<?php
require_once "modele/bd.php";

class modeleCommentaire{
    public static function AjouterCommentaire($id_Utilisateur,$texte,$id_Deck){
        $connexion = BD::ObtenirConnexion();

        $req = $connexion->prepare(
                "INSERT INTO Commentaire (id_utilisateur, texte, id_deck) VALUES (id_utilisateur :idUtilisateur, texte :texte, id_deck :idDeck)"
        );

        $req->bindParam(':idUtilisateur', $id_Utilisateur);
        $req->bindParam(':texte', $texte);
        $req->bindParam(':idDeck', $id_Deck);
        


        $req->execute();

        return $connexion->lastInsertId();
    }
}
?>