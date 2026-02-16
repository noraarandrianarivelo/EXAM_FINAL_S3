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
}
