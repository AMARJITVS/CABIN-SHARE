<?php
include_once 'dbconfig.php';
 if($_GET['category']=="firstyear")
  {
        $folder="First-year-uploads";
  }
    else if($_GET['category']=="secondyear")
    {
        $folder="Second-year-uploads";
}
    else if($_GET['category']=="thirdyear")
    {
        $folder="Third-year-uploads";
    }
    else if($_GET['category']=="finalyear")
    {
        $folder="Final-year-uploads";
    }
    else
    {
        $head="othersinside";
        $header="mainuploadx";
        $folder="Others";
    }
function is_dir_empty($dir) {
  if (!is_readable($dir)) return NULL; 
  $handle = opendir($dir);
  while (false !== ($entry = readdir($handle))) {
    if ($entry != "." && $entry != "..") {
      return FALSE;
    }
  }
  return TRUE;
}
$directory = $folder."/".$_GET['title']."/";
$directorythumb = $folder."/".$_GET['title']."/thumbnail/";
$filecount = 0;
$files = glob($directory . "*");
unlink($folder.'/'.$_GET['title'].'/'.$_GET['del_id']);
?>
<script>
    var filename=<?php echo $_GET['del_id'] ?>
     var parts = filename.split('.');
    var ext= parts[parts.length - 1];
    ext=ext.toLowerCase();
    var element = document.getElementById(filename);
    if(ext=='jpg')
    {
    <?php
 unlink($folder.'/'.$_GET['title'].'/thumbnail/'.$_GET['del_id']);
    ?>
    }
</script>
<?php
if ($files){
 $filecount = count($files);
}
else
{
    $filecount=1;
}
$select="delete from ".$_GET['category']." where file='".$_GET['del_id']."'";
$query=mysqli_query($con,$select) or die($select);
if ($filecount==2) {
      rmdir($directorythumb);
      rmdir($directory);
    ?>
  <script>
      window.location.href='central.php?category=<?php echo $_GET['category'] ?>';
</script>
<?php
}
else
{
    ?>
  <script>
      window.location.href='main.php?category=<?php echo $_GET['category'] ?>&title=<?php echo $_GET['title'] ?>';
</script>
<?php
}
?>