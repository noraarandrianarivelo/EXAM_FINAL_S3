<?php

namespace app\controllers;

use flight\Engine;
use app\models\VilleModel;
use app\models\BesoinModel;
use app\models\AttributionModel;
use app\models\DonModel;
use app\models\RegionModel;

class DashboardController
{
	protected Engine $app;

	public function __construct($app)
	{
		$this->app = $app;
	}

	public function showDashboard()
    {
        $db = $this->app->db();
        
        // Récupérer toutes les villes avec leurs besoins et attributions
        $villeModel = new VilleModel($db);
        $besoinModel = new BesoinModel($db);
        $attributionModel = new AttributionModel($db);
        $donModel = new DonModel($db);
        $regionModel = new RegionModel($db);
        
        $villes = $villeModel->getAll();
        
        // Pour chaque ville, calculer les statistiques
        $villesData = [];
        foreach ($villes as $ville) {
            // Récupérer le nom de la région
            $region = $regionModel->getById($ville['id_region']);
            $nomRegion = $region ? $region['nom'] : 'N/A';
            
            $besoins = $besoinModel->getByVille($ville['id']);
            
            $totalBesoins = 0;
            $totalRecus = 0;
            $nbBesoins = count($besoins);
            
            // Enrichir les besoins avec les détails des attributions
            $besoinsEnriches = [];
            foreach ($besoins as $besoin) {
                $totalBesoins += $besoin['quantite'];
                
                // Récupérer les attributions pour ce besoin
                $attributions = $attributionModel->getByBesoin($besoin['id']);
                $quantiteRecue = 0;
                foreach ($attributions as $attr) {
                    $quantiteRecue += $attr['quantite_dispatch'];
                    $totalRecus += $attr['quantite_dispatch'];
                }
                
                // Ajouter les infos calculées au besoin
                $besoin['quantite_recue'] = $quantiteRecue;
                $besoin['reste'] = $besoin['quantite'] - $quantiteRecue;
                $besoin['quantite_besoin'] = $besoin['quantite'];
                $besoinsEnriches[] = $besoin;
            }
            
            $reste = $totalBesoins - $totalRecus;
            $pourcentage = $totalBesoins > 0 ? ($totalRecus / $totalBesoins) * 100 : 0;
            
            $villesData[] = [
                'nom' => $ville['nom'],
                'region' => $nomRegion,
                'besoins' => $besoinsEnriches,
                'nb_besoins' => $nbBesoins,
                'total_besoins' => $totalBesoins,
                'total_recus' => $totalRecus,
                'reste' => $reste,
                'pourcentage' => $pourcentage
            ];
        }
        
        // Statistiques globales
        $allDons = $donModel->getAll();
        $allBesoins = $besoinModel->getAll();
        $allAttributions = $attributionModel->getAll();
        
        $stats = [
            'total_dons' => count($allDons),
            'total_besoins' => count($allBesoins),
            'total_attributions' => count($allAttributions),
            'total_villes' => count($villes)
        ];
        
        $this->app->render('index', [
            'villesData' => $villesData,
            'stats' => $stats
        ]);
    }

    /**
     * Affiche la page de récapitulation des besoins en montant
     */
    public function recapitulation()
    {
        $db = $this->app->db();
        $stats = $this->calculerStatsRecapitulation($db);
        
        $this->app->render('dashboard/recapitulation', [
            'stats' => $stats
        ]);
    }

    /**
     * API JSON pour récupérer les statistiques en temps réel
     */
    public function getStatsRecapitulation()
    {
        $db = $this->app->db();
        $stats = $this->calculerStatsRecapitulation($db);
        
        header('Content-Type: application/json');
        echo json_encode($stats);
    }

    /**
     * Calcule les statistiques de récapitulation
     */
    private function calculerStatsRecapitulation($db)
    {
        // Calculer le montant total des besoins (quantite * pu_categorie)
        $queryBesoinsTotal = "
            SELECT 
                COALESCE(SUM(b.quantite * cb.pu), 0) as montant_total_besoins,
                COUNT(b.id) as nombre_besoins
            FROM bngrc_besoin b
            INNER JOIN bngrc_categorie_besoin cb ON b.id_categorie_besoin = cb.id
        ";
        $stmtBesoins = $db->prepare($queryBesoinsTotal);
        $stmtBesoins->execute();
        $besoins = $stmtBesoins->fetch(\PDO::FETCH_ASSOC);

        // Calculer le montant satisfait (quantite_dispatch * pu_categorie)
        $querySatisfait = "
            SELECT 
                COALESCE(SUM(a.quantite_dispatch * cb.pu), 0) as montant_satisfait,
                COUNT(a.id) as nombre_attributions
            FROM bngrc_attribution a
            INNER JOIN bngrc_besoin b ON a.id_besoin = b.id
            INNER JOIN bngrc_categorie_besoin cb ON b.id_categorie_besoin = cb.id
        ";
        $stmtSatisfait = $db->prepare($querySatisfait);
        $stmtSatisfait->execute();
        $satisfait = $stmtSatisfait->fetch(\PDO::FETCH_ASSOC);

        // Calculer les achats effectués
        $queryAchats = "
            SELECT 
                COALESCE(SUM(montant_total), 0) as montant_achats,
                COUNT(id) as nombre_achats
            FROM bngrc_achat
        ";
        $stmtAchats = $db->prepare($queryAchats);
        $stmtAchats->execute();
        $achats = $stmtAchats->fetch(\PDO::FETCH_ASSOC);

        // Calculer le montant des dons disponibles
        $queryDons = "
            SELECT 
                COALESCE(SUM(d.quantite * cb.pu), 0) as montant_dons,
                COUNT(d.id) as nombre_dons
            FROM bngrc_don d
            INNER JOIN bngrc_categorie_besoin cb ON d.id_categorie_besoin = cb.id
        ";
        $stmtDons = $db->prepare($queryDons);
        $stmtDons->execute();
        $dons = $stmtDons->fetch(\PDO::FETCH_ASSOC);

        $montantTotal = (float) $besoins['montant_total_besoins'];
        $montantSatisfait = (float) $satisfait['montant_satisfait'];
        $montantRestant = $montantTotal - $montantSatisfait;
        $pourcentageSatisfait = $montantTotal > 0 ? ($montantSatisfait / $montantTotal) * 100 : 0;

        return [
            'montant_total_besoins' => $montantTotal,
            'montant_satisfait' => $montantSatisfait,
            'montant_restant' => $montantRestant,
            'pourcentage_satisfait' => $pourcentageSatisfait,
            'nombre_besoins' => (int) $besoins['nombre_besoins'],
            'nombre_attributions' => (int) $satisfait['nombre_attributions'],
            'montant_achats' => (float) $achats['montant_achats'],
            'nombre_achats' => (int) $achats['nombre_achats'],
            'montant_dons' => (float) $dons['montant_dons'],
            'nombre_dons' => (int) $dons['nombre_dons'],
            'timestamp' => date('Y-m-d H:i:s')
        ];
    }
}
