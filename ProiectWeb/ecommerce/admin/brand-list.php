<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');
if(strlen($_SESSION['odmsaid'])==0)
{	
	header('location:index.php');
}
if(isset($_GET['del'])){    
	$subid=$_GET['del'];
	$query=mysqli_query($con,"delete from tblbrand where id='$subid'");
	echo "<script>alert('Brand deleted permanently.');</script>";   
	echo "<script>window.location.href='brand-list.php'</script>";
}
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
	<meta charset="utf-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
	<meta name="viewport" content="width=device-width, initial-scale=1" />
	<meta name="description" content="shop - Admin Dashboard HTML Template.">

	<title>Electronic Shop - Admin Dashboard HTML Template.</title>

	<!-- GOOGLE FONTS -->
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@200;300;400;500;600;700;800&family=Poppins:wght@300;400;500;600;700;800;900&family=Roboto:wght@400;500;700;900&display=swap" rel="stylesheet">

	<link rel="stylesheet" href="assets/mdi/css/materialdesignicons.min.css">


	<!-- PLUGINS CSS STYLE -->
	<link href="assets/plugins/simplebar/simplebar.css" rel="stylesheet" />

	<!-- PLUGINS CSS STYLE -->
	<link href='assets/plugins/data-tables/datatables.bootstrap5.min.css' rel='stylesheet'>
	<link href='assets/plugins/data-tables/responsive.datatables.min.css' rel='stylesheet'>

	<!-- shop CSS -->
	<link id="shop-css" href="assets/css/style.css" rel="stylesheet" />

	<link rel="stylesheet" type="text/css" href="assets/sweetalert2/sweetalert2.min.css">
	<script src="assets/sweetalert2/sweetalert2.min.js"></script>

	<!-- FAVICON -->
	<link href="assets/img/favicon.png" rel="shortcut icon" />
</head>

<body class="ec-header-fixed ec-sidebar-fixed ec-sidebar-dark ec-header-light" id="body">
	<!-- WRAPPER -->
	<?php
	if(isset($_POST['submit']))
	{
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
	}
	?>
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
					<div class="breadcrumb-wrapper d-flex align-items-center justify-content-between">
						<div>
							<h1>Brand</h1>
							<p class="breadcrumbs"><span><a href="dashboard.php">Home</a></span>
								<span><i class="mdi mdi-chevron-right"></i></span> Brand</p>
							</div>
							<div>
								<button type="button" class="btn btn-primary" data-bs-toggle="modal"
								data-bs-target="#modal-add-member">Add Brand
							</button>
						</div>
					</div>

					<div class="product-brand card card-default p-24px">
						<div class="row mb-m-24px">
							<?php
							$sql="SELECT * from  tblbrand";
							$query = $dbh -> prepare($sql);
							$query->execute();
							$results=$query->fetchAll(PDO::FETCH_OBJ);
							if($query->rowCount() > 0)
							{
								foreach($results as $row)
								{  
									?>
									<div class="col-xxl-2 col-xl-3 col-lg-4 col-md-6">
										<div class="card card-default">
											<div class="card-body text-center p-24px">
												<div class="image mb-3">
													<img src="brandimages/<?php echo htmlentities($row->BrandImage);?>" class="img-fluid rounded-circle"
													alt="brand Image">
												</div>

												<h5 class="card-title text-dark"><?php  echo $row->BrandName;?></h5>
												<?php 
												$brid=$row->id;
												$sql7 ="SELECT id from tblproducts where BrandName='$brid'";
												$query7 = $dbh -> prepare($sql7);
												$query7->execute();
												$results7=$query7->fetchAll(PDO::FETCH_OBJ);
												$totalunreadquery=$query7->rowCount();
												?>
												<p class="item-count"><?php echo htmlentities($totalunreadquery);?><span> items</span></p>
												<a  href="brand-list.php?del=<?php echo ($row->id);?>" onclick="return confirm('Do you really want to delete?');"><span class="brand-delete mdi mdi-delete-outline"></span>
												</a>
												
											</div>
										</div>
									</div>
									<?php 
								}
							} ?>
						</div>
					</div>
				</div>
			</div>

			<!-- Add Contact Button  -->
			<div class="modal fade" id="modal-add-member" tabindex="-1" role="dialog" aria-hidden="true">
				<div class="modal-dialog modal-dialog-centered modal-md" role="document">
					<div class="modal-content">
						<form method="post" id="brand-form"   enctype="multipart/form-data">
							<div id="form_status"></div>
							<div class="modal-header px-4">
								<h5 class="modal-title" id="exampleModalCenterTitle">Add New Brand</h5>
							</div>

							<div class="modal-body px-4">
								<div class="form-group row mb-6">
									<label for="coverImage" class="col-sm-4 col-lg-2 col-form-label">
									Image</label>

									<div class="col-sm-8 col-lg-10">
										<div class="custom-file mb-1">
											<input type="file" class="custom-file-input" name="brandImage" id="brandImage" required
											>
											<label class="custom-file-label" for="brandImage">Choose
											file...</label>
											
										</div>
									</div>
								</div>

								<div class="row mb-2">
									<div class="col-lg-12">
										<div class="form-group">
											<label for="brandName">Brand name</label>
											<input type="text" class="form-control" name="brandName" id="brandName" required>
										</div>
									</div>
									<input type="hidden" name="token" value="FsWga4&@f6aw" />
								</div>
							</div>
							<div class="modal-footer px-4">
								<button type="button" class="btn btn-secondary btn-pill"
								data-bs-dismiss="modal">Cancel</button>
								<button type="submit" name="submit" class="btn btn-primary btn-pill">Add Brand</button>
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

<!-- shop Custom -->
<script src="assets/js/form-validate-brand.js"></script>
<script src="assets/js/main.js"></script>


</body>

</html>