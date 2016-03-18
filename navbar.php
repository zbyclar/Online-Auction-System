<!-- Fixed navbar: should be put in every html page to keep consitence -->
<nav class="navbar navbar-default navbar-fixed-top">
<div class="container">
<div class="navbar-header">
<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
<span class="sr-only">Toggle navigation</span>
<span class="icon-bar"></span>
<span class="icon-bar"></span>
<span class="icon-bar"></span>
</button>
<a class="navbar-brand" href="#">Project name</a>
</div>
<div id="navbar" class="navbar-collapse collapse">
<ul class="nav navbar-nav">
<li class="active"><a href="index.php">Home</a></li>
<li><a href="#about">About</a></li>
<li><a href="#contact">Contact</a></li>
<li class="dropdown">
<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Category <span class="caret"></span></a>
<ul class="dropdown-menu">
<?php
      $link = mysqli_connect('localhost','zby','root','Database_Project');
      $query = "SELECT * FROM tbl_category ORDER BY category_short DESC";
      $messages = mysqli_query($link,$query);
      mysqli_close($link);
?>
<?php
      while($row = mysqli_fetch_assoc($messages)):
?>
<li><?php $var=$row['category_short']?><a href="<?php echo "catalogue.php?new=".$var ?>"><?php echo $row['category_name']?></a></li>
<?php endwhile;
    
?>
<li role="separator" class="divider"></li>
<li class="dropdown-header">Auction Status</li>
<li><a href="catalogue.php">Active</a></li>
<li><a href="catalogue.php">Closed</a></li>
</ul>
</li>
<li id="searchappend"><input type="text" name="search" id="search" class="searchbox" tabindex="0" list="searchlist">
</li>
<li><a href="#" id="url"onclick="var url_search = 'catalogue.php?item='+$('#search').val();location.href=url_search;">search</a></li>
</ul>
<ul class="nav navbar-nav navbar-right">
<?php if(isset($_SESSION['loginname'])){?>
<li>
<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Welcome, <?php echo $_SESSION['loginname']; ?><span class="cret"></span></a>
<ul class="dropdown-menu">
<li><a href="myauction.php">My Auction</a></li>
<li><a href="mybid.php">My Bid</a></li>
<li><a href="mynotification.php">My Notification
<?php
    if($_SESSION['flag']==1){
?>
    <span id="special" class="fa-stack fa-lg">
        <i class="fa fa-circle fa-stack-2x"></i>
        <i class="fa fa-flag fa-stack-1x fa-inverse"></i>
    </span>
<?php } ?>
</a></li>
<li><a href="newitem.php">New Auction</a></li>
<li><a href="logout.php">Logout</a></li>
</ul>
</li>
<?php }
else{ ?>
<li><a href="#loginmodal" class="flatbtn" id="modaltrigger">Login</a></li>
<?php } ?>
</ul>
</div>
</div>
</nav>
<div id="loginmodal" style="display:none;">
<center><h2>User Login</h2></center>
<form id="loginform" name="loginform" method="post" action="checkin.php">
<label for="username">Username:</label>
<input type="text" name="username" id="username" class="txtfield" tabindex="1">
<label for="password">Password:</label>
<input type="password" name="password" id="password" class="txtfield" tabindex="2">
<input type="hidden" name="referrer" value="<?php echo $page; ?>" />
<div class="center" style="text-align:center">
<input type="submit" name="loginbtn" id="loginbtn" class="flatbtn-blu hidemodal" value="Log In" tabindex="3">
<input type="button" name="closebtn" id="closebtn" class="flatbtn-blu hidemodal" value="Close" tabindex="3">
<br><br>
<a class="signup"href="signup.php">Sign Up For New Users</a>
</div>


</form>
</div>
