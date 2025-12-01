<?php
require_once "modele/bd.php";

class ModeleClan
{
    public static function AjouterUtilisateurClan($idUtilisateur, $idClan, $idRole)
    {
        if (self::NombreUtilisateursClan($idClan)) {
            throw new Exception("Le clan est plein.");
        }
        $connexion = BD::ObtenirConnexion();

        $req1 = $connexion->prepare(
            "SELECT * FROM UtilisateurClan WHERE Id_Utilisateur = :idUtilisateur"
        );
        $req1->bindParam(':idUtilisateur', $idUtilisateur);
        $req1->execute();
        if ($req1->rowCount() > 0) {
            $userclan = $req1->fetch();
            self::SupprimerUtilisateurClan($idUtilisateur, $userclan['Id_Clan']);
        }

        $req = $connexion->prepare(
            "INSERT INTO UtilisateurClan (Id_Utilisateur, Id_Clan, Id_Role) VALUES (:idUtilisateur, :idClan, :idRole)"
        );

        $req->bindParam(':idUtilisateur', $idUtilisateur);
        $req->bindParam(':idClan', $idClan);
        $req->bindParam(':idRole', $idRole);

        $req->execute();

        return $connexion->lastInsertId();
    }

    public static function SupprimerUtilisateurClan($idUtilisateur, $idClan)
    {
        $connexion = BD::ObtenirConnexion();

        $req = $connexion->prepare(
            "DELETE FROM UtilisateurClan WHERE Id_Clan = :idClan AND Id_Utilisateur = :idUtilisateur"
        );

        $req->bindParam(':idClan', $idClan);
        $req->bindParam(':idUtilisateur', $idUtilisateur);


        $req->execute();

        $utilisateurs = self::ObtenirUtilisateursClan($idClan);

        if ($utilisateurs->rowCount() == 0) {
            self::SupprimerClan($idClan);
        }
    }

    public static function AjouterClan($nom, $description, $prive)
    {
        $connexion = BD::ObtenirConnexion();

        $req = $connexion->prepare(
            "INSERT INTO Clan (nom_clan, description_clan, prive) VALUES (:nom_clan, :description_clan, :prive)"
        );

        $req->bindParam(':nom_clan', $nom);
        $req->bindParam(':description_clan', $description);
        $req->bindParam(':prive', $prive);

        $req->execute();

        return $connexion->lastInsertId();
    }


    public static function SupprimerClan($idClan)
    {
        $connexion = BD::ObtenirConnexion();

        $req1 = $connexion->prepare(
            "DELETE FROM Clan WHERE Id_Clan = :idClan"

        );

        $req1->bindParam(':idClan', $idClan);

        $req1->execute();

        $req2 = $connexion->prepare(
            "DELETE FROM UtilisateurClan WHERE Id_Clan = :idClan"
        );

        $req2->bindParam(':idClan', $idClan);

        $req2->execute();
    }

    public static function ObtenirClanParId($idClan)
    {
        $connexion = BD::ObtenirConnexion();

        $req = $connexion->prepare(
            "SELECT * FROM Clan WHERE Id_Clan = :Id_Clan"
        );

        $req->bindParam(':Id_Clan', $idClan);

        $req->execute();

        return $req;
    }

    public static function ObtenirClanParNom($nomClan)
    {
        $connexion = BD::ObtenirConnexion();

        $req = $connexion->prepare(
            "SELECT * FROM Clan WHERE nom_clan = :nom_clan"
        );

        $req->bindParam(':nom_clan', $nomClan);

        $req->execute();

        return $req;
    }

    public static function ObtenirTous()
    {
        $connexion = BD::ObtenirConnexion();

        $req = $connexion->prepare(
            "SELECT * FROM Clan"
        );

        $req->execute();

        return $req;
    }

    public static function ObtenirClanUtilisateur($idUtilisateur)
    {
        $connexion = BD::ObtenirConnexion();

        $req = $connexion->prepare(
            "SELECT * FROM Clan 
            JOIN UtilisateurClan ON Clan.Id_Clan = UtilisateurClan.Id_Clan 
            WHERE UtilisateurClan.Id_Utilisateur = :Id_Utilisateur"
        );

        $req->bindParam(':Id_Utilisateur', $idUtilisateur);

        $req->execute();

        return $req;
    }

    public static function ObtenirUtilisateursClan($idClan)
    {
        $connexion = BD::ObtenirConnexion();

        $req = $connexion->prepare("SELECT Id_Utilisateur, Id_Role FROM UtilisateurClan WHERE Id_Clan = :idClan");

        $req->bindParam(':idClan', $idClan);

        $req->execute();

        return $req;
    }

    public static function ObtenirRoleNom($id_role)
    {
        $connexion = BD::ObtenirConnexion();

        $req = $connexion->prepare("SELECT role FROM Role WHERE Id_Role = :id_role");

        $req->bindParam(':id_role', $id_role);

        $req->execute();

        return $req;
    }

    public static function NombreUtilisateursClan($idClan)
    {
        $connexion = BD::ObtenirConnexion();

        $req = $connexion->prepare(
            "SELECT COUNT(*) AS nombre FROM UtilisateurClan WHERE Id_Clan = :idClan"
        );

        $req->bindParam(':idClan', $idClan);
        $req->execute();
        //ChatGPT obtenir le nombre de personne dans le clan
        $result = $req->fetch(PDO::FETCH_ASSOC);

        return ($result['nombre'] >= 50);
    }


    public static function ModifierRole($idUtilisateur, $valeurRole)
    {
        $connexion = BD::ObtenirConnexion();

        $req = $connexion->prepare(
            "UPDATE UtilisateurClan SET Id_Role = :id_Role WHERE Id_Utilisateur = :idUtilisateur"
        );

        $req->bindParam(':idUtilisateur', $idUtilisateur);

        $req->bindParam(':id_Role', $valeurRole);

        $req->execute();
    }

    //ChatGPT Fonction pour remplacer chef
    public static function PromouvoirNouveauChef($idClan)
    {
        $connexion = BD::ObtenirConnexion();

        // Find the next highest role (3, then 2, then 1)
        $req = $connexion->prepare("
        SELECT Id_Utilisateur, Id_Role 
        FROM UtilisateurClan
        WHERE Id_Clan = :idClan
        ORDER BY Id_Role DESC
        LIMIT 1
    ");

        $req->bindParam(':idClan', $idClan);
        $req->execute();
        $nouveauChef = $req->fetch();

        if ($nouveauChef) {
            // Promote to leader (role 4)
            $update = $connexion->prepare("
            UPDATE UtilisateurClan 
            SET Id_Role = 4 
            WHERE Id_Utilisateur = :idUtilisateur
        ");

            $update->bindParam(':idUtilisateur', $nouveauChef['Id_Utilisateur']);
            $update->execute();
        }
    }
}
