
-- =========================
-- DONNEES DE TEST
-- =========================

-- Insertion des régions
INSERT INTO bngrc_region (nom) VALUES 
('Analamanga'),
('Vakinankaratra'),
('Itasy'),
('Boeny'),
('Sofia'),
('Atsimo-Andrefana');

-- Insertion des villes
INSERT INTO bngrc_ville (nom, id_region) VALUES 
-- Analamanga
('Antananarivo', 1),
('Ambohidratrimo', 1),
('Ankazobe', 1),
-- Vakinankaratra
('Antsirabe', 2),
('Betafo', 2),
('Ambatolampy', 2),
-- Itasy
('Miarinarivo', 3),
('Arivonimamo', 3),
-- Boeny
('Mahajanga', 4),
('Marovoay', 4),
-- Sofia
('Antsohihy', 5),
('Bealanana', 5),
-- Atsimo-Andrefana
('Toliara', 6),
('Morombe', 6);

-- Insertion des types de besoin
INSERT INTO bngrc_type_besoin (nom) VALUES 
('Nature'),
('Matériaux'),
('Argent');

-- Insertion des catégories de besoin
INSERT INTO bngrc_categorie_besoin (nom, id_type_besoin) VALUES 
-- Nature
('Riz', 1),
('Huile', 1),
('Sucre', 1),
('Eau potable', 1),
('Conserves', 1),
-- Matériaux
('Tôle', 2),
('Clou', 2),
('Bois', 2),
('Ciment', 2),
('Bâche', 2),
-- Argent
('Aide financière', 3);

-- Insertion des besoins
INSERT INTO bngrc_besoin (pu, quantite, id_categorie_besoin, id_ville, date_besoin) VALUES 
-- Antananarivo - après cyclone
(3000.00, 500, 1, 1, '2026-01-15 10:00:00'),  -- Riz
(8000.00, 200, 2, 1, '2026-01-15 10:30:00'),  -- Huile
(25000.00, 300, 6, 1, '2026-01-15 11:00:00'), -- Tôle
(15000.00, 100, 10, 1, '2026-01-15 11:30:00'), -- Bâche

-- Antsirabe - inondation
(3000.00, 800, 1, 4, '2026-01-20 09:00:00'),  -- Riz
(8000.00, 300, 2, 4, '2026-01-20 09:30:00'),  -- Huile
(2000.00, 500, 4, 4, '2026-01-20 10:00:00'),  -- Eau potable
(50000.00, 50, 11, 4, '2026-01-20 10:30:00'), -- Aide financière

-- Mahajanga - cyclone
(3000.00, 1000, 1, 9, '2026-02-01 08:00:00'), -- Riz
(25000.00, 500, 6, 9, '2026-02-01 08:30:00'), -- Tôle
(5000.00, 1000, 7, 9, '2026-02-01 09:00:00'), -- Clou
(40000.00, 200, 9, 9, '2026-02-01 09:30:00'), -- Ciment

-- Toliara - sécheresse
(3000.00, 1200, 1, 13, '2026-02-05 07:00:00'), -- Riz
(2000.00, 2000, 4, 13, '2026-02-05 07:30:00'), -- Eau potable
(5000.00, 600, 5, 13, '2026-02-05 08:00:00'),  -- Conserves
(50000.00, 80, 11, 13, '2026-02-05 08:30:00'), -- Aide financière

-- Antsohihy - cyclone
(3000.00, 600, 1, 11, '2026-02-10 10:00:00'), -- Riz
(8000.00, 250, 2, 11, '2026-02-10 10:30:00'), -- Huile
(25000.00, 400, 6, 11, '2026-02-10 11:00:00'), -- Tôle
(30000.00, 150, 8, 11, '2026-02-10 11:30:00'), -- Bois

-- Miarinarivo - inondation
(3000.00, 400, 1, 7, '2026-02-12 09:00:00'),  -- Riz
(2000.00, 800, 4, 7, '2026-02-12 09:30:00'),  -- Eau potable
(15000.00, 80, 10, 7, '2026-02-12 10:00:00'), -- Bâche

-- Ambatolampy - glissement de terrain
(3000.00, 300, 1, 6, '2026-02-14 08:00:00'),  -- Riz
(25000.00, 200, 6, 6, '2026-02-14 08:30:00'), -- Tôle
(40000.00, 100, 9, 6, '2026-02-14 09:00:00'), -- Ciment
(50000.00, 60, 11, 6, '2026-02-14 09:30:00'); -- Aide financière

-- Insertion des dons
INSERT INTO bngrc_don (pu, quantite, id_categorie_besoin, date_saisie) VALUES 
-- Dons du 18 janvier
(3000.00, 1500, 1, '2026-01-18 10:00:00'), -- Riz
(2000.00, 1000, 4, '2026-01-18 10:30:00'), -- Eau potable
(15000.00, 150, 10, '2026-01-18 11:00:00'), -- Bâche

-- Dons du 25 janvier
(3000.00, 2000, 1, '2026-01-25 09:00:00'), -- Riz
(8000.00, 500, 2, '2026-01-25 09:30:00'),  -- Huile
(5000.00, 800, 7, '2026-01-25 10:00:00'),  -- Clou

-- Dons du 3 février
(25000.00, 600, 6, '2026-02-03 11:00:00'), -- Tôle
(40000.00, 300, 9, '2026-02-03 11:30:00'), -- Ciment
(30000.00, 200, 8, '2026-02-03 12:00:00'), -- Bois

-- Dons du 8 février
(3000.00, 3000, 1, '2026-02-08 08:00:00'),  -- Riz
(2000.00, 2500, 4, '2026-02-08 08:30:00'),  -- Eau potable
(5000.00, 1000, 5, '2026-02-08 09:00:00'),  -- Conserves
(50000.00, 200, 11, '2026-02-08 09:30:00'), -- Aide financière

-- Dons du 13 février
(8000.00, 400, 2, '2026-02-13 10:00:00'),  -- Huile
(25000.00, 500, 6, '2026-02-13 10:30:00'), -- Tôle
(15000.00, 200, 10, '2026-02-13 11:00:00'), -- Bâche

-- Dons du 15 février (récents)
(3000.00, 1000, 1, '2026-02-15 14:00:00'), -- Riz
(5000.00, 500, 7, '2026-02-15 14:30:00'),  -- Clou
(40000.00, 150, 9, '2026-02-15 15:00:00'); -- Ciment
