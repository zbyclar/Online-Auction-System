<?php
session_start();
$item_id = $_SESSION['itemid'];
$description = $_POST['comment'];
$buyerid = $_SESSION['userid'];
$grade = $_POST['ratinggrade'];
include('connect.php');
$link = mysqli_connect('localhost','zby','root','Database_Project');
$query = "INSERT INTO tbl_rating(rating_id, rating_grade, rating_item_id, rating_description, rating_buyer_id) 
          VALUES (NULL, '$grade', '$item_id', '$description', '$buyerid')";
$result = mysqli_query($link, $query);
$query_select = "SELECT * FROM tbl_rating WHERE rating_item_id = '$item_id'";
$result_select = mysqli_query($link,$query_select);
$num_select = mysqli_num_rows($result_select);
$overall_rating = 0;
while($row_select = mysqli_fetch_array($result_select)){
    $overall_rating+=$row_select['rating_grade'];
}
$overall_rating = $overall_rating/$num_select;
$query_update = "UPDATE tbl_auction SET auction_rating = '$overall_rating' WHERE auction_item_id = '$item_id'";
$result_update = mysqli_query($link, $query_update);
if ($result){
    header('location: ../itemview.php?addRating=success');
}
else{
    header('location: ../itemview.php?addRating=failed');
}
?>