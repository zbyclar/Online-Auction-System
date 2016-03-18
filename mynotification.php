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
    <link href="css/mynotification.css" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
        <link href="http://netdna.bootstrapcdn.com/bootstrap/3.1.0/css/bootstrap.min.css" rel="stylesheet">
        <script src="http://libs.baidu.com/jquery/1.10.2/jquery.min.js"></script>
    <link href="css/star-rating.min.css" media="all" rel="stylesheet" type="text/css"/>
    <script src="js/star-rating.min.js" type="text/javascript"></script>
  </head>

  <body>
    <!-- Static navbar -->
      <?php include('navbar.php') ?>
      <!-- Main component for a primary marketing message or call to action -->
      <div class="container-fluid">
        <div clss="controls" style="text-align:center"><legend><h2>User Notification Center</h2></legend></div>
          <div class="row-fluid">
              <div class="span12">
                  <div class="tabbable" id="tabs-342475">
                      <ul class="nav nav-tabs">
                          <li class="active">
                              <a data-toggle="tab" href="#panel-441202">Bid Notification</a>
                          </li>
                          <li>
                              <a data-toggle="tab" href="#panel-741064">Auction Notification</a>
                          </li>
                      </ul>
                      <div class="tab-content">
                          <div class="tab-pane active" id="panel-441202">

<?php
    $bidderid = $_SESSION['loginid'];
    $link = mysqli_connect('localhost','zby','root','Database_Project');
    $query1 = "SELECT * FROM tbl_bid
               INNER JOIN tbl_item
               ON tbl_bid.bid_item_id = tbl_item.item_id
               WHERE bid_buyer_id = '$bidderid'
               AND bid_status = 'bid_not_highest'";
    $result1 = mysqli_query($link,$query1);
    while($row1 = mysqli_fetch_array($result1)){
        $biditem = $row1['item_name'];
        $item_id = $row1['item_id'];
        $query2 = "SELECT * FROM tbl_auction WHERE auction_item_id = '$item_id'";
        $result2 = mysqli_query($link,$query2);
        $row2 = mysqli_fetch_array($result2);
        $auctionprice = $row2['auction_price'];
        $bidprice = $row1['bid_price'];
        $bidid = $row1['bid_id'];
?>

                            <div class="booking">
                                <div class="row">
                                    <div class="span12">
                                        <p> Your current bid No.<?php echo $bidid ?> for <?php echo $biditem ?> is not the highest price, someone has proposed a higher price of <b><?php echo $auctionprice ?></b>. Would you like to bid over it or give up ?
                                        </p>
                                        <a href="itemview.php?id=<?php echo $item_id; ?>"><button type="button" class="btn btn-success" >Rebid</button></a>
                                        <a href="changebidstatus.php?id=<?php echo $bidid; ?>"><button type="button" class="btn btn-success" >Drop</button></a>
                                    </div>
                                </div>
                            </div>
<?php } ?>

<?php
    $link = mysqli_connect('localhost','zby','root','Database_Project');
    $query3 = "SELECT * FROM tbl_bid
    INNER JOIN tbl_item
    ON tbl_bid.bid_item_id = tbl_item.item_id
    WHERE bid_buyer_id = '$bidderid'
    AND bid_status = 'bid_winner'";
    $result3 = mysqli_query($link,$query3);
    while($row3 = mysqli_fetch_array($result3)){
        $biditem1 = $row3['item_name'];
        $item_id1 = $row3['item_id'];
        $query4 = "SELECT * FROM tbl_auction WHERE auction_item_id = '$item_id1'";
        $result4 = mysqli_query($link,$query4);
        $row4 = mysqli_fetch_array($result4);
        $auctionprice1 = $row4['auction_price'];
        $bidprice1 = $row3['bid_price'];
        $bidid1 = $row3['bid_id'];
    ?>

                            <div class="booking">
                                <div class="row">
                                    <div class="span12">
                                        <p> Your current bid No.<?php echo $bidid1 ?> for <?php echo $biditem1 ?> is closed and you are the <b>winner</b>. Do you confirm to process the payment?
                                        </p>
                                        <a href="changebidstatus.php?id=<?php echo $bidid1; ?>"><button type="button" class="btn btn-success" >Payment</button></a>
                                        <a href="changebidstatus.php?id=<?php echo $bidid1; ?>"><button type="button" class="btn btn-success" >Cancel</button></a>
                                    </div>
                                </div>
                            </div>
<?php } ?>

