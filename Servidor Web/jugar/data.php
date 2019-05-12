<div align="center">
   <br />
   <h2>Ángulos animación última jugada</h2>
   <br />
   <table border="1" class="data">
      <tr>
         <th></th>
         <th>ROTACIÓN (0)</th>
         <th>BRAZO PRINCIPAL (1)</th>
         <th>BRAZO SECUNDARIO (2)</th>
      </tr>
      <tr>
         <td colspan="6">Movimiento humano.</td>
      </tr>

      <?php
      for ($i = 0; $i < 4; ++$i) {
          echo '<tr>';
          echo '<td><b>Mov '.($i + 1).'</b></td>';
          for ($j = 0; $j < 3; ++$j)
              echo '<td>'.$outputArray[3*$i + $j + 5].'</td>';
          echo '</tr>';
      }
      ?>
      <tr>
         <td colspan="6">Movimiento brazo.</td>
      </tr>
      <?php
      for ($ip = 4; $ip < 8; ++$ip) {
          echo '<tr>';
          echo '<td><b>Mov '.($ip - 3 ).'</b></td>';
          for ($jp = 0; $jp < 3; ++$jp)
              echo '<td>'.$outputArray[3*$ip + $jp + 11].'</td>';
          echo '</tr>';
      }
      ?>
   </table>

   <br />
   <ul align="center">
      <li><b>Mov 1:</b> Posición predeterminada.</li>
      <li><b>Mov 2:</b> Recogida de pieza del almacén.</li>
      <li><b>Mov 3:</b> Pieza dejada sobre el tablero.</li>
      <li><b>Mov 4:</b> Posición predeterminada.</li>
   </ul>


   <br /><br />
   <h2>Movimiento piezas última jugada</h2>
   <br />
   <table border="1" class="data">
      <tr>
         <th>PIEZA COGIDA DE (ejes)</th>
         <th>PIEZA COGIDA DE (número)*</th>
         <th>PIEZA DEJADA EN (ejes)</th>
         <th>PIEZA DEJADA EN (tablero)**</th>
      </tr>
      <tr>
         <td colspan="4">Movimiento humano (mueve O's).</td>
      </tr>
      <tr>
         <td>x = <?php echo $outputArray[1]; ?> , y = <?php echo $outputArray[2] ?> [mm]</td>
         <td> <?php echo 4 - $outputArray[0]; ?> </td>
         <td>x = <?php echo $outputArray[3]; ?> , y = <?php echo $outputArray[4] ?> [mm]</td>
         <td>Fila = <?php echo $outputArray[17] + 1; ?> - Columna = <?php echo $outputArray[18] + 1; ?></td>
      </tr>
      <tr>
         <td colspan="4">Movimiento brazo (mueve X's).</td>
      </tr>
      <tr>
         <td>x = <?php echo $outputArray[19]; ?> , y = <?php echo $outputArray[20] ?> [mm]</td>
         <td> <?php echo 4 - $outputArray[0];  ?> </td>
         <td>x = <?php echo $outputArray[21]; ?> , y = <?php echo $outputArray[22] ?> [mm]</td>
         <td>Fila = <?php echo $outputArray[35] + 1; ?> - Columna = <?php echo $outputArray[36] + 1; ?></td>
      </tr>
   </table>

   <br />
   <ul>
      <li><b>*</b>Número de pieza en el almacén correspondiente (hay 4 huecos en cada almacén).</li>
      <li><b>**</b>Posición relativa en el tablero (fila y columna).</li>
      <li>Los ejes parten del brazo (que está puesto donde está el título de
         la página, es decir, detrás del tablero). Eje de abcisas horizontal (en
         pantalla de ordenador) y de ordenadas vertical (ídem).</li>
   </ul>

   <br /><br /><br />
</div>
