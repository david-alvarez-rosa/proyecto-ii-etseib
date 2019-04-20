<!DOCTYPE HTML>

<html>
   <head>
      <meta charset="UTF-8">
      <title>Tres en Raya</title>
      <link rel="stylesheet" type="text/css" href="layout.css" />
      <link rel="stylesheet" type="text/css" href="board.css" />
   </head>


   <body>
      <header id="header">
         <h1 align="center"><a href="/proyecto/">Tres en Raya</a></h1>
      </header>


      <?php
      include("navbar.html")
      ?>

      <main>
         <div class="innertube">
            <p>
               Se podrían explicar cosas. Para comenzar a jugar los links son los
               de la izquierda. Aquí un ejemplo de tablero.
            </p>

            <table id="board">
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

            <br /><br />
            <p>
               asdfa añsldkfj asñlkdfj asñlkdf añlskjdf as
               asdfa añsldkfj asñlkdfj asñlkdf añlskjdf as
               asdfa añsldkfj asñlkdfj asñlkdf
               asdfa añsldkfj asñlkdfj asñlkdf añlskjdf as
               asdfa añsldkfj asñlkdfj asñlkdf añlskjdf as
               asdfa añsldkfj asñlkdfj asñlkdf
               asdfa añsldkfj asñlkdfj asñlkdf añlskjdf as
               asdfa añsldkfj asñlkdfj asñlkdf añlskjdf as
               asdfa añsldkfj asñlkdfj asñlkdf

            </p>
            <br /><br />
            <p>
               Nuevo
               asdfa añsldkfj asñlkdfj asñlkdf añlskjdf as
               asdfa añsldkfj asñlkdfj asñlkdf
               asdfa añsldkfj asñlkdfj asñlkdf añlskjdf as
               asdfa añsldkfj asñlkdfj asñlkdf añlskjdf as
               asdfa añsldkfj asñlkdfj asñlkdf
               asdfa añsldkfj asñlkdfj asñlkdf añlskjdf as
               asdfa añsldkfj asñlkdfj asñlkdf añlskjdf as
               asdfa añsldkfj asñlkdfj asñlkdf
            </p>
         </div>
      </main>


      <?php
      include("footer.html")
      ?>
   </body>
</html>
