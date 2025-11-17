<?php
require_once "modele/bd.php";
class ModeleInvitation
{
    public static function AjouterInvitation($idUtilisateur, $idUtilisateur2, $idClan)
    {
        $connexion = BD::ObtenirConnexion();

        $req = $connexion->prepare(
            "INSERT INTO Invitation (Id_Utilisateur, Id_Utilisateur_1, Id_Clan) VALUES (:idUtilisateur, :idUtilisateur2, :idClan)"
        );

        $req->bindParam(':idUtilisateur', $idUtilisateur);
        $req->bindParam(':idUtilisateur2', $idUtilisateur2);
        $req->bindParam(':idClan', $idClan);

        $req->execute();

        return $connexion->lastInsertId();
    }

    public static function SupprimerInvitation($idUtilisateur, $idClan)
    {
        $connexion = BD::ObtenirConnexion();
        
        $req = $connexion->prepare(
            "DELETE FROM Invitation WHERE Id_Clan = :idClan AND Id_Utilisateur = :idUtilisateur"
        );

        $req->bindParam(':idClan', $idClan);
        $req->bindParam(':idUtilisateur', $idUtilisateur);
        $req->execute();
    }

    public static function ObtenirInvitationsParUtilisateur($idUtilisateur)
    {
        $connexion = BD::ObtenirConnexion();

        $req = $connexion->prepare(
            "SELECT * FROM Invitation WHERE Id_Utilisateur = :idUtilisateur"
        );

        $req->bindParam(':idUtilisateur', $idUtilisateur);

        $req->execute();

        return $req;
    }
}
?>