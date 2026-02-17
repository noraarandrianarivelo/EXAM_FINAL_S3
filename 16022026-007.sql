-- =========================
-- ACHAT
-- =========================
CREATE TABLE bngrc_achat (
    id INT AUTO_INCREMENT PRIMARY KEY,
    id_besoin INT NOT NULL,
    id_don_argent INT NOT NULL,
    quantite_achetee INT NOT NULL,
    montant_unitaire DECIMAL(10,2) NOT NULL,
    frais_pourcentage DECIMAL(5,2) NOT NULL,
    montant_total DECIMAL(12,2) NOT NULL,
    date_achat DATETIME NOT NULL,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (id_besoin) REFERENCES bngrc_besoin(id),
    FOREIGN KEY (id_don_argent) REFERENCES bngrc_don(id)
);