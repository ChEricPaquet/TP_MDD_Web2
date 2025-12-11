document.addEventListener("DOMContentLoaded", () => {
    document.querySelectorAll('.formCommentaire').forEach(form => {
        form.addEventListener('submit', gererSoumission);
    });

    document.querySelectorAll('.supprimer-commentaire').forEach(btn => {
        btn.addEventListener('click', supprimerCommentaire);
    });

    document.querySelectorAll('.supprimer-deck').forEach(btn => {
        btn.addEventListener('click', supprimerDeck);
    });
});

// ChatGPT Remove the deck pls
async function supprimerDeck(event) {
    const idDeck = event.target.closest('button').dataset.id;

    const formData = new FormData();
    formData.append("id_deck", idDeck);

    if (!confirm("Voulez-vous vraiment supprimer ce deck?")) {
        return;
    }

    try {
        const response = await fetch("index.php?action=supprimerDeck", {
            method: "POST",
            body: formData
        });

        const text = await response.text();

        if (response.ok) {
            event.target.closest('.deck-container').remove();
        } else {
            alert("Erreur: " + text);
        }

    } catch (err) {
        console.error(err);
        alert("Une erreur est survenue.");
    }
}


async function supprimerCommentaire(event) {
    const idCommentaire = event.target.dataset.id;

    const formData = new FormData();
    formData.append("id_commentaire", idCommentaire);

    try {
        const response = await fetch("index.php?action=supprimerCommentaire", {
            method: "POST",
            body: formData
        });

        const text = await response.text();

        if (response.ok) {
            //ChatGPT Remove comment from page
            event.target.closest('.commentaire').remove();
        } else {
            alert("Erreur: " + text);
        }

    } catch (err) {
        console.error(err);
        alert("Une erreur est survenue.");
    }
}

async function gererSoumission(event) {
    event.preventDefault();

    const formulaire = event.target;
    if (!formulaire.checkValidity()) return;

    const formData = new FormData(formulaire);

    try {
        const reponse = await fetch("index.php?action=ajouterCommentaire", {
            method: "POST",
            body: formData,
        });

        const html = await reponse.text();
        //ChatGPT FIX THE JS
        if (reponse.ok) {
            formulaire.reset();
            formulaire.closest('.deck-container')
                .querySelector('.commentaires-zone')
                .innerHTML += html;   // server returns HTML for 1 new comment
        } else {
            gererErreurServeur(html, formulaire);
        }
    } catch (e) {
        gererErreurClient(e, formulaire);
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
