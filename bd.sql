CREATE DATABASE IF NOT EXISTS `TP_MDD_ClashRoyale`
    DEFAULT CHARACTER SET utf8mb4
    COLLATE utf8mb4_0900_ai_ci;

USE `exercice_fichier_bd`;
SET default_storage_engine=InnoDB;

CREATE Table `Clans` (
    `id_clan` int NOT NULL AUTO_INCREMENT,
    `nom_clan` varchar(15) NOT NULL,
    `description_clan` varchar(50) NOT NULL,

)

-- Table des utilisateurs
CREATE TABLE `utilisateurs` (
    `id` int NOT NULL AUTO_INCREMENT,
    `id_clan` int,
    `nom` varchar(45) NOT NULL,
    `mot_de_passe` varchar(255) NOT NULL,
    PRIMARY KEY (`id`),
    FOREIGN KEY ('id_clan') REFERENCES `Clans`(`id_clan`),
    UNIQUE (`nom`)
);

CREATE TABLE `Clan_Utilisateurs_Role` (
    `id_clan` INT NOT NULL,
    `id_utilisateur` INT NOT NULL,
    `id_role` int NOT NULL,
    PRIMARY KEY (`id_clan`, `id_utilisateur`,`id_role`),
    FOREIGN KEY (`id_clan`) REFERENCES `Clans`(`id_clan`),
    FOREIGN KEY (`id_utilisateur`) REFERENCES `utilisateurs`(`id`)
    FOREIGN KEY (`id_role`) REFERENCES 'role'(`id_role`)
); --écrit par Copilot 

CREATE Table `role` (
    `id_role` int NOT NULL,
    `role` varchar(10),
    PRIMARY KEY(`id_role`)
)