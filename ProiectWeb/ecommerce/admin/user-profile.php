<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');
if(strlen($_SESSION['odmsaid'])==0)
{	
	header('location:index.php');
}
if(isset($_POST['submit']))
{
	$adminid=$_SESSION['odmsaid'];
	$AName=$_POST['userName'];
	$fName=$_POST['firstName'];
	$lName=$_POST['lastName'];
	$mobno=$_POST['tel'];
	$email=$_POST['email'];
	$sql="update tbladmin set UserName=:adminname,FirstName=:firstname,LastName=:lastname,MobileNumber=:mobilenumber,Email=:email where ID=:aid";
	$query = $dbh->prepare($sql);
	$query->bindParam(':adminname',$AName,PDO::PARAM_STR);
	$query->bindParam(':firstname',$fName,PDO::PARAM_STR);
	$query->bindParam(':lastname',$lName,PDO::PARAM_STR);
	$query->bindParam(':email',$email,PDO::PARAM_STR);
	$query->bindParam(':mobilenumber',$mobno,PDO::PARAM_STR);
	$query->bindParam(':aid',$adminid,PDO::PARAM_STR);
	$query->execute();
	if ($query) {
		echo '<script>alert("Profile has been updated")</script>';
	}else{
		echo '<script>alert("failed")</script>';
	}
}

if(isset($_POST['submit2']))
{
	$adminid=$_SESSION['odmsaid'];
	$cpassword=md5($_POST['currentpassword']);
	$newpassword=md5($_POST['newpassword']);
	$sql ="SELECT ID FROM tbladmin WHERE ID=:adminid and Password=:cpassword";
	$query= $dbh -> prepare($sql);
	$query-> bindParam(':adminid', $adminid, PDO::PARAM_STR);
	$query-> bindParam(':cpassword', $cpassword, PDO::PARAM_STR);
	$query-> execute();
	$results = $query -> fetchAll(PDO::FETCH_OBJ);

	if($query -> rowCount() > 0)
	{
		$con="update tbladmin set Password=:newpassword where ID=:adminid";
		$chngpwd1 = $dbh->prepare($con);
		$chngpwd1-> bindParam(':adminid', $adminid, PDO::PARAM_STR);
		$chngpwd1-> bindParam(':newpassword', $newpassword, PDO::PARAM_STR);
		$chngpwd1->execute();
		if ($chngpwd1) {

			echo '<script>alert("Your password successully changed")</script>';
		}else{
			echo '<script>alert("failed")</script>';
		}
	} else {
		echo '<script>alert("Your current password is wrong")</script>';

	}
}

if(isset($_POST['submit3']))
{
	$adminid=$_SESSION['odmsaid'];
	$profileimage=$_FILES["profileimage"]["name"];
	move_uploaded_file($_FILES["profileimage"]["tmp_name"],"profileimages/".$_FILES["profileimage"]["name"]);
	$sql="update  tbladmin set Photo=:profileimage where ID=:aid";
	$query = $dbh->prepare($sql);
	$query->bindParam(':profileimage',$profileimage,PDO::PARAM_STR);
	$query->bindParam(':aid',$adminid,PDO::PARAM_STR);
	$query->execute();
	if ($query) {
		echo '<script>alert("profile Image Updated Successfully !!")</script>';
	}else{
		echo '<script>alert("failed")</script>';
	}
}
?>
<!DOCTYPE html><html lang="en" dir="ltr">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width,initial-scale=1">
	<meta name="description" content="Shop - Admin Dashboard HTML Template.">
	<title>Electronic Shop - Admin Dashboard HTML Template.</title>
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@200;300;400;500;600;700;800&family=Poppins:wght@300;400;500;600;700;800;900&family=Roboto:wght@400;500;700;900&display=swap" rel="stylesheet">

	<link rel="stylesheet" href="assets/mdi/css/materialdesignicons.min.css">
	
	<link href="assets/css/simplebar.css" rel="stylesheet">
	<link id="Shop-css" rel="stylesheet" href="assets/css/style.css">
	<link href="assets/img/favicon.png" rel="shortcut icon">
	<script type="text/javascript">
		function checkpass()
		{
			if(document.changepassword.newpassword.value!=document.changepassword.confirmpassword.value)
			{
				alert('New Password and Confirm Password field does not match');
				document.changepassword.confirmpassword.focus();
				return false;
			}
			return true;
		}   

	</script>
