<?php
    $link = mysqli_connect('localhost','zby','root','Database_Project');
    $auctionid = $_GET['id'];
    $query1 = "UPDATE tbl_auction SET auction_status = 'auction_done' WHERE auction_id = '$auctionid'";
    $result1 = mysqli_query($link,$query1);
    
    header('location:../mynotification.php');
    
?>