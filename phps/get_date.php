<?php
	$host="localhost"; // Host name 
	$username="root"; // Mysql username 
	$password="123456"; // Mysql password 
	$db_name="leave_management"; // Database name 
	$tb_name="staff";
	
	$from=$_POST["from"];
	
	$connect_id=mysql_connect("localhost", "root", "123456")or die("cannot connect"); 
	mysql_select_db("$db_name",$connect_id) or die("NoDatabase");
	
	/*$count = mysql_query("SELECT * FROM $tb_name");
	if(mysql_num_rows($count) == 0)
		echo json_encode("");
	
	else{*/
		$get=mysql_query("SELECT DISTINCT(`to_date`) FROM $tb_name WHERE '$from' BETWEEN `from_date` AND `to_date`");
		
		while($row=mysql_fetch_array($get)){
			$final=$row[0];
			
		}
		echo json_encode($final);
	//}
?>