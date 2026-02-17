-- =========================
-- DONNEES INITIALES POUR REINITIALISATION
-- =========================
USE BNGRC;

-- Suppression des données existantes (cascade)
DELETE FROM bngrc_attribution;
DELETE FROM bngrc_besoin;
DELETE FROM bngrc_don;

-- Insertion des besoins initiaux
INSERT INTO bngrc_besoin (quantite, id_categorie_besoin, id_ville, date_besoin) VALUES 
-- Antananarivo - après cyclone
(500, 1, 1, '2026-01-15 10:00:00'),  -- Riz
(200, 2, 1, '2026-01-15 10:30:00'),  -- Huile
(300, 6, 1, '2026-01-15 11:00:00'), -- Tôle
(100, 10, 1, '2026-01-15 11:30:00'), -- Bâche

-- Antsirabe - inondation
(800, 1, 4, '2026-01-20 09:00:00'),  -- Riz
(300, 2, 4, '2026-01-20 09:30:00'),  -- Huile
(500, 4, 4, '2026-01-20 10:00:00'),  -- Eau potable
(50, 11, 4, '2026-01-20 10:30:00'), -- Aide financière

-- Mahajanga - cyclone
(1000, 1, 9, '2026-02-01 08:00:00'), -- Riz
(500, 6, 9, '2026-02-01 08:30:00'), -- Tôle
(1000, 7, 9, '2026-02-01 09:00:00'), -- Clou
(200, 9, 9, '2026-02-01 09:30:00'), -- Ciment

-- Toliara - sécheresse
(1200, 1, 13, '2026-02-05 07:00:00'), -- Riz
(2000, 4, 13, '2026-02-05 07:30:00'), -- Eau potable
(600, 5, 13, '2026-02-05 08:00:00'),  -- Conserves
(80, 11, 13, '2026-02-05 08:30:00'), -- Aide financière

-- Antsohihy - cyclone
(600, 1, 11, '2026-02-10 10:00:00'), -- Riz
(250, 2, 11, '2026-02-10 10:30:00'), -- Huile
(400, 6, 11, '2026-02-10 11:00:00'), -- Tôle
(150, 8, 11, '2026-02-10 11:30:00'), -- Bois

-- Miarinarivo - inondation
(400, 1, 7, '2026-02-12 09:00:00'),  -- Riz
(800, 4, 7, '2026-02-12 09:30:00'),  -- Eau potable
(80, 10, 7, '2026-02-12 10:00:00'), -- Bâche

-- Ambatolampy - glissement de terrain
(300, 1, 6, '2026-02-14 08:00:00'),  -- Riz
(200, 6, 6, '2026-02-14 08:30:00'), -- Tôle
(100, 9, 6, '2026-02-14 09:00:00'), -- Ciment
(60, 11, 6, '2026-02-14 09:30:00'); -- Aide financière

-- Insertion des dons initiaux
INSERT INTO bngrc_don (quantite, id_categorie_besoin, date_saisie) VALUES 
-- Dons du 18 janvier
(1500, 1, '2026-01-18 10:00:00'), -- Riz
(1000, 4, '2026-01-18 10:30:00'), -- Eau potable
(150, 10, '2026-01-18 11:00:00'), -- Bâche

-- Dons du 25 janvier
(2000, 1, '2026-01-25 09:00:00'), -- Riz
(500, 2, '2026-01-25 09:30:00'),  -- Huile
(800, 7, '2026-01-25 10:00:00'),  -- Clou

-- Dons du 3 février
(600, 6, '2026-02-03 11:00:00'), -- Tôle
(300, 9, '2026-02-03 11:30:00'), -- Ciment
(200, 8, '2026-02-03 12:00:00'), -- Bois

-- Dons du 8 février
(3000, 1, '2026-02-08 08:00:00'),  -- Riz
(2500, 4, '2026-02-08 08:30:00'),  -- Eau potable
(1000, 5, '2026-02-08 09:00:00'),  -- Conserves
(200, 11, '2026-02-08 09:30:00'), -- Aide financière

-- Dons du 13 février
(400, 2, '2026-02-13 10:00:00'),  -- Huile
(500, 6, '2026-02-13 10:30:00'), -- Tôle
(200, 10, '2026-02-13 11:00:00'), -- Bâche

-- Dons du 15 février (récents)
(1000, 1, '2026-02-15 14:00:00'), -- Riz
(500, 7, '2026-02-15 14:30:00'),  -- Clou
(150, 9, '2026-02-15 15:00:00'); -- Ciment
