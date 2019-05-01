<!DOCTYPE HTML>

<html>
   <head>
      <meta charset="UTF-8">
      <title>Tres en Raya</title>
      <link rel="stylesheet" type="text/css" href="../../layout.css" />
      <link rel="stylesheet" type="text/css" href="../../tablero.css" />
   </head>


   <body>
      <header id="header">
         <div style="float: left;"><a href="/proyecto/"><h1>Tres en Raya</h1></a></div>
         <div style="float: right;"><a href="/proyecto/proyecto/documentacion/"><h3>Documentación</h3></a></div>
         <div style="margin: 0 auto; width: 150px;"><a href="/proyecto/proyecto/"><h1>Proyecto</h1></a></div>
      </header>


      <?php
      include("../../navbar.html")
      ?>


      <main>
         <div class="innertube">
            <p>
               La documentación del proyecto.
            </p>

            <?php
            include("informe.html")
            ?>
         </div>
      </main>


      <?php
      include("../../footer.html")
      ?>
   </body>
</html>
