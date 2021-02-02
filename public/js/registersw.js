var swReg;

if (navigator.serviceWorker) {
    window.addEventListener("load", function() {
        navigator.serviceWorker
            .register("/sw.js")
            .then(function(reg) {
                swReg = reg;
                swReg.pushManager.getSubscription().then(verificasubscripcion);
            });
    });
}

//  nptificaciones

function verificasubscripcion(activadas) {
    if (activadas) {
        console.log("activadas");
    } else {
        console.log("desactivadas");
    }
}

function enviarnotificacion() {
    const CustomNotifications = {
        body: "cuerpo de la notificacion",
        icon: "img/icons/icon-72x72.png",
    };

    new Notification("hola mundo", CustomNotifications);
}

const notificarme = () => {

    showNotification();
}


const showNotification = () => {

    if (!window.Notification) {
        console.log("no soporta notficaciones");
        return;
    }

    if (Notification.permission === "granted") {
        subscripcion();
    } else if (
        Notification.permission !== "denied" ||
        Notification.permission === "default"


    ) {

        Notification.requestPermission(function(permission) {
            console.log(permission);
            if (permission === "granted") {
                subscripcion();
            }
        });
    }
}