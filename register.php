<html>
<head>
	<title>Registration Page</title>
	<link rel="Stylesheet" type="text/css" href="Style/mainstyle.css">
</head>
<body>
<div class="body">
	<div class="head">
		<p class="message navigation-bar-item">Registration Page</p>
		<a href="index.html" class="navigation-bar-item">Main page</a>
	</div>
	<div class="content">
		<form action="register.php" method="POST">
			<ul class="form-list">
				<li>
					Login:
					<input type="text" id="login" name="login">
				</li>
				<li>
					Password:
					<input type="password" id="password" name="password">
				</li>
				<li>
					Role:
					<label for="Tenant">Tenant</label>
					<input type="radio" name="role" id="Tenant" value="Tenant">
					<label for="Agent">Agent</label>
					<input type="radio" name="role" id="Agent" value="Agent">
				</li>
				<li>
					<button type="submit">Register</button>
				</li>
			</ul>
			<?php
			$servername = "localhost";
			$dbusername = "ProjectManager";
			$dbpassword = "projectmanager";
			$dbname = "PZDB";

			$dbconn = new mysqli($servername,$dbusername,$dbpassword,$dbname);
			$userlogin = $_POST['login'];
			$userpassword = password_hash($_POST['password'],PASSWORD_DEFAULT);


			if(strlen($userlogin)<3 || strlen($userpassword)<3 || !(isset($_POST['role']))){
				echo "<p class='message-warning'>Couldnt register user (invalid arguments)</p>";
			}
			else{
				$userrole = $_POST['role'];
				if($dbconn->connect_error){
					die("Connetcion failed : ".$dbconn->connect_error);
				}
				$checkusername = "SELECT * FROM Users where Login like '".$userlogin."'";
				$checkusernameres = $dbconn->query($checkusername);
				if($checkusernameres->num_rows>0){
					echo "<p class='message-warning'>User name already taken</p>";
				}
				else{
					$sql = "INSERT INTO Users (Login,Password,Role) VALUES('".$userlogin."','".$userpassword."','".$userrole."')";
					if($dbconn->query($sql)==TRUE){
						echo "Succesfully registered user";
					}
					else{
						echo "<p class='message-warning'>Oops something went wrong...</p>";
					}
				}
			}

			?>
		</form>
	</div>
	<div class="footer">

	</div>
</div>
</body>
</html>