<?php
    $link = mysqli_connect('localhost','zby','root','Database_Project');
    $query5 = "SELECT * FROM tbl_bid
               INNER JOIN tbl_item
               ON tbl_bid.bid_item_id = tbl_item.item_id
               WHERE bid_buyer_id = '$bidderid'
               AND bid_status = 'bid_not_winner'";
    $result5 = mysqli_query($link,$query5);
    while($row5 = mysqli_fetch_array($result5)){
        $biditem2 = $row5['item_name'];
        $item_id2 = $row5['item_id'];
        $query6 = "SELECT * FROM tbl_auction WHERE auction_item_id = '$item_id2'";
        $result6 = mysqli_query($link,$query6);
        $row6 = mysqli_fetch_array($result6);
        $auctionprice2 = $row6['auction_price'];
        $bidprice2 = $row5['bid_price'];
        $bidid2 = $row5['bid_id'];
?>

                            <div class="booking">
                                <div class="row">
                                    <div class="span12">
                                        <p> Your current bid No.<?php echo $bidid2 ?> for <?php echo $biditem2 ?> is closed and sorry to say that you are <b>not the winner</b>.
                                        </p>
                                        <a href="changebidstatus.php?id=<?php echo $bidid2; ?>"><button type="button" class="btn btn-success" >Cancel</button></a>
                                    </div>
                                </div>
                            </div>
<?php } ?>
                          </div>
                          <div class="tab-pane" id="panel-741064">

<?php
    $link = mysqli_connect('localhost','zby','root','Database_Project');
    $query7 = "SELECT * FROM tbl_auction
               INNER JOIN tbl_item
               ON tbl_auction.auction_item_id = tbl_item.item_id
               WHERE auction_seller_id = '$bidderid'
               AND auction_status = 'auction_active'";
    $result7 = mysqli_query($link,$query7);
    while($row7 = mysqli_fetch_array($result7)){
        $biditem3 = $row7['item_name'];
        $auction_id3 = $row7['auction_id'];
        $item_id3 = $row7['item_id'];
        $query8 = "SELECT * FROM tbl_bid
                   INNER JOIN tbl_user
                   ON tbl_bid.bid_buyer_id = tbl_user.user_id
                   WHERE bid_item_id = '$item_id3'
                   ORDER BY bid_time DESC";
        $result8 = mysqli_query($link,$query8);
        while($row8 = mysqli_fetch_array($result8)){
            $biddername = $row8['user_name'];
            $bidprice3 = $row8['bid_price'];
            $bidtime = $row8['bid_time'];
        
        
?>
                              <div class="booking">
                                  <div class="row-past">
                                      <div class="span12">
                                         <p>Your auction No.<?php echo $auction_id3 ?> for <?php echo $biditem3 ?> was bidded by <?php echo $biddername ?> at <?php echo $bidtime ?> with price £ <?php echo $bidprice3 ?>.</p>
                                      </div>
                                  </div>
                              </div>
<?php  }} ?>
<?php
    $link = mysqli_connect('localhost','zby','root','Database_Project');
    $query9 = "SELECT * FROM tbl_auction
               INNER JOIN tbl_user
               ON tbl_auction.auction_buyer_id = tbl_user.user_id
               INNER JOIN tbl_item
               ON tbl_auction.auction_item_id = tbl_item.item_id
               WHERE auction_seller_id = '$bidderid'
               AND auction_status = 'auction_closed'";
    $result9 = mysqli_query($link,$query9);
    while($row9 = mysqli_fetch_array($result9)){
        $auction_id4 = $row9['auction_id'];
        $buyername = $row9['user_name'];
        $finalprice = $row9['auction_price'];
        $finalitem = $row9['item_name'];
    
?>
                              <div class="booking">
                                  <div class="row-past">
                                      <div class="span12">
                                         <p>Your auction No.<?php echo $auction_id4 ?> is closed, the final winner <?php echo $buyername ?> succeeded in bidding with price £ <?php echo $finalprice ?>.</p>
                                        <a href="changeaucstatus.php?id=<?php echo $auction_id4; ?>"><button type="button" class="btn btn-success" >Confirm</button></a>
                                        <a href="changeaucstatus.php?id=<?php echo $auction_id4; ?>"><button type="button" class="btn btn-success" >Cancel</button></a>
                                      </div>
                                  </div>
                              </div>
<?php } ?>
                          </div>
                      </div>
                  </div>
              </div>
          </div>
      </div>

    </div> <!-- /container -->
     <footer id="bottom">Design by Database Project Group</footer>

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script>window.jQuery || document.write('<script src="../../assets/js/vendor/jquery.min.js"><\/script>')</script>
    <br>
    <script src="js/bootstrap.min.js"></script>
   </body>
</html>
