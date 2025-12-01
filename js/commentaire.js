document.addEventListener("DOMContentLoaded", init);

function init() {
        document.querySelectorAll('#formCommentaire').forEach(form => {
        form.addEventListener('submit', () => gererSoumission());
    });
    document.querySelectorAll('#supprimerDeck').forEach(bouton => {
        bouton.addEventListener('click', () => gererSupprimer(bouton));
    });
}

async function gererSoumission(event) {
    event.preventDefault();
    event.stopPropagation();

    const formulaire = event.target;

    if (!formulaire.checkValidity()) {
        return;
    }

    const formData = new FormData(formulaire);

    try {
        const reponse = await fetch("index.php?action=ajouterCommentaire", {
            method: "POST",
            body: formData,
        });

        const donnees = await reponse.text();
        if (reponse.ok) {
            gererSuccessServeur(donnees, formulaire);
        } else {
            gererErreurServeur(donnees, formulaire);
        }
    } catch (erreur) {
        gererErreurClient(erreur, formulaire);
    }
}

async function gereSupprimer(bouton) {
    const deckId = bouton.dataset.id;
}

function gererSuccessServeur(htmlSuccess, formulaire) {
    //ajouter commentaire
}

function gererErreurServeur(htmlErreur, formulaire) {
    document.querySelector("#reponseCommentaire").innerHTML = `
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        ${htmlErreur}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    `;
}

function gererErreurClient(erreur, formulaire) {
    console.error("Erreur :", erreur);
    formulaire:close
    document.querySelector("#reponseCommentaire").innerHTML = `
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        Une erreur est survenue. Veuillez réessayer plus tard.
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    `;
}
