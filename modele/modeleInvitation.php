<?php
require_once "modele/bd.php";
class ModeleInvitation
{
    public static function AjouterInvitation($idUtilisateur, $idUtilisateur2, $idClan)
    {
        if ($idUtilisateur == $idUtilisateur2) {
            return null; 
        }
        $connexion = BD::ObtenirConnexion();
        // Vérifier si une invitation existe déjà entre les deux utilisateurs pour le même clan
        $req1 = $connexion->prepare(
            "SELECT * FROM Invitation WHERE Id_Utilisateur = :idUtilisateur AND Id_Utilisateur_1 = :idUtilisateur2 AND Id_Clan = :idClan"
        );
        $req1->bindParam(':idUtilisateur', $idUtilisateur);
        $req1->bindParam(':idUtilisateur2', $idUtilisateur2);
        $req1->bindParam(':idClan', $idClan);
        $req1->execute();
        if ($req1->rowCount() > 0) {
            return null;
        }
        $req = $connexion->prepare(
            "INSERT INTO Invitation (Id_Utilisateur, Id_Utilisateur_1, Id_Clan) VALUES (:idUtilisateur, :idUtilisateur2, :idClan)"
        );

        $req->bindParam(':idUtilisateur', $idUtilisateur);
        $req->bindParam(':idUtilisateur2', $idUtilisateur2);
        $req->bindParam(':idClan', $idClan);

        $req->execute();

        return $connexion->lastInsertId();
    }

    public static function SupprimerInvitation($idInvitation)
    {
        $connexion = BD::ObtenirConnexion();

        $req = $connexion->prepare(
            "DELETE FROM Invitation WHERE Id_Invitation = :idInvitation"
        );

        $req->bindParam(':idInvitation', $idInvitation);

        $req->execute();
    }
    

    public static function ObtenirInvitationsParUtilisateur($idUtilisateur)
    {
        $connexion = BD::ObtenirConnexion();

        $req = $connexion->prepare(
            "SELECT * FROM Invitation WHERE Id_Utilisateur_1 = :idUtilisateur"
        );

        $req->bindParam(':idUtilisateur', $idUtilisateur);

        $req->execute();

        return $req;
    }

    public static function ObtenirInvitationParId($idInvitation)
    {
        $connexion = BD::ObtenirConnexion();

        $req = $connexion->prepare(
            "SELECT * FROM Invitation WHERE Id_Invitation = :idInvitation"
        );

        $req->bindParam(':idInvitation', $idInvitation);

        $req->execute();

        return $req;
    }
}
?>