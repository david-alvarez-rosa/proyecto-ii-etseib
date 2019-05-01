<!DOCTYPE HTML>
<meta charset="utf-8">

<html>
   <head>
      <link rel="stylesheet" type="text/css" href="animation.css" />
   </head>


   <body bgcolor=" #CCFFFF">

      <div id ="alzado">
         <div id ="barra2"></div>

         <div id="barra1Cont">
            <div id="barra1"></div>
            <div id="articulacionPos1">
               <div id="articulacion"></div>
            </div>
         </div>

	       <div id ="base"></div>
	       <div id="tierra"></div>

         <div id="pinzaCont">
            <div id ="pinza"></div>
	          <div id="tenazas_h"></div>
	          <div id="tenazas_v1"></div>
	          <div id="tenazas_v2"></div>
            <div id="articulacionPos2">
               <div id="articulacion"></div>
            </div>
            <div id="piezaPinza"></div>
         </div>

         <div id="almacen">
	          <div id="almacenPieza0"></div>
	          <div id="almacenPieza1"></div>
	          <div id="almacenPieza2"></div>
	          <div id="almacenPieza3"></div>
         </div>

         <div id="tablero">
	          <div id="tableroPieza0"></div>
	          <div id="tableroPieza1"></div>
	          <div id="tableroPieza2"></div>
         </div>
      </div>


      <div id="velocidad">
         <p>Ajusta la velocidad:</p>
         <form action="/proyecto/prueba/">
            <?php
            echo '<input type="range" id="velSlider" name="vel" min="5" max="20" ';
                         if (isset($_GET['vel']))
                         echo ' value="'.$_GET['vel'].'" ';
                         echo 'step="3" onchange="delay = 25 - this.value;" />';
            ?>
            <input type="submit" value="Vuelve a empezar" />
         </form>
      </div>

      <script src="move.js"></script>
   </body>
</html>
