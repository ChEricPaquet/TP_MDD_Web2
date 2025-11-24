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
function afficherClanDesc($id)
{
    // Vérifier que l'ID du clan est fourni et valide CHATGPT
    if (!isset($id) || !is_numeric($id)) {
       // Ajouter une gestion d'erreur appropriée ici
    }
    require 'vue/clanDescriptif.php';
}
function afficherInvitations()
{
    require 'vue/invitation.php';
}

function envoyerInvitation()
{
    $UtilisateurInvite = ModeleUtilisateurs::ObtenirUtilisateur($_POST['nomUtilisateur']);
    $utilisateurInvite = $UtilisateurInvite->fetch();
    if ($utilisateurInvite) {
        ModeleInvitation::AjouterInvitation($_SESSION['utilisateur']['Id_Utilisateur'], $utilisateurInvite['Id_Utilisateur'], $_SESSION['Clan']['Id_Clan']);
    }
}

function ajouterCommentaire()
{
    ModeleCommentaire :: AjouterCommentaire($_SESSION['utilisateur']['Id_Utilisateur'], $_POST['commentaire'], $_POST['id_clan']);
}