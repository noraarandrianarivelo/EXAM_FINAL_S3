<?php

namespace app\models;

use PDO;
use PDOException;

class BesoinModel
{
    private $id;
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
        $STH = $DBH->prepare('INSERT INTO bngrc_besoin (quantite, id_categorie_besoin, id_ville, date_besoin) VALUES (?, ?, ?, ?)');

        try {
            $STH->execute([
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
        $STH = $DBH->prepare('UPDATE bngrc_besoin SET quantite = ?, id_categorie_besoin = ?, id_ville = ?, date_besoin = ? WHERE id = ?');

        try {
            $STH->execute([
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
        $STH = $DBH->prepare('DELETE FROM bngrc_besoin WHERE id = ?');

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
                            FROM bngrc_besoin b
                            INNER JOIN bngrc_categorie_besoin cb ON b.id_categorie_besoin = cb.id
                            INNER JOIN bngrc_ville v ON b.id_ville = v.id
                            INNER JOIN bngrc_region r ON v.id_region = r.id
                            INNER JOIN bngrc_type_besoin tb ON cb.id_type_besoin = tb.id
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
                              cb.pu as pu_categorie,
                              cb.id as id_categorie_besoin,
                              v.nom as nom_ville, 
                              r.nom as nom_region,
                              tb.nom as type_besoin,
                              tb.id as id_type_besoin
                              FROM bngrc_besoin b
                              INNER JOIN bngrc_categorie_besoin cb ON b.id_categorie_besoin = cb.id
                              INNER JOIN bngrc_ville v ON b.id_ville = v.id
                              INNER JOIN bngrc_region r ON v.id_region = r.id
                              INNER JOIN bngrc_type_besoin tb ON cb.id_type_besoin = tb.id
                              WHERE b.id = ?');
        $STH->execute([$id]);
        $STH->setFetchMode(PDO::FETCH_ASSOC);

        return $STH->fetch();
    }

    public function getByVille($id_ville)
    {
        $DBH = $this->db;
        $STH = $DBH->prepare('SELECT b.*, cb.nom as nom_categorie, tb.nom as nom_type
                              FROM bngrc_besoin b
                              INNER JOIN bngrc_categorie_besoin cb ON b.id_categorie_besoin = cb.id
                              INNER JOIN bngrc_type_besoin tb ON cb.id_type_besoin = tb.id
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
                              FROM bngrc_besoin b
                              INNER JOIN bngrc_ville v ON b.id_ville = v.id
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

    public function getBesoinsOuverts($id_categorie_besoin)
    {
        $DBH = $this->db;
        $STH = $DBH->prepare('SELECT b.*, 
                              v.nom as nom_ville,
                              r.nom as nom_region,
                              (b.quantite - COALESCE(SUM(a.quantite_dispatch), 0)) as reste
                              FROM bngrc_besoin b
                              INNER JOIN bngrc_ville v ON b.id_ville = v.id
                              INNER JOIN bngrc_region r ON v.id_region = r.id
                              LEFT JOIN bngrc_attribution a ON b.id = a.id_besoin
                              WHERE b.id_categorie_besoin = ?
                              GROUP BY b.id, b.quantite, b.id_categorie_besoin, b.id_ville, b.date_besoin, b.created_at, v.nom, r.nom
                              HAVING reste > 0
                              ORDER BY b.date_besoin ASC');
        $STH->execute([$id_categorie_besoin]);
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
        $STH = $DBH->prepare('DELETE FROM bngrc_besoin');

        try {
            $STH->execute();
            return true;
        } catch (PDOException $e) {
            throw new PDOException("Erreur lors de la réinitialisation des besoins : " . $e->getMessage());
        }
    }

    public function initialiserBesoins()
    {
        $DBH = $this->db;
        $STH = $DBH->prepare('INSERT INTO bngrc_besoin (quantite, id_categorie_besoin, id_ville, date_besoin) VALUES (?, ?, ?, ?)');

        $besoins_initiaux = [
            // Toamasina (id_region = 1)
            [200, 4, 1, '2026-02-15 08:00:00'],   // Bâche
            [1500, 2, 1, '2026-02-15 11:00:00'],  // Eau
            [500, 1, 2, '2026-02-15 15:00:00'],   // Riz (Mananjary)
            [3, 10, 1, '2026-02-15 17:00:00'],    // Groupe
            [800, 1, 1, '2026-02-16 14:00:00'],   // Riz
            [120, 3, 1, '2026-02-16 18:00:00'],   // Tôle

            // Mananjary (id_region = 2)
            [6000000, 5, 2, '2026-02-15 10:00:00'], // Argent
            [80, 3, 2, '2026-02-15 13:00:00'],      // Tôle
            [500, 1, 2, '2026-02-15 15:00:00'],     // Riz
            [60, 7, 2, '2026-02-16 16:00:00'],      // Clous
            [120, 6, 2, '2026-02-16 20:00:00'],     // Huile

            // Farafangana (id_region = 3)
            [150, 4, 3, '2026-02-16 08:00:00'],     // Bâche
            [8000000, 5, 3, '2026-02-16 09:00:00'], // Argent
            [1000, 2, 3, '2026-02-15 16:00:00'],    // Eau
            [600, 1, 3, '2026-02-16 17:00:00'],     // Riz
            [100, 8, 3, '2026-02-15 20:00:00'],     // Bois

            // Nosy Be (id_region = 4)
            [40, 3, 4, '2026-02-15 09:00:00'],      // Tôle
            [300, 1, 4, '2026-02-15 12:00:00'],     // Haricots
            [4000000, 5, 4, '2026-02-15 14:00:00'], // Argent
            [200, 9, 4, '2026-02-16 15:00:00'],     // Haricots
            [30, 7, 4, '2026-02-16 19:00:00'],      // Clous

            // Morondava (id_region = 5)
            [700, 1, 5, '2026-02-16 10:00:00'],     // Riz
            [10000000, 5, 5, '2026-02-16 12:00:00'], // Argent
            [180, 4, 5, '2026-02-16 13:00:00'],     // Bâche
            [1200, 2, 5, '2026-02-15 18:00:00'],    // Eau
            [150, 8, 5, '2026-02-15 19:00:00']      // Bois
        ];

        try {
            foreach ($besoins_initiaux as $besoin) {
                $STH->execute($besoin);
            }
            return true;
        } catch (PDOException $e) {
            throw new PDOException("Erreur lors de l'initialisation des besoins : " . $e->getMessage());
        }
    }

    public function reset()
    {
        $this->deleteAll();
        $this->initialiserBesoins();
    }
}
