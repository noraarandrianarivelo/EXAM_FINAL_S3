<?php

namespace app\services;

use app\models\DonModel;
use app\models\AttributionModel;
use app\models\BesoinModel;
use PDO;
use PDOException;

class AttributionService
{

    private $db;
    private DonModel $donModel;
    private AttributionModel $attributionModel;
    private BesoinModel $besoinModel;

    public function __construct($db)
    {
        $this->db = $db;
        $this->donModel = new DonModel($db);
        $this->attributionModel = new AttributionModel($db);
        $this->besoinModel = new BesoinModel($db);
    }


    public function dispatcherNouvelleArrivage($idDon)
    {
        // =============================
        // Récupérer le don
        // =============================
        $don = $this->donModel->getById($idDon);

        if (!$don) {
            return false;
        }

        // =============================
        // Calculer la quantité déjà utilisée du don
        // =============================
        $attributions = $this->attributionModel->getByDon($idDon);
        $utilise = 0;
        foreach ($attributions as $attr) {
            $utilise += $attr['quantite_dispatch'];
        }

        $resteDon = $don['quantite'] - $utilise;

        if ($resteDon <= 0) {
            return false;
        }

        // =============================
        // Récupérer les besoins ouverts (FIFO par date)
        // =============================
        $besoins = $this->besoinModel->getBesoinsOuverts($don['id_categorie_besoin']);

        // =============================
        // Boucle FIFO - dispatcher le don aux besoins
        // =============================
        foreach ($besoins as $besoin) {
            if ($resteDon <= 0) {
                break;
            }

            // Quantité à dispatcher = minimum entre reste du don et reste du besoin
            $quantiteADispatcher = min($resteDon, $besoin['reste']);

            // Créer une nouvelle attribution
            $attribution = new AttributionModel($this->db);
            $attribution->setIdBesoin($besoin['id']);
            $attribution->setIdDon($idDon);
            $attribution->setQuantiteDispatch($quantiteADispatcher);
            $attribution->setDateDispatch(date('Y-m-d H:i:s'));

            try {
                $attribution->save();
                $resteDon -= $quantiteADispatcher;
            } catch (PDOException $e) {
                // Log l'erreur mais continue avec les autres besoins
                error_log("Erreur lors du dispatch : " . $e->getMessage());
            }
        }

        return true;
    }

    /**
     * Simule le dispatch sans enregistrer dans la base de données
     * Retourne un tableau avec les attributions qui seraient créées
     */
    public function simulerDispatch($idDon)
    {
        // =============================
        // Récupérer le don
        // =============================
        $don = $this->donModel->getById($idDon);

        if (!$don) {
            return [
                'success' => false,
                'message' => 'Don introuvable'
            ];
        }

        // =============================
        // Calculer la quantité déjà utilisée du don
        // =============================
        $attributions = $this->attributionModel->getByDon($idDon);
        $utilise = 0;
        foreach ($attributions as $attr) {
            $utilise += $attr['quantite_dispatch'];
        }

        $resteDon = $don['quantite'] - $utilise;

        if ($resteDon <= 0) {
            return [
                'success' => false,
                'message' => 'Aucune quantité disponible pour ce don'
            ];
        }

        // =============================
        // Récupérer les besoins ouverts (FIFO par date)
        // =============================
        $besoins = $this->besoinModel->getBesoinsOuverts($don['id_categorie_besoin']);

        if (empty($besoins)) {
            return [
                'success' => false,
                'message' => 'Aucun besoin ouvert pour cette catégorie'
            ];
        }

        // =============================
        // Simuler le dispatch
        // =============================
        $simulatedAttributions = [];
        $resteDonSimule = $resteDon;

        foreach ($besoins as $besoin) {
            if ($resteDonSimule <= 0) {
                break;
            }

            // Quantité à dispatcher = minimum entre reste du don et reste du besoin
            $quantiteADispatcher = min($resteDonSimule, $besoin['reste']);

            // Créer une attribution simulée
            $simulatedAttributions[] = [
                'id_besoin' => $besoin['id'],
                'id_don' => $idDon,
                'quantite_dispatch' => $quantiteADispatcher,
                'date_dispatch' => date('Y-m-d H:i:s'),
                'ville' => $besoin['nom_ville'],
                'region' => $besoin['nom_region'],
                'quantite_besoin' => $besoin['quantite'],
                'reste_besoin_avant' => $besoin['reste'],
                'reste_besoin_après' => $besoin['reste'] - $quantiteADispatcher
            ];

            $resteDonSimule -= $quantiteADispatcher;
        }

        return [
            'success' => true,
            'quantite_totale' => $don['quantite'],
            'quantite_deja_utilisee' => $utilise,
            'quantite_disponible' => $resteDon,
            'quantite_dispatched' => $resteDon - $resteDonSimule,
            'quantite_restante' => $resteDonSimule,
            'nb_besoins_couverts' => count($simulatedAttributions),
            'attributions' => $simulatedAttributions
        ];
    }

