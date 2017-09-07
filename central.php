<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<link rel="shortcut icon" type="image/x-icon" href="image_assets/favicon.png" />
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width,height=device-height,initial-scale=1.0"/>
<title>CABIN SHARE</title>
<link rel="stylesheet" href="style.css" type="text/css" />
<link href="Resources/googlefont.css" rel='stylesheet' type='text/css'>
<link rel="stylesheet" href="Resources/bootstrap/css/bootstrap.min.css">
<script src="Resources/jquery.min.js"></script>
<script src="Resources/jquery-latest.min.css"></script>
</head>
<?php
// first thing is to start session 
session_start();
// now to check if variable is true
include_once 'dbconfig.php';
    if($_GET['category']=="firstyear")
        $head="mainupload1";
    else if($_GET['category']=="secondyear")
        $head="mainupload2";
    else if($_GET['category']=="thirdyear")
        $head="mainupload3";
    else if($_GET['category']=="finalyear")
        $head="mainupload4";
    else
        $head="mainuploadx";
?>
<body>
 <div class="background-image"></div>
<div>
<nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <div class="navbar-header" style="width: 80%">
    <img id="logo" style="float: left; margin: 5px; margin-right: 20px" src="image_assets/logo.png" class="img-responsive" alt="..." width="4%"  >
        <label id="size">
<?php
    if($_GET['category']=="firstyear")
        echo "FIRST YEAR";
    else if($_GET['category']=="secondyear")
        echo "SECOND YEAR";
    else if($_GET['category']=="thirdyear")
        echo "THIRD YEAR";
    else if($_GET['category']=="finalyear")
        echo "FINAL YEAR";
    else
        echo "OTHERS";
?>
</label>
    </div>
       <a href="#" id="loginlink" class="nav navbar-nav navbar-right btn btn-success navbar-btn" style="padding-left: 5px; margin-right: 5px; margin-top: 10px;"><span id="logicon" class="glyphicon glyphicon-log-in"></span>  <span id="logtext">Login</span></a>
  </div>
</nav>
</div>
<div class="overlay" id="dialog" style="display: none;">
    <div class="login-wrapper">
        <div class="login-content" >
            <a id="close" class="close">x</a>
            <h3>Login</h3>
           <form action="login.php?page=central.php?category=<?php echo $_GET['category'] ?>" id="form" method="post" enctype="multipart/form-data" >
               <div id="user">
                   <input style="height: 30px; font-size: 15px;" type="text" id="username" name="username" placeholder="Username" pattern="^[0-9a-zA-Z-_]{5,}$" required/>
               </div>
               <div id="pass" style=" margin-bottom: 40px;">
                   <input style="height: 30px; font-size: 15px;" type="password" id="password" name="password" placeholder="Password" pattern="[^()/> <\][\\\x22,;|]{5,}$" required/>
               </div>
                <button id="submit" name="submit_" class="btn btn-sm btn-info upload" type="submit"><span class="glyphicon glyphicon-ok-circle"></span> Login</button> 
            </form>
        </div>
    </div>
    </div>
<div class="overlay" id="dialog1" style="display: none;">
    <div class="login-wrapper">
        <div class="login-content" >
            <a id="close1" class="close">x</a>
            <h3>File upload</h3>
           <form action="<?php echo $head ?>.php?info=<?php echo $_GET['category'] ?>" id="form1" method="post" enctype="multipart/form-data" >
               <div id="title_">
                   <input type="text" id="title" name="title" placeholder="Title" pattern="^[0-9a-zA-Z-_]{3,}$" required/>
                   </div>
               <div class="progress progress-striped active">
				<div id="progress-bar1" class="progress-bar" style="width:0%"></div>
			</div>
    <label for="file1" id="addfile_" ><span class="glyphicon glyphicon-plus"></span>  ADD FILE</label>
    <input type="file" name="<?php echo $_GET['category'] ?>" id="file1" style="display:none" onchange="filename1(this); showMyMedia1(this);" />
               <label id="label_1">Nothing selected</label>
               <img id="thumbnil1" style="margin-top:5px;"  src="" alt="..."/>
                <video id="video_1" width="0" controls style="visibility: hidden; margin-top:5px;">
  <source src="" id="video_here1">
    Your browser does not support HTML5 video.
