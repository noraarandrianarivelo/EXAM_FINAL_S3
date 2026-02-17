<?php

namespace app\controllers;

use flight\Engine;
use app\models\CategorieBesoinModel;

class CategorieBesoinController
{
    protected Engine $app;

    public function __construct(Engine $app)
    {
        $this->app = $app;
    }

    /**
     * Fonction helper pour inclure le layout
     */
    protected function renderPage(string $viewName, array $data = [])
    {
        // Capture le contenu de la vue spécifique
        $this->app->render($viewName, $data, 'content');
        // Rend le layout principal
        $this->app->render('partials/body');
    }

    /**
     * Affiche la liste des catégories
     */
    public function index()
    {
        $db = $this->app->db();
        $model = new CategorieBesoinModel($db);
        
        // Récupère toutes les catégories avec le nom du type de besoin
        $categories = $model->getAll();

        $this->renderPage('categoriebesoin/index', ['categories' => $categories]);
    }

    /**
     * Affiche le formulaire d'ajout
     */
    public function create()
    {
        $db = $this->app->db();

        // Récupération des types de besoins pour le select
        $stmt = $db->prepare('SELECT id, nom FROM bngrc_type_besoin ORDER BY nom ASC');
        $stmt->execute();
        $types = $stmt->fetchAll(\PDO::FETCH_ASSOC);

        $this->renderPage('categoriebesoin/create', ['types' => $types]);
    }

    /**
     * Enregistre une nouvelle catégorie
     */
    public function store()
    {
        $db = $this->app->db();

        $nom = $_POST['nom'] ?? null;
        $pu = $_POST['pu'] ?? null;
        $id_type_besoin = $_POST['id_type_besoin'] ?? null;

        if (!$nom || !$pu || !$id_type_besoin) {
            $this->app->redirect($this->app->get('flight.base_url') . 'categories/create?error=missing');
            return;
        }

        $model = new CategorieBesoinModel($db);
        $model->setNom($nom);
        $model->setPu($pu);
        $model->setIdTypeBesoin($id_type_besoin);

        try {
            $model->save();
            $this->app->redirect($this->app->get('flight.base_url') . 'categories?success=created');
        } catch (\Exception $e) {
            $this->app->redirect($this->app->get('flight.base_url') . 'categories/create?error=db');
        }
    }

    /**
     * Affiche le formulaire d'édition
     */
    public function edit($id)
    {
        $db = $this->app->db();
        $model = new CategorieBesoinModel($db);

        $categorie = $model->getById($id);

        if (!$categorie) {
            $this->app->redirect($this->app->get('flight.base_url') . 'categories');
            return;
        }

        // Récupération des types de besoins
        $stmt = $db->prepare('SELECT id, nom FROM bngrc_type_besoin ORDER BY nom ASC');
        $stmt->execute();
        $types = $stmt->fetchAll(\PDO::FETCH_ASSOC);

        $this->renderPage('categoriebesoin/edit', [
            'categorie' => $categorie,
            'types' => $types
        ]);
    }

    /**
     * Met à jour la catégorie
     */
    public function update($id)
    {
        $db = $this->app->db();

        $model = new CategorieBesoinModel($db);
        $model->setId($id);
        $model->setNom($_POST['nom'] ?? '');
        $model->setPu($_POST['pu'] ?? 0);
        $model->setIdTypeBesoin($_POST['id_type_besoin'] ?? null);

        try {
            $model->update();
            $this->app->redirect($this->app->get('flight.base_url') . 'categories?success=updated');
        } catch (\Exception $e) {
            $this->app->redirect($this->app->get('flight.base_url') . 'categories/' . $id . '/edit?error=db');
        }
    }

    /**
     * Supprime une catégorie
     */
    public function delete($id)
    {
        $db = $this->app->db();
        $model = new CategorieBesoinModel($db);
        $model->setId($id);

        try {
            $model->delete();
            $this->app->redirect($this->app->get('flight.base_url') . 'categories?success=deleted');
        } catch (\Exception $e) {
            $this->app->redirect($this->app->get('flight.base_url') . 'categories?error=delete');
        }
    }
}