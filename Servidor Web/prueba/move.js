function sleep(delay) {
    return new Promise(resolve => setTimeout(resolve, delay));
}


async function move_barra1(phi0, phif) {
    var phi = phi0;
    var inc = 1;
    if (phi0 > phif)
        inc = -1;

    while (phi != phif) {
        await sleep(delay);
        phi += inc;

        barra1Cont.style.transform = "rotate(-" + phi.toString() + "deg)";

        var xBarra2 = xBarra2Ini + length1*(Math.cos(phi*Math.PI/180) - 1);
        var yBarra2 = yBarra2Ini + length1*Math.sin(phi*Math.PI/180);
        barra2.style.left = xBarra2.toString() + "px";
        barra2.style.bottom = yBarra2.toString() + "px";

        var xPinza = posPinza[0] + length1*(Math.cos(phi*Math.PI/180) - Math.cos(phi0*Math.PI/180));
        var yPinza = posPinza[1] + length1*(Math.sin(phi*Math.PI/180) - Math.sin(phi0*Math.PI/180));
        pinzaCont.style.left = xPinza.toString() + "px";
        pinzaCont.style.bottom = yPinza.toString() + "px";
    }

    posPinza = [xPinza, yPinza];
}


async function move_barra2(phi0, phif) {
    var phi = phi0;
    var inc = 1;
    if (phi0 > phif)
        inc = -1;

    var transPinzaIni = document.getElementById("pinzaCont").style.transform;
    while (phi != phif) {
        await sleep(delay);
        phi += inc;

        barra2.style.transform = "rotate(" + phi.toString() + "deg)";

        var xPinza = posPinza[0] + length2*(Math.cos(phi*Math.PI/180) - Math.cos(phi0*Math.PI/180));
        var yPinza = posPinza[1] + length2*(-Math.sin(phi*Math.PI/180) + Math.sin(phi0*Math.PI/180));
        pinzaCont.style.left = xPinza.toString() + "px";
        pinzaCont.style.bottom = yPinza.toString() + "px";
    }

    posPinza = [xPinza, yPinza];
}


async function move_barras(phi1, phi2) {
    move_barra1(angulosBarras[0], phi1);
    await sleep(1000); // TODO: Cambiar este valor (dejarlo en función de phi1, phi2 y delay).
    move_barra2(angulosBarras[1], phi2);
}


// Función para probar.
async function move() {
    await sleep(500);
    move_barras(90, 20);
    await sleep(1500); // TODO: Cambiar este valor (dejarlo en función de phi1, phi2 y delay).
    angulosBarras = [90, 20];

    move_barras(45, 35);
    await sleep(1500); // TODO: Cambiar este valor (dejarlo en función de phi1, phi2 y delay).
    angulosBarras = [45, 35];
    pieza.style.display = "block";
    pieza3.style.display = "none";

    move_barras(65, 65);
    await sleep(1500); // TODO: Cambiar este valor (dejarlo en función de phi1, phi2 y delay).
    angulosBarras = [65, 65];

    pieza.style.display = "none";
    piezaDej.style.display = "block";

    move_barras(90, 20);
}


var length1 = document.getElementById("barra1").offsetWidth;
var length2 = document.getElementById("barra2").offsetWidth;

var xBarra2Ini = getComputedStyle(document.getElementById("barra2")).getPropertyValue("left");
var yBarra2Ini = getComputedStyle(document.getElementById("barra2")).getPropertyValue("bottom");
// Conversión.
xBarra2Ini = Number(xBarra2Ini.slice(0, xBarra2Ini.length - 2))
yBarra2Ini = Number(yBarra2Ini.slice(0, yBarra2Ini.length - 2))

var delay = 8;

var posPinza = [515, 45];
var angulosBarras = [0, 0];

move();
