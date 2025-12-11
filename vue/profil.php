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
<?php $clanSessionrequete = ModeleClan::ObtenirClanUtilisateur($_SESSION['utilisateur']['Id_Utilisateur']);
$clanSession = $clanSessionrequete->fetch() ?>
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
        if ($deck['Id_Visibilite'] == 1 && $id != $_SESSION['utilisateur']['Id_Utilisateur']) {
            continue;
        } elseif ($deck['Id_Visibilite'] == 2 && $clanSession != null && $clanSession['Id_Clan'] != $clan['Id_Clan']) {
            continue;
        }
        $compteur++; ?>
        <div class="deck-container tableau p-3 mb-4 bg-blue-900">
            <h3 class="text-center mb-3">Deck #<?= $compteur ?></h3>
            <?php
            $cartesReq = ModeleDeck::ObtenirCarteDeckParDeck($deck['Id_Deck']);
            if ($deck['Id_Utilisateur'] == $_SESSION['utilisateur']['Id_Utilisateur']) : ?>
                <button class="btn btn-danger btn-plus supprimer-deck"
                    data-id="<?= $deck['Id_Deck'] ?>">
                    <img src="Images/Autres/Poubelle.png" style="width: 1.5rem;">
                </button>
            <?php endif; ?>

            <!-- ChatGPT: mettre les cartes dans une belle grille cool et bleu -->
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
            <?php
            $commentaires = ModeleCommentaire::ObtenirCommentairesParDeck($deck['Id_Deck']);
            ?>
            <!-- ChatGPT: DISPLAY COMMENTS PER DECK -->
            <div class="commentaires-zone">
                <?php while ($com = $commentaires->fetch()) : ?>
                    <div class="commentaire bg-blue-800 p-2 mt-2 rounded">
                        <strong><?php
                                $reqUtil = ModeleUtilisateurs::ObtenirTout($com['Id_Utilisateur']);
                                $auteur = $reqUtil->fetch();
                                echo htmlspecialchars($auteur['nom']); ?></strong>
                        <span class="text-muted small"><?= $com['dateheure'] ?></span>
                        <p class="m-0"><?= htmlspecialchars($com['texte']) ?></p>
                        <?php if ($com['Id_Utilisateur'] == $_SESSION['utilisateur']['Id_Utilisateur']) : ?>
                            <button class="btn btn-danger btn-sm mt-2 supprimer-commentaire" data-id="<?= $com['Id_Commentaire'] ?>">
                                Supprimer
                            </button>
                        <?php endif; ?>
                    </div>
                <?php endwhile; ?>
            </div>
            <div id="commentaire">
                <form class="formCommentaire needs-validation" method="post" novalidate>
                    <div class="mb-3 mt-3">
                        <label for="commentaire" class="form-label"> Commentaire &nbsp;:</label>
                        <div>
                            <input type="text" class="form-control" id="commentaire" placeholder="Entrez un commentaire" name="commentaire" required minlength="3" maxlength="100">
                            <div class="invalid-feedback">
                                Le commentaire doit etre entre 3 et 300 caractères.
                            </div>
                        </div>
                        <input type="hidden" name="id_deck" value="<?= $deck['Id_Deck'] ?>">
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