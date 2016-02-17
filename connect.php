<?php
$user = 'root';
$password = 'root';
$db = 'Database_Project';
$host = 'localhost';
$port = 3306;

$link = mysqli_connect(
                      "$host:$port",
                      $user,
                      $password
                      );
$db_selected = mysql_select_db(
                               $db, 
                               $link
                               );
?>
