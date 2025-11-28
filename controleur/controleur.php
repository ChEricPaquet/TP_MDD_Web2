<?php

require_once 'modele/modeleClan.php';
require_once 'modele/modeleUtilisateurs.php';
require_once 'modele/modeleInvitation.php';
require_once 'modele/modeleCommentaire.php';
require_once 'modele/modeleDeck.php';

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
    try {
        $UtilisateurInvite = ModeleUtilisateurs::ObtenirUtilisateur($_POST['nomUtilisateur']);
        $utilisateurInvite = $UtilisateurInvite->fetch();

        if ($utilisateurInvite != null) {
            ModeleInvitation::AjouterInvitation($_SESSION['utilisateur']['Id_Utilisateur'], $utilisateurInvite['Id_Utilisateur'], $_POST['Id_Clan']);
        }
    } catch (PDOException $e) {
        $_SESSION['erreurs'] = ["Impossible d'envoyer l'invitation : " . $e->getMessage()];
        http_response_code(400);
        echo json_encode($_SESSION['erreurs']);
        exit;
    }
}

function ajouterCommentaire()
{
    ModeleCommentaire::AjouterCommentaire($_SESSION['utilisateur']['Id_Utilisateur'], $_POST['commentaire'], $_POST['Id_Clan']);
}

function supprimerCommentaire()
{
    ModeleCommentaire::SupprimerCommentaire($_POST['id_commentaire']);
}

function sauvegarderDeck()
{
    $id_Deck = ModeleDeck::AjouterDeck($_POST['visibilite'],$_SESSION['utilisateur']['Id_Utilisateur']);
    $tableauDeck = json_decode($_POST['tableauDeck'], true);
    for ($compteur=0; $compteur <= count($tableauDeck); $compteur++) { 
        ModeleDeck::AjouterCarteDeck($tableauDeck[$compteur],$id_Deck);
    };
    
}

function rejoindreClan()
{
    // Ajout de l'utilisateur dans la base de données
    try {
        ModeleClan::AjouterUtilisateurClan($_SESSION['utilisateur']['Id_Utilisateur'], $_POST['Id_Clan'], 1);
        echo "Rejoint le clan avec succès.";
        exit;
    } catch (Exception $e) {
        if ($e->getCode() == 23000) {  // CHAPTGPT: code d'erreur pour erreur de clé primaire/unique
            if (str_contains($e->getMessage(), "1062")) {
                $_SESSION['erreurs'] = ["Impossible de rejoindre : Vous etes deja dans ce clan."];
                http_response_code(400);
                echo json_encode($_SESSION['erreurs']);
                exit;
            }
        }
        $_SESSION['erreurs'] = ["Impossible de rejoindre le clan : " . $e->getMessage()];
        http_response_code(400);
        echo json_encode($_SESSION['erreurs']);
        exit;
    }
}

function accepterInvitation()
{
    try {
        $invitationRequete = ModeleInvitation::ObtenirInvitationParId($_POST['Id_Invitation']);
        $invitation = $invitationRequete->fetch();
        if (!$invitation) {
            throw new Exception("Invitation non trouvée.");
        }
        ModeleClan::AjouterUtilisateurClan($invitation['Id_Utilisateur_1'], $invitation['Id_Clan'], 1);
        ModeleInvitation::SupprimerInvitation($_POST['Id_Invitation']);
    } catch (Exception $e) {
        if ($e->getCode() == 23000) {  // CHAPTGPT: code d'erreur pour erreur de clé primaire/unique
            if (str_contains($e->getMessage(), "1062")) {
                $_SESSION['erreurs'] = ["Impossible d'accepter l'invitation : Vous etes deja dans ce clan."];
                http_response_code(400);
                echo json_encode($_SESSION['erreurs']);
                exit;
            }
        }
        $_SESSION['erreurs'] = ["Impossible d'accepter l'invitation : " . $e->getMessage()];
        http_response_code(400);
        echo json_encode($_SESSION['erreurs']);
        exit;
    }
}


function refuserInvitation()
{
    try {
        ModeleInvitation::SupprimerInvitation($_POST['Id_Invitation']);
    } catch (Exception $e) {
        $_SESSION['erreurs'] = ["Impossible de refuser l'invitation : " . $e->getMessage()];
        http_response_code(400);
        echo json_encode($_SESSION['erreurs']);
        exit;
    }
}

function quitterClan()
{
    try {
        ModeleClan::SupprimerUtilisateurClan($_SESSION['utilisateur']['Id_Utilisateur'], $_POST['Id_Clan']);
    } catch (Exception $e) {
        $_SESSION['erreurs'] = ["Impossible de quitter le clan : " . $e->getMessage()];
        http_response_code(400);
        echo json_encode($_SESSION['erreurs']);
        exit;
    }
}

function ajoutClan()
{
    try{
        ModeleClan::AjouterClan($_POST['nomClan'], $_POST['descriptionClan']);
    } catch (Exception $e) {
        $_SESSION['erreurs'] = ["Impossible de créer un clan : " . $e->getMessage()];
        http_response_code(400);
        echo json_encode($_SESSION['erreurs']);
    exit;
    }
}
