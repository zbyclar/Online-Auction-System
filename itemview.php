<?php
session_start(); 
include('connect.php'); 
$page = "itemview";
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="../../favicon.ico">

    <title>Database Project</title>
    <!-- CSS -->
    <link href="css/thumbnail-slider.css" rel="stylesheet" type="text/css">
    <link href="css/viewitem.css" rel = "stylesheet" type="text/css">
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/navbar-fixed-top.css" rel="stylesheet">
    <link href="css/index.css" rel="stylesheet">
    <link rel="stylesheet" href="css/font-awesome.min.css">
    <link href="css/fontawesome-stars.css" rel="stylesheet">
  </head>

  <body>

    <?php include('navbar.php'); ?>
    <div id="display_results"></div>
    <?php 
        if (isset($_GET['id'])){
            $item_id = $_GET['id'];
            $_SESSION['itemid'] = $item_id;
            //session_write_close();
        }
        else{
            if (isset($_SESSION['itemid'])){
                $item_id = $_SESSION['itemid'];
            }
            else
                header('location: catelogue.php?error=no_item');
        }
        $query = "SELECT * FROM tbl_item WHERE item_id = '$item_id'";
        if ($link == false){
          die(mysqli_connect_error());
        }
        $link = mysqli_connect('localhost','zby','root','Database_Project');
        $result = mysqli_query($link, $query);
        while($row = mysqli_fetch_array($result)){
            $item_name = $row['item_name'];
            $item_strprice = $row['item_strprice'];
            $item_strtime = $row['item_strtime'];
            $item_endtime = $row['item_endtime'];
            $item_pic1 = $row['item_pic1'];
            $item_pic2 = $row['item_pic2'];
            $item_pic3 = $row['item_pic3'];
            $item_seller_id = $row['item_seller_id'];
            $item_category_short = $row['item_category_short'];
            $item_description = $row['item_description'];
        }
        
        $query_auction = "SELECT * FROM tbl_auction WHERE auction_item_id = '$item_id'";
        if ($link == false){
          die(mysqli_connect_error());
        }
        $result_auction = mysqli_query($link, $query_auction);
        while($row_auction = mysqli_fetch_array($result_auction)){
            $item_visit = $row_auction['auction_visit'];
        }
        $item_visit = $item_visit+1;
        $query_update = "UPDATE tbl_auction SET auction_visit = '$item_visit' WHERE auction_item_id = '$item_id'";
        $result_update = mysqli_query($link,$query_update);
        $query2 = "SELECT * FROM tbl_bid WHERE bid_item_id = '$item_id' ORDER BY bid_price DESC LIMIT 1";
        $result2 = mysqli_query($link, $query2);
        if ($result2){
            while($row_bid = mysqli_fetch_array($result2)){
                $bid_price = $row_bid['bid_price'];
            }
        }
        else{
            $bid_price = $item_strprice;
        }
        if(!isset($bid_price))
            $bid_price = $item_strprice;
        $query3 = "SELECT bid_id FROM tbl_bid WHERE bid_item_id = '$item_id'";
        $result3 = mysqli_query($link, $query3);
        $bidhistory = mysqli_num_rows($result3);
        $query4 = "SELECT tbl_user.user_name FROM tbl_item, tbl_user WHERE item_id = '$item_id' AND user_id = item_seller_id";
        $result4 = mysqli_query($link, $query4);
        while($row_id = mysqli_fetch_array($result4)){
            $sell_id = $row_id['user_name'];
        }
        
    ?>
    <div class="container"> 
    <?php
         if(isset($_GET['addBid'])) {
             $result = $_GET['addBid'];
                  if($result=='success') { 
    ?>
        <div class="alert alert-success alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
            <strong>Success!</strong> You have bid the item successfully!
        </div> 
        <div id="ratemodal" style="display:block;" class="modal fade in">
            <div class=" panel panel-default modal-dialog">
            <div class="modal-header">
            <h4 style="color: black;text-align: center" class="modal-title" id="myModalLabel">Rating</h4>
            </div>
            <div class="modal-body">
            <form id="rateform" name="rateform" method="post" action="rate.php">
            <label for="username">Rate the bid:</label>
            <select id="rating" name="ratinggrade">
              <option value="1">1</option>
              <option value="2">2</option>
              <option value="3">3</option>
              <option value="4">4</option>
              <option value="5">5</option>
            </select><br>
            <label for="comment">Comment:</label>
                <br>
            <!--<input type="comment" name="comment" id="comment" class="txtfield">-->
                <textarea Name="comment" rows="4" cols="40">Enter text here...</textarea>
            <div class="center" style="text-align:center">
            <input type="submit" name="ratebtn" id="ratebtn" class="flatbtn-blu hidemodal" value="Rating">
            </div>
            </form>
            </div>
            </div>
        </div>
        <?php
        }
        if($result=='failed') {
        ?>
        <div class="alert alert-danger alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr- only">Close</span></button>
            <strong>Failed!</strong> Something is wrong, please try again! 
        </div>
        <?php
        }
             if($result == 'failednothigh'){
                 ?>
                 <div class="alert alert-danger alert-dismissible" role="alert">
                    <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr- only">Close</span></button>
                 <strong>Failed!</strong> Bid price not higher than highest bid, please try again! 
                 </div>
        <?php
        
             }
             if($result == 'failedtoolate'){
                 ?>
                 <div class="alert alert-danger alert-dismissible" role="alert">
                    <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr- only">Close</span></button>
                 <strong>Failed!</strong> Sorry the auction is expired, please see other auctions! 
                 </div>
        <?php
        
             }
        }
        if(isset($_GET['isLogin'])){
            $login = $_GET['isLogin'];
            if($login == 'no'){
            ?>
            <div class="alert alert-danger alert-dismissible" role="alert">
                <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <strong>Failed!</strong> You have not logged in yet!
            </div> 
        <?php
            }
        }
        if(isset($_GET['addRating'])){
            $rating = $_GET['addRating'];
            if($rating == 'failed'){
            ?>
            <div class="alert alert-danger alert-dismissible" role="alert">
                <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <strong>Failed!</strong> Rating failed!
            </div> 
        <?php
            }
            else{
                ?>
            <div class="alert alert-success alert-dismissible" role="alert">
                <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <strong>Success!</strong> Rating successful!
            </div> 
        <?php
            }
        }
    ?> 
    </div>
    <div class="container" style="margin-top:30px;font-size:15px;">
        <div class="col-xs-12 col-md-5">
            <div class="CheckoutButtonLocation">
            </div>
            <div class="panel panel-default">
            
                <div class="panel-heading clearfix">
                     <h4 class="panel-title pull-left"><?php echo $item_name; ?></h4>
                </div>
                 <div class="panel-body">
                    <form class="form-horizontal" id ="form">
                    <div class="form-group">
                        <label class="col-xs-1"></label>
                    <div class="col-xs-10" style="text-align:center" >
                        <img id="previewimg" src="<?php echo $item_pic1; ?>" class="img-rounded" alt="Round Image" style="height:85%;width:90%" >
                    </div>
                    </div>
                    <hr class="hr">
                    <div class="row">
                        <div class="col-xs-6 col-md-4">
                            <a href="#">
                                 <img class="img-thumbnail" src="<?php echo $item_pic1; ?>">
                             </a>
                        </div>
                        <div class="col-xs-6 col-md-4">
                            <a href="#">
                                 <img class="img-thumbnail" src="<?php echo $item_pic2; ?>">
                             </a>
                        </div>
                        <div class="col-xs-6 col-md-4">
                            <a href="#">
                                 <img class="img-thumbnail" src="<?php echo $item_pic3; ?>">
                             </a>
                        </div>

                   
                    </div>
                    </form>
                 </div>
           </div>
         </div>
      <div class="col-xs-12 col-md-7">
          <div class="panel panel-default">
              <form action="bid.php" method="post">
              <table class="table table-condensed bidding">
          <tr>
          <td>
            <strong>Current Price</strong>
          </td>
          <td>
            <strong>
                <span class="Bidding_Current_Price awe-rt-CurrentPrice">
                    
                    £<span class="NumberPart"><?php echo $bid_price; ?></span>
                </span>

            </strong>
          </td>

          </tr>


    <tr>
        <td>Minimum Bid</td>
        <td>
            <span class="Bidding_Listing_MinPrice awe-rt-MinimumBid">
                
                £<span class="NumberPart"><?php echo $bid_price+1; ?></span>
            </span>

            <em class="awe-rt-MinimumBidMath awe-hidden">
                &nbsp;(
                <span class="Bidding_Current_Price awe-rt-CurrentPrice">
                    
                    £<span class="NumberPart"><?php echo $bid_price; ?></span>
                </span>
                +
                <span class="Bidding_Listing_Increment awe-rt-Increment">
                    
                    £<span class="NumberPart">1.00</span>
                </span>
                )
            </em>
        </td>
    </tr>
    <tr class="success">
        <td class="hidden-xs">
             Your Maximum Proxy Bid
        </td>
        <td colspan="2">
            <p class="visible-xs">
             Your Maximum Proxy Bid
            </p>
            <div class='input-group'>
                <span class='input-group-addon'>£</span>
                <input class="form-control" id="BidAmount" name="BidAmount" type="text" value="" />
                <input class="form-control" name="bid_item_id" type="hidden" value="<?php echo $item_id; ?>"/>
            </div>
        </td>

        </tr>
        <tr>
        <td>
            <em>
                        <span class="awe-rt-Hide">
                            <small>
                                Remaining Time:
                            </small><br />
                            <small data-epoch="ending" data-end-hide-selector="[data-listingid='333085'] .awe-rt-Hide" data-action-time="02/04/2016 21:28:11">
                                <?php $date = date('Y-m-d H:i:s');
                                        $date_today = new DateTime($date);
                                        $date_end = new DateTime($item_endtime);
                                        $diff = $date_today ->diff($date_end);
                                        //echo $diff->format("%d %H:%I:%S");
                                       //$since_start = $date->diff(new DateTime('$item_endtime'));
                                       echo $diff->days.' Day(s), ';
                                       echo $diff->h.' Hour(s), ';
                                       echo $diff->i.' Minute(s), ';
                                       echo $diff->s.' Second(s)';
                                  ?>
                            </small>
                        </span>

            </em>
        </td>
        <td>
            <input type="submit" class="btn btn-success btn-block pull-right" value="Submit Bid" />
        </td>
    </tr>

    <tr>
        <td colspan="2">
            <small>
                <em>
