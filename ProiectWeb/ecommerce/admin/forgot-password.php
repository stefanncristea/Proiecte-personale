<?php 
session_start();
error_reporting(0);
include('includes/dbconnection.php');

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
if(isset($_POST['change']))
{
	$email=$_POST['email'];
	$contact=$_POST['contact'];
	$query=mysqli_query($con,"SELECT * FROM tbladmin WHERE Email='$email' and MobileNumber='$contact'");
	$num=mysqli_fetch_array($query);
	if($num>0)
	{
		$name = $num['LastName'];

		$activationcode=md5($email.time());

		$query=mysqli_query($con,"update tbladmin set activationcode='$activationcode' WHERE Email='$email' and MobileNumber='$contact' ");
		if($query)

		{
		    // Load Composer's autoloader
			require 'vendor/autoload.php';
            // Instantiation and passing `true` enables exceptions
			$mail = new PHPMailer(true);

			$subject = stripslashes( nl2br( 'Password Reset' ) );
             //$message = stripslashes( nl2br( '' ) );

			try {
				//Server settings
				$mail->SMTPDebug = 0;  // 0 - Disable Debugging, 2 - Responses received from the server
		        $mail->isSMTP();    // Set mailer to use SMTP
		        $mail->Host       = 'smtp.gmail.com';  // Specify main and backup SMTP servers
		        $mail->SMTPAuth   = true;     // Enable SMTP authentication
		        $mail->Username   = 'compscie95@gmail.com'; // SMTP username
		        $mail->Password   = 'tntqytqmkaayhovd'; // SMTP password
		        $mail->SMTPSecure = 'ssl';//PHPMailer::ENCRYPTION_STARTTLS;  // Enable TLS encryption, `PHPMailer::ENCRYPTION_SMTPS` also accepted
		        $mail->Port       = 465; // TCP port to connect to

		        //Recipients
		        $mail->setFrom('compscie95@gmail.com', 'Code4berry');
		        
		        $mail->addAddress($email, $name);     // Add a recipient

		        // Attachement 
		        // $mail->addAttachment('upload/file.pdf');
		        //$mail->addAttachment('assets/img/products/product-img-1.jpg', 'fruit');    // Optional name

		        // Content
		        $mail->isHTML(true); // Set email format to HTML
		        $mail->Subject = $subject;
		        ob_start();
		        ?>
		        Dear &nbsp;  <?php echo ucfirst( $name ); ?>, <br />

		        <div style='padding-top:6px;'>You requested to change your password.</div>

		        <div style='padding-top:8px;'>To do so please click on the link below:</div>

		        <div style='padding-top:10px;'><a href='http://localhost/Electronicshop/admin/email_verification.php?code=<?php echo $activationcode ?>'>Click here to change your password</a></div>

		        <div style='padding-top:3px;'>If you didn't request a password change just ignore this email.</div>
		        <p style='padding-top:3px;'>Best Regards,</p>
		        <p style='padding-top:2px;'>Code4berry Team.</p>

		        <div style='padding-top:4px;'>Powered by <a href='code4berry.com'>code4berry.com</a></div></div>
		        <br />
		        <br />
		        <?php
		        $body = ob_get_contents();
		        ob_end_clean();
		        $mail->Body = $body;
		        $mail->AltBody = $body; // Plain text for non-HTML mail clients

		        $s = $mail->send();
		        if( $s == 1 ){
		        	$_SESSION['errmsg']="Please click on the link sent to your email to update your password.";

		        	echo "<script>window.location = forgot_password.php';</script>";
		        }else{
		        	$_SESSION['errmsg']="Failed, please try again later.";
		        }
		    } catch (Exception $e) {
		    } 
		}
	}
	else
	{
		$extra="forgot-password.php";
		$host  = $_SERVER['HTTP_HOST'];
		$uri  = rtrim(dirname($_SERVER['PHP_SELF']),'/\\');
		header("location:http://$host$uri/$extra");
		$_SESSION['errmsg']="Invalid email or Phone No.";
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
	<link id="Shop-css" rel="stylesheet" href="assets/css/style.css" />
	
	<!-- FAVICON -->
	<link href="assets/img/favicon.png" rel="shortcut icon" />
</head>

<body class="sign-inup" id="body">
	<div class="container d-flex align-items-center justify-content-center form-height-login pt-24px pb-24px">
		<div class="row justify-content-center">
			<div class="col-lg-6 col-md-10">
				<div class="card">
					<div class="card-header bg-primary">
						<div class="ec-brand">
							<a href="#" title="Shop">
								<img class="ec-brand-icon" src="assets/img/logo/logo-login2.png" alt="" />
							</a>
						</div>
					</div>
					<div class="card-body p-5">
						<h4 class="text-dark mb-5">Change Password</h4>
						
						<form name="register" method="post">
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
									<input type="email" class="form-control" name="email" id="email" placeholder="Email">
								</div>
								
								<div class="form-group col-md-12 ">
									<input type="text" class="form-control" name="contact" id="contact" placeholder="Contact Number">
								</div>
								
								<div class="col-md-12">
									<button type="submit" name="change" class="btn btn-primary btn-block mb-4">SEND LINK</button>
									
									<p class="sign-upp">
										<a class="text-blue" href="index.php">Sign in</a>
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
	
	<!-- Shop Custom -->	
	<script src="assets/js/main.js"></script>
</body>
</html>