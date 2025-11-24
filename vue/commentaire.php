<?php $titreOnglet = 'Créateur de Decks'; 

require_once "modele/modeleCarte.php";?>

<?php ob_start(); ?>

<script src="js/carte.js"></script>
<h1 class="text-center big-goofy-title"><?php echo $titreOnglet; ?></h1>
<div class="container py-4 bg-blue-900 tableau" id="deck">
    <div class="row g-4">
        <div class="card col-3" id="1"> <img src="Images/Autres/cartebg.png" alt="" style="width:60%"></div>
        <div class="card col-3" id="2"><img src="Images/Autres/cartebg.png" alt="" style="width:60%"></div>
        <div class="card col-3" id="3"><img src="Images/Autres/cartebg.png" alt="" style="width:60%"></div>
        <div class="card col-3" id="4"><img src="Images/Autres/cartebg.png" alt="" style="width:60%"></div>
    </div>
    <div class="row g-4" style="margin-top: auto;">
        <div class="card col-3" id="5"><img src="Images/Autres/cartebg.png" alt="" style="width:60%"></div>
        <div class="card col-3" id="6"><img src="Images/Autres/cartebg.png" alt="" style="width:60%"></div>
        <div class="card col-3" id="7"><img src="Images/Autres/cartebg.png" alt="" style="width:60%"></div>
        <div class="card col-3" id="8"><img src="Images/Autres/cartebg.png" alt="" style="width:60%"></div>
    </div>
      <form id="formCommentaire" method="$_POST" action="index.php?action=ajouterCommentaire" class="needs-validation" novalidate>
        <div class="mb-3 mt-3">
            <label for="commentaire" class="form-label"> Commentaire &nbsp;:</label>
            <input type="text" class="form-control" id="commentaire" placeholder="Entrez un commentaire pwease" name="commentaire" required minlength="3" maxlength="1000">
            <input type="hidden" name="id_clan" value="<?php echo $id_clan; ?>">
            <button type="submit" class="btn btn-primary">Ajouter le commentaire</button>
        </div>
    </form>
</div>
