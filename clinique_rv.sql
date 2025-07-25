-- Création de la table patients
CREATE TABLE patients (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(50) NOT NULL,
    prenom VARCHAR(50) NOT NULL,
    email VARCHAR(100) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    telephone VARCHAR(20),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB;

-- Création de la table specialites
CREATE TABLE specialites (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(50) NOT NULL UNIQUE
) ENGINE=InnoDB;

-- Insertion des spécialités de base
INSERT INTO specialites (nom) VALUES 
('Généraliste'),
('Dentaire'),
('Cardiologue'),
('Dermatologue'),
('Pédiatre');

-- Création de la table rendez_vous
CREATE TABLE rendez_vous (
    id INT AUTO_INCREMENT PRIMARY KEY,
    patient_id INT NOT NULL,
    specialite_id INT NOT NULL,
    date_rv DATE NOT NULL,
    heure_rv TIME NOT NULL,
    statut ENUM('en_attente', 'confirme', 'annule', 'demande_annulation') DEFAULT 'en_attente',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (patient_id) REFERENCES patients(id) ON DELETE CASCADE,
    FOREIGN KEY (specialite_id) REFERENCES specialites(id) ON DELETE CASCADE
) ENGINE=InnoDB;

-- Insertion d'un patient test (mot de passe = "test1234")
INSERT INTO patients (nom, prenom, email, password, telephone) VALUES
('Dupont', 'Jean', 'jean.dupont@email.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', '0612345678');

-- Insertion d'un rendez-vous test
INSERT INTO rendez_vous (patient_id, specialite_id, date_rv, heure_rv, statut) VALUES
(1, 1, '2025-12-15', '10:00:00', 'confirme')