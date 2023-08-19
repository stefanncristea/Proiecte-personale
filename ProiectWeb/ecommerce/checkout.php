<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');
// Code for User login
if(isset($_POST['login']))
{
  $email=$_POST['email'];
  $password=md5($_POST['password']);
  $query=mysqli_query($con,"SELECT * FROM users WHERE email='$email' and password='$password'");
  $num=mysqli_fetch_array($query);
  if($num>0)
  {

    $_SESSION['login']=$num['email'];
    $_SESSION['id']=$num['id'];
    $_SESSION['contact']=$num['contactno'];
    $_SESSION['username']=$num['name'];

    echo "<script type='text/javascript'> document.location ='checkout.php'; </script>";
  }
  else
  {
    echo "<script>alert('failed wrong credentials!');</script>";
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
 <link rel="stylesheet" href="assets/css/style.css" />
 <link rel="stylesheet" href="assets/css/demo.css" />
 <link rel="stylesheet" href="assets/css/responsive.css" />

 <!-- Background css -->
 <link rel="stylesheet" id="bg-switcher-css" href="assets/css/backgrounds/bg-4.css">
 <!-- Toastr -->
 <link rel="stylesheet" href="assets/toastr/toastr.min.css">
 <!-- SweetAlert2 -->
 <link rel="stylesheet" href="assets/sweetalert2/sweetalert2.css">
 <script src="assets/sweetalert2/sweetalert2.min.js"></script>
 <!-- Toastr -->
 <script src="assets/toastr/toastr.min.js"></script>

</head>
<body class="checkout_page">
  <?php 

// code for insert product in order table
  if(isset($_POST['ordersubmit'])) 
  {
    if(strlen($_SESSION['id'])==0)
    {   
      header('location:login.php');
    }
    else
    {
      $invoice = mt_rand(100000000, 999999999);
      $payment='Cash On Delivery';
      $ordernote=$_POST['ordernote'];
      $quantity=$_POST['quantity'];
      $pdd=$_SESSION['pid'];
      $value=array_combine($pdd,$quantity);
      foreach($value as $qty=> $val34)
      {
        $ret=mysqli_query($con,"select * from tblproducts where id='$qty'");
        while($row=mysqli_fetch_array($ret))
        {
          $quantity=$row['Quantity'];
          $newqtyleft = ($quantity-$val34);
          $sql3="update  tblproducts set Quantity=:newqtyleft where id='$qty'";
          $query=$dbh->prepare($sql3);
          $query->bindParam(':newqtyleft',$newqtyleft,PDO::PARAM_STR);
          $query->execute();
        }
        
        $lastInsertId=mysqli_query($con,"insert into orders(userId,productId,quantity,orderNote,paymentMethod,InvoiceNumber) values('".$_SESSION['id']."','$qty','$val34','$ordernote','$payment','$invoice')");

        if($lastInsertId)
        {
          unset($_SESSION['cart']);
          ?>
          <script >
            swal.fire({
              'title': 'Thank you',
              'text': 'Order Placed successfuly',
              'icon': 'success',
              'type': 'success'
            }).then( () => {
              location.href = 'user-history.php'
            })
          </script>
          <?php
        }
        else{
          echo "<script>alert('Something went wrong, Try again later');</script>";
        }
      }
    }
  }
  ?>
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
              <h2 class="ec-breadcrumb-title">Checkout</h2>
            </div>
            <div class="col-md-6 col-sm-12">
              <!-- ec-breadcrumb-list start -->
              <ul class="ec-breadcrumb-list">
                <li class="ec-breadcrumb-item"><a href="index.php">Home</a></li>
                <li class="ec-breadcrumb-item active">Checkout</li>
              </ul>
              <!-- ec-breadcrumb-list end -->
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- Ec breadcrumb end -->

  <!-- Ec checkout page -->
  <section class="ec-page-content section-space-p">
    <div class="container">
      <div class="row">
        <div class="ec-checkout-leftside col-lg-8 col-md-12 ">
          <!-- checkout content Start -->
          <div class="ec-checkout-content">
            <div class="ec-checkout-inner">
              <?php if(strlen($_SESSION['id'])==0 ) 
              {   ?>
                <div class="ec-checkout-wrap margin-bottom-30">

                  <div class="ec-checkout-block ec-check-new">
                    <h3 class="ec-checkout-title">New Customer</h3>
                    <div class="ec-check-block-content">
                      <div class="ec-check-subtitle">Checkout Options</div>
                      <form action="#">
                        <span class="ec-new-option">
                          <span>
                            <input type="radio" id="account1" name="radio-group" checked>
                            <label for="account1">Register Account</label>
                          </span>
                        <!-- <span>
                          <input type="radio" id="account2" name="radio-group">
                          <label for="account2">Guest Account</label>
                        </span> -->
                      </span>
                    </form>
                    <div class="ec-new-desc">By creating an account you will be able to shop faster,
                      be up to date on an order's status, and keep track of the orders you have
                      previously made.
                    </div>
                    <div class="ec-new-btn"><a href="register.php" class="btn btn-primary">Continue</a>
                    </div>

                  </div>
                </div>
                <div class="ec-checkout-block ec-check-login">
                  <h3 class="ec-checkout-title">Returning Customer</h3>
                  <div class="ec-check-login-form">
                    <form action="#" method="post">
                      <span class="ec-check-login-wrap">
                        <label>Email Address</label>
                        <input type="text" name="email" placeholder="Enter your email address"
                        required />
                      </span>
                      <span class="ec-check-login-wrap">
                        <label>Password</label>
                        <input type="password" name="password" placeholder="Enter your password"
                        required />
                      </span>

                      <span class="ec-check-login-wrap ec-check-login-btn">
                        <button class="btn btn-primary" type="submit" name="login" type="submit">Login</button>
                        <a class="ec-check-login-fp" href="forgot_password.php">Forgot Password?</a>
                      </span>
                    </form>
                  </div>
                </div>
              </div>
              <?php
            } else{ ?>
              <div class="ec-checkout-wrap margin-bottom-30 padding-bottom-3">
                <div class="ec-checkout-block ec-check-bill">
                  <h3 class="ec-checkout-title">Billing Details</h3>
                  <div class="ec-bl-block-content">
                    <div class="ec-check-subtitle">Checkout Options</div>
                    <span class="ec-bill-option">
                      <span>
                        <input type="radio" id="bill1" name="radio-group" checked>
                        <label for="bill1">I want to use an existing address</label>
                      </span>
                      <!-- <span>
                        <input type="radio" id="bill2" name="radio-group" checked>
                        <label for="bill2">I want to use new address</label>
                      </span> -->
                    </span>
                    <div class="ec-check-bill-form">
                      <form action="#" method="post">
                        <?php
                        $query=mysqli_query($con,"select * from users where id='".$_SESSION['id']."'");
                        while($row=mysqli_fetch_array($query))
                        {
                          ?>
                          <span class="ec-bill-wrap ec-bill-half">
                            <label>Names*</label>
                            <input type="text" name="firstname"
                            placeholder="Enter your first name" value="<?php echo $row['name'];?>" required />
                          </span>
                          <span class="ec-bill-wrap ec-bill-half">
                            <label>Phone*</label>
                            <input type="text" name="lastname" value="<?php echo $row['contactno'];?>" 
                            placeholder="Enter your contact" required />
                          </span>
                          <span class="ec-bill-wrap">
                            <label>Address</label>
                            <input type="text" name="address" value="<?php echo $row['billingAddress'];?>" placeholder="Address Line 1" />
                          </span>
                          <span class="ec-bill-wrap ec-bill-half">
                            <label>City *</label>
                            <span class="ec-bl-select-inner">
                              <select name="ec_select_city" id="ec-select-city" class="ec-bill-select">
                                <option selected disabled><?php echo $row['billingCity'];?></option>
                                <option value="1">City 1</option>
                                <option value="2">City 2</option>
                                <option value="3">City 3</option>
                                <option value="4">City 4</option>
                                <option value="5">City 5</option>
                              </select>
                            </span>
                          </span>
                          <span class="ec-bill-wrap ec-bill-half">
                            <label>Post Code</label>
                            <input type="text" name="postalcode" value="<?php echo $row['billingZipcode'];?>" placeholder="Post Code" />
                          </span>
                          <span class="ec-bill-wrap ec-bill-half">
                            <label>Country *</label>
                            <span class="ec-bl-select-inner">
                              <select name="ec_select_country" id="ec-select-country" class="ec-bill-select">
                                <option selected disabled><?php echo $row['billingCountry'];?></option>
                                <option value="1">Country 1</option>
                                <option value="2">Country 2</option>
                                <option value="3">Country 3</option>
                                <option value="4">Country 4</option>
                                <option value="5">Country 5</option>
                              </select>
                            </span>
                          </span>
                          <span class="ec-bill-wrap ec-bill-half">
                            <label>Region State</label>
                            <span class="ec-bl-select-inner">
                              <select name="ec_select_state" id="ec-select-state" class="ec-bill-select">
                                <option selected disabled><?php echo $row['billingState'];?></option>
                                <option value="1">Region/State 1</option>
                                <option value="2">Region/State 2</option>
                                <option value="3">Region/State 3</option>
                                <option value="4">Region/State 4</option>
                                <option value="5">Region/State 5</option>
                              </select>
                            </span>
                          </span>
                          <?php 
                        } ?>
                      </form>
                    </div>
                  </div>
                </div>

              </div>
              <?php 
            } ?>
            <!-- <span class="ec-check-order-btn">
              <a class="btn btn-primary" href="#">Place Order</a>
            </span> -->
          </div>
        </div>
        <!--cart content End -->
      </div>
      <!-- Sidebar Area Start -->
      <div class="ec-checkout-rightside col-lg-4 col-md-12">
        <div class="ec-sidebar-wrap">
          <!-- Sidebar Summary Block -->
          <div class="ec-sidebar-block">
            <div class="ec-sb-title">
              <h3 class="ec-sidebar-title">Summary</h3>
            </div>
            <div class="ec-sb-block-content">

              <div class="ec-checkout-summary">
                <?php
                $pdtid=array();
                $sql = "SELECT * FROM tblproducts WHERE id IN(";
                foreach($_SESSION['cart'] as $id => $value){
                  $sql .=$id. ",";
                }
                $sql=substr($sql,0,-1) . ") ORDER BY id ASC";
                $query = mysqli_query($con,$sql);
                $totalprice=0;
                if(!empty($query)){
                  while($row = mysqli_fetch_array($query))
                  {
                    $quantity=$_SESSION['cart'][$row['id']]['quantity'];
                    $_SESSION['quantity']=$_SESSION['cart'][$row['id']]['quantity'];
                    $subtotal= $_SESSION['cart'][$row['id']]['quantity']*$row['ProductPrice'];
                    $totalprice += $subtotal;
                    array_push($pdtid,$row['id']);
                  }
                }
                ?>
                <div>
                  <span class="text-left">Sub-Total</span>
                  <span class="text-right">UGX&nbsp;<?php echo htmlentities(number_format("$totalprice", 0, '.', ','));?></span>
                </div>

                <div>
                  <span class="text-left">Delivery Charges</span>
                  <span class="text-right">UGX&nbsp;80.00</span>
                </div>
                    <!-- <div>
                      <span class="text-left">Coupan Discount</span>
                      <span class="text-right"><a class="ec-checkout-coupan">Apply Coupan</a></span>
                    </div>
                    <div class="ec-checkout-coupan-content">
                      <form class="ec-checkout-coupan-form" name="ec-checkout-coupan-form"
                      method="post" action="#">
                      <input class="ec-coupan" type="text" required=""
                      placeholder="Enter Your Coupan Code" name="ec-coupan" value="">
                      <button class="ec-coupan-btn button btn-primary" type="submit"
                      name="subscribe" value="">Apply</button>
                    </form>
                  </div> -->

                  <div class="ec-checkout-summary-total">
                    <span class="text-left">Total Amount</span>
                    <span class="text-right">UGX&nbsp;<?php echo htmlentities(number_format(("$totalprice"+'80'), 0, '.', ','));?></span>
                  </div>

                </div>
                <div class="ec-checkout-pro">
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
                      ?>
                      <div class="col-sm-12 mb-6">
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
                            </div>
                          </div>
                          <div class="ec-pro-content">
                            <h5 class="ec-pro-title"><a href="product.php?pid=<?php echo htmlentities($row['id']);?>"><?php echo $row['ProductName']; ?></a></h5>
                            <div class="ec-pro-rating">
                              <i class="ecicon eci-star fill"></i>
                              <i class="ecicon eci-star fill"></i>
                              <i class="ecicon eci-star fill"></i>
                              <i class="ecicon eci-star fill"></i>
                              <i class="ecicon eci-star"></i>
                            </div>
                            <span class="ec-price">
                              <span class="new-price">UGX&nbsp;<?php echo htmlentities(number_format($row['ProductPrice'], 0, '.', ','));?>&nbsp;<span style="color: #444444;">X</span>&nbsp;
                              <span style="color: #124c92;"><?php echo $_SESSION['cart'][$row['id']]['quantity']; ?></span>
                            </span>
                          </span>
                        </div>
                      </div>
                    </div>
                    <?php
                  }
                }
                ?>
              </div>
            </div>
          </div>
          <!-- Sidebar Summary Block -->
        </div>
        <div class="ec-sidebar-wrap ec-checkout-pay-wrap">
          <!-- Sidebar Payment Block -->
          <div class="ec-sidebar-block">
            <div class="ec-sb-title">
              <h3 class="ec-sidebar-title">Payment Method</h3>
            </div>
            <div class="ec-sb-block-content">
              <div class="ec-checkout-pay">
                <div class="ec-pay-desc">Please select the preferred payment method to use on this
                order.</div>
                <form action="#" method="post">
                  <?php
                  $pdtid=array();
                  $sql = "SELECT * FROM tblproducts WHERE id IN(";
                  foreach($_SESSION['cart'] as $id => $value){
                    $sql .=$id. ",";
                  }
                  $sql=substr($sql,0,-1) . ") ORDER BY id ASC";
                  $query = mysqli_query($con,$sql);
                  if(!empty($query)){
                    while($row = mysqli_fetch_array($query))
                    {
                      $quantity=$_SESSION['cart'][$row['id']]['quantity'];

                      array_push($pdtid,$row['id']);
                      ?>
                      <span>
                        <input type="hidden" value="<?php echo $_SESSION['cart'][$row['id']]['quantity']; ?>" name="quantity[<?php echo $row['id']; ?>]">
                      </span>
                      <?php
                      $_SESSION['pid']=$pdtid;
                    }
                  }?>
                  <span class="ec-pay-option">
                    <span>
                      <input type="radio" id="pay1" name="radio-group" checked>
                      <label for="pay1">Cash On Delivery</label>
                    </span>
                  </span>
                  <span class="ec-pay-commemt">
                    <span class="ec-pay-opt-head">Add Comments About Your Order</span>
                    <textarea name="ordernote" placeholder="Comments"></textarea>
                  </span>
                  <span class="ec-pay-agree"><input type="checkbox" value="" required><a href="#">I have
                    read and agree to the <span>Terms & Conditions</span></a><span
                    class="checked"></span></span>
                    <br>
                    <?php if(!empty($_SESSION['cart']) && !empty($_SESSION['id']))
                    {   ?>
                      <span class="ec-check-order-btn">
                        <button class="btn btn-primary" type="submit" name="ordersubmit">Place order</button>
                      </span>
                      <?php 
                    } 
                    ?>
                  </form>
                </div>
              </div>
            </div>
            <!-- Sidebar Payment Block -->
          </div>
          <div class="ec-sidebar-wrap ec-check-pay-img-wrap">
            <!-- Sidebar Payment Block -->
            <div class="ec-sidebar-block">
              <div class="ec-sb-title">
                <h3 class="ec-sidebar-title">Payment Method</h3>
              </div>
              <div class="ec-sb-block-content">
                <div class="ec-check-pay-img-inner">
                  <div class="ec-check-pay-img">
                    <img src="assets/images/icons/payment1.png" alt="">
                  </div>
                  <div class="ec-check-pay-img">
                    <img src="assets/images/icons/payment2.png" alt="">
                  </div>
                  <div class="ec-check-pay-img">
                    <img src="assets/images/icons/payment3.png" alt="">
                  </div>
                  <div class="ec-check-pay-img">
                    <img src="assets/images/icons/payment4.png" alt="">
                  </div>
                  <div class="ec-check-pay-img">
                    <img src="assets/images/icons/payment5.png" alt="">
                  </div>
                  <div class="ec-check-pay-img">
                    <img src="assets/images/icons/payment6.png" alt="">
                  </div>
                  <div class="ec-check-pay-img">
                    <img src="assets/images/icons/payment7.png" alt="">
                  </div>
                </div>
              </div>
            </div>
            <!-- Sidebar Payment Block -->
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- Footer Start -->
  <?php @include("includes/footer.php");?>
  <!-- Footer Area End -->


</div>
</div>
<!-- Feature tools end -->

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
<script src="assets/js/vendor/index.js"></script>
<script src="assets/js/demo.js"></script>


</body>
</html>