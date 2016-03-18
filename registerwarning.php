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
        <a href="signup.php"><h4>Due to duplicate of your username and email, the register is failer. Click the link to return to the signup page.</h4></a>

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
