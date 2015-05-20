<?php
	$host="localhost"; // Host name 
	$username="root"; // Mysql username 
	$password="123456"; // Mysql password 
	$db_name="leave_management"; // Database name 
	$tb_name="leave_users";
	
	$connect_id=mysql_connect($host, $username, $password); 
	//mysql_select_db("$db_name",$connect_id) or die("NoDatabase");
	
	echo json_encode("hello");

?>