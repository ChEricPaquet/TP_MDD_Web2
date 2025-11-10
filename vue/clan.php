<?php $titreOnglet = 'Clans'; ?>

<?php ob_start(); ?>

<h1 class="text-center"><?php echo $titreOnglet; ?></h1>

<div class="col-sm-10 col-md-8 col-lg-6 mx-auto">
    <div id="reponse"></div>
    

    
</div>


<?php $contenu = ob_get_clean(); ?>

<?php require 'vue/gabarit.php'; ?>