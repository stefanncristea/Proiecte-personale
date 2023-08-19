<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');

if(isset($_POST['save'])) { 
  if( empty( $_POST['token'] ) ){
  echo "<script>alert('Error');</script>";
  exit;
}
if( $_POST['token'] != 'FsWga4&@f6aw' ){
  echo "<script>alert('Error');</script>";
  exit;
}
  $name=$_POST['firstname'];
  $email=$_POST['email'];
  $phonenumber=$_POST['phonenumber'];
  $address=$_POST['address'];
  $city=$_POST['city'];
  $postalcode=$_POST['postalcode'];
  $country=$_POST['country'];
  $state=$_POST['state'];
  $password=md5($_POST['password']);
  $query=mysqli_query($con,"insert into users(name,email,contactno,password,billingAddress,billingCity,billingState,billingCountry,billingZipcode) values('$name','$email','$phonenumber','$password','$address','$city','$state','$country','$postalcode')");
  if($query)
  {
    echo "<script>alert('registered successfully');</script>";
  }
  else{
    echo "<script>alert('Not register something went worng');</script>";
  }
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
  <!-- <script src='https://www.google.com/recaptcha/api.js'></script> --> 

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
              <h2 class="ec-breadcrumb-title">Register</h2>
            </div>
            <div class="col-md-6 col-sm-12">
              <!-- ec-breadcrumb-list start -->
              <ul class="ec-breadcrumb-list">
                <li class="ec-breadcrumb-item"><a href="index.php">Home</a></li>
                <li class="ec-breadcrumb-item active">Register</li>
              </ul>
              <!-- ec-breadcrumb-list end -->
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- Ec breadcrumb end -->

  <!-- Start Register -->
  <section class="ec-page-content section-space-p">
    <div class="container">
      <div class="row">
        <div class="col-md-12 text-center">
          <div class="section-title">
            <h2 class="ec-bg-title">Register</h2>
            <h2 class="ec-title">Register</h2>
            <p class="sub-title mb-3">Best place to buy and sell digital products</p>
          </div>
        </div>
        <div class="ec-register-wrapper">
          <div class="ec-register-container">
            <div class="ec-register-form">
              <form action="" method="post">
                <span class="ec-register-wrap ec-register-half">
                  <label>Full Names*</label>
                  <input type="text" name="firstname" placeholder="Enter your full names" required />
                </span>
                <span class="ec-register-wrap ec-register-half">
                  <label>Email*</label>
                  <input type="email" name="email" placeholder="Enter your email add..." required />
                </span>
                <span class="ec-register-wrap ec-register-half">
                  <label>Phone Number*</label>
                  <input type="text" name="phonenumber" placeholder="Enter your phone number"
                  required />
                </span>
                <span class="ec-register-wrap ec-register-half">
                  <label>Address</label>
                  <input type="text" name="address" placeholder="Address Line 1" />
                </span>
                <span class="ec-register-wrap ec-register-half">
                  <label>Password</label>
                  <input type="password" name="password" placeholder="Password" />
                </span>
                <span class="ec-register-wrap ec-register-half">
                  <label>City *</label>
                  <span class="ec-rg-select-inner">
                    <select name="city" id="ec-select-city" class="ec-register-select">
                      <option selected disabled>City</option>
                      <option value="Town1">Town1</option>
                      <option value="Town2">Town2</option>
                      <option value="Town3">Town3</option>
                      <option value="Town4">Town4</option>
                      <option value="Town5">Town5</option>
                    </select>
                  </span>
                </span>
                <span class="ec-register-wrap ec-register-half">
                  <label>Post Code</label>
                  <input type="text" name="postalcode" placeholder="Post Code" />
                </span>
                <span class="ec-register-wrap ec-register-half">
                  <label>Country *</label>
                  <span class="ec-rg-select-inner">
                    <select name="country" class="ec-register-select" id="ec-select-country">
                      <option selected disabled>Country</option>
                      <option value="Poland">Poland</option>
                      <option value="Canada">Canada</option>
                      <option value="USA">USA</option>
                      <option value="UK">UK</option>
                      <option value="Japan">Japan</option>
                    </select>
                  </span>
                </span>
                <span class="ec-register-wrap ec-register-half">
                  <label>Region State</label>
                  <span class="ec-rg-select-inner">
                    <select name="state" id="ec-select-state" class="ec-register-select">
                      <option selected disabled>Region/State</option>
                      <option value="Central">Central</option>
                      <option value="Western">Western</option>
                      <option value="Eastern">Eastern</option>
                      <option value="Southern">Southern</option>
                    </select>
                  </span>
                </span>
                <input type="hidden"  name="token" value="FsWga4&@f6aw" />
                <!-- <span class="ec-register-wrap ec-recaptcha">
                  <span class="g-recaptcha" data-sitekey="6LfUeskeAAAAAHJxKRWYZSh7n-cxRsDmZ8eJUKfH"
                  data-callback="verifyRecaptchaCallback"
                  data-expired-callback="expiredRecaptchaCallback"></span>
                  <input class="form-control d-none" data-recaptcha="true" required
                  data-error="Please complete the Captcha">
                  <span class="help-block with-errors"></span>
                </span> -->
                <span class="ec-register-wrap ec-register-btn">
                  <button class="btn btn-primary" name="save" type="submit">Register</button>
                </span>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- End Register -->

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
  <script src="assets/js/demoss.js"></script>
  <script src="assets/js/main.js"></script>


</body>
</html>