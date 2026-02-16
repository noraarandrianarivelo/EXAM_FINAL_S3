<?php

namespace app\models;

use PDO;
use PDOException;

class TypeBesoinModel
{
    private $id;
    private $nom;
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
        $STH = $DBH->prepare('INSERT INTO type_besoin (nom) VALUES (?)');

        try {
            $STH->execute([$this->getNom()]);
            return $DBH->lastInsertId();
        } catch (PDOException $e) {
            throw new PDOException("Erreur lors de l'ajout du type de besoin : " . $e->getMessage());
        }
    }

    public function update()
    {
        $DBH = $this->db;
        $STH = $DBH->prepare('UPDATE type_besoin SET nom = ? WHERE id = ?');

        try {
            $STH->execute([$this->getNom(), $this->getId()]);
            return true;
        } catch (PDOException $e) {
            throw new PDOException("Erreur lors de la mise à jour du type de besoin : " . $e->getMessage());
        }
    }

    public function delete()
    {
        $DBH = $this->db;
        $STH = $DBH->prepare('DELETE FROM type_besoin WHERE id = ?');

        try {
            $STH->execute([$this->getId()]);
            return true;
        } catch (PDOException $e) {
            throw new PDOException("Erreur lors de la suppression du type de besoin : " . $e->getMessage());
        }
    }

    public function getAll()
    {
        $DBH = $this->db;
        $STH = $DBH->query('SELECT * FROM type_besoin ORDER BY nom');
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
        $STH = $DBH->prepare('SELECT * FROM type_besoin WHERE id = ?');
        $STH->execute([$id]);
        $STH->setFetchMode(PDO::FETCH_ASSOC);

        return $STH->fetch();
    }
}
