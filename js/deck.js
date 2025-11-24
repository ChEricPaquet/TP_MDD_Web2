document.addEventListener("DOMContentLoaded", initialiser);

const tableauDeck = [
    idCarte1 = null,
    idCarte2 = null,
    idCarte3 = null,
    idCarte4 = null,
    idCarte5 = null,
    idCarte6 = null,
    idCarte7 = null,
    idCarte8 = null
]

function initialiser() {
    const cartes = document.querySelector("#tableau-carte")
    const imagesDeck = document.querySelector("#deck")

    cartes.addEventListener("click", function (event) {
        const carte = event.target;
        AjouterCarteAuDeck(carte)
    })

    imagesDeck.addEventListener("click", function (event){
        const carte = event.target;
        SupprimerCarte(carte);
    })
}

function AjouterCarteAuDeck(carte){
    tableauDeck.forEach(id => {
        if(id == null){
            id = carte.dataset.id;
            RafraichirDeck();
            return;
        }
    });
}

function RafraichirDeck(){
    let compteurId = 1
    tableauDeck.forEach(id => {
        if(id != null){
            var place = document.getElementById(compteurId);
            place.innerHTML="<img src=\"Images/<? $requeteIdAAjouter = ModeleCarte::ObtenirParId(id); $idAAjouter = $requeteIdAAjouter->fetch();echo htmlspecialchars($idAAjouter['image']); ?>\"style=\"width:60%\">";

        }
        else{
            var place = document.getElementById(compteurId);
            place.innerHTML="<img src=\"Images/Autres/cartebg.png\"style=\"width:60%\">";
        }
        compteurId =+ 1;        
    });
}

function SupprimerCarte(carte){
    tableauDeck[carte.id] = null;
    RafraichirDeck();
}

