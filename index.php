<?php
// first thing is to start session 
session_start();
?>
<!DOCTYPE html>
<html>
<head>
    <title>CABIN SHARE</title>
    <link rel="shortcut icon" type="image/x-icon" href="image_assets/favicon.png" />
	<meta charset="UTF-8">
<meta name="viewport" content="width=device-width,height=device-height,initial-scale=1.0"/>

<!-- you should always add your stylesheet (css) in the head tag so that it starts loading before the page html is being displayed -->	
<link rel="stylesheet" href="style.css" type="text/css" />
<link href="Resources/googlefont.css" rel='stylesheet' type='text/css'>
<link rel="stylesheet" href="Resources/bootstrap/css/bootstrap.min.css">
<script src="Resources/jquery.min.js"></script>
<script src="Resources/jquery-latest.min.css"></script>
</head>
<body>
<div>
    <div class="background-image"></div>
<div id="header">
<nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <div class="navbar-header" style="width: 90%">
    <img id="logo" style="float: left; margin: 5px; margin-right: 20px; width : 5%;" src="image_assets/logo.png" class="img-responsive" alt="..." >
        <a id="titleheader" class="navbar-brand" href="index.php" style="font-size: 36px;"> CABIN SHARE</a>
    </div>
      <a href="#" id="loginlink" class="nav navbar-nav navbar-right btn btn-success navbar-btn" style="padding-left: 5px; margin-right: 5px; margin-top: 10px;"><span id="logicon" class="glyphicon glyphicon-log-in"></span>  <span id="logtext">Login</span></a>
  </div>
</nav>
    <?php
if(isset($_SESSION['anything']))
{
   ?>
<script>
    document.getElementById("loginlink").href="logout.php";
    document.getElementById("loginlink").className='nav navbar-nav navbar-right btn btn-danger navbar-btn';
     document.getElementById("logtext").textContent="Logout";
    document.getElementById("logicon").className='glyphicon glyphicon-log-out';
    document.getElementById("loginlink").setAttribute("id", "logoutlink");
</script>
<?php
}
    ?>
 <div class="overlay" id="dialog1" style="display: none;">
    <div class="login-wrapper">
        <div class="login-content">
            <a id="close1" class="close">x</a>
            <h3>Login</h3>
           <form action="login.php?page=index.php" id="form1" method="post" enctype="multipart/form-data" >
               <div id="user">
                   <input style="height: 30px; font-size: 15px;" type="text" id="username" name="username" placeholder="Username" pattern="^[0-9a-zA-Z-_]{5,}$" required/>
               </div>
               <div id="pass" style=" margin-bottom: 40px;">
                   <input style="height: 30px; font-size: 15px;" type="password" id="password" name="password" placeholder="Password" pattern="[^()/> <\][\\\x22,;|]{5,}$" required/>
               </div>
                <button id="submit_1" name="submit_" class="btn btn-sm btn-info upload" type="submit"><span class="glyphicon glyphicon-ok-circle"></span> Login</button> 
            </form>
        </div>
    </div>
    </div>
</div>
<div class="content">
<div class="container">
  <table id="myTable" class="table">
<tr>
    <td><a id="but" href="central.php?category=firstyear">First Year</a></td></tr>
<tr>
        <td><a id="but" href="central.php?category=secondyear">Second Year</a></td></tr>
<tr>
        <td><a id="but" href="central.php?category=thirdyear">Third Year</a></td></tr>
<tr>
        <td><a id="but" href="central.php?category=finalyear">Final Year</a></td></tr>
<tr>
        <td><a id="but" href="central.php?category=others">Others</a></td></tr>
      </table>
</div>
</div>
</div>
<script language="javascript" type="text/javascript">
$(document).ready(function() {
        
     $("#loginlink").click(function( event ){
           event.preventDefault();
           $("#dialog1").fadeToggle("fast");
     });
     $("#logoutlink").click(function( event ){
           event.preventDefault();
           window.location.href = "logout.php?page=index.php"
     });
     $("#close1").click(function(){
        $("#dialog1").fadeToggle("fast");
    });
     $(document).keyup(function(e) {
        if(e.keyCode == 27 && $("#dialog1").css("display") != "none" ) { 
            event.preventDefault();
            $("#dialog1").fadeToggle("fast");
        }
    });
    });
    </script>
</body>
</html>