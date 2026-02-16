-- =========================
-- DROP DES TABLES BNGRC
-- =========================

USE BNGRC;

-- Désactiver les contraintes FK
SET FOREIGN_KEY_CHECKS = 0;

DROP TABLE IF EXISTS bngrc_attribution;
DROP TABLE IF EXISTS bngrc_don;
DROP TABLE IF EXISTS bngrc_besoin;
DROP TABLE IF EXISTS bngrc_categorie_besoin;
DROP TABLE IF EXISTS bngrc_type_besoin;
DROP TABLE IF EXISTS bngrc_ville;
DROP TABLE IF EXISTS bngrc_region;

-- Réactiver les contraintes FK
SET FOREIGN_KEY_CHECKS = 1;
