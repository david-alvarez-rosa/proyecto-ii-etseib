<table id="board">
   <?php
   for ($i = 0; $i < 3; ++$i) {
       echo '<tr>';
       for ($j = 0; $j < 3; ++$j) {
           if ($board[3*$i + $j] != ".")
               echo '<td id ="'.$board[3*$i + $j].'">'.$board[3*$i + $j].'</td>';
           else if ($outputArray[$n - 1] != "Not ended")
               echo '<td></td>';
           else
               echo '<td><a href="'.$url.$i.$j.'"><button id="tic"><span></span></button></a></td>';
       }
       echo '</tr>';
   }
   ?>
</table>
