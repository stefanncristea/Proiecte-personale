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
$tag=$_POST['tag'];
$category=$_POST['category'];
$description=$_POST['description'];
$sql="insert into tblcategory(CategoryName,Categorydescription,Tags)values(:category,:description,:tag)";
$query=$dbh->prepare($sql);
$query->bindParam(':category',$category,PDO::PARAM_STR);
$query->bindParam(':description',$description,PDO::PARAM_STR);
$query->bindParam(':tag',$tag,PDO::PARAM_STR);
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
    location.href = 'main-category.php'
  })
</script>
<?php
}
else
{
  echo '<script>alert("Something Went Wrong. Please try again")</script>';
}
?>