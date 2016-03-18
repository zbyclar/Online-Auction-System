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
    <link href="css/myauction.css" rel="stylesheet">
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
        <div clss="controls" style="text-align:center"><legend><h2>User Auction Center</h2></legend></div>
          <div class="row-fluid">
              <div class="span12">
                  <div class="tabbable" id="tabs-342475">
                      <ul class="nav nav-tabs">
                          <li class="active">
                              <a data-toggle="tab" href="#panel-441202">Active Auction</a>
                          </li>
                          <li>
                              <a data-toggle="tab" href="#panel-741064">Closed Auction</a>
                          </li>
                      </ul>
                      <div class="tab-content">
                          <div class="tab-pane active" id="panel-441202">
<?php
    $sellerid = $_SESSION['loginid'];
    $link = mysqli_connect('localhost','zby','root','Database_Project');
    $query1 = "SELECT * FROM tbl_auction 
               INNER JOIN tbl_item
               ON tbl_auction.auction_item_id = tbl_item.item_id
               WHERE auction_seller_id = '$sellerid'
               AND auction_status = 'auction_active'";
    $result1 = mysqli_query($link,$query1);
    while($row1 = mysqli_fetch_array($result1)){
        $itemname = $row1['item_name'];
        $query2 = "SELECT * FROM tbl_status WHERE status_name = 'auction_active'";
        $result2 = mysqli_query($link,$query2);
        $row2 = mysqli_fetch_array($result2);
        $status = $row2['status_description'];
        $starttime = $row1['item_strtime'];
        $endtime = $row1['item_endtime'];
        $currentprice = $row1['auction_price'];
        $itempic = $row1['item_pic1'];
        $visit = $row1['auction_visit'];
        $rating = $row1['auction_rating'];
        $id = $row1['auction_id'];
  
?>
                            <div class="booking">
                                <div class="row">
                                <div class="span4">
                                        <img src="<?php echo $itempic ?>">
                                </div>
                                <div class="span8">
                                    <div class="location">
                                        <h4>Your auction of No.<?php echo $id ?> , <?php echo $itemname ?>, is still active at this moment</h4>
                                    </div>
                                    <div class="datetime">
                                        <p>From <b><?php echo $starttime ?></b> to <b><?php echo $endtime ?></b></p>
                                    </div>
                                    <div class="price">
                                        <center>
                                        <table border = "1">
                                        <tr>
                                            <td>Current Price:</td>
                                            <td><?php echo $currentprice ?></td>
                                        </tr>
                                        <tr>
                                            <td>Visit times:</td>
                                            <td><?php echo $visit ?></td>
                                        </tr>
                                        <tr>
                                            <td>Auction Rating:</td>
                                            <td><?php echo $rating ?>/5.0</td>
                                        </tr>
                                        </table>
                                        <a href="<?php echo "getreport.php?auction=".$id ?>"><button type="btn btn-success">View History</button></a>
                                    </center>
                                    </div>
                                </div>
                                </div>
                            </div>
<?php } ?>
                          </div>
                          <div class="tab-pane" id="panel-741064">
<?php
    $query3 = "SELECT * FROM tbl_auction
               INNER JOIN tbl_item
               ON tbl_auction.auction_item_id = tbl_item.item_id
               WHERE auction_seller_id = '$sellerid'
               AND auction_status <> 'auction_active'";
    $result3 = mysqli_query($link,$query3);
    while($row3 = mysqli_fetch_array($result3)){
        $starttime1 = $row3['item_strtime'];
        $endtime1 = $row3['item_endtime'];
        $currentprice1 = $row3['auction_price'];
        $itempic1 = $row3['item_pic1'];
        $itemname1 = $row3['item_name'];
        $visit1 = $row3['auction_visit'];
        $rating1 = $row3['auction_rating'];
        $id1 = $row3['auction_id'];
        $buyerid = $row3['auction_buyer_id'];
        $query4 = "SELECT user_name FROM tbl_user WHERE user_id = '$buyerid'";
        $result4 = mysqli_query($link,$query4);
        $row4 = mysqli_fetch_array($result4);
        $buyername = $row4['user_name'];
?>
                              <div class="booking">
                                  <div class="row-past">
                                      <div class="span4">
                                          <img src="<?php echo $itempic1 ?>">
                                      </div>
                                      <div class="span8">
                                          <div class="location">
                                              <h4>Your auction of No.<?php echo $id1 ?> , <?php echo $itemname1 ?>, is closed now.</h4>
                                              <h4>The final winner is <?php echo $buyername ?>.</h4>
                                          </div>
                                          <div class="datetime">
                                              <p>From <b><?php echo $starttime1 ?></b> to <b><?php echo $endtime ?></b></p>
                                          </div>
                                          <div class="price">
                                            <center>
                                                <table border = "1">
                                                    <tr>
                                                        <td>Current Price:</td>
                                                        <td><?php echo $currentprice1 ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td>Visit times:</td>
                                                        <td><?php echo $visit1 ?></td>
                                                    </tr>
                                                    <tr>
                                                    <td>Auction Rating:</td>
                                                    <td><?php echo $rating1 ?>/5.0</td>
                                                    </tr>
                                            </table>
                                             <a href="<?php echo "getreport.php?auction=".$id1 ?>"><button type="btn btn-success">View History</button></a>
                                            </center>
                                          </div>
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
