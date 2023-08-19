<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');
if(!empty($_GET['code']) && isset($_GET['code']))
{
  $code=$_GET['code'];
  $sql=mysqli_query($con,"SELECT * FROM users WHERE activationcode='$code'");
  $num=mysqli_fetch_array($sql);
  if($num>0)
  {
    
      $_SESSION['activatecode']=$code;
      echo "<script type='text/javascript'> document.location = 'change_password.php'; </script>";
   
  }
  else
  {
    $msg ="Wrong activation code.";
  }
}

?>