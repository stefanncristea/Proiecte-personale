<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="x-ua-compatible" content="ie=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0">

  <title>Electronic Shop - Shopping portal.</title>
  <meta name="keywords" content="apparel, catalog, clean, ecommerce, ecommerce HTML, electronics, fashion, html eCommerce, html store, minimal, multipurpose, multipurpose ecommerce, online store, responsive ecommerce template, shops" />
  <meta name="description" content="Best ecommerce html template for single and multi vendor store.">
  <meta name="author" content="Code4berry">

  <!-- site Favicon -->
  <link rel="icon" href="assets/images/favicon/favicon.png" sizes="32x32" />
  <link rel="apple-touch-icon" href="assets/images/favicon/favicon-10.png" />
  <meta name="msapplication-TileImage" content="assets/images/favicon/favicon-10.png" />

  <!-- css Icon Font -->
  <link rel="stylesheet" href="assets/css/vendor/ecicons.min.css" />

  <!-- css All Plugins Files -->
  <link rel="stylesheet" href="assets/css/plugins/animate.css" />
  <link rel="stylesheet" href="assets/css/plugins/swiper-bundle.min.css" />
  <link rel="stylesheet" href="assets/css/plugins/jquery-ui.min.css" />
  <link rel="stylesheet" href="assets/css/plugins/countdownTimer.css" />
  <link rel="stylesheet" href="assets/css/plugins/slick.min.css" />
  <link rel="stylesheet" href="assets/css/plugins/bootstrap.css" />

  <!-- Main Style -->
  <link rel="stylesheet" href="assets/css/demo.css" />
  <link rel="stylesheet" href="assets/css/style.css" />

