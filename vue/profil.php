<?php $titreOnglet = 'Profil'; 
require_once 'modele/modeleClan.php';
require_once 'modele/modeleUtilisateurs.php' ?>

<?php ob_start(); 
$requeteProfil = ModeleUtilisateurs::ObtenirTout($id);
$profil = $requeteProfil->fetch();?>

<h1 class="text-center big-goofy-title">Profil</h1>

<?php $clanrequete = ModeleClan::ObtenirClanUtilisateur($id);
$clan = $clanrequete->fetch() ?>
<div class="col-sm-10 col-md-8 col-lg-6 mx-auto">
    <div class="card">
        <div class="card-body text-center">
            <h5 class="card-title">Informations du profil</h5>
            <div id="profil-infos">
                <p class="card-text"><strong>Nom d'utilisateur :</strong> <?php echo htmlspecialchars($profil['nom']); ?></p>
                <p class="card-text"><strong>Clan :</strong> <?php if ($clan) { echo $clan; } else {echo "Aucun Clan";} ?></p>
            </div>
        </div>
    </div>
</div>

<?php $contenu = ob_get_clean(); ?>

<?php require 'vue/gabarit.php'; ?>
