<?php
    session_start();
    include('connect.php');
    $sellername = $_SESSION['loginname'];
    $itemname = $_POST['itemname'];
    $bidamount = $_POST['bidamount'];
    $reserveamount = $_POST['reserveamount'];
    $duration = $_POST['duration'];
    $category = $_POST['category'];
    $description = $_POST['description'];
    $images = $_POST['image'];
    foreach($images as &$value){
        $value = "img/".$value;
    }
    //echo $images[0];
    $starttime=date("Y-m-d H:i:s");
    //echo $starttime;
    $endtime = date("Y-m-d H:i:s",strtotime("+".$duration."hour"));
    //echo $endtime;
    $link = mysqli_connect('localhost','zby','root','Database_Project');
    $query1 = "SELECT user_id FROM tbl_user WHERE user_name = '$sellername'";
    $query2 = "SELECT category_short FROM tbl_category WHERE category_name = '$category'";
    $result1 = mysqli_query($link,$query1);
    $result2 = mysqli_query($link,$query2);
    
    if($result1){
        while($row1 = mysqli_fetch_assoc($result1)){
            $sellerid = $row1['user_id'];
        }
        //echo $sellerid;
    }
    if($result2){
        while($row2 = mysqli_fetch_array($result2)){
            $cateshort = $row2['category_short'];
        }
        //echo $cateshort;
    }
    mysqli_query($link, "INSERT INTO tbl_item(item_name,item_strprice,item_strtime,item_endtime,item_pic1,item_pic2,item_pic3,item_seller_id,item_category_short,item_description)                                 
                                       VALUES('$itemname','$bidamount','$starttime','$endtime','$images[0]','$images[1]','$images[2]','$sellerid','$cateshort','$description')");
    $result3 = mysqli_query($link,"SELECT MAX(item_id) AS item_id FROM tbl_item");
    while($row3 = mysqli_fetch_array($result3)){
        $itemid = $row3['item_id'];
                 
    }
    mysqli_query($link, "INSERT INTO tbl_auction(auction_price, auction_resprice, auction_seller_id, auction_item_id) VALUES ('$bidamount','$reserveamount','$sellerid','$itemid')");
    header('location: ../newitem.php?register=success');
    mysqli_close($link);
?>