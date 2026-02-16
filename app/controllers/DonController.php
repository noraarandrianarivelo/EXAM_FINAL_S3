<?php

namespace app\controllers;

use flight\Engine;
use app\models\DonModel;
use app\models\CategorieBesoinModel;

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
     * Enregistre un nouveau don (sans dispatch automatique)
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

            // Rediriger vers la page de dispatch avec les boutons Simuler/Valider
            $this->app->redirect($this->app->get('flight.base_url') . 'test/dispatch/don/' . $idDon);
        } catch (\Exception $e) {
            $this->app->redirect($this->app->get('flight.base_url') . 'dons/create?error=2&message=' . urlencode($e->getMessage()));
        }
    }


}
