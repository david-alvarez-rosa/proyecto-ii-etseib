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
        }
    }
}
