<link rel="stylesheet" href="assets/sweetalert2/sweetalert2.css">
<script src="assets/sweetalert2/sweetalert2.min.js"></script>
<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');
$email=$_POST['email'];
$sql ="SELECT email FROM tblsubscribe WHERE email=:email";
$query= $dbh -> prepare($sql);
$query-> bindParam(':email', $email, PDO::PARAM_STR);
$query-> execute();
$results = $query -> fetchAll(PDO::FETCH_OBJ);
if($query -> rowCount() > 0)
{
	echo "<script>alert('Already Subscribed, Thank you.');</script>";
}
else{
	$query=mysqli_query($con,"insert into tblsubscribe(email) values('$email')");
	if($query)
	{
		?>
		<script >
			swal.fire({
				'title': 'Thank you',
				'text': 'Subscribed successfuly',
				'icon': 'success',
				'type': 'success'
			})
		</script>
		<?php
	}
	else{
		echo "<script>alert('Something went wrong, Try again later');</script>";
	}
}
?>