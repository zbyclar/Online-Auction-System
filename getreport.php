<?php
    session_start();
    include('connect.php');
    $page = "myauction";
    ?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="description" content="">
<meta name="author" content="">
<link rel="icon" href="../../favicon.ico">

<title>Navbar Template for Bootstrap</title>
<link href="css/bootstrap.min.css" rel="stylesheet">
<link href="css/navbar-fixed-top.css" rel="stylesheet">
<link href="css/index.css" rel="stylesheet">
<link href="css/registerwarning.css" rel="stylesheet">
<link href="http://netdna.bootstrapcdn.com/bootstrap/3.1.0/css/bootstrap.min.css" rel="stylesheet">
<script src="http://libs.baidu.com/jquery/1.10.2/jquery.min.js"></script>
<link href="css/star-rating.min.css" media="all" rel="stylesheet" type="text/css"/>
<link href="css/getreport.css" media="all" rel="stylesheet" type="text/css"/>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
<script src="js/star-rating.min.js" type="text/javascript"></script>
</head>

<body>
<!-- Static navbar -->
<?php include('navbar.php') ?>
<!-- Main component for a primary marketing message or call to action -->
<div class="container-fluid">
    <center>
        <table border = "2">
            <caption><h4><b>Auction History</b></h4></caption>
            <tr>
                <th>User Name</th>
                <th>Time</th>
                <th>Price</th>
            </tr>
<?php
    $auctionid = $_GET['auction'];
    $link = mysqli_connect('localhost','zby','root','Database_Project');
    $query = "SELECT * FROM tbl_auction WHERE auction_id = '$auctionid'";
    $result = mysqli_query($link,$query);
    $row = mysqli_fetch_array($result);
    $auctionitem = $row['auction_item_id'];
    $query2 = "SELECT * FROM tbl_bid 
               INNER JOIN tbl_user
               ON tbl_bid.bid_buyer_id = tbl_user.user_id
               WHERE bid_item_id ='$auctionitem'";
    $result2 = mysqli_query($link,$query2);
    $count = 1;
    while($row2 = mysqli_fetch_array($result2)){
        $buyername = $row2['user_name'];
        $time = $row2['bid_time'];
        $price = $row2['bid_price'];
            echo "<tr><td>".$buyername."</td>";
            echo "<td>".$time."</td>";
            echo "<td> £ ".$price."</td></tr>";
    }
?>
    </table>
    <br>
    <a href="myauction.php"><button>Return</button></a>
    </center>
</div> <!-- /container -->


<!-- Bootstrap core JavaScript
================================================== -->
<!-- Placed at the end of the document so the pages load faster -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script>window.jQuery || document.write('<script src="../../assets/js/vendor/jquery.min.js"><\/script>')</script>
<br>
<script src="js/bootstrap.min.js"></script>
</body>
</html>
