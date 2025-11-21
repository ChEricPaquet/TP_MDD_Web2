<?php $titreOnglet = 'Clans'; 
require_once "modele/modeleClan.php";
require_once "modele/modeleUtilisateurs.php"?>

<?php ob_start(); 
$requeteClans = ModeleClan::ObtenirClanParId($_GET['id']);
$clan = $requeteClans->fetch(); 
if (!$clan) {header("Location: index.php?action=afficherPageAccueil");}
?>

<h1 class="text-center big-goofy-title"><?php echo $clan["nom_clan"]; ?></h1>
<div class="container bg-blue-900 tableau">
    <h2 class="text-center"><?php echo $clan["description_clan"] ?></h2>
    <div class="container bg-blue-900">
        <div>
            <?php $requeteUtilisateurs = ModeleClan::ObtenirUtilisateursClan($clan['Id_Clan']);
            while($utilisateurs = $requeteUtilisateurs->fetch())
            {
                $requetenom = ModeleUtilisateurs::ObtenirNom($utilisateurs['Id_Utilisateur']);
                $nom = $requetenom->fetch();
                echo $nom . ' - ' . $utilisateurs['Id_Role'];
            } 
            ?>
        </div>
    </div>
</div>

<?php $contenu = ob_get_clean(); ?>

<?php require 'vue/gabarit.php'; ?>