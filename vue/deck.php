
<?php $titreOnglet = 'Deck Builder'; 
require_once "modele/modeleCarte.php";?>

<?php ob_start(); ?>

<h1 class="text-center"><?php echo $titreOnglet; ?></h1>

<div class="container py-4 bg-blue-900" id="tableau-carte">
    <div class="row g-4">
        <?php
        $requeteCartes = ModeleCarte::ObtenirTout();
        while ($carte = $requeteCartes->fetch()) {
        ?>
        <!-- ChatGPT : I want a beautiful grid that shows all the cards with their image and their name under it -->
            <div class="col-6 col-md-4 col-lg-2">
                <div class="card h-100 shadow-sm border-0">
                    <img
                        src="Images/Cartes/<?= htmlspecialchars($carte['image'])?>"
                        class="card-img-top rounded-top"
                        alt="<?= htmlspecialchars($carte['nom']) ?>"
                        style="width: 100%; height: auto;">
                    <div class="card-body text-center">
                        <h6 class="card-title fw-semibold mb-0">
                            <?= htmlspecialchars($carte['nom']) ?>
                        </h6>
                    </div>
                </div>
            </div>
        <?php
        }
        ?>
    </div>
</div>



<?php $contenu = ob_get_clean(); ?>

<?php require 'vue/gabarit.php'; ?>