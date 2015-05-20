<?php
	$host="localhost"; // Host name 
	$username="root"; // Mysql username 
	$password="123456"; // Mysql password 
	$db_name="leave_management"; // Database name 
	$tb_name="apply";
	
	$id=$_POST["id"];
	$date=$_POST["date"];
	$year=explode("-",$date);
	
	$dates=array();
	$leave_type=array();
	$staff=array();
	$period=array();
	$class=array();
	$hod=array();
	$principal=array();
	$purpose=array();
	$submit=array();
	$total=array();
	$subjects=array();
	$alternate_dates=array();
	$staff_names=array();
	$temp=array();
	$t_staff=array();
	
	$connect_id=mysql_connect("localhost", "root", "123456")or die("cannot connect"); 
	mysql_select_db("$db_name",$connect_id) or die("NoDatabase");
	
	$get_date=mysql_query("SELECT * FROM $tb_name WHERE `dates` LIKE '%$year[0]%' AND `staff_id`='$id'");
	
	while($row=mysql_fetch_array($get_date)){
		array_push($dates,$row[1]);
		array_push($leave_type,$row[3]);
		array_push($staff,$row[4]);		
		array_push($period,$row[5]);
		array_push($class,$row[6]);
		array_push($hod,$row[7]);
		array_push($principal,$row[8]);
		array_push($purpose,$row[9]);
		array_push($submit,$row[10]);
		array_push($total,$row[11]);
		array_push($subjects,$row[12]);
		array_push($alternate_dates,$row[13]);
	}
	
	for($j=0;$j<sizeof($staff);$j++){
		$general=explode(",",$staff[$j]);
		for($i=0;$i<sizeof($general);$i++){
			array_push($temp,explode("-",$general[$i])[0]);
		}
		
		for($i=0;$i<sizeof($temp);$i++){
			$get_name=mysql_query("SELECT `staff_name` FROM `leave_users` WHERE `staff_id`='$temp[$i]'");
		
			while($row2=mysql_fetch_array($get_name)){
				array_push($t_staff,$row2[0]);
			}	

		}
		
		array_push($staff_names,implode(",",$t_staff));
		$t_staff=array();
		$temp=array();
	}


	echo json_encode(array($dates,$leave_type,$staff,$period,$class,$hod,$principal,$purpose,$submit,$total,$subjects,$staff_names,$alternate_dates));

?>