</video>       <br>
               <br>
                <button id="submit_1" name="submit_" class="btn btn-sm btn-info upload" type="submit"><span class="glyphicon glyphicon-upload"></span> Upload</button> <button type="button" id="cancel_1" class="btn btn-sm btn-danger cancel"><span class="glyphicon glyphicon-ban-circle"></span> Cancel</button>
            </form>
        </div>
    </div>
    </div>
<div class="content">
<div id="body">
<div>
     <a href="#" class="btn btn-info" id="Upload_" onclick="return btntest_onclick()">
          <span class="glyphicon glyphicon-home"></span><span > Home</span>
        </a>
     <a href="#" class="hidden" id="titlelink">
          <span class="glyphicon glyphicon-cloud-upload"></span> <span >Upload Title</span>
        </a>
    </div>  
     <br /><br />
</div>
<div class="container">
  <table id="myTable" class="table">
      <?php
	$sql="SELECT DISTINCT title FROM ".$_GET['category'];
	$result_set=mysqli_query($con,$sql);
	while($row=mysqli_fetch_array($result_set))
	{
		?>
        <tr>
        <td><a id="but" href="main.php?category=<?php echo $_GET['category'] ?>&title=<?php echo $row['title'] ?>"><?php echo $row['title'] ?></a></td>
        </tr>
        <?php
	}
	?>
  </table>
