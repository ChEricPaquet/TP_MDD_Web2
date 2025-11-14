<?php
require_once "modele/bd.php";

class modeleClan
{
    public static function ajouterUtilisateurClan($idUtilisateur, $idClan)
    {
        $connexion = BD::ObtenirConnexion();

        $req = $connexion->prepare(
            "INSERT INTO UtilisateurClan (id_Utilisateur, id_Clan) VALUES (id_Utilisateur :idUtilisateur,id_Clan :idClan)"
        );

        $req->bindParam(':idUtilisateur', $idUtilisateur);
        $req->bindParam(':idClan', $idClan);

        $req->execute();

        return $connexion->lastInsertId();
    }

    public static function supprimerUtilisateurClan($idUtilisateur, $idClan)
    {
        $connexion = BD::ObtenirConnexion();
        
        $req = $connexion->prepare(
            "DELETE FROM UtilisateurClan WHERE id_clan = :idClan AND id = :idUtilisateur"
        );

        $req->bindParam(':idClan', $idClan);
        $req->bindParam(':idUtilisateur', $idUtilisateur);


        $req->execute();
    }

    public static function ajouterClan($nom,$description)
    {
        $connexion = BD::ObtenirConnexion();

        $req = $connexion->prepare(
            "INSERT INTO Clan (nom_clan, description_clan) VALUES (nom_clan :nom_clan,description_clan :description_clan)"
        );

        $req->bindParam(':nom_clan', $nom);
        $req->bindParam(':description_clan', $description);

        $req->execute();

        return $connexion->lastInsertId();
    }


    public static function supprimerClan($idClan)
    {
        $connexion = BD::ObtenirConnexion();
        
        $req = $connexion->prepare(
            "DELETE FROM Clan WHERE id_clan = :idClan"
        );

        $req->bindParam(':idClan', $idClan);

        $req->execute();
    }
}
?>