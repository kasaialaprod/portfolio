"use strict";

document.addEventListener("DOMContentLoaded", () => {
  const newLinkBtn = document.getElementById("new-link");

  if (newLinkBtn) {
    newLinkBtn.addEventListener("click", async () => {
      const title = prompt("Titre du lien");
      if (!title) return;

      const url = prompt("URL du lien");
      if (!url) return;

      try {
        const res = await fetch("/routes/ajout_lien.php", {
          method: "POST",
          headers: {
            "Content-Type": "application/json"
          },
          body: JSON.stringify({ title, url })
        });

        if (!res.ok) {
          const text = await res.text();
          console.error("Erreur API:", text);
          alert("Erreur lors de l'ajout du lien.");
          return;
        }

        alert("Lien ajouté !");
        window.location.reload();
      } catch (err) {
        console.error(err);
        alert("Erreur réseau.");
      }
    });
  }

  const deleteLinkButtons = document.querySelectorAll(".btn-delete-link");

  deleteLinkButtons.forEach((button) => {
    button.addEventListener("click", async () => {
      const card = button.closest(".link-card");
      if (!card) return;

      const id = card.getAttribute("data-id");
      if (!id) return;

      if (!confirm("Supprimer ce lien ?")) return;

      try {
        const res = await fetch("/routes/supp_lien.php?id=" + encodeURIComponent(id), {
          method: "DELETE"
        });

        if (!res.ok) {
          const text = await res.text();
          console.error("Erreur API:", text);
          alert("Erreur lors de la suppression du lien.");
          return;
        }

        alert("Lien supprimé !");
        window.location.reload();
      } catch (err) {
        console.error(err);
        alert("Erreur réseau.");
      }
    });
  });
});