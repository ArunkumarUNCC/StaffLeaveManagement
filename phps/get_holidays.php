<?php
	$host="localhost"; // Host name 
	$username="root"; // Mysql username 
	$password="123456"; // Mysql password 
	$db_name="leave_management"; // Database name 
	$tb_name="holidays";
	
	$holiday=array();
	$s_date=array();
	$e_date=array();
	$ids=array();
	
	$connect_id=mysql_connect("localhost", "root", "123456")or die("cannot connect"); 
	mysql_select_db("$db_name",$connect_id) or die("NoDatabase");
	
	$get=mysql_query("SELECT * FROM $tb_name");
	
	while($row=mysql_fetch_array($get)){
		array_push($ids,$row[0]);
		array_push($holiday,$row[1]);
		array_push($s_date,$row[2]);
		array_push($e_date,$row[3]);
	}
	
	echo json_encode(array($ids,$holiday,$s_date,$e_date));
?>