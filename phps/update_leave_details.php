<?php
	$host="localhost"; // Host name 
	$username="root"; // Mysql username 
	$password="123456"; // Mysql password 
	$db_name="leave_management"; // Database name 
	$tb_name="staff";
	
	$id=$_POST["id"];
	$on=$_POST["on"];
	$date=$_POST["d"];
	
	$connect_id=mysql_connect("localhost", "root", "123456")or die("cannot connect"); 
	mysql_select_db("$db_name",$connect_id) or die("NoDatabase");
	
	mysql_query("UPDATE $tb_name SET `On Duty`='$on/$on' WHERE `staff_id`='$id' AND '$date' BETWEEN `from_date` AND `to_date`");
	
	echo json_encode("hi");
?>