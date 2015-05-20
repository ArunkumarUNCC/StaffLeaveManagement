<?php
	$host="localhost"; // Host name 
	$username="root"; // Mysql username 
	$password="123456"; // Mysql password 
	$db_name="leave_management"; // Database name 
	$tb_name="apply";
	
	$from=$_POST["from"];
	$to=$_POST["to"];
	$dept=$_POST["dept"];
	$type=$_POST["type"];
	
	$names=array();
	$leave_types=array();
	$purpose=array();
	$departments=array();
	$designations=array();
	$from_date=array();
	$to_date=array();
	
	$temp_date=array();
	
	$connect_id=mysql_connect("localhost", "root", "123456")or die("cannot connect"); 
	mysql_select_db("$db_name",$connect_id) or die("NoDatabase");
	
	if($dept=="All" && $type=="All"){
	
		$get=mysql_query("SELECT a.`leave_type`,b.`staff_name`,a.`purpose`,b.`department`,b.`designation`,a.`dates` FROM $tb_name a,`leave_users` b WHERE a.`staff_id`=b.`staff_id` AND a.`principal`='Approve'");
		
		while($row=mysql_fetch_array($get)){
			$temp_date=explode(",",$row[5]);
			//array_push($temp_date,$row[5]);
			
			if($temp_date[0]>=$from && $temp_date[sizeof($temp_date)-1]<=$to){
				array_push($names,$row[1]);
				array_push($leave_types,$row[0]);
				array_push($purpose,$row[2]);
				array_push($departments,$row[3]);
				array_push($designations,$row[4]);
				array_push($from_date,$temp_date[0]);
				array_push($to_date,$temp_date[sizeof($temp_date)-1]);
			}
		}
		echo json_encode(array($leave_types,$names,$purpose,$departments,$designations,$from_date,$to_date));
	}
	
	else if($dept=="All" && $type!="All"){
		$get1=mysql_query("SELECT a.`leave_type`,b.`staff_name`,a.`purpose`,b.`department`,b.`designation`,a.`dates` FROM $tb_name a,`leave_users` b WHERE a.`staff_id`=b.`staff_id` AND a.`principal`='Approve' AND a.`leave_type`='$type'");
		
		while($row=mysql_fetch_array($get1)){
			$temp_date=explode(",",$row[5]);
		
			if($temp_date[0]>=$from && $temp_date[sizeof($temp_date)-1]<=$to){
				array_push($names,$row[1]);
				array_push($leave_types,$row[0]);
				array_push($purpose,$row[2]);
				array_push($departments,$row[3]);
				array_push($designations,$row[4]);
				array_push($from_date,$temp_date[0]);
				array_push($to_date,$temp_date[sizeof($temp_date)-1]);
			}
		}
		echo json_encode(array($leave_types,$names,$purpose,$departments,$designations,$from_date,$to_date));
	}	
	
	else if($dept!="All" && $type=="All"){
		$get1=mysql_query("SELECT a.`leave_type`,b.`staff_name`,a.`purpose`,b.`department`,b.`designation`,a.`dates` FROM $tb_name a,`leave_users` b WHERE a.`staff_id`=b.`staff_id` AND a.`principal`='Approve' AND b.`department`='$dept'");
		
		while($row=mysql_fetch_array($get1)){
			$temp_date=explode(",",$row[5]);
			if($temp_date[0]>=$from && $temp_date[sizeof($temp_date)-1]<=$to){
				array_push($names,$row[1]);
				array_push($leave_types,$row[0]);
				array_push($purpose,$row[2]);
				array_push($departments,$row[3]);
				array_push($designations,$row[4]);
				array_push($from_date,$temp_date[0]);
				array_push($to_date,$temp_date[sizeof($temp_date)-1]);
			}
		}
		echo json_encode(array($leave_types,$names,$purpose,$departments,$designations,$from_date,$to_date));
	}
	
	else{
		$get1=mysql_query("SELECT a.`leave_type`,b.`staff_name`,a.`purpose`,b.`department`,b.`designation`,a.`dates` FROM $tb_name a,`leave_users` b WHERE a.`staff_id`=b.`staff_id` AND a.`principal`='Approve' AND b.`department`='$dept' AND a.`leave_type`='$type'");
		
		while($row=mysql_fetch_array($get1)){
			$temp_date=explode(",",$row[5]);
			if($temp_date[0]>=$from && $temp_date[sizeof($temp_date)-1]<=$to){
				array_push($names,$row[1]);
				array_push($leave_types,$row[0]);
				array_push($purpose,$row[2]);
				array_push($departments,$row[3]);
				array_push($designations,$row[4]);
				array_push($from_date,$temp_date[0]);
				array_push($to_date,$temp_date[sizeof($temp_date)-1]);
			}
		}
		echo json_encode(array($leave_types,$names,$purpose,$departments,$designations,$from_date,$to_date));
	}
?>