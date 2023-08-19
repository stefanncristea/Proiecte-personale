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
  <link rel="icon" href="assets/images/favicon/compfavicon.ico" sizes="32x32" />
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
  <link rel="stylesheet" href="assets2/css/style.css" />
 <link rel="stylesheet" href="assets2/css/responsive.css" />

</head>
<body>
  <div id="ec-overlay"><span class="loader_img"></span></div>
  <!-- Header start  -->
  <?php @include("includes/second_header.php");?>
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
              <h2 class="ec-breadcrumb-title">Trach Order</h2>
            </div>
            <div class="col-md-6 col-sm-12">
              <!-- ec-breadcrumb-list start -->
              <ul class="ec-breadcrumb-list">
                <li class="ec-breadcrumb-item"><a href="index.php">Home</a></li>
                <li class="ec-breadcrumb-item active">Track order</li>
              </ul>
              <!-- ec-breadcrumb-list end -->
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- Ec breadcrumb end -->

  <!-- Ec Track Order section -->
  <section class="ec-page-content section-space-p">
    <div class="container">
      <!-- Track Order Content Start -->
      <div class="ec-trackorder-content col-md-12">
        <div class="ec-trackorder-inner">
          <div class="ec-trackorder-top">
            <h2 class="ec-order-id">order #8745</h2>
            <div class="ec-order-detail">
              <div>Expected arrival 14-10-2022</div>
              <div>EverGreen <span>UBH 894E</span></div>
            </div>
          </div>
          <div class="ec-trackorder-bottom">
            <div class="ec-progress-track">
              <ul id="ec-progressbar">
                <li class="step0 active">
                  <span class="ec-track-icon"> 
                    <img
                    src="assets/images/icons/track_1.png" alt="track_order">
                  </span>
                  <span
                  class="ec-progressbar-track"></span>
                  <span class="ec-track-title">order
                    <br>processed
                  </span>
                </li>
                <li class="step0 active">
                  <span class="ec-track-icon"> 
                    <img src="assets/images/icons/track_2.png" alt="track_order">
                  </span>
                  <span class="ec-progressbar-track"></span>
                  <span class="ec-track-title">order
                    <br>designing
                  </span>
                </li>
                <li class="step0 active">
                  <span class="ec-track-icon"> 
                    <img src="assets/images/icons/track_3.png" alt="track_order">
                  </span>
                  <span class="ec-progressbar-track"></span>
                  <span class="ec-track-title">order
                    <br>shipped
                  </span>
                </li>
                <li class="step0">
                  <span class="ec-track-icon"> 
                    <img src="assets/images/icons/track_4.png" alt="track_order">
                  </span>
                  <span class="ec-progressbar-track"></span>
                  <span class="ec-track-title">order <br>enroute</span>
                </li>
                <li class="step0">
                  <span class="ec-track-icon"> 
                    <img src="assets/images/icons/track_5.png" alt="track_order">
                  </span>
                  <span class="ec-progressbar-track"></span>
                  <span class="ec-track-title">order
                    <br>arrived
                  </span>
                </li>

              </ul>
            </div>
          </div>
        </div>
      </div>
      <!-- Track Order Content end -->
    </div>
  </section>
  <!-- End Track Order section -->
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