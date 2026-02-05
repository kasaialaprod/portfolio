const params = new URLSearchParams(window.location.search);
    
      if (params.get('success') === '1') {
        alert('Message envoyé avec succès !');
      }

if ("serviceWorker" in navigator) {
  window.addEventListener("load", () => {
    navigator.serviceWorker
      .register("/service-worker.js")
      .catch(err => console.error("SW registration failed:", err));
  });
}
    