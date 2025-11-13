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

        public static function suprimerUtilisateurClan($idUtilisateur, $idClan)
    {
        $connexion = BD::ObtenirConnexion();
        
        $req = $connexion->prepare(
            "DELETE FROM clan WHERE idClan = :idClan"
        );

        $req->execute();
    }
}
?>