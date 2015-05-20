<?php
	$host="localhost"; // Host name 
	$username="root"; // Mysql username 
	$password="123456"; // Mysql password 
	$db_name="leave_management"; // Database name 
	$tb_name="leave_users";
	
	$user_name=$_POST["user"];
	$password=$_POST["pass"];
	
	$connect_id=mysql_connect("localhost", "root", "123456")or die("cannot connect"); 
	mysql_select_db("$db_name",$connect_id) or die("NoDatabase");
	
	$check=mysql_query("SELECT `staff_type`,`staff_name`,`photo` FROM $tb_name WHERE `user_name`='$user_name' AND `password`='$password'");
	
	if(mysql_num_rows($check)>=1){
		while($row=mysql_fetch_array($check)){
			$type=$row[0];
			$name=$row[1];
			$path=$row[2];
		}
		
		
		echo json_encode(array("Success",$type,$name,$path));

	}
	else echo json_encode(array("Failure","Invalid Username or Password"));

?>