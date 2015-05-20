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
	$staff_ids=$_POST["staff"];
	$period=implode("|",$_POST["period"]);
	$class=implode(",",$_POST["class"]);
	$subject=implode(",",$_POST["subject"]);
	$alternate_date=implode(",",$_POST["date"]);
	
	$dates=array();
	//$final_staff=array();
	$final_date="";
	//$get_final_staff="";
	
	$connect_id=mysql_connect("localhost", "root", "123456")or die("cannot connect"); 
	mysql_select_db("$db_name",$connect_id) or die("NoDatabase");
	
		if($to==""){
			$begin = new DateTime($from);
			if(date("w",strtotime($begin->format("Y-m-d")))>0){
				$check=mysql_query("SELECT * FROM `holidays` WHERE `day`='".$begin->format('Y-m-d')."' OR `end`='".$begin->format('Y-m-d')."' OR '".$begin->format('Y-m-d')."' BETWEEN `day` AND `end`");
				if(mysql_num_rows($check)==0){

					
					for($count=0;$count<sizeof($staff_ids);$count++){
						$final_staff[$count]=$staff_ids[$count]."-Pending";
					}
					$get_final_staff=implode(",",$final_staff);
					mysql_query("UPDATE $tb_name SET `staff`='$get_final_staff',`periods`='$period',`classes`='$class',`subjects`='$subject',`alternate_dates`='$alternate_date' WHERE `staff_id`='$id' AND `dates`='$from' AND `sessions`='$from_ses'");	
				}
				echo json_encode("Staff Alterations Made Successfully");
			}

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
			
			if(sizeof($dates)>0){
				$final_staff=array();
				
				for($count=0;$count<sizeof($staff_ids);$count++){
					$final_staff[$count]=$staff_ids[$count]."-Pending";
				}
			
				$get_final_staff=implode(",",$final_staff);
				mysql_query("UPDATE $tb_name SET `staff`='$get_final_staff',`periods`='$period',`classes`='$class',`subjects`='$subject',`alternate_dates`='$alternate_date' WHERE `staff_id`='$id' AND `dates`='$final_date' AND `sessions`='$final_ses'");
				
			}
				
			echo json_encode("Staff Alterations Made Successfully");
		}
	
?>