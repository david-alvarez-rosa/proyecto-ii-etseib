<style type="text/css">
 #endMes {
     font-weight: bold;
     font-size: 30px;
 }
 input[type = radio] {
     margin-left: 20px;
 }
</style>


<div class="end" align="center">
   <?php
   if ($outputArray[$n - 1] == "AI wins")
       echo '<p id="endMes" style="color: red;">Lo sentimos, has perdido.</p>';
   else if ($outputArray[$n - 1] == "Tie")
       echo '<p id="endMes">Ha sido un empate.</p>';
   else if ($outputArray[$n - 1] == "User wins")
       echo '<p id="endMes" style="color: green;">Enhorabuena, has ganado.</p>';
   ?>
   <p>Vuelve a empezar, vacía el tablero.</p>
   <?php
   echo '<a href="/proyecto/jugar/'.$page.'/?dif=';
   echo $dif.'">';
   echo '<button>Vacía</button></a>';
   ?>

   <p>Ajusta la dificultad.</p>
   <div align="center">
      <?php
      echo '<form action="/proyecto/jugar/'.$page.'/">';
      $same = '<input type="radio" name="dif" value=';
      $dif = 'alta';
      if (isset($_GET['dif']))
          $dif = $_GET['dif'];
      $values = array('baja', 'media', 'alta');
      $valuesDisp = array('Fácil', 'Medio', 'Imposible');
      for ($i = 0; $i < 3; ++$i) {
          if ($values[$i] == $dif)
              echo '<input checked type="radio" name="dif" value="'.$values[$i].'" />'.$valuesDisp[$i];
          else
              echo '<input type="radio" name="dif" value="'.$values[$i].'" />'.$valuesDisp[$i];
      }
      echo '<br /><br />';
      echo '<input type="submit" value="Actualiza cambios" />';
      echo '</form>';
      ?>
   </div>
</div>


<?php
if ($outputArray[$n - 1] == "User wins")
    echo '
      <canvas id="canvas"></canvas>
      <script type="text/javascript" src="../confeti.js"></script>
      <style type="text/css">
        canvas {
            position: absolute;
            top: 0;
            left: 0;
            display: block;
            z-index: -1;
      }
      </style>';
?>
