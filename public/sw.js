const CACHE_STATIC_NAME = 'static-v1';


self.addEventListener("install", (e) => {
    this.skipWaiting();
    const cachestatic = caches.open(CACHE_STATIC_NAME).then((cache) => {
        return cache.addAll([
            "/offline",
            "/js/pouchdb.min.js",
            "/js/jquery.js",
            "/css/app.css",
            "/css/quehacer.css",
            "/js/app.js",
        ]);
    });
    //
    // const cachesinmutable = caches.open(CACHE_INMUTABLE_NAME).then((cache) => {
    //   return cache.addAll([
    //     'https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js',
    //   ]);
    // });


    e.waitUntil(cachestatic);
});



self.addEventListener("fetch", (event) => {
    event.respondWith(
        caches
        .match(event.request)
        .then((response) => {
            return response || fetch(event.request);
        })
        .catch(() => {
            return caches.match("/");
        })
    );
});

//push notifications

self.addEventListener('push', e => {
    var data = e.data.json();
    console.log(data.title);
    const title = data.title;
    const options = {
        body: data.body,
        icon: 'https://www.fotosregresoseguro.com/img/icon-72x72.png',
        badge: 'https://www.fotosregresoseguro.com/img/icon-72x72.png',
        vibrate: [125, 75, 125, 275, 200, 275, 125, 75, 125, 275, 200, 600, 200, 600],
        openUrl: 'https://encuestasregresoseguro.com/',
        data: {
            url: 'https://encuestasregresoseguro.com/',
        }
    };

    e.waitUntil(self.registration.showNotification(title, options));
});


self.addEventListener('notificationclose', e => {

    console.log('cerrrada');
    console.log(e);

});

self.addEventListener('notificationclick', e => {

    const notificacion = e.notification;

    const action = e.action;

    clients.openWindow(notificacion.data.url);
    notification.close();

});