<?php
	$host="localhost"; // Host name 
	$username="root"; // Mysql username 
	$password="123456"; // Mysql password 
	$db_name="leave_management"; // Database name 
	$tb_name="apply";
	
	$date=$_POST["date"];
	$dept=$_POST["dept"];
	$type=$_POST["type"];
	
	$names=array();
	$leave_types=array();
	$purpose=array();
	$departments=array();
	$designations=array();
	
	$connect_id=mysql_connect("localhost", "root", "123456")or die("cannot connect"); 
	mysql_select_db("$db_name",$connect_id) or die("NoDatabase");
	
	if($dept=="All" && $type=="All"){
		$get1=mysql_query("SELECT a.`leave_type`,b.`staff_name`,a.`purpose`,b.`department`,b.`designation` FROM $tb_name a,`leave_users` b WHERE a.`dates` LIKE '%$date%' AND a.`staff_id`=b.`staff_id` AND a.`principal`='Approve'");
		
		while($row=mysql_fetch_array($get1)){
			array_push($names,$row[1]);
			array_push($leave_types,$row[0]);
			array_push($purpose,$row[2]);
			array_push($departments,$row[3]);
			array_push($designations,$row[4]);
		}
		echo json_encode(array($leave_types,$names,$purpose,$departments,$designations));
	}
	
	else if($dept=="All" && $type!="All"){
		$get1=mysql_query("SELECT a.`leave_type`,b.`staff_name`,a.`purpose`,b.`department`,b.`designation` FROM $tb_name a,`leave_users` b WHERE a.`dates` LIKE '%$date%' AND a.`staff_id`=b.`staff_id` AND a.`principal`='Approve' AND a.`leave_type`='$type'");
		
		while($row=mysql_fetch_array($get1)){
			array_push($names,$row[1]);
			array_push($leave_types,$row[0]);
			array_push($purpose,$row[2]);
			array_push($departments,$row[3]);
			array_push($designations,$row[4]);
		}
		echo json_encode(array($leave_types,$names,$purpose,$departments,$designations));
	}	
	
	else if($dept!="All" && $type=="All"){
		$get1=mysql_query("SELECT a.`leave_type`,b.`staff_name`,a.`purpose`,b.`department`,b.`designation` FROM $tb_name a,`leave_users` b WHERE a.`dates` LIKE '%$date%' AND a.`staff_id`=b.`staff_id` AND a.`principal`='Approve' AND b.`department`='$dept'");
		
		while($row=mysql_fetch_array($get1)){
			array_push($names,$row[1]);
			array_push($leave_types,$row[0]);
			array_push($purpose,$row[2]);
			array_push($departments,$row[3]);
			array_push($designations,$row[4]);
		}
		echo json_encode(array($leave_types,$names,$purpose,$departments,$designations));
	}
	
	else{
		$get1=mysql_query("SELECT a.`leave_type`,b.`staff_name`,a.`purpose`,b.`department`,b.`designation` FROM $tb_name a,`leave_users` b WHERE a.`dates` LIKE '%$date%' AND a.`staff_id`=b.`staff_id` AND a.`principal`='Approve' AND b.`department`='$dept' AND a.`leave_type`='$type'");
		
		while($row=mysql_fetch_array($get1)){
			array_push($names,$row[1]);
			array_push($leave_types,$row[0]);
			array_push($purpose,$row[2]);
			array_push($departments,$row[3]);
			array_push($designations,$row[4]);
		}
		echo json_encode(array($leave_types,$names,$purpose,$departments,$designations));
	}
?>