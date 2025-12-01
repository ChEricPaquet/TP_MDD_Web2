
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


INSERT INTO Rarete (type)
VALUES 
("Commune"),
("Rare"),
("Épique"),
("Légendaire"),
("Champion");

INSERT INTO Visibilite (type)
VALUES 
("Privé"),
("Seulement Clan"),
("Public");

INSERT INTO Role (role)
VALUES 
("Membre"),
("Aîné"),
("Chef adjoint"),
("Chef");

INSERT INTO Carte (nom, image, description, Id_Rarete)
VALUES
("Archeres", "Archeres.png", "Deux archères rapides qui attaquent à distance.", 1),
("Archer Magique", "ArcherMagique.png", "Un Archer faible avec une grande portée et une flèche qui pénètre tout.", 4),
("Arc X", "ArcX.png", "Bâtiment qui tire rapidement sur les cartes terrestres.", 3),
("Armee De Squelettes", "ArmeeDeSquelettes.png", "Une armée de squelettes.", 1),
("Ballon", "Ballon.png", "Un ballon faible, capable de faire d’immenses dégâts aux structures.", 3),
("Barbares", "Barbares.png", "5 barbares prêts à se battre.", 1),
("Barbares Delites", "BarbaresDElites.png", "2 barbares rapides et féroces.", 2),
("Bébé Dragon", "BebeDragon.png", "Un dragon volant faisant de bons dégâts de zone.", 3),
("Bélier De Combat", "BelierDeCombat.png", "Un bélier fonçant vers le bâtiment le plus proche.", 2),
("Berserker", "Berserker.png", "Une jeune fille attaquant très vite.", 2),
("Bombardier", "Bombardier.png", "Un squelette avec des dégâts de zone sur les troupes terrestres.", 1),
("Boule De Feu", "BouleDeFeu.png", "Beaucoup de dégâts dans une petite zone.", 2),
("Boule De Neige", "BouleDeNeige.png", "Pousse les troupes et les ralentit.", 1),
("Bouliste", "Bouliste.png", "Lance une boule qui roule dans la foule.", 3),
("Bourreau", "Bourreau.png", "Lance une hache tournoyante qui revient.", 3),
("Buche", "Buche.png", "Fait rouler une bûche qui repousse les troupes sur son passage.", 4),
("Bucheron", "Bucheron.png", "Lâche une rage lorsqu’il meurt.", 4),
("Buisson Suspicieux", "BuissonSuspicieux.png", "Deux gobelins cachés qui se dirigent vers la tour.", 1),
("Cabane à Gobelins", "CabaneAGobelins.png", "Un bâtiment qui invoque des gobelins lorsqu’il est approché.", 2),
("Cabane De Barbares", "CabaneDeBarbares.png", "Un bâtiment qui invoque des barbares lorsqu’il est approché.", 2),
("Cage Gobeline", "CageGobeline.png", "Un gobelin dans une cage.", 2),
("Cannon", "Cannon.png", "Un bâtiment qui tire sur les troupes terrestres.", 1),
("Cavabeliere", "Cavabeliere.png", "Une femme qui tire des bolas et chevauche un belier.", 4),
("Charrette a canon", "CharretteACanon.png", "Un canon sur roue qui perd ses roues après avec eu des dégat.", 3),
("Chasseur","Chasseur.png","Un chasseur avec un gros calibre.", 3),
("Chauves souris", "ChauvesSouris.png", "Armée de chauves souris qui attaque en groupe", 1),
("Chevalier", "Chevalier.png", "Unité robuste à faible coût, idéale pour défendre.", 1),
("Chevalier dor", "ChevalierDOr.png", "Unité rapide qui peut dash sur une armée énnemi.", 5),
("Chevaucheur de cochon","ChevaucheurDeCochon.png","Un homme noir qui chevauche un cochon et qui cible uniquement les bâtiments", 2),
("Cimetiere","Cimetiere.png","Sort qui fait spawn des squelettes nimporte où dans larène", 4),
("Clone","Clone.png","Sort qui duplique toute les troupes en dessous", 3),
("Cochons royaux","CochonsRoyaux.png","Quatre cochons qui focus les bâtiments", 2 ),  
("Colis royal","ColisRoyal.png","Sort qui déploie une colis avec un chevalier dedans", 1),
("Goblin à sarbacane","DartGoggins.png","Gobelin à très haute cadence de tir", 2),
("Dragon de lenfer","DragonDeLEnfer.png","Dragon à cible unique mais avec des dégâts graduel", 4),
("Dragons squelettes","DragonsSquelettes.png","Deux dragons qui tire des projectiles", 1),
("Electrocuteurs","Electrocuteurs.png","Trois petits zappys qui zap les ennemis", 2),
("Electro dragon","ElectroDragon.png","Un dragon électrique qui inflige des dégâts de zone", 3),  
("Electro esprit","electroEsprit.png","Petit esprit qui inflige des dégâts électriques de zone", 1),
("Electro Géant","ElectroGeant.png","Gros tank qui fait des dégâts dépine, cible les bâtiments", 3),      
("Electro sorcier","ElectroSorcier.png","Un sorcier électrique qui cible deux cibles à la fois", 4),
("Esprit de feu","EspritDeFeu.png","Petit esprit qui inflige des dégâts de feu de zone", 1),
("Esprit de glace","EspritDeGlace.png","Petit esprit qui inflige des dégâts de glace de zone et gèle", 1),
("Esprit de soin","EspritDeSoin.png","Petit esprit qui soigne les unités alliées dans une petite zone", 1), 
("Extracteur délixir","ExtracteurDElixir.png","Bâtiment qui donne des élixirs", 2), 
("Fantôme royal","FantomeRoyal.png","Unité furtive qui devient invisible quand elle ne combat pas", 4),
("Flèches","Fleches.png","Sort qui attaque les unités ennemies dans une large zone", 1), 
("Foreuse à gobelins","ForeuseGobeline.png","Bâtiment qui vas nimporte où et spawn des gobelins", 3),
("Foudre", "Foudre.png","Sort qui fait mal sa mère au trois énnemi avec le plus de vie.", 3),
("Fournaise","Fournaise.png","Batiment qui fait naitre des esprit de feu.", 2),
("Fripons","Fripons.png","Deux filles qui lancent de la gomme et un garçon avec un épée.", 1),
("Fut à barbare","FutABarbare.png","Un sort qui roule un fut et inovque un barabre a la fin de sa trajectoire", 3),
("Fut à gobelins","FutAGobelin.png","Un sort qui invoque 3 gobelins où il attérit", 3),
("Fût à squelettes","FutASquelettes.png","Un bâtiment qui spawn des squelettes lorsqu’il est détruit", 1),
("Gang de gobelins","GangDeGobelins.png","Petite armée de gobelin en mêlée et à distance", 1),
("Gargouille","Gargouille.png","Unité volante rapide qui attaque au corps à corps", 1),
("Géant","Geant.png","Unité robuste qui cible uniquement les bâtiments", 2),
("Géant gobelin","GeantGobelin.png","Unité robuste qui cible uniquement les bâtiments et avance plus vite que le géant normal, à aussi deux gobelins à lance", 3),
("Géant royal","GeantRoyal.png","Unité robuste qui cible uniquement les bâtiments et avance plus vite que le géant normal", 1),
("Géant runique","GeantRunique.png","Unité robuste qui boost deux cartes", 3),
("Gel","Gel.png","Sort qui gel", 3),
("Gobelin explosif","GobelinExplosif.png","Gobelin fan de Ossama Bin Laden", 2),   
("Gobelins","Gobelins.png","Quatre juifs rapides qui attaquent au corps à corps", 1),
("Gobelins à lance","GobelinsALance.png","Trois gobelins avec des lances qui attaquent à distance", 1),
("Gobelinstein","Gobelinstein.png","Petit gobelin à distance et gros gobelin tanky avec une capacitée délectricité", 5), 
("Golem","Golem.png","Unité très robuste qui explose en deux golemets à sa mort", 4),
("Golem de glace","GolemDeGlace.png","Unité très robuste qui explose à sa mort et ralenti les ennemis", 3),
("Golem délixir","GolemDElixir.png","Unité plutôt robuste qui se double à sa mort deux fois, donnant de lélixir à ladversaire", 2), 
("Guardes","Guards.png","Trois squelettes avec des boucliers", 3), 
("Guerisseuse","GuerisseuseArmee.png","Unité qui soigne en attaquant", 2),
("Horde de gargouilles","HordeDeGargouilles.png","Six gargouilles volantes rapides", 2),
("Impératrice spirituelle","ImperatriceSpirituelle.png","Forme terreste et aérienne pour 3 et 6 élexir.", 4),
("Machine gobeline", "MachineGobeline.png","Bébé gobelin avec une géante machine.", 4),
("Machine volante","MachineVolante.png","Unité aérienne avec un canon.", 2),
("Maitre mineur","MaitreMineur.png","Mineur avec une foreuse qui peut changer de coter de la carte.", 5),
("Malediction gobeline","MaledictionGobeline.png","Sort qui transforme les unités énnemis en gentil gobelin.", 3),
("Mamie sorcière","MamieSorciere.png","Sorcière qui transforme les unités énnemi en cochon quand ils meurent.", 4),
("Méga chevalier","MegaChevalier.png","Unité très robuste qui inflige des dégâts de zone en sautant", 4),
("Méga Gargouille","MegaMinion.png","Unité volante robuste qui attaque à distance", 2),
("Mineur","Mineur.png","Unité qui peut être déployée nimporte où dans larène", 4),
("Mini pekka","MiniPekka.png","Unité robuste qui inflige de gros dégâts au corps à corps", 2), 
("Mirroir","Mirror.png","Sort qui permet de remmettre une carte déjà mis", 3),
("Moine","Moine.png","Unité robuste qui peut renvoyer les projectiles", 5), 
("Molosse de lave","MolosseDeLave.png","Unité volante très robuste qui explose en plusieurs petits lava pups à sa mort", 4),
("Mortier","Mortier.png","Bâtiment qui tire des obus sur une longue portée", 1), 
("Mousquetaire","Mousquetaire.png","Unité à distance avec une bonne portée et des dégâts modérés", 2),  
("Neant","Neant.png","Sort qui inflige de lourd dégât selon le nombre dunité dans sa zone", 3),
("Pêcheur", "Pecheur.png", "Unité qui tire les énnemis vers lui", 4),
("P.E.K.K.A","Pekka.png","Unité très robuste qui inflige de gros dégâts au corps à corps", 3), 
("Petit prince","PetitPrince.png","Unité à distance qui peut faire apparaitre un big boy pour tanké", 5),
("Phoenix", "Phoenix.png", "Troupe aérienne réssussite après sa mort", 4),
("Pierre tombale", "PierreTombale.png","Batiment qui fait apparaitre des squelettes.", 1),
("Poison","Poison.png","Sort qui fait mal sur la durée.", 3),
("Prince","Prince.png","Unité rapide qui charge pour infliger des dégâts accrus", 3), 
("Princesse","Princesse.png","Unité à distance avec une très longue portée", 4), 
("Prince ténébreux","PrinceTenebreux.png","Unité rapide qui inflige des dégâts de zone en chargeant", 3), 
("Rage","Rage.png","Sort qui augmente la vitesse dattaque et de déplacement des unités alliées dans une petite zone", 3), 
("Recrues royales","RecruesRoyales.png","Six petits chevaliers avec des bouclier", 1), 
("Reine des archères","ReineDesArchers.png","Unité à distance qui peut  se mettre invisible pour infliger beaucoup de dégât", 5),
("Roi squelette","RoiSquelette.png","Unité robuste qui peut faire spawner des squelettes selon le nombres dunité décédée sur le terrain", 5), 
("Ronces","Ronces.png","Sort qui immobilise et qui fait des dégâts", 3),  
("Roquette","Roquette.png","Sort qui inflige des lourds dégâts dans une petite zone", 2), 
("Sapeurs","Sapeurs.png","Deux squelettes kamikaze très fan des Japonais pendant la Seconde Guerre mondial", 3), 
("Seisme","Seisme.png","Sort très efficace contre les bâtiments", 2), 
("Boss bandit","SkillCycle.png","Unité qui dash, dash, dash et re-dash", 5), 
("Sorcier","Sorcier.png","Unité à distance qui inflige des dégâts de zone avec des boules de feu", 2), 
("Sorcier de glace","SorcierDeGlace.png","Unité à distance qui inflige des dégâts de glace qui ralentit dans une zone", 4),
("Sorcière","Sorciere.png","Unité qui attaque à distance et spawn quatres squelettes tout les dix secondes", 3),  
("Sorcière de la nuit","SorciereDeLaNuit.png","Unité qui attaque en mêlée et spawn deux chauves-souries à chaque 10 secondes", 4), 
("Squelette géant","SqueletteGeant.png","Unité très robuste qui explose en plusieurs squelettes à sa mort", 3), 
("Squelettes","Larry.png","Trois petits squelettes rapides", 1), 
("Tesla","Tesla.png","Bâtiments camouflé qui inflige de bon dégât en cible unique", 1), 
("Artificière","TireSucker.png","Unité infligeant de lourds dégâts en zone", 1), 
("Tornade","Tornade.png","Sort qui attire les unités ennemies vers son centre et inflige des dégâts sur la durée", 4), 
("Tour à bombes","TourABombes.png","Bâtiments qui envoie des bombes infligeant des dégâts en zone", 2), 
("Tour de lenfer","TourDeLEnfer.png","Bâtiments à cible unique qui inflige des dégâts graduelle", 2), 
("Trois mousquetaires","TroisMousquetaires.png","Trois mousquetaires très coûteuse mais infligeant de grands dégâts", 2), 
("Valkyrie","Valkyrie.png","Unité robuste qui inflige des dégâts de zone au corps à corps", 2), 
("Voleuse","Voleuse.png","Unité qui dash pour infliger des dégâts", 4), 
("Zap","Zap.png","Sort qui inflige des dégâts électriques de zone et étourdit les ennemis", 1), 
("Zappy","Zappy.png","Bâtiment qui tire des éclairs sur les ennemis proches", 2);

