<?php
	$host="localhost"; // Host name 
	$username="root"; // Mysql username 
	$password="123456"; // Mysql password 
	$db_name="leave_management"; // Database name 
	$tb_name="leave_users";
	
	$depts=array();
	
	$connect_id=mysql_connect("localhost", "root", "123456")or die("cannot connect"); 
	mysql_select_db("$db_name",$connect_id) or die("NoDatabase");
	
	$get=mysql_query("SELECT DISTINCT(`department`) FROM $tb_name WHERE `staff_type`!='Admin'");
	
	while($row=mysql_fetch_array($get)){
		array_push($depts,$row[0]);
	}
	
	echo json_encode($depts);
?>