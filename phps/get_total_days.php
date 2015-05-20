<?php
	$host="localhost"; // Host name 
	$username="root"; // Mysql username 
	$password="123456"; // Mysql password 
	$db_name="leave_management"; // Database name 
	$tb_name="apply";
	
	$id=$_POST["id"];
	$from=$_POST["from"];
	$to=$_POST["to"];
	
	$dates=array();
	$holidays=array();
	
	$connect_id=mysql_connect("localhost", "root", "123456")or die("cannot connect"); 
	mysql_select_db("$db_name",$connect_id) or die("NoDatabase");
	
	$begin = new DateTime($from);
	$end = new DateTime($to);
			
	$daterange = new DatePeriod($begin, new DateInterval('P1D'), $end);
	
	foreach($daterange as $date){
		if(date("w",strtotime($date->format("Y-m-d")))>0){
			$check=mysql_query("SELECT * FROM `holidays` WHERE `day`='".$date->format('Y-m-d')."' OR `end`='".$date->format('Y-m-d')."' OR '".$date->format('Y-m-d')."' BETWEEN `day` AND `end`");
			if(mysql_num_rows($check)==0)
				array_push($dates, $date->format("Y-m-d"));
		}
	}
	if(date("w",strtotime($end->format("Y-m-d")))>0){
		$check=mysql_query("SELECT * FROM `holidays` WHERE `day`='".$end->format('Y-m-d')."' OR `end`='".$end->format('Y-m-d')."' OR '".$end->format('Y-m-d')."' BETWEEN `day` AND `end`");
		if(mysql_num_rows($check)==0){
			array_push($dates, $end->format("Y-m-d"));
		}
	}
	
	echo json_encode($dates);
	
?>