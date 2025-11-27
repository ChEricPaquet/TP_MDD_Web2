<?php $titreOnglet = 'Invitations';
require_once "modele/modeleInvitation.php";
require_once "modele/modeleUtilisateurs.php";
require_once "modele/modeleClan.php" ?>

<?php ob_start();
$requeteInvitation = ModeleInvitation::ObtenirInvitationsParUtilisateur($_SESSION['utilisateur']['Id_Utilisateur']);
$invitations = $requeteInvitation->fetch();
?>

<h1 class="text-center big-goofy-title"><?php echo $titreOnglet; ?></h1>
<div class="container bg-blue-900 tableau">
    <div class="container bg-blue-900">
        <div>

            <?php if ($invitations == null) {
                echo "<h2 class='text-center'>Vous n'avez aucune invitation pour le moment.</h2>";
            } 
            else {
                do { ?>
                    <div data-id="<?= $invitations['Id_Invitation'] ?>">
                        <?php
                        $requetenom = ModeleUtilisateurs::ObtenirTout($invitations['Id_Utilisateur_Emetteur']);
                        $requeteClan = ModeleClan::ObtenirClanParId($invitations['Id_Clan']);
                        $clan = $requeteClan->fetch();
                        $utilisateur = $requetenom->fetch();

                        echo "Invitation de " . $utilisateur['nom'] .
                            " pour rejoindre le clan " . $clan['nom_clan'] . ". ";
                        ?>
                        <button class="btn btn-success btn-sm accepter-invitation" data-id="<?= $invitations['Id_Invitation'] ?>">Accepter</button>
                        <button class="btn btn-danger btn-sm refuser-invitation" data-id="<?= $invitations['Id_Invitation'] ?>">Refuser</button>
                    </div>
            <?php } while ($invitations = $requeteInvitation->fetch());
            } ?>
        </div>
    </div>
</div>

<h1 class="big-goofy-title text-center"> Inviter un utilisateur </h1>
<form class="container bg-blue-900 tableau" method="post" action="envoyerInvitation" class="needs-validation" novalidate id="form-inviter" style="margin-top: 20px;">
    <div class="mb-3 mt-3">
        <label for="nomUtilisateur" class="form-label">Nom d'utilisateur&nbsp;:</label>
        <input type="text" class="form-control" id="nomUtilisateur" placeholder="Entrez le nom d'utilisateur" name="nomUtilisateur" required minlength="3" maxlength="45">
        <div class="invalid-feedback">
            Le nom d'utilisateur est requis et doit contenir entre 3 et 45 caractères.
        </div>
        <label for="clan" class="form-label">Clan</label>
    <div> <?php $requeteClan = ModeleClan::ObtenirClanUtilisateur($_SESSION['utilisateur']['Id_Utilisateur']); $clan = $requeteClan->fetch(); echo $clan['nom_clan'];?> </div>
    <button type="submit" class="btn btn-primary">Envoyer l'invitation</button>
    </div>
</form>

<?php $contenu = ob_get_clean(); ?>

<?php require 'vue/gabarit.php'; ?>