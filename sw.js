const cacheName = "dbv2";
const domain = atob("aHR0cHM6Ly9kaWdpdGFsYmFyYW5nYXkuY29t");
const allowedFolder = ["/vendor/", "/fonts/"];

self.addEventListener("activate", (event) => {
    event.waitUntil(
        (async () => {
            const keys = await caches.keys();
            return keys.map(async (cache) => {
                if (cache !== cacheName) {
                    console.log("Service Worker: Removing old cache: " + cache);
                    return await caches.delete(cache);
                }
            });
        })()
    );
});

self.addEventListener("install", (event) => {
    event.waitUntil(caches.open(cacheName));
});

self.addEventListener("fetch", async (event) => {
    if (event.request.method !== "GET") return;
    if ((event.request.destination === "image" || event.request.url.includes(allowedFolder)) && event.request.url.startsWith(domain)) {
        event.respondWith(
            caches.open(cacheName).then((cache) => {
                return cache.match(event.request).then((cachedResponse) => {
                    return cachedResponse ||
                        fetch(event.request.url).then((fetchedResponse) => {
                            cache.put(event.request, fetchedResponse.clone());
                            return fetchedResponse;
                });
            });
        }));
    }
    return;
});
