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

    /**
     * Simule un dispatch proportionnel pour un don
     */
    public function simulerDispatchProportionnel($idDon)
    {
        $don = $this->donModel->getById($idDon);
        if (!$don) return ['success' => false, 'message' => 'Don introuvable'];

        // Récupérer les besoins ouverts
        $besoins = $this->besoinModel->getBesoinsOuverts($don['id_categorie_besoin']);
        if (empty($besoins)) return ['success' => false, 'message' => 'Aucun besoin ouvert'];

        // Calcul total des besoins
        $totalBesoin = array_sum(array_column($besoins, 'reste'));

        if ($totalBesoin <= 0) return ['success' => false, 'message' => 'Aucun besoin restant'];

        $resteDon = $don['quantite'];

        $attributions = [];
        $restesDecimaux = [];

        // Étape 1 : distribution proportionnelle arrondi vers le bas
        foreach ($besoins as $besoin) {
            $partReelle = ($besoin['reste'] / $totalBesoin) * $resteDon;
            $quantite = floor($partReelle);
            $attributions[$besoin['id']] = [
                'id_besoin' => $besoin['id'],
                'id_don' => $idDon,
                'quantite_dispatch' => $quantite,
                'ville' => $besoin['nom_ville'] ?? '',
                'region' => $besoin['nom_region'] ?? '',
                'reste_besoin_avant' => $besoin['reste'],
                'reste_besoin_apres' => $besoin['reste'] - $quantite
            ];
            $restesDecimaux[$besoin['id']] = $partReelle - $quantite;
        }

        // Étape 2 : redistribuer le reste
        $totalDistribue = array_sum(array_column($attributions, 'quantite_dispatch'));
        $reste = $resteDon - $totalDistribue;

        if ($reste > 0) {
            // Trier les besoins par décimal décroissant
            arsort($restesDecimaux);
            $ids = array_keys($restesDecimaux);
            $i = 0;
            while ($reste > 0) {
                $id = $ids[$i % count($ids)];
                $attributions[$id]['quantite_dispatch'] += 1;
                $attributions[$id]['reste_besoin_apres'] -= 1;
                $reste--;
                $i++;
            }
        }

        return [
            'success' => true,
            'quantite_totale' => $don['quantite'],
            'attributions' => array_values($attributions)
        ];
    }

    /**
     * Dispatch proportionnel réel pour un don
     */
    public function dispatcherDispatchProportionnel($idDon)
    {
        $simulation = $this->simulerDispatchProportionnel($idDon);

        if (!$simulation['success']) return $simulation;

        foreach ($simulation['attributions'] as $attr) {
            if ($attr['quantite_dispatch'] <= 0) continue;

            $attribution = new AttributionModel($this->db);
            $attribution->setIdBesoin($attr['id_besoin']);
            $attribution->setIdDon($attr['id_don']);
            $attribution->setQuantiteDispatch($attr['quantite_dispatch']);
            $attribution->setDateDispatch(date('Y-m-d H:i:s'));

            try {
                $attribution->save();
            } catch (\PDOException $e) {
                error_log("Erreur dispatch proportionnel : " . $e->getMessage());
            }
        }

        return [
            'success' => true,
            'quantite_dispatchee' => $simulation['quantite_totale'],
            'attributions' => $simulation['attributions']
        ];
    }

    /**
     * Simule le dispatch proportionnel pour TOUS les dons disponibles
     */
/**
 * Simule le dispatch proportionnel pour TOUS les dons disponibles
 * Retourne exactement la même structure que simulerTousLesDons()
 */