Auction now will bid incrementally for you up to your maximum bid. Your maximum bid is kept a secret from other users.  &nbsp;
                    Your bid is a contract between you and the listing creator.  If you have the highest bid you will enter into a legally binding purchase contract.
                </em>
            </small>
        </td>
    </tr>
</table></form>
          </div>
          <div class="panel panel-default">
        <table class="table table-condensed">
            <tr>
                <td>
                    <strong>Current Price</strong>
                </td>
                <td>
                    <span class="Bidding_Current_Price awe-rt-CurrentPrice">
                        
                        £<span class="NumberPart"><?php echo $bid_price; ?></span>
                    </span>&nbsp;
                    
                    <span class="status-label awe-rt-ColoredStatus">
                            <span class="label label-info pull-right">
                            <?php $date = date('Y-m-d H:i:s');
                                       if ($date < $item_endtime)
                                           echo 'Active';
                                       else
                                           echo 'Inactive';  
                                  ?>
                            
                            
                            
                            </span>

                    </span>
                </td>
            </tr>

            <tr>
                <td><strong>End Date</strong></td>
                <td>
                   <?php echo $item_endtime;  ?>
                   
                    
                </td>
            </tr>

            <tr>
                <td><strong>Start Date</strong></td>
                <td>
                <?php echo $item_strtime;  ?>
                </td>
            </tr>
            <td><strong>Bid History</strong></td>
                <td>
                    <span class="awe-rt-AcceptedListingActionCount" data-previous-value="0"> <?php 
                        if ($bidhistory) echo $bidhistory;
                        else
                        echo "No"; ?></span>&nbsp;Bids &nbsp;

                </td>

            <tr>
                <td>
                    <strong>Listed By</strong>
                </td>
                <td>
                    <span class="Seller"> <?php echo $sell_id;?></span>
                </td>
                
            </tr>
            <tr>
                <td colspan="2">
                    <a class="btn btn-xs btn-info pull-left hidden-xs" href="/AWDemo/Listing/Browse?Seller=BidderBill">View Seller&#39;s Other Listings</a>
                    <a class="btn btn-xs btn-info pull-left visible-xs" href="/AWDemo/Listing/Browse?Seller=BidderBill">View More Listings</a>
                </td>
            </tr>
        </table>
    </div>

      </div>
      <div class="col-xs-12">
          <div class="panel panel-default">
              <div class="panel-body">
                  <ul class="tabs">
		<li class="tab-link current" data-tab="tab-1">Description</li>
		<li class="tab-link" data-tab="tab-2">Bid History</li>
	</ul>

	<div id="tab-1" class="tab-content">
		<table style="direction:ltr; border-collapse:collapse; border-style:solid; border-color:#A3A3A3; border-width:0pt">
	<tbody>
	    <?php $array = explode(",", $item_description);
	          for ($i = 0; $i < count($array); $i++){
	          $array_content = explode(":",$array[$i]);
	     ?>
		<tr>
			<td style="border-width:0pt; vertical-align:top; width:2.1993in; padding:4pt 4pt 4pt 4pt">
			<p style="margin:0in; font-family:Arial; font-size:9.0pt; color:black"> <?php echo $array_content[0]; ?></p>
			</td>
			<td style="border-width:0pt; vertical-align:top; width:1.4437in; padding:4pt 4pt 4pt 4pt">
			<p style="margin:0in; font-family:Arial; font-size:9.0pt; color:black"> <?php echo $array_content[1]; ?></p>
			</td>
		</tr>
		<?php
		}
		?>
	</tbody>
