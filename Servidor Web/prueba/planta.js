function sleep(delay) {
    return new Promise(resolve => setTimeout(resolve, delay));
}


async function rotacion(phi0, phif) {
    phi0 = Math.ceil(phi0);
    phif = Math.ceil(phif);

    var phi = phi0;
    var inc = 1;

    if (phi0 > phif) {
        inc = -1;
    }

    while (phi != phif) {
        await sleep(30);
        phi += inc;
        robot.style.transform = "rotate(" + (-phi).toString() + "deg)";
        pinzaCont.style.transform = "rotate(" + phi.toString() + "deg)";
    }

}

async function acorta_barra2(l1,l2,x,phi) {
    //phi: angulo de las dos barrras
    //l1: longitud barra1
    //l2: longitud barra2 (se debera actualizar tras acortarla)
    //I.e: l2'=l2+x
    //Acortar: x <--> negativo
    //Algargar: x <--> positivo
    var cont = 0;
    var incr = -1;

    if (x > 0) {
        incr = 1;
    }
    var angle = Math.ceil(phi);
    var updt = -1;
    if (angle <= 0) {
        updt = 1;
    }
    while (angle != 0) {
        angle += updt;
        await sleep(4);
        pinzaCont.style.transform = "rotate(" + (angle).toString() + "deg)";
    }

    while (cont != x) {
        await sleep(20);
        cont += incr;
        console.log(cont)
        var izq = l2+cont;
        barra2.style.width = izq.toString() + "px";
        var izq2 = 235+(l2-250)+cont;
        articulacionPos2.style.left = izq2.toString() + "px";

        pinzaCont.style.left = (540+cont+(l2-250)+(l1-250)) + "px";
    }

    updt *= -1;
    angle = 0;
    while (angle != Math.ceil(phi)){
        angle += updt;
        await sleep(4);
        pinzaCont.style.transform = "rotate(" + (angle).toString() + "deg)";
    }
}

async function acorta_barra1(l1,l2,x,phi) {
    //l1: longitud barra1 actual
    //l2: longitud barra2 actual
    //x: mm que quieres acortar (< 0 para acortar)
    //phi: ángulo de las barras respecto la horizontal

    var cont = 0;
    var incr = -1;

    if (x > 0) {
        incr = 1;
    }
    var angle = Math.ceil(phi);
    var updt = -1;
    if (angle <= 0) {
        updt = 1;
    }
    while (angle != 0) {
        angle += updt;
        await sleep(4);
        pinzaCont.style.transform = "rotate(" + (angle).toString() + "deg)";
    }

    while (cont != x) {
        await sleep(10);
        cont += incr;
        console.log(cont)
        var l1_new = l1+cont;
        barra1.style.width = l1_new.toString() + "px";

        var izq_cont = 290+(l1-250)+cont;
        barra2Cont.style.left = izq_cont.toString() + "px";

        var izq = 235+(l1-250)+cont;
        articulacionPos1.style.left = izq.toString() + "px";

        pinzaCont.style.left = (540+(l1-250)+(l2-250)+cont) + "px";
    }

    updt *= -1;
    angle = 0;
    while (angle != Math.ceil(phi)){
        angle += updt;
        await sleep(4);
        pinzaCont.style.transform = "rotate(" + (angle).toString() + "deg)";
    }
}



//pieza roja almacen: 100 px del centro de rotacion
//pieza azul almacen: 150 px del centro de rotacion
