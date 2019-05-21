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
         <div style="float: left;">
            <a href="/proyecto/" title="Página principal.">
               <h1>Tres en Raya</h1>
            </a>
         </div>
         <div style="float: right;">
            <a href="/proyecto/jugar/per/" title="Empieza tú a jugar.">
               <h3>Empieza tú</h3>
            </a>
         </div>
         <div style="margin: 0 auto; width: 100px;">
            <a href="/proyecto/jugar/" title="Juega contra la máquina.">
               <h1>Jugar</h1>
            </a>
         </div>
      </header>


      <?php
      include("../../navbar.html")
      ?>


      <main id="main">
         <div class="innertube">
            <p>Juega al tres en raya, tú empiezas (también puedes
               <a href="/proyecto/jugar/ai/" title="Tú juegas segundo.">
                  ir segundo</a>).
            </p>
         </div>

         <?php
         $dif = 'alta';
         if (isset($_GET['dif']))
             $dif = $_GET['dif'];

         if (isset($_GET['movs'])) {
             $movs = $_GET['movs'];
             if (isset($_GET['rama'])) {
                 $rama = $_GET['rama'];
                 $nodo = $_GET['nodo'];
                 $sims = $_GET['sims'];
                 $eb = $_GET['eb'];
             }
             else {
                 $rama = '-1';
                 $nodo = '-1';
                 $sims = '-1';
                 $eb = 'False';
             }
             if ($dif == 'baja')
                 $eb = 'Easy';
             else if ($dif == 'media')
                 $eb = 'True';
             $command = 'python3 ../../cgi-bin/main.py '.$movs.' '.$rama.' '.$nodo.' '.$sims.' '.$eb;
             $output = exec($command);
             $outputArray = explode(",", $output);
             $n = sizeof($outputArray);

             $board = $outputArray[$n - 3];
             $url = '?dif='.$dif.$outputArray[$n - 2];
         }

         else {
             $board = '.........';
             $url = '?dif='.$dif.'&movs=';
             $outputArray = array('Not ended');
             $n = sizeof($outputArray);
         }
         ?>

         <?php
         include("../tablero.php");
         $page = 'per';
         include("../controles.php");
         include("../data.php");
         ?>

         <div id="animacion">
            <?php
            include("../animacion.php");
            ?>

            <div id="velocidad" align="center">
               <p>Ajusta la velocidad:</p>
               <form action="/proyecto/jugar/per/">
                  <?php
                  echo '<input type="range" id="velSlider" name="vel" min="3" max="27" ';
                  if (isset($_GET['vel']))
                      echo ' value="'.$_GET['vel'].'" ';
                  echo 'step="3" onchange="delay = 25 - this.value;" />';
                  ?>
                  <!-- <input type="submit" value="Vuelve a empezar" /> -->
               </form>
               <button onclick="comenzarAnimacion();">
                  Volver a empezar
               </button>
            </div>

            <button id="pantCompl" onclick="mostrarAnimacionCompleta();">
               Pantalla completa
            </button>
            <a id="cerrarPant" href="javascript:void(0)" onclick="cerrarAnimacion();">
               &times;
            </a>
         </div>
      </main>


      <?php
      include("../../footer.html")
      ?>


      <script src="../animacion.js"></script>
      <script type="text/javascript">
       <?php
       if (isset($_GET['vel'])) {
           echo 'mostrarAnimacion();';
           echo 'mostrarAnimacionCompleta();';
       }
       else
           echo 'mostrarControles();';
       ?>
      </script>

   </body>
</html>
