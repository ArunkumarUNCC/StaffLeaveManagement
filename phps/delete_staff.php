<?php
	$host="localhost"; // Host name 
	$username="root"; // Mysql username 
	$password="123456"; // Mysql password 
	$db_name="leave_management"; // Database name 
	$tb_name="leave_users";
	
	$id=$_POST["id"];
	
	$connect_id=mysql_connect("localhost", "root", "123456")or die("cannot connect"); 
	mysql_select_db("$db_name",$connect_id) or die("NoDatabase");
	
	mysql_query("DELETE FROM $tb_name WHERE `staff_id`='$id'");
	mysql_query("DELETE FROM `apply` WHERE `staff_id`='$id'");
	mysql_query("DELETE FROM `staff` WHERE `staff_id`='$id'");
	
	echo json_encode("hi");
?>