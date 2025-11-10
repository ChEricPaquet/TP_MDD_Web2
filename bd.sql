CREATE DATABASE IF NOT EXISTS `TP_MDD_ClashRoyale`
    DEFAULT CHARACTER SET utf8mb4
    COLLATE utf8mb4_0900_ai_ci;

USE `exercice_fichier_bd`;
SET default_storage_engine=InnoDB;
CREATE TABLE Clans (
    id_clan INT AUTO_INCREMENT,
    nom_clan VARCHAR(15) NOT NULL,
    description_clan VARCHAR(50) NOT NULL,
    PRIMARY KEY (id_clan)
);

CREATE TABLE Utilisateurs (
    id INT AUTO_INCREMENT,
    nom VARCHAR(45) NOT NULL,
    mot_de_passe VARCHAR(255) NOT NULL,
    PRIMARY KEY (id),
    UNIQUE (nom)
);

CREATE TABLE Role (
    id_role INT,
    role VARCHAR(10),
    PRIMARY KEY (id_role)
);

CREATE TABLE Rarete (
    id_rarete INT AUTO_INCREMENT,
    type VARCHAR(50),
    PRIMARY KEY (id_rarete)
);

CREATE TABLE Deck (
    id_deck INT AUTO_INCREMENT,
    id INT NOT NULL,
    PRIMARY KEY (id_deck),
    FOREIGN KEY (id) REFERENCES Utilisateurs(id)
);

CREATE TABLE Commentaire (
    id_commentaire INT AUTO_INCREMENT,
    texte VARCHAR(1000),
    id_deck INT NOT NULL,
    id INT NOT NULL,
    PRIMARY KEY (id_commentaire),
    FOREIGN KEY (id_deck) REFERENCES Deck(id_deck),
    FOREIGN KEY (id) REFERENCES Utilisateurs(id)
);

CREATE TABLE Carte (
    id_carte INT AUTO_INCREMENT,
    nom VARCHAR(50),
    description VARCHAR(500),
    image VARBINARY(250),
    id_rarete INT NOT NULL,
    PRIMARY KEY (id_carte),
    FOREIGN KEY (id_rarete) REFERENCES Rarete(id_rarete)
);

CREATE TABLE UtilisateurClan (
    id_clan INT,
    id INT,
    id_role INT,
    PRIMARY KEY (id_clan, id, id_role),
    FOREIGN KEY (id_clan) REFERENCES Clans(id_clan),
    FOREIGN KEY (id) REFERENCES Utilisateurs(id),
    FOREIGN KEY (id_role) REFERENCES Role(id_role)
);

CREATE TABLE Contient (
    id_carte INT,
    id_deck INT,
    PRIMARY KEY (id_carte, id_deck),
    FOREIGN KEY (id_carte) REFERENCES Carte(id_carte),
    FOREIGN KEY (id_deck) REFERENCES Deck(id_deck)
);

