<?php
$user = 'zby';
$password = 'root';
$db = 'Database_Project';
$host = 'localhost';
$port = 3306;
    $link = mysql_connect(
                          "$host:$port",
                          $user,
                          $password
                          )or die("Error " . mysqli_error($link));
    $db_selected = mysql_select_db(
                                   $db, 
                                   $link
                                   )or die("Error ");

?>
