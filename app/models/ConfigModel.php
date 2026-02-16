<?php

namespace app\models;

use PDO;
use PDOException;

class ConfigModel
{
    private $id;
    private $key;
    private $value;
    private $description;
    private $created_at;
    private $updated_at;

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

    public function getKey()
    {
        return $this->key;
    }

    public function setKey($key)
    {
        $this->key = $key;
    }

    public function getValue()
    {
        return $this->value;
    }

    public function setValue($value)
    {
        $this->value = $value;
    }

    public function getDescription()
    {
        return $this->description;
    }

    public function setDescription($description)
    {
        $this->description = $description;
    }

    public function getCreatedAt()
    {
        return $this->created_at;
    }

    public function setCreatedAt($created_at)
    {
        $this->created_at = $created_at;
    }

    public function getUpdatedAt()
    {
        return $this->updated_at;
    }

    public function setUpdatedAt($updated_at)
    {
        $this->updated_at = $updated_at;
    }

    // CRUD Operations

    /**
     * Sauvegarde une nouvelle configuration
     */
    public function save()
    {
        $DBH = $this->db;
        $STH = $DBH->prepare('INSERT INTO bngrc_configuration (cle, valeur, description) VALUES (?, ?, ?)');

        try {
            $STH->execute([
                $this->getKey(),
                $this->getValue(),
                $this->getDescription()
            ]);
            return $DBH->lastInsertId();
        } catch (PDOException $e) {
            throw new PDOException("Erreur lors de l'ajout de la configuration : " . $e->getMessage());
        }
    }

    /**
     * Met à jour une configuration existante
     */
    public function update()
    {
        $DBH = $this->db;
        $STH = $DBH->prepare('UPDATE bngrc_configuration SET valeur = ?, description = ? WHERE id = ?');

        try {
            $STH->execute([
                $this->getValue(),
                $this->getDescription(),
                $this->getId()
            ]);
            return true;
        } catch (PDOException $e) {
            throw new PDOException("Erreur lors de la mise à jour de la configuration : " . $e->getMessage());
        }
    }

    /**
     * Supprime une configuration
     */
    public function delete()
    {
        $DBH = $this->db;
        $STH = $DBH->prepare('DELETE FROM bngrc_configuration WHERE id = ?');

        try {
            $STH->execute([$this->getId()]);
            return true;
        } catch (PDOException $e) {
            throw new PDOException("Erreur lors de la suppression de la configuration : " . $e->getMessage());
        }
    }

    /**
     * Récupère toutes les configurations
     */
    public function getAll()
    {
        $DBH = $this->db;
        $STH = $DBH->query('SELECT * FROM bngrc_configuration ORDER BY cle ASC');

        try {
            return $STH->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            throw new PDOException("Erreur lors de la récupération des configurations : " . $e->getMessage());
        }
    }

    /**
     * Récupère une configuration par ID
     */
    public function getById($id)
    {
        $DBH = $this->db;
        $STH = $DBH->prepare('SELECT * FROM bngrc_configuration WHERE id = ?');

        try {
            $STH->execute([$id]);
            $result = $STH->fetch(PDO::FETCH_ASSOC);
            if ($result) {
                $this->hydrateFromArray($result);
            }
            return $result;
        } catch (PDOException $e) {
            throw new PDOException("Erreur lors de la récupération de la configuration : " . $e->getMessage());
        }
    }

    /**
     * Récupère une configuration par sa clé
     */
    public function getByKey($key)
    {
        $DBH = $this->db;
        $STH = $DBH->prepare('SELECT * FROM bngrc_configuration WHERE cle = ?');

        try {
            $STH->execute([$key]);
            $result = $STH->fetch(PDO::FETCH_ASSOC);
            if ($result) {
                $this->hydrateFromArray($result);
                return $result['valeur'];
            }
            return null;
        } catch (PDOException $e) {
            throw new PDOException("Erreur lors de la récupération de la configuration : " . $e->getMessage());
        }
    }

    /**
     * Récupère la valeur d'une configuration par sa clé
     */
    public static function get($db, $key, $default = null)
    {
        try {
            $STH = $db->prepare('SELECT valeur FROM bngrc_configuration WHERE cle = ?');
            $STH->execute([$key]);
            $result = $STH->fetch(PDO::FETCH_ASSOC);
            return $result ? $result['valeur'] : $default;
        } catch (PDOException $e) {
            return $default;
        }
    }

    /**
     * Hydrolyse l'objet à partir d'un tableau associatif
     */
    private function hydrateFromArray($data)
    {
        if (isset($data['id'])) {
            $this->setId($data['id']);
        }
        if (isset($data['key'])) {
            $this->setKey($data['key']);
        }
        if (isset($data['cle'])) {
            $this->setKey($data['cle']);
        }
        if (isset($data['value'])) {
            $this->setValue($data['value']);
        }
        if (isset($data['valeur'])) {
            $this->setValue($data['valeur']);
        }
        if (isset($data['description'])) {
            $this->setDescription($data['description']);
        }
        if (isset($data['created_at'])) {
            $this->setCreatedAt($data['created_at']);
        }
        if (isset($data['updated_at'])) {
            $this->setUpdatedAt($data['updated_at']);
        }
    }
}
