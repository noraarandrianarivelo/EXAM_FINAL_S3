<?php

namespace app\models;

use Flight;
use PDO;
use PDOException;

class ImageModel
{
    private $id;
    private $path;
    private $description;

    private $db;

    // Constructeur
    public function __construct($db)
    {
        $this->db = $db;
    }

    // Getter et setter
    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function getPath()
    {
        return $this->path;
    }

    public function setPath($path)
    {
        $this->path = $path;
    }

    public function getDescription()
    {
        return $this->description;
    }

    public function setDescription($description)
    {
        $this->description = $description;
    }

    // CRUD
    public function save()
    {
        $DBH = $this->db;

        $STH = $DBH->prepare('INSERT INTO image (path, description) VALUES (?, ?)');

        try {
            $STH->execute([$this->getPath(), $this->getDescription()]);
            return true;
        } catch (PDOException $e) {
            throw new PDOException("Erreur lors de l'ajout de l'image : " . $e->getMessage());
        }
    }

    public function delete($id) {
        
    }

    public function update($id) {}

    public function getImages()
    {
        $DBH = $this->db;

        $STH = $DBH->query('SELECT * FROM public.image');
        $STH->setFetchMode(PDO::FETCH_ASSOC);

        $resultats = [];
        while ($row = $STH->fetch()) {
            $resultats[] = $row;
        }

        return $resultats;
    }

    public function getImage($id)
    {
        $DBH = $this->db;

        $data = array($id);

        $STH = $DBH->prepare('SELECT * FROM public.image where id = ?');
        $STH->execute($data);

        $STH->setFetchMode(PDO::FETCH_ASSOC);

        $resultat = $STH->fetch();


        return $resultat;
    }
}
