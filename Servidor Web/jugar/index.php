<!DOCTYPE HTML>

<html>
   <head>
      <meta charset="UTF-8">
      <title>Tres en Raya</title>
      <link rel="stylesheet" type="text/css" href="../layout.css" />
      <link rel="stylesheet" type="text/css" href="../tablero.css" />
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
         <div style="margin: 0 auto; width: 100px;"><a href="/proyecto/jugar/"><h1>Jugar</h1></a></div>
      </header>


      <?php
      include("../navbar.html")
      ?>


      <main>
         <div class="innertube">
            <p>
               Aquí están las diferentes opciones para jugar al tres en raya con
               el brazo robótico.
            </p>

            <ul>
               <li>
                  <a href="/proyecto/jugar/per/" title="Empieza tú a jugar.">
                     Empieza tú
                  </a>
               </li>
               <li>
                  <a href="/proyecto/jugar/ai/" title="Tú juegas segundo.">
                     Empieza el brazo
                  </a>
               </li>
               <li>
                  <a href="/proyecto/error/" title="Ve una partida.">
                     Ver partida
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
