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
	$query=mysqli_query($con,"delete from productreviews where id='$subid'");
	echo "<script>alert('review deleted permanently.');</script>";   
	echo "<script>window.location.href='review-list.php'</script>";
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

	<!-- PLUGINS CSS STYLE -->
	<link href='assets/plugins/data-tables/datatables.bootstrap5.min.css' rel='stylesheet'>
	<link href='assets/plugins/data-tables/responsive.datatables.min.css' rel='stylesheet'>

	<!-- Shop CSS -->
	<link id="Shop-css" href="assets/css/style.css" rel="stylesheet" />

	<!-- FAVICON -->
	<link href="assets/img/favicon.png" rel="shortcut icon" />
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
					<div class="breadcrumb-wrapper breadcrumb-wrapper-2 d-flex align-items-center justify-content-between">
						<h1>Review</h1>
						<p class="breadcrumbs"><span><a href="dashboard.php">Home</a></span>
							<span><i class="mdi mdi-chevron-right"></i></span>Review
						</p>
					</div>
					<!-- start modal -->
					<div class="modal fade"  id="editData5" tabindex="-1" role="dialog" aria-hidden="true">
						<div class="modal-dialog modal-dialog-centered modal-md" role="document">
							<div class="modal-content">

								<div class="modal-header px-4">
									<h5 class="modal-title" id="exampleModalCenterTitle">View review</h5>
								</div>

								<div class="modal-body px-4" id="info_update5">

									<?php @include("view-review.php");?>
								</div>
							</div>
						</div>
					</div>
					<!-- end modal -->
					<div class="row">
						<div class="col-12">
							<div class="card card-default">
								<div class="card-body">
									<div class="table-responsive">
										<table id="responsive-data-table" class="table" style="width:100%">
											<thead>
												<tr>
													<th>Product</th>
													<th>Name</th>
													<th>Profile</th>
													<th>Vendor</th>
													<th>Ratings</th>
													<th>Date</th>
													<th>Action</th>
												</tr>
											</thead>

											<tbody>
												<?php
												$sql="SELECT productreviews.*,tblproducts.id as pid,tblproducts.ProductName as product,tblproducts.ProductImage from productreviews join tblproducts on tblproducts.id=productreviews.productid ";
												$query = $dbh -> prepare($sql);
												$query->execute();
												$results=$query->fetchAll(PDO::FETCH_OBJ);
												if($query->rowCount() > 0)
												{
													foreach($results as $row)
														{  ?>
															<tr>
																<td><img class="tbl-thumb" src="productimages/<?php echo htmlentities($row->ProductImage);?>" alt="product image"/></td>
																<td><?php  echo $row->product;?></td>
																<td><img class="tbl-thumb" src="assets/img/user/u5.jpg" alt="product image"/></td>
																<td><?php  echo $row->name;?></td>
																<td>
																	<?php
																	if ($row->rating=='5') {?>
																		<div class="ec-t-rate">
																			<i class="mdi mdi-star is-rated"></i>
																			<i class="mdi mdi-star is-rated"></i>
																			<i class="mdi mdi-star is-rated"></i>
																			<i class="mdi mdi-star is-rated"></i>
																			<i class="mdi mdi-star is-rated"></i>
																		</div>
																		<?php
																	}else if($row->rating=='4') {?>
																		<div class="ec-t-rate">
																			<i class="mdi mdi-star is-rated"></i>
																			<i class="mdi mdi-star is-rated"></i>
																			<i class="mdi mdi-star is-rated"></i>
																			<i class="mdi mdi-star is-rated"></i>
																			<i class="mdi mdi-star"></i>
																		</div>
																		<?php
																	}else if($row->rating=='3') {?>
																		<div class="ec-t-rate">
																			<i class="mdi mdi-star is-rated"></i>
																			<i class="mdi mdi-star is-rated"></i>
																			<i class="mdi mdi-star is-rated"></i>
																			<i class="mdi mdi-star "></i>
																			<i class="mdi mdi-star"></i>
																		</div>
																		<?php
																	}else if($row->rating=='2') {?>
																		<div class="ec-t-rate">
																			<i class="mdi mdi-star is-rated"></i>
																			<i class="mdi mdi-star is-rated"></i>
																			<i class="mdi mdi-star "></i>
																			<i class="mdi mdi-star "></i>
																			<i class="mdi mdi-star"></i>
																		</div>
																		<?php
																	}else if($row->rating=='1') {?>
																		<div class="ec-t-rate">
																			<i class="mdi mdi-star is-rated"></i>
																			<i class="mdi mdi-star "></i>
																			<i class="mdi mdi-star "></i>
																			<i class="mdi mdi-star "></i>
																			<i class="mdi mdi-star"></i>
																		</div>
																		<?php
																	}
																	?>

																</td>
																<td><?php  echo htmlentities(date("d-m-Y", strtotime($row->reviewDate)));?></td>
																<td>
																	<div class="btn-group mb-1">
																		<button type="button"
																		class="btn btn-outline-success">Info</button>
																		<button type="button"
																		class="btn btn-outline-success dropdown-toggle dropdown-toggle-split"
																		data-bs-toggle="dropdown" aria-haspopup="true"
																		aria-expanded="false" data-display="static">
																		<span class="sr-only">Info</span>
																	</button>

																	<div class="dropdown-menu">
																		<a class="dropdown-item edit_data5" id="<?php echo  ($row->id); ?>" href="#">View</a>
																		<a class="dropdown-item" href="review-list.php?del=<?php echo ($row->id);?>" onclick="return confirm('Do you really want to delete?');">Delete</a>
																	</div>
																</div>
															</td>
														</tr>
														<?php
													}
												}?>

											</tbody>
										</table>
									</div>
								</div>
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

	<!-- Shop Custom -->
	<script src="assets/js/main.js"></script>
	<script type="text/javascript">
		$(document).ready(function(){
			$(document).on('click','.edit_data5',function(){
				var edit_id5=$(this).attr('id');
				$.ajax({
					url:"view-review.php",
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