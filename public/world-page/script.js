/*const params = new URLSearchParams(window.location.search);
    
      if (params.get('success') === '1') {
        alert('Message envoyé avec succès !');
      }

if ("serviceWorker" in navigator) {
  window.addEventListener("load", () => {
    navigator.serviceWorker
      .register("/service-worker.js")
      .catch(err => console.error("SW registration failed:", err));
  });
}*/ 

  const btn = document.getElementById('showCardsBtn');
  const hero = document.querySelector('.section-hero');

  btn.addEventListener('click', (event) => {
    event.preventDefault();
    hero.classList.toggle('section-hero--expanded');
  });
