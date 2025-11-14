
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
    dateheure DATETIME NOT NULL,
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
('Bouliste', 'Bouliste.png', 'Lance une boule qui roule dans la foule.', 3),
('Bourreau', 'Bourreau.png', 'Lance une hache tournoyante qui revient.', 3),
('Buche', 'Buche.png', 'Fait rouler une bûche qui repousse les troupes sur son passage.', 4),
('Bucheron', 'Bucheron.png', 'Lâche une rage lorsqu’il meurt.', 4),
('Buisson Suspicieux', 'BuissonSuspicieux.png', 'Deux gobelins cachés qui se dirigent vers la tour.', 1),
('Cabane à Gobelins', 'CabaneAGobelins.png', 'Un bâtiment qui invoque des gobelins lorsqu’il est approché.', 2),
('Cabane De Barbares', 'CabaneDeBarbares.png', 'Un bâtiment qui invoque des barbares lorsqu’il est approché.', 2),
('Cage Gobeline', 'CageGobeline.png', 'Un gobelin dans une cage.', 2),
('Cannon', 'Cannon.png', 'Un bâtiment qui tire sur les troupes terrestres.', 1),
('Chevalier', 'Chevalier.png', 'Unité robuste à faible coût, idéale pour défendre.', 1),
('Chevaucheur de cochon','ChevaucheurDeCochon.png','Un homme noir qui chevauche un cochon et qui cible uniquement les bâtiments', 2),
('Cimetiere','Cimetiere.png','Sort qui fait spawn des squelettes nimporte où dans larène', 4),
('Clone','Clone.png','Sort qui duplique toute les troupes en dessous', 3),
('Cochons royaux','CochonsRoyaux.png','Quatre cochons qui focus les bâtiments', 2 ),  
('Colis royal','ColisRoyal.png','Sort qui déploie une colis avec un chevalier dedans', 1),
('Dart goblin','DartGoggins.png','Gobelin à très haute cadence de tir', 2),
('Dragon de lenfer','DragonDeLEnfer.png','Dragon à cible unique mais avec des dégâts graduel', 4),
('Dragons squelettes','DragonsSquelettes.png','Deux dragons qui tire des projectiles', 1),
('Electrocuteurs','Electrocuteurs.png','Trois petits zappys qui zap les ennemis', 2),
('Electro dragon','ElectroDragon.png','Un dragon électrique qui inflige des dégâts de zone', 3),  
('Electro esprit','electroEsprit.png','Petit esprit qui inflige des dégâts électriques de zone', 1),
('Electro Géant','ElectroGeant.png','Gros tank qui fait des dégâts dépine, cible les bâtiments', 3),      
('Electro sorcier','ElectroSorcier.png','Un sorcier électrique qui cible deux cibles à la fois', 4),
('Esprit de feu','EspritDeFeu.png','Petit esprit qui inflige des dégâts de feu de zone', 1),
('Esprit de glace','EspritDeGlace.png','Petit esprit qui inflige des dégâts de glace de zone et gèle', 1),
('Esprit de soin','EspritDeSoin.png','Petit esprit qui soigne les unités alliées dans une petite zone', 1), 
('Extracteur délixir','ExtracteurDElixir.png','Bâtiment qui donne des élixirs', 2), 
('Flèches','Fleches.png','Sort qui attaque les unités ennemies dans une large zone', 1), 
('Fantôme royal','FantomeRoyal.png','Unité furtive qui devient invisible quand elle ne combat pas', 4),
('Foreuse à gobelins','ForeuseGobeline.png','Bâtiment qui vas nimporte où et spawn des gobelins', 3),
('Fût à squelettes','FutASquelettes.png','Un bâtiment qui spawn des squelettes lorsqu’il est détruit', 1),
('Gargouille','Gargouille.png','Unité volante rapide qui attaque au corps à corps', 1),
('Gang de gobelins','GangDeGobelins.png','Petite armée de gobelin en mêlée et à distance', 1), 
('Géant','Geant.png','Unité robuste qui cible uniquement les bâtiments', 2),
('Géant royal','GeantRoyal.png','Unité robuste qui cible uniquement les bâtiments et avance plus vite que le géant normal', 1),
('Géant gobelin','GeantGobelin.png','Unité robuste qui cible uniquement les bâtiments et avance plus vite que le géant normal, à aussi deux gobelins à lance', 3),
('Géant runique','GeantRunique.png','Unité robuste qui boost deux cartes', 3),
('Gel','Gel.png','Sort qui gel', 3),
('Gobelin explosif','GobelinExplosif.png','Gobelin fan de Ossama Bin Laden', 2),   
('Gobelins','Gobelins.png','Trois gobelins rapides qui attaquent au corps à corps', 1),
('Gobelins à lance','GobelinsALance.png','Trois gobelins avec des lances qui attaquent à distance', 1),
('Gobelinstein','Gobelinstein.png','Petit gobelin à distance et gros gobelin tanky avec une capacitée délectricité', 5), 
('Golem','Golem.png','Unité très robuste qui explose en deux golemets à sa mort', 4),
('Golem de glace','GolemDeGlace.png','Unité très robuste qui explose à sa mort et ralenti les ennemis', 3),
('Golem délixir','GolemDElixir.png','Unité plutôt robuste qui se double à sa mort deux fois, donnant de lélixir à ladversaire', 2), 
('Guardes','Guards.png','Trois squelettes avec des boucliers', 3), 
('Horde de gargouilles','HordeDeGargouilles.png','Six gargouilles volantes rapides', 2),  
('Guerisseuse','GuerisseuseArmee.png','Unité qui soigne en attaquant', 2), 
('Molosse de lave','MolosseDeLave.png','Unité volante très robuste qui explose en plusieurs petits lava pups à sa mort', 4), 
('Méga Gargouille','MegaMinion.png','Unité volante robuste qui attaque à distance', 2), 
('Mini P.E.K.K.A','MiniPekka.png','Unité robuste qui inflige de gros dégâts au corps à corps', 2), 
('Mirroir','Mirror.png','Sort qui permet de remmettre une carte déjà mis', 3), 
('Moine','Moine.png','Unité robuste qui peut renvoyer les projectiles', 5), 
('Mortier','Mortier.png','Bâtiment qui tire des obus sur une longue portée', 1), 
('Méga chevalier','MegaChevalier.png','Unité très robuste qui inflige des dégâts de zone en sautant', 4), 
('Mineur','Mineur.png','Unité qui peut être déployée nimporte où dans larène', 4), 
('Mousquetaire','Mousquetaire.png','Unité à distance avec une bonne portée et des dégâts modérés', 2),  
('Neant','Neant.png','Sort qui inflige de lourd dégât selon le nombre dunité dans sa zone', 3), 
('P.E.K.K.A','Pekka.png','Unité très robuste qui inflige de gros dégâts au corps à corps', 3), 
('Petit prince','PetitPrince.png','Unité à distance qui peut faire apparaitre un big boy pour tanké', 5), 
('Prince','Prince.png','Unité rapide qui charge pour infliger des dégâts accrus', 3), 
('Princesse','Princesse.png','Unité à distance avec une très longue portée', 4), 
('Prince ténébreux','PrinceTenebreux.png','Unité rapide qui inflige des dégâts de zone en chargeant', 3), 
('Rage','Rage.png','Sort qui augmente la vitesse dattaque et de déplacement des unités alliées dans une petite zone', 3), 
('Recrues royales','RecruesRoyales.png','Six petits chevaliers avec des bouclier', 1), 
('Reine des archères','ReineDesArchers.png','Unité à distance qui peut  se mettre invisible pour infliger beaucoup de dégât', 5),
('Roi squelette','RoiSquelette.png','Unité robuste qui peut faire spawner des squelettes selon le nombres dunité décédée sur le terrain', 5), 
('Ronces','Ronces.png','Sort qui immobilise et qui fait des dégâts', 3),  
('Roquette','Roquette.png','Sort qui inflige des lourds dégâts dans une petite zone', 2), 
('Sapeurs','Sapeurs.png','Deux squelettes kamikaze très fan des Japonais pendant la Seconde Guerre mondial', 3), 
('Seisme','Seisme.png','Sort très efficace contre les bâtiments', 2), 
('Boss bandit','SkillCycle.png','Unité qui dash, dash, dash et re-dash', 5), 
('Sorcier','Sorcier.png','Unité à distance qui inflige des dégâts de zone avec des boules de feu', 2), 
('Sorcier de glace','SorcierDeGlace.png','Unité à distance qui inflige des dégâts de glace qui ralentit dans une zone', 4),
('Sorcière','Sorciere.png','Unité qui attaque à distance et spawn quatres squelettes tout les dix secondes', 3),  
('Sorcière de la nuit','SorciereDeLaNuit.png','Unité qui attaque en mêlée et spawn deux chauves-souries à chaque 10 secondes', 4), 
('Squelette géant','SqueletteGeant.png','Unité très robuste qui explose en plusieurs squelettes à sa mort', 2), 
('Squelettes','Larry.png','Trois petits squelettes rapides', 1), 
('Géant squelette','SqueletteGeant.png','Unité très robuste qui lâche une bombe à sa mort', 3), 
('Tesla','Tesla.png','Bâtiments camouflé qui inflige de bon dégât en cible unique', 1), 
('Artificière','TireSucker.png','Unité infligeant de lourds dégâts en zone', 1), 
('Tornade','Tornade.png','Sort qui attire les unités ennemies vers son centre et inflige des dégâts sur la durée', 4), 
('Tour à bombes','TourABombes.png','Bâtiments qui envoie des bombes infligeant des dégâts en zone', 2), 
('Tour de lenfer','TourDeLEnfer.png','Bâtiments à cible unique qui inflige des dégâts graduelle', 2), 
('Trois mousquetaires','TroisMousquetaires.png','Trois mousquetaires très coûteuse mais infligeant de grands dégâts', 2), 
('Valkyrie','Valkyrie.png','Unité robuste qui inflige des dégâts de zone au corps à corps', 2), 
('Voleuse','Voleuse.png','Unité qui dash pour infliger des dégâts', 4), 
('Zap','Zap.png','Sort qui inflige des dégâts électriques de zone et étourdit les ennemis', 1), 
('Zappy','Zappy.png','Bâtiment qui tire des éclairs sur les ennemis proches', 2)

