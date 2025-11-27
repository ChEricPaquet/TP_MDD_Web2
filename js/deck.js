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

