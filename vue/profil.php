<?php $titreOnglet = 'Profil';
require_once 'modele/modeleClan.php';
require_once 'modele/modeleUtilisateurs.php';
require_once 'modele/modeleDeck.php'; ?>


<?php ob_start();
$requeteProfil = ModeleUtilisateurs::ObtenirTout($id);
$profil = $requeteProfil->fetch();

$requetesDecks = ModeleDeck::ObtenirDecksParUtilisateur($id);
?>

<script src="js/commentaire.js"></script>

<h1 class="text-center big-goofy-title">Profil</h1>

<?php $clanrequete = ModeleClan::ObtenirClanUtilisateur($id);
$clan = $clanrequete->fetch() ?>
<div class="tableau container bg-blue-900 mt-4">
    <div class="card bg-blue-700">
        <div class="card-body ">
            <div class="profil-text ">
                <h3 class="card-text text-shadow mb-3">Informations du Joueur</h3>
                <p class="card-text"><strong>Nom d'utilisateur :</strong> <?= htmlspecialchars($profil['nom']); ?></p>
                <p class="card-text"><strong>Clan :</strong> <?= $clan ? htmlspecialchars($clan['nom_clan']) : "Aucun Clan"; ?></p>
            </div>
        </div>
    </div>
</div>

<h1 class="text-center big-goofy-title">Decks</h1>
<div class="container mt-4">
    <?php $compteur = 0;
    while ($deck = $requetesDecks->fetch()) :
        $compteur++; ?>
        <div class="deck-container tableau p-3 mb-4 bg-blue-900">
            <h3 class="text-center mb-3">Deck #<?= $compteur ?></h3>
            <?php
            $cartesReq = ModeleDeck::ObtenirCarteDeckParDeck($deck['Id_Deck']);
            ?>
            <!-- CHATGPT: mettre les cartes dans une belle grille cool et bleu -->
            <div class="row g-2 justify-content-center">
                <?php while ($carte = $cartesReq->fetch()) : ?>
                    <div class="col-6 col-sm-4 col-md-3 col-lg-3">
                        <div class="card card-carte text-center p-2 bg-blue-800">
                            <img src="Images/Cartes/<?= htmlspecialchars($carte['image']) ?>"
                                class="img-fluid carte-image" alt="<?= htmlspecialchars($carte['nom']) ?>">
                            <p class="mt-2 mb-0 text-white">
                                <?= htmlspecialchars($carte['nom']) ?>
                            </p>
                        </div>
                    </div>
                <?php endwhile; ?>
            </div>
            <div id="commentaire">
                <form id="formCommentaire" method="$_POST" action="index.php?action=ajouterCommentaire" class="tableau needs-validation " novalidate>
                    <div class="mb-3 mt-3">
                        <label for="commentaire" class="form-label"> Commentaire &nbsp;:</label>
                        <input type="text" class="form-control" id="commentaire" placeholder="Entrez un commentaire" name="commentaire" required minlength="3" maxlength="1000">
                        <input type="hidden" name="id_clan" value="<?php $clan['Id_Clan'] ?>">
                        <div id="reponseCommentaire"></div>
                        <button type="submit" class="btn btn-primary">Ajouter le commentaire</button>
                    </div>
                </form>
            </div>
        </div>
    <?php endwhile; ?>

</div>

<?php $contenu = ob_get_clean(); ?>

<?php require 'vue/gabarit.php'; ?>