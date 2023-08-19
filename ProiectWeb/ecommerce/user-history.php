<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');
if(strlen($_SESSION['id'])==0)
{   
  header('location:login.php');
}
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
              <h2 class="ec-breadcrumb-title">Cart</h2>
            </div>
            <div class="col-md-6 col-sm-12">
              <!-- ec-breadcrumb-list start -->
              <ul class="ec-breadcrumb-list">
                <li class="ec-breadcrumb-item"><a href="index.php">Home</a></li>
                <li class="ec-breadcrumb-item active">Cart</li>
              </ul>
              <!-- ec-breadcrumb-list end -->
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- Ec breadcrumb end -->

  <!-- User history section -->
  <section class="ec-page-content ec-vendor-uploads ec-user-account section-space-p">
    <div class="container">
      <div class="row">
        <!-- Sidebar Area Start -->
        <?php @include("includes/sidebar.php");?>
        <div class="ec-shop-rightside col-lg-9 col-md-12">
          <div class="ec-vendor-dashboard-card">
            <div class="ec-vendor-card-header">
              <h5>Product History</h5>
              <div class="ec-header-btn">
                <a class="btn btn-lg btn-primary" href="index.php">Shop Now</a>
              </div>
            </div>
            <div class="ec-vendor-card-body">
              <div class="ec-vendor-card-table">
                <table class="table ec-table">
                  <thead>
                    <tr>
                      <th scope="col">NO.</th>
                      <th scope="col">Customer Name</th>
                      <th scope="col">Invoice No</th>
                      <th scope="col">Payment Methods</th>
                      <th scope="col">Status</th>
                      <th scope="col">Actions</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php 
                    $sql2="select distinct InvoiceNumber,userid,paymentMethod    from orders where userId='".$_SESSION['id']."' ORDER BY id DESC";
                    $query2 = $dbh -> prepare($sql2);
                    $query2->execute();
                    $results2=$query2->fetchAll(PDO::FETCH_OBJ);
                    $cnt=1;
                    if($query2->rowCount() > 0)
                    {
                      foreach($results2 as $row2)
                      { 
                        $user=$row2->userId;

                        ?>
                        <tr>
                          <th scope="row"><span><?php echo $cnt;?></span></th>
                          <?php
                          $ret4=mysqli_query($con,"select * from users where id='$user'");
                          while($row4=mysqli_fetch_array($ret4))
                            {?>
                              <td><span><?php echo htmlentities($row4['name']);?></span></td>
                              <?php
                            }?>
                            <td><span><?php  echo htmlentities($row2->InvoiceNumber);?></span></td>
                            <td><span><?php  echo htmlentities($row2->paymentMethod);?></span></td>
                            <td><span>Active</span></td>
                            <td><span class="tbl-btn">
                              <a class="btn btn-sm btn-primary"
                              href="user-invoice.php?invid=<?php  echo htmlentities($row2->InvoiceNumber);?>">Invoice</a>
                              <a class="btn btn-sm btn-primary"
                              href="track-order.php">Track</a>
                            </span>
                          </td>
                        </tr>
                        <?php
                        $cnt=$cnt+1;
                      }
                    } ?>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- End User history section -->

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