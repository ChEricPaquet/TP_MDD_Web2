
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
<form method="post" action="ajouterDeck" class="container py-4 bg-blue-900 tableau" id="deck">
    <div id="reponse" ></div>
    <div class="row g-4">
        <div class="card deck-slot col-3" data-id="0" id="1"> <img src="Images/Autres/cartebg.png" style="width:60%"></div>
        <div class="card deck-slot col-3" data-id="0" id="2"><img src="Images/Autres/cartebg.png" style="width:60%"></div>
        <div class="card deck-slot col-3" data-id="0" id="3"><img src="Images/Autres/cartebg.png" style="width:60%"></div>
        <div class="card deck-slot col-3" data-id="0" id="4"><img src="Images/Autres/cartebg.png" style="width:60%"></div>
    </div>
    <div class="row g-4" style="margin-top: auto;">
        <div class="card deck-slot col-3" data-id="0" id="5"><img src="Images/Autres/cartebg.png" style="width:60%"></div>
        <div class="card deck-slot col-3" data-id="0" id="6"><img src="Images/Autres/cartebg.png" style="width:60%"></div>
        <div class="card deck-slot col-3" data-id="0" id="7"><img src="Images/Autres/cartebg.png" style="width:60%"></div>
        <div class="card deck-slot col-3" data-id="0" id="8"><img src="Images/Autres/cartebg.png" style="width:60%"></div>
    </div>
    <div class="text-center mt-5">
        <label class="form-label fw-bold mb-2">Visibilité du deck :</label>

        <div class="form-check form-check-inline">
            <input type="radio" class="form-check-input" name="visibilite" id="radioPublic" value="3" checked>
            <label class="form-check-label" for="radioPublic">Public</label>
        </div>

        <div class="form-check form-check-inline">
            <input type="radio" class="form-check-input" name="visibilite" id="radioClan" value="2">
            <label class="form-check-label" for="radioClan">Clan seulement</label>
        </div>

        <div class="form-check form-check-inline">
            <input type="radio" class="form-check-input" name="visibilite" id="radioPrive" value="1">
            <label class="form-check-label" for="radioPrive">Privé</label>
        </div>
    </div>
    <div class="text-center mt-4">
        <button type="submit" class="btn btn-primary px-5 py-2 fs-5 fw-semibold" id="envoyer">
            Sauvegarder le deck
        </button>
    </div>
</form>


<div class="container py-4 bg-blue-900 tableau" id="tableau-carte" >
    <div class="row g-4">
        <?php
        $requeteCartes = ModeleCarte::ObtenirTout();
        while ($carte = $requeteCartes->fetch()) {
            ?>
        <!-- ChatGPT : I want a beautiful grid that shows all the cards with their image and their name under it -->
            <div class="col-6 col-md-4 col-lg-2 "data-id="<?=$carte['Id_Carte']?>" data-rarete="<?=$carte['Id_Rarete']?>">
                <div class="card h-100 shadow-sm border-0" data-id="<?=$carte['Id_Carte']?>" data-rarete="<?=$carte['Id_Rarete']?>">
                    <img
                        src="Images/Cartes/<?= htmlspecialchars($carte['image'])?>"
                        class="card-img-top rounded-top"
                        alt="<?= htmlspecialchars($carte['nom']) ?>"
                        style="width: 100%; height: auto;"
                        data-id="<?=$carte['Id_Carte']?>" data-rarete="<?=$carte['Id_Rarete']?>">
                    <div class="card-body text-center" data-id="<?=$carte['Id_Carte']?>" data-rarete="<?=$carte['Id_Rarete']?>">
                        <h6 class="card-title fw-semibold mb-0" data-id="<?=$carte['Id_Carte']?>" data-rarete="<?=$carte['Id_Rarete']?>">
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