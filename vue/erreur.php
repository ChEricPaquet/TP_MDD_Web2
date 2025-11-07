<?php $titreOnglet = 'Erreur'; ?>

<?php ob_start(); ?>

<div class="text-center">
    <h1>Une erreur est survenue&nbsp;:</h1>
    <p><?php echo htmlspecialchars($msgErreur); ?></p>
</div>

<?php $contenu = ob_get_clean(); ?>

<?php require 'vue/gabarit.php'; ?>