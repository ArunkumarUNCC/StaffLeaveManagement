<?php
$db_name="leave_management";

$connect_id=mysql_connect("localhost", "root", "123456")or die("cannot connect"); 
mysql_select_db("$db_name",$connect_id) or die("NoDatabase");

$depts=array();
	
$get=mysql_query("SELECT * FROM `departments`");

while($row=mysql_fetch_array($get)){
	array_push($depts,$row[0]);
}

echo json_encode($depts);

?>