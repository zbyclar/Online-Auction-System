<?php
    session_start();
    include('connect.php');
    $page = "catalogue";
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
        <link href="css/bootstrap.min.css" rel="stylesheet">
        <link href="css/navbar-fixed-top.css" rel="stylesheet">
        <link href="css/index.css" rel="stylesheet">
        <link href="css/catalogue.css" rel="stylesheet">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
    </head>
    
    <body>
    <?php include('navbar.php'); ?>
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="tabbable" id="tabs-342571">
                        <ul class="nav nav-tabs">
                            <li>
                                <a href="#panel-170883" data-toggle="tab">Section 1</a>
                            </li>
                            <li class="active">
                                <a href="#panel-264791" data-toggle="tab">Section 2</a>
                            </li>
                        </ul>

                        <div class="tab-content">
                            <div class="tab-pane" id="panel-170883">
                                <div class="container-fluid">
<?php
      $link = mysqli_connect('localhost','zby','root','Database_Project');
      if(isset($_GET['new'])){                            
          $category = $_GET['new'];
          $now = date("Y-m-d G:i:s");
          $query = "SELECT * FROM tbl_item WHERE item_category_short='$category' AND item_endtime > '$now'";
      }
      else if (isset($_GET['item'])){
          $itemname = $_GET['item'];
          $now = date("Y-m-d G:i:s");
          $query = "SELECT * FROM tbl_item WHERE item_name LIKE '$itemname%' AND item_endtime > '$now'";
      }
      else if (isset($_GET['sellerid'])){
          $seller_id = $_GET['sellerid'];
          $now = date("Y-m-d G:i:s");
          $query = "SELECT * FROM tbl_item WHERE item_seller_id='$seller_id' AND item_endtime > '$now'";
      }
      $messages1 = mysqli_query($link,$query);
      $messages2 = mysqli_query($link,$query);
      $rownum = mysqli_num_rows($messages1);
      $count = 0;
      if($rownum == 0){
          ?>
      
          <h2>Results Not Found! Please Try Again!</h2>
          <?php
      }
      while($row=mysqli_fetch_array($messages1)){
         $count = $count+1;
         $check = $count % 3;
         if($check==1){
?>
          <div class="row">
<?php } ?>
            <div class = "col-md-4">
                <div class="item-description">
                    <h5><?php echo $row['item_name']?></h5>
                    <h5>£ <?php echo $row['item_strprice']?></h5>
                    <h5><?php echo $row['item_endtime']?></h5>
                </div>
                <img alt="Bootstrap Image Preview" class="img-responsive" src="<?php echo $row['item_pic1'] ?>"><br>
                <a href="itemview.php?id=<?php echo $row['item_id'];?>"><button type="button" class="btn" >Viewing</button></a>
            </div>
<?php
        if($check==0){
?>
        </div>

<?php }
        else if($count == $rownum){
?>
        </div>
<?php }} ?>
</div>
</div>


                            <div class="tab-pane active" id="panel-264791">
                                <div class="container-fluid">
<?php
    $rownum = mysqli_num_rows($messages2);
    if($rownum == 0){
          ?>
      
          <h2>Results Not Found! Please Try Again!</h2>
          <?php
      }
    while($unit=mysqli_fetch_array($messages2)){
?>
<div class="row row-display">
<div class="col-md-4">
<img alt="Bootstrap Image Preview" class="img-responsive" src="<?php echo $unit['item_pic1'] ?>"><br>
    <a href="itemview.php?id=<?php echo $unit['item_id'];?>"><button type="button" class="btn">Viewing</button></a>
</div>
<div class="col-md-8">
<h2><?php echo $unit['item_name']?></h2>
<p><?php echo $unit['item_description']?></p>
</div></div>
<?php } ?>                      </div>
                            </div>
                        </div>
                    </div>
                </div>
<footer id="bottom">Design by Database Project Group</footer>
            </div>

        
        
        <!-- ===============================================js============================================== -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
        <script>window.jQuery || document.write('<script src="../../assets/js/vendor/jquery.min.js"><\/script>')</script>
        <script src="js/bootstrap.min.js"></script>
        <script src="js/jquery.leanModal.min.js"></script>
        <script>
            $(function(){
              $('#loginform').submit(function(e){
                                     return true;
                                     });
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
              $('#modaltrigger').leanModal({ top: 110, overlay: 0.45, closeButton: ".hidemodal" });
              });
              function show_modal(editModal){
       
    var show = document.getElementById(editModal);
    if (show.style.display === "block"){
            
        show.style.display = "none";
        show.setAttribute("aria-hidden",true);
        show.class = "modal fade";
            
    } else {
            
        show.style.display = "block";
        show.setAttribute("aria-hidden",false);
        show.className = "modal fade in";
            
    }
    }
            </script>
    </body>
</html>