    /**
     * Simule le dispatch de TOUS les dons avec quantité disponible
     * Retourne un tableau avec les attributions groupées par don
     */
    public function simulerTousLesDons()
    {
        // Récupérer tous les dons
        $dons = $this->donModel->getAll();

        $resultats = [];
        $totalSimulations = 0;
        $totalBesoinsCouverts = 0;
        $totalQuantiteDispatchee = 0;

        foreach ($dons as $don) {
            // Calculer la quantité déjà utilisée
            $attributions = $this->attributionModel->getByDon($don['id']);
            $utilise = 0;
            foreach ($attributions as $attr) {
                $utilise += $attr['quantite_dispatch'];
            }

            $reste = $don['quantite'] - $utilise;

            // Simuler seulement si du reste disponible
            if ($reste > 0) {
                $simulation = $this->simulerDispatch($don['id']);

                if ($simulation['success']) {
                    $resultats[] = [
                        'don' => $don,
                        'simulation' => $simulation
                    ];
                    $totalSimulations++;
                    $totalBesoinsCouverts += $simulation['nb_besoins_couverts'];
                    $totalQuantiteDispatchee += $simulation['quantite_dispatched'];
                }
            }
        }

        return [
            'success' => !empty($resultats),
            'nb_dons_a_dispatcher' => $totalSimulations,
            'nb_besoins_couverts' => $totalBesoinsCouverts,
            'quantite_totale_dispatchee' => $totalQuantiteDispatchee,
            'resultats' => $resultats
        ];
    }

    /**
     * Simule le dispatch de TOUS les dons en priorisant les besoins du plus petit au plus grand
     */
    public function simulerTousLesDonsBesoinCroissant()
    {
        $dons = $this->donModel->getAll();
        $resultats = [];
        $totalSimulations = 0;
        $totalBesoinsCouverts = 0;
        $totalQuantiteDispatchee = 0;
        foreach ($dons as $don) {
            $attributions = $this->attributionModel->getByDon($don['id']);
            $utilise = 0;
            foreach ($attributions as $attr) {
                $utilise += $attr['quantite_dispatch'];
            }
            $reste = $don['quantite'] - $utilise;
            if ($reste > 0) {
                // Récupérer tous les besoins ouverts de la même catégorie, triés par quantité croissante
                $besoins = $this->besoinModel->getBesoinsOuverts($don['id_categorie_besoin']);
                usort($besoins, function ($a, $b) {
                    return $a['reste'] <=> $b['reste'];
                });
                $simulatedAttributions = [];
                $resteDonSimule = $reste;
                foreach ($besoins as $besoin) {
                    if ($resteDonSimule <= 0) break;
                    $quantiteADispatcher = min($resteDonSimule, $besoin['reste']);
                    if ($quantiteADispatcher > 0) {
                        $simulatedAttributions[] = [
                            'id_besoin' => $besoin['id'],
                            'id_don' => $don['id'],
                            'quantite_dispatch' => $quantiteADispatcher,
                            'date_dispatch' => date('Y-m-d H:i:s'),
                            'ville' => $besoin['nom_ville'] ?? '',
                            'region' => $besoin['nom_region'] ?? '',
                            'quantite_besoin' => $besoin['quantite'],
                            'reste_besoin_avant' => $besoin['reste'],
                            'reste_besoin_après' => $besoin['reste'] - $quantiteADispatcher
                        ];
                        $resteDonSimule -= $quantiteADispatcher;
                    }
                }
                if (!empty($simulatedAttributions)) {
                    $resultats[] = [
                        'don' => $don,
                        'simulation' => [
                            'success' => true,
                            'quantite_totale' => $don['quantite'],
                            'quantite_deja_utilisee' => $utilise,
                            'quantite_disponible' => $reste,
                            'quantite_dispatched' => $reste - $resteDonSimule,
                            'quantite_restante' => $resteDonSimule,
                            'nb_besoins_couverts' => count($simulatedAttributions),
                            'attributions' => $simulatedAttributions
                        ]
                    ];
                    $totalSimulations++;
                    $totalBesoinsCouverts += count($simulatedAttributions);
                    $totalQuantiteDispatchee += ($reste - $resteDonSimule);
                }
            }
        }
        return [
            'success' => !empty($resultats),
            'nb_dons_a_dispatcher' => $totalSimulations,
            'nb_besoins_couverts' => $totalBesoinsCouverts,
            'quantite_totale_dispatchee' => $totalQuantiteDispatchee,
            'resultats' => $resultats
        ];
    }

