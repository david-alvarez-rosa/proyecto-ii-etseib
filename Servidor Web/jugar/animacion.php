<div id ="alzado">
   <div id ="barra2A"></div>

   <div id="barra1ACont">
      <div id="barra1A"></div>
      <div id="articulacionPos1A">
         <div id="articulacion"></div>
      </div>
   </div>

   <div id ="baseA"></div>
   <div id="tierraA"></div>

   <div id="pinzaContA">
      <div id="extensionA"></div>
      <div id ="pinzaA"></div>
      <div id="tenazas_hA"></div>
      <div id="tenazas_v1A"></div>
      <div id="tenazas_v2A"></div>
      <div id="articulacionPos2A">
         <div id="articulacion"></div>
      </div>
      <div id="articulacionPos3A">
         <div id="articulacion"></div>
      </div>
      <div id="piezaPinzaA"></div>
   </div>

   <div id="almacenA">
      <div id="almacenPieza0A"></div>
      <div id="almacenPieza1A"></div>
      <div id="almacenPieza2A"></div>
      <div id="almacenPieza3A"></div>
      <div id="almacenPieza4A"></div>
   </div>

   <div id="tableroA">
      <div id="tableroPieza0A"></div>
      <div id="tableroPieza1A"></div>
      <div id="tableroPieza2A"></div>
   </div>
</div>


<div id="planta">
   <div id="almacenXsP"></div>
   <div id="almacenOsP"></div>

   <div id="robotP">
      <div id ="barra2ContP">
         <div id ="barra2P"></div>
         <div id="articulacionPos2P">
            <div id="articulacion"></div>
         </div>
      </div>

      <div id="barra1ContP">
         <div id="barra1P"></div>
         <div id="articulacionPos1P">
            <div id="articulacion"></div>
         </div>
      </div>

      <div id="articulacionPos3P">
         <div id="articulacion"></div>
      </div>

      <div id="extensionP"></div>

      <div id="pinzaContP">
         <div id="articulacionPos4P">
            <div id="articulacion"></div>
         </div>
         <div id="pinzaP"></div>
         <div id="piezaPinzaP"></div>
      </div>
   </div>

   <div id="baseP"></div>
   <div id="tierraP"></div>

   <table id="boardP">
      <?php
      for ($i = 0; $i < 3; ++$i) {
          echo '<tr>';
          for ($j = 0; $j < 3; ++$j) {
              if ($board[3*$i + $j] == "X" and ($i != $outputArray[35] or $j != $outputArray[36]))
                  echo '<td><div id="tableroPiezaXP"></div></td>';
              else if ($board[3*$i + $j] == "O" and ($i != $outputArray[17] or $j != $outputArray[18]))
                  echo '<td><div id="tableroPiezaOP"></div></td>';
              else
                  echo '<td><div id="tableroPiezaP'.$i.$j.'"></div></td>';
          }
          echo '</tr>';
      }
      ?>
   </table>
</div>

<script type="text/javascript">
 async function comenzarAnimacion() {
     var boardRaw =  "<?php echo $outputArray[sizeof($outputArray) - 3]; ?>";
     var lastORow = "<?php echo $outputArray[17]; ?>";
     var lastOColumn = "<?php echo $outputArray[18]; ?>";
     var lastXRow = "<?php echo $outputArray[35]; ?>";
     var lastXColumn = "<?php echo $outputArray[36]; ?>";
     var behindO = false;
     var behindX = false;
     for (var j = 0; j < 3; ++j)
         for (var i = 0; i < 3; ++i) {
             if (boardRaw[3*i + j] == "O" && (i != lastORow || j != lastOColumn)) {
                 document.getElementById("tableroPieza" + j + "A").style.display = "block";
                 document.getElementById("tableroPieza" + j + "A").style.background = "#3862E0";
             }
             else if (boardRaw[3*i + j] == "X" && (i != lastXRow || j != lastXColumn)) {
                 document.getElementById("tableroPieza" + j + "A").style.display = "block";
                 document.getElementById("tableroPieza" + j + "A").style.background = "#336600";
             }
             if (boardRaw[3*i + j] != ".") {
                 if (lastOColumn == j && lastORow < i)
                     behindO = true;
                 if ((lastXColumn == j && lastXRow < i) || (lastXColumn == lastOColumn && lastXRow < lastORow))
                     behindX = true;
             }
         }

     var posAlmacen =  <?php echo $outputArray[0]; ?>;
     for (var i = 0; i < posAlmacen; ++i)
         document.getElementById("almacenPieza" + i + "A").style.display = "none";

     await sleep(500);

     var web = "<?php echo $_SERVER['REQUEST_URI'][16]; ?>";
     <?php
     if ($outputArray[$n - 1] != "Not ended")
         echo 'var notEnd = false;';
     else
         echo 'var notEnd = true;';
     ?>

     /* Pieza del usuario. */
     var phisIni = [<?php echo $outputArray[8].', '.$outputArray[9].', '.$outputArray[10]; ?>];
     var phisEnd = [<?php echo $outputArray[11].', '.$outputArray[12].', '.$outputArray[13]; ?>];
     var posPieza = "<?php echo $outputArray[17].$outputArray[18]; ?>";
     phisIni[0] *= -1;
     phisIni[2] *= -1;
     phisEnd[2] *= -1;
     var tipo = "O";
     move_piece(phisIni, phisEnd, posPieza, tipo, behindO, posAlmacen);

     /* Pieza del robot. */
     if (web != "p" || notEnd) {
         await sleep(11*sleepTime);
         var phisIni = [<?php echo $outputArray[26].', '.$outputArray[27].', '.$outputArray[28]; ?>];
         var phisEnd = [<?php echo $outputArray[29].', '.$outputArray[30].', '.$outputArray[31]; ?>];
         var posPieza = "<?php echo $outputArray[35].$outputArray[36]; ?>";
         phisIni[0] *= -1;
         phisIni[2] *= -1;
         phisEnd[2] *= -1;
         var tipo = "X";
         move_piece(phisIni, phisEnd, posPieza, tipo, behindX, posAlmacen);
     }
 }
</script>
