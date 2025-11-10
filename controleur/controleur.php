<?php
session_start();
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
$pagesPubliques = ['accueil', 'connexion', 'inscription'];

$action = $_GET['action'] ?? 'accueil';

$connecte = $_SESSION['utilisateur'] ?? false;
if (!$connecte && !in_array($action, $pagesPubliques)) {
    header('Location: index.php?action=connexion');
    exit;
}
if ($_GET['action'] === 'inscrire') {
    // Démarre la session si pas déjà fait
    session_start();

    // Récupération des données du formulaire
    $nom = $_POST['nom'] ?? '';
    $motDePasse = $_POST['motDePasse'] ?? '';
    $confirmation = $_POST['confirmationMotDePasse'] ?? '';

    // Tableau pour stocker les erreurs
    $_SESSION['erreurs'] = [];

    // Vérification du mot de passe avec regex
    $pattern = '/^(?=.*[A-Z])(?=.*[a-z])(?=.*\d)(?=.*[\W_]).{8,}$/';
    if (!preg_match($pattern, $motDePasse)) {
        $_SESSION['erreurs'][] = "Le mot de passe doit contenir au moins 8 caractères, dont une majuscule, une minuscule, un chiffre et un caractère spécial.";
    }

    // Vérifier que la confirmation correspond
    if ($motDePasse !== $confirmation) {
        $_SESSION['erreurs'][] = "La confirmation du mot de passe ne correspond pas.";
    }

    // Vérifier si le nom est vide ou déjà pris, etc...
    if (empty($nom)) {
        $_SESSION['erreurs'][] = "Le nom d'utilisateur est requis.";
    }

    // Si aucune erreur, on peut enregistrer l'utilisateur en base
    if (empty($_SESSION['erreurs'])) {
        // Code pour enregistrer l'utilisateur...
        header('Location: index.php?action=connexion');
        exit;
    } else {
        // Rediriger vers l'inscription pour afficher les erreurs
        header('Location: index.php?action=inscription');
        exit;
    }
} // aider par chatgpt
switch ($action) {
    case 'accueil':
        afficherPageAccueil();
        break;
    case 'deck':
        afficherDecksBuilder();
        break;
    case 'clan':
        afficherClan();
        break;
    case 'inscription':
        require 'vue/inscription.php';
        break;
    case 'connexion':
        require 'vue/connexion.php';
        break;
    default:
        afficherPageAccueil();
        break;
} // Fait par ChatGPT