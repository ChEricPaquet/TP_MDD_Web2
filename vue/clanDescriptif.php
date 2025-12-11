<?php $titreOnglet = 'Clans';
require_once "modele/modeleClan.php";
require_once "modele/modeleUtilisateurs.php" ?>

<?php ob_start();
$requeteClans = ModeleClan::ObtenirClanParId($id);
$clan = $requeteClans->fetch();
if (!$clan) {
    header("Location: index.php?action=afficherPageAccueil");
}
$requeteUtilisateurs = ModeleClan::ObtenirClanUtilisateur($_SESSION['utilisateur']['Id_Utilisateur']);
$clanUtilisateur = $requeteUtilisateurs->fetch();
$modifierChef = false;
$modifierRole = false;
if ($clanUtilisateur != null && $clanUtilisateur['Id_Clan'] == $clan['Id_Clan'])
    {

        if ($clanUtilisateur['Id_Role'] == 4) {
        $modifierChef = true;
        $modifierRole = true;
    }
    if ($clanUtilisateur['Id_Role'] == 3) {
        $modifierRole = true;
    }
}
?>
<script src="js/clanRole.js"></script>

<script src="js/clandescriptif.js"></script>
<!--I want the image to be aligned on the left with the description on the right, under the description there should be a button to join the clan and over the description there should be the count of members -->
<div class="container bg-blue-900 tableau p-4">
    <!-- ROW: image left / description right -->
    <div class="row align-items-center mb-4">

        <!-- IMAGE -->
        <img class="clan-image" style="width: 15%;" src="Images/Clans/<?= htmlspecialchars($clan['Id_Clan']) ?>.png">
        <!-- DESCRIPTION + MEMBERS + BUTTON -->
        <div class="col-md-8">

            <h1 class="text-center big-goofy-title mb-4">
                <?= htmlspecialchars($clan["nom_clan"]) ?>
            </h1>

            <!-- MEMBER COUNT -->
            <?php
            $countReq = ModeleClan::ObtenirUtilisateursClan($clan['Id_Clan']);
            $nombreMembres = $countReq->rowCount();
            ?>
            <h4 class="text-white mb-3">
                Membres : <strong><?= $nombreMembres ?>/50</strong>
            </h4>

            <!-- DESCRIPTION -->
            <p class="fs-5 text-light">
                <?= nl2br(htmlspecialchars($clan["description_clan"])) ?>
            </p>

            <!-- BUTTON JOIN -->
            <?php if (!$clan['prive']) {if (!$clanUtilisateur || $clanUtilisateur['Id_Clan'] != $clan['Id_Clan']) { ?>
            <div class="mt-3">
                <form id="formRejoindre" method="post" action="rejoindreClan">
                    <input type="hidden" id="clanId" name="Id_Clan" value="<?= $clan['Id_Clan'] ?>">
                    <button type="submit" class="btn btn-success btn-lg">
                        Rejoindre le clan
                    </button>
                </form>
            </div>
            <?php }}else{?> <div style="color: brown;">Ce clan est privé</div> <?php } ?>

            <?php if ($clanUtilisateur && $clanUtilisateur['Id_Clan'] == $clan['Id_Clan']) { ?>
                <div class="mt-3">
                    <form id="formQuitter" method="post" action="quitterClan">
                        <input type="hidden" id="clanId" name="Id_Clan" value="<?= $clan['Id_Clan'] ?>">
                        <button type="submit" class="btn btn-danger btn-lg">
                            Quitter le clan
                        </button>
                    </form>
                </div>
            <?php } ?>
            <div class="mt-2" id="reponse"> </div>

        </div>
    </div>

    <!-- MEMBER LIST -->
    <h3 class="text-center text-white mt-4">Membres du clan</h3>
    <div id="tableau-utilisateurs" class="container bg-blue-900">

        <?php
        $requeteUtilisateurs = ModeleClan::ObtenirUtilisateursClan($clan['Id_Clan']);
        while ($utilisateurs = $requeteUtilisateurs->fetch()) {
            $requetenom = ModeleUtilisateurs::ObtenirTout($utilisateurs['Id_Utilisateur']);
            $requeteRole = ModeleClan::ObtenirRoleNom($utilisateurs['Id_Role']);
            $utilisateur = $requetenom->fetch();
            $role = $requeteRole->fetch();
        ?>
            <div class="panel-nom py-2" data-id="<?= $utilisateurs['Id_Utilisateur'] ?>">
                <?= htmlspecialchars($utilisateur['nom']) ?> - <?= htmlspecialchars($role['role']) ?>
            </div>

            <?php if ($modifierRole && $utilisateurs['Id_Utilisateur'] != $_SESSION['utilisateur']['Id_Utilisateur'] && $role['role'] != "Chef") { ?>
                <form class="form-changer-role" data-id="<?= $utilisateurs['Id_Utilisateur'] ?>" data-clan="<?= $clan['Id_Clan'] ?>">
                    <div class="form-check form-check-inline">
                        <input type="radio" name="idRole" value="1" checked> Membre
                    </div>
                    <div class="form-check form-check-inline">
                        <input type="radio" name="idRole" value="2"> Aîné
                    </div>
                    <div class="form-check form-check-inline">
                        <input type="radio" name="idRole" value="3"> Chef-Adjoint
                    </div>
                    <?php if ($modifierChef) { ?>
                        <div class="form-check form-check-inline">
                            <input type="radio" name="idRole" value="4"> Chef
                        </div>
                        <?php } ?>
                        <button type="submit" class="btn btn-primary btn-sm">Changer le rôle</button>
                    </form>
                    <div class="response-role" id="response-<?= $utilisateurs['Id_Utilisateur'] ?>"></div>
    <?php } 
} ?>
    </div>
</div>


<?php $contenu = ob_get_clean(); ?>

<?php require 'vue/gabarit.php'; ?>