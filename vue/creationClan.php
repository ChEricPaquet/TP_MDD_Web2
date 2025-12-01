<?php $titreOnglet = 'Création d\'un clan';
require_once "modele/modeleClan.php"; ?>

<?php ob_start(); ?>

<script src="js/creationClan.js"></script>

<h1 class="text-center big-goofy-title"><?php echo $titreOnglet; ?></h1>
<div class="container bg-blue-900 tableau" id="tableau-clans">
    <div>
        <form id="formAjouterClan" action="index.php?action=ajoutClan" method="post" class="needs-validation" novalidate>
            <div class="mb-3 mt-3">
                <label for="nomClan" class="form-label">Nom du clan&nbsp;:</label>
                <input type="text" class="form-control" id="nomClan" placeholder="Entrez le nom du clan " name="nomClan" required minlength="3" maxlength="100">
                <div class="invalid-feedback">
                    Le nom du clan est requis et doit contenir entre 3 et 100 caractères.
                </div>
            </div>

            <div class="mb-3 mt-3">
                <label for="descriptionClan" class="form-label">Description du clan&nbsp;:</label>
                <input type="text" class="form-control" id="descriptionClan" placeholder="Entrez la description du clan " name="descriptionClan" required minlength="3" maxlength="255">
                <div class="invalid-feedback">
                    La description du clan est requis et doit contenir entre 3 et 255 caractères.
                </div>
            </div>

            <div class="mb-3 mt-3">
                <label class="form-label d-block">Visibilité du clan :</label>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="prive" id="publicClan" value="0" checked>
                    <label class="form-check-label" for="publicClan">Public</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="prive" id="privateClan" value="1">
                    <label class="form-check-label" for="privateClan">Privé</label>
                </div>
            </div>

            <button type="submit" class="btn btn-primary">Créer le clan</button>
            <div id="reponse"></div>
        </form>
    </div>
</div>

<?php $contenu = ob_get_clean(); ?>

<?php require 'vue/gabarit.php'; ?>