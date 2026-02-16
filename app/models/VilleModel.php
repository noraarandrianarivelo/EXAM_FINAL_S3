<?php

namespace app\models;

use PDO;
use PDOException;

class VilleModel
{
    private $id;
    private $nom;
    private $id_region;
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

    public function getIdRegion()
    {
        return $this->id_region;
    }

    public function setIdRegion($id_region)
    {
        $this->id_region = $id_region;
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
        $STH = $DBH->prepare('INSERT INTO ville (nom, id_region) VALUES (?, ?)');

        try {
            $STH->execute([$this->getNom(), $this->getIdRegion()]);
            return $DBH->lastInsertId();
        } catch (PDOException $e) {
            throw new PDOException("Erreur lors de l'ajout de la ville : " . $e->getMessage());
        }
    }

    public function update()
    {
        $DBH = $this->db;
        $STH = $DBH->prepare('UPDATE ville SET nom = ?, id_region = ? WHERE id = ?');

        try {
            $STH->execute([$this->getNom(), $this->getIdRegion(), $this->getId()]);
            return true;
        } catch (PDOException $e) {
            throw new PDOException("Erreur lors de la mise à jour de la ville : " . $e->getMessage());
        }
    }

    public function delete()
    {
        $DBH = $this->db;
        $STH = $DBH->prepare('DELETE FROM ville WHERE id = ?');

        try {
            $STH->execute([$this->getId()]);
            return true;
        } catch (PDOException $e) {
            throw new PDOException("Erreur lors de la suppression de la ville : " . $e->getMessage());
        }
    }

    public function getAll()
    {
        $DBH = $this->db;
        $STH = $DBH->query('SELECT v.*, r.nom as nom_region FROM ville v 
                            INNER JOIN region r ON v.id_region = r.id 
                            ORDER BY v.nom');
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
        $STH = $DBH->prepare('SELECT v.*, r.nom as nom_region FROM ville v 
                              INNER JOIN region r ON v.id_region = r.id 
                              WHERE v.id = ?');
        $STH->execute([$id]);
        $STH->setFetchMode(PDO::FETCH_ASSOC);

        return $STH->fetch();
    }

    public function getByRegion($id_region)
    {
        $DBH = $this->db;
        $STH = $DBH->prepare('SELECT * FROM ville WHERE id_region = ? ORDER BY nom');
        $STH->execute([$id_region]);
        $STH->setFetchMode(PDO::FETCH_ASSOC);

        $resultats = [];
        while ($row = $STH->fetch()) {
            $resultats[] = $row;
        }

        return $resultats;
    }
}
