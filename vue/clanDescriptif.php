<?php $titreOnglet = 'Clans';
require_once "modele/modeleClan.php";
require_once "modele/modeleUtilisateurs.php" ?>

<?php ob_start();
$requeteClans = ModeleClan::ObtenirClanParId($_GET['id']);
$clan = $requeteClans->fetch();
if (!$clan) {
    header("Location: index.php?action=afficherPageAccueil");
}
?>

<h1 class="text-center big-goofy-title"><?php echo $clan["nom_clan"]; ?></h1>
<div class="container bg-blue-900 tableau">
    <img class="ClanImage" src="Images/Clans/<?= htmlspecialchars($clan['Id_Clan']) ?>.png">
    <h2 class="text-center"><?php echo $clan["description_clan"] ?></h2>
    <div class="container bg-blue-900" style="padding-bottom: 2%;">
        <div>
            <?php $requeteUtilisateurs = ModeleClan::ObtenirUtilisateursClan($clan['Id_Clan']);
            while ($utilisateurs = $requeteUtilisateurs->fetch()) { ?>
                <div class="panel-nom" style="padding: 1%;" data-id="<?=$utilisateurs['Id_Utilisateur'] ?>">
                    <?php $requetenom = ModeleUtilisateurs::ObtenirTout($utilisateurs['Id_Utilisateur']); 
                    $requeteRole = ModeleClan::ObtenirRoleNom($utilisateurs['Id_Role']);
                    $utilisateur = $requetenom->fetch();
                    $role = $requeteRole->fetch();
                    echo $utilisateur['nom'] . ' - ' . $role['role']; ?>
                </div>
            <?php } ?>
        </div>
    </div>
</div>

<?php $contenu = ob_get_clean(); ?>

<?php require 'vue/gabarit.php'; ?>