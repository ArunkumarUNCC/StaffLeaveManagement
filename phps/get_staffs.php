<?php
	$host="localhost"; // Host name 
	$username="root"; // Mysql username 
	$password="123456"; // Mysql password 
	$db_name="leave_management"; // Database name 
	$tb_name="leave_users";
	
	$dept=$_POST["dept"];
	$name=$_POST["name"];
	$type=$_POST["staff_type"];
	$staffs=array();
	$ids=array();
	
	$connect_id=mysql_connect("localhost", "root", "123456")or die("cannot connect"); 
	mysql_select_db("$db_name",$connect_id) or die("NoDatabase");
	
	if($type=="Non teaching Staff")
		$get=mysql_query("SELECT `staff_id`,`staff_name` FROM $tb_name WHERE `staff_type`!='Admin' AND `staff_type`='$type' AND `staff_name`!='$name' AND `department`='$dept'");
	else
		$get=mysql_query("SELECT `staff_id`,`staff_name` FROM $tb_name WHERE `staff_type`!='Admin' AND (`staff_type`='$type' OR `staff_type`='HOD') AND `staff_name`!='$name' AND `department`='$dept'");
	
	while($row=mysql_fetch_array($get)){
		array_push($staffs,$row[1]);
		array_push($ids,$row[0]);
	}
	
	echo json_encode(array($ids,$staffs));
?>