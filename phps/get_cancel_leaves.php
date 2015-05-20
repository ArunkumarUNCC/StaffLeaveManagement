<?php
	$host="localhost"; // Host name 
	$username="root"; // Mysql username 
	$password="123456"; // Mysql password 
	$db_name="leave_management"; // Database name 
	$tb_name="apply";
	
	$id=$_POST["id"];
	$date=$_POST["today"];
	
	$from=array();
	$to=array();
	$purpose=array();
	$temp=array();
	$type=array();
	$status=array();
	
	$waiting_from=array();
	$waiting_status=array();
	$waiting_purpose=array();
	$waiting_temp=array();
	$waiting_type=array();
	
	$connect_id=mysql_connect("localhost", "root", "123456")or die("cannot connect"); 
	mysql_select_db("$db_name",$connect_id) or die("NoDatabase");
	
	$get=mysql_query("SELECT `dates`,`purpose`,`leave_type` FROM $tb_name WHERE `staff_id`='$id' AND `principal`='Approve' AND `cancel_status`=''");
	
	while($row=mysql_fetch_array($get)){
		$temp=explode(",",$row[0]);
		
		if(($temp[0])>$date){
			array_push($from,$temp[0]);
			array_push($to,$temp[sizeof($temp)-1]);
			array_push($purpose,$row[1]);
			array_push($type,$row[2]);
		}
	}
	
	$get1=mysql_query("SELECT `cancel_dates`,`cancel_purpose`,`leave_type`,`cancel_status` FROM $tb_name WHERE `staff_id`='$id' AND `cancel_status`!=''");
	
	while($row1=mysql_fetch_array($get1)){
		
			array_push($waiting_from,$row1[0]);
			array_push($waiting_purpose,$row1[1]);
			array_push($waiting_type,$row1[2]);
			array_push($waiting_status,$row1[3]);
	}
	echo json_encode(array($from,$to,$purpose,$type,$waiting_from,$waiting_purpose,$waiting_type,$status,$waiting_status));
?>