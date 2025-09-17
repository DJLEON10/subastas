document.addEventListener("DOMContentLoaded", function () {
        var mapa = L.map('mapa').setView([8.2395, -73.3580], 14); // Punto de inicio y zoom
    
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; OpenStreetMap contributors'
        }).addTo(mapa);
    
        let comunas = {
            comuna_uno: [
                {nombre: "20 de julio", coords: [8.2395, -73.3580]},
                {nombre: "El Llano", coords: [8.2380, -73.3565]},
                {nombre: "Las Cajas", coords: [8.2360, -73.3540]},
                {nombre: "Santa Ana", coords: [8.2345, -73.3555]},
                {nombre: "San José", coords: [8.2330, -73.3570]},
                {nombre: "Urbanización Central", coords: [8.2315, -73.3595]},
                {nombre: "Hacaritama", coords: [8.2315, -73.3595]},
                {nombre: "Tacaloa", coords: [8.2315, -73.3595]},
                {nombre: "San Agustín", coords: [8.2315, -73.3595]},
                {nombre: "La Modelo", coords: [8.2315, -73.3595]}
            ],
            comuna_dos: [
                {nombre: "El Dorado", coords: [8.25477, -73.35468]},
                {nombre: "Nuevo Horizonte", coords: [8.236, -73.353]},
                {nombre: "Cañaveral", coords: [8.25235, -73.35776]},
                {nombre: "El Carmen", coords: [8.25361, -73.35409]},
                {nombre: "Simón Bolívar", coords: [8.24558, -73.35171]},
                {nombre: "Sesquicentenario", coords: [8.24848, -73.35584]},
                {nombre: "Fundadores", coords: [8.14528, -73.21126]},
                {nombre: "Comuneros", coords: [8.24752, -73.35427]},
                {nombre: "Urbanización Los Alpes", coords: [8.24397, -73.35516]},
                {nombre: "Cristo Rey", coords: [8.24021, -73.34979]},
                {nombre: "El Retiro", coords: [8.24613, -73.35566]},
                {nombre: "El Peñón", coords: [8.24578, -73.35446]},
                {nombre: "Urbanización Bruselas", coords: [8.24455, -73.35374]},
                {nombre: "Betania", coords: [7.23895, -73.35229]},
                {nombre: "Nueve de Octubre", coords: [8.23652, -73.3469]},
                {nombre: "Palomar", coords: [8.23557, -73.34966]}
            ],
            comuna_tres: [
                {nombre: "Camino Real", coords: [8.23526, -73.34713]},
                {nombre: "Santa Lucía", coords: [8.236, -73.352]},
                {nombre: "Las Mercedes", coords: [8.237, -73.351]},
                {nombre: "La Palmita", coords: [8.23172, -73.35046]},
                {nombre: "Belén", coords: [8.22783, -73.33664]},
                {nombre: "Olaya Herrera", coords: [8.22956, -73.35314]}
            ],
            comuna_cuatro: [
                {nombre: "Santa Cruz", coords: [8.36465, -73.31888]},
                {nombre: "El Tejarito", coords: [8.23607, -73.35491]},
                {nombre: "Junín", coords: [8.23773, -73.35604]},
                {nombre: "La Torcoroma", coords: [8.23735, -73.35930]},
                {nombre: "Juan XXIII", coords: [8.23764, -73.36066]},
                {nombre: "La Libertad", coords: [8.23995, -73.36054]},
                {nombre: "El Landia", coords: [8.24292, -73.36223]},
                {nombre: "La Esmeralda", coords: [8.24278, -73.36101]}
            ],
            comuna_cinco: [
                {nombre: "Las Ferias", coords: [8.23767, -73.35602]},
                {nombre: "Buenos Aires", coords: [8.26089, -73.35770]},
                {nombre: "Las Palmeras", coords: [8.26276, -73.35897]},
                {nombre: "La Primavera", coords: [8.25979, -73.35801]},
                {nombre: "Ciudad Jardín", coords: [8.25562, -73.35907]}
            ],
            comuna_seis: [
                {nombre: "Santa Clara", coords: [8.26891, -73.36530]},
                {nombre: "Bermejal", coords: [8.26881, -73.36481]},
                {nombre: "Urbanización Colinas de La Florida", coords: [8.26637, -73.3638]},
                {nombre: "El Líbano", coords: [8.27159, -73.36753]},
                {nombre: "La Gloria", coords: [8.26339, -73.36059]},
                {nombre: "Dos de Octubre", coords: [8.26646, -73.36685]}
            ]
        };
    
        // Convertir el nombre de la comuna del habitante a la clave del objeto
        let comunaClave = "comuna_" + comunaHabitante.toLowerCase().replace(" ", "_");
    
        // Dibujar el polígono si existe la comuna en el objeto
        if (comunaHabitante && comunas[comunaClave]) {
            let coordenadas = comunas[comunaClave].map(barrio => barrio.coords);
            L.polygon(coordenadas, { color: 'blue', fillOpacity: 0.5 }).addTo(mapa);
        }
    });
    