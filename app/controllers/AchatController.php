<?php

namespace app\controllers;

use app\models\AchatModel;
use app\models\AttributionModel;
use app\models\BesoinModel;
use app\models\ConfigModel;
use app\models\VilleModel;
use Flight;

class AchatController
{
    private $db;

    public function __construct()
    {
        $this->db = Flight::db();
    }

    /**
     * Liste tous les achats (filtrable par ville)
     */
    public function index()
    {
        $achatModel = new AchatModel($this->db);
        $villeModel = new VilleModel($this->db);
        
        $id_ville = Flight::request()->query->id_ville ?? null;
        
        $achats = $achatModel->getAll($id_ville);
        $villes = $villeModel->getAll();
        
        Flight::render('achats/index', [
            'achats' => $achats,
            'villes' => $villes,
            'id_ville_selected' => $id_ville
        ]);
    }

    /**
     * Affiche les besoins achetables (page pour faire les achats)
     */
    public function listBesoinsAchetables()
    {
        $achatModel = new AchatModel($this->db);
        $villeModel = new VilleModel($this->db);
        $configModel = new ConfigModel($this->db);
        
        $id_ville = Flight::request()->query->id_ville ?? null;
        
        // Récupère les besoins non couverts
        $besoins = $achatModel->getBesoinsAchetables($id_ville);
        
        // Récupère les dons en argent disponibles
        $donsArgent = $achatModel->getMontantArgentDisponible();
        
        // Calcule le montant total disponible
        $montantTotalDisponible = array_sum(array_column($donsArgent, 'montant_disponible'));
        
        // Récupère le pourcentage de frais configuré
        $frais = $configModel->getByKey('frais_achat_pourcentage') ?? 10;
        
        $villes = $villeModel->getAll();
        
        Flight::render('achats/besoins-achetables', [
            'besoins' => $besoins,
            'donsArgent' => $donsArgent,
            'montantTotalDisponible' => $montantTotalDisponible,
            'frais' => $frais,
            'villes' => $villes,
            'id_ville_selected' => $id_ville
        ]);
    }

    /**
     * Traite l'achat d'un besoin avec les dons en argent
     */
    public function acheter()
    {
        $id_besoin = Flight::request()->data->id_besoin;
        $quantite = Flight::request()->data->quantite;
        
        if (!$id_besoin || !$quantite || $quantite <= 0) {
            Flight::json([
                'success' => false,
                'message' => 'Données invalides'
            ], 400);
            return;
        }

        $achatModel = new AchatModel($this->db);
        $besoinModel = new BesoinModel($this->db);
        $attributionModel = new AttributionModel($this->db);
        $configModel = new ConfigModel($this->db);

        try {
            // Récupère les informations du besoin
            $besoin = $besoinModel->getById($id_besoin);
            
            if (!$besoin) {
                Flight::json([
                    'success' => false,
                    'message' => 'Besoin introuvable'
                ], 404);
                return;
            }

            // Vérifie que c'est bien un besoin en Nature ou Matériaux
            if (!in_array($besoin['type_besoin'], ['Nature', 'Matériaux'])) {
                Flight::json([
                    'success' => false,
                    'message' => 'On ne peut acheter que des besoins en Nature ou Matériaux'
                ], 400);
                return;
            }

            // Vérifie qu'il n'y a pas de dons disponibles pour cette catégorie
            if ($achatModel->hasDonsDisponibles($besoin['id_categorie_besoin'])) {
                Flight::json([
                    'success' => false,
                    'message' => 'Il existe encore des dons disponibles pour cette catégorie. Veuillez d\'abord utiliser les dons directs avant d\'acheter.'
                ], 400);
                return;
            }

            // Calcule la quantité restante à couvrir
            // Quantité totale - quantité déjà attribuée - quantité déjà achetée
            $quantiteTotale = $besoin['quantite'];
            $quantiteAttribuee = $attributionModel->getQuantiteTotaleAttribuee($id_besoin);
            $quantiteAchetee = $achatModel->getQuantiteTotaleAchetee($id_besoin);
            $quantiteRestante = $quantiteTotale - $quantiteAttribuee - $quantiteAchetee;
            
            if ($quantite > $quantiteRestante) {
                Flight::json([
                    'success' => false,
                    'message' => "Quantité demandée ($quantite) supérieure à la quantité restante ($quantiteRestante)"
                ], 400);
                return;
            }

            // Récupère le pourcentage de frais
            $fraisPourcentage = $configModel->getByKey('frais_achat_pourcentage') ?? 10;
            
            // Calcule le montant unitaire et le montant total avec frais
            $pu = $besoin['pu_categorie'];
            $montantSansFrais = $pu * $quantite;
            $montantFrais = $montantSansFrais * ($fraisPourcentage / 100);
            $montantTotal = $montantSansFrais + $montantFrais;

            // Récupère les dons en argent disponibles (FIFO)
            $donsArgent = $achatModel->getMontantArgentDisponible();
            
            if (empty($donsArgent)) {
                Flight::json([
                    'success' => false,
                    'message' => 'Aucun don en argent disponible'
                ], 400);
                return;
            }

            // Vérifie qu'il y a assez d'argent
            $montantDisponibleTotal = array_sum(array_column($donsArgent, 'montant_disponible'));
            
            if ($montantTotal > $montantDisponibleTotal) {
                Flight::json([
                    'success' => false,
                    'message' => sprintf(
                        'Montant insuffisant. Nécessaire: %.2f Ar (avec %s%% de frais), Disponible: %.2f Ar',
                        $montantTotal,
                        $fraisPourcentage,
                        $montantDisponibleTotal
                    )
                ], 400);
                return;
            }

            // Utilise le premier don disponible (FIFO)
            $donArgent = $donsArgent[0];
            
            if ($montantTotal > $donArgent['montant_disponible']) {
                Flight::json([
                    'success' => false,
                    'message' => sprintf(
                        'Le premier don en argent disponible (%.2f Ar) est insuffisant pour cet achat (%.2f Ar). Veuillez réduire la quantité ou attendre un don plus important.',
                        $donArgent['montant_disponible'],
                        $montantTotal
                    )
                ], 400);
                return;
            }

            // Enregistre l'achat
            $achat = new AchatModel($this->db);
            $achat->setIdBesoin($id_besoin);
            $achat->setIdDonArgent($donArgent['id']);
            $achat->setQuantiteAchetee($quantite);
            $achat->setMontantUnitaire($pu);
            $achat->setFraisPourcentage($fraisPourcentage);
            $achat->setMontantTotal($montantTotal);
            $achat->setDateAchat(date('Y-m-d H:i:s'));
            
            $achatId = $achat->save();

            Flight::json([
                'success' => true,
                'message' => 'Achat effectué avec succès',
                'achat_id' => $achatId,
                'details' => [
                    'quantite' => $quantite,
                    'pu' => $pu,
                    'montant_sans_frais' => $montantSansFrais,
                    'frais_pourcentage' => $fraisPourcentage,
                    'montant_frais' => $montantFrais,
                    'montant_total' => $montantTotal,
                    'don_utilise' => $donArgent['id']
                ]
            ]);

        } catch (\Exception $e) {
            Flight::json([
                'success' => false,
                'message' => 'Erreur lors de l\'achat : ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Affiche le détail d'un achat
     */
    public function show($id)
    {
        $achatModel = new AchatModel($this->db);
        $achat = $achatModel->getById($id);
        
        if (!$achat) {
            Flight::notFound();
            return;
        }
        
        Flight::render('achats/show', [
            'achat' => $achat
        ]);
    }
}
