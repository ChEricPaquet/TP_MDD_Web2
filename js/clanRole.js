//ChatGPT Add JS to handle the role change via AJAX
document.addEventListener("DOMContentLoaded", () => {
    document.querySelectorAll(".form-changer-role").forEach(form => {
        form.addEventListener("submit", async (e) => {
            e.preventDefault();
            const idUtilisateur = form.dataset.id;
            const idClan = form.dataset.clan;
            const idRole = form.querySelector("input[name='idRole']:checked").value;

            // Use the dedicated response div by ID
            const reponseDiv = document.getElementById(`response-${idUtilisateur}`);

            try {
                const resp = await fetch("index.php?action=changerRole", {
                    method: "POST",
                    body: new URLSearchParams({
                        idUtilisateur: idUtilisateur,
                        idRole: idRole,
                        idClan: idClan
                    })
                });

                const text = await resp.text();

                if (resp.ok) {
                    reponseDiv.innerHTML = `
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            Rôle modifié avec succès !
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    `;

                    setTimeout(() => {
                        window.location.reload(); // reload the same page
                    }, 1000);

                } else {
                    reponseDiv.innerHTML = `
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            ${text}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    `;
                }
            } catch (err) {
                reponseDiv.innerHTML = `
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        Une erreur est survenue.
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                `;
            }
        });
    });
});