    /**
     * Dispatch réel de TOUS les dons avec quantité disponible
     */
    public function dispatcherTousLesDons()
    {
        // Récupérer tous les dons
        $dons = $this->donModel->getAll();

        $resultats = [];
        $totalDispatchs = 0;
        $totalBesoinsCouverts = 0;
        $totalAttributions = 0;

        foreach ($dons as $don) {
            // Calculer la quantité déjà utilisée
            $attributions = $this->attributionModel->getByDon($don['id']);
            $utilise = 0;
            foreach ($attributions as $attr) {
                $utilise += $attr['quantite_dispatch'];
            }

            $reste = $don['quantite'] - $utilise;
            $avantDispatch = $utilise;

            // Dispatcher seulement si du reste disponible
            if ($reste > 0) {
                $success = $this->dispatcherNouvelleArrivage($don['id']);

                if ($success) {
                    // Récupérer les nouvelles attributions
                    $nouvellesAttributions = $this->attributionModel->getByDon($don['id']);
                    $apresDispatch = 0;
                    foreach ($nouvellesAttributions as $attr) {
                        $apresDispatch += $attr['quantite_dispatch'];
                    }

                    $quantiteDispatchee = $apresDispatch - $avantDispatch;
                    $nbNouvellesAttributions = count($nouvellesAttributions) - count($attributions);

                    $resultats[] = [
                        'don' => $don,
                        'avant' => $avantDispatch,
                        'apres' => $apresDispatch,
                        'dispatche' => $quantiteDispatchee,
                        'nb_attributions' => $nbNouvellesAttributions,
                        'nouvelles_attributions' => array_slice($nouvellesAttributions, -$nbNouvellesAttributions)
                    ];

                    $totalDispatchs++;
                    $totalBesoinsCouverts += $nbNouvellesAttributions;
                    $totalAttributions += $nbNouvellesAttributions;
                }
            }
        }

        return [
            'success' => !empty($resultats),
            'nb_dons_dispatches' => $totalDispatchs,
            'nb_besoins_couverts' => $totalBesoinsCouverts,
            'nb_attributions' => $totalAttributions,
            'resultats' => $resultats
        ];
    }


    /**
     * Dispatch réel de TOUS les dons en priorisant les besoins du plus petit au plus grand
     */
    public function dispatcherTousLesDonsBesoinCroissant()
    {
        $dons = $this->donModel->getAll();

        $resultats = [];
        $totalDispatchs = 0;
        $totalBesoinsCouverts = 0;
        $totalAttributions = 0;

        foreach ($dons as $don) {

            // Quantité déjà utilisée
            $attributionsAvant = $this->attributionModel->getByDon($don['id']);
            $utilise = 0;
            foreach ($attributionsAvant as $attr) {
                $utilise += $attr['quantite_dispatch'];
            }

            $reste = $don['quantite'] - $utilise;
            $avantDispatch = $utilise;

            if ($reste > 0) {

                // Besoins ouverts même catégorie
                $besoins = $this->besoinModel->getBesoinsOuverts($don['id_categorie_besoin']);

                // Tri croissant sur le reste
                usort($besoins, function ($a, $b) {
                    return $a['reste'] <=> $b['reste'];
                });

                foreach ($besoins as $besoin) {

                    if ($reste <= 0) break;

                    $quantiteADispatcher = min($reste, $besoin['reste']);

                    if ($quantiteADispatcher > 0) {

                        $attribution = new \app\models\AttributionModel($this->db);
                        $attribution->setIdBesoin($besoin['id']);
                        $attribution->setIdDon($don['id']);
                        $attribution->setQuantiteDispatch($quantiteADispatcher);
                        $attribution->setDateDispatch(date('Y-m-d H:i:s'));

                        try {
                            $attribution->save();
                            $reste -= $quantiteADispatcher;
                        } catch (\PDOException $e) {
                            error_log("Erreur dispatch croissant : " . $e->getMessage());
                        }
                    }
                }

                // Récupérer les nouvelles attributions
                $attributionsApres = $this->attributionModel->getByDon($don['id']);

                $apresDispatch = 0;
                foreach ($attributionsApres as $attr) {
                    $apresDispatch += $attr['quantite_dispatch'];
                }

                $quantiteDispatchee = $apresDispatch - $avantDispatch;
                $nbNouvellesAttributions = count($attributionsApres) - count($attributionsAvant);

                if ($nbNouvellesAttributions > 0) {

                    $resultats[] = [
                        'don' => $don,
                        'avant' => $avantDispatch,
                        'apres' => $apresDispatch,
                        'dispatche' => $quantiteDispatchee,
                        'nb_attributions' => $nbNouvellesAttributions,
                        'nouvelles_attributions' => array_slice($attributionsApres, -$nbNouvellesAttributions)
                    ];

                    $totalDispatchs++;
                    $totalBesoinsCouverts += $nbNouvellesAttributions;
                    $totalAttributions += $nbNouvellesAttributions;
                }
            }
        }

        return [
            'success' => !empty($resultats),
            'nb_dons_dispatches' => $totalDispatchs,
            'nb_besoins_couverts' => $totalBesoinsCouverts,
            'nb_attributions' => $totalAttributions,
            'resultats' => $resultats
        ];
    }
}