public function simulerTousLesDonsProportionnel()
{
    $dons = $this->donModel->getAll();
    $resultats = [];
    $totalSimulations = 0;
    $totalBesoinsCouverts = 0;
    $totalQuantiteDispatchee = 0;

    foreach ($dons as $don) {
        $attributionsExistantes = $this->attributionModel->getByDon($don['id']);
        $utilise = array_sum(array_column($attributionsExistantes, 'quantite_dispatch'));
        $resteDon = $don['quantite'] - $utilise;

        if ($resteDon <= 0) continue;

        // Récupérer les besoins ouverts
        $besoins = $this->besoinModel->getBesoinsOuverts($don['id_categorie_besoin']);
        if (empty($besoins)) continue;

        // Total des besoins restants
        $totalBesoin = array_sum(array_column($besoins, 'reste'));
        if ($totalBesoin <= 0) continue;

        $simulatedAttributions = [];
        $restesDecimaux = [];

        // Étape 1 : distribution proportionnelle arrondi vers le bas
        foreach ($besoins as $besoin) {
            $partReelle = ($besoin['reste'] / $totalBesoin) * $resteDon;
            $quantite = floor($partReelle);
            $simulatedAttributions[] = [
                'id_besoin' => $besoin['id'],
                'id_don' => $don['id'],
                'quantite_dispatch' => $quantite,
                'date_dispatch' => date('Y-m-d H:i:s'),
                'ville' => $besoin['nom_ville'] ?? '',
                'region' => $besoin['nom_region'] ?? '',
                'quantite_besoin' => $besoin['quantite'],
                'reste_besoin_avant' => $besoin['reste'],
                'reste_besoin_après' => $besoin['reste'] - $quantite
            ];
            $restesDecimaux[$besoin['id']] = $partReelle - $quantite;
        }

        // Étape 2 : redistribuer le reste selon les décimales
        $totalDistribue = array_sum(array_column($simulatedAttributions, 'quantite_dispatch'));
        $reste = $resteDon - $totalDistribue;

        if ($reste > 0) {
            arsort($restesDecimaux);
            $ids = array_keys($restesDecimaux);
            $i = 0;
            while ($reste > 0) {
                $id = $ids[$i % count($ids)];
                foreach ($simulatedAttributions as &$attr) {
                    if ($attr['id_besoin'] == $id) {
                        $attr['quantite_dispatch'] += 1;
                        $attr['reste_besoin_après'] -= 1;
                        $reste--;
                        break;
                    }
                }
                $i++;
            }
        }

        if (!empty($simulatedAttributions)) {
            $resultats[] = [
                'don' => $don,
                'simulation' => [
                    'success' => true,
                    'quantite_totale' => $don['quantite'],
                    'quantite_deja_utilisee' => $utilise,
                    'quantite_disponible' => $resteDon,
                    'quantite_dispatched' => $resteDon - max($reste, 0),
                    'quantite_restante' => max($reste, 0),
                    'nb_besoins_couverts' => count($simulatedAttributions),
                    'attributions' => $simulatedAttributions
                ]
            ];

            $totalSimulations++;
            $totalBesoinsCouverts += count($simulatedAttributions);
            $totalQuantiteDispatchee += ($resteDon - max($reste, 0));
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
 * Dispatch réel proportionnel pour TOUS les dons disponibles
 * Retourne exactement la même structure que dispatcherTousLesDons()
 */
public function dispatcherTousLesDonsProportionnel()
{
    $dons = $this->donModel->getAll();

    $resultats = [];
    $totalDispatchs = 0;
    $totalBesoinsCouverts = 0;
    $totalAttributions = 0;

    foreach ($dons as $don) {

        // Quantité déjà utilisée
        $attributionsAvant = $this->attributionModel->getByDon($don['id']);
        $utilise = array_sum(array_column($attributionsAvant, 'quantite_dispatch'));
        $resteDon = $don['quantite'] - $utilise;
        $avantDispatch = $utilise;

        if ($resteDon <= 0) continue;

        // Récupérer les besoins ouverts
        $besoins = $this->besoinModel->getBesoinsOuverts($don['id_categorie_besoin']);
        if (empty($besoins)) continue;

        // Calcul total des besoins restants
        $totalBesoin = array_sum(array_column($besoins, 'reste'));
        if ($totalBesoin <= 0) continue;

        $simulatedAttributions = [];
        $restesDecimaux = [];

        // Étape 1 : répartition proportionnelle arrondi vers le bas
        foreach ($besoins as $besoin) {
            $partReelle = ($besoin['reste'] / $totalBesoin) * $resteDon;
            $quantite = floor($partReelle);

            if ($quantite > 0) {
                $attribution = new \app\models\AttributionModel($this->db);
                $attribution->setIdBesoin($besoin['id']);
                $attribution->setIdDon($don['id']);
                $attribution->setQuantiteDispatch($quantite);
                $attribution->setDateDispatch(date('Y-m-d H:i:s'));

                try {
                    $attribution->save();
                    $simulatedAttributions[] = [
                        'id_besoin' => $besoin['id'],
                        'id_don' => $don['id'],
                        'quantite_dispatch' => $quantite,
                        'ville' => $besoin['nom_ville'] ?? '',
                        'region' => $besoin['nom_region'] ?? '',
                        'reste_besoin_avant' => $besoin['reste'],
                        'reste_besoin_apres' => $besoin['reste'] - $quantite
                    ];
                } catch (\PDOException $e) {
                    error_log("Erreur dispatch proportionnel : " . $e->getMessage());
                }
            }
            $restesDecimaux[$besoin['id']] = $partReelle - $quantite;
        }

        // Étape 2 : redistribuer le reste selon les décimales
        $totalDistribue = array_sum(array_column($simulatedAttributions, 'quantite_dispatch'));
        $reste = $resteDon - $totalDistribue;

        if ($reste > 0) {
            arsort($restesDecimaux);
            $ids = array_keys($restesDecimaux);
            $i = 0;
            while ($reste > 0) {
                $id = $ids[$i % count($ids)];
                foreach ($simulatedAttributions as &$attr) {
                    if ($attr['id_besoin'] == $id) {
                        $attr['quantite_dispatch'] += 1;
                        $attr['reste_besoin_apres'] -= 1;
                        $reste--;
                        break;
                    }
                }
                $i++;
            }
        }

        // Récupérer toutes les attributions après dispatch
        $attributionsApres = $this->attributionModel->getByDon($don['id']);
        $apresDispatch = array_sum(array_column($attributionsApres, 'quantite_dispatch'));
        $nbNouvellesAttributions = count($attributionsApres) - count($attributionsAvant);

        if ($nbNouvellesAttributions > 0) {
            $resultats[] = [
                'don' => $don,
                'avant' => $avantDispatch,
                'apres' => $apresDispatch,
                'dispatche' => $apresDispatch - $avantDispatch,
                'nb_attributions' => $nbNouvellesAttributions,
                'nouvelles_attributions' => array_slice($attributionsApres, -$nbNouvellesAttributions)
            ];

            $totalDispatchs++;
            $totalBesoinsCouverts += $nbNouvellesAttributions;
            $totalAttributions += $nbNouvellesAttributions;
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
