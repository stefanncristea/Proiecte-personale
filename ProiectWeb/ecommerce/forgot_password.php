<?php 
session_start();
error_reporting(0);
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
include('includes/dbconnection.php');
if(isset($_POST['change']))
{
  $email=$_POST['email'];
  $contact=$_POST['contact'];
  $query=mysqli_query($con,"SELECT * FROM users WHERE email='$email' and contactno='$contact'");
  $num=mysqli_fetch_array($query);
  if($num>0)
  {
    $name = $num['name'];

    $activationcode=md5($email.time());

    $query=mysqli_query($con,"update users set activationcode='$activationcode' WHERE email='$email' and contactno='$contact' ");
    if($query)

    {
        // Load Composer's autoloader
      require 'vendor/autoload.php';
            // Instantiation and passing `true` enables exceptions
      $mail = new PHPMailer(true);

      $subject = stripslashes( nl2br( 'Password Reset' ) );
             //$message = stripslashes( nl2br( '' ) );

      try {

            //Server settings
            $mail->SMTPDebug = 0;  // 0 - Disable Debugging, 2 - Responses received from the server
          $mail->isSMTP();    // Set mailer to use SMTP
          $mail->Host       = 'smtp.gmail.com';  // Specify main and backup SMTP servers
          $mail->SMTPAuth   = true;     // Enable SMTP authentication
          $mail->Username   = 'compscie95@gmail.com'; // SMTP username
          $mail->Password   = 'tntqytqmkaayhovd'; // SMTP password
          $mail->SMTPSecure = 'ssl';//PHPMailer::ENCRYPTION_STARTTLS;  // Enable TLS encryption, `PHPMailer::ENCRYPTION_SMTPS` also accepted
          $mail->Port       = 465; // TCP port to connect to

          //Recipients
          $mail->setFrom('compscie95@gmail.com', 'Code4berry');
          
          $mail->addAddress($email, $name);     // Add a recipient

          // Attachement 
          // $mail->addAttachment('upload/file.pdf');
          //$mail->addAttachment('assets/img/products/product-img-1.jpg', 'fruit');    // Optional name

          // Content
          $mail->isHTML(true); // Set email format to HTML
          $mail->Subject = $subject;
          ob_start();
          ?>
          Dear &nbsp;  <?php echo ucfirst( $name ); ?>, <br />

          <div style='padding-top:6px;'>You requested to change your password.</div>

          <div style='padding-top:8px;'>To do so please click on the link below:</div>

          <div style='padding-top:10px;'><a href='http://localhost/Electronicshop/email_verification.php?code=<?php echo $activationcode ?>'>Click here to change your password</a></div>

          <div style='padding-top:3px;'>If you didn't request a password change just ignore this email.</div>
          <p style='padding-top:3px;'>Best Regards,</p>
          <p style='padding-top:2px;'>Electronic Shop Team.</p>

          <div style='padding-top:4px;'>Powered by <a href='code4berry.com'>code4berry.com</a></div></div>
          <br />
          <br />
          <?php
          $body = ob_get_contents();
          ob_end_clean();
          $mail->Body = $body;
          $mail->AltBody = $body; // Plain text for non-HTML mail clients

          $s = $mail->send();
          if( $s == 1 ){
            $_SESSION['errmsg']="Please click on the link sent to your email to update your password.";

            echo "<script>window.location = forgot_password.php';</script>";
          }else{
            $_SESSION['errmsg']="Failed, please try again later.";
          }
        } catch (Exception $e) {
        } 
      }
    }
    else
    {
      $extra="forgot_password.php";
      $host  = $_SERVER['HTTP_HOST'];
      $uri  = rtrim(dirname($_SERVER['PHP_SELF']),'/\\');
      header("location:http://$host$uri/$extra");
      $_SESSION['errmsg']="Invalid email or Phone No.";
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
                <h2 class="ec-breadcrumb-title">Forgot Password</h2>
              </div>
              <div class="col-md-6 col-sm-12">
                <!-- ec-breadcrumb-list start -->
                <ul class="ec-breadcrumb-list">
                  <li class="ec-breadcrumb-item"><a href="index.php">Home</a></li>
                  <li class="ec-breadcrumb-item active">Forgot Password</li>
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
              <h2 class="ec-bg-title">Forgot Password</h2>
              <h2 class="ec-title">Forgot Password</h2>
              <p class="sub-title mb-3">Enter the email and phone you used when you joined and we will send you alink to update your password</p>
            </div>
          </div>
          <div class="ec-login-wrapper">
            <div class="ec-login-container">
              <div class="ec-login-form">
                <form action="#" method="post">
                  <span style="color:red;" >
                    <?php
                    echo htmlentities($_SESSION['errmsg']);
                    ?>
                    <?php
                    echo htmlentities($_SESSION['errmsg']="");
                    ?>
                  </span>
                  <span class="ec-login-wrap">
                    <label>Email Address*</label>
                    <input type="text" name="email" placeholder="Enter your email add..." required />
                  </span>
                  <span class="ec-login-wrap">
                    <label>Phone*</label>
                    <input type="text" name="contact" placeholder="Enter your phone" required />
                  </span>
                  <span class="ec-login-wrap ec-login-fp">
                    <label><a href="login.php">signin</a></label>
                  </span>
                  <span class="ec-login-wrap ec-login-btn">
                    <button class="btn btn-primary" name="change" type="submit">Send Link</button>
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