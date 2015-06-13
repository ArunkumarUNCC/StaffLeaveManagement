<?php
	$host="localhost"; // Host name 
	$username="root"; // Mysql username 
	$password="123456"; // Mysql password 
	$db_name="leave_management"; // Database name 
	$tb_name="cancel_leaves";
	
	$id=$_POST["id"];
	$from=$_POST["from"];
	$user=$_POST["user"];
	$type=$_POST["type"];
	$status=$_POST["status"];
	
	$temp=array();
	$total=0;
	
	$connect_id=mysql_connect("localhost", "root", "123456")or die("cannot connect"); 
	mysql_select_db("$db_name",$connect_id) or die("NoDatabase");
	
	if($user=="HOD"){
		if($status=="Deny"){
			mysql_query("DELETE FROM $tb_name WHERE `staff_id`='$id' AND `from_date`='$from' AND `leave_type`='$type'");
			mysql_query("UPDATE `apply` SET `cancel_status`='$status,$status,$status' WHERE `staff_id`='$id' AND `leave_type`='$type' AND `cancel_dates`='$from'");
		}
		else{
			mysql_query("UPDATE $tb_name SET `hod`='$status',`admin`='$status' WHERE `staff_id`='$id' AND `from_date`='$from' AND `leave_type`='$type'");	
			mysql_query("UPDATE `apply` SET `cancel_status`='$status,$status,Pending' WHERE `staff_id`='$id' AND `leave_type`='$type' AND `cancel_dates`='$from'");
		}
	}
		
	else if($user=="Principal"){
		mysql_query("DELETE FROM $tb_name WHERE `staff_id`='$id' AND `from_date`='$from' AND `leave_type`='$type'");
		mysql_query("UPDATE `apply` SET `cancel_status`='Approve,Approve,$status' WHERE `staff_id`='$id' AND `leave_type`='$type' AND `cancel_dates`='$from'");
		
		if($status=="Approve"){
			$cancelling_dates = array();
			$cancelling_dates = explode(",",$from);
			$date_count = sizeof($cancelling_dates);
			$tempDate1 = array();
			$tempDate1 = explode("_",$from);
			$reduce_session = 0;
			
			for($i=0;$i<sizeof($cancelling_dates);$i++){
				
				if((explode("_",$cancelling_dates[$i],1)=="an" || explode("_",$cancelling_dates[$i],1)=="fn")){}
					$reduce_session+=0.5;
			}
				
			$date_count-=$reduce_session;

			$get1=mysql_query("SELECT `$type` FROM `staff` WHERE `staff_id`='$id' AND ('$tempDate1[0]' BETWEEN `from_date` AND `to_date`)");
	
			
			while($row1=mysql_fetch_array($get1)){
				$temp=explode("/",$row1[0]);
			}
			
			$date_count+=intval($temp[0]);
			
			$get_total = mysql_query("SELECT `total` FROM `apply` WHERE `staff_id`='$id' AND `dates` LIKE '%$from%' AND `leave_type`='$type'");
			
			$get1=mysql_query("UPDATE `staff` SET `$type`='$date_count/$temp[1]' WHERE `staff_id`='$id' AND ('$tempDate1[0]' BETWEEN `from_date` AND `to_date`)");
		}
	}
	echo json_encode("You ".$status."d Leave Cancellation");
	///echo json_encode("Hello");
?>
	