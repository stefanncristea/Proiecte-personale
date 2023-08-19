<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');
// Code for Remove a Product from Cart
if(isset($_GET['action']) && $_GET['action']=="remove")
{

  if(!empty($_SESSION["cart"])) {
    foreach($_SESSION["cart"] as $k => $v) {
      if($_GET["code"] == $k)
        unset($_SESSION["cart"][$k]); 
    }
  }
}
if(isset($_POST['submit'])){
  if(!empty($_SESSION['cart'])){
    foreach($_POST['quantity'] as $key => $val){
      if($val==0){
        unset($_SESSION['cart'][$key]);
      }else{
        $_SESSION['cart'][$key]['quantity']=$val;

      }
    }
    
    echo "<script type='text/javascript'> document.location ='cart.php'; </script>";
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

  <!-- Ec cart page -->
  <section class="ec-page-content section-space-p">
    <div class="container">
      <div class="row">
        <div class="ec-cart-leftside col-lg-8 col-md-12 ">
          <!-- cart content Start -->
          <div class="ec-cart-content">
            <div class="ec-cart-inner">
              <div class="row">
                <form action="#" method="post">
                  <div class="table-content cart-table-content">
                    <table>
                      <thead>
                        <tr>
                          <th>Product</th>
                          <th>Price</th>
                          <th style="text-align: center;">Quantity</th>
                          <th>Total</th>
                          <th></th>
                        </tr>
                      </thead>
                      <?php
                      if(!empty($_SESSION['cart']))
                      {
                        ?>
                        <tbody>
                          <?php
                          $pdtid=array();
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

                              array_push($pdtid,$row['id']);
                              ?>
                              <tr>
                                <td data-label="Product" class="ec-cart-pro-name"><a
                                  href="product.php?pid=<?php echo htmlentities($row['id']);?>"><img class="ec-cart-pro-img mr-4"
                                  src="admin/productimages/<?php echo htmlentities($row['ProductImage']);?>"
                                  alt="" /><?php echo $row['ProductName'];
                                  ?></a>
                                </td>
                                <td data-label="Price" class="ec-cart-pro-price"><span
                                  class="amount">$ &nbsp;<?php echo htmlentities(number_format($row['ProductPrice'], 0, '.', ','));?></span></td>
                                  <td data-label="Quantity" class="ec-cart-pro-qty"
                                  style="text-align: center;">
                                  <div class="cart-qty-plus-minus">
                                    <input type="number" value="<?php echo $_SESSION['cart'][$row['id']]['quantity']; ?>" name="quantity[<?php echo $row['id']; ?>]"  value="<?php echo $_SESSION['cart'][$row['id']]['quantity']; ?>"  />
                                  </div>
                                </td>
                                <td data-label="Total" class="ec-cart-pro-subtotal">$ &nbsp;
                                  <?php echo htmlentities(number_format($_SESSION['cart'][$row['id']]['quantity']*$row['ProductPrice'], 0, '.', ','));?></td>
                                  <td data-label="Remove" class="ec-cart-pro-remove">
                                    <a href="cart.php?action=remove&code=<?php echo $row['id']; ?>"><i class="ecicon eci-trash-o"></i></a>
                                  </td>
                                </tr>
                                <?php 
                              }
                            }
                            $_SESSION['pid']=$pdtid;
                            ?>

                          </tbody>
                          <?php
                        }else{?>
                          <tbody>
                            <tr>
                              <td colspan="4">
                                Your shopping cart is empty
                              </td>
                            </tr>

                          </tbody>
                          <?php
                        }
                        ?>
                      </table>
                    </div>
                    <div class="row">
                      <div class="col-lg-12">
                        <div class="ec-cart-update-bottom">
                          <a href="index.php">Continue Shopping</a>
                          <button class="btn btn-primary" type="submit" name="submit">Update shopping cart</button>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-lg-12">
                        <div class="ec-cart-update-bottom" style="float: right;">
                          <a href="checkout.php" class="btn btn-primary">
                            <span style="color: #ffffff; ">Check Out</span>
                          </a>
                        </div>
                      </div>
                    </div>
                  </form>
                </div>
              </div>
            </div>
            <!--cart content End -->
          </div>
          <!-- Sidebar Area Start -->
          <div class="ec-cart-rightside col-lg-4 col-md-12">
            <div class="ec-sidebar-wrap">
              <!-- Sidebar Summary Block -->
              <div class="ec-sidebar-block">
                <div class="ec-sb-title">
                  <h3 class="ec-sidebar-title">Summary</h3>
                </div>
                <div class="ec-sb-block-content">
                  <h4 class="ec-ship-title">Estimate Shipping</h4>
                  <div class="ec-cart-form">
                    <p>Enter your destination to get a shipping estimate</p>
                    <form action="#" method="post">
                      <span class="ec-cart-wrap">
                        <label>Country *</label>
                        <span class="ec-cart-select-inner">
                          <select name="ec_cart_country" id="ec-cart-select-country" class="ec-cart-select">
                            <option selected="" disabled="">United States</option>
                            <option value="1">Country 1</option>
                            <option value="2">Country 2</option>
                            <option value="3">Country 3</option>
                            <option value="4">Country 4</option>
                            <option value="5">Country 5</option>
                          </select>
                        </span>
                      </span>
                      <span class="ec-cart-wrap">
                        <label>State/Province</label>
                        <span class="ec-cart-select-inner">
                          <select name="ec_cart_state"  id="ec-cart-select-state" class="ec-cart-select">
                            <option selected="" disabled="">Please Select a region, state
                            </option>
                            <option value="1">Region/State 1</option>
                            <option value="2">Region/State 2</option>
                            <option value="3">Region/State 3</option>
                            <option value="4">Region/State 4</option>
                            <option value="5">Region/State 5</option>
                          </select>
                        </span>
                      </span>
                      <span class="ec-cart-wrap">
                        <label>Zip/Postal Code</label>
                        <input type="text" name="postalcode" placeholder="Zip/Postal Code">
                      </span>
                    </form>
                  </div>
                </div>

                <div class="ec-sb-block-content">
                  <div class="ec-cart-summary-bottom">
                    <div class="ec-cart-summary">
                      <div>
                        <span class="text-left">Sub-Total</span>
                        <span class="text-right">$<?php echo htmlentities(number_format($totalprice, 0, '.', ','));?></span>
                      </div>
                      <div>
                        <span class="text-left">Delivery Charges</span>
                        <span class="text-right">$80.00</span>
                      </div>
                      <div class="ec-cart-summary-total">
                        <span class="text-left">Total Amount</span>
                        <span class="text-right">$<?php echo htmlentities(number_format(($totalprice+'80'), 0, '.', ','));?></span>
                      </div>
                    </div>

                  </div>
                </div>
              </div>
              <!-- Sidebar Summary Block -->
            </div>
          </div>
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