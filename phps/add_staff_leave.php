<?php
	$host="localhost"; // Host name 
	$username="root"; // Mysql username 
	$password="123456"; // Mysql password 
	$db_name="leave_management"; // Database name 
	$tb_name="leaves";
	
	$type=$_POST["type"];
	$leave_name=$_POST["name"];
	$names=implode(",",$_POST["name"]);
	$counts=implode(",",$_POST["count"]);
	$from_date=$_POST["from"];
	$to_date=$_POST["to"];
	
	$connect_id=mysql_connect("localhost", "root", "123456")or die("cannot connect"); 
	mysql_select_db("$db_name",$connect_id) or die("NoDatabase");
	
	mysql_query("UPDATE $tb_name SET `leave_name`='$names',`leave_count`='$counts' WHERE `type`='$type'");
	
	for($i=0;$i<sizeof($leave_name);$i++){
		$check_col=mysql_query("SELECT * FROM information_schema.COLUMNS WHERE TABLE_SCHEMA='$db_name' AND TABLE_NAME='staff' AND COLUMN_NAME='$names[$i]'");
		
		if(mysql_num_rows($check_col)==0){
			mysql_query("ALTER TABLE `staff` ADD `$leave_name[$i]` VARCHAR(20)");
		}
	}
	$check=mysql_query("SELECT * FROM `staff` WHERE `from_date`='$from_date' AND `to_date`='$to_date'");
	if(mysql_num_rows($check)==0){
		$user1=mysql_query("SELECT `staff_id` FROM `leave_users` WHERE `staff_type`='$type' OR `staff_type`='HOD'");
		
		$get=mysql_query("SELECT `leave_name`,`leave_count` FROM `leaves` WHERE `type`='$type'");
			
		$row1=mysql_fetch_array($get);
		$leave_name=explode(",",$row1[0]);
		$leave_count=explode(",",$row1[1]);
		
		while($row=mysql_fetch_array($user1)){
			mysql_query("INSERT INTO `staff`(`staff_id`,`from_date`,`to_date`) VALUES('$row[0]','$from_date','$to_date')");
		}
		for($i=0;$i<sizeof($leave_name);$i++){
			mysql_query("UPDATE `staff` SET `$leave_name[$i]`='$leave_count[$i]/$leave_count[$i]' WHERE `from_date`='$from_date' AND `to_date`='$to_date'");
		}
		
	}
	
	
	echo json_encode("Leave Updated Successfully");
	
?>