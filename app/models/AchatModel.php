<?php

namespace app\models;

use PDO;
use PDOException;

class AchatModel
{
    private $id;
    private $id_besoin;
    private $id_don_argent;
    private $quantite_achetee;
    private $montant_unitaire;
    private $frais_pourcentage;
    private $montant_total;
    private $date_achat;
    private $created_at;

    private $db;

    // Constructeur
    public function __construct($db)
    {
        $this->db = $db;
    }

    // Getters et Setters
    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function getIdBesoin()
    {
        return $this->id_besoin;
    }

    public function setIdBesoin($id_besoin)
    {
        $this->id_besoin = $id_besoin;
    }

    public function getIdDonArgent()
    {
        return $this->id_don_argent;
    }

    public function setIdDonArgent($id_don_argent)
    {
        $this->id_don_argent = $id_don_argent;
    }

    public function getQuantiteAchetee()
    {
        return $this->quantite_achetee;
    }

    public function setQuantiteAchetee($quantite_achetee)
    {
        $this->quantite_achetee = $quantite_achetee;
    }

    public function getMontantUnitaire()
    {
        return $this->montant_unitaire;
    }

    public function setMontantUnitaire($montant_unitaire)
    {
        $this->montant_unitaire = $montant_unitaire;
    }

    public function getFraisPourcentage()
    {
        return $this->frais_pourcentage;
    }

    public function setFraisPourcentage($frais_pourcentage)
    {
        $this->frais_pourcentage = $frais_pourcentage;
    }

    public function getMontantTotal()
    {
        return $this->montant_total;
    }

    public function setMontantTotal($montant_total)
    {
        $this->montant_total = $montant_total;
    }

    public function getDateAchat()
    {
        return $this->date_achat;
    }

    public function setDateAchat($date_achat)
    {
        $this->date_achat = $date_achat;
    }

    public function getCreatedAt()
    {
        return $this->created_at;
    }

    public function setCreatedAt($created_at)
    {
        $this->created_at = $created_at;
    }

    // CRUD Operations

    /**
     * Sauvegarde un nouvel achat
     */
    public function save()
    {
        $DBH = $this->db;
        $STH = $DBH->prepare('INSERT INTO bngrc_achat (id_besoin, id_don_argent, quantite_achetee, montant_unitaire, frais_pourcentage, montant_total, date_achat) VALUES (?, ?, ?, ?, ?, ?, ?)');

        try {
            $STH->execute([
                $this->getIdBesoin(),
                $this->getIdDonArgent(),
                $this->getQuantiteAchetee(),
                $this->getMontantUnitaire(),
                $this->getFraisPourcentage(),
                $this->getMontantTotal(),
                $this->getDateAchat()
            ]);
            return $DBH->lastInsertId();
        } catch (PDOException $e) {
            throw new PDOException("Erreur lors de l'enregistrement de l'achat : " . $e->getMessage());
        }
    }

    /**
     * Récupère tous les achats avec leurs détails
     */
    public function getAll($id_ville = null)
    {
        $DBH = $this->db;
        
        $sql = 'SELECT 
                    a.*,
                    b.quantite as quantite_besoin,
                    b.date_besoin,
                    cb.nom as nom_categorie,
                    cb.pu as pu_categorie,
                    tb.nom as type_besoin,
                    v.nom as nom_ville,
                    v.id as id_ville,
                    d.quantite as quantite_don_argent
                FROM bngrc_achat a
                INNER JOIN bngrc_besoin b ON a.id_besoin = b.id
                INNER JOIN bngrc_categorie_besoin cb ON b.id_categorie_besoin = cb.id
                INNER JOIN bngrc_type_besoin tb ON cb.id_type_besoin = tb.id
                INNER JOIN bngrc_ville v ON b.id_ville = v.id
                INNER JOIN bngrc_don d ON a.id_don_argent = d.id';

        if ($id_ville) {
            $sql .= ' WHERE v.id = ?';
        }

        $sql .= ' ORDER BY a.date_achat DESC';

        try {
            if ($id_ville) {
                $STH = $DBH->prepare($sql);
                $STH->execute([$id_ville]);
            } else {
                $STH = $DBH->query($sql);
            }
            return $STH->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            throw new PDOException("Erreur lors de la récupération des achats : " . $e->getMessage());
        }
    }

