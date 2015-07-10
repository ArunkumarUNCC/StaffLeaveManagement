
	<?php
	$host="localhost"; // Host name 
	$username="root"; // Mysql username 
	$password="123456"; // Mysql password 
	$db_name="leave_management"; // Database name 
	$tb_name="leave_users";
	
	$id=$_POST["staff_id2"];
    $mail=$_POST["staff_mail"];
    $contact=$_POST["staff_contact"];
    $pass=$_POST["staff_pass"];
	$path="images/photos/";
    
  	$connect_id=mysql_connect("localhost", "root", "123456")or die("cannot connect"); 
	mysql_select_db("$db_name",$connect_id) or die("NoDatabase");
	
	if(strlen($contact)==10){
		if(filter_var($mail, FILTER_VALIDATE_EMAIL)){
			mysql_query("UPDATE $tb_name SET mail='$mail',`contact`='$contact' WHERE `staff_id`='$id'");
			
			if(!empty($_POST["staff_pass"])){
			
				mysql_query("UPDATE $tb_name SET `password`='$pass' WHERE `staff_id`='$id'");
			}
			
			if (isset($_FILES["staff_photo"])) {
				$allowed = array('image/gif', 'image/png','image/jpeg');
						
				if(in_array($_FILES["staff_photo"]["type"], $allowed))
				{
					if(!empty($_FILES["staff_photo"])){
						if (file_exists($path)){
							move_uploaded_file($_FILES["staff_photo"]["tmp_name"], $path . $_FILES["staff_photo"]["name"]);
							mysql_query("UPDATE $tb_name SET `photo`='phps/$path".$_FILES["staff_photo"]["name"]."' WHERE `staff_id`='$id'");
							
						}
						else{
							mkdir($path, 0755, true);
							move_uploaded_file($_FILES["staff_photo"]["tmp_name"], $path . $_FILES["staff_photo"]["name"]);
							mysql_query("UPDATE $tb_name SET `photo`='phps/$path".$_FILES["staff_photo"]["name"]."' WHERE `staff_id`='$id'");
						}
							
					}
					echo "Profile Updated Successfully";
				}
				else echo "Wrong Image Type";
			}
		}
		else echo "Invalid Email Id";
	}
	
	else echo "Invalid Contact";
?>