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
    require 'vue/clanDescriptif.php';
}
function afficherInvitations()
{
    require 'vue/invitation.php';
}

function envoyerInvitation()
{
    //ChatGPT ajouter beaucoup de validations
    try {
        if (!isset($_POST['nomUtilisateur'], $_POST['Id_Clan'])) {
            http_response_code(400);
            echo "Requête invalide.";
            return;
        }

        $nom = trim($_POST['nomUtilisateur']);
        $idClan = intval($_POST['Id_Clan']);

        // Vérifier si l'utilisateur existe
        $UtilisateurInvite = ModeleUtilisateurs::ObtenirUtilisateur($nom);
        $utilisateurInvite = $UtilisateurInvite->fetch();

        if (!$utilisateurInvite) {
            http_response_code(400);
            echo "Cet utilisateur n'existe pas.";
            return;
        }

        // Empêcher d’envoyer une invitation à soi-même
        if ($utilisateurInvite['Id_Utilisateur'] == $_SESSION['utilisateur']['Id_Utilisateur']) {
            http_response_code(400);
            echo "Vous ne pouvez pas vous inviter vous-même.";
            return;
        }

        // Vérifier si l'utilisateur est déjà dans le clan
        $clanExistant = ModeleClan::ObtenirClanUtilisateur($utilisateurInvite['Id_Utilisateur'])->fetch();
        if ($clanExistant && $clanExistant['Id_Clan'] == $idClan) {
            http_response_code(400);
            echo "Cet utilisateur fait déjà partie du clan.";
            return;
        }

        // Ajouter l’invitation
        ModeleInvitation::AjouterInvitation(
            $_SESSION['utilisateur']['Id_Utilisateur'],
            $utilisateurInvite['Id_Utilisateur'],
            $idClan
        );

        // Succès
        http_response_code(200);
        echo "Invitation envoyée!";

    } catch (PDOException $e) {
        http_response_code(500);
        echo "Erreur serveur : " . htmlspecialchars($e->getMessage());
    }
}


function ajouterCommentaire()
{
    try {
        $Idcommentaire = ModeleCommentaire::AjouterCommentaire($_SESSION['utilisateur']['Id_Utilisateur'], $_POST['commentaire'], $_POST['id_deck']);
        //ChatGPT CONTROLLER MUST RETURN THE HTML OF THE NEW COMMENT
        echo "
        <div class='commentaire bg-blue-800 p-2 mt-2 rounded'>
            <strong>" . htmlspecialchars($_SESSION['utilisateur']['nom']) . "</strong>
            <span class='text-muted small'>" . date('Y-m-d H:i:s') . "</span>
            <p class='m-0'>" . htmlspecialchars($_POST['commentaire']) . "</p>
            <button class='btn btn-danger btn-sm mt-2 supprimer-commentaire' data-id='" . $Idcommentaire . "'>
                Supprimer
            </button>
        </div>
        ";
    } catch (PDOException $e) {
        echo $e->getMessage();
    }

}

function supprimerCommentaire()
{
    try {
        ModeleCommentaire::SupprimerCommentaire($_POST['id_commentaire']);
        echo "OK";
    } catch (PDOException $e) {
        http_response_code(400);
        echo $e->getMessage();
    }
}


function sauvegarderDeck()
{
    $id_Deck = ModeleDeck::AjouterDeck($_POST['visibilite'],$_SESSION['utilisateur']['Id_Utilisateur']);
    $tableauDeck = json_decode($_POST['tableauDeck'], true);
    for ($compteur=0; $compteur <= count($tableauDeck); $compteur++) { 
        ModeleDeck::AjouterCarteDeck($tableauDeck[$compteur],$id_Deck);
    };
    
}

function supprimerDeck()
{
    try {
        ModeleDeck::SupprimerDeck($_POST['id_deck']);
        echo "OK";
    } catch (PDOException $e) {
        http_response_code(400);
        echo $e->getMessage();
    }
}

