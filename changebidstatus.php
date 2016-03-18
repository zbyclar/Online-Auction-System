<?php
    $link = mysqli_connect('localhost','zby','root','Database_Project');
    $bidid = $_GET['id'];
    $query1 = "UPDATE tbl_bid SET bid_status = 'bid_done' WHERE bid_id = '$bidid'";
    $result1 = mysqli_query($link,$query1);
    
    header('location:../mynotification.php');
?>