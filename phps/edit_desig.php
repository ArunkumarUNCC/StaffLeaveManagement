<?php
$name=$_POST["name"];
$type=$_POST["staff_type"];
$id=$_POST["id"];
	
$db_name="leave_management";
$connect_id=mysql_connect("localhost", "root", "123456")or die("cannot connect"); 
mysql_select_db("$db_name",$connect_id) or die("NoDatabase");

if($id=="1"){
	$check = mysql_query("SELECT * FROM `designations` WHERE `staff_type`='$type'");
	
	if(mysql_num_rows($check)==0){
		mysql_query("INSERT INTO `designations` VALUES('$name','$type')");
		echo json_encode("New Designation Added Successfully");
	}
	
	else{
		$temp_desig=array();
		$designations="";
		$flag = 0;
				
		while($row = mysql_fetch_array($check)){
			$designations = $row[0];	
		}
		
		if(!strpos($designations,",")){
			if($designations==$name)
				$flag=1;
			else $designations = $designations.",".$name;
		}
			
		else{
			
			$temp_desig = explode(",",$designations);
			
			if(in_array($name,$temp_desig))
				$flag = 1;
			
			array_push($temp_desig,$name);
			$designations = implode(",",$temp_desig);
		}
		
		if($flag!=1){
			mysql_query("UPDATE `designations` SET `name`='$designations' WHERE `staff_type`='$type'");
		
			echo json_encode("New Designation Added Successfully");
		}
		else echo json_encode("Designation already exists...");
	}
}

else if($id=="2"){
	$temp_desig=array();
	$designations="";
	$flag = 0;
	
	$get_desigs = mysql_query("SELECT `name` FROM `designations` WHERE `staff_type`='$type'");
	
	while($row = mysql_fetch_array($get_desigs)){
		$designations = $row[0];	
	}
	
	if(!strpos($designations,",")){
		mysql_query("UPDATE `designations` SET `name`='' WHERE `staff_type`='$type'");
	}
			
	else{
		$temp_desig = explode(",",$designations);
		$key = array_search($name,$temp_desig);
		unset($temp_desig[$key]);
		$designations = implode(",",$temp_desig);
		
		mysql_query("UPDATE `designations` SET `name`='$designations' WHERE `staff_type`='$type'");
	}
	
	echo json_encode("Designation $name Deleted Successfully...");

}
?>