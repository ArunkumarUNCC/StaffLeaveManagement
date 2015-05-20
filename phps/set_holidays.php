<?php
	$host="localhost"; // Host name 
	$username="root"; // Mysql username 
	$password="123456"; // Mysql password 
	$db_name="leave_management"; // Database name 
	$tb_name="holidays";
	$id=$_POST["flag"];
	$holiday=$_POST["holiday"];
	$s_date=$_POST["s_date"];
	$e_date=$_POST["e_date"];
	$flag1=$_POST["id"];
	//$e_date=$e_date-1;
	
	$connect_id=mysql_connect("localhost", "root", "123456")or die("cannot connect"); 
	mysql_select_db("$db_name",$connect_id) or die("NoDatabase");
	
	if($id=="1"){
		mysql_query("INSERT INTO $tb_name VALUES('$flag1','$holiday','$s_date','$e_date')");
		mysql_query("UPDATE $tb_name SET `end`=DATE_SUB(`end`,INTERVAL 1 DAY) WHERE `id`='$flag1'");
		echo json_encode("Insertion Successfull");
	}
		
	else if($id=="2"){
		mysql_query("UPDATE $tb_name SET `id`='$holiday $s_date',`day`='$s_date',`end`='$e_date' WHERE `id`='$flag1'");
		mysql_query("UPDATE $tb_name SET `end`=DATE_SUB(`end`,INTERVAL 1 DAY) WHERE `id`='$flag1'");
		echo json_encode("Updation Successfull");
	}

	else if($id=="3"){
		mysql_query("UPDATE $tb_name SET `holiday`='$holiday' WHERE `id`='$flag1'");
		echo json_encode("Updation Success");
	}
	
	else if($id=="4"){
		mysql_query("DELETE FROM $tb_name WHERE `id`='$flag1'");
		echo json_encode("Deletion Successfull");
	}
	
	else if($id=="5"){
		mysql_query("UPDATE $tb_name SET `end`='$e_date' WHERE `id`='$flag1'");
		mysql_query("UPDATE $tb_name SET `end`=DATE_SUB(`end`,INTERVAL 1 DAY) WHERE `id`='$flag1'");
		echo json_encode("Updation Successfull");
	}
	
	else{
		//mysql_query("DELETE FROM $tb_name WHERE YEAR( STR_TO_DATE(  `day` ,  '%Y-%m-%d' ) ) < $flag1");
		mysql_query("DELETE FROM $tb_name WHERE (STR_TO_DATE(  `day` ,  '%Y-%m-%d' ) BETWEEN '$s_date' AND '$e_date') AND (STR_TO_DATE(  `end` ,  '%Y-%m-%d' ) BETWEEN '$s_date' AND '$e_date')");
		echo json_encode("Holidays Within the Seleted Range of Dates Has Been Successfully Deleted");
	}
?>