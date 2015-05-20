<?php

	$id=$_POST["id"];
	$status=$_POST["status"];
	
	$connect_id=mysql_connect("localhost", "root", "123456")or die("cannot connect"); 
	mysql_select_db("$db_name",$connect_id) or die("NoDatabase");


	require_once('/class.phpmailer.php');
		
		
		$get=mysql_query("SELECT `mail` FROM $tb_name WHERE `user_name`='$id'");

		while($row=mysql_fetch_array($get)){
			$to=$row[0];

		}
		
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

		  $mail->Subject = 'HALL BOOKING for';
      	  $mail->AltBody = 'HALL BOOKING'; // optional - MsgHTML will create an alternate automatically
		  $mail->MsgHTML("<html><table style=\"text-align: center;\"><tr><td colspan=\"2\" style=\"width: 200px;\"><img src=\"../images/leave_logo.jpg \" style=\"width: 400px;\" /></td></tr><tr><td>Your Staff ID</td><td></td></tr><tr><td>Your Password</td><td></td></tr><tr style=\"text-align: right; margin-top: 50px;\"><td colspan=\"2\"><b>Regards<br/>(Arunkumar)Administrator<br/>Staff Leave Management System</b></td></tr>");
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
		
?>