<?php
require_once "modele/bd.php";


class ModeleCarte
{
    public static function ObtenirParId($id)
    {
        $connection = BD::ObtenirConnexion();

        $req = $connection->prepare(
            "SELECT * FROM Carte WHERE Id_Carte = :Id_Carte"
        );

        $req->bindParam(':Id_Carte', $id);

        $req->execute();

        return $req;
    }

    public static function ObtenirTout()
    {
        $connection = BD::ObtenirConnexion();

        $req = $connection->prepare(
            "SELECT * FROM Carte"
        );
        $req->execute();

        return $req;
    }
}
?>