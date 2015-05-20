<?php 
require 'core.inc.php';
if(loggedin()){
?>
<html>
  <head>
    <title>PHPMailer - SMTP (Gmail) advanced test</title>
  </head>
  <body>
    <?php
/*
		$s=mysql_connect("localhost","root","");
		$ss=mysql_select_db('anurag',$s);
		$sql="SELECT * FROM result where length(email) > 5";
    	$query = mysql_query($sql);
		while($row = mysql_fetch_array($query))
    	{
		$sub1=$row['id1'];
		$sub2=$row['id2'];
		$sub3=$row['id3'];
		$sub4=$row['id4'];
		$sub5=$row['id5'];
		$sub6=$row['id6'];
		$g1=$row['grade1'];
		$g2=$row['grade2'];
		$g3=$row['grade3'];
		$g4=$row['grade4'];
		$g5=$row['grade5'];
		$g6=$row['grade6'];
		$message=$sub1.$g1.'\n'.$sub1.$g1.'\n'.$sub2.$g2.'\n'.$sub3.$g3.'\n'.$sub4.$g4.'\n'.$sub5.$g5.'\n'.$sub6.$g6;*/
		
		//$message="The ".$_SESSION['h_name']." on ".$_SESSION['date']." is successfully booked";
		//$message=$message.$_SESSION['h_name'];
    	require_once('/class.phpmailer.php');
    //include("class.smtp.php"); // optional, gets called from within class.phpmailer.php if not already loaded

    $mail = new PHPMailer(true); // the true param means it will throw exceptions on errors, which we need to catch

    $mail->IsSMTP(); // telling the class to use SMTP
			$mailto="b.arun410@gmail.com";
    try {
      //$mail->Host       = "mail.yourdomain.com"; // SMTP server
      $mail->SMTPDebug  = 2;                     // enables SMTP debug information (for testing)
      $mail->SMTPAuth   = true;                  // enable SMTP authentication
      $mail->SMTPSecure = "tls";                 // sets the prefix to the servier
      $mail->Host       = "smtp.gmail.com";      // sets GMAIL as the SMTP server
      $mail->Port       = 587;                   // set the SMTP port for the GMAIL server
      $mail->Username   = "hallbooking.skcet@gmail.com";  // GMAIL username
      $mail->Password   = "admin.skcet";            // GMAIL password
	  
	  
      $mail->AddAddress($mailto, '');
      $mail->SetFrom('hallbooking.skcet@gmail.com', 'SKCET HALL BOOKING');
      //$mail->AddReplyTo('name@yourdomain.com', 'First Last');
        $mail->Subject = 'HALL BOOKING for';
      $mail->AltBody = 'HALL BOOKING'; // optional - MsgHTML will create an alternate automatically
	  
		//$a=$_SESSION['h_name'];
		//$b=$_SESSION['date'];
      //$mail->MsgHTML("<h1>THE ".$a." ON ".$b." IS SUCCESSFULLY BOOKED!!!</h1>");
	  $a="Hi Arun";
	  $b="My First Mail";
	  
	  $mail->MsgHTML("<table border='2px solid black' style='text-align:center;background-color:#AADD33;'> <tr><td><img src='W:\EasyPHP5.3.0\www\HALL___BOOKING\images\skcet.png'></td><td><h1>SKCET-HALL BOOKING MANAGEMENT SYSTEM</h1></td></tr><tr><td colspan='2'><h2>THE REQUESTED HALL <span style='text-decoration:underline' color:'white'>".$a."</span> FOR THE FOLLOWING DATE <span style='text-decoration:underline' color:'white'>".$b."</span> IS APPROVED BY THE ADMIN AND BOOKED!!!</h2></td></tr>");
      $mail->Send();
	  //mail loop
	  $con=mysql_connect("localhost","root","");
	  mysql_select_db("test1",$con);
	  $res=mysql_query("select mailid from tech_detail");
	  while($m=mysql_fetch_array($res)){
	  $mail->AddAddress($m['mailid'], '');
      $mail->SetFrom('hallbooking.skcet@gmail.com', 'SKCET HALL BOOKING');
      //$mail->AddReplyTo('name@yourdomain.com', 'First Last');
        $mail->Subject = 'HALL BOOKING for';
      $mail->AltBody = 'HALL BOOKING'; // optional - MsgHTML will create an alternate automatically
	  
		//$a=$_SESSION['h_name'];
		//$b=$_SESSION['date'];
      //$mail->MsgHTML("<h1><table border='2px solid yellow' style='background-color:blue;'> <tr><td></td></tr><tr><td>THE REQUESTED HALL <span style='text-decoration:underline'>".$a."</span> FOR THE FOLLOWING DATE <span style='text-decoration:underline'>".$b."</span> IS APPROVED BY THE ADMIN AND BOOKED!!!</td></tr></h1>");
	  $mail->MsgHTML("<table border='2px solid black' style='text-align:center;background-color:#AADD33;'> <tr><td><img src='W:\EasyPHP5.3.0\www\HALL___BOOKING\images\skcet.png'></td><td><h1>SKCET-HALL BOOKING MANAGEMENT SYSTEM</h1></td></tr><tr><td colspan='2'><h2>THE REQUESTED HALL <span style='text-decoration:underline' color:'white'>".$a."</span> FOR THE FOLLOWING DATE <span style='text-decoration:underline' color:'white'>".$b."</span> IS APPROVED BY THE ADMIN AND BOOKED AND YOU ARE REQUESTED TO DO THE REQUIRED ARRANGEMENTS!!!</h2></td></tr>");
      //$mail->Send();
	  }
    //  echo "Message Sent OK</p>\n";
    } catch (phpmailerException $e) {
     // echo $e->errorMessage(); //Pretty error messages from PHPMailer
    } catch (Exception $e) {
     // echo $e->getMessage(); //Boring error messages from anything else!
    }
    ?>
  </body>
</html>
<?php 
	header('Location:first.php');
?>
<?php 
}
else{
echo "Unauthirized Access!!!!";
}

















?>