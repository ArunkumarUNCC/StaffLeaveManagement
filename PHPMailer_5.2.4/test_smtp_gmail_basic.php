<html>
<head>
<title>PHPMailer - SMTP (Gmail) basic test</title>
</head>
<body>

<?php
require_once('/class.phpmailer.php');

//include("class.smtp.php"); // optional, gets called from within class.phpmailer.php if not already loaded

$mail= new PHPMailer(true);
$mailto="b.arun410@gmail.com";
$mail->IsSMTP(); 
 try {
      //$mail->Host       = "mail.yourdomain.com"; // SMTP server
      $mail->SMTPDebug  = 2;                     // enables SMTP debug information (for testing)
      $mail->SMTPAuth   = true;                  // enable SMTP authentication
      $mail->SMTPSecure = "tls";                 // sets the prefix to the servier
      $mail->Host       = "smtp.gmail.com";      // sets GMAIL as the SMTP server
      $mail->Port       = 587;                   // set the SMTP port for the GMAIL server
      $mail->Username   = "hallbooking.skcet@gmail.com";  // GMAIL username
      $mail->Password   = "admin.skcet"; 

		$mail->AddAddress($mailto, '');
		 $mail->SetFrom('hallbooking.skcet@gmail.com', 'SKCET HALL BOOKING');

		//$mail->AddReplyTo("b.arun410@gmail.com","Manikandan");

		$mail->Subject = 'HALL BOOKING for';
      	$mail->AltBody = 'HALL BOOKING'; // optional - MsgHTML will create an alternate automatically
		$mail->MsgHTML("Test Message");
		if(!$mail->Send()) {
		  //echo "Mailer Error: " . $mail->ErrorInfo;
} else {
  //echo "Message sent!";
}
	}
	
catch (phpmailerException $e) {
     // echo $e->errorMessage(); //Pretty error messages from PHPMailer
    } catch (Exception $e) {
     // echo $e->getMessage(); //Boring error messages from anything else!
    }
?>

</body>
</html>
