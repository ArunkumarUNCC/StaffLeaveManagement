<?php
$name=$_POST["name"];
$id=$_POST["id"];
	
$db_name="leave_management";
$connect_id=mysql_connect("localhost", "root", "123456")or die("cannot connect"); 
mysql_select_db("$db_name",$connect_id) or die("NoDatabase");

if($id=="1"){
	mysql_query("INSERT INTO `designations` VALUES('$name')");
	echo json_encode("New Designation Added Successfully");
}

else if($id=="2"){
	mysql_query("DELETE FROM `designations` WHERE `name`='$name'");
	echo json_encode("Designation $name Deleted Successfully...");
}
?>