INSERT INTO Utilisateur (nom, mot_de_passe)
VALUES
("MegaNight999", "At!92xQm7"),
("Firespark", "Bg#74LmZp"),
("Micheal Bouffard", "Cd*58VrNt"),
("MrBeast", "Dl@63QwXe"),
("Kanye West", "Ef!81ZkRt"),
("Krambit", "Fm#97YtLp"),
("SilvarC1", "Gr*46PwMn"),
("AAAAAAAA", "Hb@55KsQz"),
("Gandalf2", "Ic!72XvJr"),
("Julius Ceasar", "Jm#83NtWq"),
("Canishlol666", "Cp*29XzVb"),
("SparkyFire", "Sf@68LmYp"),
("ULose123", "Ud!47VrNt"),
("MohamedLight", "Ml#59QwXe"),
("Ryley", "Rs*82ZkRt"),
("Ian77", "Lb@91YtLp"),
("Ken", "Kg!34PwMn"),
("DragonSlayer", "Db#76KsQz"),
("HAWGRIDAR", "Kr*88NtWq"),
("EtienneDaGoat", "Sh@22XzVb");

INSERT INTO Clan (nom_clan, description_clan, prive)
VALUES
("Les MegaKnights", "SAUTER FRAPPER GAGNER", 0),
("Phénix Doré", "Un clan légendaire, renaissant de ses cendres, dédié à la meilleure carte du jeu: Le Phoenix", 1),
("Légion des Ombres", "Profesionnels seulement, doit être actif et talentueux", 0),
("Gardiens des Noobs", "Un clan dévoué à la protection des faibles, avec une forte tradition de défense.", 1),
("Dragons Écarlates", "Clan fier et puissant, spécialisé dans la guerre des clans", 0),
("FlashLight", "Le top du top, les rois des rois, bienvenu dans la cours des grands.", 0),
("Liberté du Québec", "Un clan légendaire, lié aux arts patriotiques et aux secrets français québecois.", 0),
("McDonaldDriveThru", "Mettez les frites dans le sac petit frère", 0);


