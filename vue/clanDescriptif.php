<?php $titreOnglet = 'Clans'; 
require_once "modele/modeleClan.php";?>

<?php ob_start(); 
$requeteClans = ModeleClan::ObtenirClanParId($_GET['id']);
$clan = $requeteClans->fetch(); 
if (!$clan) {header("Location: index.php?action=afficherPageAccueil");}
?>

<script src="js/clan.js"></script>

<h1 class="text-center big-goofy-title"><?php echo $clan["nom_clan"]; ?></h1>
<div class="container bg-blue-900">
    <div>

    </div>
</div>


<?php $contenu = ob_get_clean(); ?>

<?php require 'vue/gabarit.php'; ?>