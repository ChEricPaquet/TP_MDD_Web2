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

    public static function ObtenirCarteDeckParDeck($idDeck)
    {
        $connexion = BD::ObtenirConnexion();

        $req = $connexion->prepare(
            "SELECT c.* FROM Carte c JOIN CarteDeck cd ON c.Id_Carte = cd.Id_Carte WHERE cd.Id_Deck = :id_deck"
        );

        $req->bindParam(':id_deck', $idDeck);

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

    public static function NombreCarte($idDeck)
    {
        $connexion = BD::ObtenirConnexion();

        $req = $connexion->prepare(
                "SELECT COUNT(Id_Carte) AS nb FROM CarteDeck WHERE Id_Deck = :idDeck"
            );

        $req->bindParam(':idDeck', $idDeck, PDO::PARAM_INT);

        $req->execute();
        
        if($req->fetchColumn() == 8)
        {
            return false;
        }
        return true;
    }

    public static function AjouterCarteDeck($idCarte, $idDeck)
    {
        if (self::NombreCarte($idDeck) && self::NombreChampion($idCarte, $idDeck))
        {            
            $connexion = BD::ObtenirConnexion();

            $req = $connexion->prepare(
                "INSERT INTO CarteDeck (Id_Carte, Id_Deck) VALUES (:idCarte, :idDeck)"
            );

            $req->bindParam(':idCarte', $idCarte);
            $req->bindParam(':idDeck', $idDeck);

            $req->execute();

            return $connexion->lastInsertId();
        }
        return false;
    }

    public static function SupprimerCarteDeck($idCarte, $idDeck)
    {                
        $connexion = BD::ObtenirConnexion();
        $req = $connexion->prepare(
            "DELETE FROM CarteDeck WHERE Id_Carte = :idCarte AND Id_Deck = :idDeck"
        );

        $req->bindParam(':idCarte', $idCarte);
        $req->bindParam(':idDeck', $idDeck);

        $req->execute();

        return $connexion->lastInsertId();
    }
    
    public static function NombreChampion($idCarte, $idDeck)
    {
        $connexion = BD::ObtenirConnexion();
        $req = $connexion->prepare(
            "SELECT Id_Rarete FROM Carte c JOIN CarteDeck AS cd ON c.Id_Carte = cd.Id_Carte WHERE c.Id_Carte = :idCarte AND Id_Deck = :idDeck"
            
        );      

        $req->bindParam(':idCarte', $idCarte);
        $req->bindParam(':idDeck', $idDeck);

        $req->execute();

        if($req->fetchColumn() == 5)
        {
            return false;
        }
        return true;
    }
}
?>