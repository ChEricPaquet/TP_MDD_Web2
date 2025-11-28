document.addEventListener("DOMContentLoaded", initialiser);


const tableauDeck = [
    null,
    null,
    null,
    null,
    null,
    null,
    null,
    null
]

function initialiser() {
    const cartes = document.querySelector("#tableau-carte")
    const imagesDeck = document.querySelector("#deck")
    const envoyerButton = document.querySelector("#envoyer")

    cartes.addEventListener("click", function (event) {
        const carte = event.target;
        console.warn(carte);
            AjouterCarteAuDeck(carte)
    })

    imagesDeck.addEventListener("click", function (event){
        const carte = event.target;
        if(carte.id === "deck"){
            return;
        }
        SupprimerCarte(carte);
    })

    envoyerButton.addEventListener("click", function (event){
        for (const id of tableauDeck){
            if (id == null) {
                return;
            }
        }
        SauvegarderDeck(event)
    })
}

function AjouterCarteAuDeck(carte){
    if (carte.dataset.id === undefined) {
        console.warn(carte);
        return;
    }
        for (const id of tableauDeck) {
        if (id != null && id.dataset.id == carte.dataset.id) {
            return;
        }
    }
    if (carte.dataset.rarete == 5) {
        for (const id of tableauDeck) {
        if (id != null && id.dataset.rarete == 5) {
            return;
        }
    }
    }

    for (let i = 0; i < tableauDeck.length; i++) {
        if (tableauDeck[i] === null) {
            tableauDeck[i] = carte;
            RafraichirDeck();
            break;
        }
    }
}

function RafraichirDeck(){
    let compteurId = 1;
    tableauDeck.forEach(id => {
        if(id != null){
            var place = document.getElementById(compteurId);
            place.innerHTML="<img id=\"" + compteurId + "\" src=" + imagesCartes[id.dataset.id] + " \"style=\"width:60%\">";

        }
        else{
            var place = document.getElementById(compteurId);
            place.innerHTML="<img src=\"Images/Autres/cartebg.png \"style=\"width:60%\">";
        }
        compteurId += 1;        
    });
}

function SupprimerCarte(carte){
    tableauDeck[carte.id - 1] = null;
    RafraichirDeck();
}

async function SauvegarderDeck(event){
    event.preventDefault();
    event.stopPropagation();



    const formulaire = event.target;

    if (!formulaire.checkValidity()) {
        return;
    }

    const formdata = new FormData(formulaire);
    formData.append("tableauDeck", JSON.stringify(tableauAEnvoyer()));

    try{
        const reponse = await fetch("index.php?action=sauvegarderDeck",{
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

function tableauAEnvoyer(){
    const tableauFinal = [
        null,
        null,
        null,
        null,
        null,
        null,
        null,
        null
    ];

    const compteur = 1;

    for (const id of tableauDeck){
        tableauFinal[compteur] = id.dataset.id
    };

    return tableauFinal;
}

