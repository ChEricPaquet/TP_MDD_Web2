<?php
require_once "modele/modeleUtilisateurs.php";

function afficherPageConnexion()
{
    require 'vue/connexion.php';
}

function afficherPageInscription()
{
    require 'vue/inscription.php';
}

function afficherPageProfil()
{
    bloquerSiNonConnecte();

    $id = $_SESSION['utilisateur']['Id_Utilisateur'];
    if (!empty($_GET['id'])) {
        $id = $_GET['id'];   
    }
    // Afficher la page de profil
    require 'vue/profil.php';
}


function validerDonneesAuthentification()
{
    $erreurs = [];
    if (empty($_POST['nom']) || mb_strlen($_POST['nom']) < 3 || mb_strlen($_POST['nom']) > 45) {
        $erreurs[] = 'Le nom d\'utilisateur est requis et doit contenir entre 3 et 45 caractères.';
    }
    if (empty($_POST['motDePasse']) || mb_strlen($_POST['motDePasse']) < 6 || mb_strlen($_POST['motDePasse']) > 45 || !preg_match("/^(?=.*[A-Z])(?=.*[a-z])(?=.*\d)(?=.*[\W_])(?!.*\s).{8,}$/", $_POST['motDePasse'])) {
        $erreurs[] = 'Le mot de passe doit contenir au moins 8 caractères, dont une majuscule, une minuscule, un chiffre et un caractère spécial.';
    }
    return $erreurs;
}

function connecter()
{
    $erreurs = validerDonneesAuthentification();
    if (!empty($erreurs)) {
        retournerMessageErreurAJAX($erreurs);
    }

    // Vérification des informations d'identification
    $requeteUtilisateurs = ModeleUtilisateurs::obtenirUtilisateur($_POST['nom']);
    $utilisateur = $requeteUtilisateurs->fetch();
    if (!$utilisateur || !password_verify($_POST['motDePasse'], $utilisateur['mot_de_passe'])) {
        retournerMessageErreurAJAX(['Nom d\'utilisateur ou mot de passe incorrect.']);
    }

    // Stocker les informations de l'utilisateur dans la session
    $_SESSION['utilisateur'] = $utilisateur;
    unset($_SESSION['utilisateur']['mot_de_passe']); // Ne pas stocker le mot de passe en session

    // Retour d'une alert de succès au client AJAX
    require 'vue/connexionSucces.php';
}

function inscription()
{
    $erreurs = validerDonneesAuthentification();
    if (!empty($erreurs)) {
        // Ajout des erreurs à la session pour les afficher sur la page d'inscription
        $_SESSION['erreurs'] = $erreurs;
        header('Location: index.php?action=afficherPageInscription');
        exit;
    }

    try {
        // Ajout de l'utilisateur dans la base de données
        ModeleUtilisateurs::ajouterUtilisateur($_POST['nom'], password_hash($_POST['motDePasse'], PASSWORD_DEFAULT));
        // Après une inscription réussie, connecter automatiquement l'utilisateur
        connecter();
    } catch (PDOException $e) {
        // Gérer l'erreur, par exemple si le nom d'utilisateur est déjà pris
        $_SESSION['erreurs'] = ['Le nom d\'utilisateur est déjà pris. Veuillez en choisir un autre.'];
        header('Location: index.php?action=afficherPageInscription');
        exit;
    }
}

function deconnecter()
{
    // Vider les données de la session
    session_unset();
    // Détruire la session pour déconnecter l'utilisateur
    session_destroy();
    // Rediriger vers la page d'accueil après la déconnexion
    header('Location: index.php?action=afficherPageAccueil');
    exit;
}
