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
        SupprimerCarte(carte);
    })
}

function AjouterCarteAuDeck(carte){
    if (carte.dataset.id === undefined) {
        console.warn(carte);
        return;
    }
        if (tableauDeck.includes(carte.dataset.id)) {
        console.warn("Déjà dans le deck");
        return;
    }
    for (let i = 0; i < tableauDeck.length; i++) {
        if (tableauDeck[i] === null) {
            tableauDeck[i] = carte.dataset.id;
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
            place.innerHTML="<img id=\"" + compteurId + "\" src=" + imagesCartes[id] + " \"style=\"width:60%\">";

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

