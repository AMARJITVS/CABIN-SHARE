<?php
include_once 'dbconfig.php';
 function make_thumb($src, $dest, $desired_width) {

    /* read the source image */
    $source_image = imagecreatefromjpeg($src);
    $width = imagesx($source_image);
    $height = imagesy($source_image);

    /* find the "desired height" of this thumbnail, relative to the desired width  */
    $desired_height = floor($height * ($desired_width / $width));

    /* create a new, "virtual" image */
    $virtual_image = imagecreatetruecolor($desired_width, $desired_height);

    /* copy source image at a resized size */
    imagecopyresampled($virtual_image, $source_image, 0, 0, 0, 0, $desired_width, $desired_height, $width, $height);

    /* create the physical thumbnail image to its destination */
    imagejpeg($virtual_image, $dest);
}
if(isset($_GET['info'])=="thirdyear")
{
$randomNum1=rand(1000,100000);
$randomNum2=rand(1000,100000);
$randomNum=$randomNum1 * $randomNum2;
	$file = $randomNum."-".$_FILES['thirdyear']['name'];
    $file_loc = $_FILES['thirdyear']['tmp_name'];
	$file_size = $_FILES['thirdyear']['size'];
	$file_type = $_FILES['thirdyear']['type'];
	$folder="Third-year-uploads/".$_POST["title"]."/";
    $folderthumb="Third-year-uploads/".$_POST['title']."/thumbnail/";
    $titlename=$_POST["title"];
    // make folder if not exists
    if (!file_exists($folder)) {
      mkdir($folder, 0777, true);
      mkdir($folderthumb, 0777, true);
}
	// new file size in KB
	$new_size = round($file_size/1024/1024,2)." MB";  
	// new file size in KB
	
	// make file name in lower case
	$new_file_name = strtolower($file);
	// make file name in lower case
	
	$final_file=str_replace(' ','-',$new_file_name);
	
	if(move_uploaded_file($file_loc,$folder.$final_file))
	{
		$sql="INSERT INTO thirdyear(title,file,size) VALUES('$titlename','$final_file','$new_size')";
		mysqli_query($con,$sql);
	}
	else
	{
		?>
		<script>
		alert('error while uploading file');
        </script>
		<?php
	}
$src=$folder.$final_file;
$dest=$folderthumb.$final_file;
$desired_width="200";
make_thumb($src, $dest, $desired_width);

}
if(isset($_GET['info'])=="thirdyearinside")
{
$randomNum1=rand(1000,100000);
$randomNum2=rand(1000,100000);
$randomNum=$randomNum1 * $randomNum2;
	$file = $randomNum."-".$_FILES['file']['name'];
    $file_loc = $_FILES['file']['tmp_name'];
	$file_size = $_FILES['file']['size'];
	$file_type = $_FILES['file']['type'];
	$folder="Third-year-uploads/".$_GET['title']."/";
    $folderthumb="Third-year-uploads/".$_GET['title']."/thumbnail/";
    $titlename=$_GET['title'];
    // make folder if not exists
 if (!file_exists($folder)) {
      mkdir($folder, 0777, true);
}
	// new file size in KB
	$new_size = round($file_size/1024/1024,2)." MB";  
	// new file size in KB
	
	// make file name in lower case
	$new_file_name = $file;
	// make file name in lower case
	
	$final_file=str_replace(' ','-',$new_file_name);
	
	if(move_uploaded_file($file_loc,$folder.$final_file))
	{
		$sql="INSERT INTO thirdyear(title,file,size) VALUES('$titlename','$final_file','$new_size')";
		mysqli_query($con,$sql);
	}
	else
	{
		?>
		<script>
		alert('error while uploading file');
        </script>
		<?php
	}
$src=$folder.$final_file;
$dest=$folderthumb.$final_file;
$desired_width="200";
make_thumb($src, $dest, $desired_width);
}
?>