</head>
<body>
  <div id="ec-overlay"><span class="loader_img"></span></div>
  <!-- Header start  -->
  <?php @include("includes/header.php");?>
  <!-- Header End  -->

  <!-- Ekka Cart Start -->
  <?php @include("includes/shoppingcart.php");?>
  <!-- Ekka Cart End -->


  <!-- Ec breadcrumb start -->
  <div class="sticky-header-next-sec  ec-breadcrumb section-space-mb">
    <div class="container">
      <div class="row">
        <div class="col-12">
          <div class="row ec_breadcrumb_inner">
            <div class="col-md-6 col-sm-12">
              <h2 class="ec-breadcrumb-title">User-invoice</h2>
            </div>
            <div class="col-md-6 col-sm-12">
              <!-- ec-breadcrumb-list start -->
              <ul class="ec-breadcrumb-list">
                <li class="ec-breadcrumb-item"><a href="index.php">Home</a></li>
                <li class="ec-breadcrumb-item active">User Invoice</li>
              </ul>
              <!-- ec-breadcrumb-list end -->
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- Ec breadcrumb end -->

  <!-- User invoice section -->
  <section class="ec-page-content ec-vendor-uploads ec-user-account section-space-p">
    <div class="container">
      <div class="row">
        <!-- Sidebar Area Start -->
        <?php @include("includes/sidebar.php");?>
        <div class="ec-shop-rightside col-lg-9 col-md-12">
          <div class="ec-vendor-dashboard-card">
            <div class="ec-vendor-card-header">
              <h5>Invoice</h5>
              <div class="ec-header-btn">
                <a class="btn btn-lg btn-secondary" href="generatepdf.php?search=<?php  echo intval($_GET['invid']);?>">Print</a>
                <a class="btn btn-lg btn-primary" href="generatepdf.php?search=<?php  echo intval($_GET['invid']);?>" target="_blank">Export</a>
              </div>
            </div>
            <div class="ec-vendor-card-body padding-b-0">
              <div class="page-content">
                <div class="page-header text-blue-d2">
                  <img src="assets/images/logo/logo-10.png" alt="Site Logo">
                </div>

                <div class="container px-0">
                  <div class="row mt-4">
                    <div class="col-lg-12">
                      <hr class="row brc-default-l1 mx-n1 mb-4" />

                      <div class="row">
                        <?php 
                        $inid=intval($_GET['invid']);
                        $query=mysqli_query($con,"SELECT *  from users join orders on orders.userid=users.id where orders.InvoiceNumber='$inid' limit 1");
                        while($row=mysqli_fetch_array($query))
                        {    
                          ?>
                          <div class="col-sm-6">
                            <div class="my-2">
                              <span class="text-sm text-grey-m2 align-middle">To : </span>
                              <span class="text-600 text-110 text-blue align-middle"><?php echo $row['name'];?></span>
                            </div>
                            <div class="text-grey-m2">
                              <div class="my-2">
                                <?php echo $row['billingAddress'];?>,&nbsp;<?php echo $row['billingCity'];?>.
                              </div>
                              <div class="my-2">
                                <?php echo $row['billingCountry'];?>
                              </div>
                              <div class="my-2"><b class="text-600">Phone : </b>
                                0  <?php echo $row['contactno'];?>
                              </div>
                            </div>
                          </div>
                          <!-- /.col -->

                          <div class="text-95 col-sm-6 align-self-start d-sm-flex justify-content-end">
                            <hr class="d-sm-none" />
                            <div class="text-grey-m2">

                              <div class="my-2"><span class="text-600 text-90">ID : </span>
                              #111-222</div>

                              <div class="my-2"><span class="text-600 text-90">HSN Code :
                              </span> #123456</div>
                              <div class="my-2"><span class="text-600 text-90">Issue Date :
                              </span> <?php echo date('d/m/y'); ?></div>

                              <div class="my-2"><span class="text-600 text-90">Invoice No :
                              </span><?php echo intval($_GET['invid']); ?></div>
                            </div>
                          </div>
                          <!-- /.col -->
                          <?php
                        } ?>
                      </div>

                      <div class="mt-4">

                        <div class="text-95 text-secondary-d3">
                          <div class="ec-vendor-card-table">
                            <table class="table ec-table">
                              <thead>
                                <tr>
                                  <th scope="col">NO.</th>
                                  <th scope="col">Name</th>
                                  <th scope="col">Qty</th>
                                  <th scope="col">Price</th>
                                  <th scope="col">Amount</th>
                                </tr>
                              </thead>
                              <tbody>
                                <?php 
                                $inid=intval($_GET['invid']);
                                $query2=mysqli_query($con,"SELECT tblproducts.ProductName,tblproducts.ProductPrice,orders.quantity  from orders join tblproducts on tblproducts.id=orders.productid where orders.InvoiceNumber='$inid'");
                                $cnt=1;
                                while($row2=mysqli_fetch_array($query2))
                                {    
                                  ?> 
                                  <tr>
                                    <th><span><?php echo $cnt ?></span></th>
                                    <td><span><?php echo $row2['ProductName'];?></span></td>
                                    <td><span><?php echo $qty=$row2['quantity'];?></span></td>
                                    <td><span>$&nbsp;<?php echo number_format($ppu=$row2['ProductPrice'],0);?></span></td>
                                    <td><span>$&nbsp;<?php echo number_format($subtotal=($ppu*$qty),0);?></span></td>
                                  </tr>
                                  <?php
                                  $grandtotal+=$subtotal; 
                                  $cnt++;
                                } ?>

                              </tbody>
                              <tfoot>
                                <tr>
                                  <td class="border-none" colspan="3">
                                    <span></span>
                                  </td>
                                  <td class="border-color" colspan="1">
                                    <span><strong>Sub Total</strong></span>
                                  </td>
                                  <td class="border-color">
                                    <span>$&nbsp;<?php echo number_format($grandtotal,0);?></span>
                                  </td>
                                </tr>
                                <tr>
                                  <td class="border-none" colspan="3">
                                    <span></span>
                                  </td>
                                  <td class="border-color" colspan="1">
                                    <span><strong>Tax (10%)</strong></span>
                                  </td>
                                  <td class="border-color">
                                    <span>$<?php echo number_format((0.1*$grandtotal),0);?></span>
                                  </td>
                                </tr>
                                <tr>
                                  <td class="border-none m-m15"
                                  colspan="3"><span class="note-text-color">Extra
                                    note such as company or payment
                                  information...</span></td>
                                  <td class="border-color m-m15"
                                  colspan="1"><span><strong>Total</strong></span>
                                </td>
                                <td class="border-color m-m15">
                                  <span>$<?php echo number_format(((0.1*$grandtotal)+$grandtotal),0);?></span></td>
                                </tr>
                              </tfoot>
                            </table>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- End User invoice section -->


  <!-- Footer Start -->
  <?php @include("includes/footer.php");?>
  <!-- Footer Area End -->

  <!-- Vendor JS -->
  <script src="assets/js/vendor/jquery-3.5.1.min.js"></script>
  <script src="assets/js/vendor/jquery.notify.min.js"></script>
  <script src="assets/js/vendor/jquery.bundle.notify.min.js"></script>
  <script src="assets/js/vendor/popper.min.js"></script>
  <script src="assets/js/vendor/bootstrap.min.js"></script>
  <script src="assets/js/vendor/jquery-migrate-3.3.0.min.js"></script>
  <script src="assets/js/vendor/modernizr-3.11.2.min.js"></script>

  <!--Plugins JS-->
  <script src="assets/js/plugins/swiper-bundle.min.js"></script>
  <script src="assets/js/plugins/countdownTimer.min.js"></script>
  <script src="assets/js/plugins/scrollup.js"></script>
  <script src="assets/js/plugins/jquery.zoom.min.js"></script>
  <script src="assets/js/plugins/slick.min.js"></script>
  <script src="assets/js/plugins/infiniteslidev2.js"></script>
  <script src="assets/js/plugins/fb-chat.js"></script>

  <!-- Main Js -->
  <script src="assets/js/vendor/index.js"></script>
  <script src="assets/js/demo.js"></script>
  <script src="assets/js/main.js"></script>


</body>
</html>