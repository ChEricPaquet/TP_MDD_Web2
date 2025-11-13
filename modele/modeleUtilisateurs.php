<?php
require_once "modele/bd.php";

class ModeleUtilisateurs
{
    // Permet d'ajouter un utilisateur dans la base de données
    public static function ajouterUtilisateur($nom, $mot_de_passe)
    {
        $connexion = BD::ObtenirConnexion();

        // Préparation de la requête SQL
        $req = $connexion->prepare(
            "INSERT INTO Utilisateurs (nom, mot_de_passe) VALUES (:nom, :mot_de_passe)"
        );

        // Liaison des paramètres nommés avec les variables PHP
        $req->bindParam(':nom', $nom);
        $req->bindParam(':mot_de_passe', $mot_de_passe);

        // Exécution de la requête préparée
        $req->execute();

        // Retourne l'identifiant de l'utilisateur qui vient d'être inséré
        return $connexion->lastInsertId();
    }

    // Permet d'obtenir un utilisateur par son nom
    public static function obtenirUtilisateur($nom)
    {
        $connexion = BD::ObtenirConnexion();

        // Préparation de la requête SQL avec un paramètre nommé
        $req = $connexion->prepare(
            "SELECT * FROM Utilisateurs WHERE nom = :nom"
            
        );

        // Liaison des paramètres nommés avec les variables PHP
        $req->bindParam(':nom', $nom);

        // Exécution de la requête
        $req->execute();

        // Retourne l'objet PDOStatement contenant le résultat
        return $req;
    }
}
