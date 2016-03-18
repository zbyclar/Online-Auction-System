<?php
session_start();
include('connect.php');
$item_id = $_SESSION['itemid'];
$bid_price = $_POST['BidAmount'];

if(!(isset($_SESSION['loginname']))){
    header('location: ../itemview.php?isLogin=no');
}
else{
    $buyer_name = $_SESSION['loginname'];
    $query_bid = "SELECT * FROM tbl_bid WHERE bid_item_id = '$item_id' ORDER BY bid_price DESC LIMIT 1";
    $result_bid = mysqli_query($link, $query_bid);
    $date = date("Y-m-d G:i:s");
    $link = mysqli_connect('localhost','zby','root','Database_Project');
    $query_time = "SELECT * FROM tbl_item WHERE item_id = '$item_id'";
    $result_time = mysqli_query($link, $query_time);
    while($row = mysqli_fetch_array($result_time)){
        $endtime = $row['item_endtime'];
        $strprice = $row['item_strprice'];
    }
    while($row = mysqli_fetch_array($result_bid)){
        $highest_price = $row['bid_price'];
    }
    if(!isset($highest_price)){
        $highest_price = $strprice;
    }
    if ($bid_price <= $highest_price){
        header('location: ../itemview.php?addBid=failednothigh');
    }
    else if($date > $endtime){
        header('location: ../itemview.php?addBid=failedtoolate');
    }
    else{
        $user_id = $_SESSION['loginid'];
        $link = mysqli_connect('localhost','zby','root','Database_Project');
        $query_num = "SELECT bid_id,tbl_user.user_name, tbl_user.user_email, tbl_item.item_name
                      FROM tbl_bid, tbl_user,tbl_item WHERE bid_item_id = '$item_id' 
                      AND bid_buyer_id <> '$user_id' AND bid_buyer_id = user_id AND bid_item_id = item_id";
        $result_num = mysqli_query($link, $query_num);
        $query_status = "UPDATE tbl_bid SET bid_status = 'bid_highest' WHERE bid_item_id = '$item_id'";
        $result_status = mysqli_query($link, $query_status);
        $bidhistory_num = mysqli_num_rows($result_num);
        $query_duplicate = "SELECT * FROM tbl_bid WHERE bid_item_id = '$item_id' AND bid_buyer_id = '$user_id'";
        $result_duplicate = mysqli_query($link, $query_duplicate);
        $num_duplicate = mysqli_num_rows($result_duplicate);
        if($num_duplicate){
            while($row_update=mysqli_fetch_array($result_duplicate)){
                $bidhistory=$row_update['bid_history'];
            }
            
            $bidhistory = $bidhistory.$date."|".$bid_price."|";
            $query = "UPDATE tbl_bid SET bid_price = '$bid_price', bid_time = '$date', bid_history='$bidhistory'
                      WHERE bid_item_id = '$item_id' AND bid_buyer_id = '$user_id'";
        }
        else{
            $bidhis = $date."|".$bid_price."|";
            $query = "INSERT INTO tbl_bid(bid_id, bid_price, bid_time, bid_item_id, bid_buyer_id,bid_history)
                      VALUES (NULL, '$bid_price', '$date', '$item_id', '$user_id','$bidhis')";
        }
        $query_update = "UPDATE tbl_auction SET auction_price = '$bid_price', auction_buyer_id = '$user_id' 
                         WHERE auction_item_id = '$item_id'";
        $result_update = mysqli_query($link, $query_update);
//        $query_auction = "SELECT tbl_user.user_name, tbl_user.user_email FROM tbl_auction, tbl_user
//                          WHERE auction_item_id = '$item_id' AND auction_seller_id = user_id";
//        $result_auction = mysqli_query($link, $query_auction);
//        while($row_auction = mysqli_fetch_array($result_auction)){
//            $email = $row_auction['user_email'];
//            $user_name = $row_auction['user_name'];
//        }
//        require 'PHPMailerAutoload.php';
//                         
//            $mail = new PHPMailer;
//                         
//            $mail->isSMTP();                                      // Set mailer to use SMTP
//            $mail->Host = 'smtp.gmail.com';  // Specify main and backup SMTP servers
//            $mail->SMTPAuth = true;                               // Enable SMTP authentication
//            $mail->Username = 'webserviceucl@gmail.com';                 // SMTP username
//            $mail->Password = 'ucl123456';                           // SMTP password
//            $mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
//            $mail->Port = 587;                                    // TCP port to connect to
//            $mail->setFrom('webserviceucl@gmail.com', 'Web Service');
//            $mail->addAddress($email, $user_name);     // Add a recipient
//            $mail->isHTML(true);                                  // Set email format to HTML
//            $mail->Subject = 'Auction Update';
//            $mail->Body    = 'Hi,'.$user_name.', we are glad to inform you that'.$buyer_name.'has bid for your item.';
//            $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
//            if(!$mail->send()) {
//                echo 'Message could not be sent.';
//            }
        $result = mysqli_query($link, $query);
        if($result){
            if($bidhistory_num){
                require 'PHPMailerAutoload.php';
                         
                $mail = new PHPMailer;

                $mail->isSMTP();                                      // Set mailer to use SMTP
                $mail->Host = 'smtp.gmail.com';  // Specify main and backup SMTP servers
                $mail->SMTPAuth = true;                               // Enable SMTP authentication
                $mail->Username = 'webserviceucl@gmail.com';                 // SMTP username
                $mail->Password = 'ucl123456';                           // SMTP password
                $mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
                $mail->Port = 587;                                    // TCP port to connect to
                $mail->setFrom('webserviceucl@gmail.com', 'Web Service');
                while($row = mysqli_fetch_array($result_num)){
                    $email = $row['user_email'];
                    $user_name = $row['user_name'];
                    $item_name = $row['item_name'];
                    $mail->addAddress($email, $user_name); 
                    
                }
                $mail->isHTML(true);                                  // Set email format to HTML
                $mail->Subject = 'Auction Update';
                $mail->Body    = 'Hi, we are sorry to inform you that you have been outbid in item <b>'.$item_name.'</b>, please bid a higher price for this item. Thank you for your time';
                $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
                if(!$mail->send()) {
                    echo 'Message could not be sent.';
                }
            }
            header('location: ../itemview.php?addBid=success');
        }
        else{
            header('location: ../itemview.php?addBid=failed');
        }
    }
}
?>