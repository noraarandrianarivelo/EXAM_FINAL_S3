<?php

namespace app\services;

use app\models\DonModel;
use app\models\AttributionModel;
use app\models\BesoinModel;
use PDO;
use PDOException;

class AttributionService {

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
     * Simuler le dispatch sans écrire en base de données.
     * Retourne un tableau de résultats simulés (preview).
     */
    public function simulerDispatch($idDon)
    {
        $don = $this->donModel->getById($idDon);

        if (!$don) {
            return ['success' => false, 'message' => 'Don introuvable'];
        }

        // Calculer la quantité déjà utilisée du don
        $attributions = $this->attributionModel->getByDon($idDon);
        $utilise = 0;
        foreach ($attributions as $attr) {
            $utilise += $attr['quantite_dispatch'];
        }

        $resteDon = $don['quantite'] - $utilise;

        if ($resteDon <= 0) {
            return [
                'success' => false,
                'message' => 'Ce don a déjà été entièrement dispatché.',
                'don' => $don,
                'utilise' => $utilise,
                'reste' => 0,
                'simulation' => []
            ];
        }

        // Récupérer les besoins ouverts (FIFO par date)
        $besoins = $this->besoinModel->getBesoinsOuverts($don['id_categorie_besoin']);

        if (empty($besoins)) {
            return [
                'success' => false,
                'message' => 'Aucun besoin ouvert pour cette catégorie.',
                'don' => $don,
                'utilise' => $utilise,
                'reste' => $resteDon,
                'simulation' => []
            ];
        }

        // Simulation FIFO sans écriture en BDD
        $simulation = [];
        $resteSimule = $resteDon;

        foreach ($besoins as $besoin) {
            if ($resteSimule <= 0) {
                break;
            }

            $quantiteADispatcher = min($resteSimule, $besoin['reste']);

            $simulation[] = [
                'id_besoin' => $besoin['id'],
                'nom_ville' => $besoin['nom_ville'],
                'nom_region' => $besoin['nom_region'],
                'quantite_besoin' => $besoin['quantite'],
                'reste_besoin' => $besoin['reste'],
                'quantite_dispatch' => $quantiteADispatcher,
                'reste_besoin_apres' => $besoin['reste'] - $quantiteADispatcher,
                'date_besoin' => $besoin['date_besoin']
            ];

            $resteSimule -= $quantiteADispatcher;
        }

        return [
            'success' => true,
            'don' => $don,
            'utilise' => $utilise,
            'reste_avant' => $resteDon,
            'reste_apres' => $resteSimule,
            'total_dispatche' => $resteDon - $resteSimule,
            'nb_besoins_satisfaits' => count($simulation),
            'simulation' => $simulation
        ];
    }
}

