// public/js/cookies.js

// Función para crear cookies
function setCookie(name, value, minutes) {
    const date = new Date();
    date.setTime(date.getTime() + minutes * 60 * 1000);
    document.cookie = `${name}=${value};expires=${date.toUTCString()};path=/`;
}

// Función para leer cookies
function getCookie(name) {
    const cookieArr = document.cookie.split("; ");
    for (let i = 0; i < cookieArr.length; i++) {
        const cookiePair = cookieArr[i].split("=");
        if (name === cookiePair[0]) {
            return decodeURIComponent(cookiePair[1]);
        }
    }
    return null;
}

// 1️⃣ Guardar ubicación del usuario
if (navigator.geolocation) {
    navigator.geolocation.getCurrentPosition((position) => {
        const ubicacion = `${position.coords.latitude},${position.coords.longitude}`;
        setCookie("ubicacion", ubicacion, 60); // dura 1 hora
    });
}

// 2️⃣ Hora de ingreso (día, mes, año y hora)
const fechaActual = new Date();
setCookie("hora_ingreso", fechaActual.toLocaleString(), 60);

// 3️⃣ Capturar categorías en las que el usuario da clic
document.addEventListener("click", function (e) {
    if (e.target.classList.contains("categoria")) {
        let categorias = getCookie("categorias") || "";
        categorias += `${e.target.dataset.nombre}, `;
        setCookie("categorias", categorias, 60);
    }
});

// 4️⃣ Medir tiempo dentro de la página
let tiempoInicio = Date.now();
window.addEventListener("beforeunload", () => {
    const tiempoFinal = (Date.now() - tiempoInicio) / 1000; // en segundos
    setCookie("tiempo_dentro", tiempoFinal, 60);
});

// 5️⃣ Capturar si intentó subastar
document.addEventListener("click", function (e) {
    if (e.target.classList.contains("btn-subasta")) {
        setCookie("intento_subastar", "true", 60);
    }
});

document.querySelector("#categoria")?.addEventListener("change", function() {
    const categoriaSeleccionada = this.options[this.selectedIndex].text;
    let categorias = getCookie("categorias") || "";
    categorias += `${categoriaSeleccionada}, `;
    setCookie("categorias", categorias, 60);
});


document.addEventListener("click", function (e) {
    if (e.target.classList.contains("btn-subasta")) {
        setCookie("intento_subastar", "true", 60);
        console.log("🍪 Cookie intento_subastar creada correctamente");
    }
});

