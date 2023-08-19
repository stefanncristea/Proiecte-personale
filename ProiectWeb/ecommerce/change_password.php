<?php 
session_start();
error_reporting(0);
include('includes/dbconnection.php');
if (empty($_SESSION['activatecode'])) {
  header('location:forgot-password.php');
} 
if(isset($_POST['change']))
{
  $codeactivate=$_SESSION['activatecode'];
  $password=md5($_POST['password']);
  $query=mysqli_query($con,"SELECT * FROM users WHERE activationcode='$codeactivate'");
  $num=mysqli_fetch_array($query);
  if($num>0)
  {
    $extra="change_password.php";
    mysqli_query($con,"update users set password='$password' WHERE activationcode='$codeactivate' ");
    $host=$_SERVER['HTTP_HOST'];
    $uri=rtrim(dirname($_SERVER['PHP_SELF']),'/\\');
    header("location:http://$host$uri/$extra");
    $_SESSION['errmsg']="Password Changed Successfully";
    exit();
  }
  else
  {
    $extra="change_password.php";
    $host  = $_SERVER['HTTP_HOST'];
    $uri  = rtrim(dirname($_SERVER['PHP_SELF']),'/\\');
    header("location:http://$host$uri/$extra");
    $_SESSION['errmsg']="Invalid email id or Contact no";
    exit();
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
  <script type="text/javascript">
    function valid()
    {
      if(document.register.password.value!= document.register.confirmpassword.value)
      {
        alert("Password and Confirm Password Field do not match  !!");
        document.register.confirmpassword.focus();
        return false;
      }
      return true;
    }
  </script>

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
              <h2 class="ec-breadcrumb-title">Change Password</h2>
            </div>
            <div class="col-md-6 col-sm-12">
              <!-- ec-breadcrumb-list start -->
              <ul class="ec-breadcrumb-list">
                <li class="ec-breadcrumb-item"><a href="index.php">Home</a></li>
                <li class="ec-breadcrumb-item active">Reset Password</li>
              </ul>
              <!-- ec-breadcrumb-list end -->
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- Ec breadcrumb end -->

  <!-- Ec login page -->
  <section class="ec-page-content section-space-p">
    <div class="container">
      <div class="row">
        <div class="col-md-12 text-center">
          <div class="section-title">
            <h2 class="ec-bg-title">Reset Password In</h2>
            <p class="sub-title mb-3">We are almost there.</p>
          </div>
        </div>
        <div class="ec-login-wrapper">
          <div class="ec-login-container">
            <div class="ec-login-form">
              <form onSubmit="return valid();" name="register" method="post" method="post">
                <span style="color:red;" >
                  <?php
                  echo htmlentities($_SESSION['errmsg']);
                  ?>
                  <?php
                  echo htmlentities($_SESSION['errmsg']="");
                  ?>
                </span>
                <span class="ec-login-wrap">
                  <label>Password*</label>
                  <input type="password"id="password" onKeyUp="checkPasswordStrength();" name="password" required />
                </span>
                <span>
                  <div id="password-strength-status" style="margin-bottom: 10px;"></div>
                </span>
                <span class="ec-login-wrap">
                  <label>Confirm Password*</label>
                  <input type="password" id="confirmpassword" name="confirmpassword" placeholder="Enter your password" required />
                </span>
                <span class="ec-login-wrap ec-login-fp">
                  <label><a href="login.php">Signin Now</a></label>
                </span>
                <span class="ec-login-wrap ec-login-btn">
                  <button class="btn btn-primary" name="change" type="submit">Reset</button>
                </span>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- Footer Start -->
   <?php @include("includes/footer.php");?>
  <!-- Footer Area End -->

  <!-- Newsletter Modal Start -->
  <div id="ec-popnews-bg"></div>
  <div id="ec-popnews-box">
    <div id="ec-popnews-close"><i class="ecicon eci-close"></i></div>
    <div id="ec-popnews-box-content">
      <h1>Subscribe Newsletter</h1>
      <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p>
      <form id="ec-popnews-form" action="#" method="post">
        <input type="email" name="newsemail" placeholder="Email Address" required />
        <button type="button" class="btn btn-secondary" name="subscribe">Subscribe</button>
      </form>
    </div>
  </div>
  <!-- Newsletter Modal end -->

  <!-- successfully toast Start -->
  <div id="addtocart_toast" class="addtocart_toast">
    <div class="desc">You Have Add To Cart Successfully</div>
  </div>
  <div id="wishlist_toast" class="wishlist_toast">
    <div class="desc">You Have Add To Wishlist Successfully</div>
  </div>
  <!--successfully toast end -->

  <!-- Theme Custom Cursors -->
  <!-- <div class="ec-cursor"></div> -->
  <!--   <div class="ec-cursor-2"></div> -->

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
  <script>
    function myFunction() {
      var x = document.getElementById("password");
      if (x.type === "password") {
        x.type = "text";
      } else {
        x.type = "password";
      }
    }
  </script>


</body>
</html>