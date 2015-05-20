<?php
	$host="localhost"; // Host name 
	$username="root"; // Mysql username 
	$password="123456"; // Mysql password 
	$db_name="leave_management"; // Database name 
	$tb_name="apply";
	
	$from=$_POST["from"];
	$to=$_POST["to"];
	$dept=$_POST["duig"];

	$names=array();
	$departments=array();
	$from_date=array();
	$to_date=array();
	$months=array();
	$dates=array();
	$counts=array();
	
	$final_dates=array();
	$final_months=array();
	$final_counts=array();
	
	$temp_date=array();
	$temp_month="";
	$temp_staff="";
	$count=0;
	$c=0;
	
	$connect_id=mysql_connect("localhost", "root", "123456")or die("cannot connect"); 
	mysql_select_db("$db_name",$connect_id) or die("NoDatabase");
	
	if($dept=="All"){
		$get=mysql_query("SELECT a.`leave_type`,b.`staff_name`,a.`purpose`,b.`department`,b.`designation`,a.`dates`,a.`staff_id` FROM $tb_name a,`leave_users` b WHERE a.`staff_id`=b.`staff_id` AND a.`principal`='Approve' AND a.`leave_type`='LOP' ORDER BY a.`staff_id` ASC");
			
		while($row=mysql_fetch_array($get)){
			
			/*if($temp_staff!=$row[6]){
				$temp_staff=$row[6];
				
				//if($c>0){
					array_push($counts,$count);
					array_push($final_counts,implode("//",$counts));
					array_push($final_dates,implode("//",$dates));
					array_push($final_months,implode("//",$months));
					array_push($names,$row[1]);
					array_push($departments,$row[3]);
					
					$counts=array();
					$dates=array();
					$months=array();
					$count=0;
					$c=1;	
				//}
				
				$temp_date=explode(",",$row[5]);
				
				
				array_push($from_date,$temp_date[0]);
				array_push($to_date,$temp_date[sizeof($temp_date)-1]);
				
				for($i=0;$i<sizeof($temp_date);$i++){
					if((strtotime($temp_date[$i])>=strtotime($from)) && (strtotime($temp_date[$i])<=strtotime($to))){	
						array_push($dates,$temp_date[$i]);			
						$temp_month=date('F',strtotime($temp_date[$i]));
						
						
						if(!in_array($temp_month,$months)){
							array_push($months,date('F',strtotime($temp_date[$i])));	
							if($i!=0){
								if($count!=0)
									array_push($counts,$count);
								$count=0;
							}
						}
						$count++;
					}
				}
			}
			else{*/
				$temp_date=explode(",",$row[5]);
				
				
				array_push($from_date,$temp_date[0]);
				array_push($to_date,$temp_date[sizeof($temp_date)-1]);
				
				for($i=0;$i<sizeof($temp_date);$i++){
					if((strtotime($temp_date[$i])>=strtotime($from)) && (strtotime($temp_date[$i])<=strtotime($to))){	
						array_push($dates,$temp_date[$i]);			
						$temp_month=date('F',strtotime($temp_date[$i]));
						
						
						if(!in_array($temp_month,$months)){
							array_push($months,date('F',strtotime($temp_date[$i])));	
							if($i!=0){
								if($count!=0)
									array_push($counts,$count);
								$count=0;
							}
						}
						$count++;
					}
				}
			//}
			if(sizeof($dates)>0){
				array_push($counts,$count);
				array_push($final_counts,implode("//",$counts));
				array_push($final_dates,implode("//",$dates));
				array_push($final_months,implode("//",$months));
				array_push($names,$row[1]);
				array_push($departments,$row[3]);
				
				$counts=array();
				$dates=array();
				$months=array();
				$count=0;	
			}
		}
	}
	
	else{
		$get=mysql_query("SELECT a.`leave_type`,b.`staff_name`,a.`purpose`,b.`department`,b.`designation`,a.`dates`,a.`staff_id` FROM $tb_name a,`leave_users` b WHERE a.`staff_id`=b.`staff_id` AND a.`principal`='Approve' AND a.`leave_type`='LOP' AND b.`department`='$dept' ORDER BY a.`staff_id` ASC");
			
		while($row=mysql_fetch_array($get)){
			
			/*if($temp_staff!=$row[6]){
				$temp_staff=$row[6];
				
				//if($c>0){
					array_push($counts,$count);
					array_push($final_counts,implode("//",$counts));
					array_push($final_dates,implode("//",$dates));
					array_push($final_months,implode("//",$months));
					array_push($names,$row[1]);
					array_push($departments,$row[3]);
					
					$counts=array();
					$dates=array();
					$months=array();
					$count=0;
					$c=1;	
				//}
				
				$temp_date=explode(",",$row[5]);
				
				
				array_push($from_date,$temp_date[0]);
				array_push($to_date,$temp_date[sizeof($temp_date)-1]);
				
				for($i=0;$i<sizeof($temp_date);$i++){
					if((strtotime($temp_date[$i])>=strtotime($from)) && (strtotime($temp_date[$i])<=strtotime($to))){	
						array_push($dates,$temp_date[$i]);			
						$temp_month=date('F',strtotime($temp_date[$i]));
						
						
						if(!in_array($temp_month,$months)){
							array_push($months,date('F',strtotime($temp_date[$i])));	
							if($i!=0){
								if($count!=0)
									array_push($counts,$count);
								$count=0;
							}
						}
						$count++;
					}
				}
			}
			else{*/
				$temp_date=explode(",",$row[5]);
				
				
				array_push($from_date,$temp_date[0]);
				array_push($to_date,$temp_date[sizeof($temp_date)-1]);
				
				for($i=0;$i<sizeof($temp_date);$i++){
					if((strtotime($temp_date[$i])>=strtotime($from)) && (strtotime($temp_date[$i])<=strtotime($to))){	
						array_push($dates,$temp_date[$i]);			
						$temp_month=date('F',strtotime($temp_date[$i]));
						
						
						if(!in_array($temp_month,$months)){
							array_push($months,date('F',strtotime($temp_date[$i])));	
							if($i!=0){
								if($count!=0)
									array_push($counts,$count);
								$count=0;
							}
						}
						$count++;
					}
				}
			//}
			if(sizeof($dates)>0){
				array_push($counts,$count);
				array_push($final_counts,implode("//",$counts));
				array_push($final_dates,implode("//",$dates));
				array_push($final_months,implode("//",$months));
				array_push($names,$row[1]);
				array_push($departments,$row[3]);
				
				$counts=array();
				$dates=array();
				$months=array();
				$count=0;	
			}
		}
	}
	echo json_encode(array($names,$departments,$final_dates,$final_months,$final_counts,$dept));
	
?>