<html>
<head>
    <title>Password change</title>
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
            echo "<p class='message navigation-bar-item'>Password change ".$_SESSION['user_id']."</p>";
            echo "<a href='homepage.php' class='navigation-bar-item'>Homepage</a>";
            echo "<a href='logout.php' class='navigation-bar-item'>Logout</a>";
        }
        ?>
    </div>
    <div class="content">
        <?php
        echo "
                <form action=\"changepassword.php\" method=\"post\">
                     Old password   :   <input type=\"password\" id=\"oldpass\" name=\"oldpass\" required><br>
                     New password   :   <input type=\"password\" id=\"newpass\" name=\"newpass\" required><br>
                     Repeat new password          : <input type=\"password\" id=\"newpass\" name=\"newpassr\" required><br>
                    
                    <input type=\"submit\" name=\"changepass\" value=\"Change password\"><br>
                </form>
                ";
        if(isset($_POST['changepass'])) {
            if($_POST['newpass']!=$_POST['newpassr']){
                echo "<p class='message-warning'>Passwords have to match</p>";
            }
            else{
            include 'dbconn.php';
            $query = "SELECT Password FROM Users WHERE Login like '" . $_SESSION['user_id'] . "' ";
            $result = $dbconn->query($query);

            if($result->num_rows>0){
                if(password_verify($_POST['oldpass'],$result->fetch_assoc()["Password"])){
                    $npass = password_hash($_POST['newpass'],PASSWORD_DEFAULT);
                    $query = "UPDATE Users SET Password='".$npass."' WHERE Login like '".$_SESSION['user_id']."' ";
                    if($dbconn->query($query)==TRUE){
                        echo "Succesfully changed password";
                    }
                    else{
                        echo "<p class='message-warning'>Couldn't change password</p>";
                    }
                }
                else{
                    echo "<p class='message-warning'>Incorrect password</p>";
                }
            }
           }
        }



        ?>

    </div>
    <div class="footer">

    </div>
</div>

</body>
</html><?php
