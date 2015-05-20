<html>
<head>
<title>PHPMailer - SMTP (Gmail) basic test</title>
</head>
<body>

<?php

//error_reporting(E_ALL);
error_reporting(E_STRICT);

date_default_timezone_set('America/Toronto');

require_once('../class.phpmailer.php');
//include("class.smtp.php"); // optional, gets called from within class.phpmailer.php if not already loaded

$mail             = new PHPMailer();

$body             = file_get_contents('contents.html');
$body             = preg_replace('/[\]/','',$body);

$mail->IsSMTP(); // telling the class to use SMTP
$mail->Host       = "smtp.gmail.com"; // SMTP server
$mail->SMTPDebug  = 1;                     // enables SMTP debug information (for testing)
                                           // 1 = errors and messages
                                           // 2 = messages only
$mail->SMTPAuth   = true;                  // enable SMTP authentication
$mail->SMTPSecure = "ssl";                 // sets the prefix to the servier
$mail->Host       = "smtp.gmail.com";      // sets GMAIL as the SMTP server
$mail->Port       = 465;                   // set the SMTP port for the GMAIL server
$mail->Username   = "mohanram2k@gmail.com";  // GMAIL username
$mail->Password   = "HONEYBEE91#";            // GMAIL password

$mail->SetFrom('mohanram2k@gmail.com', 'mohanram Test');

$mail->AddReplyTo("clickmani@gmail.com","Manikandan");

$mail->Subject    = "PHPMailer Test Subject via smtp (Gmail), basic";

$mail->AltBody    = "To view the message, please use an HTML compatible email viewer!"; // optional, comment out and test
$body="Sir, I have sent you mail Using the XAMPP Server.Try Downloading and Using XAMPP Server. The Possible Reasons for Mail Failure is GMAIL Accepts SSL Connections.We need to Specify Parameters to for SSL and Other Port Properties.Other Mail not Directed with SSL will be skipped.YOu may get a message sent Message,Yet the mail doesnt go to Inbox-Due to this only.
The Second Alternative being to have a Server running with a Mail Server Configured and Running . You just need to specify the host=Domain.example.com";
$mail->MsgHTML($body);

$address = "mohan_ggg@yahoo.co.in";
$mail->AddAddress($address, "Mohanram");


if(!$mail->Send()) {
  echo "Mailer Error: " . $mail->ErrorInfo;
} else {
  echo "Message sent!";
}

?>

</body>
</html>
