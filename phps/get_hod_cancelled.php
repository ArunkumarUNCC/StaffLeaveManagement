<?php
	$host="localhost"; // Host name 
	$username="root"; // Mysql username 
	$password="123456"; // Mysql password 
	$db_name="leave_management"; // Database name 
	$tb_name="cancel_leaves";
	
	$id=$_POST["id"];
	
	$staff_id=array();
	$names=array();
	$depts=array();
	$from=array();
	$to=array();
	$purpose=array();
	$type=array();
	
	$connect_id=mysql_connect("localhost", "root", "123456")or die("cannot connect"); 
	mysql_select_db("$db_name",$connect_id) or die("NoDatabase");
	
	$get=mysql_query("SELECT a.*,b.`staff_name`,b.`department` FROM $tb_name a,`leave_users` b WHERE a.`staff_id`=b.`staff_id`");
?>