</div>
</div>
<?php
if(isset($_SESSION['anything']))
{
   ?>
<script>
    document.getElementById("titlelink").className='btn btn-primary';
    document.getElementById("loginlink").href="logout.php";
    document.getElementById("loginlink").className='nav navbar-nav navbar-right btn btn-danger navbar-btn';
     document.getElementById("logtext").textContent="Logout";
    document.getElementById("logicon").className='glyphicon glyphicon-log-out';
    document.getElementById("loginlink").setAttribute("id", "logoutlink");
</script>
<?php
}
?>
<script language="javascript" type="text/javascript">
$(document).ready(function() {
    $("#loginlink").click(function( event ){
           event.preventDefault();
           $("#dialog").fadeToggle("fast");
     });
     $("#titlelink").click(function( event ){
           event.preventDefault();
           $("#dialog1").fadeToggle("fast");
     });
    $("#logoutlink").click(function( event ){
           event.preventDefault();
           window.location.href = "logout.php?page=central.php?category=<?php echo $_GET['category'] ?>";
     });
     $("#close1").click(function(){
         document.querySelector("#video_1").pause();
        $("#dialog1").fadeToggle("fast");
    });
    $("#close").click(function(){
        $("#dialog").fadeToggle("fast");
    });
     $(document).keyup(function(e) {
        if(e.keyCode == 27 && $("#dialog1").css("display") != "none" ) { 
            event.preventDefault();
            $("#dialog1").fadeToggle("fast");
        }
    });
    $(document).keyup(function(e) {
        if(e.keyCode == 27 && $("#dialog").css("display") != "none" ) { 
            event.preventDefault();
            $("#dialog").fadeToggle("fast");
        }
    });
     $.video3 = function(files_) { 
    var $source = $('#video_here1');
  $source[0].src = URL.createObjectURL(files_.files[0]);
  $source.parent()[0].load();
    }
    $.video4 = function() { 
    document.querySelector("#video_1 > source").src = "";
    document.querySelector("#video_1").load();
    }
     $.close2 = function() { 
    $("#dialog1").fadeToggle("fast");
    alert("successfully uploaded");
    }
});
function filename1(file1) {
    var file1=document.getElementById('file1');
        if(file1.value.length==0)
            {
                document.getElementById("label_1").innerHTML="No File selected to upload";
                 var img_=document.getElementById('thumbnil1');
                 img_.src = "#";
                 img_.style.width="0px";
                 img_.style.height="0px"
                 img_.style.visibility="visible";
                var vid=document.getElementById('video_1');
            vid.width="0";
            vid.height="0";
            vid.style.visibility="hidden";
            $.video4();
            }
    document.getElementById("cancel_1").disabled = false;
    document.getElementById("label_1").innerHTML=file1.files[0].name.toString();
}
    
     function showMyMedia1(fileInput) {
        var files = fileInput.files;
        for (var i = 0; i < files.length; i++) {           
            var file = files[i];
            var imageType = /image.*/;
            var videoType = /video.*/;
             if (file.type.match(videoType)) {
                 var img_=document.getElementById('thumbnil1');
                 img_.src = "#";
                 img_.style.width="0px";
                 img_.style.height="0px"
                 img_.style.visibility="hidden";
                 var vid=document.getElementById('video_1');
                 if (matchMedia('only screen and (max-width: 480px)').matches) {
  vid.width="300";
 vid.height="150";
}
                 else{
                 vid.width="350";
                 vid.height="250";
                 }
                 vid.style.visibility="visible";
                 $.video3(fileInput);
                 continue;
            }
            if (!file.type.match(imageType) && !file.type.match(videoType)) {
                continue;
            }
            var vid=document.getElementById('video_1');
            vid.width="0";
             vid.height="0";
            vid.style.visibility="hidden";
            $.video4();
            var img_=document.getElementById('thumbnil1');
            img_.style.height = '200px';
            img_.style.width = '300px';
            img_.style.visibility="visible";
            var img=document.getElementById("thumbnil1");
            img.file = file;    
            var reader = new FileReader();
            reader.onload = (function(aImg) { 
                return function(e) { 
                    aImg.src = e.target.result; 
                }; 
            })(img);
            reader.readAsDataURL(file);
        } 
    }
    $(document).on('submit','#form1',function(e){
			e.preventDefault();
        if($('#file1').val()=="")
            {
                alert("No File selected to upload");
            }
        else
            {
                $form = $(this);

			uploadImage1($form);
            }

		});
     function uploadImage1($form){
			$form.find('#progress-bar1').removeClass('progress-bar-success')
										.removeClass('progress-bar-danger');

			var formdata = new FormData($form[0]); //formelement
			var request = new XMLHttpRequest();

			//progress event...
			request.upload.addEventListener('progress',function(e){
				var percent = Math.round(e.loaded/e.total * 100);
				$form.find('#progress-bar1').width(percent+'%').html(percent+'%');
			});

			//progress completed load event
			request.addEventListener('load',function(e){
				$form.find('#progress-bar1').addClass('progress-bar-success').html('upload completed....');
                document.getElementById("cancel_1").disabled = true;
                document.getElementById("label_1").innerHTML="No File selected to upload";
                 var img_=document.getElementById('thumbnil1');
                 img_.src = "#";
                 img_.style.width="0px";
                 img_.style.height="0px"
                 img_.style.visibility="visible";
                var vid=document.getElementById('video_1');
            vid.width="0";
            vid.height="0";
            vid.style.visibility="hidden";
            $.video4();
            $form.find('#progress-bar1').width('0%').html('0%');
            var file1=document.getElementById('file1');
            file1.value="";
            var title_ = document.getElementById("title");
            title_.value="";
            $.close2();
            location.reload();
			});

			request.open('post', '<?php echo $head ?>.php?info=<?php echo $_GET['category'] ?>');
			request.send(formdata);

			$form.on('click','#cancel_1',function(){
				request.abort();

				$form.find('#progress-bar1')
					.addClass('progress-bar-danger')
					.removeClass('progress-bar-success')
					.html('upload aborted...');
			});

		}
function btntest_onclick() 
{
    window.location.href = "index.php";
}
</script>
</body>
</html>