const staticCacheName = "site-static-v1.4.8";
const assets = ["/index.php", "/wp-content/themes/hirogas_2023/css/style.css", "https://fonts.googleapis.com/css2?family=Murecho:wght@700&family=Noto+Sans+JP:wght@400;700&family=Roboto+Condensed:wght@400;700&family=Noto+Sans:wght@400;700&display=swap"];
// install event
self.addEventListener("install", (evt) => {
  //evt.waitUntil(self.skipWaiting());
  evt.waitUntil(
    caches.open(staticCacheName).then((cache) => {
      console.log("caching shell assets");
      cache.addAll(assets);
    })
  );
});
// activate event

self.addEventListener("activate", (evt) => {
  evt.waitUntil(
    caches.keys().then((keys) => {
      return Promise.all(keys.filter((key) => key !== staticCacheName).map((key) => caches.delete(key)));
    })
  );
});

// When we change the name we could have multiple cache, to avoid that we need to delet the old cache, so with this function we check the key that is our cache naming, if it is different from the actual naming we delete it, in this way we will always have only the last updated cache.
// fetch event

self.addEventListener("fetch", (evt) => {
  evt.respondWith(
    caches.match(evt.request).then((cacheRes) => {
      return cacheRes || fetch(evt.request);
    })
  );
});
