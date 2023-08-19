<?php 
session_start();
error_reporting(0);
include('includes/dbconnection.php');
if(strlen($_SESSION['odmsaid'])==0)
{   
    header('location:index.php');
}

if( empty( $_POST['token'] ) ){
    echo '<span class="notice">Error!</span>';
    exit;
}
if( $_POST['token'] != 'FsWga4&@f6aw' ){
    echo '<span class="notice">Error!</span>';
    exit;
}
$firstname=$_POST['firstName'];
$lastname=$_POST['lastName'];
$email=$_POST['email']; 
$staffid=$_POST['staffid']; 
$mobile=$_POST['mobileno'];
$dignity=$_POST['dignity'];
$birthday=$_POST['Birthday']; 
$userName=$_POST['username'];
$password=md5($_POST['password']); 
$sql="INSERT INTO  tbladmin(Staffid,AdminName,UserName,FirstName,LastName,Email,MobileNumber,Password,Birthday) VALUES(:staffid,:dignity,:username,:firstname,:lastname,:email,:mobile,:password,:birthday)";
$query = $dbh->prepare($sql);
$query->bindParam(':firstname',$firstname,PDO::PARAM_STR);
$query->bindParam('lastname',$lastname,PDO::PARAM_STR);
$query->bindParam(':email',$email,PDO::PARAM_STR);
$query->bindParam(':birthday',$birthday,PDO::PARAM_STR);
$query->bindParam(':staffid',$staffid,PDO::PARAM_STR);
$query->bindParam(':dignity',$dignity,PDO::PARAM_STR);
$query->bindParam(':username',$username,PDO::PARAM_STR);
$query->bindParam(':mobile',$mobile,PDO::PARAM_STR);
$query->bindParam(':password',$password,PDO::PARAM_STR);
$query->execute();
$lastInsertId = $dbh->lastInsertId();
if($lastInsertId)
{
    ?>
    <script >
        swal.fire({
            'title': 'Thank you',
            'text': 'Saved successfuly',
            'icon': 'success',
            'type': 'success'
        }).then( () => {
            location.href = 'user-list.php'
        })
    </script>
    <?php
}
else 
{
    echo "<script>alert('Something went wrong. Please try again');</script>";
}

 ?>