</table>

	</div>
	<div id="tab-2" class="tab-content">
	<table class="table-condensed">
            <tr>
                <td><strong>Current Price</strong></td>
                <td><?php echo "£".$bid_price; ?></td>
            </tr>
            <tr>
                <td><strong>Starting Price</strong></td>
                <td><?php echo "£".$item_strprice; ?></td>
            </tr>

    <tr>
        <td><strong>Number of Bids</strong></td>
        <td> <?php echo $bidhistory; ?> </td>
    </tr>
        <tr>
            <td><strong>Remaining Time</strong></td>
            <td>
            <?php $date = date('Y-m-d H:i:s');
               
                                        $date_today = new DateTime($date);
                                        $date_end = new DateTime($item_endtime);
                                        $diff = $date_today ->diff($date_end);
                                        //echo $diff->format("%d %H:%I:%S");
                                       //$since_start = $date->diff(new DateTime('$item_endtime'));
                                       echo $diff->days.' Day(s), ';
                                       echo $diff->h.' Hour(s), ';
                                       echo $diff->i.' Minute(s), ';
                                       echo $diff->s.' Second(s)';
                                  ?>
            </td>
        </tr>
        <tr>
            <td><strong>Start Date/Time</strong></td>
            <td>
            <?php echo $item_strtime;  ?>
            </td>
        </tr>
        <tr>
            <td><strong>End Date/Time</strong></td>
            <td>
            <?php echo $item_endtime; ?>
            </td>
        </tr>
    <tr>
        <td><strong>Seller</strong></td>
        <td>
         <?php echo $sell_id;?>
        </td>
    </tr>
    <tr>
        <td></td>
        <td></td>
    </tr>
