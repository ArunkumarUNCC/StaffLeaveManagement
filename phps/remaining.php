<?php
	$host="localhost"; // Host name 
	$username="root"; // Mysql username 
	$password="123456"; // Mysql password 
	$db_name="leave_management"; // Database name 
	$tb_name="leave_users";
	
	$id=$_POST["user"];
	$type=$_POST["type"];
	$date=$_POST["today"];
	
	if($type=="HOD")
		$type="Teaching Staff";
	
	$leave_names=array();
	$count=array();
	
	$connect_id=mysql_connect("localhost", "root", "123456")or die("cannot connect"); 
	mysql_select_db("$db_name",$connect_id) or die("NoDatabase");
	
	$staff_name="";
	$staff_dept="";
	$staff_desig="";
	
	$get_type=mysql_query("SELECT `staff_type`,`staff_name`,`department`,`designation` FROM `leave_users` WHERE `staff_id`='$id'");
	
	while($getting=mysql_fetch_array($get_type)){
		$staff_type=$getting[0];
		$staff_name=$getting[1];
		$staff_dept=$getting[2];
		$staff_desig=$getting[3];
	}
	if($staff_type=="HOD")
		$staff_type="Teaching Staff";
	
	$get_leave=mysql_query("SELECT `leave_name` FROM `leaves` WHERE `type`='$staff_type'");
	
	while($row=mysql_fetch_array($get_leave)){
		$leave_names=explode(",",$row[0]);
	}
	
	for($i=0;$i<sizeof($leave_names);$i++){
		$get_count=mysql_query("SELECT `$leave_names[$i]`,`LOP` FROM `staff` WHERE `staff_id`='$id' AND '$date' BETWEEN `from_date` AND `to_date`");
		
		while($row1=mysql_fetch_array($get_count)){
			array_push($count,$row1[0]);
			$lop=$row1[1];
		}
	}
	echo json_encode(array($leave_names,$count,$lop,$staff_name,$staff_dept,$staff_desig));
	
?>