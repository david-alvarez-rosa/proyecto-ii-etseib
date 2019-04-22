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
      $values = array('Baja', 'Media', 'Alta');
      for ($i = 0; $i < 3; ++$i) {
          if (strtolower($values[$i]) == $dif)
              echo '<input checked type="radio" name="dif" value="'.strtolower($values[$i]).'" />'.$values[$i];
          else
              echo '<input type="radio" name="dif" value="'.strtolower($values[$i]).'" />'.$values[$i];
      }
      echo '<br /><br />';
      echo '<input type="submit" value="Actualiza cambios" />';
      echo '</form>';
      ?>
   </div>
</div>
