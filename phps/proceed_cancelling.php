<?php
	$host="localhost"; // Host name 
	$username="root"; // Mysql username 
	$password="123456"; // Mysql password 
	$db_name="leave_management"; // Database name 
	$tb_name="apply";
	
	$id=$_POST["user"];
	$from=$_POST["from_date"];
	$cancel=$_POST["selects"];
	$purpose=$_POST["purpose_for"];
	$type=$_POST["leave_type"];
	$c_p=$_POST["can_pur"];
	
	$connect_id=mysql_connect("localhost", "root", "123456")or die("cannot connect"); 
	mysql_select_db("$db_name",$connect_id) or die("NoDatabase");
	
	mysql_query("UPDATE $tb_name SET `cancel_status`='Pending,Pending,Pending',`cancel_dates`='$cancel',`cancel_purpose`='$c_p' WHERE `dates` LIKE '%$from%' AND `purpose`='$purpose' AND `staff_id`='$id' AND `leave_type`='$type'");
	
	mysql_query("INSERT INTO `cancel_leaves` VALUES('$id','$cancel','$purpose','$type','$c_p','Pending','Pending','Pending')");
	
	echo json_encode("his");
?>
