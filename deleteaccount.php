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
            echo "<p class='message navigation-bar-item'>Delete account ".$_SESSION['user_id']."</p>";
            echo "<a href='homepage.php' class='navigation-bar-item'>Homepage</a>";
            echo "<a href='logout.php' class='navigation-bar-item'>Logout</a>";
        }
        ?>
    </div>
    <div class="content">
        <?php
        if(isset($_POST['deleteconfirm'])){
            include 'dbconn.php';
            $query = "SELECT Password FROM Users WHERE Login like '".$_SESSION['user_id']."'";
            $result = $dbconn->query($query);
            if($result->num_rows>0){
                if(password_verify($_POST['password'],$result->fetch_assoc()["Password"])){
                    $query = "DELETE FROM Users WHERE Login like '".$_SESSION['user_id']."' ";
                    if($dbconn->query($query)==TRUE){
                        echo "Succesfully deleted account";
                        header("Location: ./logout.php");
                        exit;
                    }
                    else{
                        echo "
                        <form action=\"deleteaccount.php\" method=\"post\">
                        Password :<input type=\"password\" name=\"password\"><br>
                            <input type=\"submit\" name=\"deleteconfirm\" value=\"Confirm\"><br>
                        </form>
                        ";
                        echo "<p class='message-warning'>Couldnt delete account</p>";
                    }
                }
                else{
                    echo "
                        <form action=\"deleteaccount.php\" method=\"post\">
                        Password :<input type=\"password\" name=\"password\"><br>
                            <input type=\"submit\" name=\"deleteconfirm\" value=\"Confirm\"><br>
                        </form>
                        ";
                    echo "<p class='message-warning'>Incorrect password</p>";
                }
            }
        }
        else if(isset($_POST['delete'])) {
            if($_POST['delete']=="No"){
                header("Location: ./manageaccount.php");
                exit;
            }
            else{
                echo "
                <form action=\"deleteaccount.php\" method=\"post\">
                Password :<input type=\"password\" name=\"password\"><br>
                    <input type=\"submit\" name=\"deleteconfirm\" value=\"Confirm\"><br>
                </form>
                ";
            }
        }
        else{
            echo "
                <form action=\"deleteaccount.php\" method=\"post\">
                    <input type=\"submit\" name=\"delete\" value=\"Yes\">
                </form>
                ";
            echo "
                <form action=\"deleteaccount.php\" method=\"post\">
                    <input type=\"submit\" name=\"delete\" value=\"No\"><br>
                </form>
                ";
        }




        ?>

    </div>
    <div class="footer">

    </div>
</div>

</body>
</html><?php
		