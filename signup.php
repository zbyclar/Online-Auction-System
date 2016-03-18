<?php
    session_start();
    include('connect.php');
    $page = "signup";
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
        <link href="css/signup.css" rel="stylesheet" type="text/css">
        <link href="css/bootstrap.min.css" rel="stylesheet">
        <link href="css/navbar-fixed-top.css" rel="stylesheet">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
        <link href="css/index.css" rel="stylesheet">
    </head>
    
    <body>
        <?php include('navbar.php'); ?>
        <div class="container">
        <div class="panel panel-default">
            
                <div class="panel-heading clearfix">
                     <center><h4 class="panel-title">Register</h4></center>
                </div>
                 <div class="panel-body">
        <form class="signup" action="usersignup.php" method="POST">
            <fieldset>
                
                <div class="control-group-check">
                    Please choose your gender:
                    <input type="radio" name="gender" value="male" checked="checked" />Male
                    <input type="radio" name="gender" value="female" />Female
                </div>
                <div class="control-group">
                    <br>
                    <div class="controls">
                        <input type="text" id="username_ini" name="username_ini" placeholder="" class="form-control input-lg" value="Username" onfocus="if(this.value=='Username')this.value='';" onblur="if(!value) {value=defaultValue; this.type='text';}" data-toggle="popover"  data-content="Username can contain any letters or numbers, without spaces">

                    </div>
                </div>
                
                <div class="control-group">
                    <br>
                    <div class="controls">
                        <input type="email" id="email" name="email" placeholder="" class="form-control input-lg" value="E-mail" onfocus="if(this.value=='E-mail')this.value='';" onblur="if(!value) {value=defaultValue; this.type='text';}" data-toggle="popover"  data-content="Please provide your E-mail" onKeyUp="validateForm()" required>

                    </div>
                </div>
                
                <div class="control-group">
                    <br>
                    <div class="controls">
                        <input type="text" id="password_ini" name="password_ini" placeholder="" class="form-control input-lg" name="pwd" value="Password" onfocus="if(this.value==defaultValue) {this.value='';this.type='password'}" onblur="if(!value) {value=defaultValue; this.type='text';}" data-toggle="popover"  data-content="Password should be at least 6 characters" onKeyUp="validatePwd()" required>

                    </div>
                </div>
                
                <div class="control-group">
                    <br>
                    <div class="controls">
                        <input type="text" id="password_confirm" name="password_confirm" placeholder="" class="form-control input-lg" value="Password Confirmation" onfocus="if(this.value==defaultValue) {this.value='';this.type='password'}" onblur="if(!value) {value=defaultValue; this.type='text';}" data-toggle="popover"  data-content="Please confirm password" onKeyUp="validatePwdconfirm()" required>

                    </div>
                </div>
                <div class="control-group-option">
                    Date of Birth:
                    <select id="daydropdown" name="day">
                    </select>
                    <select id="monthdropdown" name="month">
                    </select>
                    <select id="yeardropdown" name="year">
                    </select>
                </div>
                <div class="control-group-check">
                    <br>
                    <div class="controls">
                        <input type="checkbox" id="issub" name="issub" value="0" onclick="this.value=(this.value==0)?1:0">Would you like to get our latest update via email ?
                    </div>
                </div>
                <div class="control-group">
                    <!-- Button -->
                    <div class="controls-button">
                        <button class="btn" id="btn_submit" name="submit" onclick="check()">Register</button>
                    </div>
                </div>
        </form>
        </div>
        </div>
        </div>

        <script type="text/javascript">

            //populatedropdown(id_of_day_select, id_of_month_select, id_of_year_select)
            window.onload=function(){
            populatedropdown("daydropdown", "monthdropdown", "yeardropdown")
        }
        </script>
        </fieldset>
        </form>
        <footer id="bottom">Design by Database Project Group</footer>
        <!-- ===============================================js============================================== -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
        <script src="js/thumbnail-slider.js" type="text/javascript"></script>
        <script>window.jQuery || document.write('<script src="../../assets/js/vendor/jquery.min.js"><\/script>')</script>
        <script src="js/bootstrap.min.js"></script>
        <script src="js/jquery.leanModal.min.js"></script>
        <script>
$(function() {
  // 初始化 popover，触发方式为手动触发
  $("[data-toggle='popover']").popover({

  })
  .on('focus', function() {
    // 获得焦点时隐藏
    $(this).popover('show');
  })
  .on('blur', function() {
    // 失去焦点时显示
    $(this).popover('hide');
  });
});
</script>
        <script>
            $(function(){
              $('#loginform').submit(function(e){
                                     return true;
                                     });
              $('#modaltrigger').leanModal({ top: 110, overlay: 0.45, closeButton: ".hidemodal" });
              });
         </script>
        <script type="text/javascript">

            /***********************************************
            * Drop Down Date select script- by JavaScriptKit.com
            * This notice MUST stay intact for use
            * Visit JavaScript Kit at http://www.javascriptkit.com/ for this script and more
            ***********************************************/

            var monthtext=['01','02','03','04','05','06','07','08','09','10','11','12'];

            function populatedropdown(dayfield, monthfield, yearfield){
                var today=new Date()
                var dayfield=document.getElementById(dayfield)
                var monthfield=document.getElementById(monthfield)
                var yearfield=document.getElementById(yearfield)
                for (var i=0; i<=31; i++)
                    dayfield.options[i]=new Option(i, i+1)
                    dayfield.options[today.getDate()]=new Option(today.getDate(), today.getDate(), true, true) //select today's day
                for (var m=0; m<12; m++)
                    monthfield.options[m]=new Option(monthtext[m], monthtext[m])
                    monthfield.options[today.getMonth()]=new Option(monthtext[today.getMonth()], monthtext[today.getMonth()], true, true) //select today's month
                var thisyear=today.getFullYear()
                for (var y=0; y<100; y++){
                    yearfield.options[y]=new Option(thisyear, thisyear)
                    thisyear-=1;
                }
                yearfield.options[0]=new Option(today.getFullYear(), today.getFullYear(), true, true) //select today's year
            }
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
function validateForm(email){
    document.getElementById('btn_submit').disabled = true;
    var regEx = /^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,4})$/;
    var email = document.getElementById('email').value;
    var emailTest = regEx.test(email);
    if(emailTest == true){
        $("#email").css("border","solid #abbce8 1px");
        document.getElementById('btn_submit').disabled = false;
    }
    if(emailTest == false){
        $("#email").css("border","solid pink");
        return false;
    }
}
function validatePwd(){
    document.getElementById('btn_submit').disabled = true;
    var pwd = document.getElementById('password_ini').value;
    if(pwd.length >= 6){
        $("#password_ini").css("border","solid #abbce8 1px");
        document.getElementById('btn_submit').disabled = false;
    }else{
        $("#password_ini").css("border","solid pink");
    }

}
function validatePwdconfirm(){
    document.getElementById('btn_submit').disabled = true;
    var pwd = document.getElementById('password_ini').value;
    var retype_pwd = document.getElementById('password_confirm').value;
    if(retype_pwd == pwd){
        $("#password_confirm").css("border","solid #abbce8 1px");
        document.getElementById('btn_submit').disabled = false;
    }else{
        $("#password_confirm").css("border","solid pink");
    }
}
function check(){
    var username = document.getElementById('username_ini').value;
    var email = document.getElementById('email').value;
    var password = document.getElementById('password_ini').value;
    console.log(username);
    console.log(email);
    console.log(password);
}
    </script>
    </body>
</html>

