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
  <meta name="msapplication-TileImage" content="assets/images/favicon/favicon.png" />

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
  <!-- Toastr -->
  <link rel="stylesheet" href="assets/toastr/toastr.min.css">
  <!-- SweetAlert2 -->
  <link rel="stylesheet" href="assets/sweetalert2/sweetalert2.css">
  <script src="assets/sweetalert2/sweetalert2.min.js"></script>
  <!-- Toastr -->
  <script src="assets/toastr/toastr.min.js"></script>

</head>
<body>
  <div id="ec-overlay"><span class="loader_img"></span></div>
  <?php
  $pid=intval($_GET['pid']);
  if(isset($_GET['pid']) && $_GET['action']=="wishlist" ){
    if(strlen($_SESSION['login'])==0)
    {   
      header('location:login.php');
    }
    else
    {
      $query=mysqli_query($con,"insert into wishlist(userId,productId) values('".$_SESSION['id']."','$pid')");
      if($query)
      {
        ?>
        <script >
          swal.fire({
            'title': 'Thank you',
            'text': 'Added successfuly',
            'icon': 'success',
            'type': 'success'
          }).then( () => {
            location.href = 'wishlist.php'
          })
        </script>
        <?php
      }
      else{
        echo "<script>alert('Something went wrong');</script>";
      }
    }
  }
  ?>
   <!-- Header start  -->
  <?php @include("includes/header.php");?>
  <!-- Header End  -->

  <!-- Ekka Cart Start -->
  <?php @include("includes/shoppingcart.php");?>
  <!-- Ekka Cart End -->

  <!-- Main Slider Start -->
  <div class="ec-main-slider section section-space-mb">
    <div class="ec-slider">
      <div class="ec-slide-item d-flex slide-1">
        <img src="assets/images/main-slider-banner/arrow-32.png" class="main_banner_arrow_img" alt="" />
        <div class="container align-self-center">
          <div class="row">
            <div class="col-xl-6 col-lg-7 col-md-7 col-sm-7 align-self-center">
              <div class="ec-slide-content slider-animation">
                <h2 class="ec-slide-stitle">High Speed</h2>
                <h1 class="ec-slide-title">3.2GH Core7 Desktop Machine</h1>
                <p>Introducing Dell Vostro. Fundamentally redesigned with latest technology & can work in powerful sectors like industries.</p>
                <span class="ec-slide-disc">Starting @<span>$900</span></span>
                <a href="product.php?pid=60" class="btn btn-lg btn-secondary">Shop Now</a>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="ec-slide-item d-flex slide-2">
        <img src="assets/images/main-slider-banner/arrow-32.png" class="main_banner_arrow_img" alt="" />
        <div class="container align-self-center">
          <div class="row">
            <div class="col-xl-6 col-lg-7 col-md-7 col-sm-7 align-self-center">
              <div class="ec-slide-content slider-animation">
                <h2 class="ec-slide-stitle">Powerful Laptop</h2>
                <h1 class="ec-slide-title">Dell Latitude.</h1>
                <p>Introducing Latitude vss4 model. Fundamentally redesigned and re-programmed to help
                to do heavy tasks with freeze.</p>
                <span class="ec-slide-disc">Starting @<span>$654</span></span>
                <a href="product.php?pid=64" class="btn btn-lg btn-secondary">Shop Now</a>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="ec-slide-item d-flex slide-3">
        <img src="assets/images/main-slider-banner/arrow-31.png" class="main_banner_arrow_img" alt="" />
        <div class="container align-self-center">
          <div class="row">
            <div class="col-xl-6 col-lg-7 col-md-7 col-sm-7 align-self-center">
              <div class="ec-slide-content slider-animation">
                <h2 class="ec-slide-stitle">Smooth & simple </h2>
                <h1 class="ec-slide-title">Samsung Galaxy</h1>
                <p>Introducing garaxy phone. Fundamentally redesigned and re-developed to help
                you stay even more active, healthy, and connected.</p>
                <span class="ec-slide-disc">Starting @<span>$400</span></span>
                <a href="product.php?pid=81" class="btn btn-lg btn-secondary">Shop Now</a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- Main Slider End -->

  <!-- About Start -->
  <section class="section ec-about-sec section-space-p">
    <div class="container">
      <div class="row">
        <div class="section-title d-none">
          <h2 class="ec-title">About</h2>
        </div>
        <div class="col-lg-6">
          <div class="ec-about">
            <img src="assets/images/about/about-11.jpg" alt="about-image">
          </div>
        </div>
        <div class="col-lg-6">
          <div class="ec-about-detail">
            <h4>Lenovo V15 laptop, with 1TB storage.</h4>
            <h5>The standard chunk of Lorem Ipsum used since the 1500s is reproduced below for those interested alteration in some form.</h5>
            <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.</p>
            <p>Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from in Virginia.</p>
            <a class="btn btn-lg btn-primary" href="product.php?pid=82">Buy Now</a>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- About End -->

  <!--  category Section Start -->
  <section class="section ec-category-section section-space-p">
    <div class="container">
      <div class="row">
        <div class="col-md-12 section-title-block">
          <div class="section-title">
            <h2 class="ec-title">Browse By Categories</h2>
            <p class="sub-title">Check out our feature products.</p>
          </div>
          <div class="section-btn">
            <span class="ec-section-btn"><a class="btn-primary" href="shop-left-sidebar-col-3.html">View All Categories</a></span>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="ec_cat_slider">
          <div class="ec_cat_content">
            <div class="ec_cat_inner">
              <div class="ec-cat-image">
                <img src="assets/images/category-image/28.jpg" alt="" />
              </div>
              <div class="ec-cat-desc">
                <span class="ec-section-btn"><a href="product.php?pid=70" class="btn-primary">Laptops</a></span>
              </div>
            </div>
          </div>
          <div class="ec_cat_content">
            <div class="ec_cat_inner">
              <div class="ec-cat-image">
                <img src="assets/images/category-image/27.jpg" alt="" />
              </div>
              <div class="ec-cat-desc">
                <span class="ec-section-btn"><a href="product.php?pid=79" class="btn-primary">Tablets</a></span>
              </div>
            </div>
          </div>
          <div class="ec_cat_content">
            <div class="ec_cat_inner">
              <div class="ec-cat-image">
                <img src="assets/images/category-image/24.jpg" alt="" />
              </div>
              <div class="ec-cat-desc">
                <span class="ec-section-btn"><a href="product.php?pid=66" class="btn-primary">Printers</a></span>
              </div>
            </div>
          </div>
          <div class="ec_cat_content">
            <div class="ec_cat_inner">
              <div class="ec-cat-image">
                <img src="assets/images/category-image/25.jpg" alt="" />
              </div>
              <div class="ec-cat-desc">
                <span class="ec-section-btn"><a href="product.php?pid=75" class="btn-primary">Phones</a></span>
              </div>
            </div>
          </div>
          <div class="ec_cat_content">
            <div class="ec_cat_inner">
              <div class="ec-cat-image">
                <img src="assets/images/category-image/26.jpg" alt="" />
              </div>
              <div class="ec-cat-desc">
                <span class="ec-section-btn"><a href="product.php?pid=61" class="btn-primary">Desktops</a></span>
              </div>
            </div>
          </div>
          <div class="ec_cat_content">
            <div class="ec_cat_inner">
              <div class="ec-cat-image">
                <img src="assets/images/category-image/22.jpg" alt="" />
              </div>
              <div class="ec-cat-desc">
                <span class="ec-section-btn"><a href="product.php?pid=78" class="btn-primary">Dell laptop</a></span>
              </div>
            </div>
          </div>
          <div class="ec_cat_content">
            <div class="ec_cat_inner">
              <div class="ec-cat-image">
                <img src="assets/images/category-image/23.jpg" alt="" />
              </div>
              <div class="ec-cat-desc">
                <span class="ec-section-btn"><a href="product.php?pid=81" class="btn-primary">Samsung Phone</a></span>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!--category Section End -->

  <!-- ec Banner Section Start -->
  <section class="ec-banner section section-space-p">
    <div class="container">
      <h2 class="d-none">Banner</h2>
      <div class="ec-banners">
        <div class="ec-banner-left col-sm-6">
          <div class="ec-banner-block ec-banner-block-1 col-sm-12">
            <div class="banner-block">
              <img src="assets/images/banner/32.jpg" alt="" />
              <div class="banner-content">
                <div class="banner-text">
                  <span class="ec-banner-stitle">20% Off ! Limited week deal</span>
                  <span class="ec-banner-title">New device</span>
                  <p>Lorem ipsum, or lipsum as it <br>is sometimes known, is dummy <br>since 1991.</p>
                </div>
                <span class="ec-banner-btn"><a href="product.php?pid=70" class="btn-primary">Discover Now</a></span>
              </div>
            </div>
          </div>
        </div>
        <div class="ec-banner-right col-sm-6">
          <div class="ec-banner-block ec-banner-block-2 col-sm-12">
            <div class="banner-block">
              <img src="assets/images/banner/33.jpg" alt="" />
              <div class="banner-content">
                <div class="banner-text">
                  <span class="ec-banner-stitle">Rezer’s</span>
                  <span class="ec-banner-title">Hp spectra</span>
                </div>
                <span class="ec-banner-btn"><a href="product.php?pid=63" class="btn-primary">Discover Now</a></span>
              </div>
            </div>
          </div>
          <div class="ec-banner-block ec-banner-block-3 col-sm-6">
            <div class="banner-block">
              <a href="product.php?pid=77">
                <img src="assets/images/banner/34.jpg" alt="" />
                <div class="banner-content">
                  <div class="banner-text">
                    <span class="ec-banner-stitle">Exlusive</span>
                    <span class="ec-banner-title">Headsets &amp; Phones</span>
                    <span class="ec-banner-desc">Starting <span>$500.00</span></span>
                  </div>
                </div>
              </a>
            </div>
          </div>
          <div class="ec-banner-block ec-banner-block-4 col-sm-6">
            <div class="banner-block">
              <a href="product.php?pid=79">
                <img src="assets/images/banner/35.jpg" alt="" />
                <div class="banner-content">
                  <div class="banner-text">
                    <span class="ec-banner-stitle">Best 2022 Tabs</span>
                    <span class="ec-banner-title">latest tablets </span>
                  </div>
                </div>
              </a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- ec Banner Section End -->

  <!-- Product tab Area Start -->
  <section class="section ec-product-tab section-space-p">
    <div class="container">
      <div class="row">
        <div class="col-md-12 section-title-block">
          <div class="section-title">
            <h2 class="ec-title">Exclusive Products</h2>
            <p class="sub-title">Check out our exclusive products.</p>
          </div>
          <div class="section-btn">
            <ul class="ec-pro-tab-nav nav">
              <li class="nav-item"><a class="nav-link active" data-bs-toggle="tab"
                href="#tab-pro-new-arrivals">New Arrivals</a>
              </li>
              <li class="nav-item"><a class="nav-link" data-bs-toggle="tab"
                href="#tab-pro-special-offer">Special Offer</a>
              </li>
              <li class="nav-item"><a class="nav-link" data-bs-toggle="tab"
                href="#tab-pro-best-sellers">Best Sellers</a>
              </li>
            </ul>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col">
          <div class="tab-content">
            <!-- 1st Product tab start -->
            <div class="tab-pane fade show active" id="tab-pro-new-arrivals">
              <div class="row">
                <div class="ec-pro-tab-slider">
                  <?php
                  $ret=mysqli_query($con,"select * from tblproducts where Status='New' order by rand()");
                  while ($row=mysqli_fetch_array($ret)) 
                  {
                    $discount=$row['ProductDiscount'];
                    ?>
                    <div class="col-lg-3 col-md-6 col-sm-6 col-xs-6 ec-product-content">
                      <div class="ec-product-inner">
                        <div class="ec-pro-image-outer">
                          <div class="ec-pro-image">
                            <a href="product.php?pid=<?php echo htmlentities($row['id']);?>" class="image">
                              <img class="main-image"
                              src="admin/productimages/<?php echo htmlentities($row['ProductImage']);?>"
                              alt="Product" />
                              <img class="hover-image"
                              src="admin/productimages/<?php echo htmlentities($row['ProductImage2']);?>"
                              alt="Product" />
                            </a>
                            <?php
                            if (!empty($discount))
                            {
                              ?>
                              <span class="flags">
                                <span class="percentage">-<?php echo htmlentities($row['ProductDiscount']);?>%</span>
                              </span>
                              <?php 
                            }
                            ?>

                            <div class="ec-pro-actions">
                              <a href="addcart.php?page=product&action=add&id=<?php echo $row['id']; ?>">
                                <button title="Add To Cart" class=" add-to-cart">
                                  <img
                                  src="assets/images/icons/cart.svg"
                                  class="svg_img pro_svg" alt="" />
                                </button>
                              </a>
                              <a href="#" class="ec-btn-group compare"
                              title="Compare"><img
                              src="assets/images/icons/compare.svg"
                              class="svg_img pro_svg" alt="" /></a>
                              <a href="index.php?pid=<?php echo htmlentities($row['id'])?>&&action=wishlist" class="ec-btn-group " title="Wishlist"><img
                                src="assets/images/icons/pro_wishlist.svg"
                                class="svg_img pro_svg" alt="" />
                              </a>
                            </div>
                          </div>
                        </div>
                        <div class="ec-pro-content">
                          <h5 class="ec-pro-title"><a href="product.php?pid=<?php echo htmlentities($row['id']);?>"><?php echo htmlentities($row['ProductName']);?></a>
                          </h5>
                          <span class="ec-price">
                            <span class="old-price">$&nbsp;<?php echo htmlentities(number_format($row['PriceBefore'], 0, '.', ','));?></span>
                            <span class="new-price">$&nbsp;<?php echo htmlentities(number_format($row['ProductPrice'], 0, '.', ','));?></span>
                          </span>
                        </div>
                      </div>
                    </div>
                    <?php
                  }
                  ?>
                </div>
              </div>
            </div>
            <!-- ec 1st Product tab end -->
            <!-- ec 2nd Product tab start -->
            <div class="tab-pane fade" id="tab-pro-special-offer">
              <div class="row">
                <div class="ec-pro-tab-slider">
                  <?php
                  $ret=mysqli_query($con,"select * from tblproducts where Status='Special' order by rand()");
                  while ($row=mysqli_fetch_array($ret)) 
                  {
                    $discount=$row['ProductDiscount'];
                    ?>
                    <div class="col-lg-3 col-md-6 col-sm-6 col-xs-6 ec-product-content">
                      <div class="ec-product-inner">
                        <div class="ec-pro-image-outer">
                          <div class="ec-pro-image">
                            <a href="product.php?pid=<?php echo htmlentities($row['id']);?>" class="image">
                              <img class="main-image"
                              src="admin/productimages/<?php echo htmlentities($row['ProductImage']);?>"
                              alt="Product" />
                              <img class="hover-image"
                              src="admin/productimages/<?php echo htmlentities($row['ProductImage2']);?>"
                              alt="Product" />
                            </a>
                            <?php
                            if (!empty($discount))
                            {
                              ?>
                              <span class="flags">
                                <span class="percentage">-<?php echo htmlentities($row['ProductDiscount']);?>%</span>
                              </span>
                              <?php 
                            }
                            ?>

                            <div class="ec-pro-actions">
                              <a href="addcart.php?page=product&action=add&id=<?php echo $row['id']; ?>">
                                <button title="Add To Cart" class=" add-to-cart">
                                  <img
                                  src="assets/images/icons/cart.svg"
                                  class="svg_img pro_svg" alt="" />
                                </button>
                              </a>
                              <a href="#" class="ec-btn-group compare"
                              title="Compare"><img
                              src="assets/images/icons/compare.svg"
                              class="svg_img pro_svg" alt="" /></a>
                              <a href="index.php?pid=<?php echo htmlentities($row['id'])?>&&action=wishlist" class="ec-btn-group" title="Wishlist"><img
                                src="assets/images/icons/pro_wishlist.svg"
                                class="svg_img pro_svg" alt="" />
                              </a>
                            </div>
                          </div>
                        </div>
                        <div class="ec-pro-content">
                          <h5 class="ec-pro-title"><a href="product.php?pid=<?php echo htmlentities($row['id']);?>"><?php echo htmlentities($row['ProductName']);?></a>
                          </h5>
                          <span class="ec-price">
                            <span class="old-price">$&nbsp;<?php echo htmlentities(number_format($row['ProductPrice'], 0, '.', ','));?></span>
                            <span class="new-price">$&nbsp;<?php echo htmlentities(number_format($row['PriceBefore'], 0, '.', ','));?></span>
                          </span>
                        </div>
                      </div>
                    </div>
                    <?php
                  }
                  ?>
                </div>
              </div>
            </div>
            <!-- ec 2nd Product tab end -->
            <!-- ec 3rd Product tab start -->
            <div class="tab-pane fade" id="tab-pro-best-sellers">
              <div class="row">
                <div class="ec-pro-tab-slider">
                  <?php
                  $ret=mysqli_query($con,"select * from tblproducts where Status='Best' order by rand()");
                  while ($row=mysqli_fetch_array($ret)) 
                  {
                    $discount=$row['ProductDiscount'];
                    ?>
                    <div class="col-lg-3 col-md-6 col-sm-6 col-xs-6 ec-product-content">
                      <div class="ec-product-inner">
                        <div class="ec-pro-image-outer">
                          <div class="ec-pro-image">
                            <a href="product.php?pid=<?php echo htmlentities($row['id']);?>" class="image">
                              <img class="main-image"
                              src="admin/productimages/<?php echo htmlentities($row['ProductImage']);?>"
                              alt="Product" />
                              <img class="hover-image"
                              src="admin/productimages/<?php echo htmlentities($row['ProductImage2']);?>"
                              alt="Product" />
                            </a>
                            <?php
                            if (!empty($discount))
                            {
                              ?>
                              <span class="flags">
                                <span class="percentage">-<?php echo htmlentities($row['ProductDiscount']);?>%</span>
                              </span>
                              <?php 
                            }
                            ?>

                            <div class="ec-pro-actions">
                              <a href="addcart.php?page=product&action=add&id=<?php echo $row['id']; ?>">
                                <button title="Add To Cart" class=" add-to-cart">
                                  <img
                                  src="assets/images/icons/cart.svg"
                                  class="svg_img pro_svg" alt="" />
                                </button>
                              </a>
                              <a href="#" class="ec-btn-group compare"
                              title="Compare"><img
                              src="assets/images/icons/compare.svg"
                              class="svg_img pro_svg" alt="" /></a>
                              <a  href="index.php?pid=<?php echo htmlentities($row['id'])?>&&action=wishlist" class="ec-btn-group " title="Wishlist"><img
                                src="assets/images/icons/pro_wishlist.svg"
                                class="svg_img pro_svg" alt="" />
                              </a>
                            </div>
                          </div>
                        </div>
                        <div class="ec-pro-content">
                          <h5 class="ec-pro-title"><a href="product.php?pid=<?php echo htmlentities($row['id']);?>"><?php echo htmlentities($row['ProductName']);?></a>
                          </h5>
                          <span class="ec-price">
                            <span class="old-price">$&nbsp;<?php echo htmlentities(number_format($row['ProductPrice'], 0, '.', ','));?></span>
                            <span class="new-price">$&nbsp;<?php echo htmlentities(number_format($row['PriceBefore'], 0, '.', ','));?></span>
                          </span>
                        </div>
                      </div>
                    </div>
                    <?php
                  }
                  ?>
                </div>
              </div>
            </div>
            <!-- ec 3rd Product tab end -->
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- ec Product tab Area End -->

  <!--  offer Section Start -->
  <section class="section ec-offer-section section-space-mt section-space-mb">
    <h2 class="d-none">Offer</h2>
    <div class="container">
      <div class="ec-banner-info-10">
        <div class="ec-offer-inner">
          <div class="col-sm-4 ec-offer-content">
            <h2 class="ec-offer-stitle">Black Friday</h2>
            <h2 class="ec-offer-title">40% off</h2>
            <span class="ec-offer-desc">All Electronic Devices</span>
            <div class="countdowntimer"><span id="ec-offer-count"></span></div>
            <span class="ec-offer-btn"><a href="#" class="btn btn-lg btn-secondary">Shop Now</a></span>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- offer Section End -->

  <!-- Trending Item Start -->
  <section class="section ec-trend-product section-space-p">
    <div class="container">
      <div class="row">
        <div class="col-md-12 section-title-block">
          <div class="section-title">
            <h2 class="ec-title">Trending Item</h2>
            <p class="sub-title">Check out our trending products.</p>
          </div>
          <div class="section-btn">
            <span class="ec-section-btn"><a class="btn-secondary" href="#">View All</a></span>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="ec-trend-slider">
          <?php
          $ret=mysqli_query($con,"select * from tblproducts order by rand()");
          while ($row=mysqli_fetch_array($ret)) 
          {
            $status=$row['Status'];
            ?>
            <div class="col-lg-3 col-md-6 col-sm-6 col-xs-6 ec-product-content">
              <div class="ec-product-inner">
                <div class="ec-pro-image-outer">
                  <div class="ec-pro-image">
                    <a href="product.php?pid=<?php echo htmlentities($row['id']);?>" class="image">
                      <img class="main-image"
                      src="admin/productimages/<?php echo htmlentities($row['ProductImage']);?>"
                      alt="Product" />
                      <img class="hover-image"
                      src="admin/productimages/<?php echo htmlentities($row['ProductImage2']);?>"
                      alt="Product" />
                    </a>
                    <?php
                    if ($status=='New')
                    {
                      ?>
                      <span class="flags"><span class="sale">Top Seller</span></span>
                      <?php 
                    }
                    ?>
                    <div class="ec-pro-actions">
                      <a href="addcart.php?page=product&action=add&id=<?php echo $row['id']; ?>">
                        <button title="Add To Cart" class=" add-to-cart"><img
                          src="assets/images/icons/cart.svg"
                          class="svg_img pro_svg" alt="" />
                        </button>
                      </a>
                      <a href="#" class="ec-btn-group compare"
                      title="Compare"><img
                      src="assets/images/icons/compare.svg"
                      class="svg_img pro_svg" alt="" /></a>
                      <a href="index.php?pid=<?php echo htmlentities($row['id'])?>&&action=wishlist" class="ec-btn-group" title="Wishlist"><img
                        src="assets/images/icons/pro_wishlist.svg"
                        class="svg_img pro_svg" alt="" />
                      </a>
                    </div>
                  </div>
                </div>
                <div class="ec-pro-content">
                  <h5 class="ec-pro-title"><a href="product.php?pid=<?php echo htmlentities($row['id']);?>"><?php echo htmlentities($row['ProductName']);?></a>
                  </h5>
                  <span class="ec-price">
                    <span class="old-price">$&nbsp;<?php echo htmlentities(number_format($row['PriceBefore'], 0, '.', ','));?></span>
                    <span class="new-price">$&nbsp;<?php echo htmlentities(number_format($row['ProductPrice'], 0, '.', ','));?></span>
                  </span>
                </div>
              </div>
            </div>
            <?php
          }?>
        </div>
      </div>
    </div>
  </section>
  <!-- Trending Item end -->

  <!--  services Section Start -->
  <section class="section ec-services-section section-space-p">
    <h2 class="d-none">Services</h2>
    <div class="container">
      <div class="row mb-minus-30">

        <div class="ec_ser_content ec_ser_content_1 col-sm-12 col-md-3">
          <div class="ec_ser_inner">
            <div class="ec-service-image">
              <img src="assets/images/icons/service_1.svg" class="svg_img" alt="service" />
            </div>
            <div class="ec-service-desc">
              <h2>Quick Delivery</h2>
              <p>For Order Over $100.</p>
            </div>
          </div>
        </div>
        <div class="ec_ser_content ec_ser_content_2 col-sm-12 col-md-3">
          <div class="ec_ser_inner">
            <div class="ec-service-image">
              <img src="assets/images/icons/service_3.svg" class="svg_img" alt="service" />
            </div>
            <div class="ec-service-desc">
              <h2>Free Returns</h2>
              <p>Easy & Free Return.</p>
            </div>
          </div>
        </div>
        <div class="ec_ser_content ec_ser_content_3 col-sm-12 col-md-3">
          <div class="ec_ser_inner">
            <div class="ec-service-image">
              <img src="assets/images/icons/service_2.svg" class="svg_img" alt="service" />
            </div>
            <div class="ec-service-desc">
              <h2>24/7 Support</h2>
              <p>Free Online Support.</p>
            </div>
          </div>
        </div>
        <div class="ec_ser_content ec_ser_content_3 col-sm-12 col-md-3">
          <div class="ec_ser_inner">
            <div class="ec-service-image">
              <img src="assets/images/icons/service_4.svg" class="svg_img" alt="service" />
            </div>
            <div class="ec-service-desc">
              <h2>Secure Payment</h2>
              <p>Refund Guaranteed.</p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!--services Section End -->

  <!-- ec testimonial Start -->
  <section class="section ec-test-section section-space-p">
    <div class="container">
      <div class="row">
        <div class="col-md-12 section-title-block">
          <div class="section-title">
            <h2 class="ec-title">Testimonial</h2>
            <p class="sub-title">What our clients say about us!</p>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="ec-test-outer">
          <ul id="ec-testimonial-slider">
            <li class="ec-test-item">
              <div class="ec-test-inner">
                <div class="ec-test-img"><img alt="testimonial" title="testimonial"
                  src="assets/images/testimonial/face31.jpg" />
                </div>
                <div class="ec-test-content">
                  <div class="ec-test-icon"><img src="assets/images/testimonial/quote-3.svg"
                    class="svg_img test_svg" alt="" />
                  </div>
                  <div class="ec-test-desc">Lorem ipsum dolor sit amet, consectetur adipiscing elit,
                    sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad
                  minim veniam.</div>
                  <div class="ec-test-name-info"> 
                    <div class="ec-test-name">Nicole Brown</div>
                    <div class="ec-test-designation">Manager of AZAM</div>
                  </div>
                </div>
              </div>
            </li>
            <li class="ec-test-item">
              <div class="ec-test-inner">
                <div class="ec-test-img"><img alt="testimonial" title="testimonial"
                  src="assets/images/testimonial/face30.jpg" />
                </div>
                <div class="ec-test-content">
                  <div class="ec-test-icon"><img src="assets/images/testimonial/quote-3.svg"
                    class="svg_img test_svg" alt="" />
                  </div>
                  <div class="ec-test-desc">Lorem ipsum dolor sit amet, consectetur adipiscing elit,
                    sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad
                  minim veniam.</div>
                  <div class="ec-test-name-info">
                    <div class="ec-test-name">Mark Rashford</div>
                    <div class="ec-test-designation">Manager of AZAM</div>
                  </div>
                </div>
              </div>
            </li>
            <li class="ec-test-item">
              <div class="ec-test-inner">
                <div class="ec-test-img"><img alt="testimonial" title="testimonial"
                  src="assets/images/testimonial/face29.jpg" />
                </div>
                <div class="ec-test-content">
                  <div class="ec-test-icon"><img src="assets/images/testimonial/quote-3.svg"
                    class="svg_img test_svg" alt="" />
                  </div>
                  <div class="ec-test-desc">Lorem ipsum dolor sit amet, consectetur adipiscing elit,
                    sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad
                  minim veniam.</div>
                  <div class="ec-test-name-info">
                    <div class="ec-test-name">Holly Linda</div>
                    <div class="ec-test-designation">Manager of AZAM</div>
                  </div>
                </div>
              </div>
            </li>
          </ul>
        </div>
      </div>
    </div>
  </section>
  <!-- ec testimonial end -->

  <!-- Ec Brand Section Start -->
  <section class="section ec-brand-area section-space-p">
    <h2 class="d-none">Brands</h2>
    <div class="container">
      <div class="row">
        <div class="ec-brand-outer">
          <ul id="ec-brand-slider">
            <li class="ec-brand-item"  data-animation="zoomIn">
              <div class="ec-brand-img">
                <a href="#">
                  <img alt="brand" title="brand" src="assets/images/brand-image/apple.png" />
                </a>
              </div>
            </li>
            <li class="ec-brand-item"  data-animation="zoomIn">
              <div class="ec-brand-img">
                <a href="#">
                  <img alt="brand" title="brand" src="assets/images/brand-image/dell.png" />
                </a>
              </div>
            </li>
            <li class="ec-brand-item"  data-animation="zoomIn">
              <div class="ec-brand-img">
                <a href="#">
                  <img alt="brand" title="brand" src="assets/images/brand-image/hauwei.png" />
                </a>
              </div>
            </li>
            <li class="ec-brand-item"  data-animation="zoomIn">
              <div class="ec-brand-img">
                <a href="#">
                  <img alt="brand" title="brand" src="assets/images/brand-image/hp.png" />
                </a>
              </div>
            </li>
            <li class="ec-brand-item"  data-animation="zoomIn">
              <div class="ec-brand-img">
                <a href="#">
                  <img alt="brand" title="brand" src="assets/images/brand-image/lg.png" />
                </a>
              </div>
            </li>
            <li class="ec-brand-item"  data-animation="zoomIn">
              <div class="ec-brand-img">
                <a href="#">
                  <img alt="brand" title="brand" src="assets/images/brand-image/samsung.png" />
                </a>
              </div>
            </li>
            <li class="ec-brand-item"  data-animation="zoomIn">
              <div class="ec-brand-img">
                <a href="#">
                  <img alt="brand" title="brand" src="assets/images/brand-image/sony.png" />
                </a>
              </div>
            </li>
            <li class="ec-brand-item"  data-animation="zoomIn">
              <div class="ec-brand-img">
                <a href="#">
                  <img alt="brand" title="brand" src="assets/images/brand-image/spacex.png" />
                </a>
              </div>
            </li>
          </ul>
        </div>
      </div>
    </div>
  </section>
  <!-- Ec Brand Section End -->

  <!-- Ec Instagram Start -->
  <section class="section ec-instagram-section section-space-p">
    <div class="container">
      <div class="row">
        <div class="col-md-12 section-title-block">
          <div class="section-title">
            <h2 class="ec-title">Facebook <span>#Electro_store</span></h2>
            <p class="sub-title">Add Stories on facebook and tell us how impact our product in your life.
            </p>
          </div>
          <div class="section-btn">
            <span class="ec-section-btn"><a class="btn-secondary" href="#">Follow Us</a></span>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="ec-insta-wrapper">
          <div class="ec-insta-outer">
            <div class="insta-auto">
              <!-- instagram item -->
              <div class="ec-insta-item">
                <div class="ec-insta-inner">
                  <a href="#" target="_blank"><img src="assets/images/instragram-image/20.jpg" alt=""></a>
                </div>
              </div>
              <!-- instagram item -->
              <div class="ec-insta-item">
                <div class="ec-insta-inner">
                  <a href="#" target="_blank"><img src="assets/images/instragram-image/21.jpg" alt=""></a>
                </div>
              </div>
              <!-- instagram item -->
              <div class="ec-insta-item">
                <div class="ec-insta-inner">
                  <a href="#" target="_blank"><img src="assets/images/instragram-image/22.jpg" alt=""> </a>
                </div>
              </div>
              <!-- instagram item -->
              <div class="ec-insta-item">
                <div class="ec-insta-inner">
                  <a href="#" target="_blank"><img src="assets/images/instragram-image/23.jpg" alt=""></a>
                </div>
              </div>
              <!-- instagram item -->
              <div class="ec-insta-item">
                <div class="ec-insta-inner">
                  <a href="#" target="_blank"><img src="assets/images/instragram-image/24.jpg" alt=""></a>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- Ec Instagram End -->

  <!-- Footer Start -->
  <?php @include("includes/footer.php");?>
  <!-- Footer Area End -->

  <!-- FB Chat Messenger -->
  <div class="ec-fb-style fb-right-bottom">

    <!-- Start Floating Panel Container -->
    <div class="fb-panel">
      <!-- Panel Content -->
      <div class="fb-header">
        <img src="assets/images/user/4.jpg" alt="pic" />
        <h2>Linda Michelle</h2>
        <p>Technical Manager</p>
      </div>
      <div class="fb-body">
        <p><b>Hey there &#128515;</b></p>
        <p>Need help ? just send me a message.</p>
      </div>
      <div class="fb-footer">

        <a href="contactus.php" target="_blank" class="fb-msg-button">
          <span>Send Message</span>
          <svg width="13px" height="10px" viewBox="0 0 13 10">
            <path d="M1,5 L11,5"></path>
            <polyline points="8 1 12 5 8 9"></polyline>
          </svg>
        </a>

      </div>
    </div>
    <!--/ End Floating Panel Container -->

    <!-- Start Right Floating Button -->
    <div class="fb-button fb-right-bottom">
      <img class="fa-messenger" src="assets/images/icons/chat-icon.png" alt="icon" />
    </div>
    <!--/ End Right Floating Button -->

  </div>
  <!-- FB Chat Messenger end -->

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

  <!-- <script src="assets/js/main.js"></script> -->

  <!-- Main Js -->
  <script src="assets/js/vendor/index.js"></script>
  <script src="assets/js/demo.js"></script>

</body>
</html>