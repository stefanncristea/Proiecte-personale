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

	<title>Electronic Shop - Admin Dashboard HTML Template.</title>

	<!-- GOOGLE FONTS -->
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@200;300;400;500;600;700;800&family=Poppins:wght@300;400;500;600;700;800;900&family=Roboto:wght@400;500;700;900&display=swap" rel="stylesheet">

	<link rel="stylesheet" href="assets/mdi/css/materialdesignicons.min.css">

	<!-- PLUGINS CSS STYLE -->
	<link href="assets/plugins/simplebar/simplebar.css" rel="stylesheet" />

	<!-- Shop CSS -->
	<link id="Shop-css" rel="stylesheet" href="assets/css/style.css" />

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
					<div class="breadcrumb-wrapper breadcrumb-wrapper-2">
						<h1>Order Detail</h1>
						<p class="breadcrumbs"><span><a href="dashboard.php">Home</a></span>
							<span><i class="mdi mdi-chevron-right"></i></span>Orders
						</p>
					</div>
					<div class="row">
						<div class="col-12">
							<div class="ec-odr-dtl card card-default">
								<div class="card-header card-header-border-bottom d-flex justify-content-between">
									<h2 class="ec-odr">Order Detail<br>
										<span class="small">Order ID: #<?php echo $_GET['invid'];?></span>
									</h2>
								</div>
								<div class="card-body">
									<?php
									$user=($_GET['uid']);
									$sql2="SELECT users.name,users.email,users.contactno,users.billingAddress,orders.paymentMethod,orders.orderDate from users join orders on orders.userId=users.id where users.id='$user' limit 1 ";
									$query2 = $dbh -> prepare($sql2);
									$query2->execute();
									$results2=$query2->fetchAll(PDO::FETCH_OBJ);
									if($query2->rowCount() > 0)
									{
										foreach($results2 as $row2)
											{  ?>
												<div class="row">
													<div class="col-xl-3 col-lg-6">
														<address class="info-grid">
															<div class="info-title"><strong>Customer ID:&nbsp;<?php echo $user;?></strong></div><br>
															<div class="info-content">
																<?php echo $row2->name;?>.<br>
																<?php echo $row2->email;?><br>
																<?php echo $row2->billingAddress;?><?php echo $row2->billingCountry;?><br>
																0<?php echo $row2->contactno;?>
															</div>
														</address>
													</div>
													<div class="col-xl-3 col-lg-6">
														<address class="info-grid">
															<div class="info-title"><strong>Shipped To:</strong></div><br>
															<div class="info-content">
																<?php echo $row2->email;?><br>
																<?php echo $row2->billingAddress;?><br>
																<?php echo $row2->billingCity;?><?php echo $row2->billingCountry;?>
																0 <?php echo $row2->contactno;?>
															</div>
														</address>
													</div>
													<div class="col-xl-3 col-lg-6">
														<address class="info-grid">
															<div class="info-title"><strong>Payment Method:</strong></div><br>
															<div class="info-content">
																<?php echo $row2->paymentMethod;?>
															</div>
														</address>
													</div>
													<div class="col-xl-3 col-lg-6">
														<address class="info-grid">
															<div class="info-title"><strong>Order Date:</strong></div><br>
															<div class="info-content">
																<?php  echo htmlentities(date("d-m-Y", strtotime($row2->orderDate)));?>
															</div>
														</address>
													</div>
												</div>
												<?php
											}
										}
										?>
										<div class="row">
											<div class="col-md-12">
												<h3 class="tbl-title">PRODUCT SUMMARY</h3>
												<div class="table-responsive">
													<table class="table table-striped o-tbl">
														<thead>
															<tr class="line">
																<td><strong>#</strong></td>
																<td class="text-center"><strong>IMAGE</strong></td>
																<td class="text-center"><strong>PRODUCT</strong></td>
																<td class="text-center"><strong>PRICE/UNIT</strong></td>
																<td class="text-right"><strong>QUANTITY</strong></td>
																<td class="text-right"><strong>SUBTOTAL</strong></td>
															</tr>
														</thead>
														<tbody>
															<?php 
															$inid=intval($_GET['invid']);
															$query=mysqli_query($con,"SELECT tblproducts.ProductName,tblproducts.ProductPrice,tblproducts.ProductImage,orders.quantity  from orders join tblproducts on tblproducts.id=orders.productid where orders.InvoiceNumber='$inid'");
															$cnt=1;
															while($row=mysqli_fetch_array($query))
															{    
																?> 
																<tr>
																	<td>1</td>
																	<td><img class="product-img"
																		src="productimages/<?php echo htmlentities($row['ProductImage']);?>" alt="" />
																	</td>
																	<td><strong>B<?php echo $row['ProductName'];?></strong><br>a vary smooth and
																	comfert Shoes ever for baby.</td>
																	<td class="text-center"><?php echo $qty=$row['quantity'];?></td>
																	<td class="text-center">$&nbsp;<?php echo $ppu=$row['ProductPrice'];?></td>
																	<td class="text-right">$<?php echo $subtotal=($ppu*$qty);?></td>
																</tr>
																<?php
																$grandtotal+=$subtotal; 
																$cnt++;
															} ?>
															<tr>
																<td colspan="4"></td>
																<td class="text-right"><strong>Taxes</strong></td>
																<td class="text-right"><strong>N/A</strong></td>
															</tr>
															<tr>
																<td colspan="4">
																</td>
																<td class="text-right"><strong>Total</strong></td>
																<td class="text-right"><strong>$&nbsp;<?php echo number_format($grandtotal,0);?></strong></td>
															</tr>

															<tr>
																<td colspan="4">
																</td>
																<td class="text-right"><strong>Payment Status</strong></td>
																<td class="text-right"><strong>PAID</strong></td>
															</tr>
														</tbody>
													</table>
												</div>
											</div>
										</div>
									</div>
								</div>
								<!-- Tracking Detail -->
								<div class="card mt-4 trk-order">
									<div class="p-4 text-center text-white text-lg bg-dark rounded-top">
										<span class="text-uppercase">Tracking Order No - </span>
										<span class="text-medium"><?php echo $inid;?></span>
									</div>
									<div class="d-flex flex-wrap flex-sm-nowrap justify-content-between py-3 px-2 bg-secondary">
										<div class="w-100 text-center py-1 px-2">
											<span class="text-medium">Shipped
												Via:
											</span> Evergreen Ground
										</div>
										<div class="w-100 text-center py-1 px-2">
											<span class="text-medium">Status:</span>
											Checking Quality
										</div>
										<div class="w-100 text-center py-1 px-2">
											<span class="text-medium">Expected
												Date:
											</span> DEC 09, 2022
										</div>
									</div>
									<div class="card-body">
										<div class="steps d-flex flex-wrap flex-sm-nowrap justify-content-between padding-top-2x padding-bottom-1x">
											<div class="step completed">
												<div class="step-icon-wrap">
													<div class="step-icon"><i class="mdi mdi-cart"></i></div>
												</div>
												<h4 class="step-title">Confirmed Order</h4>
											</div>
											<div class="step completed">
												<div class="step-icon-wrap">
													<div class="step-icon"><i class="mdi mdi-tumblr-reblog"></i></div>
												</div>
												<h4 class="step-title">Processing Order</h4>
											</div>
											<div class="step completed">
												<div class="step-icon-wrap">
													<div class="step-icon"><i class="mdi mdi-gift"></i></div>
												</div>
												<h4 class="step-title">Product Dispatched</h4>
											</div>
											<div class="step">
												<div class="step-icon-wrap">
													<div class="step-icon"><i class="mdi mdi-truck-delivery"></i></div>
												</div>
												<h4 class="step-title">On Delivery</h4>
											</div>
											<div class="step">
												<div class="step-icon-wrap">
													<div class="step-icon"><i class="mdi mdi-hail"></i></div>
												</div>
												<h4 class="step-title">Product Delivered</h4>
											</div>
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

		<!-- Option Switcher -->
		<script src="assets/plugins/options-sidebar/optionswitcher.js"></script>

		<!-- Shop Custom -->
		<script src="assets/js/main.js"></script>
	</body>
	</html>