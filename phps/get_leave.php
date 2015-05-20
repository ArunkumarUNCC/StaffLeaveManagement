<?php
	$host="localhost"; // Host name 
	$username="root"; // Mysql username 
	$password="123456"; // Mysql password 
	$db_name="leave_management"; // Database name 
	$tb_name="leave_users";
	

	$connect_id=mysql_connect("localhost", "root", "123456")or die("cannot connect"); 
	mysql_select_db("$db_name",$connect_id) or die("NoDatabase");
	
	$leave_names=array();
$get_leave_names=mysql_query("SELECT `COLUMN_NAME` FROM `INFORMATION_SCHEMA`.`COLUMNS` WHERE `TABLE_SCHEMA`='leave_management' AND `TABLE_NAME`='staff'");

	while($row=mysql_fetch_array($get_leave_names)){
		if($row[0]!="staff_id" && $row[0]!="from_date" && $row[0]!="to_date" && $row[0]!="LOP")
			array_push($leave_names,$row[0]);
	}

	echo json_encode($leave_names);
?>