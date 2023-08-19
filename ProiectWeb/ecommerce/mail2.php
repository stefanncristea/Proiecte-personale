<?php 
error_reporting(0);
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

if( empty( $_POST['token'] ) ){
	echo '<span class="notice">Error!</span>';
	exit;
}
if( $_POST['token'] != 'FsWga4&@f6aw' ){
	echo '<span class="notice">Error!</span>';
	exit;
}
// Load Composer's autoloader
require 'vendor/autoload.php';

// Instantiation and passing `true` enables exceptions
$mail = new PHPMailer(true);

$name = $_POST['name'];
$from = $_POST['email'];
$phone = $_POST['phone'];
$subject = stripslashes( nl2br( $_POST['subject'] ) );
$message = stripslashes( nl2br( $_POST['message'] ) );

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
    $mail->setFrom($from, 'Code4berry website');
    
    $mail->addAddress('code4berryteam@gmail.com', 'Code4berry Admin');     // Add a recipient

    // Attachement 
    // $mail->addAttachment('upload/file.pdf');
    //$mail->addAttachment('assets/img/products/product-img-1.jpg', 'fruit');    // Optional name

    // Content
    $mail->isHTML(true); // Set email format to HTML
    $mail->Subject = $subject;
    ob_start();
    ?>
    Hi General Manager!<br /><br />
    <?php echo ucfirst( $name ); ?>  has sent you a message via contact form on your website!
    <br /><br />

    Name: <?php echo ucfirst( $name ); ?><br />
    Email: <?php echo $from; ?><br />
    Phone: <?php echo $phone; ?><br />
    Subject: <?php echo $subject; ?><br />
    Message: <br /><br />
    <?php echo $message; ?>
    <br />
    <br />
    <?php
    $body = ob_get_contents();
    ob_end_clean();
    $mail->Body = $body;
    $mail->AltBody = $body; // Plain text for non-HTML mail clients

    $s = $mail->send();
    if( $s == 1 ){
    	echo '<div class="success" ><i class="ecicon eci-check-circle"></i><h3>Thank You!</h3>Your message has been sent successfully.</div>';
    }else{
    	echo '<div>Your message sending failed!</div>';
    }
} catch (Exception $e) {
} 
?>
