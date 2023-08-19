<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');
if(strlen($_SESSION['login'])==0)
{   
  header('location:login.php');
}
if(isset($_GET['action']) && $_GET['action']=="add")
{
  $id=intval($_GET['id']);
  $query=mysqli_query($con,"delete from wishlist where productId='$id'");
  if(isset($_SESSION['cart'][$id])){
    $_SESSION['cart'][$id]['quantity']++;
  }else{
    $sql_p="SELECT * FROM tblproducts WHERE id={$id}";
    $query_p=mysqli_query($con,$sql_p);
    if(mysqli_num_rows($query_p)!=0){
      $row_p=mysqli_fetch_array($query_p);
      $_SESSION['cart'][$row_p['id']]=array("quantity" => 1, "price" => $row_p['ProductPrice']);  
      header('location:wishlist.php');
    }
    else{
      $message="Product ID is invalid";
    }
  }
}

// Code forProduct deletion from  wishlist  
$wid=intval($_GET['del']);
if(isset($_GET['del']))
{
  $query=mysqli_query($con,"delete from wishlist where id='$wid'");
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
  <link rel="stylesheet" href="assets/css/style.css" />
  <link rel="stylesheet" href="assets/css/demo.css" />
  <link rel="stylesheet" href="assets/css/responsive.css" />


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
              <h2 class="ec-breadcrumb-title">Wishlist</h2>
            </div>
            <div class="col-md-6 col-sm-12">
              <!-- ec-breadcrumb-list start -->
              <ul class="ec-breadcrumb-list">
                <li class="ec-breadcrumb-item"><a href="index.php">Home</a></li>
                <li class="ec-breadcrumb-item active">Wishlist</li>
              </ul>
              <!-- ec-breadcrumb-list end -->
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- Ec breadcrumb end -->

  <!-- Ec Wishlist page -->
  <section class="ec-page-content section-space-p">
    <div class="container">
      <div class="row">
        <!-- Compare Content Start -->
        <div class="ec-wish-rightside col-lg-12 col-md-12">
          <!-- Compare content Start -->
          <div class="ec-compare-content">
            <div class="ec-compare-inner">
              <div class="row margin-minus-b-30">
                <?php
                $ret=mysqli_query($con,"select tblproducts.ProductName as pname,tblproducts.ProductPrice as pprice,tblproducts.ProductImage,tblproducts.ProductImage2,tblproducts.id,wishlist.productId as pid,wishlist.id as wid from wishlist join tblproducts on tblproducts.id=wishlist.productId where wishlist.userId='".$_SESSION['id']."'");
                $num=mysqli_num_rows($ret);
                if($num>0)
                {
                  while ($row=mysqli_fetch_array($ret))
                  {
                    ?>

                    <div class="col-lg-3 col-md-4 col-sm-6 col-xs-6 mb-6 pro-gl-content">
                      <div class="ec-product-inner">
                        <div class="ec-pro-image-outer">
                          <div class="ec-pro-image">
                            <a href="product.php?pid=<?php echo htmlentities($row['id']);?>" class="image">
                              <img class="main-image"
                              src="admin/productimages/<?php echo htmlentities($row['ProductImage']);?>" alt="Product" />
                              <img class="hover-image"
                              src="admin/productimages/<?php echo htmlentities($row['ProductImage2']);?>" alt="Product" />
                            </a>
                            <span class="ec-com-remove ec-remove-wish"><a href="wishlist.php?del=<?php echo htmlentities($row['wid']);?>" onClick="return confirm('Are you sure you want to delete?')">×</a></span>
                            <span class="percentage">20%</span>
                            <a href="#" class="quickview" data-link-action="quickview"
                            title="Quick view" data-bs-toggle="modal"
                            data-bs-target="#ec_quickview_modal"><img
                            src="assets/images/icons/quickview.svg" class="svg_img pro_svg"
                            alt="" /></a>
                            <a href="wishlist.php?page=product&action=add&id=<?php echo $row['pid']; ?>">
                              <div class="ec-pro-actions">
                                <button title="Add To Cart" class=" add-to-cart"><img
                                  src="assets/images/icons/cart.svg" class="svg_img pro_svg"
                                  alt="" /> Add To Cart</button>
                                </div>
                              </a>
                            </div>
                          </div>
                          <div class="ec-pro-content">
                            <h5 class="ec-pro-title"><a href="product.php?pid=<?php echo htmlentities($row['id']);?>"><?php echo htmlentities($row['pname']);?></a></h5>
                            <div class="ec-pro-rating">
                              <i class="ecicon eci-star fill"></i>
                              <i class="ecicon eci-star fill"></i>
                              <i class="ecicon eci-star fill"></i>
                              <i class="ecicon eci-star fill"></i>
                              <i class="ecicon eci-star"></i>
                            </div>

                            <span class="ec-price">
                              <span class="old-price">$50.00</span>
                              <span class="new-price">UGX&nbsp;<?php echo htmlentities(number_format($row['pprice'], 0, '.', ','));?></span>
                            </span>                                   
                          </div>
                        </div>
                      </div>
                      <?php
                    }
                  }else{?>
                    <p><strong>You don't have product in wishlist</strong></p>
                  <?php } ?>
                </div>
              </div>
            </div>
            <!--compare content End -->
          </div>
          <!-- Compare Content end -->
        </div>
      </div>
    </section>
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