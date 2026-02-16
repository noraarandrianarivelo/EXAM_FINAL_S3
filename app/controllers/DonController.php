<?php

namespace app\controllers;

use flight\Engine;
use app\models\DonModel;
use app\models\CategorieBesoinModel;
use app\services\AttributionService;

class DonController
{
    protected Engine $app;

    public function __construct($app)
    {
        $this->app = $app;
    }

    /**
     * Affiche le formulaire d'ajout de don
     */
    public function create()
    {
        $categorieBesoinModel = new CategorieBesoinModel($this->app->db());
        $categories = $categorieBesoinModel->getAll();

        $this->app->render('dons/create', ['categories' => $categories]);
    }

    /**
     * Enregistre un nouveau don et lance le dispatch automatiquement
     */
    public function store()
    {
        $db = $this->app->db();
        
        // Récupérer les données du formulaire
        $quantite = $_POST['quantite'] ?? 0;
        $id_categorie_besoin = $_POST['id_categorie_besoin'] ?? 0;
        $date_saisie = $_POST['date_saisie'] ?? date('Y-m-d H:i:s');

        // Validation basique
        if (!$quantite || !$id_categorie_besoin) {
            $this->app->redirect($this->app->get('flight.base_url') . 'dons/create?error=1');
            return;
        }

        // Créer le don
        $donModel = new DonModel($db);
        $donModel->setQuantite($quantite);
        $donModel->setIdCategorieBesoin($id_categorie_besoin);
        $donModel->setDateSaisie($date_saisie);

        try {
            $idDon = $donModel->save();

            // DISPATCH AUTOMATIQUE après l'ajout
            $attributionService = new AttributionService($db);
            $resultatDispatch = $attributionService->dispatcherNouvelleArrivage($idDon);

            // Rediriger vers la page de résultat du dispatch
            $this->app->redirect($this->app->get('flight.base_url') . 'dons/' . $idDon . '/dispatch-result');
        } catch (\Exception $e) {
            $this->app->redirect($this->app->get('flight.base_url') . 'dons/create?error=2&message=' . urlencode($e->getMessage()));
        }
    }

    /**
     * Affiche le résultat du dispatch automatique après ajout
     */
    public function showDispatchResult($id)
    {
        $db = $this->app->db();
        $donModel = new DonModel($db);
        $don = $donModel->getById($id);

        if (!$don) {
            $this->app->redirect($this->app->get('flight.base_url') . 'test/dispatch');
            return;
        }

        // Récupérer les informations de dispatch
        $attributionModel = new \app\models\AttributionModel($db);
        $besoinModel = new \app\models\BesoinModel($db);

        $attributions = $attributionModel->getByDon($id);
        $utilise = 0;
        foreach ($attributions as $attr) {
            $utilise += $attr['quantite_dispatch'];
        }

        $reste = $don['quantite'] - $utilise;
        $besoinsOuverts = $besoinModel->getBesoinsOuverts($don['id_categorie_besoin']);

        $this->app->render('dons/dispatch-result', [
            'don' => $don,
            'attributions' => $attributions,
            'utilise' => $utilise,
            'reste' => $reste,
            'besoinsOuverts' => $besoinsOuverts,
            'nbAttributions' => count($attributions)
        ]);
    }
}
