<?php
require_once "modele/bd.php";

class ModeleCommentaire{
    public static function AjouterCommentaire($Id_Utilisateur,$texte,$id_Deck){
        $dateHeure = date_create('now');
        $connexion = BD::ObtenirConnexion();

        $req = $connexion->prepare(
            "INSERT INTO Commentaire (Id_Utilisateur, dateheure, texte, Id_Deck) VALUES (Id_Utilisateur :idUtilisateur, dateheure :dateheure, texte :texte, Id_Deck :idDeck)"
        );

        $req->bindParam(':idUtilisateur', $Id_Utilisateur);
        $req->bindParam(':dateheure', $dateHeure);
        $req->bindParam(':texte', $texte);
        $req->bindParam(':idDeck', $id_Deck);
        


        $req->execute();

        return $connexion->lastInsertId();
    }

    public static function ObtenirCommentairesParDeck($id_Deck){
        $connexion = BD::ObtenirConnexion();

        $req = $connexion->prepare(
                "SELECT * FROM Commentaire WHERE Id_Deck = :idDeck"
        );

        $req->bindParam(':idDeck', $id_Deck);

        $req->execute();

        return $req;
    }

    public static function SupprimerCommentaire($id_Commentaire){
        $connexion = BD::ObtenirConnexion();

        $req = $connexion->prepare(
                "DELETE FROM Commentaire WHERE Id_Commentaire = :idCommentaire"
        );

        $req->bindParam(':idCommentaire', $id_Commentaire);

        $req->execute();
    }

    
    public static function ObtenirTousLesCommentaires($id_Deck)
    {
        $connexion = BD::ObtenirConnexion();

        $req = $connexion->prepare(
            "SELECT * FROM Commentaire WHERE Id_Deck = :id_Deck"
        );

        $req->bindParam(':id_Deck', $id_Deck);

        $req->fetch();
    }
}
?>