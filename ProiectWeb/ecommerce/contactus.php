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

 <title>contact us| Electronic shop</title>
 <meta name="keywords" content="apparel, catalog, clean, ecommerce, ecommerce HTML, electronics, fashion, html eCommerce, html store, minimal, multipurpose, multipurpose ecommerce, online store, responsive ecommerce template, shops" />
 <meta name="description" content="Best ecommerce html template for single and multi vendor store.">
 <meta name="author" content="code4berry">

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
 <link rel="stylesheet" href="assets/css/plugins/nouislider.css" />
 <link rel="stylesheet" href="assets/css/plugins/bootstrap.css" />

 <!-- Main Style -->
 <link rel="stylesheet" href="assets2/css/style.css" />
 <link rel="stylesheet" href="assets2/css/responsive.css" />

 <!-- Background css -->
 <link rel="stylesheet" id="bg-switcher-css" href="assets2/css/backgrounds/bg-4.css">
 <style>
  #form_status span {
    color: #fff;
    font-size: 14px;
    font-weight: normal;
    background: #E74C3C;
    width: 100%;
    text-align: center;
    display: inline-block;
    padding: 10px 0px;
    border-radius: 3px;
    margin-bottom: 18px;
  }

  #form_status span.loading {
    color: #333;
    background: #eee;
    border-radius: 3px;
    padding: 18px 0px;
  }

  #form_status span.notice {
    color: yellow;
  }

  #form_status .success {
    color: #fff;
    text-align: center;
    background: #2ecc71;
    border-radius: 3px;
    padding: 30px 0px;
  }

  #form_status .success i {
    color: #fff;
    font-size: 45px;
    margin-bottom: 14px;
  }

  #form_status .success h3 {
    color: #fff;
    margin-bottom: 10px;
  }

</style> 

