<?php
	$host="localhost"; // Host name 
	$username="root"; // Mysql username 
	$password="123456"; // Mysql password 
	$db_name="leave_management"; // Database name 
	$tb_name="leaves";
	
	$type=$_POST["type"];
	$leave_name=$_POST["name"];
	$names=implode(",",$_POST["name"]);
	$leave_count=$_POST["count"];
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
	
	if($type=="Teaching Staff")
		$get_single = mysql_query("SELECT `staff_id` FROM `leave_users` WHERE `staff_type`='$type' OR `staff_type`='HOD' LIMIT 1");
		
	else $get_single = mysql_query("SELECT `staff_id` FROM `leave_users` WHERE `staff_type`='$type' LIMIT 1");	
		
	$row3 = mysql_fetch_array($get_single);	
		
	$check=mysql_query("SELECT * FROM `staff` WHERE `from_date`='$from_date' AND `to_date`='$to_date' AND `staff_id`='$row3[0]'");
	if(mysql_num_rows($check)==0){
		$get_admin = mysql_query("SELECT `staff_id` FROM `leave_users` WHERE `staff_type`='Admin'");
			
		$row2 = mysql_fetch_array($get_admin);
		$admin_id = $row2[0];
			
		mysql_query("UPDATE `staff` SET `from_date`='$from_date',`to_date`='$to_date' WHERE `staff_id`='$admin_id'");
		
		if($type=="Teaching Staff")
			$user1=mysql_query("SELECT `staff_id` FROM `leave_users` WHERE `staff_type`='$type' OR `staff_type`='HOD'");
		
		else $user1=mysql_query("SELECT `staff_id` FROM `leave_users` WHERE `staff_type`='$type'");
		
		while($row=mysql_fetch_array($user1)){
			mysql_query("INSERT INTO `staff`(`staff_id`,`from_date`,`to_date`) VALUES('$row[0]','$from_date','$to_date')");
			
			for($i=0;$i<sizeof($leave_name);$i++){
				mysql_query("UPDATE `staff` SET `$leave_name[$i]`='$leave_count[$i]/$leave_count[$i]' WHERE `from_date`='$from_date' AND `to_date`='$to_date' AND `staff_id`='$row[0]'");
			}
		}
		
		echo json_encode("Leave Updated Successfully");
	}
	
	/*else{
		if($type="Teaching Staff")
			$user1=mysql_query("SELECT `staff_id` FROM `leave_users` WHERE `staff_type`='$type' OR `staff_type`='HOD'");
		
		else $user1=mysql_query("SELECT `staff_id` FROM `leave_users` WHERE `staff_type`='$type'");
		
		$get=mysql_query("SELECT `leave_name`,`leave_count` FROM `leaves` WHERE `type`='$type'");
				
		$row1=mysql_fetch_array($get);
		$leave_name=explode(",",$row1[0]);
		$leave_count=explode(",",$row1[1]);
		
		
		for($i=0;$i<sizeof($leave_name);$i++){
			while($row=mysql_fetch_array($user1)){
				mysql_query("UPDATE `staff` SET `$leave_name[$i]`='$leave_count[$i]/$leave_count[$i]' WHERE `from_date`='$from_date' AND `to_date`='$to_date' AND `staff_id`='$row[0]'");
			}
		}
		
		echo json_encode("Leave Updated Successfully");
	}*/
	else echo json_encode("You cannot alter the leave details that were provided for the already existing dates");
	
	
?>