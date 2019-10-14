<?php
	$servername = "localhost";
	$dbusername = "root";
	$dbpassword = "root";
	$dbname = "PZDB";

	$dbconn = new mysqli($servername,$dbusername,$dbpassword,$dbname);

	if($dbconn->connect_error){
		die("Connetcion failed : ".$dbconn->connect_error);
	}
	$userlogin = $_POST['login'];
	$userpassword = $_POST['password'];

	$sql = "SELECT * FROM Users WHERE Login like '".$userlogin."' ";
	$result = $dbconn->query($sql);
	if($result->num_rows>0){
		if(password_verify($userpassword,$result->fetch_assoc()["Password"])){
			echo "Succesfully logged in";
		}
		else{
			echo "Invalid username or password";
		}
	}
	else{
		#echo $dbconn->query($sql);
		echo "Invalid username or password";
	}


 ?>
