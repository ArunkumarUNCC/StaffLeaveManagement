<?php
	$host="localhost"; // Host name 
	$username="root"; // Mysql username 
	$password="123456"; // Mysql password 
	$db_name="leave_management"; // Database name 
	$tb_name="leave_users";
	
	$name=$_POST["name"];
	$id=$_POST["id"];
	$type=$_POST["type"];
	$dept=$_POST["dept"];
	$doj=$_POST["doj"];
	$mail=$_POST["mail"];
	$contact=$_POST["contact"];
	$designation=$_POST["designation"];
	$to=$_POST["to"];
	$leave_names=$_POST["ln"];
	$leaves=$_POST["lv"];
	
	$leave_name=array();
	$leave_count=array();
	
	$connect_id=mysql_connect("localhost", "root", "123456")or die("cannot connect"); 
	mysql_select_db("$db_name",$connect_id) or die("NoDatabase");
	
	$check=mysql_query("SELECT * FROM $tb_name WHERE `staff_id`='$id'");
	
	if(mysql_num_rows($check)==0){
		mysql_query("INSERT INTO $tb_name(`staff_id`, `staff_name`, `staff_type`, `department`, `designation`, `doj`, `mail`, `contact`, `user_name`, `password`) VALUES('$id','$name','$type','$dept','$designation','$doj','$mail','$contact','$id','$id')");
		
		if($type!="Principal"){
			if($type=="HOD")
				$type="Teaching Staff";
				
			$tb_name="staff";
			/*$leave_name=explode(",",$leave_names);
			$leave_count=explode(",",$leaves);*/
			
			mysql_query("INSERT INTO $tb_name(`staff_id`,`from_date`,`to_date`) VALUES('$id','$doj','$to')");
			
			for($i=0;$i<sizeof($leave_names);$i++){
				mysql_query("UPDATE $tb_name SET `$leave_names[$i]`='$leaves[$i]/$leaves[$i]' WHERE `staff_id`='$id'");
			}
		}
		
		
		echo json_encode("New Staff Added...");
	}
	else echo json_encode("Staff Already Exists...");
	//echo json_encode("hi");
?>