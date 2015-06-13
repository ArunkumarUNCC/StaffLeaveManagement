<?php
	$host="localhost"; // Host name 
	$username="root"; // Mysql username 
	$password="123456"; // Mysql password 
	$db_name="leave_management"; // Database name 
	$tb_name="leaves";
	
	$type=$_POST["type"];
		
	if($type=="HOD")
		$type="Teaching Staff";
	
	$leave_names=array();
	$leave_count=array();

	$connect_id=mysql_connect("localhost", "root", "123456")or die("cannot connect"); 
	mysql_select_db("$db_name",$connect_id) or die("NoDatabase");
	
	$get=mysql_query("SELECT * FROM $tb_name WHERE `type`='$type'");
	
	while($row=mysql_fetch_array($get)){
		$names=$row[1];
		$counts=$row[2];
	}
	
	$leave_names=explode(",",$names);
	$leave_count=explode(",",$counts);
	
	//echo json_encode($type);
	echo json_encode(array($leave_names,$leave_count));
?>