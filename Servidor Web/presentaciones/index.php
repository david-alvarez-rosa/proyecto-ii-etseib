<!DOCTYPE HTML>

<html>
   <head>
      <meta charset="UTF-8">
      <title>Tres en Raya</title>
      <link rel="stylesheet" type="text/css" href="../layout.css" />
      <style type="text/css">
      </style>
   </head>


   <body>
      <header id="header">
         <div style="float: left;">
            <a href="/proyecto/" title="Página principal.">
               <h1>Tres en Raya</h1>
            </a>
         </div>
         <div style="margin: 0 auto; width: 250px;">
            <a href="/proyecto/presentaciones/" title="Todas las presentaciones.">
               <h1>Presentaciones</h1>
            </a>
         </div>
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
                  <a href="/proyecto/presentaciones/p3/" title="Presentación final.">
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
