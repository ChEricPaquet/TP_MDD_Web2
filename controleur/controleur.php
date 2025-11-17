<?php
function afficherPageAccueil()
{
    require 'vue/accueil.php';
}
function afficherDecksBuilder()
{
    require 'vue/deck.php';
}
function afficherClan()
{
    require 'vue/clan.php';
}
function afficherClanDesc()
{
    // Vérifier que l'ID du clan est fourni et valide CHATGPT
    if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
       // Ajouter une gestion d'erreur appropriée ici
    }
    require 'vue/clanDescriptif.php';
}