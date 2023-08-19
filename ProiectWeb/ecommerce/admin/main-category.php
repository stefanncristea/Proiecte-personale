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
	$query=mysqli_query($con,"delete from tblcategory where id='$subid'");
	echo "<script>alert('Category deleted permanently.');</script>";   
	echo "<script>window.location.href='main-category.php'</script>";
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
					<div class="breadcrumb-wrapper breadcrumb-wrapper-2 breadcrumb-contacts">
						<h1>Main Category</h1>
						<p class="breadcrumbs"><span><a href="dashboard.php">Home</a></span>
							<span><i class="mdi mdi-chevron-right"></i></span>Main Category</p>
						</div>
						<div class="row">
							<div class="col-xl-4 col-lg-12">
								<div class="ec-cat-list card card-default mb-24px">
									<div class="card-body">
										<div class="ec-cat-form">
											<h4>Add New Category</h4>

											<div id="form_status"></div>
											<form  method="post" id="cartegory-form" onSubmit="return valid_datas( this );" enctype="multipart/form-data">

												<div class="form-group row">
													<label for="text" class="col-12 col-form-label">Category Name</label> 
													<div class="col-12">
														<input id="category" name="category" class="form-control here slug-title" type="text">
													</div>
												</div>
												<div class="form-group row">
													<label class="col-12 col-form-label">Description</label> 
													<div class="col-12">
														<textarea id="description" name="description" cols="40" rows="4" class="form-control"></textarea>
													</div>
												</div> 

												<div class="form-group row">
													<label class="col-12 col-form-label">Product Tags <span>( Type and
													make comma to separate tags )</span></label>
													<div class="col-12">
														<input type="text" class="form-control" id="tag" name="tag" value="" placeholder="" data-role="tagsinput">
													</div>
													<input type="hidden" name="token" value="FsWga4&@f6aw" />
												</div>

												<div class="row">
													<div class="col-12">
														<button name="submit" type="submit" class="btn btn-primary">Submit</button>
													</div>
												</div>

											</form>

										</div>
									</div>
								</div>
							</div>
							<!-- start modal -->
							<div class="modal fade"  id="editData5" tabindex="-1" role="dialog" aria-hidden="true">
								<div class="modal-dialog modal-dialog-centered modal-md" role="document">
									<div class="modal-content">

										<div class="modal-header px-4">
											<h5 class="modal-title" id="exampleModalCenterTitle">Edit Category</h5>
										</div>

										<div class="modal-body px-4" id="info_update5">

											<?php @include("edit-category.php");?>
										</div>
									</div>
								</div>
							</div>
							<!-- end modal -->
							<div class="col-xl-8 col-lg-12">
								<div class="ec-cat-list card card-default">
									<div class="card-body">
										<div class="table-responsive">
											<table id="responsive-data-table" class="table">
												<thead>
													<tr>
														<th>Name</th>
														<th>Sub Categories</th>
														<th>Product</th>
														<th>Trending</th>
														<th>Action</th>
													</tr>
												</thead>

												<tbody>
													<?php
													$sql="SELECT* from tblcategory  ORDER BY id DESC";
													$query = $dbh -> prepare($sql);
													$query->execute();
													$results=$query->fetchAll(PDO::FETCH_OBJ);
													if($query->rowCount() > 0)
													{
														foreach($results as $row)
														{ 
															?>
															<tr>
																<td><?php  echo htmlentities($row->CategoryName);?></td>
																<td>
																	<span class="ec-sub-cat-list">
																		<?php 
																		$idd=$row->id;
																		$sql2 ="SELECT id from subcategory where categoryid='$idd'";
																		$query2 = $dbh -> prepare($sql2);
																		$query2->execute();
																		$results2=$query2->fetchAll(PDO::FETCH_OBJ);
																		$totalunreadquery=$query2->rowCount();
																		?>
																		<span class="ec-sub-cat-count" title="Total Sub Categories"><?php echo htmlentities($totalunreadquery);?></span>
																		<?php
																		$idd=$row->id;
																		$sql4="SELECT* from subcategory  where categoryid='$idd'";
																		$query4 = $dbh -> prepare($sql4);
																		$query4->execute();
																		$results4=$query4->fetchAll(PDO::FETCH_OBJ);
																		if($query4->rowCount() > 0)
																		{
																			foreach($results4 as $row4)
																			{ 
																				?>
																				<span class="ec-sub-cat-tag"><?php  echo htmlentities($row4->subcategory);?></span>
																				<?php 
																			}
																		} ?>
																	</span>
																</td>
																<?php 
																$cat=$row->id;
																$sql7 ="SELECT id from tblproducts where CategoryName='$cat'";
																$query7 = $dbh -> prepare($sql7);
																$query7->execute();
																$results7=$query7->fetchAll(PDO::FETCH_OBJ);
																$totalunreadquery=$query7->rowCount();
																?>
																<td><?php echo htmlentities($totalunreadquery);?></td>
																<td><span class="badge badge-success">Top</span></td>
																<td>
																	<div class="btn-group">
																		<button type="button"
																		class="btn btn-outline-success">Info</button>
																		<button type="button"
																		class="btn btn-outline-success dropdown-toggle dropdown-toggle-split"
																		data-bs-toggle="dropdown" aria-haspopup="true"
																		aria-expanded="false" data-display="static">
																		<span class="sr-only">Info</span>
																	</button>

																	<div class="dropdown-menu">
																		<a class="dropdown-item edit_data5" id="<?php echo  ($row->id); ?>" href="#">Edit</a>
																		<a class="dropdown-item" href="main-category.php?del=<?php echo ($row->id);?>" onclick="return confirm('Do you really want to delete?');">Delete</a>
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
	<script src="assets/plugins/tags-input/bootstrap-tagsinput.js"></script>
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
	<script src="assets/js/form-validate-category.js"></script>
	<script src="assets/js/main.js"></script>
	<script src="assets/sweetalert2/sweetalert2.min.js"></script>
	<script type="text/javascript">
		$(document).ready(function(){
			$(document).on('click','.edit_data5',function(){
				var edit_id5=$(this).attr('id');
				$.ajax({
					url:"edit-category.php",
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