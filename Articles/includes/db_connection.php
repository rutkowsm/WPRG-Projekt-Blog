<?php

/**
 * Get the database connection
 *
 * @return object Connection to a MySQL server
*/

function getDBconn(){
  $db_host = 'localhost';
  $db_name = 'cms_store';
  $db_user = 'admin';
  $db_pass = 'adminpass';

  $conn = mysqli_connect($db_host, $db_user, $db_pass, $db_name);

  if (mysqli_connect_error()) {
    echo mysqli_connect_error();
    exit;
  }

  return $conn;
}
 ?>
