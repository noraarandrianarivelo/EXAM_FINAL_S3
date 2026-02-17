<?php

namespace app\models;

use PDO;
use PDOException;

class DonModel
{
    private $id;
    private $quantite;
    private $id_categorie_besoin;
    private $date_saisie;
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

    public function getDateSaisie()
    {
        return $this->date_saisie;
    }

    public function setDateSaisie($date_saisie)
    {
        $this->date_saisie = $date_saisie;
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
        $STH = $DBH->prepare('INSERT INTO bngrc_don (quantite, id_categorie_besoin, date_saisie) VALUES (?, ?, ?)');

        try {
            $STH->execute([
                $this->getQuantite(),
                $this->getIdCategorieBesoin(),
                $this->getDateSaisie()
            ]);
            return $DBH->lastInsertId();
        } catch (PDOException $e) {
            throw new PDOException("Erreur lors de l'ajout du don : " . $e->getMessage());
        }
    }

    public function update()
    {
        $DBH = $this->db;
        $STH = $DBH->prepare('UPDATE bngrc_don SET quantite = ?, id_categorie_besoin = ?, date_saisie = ? WHERE id = ?');

        try {
            $STH->execute([
                $this->getQuantite(),
                $this->getIdCategorieBesoin(),
                $this->getDateSaisie(),
                $this->getId()
            ]);
            return true;
        } catch (PDOException $e) {
            throw new PDOException("Erreur lors de la mise à jour du don : " . $e->getMessage());
        }
    }

    public function delete()
    {
        $DBH = $this->db;
        $STH = $DBH->prepare('DELETE FROM bngrc_don WHERE id = ?');

        try {
            $STH->execute([$this->getId()]);
            return true;
        } catch (PDOException $e) {
            throw new PDOException("Erreur lors de la suppression du don : " . $e->getMessage());
        }
    }

    public function getAll()
    {
        $DBH = $this->db;
        $STH = $DBH->query('SELECT d.*, 
                            cb.nom as nom_categorie,
                            cb.pu as pu,
                            tb.nom as nom_type_besoin
                            FROM bngrc_don d
                            INNER JOIN bngrc_categorie_besoin cb ON d.id_categorie_besoin = cb.id
                            INNER JOIN bngrc_type_besoin tb ON cb.id_type_besoin = tb.id
                            ORDER BY d.date_saisie DESC');
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
        $STH = $DBH->prepare('SELECT d.*, 
                              cb.nom as nom_categorie,
                              cb.pu as pu,
                              tb.nom as nom_type_besoin
                              FROM bngrc_don d
                              INNER JOIN bngrc_categorie_besoin cb ON d.id_categorie_besoin = cb.id
                              INNER JOIN bngrc_type_besoin tb ON cb.id_type_besoin = tb.id
                              WHERE d.id = ?');
        $STH->execute([$id]);
        $STH->setFetchMode(PDO::FETCH_ASSOC);

        return $STH->fetch();
    }

    public function getByCategorie($id_categorie_besoin)
    {
        $DBH = $this->db;
        $STH = $DBH->prepare('SELECT * FROM bngrc_don 
                              WHERE id_categorie_besoin = ? 
                              ORDER BY date_saisie DESC');
        $STH->execute([$id_categorie_besoin]);
        $STH->setFetchMode(PDO::FETCH_ASSOC);

        $resultats = [];
        while ($row = $STH->fetch()) {
            $resultats[] = $row;
        }

        return $resultats;
    }

    public function getDonsDisponibles($id_categorie_besoin = null)
    {
        $DBH = $this->db;

        $sql = 'SELECT d.*, 
                cb.nom as nom_categorie,
                (d.quantite - COALESCE(SUM(a.quantite_dispatch), 0)) as quantite_disponible
                FROM bngrc_don d
                INNER JOIN bngrc_categorie_besoin cb ON d.id_categorie_besoin = cb.id
                LEFT JOIN bngrc_attribution a ON d.id = a.id_don
                WHERE 1=1';

        if ($id_categorie_besoin !== null) {
            $sql .= ' AND d.id_categorie_besoin = ?';
        }

        $sql .= ' GROUP BY d.id, d.quantite, d.id_categorie_besoin, d.date_saisie, d.created_at, cb.nom
                  HAVING quantite_disponible > 0
                  ORDER BY d.date_saisie';

        if ($id_categorie_besoin !== null) {
            $STH = $DBH->prepare($sql);
            $STH->execute([$id_categorie_besoin]);
        } else {
            $STH = $DBH->query($sql);
        }

        $STH->setFetchMode(PDO::FETCH_ASSOC);

        $resultats = [];
        while ($row = $STH->fetch()) {
            $resultats[] = $row;
        }

        return $resultats;
    }

    public function deleteAll()
    {
        $DBH = $this->db;
        $STH = $DBH->prepare('DELETE FROM bngrc_don');

        try {
            $STH->execute();
            return true;
        } catch (PDOException $e) {
            throw new PDOException("Erreur lors de la réinitialisation des dons : " . $e->getMessage());
        }
    }

    public function initialiserDons()
    {
        $DBH = $this->db;
        $STH = $DBH->prepare('INSERT INTO bngrc_don (quantite, id_categorie_besoin, date_saisie) VALUES (?, ?, ?)');

        $dons_initiaux = [
            // Dons du 16 février
            [5000000, 5, '2026-02-16 12:53:00'],
            [3000000, 5, '2026-02-16 12:53:00'],
            [400, 1, '2026-02-16 12:54:00'],
            [600, 2, '2026-02-16 12:54:00'],

            // Dons du 17 février
            [100, 7, '2026-02-17 12:47:00'],
            [4000000, 5, '2026-02-17 12:53:00'],
            [1500000, 5, '2026-02-17 12:53:00'],
            [6000000, 5, '2026-02-17 12:53:00'],
            [50, 3, '2026-02-17 12:54:00'],
            [70, 4, '2026-02-17 12:54:00'],
            [100, 9, '2026-02-17 12:54:00'],
            [88, 9, '2026-02-17 12:55:00'],

            // Dons du 18 février
            [2000, 1, '2026-02-18 12:54:00'],
            [300, 3, '2026-02-18 12:55:00'],
            [5000, 2, '2026-02-18 12:55:00'],

            // Dons du 19 février
            [20000000, 5, '2026-02-19 12:55:00'],
            [500, 4, '2026-02-19 12:55:00']
        ];

        try {
            foreach ($dons_initiaux as $don) {
                $STH->execute($don);
            }
            return true;
        } catch (PDOException $e) {
            throw new PDOException("Erreur lors de l'initialisation des dons : " . $e->getMessage());
        }
    }

    public function reset()
    {
        $this->deleteAll();
        $this->initialiserDons();
    }
}
