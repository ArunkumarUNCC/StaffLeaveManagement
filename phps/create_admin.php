<?php
	$host="localhost"; // Host name 
	$username="root"; // Mysql username 
	$password="123456"; // Mysql password 
	$db_name="leave_management"; // Database name 
	$tb_name="leave_users";
	
	$name=$_POST["name"];
	$id=$_POST["id"];
	$type="Admin";
	//$doj=$_POST["doj"];
	$mail=$_POST["mail"];
	$contact=$_POST["contact"];
	
	$connect_id=mysql_connect("localhost", "root", "123456")or die("cannot connect"); 
	mysql_select_db("$db_name",$connect_id) or die("NoDatabase");
	
	$check=mysql_query("SELECT * FROM $tb_name WHERE `staff_id`='$id'");
	
	if(mysql_num_rows($check)==0){
		mysql_query("INSERT INTO $tb_name(`staff_id`, `staff_name`, `staff_type`, `mail`, `contact`, `user_name`, `password`) VALUES('$id','$name','$type','$mail','$contact','$id','$id')");
		echo json_encode("New Admin Added...");
		
	}
	
	else echo json_encode("AdminId Already Exists");
	
?>