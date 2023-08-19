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

$brand=$_POST['brandName'];
$image=$_FILES["brandImage"]["name"];
move_uploaded_file($_FILES["brandImage"]["tmp_name"],"brandimages/".$_FILES["brandImage"]["name"]);
$sql="insert into tblbrand(BrandName,BrandImage)values(:brand,:image)";
$query=$dbh->prepare($sql);
$query->bindParam(':brand',$brand,PDO::PARAM_STR);
$query->bindParam(':image',$image,PDO::PARAM_STR);
$query->execute();
$LastInsertId=$dbh->lastInsertId();
if ($LastInsertId>0) 
{
  ?>
  <script >
   swal.fire({
    'title': 'Thank you',
    'text': 'Saved successfuly',
    'icon': 'success',
    'type': 'success'
  }).then( () => {
    location.href = 'brand-list.php'
  })
</script>
<?php
}
else
{
  echo '<script>alert("Something Went Wrong. Please try again")</script>';
}
?>