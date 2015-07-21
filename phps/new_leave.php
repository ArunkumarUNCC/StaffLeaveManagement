<?php
	$host="localhost"; // Host name 
	$username="root"; // Mysql username 
	$password="123456"; // Mysql password 
	$db_name="leave_management"; // Database name 
	$tb_name="leaves";
	
	$type=$_POST["type"];
	$name=$_POST["name"];
	$year=$_POST["y"];
	
	$leave_names=array();
	$leave_count=array();

	$connect_id=mysql_connect("localhost", "root", "123456")or die("cannot connect"); 
	mysql_select_db("$db_name",$connect_id) or die("NoDatabase");
	
	$get=mysql_query("SELECT `leave_name`,`leave_count` FROM $tb_name WHERE `type`='$type'");
	
	if(mysql_num_rows($get)==0){
		mysql_query("INSERT INTO $tb_name(`type`,`leave_name`,`leave_count`) VALUES('$type','$name','0')");
		echo json_encode("Updation Success");	
	}
	
	else{
		while($row=mysql_fetch_array($get)){
			$names=$row[0];
			$count=$row[1];
		}
		
		if($names==""){
			mysql_query("UPDATE $tb_name SET `leave_name`='$name',`leave_count`='0' WHERE `type`='$type'");
			echo json_encode("Updation Success");	
		}
		
		else{
			$leave_names=explode(",",$names);
			$leave_count=explode(",",$count);
			
			array_push($leave_names,$name);
			array_push($leave_count,'0');
			
			$names=implode(",",$leave_names);
			$count=implode(",",$leave_count);
			
			mysql_query("UPDATE $tb_name SET `leave_name`='$names',`leave_count`='$count' WHERE `type`='$type'");
			
			
			echo json_encode("Updation Success");
		}
	}
?>