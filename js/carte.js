document.addEventListener("DOMContentLoaded", initialiser);

function initialiser() {
    const cartes = document.querySelector("#tableau-carte");
    cartes.addEventListener("click", function (event) {
        const carte = event.target; 
        console.warn(carte);
    });
}
