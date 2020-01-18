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
            echo "<p class='message navigation-bar-item'>Account information of user ".$_SESSION['user_id']."</p>";
            echo "<a href='homepage.php' class='navigation-bar-item'>Homepage</a>";
            echo "<a href='logout.php' class='navigation-bar-item'>Logout</a>";
        }
        ?>
    </div>
    <div class="content">
        <?php
            // Display account information
            $servername = "localhost";
            $dbusername = "ProjectManager";
            $dbpassword = "projectmanager";
            $dbname = "PZDB";

            $dbconn = new mysqli($servername,$dbusername,$dbpassword,$dbname);
            $query = "SELECT * FROM Users WHERE Login like '".$_SESSION['user_id']."' ";
            $result = $dbconn->query($query);
            if($result->num_rows >0){
                $userinfo = $result->fetch_assoc();


                echo "
                <form action=\"changeinformation.php\" method=\"post\">
                     Name           : <input type=\"text\" id=\"name\" name=\"name\" value = \"".$userinfo['Name']."\" required><br>
                     Surname        : <input type=\"text\" id=\"surname\" name=\"surname\" value = \"".$userinfo['Surname']."\" required><br>
                     Role           : 
                 
                
                    <label for=\"Tenant\">Tenant</label>
                    ";
                    if($userinfo['Role'] == "Tenant") {
                        echo "
                            <input type=\"radio\" name=\"role\" id=\"Tenant\" value=\"Tenant\" checked>
                            <label for=\"Agent\">Agent</label>
                            <input type=\"radio\" name=\"role\" id=\"Agent\" value=\"Agent\" disabled>
                            <br>
                        ";
                    }
                    else{
                        echo "
                            <input type=\"radio\" name=\"role\" id=\"Tenant\" value=\"Tenant\" disabled>
                            <label for=\"Agent\">Agent</label>
                            <input type=\"radio\" name=\"role\" id=\"Agent\" value=\"Agent\" checked>
                            <br>
                        ";
                    }
                echo "
                     Phone number   : <input type=\"text\" id=\"phonenumber\" name=\"phonenumber\" value = \"".$userinfo['Phonenumber']."\"><br>
                     Email          : <input type=\"email\" id=\"email\" name=\"email\" value = \"".$userinfo['Email']."\" required><br>
                    
                    <input type=\"submit\" name=\"changeinfo\" value=\"Save changes\"><br>
                </form>
                ";

                echo "<a href='changepassword.php'>Change password</a><br>";
                echo "<a href='deleteaccount.php'>Delete account</a><br>";
            }


        ?>

    </div>
    <div class="footer">

    </div>
</div>

</body>
</html>