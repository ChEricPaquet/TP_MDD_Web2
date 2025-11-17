document.addEventListener("DOMContentLoaded", initialiser);
function initialiser() {
        const clans = document.querySelector("#tableau-clans");
    clans.addEventListener("click", function (event) {
        const clan = event.target; 
        if (clan.dataset.id !== undefined) {
            document.location = "index.php?action=afficherClanDesc&id=" + clan.dataset.id;
        }
        else {
            console.warn(clan);
        }

    });
}