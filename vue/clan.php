<?php $titreOnglet = 'Clans'; 
require_once "modele/modeleClan.php";?>

<?php ob_start(); ?>

<script src="js/clan.js"></script>

<h1 class="text-center big-goofy-title"><?php echo $titreOnglet; ?></h1>
<div class="container bg-blue-900 tableau" id="tableau-clans">
    <div>
        <?php
        $requeteClans = ModeleClan::ObtenirTous();
        while ($clan = $requeteClans->fetch()) {
        ?>
            <div>
                <div class="card h-100 shadow-sm border-0" >
                    <div data-id="<?=$clan['Id_Clan']?>" class="card-body text-center">
                        <img src="Images/Clans/<?= htmlspecialchars($clan['Id_Clan']) ?>.png"
                            alt="<?= htmlspecialchars($clan['nom_clan']) ?>"
                            style="width: 10%; height: auto;">
                        <h6 class="card-title fw-semibold mb-0">
                            <?= htmlspecialchars($clan['nom_clan']) ?>
                        </h6>
                    </div>
                </div>
            </div>
        <?php } ?>
    </div>
</div>


<?php $contenu = ob_get_clean(); ?>

<?php require 'vue/gabarit.php'; ?>