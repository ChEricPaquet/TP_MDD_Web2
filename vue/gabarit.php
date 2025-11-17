<?php
// Le gabarit est le modèle de page HTML utilisé pour toutes les pages de l'application.
// Il définit la structure de base de la page, y compris l'en-tête, le pied de page et la zone de contenu principal.
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Luckiest+Guy&display=swap" rel="stylesheet">

    <!-- Bootstrap 5 JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
    <script src="js/bootstrap.js"></script>
    <title>
        <?php
        // Utilisation de la variable $titreOnglet définie dans chaque vue spécifique pour le titre de l'onglet.
        echo $titreOnglet;
        ?>
    </title>
</head>

<body class="d-flex flex-column min-vh-100 p-0 m-0">
    <header class="bg-primary">
        <?php
        // Chargement du menu de navigation.
        // Le menu est responsable de l'affichage des liens de navigation.
        // Toutes les pages de l'application utilisent ce menu.
        require_once 'vue/menu.php';
        ?>
    </header>
    <main class="pt-2 flex-fill bg-light">
        <?php
        // Zone de contenu principal.
        // Affichage du contenu spécifique à chaque page.
        // Le contenu est récupéré depuis la variable $contenu définie dans chaque vue spécifique.
        // Cette variable contient le code HTML généré par la vue entre ob_start() et ob_get_clean().
        echo $contenu;
        ?>
    </main>
    <footer>
        <p class="container text-center py-2 mt-2 border-top">&copy; 2025 Clash Royal </p>
    </footer>
</body>

</html>