<html>
<head>
    <title>Home page</title>
    <link rel="Stylesheet" type="text/css" href="Style/mainstyle.css">
</head>
<body>
<div class="body">
    <div class="head">
        <?php
        session_start();

        if(isset($_SESSION['user_id'])){
            include 'dbconn.php';
            $sqlquery = "SELECT * FROM Users WHERE Login like'".$_SESSION['user_id']."'";
            $userinfo = $dbconn->query($sqlquery);

            echo "<p class='message navigation-bar-item'>Welcome,".$_SESSION['user_id']."</p>";

            if($userinfo->num_rows>0){
                $userinfo = $userinfo->fetch_assoc();
                echo "<a href='manageaccount.php' class='navigation-bar-item'>My Account</a><br>";
                if($userinfo['Role']=='Tenant'){
                    echo "<a href='myreservations.php' class='navigation-bar-item'>My Reservations</a><br>";
                    echo "<a href='roombrowser.php' class='navigation-bar-item'>Room Browser</a><br>";
                }
                else{
                    echo "<a href='myrooms.php' class='navigation-bar-item'>My rooms</a><br>";
                    echo "<a href='addroom.php' class='navigation-bar-item'>Add room</a><br>";
                }
            }
            echo "<a href='logout.php' class='navigation-bar-item'>Logout</a>";

        }
        else{
            echo "<p class='message navigation-bar-item'>Not logged in</p>";
            echo "<a href='login.php' class='navigation-bar-item'>Login Page</a>";
        }
        ?>
    </div>
    <div class="content">

    </div>
    <div class="footer">

    </div>
</div>

</body>
</html>