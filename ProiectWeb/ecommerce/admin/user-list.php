<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');
if(strlen($_SESSION['odmsaid'])==0)
{	
	header('location:index.php');
}
if(isset($_GET['delid']))
{
	$rid=intval($_GET['delid']);
	$sql="update tbladmin set Status='0' where ID='$rid'";
	$query=$dbh->prepare($sql);
	$query->bindParam(':rid',$rid,PDO::PARAM_STR);
	$query->execute();
	if ($query->execute()){
		echo "<script>alert('User blocked');</script>"; 
		echo "<script>window.location.href = 'user-list.php'</script>";
	}else{
		echo '<script>alert("update failed! try again later")</script>';
	}
}
if(isset($_GET['resid']))
{
	$reid=intval($_GET['resid']);
	$sql="update tbladmin set Status='1' where ID='$reid'";
	$query=$dbh->prepare($sql);
	$query->bindParam(':reid',$reid,PDO::PARAM_STR);
	$query->execute();
	if ($query->execute()){
		echo "<script>alert('User Restored');</script>"; 
		echo "<script>window.location.href = 'user-list.php'</script>";
	}else{
		echo '<script>alert("update failed! try again later")</script>';
	}
}

if(isset($_GET['del'])){    
	$cmpid=$_GET['del'];
	$query=mysqli_query($con,"delete from tbladmin where ID='$cmpid'");
	echo "<script>alert('User deleted permanently.');</script>";   
	echo "<script>window.location.href='user-list.php'</script>";
}

?>
<!DOCTYPE html>
<html lang="en" dir="ltr">

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

	<link rel="stylesheet" href="assets/mdi/css/materialdesignicons.min.css">

	<!-- PLUGINS CSS STYLE -->
	<link href="assets/plugins/simplebar/simplebar.css" rel="stylesheet" />

	<!-- Data Tables -->
	<link href='assets/plugins/data-tables/datatables.bootstrap5.min.css' rel='stylesheet'>
	<link href='assets/plugins/data-tables/responsive.datatables.min.css' rel='stylesheet'>

	<!-- Shop CSS -->
	<link id="Shop-css" rel="stylesheet" href="assets/css/style.css" />

	<link id="Shop-css" rel="stylesheet" href="assets/css/form-validate.css" />

	<link rel="stylesheet" type="text/css" href="assets/sweetalert2/sweetalert2.min.css">

	<!-- FAVICON -->
	<link href="assets/img/favicon.png" rel="shortcut icon" />
	<script>
		function checkAvailability() 
		{
			$("#loaderIcon").show();
			jQuery.ajax(
			{
				url: "check_availability.php",
				data:'email='+$("#email").val(),
				type: "POST",
				success:function(data)
				{
					$("#user-availability-status").html(data);
					$("#loaderIcon").hide();
				},
				error:function (){}
			});
		}
	</script>
</head>

