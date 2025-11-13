CREATE DATABASE IF NOT EXISTS `TP_MDD_ClashRoyale`
    DEFAULT CHARACTER SET utf8mb4
    COLLATE utf8mb4_0900_ai_ci;

USE `exercice_fichier_bd`;
SET default_storage_engine=InnoDB;
CREATE DATABASE IF NOT EXISTS `TP_MDD_ClashRoyale`
    DEFAULT CHARACTER SET utf8mb4
    COLLATE utf8mb4_0900_ai_ci;

USE `TP_MDD_ClashRoyale`;
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
    id_clan INT AUTO_INCREMENT,
    id INT,
    id_role INT,
    PRIMARY KEY (id_clan, id, id_role),
    FOREIGN KEY (id_clan) REFERENCES Clans(id_clan),
    FOREIGN KEY (id) REFERENCES Utilisateurs(id),
    FOREIGN KEY (id_role) REFERENCES Role(id_role)
);

CREATE TABLE CarteDeck (
    id_carte INT,
    id_deck INT,
    PRIMARY KEY (id_carte, id_deck),
    FOREIGN KEY (id_carte) REFERENCES Carte(id_carte),
    FOREIGN KEY (id_deck) REFERENCES Deck(id_deck)
);

INSERT INTO Rarete (type)
VALUES 
("Commune"),
("Rare"),
("Épique"),
("Légendaire"),
("Champion")

INSERT INTO Carte (nom, image, description, id_rarete)
VALUES
-- Troupes
('Chevalier', 'Chevalier.png', 'Unité robuste à faible coût, idéale pour défendre.', 1),
('Archeres', 'Archeres.png', 'Deux archères rapides qui attaquent à distance.', 1),
('Archer Magique', 'ArcherMagique.png', 'Un Archer faible avec une grande portée et une flèche qui pénètre tout.', 4),
('Arc X', 'ArcX.png', 'Bâtiment qui tire rapidement sur les cartes terrestres.', 3),
('Armee De Squelettes', 'ArmeeDeSquelettes.png', 'Une armée de squelettes.', 1),
('Ballon', 'Ballon.png', 'Un ballon faible, capable de faire d’immenses dégâts aux structures.', 3),
('Barbares', 'Barbares.png', '5 barbares prêts à se battre.', 1),
('Barbares Delites', 'BarbaresDElites.png', '2 barbares rapides et féroces.', 2),
('Bébé Dragon', 'BebeDragon.png', 'Un dragon volant faisant de bons dégâts de zone.', 3),
('Bélier De Combat', 'BelierDeCombat.png', 'Un bélier fonçant vers le bâtiment le plus proche.', 2),
('Berserker', 'Berserker.png', 'Une jeune fille attaquant très vite.', 2),
('Bombardier', 'Bombardier.png', 'Un squelette avec des dégâts de zone sur les troupes terrestres.', 1),
('Boule De Feu', 'BouleDeFeu.png', 'Beaucoup de dégâts dans une petite zone.', 2),
('Boule De Neige', 'BouleDeNeige.png', 'Pousse les troupes et les ralentit.', 1),
('Bouliste', 'Bouliste.png', 'Lance une boule qui traverse les ennemis.', 3),
('Bourreau', 'Bourreau.png', 'Lance une hache tournoyante qui revient.', 3),
('Buche', 'Buche.png', 'Fait rouler une bûche qui repousse les troupes sur son passage.', 4),
('Bucheron', 'Bucheron.png', 'Lâche une rage lorsqu’il meurt.', 4),
('Buisson Suspicieux', 'BuissonSuspicieux.png', 'Deux gobelins cachés qui se dirigent vers la tour.', 1),
('Cabane à Gobelins', 'CabaneAGobelins.png', 'Un bâtiment qui invoque des gobelins lorsqu’il est approché.', 2),
('Cabane De Barbares', 'CabaneDeBarbares.png', 'Un bâtiment qui invoque des barbares lorsqu’il est approché.', 2),
('Cage Gobeline', 'CageGobeline.png', 'Un gobelin dans une cage.', 2),
('Cannon', 'Cannon.png', 'Un bâtiment qui tire sur les troupes terrestres.', 1);

