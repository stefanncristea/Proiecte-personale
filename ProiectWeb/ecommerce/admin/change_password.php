<?php 
session_start();
error_reporting(0);
include('includes/dbconnection.php');
if (empty($_SESSION['activatecode'])) {
	header('location:forgot-password.php');
} 
if(isset($_POST['change']))
{
	
	$codeactivate=$_SESSION['activatecode'];
	$password=md5($_POST['password']);
	$query=mysqli_query($con,"SELECT * FROM tbladmin WHERE activationcode='$codeactivate'");
	$num=mysqli_fetch_array($query);
	if($num>0)
	{
		$extra="change_password.php";
		mysqli_query($con,"update tbladmin set Password='$password' WHERE activationcode='$codeactivate' ");
		$host=$_SERVER['HTTP_HOST'];
		$uri=rtrim(dirname($_SERVER['PHP_SELF']),'/\\');
		header("location:http://$host$uri/$extra");
		$_SESSION['errmsg']="Password Changed Successfully";
		exit();
	}
	else
	{
		$extra="change_password.php";
		$host  = $_SERVER['HTTP_HOST'];
		$uri  = rtrim(dirname($_SERVER['PHP_SELF']),'/\\');
		header("location:http://$host$uri/$extra");
		$_SESSION['errmsg']="Invalid email id or Contact no";
		exit();
	}
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
	<meta name="viewport" content="width=device-width, initial-scale=1" />
	<meta name="description" content="Shop - Admin Dashboard HTML Template.">

	<title>Electronic Shop - Admin Dashboard HTML Template.</title>

	<!-- GOOGLE FONTS -->
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@200;300;400;500;600;700;800&family=Poppins:wght@300;400;500;600;700;800;900&family=Roboto:wght@400;500;700;900&display=swap" rel="stylesheet">
	
	<link href="https://cdn.materialdesignicons.com/4.4.95/css/materialdesignicons.min.css" rel="stylesheet" />

	<!-- Shop CSS -->
	<link id="shop-css" rel="stylesheet" href="assets/css/style.css" />

	<!-- FAVICON -->
	<link href="assets/img/favicon.png" rel="shortcut icon" />
	<script type="text/javascript">
		function valid()
		{
			if(document.register.password.value!= document.register.confirmpassword.value)
			{
				alert("Password and Confirm Password Field do not match  !!");
				document.register.confirmpassword.focus();
				return false;
			}
			return true;
		}
	</script>
</head>

<body class="sign-inup" id="body">
	<div class="container d-flex align-items-center justify-content-center form-height pt-24px pb-24px">
		<div class="row justify-content-center">
			<div class="col-lg-7 col-md-10">
				<div class="card">
					<div class="card-header bg-primary">
						<div class="ec-brand">
							<a href="#" title="shop">
								<img class="ec-brand-icon" src="assets/img/logo/logo-login2.png" alt="" />
							</a>
						</div>
					</div>
					<div class="card-body p-5">
						<h4 class="text-dark mb-5">Almost there Enter your new password</h4>

						<form name="register"  onSubmit="return valid();" method="post">
							<span style="color:red;" >
								<?php
								echo htmlentities($_SESSION['errmsg']);
								?>
								<?php
								echo htmlentities($_SESSION['errmsg']="");
								?>
							</span>
							
							<div class="row">
								<div class="form-group col-md-12 mb-4">
									<input type="password" class="form-control" name="password" id="password" placeholder="Password" required>
								</div>
								<div class="form-group col-md-12 mb-4">
									<input type="password" class="form-control" name="confirmpassword" id="confirmpassword" placeholder="Confirm Password" required>
								</div>
								<div class="col-md-12">

									<button type="submit"  name="change" class="btn btn-primary btn-block mb-4">Reset</button>

									<p class="sign-upp">Login?
										<a class="text-blue" href="index.php">Signin Now</a>
									</p>
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>

	<!-- Javascript -->
	<script src="assets/plugins/jquery/jquery-3.5.1.min.js"></script>
	<script src="assets/plugins/jquery/jquery.notify.min.js"></script>
	<script src="assets/plugins/jquery/jquery.bundle.notify.min.js"></script>
	<script src="assets/js/bootstrap.bundle.min.js"></script>
	<script src="assets/plugins/jquery-zoom/jquery.zoom.min.js"></script>
	<script src="assets/plugins/slick/slick.min.js"></script>

	<!-- shop Custom -->
	<script src="assets/js/main.js"></script>
</body>

</html>