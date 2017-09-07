<?php
    include 'dbconfig.php';
    $username=$_POST['username'];
    $password=$_POST['password'];
    $sUser=mysqli_real_escape_string($con,$username);
    $sPass=mysqli_real_escape_string($con,$password);
    // For Security 
    $query="SELECT * From auth where username='$sUser' and password='$sPass'";
    $result=mysqli_query($con,$query);
    if(mysqli_num_rows($result)==1)
    {
        session_start();
        $_SESSION['anything']='something';
        ?>
  <script>
      window.location.href='<?php echo $_GET['page'] ?>';
</script>
<?php
    }
else
{
     ?>
  <script>
      window.location.href='<?php echo $_GET['page'] ?>';
      alert("Username or Password incorrect!!!");
</script>
<?php
}
?>