</table>

	<table style="direction:ltr; border-collapse:collapse; border-style:solid; border-color:#A3A3A3; border-width:0pt">
	<tbody>
	    <tr>
             <th>Bid Time</th>
             <th>Username</th>
             <th>Bid Price</th>
             
        </tr>
	    <?php $query = "SELECT tbl_user.user_name, tbl_bid.bid_price, tbl_bid.bid_time FROM tbl_bid, tbl_user
	                    WHERE bid_item_id = '$item_id' AND user_id = bid_buyer_id ORDER BY tbl_bid.bid_price DESC";
	          $result = mysqli_query($link, $query);
	          while($row = mysqli_fetch_array($result)){
	     ?>
		<tr>
			<td style="border-width:0pt; vertical-align:top; width:2.1993in; padding:4pt 4pt 4pt 4pt">
			<p style="margin:0in; font-family:Arial; font-size:9.0pt; color:black"> <?php echo $row['bid_time']; ?></p>
			</td>
			<td style="border-width:0pt; vertical-align:top; width:1.4437in; padding:4pt 4pt 4pt 4pt">
			<p style="margin:0in; font-family:Arial; font-size:9.0pt; color:black"> <?php echo $row['user_name']; ?></p>
			</td>
			<td style="border-width:0pt; vertical-align:top; width:1.4437in; padding:4pt 4pt 4pt 4pt">
			<p style="margin:0in; font-family:Arial; font-size:9.0pt; color:black"> <?php echo $row['bid_price']; ?></p>
			</td>
		</tr>
		<?php
		}
		?>
        </tbody>
        </table>
    </div> <!-- /container -->
    

              </div>
          </div>
        </div>
        <footer id="bottom">Design by Database Project Group</footer>
      </div>
    </body>
    <!-- ===============================================js============================================== -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src="js/thumbnail-slider.js" type="text/javascript"></script>
    <script>window.jQuery || document.write('<script src="../../assets/js/vendor/jquery.min.js"><\/script>')</script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/jquery.leanModal.min.js"></script>
    <script src="js/jquery.barrating.min.js"></script>


    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    
    <script type="text/javascript">
        $(document).ready(function () {
            $("img.img-thumbnail").click(function () {
                var thumb = this;
                $('#previewimg').fadeOut("fast", function () {
                    $("#previewimg").attr("src", $(thumb).attr("src"));
                    $('#previewimg').fadeIn("fast");
                });
            });
            $('ul.tabs li').click(function(){
		var tab_id = $(this).attr('data-tab');

		$('ul.tabs li').removeClass('current');
		$('.tab-content').removeClass('current');

		$(this).addClass('current');
		$("#"+tab_id).addClass('current');
	    })

        });
        
    $('#loginform').submit(function(e){
    return true;
    });
    $('#modaltrigger').leanModal({ top: 110, overlay: 0.45, closeButton: ".hidemodal" });
    $('#search').keyup(function(){
        var filter = $(this).val();
        console.log(filter);
        $.ajax({
        type: "POST",
        url: "getsearch.php",
        data: {filter: filter},
        success: function(result){    
            if(result) {
                $('#searchappend').append(result);
                
            }
            else{
            }
            
        }
        });
    });    
     $(function() {
      $('#rating').barrating({
        theme: 'fontawesome-stars'
      });
   });
    
    </script>
    
  
</html>
