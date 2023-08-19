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
	<meta name="description" content="shop - Admin Dashboard eCommerce HTML Template.">

	<title>Electronic shop - Admin Dashboard eCommerce HTML Template..</title>

	<!-- GOOGLE FONTS -->
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@200;300;400;500;600;700;800&family=Poppins:wght@300;400;500;600;700;800;900&family=Roboto:wght@400;500;700;900&display=swap" rel="stylesheet"> 

	<link rel="stylesheet" href="assets/mdi/css/materialdesignicons.min.css">

	<!-- PLUGINS CSS STYLE -->
	<link href="assets/plugins/daterangepicker/daterangepicker.css" rel="stylesheet">
	<link href="assets/plugins/simplebar/simplebar.css" rel="stylesheet" />

	<!-- shop CSS -->
	<link id="shop-css" href="assets/css/style.css" rel="stylesheet" />

	<!-- FAVICON -->
	<link href="assets/img/favicon.png" rel="shortcut icon" />

</head>

<body class="ec-header-fixed ec-sidebar-fixed ec-sidebar-light ec-header-light" id="body">

	<!--  WRAPPER  -->
	<div class="wrapper">
		
		<!-- LEFT MAIN SIDEBAR -->
		<?php @include("includes/sidebar.php");?>

		<!--  PAGE WRAPPER -->
		<div class="ec-page-wrapper">

			<!-- Header -->
			<?php @include("includes/header.php");?>

			<!-- CONTENT WRAPPER -->
			<div class="ec-content-wrapper">
				<div class="content">
					<!-- Top Statistics -->
					<div class="row">
						<div class="col-xl-3 col-sm-6 p-b-15 lbl-card">
							<div class="card card-mini dash-card card-1">
								<div class="card-body">
									<?php 
									$sql ="SELECT ID from tbladmin where Status='1'";
									$query = $dbh -> prepare($sql);
									$query->execute();
									$results=$query->fetchAll(PDO::FETCH_OBJ);
									$totalunreadquery=$query->rowCount();
									?>
									<h2 class="mb-1"><?php echo htmlentities($totalunreadquery);?></h2>
									<p>Total Signups</p>
									<span class="mdi mdi-account-arrow-left"></span>
								</div>
							</div>
						</div>
						<div class="col-xl-3 col-sm-6 p-b-15 lbl-card">
							<div class="card card-mini dash-card card-2">
								<div class="card-body">
									<?php
									$sql=mysqli_query($con,"select id from tblproducts");
									$listedproduct=mysqli_num_rows($sql);
									?>
									<h2 class="mb-1"><?php echo $listedproduct;?></h2>
									<p>Total Products</p>
									<span class="mdi mdi-desktop-mac"></span>
								</div>
							</div>
						</div>
						<div class="col-xl-3 col-sm-6 p-b-15 lbl-card">
							<div class="card card-mini dash-card card-3">
								<div class="card-body">
									<?php
									$querybb=mysqli_query($con,"select sum(tblproducts.Quantity*tblproducts.ProductPrice) as today  from orders join tblproducts on tblproducts.id=orders.productId where date(orders.orderDate)=CURDATE()");
									$today=mysqli_fetch_array($querybb);
									?>
									<h2 class="mb-1">$<?php echo number_format($today['today'],2);?></h2>
									<p>Daily Revenue</p>
									<span class="mdi mdi-currency-usd"></span>
								</div>
							</div>
						</div>
						<div class="col-xl-3 col-sm-6 p-b-15 lbl-card">
							<div class="card card-mini dash-card card-4">
								<div class="card-body">
									<?php
									$qury=mysqli_query($con,"select sum(tblproducts.Quantity*tblproducts.ProductPrice) as week  from orders join tblproducts on tblproducts.id=orders.productId where date(orders.orderDate)>=(DATE(NOW()) - INTERVAL 7 DAY)");
									$row=mysqli_fetch_array($qury);
									?>
									<h2 class="mb-1">$<?php echo number_format($row['week'],2);?></h2>
									<p>Weekly Revenue</p>
									<span class="mdi mdi-currency-usd"></span>
								</div>
							</div>
						</div>
					</div>

					<div class="row">
						<div class="col-xl-8 col-md-12 p-b-15">
							<!-- Sales Graph -->
							<div id="user-acquisition" class="card card-default">
								<div class="card-header">
									<h2>Sales Report</h2>
								</div>
								<div class="card-body">
									<ul class="nav nav-tabs nav-style-border justify-content-between justify-content-lg-start border-bottom" role="tablist">
										<li class="nav-item">
											<a class="nav-link active" data-bs-toggle="tab" href="#todays" role="tab"
											aria-selected="true">Today &apos;s</a>
										</li>
										<li class="nav-item">
											<a class="nav-link" data-bs-toggle="tab" href="#monthly" role="tab"
											aria-selected="false">Monthly </a>
										</li>
										<li class="nav-item">
											<a class="nav-link" data-bs-toggle="tab" href="#yearly" role="tab"
											aria-selected="false">Yearly</a>
										</li>
									</ul>
									<div class="tab-content pt-4" id="salesReport">
										<div class="tab-pane fade show active" id="source-medium" role="tabpanel">
											<div class="mb-6" style="max-height:247px">
												<canvas id="acquisition" class="chartjs2"></canvas>
												<div id="acqLegend" class="customLegend mb-2"></div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>

						<div class="col-xl-4 col-md-12 p-b-15">
							<!-- Doughnut Chart -->
							<div class="card card-default">
								<div class="card-header justify-content-center">
									<h2>Orders Overview</h2>
								</div>
								<div class="card-body">
									<canvas id="doChart"></canvas>
								</div>
								<a href="#" class="pb-5 d-block text-center text-muted"><i
									class="mdi mdi-download mr-2"></i> Download overall report
								</a>
								<div class="card-footer d-flex flex-wrap bg-white p-0">
									<div class="col-6">
										<div class="p-20">
											<ul class="d-flex flex-column justify-content-between">
												<li class="mb-2"><i class="mdi mdi-checkbox-blank-circle-outline mr-2"
													style="color: #4c84ff"></i>Order Completed
												</li>
												<li class="mb-2"><i class="mdi mdi-checkbox-blank-circle-outline mr-2"
													style="color: #80e1c1 "></i>Order Unpaid
												</li>
												<li><i class="mdi mdi-checkbox-blank-circle-outline mr-2"
													style="color: #ff7b7b "></i>Order returned
												</li>
											</ul>
										</div>
									</div>
									<div class="col-6 border-left">
										<div class="p-20">
											<ul class="d-flex flex-column justify-content-between">
												<li class="mb-2"><i class="mdi mdi-checkbox-blank-circle-outline mr-2"
													style="color: #8061ef"></i>Order Pending
												</li>
												<li class="mb-2"><i class="mdi mdi-checkbox-blank-circle-outline mr-2"
													style="color: #ffa128"></i>Order Canceled
												</li>
												<li><i class="mdi mdi-checkbox-blank-circle-outline mr-2"
													style="color: #7be6ff"></i>Order Broken
												</li>
											</ul>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>

					<div class="row">
						<div class="col-xl-8 col-12 p-b-15">
							<!-- World Chart -->
							<div class="card card-default" id="analytics-country">
								<div class="card-header justify-content-between">
									<h2>Purchased by Country</h2>
									<div class="date-range-report ">
										<span></span>
									</div>
								</div>
								<div class="card-body vector-map-world-2">
									<div id="regions_purchase" style="height: 100%; width: 100%;"></div>
								</div>
								<div class="border-top mt-3">
									<div class="row no-gutters">
										<div class="col-lg-6">
											<div class="world-data-chart border-bottom pt-15px pb-15px">
												<canvas id="hbar1" class="chartjs"></canvas>
											</div>
										</div>
										<div class="col-lg-6">
											<div class="world-data-chart pt-15px pb-15px">
												<canvas id="hbar2" class="chartjs"></canvas>
											</div>
										</div>
									</div>
								</div>
								<div class="card-footer d-flex flex-wrap bg-white">
									<a href="#" class="text-uppercase py-3">In-Detail Overview</a>
								</div>
							</div>
						</div>
						<div class="col-xl-4 col-12 p-b-15">
							<!-- Top Sell Table -->
							<div class="card card-default Sold-card-table">
								<div class="card-header justify-content-between">
									<h2>Sold by Items</h2>
									<div class="tools">
										<button class="text-black-50 mr-2 font-size-20"><i
											class="mdi mdi-cached"></i>
										</button>
										<div class="dropdown show d-inline-block widget-dropdown">
											<a class="dropdown-toggle icon-burger-mini" href="#" role="button"
											id="dropdown-units" data-bs-toggle="dropdown" aria-haspopup="true"
											aria-expanded="false" data-display="static"></a>
											<ul class="dropdown-menu dropdown-menu-right">
												<li class="dropdown-item"><a href="#">Action</a></li>
												<li class="dropdown-item"><a href="#">Another action</a></li>
												<li class="dropdown-item"><a href="#">Something else here</a></li>
											</ul>
										</div>
									</div>
								</div>
								<div class="card-body py-0 compact-units" data-simplebar style="height: 534px;">
									<table class="table ">
										<tbody>
											<?php
											$sql="SELECT orders.quantity,orders.id,tblproducts.ProductName from orders join tblproducts on orders.productId=tblproducts.id ORDER BY InvoiceNumber DESC";
											$query = $dbh -> prepare($sql);
											$query->execute();
											$results=$query->fetchAll(PDO::FETCH_OBJ);
											if($query->rowCount() > 0)
											{
												foreach($results as $row)
												{ 
													?>
													<tr>
														<td class="text-dark"><?php  echo htmlentities($row->ProductName);?></td>
														<td class="text-center"><?php  echo htmlentities($row->quantity);?></td>
														<td class="text-right">33% <i
															class="mdi mdi-arrow-up-bold text-success pl-1 font-size-12"></i>
														</td>
													</tr>
													<?php 
												}
											} ?>
										</tbody>
									</table>
								</div>
								<div class="card-footer d-flex flex-wrap bg-white">
									<a href="#" class="text-uppercase py-3">View Report</a>
								</div>
							</div>
						</div>
					</div>

					<div class="row">
						<div class="col-12 p-b-15">
							<!-- Recent Order Table -->
							<div class="card card-table-border-none card-default recent-orders" id="recent-orders">
								<div class="card-header justify-content-between">
									<h2>Recent Purchased Products</h2>
									<div class="date-range-report">
										<span></span>
									</div>
								</div>
								<div class="card-body pt-0 pb-5">
									<table class="table card-table table-responsive table-responsive-large" style="width:100%">
										<thead>
											<tr>
												<th>Invoice Number</th>
												<th>Product Name</th>
												<th class="d-none d-lg-table-cell">Units</th>
												<th class="d-none d-lg-table-cell">Order Date</th>
												<th class="d-none d-lg-table-cell">Order Cost</th>
												<th>Status</th>
												<th></th>
											</tr>
										</thead>
										<tbody>
											<?php
											$sql2="SELECT orders.quantity,orders.InvoiceNumber,orders.orderDate,orders.id,tblproducts.ProductName,tblproducts.ProductPrice,tblproducts.id from orders join tblproducts on orders.productId=tblproducts.id ORDER BY InvoiceNumber DESC limit 6";
											$query2 = $dbh -> prepare($sql2);
											$query2->execute();
											$results2=$query2->fetchAll(PDO::FETCH_OBJ);
											if($query2->rowCount() > 0)
											{
												foreach($results2 as $row2)
												{ 
													?>
													<tr>
														<td><?php  echo htmlentities($row2->InvoiceNumber);?></td>
														<td>
															<a class="text-dark" href="product-edit.php?productid=<?php echo ($row2->id) ?>"><?php  echo htmlentities($row2->ProductName);?></a>
														</td>
														<td class="d-none d-lg-table-cell"><?php  echo htmlentities($row2->quantity);?> Unit</td>
														<td class="d-none d-lg-table-cell"><?php  echo htmlentities(date("d-m-Y", strtotime($row2->orderDate)));?></td>
														<td class="d-none d-lg-table-cell">$<?php  echo htmlentities(($row2->quantity)*($row2->ProductPrice));?></td>
														<td>
															<span class="badge badge-success">Completed</span>
														</td>

														<td class="text-right">
															<div class="dropdown show d-inline-block widget-dropdown">
																<a class="dropdown-toggle icon-burger-mini" href="#"
																role="button" id="dropdown-recent-order5"
																data-bs-toggle="dropdown" aria-haspopup="true"
																aria-expanded="false" data-display="static"></a>
																<ul class="dropdown-menu dropdown-menu-right">
																	<li class="dropdown-item">
																		<a href="product-edit.php?productid=<?php echo ($row2->id) ?>">View</a>
																	</li>
																	<li class="dropdown-item">
																		<a href="#">Remove</a>
																	</li>
																</ul>
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

					<div class="row">
						<div class="col-xl-5">
							<!-- New Customers -->
							<div class="card ec-cust-card card-table-border-none card-default">
								<div class="card-header justify-content-between ">
									<h2>New Customers</h2>
									<div>
										<button class="text-black-50 mr-2 font-size-20">
											<i class="mdi mdi-cached"></i>
										</button>
										<div class="dropdown show d-inline-block widget-dropdown">
											<a class="dropdown-toggle icon-burger-mini" href="#" role="button" id="dropdown-customar" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-display="static">
											</a>
											<ul class="dropdown-menu dropdown-menu-right">
												<li class="dropdown-item"><a href="#">Action</a></li>
												<li class="dropdown-item"><a href="#">Another action</a></li>
												<li class="dropdown-item"><a href="#">Something else here</a></li>
											</ul>
										</div>
									</div>
								</div>
								<div class="card-body pt-0 pb-15px">
									<table class="table ">
										<tbody>
											<?php
											$sql6="SELECT * from users ORDER BY name DESC limit 6";
											$query6 = $dbh -> prepare($sql6);
											$query6->execute();
											$results6=$query6->fetchAll(PDO::FETCH_OBJ);
											if($query6->rowCount() > 0)
											{
												foreach($results6 as $row6)
												{ 
													?>
													<tr>
														<td>
															<div class="media">
																<div class="media-image mr-3 rounded-circle">
																	<a href="profile.html"><img
																		class="profile-img rounded-circle w-45"
																		src="assets/img/user/u6.jpg"
																		alt="customer image">
																	</a>
																</div>
																<div class="media-body align-self-center">
																	<a href="profile.html">
																		<h6 class="mt-0 text-dark font-weight-medium"><?php  echo htmlentities($row6->name);?></h6>
																	</a>
																	<small><?php  echo htmlentities($row6->email);?></small>
																</div>
															</div>
														</td>
														<?php 
														$idd=$row6->id;
														$sql7 ="SELECT id from orders where userId='$idd'";
														$query7 = $dbh -> prepare($sql7);
														$query7->execute();
														$results7=$query7->fetchAll(PDO::FETCH_OBJ);
														$totalunreadquery=$query7->rowCount();
														?>
														<td><?php echo htmlentities($totalunreadquery);?> Orders</td>
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

						<div class="col-xl-7">
							<!-- Top Products -->
							<div class="card card-default ec-card-top-prod">
								<div class="card-header justify-content-between">
									<h2>Top Products</h2>
									<div>
										<button class="text-black-50 mr-2 font-size-20"><i
											class="mdi mdi-cached"></i>
										</button>
										<div class="dropdown show d-inline-block widget-dropdown">
											<a class="dropdown-toggle icon-burger-mini" href="#" role="button" id="dropdown-product" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-display="static">
											</a>
											<ul class="dropdown-menu dropdown-menu-right">
												<li class="dropdown-item"><a href="#">Update Data</a></li>
												<li class="dropdown-item"><a href="#">Detailed Log</a></li>
												<li class="dropdown-item"><a href="#">Statistics</a></li>
												<li class="dropdown-item"><a href="#">Clear Data</a></li>
											</ul>
										</div>
									</div>
								</div>
								<div class="card-body mt-10px mb-10px py-0">
									<?php
									$sql3="SELECT * from tblproducts order by rand() limit 3";
									$query3 = $dbh -> prepare($sql3);
									$query3->execute();
									$results3=$query3->fetchAll(PDO::FETCH_OBJ);
									if($query3->rowCount() > 0)
									{
										foreach($results3 as $row3)
										{ 
											?>
											<div class="row media d-flex pt-15px pb-15px">
												<div class="col-lg-3 col-md-3 col-2 media-image align-self-center rounded">
													<a href="#"><img src="productimages/<?php echo htmlentities($row3->ProductImage);?>" alt="customer image"></a>
												</div>
												<div class="col-lg-9 col-md-9 col-10 media-body align-self-center ec-pos">
													<a href="#">
														<h6 class="mb-10px text-dark font-weight-medium"><?php echo substr($row3->ProductName,0,40);?></h6>
													</a>
													<p class="d-none d-md-block"><?php echo substr($row3->productDetails,0,150);?>...<a href="product-edit.php?productid=<?php echo ($row3->id) ?>">more</a></p>
													<p class="mb-0 ec-price">
														<span class="text-dark">$<?php  echo htmlentities($row3->ProductPrice);?></span>
														<del>$<?php  echo htmlentities($row3->PriceBefore);?></del>
													</p>
												</div>
											</div>
											<?php
										}
									}
									?>
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

	<!-- Chart -->
	<script src="assets/plugins/charts/Chart.min.js"></script>
	<script src="assets/js/chart.js"></script>

	<!-- Google map chart -->
	<script src="assets/plugins/charts/google-map-loader.js"></script>
	<script src="assets/plugins/charts/google-map.js"></script>

	<!-- Date Range Picker -->
	<script src="assets/plugins/daterangepicker/moment.min.js"></script>
	<script src="assets/plugins/daterangepicker/daterangepicker.js"></script>
	<script src="assets/js/date-range.js"></script>

	<!-- Option Switcher -->
	<script src="assets/plugins/options-sidebar/optionswitcher.js"></script>

	<!-- shop Custom -->
	<script src="assets/js/main.js"></script>
</body>

</html>