<?php
require 'vendor/autoload.php';
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

define('DB_SERVER','localhost');
define('DB_USER','root');
define('DB_PASS' ,'');
define('DB_NAME','sfypm_db');
$con = mysqli_connect(DB_SERVER,DB_USER,DB_PASS,DB_NAME);
// Check connection
if (mysqli_connect_errno())
{
 echo "Failed to connect to MySQL: " . mysqli_connect_error();
}



// sending email function

function send_mail($subject,$content,$to){
    global $con; 
    $countfiles='';
    $date=date("Y-m-d H:i:s");
    $send_status=0;
        // connect db 
//////////////////////////////////////////////////////// SEND Mail
//Instantiation and passing `true` enables exceptions
$mail = new PHPMailer(true);
    try {
//Server settings
//$mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
$mail->isSMTP();                                            //Send using SMTP
$mail->Host       = 'smtp-mail.outlook.com';                     //Set the SMTP server to send through
$mail->SMTPAuth   = true;                                   //Enable SMTP authentication
$mail->Username   = 'ndagijimanaenock11@outlook.com';                     //SMTP username
$mail->Password   = 'passtoenock@123';                               //SMTP password
$mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         //Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
$mail->Port       = 587;                                    //TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above
//Recipients
$mail->setFrom('ndagijimanaenock11@outlook.com');
$mail->addAddress($to);                  //Name is optional
$mail->addReplyTo('ndagijimanaenock11@outlook.com');
//$body = mysqli_real_escape_string($con, $content);
$mail->MsgHTML($content);
$mail->isHTML(true);                                  //Set email format to HTML
$mail->Subject = $subject;
//$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
$mail->send();
return 1;

} catch (Exception $e) {
return  0;
}
}
?>