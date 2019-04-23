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
   </head>


   <body>
      <header id="header">
         <div style="float: left;"><a href="/proyecto/"><h1>Tres en Raya</h1></a></div>
         <div style="float: right;"><a href="/proyecto/jugar/per/"><h3>Empieza tú</h3></a></div>
         <div style="margin: 0 auto; width: 100px;"><a href="/proyecto/jugar/"><h1>Jugar</h1></a></div>
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
             $outputArray = split(",", $output);
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
         include("../board.php");
         $page = 'per';
         if ($outputArray[$n - 1] == "Not ended")
             include("../controles.php");
         else
             include("../endGame.php");
         include("../data.php");
         ?>
      </main>


      <?php
      include("../../footer.html")
      ?>
   </body>
</html>
