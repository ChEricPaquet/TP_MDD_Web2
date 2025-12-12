
CREATE DATABASE IF NOT EXISTS `TP_MDD_ClashRoyale`
    DEFAULT CHARACTER SET utf8mb4
    COLLATE utf8mb4_0900_ai_ci;

USE `TP_MDD_ClashRoyale`;
SET default_storage_engine=InnoDB;

CREATE TABLE Clan(
    Id_Clan INT AUTO_INCREMENT,
    nom_clan VARCHAR(150)  NOT NULL,
    description_clan VARCHAR(500)  NOT NULL,
    prive BOOLEAN NOT NULL,
    PRIMARY KEY(Id_Clan),
    UNIQUE(nom_clan)
);

CREATE TABLE Utilisateur(
    Id_Utilisateur INT AUTO_INCREMENT,
    nom VARCHAR(100)  NOT NULL,
    mot_de_passe VARCHAR(255)  NOT NULL,
    PRIMARY KEY(Id_Utilisateur),
    UNIQUE(nom)
);

CREATE TABLE Role(
    Id_Role INT AUTO_INCREMENT,
    role VARCHAR(30) ,
    PRIMARY KEY(Id_Role)
);

CREATE TABLE Rarete(
    Id_Rarete INT AUTO_INCREMENT,
    type VARCHAR(50) ,
    PRIMARY KEY(Id_Rarete)
);

CREATE TABLE Carte(
    Id_Carte INT AUTO_INCREMENT,
    nom VARCHAR(50) ,
    image VARBINARY(250) ,
    description VARCHAR(500) ,
    Id_Rarete INT NOT NULL,
    PRIMARY KEY(Id_Carte),
    FOREIGN KEY(Id_Rarete) REFERENCES Rarete(Id_Rarete)
);

CREATE TABLE Visibilite(
    Id_Visibilite INT AUTO_INCREMENT,
    type VARCHAR(50) ,
    PRIMARY KEY(Id_Visibilite)
);

CREATE TABLE Invitation(
    Id_Invitation INT AUTO_INCREMENT,
    Id_Utilisateur INT NOT NULL,
    Id_Utilisateur_1 INT NOT NULL,
    Id_Clan INT NOT NULL,
    PRIMARY KEY(Id_Invitation),
    FOREIGN KEY(Id_Utilisateur) REFERENCES Utilisateur(Id_Utilisateur),
    FOREIGN KEY(Id_Utilisateur_1) REFERENCES Utilisateur(Id_Utilisateur),
    FOREIGN KEY(Id_Clan) REFERENCES Clan(Id_Clan)
);

CREATE TABLE Deck(
    Id_Deck INT AUTO_INCREMENT,
    Id_Visibilite INT NOT NULL,
    Id_Utilisateur INT NOT NULL,
    PRIMARY KEY(Id_Deck),
    FOREIGN KEY(Id_Visibilite) REFERENCES Visibilite(Id_Visibilite),
    FOREIGN KEY(Id_Utilisateur) REFERENCES Utilisateur(Id_Utilisateur)
);

CREATE TABLE Commentaire(
    Id_Commentaire INT AUTO_INCREMENT,
    dateheure DATETIME NOT NULL,
    texte VARCHAR(1000) ,
    Id_Utilisateur INT NOT NULL,
    Id_Deck INT NOT NULL,
    PRIMARY KEY(Id_Commentaire),
    FOREIGN KEY(Id_Utilisateur) REFERENCES Utilisateur(Id_Utilisateur),
    FOREIGN KEY(Id_Deck) REFERENCES Deck(Id_Deck)
);

CREATE TABLE UtilisateurClan(
    Id_Clan INT,
    Id_Utilisateur INT,
    Id_Role INT,
    PRIMARY KEY(Id_Clan, Id_Utilisateur, Id_Role),
    FOREIGN KEY(Id_Clan) REFERENCES Clan(Id_Clan),
    FOREIGN KEY(Id_Utilisateur) REFERENCES Utilisateur(Id_Utilisateur),
    FOREIGN KEY(Id_Role) REFERENCES Role(Id_Role)
);

CREATE TABLE CarteDeck(
    Id_Carte INT,
    Id_Deck INT,
    PRIMARY KEY(Id_Carte, Id_Deck),
    FOREIGN KEY(Id_Carte) REFERENCES Carte(Id_Carte),
    FOREIGN KEY(Id_Deck) REFERENCES Deck(Id_Deck)
);