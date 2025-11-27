
<?php $titreOnglet = 'Créateur de Decks'; 

require_once "modele/modeleCarte.php";?>

<?php ob_start();
$images = [];
$requeteCartes = ModeleCarte::ObtenirTout();
while ($carte = $requeteCartes->fetch()) {
    $images[$carte['Id_Carte']] = "Images/Cartes/" . $carte['image'];
}
?>

<script>
    const imagesCartes = <?php echo json_encode($images); ?>;
</script>
<script src="js/deck.js"></script>

<h1 class="text-center big-goofy-title"><?php echo $titreOnglet; ?></h1>
<div class="container py-4 bg-blue-900 tableau" id="deck">
    <div class="row g-4">
        <div class="card col-3" id="1"> <img src="Images/Autres/cartebg.png" style="width:60%"></div>
        <div class="card col-3" id="2"><img src="Images/Autres/cartebg.png" style="width:60%"></div>
        <div class="card col-3" id="3"><img src="Images/Autres/cartebg.png" style="width:60%"></div>
        <div class="card col-3" id="4"><img src="Images/Autres/cartebg.png" style="width:60%"></div>
    </div>
    <div class="row g-4" style="margin-top: auto;">
        <div class="card col-3" id="5"><img src="Images/Autres/cartebg.png" style="width:60%"></div>
        <div class="card col-3" id="6"><img src="Images/Autres/cartebg.png" style="width:60%"></div>
        <div class="card col-3" id="7"><img src="Images/Autres/cartebg.png" style="width:60%"></div>
        <div class="card col-3" id="8"><img src="Images/Autres/cartebg.png" style="width:60%"></div>
    </div>
    <div>
        <label>
            <input type="radio" name="radioVisibilité" id="radioPublic" checked> Public
            <input type="radio" name="radioVisibilité" id="radioClan"> Clan seulement
            <input type="radio" name="radioVisibilité" id="radioPrivé"> Privée
        </label>    
        <button id="btn-sauvegarder" class="btn btn-primary mt-4">Sauvegarder le deck ajouter priver publicx truc ahhahaa</button>
    </div>
</div>


<div class="container py-4 bg-blue-900 tableau" id="tableau-carte" style="margin-top: 10px;">
    <div class="row g-4">
        <?php
        $requeteCartes = ModeleCarte::ObtenirTout();
        while ($carte = $requeteCartes->fetch()) {
            ?>
        <!-- ChatGPT : I want a beautiful grid that shows all the cards with their image and their name under it -->
            <div class="col-6 col-md-4 col-lg-2 "data-id="<?=$carte['Id_Carte']?>">
                <div class="card h-100 shadow-sm border-0" data-id="<?=$carte['Id_Carte']?>" data-rarete="<?=$carte['Id_Rarete']?>">
                    <img
                        src="Images/Cartes/<?= htmlspecialchars($carte['image'])?>"
                        class="card-img-top rounded-top"
                        alt="<?= htmlspecialchars($carte['nom']) ?>"
                        style="width: 100%; height: auto;"
                        data-id="<?=$carte['Id_Carte']?>">
                    <div class="card-body text-center" data-id="<?=$carte['Id_Carte']?>">
                        <h6 class="card-title fw-semibold mb-0" data-id="<?=$carte['Id_Carte']?>">
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