<body class="ec-header-fixed ec-sidebar-fixed ec-sidebar-dark ec-header-light" id="body">

	<!-- WRAPPER -->
	<div class="wrapper">

		<!-- LEFT MAIN SIDEBAR -->
		<?php @include("includes/sidebar.php");?>

		<!-- PAGE WRAPPER -->
		<div class="ec-page-wrapper">

			<!-- Header -->
			<?php @include("includes/header.php");?>

			<!-- CONTENT WRAPPER -->
			<div class="ec-content-wrapper">
				<div class="content">
					<div class="breadcrumb-wrapper breadcrumb-contacts">
						<div>
							<h1>User List</h1>
							<p class="breadcrumbs"><span><a href="dashboard.php">Home</a></span>
								<span><i class="mdi mdi-chevron-right"></i></span>User
							</p>
						</div>
						<div>
							<button type="button" class="btn btn-primary" data-bs-target="#blockedUser" data-bs-toggle="modal"> 
								Blocked Users
							</button>
							<button type="button" class="btn btn-primary" data-bs-target="#addUser" data-bs-toggle="modal"> 
								Add User
							</button>
						</div>
					</div>
					<!-- start modal -->
					<div class="modal fade"  id="editData5" tabindex="-1" role="dialog" aria-hidden="true">
						<div class="modal-dialog modal-dialog-centered modal-md" role="document">
							<div class="modal-content">

								<div class="modal-header px-4">
									<h5 class="modal-title" id="exampleModalCenterTitle">View User Details</h5>
								</div>

								<div class="modal-body px-4" id="info_update5">

									<?php @include("edit-user.php");?>
								</div>
							</div>
						</div>
					</div>
					<!-- end modal -->
					<div class="row">
						<div class="col-12">
							<div class="ec-vendor-list card card-default">
								<div class="card-body">
									<div class="table-responsive">
										<table id="responsive-data-table" class="table">
											<thead>
												<tr>
													<th>Profile</th>
													<th>Name</th>
													<th>Email</th>
													<th>Phone</th>
													<th>Status</th>
													<th>Join On</th>
													<th>Action</th>
												</tr>
											</thead>

											<tbody>
												<?php
												$sql="SELECT * from tbladmin where Status='1' ORDER BY id DESC";
												$query = $dbh -> prepare($sql);
												$query->execute();
												$results=$query->fetchAll(PDO::FETCH_OBJ);
												if($query->rowCount() > 0)
												{
													foreach($results as $row)
													{ 
														?>
														<tr>
															<td>
																<?php 
																if($row->Photo=="avatar15.jpg"){ ?>
																	<img class="vendor-thumb" src="assets/img/vendor/u1.jpg" alt="user profile" />
																	<?php 
																} else { ?>
																	<img class="vendor-thumb" src="profileimages/<?php  echo $row->Photo;?>" alt="user profile" > 
																	<?php 
																} ?> 

															</td>
															<td><?php  echo htmlentities($row->FirstName);?>&nbsp;<?php  echo htmlentities($row->LastName);?></td>
															<td><?php  echo htmlentities($row->Email);?></td>
															<td><?php  echo htmlentities($row->MobileNumber);?></td>
															<?php 
															if($row->Status=="1"){ ?>
																<td>ACTIVE</td>
																<?php
															} else{ ?>
																<td>INACTIVE</td>
																<?php 
															} ?>
															<td><?php  echo htmlentities(date("d-m-Y", strtotime($row->AdminRegdate)));?></td>
															<td>
																<div class="btn-group mb-1">
																	<button type="button"
																	class="btn btn-outline-success">Info</button>
																	<button type="button"class="btn btn-outline-success dropdown-toggle dropdown-toggle-split" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-display="static">
																		<span class="sr-only">Info</span>
																	</button>

																	<div class="dropdown-menu">
																		<a class="dropdown-item edit_data5" id="<?php echo  ($row->ID); ?>" href="#">View</a>
																		<a class="dropdown-item" href="user-list.php?delid=<?php echo ($row->ID);?>" onclick="return confirm('Do you really want to Block ?');" title="Block this User">Block</a>
																	</div>
																</div>
															</td>
														</tr>
														<?php 
													}
												}
												?>
											</tbody>
										</table>
									</div>
								</div>
							</div>
						</div>
					</div>
					<!-- Add User Modal  -->
					<div class="modal fade modal-add-contact" id="addUser" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
						<div class="modal-dialog modal-dialog-centered modal-lg" role="document">
							<div class="modal-content">
								<div id="form_status"></div>
								<form method="post" id="user-contact" onSubmit="return valid_datas( this );" enctype="multipart/form-data">
									<div class="modal-header px-4">
										<h5 class="modal-title" id="exampleModalCenterTitle">Add New User</h5>
									</div>

									<div class="modal-body px-4">
										<div class="form-group row mb-6">
											<label for="coverImage" class="col-sm-4 col-lg-2 col-form-label">User
											Image</label>

											<div class="col-sm-8 col-lg-10">
												<div class="custom-file mb-1">
													<input type="file" class="custom-file-input" name="coverImage" id="coverImage"
													>
													<label class="custom-file-label" for="coverImage">Choose
													file...</label>
													<div class="invalid-feedback">Example invalid custom file feedback
													</div>
												</div>
											</div>
										</div>

										<div class="row mb-2">
											<div class="col-lg-4">
												<div class="form-group">
													<label for="firstName">First name</label>
													<input type="text" class="form-control" name="firstName" id="firstName" >
												</div>
											</div>

											<div class="col-lg-4">
												<div class="form-group">
													<label for="lastName">Last name</label>
													<input type="text" class="form-control" name="lastName" id="lastName">
												</div>
											</div>

											<div class="col-lg-4">
												<div class="form-group mb-4">
													<label for="userName">User name</label>
													<input type="text" class="form-control" name="username" id="username"
													>
												</div>
											</div>
											<div class="col-lg-3">
												<div class="form-group mb-4">
													<label for="email">Staff ID</label>
													<input type="text" class="form-control" name="staffid" id="staffid"
													>
												</div>
											</div>

											<div class="col-lg-3">
												<div class="form-group mb-4">
													<label for="email">Email</label>
													<input type="email" class="form-control" onBlur="checkAvailability()" name="email" id="email"
													>
													<span id="user-availability-status" style="font-size:12px;"></span> 
												</div>
											</div>

											<div class="col-lg-3">
												<div class="form-group mb-4">
													<label for="Birthday">Birthday</label>
													<input type="text" class="form-control" placeholder="dd/mm/yyyy" name="Birthday" id="Birthday"
													>
												</div>
											</div>
											<div class="col-lg-3">
												<div class="form-group mb-4">
													<label for="mobileno">Mobile No</label>
													<input type="text" class="form-control" name="mobileno" id="mobileno"
													>
												</div>
											</div>
											<div class="col-lg-4">
												<div class="form-group mb-4">
													<label for="dignity">Permission</label>
													<select class="form-control"   name="dignity"  id="dignity"  >
														<option value="">Select permisions</option>
														<option value="Admin">Admin</option>
														<option value="User">User</option>
													</select>
												</div>
											</div>
											<div class="col-lg-4">
												<div class="form-group mb-4">
													<label for="password">password</label>
													<input type="password" class="form-control" name="password" id="password"
													>
												</div>
											</div>

											<div class="col-lg-4">
												<div class="form-group mb-4">
													<label for="event">Confirm Password</label>
													<input type="password" class="form-control" name="confirmpassword" id="confirmpassword"
													>
												</div>
												<input type="hidden" name="token" value="FsWga4&@f6aw" />
											</div>
										</div>
									</div>

									<div class="modal-footer px-4">
										<button type="button" class="btn btn-secondary btn-pill"
										data-bs-dismiss="modal">Cancel</button>
										<button type="submit" class="btn btn-primary btn-pill">Submit</button>
									</div>
								</form>
							</div>
						</div>
					</div>
					<div class="modal fade modal-add-contact" id="blockedUser" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
						<div class="modal-dialog modal-dialog-centered modal-lg" role="document">
							<div class="modal-content">
								<form>
									<div class="modal-header px-4">
										<h5 class="modal-title" id="exampleModalCenterTitle">Blocked User</h5>
									</div>

									<div class="modal-body px-4">
										<div class="row">
											<div class="col-12">
												<div class="ec-vendor-list card card-default">
													<div class="card-body">
														<div class="table-responsive">
															<table id="responsive-data-table" class="table">
																<thead>
																	<tr>
																		<th>Profile</th>
																		<th>Name</th>
																		<th>Email</th>
																		<th>Phone</th>
																		<th>Status</th>
																		<th>Join On</th>
																		<th>Action</th>
																	</tr>
																</thead>

																<tbody>
																	<?php
																	$sql="SELECT * from tbladmin where Status='0' ORDER BY id DESC";
																	$query = $dbh -> prepare($sql);
																	$query->execute();
																	$results=$query->fetchAll(PDO::FETCH_OBJ);
																	if($query->rowCount() > 0)
																	{
																		foreach($results as $row)
																		{ 
																			?>
																			<tr>
																				<td>
																					<?php 
																					if($row->Photo=="avatar15.jpg"){ ?>
																						<img class="vendor-thumb" src="assets/img/vendor/u1.jpg" alt="user profile" />
																						<?php 
																					} else { ?>
																						<img class="vendor-thumb" src="profileimages/<?php  echo $row->Photo;?>" alt="user profile" > 
																						<?php 
																					} ?> 

																				</td>
																				<td><?php  echo htmlentities($row->FirstName);?>&nbsp;<?php  echo htmlentities($row->LastName);?></td>
																				<td><?php  echo htmlentities($row->Email);?></td>
																				<td><?php  echo htmlentities($row->MobileNumber);?></td>
																				<?php 
																				if($row->Status=="1"){ ?>
																					<td>ACTIVE</td>
																					<?php
																				} else{ ?>
																					<td>INACTIVE</td>
																					<?php 
																				} ?>
																				<td><?php  echo htmlentities(date("d-m-Y", strtotime($row->AdminRegdate)));?></td>
																				<td>
																					<div class="btn-group mb-1">
																						<button type="button"
																						class="btn btn-outline-success">Info</button>
																						<button type="button" class="btn btn-outline-success dropdown-toggle dropdown-toggle-split" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-display="static">
																							<span class="sr-only">Info</span>
																						</button>

																						<div class="dropdown-menu">
																							<a class="dropdown-item" href="user-list.php?resid=<?php echo ($row->ID);?>" onclick="return confirm('Do you really want to Restore ?');" title="Restore this User">Unblock</a>
																							<a class="dropdown-item" href="user-list.php?del=<?php echo ($row->ID);?>" onclick="return confirm('Do you really want to delete permanently?');">Delete</a>
																						</div>
																					</div>
																				</td>
																			</tr>
																			<?php 

																		}
																	}
																	?>
																</tbody>
															</table>
														</div>
													</div>
												</div>
											</div>
										</div>

									</div>

									<div class="modal-footer px-4">
										<button type="button" class="btn btn-secondary btn-pill"
										data-bs-dismiss="modal">Cancel</button>
									</div>
								</form>
							</div>
						</div>
					</div>
				</div> <!-- End Content -->
			</div> <!-- End Content Wrapper -->

			<!-- Footer -->
			<?php @include("includes/footer.php");?>

		</div> <!-- End Page Wrapper -->
	</div> <!-- End Wrapper -->

	<!-- Common Javascript -->
	<script src="assets/plugins/jquery/jquery-3.5.1.min.js"></script>
	<script src="assets/plugins/jquery/jquery.notify.min.js"></script>
	<script src="assets/plugins/jquery/jquery.bundle.notify.min.js"></script>
	<script src="assets/js/bootstrap.bundle.min.js"></script>
	<script src="assets/plugins/simplebar/simplebar.min.js"></script>
	<script src="assets/plugins/jquery-zoom/jquery.zoom.min.js"></script>
	<script src="assets/plugins/slick/slick.min.js"></script>

	<!-- Data Tables -->
	<script src='assets/plugins/data-tables/jquery.datatables.min.js'></script>
	<script src='assets/plugins/data-tables/datatables.bootstrap5.min.js'></script>
	<script src='assets/plugins/data-tables/datatables.responsive.min.js'></script>

	<!-- Option Switcher -->
	<script src="assets/plugins/options-sidebar/optionswitcher.js"></script>

	<script src="assets/js/form-validate2.js"></script>
	<script src="assets/sweetalert2/sweetalert2.min.js"></script>

	<!-- Shop Custom -->
	<script src="assets/js/main.js"></script>
	<script type="text/javascript">
		$(document).ready(function(){
			$(document).on('click','.edit_data5',function(){
				var edit_id5=$(this).attr('id');
				$.ajax({
					url:"edit-user.php",
					type:"post",
					data:{edit_id5:edit_id5},
					success:function(data){
						$("#info_update5").html(data);
						$("#editData5").modal('show');
					}
				});
			});
		});
	</script>
</body>

</html>