<?php
	$host="localhost"; // Host name 
	$username="root"; // Mysql username 
	$password="123456"; // Mysql password 
	$db_name="leave_management"; // Database name 
	$tb_name="apply";
	
	$id=$_POST["id"];
	$date=$_POST["date"];
	$from=$_POST["accept_to"];
	$class=$_POST["class"];
	$period=$_POST["period"];
		$ch1=$period."|";
		$ch2="|".$period;
		$ch3="|".$period."|";
		$ch4=$period;
	$search=$id."-Pending";
	
	$dates=array();
	$staff=array();
	
	$connect_id=mysql_connect("localhost", "root", "123456")or die("cannot connect"); 
	mysql_select_db("$db_name",$connect_id) or die("NoDatabase");
	
	$get=mysql_query("SELECT `dates`,`staff` FROM $tb_name WHERE `dates` LIKE '%{$date}%' AND `staff` LIKE '%{$search}%' AND `classes` LIKE '%{$class}%' AND (`periods` LIKE '%{$ch1}%' OR `periods` LIKE '%{$ch2}%' OR `periods` LIKE '%{$ch3}%' OR `periods` LIKE '%{$ch4}%')");
	
	while($row=mysql_fetch_array($get)){
		$dates=explode(",",$row[0]);
		$staff=explode(",",$row[1]);
	}
	
	for($i=0;$i<sizeof($staff);$i++){
		if($staff[$i]==$id."-Pending"){
			$staff[$i]=$id."-Approved";
			break;
		}
	}
	$final_staff=implode(",",$staff);
	
	mysql_query("UPDATE $tb_name SET `staff`='$final_staff' WHERE `dates` LIKE '%{$date}%' AND `staff` LIKE '%{$search}%' AND `classes` LIKE '%{$class}%' AND (`periods` LIKE '%{$ch1}%' OR `periods` LIKE '%{$ch2}%' OR `periods` LIKE '%{$ch3}%'  OR `periods` LIKE '%{$ch4}%')");
	
	mysql_query("DELETE FROM `approve` WHERE `staff_id`='$from' AND `to`='$id' AND `date`='$date' AND `class`='$class' AND `periods`='$period'");
	
	echo json_encode("Request Approved");
?>