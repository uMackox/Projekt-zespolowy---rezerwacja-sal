<html>
<head>
    <title>Account management</title>
    <link rel="Stylesheet" type="text/css" href="Style/mainstyle.css">
</head>
<body>
<div class="body">
    <div class="head">
        <?php
        session_start();

        if(!isset($_SESSION['user_id'])) { // Redirect to homepage
            header("Location: ./homepage.php");
            exit;
        }
        else{
            echo "<p class='message navigation-bar-item'>Manage information of ".$_SESSION['user_id']."</p>";
            echo "<a href='homepage.php' class='navigation-bar-item'>Homepage</a>";
            echo "<a href='manageaccount.php' class='navigation-bar-item'>Account Management</a>";
            echo "<a href='logout.php' class='navigation-bar-item'>Logout</a>";
        }
        ?>
    </div>
    <div class="content">
        <?php
        if(isset($_POST['changeinfo'])){
            // Display account information
            $servername = "localhost";
            $dbusername = "ProjectManager";
            $dbpassword = "projectmanager";
            $dbname = "PZDB";

            $dbconn = new mysqli($servername,$dbusername,$dbpassword,$dbname);
            $query = "UPDATE Users SET Name='".$_POST['name']."', Surname='".$_POST['surname']."', Role='".$_POST['role']."', Phonenumber='".$_POST['phonenumber']."', Email='".$_POST['email']."' WHERE Login like '".$_SESSION['user_id']."' ";
            if($dbconn->query($query)==TRUE){
                echo "Succesfully changed information";
            }
            else{
                echo "<p class='message-warning'>Couldn't change information</p>";
            }
        }
        else{
            header("Location: ./manageaccount.php");
            exit;
        }



        ?>

    </div>
    <div class="footer">

    </div>
</div>

</body>
</html>