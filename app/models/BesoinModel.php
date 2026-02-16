<?php

namespace app\models;

use PDO;
use PDOException;

class BesoinModel
{
    private $id;
    private $pu;
    private $quantite;
    private $id_categorie_besoin;
    private $id_ville;
    private $date_besoin;
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

    public function getPu()
    {
        return $this->pu;
    }

    public function setPu($pu)
    {
        $this->pu = $pu;
    }

    public function getQuantite()
    {
        return $this->quantite;
    }

    public function setQuantite($quantite)
    {
        $this->quantite = $quantite;
    }

    public function getIdCategorieBesoin()
    {
        return $this->id_categorie_besoin;
    }

    public function setIdCategorieBesoin($id_categorie_besoin)
    {
        $this->id_categorie_besoin = $id_categorie_besoin;
    }

    public function getIdVille()
    {
        return $this->id_ville;
    }

    public function setIdVille($id_ville)
    {
        $this->id_ville = $id_ville;
    }

    public function getDateBesoin()
    {
        return $this->date_besoin;
    }

    public function setDateBesoin($date_besoin)
    {
        $this->date_besoin = $date_besoin;
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
        $STH = $DBH->prepare('INSERT INTO besoin (pu, quantite, id_categorie_besoin, id_ville, date_besoin) VALUES (?, ?, ?, ?, ?)');

        try {
            $STH->execute([
                $this->getPu(),
                $this->getQuantite(),
                $this->getIdCategorieBesoin(),
                $this->getIdVille(),
                $this->getDateBesoin()
            ]);
            return $DBH->lastInsertId();
        } catch (PDOException $e) {
            throw new PDOException("Erreur lors de l'ajout du besoin : " . $e->getMessage());
        }
    }

    public function update()
    {
        $DBH = $this->db;
        $STH = $DBH->prepare('UPDATE besoin SET pu = ?, quantite = ?, id_categorie_besoin = ?, id_ville = ?, date_besoin = ? WHERE id = ?');

        try {
            $STH->execute([
                $this->getPu(),
                $this->getQuantite(),
                $this->getIdCategorieBesoin(),
                $this->getIdVille(),
                $this->getDateBesoin(),
                $this->getId()
            ]);
            return true;
        } catch (PDOException $e) {
            throw new PDOException("Erreur lors de la mise à jour du besoin : " . $e->getMessage());
        }
    }

    public function delete()
    {
        $DBH = $this->db;
        $STH = $DBH->prepare('DELETE FROM besoin WHERE id = ?');

        try {
            $STH->execute([$this->getId()]);
            return true;
        } catch (PDOException $e) {
            throw new PDOException("Erreur lors de la suppression du besoin : " . $e->getMessage());
        }
    }

    public function getAll()
    {
        $DBH = $this->db;
        $STH = $DBH->query('SELECT b.*, 
                            cb.nom as nom_categorie, 
                            v.nom as nom_ville, 
                            r.nom as nom_region,
                            tb.nom as nom_type_besoin
                            FROM besoin b
                            INNER JOIN categorie_besoin cb ON b.id_categorie_besoin = cb.id
                            INNER JOIN ville v ON b.id_ville = v.id
                            INNER JOIN region r ON v.id_region = r.id
                            INNER JOIN type_besoin tb ON cb.id_type_besoin = tb.id
                            ORDER BY b.date_besoin DESC');
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
        $STH = $DBH->prepare('SELECT b.*, 
                              cb.nom as nom_categorie, 
                              v.nom as nom_ville, 
                              r.nom as nom_region,
                              tb.nom as nom_type_besoin
                              FROM besoin b
                              INNER JOIN categorie_besoin cb ON b.id_categorie_besoin = cb.id
                              INNER JOIN ville v ON b.id_ville = v.id
                              INNER JOIN region r ON v.id_region = r.id
                              INNER JOIN type_besoin tb ON cb.id_type_besoin = tb.id
                              WHERE b.id = ?');
        $STH->execute([$id]);
        $STH->setFetchMode(PDO::FETCH_ASSOC);

        return $STH->fetch();
    }

    public function getByVille($id_ville)
    {
        $DBH = $this->db;
        $STH = $DBH->prepare('SELECT b.*, cb.nom as nom_categorie 
                              FROM besoin b
                              INNER JOIN categorie_besoin cb ON b.id_categorie_besoin = cb.id
                              WHERE b.id_ville = ? 
                              ORDER BY b.date_besoin DESC');
        $STH->execute([$id_ville]);
        $STH->setFetchMode(PDO::FETCH_ASSOC);

        $resultats = [];
        while ($row = $STH->fetch()) {
            $resultats[] = $row;
        }

        return $resultats;
    }

    public function getByCategorie($id_categorie_besoin)
    {
        $DBH = $this->db;
        $STH = $DBH->prepare('SELECT b.*, v.nom as nom_ville 
                              FROM besoin b
                              INNER JOIN ville v ON b.id_ville = v.id
                              WHERE b.id_categorie_besoin = ? 
                              ORDER BY b.date_besoin DESC');
        $STH->execute([$id_categorie_besoin]);
        $STH->setFetchMode(PDO::FETCH_ASSOC);

        $resultats = [];
        while ($row = $STH->fetch()) {
            $resultats[] = $row;
        }

        return $resultats;
    }
}
