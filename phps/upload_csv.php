
<?php
	$host="localhost"; // Host name 
	$username="root"; // Mysql username 
	$password="123456"; // Mysql password 
	$db_name="leave_management"; // Database name 
	$tb_name="leave_users";
	
	$data = array();
	$staff_type = array();
	$leave_name = array();
	$leave_count = array();
	
	$connect_id=mysql_connect("localhost", "root", "123456")or die("cannot connect"); 
	mysql_select_db("$db_name",$connect_id) or die("NoDatabase");
	
	$leave_details = mysql_query("SELECT * FROM `leaves`");
	
	while($row = mysql_fetch_array($leave_details)){
		array_push($staff_type,$row[0]);
		array_push($leave_name,$row[1]);
		array_push($leave_count,$row[2]);
	}
	
	$date_details = mysql_query("SELECT `from_date`,`to_date` FROM `staff` WHERE `staff_id`=(SELECT `staff_id` FROM `$tb_name` WHERE `staff_type`='Admin')");
	
	while($row = mysql_fetch_array($date_details)){
		$from_date = $row[0];
		$to_date = $row[1];	
	}
	
	if(isset($_FILES["csv"])){
		
		if($_FILES["csv"]["type"]=="text/csv" || $_FILES["csv"]["type"]=="application/vnd.ms-excel"){
			$file_name = $_FILES["csv"]["name"];
			
			move_uploaded_file($_FILES["csv"]["tmp_name"],$file_name);
			$file = fopen($file_name,"r");
			
			while($data = fgetcsv($file)){
				
				$staff_id = $data[0];
				$check_id = mysql_query("SELECT * FROM `$tb_name` WHERE `staff_id`='$staff_id'");
				
				if(mysql_num_rows($check_id)==0){
					$insert_query = "INSERT INTO $tb_name VALUES(";
					
					for($i=0;$i<sizeof($data)-1;$i++){
						$insert_query.=	"'$data[$i]',";
					}
					$insert_query.=	"'$data[$i]')";
					
					mysql_query($insert_query);
					
					$leave_name_details	= array();
					$leave_count_details = array();
					
					for($j=0;$j<sizeof($staff_type);$j++){
						
						if(in_array($staff_type[$j],$data)){
							$leave_name_details	= explode(",",$leave_name[$j]);
							$leave_count_details = explode(",",$leave_count[$j]);
						}
						else if(in_array("HOD",$data) || in_array("Hod",$data) || in_array("hod",$data)){
							if($staff_type[$j]=="Teaching Staff"){	
								$leave_name_details	= explode(",",$leave_name[$j]);
								$leave_count_details = explode(",",$leave_count[$j]);
								break;
							}
						}
						
					}
					
					mysql_query("INSERT INTO `staff`(`staff_id`,`from_date`,`to_date`) VALUES('$staff_id','$from_date','$to_date')");
						
					for($k=0;$k<sizeof($leave_name_details);$k++){
						mysql_query("UPDATE `staff` SET `$leave_name_details[$k]`='$leave_count_details[$k]/$leave_count_details[$k]' WHERE `staff_id`='$staff_id'");	
					}
					echo "Staff Details Uploaded Succesfully";
				}
				else echo "Staff ID $data[0] is redundant. The first entry in the file only will be uploaded.\n";
			}
					
		}
		
		else echo "Select a .csv File";
	}
	
	else echo "Please select a file...";
	
?>