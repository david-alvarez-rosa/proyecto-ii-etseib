// Funciones para web.
function mostrarAnimacion() {
    botonControl.style.border = "";
    animacion.style.visibility = "visible";
    planta.style.visibility = "hidden";
    alzado.style.top = "250px";
    alzado.style.transform = "scale(.7, .7)";
    animacion.style.height = "300px";
    animacion.style.width = "500px";
    animacion.style.top = "120px";
    animacion.style.left = "50px";
    animacion.style.background = "#F0F0F0";
    animacion.style.border = "";
    velocidad.style.display = "none";
    botonAnimacion.style.border = "3px inset Black";
    cerrarPant.style.display = "none";
    pantCompl.style.display = "block";
    comenzarAnimacion();
}


function mostrarAnimacionCompleta() {
    planta.style.visibility = "visible";
    alzado.style.top = "290px";
    alzado.style.transform = "scale(.8, .8)";
    animacion.style.height = "530px";
    animacion.style.width = "96.5%";
    animacion.style.top = "10px";
    animacion.style.left = "17px";
    animacion.style.border = "3px solid Black";
    animacion.style.background = "##E6E6E6";
    velocidad.style.display = "block";
    cerrarPant.style.display = "block";
    pantCompl.style.display = "none";
}


function cerrarAnimacion() {
    control.style.visibility = "visible";
    animacion.style.visibility = "hidden";
    planta.style.visibility = "hidden";
    mostrarControles();
}


function mostrarControles() {
    animacion.style.visibility = "hidden";
    control.style.visibility ="visible";
    botonControl.style.border = "3px inset Black";
    botonAnimacion.style.border = "";
}


function almacenColorA(color) {
    almacenPieza0A.style.background = color;
    almacenPieza1A.style.background = color;
    almacenPieza2A.style.background = color;
    almacenPieza3A.style.background = color;
    almacenPieza4A.style.background = color;
}


function piezaPinzaColorA(color) {
    piezaPinzaA.style.background = color;
}


function actualizaAlmacenA(noAlmacen) {
    for (var i = 0; i < 4; ++i) {
        if (i < noAlmacen)
            document.getElementById("almacenPieza" + i + "A").style.display = "none";
        else
            document.getElementById("almacenPieza" + i + "A").style.display = "block";
    }
}


// Funciones para movimiento del brazo robótico virtual.
function sleep(delay) {
    return new Promise(resolve => setTimeout(resolve, delay));
}


async function rotacionP(phi0, phif) {
    sleepTime = 1.35*delay*Math.abs(phi0 - phif);

    var phi = phi0;
    var inc = 1;

    if (phi0 > phif)
        inc = -1;

    while (phi != phif) {
        await sleep(delay);
        phi += inc;
        robotP.style.transform = "rotate(" + (-phi) + "deg)";
        pinzaContP.style.transform = "rotate(" + phi + "deg)";
    }
}


async function move_barra1(phi0, phif) {
    var phi = phi0;
    var inc = 1;
    if (phi0 > phif)
        inc = -1;

    while (phi != phif) {
        await sleep(delay);
        phi += inc;

        barra1ACont.style.transform = "rotate(-" + phi + "deg)";

        var xBarra2A = xBarra2AIniA + length1A*Math.cos(phi*Math.PI/180);
        var yBarra2A = yBarra2AIniA + length1A*(Math.sin(phi*Math.PI/180) - 1);
        barra2A.style.left = xBarra2A + "px";
        barra2A.style.bottom = yBarra2A + "px";

        var xPinza = posPinzaA[0] + length1A*(Math.cos(phi*Math.PI/180) - Math.cos(phi0*Math.PI/180));
        var yPinza = posPinzaA[1] + length1A*(Math.sin(phi*Math.PI/180) - Math.sin(phi0*Math.PI/180));
        pinzaContA.style.left = xPinza + "px";
        pinzaContA.style.bottom = yPinza + "px";

        var length1P = length1A*(Math.cos(phi*Math.PI/180));
        barra1P.style.width = length1P + "px";
        articulacionPos1P.style.left = length1P - 15 + "px";
        barra2ContP.style.left = length1P + 40 + "px";
        extensionP.style.left = 40 + length1P + document.getElementById("barra2P").offsetWidth + "px";
        pinzaContP.style.left = 40 + length1P + document.getElementById("barra2P").offsetWidth + 51.6 + "px";
    }

    posPinzaA = [xPinza, yPinza];
}


