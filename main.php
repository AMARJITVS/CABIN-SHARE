<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>Cabin Share</title>
<link rel="shortcut icon" type="image/x-icon" href="image_assets/favicon.png" />
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width,height=device-height,initial-scale=0.8"/>
<link rel="stylesheet" href="style.css" type="text/css" />
<link href="Resources/googlefont.css" rel='stylesheet' type='text/css'>
<link rel="stylesheet" href="Resources/bootstrap/css/bootstrap.min.css">
<script src="Resources/bootstrap.min.css"></script>
<script src="Resources/jquery.min.js"></script>
<script src="Resources/jquery-latest.min.css"></script>
</head>
<?php
session_start();
include_once 'dbconfig.php';
  if($_GET['category']=="firstyear")
  {
        $head="firstyearinside";
        $header="mainupload1";
        $folder="First-year-uploads";
  }
    else if($_GET['category']=="secondyear")
    {
        $head="secondyearinside";
        $header="mainupload2";
        $folder="Second-year-uploads";
}
    else if($_GET['category']=="thirdyear")
    {
        $head="thirdyearinside";
        $header="mainupload3";
        $folder="Third-year-uploads";
    }
    else if($_GET['category']=="finalyear")
    {
        $head="finalyearinside";
        $header="mainupload4";
        $folder="Final-year-uploads";
    }
    else
    {
        $head="othersinside";
        $header="mainuploadx";
        $folder="Others";
    }
?>
<body >
<div class="background-image"></div>
<div>
<nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <div class="navbar-header" style="width: 80%">
    <img id="logo" style="float: left; margin: 5px; margin-right: 20px" src="image_assets/logo.png" class="img-responsive" alt="..." width="4%"  ><label id="size"><?php echo $_GET['title'] ?></label>
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
           <form action="login.php?page=main.php?category=<?php echo $_GET['category']?>%26title=<?php echo $_GET['title']?>" id="form1" method="post" enctype="multipart/form-data" >
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
        <div class="login-content" id="loginTarget">
            <a id="close1" class="close">x</a>
            <h3>File upload</h3>
           <form action="<?php echo $header ?>.php?info=<?php echo $head ?>&title=<?php echo $_GET['title'] ?>" id="form" method="post" enctype="multipart/form-data" >
               <div class="progress progress-striped active">
				<div id="progress-bar" class="progress-bar" style="width:0%"></div>
			</div>
    <label for="file" id="addfile_" ><span class="glyphicon glyphicon-plus"></span>  ADD FILE</label>
    <input type="file" name="file" id="file" style="display:none" onchange="filename(this); showMyMedia(this);" />
               <label id="label_">Nothing selected</label>
               <img id="thumbnil" style="margin-top:5px; visibility: visible"  src="" alt="..."/>
               <video id="video_" width="0" controls style="visibility: hidden; margin-top: 5px;">
  <source src="" id="video_here">
    Your browser does not support HTML5 video.
</video>
               <br>
               <br>
                <button id="submit_" class="btn btn-sm btn-info upload"  name="submit_" type="submit" ><span class="glyphicon glyphicon-upload"></span> Upload</button> <button type="button" id="cancel_" class="btn btn-sm btn-danger cancel"><span class="glyphicon glyphicon-ban-circle"></span> Cancel</button>
            </form>
        </div>
    </div>
