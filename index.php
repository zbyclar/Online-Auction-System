<?php
    session_start();
    include('connect.php');
    $page = "index";
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
  </head>

  <body>

    <?php include('navbar.php'); ?>
      <!-- change the below part for each html page -->
    <div style="padding:120px 0;">
        <div id="thumbnail-slider">
            <div class="inner">
                <ul>
                    <li>
                        <a class="thumb" href="img/6.jpg"></a>
                    </li>
                    <li>
                        <a class="thumb" href="img/7.jpg"></a>
                    </li>
                    <li>
                        <a class="thumb" href="img/2.jpg"></a>
                    </li>
                    <li>
                        <a class="thumb" href="img/3.jpg"></a>
                    </li>
                    <li>
                        <a class="thumb" href="img/4.jpg"></a>
                    </li>
                    <li>
                        <a class="thumb" href="img/5.jpg"></a>
                    </li>
                    <li>
                        <a class="thumb" href="img/8.jpg"></a>
                    </li>
                    <li>
                        <a class="thumb" href="img/9.jpg"></a>
                    </li>
                    <li>
                        <a class="thumb" href="img/10.jpg"></a>
                    </li>
                    <li>
                        <a class="thumb" href="img/11.jpg"></a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <footer style="text-align:center">Design by Database Project Group</footer>


    <!-- ===============================================js============================================== -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src="js/thumbnail-slider.js" type="text/javascript"></script>
    <script>window.jQuery || document.write('<script src="../../assets/js/vendor/jquery.min.js"><\/script>')</script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/jquery.leanModal.min.js"></script>
    <script>
    $(function(){
    $('#loginform').submit(function(e){
    return true;
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
