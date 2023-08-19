<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');
if(strlen($_SESSION['odmsaid'])==0)
{	
	header('location:index.php');
}
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
	<meta charset="utf-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
	<meta name="viewport" content="width=device-width, initial-scale=1" />
	<meta name="description" content="Shop - Admin Dashboard HTML Template.">

	<title>Electronic Shop- Admin Dashboard.</title>

	<!-- GOOGLE FONTS -->
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@200;300;400;500;600;700;800&family=Poppins:wght@300;400;500;600;700;800;900&family=Roboto:wght@400;500;700;900&display=swap" rel="stylesheet">

	<link rel="stylesheet" href="assets/mdi/css/materialdesignicons.min.css">
	
	<!-- PLUGINS CSS STYLE -->
	<link href="assets/plugins/simplebar/simplebar.css" rel="stylesheet" />

	<!-- Shop CSS -->
	<link id="Shop-css" rel="stylesheet" href="assets/css/style.css" />
	<link id="Shop-css" rel="stylesheet" href="assets/css/form-validate.css" />

	<link rel="stylesheet" type="text/css" href="assets/sweetalert2/sweetalert2.min.css">

	<!-- FAVICON -->
	<link href="assets/img/favicon.png" rel="shortcut icon" />
	<script>
		function getSubcat(val) {
			$.ajax({
				type: "POST",
				url: "get_subcat.php",
				data:'cat_id='+val,
				success: function(data){
					$("#subcategory").html(data);
				}
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
					<div class="breadcrumb-wrapper d-flex align-items-center justify-content-between">
						<div>
							<h1>Add Product</h1>
							<p class="breadcrumbs">
								<span><a href="dashboard.php">Home</a></span>
								<span><i class="mdi mdi-chevron-right"></i></span>Product
							</p>
						</div>
						<div>
							<a href="product-list.php" class="btn btn-primary"> View All
							</a>
						</div>
					</div>
					<div class="row">
						<div class="col-12">
							<div class="card card-default">
								<div class="card-header card-header-border-bottom">
									<h2>Add Product</h2>
								</div>

								<div class="card-body">
									<div class="row ec-vendor-uploads">
										<form class="row g-3" method="post"  id="fruitkha-contact"  enctype="multipart/form-data">
											<div class="col-lg-4">
												<div class="ec-vendor-img-upload">
													<div class="ec-vendor-main-img">
														<div class="avatar-upload">
															<div class="avatar-edit">
																<input type='file' name="imageUpload" id="imageUpload" class="ec-image-upload"
																accept=".png, .jpg, .jpeg" />
																<label for="imageUpload"><img
																	src="assets/img/icons/edit.svg"
																	class="svg_img header_svg" alt="edit" />
																</label>
															</div>
															<div class="avatar-preview ec-preview">
																<div class="imagePreview ec-div-preview">
																	<img class="ec-image-preview"
																	src="assets/img/products/vender-upload-preview.jpg"
																	alt="edit" />
																</div>
															</div>
														</div>
														<div class="thumb-upload-set colo-md-12">
															<div class="thumb-upload">
																<div class="thumb-edit">
																	<input type='file' name="image1" id="image1"
																	class="ec-image-upload"
																	accept=".png, .jpg, .jpeg" />
																	<label for="imageUpload"><img
																		src="assets/img/icons/edit.svg"
																		class="svg_img header_svg" alt="edit" />
																	</label>
																</div>
																<div class="thumb-preview ec-preview">
																	<div class="image-thumb-preview">
																		<img class="image-thumb-preview ec-image-preview"
																		src="assets/img/products/vender-upload-thumb-preview.jpg"
																		alt="edit" />
																	</div>
																</div>
															</div>
															<div class="thumb-upload">
																<div class="thumb-edit">
																	<input type='file' name="image2" id="image2"
																	class="ec-image-upload"
																	accept=".png, .jpg, .jpeg" />
																	<label for="imageUpload"><img
																		src="assets/img/icons/edit.svg"
																		class="svg_img header_svg" alt="edit" />
																	</label>
																</div>
																<div class="thumb-preview ec-preview">
																	<div class="image-thumb-preview">
																		<img class="image-thumb-preview ec-image-preview"
																		src="assets/img/products/vender-upload-thumb-preview.jpg"
																		alt="edit" />
																	</div>
																</div>
															</div>
															<div class="thumb-upload">
																<div class="thumb-edit">
																	<input type='file' name="image3" id="image3"
																	class="ec-image-upload"
																	accept=".png, .jpg, .jpeg" />
																	<label for="imageUpload"><img
																		src="assets/img/icons/edit.svg"
																		class="svg_img header_svg" alt="edit" />
																	</label>
																</div>
																<div class="thumb-preview ec-preview">
																	<div class="image-thumb-preview">
																		<img class="image-thumb-preview ec-image-preview"
																		src="assets/img/products/vender-upload-thumb-preview.jpg"
																		alt="edit" />
																	</div>
																</div>
															</div>
														</div>
													</div>
												</div>
											</div>

											<div class="col-lg-8">
												<div class="ec-vendor-upload-detail">
													<div id="form_status"></div>
													<div class="row col-md-12 mt-4">
														<div class="col-md-12">
															<label for="inputEmail4" class="form-label">Product name</label>
															<input type="text" name="product" id="product" class="form-control" required>
														</div>
													</div>
													<div class="row col-md-12 mt-4">
														<div class="col-md-6">
															<label class="form-label">Select Brand</label>
															<select  name="brand" id="brand"  class="form-control" required>
																<option value="">Select brand</option>
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
																		<option value="<?php  echo $row->id;?>">
																			<?php  echo $row->BrandName;?>

																		</option>
																		<?php 
																	}
																} ?>
															</select>
														</div>
														<div class="col-md-6">
															<label for="inputEmail4" class="form-label">Discount</label>
															<input type="number" name="discount" id="discount" class="form-control ">
														</div>
													</div>
													<div class="row col-md-12 mt-4">
														<div class="col-md-6">
															<label class="form-label">Select Categories</label>
															<select  name="category" id="category" onChange="getSubcat(this.value);" class="form-control" required>
																<option value="">Select Category</option>
																<?php
																$sql="SELECT * from  tblcategory";
																$query = $dbh -> prepare($sql);
																$query->execute();
																$results=$query->fetchAll(PDO::FETCH_OBJ);
																if($query->rowCount() > 0)
																{
																	foreach($results as $row)
																	{
																		?> 
																		<option value="<?php  echo $row->id;?>">
																			<?php  echo $row->CategoryName;?>

																		</option>
																		<?php 
																	}
																} ?>
															</select>
														</div>
														<div class="col-md-6">
															<label class="form-label">Select Sub-Categories</label>
															<select  name="subcategory" id="subcategory" class="form-control" required>

															</select>
														</div>
													</div>
													<div class="row col-md-12 mt-4">
														<div class="col-md-6">
															<label class="form-label">Price <span>( In USD
															)</span></label>
															<input type="number" class="form-control" name="price1" id="price1" required>
														</div>
														<div class="col-md-6">
															<label class="form-label">Price Before <span>( In USD
															)</span></label>
															<input type="number" class="form-control" name="price2" id="price2" required>
														</div>
													</div>
													<div class="row col-md-12 mt-4">
														<div class="col-md-6">
															<label class="form-label">Select Status</label>
															<select  name="status" id="status"  class="form-control" required>
																<option value="">Select status</option>
																<option value="New">New Arrivals</option>
																<option value="Special">Special Offer</option>
																<option value="Best">Best Sellers</option>
															</select>
														</div>
														<div class="col-md-6">
															<label class="form-label">Quantity </label>
															<input type="number" class="form-control" name="quantity" id="quantity" required>
														</div>
													</div>
													
													<div class="col-md-12 mt-4">
														<label class="form-label">Specifications</label>
														<textarea class="form-control" name="details" id="details" rows="4" required></textarea>
													</div>
													<div class="col-md-12 mt-4">
														<label class="form-label">Details</label>
														<textarea class="form-control" name="description" id="description" rows="4"></textarea>
													</div>
													<div class="col-md-12 mt-4">
														<label class="form-label">Product Tags <span>( Type and
														make comma to separate tags )</span></label>
														<input type="text" class="form-control" id="group_tag"
														name="group_tag" value="" placeholder=""
														data-role="tagsinput" />
													</div>
													<input type="hidden" name="token" value="FsWga4&@f6aw" />
													<div class="col-md-12">
														<button type="submit" name="submit" class="btn btn-primary">Submit</button>
													</div>
												</div>
											</div>
										</form>
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

	<!-- Option Switcher -->
	<script src="assets/plugins/options-sidebar/optionswitcher.js"></script>

	<!-- form validation js -->
	<script src="assets/js/form-validate.js"></script>
	<script src="assets/sweetalert2/sweetalert2.min.js"></script>

	<!-- Shop Custom -->
	<script src="assets/js/main.js"></script>
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
		$category=$_POST['category'];
		$product=$_POST['product'];
		$brand=$_POST['brand'];
		$quantity=$_POST['quantity'];
		$status=$_POST['status'];
		$discount=$_POST['discount'];
		$subcategory=$_POST['subcategory'];
		$price1=$_POST['price1'];
		$price2=$_POST['price2'];
		$group_tag=$_POST['group_tag'];
		$details=$_POST['details'];
		$description=$_POST['description'];
		$image=$_FILES["imageUpload"]["name"];
		$image1=$_FILES["image1"]["name"];
		$image2=$_FILES["image2"]["name"];
		$image3=$_FILES["image3"]["name"];
		move_uploaded_file($_FILES["imageUpload"]["tmp_name"],"productimages/".$_FILES["imageUpload"]["name"]);
		move_uploaded_file($_FILES["image1"]["tmp_name"],"productimages/".$_FILES["image1"]["name"]);
		move_uploaded_file($_FILES["image2"]["tmp_name"],"productimages/".$_FILES["image2"]["name"]);
		move_uploaded_file($_FILES["image3"]["tmp_name"],"productimages/".$_FILES["image3"]["name"]);
		$sql="insert into tblproducts(CategoryName,ProductName,ProductPrice,PriceBefore,productDetails,productDescription,Grouptag,BrandName,ProductDiscount,Subcategory,ProductImage,Quantity,Status,ProductImage2,ProductImage3,ProductImage4)values(:category,:product,:price1,:price2,:details,:description,:group_tag,:brand,:discount,:subcategory,:image,:quantity,:status,:image1,:image2,:image3)";
		$query=$dbh->prepare($sql);
		$query->bindParam(':category',$category,PDO::PARAM_STR);
		$query->bindParam(':product',$product,PDO::PARAM_STR);
		$query->bindParam(':brand',$brand,PDO::PARAM_STR);
		$query->bindParam(':quantity',$quantity,PDO::PARAM_STR);
		$query->bindParam(':status',$status,PDO::PARAM_STR);
		$query->bindParam(':discount',$discount,PDO::PARAM_STR);
		$query->bindParam(':subcategory',$subcategory,PDO::PARAM_STR);
		$query->bindParam(':image',$image,PDO::PARAM_STR);
		$query->bindParam(':image1',$image1,PDO::PARAM_STR);
		$query->bindParam(':image2',$image2,PDO::PARAM_STR);
		$query->bindParam(':image3',$image3,PDO::PARAM_STR);
		$query->bindParam(':price1',$price1,PDO::PARAM_STR);
		$query->bindParam(':price2',$price2,PDO::PARAM_STR);
		$query->bindParam(':details',$details,PDO::PARAM_STR);
		$query->bindParam(':description',$description,PDO::PARAM_STR);
		$query->bindParam(':group_tag',$group_tag,PDO::PARAM_STR);
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
					location.href = 'product-add.php'
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
</body>

</html>