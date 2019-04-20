<!DOCTYPE HTML>

<html>
   <head>
      <meta charset="UTF-8">
      <title>Tres en Raya</title>
      <link rel="stylesheet" type="text/css" href="../layout.css" />
      <link rel="stylesheet" type="text/css" href="../board.css" />
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
            <a href="/proyecto/presentaciones/">Presentaciones</a>
         </h1>
      </header>


      <?php
      include("../navbar.html")
      ?>


      <main>
         <div class="innertube">
            <p>
               Aquí están las diferentes presentaciones del proyecto.
            </p>

            <ul>
               <li>
                  <a href="/proyecto/presentaciones/p1/" title="Presentación inicial.">
                     Presentación 1
                  </a>
               </li>
               <li>
                  <a href="/proyecto/presentaciones/p2/" title="Segunda presentación.">
                     Presentación 2
                  </a>
               </li>
               <li>
                  <a href="/proyecto/error/" title="Presentación final.">
                     Presentación 3
                  </a>
               </li>
            </ul>
         </div>
      </main>


      <?php
      include("../footer.html")
      ?>
   </body>
</html>
