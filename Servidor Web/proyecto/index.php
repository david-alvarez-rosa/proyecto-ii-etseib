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
         <div style="margin: 0 auto; width: 150px;"><a href="/proyecto/proyecto/"><h1>Proyecto</h1></a></div>
      </header>


      <?php
      include("../navbar.html")
      ?>


      <main>
         <div class="innertube">
            <p>
               Aquí están las diferentes apartados que componen este proyecto.
            </p>

            <ul>
               <li>
                  <a href="/proyecto/proyecto/documentacion/" title="La documentación del proyecto.">
                     Documentación
                  </a>
               </li>
               <li>
                  <a href="/proyecto/proyecto/codigo/" title="Todo el código.">
                     Código
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
