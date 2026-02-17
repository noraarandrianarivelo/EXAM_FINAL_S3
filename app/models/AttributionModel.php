<?php

namespace app\models;

use PDO;
use PDOException;

class AttributionModel
{
    private $id;
    private $id_besoin;
    private $id_don;
    private $quantite_dispatch;
    private $date_dispatch;
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

    public function getIdDon()
    {
        return $this->id_don;
    }

    public function setIdDon($id_don)
    {
        $this->id_don = $id_don;
    }

    public function getQuantiteDispatch()
    {
        return $this->quantite_dispatch;
    }

    public function setQuantiteDispatch($quantite_dispatch)
    {
        $this->quantite_dispatch = $quantite_dispatch;
    }

    public function getDateDispatch()
    {
        return $this->date_dispatch;
    }

    public function setDateDispatch($date_dispatch)
    {
        $this->date_dispatch = $date_dispatch;
    }

    public function getCreatedAt()
    {
        return $this->created_at;
    }

    public function setCreatedAt($created_at)
    {
        $this->created_at = $created_at;
    }

    // CRUD
    public function save()
    {
        $DBH = $this->db;
        $STH = $DBH->prepare('INSERT INTO bngrc_attribution (id_besoin, id_don, quantite_dispatch, date_dispatch) VALUES (?, ?, ?, ?)');

        try {
            $STH->execute([
                $this->getIdBesoin(),
                $this->getIdDon(),
                $this->getQuantiteDispatch(),
                $this->getDateDispatch()
            ]);
            return $DBH->lastInsertId();
        } catch (PDOException $e) {
            throw new PDOException("Erreur lors de l'ajout de l'attribution : " . $e->getMessage());
        }
    }

    public function update()
    {
        $DBH = $this->db;
        $STH = $DBH->prepare('UPDATE bngrc_attribution SET id_besoin = ?, id_don = ?, quantite_dispatch = ?, date_dispatch = ? WHERE id = ?');

        try {
            $STH->execute([
                $this->getIdBesoin(),
                $this->getIdDon(),
                $this->getQuantiteDispatch(),
                $this->getDateDispatch(),
                $this->getId()
            ]);
            return true;
        } catch (PDOException $e) {
            throw new PDOException("Erreur lors de la mise à jour de l'attribution : " . $e->getMessage());
        }
    }

    public function delete()
    {
        $DBH = $this->db;
        $STH = $DBH->prepare('DELETE FROM bngrc_attribution WHERE id = ?');

        try {
            $STH->execute([$this->getId()]);
            return true;
        } catch (PDOException $e) {
            throw new PDOException("Erreur lors de la suppression de l'attribution : " . $e->getMessage());
        }
    }

    public function getAll()
    {
        $DBH = $this->db;
        $STH = $DBH->query('SELECT a.*, 
                            b.quantite as quantite_besoin,
                            d.quantite as quantite_don,
                            cb.nom as nom_categorie,
                            cb.pu,
                            v.nom as nom_ville,
                            r.nom as nom_region
                            FROM bngrc_attribution a
                            INNER JOIN bngrc_besoin b ON a.id_besoin = b.id
                            INNER JOIN bngrc_don d ON a.id_don = d.id
                            INNER JOIN bngrc_categorie_besoin cb ON b.id_categorie_besoin = cb.id
                            INNER JOIN bngrc_ville v ON b.id_ville = v.id
                            INNER JOIN bngrc_region r ON v.id_region = r.id
                            ORDER BY a.date_dispatch DESC');
        $STH->setFetchMode(PDO::FETCH_ASSOC);

        $resultats = [];
        while ($row = $STH->fetch()) {
            $resultats[] = $row;
        }

        return $resultats;
    }

    public function getById($id)
    {
        $DBH = $this->db;
        $STH = $DBH->prepare('SELECT a.*, 
                              b.quantite as quantite_besoin,
                              d.quantite as quantite_don,
                              cb.nom as nom_categorie,
                              cb.pu,
                              v.nom as nom_ville,
                              r.nom as nom_region
                              FROM bngrc_attribution a
                              INNER JOIN bngrc_besoin b ON a.id_besoin = b.id
                              INNER JOIN bngrc_don d ON a.id_don = d.id
                              INNER JOIN bngrc_categorie_besoin cb ON b.id_categorie_besoin = cb.id
                              INNER JOIN bngrc_ville v ON b.id_ville = v.id
                              INNER JOIN bngrc_region r ON v.id_region = r.id
                              WHERE a.id = ?');
        $STH->execute([$id]);
        $STH->setFetchMode(PDO::FETCH_ASSOC);

        return $STH->fetch();
    }

    public function getByBesoin($id_besoin)
    {
        $DBH = $this->db;
        $STH = $DBH->prepare('SELECT a.*, d.quantite as quantite_don, cb.pu
                              FROM bngrc_attribution a
                              INNER JOIN bngrc_don d ON a.id_don = d.id
                              INNER JOIN bngrc_besoin b ON a.id_besoin = b.id
                              INNER JOIN bngrc_categorie_besoin cb ON b.id_categorie_besoin = cb.id
                              WHERE a.id_besoin = ? 
                              ORDER BY a.date_dispatch DESC');
        $STH->execute([$id_besoin]);
        $STH->setFetchMode(PDO::FETCH_ASSOC);

        $resultats = [];
        while ($row = $STH->fetch()) {
            $resultats[] = $row;
        }

        return $resultats;
    }

    public function getByDon($id_don)
    {
        $DBH = $this->db;
        $STH = $DBH->prepare('SELECT a.*, b.quantite as quantite_besoin, v.nom as nom_ville
                              FROM bngrc_attribution a
                              INNER JOIN bngrc_besoin b ON a.id_besoin = b.id
                              INNER JOIN bngrc_ville v ON b.id_ville = v.id
                              WHERE a.id_don = ? 
                              ORDER BY a.date_dispatch DESC');
        $STH->execute([$id_don]);
        $STH->setFetchMode(PDO::FETCH_ASSOC);

        $resultats = [];
        while ($row = $STH->fetch()) {
            $resultats[] = $row;
        }

        return $resultats;
    }

    /**
     * Calcule la quantité totale attribuée pour un besoin
     */
    public function getQuantiteTotaleAttribuee($id_besoin)
    {
        $DBH = $this->db;
        $STH = $DBH->prepare('SELECT COALESCE(SUM(quantite_dispatch), 0) as total FROM bngrc_attribution WHERE id_besoin = ?');

        try {
            $STH->execute([$id_besoin]);
            $result = $STH->fetch(PDO::FETCH_ASSOC);
            return $result['total'] ?? 0;
        } catch (PDOException $e) {
            throw new PDOException("Erreur lors du calcul de la quantité attribuée : " . $e->getMessage());
        }
    }
}
