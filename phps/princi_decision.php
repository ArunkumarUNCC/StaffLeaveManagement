<?php
	require_once('/class.phpmailer.php');
	
	$host="localhost"; // Host name 
	$username="root"; // Mysql username 
	$password="123456"; // Mysql password 
	$db_name="leave_management"; // Database name 
	$tb_name="apply";
	
	$id=$_POST["id"];
	$name=$_POST["name"];
	$date=$_POST["date"];
	$staff=$_POST["staff"];
	$class=$_POST["class"];
	$period=$_POST["period"];
	$status=$_POST["status"];
	$leave_type=$_POST["type"];
	
	$to="";
	
	$temp_date=explode(",",$date);
	$size=sizeof($temp_date);
	
	$connect_id=mysql_connect($host, $username, $password);
	mysql_select_db("$db_name",$connect_id) or die("NoDatabase");
	
	//mysql_query("UPDATE $tb_name SET `principal`='$status' WHERE `staff_id`='$id' AND `dates`='$date' AND `staff`='$staff' AND `classes`='$class' AND `periods`='$period' AND `leave_type`='$leave_type'");
	
	$get_size=mysql_query("SELECT `total` FROM $tb_name WHERE `staff_id`='$id' AND `dates`='$date' AND `staff`='$staff' AND `classes`='$class' AND `periods`='$period' AND `leave_type`='$leave_type'");
	
	while($total=mysql_fetch_array($get_size)){
		$size=$total[0];
	}
	
	if($status=="Approve"){		
	
		$get=mysql_query("SELECT `mail` FROM `leave_users` WHERE `user_name`='$id'");

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
			$mail->SetFrom('slms@skcet.ac.in', 'SKCET SLMS');
	
			//$mail->AddReplyTo("b.arun410@gmail.com","Manikandan");
	
			$mail->Subject = 'Leave Approval Reg!!!';
			$mail->AltBody = 'Leave Approval Reg!!!'; // optional - MsgHTML will create an alternate automatically
			
			if(sizeof($temp_date)==1){
				$mail->MsgHTML("<html><table style=\"text-align: center;\"><tr><td colspan=\"2\" style=\"width: 100%;\"><img src=\"../images/leave_logo.jpg \" style=\"height: 100px; width: 100%;\" /></td></tr><tr><td colspan=\"2\"><b><span style=\"text-align:left;\">Hello $name,</span><br/><br/>Your Leave On $date </b> Has Been Approved By The Principal. For Further Information, Please Visit Your Account!!!</td></tr><tr style=\"text-align: right; margin-top: 50px;\"><td colspan=\"2\"><b>Regards<br/>SLMS Administrator</b></td></tr>");
			}
				
			else $mail->MsgHTML("<html><table style=\"text-align: center;\"><tr><td colspan=\"2\" style=\"width: 100%;\"><img src=\"../images/leave_logo.jpg \" style=\"height: 100px;width: 100%;\" /></td></tr><tr><td colspan=\"2\"><b><span style=\"text-align:left;\">Hello $name,</span><br/><br/>Your Leave From ".explode(",",$date)[0]." To ".$temp_date[sizeof($temp_date)-1] ."</b> Has Been Approved By The Principal. For Further Information, Please Visit Your Account!!!</td></tr><tr style=\"text-align: right; margin-top: 50px;\"><td colspan=\"2\"><b><br/>Regards<br/>SLMS Administrator</b></td></tr>");
			
			if(!$mail->Send()) {
			  echo json_encode("A password has been sent to your mail-id");
			} 
			else {
				echo json_encode("A password has been sent to your mail-id");
			}
		}
		
		catch (phpmailerException $e) {
		 // echo $e->errorMessage(); //Pretty error messages from PHPMailer
		} 
		catch (Exception $e) {
		 // echo $e->getMessage(); //Boring error messages from anything else!
		}
		//echo json_encode("A password has been sent to your mail-id");

	
	
		$get=mysql_query("SELECT `$leave_type` FROM `staff` WHERE `staff_id`='$id' AND ('$temp_date[0]' BETWEEN `from_date` AND `to_date` OR '".$temp_date[$size-1]."' BETWEEN `from_date` AND `to_date`)");
		
		while($row=mysql_fetch_array($get)){
			$leaves=$row[0];
		}
		$proper=explode("/",$leaves);
		$original=$proper[0]-$size;
		
		//mysql_query("UPDATE `staff` SET `$leave_type`='$original/$proper[1]' WHERE `staff_id`='$id'");
	}
	
	//header('Location:Mailer/test_smtp_gmail_advanced.php');*/
	//echo json_encode($original/$proper[1]);

	
	echo json_encode("asdf");
?>