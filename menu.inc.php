<?php
  // include dbh functions
  include 'dbh.inc.php';

  // connect to DB
  $dbh = new Dbh();

  $query = "select * from menu_items WHERE link_status = 'active'";
  $result = $dbh->query($query);

  $num_results = $result->num_rows;

  echo '<table id="menu">
          <tbody>
            <tr>';
  
  for ($i = 0; $i < $num_results; $i++) {
    $row = $result->fetch_assoc();

    echo '<td><a href="'.$row['link_url'].'">'.$row['link_name'].'</a></td>';
  }

  echo '</tr>
      </tbody>
      </table>';

  $result->free();