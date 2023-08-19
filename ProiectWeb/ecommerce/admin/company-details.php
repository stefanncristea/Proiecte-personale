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
	$companyemail=$_POST['companyemail'];
	$companyname=$_POST['companyname'];
	$companyaddress=$_POST['companyaddress'];
	$regno=$_POST['regno'];
	$country=$_POST['country'];
	$mobno=$_POST['mobilenumber'];
	$sql="update tblcompany set companyaddress=:companyaddress,companyname=:companyname,companyemail=:companyemail,regno=:regno,companyphone=:mobilenumber,country=:country";
	$query = $dbh->prepare($sql);
	$query->bindParam(':companyaddress',$companyaddress,PDO::PARAM_STR);
	$query->bindParam(':companyemail',$companyemail,PDO::PARAM_STR);
	$query->bindParam(':regno',$regno,PDO::PARAM_STR);
	$query->bindParam(':country',$country,PDO::PARAM_STR);
	$query->bindParam(':mobilenumber',$mobno,PDO::PARAM_STR);
	$query->bindParam(':companyname',$companyname,PDO::PARAM_STR);
	$query->execute();
	if ($query->execute()){
		echo '<script>alert("Profile has been updated")</script>';
	}else{
		echo '<script>alert("update failed! try again later")</script>';
	}
}
if(isset($_POST['submit2']))
{
	$companyname=$_SESSION['companyname'];
	$filename = $_FILES['note']['name'];

  // destination of the file on the server
	$destination = 'companyimages/' . $filename;

  // get the file extension
	$extension = pathinfo($filename, PATHINFO_EXTENSION);

  // the physical file on a temporary uploads directory on the server
	$file = $_FILES['note']['tmp_name'];
	$size = $_FILES['note']['size'];
  // move the uploaded (temporary) file to the specified destination
	if (move_uploaded_file($file, $destination)) {
		$sql="update  tblcompany set companylogo=:filename ";
		$query = $dbh->prepare($sql);
		$query->bindParam(':filename',$filename,PDO::PARAM_STR);
		$query->execute();
		if ($query->execute()){
			echo '<script>alert("Company logo updated successfully")</script>';
		}else{
			echo '<script>alert("update failed! try again later")</script>';
		}
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
							<h1>Company Details</h1>
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
							$sql="SELECT * from  tblcompany ";
							$query = $dbh -> prepare($sql);
							$query->execute();
							$results=$query->fetchAll(PDO::FETCH_OBJ);
							if($query->rowCount() > 0)
							{
								foreach($results as $row)
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
														<img src="companyimages/<?php  echo $row->companylogo;?>" > 
														<?php 
													} ?> 
												</div>
												<div class="card-body">
													<h4 class="py-2 text-dark"><?php  echo $row->companyname;?></h4>
													<p>
														<a href="/cdn-cgi/l/email-protection" class="__cf_email__" data-cfemail="0a676b7861246f726b677a666f4a6d676b636624696567"><?php  echo $row->companyemail;?></a>
													</p>
												</div>
											</div>
											<hr class="w-100">
											<div class="contact-info pt-4">
												<h5 class="text-dark">Contact Information</h5>
												<p class="text-dark font-weight-medium pt-24px mb-2">Email address</p>
												<p>
													<a href="/cdn-cgi/l/email-protection" class="__cf_email__" data-cfemail="83eee2f1e8ade6fbe2eef3efe6c3e4eee2eaefade0ecee"><?php  echo $row->companyemail;?></a>
												</p>
												<p class="text-dark font-weight-medium pt-24px mb-2">Phone Number</p><p>0<?php  echo $row->companyphone;?></p>
												<p class="text-dark font-weight-medium pt-24px mb-2">Reg No.</p>
												<p><?php  echo $row->regno;?></p>

											</div>
										</div>

									</div>
									<?php
								}
							}
							?>
							<div class="col-lg-8 col-xl-9">
								<div class="profile-content-right profile-right-spacing py-5">
									<ul class="nav nav-tabs px-3 px-xl-5 nav-style-border" id="myProfileTab" role="tablist">
										<li class="nav-item" role="presentation">
											<button class="nav-link active" id="settings-tab" data-bs-toggle="tab" data-bs-target="#settings" type="button" role="tab" aria-controls="settings" aria-selected="true">Settings
											</button>
										</li>
									</ul>
									<div class="tab-content px-3 px-xl-5" id="myTabContent">
										<div class="tab-pane fade " id="profile" role="tabpanel" aria-labelledby="profile-tab">
											<div class="tab-widget mt-5">
												<div class="row">

												</div>
												<div class="row">
													<div class="col-xl-12">
														<div class="card card-default">
															<div class="card-header justify-content-between mb-1">
																<div>
																	<button class="text-black-50 mr-2 font-size-20">
																		<i class="mdi mdi-cached"></i>
																	</button>
																	<div class="dropdown show d-inline-block widget-dropdown">
																		<a class="dropdown-toggle icon-burger-mini" href="#" role="button" id="dropdown-notification" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-display="static"></a>

																	</div>
																</div>
															</div>
														</div>
													</div>
												</div>
											</div>
										</div>
										<div class="tab-pane fade show active" id="settings" role="tabpanel" aria-labelledby="settings-tab">
											<div class="tab-pane-content mt-5">
												<form name="profileimage" method="post" enctype="multipart/form-data">
													<div class="form-group row mb-6">
														<label for="coverImage" class="col-sm-4 col-lg-2 col-form-label">Company Logo</label>
														<div class="col-sm-8 col-lg-10">
															<div class="custom-file mb-1">
																<input type="file" name="note" id="note" class="custom-file-input"  required>
																<label class="custom-file-label" for="profileimage">Choose file...
																</label>
																<div class="invalid-feedback">Example invalid custom file feedback
																</div>
																<div class="d-flex justify-content-end mt-5">
																	<button type="submit" name="submit2" class="btn btn-primary mb-2 btn-pill">Update Logo
																	</button>
																</div>
															</div>
														</div>
													</div>
												</form>
												<hr>

												<form method="post">
													<?php
													$sql="SELECT * from  tblcompany ";
													$query = $dbh -> prepare($sql);
													$query->execute();
													$results=$query->fetchAll(PDO::FETCH_OBJ);
													if($query->rowCount() > 0)
													{
														foreach($results as $row)
														{  
															?>
															<div class="row mb-2">
																<div class="col-lg-6">
																	<div class="form-group">
																		<label for="firstName">Company Name</label>
																		<input class="form-control" name="companyname" value="<?php  echo $row->companyname;?>" id="companyname" >
																	</div>
																</div>
																<div class="col-lg-6">
																	<div class="form-group">
																		<label for="lastName">Reg No.</label>
																		<input class="form-control" name="regno" value="<?php  echo $row->regno;?>" id="regno" >
																	</div>
																</div>
															</div>
															<div class="form-group ">
																<label for="userName">Physical Address</label>
																<input class="form-control" name="companyaddress" value="<?php  echo $row->companyaddress;?>" id="companyaddress" >
															</div>

															<div class="row mb-2">
																<div class="col-lg-6">
																	<div class="form-group ">
																		<label for="userName">Country</label>
																		<input class="form-control" name="country" value="<?php  echo $row->country;?>" id="country" >
																	</div>
																</div>
																<div class="col-lg-6">
																	<div class="form-group mb-4">
																		<label for="email">Email</label>
																		<input type="email" name="companyemail" class="form-control" id="companyemail" value="<?php  echo $row->companyemail;?>">
																	</div>
																</div>

															</div>
															<div class="col-lg-6">
																<div class="form-group mb-4">
																	<label for="tel">Tel.</label>
																	<input type="text" name="mobilenumber"class="form-control" id="mobilenumber" value="0<?php  echo $row->companyphone;?>">
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