    /**
     * Récupère un achat par ID
     */
    public function getById($id)
    {
        $DBH = $this->db;
        $STH = $DBH->prepare('SELECT 
                                a.*,
                                b.quantite as quantite_besoin,
                                b.date_besoin,
                                cb.nom as nom_categorie,
                                cb.pu as pu_categorie,
                                tb.nom as type_besoin,
                                v.nom as nom_ville,
                                d.quantite as quantite_don_argent
                            FROM bngrc_achat a
                            INNER JOIN bngrc_besoin b ON a.id_besoin = b.id
                            INNER JOIN bngrc_categorie_besoin cb ON b.id_categorie_besoin = cb.id
                            INNER JOIN bngrc_type_besoin tb ON cb.id_type_besoin = tb.id
                            INNER JOIN bngrc_ville v ON b.id_ville = v.id
                            INNER JOIN bngrc_don d ON a.id_don_argent = d.id
                            WHERE a.id = ?');

        try {
            $STH->execute([$id]);
            return $STH->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            throw new PDOException("Erreur lors de la récupération de l'achat : " . $e->getMessage());
        }
    }

    /**
     * Récupère les achats pour un besoin spécifique
     */
    public function getByBesoin($id_besoin)
    {
        $DBH = $this->db;
        $STH = $DBH->prepare('SELECT * FROM bngrc_achat WHERE id_besoin = ?');

        try {
            $STH->execute([$id_besoin]);
            return $STH->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            throw new PDOException("Erreur lors de la récupération des achats pour ce besoin : " . $e->getMessage());
        }
    }

    /**
     * Calcule la quantité totale achetée pour un besoin
     */
    public function getQuantiteTotaleAchetee($id_besoin)
    {
        $DBH = $this->db;
        $STH = $DBH->prepare('SELECT COALESCE(SUM(quantite_achetee), 0) as total FROM bngrc_achat WHERE id_besoin = ?');

        try {
            $STH->execute([$id_besoin]);
            $result = $STH->fetch(PDO::FETCH_ASSOC);
            return $result['total'] ?? 0;
        } catch (PDOException $e) {
            throw new PDOException("Erreur lors du calcul de la quantité achetée : " . $e->getMessage());
        }
    }

    /**
     * Vérifie s'il reste des dons disponibles pour une catégorie (Nature ou Matériaux)
     */
    public function hasDonsDisponibles($id_categorie_besoin)
    {
        $DBH = $this->db;
        
        // Récupère les dons disponibles (quantité restante après attributions)
        $sql = 'SELECT d.id, 
                       d.quantite - COALESCE(SUM(a.quantite_dispatch), 0) as quantite_disponible
                FROM bngrc_don d
                LEFT JOIN bngrc_attribution a ON d.id = a.id_don
                WHERE d.id_categorie_besoin = ?
                GROUP BY d.id
                HAVING quantite_disponible > 0';

        try {
            $STH = $DBH->prepare($sql);
            $STH->execute([$id_categorie_besoin]);
            $result = $STH->fetch(PDO::FETCH_ASSOC);
            return $result !== false;
        } catch (PDOException $e) {
            throw new PDOException("Erreur lors de la vérification des dons disponibles : " . $e->getMessage());
        }
    }

    /**
     * Récupère les besoins non couverts (ouverts) qui peuvent être achetés
     * Ce sont les besoins en Nature ou Matériaux qui n'ont plus de dons directs disponibles
     */
    public function getBesoinsAchetables($id_ville = null)
    {
        $DBH = $this->db;
        
        $sql = 'SELECT 
                    b.id,
                    b.quantite,
                    b.date_besoin,
                    cb.nom as nom_categorie,
                    cb.pu as pu_categorie,
                    cb.id as id_categorie_besoin,
                    tb.nom as type_besoin,
                    tb.id as id_type_besoin,
                    v.nom as nom_ville,
                    v.id as id_ville,
                    COALESCE(SUM(a.quantite_dispatch), 0) as quantite_attribuee,
                    COALESCE(SUM(ac.quantite_achetee), 0) as quantite_achetee,
                    (b.quantite - COALESCE(SUM(a.quantite_dispatch), 0) - COALESCE(SUM(ac.quantite_achetee), 0)) as quantite_restante
                FROM bngrc_besoin b
                INNER JOIN bngrc_categorie_besoin cb ON b.id_categorie_besoin = cb.id
                INNER JOIN bngrc_type_besoin tb ON cb.id_type_besoin = tb.id
                INNER JOIN bngrc_ville v ON b.id_ville = v.id
                LEFT JOIN bngrc_attribution a ON b.id = a.id_besoin
                LEFT JOIN bngrc_achat ac ON b.id = ac.id_besoin
                WHERE tb.nom IN ("Nature", "Matériaux")';
        
        if ($id_ville) {
            $sql .= ' AND v.id = ?';
        }
        
        $sql .= ' GROUP BY b.id, b.quantite, b.date_besoin, cb.nom, cb.pu, cb.id, tb.nom, tb.id, v.nom, v.id
                  HAVING quantite_restante > 0
                  ORDER BY b.date_besoin ASC';

        try {
            if ($id_ville) {
                $STH = $DBH->prepare($sql);
                $STH->execute([$id_ville]);
            } else {
                $STH = $DBH->query($sql);
            }
            return $STH->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            throw new PDOException("Erreur lors de la récupération des besoins achetables : " . $e->getMessage());
        }
    }

    /**
     * Récupère le montant total disponible dans les dons en argent
     */
    public function getMontantArgentDisponible()
    {
        $DBH = $this->db;
        
        $sql = 'SELECT 
                    d.id,
                    d.quantite as montant_don,
                    cb.pu,
                    COALESCE(SUM(a.quantite_dispatch), 0) as quantite_attribuee,
                    COALESCE(SUM(ac.montant_total), 0) as montant_achete,
                    (d.quantite - COALESCE(SUM(ac.montant_total), 0)) as montant_disponible
                FROM bngrc_don d
                INNER JOIN bngrc_categorie_besoin cb ON d.id_categorie_besoin = cb.id
                INNER JOIN bngrc_type_besoin tb ON cb.id_type_besoin = tb.id
                LEFT JOIN bngrc_attribution a ON d.id = a.id_don
                LEFT JOIN bngrc_achat ac ON d.id = ac.id_don_argent
                WHERE tb.nom = "Argent"
                GROUP BY d.id, d.quantite, cb.pu
                HAVING montant_disponible > 0
                ORDER BY d.date_saisie ASC';

        try {
            $STH = $DBH->query($sql);
            return $STH->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            throw new PDOException("Erreur lors de la récupération de l'argent disponible : " . $e->getMessage());
        }
    }
}
