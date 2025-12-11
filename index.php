<?php
date_default_timezone_set('America/Toronto');

// La première chose qu'on fait à chaque requête est de démarrer la session.
// Ainsi, on peut accéder aux variables de session dans tout le site.
session_start();

require_once 'controleur/controleur.php';
require_once 'controleur/controleurUtilisateurs.php';
require_once 'controleur/controleurUtils.php';

try {
    if (!isset($_GET['action'])) {
        afficherPageAccueil();
        return;
    }

    switch ($_GET['action']) {
        case 'afficherPageAccueil':
            afficherPageAccueil();
            break;
        case 'afficherPageConnexion':
            afficherPageConnexion();
            break;
        case 'afficherPageInscription':
            afficherPageInscription();
            break;
        case 'afficherPageProfil':
            afficherPageProfil();
            break;
        case 'afficherPageCreationClan':
            afficherPageCreationClan();
            break;
        case 'connecter':
            connecter();
            break;
        case 'inscription':
            inscription();
            break;
        case 'deconnecter':
            deconnecter();
            break;
        case 'afficherDecksBuilder':
            afficherDecksBuilder();
            break;
        case 'afficherClan':
            afficherClan();
            break;
        case 'afficherClanDesc':
            $id = $_GET['id'];
            afficherClanDesc($id);
            break;
        case 'afficherInvitations':
            afficherInvitations();
            break;
        case 'envoyerInvitation':
            envoyerInvitation();
            break;
        case 'ajouterCommentaire':
            ajouterCommentaire();
            break;
        case 'supprimerCommentaire':
            supprimerCommentaire();
            break;
        case 'sauvegarderDeck':
            sauvegarderDeck();
            break;
        case 'rejoindreClan':
            rejoindreClan(null, null);
            break;
        case 'accepterInvitation':
            accepterInvitation();
            break;
        case 'refuserInvitation':
            refuserInvitation();
            break;
        case 'quitterClan':
            quitterClan();
            break;
        case 'ajoutClan':
            ajoutClan();
            break;
        case 'changerRole':
            changerRole();
            break;
        case 'afficherClanUtilisateur':
            afficherClanUtilisateur();
            break;
        case 'supprimerDeck':
            supprimerDeck();
            break;
        default:
            http_response_code(404);
            throw new Exception('404 : Action non supportée');
    }
} catch (PDOException $e) {
    if (http_response_code() < 400) {
        http_response_code(500);
    }
    $msgErreur = $e->getMessage();
    require 'vue/erreur.php';
} catch (Exception $ex) {
    if (http_response_code() < 400) {
        http_response_code(500);
    }
    $msgErreur = $ex->getMessage();
    require 'vue/erreur.php';
}
