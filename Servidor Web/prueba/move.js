function rad_to_deg(phi) {
    return phi*(180/Math.PI);
}


function move_brazo(phi1,phi2) {
    /* Supongo que se pasa phi1 y phi2 en grados */
    /* Supongo phi2 > 0 */
    /* phi2 --> angulo que forma la barra 2 con la horizontal */
    
    var cont1 = 0;
    var deg1 = Math.ceil(phi1);
    console.log(deg1)
    var id = setInterval(frame, 50);
    var length = 250;
    function frame() {
        if (cont1 == deg1) {
	    clearInterval(id);
	    var y = -length*Math.sin(deg1*Math.PI/180);
	    var x = length*Math.cos(deg1*Math.PI/180) - length;
	    move_brazo2(phi1,phi2,x,y);
	}
	else {
	    ++cont1;
            brazo.style.transform = "rotate(" + -cont1.toString() + "deg)";
            console.log(cont1)
            var y = -length*Math.sin(cont1*Math.PI/180);
            var x = length*Math.cos(cont1*Math.PI/180) - length;
            brazo2.style.transform = "translate(" + x.toString() + "px, " + y.toString() + "px)";
            pinza.style.transform = "translate(" + x.toString() + "px, " + y.toString() + "px)";
	    tenazas_v1.style.transform = "translate(" + x.toString() + "px, " + y.toString() + "px)";
	    tenazas_v2.style.transform = "translate(" + x.toString() + "px, " + y.toString() + "px)";
	    tenazas_h.style.transform = "translate(" + x.toString() + "px, " + y.toString() + "px)";
	    console.log("out2.0")
	}
    }
}

function move_brazo2(phi1,phi2,x,y) {
    console.log(x)
    console.log(y)
    var deg1 = Math.ceil(phi1);
    var deg2 = Math.ceil(phi2);
    var length = 250;
    console.log(deg2)
    var cont2 = 0;
    var id2 = setInterval(frame2, 50);
    function frame2() {
	if (cont2 == deg2) {
	    clearInterval(id2);
	}
	else {
	    ++cont2;

	    console.log(x);
	    console.log(cont2);
	    brazo2.style.transform = "translate(" + x.toString() + "px, " + y.toString() + "px) rotate(" + cont2.toString() + "deg)";
	    var xp = x + length*(Math.cos(cont2*Math.PI/180) - 1) - 10;
	    var yp = y + length*Math.sin(cont2*Math.PI/180);
	    console.log(xp);
	    pinza.style.transform = "translate(" + xp.toString() + "px, " + yp.toString() + "px)";
	    tenazas_v1.style.transform = "translate(" + xp.toString() + "px, " + yp.toString() + "px)";
	    tenazas_v2.style.transform = "translate(" + xp.toString() + "px, " + yp.toString() + "px)";
	    tenazas_h.style.transform = "translate(" + xp.toString() + "px, " + yp.toString() + "px)";
	}
    }
}
