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
            echo "<p class='message navigation-bar-item'>Welcome,".$_SESSION['user_id']."</p>";
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