<?php $titreOnglet = 'Invitations';
require_once "modele/modeleInvitation.php";
require_once "modele/modeleUtilisateurs.php";
require_once "modele/modeleClan.php" ?>

<?php ob_start();
$requeteInvitation = ModeleInvitation::ObtenirInvitationsParUtilisateur($_SESSION['utilisateur']['Id_Utilisateur']);
$invitations = $requeteInvitation->fetch();
?>
<script src="js/invitation.js"></script>
<h1 class="text-center big-goofy-title"><?php echo $titreOnglet; ?></h1>

<!-- ChatGPT : the css looks nice but keep my code -->
<div class="container bg-blue-900  tableau p-6 min-h-screen">
    <div class="max-w-3xl mx-auto">
        <?php if ($invitations == null) { ?>
            <h2 class="text-center">Vous n'avez aucune invitation pour le moment.</h2>
        <?php } else { ?>
            <div id="reponse2"></div>
        <?php do {
                $requetenom = ModeleUtilisateurs::ObtenirTout($invitations['Id_Utilisateur_1']);
                $requeteClan = ModeleClan::ObtenirClanParId($invitations['Id_Clan']);
                $clan = $requeteClan->fetch();
                $utilisateur = $requetenom->fetch();
        ?>
            <div class="invitation-card" data-id="<?= $invitations['Id_Invitation'] ?>">
                <div class="invitation-text">
                    <span class="user-name"><?= htmlspecialchars($utilisateur['nom']) ?></span>
                    vous invite à rejoindre le clan
                    <span class="clan-name"><?= htmlspecialchars($clan['nom_clan']) ?></span>.
                </div>
                <div class="invitation-buttons">
                    <button class="btn-accept accepter-invitation" data-id="<?= $invitations['Id_Invitation'] ?>">Accepter</button>
                    <button class="btn-refuse refuser-invitation" data-id="<?= $invitations['Id_Invitation'] ?>">Refuser</button>
                </div>
            </div>
        <?php } while ($invitations = $requeteInvitation->fetch()); 
        } ?>
    </div>
</div>


<h1 class="big-goofy-title text-center"> Inviter un utilisateur </h1>

<?php $requeteClan = ModeleClan::ObtenirClanUtilisateur($_SESSION['utilisateur']['Id_Utilisateur']);
$clan = $requeteClan->fetch();
if ($clan) {
?>
    <form class="container bg-blue-900 tableau" method="post" action="envoyerInvitation" class="needs-validation" novalidate id="form-inviter">
        <div class="mb-3 mt-3">
            <label for="nomUtilisateur" class="form-label">Nom d'utilisateur&nbsp;:</label>
            <input type="text" class="form-control" id="nomUtilisateur" placeholder="Entrez le nom d'utilisateur" name="nomUtilisateur" required minlength="3" maxlength="45">
            <div class="invalid-feedback">
                Le nom d'utilisateur est requis et doit contenir entre 3 et 45 caractères.
            </div>
            <input type="hidden" id="clanId" name="Id_Clan" value="<?php echo $clan['Id_Clan']; ?>">
            <label class="form-label">L'utilisateur sera invité dans le clan : <?php echo $clan['nom_clan']; ?>.</label>
            <div id="reponse"></div>
            <button type="submit" class="btn btn-primary">Envoyer l'invitation</button>
        </div>
    </form>
<?php
} else {
    echo "<div class=\"container bg-blue-900 tableau\"><h2 class='text-center'>Vous devez être dans un clan pour inviter des utilisateurs.</h2></div>";
}
?>


<?php $contenu = ob_get_clean(); ?>

<?php require 'vue/gabarit.php'; ?>