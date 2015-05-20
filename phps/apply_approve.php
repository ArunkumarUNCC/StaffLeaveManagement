<?php
	$host="localhost"; // Host name 
	$username="root"; // Mysql username 
	$password="123456"; // Mysql password 
	$db_name="leave_management"; // Database name 
	$tb_name="approve";
	
	$id=$_POST["id"];
	$date=$_POST["date"];
	$class=$_POST["class"];
	$period=$_POST["period"];
	$dept=$_POST["dept"];
	$to=$_POST["staff"];
	$subject=$_POST["subject"];

	$connect_id=mysql_connect("localhost", "root", "123456")or die("cannot connect"); 
	mysql_select_db("$db_name",$connect_id) or die("NoDatabase");	
	
	for($i=0;$i<sizeof($to);$i++){
		mysql_query("INSERT INTO $tb_name VALUES('$id','$dept[$i]','$to[$i]','$date[$i]','$class[$i]','$period[$i]','$subject[$i]')");
	}
	
	echo json_encode("hi");
?>