<?php
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
	
	$connect_id=mysql_connect("localhost", "root", "123456")or die("cannot connect");  
	mysql_select_db("$db_name",$connect_id) or die("NoDatabase");
	
	mysql_query("UPDATE $tb_name SET `hod`='$status' WHERE `staff_id`='$id' AND `dates`='$date' AND `staff`='$staff' AND `classes`='$class' AND `periods`='$period' AND `leave_type`='$leave_type'");
	
	echo json_encode("You Have Approved a ".$name."'s Leave");
?>