</div>
<div class="content">
<div class="container">
<div id="head" style="margin-top: 15px;">
    <div id="headl">
     <a href="#" class="btn btn-info" id="Upload_" onclick="return btntest_onclick()">
          <span class="glyphicon glyphicon-home"></span><span > Home</span>
        </a>
        <a href="#" class="btn btn-info" id="Upload_" onclick="return btnback_onclick()">
          <span class="glyphicon glyphicon-backward"></span><span > Back</span>
        </a>
        <a href="#" class="hidden" id="loginLink">
          <span class="glyphicon glyphicon-cloud-upload"></span> <span > Upload File</span>
        </a>
    </div>
    </div>
	<table class="table" >
    <thead>
    <tr>
        <th>Preview</th>
        <th>File Name</th>
        <th>File Size</th>
        <th></th>
        <th></th>
    </tr>
        </thead>
    <?php
	$sql="SELECT * FROM ".$_GET['category']." where title=\"".$_GET['title']."\"";
	$result_set=mysqli_query($con,$sql);
    if(isset($_SESSION['anything']))
    {
	while($row=mysqli_fetch_array($result_set))
	{
		?>
        <tr> 
            <td><a target="_blank" href="<?php echo $folder ?>/<?php echo $_GET['title']."/".$row['file'] ?>"><img id="<?php echo $row['file']; ?>" src="<?php echo $folder ?>/<?php echo $_GET['title']."/thumbnail/".$row['file'] ?>" style="width:50px" alt="No preview available" onerror="thumbnailcreate(this.id)"></a></td>
        <td><?php echo substr($row['file'],strpos($row['file'],"-")+1) ?></td>
        <td><?php echo $row['size'] ?></td>
        <td class="right"><a href="<?php echo $folder ?>/<?php echo $_GET['title']."/".$row['file'] ?>" class="btn btn-success btn-sm" download>
          <span class="glyphicon glyphicon-download-alt"></span> <span class="hidden-xs hidden-sm">Download</span>
        </a></td>
        <td class="right" ><a href="#" class="btn btn-danger btn-sm" id="<?php echo $row['file']; ?>" onclick="deleteme(this.id)">
          <span class="glyphicon glyphicon-trash"></span>
            <span class="hidden-xs hidden-sm">Delete</span>
            </a> 
            </td>
        </tr>
        <?php
	}
    }
        else
        {
            while($row=mysqli_fetch_array($result_set))
	{
		?>
        <tr> 
            <td><a target="_blank" href="<?php echo $folder ?>/<?php echo $_GET['title']."/".$row['file'] ?>"><img id="<?php echo $row['file']; ?>" src="<?php echo $folder ?>/<?php echo $_GET['title']."/thumbnail/".$row['file'] ?>" style="width:50px" alt="No preview available" onerror="thumbnailcreate(this.id)"></a></td>
        <td><?php echo substr($row['file'],strpos($row['file'],"-")+1) ?></td>
        <td><?php echo $row['size'] ?></td>
        <td class="right"><a href="<?php echo $folder ?>/<?php echo $_GET['title']."/".$row['file'] ?>" class="btn btn-success btn-sm" download>
          <span class="glyphicon glyphicon-download-alt"></span> <span class="hidden-xs hidden-sm">Download</span>
        </a></td>
        </tr>
        <?php
	}
        }
	?>
    </table>
    </div>
