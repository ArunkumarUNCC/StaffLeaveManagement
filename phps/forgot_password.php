
<?php
require_once('/class.phpmailer.php');

//include("class.smtp.php"); // optional, gets called from within class.phpmailer.php if not already loaded
$id=$_POST["user"];
$password=$_POST["pass"];
$to=$_POST["mail"];
$tb_name="leave_users";
$db_name="leave_management";

$connect_id=mysql_connect("localhost", "root", "123456")or die("cannot connect"); 
mysql_select_db("$db_name",$connect_id) or die("NoDatabase");

$get=mysql_query("SELECT * FROM $tb_name WHERE `user_name`='$id'");

if(mysql_num_rows($get)>0){
	mysql_query("UPDATE $tb_name SET `password`='$password' WHERE `user_name`='$id'");
	$mail= new PHPMailer(true);
	$mailto=$to;
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

		$mail->Subject = 'SLMS Password Change';
      	$mail->AltBody = 'SLMS Password Change'; // optional - MsgHTML will create an alternate automatically
		$mail->MsgHTML("<html><table style=\"text-align: center;\"><tr><td colspan=\"2\" style=\"width: 200px;\"><img src=\"../images/leave_logo.jpg \" style=\"width: 400px;\" /></td></tr><tr><td>Your Staff ID</td><td>$id</td></tr><tr><td>Your Password</td><td>$password</td></tr><tr style=\"text-align: right; margin-top: 50px;\"><td colspan=\"2\"><b>Regards<br/>(Arunkumar)Administrator<br/>Staff Leave Management System</b></td></tr>");
		if(!$mail->Send()) {
		  echo json_encode("A password has been sent to your mail-id");
		} else {
  			echo json_encode("A password has been sent to your mail-id");
		}
	}
	
	catch (phpmailerException $e) {
     // echo $e->errorMessage(); //Pretty error messages from PHPMailer
    } catch (Exception $e) {
     // echo $e->getMessage(); //Boring error messages from anything else!
    }
	//echo json_encode("A password has been sent to your mail-id");
}

else echo json_encode("Incorrect Staff ID");
?>

