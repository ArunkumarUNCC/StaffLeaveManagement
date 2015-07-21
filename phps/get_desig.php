<?php
$db_name="leave_management";
$connect_id=mysql_connect("localhost", "root", "123456")or die("cannot connect"); 
mysql_select_db("$db_name",$connect_id) or die("NoDatabase");

$type = $_POST["staff_type"];
$designations=array();
	
$get=mysql_query("SELECT `name` FROM `designations` WHERE `staff_type`='$type'");

while($row=mysql_fetch_array($get)){
	$designations = explode(",",$row[0]);
}


echo json_encode($designations);


?>