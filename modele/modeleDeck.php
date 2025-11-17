<?php
require_once "modele/bd.php";
class ModeleDeck
{
    public static function AjouterDeck($nomDeck, $idVisibilite, $idUtilisateur)
    {
        $connexion = BD::ObtenirConnexion();

        $req = $connexion->prepare(
            "INSERT INTO Deck (nom_deck, Id_Visibilite, Id_Utilisateur) VALUES (:nom_deck, :Id_Visibilite, :id_utilisateur)"
        );

        $req->bindParam(':nom_deck', $nomDeck);
        $req->bindParam(':Id_Visibilite', $idVisibilite);
        $req->bindParam(':id_utilisateur', $idUtilisateur);

        $req->execute();

        return $connexion->lastInsertId();
    }

    public static function ObtenirDecksParUtilisateur($idUtilisateur)
    {
        $connexion = BD::ObtenirConnexion();

        $req = $connexion->prepare(
            "SELECT * FROM Deck WHERE Id_Utilisateur = :id_utilisateur"
        );

        $req->bindParam(':id_utilisateur', $idUtilisateur);

        $req->execute();

        return $req;
    }

    public static function SupprimerDeck($idDeck)
    {
        $connexion = BD::ObtenirConnexion();

        $req = $connexion->prepare(
            "DELETE FROM Deck WHERE Id_Deck = :id_deck"
        );

        $req->bindParam(':id_deck', $idDeck);

        $req->execute();
    }   
}

?>