<?php
if(isset($_SESSION['anything']))
{
   ?>
<script>
    document.getElementById("loginLink").className='btn btn-primary';
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
    $("#loginLink").click(function( event ){
            event.preventDefault();
           $("#dialog1").fadeToggle("fast");
     });
    $("#logoutlink").click(function( event ){
           event.preventDefault();
           window.location.href = "logout.php?page=main.php?category=<?php echo $_GET['category']?>%26title=<?php echo $_GET['title']?>";
     });
     $("#close").click(function(){
         document.querySelector("#video_").pause();
        $("#dialog").fadeToggle("fast");
    });
    $("#close1").click(function(){
         document.querySelector("#video_").pause();
        $("#dialog1").fadeToggle("fast");
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
     $.video1 = function(files_) { 
    var $source = $('#video_here');
  $source[0].src = URL.createObjectURL(files_.files[0]);
  $source.parent()[0].load();
    }
    $.video2 = function() { 
    document.querySelector("#video_ > source").src = "";
    document.querySelector("#video_").load();

    }
});
  $(document).on('submit','#form',function(e){
			e.preventDefault();
        if($('#file').val()=="")
            {
                alert("No File selected to upload");
            }
        else
            {
                $form = $(this);

			uploadImage($form);
            }

		});
function thumbnailcreate(filename)
    {
    var parts = filename.split('.');
    var ext= parts[parts.length - 1];
    ext=ext.toLowerCase();
    var element = document.getElementById(filename);
    if(ext=='mp4' || ext=='avi' || ext=='mpg' || ext=='m4v')
    {
    element.src="image_assets/videothumbnail.png";
    }
        else if(ext=='gif' || ext=='png' || ext=='jpeg')
            {
                element.src="<?php echo $folder ?>/<?php echo $_GET['title']?>/"+filename;
            }
    else{
    element.src="image_assets/defaultthumbnail.png";
    }
    }
function deleteme(delid) 
{
     var a= confirm('Are sure you want to delete this file ?');
    if(a)
        {
            window.location.href='delete_file.php?del_id='+delid+'&title=<?php echo $_GET['title'] ?>&category=<?php echo $_GET['category'] ?>';
        return true;
        }
}
//function viewitem(viewid) 
//{
//           window.open('uploads/'+viewid+'');
//        return true;
//}
 function uploadImage($form){
			$form.find('#progress-bar').removeClass('progress-bar-success')
										.removeClass('progress-bar-danger');

			var formdata = new FormData($form[0]); //formelement
			var request = new XMLHttpRequest();

			//progress event...
			request.upload.addEventListener('progress',function(e){
				var percent = Math.round(e.loaded/e.total * 100);
				$form.find('#progress-bar').width(percent+'%').html(percent+'%');
			});

			//progress completed load event
			request.addEventListener('load',function(e){
				$form.find('#progress-bar').addClass('progress-bar-success').html('upload completed....');
                document.getElementById("cancel_").disabled = true;
                alert("successfully uploaded");
               location.reload();
			});

			request.open('post', '<?php echo $header ?>.php?info=<?php echo $head ?>&title=<?php echo $_GET['title'] ?>');
			request.send(formdata);

			$form.on('click','#cancel_',function(){
				request.abort();

				$form.find('#progress-bar')
					.addClass('progress-bar-danger')
					.removeClass('progress-bar-success')
					.html('upload aborted...');
			});

		}
function btntest_onclick() 
{
    window.location.href = "index.php";
}
function btnback_onclick() 
{
    window.location.href = "central.php?category=<?php echo $_GET['category'] ?>";
}
function filename(file1) {
   var file1=document.getElementById('file');
        if(file1.value.length==0)
            {
                document.getElementById("label_").innerHTML="No File selected to upload";
                 var img_=document.getElementById('thumbnil');
                 img_.src = "#";
                 img_.style.width="0px";
                 img_.style.height="0px"
                 img_.style.visibility="visible";
                var vid=document.getElementById('video_');
            vid.width="0";
             vid.height="0";
            vid.style.visibility="hidden";
            $.video2();
            }
    document.getElementById("label_").innerHTML=file1.files[0].name.toString();
}
    function showMyMedia(fileInput) {
        var files = fileInput.files;
        for (var i = 0; i < files.length; i++) {           
            var file = files[i];
            var imageType = /image.*/;
            var videoType = /video.*/;
             if (file.type.match(videoType)) {
                 var img_=document.getElementById('thumbnil');
                 img_.src = "#";
                 img_.style.width="0px";
                 img_.style.height="0px"
                 img_.style.visibility="hidden";
                 var vid=document.getElementById('video_');
                 if (matchMedia('only screen and (max-width: 480px)').matches) {
                 vid.width="300";
                 vid.height="150";
                 }
                 else{
                 vid.width="350";
                 vid.height="250";
                 }
                 vid.style.visibility="visible";
                 $.video1(fileInput);
                 continue;
            }
            if (!file.type.match(imageType) && !file.type.match(videoType)) {
                continue;
            }
            var vid=document.getElementById('video_');
            vid.width="0";
             vid.height="0";
            vid.style.visibility="hidden";
            $.video2();
            var img_=document.getElementById('thumbnil');
             img_.style.height = '250px';
            img_.style.width = '350px';
            img_.style.visibility="visible";
            var img=document.getElementById("thumbnil");
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
</script>
</div>
</body>
</html>