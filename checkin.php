<?php
    session_start();
    include('connect.php');
    $referrer = $_POST['referrer'];
    $loginname = $_POST['username'];
    $loginpass = $_POST['password'];
    $query6 = "SELECT * FROM tbl_user WHERE user_name = '$loginname'";
    $link = mysqli_connect('localhost','zby','root','Database_Project');
    $result = mysqli_query($link,$query6);
    if($result){
        while($row = mysqli_fetch_array($result)){

            $hashed_password = $row['user_pwd'];
            $loginemail = $row['user_email'];
            $logindob = $row['user_dob'];
            $logingender = $row['user_gender'];
            $loginissub = $row['user_issub'];
        }
        if(sha1($loginpass) == $hashed_password){
 
            $_SESSION['loginname'] = $loginname;
            $_SESSION['loginemail'] = $loginemail;
            $_SESSION['logindob'] = $logindob;
            $_SESSION['logingender'] = $logingender;
            $_SESSION['loginissub'] = $loginissub;
            $auctionuser = $_SESSION['loginname'];
            $query11 = "SELECT user_id FROM tbl_user WHERE user_name = '$auctionuser'";
            $result11 = mysqli_query($link,$query11);
            $row11 = mysqli_fetch_array($result11);
            $_SESSION['loginid'] = $row11['user_id'];
            
            
            
            header('location: ../'.$referrer.'.php?login=success');
            
            
            //update tbl_auction, check whether the auction is expired
            $currenttime = date("Y-m-d G:i:s");
            $query7 = "SELECT * FROM tbl_item";
            $result7 = mysqli_query($link,$query7);
            while($row7 = mysqli_fetch_array($result7)){
                if($currenttime > $row7['item_endtime']){
                    //echo $row7['item_endtime'];
                    $auction_item_id = $row7['item_id'];
                    //echo $auction_item_id;
                    mysqli_query($link,"UPDATE tbl_auction SET auction_status = 'auction_closed' WHERE auction_item_id = '$auction_item_id' AND auction_status <> 'auction_done'");
                    
                }
            }
            
            //update bid_status in tbl_bid, there are four cases
            $query8 = "SELECT * FROM tbl_user WHERE user_name = '$loginname'";
            $result8 = mysqli_query($link,$query8);
            while($row8 = mysqli_fetch_assoc($result8)){
                $userid = $row8['user_id'];
            }
            $query9 = "SELECT * FROM tbl_bid WHERE bid_buyer_id = '$userid'";
            $result9 = mysqli_query($link,$query9);
            while($row9 = mysqli_fetch_assoc($result9)){
                $bid_item_id = $row9['bid_item_id'];
                $query10 = "SELECT * FROM tbl_auction WHERE auction_item_id = '$bid_item_id'";
                $result10 = mysqli_query($link,$query10);
                while($row10 = mysqli_fetch_assoc($result10)){
                    $auction_buyer_id = $row10['auction_buyer_id'];
                    $auction_status = $row10['auction_status'];
                    if($auction_status == "auction_active" && $userid == $auction_buyer_id){
                        mysqli_query($link,"UPDATE tbl_bid SET bid_status = 'bid_highest' WHERE bid_status <> 'bid_done' AND bid_buyer_id = '$userid'");
                    }else if($auction_status == "auction_closed" && $userid == $auction_buyer_id){
                        mysqli_query($link,"UPDATE tbl_bid SET bid_status = 'bid_winner' WHERE bid_status <> 'bid_done' AND bid_buyer_id = '$userid'");
                    }else if($auction_status == "auction_active" && $userid != $auction_buyer_id){
                        mysqli_query($link,"UPDATE tbl_bid SET bid_status = 'bid_not_highest' WHERE bid_status <> 'bid_done' AND bid_buyer_id = '$userid'");
                    }else if($auction_status == "auction_closed" && $userid != $auction_buyer_id){
                        mysqli_query($link,"UPDATE tbl_bid SET bid_status = 'bid_not_winner' WHERE bid_status <> 'bid_done' AND bid_buyer_id = '$userid'");
                    }
                }
            }
            
            //add flag to notify
            $aucuserid = $_SESSION['loginid'];
            $query12 = "SELECT * FROM tbl_auction WHERE auction_status <> 'auction_done'
            AND auction_seller_id = '$aucuserid'";
            $result12 = mysqli_query($link,$query12);
            $query13 = "SELECT * FROM tbl_bid WHERE bid_status
            IN('bid_not_highest','bid_winner','bid_not_winner')
            AND bid_buyer_id = '$aucuserid'";
            $row12 = mysqli_fetch_array($result12);
            $result13 = mysqli_query($link,$query13);
            $row13 = mysqli_fetch_array($result13);
            if($row12||$row13){
                $_SESSION['flag'] = 1;
            }else{
                $_SESSION['flag'] = 0;
            }

            
            
        }else {
  
            header('location: ../checkinwarning.php?login=failed');
        }
    }else{

        header('location: ../checkinwarning.php?login=none-matched');
    }
    mysqli_close($link);
?>