INSERT INTO Utilisateurs (nom, mot_de_passe)
VALUES
('Alice Tremblay', 'At!92xQm7'),
('Benoît Gagnon', 'Bg#74LmZp'),
('Clara Dubois', 'Cd*58VrNt'),
('David Lavoie', 'Dl@63QwXe'),
('Élodie Fortin', 'Ef!81ZkRt'),
('François Moreau', 'Fm#97YtLp'),
('Gabrielle Roy', 'Gr*46PwMn'),
('Hugo Boucher', 'Hb@55KsQz'),
('Isabelle Caron', 'Ic!72XvJr'),
('Julien Martel', 'Jm#83NtWq')

INSERT INTO Clans (nom_clan, description_clan)
VALUES
('Les Loups Argentés', 'Un clan de guerriers rusés, connus pour leur rapidité et leur esprit d’équipe.'),
('Dragons Écarlates', 'Clan fier et puissant, spécialisé dans la maîtrise du feu et la force brute.'),
('Ombres Silencieuses', 'Assassins discrets et stratèges, experts en infiltration et en espionnage.'),
('Gardiens de l’Aube', 'Protecteurs des terres sacrées, porteurs de lumière et défenseurs des innocents.'),
('Corbeaux Mystiques', 'Un clan mystérieux, lié aux arts occultes et aux secrets anciens.')
