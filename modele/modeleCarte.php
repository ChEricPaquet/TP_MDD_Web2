<?php
require_once "modele/bd.php";

class ModeleCarte
{
    public static function ObtenirParId($id)
    {
        $connection = BD::ObtenirConnexion();

        $req = $connection->prepare(
            "SELECT * FROM carte WHERE id_carte = :id_carte"
        );

        $req->bindParam('id_carte', $id);

        $req->execute();

        return $req;
    }

    public static function ObtenirTout()
    {
        $connection = BD::ObtenirConnexion();

        $req = $connection->prepare(
            "SELECT * FROM carte"
        );

        $req->bindParam('id_carte', $id);

        $req->execute();

        return $req;
    }
}
?>