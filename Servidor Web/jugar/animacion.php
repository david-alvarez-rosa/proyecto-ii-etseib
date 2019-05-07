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
              if ($board[3*$i + $j] == "X")
                  echo '<td><div id="tableroPiezaXP"></div></td>';
              else if ($board[3*$i + $j] == "O")
                  echo '<td><div id="tableroPiezaOP"></div></td>';
              else
                  echo '<td><a href="'.$url.$i.$j.'"><button id="ticP"><span></span></button></a></td>';
          }
          echo '</tr>';
      }
      ?>
   </table>
</div>


<script type="text/javascript">
 async function comenzarAnimacion() {
     await sleep(500);

     move_piece(3, 1);
     await sleep(550*delay);

     move_piece(-2, 3);
     await sleep(550*delay);

     reset();
 }
</script>
