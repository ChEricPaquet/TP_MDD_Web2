document.addEventListener("DOMContentLoaded", initialiser);
function initialiser(){
    const utilisateurs = document.querySelector("#tableau-utilisateurs");
    utilisateurs.addEventListener("click", function (event){
        const utilisateur = event.target;
        if(utilisateur.dataset.id !== undefined){
            document.location = "index.php?action=afficherPageProfil&id=" + utilisateur.dataset.id
        }else {
            console.warn(utilisateur)
        }
    })
}