<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');
if(strlen($_SESSION['login'])==0)
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
  <!-- SweetAlert2 -->
  <link rel="stylesheet" href="assets/sweetalert2/sweetalert2.css">
  <script src="assets/sweetalert2/sweetalert2.min.js"></script>

</head>
<body>
  <?php
  if(isset($_POST['update']))
  {
    $baddress=$_POST['billingaddress'];
    $bstate=$_POST['billingcountry'];
    $bcity=$_POST['billingcity'];
    $saddress=$_POST['shippingaddress'];
    $sstate=$_POST['shippingcountry'];
    $scity=$_POST['shippingcity'];
    $phone=$_POST['phone'];
    $email=$_POST['email'];
    $name=$_POST['name'];
    $sql="update users set billingAddress=:baddress,billingCountry=:bcountry,billingCity=:bcity,shippingAddress=:saddress,shippingCountry=:scountry,shippingCity=:scity,contactno=:phone,email=:email,name=:name where id='".$_SESSION['id']."'";
    $query4 = $dbh->prepare($sql);
    $query4->bindParam(':baddress',$baddress,PDO::PARAM_STR);
    $query4->bindParam(':bcountry',$bcountry,PDO::PARAM_STR);
    $query4->bindParam(':bcity',$bcity,PDO::PARAM_STR);
    $query4->bindParam(':saddress',$saddress,PDO::PARAM_STR);
    $query4->bindParam(':scountry',$scountry,PDO::PARAM_STR);
    $query4->bindParam(':scity',$scity,PDO::PARAM_STR);
    $query4->bindParam(':name',$name,PDO::PARAM_STR);
    $query4->bindParam(':phone',$phone,PDO::PARAM_STR);
    $query4->bindParam(':email',$email,PDO::PARAM_STR);
    $query4->execute();
    if ($query4->execute()){
      ?>
      <script >
        swal.fire({
          'title': 'Thank you',
          'text': 'Updated successfuly',
          'icon': 'success',
          'type': 'success'
        }).then( () => {
          location.href = 'user-profile.php'
        })
      </script>

      <?php
    }else{
      echo '<script>alert("update failed! try again later")</script>';
    }
  }
  ?>
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
              <h2 class="ec-breadcrumb-title">User Profile</h2>
            </div>
            <div class="col-md-6 col-sm-12">
              <!-- ec-breadcrumb-list start -->
              <ul class="ec-breadcrumb-list">
                <li class="ec-breadcrumb-item"><a href="index.php">Home</a></li>
                <li class="ec-breadcrumb-item active">Profile</li>
              </ul>
              <!-- ec-breadcrumb-list end -->
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- Ec breadcrumb end -->


  <!-- User profile section -->
  <section class="ec-page-content ec-vendor-uploads ec-user-account section-space-p">
    <div class="container">
      <div class="row">
        <!-- Sidebar Area Start -->
        <?php @include("includes/sidebar.php");?>
        <div class="ec-shop-rightside col-lg-9 col-md-12">
          <div class="ec-vendor-dashboard-card ec-vendor-setting-card">
            <div class="ec-vendor-card-body">
              <div class="row">
                <?php
                $query=mysqli_query($con,"select * from users where id='".$_SESSION['id']."'");
                while($row=mysqli_fetch_array($query))
                {
                  ?>
                  <div class="col-md-12">
                    <div class="ec-vendor-block-profile">
                      <div class="ec-vendor-block-img space-bottom-30">
                        <div class="ec-vendor-block-bg">
                          <a href="#" class="btn btn-lg btn-primary"
                          data-link-action="editmodal" title="Edit Detail"
                          data-bs-toggle="modal" data-bs-target="#edit_modal">Edit Detail</a>
                        </div>
                        <div class="ec-vendor-block-detail">
                          <img class="v-img" src="assets/images/user/4.jpg" alt="vendor image">
                          <h5 class="name"><?php echo $row['name'];?></h5>
                          <p>( Sales Manager )</p>
                        </div>
                        <p>Hello <span><?php echo $row['name'];?>!</span></p>
                        <p>From your account you can easily view and track orders. You can manage and change your account information like address, contact information and history of orders.</p>
                      </div>
                      <h5>Account Information</h5>

                      <div class="row">
                        <div class="col-md-6 col-sm-12">
                          <div class="ec-vendor-detail-block ec-vendor-block-email space-bottom-30">
                            <h6>E-mail address 
                            </h6>
                            <ul>
                              <li><strong>Email : </strong><?php echo $row['email'];?></li>
                              <!-- <li><strong>Email 2 : </strong>support2@exapmle.com</li> -->
                            </ul>
                          </div>
                        </div>
                        <div class="col-md-6 col-sm-12">
                          <div class="ec-vendor-detail-block ec-vendor-block-contact space-bottom-30">
                            <h6>Contact nubmer
                            </h6>
                            <ul>
                              <li><strong>Phone Nubmer : </strong><?php echo $row['contactno'];?></li>
                              <!--  <li><strong>Phone Nubmer 2 : </strong>(123) 123 456 7890</li> -->
                            </ul>
                          </div>
                        </div>
                        <div class="col-md-6 col-sm-12">
                          <div class="ec-vendor-detail-block ec-vendor-block-address mar-b-30">
                            <h6>Address</a>
                            </h6>
                            <ul>
                              <li><strong>Home : </strong><?php echo $row['billingAddress'];?>&nbsp; <?php echo $row['billingState'];?>&nbsp; <?php echo $row['billingCity'];?>&nbsp; <?php echo $row['billingCountry'];?> - <?php echo $row['billingZipcode'];?>.</li>
                            </ul>
                          </div>
                        </div>
                        <div class="col-md-6 col-sm-12">
                          <div class="ec-vendor-detail-block ec-vendor-block-address">
                            <h6>Shipping Address
                            </h6>
                            <ul>
                              <li><strong>Office : </strong><?php echo $row['shippingAddress'];?>&nbsp; <?php echo $row['shippingState'];?>&nbsp; <?php echo $row['shippingCity'];?>&nbsp; <?php echo $row['shippingCountry'];?> - <?php echo $row['shippingZipcode'];?>.</li>
                            </ul>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <?php 
                } ?>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- End User profile section -->

  <!-- Footer Start -->
  <?php @include("includes/footer.php");?>
  <!-- Footer Area End -->

  <!-- Modal -->
  <div class="modal fade" id="edit_modal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-body">
          <div class="row">
            <div class="ec-vendor-block-img space-bottom-30">
              <form>
                <div class="ec-vendor-block-bg cover-upload">
                  <div class="thumb-upload">
                    <div class="thumb-edit">
                      <input type='file' id="thumbUpload01" class="ec-image-upload"
                      accept=".png, .jpg, .jpeg" />
                      <label><img src="assets/images/icons/edit.svg"
                        class="svg_img header_svg" alt="edit" />
                      </label>
                    </div>
                    <div class="thumb-preview ec-preview">
                      <div class="image-thumb-preview">
                        <img class="image-thumb-preview ec-image-preview v-img"
                        src="assets/images/banner/33.jpg" alt="edit" />
                      </div>
                    </div>
                  </div>
                </div>
                <div class="ec-vendor-block-detail">
                  <div class="thumb-upload">
                    <div class="thumb-edit">
                      <input type='file' id="thumbUpload02" class="ec-image-upload"
                      accept=".png, .jpg, .jpeg" />
                      <label><img src="assets/images/icons/edit.svg"
                        class="svg_img header_svg" alt="edit" />
                      </label>
                    </div>
                    <div class="thumb-preview ec-preview">
                      <div class="image-thumb-preview">
                        <img class="image-thumb-preview ec-image-preview v-img"
                        src="assets/images/user/4.jpg" alt="edit" />
                      </div>
                      <button type="submit" class="btn btn-primary ">Update Image</button>
                    </div>
                  </div>
                </div>
              </form>
              <div class="ec-vendor-upload-detail">
                <form class="row g-3" method="post">
                  <?php
                  $query=mysqli_query($con,"select * from users where id='".$_SESSION['id']."'");
                  while($row=mysqli_fetch_array($query))
                  {
                    ?>
                    <div class="col-md-12 space-t-15">
                      <label class="form-label">Full names</label>
                      <input type="text" class="form-control" name="name" value="<?php echo $row['name'];?>">
                    </div>
                    <div class="col-md-6 space-t-15">
                      <label class="form-label">Email id </label>
                      <input type="email" class="form-control" name="email" value="<?php echo $row['email'];?>">
                    </div>
                    <div class="col-md-6 space-t-15">
                      <label class="form-label">Phone number</label>
                      <input type="text" class="form-control" name="phone" value="<?php echo $row['contactno'];?>">
                    </div>
                    <div class="col-md-4 space-t-15">
                      <label class="form-label">Billing Address</label>
                      <input type="text" class="form-control" name="billingaddress" value="<?php echo $row['billingAddress'];?>">
                    </div>
                    <div class="col-md-4 space-t-15">
                      <label class="form-label">Billing Country</label>
                      <input type="text" class="form-control" name="billingcountry"value="<?php echo $row['billingCountry'];?>">
                    </div>
                    <div class="col-md-4 space-t-15">
                      <label class="form-label">Billing City</label>
                      <input type="text" class="form-control" name="billingcity" value="<?php echo $row['billingCity'];?>">
                    </div>
                    <div class="col-md-4 space-t-15">
                      <label class="form-label">Shipping Address</label>
                      <input type="text" class="form-control" name="shippingaddress" value="<?php echo $row['shippingAddress'];?>">
                    </div>
                    <div class="col-md-4 space-t-15">
                      <label class="form-label">Shipping Country</label>
                      <input type="text" class="form-control" name="shippingcountry" value="<?php echo $row['shippingCountry'];?>">
                    </div>
                    <div class="col-md-4 space-t-15">
                      <label class="form-label">Shipping City</label>
                      <input type="text" class="form-control" name="shippingcity" value="<?php echo $row['shippingCity'];?>">
                    </div>
                    <div class="col-md-12 space-t-15">
                      <button type="submit" name="update" class="btn btn-primary">Update</button>
                      <a href="#" class="btn btn-lg btn-secondary qty_close" data-bs-dismiss="modal"
                      aria-label="Close">Close</a>
                    </div>
                    <?php
                  }?>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- Modal end -->

  <!-- Vendor JS -->
  <script src="assets/js/vendor/jquery-3.5.1.min.js"></script>
  <script src="assets/js/vendor/jquery.notify.min.js"></script>
  <script src="assets/js/vendor/jquery.bundle.notify.min.js"></script>
  <script src="assets/js/vendor/popper.min.js"></script>
  <script src="assets/js/vendor/bootstrap.min.js"></script>
  <script src="assets/js/vendor/bootstrap-tagsinput.js"></script>
  <script src="assets/js/vendor/jquery-migrate-3.3.0.min.js"></script>
  <script src="assets/js/vendor/modernizr-3.11.2.min.js"></script>
  <script src="assets/js/vendor/jquery.magnific-popup.min.js"></script>

  <!--Plugins JS-->
  <script src="assets/js/plugins/swiper-bundle.min.js"></script>
  <script src="assets/js/plugins/nouislider.js"></script>
  <script src="assets/js/plugins/countdownTimer.min.js"></script>
  <script src="assets/js/plugins/scrollup.js"></script>
  <script src="assets/js/plugins/jquery.zoom.min.js"></script>
  <script src="assets/js/plugins/slick.min.js"></script>
  <script src="assets/js/plugins/infiniteslidev2.js"></script>
  <script src="assets/js/plugins/jquery.sticky-sidebar.js"></script>

  <!-- Main Js -->
  <script src="assets/js/vendor/index.js"></script>
  <script src="assets/js/demo.js"></script>
  <script src="assets/js/main.js"></script>

</body>
</html>