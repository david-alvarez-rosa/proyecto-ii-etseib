<style type="text/css">
 input[type = radio] {
     margin-left: 20px;
 }
</style>

<div class="control" align="center">
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
