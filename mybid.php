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
    <link href="css/mybid.css" rel="stylesheet">
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
      <div class="container">
        <div clss="controls" style="text-align:center"><legend><h2>User Bid Center</h2></legend></div>
          <div class="row-fluid">
              <div class="span12">
                  <div class="tabbable" id="tabs-342475">
                      <ul class="nav nav-tabs">
                          <li class="active">
                              <a data-toggle="tab" href="#panel-441202">Active Bid</a>
                          </li>
                          <li>
                              <a data-toggle="tab" href="#panel-741064">Closed Bid</a>
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
               AND bid_status IN ('bid_highest','bid_not_highest')";
    $result1 = mysqli_query($link,$query1);
    while($row1 = mysqli_fetch_array($result1)){
        $biditem = $row1['item_name'];
        $itempic = $row1['item_pic1'];
        $bidid = $row1['bid_id'];
        $bidhistory = $row1['bid_history'];
        $count = 1;
?>
                            <div class="booking">
                                <div class="row">
                                    <div class="span4">
                                        <img src="<?php echo $itempic ?>">
                                        <div class="cleaner"><ul><li>
                                            <?php echo "NO.".$bidid.": ".$biditem ?>
                                        </li></ul></div>
                                    </div>
                                    <div class="span8">
                                        <div class="location">
                                            <center>
                                            <table border = "2">
                                                <caption><h4>Bid History</h4></caption>
                                                <tr>
                                                    <th>Bid DateTime</th>
                                                    <th>Bid Price</th>
                                                </tr>
<?php
    $table = explode('|', $bidhistory);
    foreach($table as $value){
        if($value != null){
            if($count % 2 == 1){
                echo "<tr><td>".$value."</td>";
            }
            else {
                echo "<td> £ ".$value."</td></tr>";
            }
            $count++;
        }
    }
?>
                                            </table>
                                            </center>
                                        </div>
                                    </div>
                                </div>
                            </div>
<?php } ?>
                          </div>
                          <div class="tab-pane" id="panel-741064">

<?php
    //$bidderid = $_SESSION['loginid'];
    //$link = mysqli_connect('localhost','zby','root','Database_Project');
    $query2 = "SELECT * FROM tbl_bid
               INNER JOIN tbl_item
               ON tbl_bid.bid_item_id = tbl_item.item_id
               WHERE bid_buyer_id = '$bidderid'
               AND bid_status IN ('bid_winner','bid_not_winner','bid_done')";
               $result2 = mysqli_query($link,$query2);
    while($row2 = mysqli_fetch_array($result2)){
        $biditem1 = $row2['item_name'];
        $itempic1 = $row2['item_pic1'];
        $bidid1 = $row2['bid_id'];
        $bidhistory1 = $row2['bid_history'];
        $count1 = 1;
?>
                            <div class="booking">
                                <div class="row">
                                    <div class="span4">
                                        <img src="<?php echo $itempic1 ?>">
                                        <div class="cleaner"><ul><li>
                                            <?php echo "NO.".$bidid1.": ".$biditem1 ?>
                                        </li></ul></div>
                                    </div>
                                    <div class="span8">
                                        <div class="location">
                                            <center>
                                                <table border = "2">
                                                    <caption>Bid History</caption>
                                                    <tr>
                                                        <th>Bid DateTime</th>
                                                        <th>Bid Price</th>
                                                    </tr>
<?php
    $table1 = explode('|', $bidhistory1);
    foreach($table1 as $value1){
        if($value1 != null){
            if($count1 % 2 == 1){
                echo "<tr><td>".$value1."</td>";
            }
            else {
                echo "<td> £ ".$value1."</td></tr>";
            }
            $count1++;
        }
    }
    ?>
                                                </table>
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
