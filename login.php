<html>
<head>
</head>
<body>
Login page
<br>
<a href="index.html">Main page</a>
<br>
<form action="login.php" method="POST">
	Login: <input type="text" id="login" name="login">

	<br>

	Password: <input type="password" id="password" name="password">

	<br>
	<button type="submit">Sign-in</button>

</form>

<?php
	session_start();
	if(! empty($_POST)){
		if(isset($_POST['login']) && isset($_POST['password'])){
			$servername = "localhost";
			$dbusername = "ProjectManager";
			$dbpassword = "projectmanager";
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
					$user = $result->fetch_object();
					$_SESSION['user_id'] = $userlogin;
					header("Location: ./homepage.php");
					exit;
				}
				else{
					echo "Invalid username or password";
				}
			}
			else{
				#echo $dbconn->query($sql);
				echo "Invalid username or password";
			}
		}

	}
 ?>

</body>
</html>