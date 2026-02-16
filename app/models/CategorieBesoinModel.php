<?php

namespace app\models;

use PDO;
use PDOException;

class CategorieBesoinModel
{
    private $id;
    private $nom;
    private $pu;
    private $id_type_besoin;
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

    public function getNom()
    {
        return $this->nom;
    }

    public function setNom($nom)
    {
        $this->nom = $nom;
    }

    public function getPu()
    {
        return $this->pu;
    }

    public function setPu($pu)
    {
        $this->pu = $pu;
    }

    public function getIdTypeBesoin()
    {
        return $this->id_type_besoin;
    }

    public function setIdTypeBesoin($id_type_besoin)
    {
        $this->id_type_besoin = $id_type_besoin;
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
        $STH = $DBH->prepare('INSERT INTO bngrc_categorie_besoin (nom, pu, id_type_besoin) VALUES (?, ?, ?)');

        try {
            $STH->execute([$this->getNom(), $this->getPu(), $this->getIdTypeBesoin()]);
            return $DBH->lastInsertId();
        } catch (PDOException $e) {
            throw new PDOException("Erreur lors de l'ajout de la catégorie de besoin : " . $e->getMessage());
        }
    }

    public function update()
    {
        $DBH = $this->db;
        $STH = $DBH->prepare('UPDATE bngrc_categorie_besoin SET nom = ?, pu = ?, id_type_besoin = ? WHERE id = ?');

        try {
            $STH->execute([$this->getNom(), $this->getPu(), $this->getIdTypeBesoin(), $this->getId()]);
            return true;
        } catch (PDOException $e) {
            throw new PDOException("Erreur lors de la mise à jour de la catégorie de besoin : " . $e->getMessage());
        }
    }

    public function delete()
    {
        $DBH = $this->db;
        $STH = $DBH->prepare('DELETE FROM bngrc_categorie_besoin WHERE id = ?');

        try {
            $STH->execute([$this->getId()]);
            return true;
        } catch (PDOException $e) {
            throw new PDOException("Erreur lors de la suppression de la catégorie de besoin : " . $e->getMessage());
        }
    }

    public function getAll()
    {
        $DBH = $this->db;
        $STH = $DBH->query('SELECT cb.*, tb.nom as nom_type_besoin FROM bngrc_categorie_besoin cb 
                            INNER JOIN bngrc_type_besoin tb ON cb.id_type_besoin = tb.id 
                            ORDER BY cb.nom');
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
        $STH = $DBH->prepare('SELECT cb.*, tb.nom as nom_type_besoin FROM bngrc_categorie_besoin cb 
                              INNER JOIN bngrc_type_besoin tb ON cb.id_type_besoin = tb.id 
                              WHERE cb.id = ?');
        $STH->execute([$id]);
        $STH->setFetchMode(PDO::FETCH_ASSOC);

        return $STH->fetch();
    }

    public function getByTypeBesoin($id_type_besoin)
    {
        $DBH = $this->db;
        $STH = $DBH->prepare('SELECT * FROM bngrc_categorie_besoin WHERE id_type_besoin = ? ORDER BY nom');
        $STH->execute([$id_type_besoin]);
        $STH->setFetchMode(PDO::FETCH_ASSOC);

        $resultats = [];
        while ($row = $STH->fetch()) {
            $resultats[] = $row;
        }

        return $resultats;
    }
}
