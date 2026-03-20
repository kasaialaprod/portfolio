"use strict";

document.addEventListener("DOMContentLoaded", () => {
  // Bouton ajout projet
  const btn = document.getElementById("new-projet");

  if (btn) {
    btn.addEventListener("click", async () => {
      const title = prompt("Titre du projet");
      if (!title) return;

      const url = prompt("URL du projet");
      if (!url) return;

      try {
        const res = await fetch("ajout_projet.php", {
          method: "POST",
          headers: {
            "Content-Type": "application/json"
          },
          body: JSON.stringify({
            title,
            url,
            tech: "html-css"
          })
        });

        if (!res.ok) {
          const text = await res.text();
          console.error("Erreur API:", text);
          alert("Erreur lors de l'ajout du projet.");
          return;
        }

        alert("Projet ajouté !");
        window.location.reload();
      } catch (err) {
        console.error(err);
        alert("Erreur réseau.");
      }
    });
  }

  // Boutons supprimer
  const deleteButtons = document.querySelectorAll(".btn-delete");

  deleteButtons.forEach((button) => {
    button.addEventListener("click", async () => {
      const card = button.closest(".card");
      if (!card) return;

      const id = card.getAttribute("data-id");
      if (!id) return;

      if (!confirm("Supprimer ce projet ?")) return;

      try {
        const res = await fetch("supprimer_projet.php?id=" + encodeURIComponent(id), {
          method: "DELETE"
        });

        if (!res.ok) {
          const text = await res.text();
          console.error("Erreur API suppression:", text);
          alert("Erreur lors de la suppression.");
          return;
        }

        // retire la carte sans recharger la page
        card.remove();
      } catch (err) {
        console.error(err);
        alert("Erreur réseau.");
      }
    });
  });
});
