<!DOCTYPE HTML>

<html>
   <head>
      <meta charset="UTF-8">
      <title>Tres en Raya</title>
      <link rel="stylesheet" type="text/css" href="../../layout.css" />
      <link rel="stylesheet" type="text/css" href="../../board.css" />
      <style type="text/css">
       .data {
           width: 90%;
           min-width: 500px;
           height: 70px;
           text-align: center;
       }
      </style>
      <!-- <meta http-equiv="refresh" content="3;URL='https://alvarezrosa.com'" /> -->
   </head>


   <body>
      <header id="header">
         <h1 align="center">
            <span style="float: left;"><a href="/proyecto/">Tres en Raya</a></span>
            <a href="/proyecto/jugar/">Jugar</a>
            <span style="float: right;"><a href="/proyecto/jugar/ai/">Comienza el brazo</a></span>
         </h1>
      </header>


      <?php
      include("../../navbar.html")
      ?>


      <main>
         <?php
         function endGame($message) {
             echo '<div class="modal-wrapper">
         <div class="modal">
            <div class="head">
               <h3>';
             echo $message;
             echo '</h3>
      </div>
      <a href="/proyecto/ai/" id="playAsX"><button>Vuelve a empezar</button></a>
      </div>
      </div>
             ';
         }
         ?>

         <?php
         if (isset($_GET['movs'])) {
             $movs = $_GET['movs'];
             if (isset($_GET['rama'])) {
                 $rama = $_GET['rama'];
                 $nodo = $_GET['nodo'];
                 $sims = $_GET['sims'];
                 $eb = $_GET['eb'];
                 $command = 'python3 ../../cgi-bin/main2.py '.$movs.' '.$rama.' '.$nodo.' '.$sims.' '.$eb;
             }
             else
                 $command = 'python3 ../../cgi-bin/main2.py '.$movs.' 3 0 -1 False';

             $output = exec($command);
             $outputArray = split(",", $output);
             $n = sizeof($outputArray);

             $board = $outputArray[$n - 2];
             $url = $outputArray[$n - 1];

             if ($output == "AI wins")
                 endGame("AI wins");
             else if ($output == "Tie")
                 endGame("Tie");
         }
         else {
             $board = 'X........';
             $url = '?movs=';
         }
         ?>

         <br /><br />
         <table id="board">
            <?php
            for ($i = 0; $i < 3; ++$i) {
                echo '<tr>';
                for ($j = 0; $j < 3; ++$j) {
                    if ($board[3*$i + $j] != ".")
                        echo '<td id ="'.$board[3*$i + $j].'">'.$board[3*$i + $j].'</td>';
                    else
                        echo '<td><a href="'.$url.$i.$j.'"><button id="tic"><span></span></button></a></td>';
                }
                echo '</tr>';
            }
            ?>
         </table>

         <br /><br />
         <div align="center">
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
               for ($i = 0; $i < 7; ++$i) {
                   echo '<tr>';
                   echo '<td><b>Mov '.$i.'</b></td>';
                   for ($j = 0; $j < 5; ++$j) {
                       echo '<td>';
                       if ($outputArray[5*$i + $j + 4] < -5000)
                           echo 'Abierta';
                       else if ($outputArray[5*$i + $j + 4] > 5000)
                           echo 'Cerrada';
                       else
                           echo $outputArray[5*$i + $j + 4];
                       echo '</td>';
                   }
                   echo '</tr>';
               }
               ?>
               <tr>
                  <td colspan="6">Movimiento brazo.</td>
               </tr>
               <?php
               for ($ip = 7; $ip < 14; ++$ip) {
                   echo '<tr>';
                   $ipp = $ip - 7;
                   echo '<td><b>Mov '.$ipp.'</b></td>';
                   for ($jp = 0; $jp < 5; ++$jp) {
                       echo '<td>';
                       if ($outputArray[5*$ip + $jp + 10] < -5000)
                           echo 'Abierta';
                       else if ($outputArray[5*$ip + $jp + 10] > 5000)
                           echo 'Cerrada';
                       else
                           echo $outputArray[5*$ip + $jp + 10];
                       echo '</td>';
                   }
                   echo '</tr>';
               }
               ?>
            </table>

            <br />
            <ul align="center">
               <li><b>Mov 0:</b> Posición de inicio (predeterminada).</li>
               <li><b>Mov 1:</b> Pinza sobre la pieza a coger en el almacén (a la altura justa para que al cerrar la pinza coja la pieza).</li>
               <li><b>Mov 2:</b> Justo después de cerrar la pinza.</li>
               <li><b>Mov 3:</b> Sobre la posición final.</li>
               <li><b>Mov 4:</b> Pinza bajada sobre posición final.</li>
               <li><b>Mov 5:</b> Pieza soltada en la posición final (con las pinzas abiertas).</li>
               <li><b>Mov 6:</b> Posición final (predeterminada).</li>
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
                  <td>Fila = <?php echo $outputArray[39] + 1; ?> - Columna = <?php echo $outputArray[40] + 1; ?></td>
               </tr>
               <tr>
                  <td colspan="4">Movimiento brazo (mueve X's).</td>
               </tr>
               <tr>
                  <td>x = <?php echo $outputArray[41]; ?> , y = <?php echo $outputArray[42] ?> [mm]</td>
                  <td>Falta, pero va por orden.</td>
                  <td>x = <?php echo $outputArray[43]; ?> , y = <?php echo $outputArray[44] ?> [mm]</td>
                  <td>Fila = <?php echo $outputArray[80] + 1; ?> - Columna = <?php echo $outputArray[81] + 1; ?></td>
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

         </div>
      </main>


      <?php
      include("../../footer.html")
      ?>
   </body>
</html>
