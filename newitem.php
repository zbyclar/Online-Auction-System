<?php
    session_start();
    include('connect.php');
    $page = "newitem";
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

        <link href="css/bootstrap.min.css" rel="stylesheet">
        <link href="css/navbar-fixed-top.css" rel="stylesheet">
        <link href="css/index.css" rel="stylesheet">
        <link rel="stylesheet" type="text/css" href="css/uploadify.css" />
    <link href="css/newitem.css" rel="stylesheet" type="text/css">
    </head>
    
    <body>
        
        <!-- Fixed navbar: should be put in every html page to keep consitence -->
       <?php include('navbar.php'); ?>
        <div class="container">
        <div class="panel panel-default">
            
            <div class="panel-heading clearfix">
                <h4 class="panel-title">Place a new auction</h4>
            </div>
            <div class="panel-body">
                <form class="signup" action="" method="POST">
                    <table class="itemadd">
                        <tr>
                            <td>Item Name</td>
                            <td class="input-box"><input type="text" class='item-input' id="itemname" name="itemname" placeholder="">
                            </td>
                        </tr>
                        <tr>
                            <td>Initial Price</td>
                            <td class="input-box">
                                <input class="item-input" id="BidAmount" name="BidAmount" type="text" value=" £" onfocus="if(this.value==defaultValue) {this.value='';this.type='number'}">
                            </td>
                        </tr>
                        <tr>
                            <td>Item Category</td>
                            <td class="input-box">
                                <select calss='item-select' id="category">
                                    <option value ="category1">category1</option>
                                    <option value ="category2">category2</option>
                                    <option value ="category3">category3</option>
                                    <option value ="category4">category4</option>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td>Item Descripton</td>
                            <td class="input-box">
                                <textarea id="itemdescription" class="item-input-textarea" rows="10" cols="40"></textarea>
                            </td>
                        </tr>
                    </table>
                    <br>
                    <legend><h3>Picture Upload</h3></legend>
                    <div class="col-md-12">
                        <div class="col-md-4">
                            <input type="file" name="file_upload" id="file_upload1" />
                        </div>
                        <div class="col-md-4">
                            <input type="file" name="file_upload" id="file_upload2" />
                        </div>
                        <div class="col-md-4">
                            <input type="file" name="file_upload" id="file_upload3" />
                        </div>
                    </div>
                    <br>
                    <div class="control-group">
                <!-- Button -->
                    <div class="controls-button">
                        <button class="btn">Register</button>
                    </div>
                </form>
            </div>
            </div>
       <footer style="text-align:center;margin:auto">Design by Database Project Group</footer>
        <!-- ===============================================js============================================== -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
        <script src="js/thumbnail-slider.js" type="text/javascript"></script>
        <script>window.jQuery || document.write('<script src="../../assets/js/vendor/jquery.min.js"><\/script>')</script>
        <script src="js/bootstrap.min.js"></script>
        <script src="js/jquery.leanModal.min.js"></script>
        <script type="text/javascript" src="js/jquery.uploadify.min.js"></script>
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
        <script>
            function viewmypic(mypic,imgfile) {
                if (imgfile.value){
                    mypic.src=imgfile.value;
                    mypic.style.display="";
                    mypic.border=1; 
                } 
            } 
        </script>
        <script>
            $(function() {
              $('#file_upload1').uploadify({
                                          'swf'      : 'uploadify.swf',
                                          'uploader' : 'uploadify.php'
                                          // Put your options here
                                          });
              $('#file_upload2').uploadify({
                                           'swf'      : 'uploadify.swf',
                                           'uploader' : 'uploadify.php'
                                           // Put your options here
                                           });
              $('#file_upload3').uploadify({
                                           'swf'      : 'uploadify.swf',
                                           'uploader' : 'uploadify.php'
                                           // Put your options here
                                           });


              });
        </script>
    </body>
</html>

