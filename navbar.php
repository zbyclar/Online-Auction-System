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
<li><a href="catalogue.php">Category1</a></li>
<li><a href="catalogue.php">Category2</a></li>
<li><a href="catalogue.php">Category3</a></li>
<li role="separator" class="divider"></li>
<li class="dropdown-header">Nav header</li>
<li><a href="catalogue.php">Category4</a></li>
<li><a href="catalogue.php">Category5</a></li>
</ul>
</li>
<li><input type="text" name="search" id="search" class="searchbox" tabindex="0"></li>
<li><a href="search">search</a></li>
</ul>
<ul class="nav navbar-nav navbar-right">
<li><a href="#loginmodal" class="flatbtn" id="modaltrigger">Login</a></li>
<li><a href="../navbar-static-top/">Static top</a></li>
<li class="active"><a href="./">Fixed top <span class="sr-only">(current)</span></a></li>
</ul>
</div>
</div>
</nav>
<div id="loginmodal" style="display:none;" class="modal fade">
<div class=" panel panel-default modal-dialog">

<div class="modal-header">
<button style="color: black" type="button" class="close" onclick = "show_modal('loginmodal');" >×</button>
<h4 style="color: black;text-align: center" class="modal-title" id="myModalLabel">Login</h4>
</div>
<div class="modal-body">
<form id="loginform" name="loginform" method="post" action="index.html">
<label for="username">Username:</label>
<input type="text" name="username" id="username" class="txtfield" tabindex="1">
<label for="password">Password:</label>
<input type="password" name="password" id="password" class="txtfield" tabindex="2">
<div class="center" style="text-align:center">
<input type="button" name="loginbtn" id="loginbtn" class="flatbtn-blu hidemodal" value="Log In" tabindex="3">
<input type="button" name="closebtn" id="closebtn" class="flatbtn-blu hidemodal" value="Close" tabindex="3">
<br><br>
<a class="signup"href="signup.php">Sign Up For New Users</a>
</div>


</form>
</div>
</div>
</div>
