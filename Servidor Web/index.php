<!DOCTYPE HTML>

<html>
   <head>
      <meta charset="UTF-8">
      <title>Tres en Raya</title>
      <link rel="stylesheet" type="text/css" href="layout.css" />
      <link rel="stylesheet" type="text/css" href="tablero.css" />
   </head>


   <body>
      <header id="header">
         <h1 align="center">
            <a href="/proyecto/" title="Página principal.">Tres en Raya</a>
         </h1>
      </header>


      <?php
      include("navbar.html")
      ?>

      <main>
         <div class="innertube">
	          <p>
               Bienvenidos a nuestro proyecto.
            </p>

            <table id="board" style="margin-right: 25px;">
               <tr>
                  <td id="X">X</td>
                  <td id="O">O</td>
                  <td></td>
               </tr>
               <tr>
                  <td></td>
                  <td id="O">O</td>
                  <td></td>
               </tr>
               <tr>
                  <td id="X">X</td>
                  <td></td>
                  <td id="O">O</td>
               </tr>
            </table>
         </div>
      </main>


      <?php
      include("footer.html")
      ?>
   </body>
</html>
