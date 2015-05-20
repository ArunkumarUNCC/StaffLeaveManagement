<?php
	$host="localhost"; // Host name 
	$username="root"; // Mysql username 
	$password="123456"; // Mysql password 
	$db_name="leave_management"; // Database name 
	$tb_name="cancel_leaves";
	
	$id=$_POST["id"];
	$from=$_POST["from"];
	$to=$_POST["to"];
	$type=$_POST["type"];
	$status=$_POST["status"];
	
	$temp=array();
	$total=0;
	
	$connect_id=mysql_connect("localhost", "root", "123456")or die("cannot connect"); 
	mysql_select_db("$db_name",$connect_id) or die("NoDatabase");
	
	mysql_query("DELETE FROM $tb_name WHERE `staff_id`='$id' AND `from_date`='$from' AND `to_date`='$to' AND `leave_type`='$type'");
	mysql_query("UPDATE `apply` SET `cancel_status`='$status' WHERE `staff_id`='$id' AND `leave_type`='$type' AND `dates` LIKE '%$from%'");
	
	if($status=="Approve"){
		$get=mysql_query("SELECT `total` FROM `apply` WHERE `staff_id`='$id' AND `leave_type`='$type' AND `dates` LIKE '%$from%'");
		
		while($row=mysql_fetch_array($get)){
			$total=intval($row[0]);
		}	
		

		$get1=mysql_query("SELECT `$type` FROM `staff` WHERE `staff_id`='$id' AND ('$from' BETWEEN `from_date` AND `to_date`)");

		
		while($row1=mysql_fetch_array($get1)){
			$temp=explode("/",$row1[0]);
		}
		
		$total+=intval($temp[0]);
		
		$get1=mysql_query("UPDATE `staff` SET `$type`='$total/$temp[1]' WHERE `staff_id`='$id' AND ('$from' BETWEEN `from_date` AND `to_date`)");
	}
	
	echo json_encode("You Approved Leave Cancellation");
?>
	