	<?php
	$host="localhost"; // Host name 
	$username="root"; // Mysql username 
	$password="123456"; // Mysql password 
	$db_name="leave_management"; // Database name 
	$tb_name="leave_users";
	
	$id=$_POST["id"];
	$flag=$_POST["flag"];
    $mail=$_POST["mail"];
    $contact=$_POST["contact"];
    $pass=$_POST["password"];
    
  	$connect_id=mysql_connect("localhost", "root", "123456")or die("cannot connect"); 
	mysql_select_db("$db_name",$connect_id) or die("NoDatabase");
    
    if($flag=="1"){
    	$get=mysql_query("SELECT * FROM $tb_name WHERE `staff_id`='$id'");
        
        while($row=mysql_fetch_array($get)){
        	$name=$row[1];
            $id=$row[0];
            $type=$row[2];
            $dept=$row[3];
            $desig=$row[4];
            $doj=$row[5];
            $mail=$row[6];
            $contact=$row[7];
            $user_name=$row[8];
			$photo_link=$row[10];
        }
        
        echo json_encode(array($id,$name,$type,$dept,$desig,$doj,$mail,$contact,$user_name,$photo_link));
    }
    
    else if($flag=="2"){
    	mysql_query("UPDATE $tb_name SET `mail`='$mail',`contact`='$contact' WHERE `staff_id`='$id'");
        echo json_encode("hi");
    }
    
    else if($flag=="3"){
    	mysql_query("UPDATE $tb_name SET `mail`='$mail',`contact`='$contact',`password`='$pass' WHERE `staff_id`='$id'");
        echo json_encode("hi");
    } 
?>