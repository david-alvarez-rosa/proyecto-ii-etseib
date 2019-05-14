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
     await sleep(500);

     /* Pieza del usuario. */
     var phisIni = [<?php echo $outputArray[8].', '.$outputArray[9].', '.$outputArray[10]; ?>];
     var phisEnd = [<?php echo $outputArray[11].', '.$outputArray[12].', '.$outputArray[13]; ?>];
     var posPieza = "<?php echo $outputArray[17].$outputArray[18]; ?>";
     phisIni[0] *= -1;
     phisIni[2] *= -1;
     phisEnd[2] *= -1;
     var tipo = "O";
     move_piece(phisIni, phisEnd, posPieza, tipo);

     /* Pieza del robot. */
     await sleep(20*sleepTime);
     var phisIni = [<?php echo $outputArray[26].', '.$outputArray[27].', '.$outputArray[28]; ?>];
     var phisEnd = [<?php echo $outputArray[29].', '.$outputArray[30].', '.$outputArray[31]; ?>];
     var posPieza = "<?php echo $outputArray[35].$outputArray[36]; ?>";
     phisIni[0] *= -1;
     phisIni[2] *= -1;
     phisEnd[2] *= -1;
     var tipo = "X";
     move_piece(phisIni, phisEnd, posPieza, tipo);
 }
</script>
