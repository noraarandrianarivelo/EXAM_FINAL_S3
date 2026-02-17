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
            // Dons du 18 janvier
            [1500, 1, '2026-01-18 10:00:00'],
            [1000, 4, '2026-01-18 10:30:00'],
            [150, 10, '2026-01-18 11:00:00'],
            // Dons du 25 janvier
            [2000, 1, '2026-01-25 09:00:00'],
            [500, 2, '2026-01-25 09:30:00'],
            [800, 7, '2026-01-25 10:00:00'],
            // Dons du 3 février
            [600, 6, '2026-02-03 11:00:00'],
            [300, 9, '2026-02-03 11:30:00'],
            [200, 8, '2026-02-03 12:00:00'],
            // Dons du 8 février
            [3000, 1, '2026-02-08 08:00:00'],
            [2500, 4, '2026-02-08 08:30:00'],
            [1000, 5, '2026-02-08 09:00:00'],
            [200, 11, '2026-02-08 09:30:00'],
            // Dons du 13 février
            [400, 2, '2026-02-13 10:00:00'],
            [500, 6, '2026-02-13 10:30:00'],
            [200, 10, '2026-02-13 11:00:00'],
            // Dons du 15 février (récents)
            [1000, 1, '2026-02-15 14:00:00'],
            [500, 7, '2026-02-15 14:30:00'],
            [150, 9, '2026-02-15 15:00:00']
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

    public function reset(){
        $this->deleteAll();
        $this->initialiserDons();
    }
}
