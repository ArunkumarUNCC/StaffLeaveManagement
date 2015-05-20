<?php
	$host="localhost"; // Host name 
	$username="root"; // Mysql username 
	$password="123456"; // Mysql password 
	$db_name="leave_management"; // Database name 
	$tb_name="apply";
	
	$dept=$_POST["dept"];
	
	$staff_ids=array();
	$staff_names=array();
	$dates=array();
	$sessions=array();
	$total=array();
	$purpose=array();
	$departments=array();
	$photos=array();
	
	$alternate_staff=array();
	$alternate_class=array();
	$alternate_period=array();
	$alternate_subject=array();
	$alternate_date=array();
	$alternate_staff_names=array();
	$temp=array();
	$t_staff=array();
	
	$connect_id=mysql_connect("localhost", "root", "123456")or die("cannot connect"); 
	mysql_select_db("$db_name",$connect_id) or die("NoDatabase");
	$type=array();
	//$hod_dept=mysql_fetch_array(mysql_query("SELECT `department` FROM `leave_users` WHERE `staff_id`='$id'"));
	if($dept=="All"){
		$get=mysql_query("SELECT * FROM $tb_name where `staff` NOT LIKE '%-Pending%' AND `hod`='Approve' AND `principal`='Pending'");
		
		while($row=mysql_fetch_array($get)){
			array_push($staff_ids,$row[0]);
			$name=mysql_query("SELECT `staff_name`,`department`,`photo` FROM `leave_users` WHERE `staff_id`='$row[0]'");
			while($row2=mysql_fetch_array($name)){
				array_push($staff_names,$row2[0]);
				array_push($departments,$row2[1]);
				array_push($photos,$row2[2]);
			}
			array_push($dates,$row[1]);
			array_push($sessions,$row[2]);
			array_push($type,$row[3]);
			array_push($total,$row[11]);
			array_push($purpose,$row[9]);
			array_push($alternate_staff,$row[4]);
			array_push($alternate_period,$row[5]);
			array_push($alternate_class,$row[6]);
			array_push($alternate_subject,$row[12]);
			array_push($alternate_date,$row[13]);
		}
		
			for($j=0;$j<sizeof($alternate_staff);$j++){
			$general=explode(",",$alternate_staff[$j]);
			for($i=0;$i<sizeof($general);$i++){
				array_push($temp,explode("-",$general[$i])[0]);
			}
			
			for($i=0;$i<sizeof($temp);$i++){
				$get_name=mysql_query("SELECT `staff_name` FROM `leave_users` WHERE `staff_id`='$temp[$i]'");
			
				while($row2=mysql_fetch_array($get_name)){
					array_push($t_staff,$row2[0]);
				}	
	
			}
			
			array_push($alternate_staff_names,implode(",",$t_staff));
			$t_staff=array();
			$temp=array();
		}
		
		echo json_encode(array($staff_ids,$staff_names,$dates,$sessions,$alternate_staff,$alternate_class,$alternate_period,$type,$total,$purpose,$alternate_subject,$alternate_date,$alternate_staff_names,$departments,$photos));
	}
	else{
		$get=mysql_query("SELECT * FROM $tb_name where `staff_id` IN (SELECT `staff_id` FROM `leave_users` WHERE `department`='$dept') AND `staff` NOT LIKE '%-Pending%' AND `hod`='Approve' AND `principal`='Pending'");
		
		while($row=mysql_fetch_array($get)){
			array_push($staff_ids,$row[0]);
			$name=mysql_query("SELECT `staff_name`,`department`,`photo` FROM `leave_users` WHERE `staff_id`='$row[0]'");
			while($row2=mysql_fetch_array($name)){
				array_push($staff_names,$row2[0]);
				array_push($departments,$row2[1]);
				array_push($photos,$row2[2]);
			}
			array_push($dates,$row[1]);
			array_push($sessions,$row[2]);
			array_push($type,$row[3]);
			array_push($total,$row[11]);
			array_push($purpose,$row[9]);
			array_push($alternate_staff,$row[4]);
			array_push($alternate_period,$row[5]);
			array_push($alternate_class,$row[6]);
			array_push($alternate_subject,$row[12]);
			array_push($alternate_date,$row[13]);
		}
		
			for($j=0;$j<sizeof($alternate_staff);$j++){
			$general=explode(",",$alternate_staff[$j]);
			for($i=0;$i<sizeof($general);$i++){
				array_push($temp,explode("-",$general[$i])[0]);
			}
			
			for($i=0;$i<sizeof($temp);$i++){
				$get_name=mysql_query("SELECT `staff_name` FROM `leave_users` WHERE `staff_id`='$temp[$i]'");
			
				while($row2=mysql_fetch_array($get_name)){
					array_push($t_staff,$row2[0]);
				}	
	
			}
			
			array_push($alternate_staff_names,implode(",",$t_staff));
			$t_staff=array();
			$temp=array();
		}
		
		echo json_encode(array($staff_ids,$staff_names,$dates,$sessions,$alternate_staff,$alternate_class,$alternate_period,$type,$total,$purpose,$alternate_subject,$alternate_date,$alternate_staff_names,$departments,$photos));
	}
?>