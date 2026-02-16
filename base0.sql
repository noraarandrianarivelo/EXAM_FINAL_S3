DROP DATABASE IF EXISTS BNGRC;
CREATE DATABASE IF NOT EXISTS BNGRC;
USE BNGRC;

-- =========================
-- REGION
-- =========================
CREATE TABLE region (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(100) NOT NULL,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP
);

-- =========================
-- VILLE
-- =========================
CREATE TABLE ville (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(100) NOT NULL,
    id_region INT NOT NULL,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (id_region) REFERENCES region(id)
);

-- =========================
-- TYPE BESOIN
-- =========================
CREATE TABLE type_besoin (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(100) NOT NULL,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP
);

-- =========================
-- CATEGORIE BESOIN
-- =========================
CREATE TABLE categorie_besoin (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(100) NOT NULL,
    id_type_besoin INT NOT NULL,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (id_type_besoin) REFERENCES type_besoin(id)
);

-- =========================
-- BESOIN
-- =========================
CREATE TABLE besoin (
    id INT AUTO_INCREMENT PRIMARY KEY,
    pu DECIMAL(10,2) NOT NULL,
    quantite INT NOT NULL,
    id_categorie_besoin INT NOT NULL,
    id_ville INT NOT NULL,
    date_besoin DATETIME NOT NULL,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (id_categorie_besoin) REFERENCES categorie_besoin(id),
    FOREIGN KEY (id_ville) REFERENCES ville(id)
);

-- =========================
-- DON
-- =========================
CREATE TABLE don (
    id INT AUTO_INCREMENT PRIMARY KEY,
    pu DECIMAL(10,2) NOT NULL,
    quantite INT NOT NULL,
    id_categorie_besoin INT NOT NULL,
    date_saisie DATETIME NOT NULL,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (id_categorie_besoin) REFERENCES categorie_besoin(id)
);

-- =========================
-- ATTRIBUTION
-- =========================
CREATE TABLE attribution (
    id INT AUTO_INCREMENT PRIMARY KEY,
    id_besoin INT NOT NULL,
    id_don INT NOT NULL,
    quantite_dispatch INT NOT NULL,
    date_dispatch DATETIME NOT NULL,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (id_besoin) REFERENCES besoin(id),
    FOREIGN KEY (id_don) REFERENCES don(id)
);
