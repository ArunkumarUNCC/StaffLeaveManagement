<?php
	$host="localhost"; // Host name 
	$username="root"; // Mysql username 
	$password="123456"; // Mysql password 
	$db_name="leave_management"; // Database name 
	$tb_name="apply";
	
	$id=$_POST["id"];
	$l_from=$_POST["from"];
	$l_to=$_POST["to"];
	
	$dates=array();
	$from=array();
	$to=array();
	$purpose=array();
	$temp=array();
	$type=array();
	$status=array();
	$flag="";
	
	$connect_id=mysql_connect("localhost", "root", "123456")or die("cannot connect"); 
	mysql_select_db("$db_name",$connect_id) or die("NoDatabase");
	
	$get=mysql_query("SELECT `dates`,`purpose`,`leave_type` FROM $tb_name WHERE `staff_id`='$id' AND `principal`='Approve' AND `cancel_status`=''");
	
	while($row=mysql_fetch_array($get)){
		array($dates,$row[0]);
		$temp=explode(",",$row[0]);
	
		for($i=0;$i<sizeof($temp);$i++){	
			if((strtotime($temp[$i])>=strtotime($l_from)) && (strtotime($temp[$i])<=strtotime($l_to))){
				array_push($from,$temp[$i]);
				/*array_push($to,$temp[sizeof($temp)-1]);
				array_push($purpose,$row[1]);
				array_push($type,$row[2]);*/
			}
		}
		$flag=implode(",",$from);
		array_push($to,$flag);
		array_push($purpose,$row[1]);
		array_push($type,$row[2]);
	}
	
	echo json_encode(array($to,$purpose,$type,$dates));
?>