</head>
<body class="ec-header-fixed ec-sidebar-fixed ec-sidebar-dark ec-header-light" id="body">
	<div class="wrapper">
		<?php @include("includes/sidebar.php");?>
		<div class="ec-page-wrapper">
			<?php @include("includes/header.php");?>

			<div class="ec-content-wrapper">
				<div class="content">
					<div class="breadcrumb-wrapper breadcrumb-contacts">
						<div>
							<h1>User Profile</h1>
							<p class="breadcrumbs">
								<span>
									<a href="dashboard.php">Home</a>
								</span> 
								<span>
									<i class="mdi mdi-chevron-right"></i>
								</span>Profile
							</p>
						</div>
					</div>
					<div class="card bg-white profile-content">
						<div class="row">
							<?php
							$adminid=$_SESSION['odmsaid'];
							$sql2="SELECT * from  tbladmin where ID=:aid";
							$query2 = $dbh -> prepare($sql2);
							$query2->bindParam(':aid',$adminid,PDO::PARAM_STR);
							$query2->execute();
							$results2=$query2->fetchAll(PDO::FETCH_OBJ);
							if($query2->rowCount() > 0)
							{
								foreach($results2 as $row2)
								{
									?>
									<div class="col-lg-4 col-xl-3">
										<div class="profile-content-left profile-left-spacing">

											<div class="text-center widget-profile px-0 border-0">
												<div class="card-img mx-auto rounded-circle">
													<?php 
													if($row2->Photo=="avatar15.jpg"){ ?>
														<img src="assets/img/user/u1.jpg" alt="user image">
														<?php 
													} else { ?>
														<img src="profileimages/<?php  echo $row2->Photo;?>" > 
														<?php 
													} ?> 
												</div>
												<div class="card-body">
													<h4 class="py-2 text-dark"><?php  echo $row2->FirstName;?>&nbsp; <?php  echo $row2->LastName;?></h4>
													<p>
														<a href="/cdn-cgi/l/email-protection" class="__cf_email__" data-cfemail="0a676b7861246f726b677a666f4a6d676b636624696567"><?php  echo $row2->Email;?>
													</a>
												</p>
												<a class="btn btn-primary my-3" href="#">Follow</a>
											</div>
										</div>
										<div class="d-flex justify-content-between">
											<div class="text-center pb-4">
												<h6 class="text-dark pb-2">546</h6>
												<p>Bought</p>
											</div>
											<div class="text-center pb-4">
												<h6 class="text-dark pb-2">32</h6>
												<p>Wish List</p>
											</div>
											<div class="text-center pb-4">
												<h6 class="text-dark pb-2">1150</h6>
												<p>Following</p>
											</div>
										</div>
										<hr class="w-100">
										<div class="contact-info pt-4">
											<h5 class="text-dark">Contact Information</h5>
											<p class="text-dark font-weight-medium pt-24px mb-2">Email address</p>
											<p>
												<a href="/cdn-cgi/l/email-protection" class="__cf_email__" data-cfemail="83eee2f1e8ade6fbe2eef3efe6c3e4eee2eaefade0ecee"><?php  echo $row2->Email;?>
											</a>
										</p>
										<p class="text-dark font-weight-medium pt-24px mb-2">Phone Number</p><p>0<?php  echo $row2->MobileNumber;?></p>
										<p class="text-dark font-weight-medium pt-24px mb-2">Birthday</p>
										<p>Dec 10, 1991</p>
										
									</div>
								</div>
								<?php
							}
						}
						?>
					</div>
					<div class="col-lg-8 col-xl-9">
						<div class="profile-content-right profile-right-spacing py-5">
							<ul class="nav nav-tabs px-3 px-xl-5 nav-style-border" id="myProfileTab" role="tablist">
								<li class="nav-item" role="presentation">
									<button class="nav-link active" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile" type="button" role="tab" aria-controls="profile" aria-selected="true">Profile
									</button>
								</li>
								<li class="nav-item" role="presentation">
									<button class="nav-link" id="settings-tab" data-bs-toggle="tab" data-bs-target="#settings" type="button" role="tab" aria-controls="settings" aria-selected="false">Settings
									</button>
								</li>
							</ul>
							<div class="tab-content px-3 px-xl-5" id="myTabContent">
								<div class="tab-pane fade show active" id="profile" role="tabpanel" aria-labelledby="profile-tab">
									<div class="tab-widget mt-5">
										<div class="row">
											<div class="col-xl-4">
												<div class="media widget-media p-3 bg-white border">
													<div class="icon rounded-circle mr-3 bg-primary">
														<i class="mdi mdi-account-outline text-white"></i></div>
														<div class="media-body align-self-center">
															<?php 
															$sql22 ="SELECT id from orders";
															$query22 = $dbh -> prepare($sql22);
															$query22->execute();
															$results22=$query22->fetchAll(PDO::FETCH_OBJ);
															$totalunreadquery=$query22->rowCount();
															?>
															<h4 class="text-primary mb-2"><?php echo htmlentities($totalunreadquery);?></h4>
															<p>Bought Products</p>
														</div>
													</div>
												</div>
												<div class="col-xl-4">
													<div class="media widget-media p-3 bg-white border">
														<div class="icon rounded-circle bg-warning mr-3">
															<i class="mdi mdi-cart-outline text-white"></i>
														</div>
														<div class="media-body align-self-center">
															<?php 
															$sql23 ="SELECT id from wishlist";
															$query23 = $dbh -> prepare($sql23);
															$query23->execute();
															$results23=$query23->fetchAll(PDO::FETCH_OBJ);
															$totalwishlist=$query23->rowCount();
															?>
															<h4 class="text-primary mb-2"><?php echo htmlentities($totalwishlist);?></h4>
															<p>Wish List</p>
														</div>
													</div>
												</div>
												<div class="col-xl-4">
													<div class="media widget-media p-3 bg-white border">
														<div class="icon rounded-circle mr-3 bg-success">
															<i class="mdi mdi-ticket-percent text-white"></i>
														</div>
														<div class="media-body align-self-center">
															<h4 class="text-primary mb-2">02</h4>
															<p>Voucher</p>
														</div>
													</div>
												</div>
											</div>
											<div class="row">
												<div class="col-xl-12">
													<div class="card card-default">
														<div class="card-header justify-content-between mb-1">
															<h2>Latest Notifications</h2>
															<div>
																<button class="text-black-50 mr-2 font-size-20">
																	<i class="mdi mdi-cached"></i>
																</button>
																<div class="dropdown show d-inline-block widget-dropdown">
																	<a class="dropdown-toggle icon-burger-mini" href="#" role="button" id="dropdown-notification" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-display="static"></a>
																	<ul class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdown-notification">
																		<li class="dropdown-item">
																			<a href="#">Action</a>
																		</li>
																		<li class="dropdown-item">
																			<a href="#">Another action</a>
																		</li>
																		<li class="dropdown-item">
																			<a href="#">Something else here</a></li>
																		</ul>
																	</div>
																</div>
															</div>
															<div class="card-body compact-notifications" data-simplebar style="height:434px">
																<div class="media pb-3 align-items-center justify-content-between">
																	<div class="d-flex rounded-circle align-items-center justify-content-center mr-3 media-icon iconbox-45 bg-primary text-white">
																		<i class="mdi mdi-cart-outline font-size-20"></i>
																	</div>
																	<div class="media-body pr-3">
																		<a class="mt-0 mb-1 font-size-15 text-dark" href="#">New Order</a>
																		<p>Doreen has placed an new order</p>
																	</div>
																	<span class="font-size-12 d-inline-block">
																		<i class="mdi mdi-clock-outline"></i> 04:30 PM
																	</span>
																</div>
																<div class="media py-3 align-items-center justify-content-between">
																	<div class="d-flex rounded-circle align-items-center justify-content-center mr-3 media-icon iconbox-45 bg-success text-white">
																		<i class="mdi mdi-email-outline font-size-20"></i>
																	</div>
																	<div class="media-body pr-3">
																		<a class="mt-0 mb-1 font-size-15 text-dark" href="#">New Enquiry
																		</a>
																		<p>Johnson sent you new message</p>
																	</div>
																	<span class="font-size-12 d-inline-block">
																		<i class="mdi mdi-clock-outline"></i> 10:23 AM
																	</span>
																</div>
																<div class="media py-3 align-items-center justify-content-between">
																	<div class="d-flex rounded-circle align-items-center justify-content-center mr-3 media-icon iconbox-45 bg-warning text-white">
																		<i class="mdi mdi-stack-exchange font-size-20"></i>
																	</div>
																	<div class="media-body pr-3">
																		<a class="mt-0 mb-1 font-size-15 text-dark" href="#">Support Ticket</a>
																		<p>Everist has placed an new ticket</p>
																	</div>
																	<span class="font-size-12 d-inline-block">
																		<i class="mdi mdi-clock-outline"></i> 07:10 AM
																	</span>
																</div>
																<div class="media py-3 align-items-center justify-content-between">
																	<div class="d-flex rounded-circle align-items-center justify-content-center mr-3 media-icon iconbox-45 bg-primary text-white">
																		<i class="mdi mdi-cart-outline font-size-20"></i>
																	</div>
																	<div class="media-body pr-3">
																		<a class="mt-0 mb-1 font-size-15 text-dark" href="#">New order</a>
																		<p>Elizabeth has placed an new order</p>
																	</div>
																	<span class="font-size-12 d-inline-block">
																		<i class="mdi mdi-clock-outline"></i> 10:44 PM
																	</span>
																</div>
																<div class="media py-3 align-items-center justify-content-between">
																	<div class="d-flex rounded-circle align-items-center justify-content-center mr-3 media-icon iconbox-45 bg-info text-white">
																		<i class="mdi mdi-calendar-blank font-size-20"></i>
																	</div>
																	<div class="media-body pr-3">
																		<a class="mt-0 mb-1 font-size-15 text-dark" href="">General Meeting</a>
																		<p>You are requested to attend meeting tommorow</p>
																	</div>
																	<span class="font-size-12 d-inline-block">
																		<i class="mdi mdi-clock-outline"></i> 11:00 AM
																	</span>
																</div>
															</div>
															<div class="mt-3">

															</div>
														</div>
													</div>
												</div>
											</div>
										</div>
										<div class="tab-pane fade" id="settings" role="tabpanel" aria-labelledby="settings-tab">
											<div class="tab-pane-content mt-5">
												<form name="profileimage" method="post" enctype="multipart/form-data">
													<div class="form-group row mb-6">
														<label for="coverImage" class="col-sm-4 col-lg-2 col-form-label">User Image</label>
														<div class="col-sm-8 col-lg-10">
															<div class="custom-file mb-1">
																<input type="file" name="profileimage" class="custom-file-input" id="profileimage" required>
																<label class="custom-file-label" for="profileimage">Choose file...
																</label>
																<div class="invalid-feedback">Example invalid custom file feedback
																</div>
																<div class="d-flex justify-content-end mt-5">
																	<button type="submit" name="submit3" class="btn btn-primary mb-2 btn-pill">Update image
																	</button>
																</div>
															</div>
														</div>
													</div>
												</form>
												<hr>

												<form method="post">
													<?php
													$adminid=$_SESSION['odmsaid'];
													$sql="SELECT * from  tbladmin where ID=:aid";
													$query = $dbh -> prepare($sql);
													$query->bindParam(':aid',$adminid,PDO::PARAM_STR);
													$query->execute();
													$results=$query->fetchAll(PDO::FETCH_OBJ);
													$cnt=1;
													if($query->rowCount() > 0)
													{
														foreach($results as $row)
														{  
															?>
															<div class="row mb-2">
																<div class="col-lg-6">
																	<div class="form-group">
																		<label for="firstName">First name</label>
																		<input class="form-control" name="firstName" value="<?php  echo $row->FirstName;?>" id="firstName" >
																	</div>
																</div>
																<div class="col-lg-6">
																	<div class="form-group">
																		<label for="lastName">Last name</label>
																		<input class="form-control" name="lastName" value="<?php  echo $row->LastName;?>" id="lastName" >
																	</div>
																</div>
															</div>
															<div class="form-group mb-4">
																<label for="userName">User name</label>
																<input class="form-control" name="userName" value="<?php  echo $row->UserName;?>" id="userName" >
																<span class="d-block mt-1">Accusamus nobis at omnis consequuntur culpa tempore saepe animi.
																</span>
															</div>
															<div class="col-lg-6">
																<div class="form-group mb-4">
																	<label for="email">Email</label>
																	<input type="email" name="email" class="form-control" id="email" value="<?php  echo $row->Email;?>">
																</div>
															</div>
															<div class="col-lg-6">
																<div class="form-group mb-4">
																	<label for="tel">Tel.</label>
																	<input type="text" name="tel"class="form-control" id="tel" value="0<?php  echo $row->MobileNumber;?>">
																</div>
															</div>
															<?php 
														}
													} ?>
													<div class="d-flex justify-content-end mt-5">
														<button type="submit" name="submit" class="btn btn-primary mb-2 btn-pill">Update Profile
														</button>
													</div>
													<hr>
												</form>
												<form method="post" onsubmit="return checkpass();" name="changepassword">
													<div class="form-group mb-4">
														<label for="oldPassword">Old password</label>
														<input type="password" name="currentpassword" class="form-control" id="currentPassword">
													</div>
													<div class="form-group mb-4">
														<label for="newPassword">New password</label>
														<input type="password" name="newpassword" class="form-control" id="newPassword">
													</div>
													<div class="form-group mb-4">
														<label for="conPassword">Confirm password</label>
														<input type="password" class="form-control" name="confirmpassword" id="confirmPassword">
													</div>
													<div class="d-flex justify-content-end mt-5">
														<button type="submit" name="submit2" class="btn btn-primary mb-2 btn-pill">Change Password
														</button>
													</div>
												</form>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>

			<?php @include("includes/footer.php");?>
		</div>
	</div>
	<script data-cfasync="false" src="/cdn-cgi/scripts/5c5dd728/cloudflare-static/email-decode.min.js"></script>
	<script src="assets/plugins/jquery-3.5.1.min.js"></script>
	<script src="assets/plugins/jquery.notify.min.js"></script>
	<script src="assets/plugins/jquery.bundle.notify.min.js"></script>
	<script src="assets/plugins/bootstrap.bundle.min.js"></script>
	<script src="assets/plugins/simplebar.min.js"></script>
	<script src="assets/plugins/jquery.zoom.min.js"></script>
	<script src="assets/plugins/slick.min.js"></script>
	<script src="assets/plugins/optionswitcher.js"></script>
	<script src="assets/js/main.js"></script>
</body>
</html>