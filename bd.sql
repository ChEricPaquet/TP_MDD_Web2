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

INSERT INTO Cartes (nom, image, description)
VALUES
-- Troupes
('Chevalier', 'Chevalier.png', 'Unité robuste à faible coût, idéale pour défendre.'),
('Archeres', 'Archeres.png', 'Deux archères rapides qui attaquent à distance.'),
('ArcherMagique', 'ArcherMagique.png', 'Un Archer faible avec une grande portée et une fleche qui pénetre tout'),
('ArcX', 'ArcX.png', 'batiment qui tire rapidement sur les cartes terraines'),
('ArmeeDeSquelettes', 'ArmeeDeSquelettes.png', 'Une armée de squelettes'),
('Ballon', 'Ballon.png', 'Un ballon faible, capable de faire des immense degats au structure'),
('Barbares', 'Barbares.png', '5 barbares prets a ce battre'),
('BarbaresDElites', 'BarbaresDElites.png', '2 barbares rapides et férocent'),
('BebeDragon', 'BebeDragon.png', 'Un dragon volant fesant un bon dgat de zone'),
('BelierDeCombat', 'BelierDeCombat.png', 'Un belier foncant vers le batiment le plus proche')
('Berserker','Berserker.png','Une jeune fille attaquant tres vite')
('Bombardier','Bombardier.png', 'Un squelette avec du degat de zone sur les troupes terrestres'),
('BouleDeFeu', 'BouleDeFeu.png', 'Beaucoup de dégat dans une petite zone'),
('BouleDeNeige','BouleDeNeige.png', 'Pousse les troupes et les rallentits'),
('Bouliste','Bouliste.png', 'Roule une boule dans la foulle'),
('Bourreau', 'Bourreau.png', 'Bourre'),
('Buche', 'Buche.png', 'Roulle une buche et repousse les troupes dans le chemin'),
('Bucheron','Bucheron.png', 'Jete une rage lorsquil meurt'),
('BuissonSuspicieux', 'BuissonSuspicieux.png','2 goblin cachés qui se dirige vers la tour'),
('CabaneAGoblins', 'CabaneAGobelins.png', 'Un batiment qui invoque des goblins lorsquil est approché'),
('CabaneDeBarbares','CabaneDeBarbares','Un batiment qui invoque des barabres lorsquil est approché'),
('CageGobeline','CageGobeline.png','Un goblin dans une cage'),
('Cannon','Cannon.png','Un batiment qui tire sur les troupes terrestres')


