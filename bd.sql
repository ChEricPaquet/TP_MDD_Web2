CREATE DATABASE IF NOT EXISTS `TP_MDD_ClashRoyale`
    DEFAULT CHARACTER SET utf8mb4
    COLLATE utf8mb4_0900_ai_ci;

USE `exercice_fichier_bd`;
SET default_storage_engine=InnoDB;

-- Table des utilisateurs
CREATE TABLE `utilisateurs` (
    `id` int NOT NULL AUTO_INCREMENT,
    `nom` varchar(45) NOT NULL,
    `mot_de_passe` varchar(255) NOT NULL,
    PRIMARY KEY (`id`),
    UNIQUE (`nom`)
);

INSERT INTO `utilisateurs` (`id`, `nom`, `mot_de_passe`) VALUES
    (1, 'user1', '$2y$10$OGiU3BxumEMXlaaBkWFggOJk5FqsgnLn3S7E5TrJJ.eo.CkGCVa4.'), -- Mot de passe: 123456

INSERT INTO `marques` (`nom`) VALUES ('Toyota');


INSERT INTO `modeles` (`nom`, `marques_id`) VALUES ('Corolla', 1);
