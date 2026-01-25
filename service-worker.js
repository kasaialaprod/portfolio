const URLS_TO_CACHE = [
  "/",
  "/style.css",
  "/script.js",
  "/asset/image/icon-192.png",
  "/asset/image/icon-512.png"
];


// Installation : mise en cache des ressources de base
self.addEventListener("install", event => {
  event.waitUntil(
    caches.open(CACHE_NAME).then(cache => cache.addAll(URLS_TO_CACHE))
  );
});

// Activation : nettoyage des anciens caches
self.addEventListener("activate", event => {
  event.waitUntil(
    caches.keys().then(keys =>
      Promise.all(
        keys
          .filter(key => key !== CACHE_NAME)
          .map(key => caches.delete(key))
      )
    )
  );
});

// Interception des requêtes : cache d'abord, réseau ensuite
self.addEventListener("fetch", event => {
  event.respondWith(
    caches.match(event.request).then(response => {
      return (
        response ||
        fetch(event.request).catch(() => caches.match("/"))
      );
    })
  );
});