function rejoindreClan($idClan, $idRole)
{   
    if ($idRole == null) {
        $idRole = 1;
    }
    if($idClan == null)
    {
        $idClan = $_POST['Id_Clan'];
    }
    // Ajout de l'utilisateur dans la base de données
    try {
        ModeleClan::AjouterUtilisateurClan($_SESSION['utilisateur']['Id_Utilisateur'], $idClan, $idRole);
        echo "Rejoint le clan avec succès.";
    } catch (Exception $e) {
        if ($e->getCode() == 23000) {  // CHAPTGPT: code d'erreur pour erreur de clé primaire/unique
            if (str_contains($e->getMessage(), "1062")) {
                $_SESSION['erreurs'] = "Impossible de rejoindre : Vous etes deja dans ce clan.";
                http_response_code(400);
                echo json_encode($_SESSION['erreurs']);
                exit;
            }
        }
        $_SESSION['erreurs'] = "Impossible de rejoindre le clan : " . $e->getMessage();
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
                $_SESSION['erreurs'] = "Impossible d'accepter l'invitation : Vous etes deja dans ce clan.";
                http_response_code(400);
                echo json_encode($_SESSION['erreurs']);
                exit;
            }
        }
        $_SESSION['erreurs'] = "Impossible d'accepter l'invitation : " . $e->getMessage();
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
        $_SESSION['erreurs'] = "Impossible de refuser l'invitation : " . $e->getMessage();
        http_response_code(400);
        echo json_encode($_SESSION['erreurs']);
        exit;
    }
}

function quitterClan()
{
    try {
        $utilisateurRequete = ModeleClan::ObtenirClanUtilisateur($_SESSION['utilisateur']['Id_Utilisateur']);
        $utilisateur = $utilisateurRequete->fetch();
        ModeleClan::SupprimerUtilisateurClan($_SESSION['utilisateur']['Id_Utilisateur'], $_POST['Id_Clan']);
        if ($utilisateur && $utilisateur['Id_Role'] == 4) {
            ModeleClan::PromouvoirNouveauChef($_POST['Id_Clan']);
        }
    } catch (Exception $e) {
        $_SESSION['erreurs'] = "Impossible de quitter le clan : " . $e->getMessage();
        http_response_code(400);
        echo json_encode($_SESSION['erreurs']);
        exit;
    }
}

function ajoutClan()
{
    try{
        $idClan = ModeleClan::AjouterClan($_POST['nomClan'], $_POST['descriptionClan'], $_POST['prive']);
        rejoindreClan($idClan, 4);
    } catch (Exception $e) {
 if ($e->getCode() == 23000) {  // CHAPTGPT: code d'erreur pour erreur de clé primaire/unique
            if (str_contains($e->getMessage(), "1062")) {
                $_SESSION['erreurs'] = 'Impossible de creer ce clan : Il existe deja.';
                http_response_code(400);
                echo json_encode($_SESSION['erreurs']);
                exit;
            }
        }
        $_SESSION['erreurs'] = "Impossible de creer le clan : " . $e->getMessage();
        http_response_code(400);
        echo json_encode($_SESSION['erreurs']);
        exit;
    }
}
// ChatGPT if the user makes another player the chef they will themselves become a chef adjoint
function changerRole() {
    try {
        $idUtilisateur = $_POST['idUtilisateur'];
        $idRole = intval($_POST['idRole']);
        $idClan = intval($_POST['idClan']);

        // Get current user info
        $currentUserId = $_SESSION['utilisateur']['Id_Utilisateur'];
        $currentUserClan = ModeleClan::ObtenirClanUtilisateur($currentUserId)->fetch();

        if (!$currentUserClan || $currentUserClan['Id_Clan'] != $idClan) {
            http_response_code(400);
            echo "Vous n'êtes pas dans ce clan.";
            return;
        }

        // Promote the target user
        ModeleClan::ModifierRole($idUtilisateur, $idRole);

        // If the new role is Chef (4) and it's not the current user
        if ($idRole === 4 && $idUtilisateur != $currentUserId) {
            ModeleClan::ModifierRole($currentUserId, 3); // Current user becomes Chef-Adjoint
        }

        http_response_code(200);
        echo "OK";

    } catch (Exception $e) {
        http_response_code(400);
        echo "Erreur : " . $e->getMessage();
    }
}




function afficherClanUtilisateur(){
    $utilisateurRequete = ModeleClan::ObtenirClanUtilisateur($_SESSION['utilisateur']['Id_Utilisateur']);
    $utilisateur = $utilisateurRequete->fetch();

    if ($utilisateur != null) {
        afficherClanDesc($utilisateur['Id_Clan']);
        return;
    }

    header("Location: index.php?action=afficherPageAccueil");
    exit;
}