INSERT INTO Deck (Id_Visibilite, Id_Utilisateur)
VALUES
(3, 1),
(2, 2),
(1, 3),
(3, 4),
(2, 5),
(1, 6),
(3, 7),
(2, 8),
(1, 9),
(3, 10);

INSERT INTO Commentaire (dateheure, texte, Id_Utilisateur, Id_Deck)
VALUES
(NOW(),"Bridge spam qui rend fou, ça attaque de partout 😈",1,1),
(NOW(),"Équilibré et polyvalent, parfait pour grimper en ladder 🚀",2,4),
(NOW(),"Cycle ultra rapide, l’adversaire n’a même pas le temps de respirer 😮‍💨",3,7),
(NOW(),"Ce deck est une vraie machine à pression 🔥",4,2),
(NOW(),"Ballon qui surprend et fait des dégâts monstrueux en une seule attaque 🎈💥",5,5);

INSERT INTO CarteDeck (Id_Carte, Id_Deck)
VALUES
(1, 1),
(12, 1),
(23, 1),
(26, 1),
(22, 1),
(33, 1),
(49, 1),
(48, 1),
(55, 2),
(56, 2),
(61, 2),
(75, 2),
(77, 2),
(89, 2),
(98, 2),
(86, 2),
(121, 3),
(113, 3),
(102, 3),
(100, 3),
(103, 3),
(96, 3),
(118, 3),
(110, 3),
(116, 4),
(101, 4),
(95, 4),
(71, 4),
(66, 4),
(77, 4),
(89, 4),
(69, 4),
(89, 5),
(118, 5),
(86, 5),
(111, 5),
(13, 5),
(47, 5),
(22, 5),
(5, 5);

INSERT INTO Invitation (Id_Utilisateur, Id_Utilisateur_1, Id_Clan)
VALUES
(3, 1, 1),
(4, 2, 2),
(5, 3, 3),
(6, 4, 4),
(7, 5, 5);

INSERT INTO UtilisateurClan (Id_Clan, Id_Utilisateur, Id_Role)
VALUES
(1, 1, 4),
(1, 2, 2),
(1, 3, 1),
(2, 4, 4),
(2, 5, 3),
(2, 6, 1),
(3, 7, 4),
(3, 8, 2),
(3, 9, 1),
(4, 10, 4);
(4, 11, 2),
(4, 12, 1),
(5, 13, 4),
(5, 14, 3),
(5, 15, 1),
(6, 16, 4),
(6, 17, 2),
(6, 18, 1),
(7, 19, 4),
(7, 20, 2);