async function move_barra2(phi0, phif) {
    var phi = phi0;
    var inc = 1;
    if (phi0 > phif)
        inc = -1;

    var transPinzaIni = document.getElementById("pinzaContA").style.transform;
    while (phi != phif) {
        await sleep(delay);
        phi += inc;

        barra2A.style.transform = "rotate(" + phi + "deg)";

        var xPinza = posPinzaA[0] + length2A*(Math.cos(phi*Math.PI/180) - Math.cos(phi0*Math.PI/180));
        var yPinza = posPinzaA[1] + length2A*(-Math.sin(phi*Math.PI/180) + Math.sin(phi0*Math.PI/180));
        pinzaContA.style.left = xPinza + "px";
        pinzaContA.style.bottom = yPinza + "px";

        var length2P = length2A*(Math.cos(phi*Math.PI/180));
        barra2P.style.width = length2P + "px";
        articulacionPos2P.style.left = length2P - 15 + "px";
        extensionP.style.left = 40 + document.getElementById("barra1P").offsetWidth + length2P + "px";
        pinzaContP.style.left = 40 + document.getElementById("barra1P").offsetWidth + length2P + 51.6 + "px";
    }

    posPinzaA = [xPinza, yPinza];
}


async function move_barras(phi1, phi2) {
    var sleepTime1 = 2*delay*Math.abs(phi1 - angulosBarrasA[0]);
    var sleepTime2 = 2*delay*Math.abs(phi2 - angulosBarrasA[1]);
    sleepTime = 1.1*(sleepTime1 + sleepTime2);

    move_barra1(angulosBarrasA[0], phi1);
    await sleep(sleepTime1);
    move_barra2(angulosBarrasA[1], phi2);
    await sleep(sleepTime2);
    angulosBarrasA = [phi1, phi2];
}


async function reset() {
    move_barras(90, 77);
    await sleep(sleepTime);
}


async function move_piece(phisIni, phisEnd, posPieza, tipo, behind, posAlmacen) {
    // phis* = [rotacion, brazo1, brazo2].
    // Ir al almacén.
    rotacionP(0, phisIni[0]);
    tableroA.style.opacity = "0.1";
    if (tipo == "O") {
        document.getElementById("piezaPinzaA").style.background = "#3862E0";
        document.getElementById("almacenPieza0A").style.background = "#3862E0";
        document.getElementById("almacenPieza1A").style.background = "#3862E0";
        document.getElementById("almacenPieza2A").style.background = "#3862E0";
        document.getElementById("almacenPieza3A").style.background = "#3862E0";
        document.getElementById("almacenPieza4A").style.background = "#3862E0";
    }
    else {
        document.getElementById("piezaPinzaA").style.background = "#336600";
        document.getElementById("almacenPieza0A").style.background = "#336600";
        document.getElementById("almacenPieza1A").style.background = "#336600";
        document.getElementById("almacenPieza2A").style.background = "#336600";
        document.getElementById("almacenPieza3A").style.background = "#336600";
        document.getElementById("almacenPieza4A").style.background = "#336600";
    }
    almacenA.style.opacity = "1";
    await sleep(sleepTime);

    move_barras(angulosBarrasA[0] - 1, 20);
    await sleep(sleepTime);

    move_barras(phisIni[1], phisIni[2]);
    await sleep(sleepTime);
    document.getElementById("piezaPinzaA").style.display = "block";
    document.getElementById("almacenPieza" + posAlmacen + "A").style.display = "none";

    // Ir al tablero.
    rotacionP(phisIni[0], phisEnd[0]);
    almacenA.style.opacity = "0.1";
    tableroA.style.opacity = "1";
    await sleep(sleepTime);

    move_barras(phisEnd[1], phisEnd[2]);
    await sleep(sleepTime);
    piezaPinzaA.style.display = "none";
    document.getElementById("tableroPieza" + posPieza[1] + "A").style.display = "block";
    if (tipo == "O") {
        document.getElementById("tableroPiezaP" + posPieza).style.background = "#3862E0";
        if (behind == false)
            document.getElementById("tableroPieza" + posPieza[1] + "A").style.background = "#3862E0";
    }
    else {
        document.getElementById("tableroPiezaP" + posPieza).style.background = "#336600";
        if (behind == false)
            document.getElementById("tableroPieza" + posPieza[1] + "A").style.background = "#336600";
    }
    document.getElementById("tableroPiezaP" + posPieza).style.display = "block";

    document.getElementById("almacenPieza" + posAlmacen + "A").style.display = "block";
    reset();
}


var length1A = document.getElementById("barra1A").offsetWidth;
var length2A = document.getElementById("barra2A").offsetWidth;

var xBarra2AIniA = getComputedStyle(document.getElementById("barra2A")).getPropertyValue("left");
var yBarra2AIniA = getComputedStyle(document.getElementById("barra2A")).getPropertyValue("bottom");
// Conversión.
xBarra2AIniA = Number(xBarra2AIniA.slice(0, xBarra2AIniA.length - 2))
yBarra2AIniA = Number(yBarra2AIniA.slice(0, yBarra2AIniA.length - 2))

var delay = 25 - Number(document.getElementById("velSlider").value);
var sleepTime = 0;

// Angulos y posiciones inicio.
var posPinzaA = [120.588, 33.151];
var angulosBarrasA = [90, 77];
