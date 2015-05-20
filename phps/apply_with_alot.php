<?php
	$host="localhost"; // Host name 
	$username="root"; // Mysql username 
	$password="123456"; // Mysql password 
	$db_name="leave_management"; // Database name 
	$tb_name="apply";
	
	$id=$_POST["id"];
	$type=$_POST["type"];
	$from=$_POST["from"];
	$to=$_POST["to"];
	$from_ses=$_POST["from_ses"];
	$to_ses=$_POST["to_ses"];
	$purpose=$_POST["purpose"];
	$submit_date=$_POST["submitted_on"];
	$total=$_POST["days"];
	
	$dates=array();
	$final_date="";
	
	$connect_id=mysql_connect("localhost", "root", "123456")or die("cannot connect"); 
	mysql_select_db("$db_name",$connect_id) or die("NoDatabase");
	

	if($to==""){
		$staff_date=mysql_query("SELECT * FROM `staff` WHERE `staff_id`='$id' AND (`from_date`='$from' OR '$from' BETWEEN `from_date` AND `to_date`)");
		
		if(mysql_num_rows($staff_date)==0){
			echo json_encode("You are not eligible to take this leave");
		}
		else{
			$begin = new DateTime($from);
			if(date("w",strtotime($begin->format("Y-m-d")))>0){
				$check=mysql_query("SELECT * FROM `holidays` WHERE `day`='".$begin->format('Y-m-d')."' OR `end`='".$begin->format('Y-m-d')."' OR '".$begin->format('Y-m-d')."' BETWEEN `day` AND `end`");
				if(mysql_num_rows($check)==0){
					if($from_ses=="fd")
						mysql_query("INSERT INTO $tb_name(`staff_id`,`dates`,`sessions`,`leave_type`,`hod`,`principal`,`purpose`,`submitted`,`total`) VALUES('$id','$from','$from_ses','$type','Pending','Pending','$purpose','$submit_date','1')");
					else mysql_query("INSERT INTO $tb_name(`staff_id`,`dates`,`sessions`,`leave_type`,`hod`,`principal`,`purpose`,`submitted`,`total`) VALUES('$id','$from','$from_ses','$type','Pending','Pending','$purpose','$submit_date','0.5')");
					$final_date=$from;
					echo json_encode($final_date);	
				}
				else echo json_encode("The selected date is a holiday...");
			}
			
		}
	}
		
	else{
		$staff_date=mysql_query("SELECT * FROM `staff` WHERE `staff_id`='$id' AND (`from_date`='$from' OR '$from' BETWEEN `from_date` AND `to_date`)");
		
		if(mysql_num_rows($staff_date)==0){
			echo json_encode("You are not eligible to take this leave");
		}
		else{
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
					$final_ses=$from_ses.",".$to_ses;
				}
				else $final_ses=$from_ses;
			}
			
			$final_date=implode(",",$dates);
			
			if(sizeof($final_date)>0)
				mysql_query("INSERT INTO $tb_name(`staff_id`,`dates`,`sessions`,`leave_type`,`hod`,`principal`,`purpose`,`submitted`,`total`) VALUES('$id','$final_date','$final_ses','$type','Pending','Pending','$purpose','$submit_date','$total')");
				
			echo json_encode($final_date);
		}
	}

?>