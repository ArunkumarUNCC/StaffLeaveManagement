<?php
	$host="localhost"; // Host name 
	$username="root"; // Mysql username 
	$password="123456"; // Mysql password 
	$db_name="leave_management"; // Database name 
	$tb_name="approve";
	
	$id=$_POST["id"];
	$type=$_POST["type"];
	
	$from=array();
	$dates=array();
	$classes=array();
	$periods=array();
	$names=array();
	$subjects=array();

	$connect_id=mysql_connect("localhost", "root", "123456")or die("cannot connect"); 
	mysql_select_db("$db_name",$connect_id) or die("NoDatabase");
	
	if($type!="Principal"){
		$get=mysql_query("SELECT * FROM $tb_name WHERE `to`='$id'");
		
		while($row=mysql_fetch_array($get)){
			$get_name=mysql_query("SELECT `staff_name` FROM `leave_users` WHERE `staff_id`='$row[0]'");
			while($row2=mysql_fetch_array($get_name))
				array_push($names,$row2);
		
			array_push($from,$row[0]);
			array_push($dates,$row[3]);
			array_push($classes,$row[4]);
			array_push($periods,$row[5]);
			array_push($subjects,$row[6]);
		}
	}
	
	echo json_encode(array($names,$from,$dates,$classes,$periods,$subjects));
?>