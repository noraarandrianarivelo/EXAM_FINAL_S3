<?php

namespace app\controllers;

use flight\Engine;
use app\models\DonModel;
use app\models\BesoinModel;
use app\models\AttributionModel;
use app\services\AttributionService;

class TestController
{
    protected Engine $app;

    public function __construct($app)
    {
        $this->app = $app;
    }

    /**
     * Affiche la liste des dons disponibles pour tester le dispatch
     */
    public function index()
    {
        $db = $this->app->db();
        $donModel = new DonModel($db);
        $attributionModel = new AttributionModel($db);
        
        $dons = $donModel->getAll();
        
        // Ajouter les informations de dispatch pour chaque don
        foreach ($dons as &$don) {
            $attributions = $attributionModel->getByDon($don['id']);
            $utilise = 0;
            foreach ($attributions as $attr) {
                $utilise += $attr['quantite_dispatch'];
            }
            $don['utilise'] = $utilise;
            $don['reste'] = $don['quantite'] - $utilise;
            $don['nb_attributions'] = count($attributions);
        }

        $this->app->render('test/index', ['dons' => $dons]);
    }

    /**
     * Affiche l'état du don avant dispatch
     */
    public function showDon($id)
    {
        $db = $this->app->db();
        $donModel = new DonModel($db);
        $besoinModel = new BesoinModel($db);
        $attributionModel = new AttributionModel($db);

        $don = $donModel->getById($id);
        
        if (!$don) {
            $this->app->redirect($this->app->get('flight.base_url') . 'test/dispatch');
            return;
        }

        // Calculer la quantité déjà utilisée
        $attributions = $attributionModel->getByDon($id);
        $utilise = 0;
        foreach ($attributions as $attr) {
            $utilise += $attr['quantite_dispatch'];
        }

        $reste = $don['quantite'] - $utilise;

        // Récupérer les besoins ouverts
        $besoins = $besoinModel->getBesoinsOuverts($don['id_categorie_besoin']);

        $this->app->render('test/show', [
            'don' => $don,
            'utilise' => $utilise,
            'reste' => $reste,
            'besoins' => $besoins,
            'attributions' => $attributions
        ]);
    }

    /**
     * Simule le dispatch sans enregistrer dans la DB
     */
    public function simuler($id)
    {
        $db = $this->app->db();
        $donModel = new DonModel($db);
        $besoinModel = new BesoinModel($db);
        $attributionModel = new AttributionModel($db);

        $don = $donModel->getById($id);
        
        if (!$don) {
            $this->app->redirect($this->app->get('flight.base_url') . 'test/dispatch');
            return;
        }

        // État AVANT
        $attributionsAvant = $attributionModel->getByDon($id);
        $utiliseAvant = 0;
        foreach ($attributionsAvant as $attr) {
            $utiliseAvant += $attr['quantite_dispatch'];
        }
        $resteAvant = $don['quantite'] - $utiliseAvant;

        // Besoins ouverts AVANT
        $besoinsAvant = $besoinModel->getBesoinsOuverts($don['id_categorie_besoin']);

        // SIMULATION DU DISPATCH (sans enregistrement)
        $attributionService = new AttributionService($db);
        $simulation = $attributionService->simulerDispatch($id);

        $this->app->render('test/simulation', [
            'don' => $don,
            'simulation' => $simulation,
            'avant' => [
                'utilise' => $utiliseAvant,
                'reste' => $resteAvant,
                'besoins' => $besoinsAvant,
                'attributions' => $attributionsAvant
            ]
        ]);
    }

    /**
     * Exécute le dispatch et affiche les résultats
     */
    public function dispatch($id)
    {
        $db = $this->app->db();
        $donModel = new DonModel($db);
        $besoinModel = new BesoinModel($db);
        $attributionModel = new AttributionModel($db);

        $don = $donModel->getById($id);
        
        if (!$don) {
            $this->app->redirect($this->app->get('flight.base_url') . 'test/dispatch');
            return;
        }

        // État AVANT
        $attributionsAvant = $attributionModel->getByDon($id);
        $utiliseAvant = 0;
        foreach ($attributionsAvant as $attr) {
            $utiliseAvant += $attr['quantite_dispatch'];
        }
        $resteAvant = $don['quantite'] - $utiliseAvant;

        // Besoins ouverts AVANT
        $besoinsAvant = $besoinModel->getBesoinsOuverts($don['id_categorie_besoin']);

        // EXÉCUTION DU DISPATCH
        $attributionService = new AttributionService($db);
        $resultat = $attributionService->dispatcherNouvelleArrivage($id);

        // État APRÈS
        $attributionsApres = $attributionModel->getByDon($id);
        $utiliseApres = 0;
        foreach ($attributionsApres as $attr) {
            $utiliseApres += $attr['quantite_dispatch'];
        }
        $resteApres = $don['quantite'] - $utiliseApres;

        // Besoins ouverts APRÈS
        $besoinsApres = $besoinModel->getBesoinsOuverts($don['id_categorie_besoin']);

        // Nouvelles attributions créées
        $nouvellesAttributions = [];
        foreach ($attributionsApres as $attrApres) {
            $isNew = true;
            foreach ($attributionsAvant as $attrAvant) {
                if ($attrAvant['id'] == $attrApres['id']) {
                    $isNew = false;
                    break;
                }
            }
            if ($isNew) {
                $nouvellesAttributions[] = $attrApres;
            }
        }

        $this->app->render('test/result', [
            'don' => $don,
            'resultat' => $resultat,
            'avant' => [
                'utilise' => $utiliseAvant,
                'reste' => $resteAvant,
                'besoins' => $besoinsAvant,
                'attributions' => $attributionsAvant
            ],
            'apres' => [
                'utilise' => $utiliseApres,
                'reste' => $resteApres,
                'besoins' => $besoinsApres,
                'attributions' => $attributionsApres
            ],
            'nouvelles' => $nouvellesAttributions
        ]);
    }

    /**
     * Simule le dispatch de TOUS les dons (GÉNÉRAL)
     */
    public function simulerTout()
    {
        $db = $this->app->db();
        $attributionService = new AttributionService($db);

        // Simuler tous les dons
        $resultat = $attributionService->simulerTousLesDons();

        $this->app->render('test/simulation-generale', [
            'resultat' => $resultat
        ]);
    }

    /**
     * Exécute le dispatch réel de TOUS les dons (GÉNÉRAL)
     */
    public function dispatcherTout()
    {
        $db = $this->app->db();
        $attributionService = new AttributionService($db);

        // Dispatch réel de tous les dons
        $resultat = $attributionService->dispatcherTousLesDons();

        $this->app->render('test/result-general', [
            'resultat' => $resultat
        ]);
    }

    /**
     * Exécute le dispatch réel de TOUS les dons (Besoins du plus petit au plus grand)
     */
public function dispatcherToutCroissant()
{
    $db = $this->app->db();
    $attributionService = new \app\services\AttributionService($db);

    // Dispatch réel croissant
    $resultat = $attributionService->dispatcherTousLesDonsBesoinCroissant();

    $this->app->render('test/result-tout-croissant', [
        'resultat' => $resultat
    ]);
}


    public function simulerToutCroissant()
    {
        $db = $this->app->db();
        $attributionService = new \app\services\AttributionService($db);
        $resultat = $attributionService->simulerTousLesDonsBesoinCroissant();
        $this->app->render('test/simulation-tout-croissant', [
            'resultat' => $resultat
        ]);
    }
}
