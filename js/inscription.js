document
    .getElementById("confirmationMotDePasse")
    .addEventListener("input", validerConfirmationMotDePasse);
document
    .getElementById("motDePasse")
    .addEventListener("input", validerConfirmationMotDePasse);

function validerConfirmationMotDePasse() {
    const inputConfirmation = document.getElementById("confirmationMotDePasse");
    const motDePasse = document.getElementById("motDePasse").value;
    const confirmationMotDePasse = inputConfirmation.value;

    let erreur = "";
    if (motDePasse !== confirmationMotDePasse) {
        erreur = "Les mots de passe ne correspondent pas.";
    }
    inputConfirmation.setCustomValidity(erreur);
}

document.addEventListener("DOMContentLoaded", init);

function init() {
    const form = document.querySelector("#formInscription");
    form.addEventListener("submit", gererSoumission);
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
        const reponse = await fetch("index.php?action=inscription", {
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
        document.location = "index.php?action=afficherPageProfil";
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
