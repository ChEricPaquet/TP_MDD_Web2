document.addEventListener("DOMContentLoaded", initialiser);
function initialiser(){
    const form = document.querySelector("#form-inviter");
    form.addEventListener("submit", gererSoumission);
    document.querySelectorAll('.accepter-invitation').forEach(bouton => {
        bouton.addEventListener('click', () => accepterInvitation(bouton));
    });
    document.querySelectorAll('.refuser-invitation').forEach(bouton => {
        bouton.addEventListener('click', () => refuserInvitation(bouton));
    });
}

async function accepterInvitation(bouton) {
    const idInvitation = bouton.dataset.id;
    try {
        const reponse = await fetch("index.php?action=accepterInvitation", {
            method: "POST",
            body: new URLSearchParams({ Id_Invitation: idInvitation }),
        });
        const donnees = await reponse.text();
        if (reponse.ok) {
            bouton.closest('.invitation-card').remove();
            document.location = "index.php?action=afficherInvitations";
        } else {
            gererErreurServeur(donnees, true);
        }
    } catch (erreur) {
        gererErreurClient(erreur, true);
    }
}
async function refuserInvitation(bouton) {
    const idInvitation = bouton.dataset.id;
    try {
        const reponse = await fetch("index.php?action=refuserInvitation", {
            method: "POST",
            body: new URLSearchParams({ Id_Invitation: idInvitation }),
        });
        const donnees = await reponse.text();
        if (reponse.ok) {
            bouton.closest('.invitation-card').remove();
        } else {
            gererErreurServeur(donnees, true);
        }
    } catch (erreur) {
        gererErreurClient(erreur, true);
    }
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
        const reponse = await fetch("index.php?action=envoyerInvitation", {
            method: "POST",
            body: formData,
        });

        const donnees = await reponse.text();
        if (reponse.ok) {
            gererSuccessServeur(donnees);
        } else {
            gererErreurServeur(donnees);
        }
    } catch (erreur) {
        gererErreurClient(erreur);
    }
}

function gererSuccessServeur(htmlSuccess) {
    const zone = document.querySelector("#reponse");

    zone.innerHTML = `
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            ${htmlSuccess}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    `;

    setTimeout(() => {
        zone.innerHTML = "";
    }, 2000);
}


function gererErreurServeur(htmlErreur, deux) {   
    var div = document.querySelector("#reponse")
    if (deux) {
        div = document.querySelector("#reponse2")
    }
    div.innerHTML = `
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        ${htmlErreur}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    `;
}

function gererErreurClient(erreur, deux) {
    var div = document.querySelector("#reponse")
    if (deux) {
        div = document.querySelector("#reponse2")
    }
    div.innerHTML = `
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        Une erreur est survenue. Veuillez réessayer plus tard.
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    `;
}
