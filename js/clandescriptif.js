document.addEventListener("DOMContentLoaded", initialiser);
function initialiser() {
    const formRejoindre = document.querySelector("#formRejoindre");
    if (formRejoindre) {
        formRejoindre.addEventListener("submit", gererSoumission);
    }
    const formQuitter = document.querySelector("#formQuitter");
    if (formQuitter) {
        formQuitter.addEventListener("submit", gererSoumission);
    }
    const utilisateurs = document.querySelector("#tableau-utilisateurs");
    utilisateurs.addEventListener("click", function (event) {
        const utilisateur = event.target;
        if (utilisateur.dataset.id !== undefined) {
            document.location = "index.php?action=afficherPageProfil&id=" + utilisateur.dataset.id
        } else {
            console.warn(utilisateur)
        }
    })
}

async function gererSoumission(event) {
    event.preventDefault();
    event.stopPropagation();

    const formulaire = event.target;

    if (!formulaire.checkValidity()) {
        return;
    }

    const formData = new FormData(formulaire);
    //CHAPTGPT: Change le choix de l'action en fonction du formulaire soumis
    // 👇 IMPORTANT : pick the right action based on the form ID
    let action = "rejoindreClan";

    if (formulaire.id === "formQuitter") {
        action = "quitterClan";
    }

    try {
        const reponse = await fetch(`index.php?action=${action}`, {
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
    document.querySelector("#reponse").innerHTML = htmlSuccess;
    setTimeout(() => {
        document.location = "index.php?action=afficherClanDesc&id=" + document.querySelector("#clanId").value;
    }, 1000);
}

function gererErreurServeur(htmlErreur) {
    document.querySelector("#reponse").innerHTML = `
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        ${htmlErreur}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    `;
}

function gererErreurClient(erreur) {
    console.error("Erreur :", erreur);
    document.querySelector("#reponse").innerHTML = `
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        Une erreur est survenue. Veuillez réessayer plus tard.
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    `;
}
