CREATE DATABASE IF NOT EXISTS gestion_materiel;
USE gestion_materiel;
CREATE TABLE Utilisateur (
    id_utilisateur INT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(100),
    prenom VARCHAR(100),
    email VARCHAR(150) UNIQUE,
    mot_de_passe VARCHAR(255),
    rôle ENUM('etudiant', 'technicien', 'responsable'),
    date_inscription DATE
);

-- Table Notification
CREATE TABLE Notification (
    id_notification INT AUTO_INCREMENT PRIMARY KEY,
    id_utilisateur INT,
    type VARCHAR(50),
    message TEXT,
    date_envoi DATETIME,
    lue BOOLEAN DEFAULT FALSE,
    FOREIGN KEY (id_utilisateur) REFERENCES Utilisateur(id_utilisateur)
);

-- Table Équipement
CREATE TABLE Equipement (
    id_equipement INT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(100),
    description TEXT,
    catégorie VARCHAR(100),
    état ENUM('disponible', 'hors_service', 'en_reparation') DEFAULT 'disponible',
    seuil_alerte INT,
    qr_code VARCHAR(255),
    quantite_dispo INT
);

-- Table Stock
CREATE TABLE Stock (
    id_stock INT AUTO_INCREMENT PRIMARY KEY,
    id_equipement INT UNIQUE,
    localisation VARCHAR(100),
    quantité INT,
    seuil_minimum INT,
    FOREIGN KEY (id_equipement) REFERENCES Equipement(id_equipement)
);

-- Table Réservation
CREATE TABLE Reservation (
    id_reservation INT AUTO_INCREMENT PRIMARY KEY,
    id_utilisateur INT,
    date_debut DATETIME,
    date_fin DATETIME,
    statut ENUM('en_attente', 'validée', 'refusée', 'terminée') DEFAULT 'en_attente',
    signature_responsable TEXT,
    qr_code_reservation VARCHAR(255),
    date_creation DATETIME DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (id_utilisateur) REFERENCES Utilisateur(id_utilisateur)
);

-- Table Réservation_Équipement (relation N-N)
CREATE TABLE Reservation_Equipement (
    id_reservation INT,
    id_equipement INT,
    quantite_demandée INT,
    PRIMARY KEY (id_reservation, id_equipement),
    FOREIGN KEY (id_reservation) REFERENCES Reservation(id_reservation),
    FOREIGN KEY (id_equipement) REFERENCES Equipement(id_equipement)
);

-- Table Materiel 
CREATE TABLE Materiel (
    id_materiel INT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(100) NOT NULL,
    type VARCHAR(100), -- Ex: Ordinateur, Imprimante, Câble HDMI...
    marque VARCHAR(100),
    modele VARCHAR(100),
    numero_serie VARCHAR(100) UNIQUE,
    etat ENUM('disponible', 'en_panne', 'en_reparation') DEFAULT 'disponible',
    date_ajout DATE,
    qr_code VARCHAR(255),
    localisation VARCHAR(100),
    seuil_alerte INT,
    quantite INT DEFAULT 1
);

drop table Materiel ;
