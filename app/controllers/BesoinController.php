<?php

namespace app\controllers;

use flight\Engine;
use app\models\BesoinModel;
use app\models\CategorieBesoinModel;

class BesoinController
{
    protected Engine $app;

    public function __construct(Engine $app)
    {
        $this->app = $app;
    }

    /**
     * Affiche la liste des besoins (Read)
     */
    public function index()
    {
        $db = $this->app->db();
        $besoinModel = new BesoinModel($db);
        
        // Récupère tous les besoins avec les jointures (ville, catégorie, etc.)
        $besoins = $besoinModel->getAll();

        $this->app->render('besoins/index', ['besoins' => $besoins]);
    }

    /**
     * Affiche le formulaire d'ajout de besoin
     */
    public function create()
    {
        $db = $this->app->db();

        $categorieModel = new CategorieBesoinModel($db);
        $categories = $categorieModel->getAll();

        $stmt = $db->prepare('SELECT id, nom FROM bngrc_ville ORDER BY nom ASC');
        $stmt->execute();
        $villes = $stmt->fetchAll(\PDO::FETCH_ASSOC);

        $this->app->render('besoins/create', [
            'categories' => $categories,
            'villes' => $villes
        ]);
    }

    /**
     * Enregistre le besoin en base de données
     */
    public function store()
    {
        $db = $this->app->db();

        $id_ville = $_POST['ville'] ?? null;
        $id_categorie_besoin = $_POST['categorie_besoin'] ?? null;
        $quantite = $_POST['quantite'] ?? 0;
        $pu = $_POST['prix_unitaire'] ?? 0;
        $date_besoin = $_POST['date_ajout'] ?? date('Y-m-d');

        if (!$id_ville || !$id_categorie_besoin || !$quantite || !$pu) {
            $this->app->redirect($this->app->get('flight.base_url') . 'besoins/create?error=missing');
            return;
        }

        $besoinModel = new BesoinModel($db);
        $besoinModel->setIdVille($id_ville);
        $besoinModel->setIdCategorieBesoin($id_categorie_besoin);
        $besoinModel->setQuantite($quantite);
        $besoinModel->setPu($pu);
        $besoinModel->setDateBesoin($date_besoin);

        try {
            $besoinModel->save();
            $this->app->redirect($this->app->get('flight.base_url') . 'besoins?success=created');
        } catch (\Exception $e) {
            $this->app->redirect($this->app->get('flight.base_url') . 'besoins/create?error=db');
        }
    }

    /**
     * Affiche le formulaire d'édition (Update - Partie 1)
     */
    public function edit($id)
    {
        $db = $this->app->db();
        $besoinModel = new BesoinModel($db);

        // Récupère les infos du besoin actuel
        $besoin = $besoinModel->getById($id);

        if (!$besoin) {
            $this->app->redirect($this->app->get('flight.base_url') . 'besoins');
            return;
        }

        // Récupère les listes pour les selects
        $categorieModel = new CategorieBesoinModel($db);
        $categories = $categorieModel->getAll();

        $stmt = $db->prepare('SELECT id, nom FROM bngrc_ville ORDER BY nom ASC');
        $stmt->execute();
        $villes = $stmt->fetchAll(\PDO::FETCH_ASSOC);

        $this->app->render('besoins/edit', [
            'besoin' => $besoin,
            'categories' => $categories,
            'villes' => $villes
        ]);
    }

    /**
     * Traite la mise à jour (Update - Partie 2)
     */
    public function update($id)
    {
        $db = $this->app->db();

        $besoinModel = new BesoinModel($db);
        $besoinModel->setId($id);
        $besoinModel->setIdVille($_POST['ville'] ?? null);
        $besoinModel->setIdCategorieBesoin($_POST['categorie_besoin'] ?? null);
        $besoinModel->setQuantite($_POST['quantite'] ?? 0);
        $besoinModel->setPu($_POST['prix_unitaire'] ?? 0);
        $besoinModel->setDateBesoin($_POST['date_ajout'] ?? date('Y-m-d'));

        try {
            $besoinModel->update();
            $this->app->redirect($this->app->get('flight.base_url') . 'besoins?success=updated');
        } catch (\Exception $e) {
            $this->app->redirect($this->app->get('flight.base_url') . 'besoins/' . $id . '/edit?error=db');
        }
    }

    /**
     * Supprime un besoin
     */
    public function delete($id)
    {
        $db = $this->app->db();
        $besoinModel = new BesoinModel($db);
        $besoinModel->setId($id);

        try {
            $besoinModel->delete();
            $this->app->redirect($this->app->get('flight.base_url') . 'besoins?success=deleted');
        } catch (\Exception $e) {
            // Gestion erreur si contrainte de clé étrangère (besoin déjà attribué)
            $this->app->redirect($this->app->get('flight.base_url') . 'besoins?error=delete');
        }
    }
}