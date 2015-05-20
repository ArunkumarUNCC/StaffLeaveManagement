<?php
	$host="localhost"; // Host name 
	$username="root"; // Mysql username 
	$password="123456"; // Mysql password 
	$db_name="leave_management"; // Database name 
	$tb_name="cancel_leaves";
	
	$id=array();
	$names=array();
	$depts=array();
	$from=array();
	$to=array();
	$purpose=array();
	$type=array();
	
	$connect_id=mysql_connect("localhost", "root", "123456")or die("cannot connect"); 
	mysql_select_db("$db_name",$connect_id) or die("NoDatabase");
	
	$get=mysql_query("SELECT a.*,b.`staff_name`,b.`department` FROM $tb_name a,`leave_users` b WHERE a.`staff_id`=b.`staff_id`");
	
	while($row=mysql_fetch_array($get)){
		array_push($id,$row[0]);
		array_push($names,$row[5]);
		array_push($depts,$row[6]);
		array_push($from,$row[1]);
		array_push($to,$row[2]);
		array_push($purpose,$row[3]);
		array_push($type,$row[4]);
	}
	
	echo json_encode(array($id,$names,$depts,$from,$to,$purpose,$type));
?>