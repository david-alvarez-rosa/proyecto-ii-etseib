<!DOCTYPE HTML>

<html>
   <head>
      <meta charset="UTF-8">
      <title>Tres en Raya</title>
      <link rel="stylesheet" type="text/css" href="../../layout.css" />
      <link rel="stylesheet" type="text/css" href="../../tablero.css" />
      <link rel="stylesheet" type="text/css" href="../animacion.css" />
      <style type="text/css">
       .data {
           width: 90%;
           min-width: 500px;
           height: 70px;
           text-align: center;
       }
      </style>
   </head>


   <body>
      <header id="header">
         <div style="float: left;"><a href="/proyecto/"><h1>Tres en Raya</h1></a></div>
         <div style="float: right;"><a href="/proyecto/jugar/ai/"><h3>Empieza el brazo</h3></a></div>
         <div style="margin: 0 auto; width: 100px;"><a href="/proyecto/jugar/"><h1>Jugar</h1></a></div>
      </header>


      <?php
      include("../../navbar.html")
      ?>


      <main id="main">
         <div class="innertube">
            <p>Juega al tres en raya, tú vas segundo (también puedes
               <a href="/proyecto/jugar/per/" title="Empieza tú a jugar.">
                  empezar tú</a>).
            </p>
         </div>

         <?php
         $dif = 'alta';
         if (isset($_GET['dif']))
             $dif = $_GET['dif'];

         if (isset($_GET['movs'])) {
             $movs = $_GET['movs'];
             $rama = $_GET['rama'];
             $nodo = $_GET['nodo'];
             $sims = $_GET['sims'];
             $eb = $_GET['eb'];

             if ($dif == 'baja')
                 $eb = 'Easy';
             else if ($dif == 'media')
                 $eb = 'True';

             $command = 'python3 ../../cgi-bin/main2.py '.$movs.' '.$rama.' '.$nodo.' '.$sims.' '.$eb;
             $output = exec($command);
             $outputArray = split(",", $output);
             $n = sizeof($outputArray);

             $board = $outputArray[$n - 3];
             $url = '?dif='.$dif.$outputArray[$n - 2];
         }
         else {
             $rand = rand(1, 4);
             if ($rand == 1) {
                 $movs = "00";
                 $sims = -1;
                 $board = 'X........';
             }
             else if ($rand == 2) {
                 $movs = "02";
                 $sims = 0;
                 $board = '..X......';
             }
             else if ($rand == 3) {
                 $movs = "20";
                 $sims = 2;
                 $board = '......X..';
             }
             else {
                 $movs = "22";
                 $sims = 1;
                 $board = '........X';
             }
             $url = '?dif='.$dif.'&rama=3&nodo=0&sims='.$sims.'&eb=False&movs='.$movs;
             $outputArray = array('Not ended');
             $n = sizeof($outputArray);
         }
         ?>

         <?php
         include("../tablero.php");
         $page = 'ai';
         include("../controles.php");
         include("../data.php");
         ?>


         <button style="position: absolute; top: 200px; cursor: pointer;" onclick="mostrarAnimacion();">
            Abre animación
         </button>

         <div id="animacion">
            <?php
            include("../animacion.html");
            ?>

            <div id="velocidad">
               <p>Ajusta la velocidad:</p>
               <form action="/proyecto/jugar/prueba2xy">
                  <?php
                  echo '<input type="range" id="velSlider" name="vel" min="5" max="20" ';
                  if (isset($_GET['vel']))
                      echo ' value="'.$_GET['vel'].'" ';
                  echo 'step="3" onchange="delay = 25 - this.value;" />';
                  ?>
                  <input type="submit" value="Vuelve a empezar" />
               </form>
            </div>
         </div>

         <script type="text/javascript">
          function mostrarAnimacion() {
              control.style.visibility = "hidden";
              animacion.style.visibility = "visible";
              move();
          }
         </script>

      </main>


      <?php
      include("../../footer.html")
      ?>

      <script src="../animacion.js"></script>
   </body>
</html>
