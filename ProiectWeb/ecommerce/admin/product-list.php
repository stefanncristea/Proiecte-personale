<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');
if(strlen($_SESSION['odmsaid'])==0)
{	
	header('location:index.php');
}

if(isset($_GET['del'])){    
	$cmpid=$_GET['del'];
	$query=mysqli_query($con,"delete from tblproducts where id='$cmpid'");
	echo "<script>alert('Product record deleted.');</script>";   
	echo "<script>window.location.href='product-list.php'</script>";
}
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
	<meta charset="utf-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
	<meta name="viewport" content="width=device-width, initial-scale=1" />
	<meta name="description" content="Shop - Admin Dashboard HTML Template.">

	<title>Ectronic Shop - Admin Dashboard HTML Template.</title>

	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@200;300;400;500;600;700;800&family=Poppins:wght@300;400;500;600;700;800;900&family=Roboto:wght@400;500;700;900&display=swap" rel="stylesheet">

	<link href="https://cdn.materialdesignicons.com/4.4.95/css/materialdesignicons.min.css" rel="stylesheet" />

	<!-- PLUGINS CSS STYLE -->
	<link href="assets/plugins/simplebar/simplebar.css" rel="stylesheet" />

	<!-- No Extra plugin used -->

	<link href='assets/plugins/data-tables/datatables.bootstrap5.min.css' rel='stylesheet'>
	<link href='assets/plugins/data-tables/responsive.datatables.min.css' rel='stylesheet'>

	<!-- ekka CSS -->
	<link id="ekka-css" rel="stylesheet" href="assets/css/style.css" />

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
					<div class="breadcrumb-wrapper d-flex align-items-center justify-content-between">
						<div>
							<h1>Product</h1>
							<p class="breadcrumbs"><span><a href="dashboard.php">Home</a></span>
								<span><i class="mdi mdi-chevron-right"></i></span>Product</p>
							</div>
							<div>
								<a href="product-add.php" class="btn btn-primary"> Add Porduct</a>
							</div>
						</div>
						<!-- start modal -->
						<div class="modal fade"  id="editData5" tabindex="-1" role="dialog" aria-hidden="true">
							<div class="modal-dialog modal-dialog-centered modal-md" role="document">
								<div class="modal-content">

									<div class="modal-header px-4">
										<h5 class="modal-title" id="exampleModalCenterTitle">Add New Stock</h5>
									</div>

									<div class="modal-body px-4" id="info_update5">

										<?php @include("product-stockin.php");?>
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
														<th>Price</th>
														<th>Offer</th>
														<th>Stock</th>
														<th>Status</th>
														<th>Date</th>
														<th>Action</th>
													</tr>
												</thead>

												<tbody>
													<?php
													$sql="SELECT * from tblproducts ORDER BY id DESC";
													$query = $dbh -> prepare($sql);
													$query->execute();
													$results=$query->fetchAll(PDO::FETCH_OBJ);
													if($query->rowCount() > 0)
													{
														foreach($results as $row)
														{ 

															?>
															<tr>
																<td><img class="tbl-thumb" src="productimages/<?php echo htmlentities($row->ProductImage);?>" alt="Product Image" /></td>
																<td><?php  echo htmlentities($row->ProductName);?></td>
																<td>$<?php echo htmlentities(number_format($row->ProductPrice, 0, '.', ','));?></td>
																<td><?php  echo htmlentities($row->ProductDiscount);?>% OFF</td>
																<td><?php  echo htmlentities($row->Quantity);?></td>
																<td>ACTIVE</td>
																<td><?php  echo htmlentities(date("d-m-Y", strtotime($row->PostingDate)));?></td>
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
																		<a class="dropdown-item" href="product-edit.php?productid=<?php echo ($row->id) ?>">Edit</a>
																		<a class="dropdown-item edit_data5" href="#"  id="<?php echo  ($row->id); ?>"  >Stock In</a>
																		<a class="dropdown-item" href="product-list.php?del=<?php echo ($row->id);?>" onclick="return confirm('Do you really want to delete?');">Delete</a>
																	</div>
																</div>
															</td>
														</tr>
														<?php 
													}
												} ?>
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

	<!-- Datatables -->
	<script src='assets/plugins/data-tables/jquery.datatables.min.js'></script>
	<script src='assets/plugins/data-tables/datatables.bootstrap5.min.js'></script>
	<script src='assets/plugins/data-tables/datatables.responsive.min.js'></script>

	<!-- Option Switcher -->
	<script src="assets/plugins/options-sidebar/optionswitcher.js"></script>

	<!-- Ekka Custom -->
	<script src="assets/js/main.js"></script>

	<script type="text/javascript">
		$(document).ready(function(){
			$(document).on('click','.edit_data5',function(){
				var edit_id5=$(this).attr('id');
				$.ajax({
					url:"product-stockin.php",
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