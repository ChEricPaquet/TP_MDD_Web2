<?php $titreOnglet = 'Clans';
require_once "modele/modeleClan.php"; ?>

<?php ob_start(); ?>

<script src="js/clan.js"></script>

<h1 class="text-center big-goofy-title"><?php echo $titreOnglet; ?></h1>
<div class="container bg-blue-900 tableau" id="tableau-clans">
    <div>
        <?php
        $requeteClans = ModeleClan::ObtenirTous();
        while ($clan = $requeteClans->fetch()) {
        ?>
            <div class="card h-100 shadow-sm border-0">
                <div data-id="<?= $clan['Id_Clan'] ?>" class="card-body d-flex align-items-center justify-content-between">
                    <!-- ChatGPT alligner l'image a droite et le texte a gauche  -->
                    <!-- Text on the left -->
                    <h3 data-id="<?= $clan['Id_Clan'] ?>" class="fw-bold mb-0 clan-name">
                        <?= htmlspecialchars($clan['nom_clan']) ?>
                    </h3>
                    <!-- Image on the right -->
                    <img data-id="<?= $clan['Id_Clan'] ?>"
                        src="Images/Clans/<?= htmlspecialchars($clan['Id_Clan']) ?>.png"
                        alt="<?= htmlspecialchars($clan['nom_clan']) ?>"
                        class="clan-image">
                </div>
            </div>
        <?php } ?>
    </div>
</div>


<?php $contenu = ob_get_clean(); ?>

<?php require 'vue/gabarit.php'; ?>