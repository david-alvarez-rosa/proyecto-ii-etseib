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
    var sleepTime1 = 1.35*delay*Math.abs(phi1 - angulosBarras[0]);
    var sleepTime2 = 1.35*delay*Math.abs(phi2 - angulosBarras[1]);
    sleepTime = 1.1*(sleepTime1 + sleepTime2);

    move_barra1(angulosBarras[0], phi1);
    await sleep(sleepTime1);
    move_barra2(angulosBarras[1], phi2);
    await sleep(sleepTime2);
    angulosBarras = [phi1, phi2];
}


async function move_piece(noAlmacen, noTablero) {
    // Ir al almacén.
    tablero.style.opacity = "0.1";
    move_barras(angulosBarras[0] - 1, 20);
    await sleep(sleepTime);

    almacen.style.opacity = "1";
    move_barras(almacenAngs[noAlmacen][0], almacenAngs[noAlmacen][1]);
    await sleep(sleepTime);
    document.getElementById("piezaPinza").style.display = "block";
    document.getElementById("almacenPieza" + noAlmacen).style.display = "none";

    // Ir al tablero.
    almacen.style.opacity = "0.1";
    tablero.style.opacity = "1";
    move_barras(tableroAngs[noTablero][0], tableroAngs[noTablero][1]);
    await sleep(sleepTime);
    piezaPinza.style.display = "none";
    document.getElementById("tableroPieza" + noTablero).style.display = "block";
}


async function reset() {
    move_barras(90, 73);
    await sleep(sleepTime);
}


// Función para probar.
async function move() {
    reset();
    await sleep(280*delay + 500);

    move_piece(0, 0);
    await sleep(250*delay);

    move_piece(1, 2);
    await sleep(250*delay);

    move_piece(2, 1);
    await sleep(250*delay);

    reset();
}


var length1 = document.getElementById("barra1").offsetWidth;
var length2 = document.getElementById("barra2").offsetWidth;

var xBarra2Ini = getComputedStyle(document.getElementById("barra2")).getPropertyValue("left");
var yBarra2Ini = getComputedStyle(document.getElementById("barra2")).getPropertyValue("bottom");
// Conversión.
xBarra2Ini = Number(xBarra2Ini.slice(0, xBarra2Ini.length - 2))
yBarra2Ini = Number(yBarra2Ini.slice(0, yBarra2Ini.length - 2))

var delay = 12;
var sleepTime = 0;

var posPinza = [515, 45];
var angulosBarras = [0, 0];

var almacenAngs = [[48, 31], [45, 35], [42, 39], [39, 42]];
var tableroAngs = [[71, 75], [67, 68], [61, 63]];

move();
