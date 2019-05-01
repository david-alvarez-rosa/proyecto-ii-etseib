<div align="center">
   <br />
   <h2>Ángulos servos última jugada</h2>
   <br />
   <table border="1" class="data">
      <tr>
         <th></th>
         <th>ROTACIÓN (0)</th>
         <th>BRAZO PRINCIPAL (1)</th>
         <th>BRAZO SECUNDARIO (2)</th>
         <th>PINZA ROTACIÓN (4)</th>
         <th>PINZA APERTURA (5)</th>
      </tr>
      <tr>
         <td colspan="6">Movimiento humano.</td>
      </tr>

      <?php
      for ($i = 0; $i < 9; ++$i) {
          echo '<tr>';
          echo '<td><b>Mov '.$i.'</b></td>';
          for ($j = 0; $j < 5; ++$j)
              echo '<td>'.$outputArray[5*$i + $j + 4].'</td>';
          echo '</tr>';
      }
      ?>
      <tr>
         <td colspan="6">Movimiento brazo.</td>
      </tr>
      <?php
      for ($ip = 9; $ip < 18; ++$ip) {
          echo '<tr>';
          $ipp = $ip - 9;
          echo '<td><b>Mov '.$ipp.'</b></td>';
          for ($jp = 0; $jp < 5; ++$jp)
              echo '<td>'.$outputArray[5*$ip + $jp + 10].'</td>';
          echo '</tr>';
      }
      ?>
   </table>

   <br />
   <ul align="center">
      <li><b>Mov 0:</b> Posición predeterminada.</li>
      <li><b>Mov 1:</b> Pinza sobre la pieza a coger en el almacén (a la altura justa para que al cerrar la pinza coja la pieza).</li>
      <li><b>Mov 2:</b> Justo después de cerrar la pinza.</li>
      <li><b>Mov 3:</b> Subir la pinza para que no se choque.</li>
      <li><b>Mov 4:</b> Sobre la posición final.</li>
      <li><b>Mov 5:</b> Pinza bajada sobre posición final.</li>
      <li><b>Mov 6:</b> Pieza soltada en la posición final (con las pinzas abiertas).</li>
      <li><b>Mov 7:</b> Subir la pinza para que no se choque.</li>
      <li><b>Mov 8:</b> Posición predeterminada.</li>
   </ul>


   <br /><br /><br /><br />
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
         <td>x = <?php echo $outputArray[0]; ?> , y = <?php echo $outputArray[1] ?> [mm]</td>
         <td>Falta, pero va por orden.</td>
         <td>x = <?php echo $outputArray[2]; ?> , y = <?php echo $outputArray[3] ?> [mm]</td>
         <td>Fila = <?php echo $outputArray[49] + 1; ?> - Columna = <?php echo $outputArray[50] + 1; ?></td>
      </tr>
      <tr>
         <td colspan="4">Movimiento brazo (mueve X's).</td>
      </tr>
      <tr>
         <td>x = <?php echo $outputArray[51]; ?> , y = <?php echo $outputArray[52] ?> [mm]</td>
         <td>Falta, pero va por orden.</td>
         <td>x = <?php echo $outputArray[53]; ?> , y = <?php echo $outputArray[54] ?> [mm]</td>
         <td>Fila = <?php echo $outputArray[100] + 1; ?> - Columna = <?php echo $outputArray[101] + 1; ?></td>
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
