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
					<div class="breadcrumb-wrapper breadcrumb-wrapper-2">
						<h1>Invoice</h1>
						<p class="breadcrumbs"><span><a href="dashboard.php">Home</a></span>
							<span><i class="mdi mdi-chevron-right"></i></span>Invoice
						</p>
					</div>
					<div class="card invoice-wrapper border-radius border bg-white p-4">
						<div class="d-flex justify-content-between">
							<h3 class="text-dark font-weight-medium">Invoice #<?php echo intval($_GET['invid']); ?></h3>

							<div class="btn-group">
								<a href="generatepdf.php?search=<?php  echo intval($_GET['invid']);?>&userid=<?php  echo intval($_GET['uid']);?> " target="_blank">
									<button class="btn btn-sm btn-primary">
										<i class="mdi mdi-content-save"></i>Generate pdf
									</button> &nbsp;
								</a>

								<a href="generatepdf.php?search=<?php  echo intval($_GET['invid']);?>&userid=<?php  echo intval($_GET['uid']);?>">
									<button class="btn btn-sm btn-primary">
										<i class="mdi mdi-printer"></i> Print
									</button>
								</a>
							</div>
						</div>

						<div class="row pt-5">
							<div class="col-xl-3 col-lg-4 col-sm-6">
								<p class="text-dark mb-2">From</p>
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
										<address>
											<span><?php echo $row->companyname;?></span>
											<br> <?php echo $row->companyaddress;?>
											<br> <span>Email:</span> <?php echo $row->companyemail;?>
											<br> <span>Phone:</span> 0<?php echo $row->companyphone;?>
										</address>
										<?php
									}

								}
								?>
							</div>
							<div class="col-xl-3 col-lg-4 col-sm-6">
								<p class="text-dark mb-2">To</p>
								<?php 
								$inid=intval($_GET['invid']);
								$query=mysqli_query($con,"SELECT *  from users join orders on orders.userid=users.id where orders.InvoiceNumber='$inid' limit 1");
								while($row=mysqli_fetch_array($query))
								{    
									?> 
									<address>
										<span><?php echo $row['name'];?></span>
										<br> <?php echo $row['billingAddress'];?>,<?php echo $row['billingCity'];?>,<?php echo $row['billingCountry'];?>.
										<br> <span>Email</span>: <?php echo $row['email'];?>
										<br> <span>Phone:</span> 0<?php echo $row['contactno'];?>
									</address>
									<?php
								} ?>
							</div>
							<div class="col-xl-4 disp-none"></div>
							<div class="col-xl-2 col-lg-4 col-sm-6">
								<p class="text-dark mb-2">Details</p>

								<address>
									<span>Invoice ID:</span>
									<span class="text-dark">#<?php echo intval($_GET['invid']); ?></span>
									<br><span>Date :</span> <?php echo date('d/m/y'); ?>
									<br> <span>VAT:</span> 10%
								</address>
							</div>
						</div>

						<div class="table-responsive">
							<table class="table mt-3 table-striped table-responsive table-responsive-large inv-tbl" style="width:100%">
								<thead>
									<tr>
										<th>#</th>
										<th>Image</th>
										<th>Item</th>
										<th>Quantity</th>
										<th>Unit_Cost</th>
										<th>Total</th>
									</tr>
								</thead>

								<tbody>
									<?php 
									$inid=intval($_GET['invid']);
									$query=mysqli_query($con,"SELECT tblproducts.ProductName,tblproducts.ProductImage,tblproducts.ProductPrice,orders.quantity  from orders join tblproducts on tblproducts.id=orders.productid where orders.InvoiceNumber='$inid'");
									$cnt=1;
									while($row=mysqli_fetch_array($query))
									{    
										?> 
										<tr>
											<td><?php echo $cnt;?></td>
											<td><img class="invoice-item-img" src="productimages/<?php echo htmlentities($row['ProductImage']);?>" alt="product-image" /></td>
											<td><?php echo $row['ProductName'];?></td>
											<td><?php echo $qty=$row['quantity'];?></td>
											<td>$&nbsp;<?php echo number_format($ppu=$row['ProductPrice'],0);?></td>
											<td>$&nbsp;<?php echo number_format($subtotal=($ppu*$qty),0);?></td>
										</tr>
										<?php
										$grandtotal+=$subtotal; 
										$cnt++;
									} ?>
								</tbody>
							</table>
						</div>
						<div class="row justify-content-end inc-total">
							<div class="col-lg-3 col-xl-3 col-xl-3 ml-sm-auto">
								<ul class="list-unstyled mt-3">
									<li class="mid pb-3 text-dark"> Subtotal
										<span class="d-inline-block float-right text-default">$&nbsp;<?php echo number_format($grandtotal,0);?></span>
									</li>

									<li class="mid pb-3 text-dark">Vat(10%)
										<span class="d-inline-block float-right text-default">$<?php echo number_format((0.1*$grandtotal),0);?></span>
									</li>

									<li class="pb-3 text-dark">Total
										<span class="d-inline-block float-right">$<?php echo number_format(((0.1*$grandtotal)+$grandtotal),0);?></span>
									</li>
								</ul>

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