</head>
<body class="product_page">
  <div id="ec-overlay"><span class="loader_img"></span></div>

  <!-- Header start  -->
  <?php @include("includes/second_header.php");?>
  <!-- Header End  -->

  <!-- ekka Cart Start -->
  <?php @include("includes/shoppingcart.php");?>
  <!-- ekka Cart End -->

  <!-- Ec breadcrumb start -->
  <div class="sticky-header-next-sec  ec-breadcrumb section-space-mb">
    <div class="container">
      <div class="row">
        <div class="col-12">
          <div class="row ec_breadcrumb_inner">
            <div class="col-md-6 col-sm-12">
              <h2 class="ec-breadcrumb-title">Contact Us</h2>
            </div>
            <div class="col-md-6 col-sm-12">
              <!-- ec-breadcrumb-list start -->
              <ul class="ec-breadcrumb-list">
                <li class="ec-breadcrumb-item"><a href="index.php">Home</a></li>
                <li class="ec-breadcrumb-item active">Contact Us</li>
              </ul>
              <!-- ec-breadcrumb-list end -->
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- Ec breadcrumb end -->

  <!-- Ec Contact Us page -->
  <section class="ec-page-content section-space-p">
    <div class="container">
      <div class="row">
        <div class="ec-common-wrapper">
          <div class="ec-contact-leftside">
            <div class="ec-contact-container">
              <div id="form_status"></div>
              <div class="ec-contact-form">
                <form method="post" class="" id="fruitkha-contact" onSubmit="return valid_datas2( this );">
                  <span class="ec-contact-wrap">
                    <label>Full Name*</label>
                    <input type="text" name="name" id="name" placeholder="Enter your names"
                    />
                  </span>
                  
                  <span class="ec-contact-wrap">
                    <label>Email*</label>
                    <input type="email" name="email" id="email" placeholder="Enter your email address"
                    />
                  </span>
                  <span class="ec-contact-wrap">
                    <label>Phone Number*</label>
                    <input type="text" name="phone" id="phone" placeholder="Enter your phone number"
                    />
                  </span>
                  <span class="ec-contact-wrap">
                    <label>Subject*</label>
                    <input type="text" name="subject" id="subject" placeholder="Enter your subject"
                    />
                  </span>
                  <span class="ec-contact-wrap">
                    <label>Message*</label>
                    <textarea name="message" id="message" 
                    placeholder="Please leave your message here.."></textarea>
                  </span>
                  <span><input type="hidden" name="token" value="FsWga4&@f6aw" /></span>
                  <span class="ec-contact-wrap ec-contact-btn">
                    <button class="btn btn-primary" type="submit"><i class="ecicon eci-send" aria-hidden="true"></i>&nbsp;Send</button>
                  </span>
                </form>
              </div>
            </div>
          </div>
          <div class="ec-contact-rightside">
            <div class="ec_contact_map">
              <div class="ec_map_canvas">
                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d49116.39176087041!2d-86.41867791216099!3d39.69977417971648!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x886ca48c841038a1%3A0x70cfba96bf847f0!2sPlainfield%2C%20IN%2C%20USA!5e0!3m2!1sen!2sbd!4v1586106673811!5m2!1sen!2sbd" height="460" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>
              </div>
            </div>
            <div class="ec_contact_info">
              <h1 class="ec_contact_info_head">Contact us</h1>
              
              <ul class="align-items-center">
                <li class="ec-contact-item"><i class="ecicon eci-map-marker"
                  aria-hidden="true"></i>
                  <span>Address :</span>12 Plainfield Guilford, Township
                  IN, USA
                </li>
                <li class="ec-contact-item align-items-center"><i class="ecicon eci-phone"
                  aria-hidden="true"></i><span>Call Us :</span><a href="tel:+440123456789">+44 0123
                  456 789</a>
                </li>
                <li class="ec-contact-item align-items-center"><i class="ecicon eci-envelope"
                  aria-hidden="true"></i><span>Email :</span><a
                  href="mailto:example@ec-email.com">example@ec-email.com</a>
                </li>
              </ul>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- Footer Start -->
  <?php @include("includes/footer.php");?>
  <!-- Footer Area End -->

  <!-- Footer navigation panel for responsive display -->
  <div class="ec-nav-toolbar">
    <div class="container">
      <div class="ec-nav-panel">
        <div class="ec-nav-panel-icons">
          <a href="#ec-mobile-menu" class="navbar-toggler-btn ec-header-btn ec-side-toggle"><img
            src="assets/images/icons/menu.svg" class="svg_img header_svg" alt="" />
          </a>
        </div>
        <div class="ec-nav-panel-icons">
          <a href="#ec-side-cart" class="toggle-cart ec-header-btn ec-side-toggle"><img
            src="assets/images/icons/cart.svg" class="svg_img header_svg" alt="" />
            <?php
            $sql = "SELECT * FROM tblproducts WHERE id IN(";
            foreach($_SESSION['cart'] as $id => $value){
              $sql .=$id. ",";
            }
            $sql=substr($sql,0,-1) . ") ORDER BY id ASC";
            $query = mysqli_query($con,$sql);
            $totalprice=0;
            $totalqunty=0;
            if(!empty($query)){
              while($row = mysqli_fetch_array($query))
              {
                $quantity=$_SESSION['cart'][$row['id']]['quantity'];
                $subtotal= $_SESSION['cart'][$row['id']]['quantity']*$row['ProductPrice'];
                $totalprice += $subtotal;
                $_SESSION['qnty']=$totalqunty+=$quantity;
              }
            }
            if(!empty($_SESSION['cart']))
            {

              ?>
              <span class="ec-cart-noti ec-header-count cart-count-lable"><?php echo $_SESSION['qnty'];?></span>
              <?php
            }else{?>
              <span class="ec-cart-noti ec-header-count cart-count-lable">0</span>
              <?php
            }
            ?>

          </a>
        </div>
        <div class="ec-nav-panel-icons">
          <a href="index.php" class="ec-header-btn"><img src="assets/images/icons/home.svg"
            class="svg_img header_svg" alt="icon" />
          </a>
        </div>
        <div class="ec-nav-panel-icons">
          <a href="wishlist.php" class="ec-header-btn"><img src="assets/images/icons/wishlist.svg"
            class="svg_img header_svg" alt="icon" />
            <?php
            if(strlen($_SESSION['login'])==0)
            {   
              ?>
              <span class="ec-cart-noti">0</span>
              <?php
            }
            else{
              $ret=mysqli_query($con,"select count(userId) as total  from wishlist where userId='".$_SESSION['id']."'");
              $num=mysqli_fetch_array($ret);
              $count=$num['total'];
              ?>
              <span class="ec-cart-noti"><?php echo $count?></span>
              <?php
            }?>
          </a>
        </div>
        <div class="ec-nav-panel-icons">
          <a href="login.php" class="ec-header-btn"><img src="assets/images/icons/user.svg"
            class="svg_img header_svg" alt="icon" />
          </a>
        </div>

      </div>
    </div>
  </div>
  <!-- Footer navigation panel for responsive display end -->

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
  <script src="assets/js/vendor/jquery.magnific-popup.min.js"></script>
  <script src="assets/js/plugins/jquery.sticky-sidebar.js"></script>
  <!-- Google translate Js -->
  <script src="assets/js/vendor/google-translate.js"></script>
  <script>
    function googleTranslateElementInit() {
      new google.translate.TranslateElement({ pageLanguage: 'en' }, 'google_translate_element');
    }
  </script>
  <!-- Main Js -->
  <script src="assets2/js/vendor/index.js"></script>
  <script src="assets2/js/main.js"></script>
  <script src="assets/js/form-validate2.js"></script>

</body>
</html>