<?php
	$servername = "localhost";
	$dbusername = "ProjectManager";
	$dbpassword = "projectmanager";
	$dbname = "PZDB";

	$dbconn = new mysqli($servername,$dbusername,$dbpassword,$dbname);
	$userlogin = $_POST['login'];
	$userpassword = password_hash($_POST['password'],PASSWORD_DEFAULT);
	$userrole = $_POST['role'];

	if($dbconn->connect_error){
		die("Connetcion failed : ".$dbconn->connect_error);
	}
	$checkusername = "SELECT * FROM Users where Login like '".$userlogin."'";
	$checkusernameres = $dbconn->query($checkusername);
	if($checkusernameres->num_rows>0){
		echo "User name already taken";
	}
	else{
		$sql = "INSERT INTO Users (Login,Password,Role) VALUES('".$userlogin."','".$userpassword."','".$userrole."')";
		if($dbconn->query($sql)==TRUE){
			echo "Succesfully registered user";
		}
		else{
			echo "Error registering user";
		}
	}
 ?>
