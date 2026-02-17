<?php

namespace app\controllers;

use flight\Engine;
use app\models\VilleModel;
use app\utils\FunctionUtils; // CORRECTION : Importer la bonne classe

class VilleController
{
    protected Engine $app;
    protected FunctionUtils $utils; // CORRECTION : Typer correctement la propriété

    public function __construct(Engine $app)
    {
        $this->app = $app;
        // CORRECTION : Instancier FunctionUtils
        $this->utils = new FunctionUtils($app);
    }

    /**
     * Affiche la liste des villes
     */
    public function index()
    {
        $db = $this->app->db();
        $villeModel = new VilleModel($db);
        
        // Récupère toutes les villes avec le nom de la région
        $villes = $villeModel->getAll();

        // Maintenant, cette ligne fonctionnera correctement
        $this->app->render('villes/index', ['villes' => $villes]);
    }

    /**
     * Affiche le formulaire d'ajout
     */
    public function create()
    {
        $db = $this->app->db();

        // Récupération des régions pour le select
        $stmt = $db->prepare('SELECT id, nom FROM bngrc_region ORDER BY nom ASC');
        $stmt->execute();
        $regions = $stmt->fetchAll(\PDO::FETCH_ASSOC);

        $this->app->render('villes/create', ['regions' => $regions]);
    }

    /**
     * Enregistre une nouvelle ville
     */
    public function store()
    {
        $db = $this->app->db();

        $nom = $_POST['nom'] ?? null;
        $id_region = $_POST['id_region'] ?? null;

        if (!$nom || !$id_region) {
            $this->app->redirect($this->app->get('flight.base_url') . 'villes/create?error=missing');
            return;
        }

        $villeModel = new VilleModel($db);
        $villeModel->setNom($nom);
        $villeModel->setIdRegion($id_region);

        try {
            $villeModel->save();
            $this->app->redirect($this->app->get('flight.base_url') . 'villes?success=created');
        } catch (\Exception $e) {
            $this->app->redirect($this->app->get('flight.base_url') . 'villes/create?error=db');
        }
    }

    /**
     * Affiche le formulaire d'édition
     */
    public function edit($id)
    {
        $db = $this->app->db();
        $villeModel = new VilleModel($db);

        $ville = $villeModel->getById($id);

        if (!$ville) {
            $this->app->redirect($this->app->get('flight.base_url') . 'villes');
            return;
        }

        // Récupération des régions
        $stmt = $db->prepare('SELECT id, nom FROM bngrc_region ORDER BY nom ASC');
        $stmt->execute();
        $regions = $stmt->fetchAll(\PDO::FETCH_ASSOC);

        $this->app->render('villes/edit', [
            'ville' => $ville,
            'regions' => $regions
        ]);
    }

    /**
     * Met à jour la ville
     */
    public function update($id)
    {
        $db = $this->app->db();

        $villeModel = new VilleModel($db);
        $villeModel->setId($id);
        $villeModel->setNom($_POST['nom'] ?? '');
        $villeModel->setIdRegion($_POST['id_region'] ?? null);

        try {
            $villeModel->update();
            $this->app->redirect($this->app->get('flight.base_url') . 'villes?success=updated');
        } catch (\Exception $e) {
            $this->app->redirect($this->app->get('flight.base_url') . 'villes/' . $id . '/edit?error=db');
        }
    }

    /**
     * Supprime une ville
     */
    public function delete($id)
    {
        $db = $this->app->db();
        $villeModel = new VilleModel($db);
        $villeModel->setId($id);

        try {
            $villeModel->delete();
            $this->app->redirect($this->app->get('flight.base_url') . 'villes?success=deleted');
        } catch (\Exception $e) {
            // Erreur probablement due à une contrainte de clé étrangère (besoins existants)
            $this->app->redirect($this->app->get('flight.base_url') . 'villes?error=delete');
        }
    }
}