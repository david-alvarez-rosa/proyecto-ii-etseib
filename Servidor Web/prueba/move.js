function myMove() {
    var deg = 0;
    var id = setInterval(frame, 20);
    var length = 250;
    function frame() {
        if (deg == -60) {
            clearInterval(id);
        }
        else {
            --deg;
            brazo.style.transform = "rotate(" + deg.toString() + "deg)";
            console.log(deg)
            var y = length*Math.sin(deg*Math.PI/180);
            var x = length*Math.cos(deg*Math.PI/180) - length;
            brazo2.style.transform = "translate(" + x.toString() + "px, " + y.toString() + "px)";
            pinza.style.transform = "translate(" + x.toString() + "px, " + y.toString() + "px)";
	    tenazas_v1.style.transform = "translate(" + x.toString() + "px, " + y.toString() + "px)";
	    tenazas_v2.style.transform = "translate(" + x.toString() + "px, " + y.toString() + "px)";
	    tenazas_h.style.transform = "translate(" + x.toString() + "px, " + y.toString() + "px)";
	}
    }

    var deg2 = 0;
    var id2 = setInterval(frame2, 15);
    function frame2() {
        if (deg2 == 30) {
            clearInterval(id2);
        }
        else if (deg == -60) {
            ++deg2;
            var y = length*Math.sin(deg*Math.PI/180);
            var x = length*Math.cos(deg*Math.PI/180) - length;
            brazo2.style.transform = "translate(" + x.toString() + "px, " + y.toString() + "px) rotate(" + deg2.toString() + "deg)";
            var xp = x + length*(Math.cos(deg2*Math.PI/180) - 1) - 10;
            var yp = y + length*Math.sin(deg2*Math.PI/180);
            pinza.style.transform = "translate(" + xp.toString() + "px, " + yp.toString() + "px)";
	    tenazas_v1.style.transform = "translate(" + xp.toString() + "px, " + yp.toString() + "px)";
	    tenazas_v2.style.transform = "translate(" + xp.toString() + "px, " + yp.toString() + "px)";
	    tenazas_h.style.transform = "translate(" + xp.toString() + "px, " + yp.toString() + "px)";
        }
    }
}

function rad_to_deg(phi) {
    return phi*(180/Math.PI);
}

function move_brazo(phi1,phi4) {
    /* Supongo que se pasa phi1 y phi4 en radianes */
    /* Supongo phi4 < 2*pi */

    var deg = Math.ceil(360-rad_to_deg(phi4));
    console.log(deg)
    var id_brazo2 = setInterval(frame4, 500);
    var length = 250;
    function frame4() {
	if (deg == 0) {
	    clearInterval(id_brazo2)
	}
	else {
	    --deg;
	    var y = length*Math.sin(deg*Math.PI/180);
            var x = length*Math.cos(deg*Math.PI/180) - length;
            brazo2.style.transform = "translate(" + x.toString() + "px, " + y.toString() + "px) rotate(" + deg.toString() + "deg)";
            var xp = x + length*(Math.cos(deg*Math.PI/180) - 1) - 10;
            var yp = y + length*Math.sin(deg*Math.PI/180);
            pinza.style.transform = "translate(" + xp.toString() + "px, " + yp.toString() + "px)";
	    tenazas_v1.style.transform = "translate(" + xp.toString() + "px, " + yp.toString() + "px)";
	    tenazas_v2.style.transform = "translate(" + xp.toString() + "px, " + yp.toString() + "px)";
	    tenazas_h.style.transform = "translate(" + xp.toString() + "px, " + yp.toString() + "px)";
	}
    }
}
