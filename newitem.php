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
        <script type="text/javascript" src="js/plupload.full.min.js"></script>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="icon" href="../../favicon.ico">
            
        <title>Database Project</title>
        <!-- CSS -->

        <link href="css/bootstrap.min.css" rel="stylesheet">
        <link href="css/navbar-fixed-top.css" rel="stylesheet">
        <link href="css/index.css" rel="stylesheet">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
    <link href="css/newitem.css" rel="stylesheet" type="text/css">
    </head>
    
    <body>
        
        <!-- Fixed navbar: should be put in every html page to keep consitence -->
       <?php include('navbar.php'); ?>
        <div class="container">
        <div class="panel panel-default">
<?php
if(isset($_GET['register'])){
    $login = $_GET['register'];
    if($login == 'success'){
        ?>
        <div class="alert alert-success alert-dismissible" role="alert">
        <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <strong>Success!</strong> Your auction has been placed!
        </div>
<?php }} ?>
            <div class="panel-heading clearfix">
                <h3 class="panel-title">Place a new auction</h3>
            </div>
            <div class="panel-body">
                <form class="signup" action="additem.php" method="POST">
                    <table class="itemadd">
                        <tr>
                            <td>Item Name</td>
                            <td class="input-box"><input type="text" class='item-input' id="itemname" name="itemname" placeholder="">
                            </td>
                        </tr>
                        <tr>
                            <td>Initial Price</td>
                            <td class="input-box">
                                <input class="item-input" id="BidAmount" name="bidamount" type="text" value=" £" onfocus="if(this.value==defaultValue) {this.value='';this.type='number'}">
                            </td>
                        </tr>
                        <tr>
                            <td>Reserve Price</td>
                            <td class="input-box">
                                <input class="item-input" id="ReserveAmount" name="reserveamount" type="text" value=" £" onfocus="if(this.value==defaultValue) {this.value='';this.type='number'}">
                            </td>
                        </tr>
                        <tr>
                            <td>Item Category</td>
                            <td class="input-box">
                                <select calss='item-select' id="category" name="category">
<?php
    $link = mysqli_connect('localhost','zby','root','Database_Project');
    $query = "SELECT category_name FROM tbl_category ORDER BY category_short DESC";
    $messages = mysqli_query($link,$query);
    ?>
<?php
    while($row = mysqli_fetch_assoc($messages)):
    ?>
<option value="<?php echo $row['category_name']?>"><?php echo $row['category_name'];?></option>
<?php endwhile;
    mysqli_close($link);
?>

                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                Duration
                            </td>
                            <td class="input-box">
                                <select class="item-select" id="category" name="duration">
                                  <option value="25">25 hours</option>
                                  <option value="26">26 hours</option>
                                  <option value="27">27 hours</option>
                                  <option value="28">28 hours</option>
                                  <option value="29">29 hours</option>
                                  <option value="30">30 hours</option>
                                  <option value="31">31 hours</option>
                                    <option value="32">32 hours</option>
                                    <option value="33">33 hours</option>
                                    <option value="34">34 hours</option>
                                    <option value="35">35 hours</option>
                                    <option value="36">36 hours</option>

                                </select>
                               
                            </td>
                        </tr>
                        <tr>
                            <td>Item Descripton</td>
                            <td class="input-box">
                                <textarea id="itemdescription" class="item-input-textarea" name="description"rows="10" cols="40"></textarea>
                            </td>
                        </tr>
                    </table>
                    <br>
                    <center><legend><h3>Picture Upload</h3></legend></center>
                    <div class="col-md-12">
                        <ul id="filelist" name=""></ul>
                        <br />
                        <div class="upload">
                        <input  class="btn upload-button"type="button" id="browse" onclick="javascript:;" value="Browse">
                        <input class="btn upload-button"type="button" id="start-upload" onclick="javascript:;" value="Upload">
                        </div>
                    </div>
                    <br>
                    <div class="control-group">
                <!-- Button -->
                    <div class="controls-button">
                        <button type="submit" class="btn">Register</button>
                    </div>
                </form>
            </div>
            </div>
       <footer id="bottom">Design by Database Project Group</footer>
        <!-- ===============================================js============================================== -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
        <script src="js/thumbnail-slider.js" type="text/javascript"></script>
        <script>window.jQuery || document.write('<script src="../../assets/js/vendor/jquery.min.js"><\/script>')</script>
        <script src="js/bootstrap.min.js"></script>
        <script src="js/jquery.leanModal.min.js"></script>
        <script src="js/jquery.ui.plupload.min.js"></script>
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
        <script type="text/javascript">
            var uploader = new plupload.Uploader({
               runtimes : 'html5,flash,silverlight,html4',
               browse_button: 'browse', // this can be an id of a DOM element or the DOM element itself
               url: 'upload.php',
               resize: {
                  width: 400,
                  height: 300,
               }
            });

            uploader.init();

            uploader.bind('FilesAdded', function(up, files) {
              var html = '';
              var temp = "image[]";
              plupload.each(files, function(file) {
                            html += '<li id="' + file.id + '">' + file.name + ' (' + plupload.formatSize(file.size) + ') <b></b></li><br><input type="hidden" name="'+temp+'" value="'+file.name+'">';
                            });
                          
              document.getElementById('filelist').innerHTML += html;
              });

            uploader.bind('UploadProgress', function(up, file) {
              document.getElementById(file.id).getElementsByTagName('b')[0].innerHTML = '<span>' + file.percent + "%</span>";
              });

            uploader.bind('Error', function(up, err) {
              document.getElementById('console').innerHTML += "\nError #" + err.code + ": " + err.message;
              });

            document.getElementById('start-upload').onclick = function() {
                uploader.start();
            };
        </script>
    </body>
</html>

