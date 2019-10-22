<?php
session_start();

if(isset($_SESSION['user_id'])){
    echo "Welcome,".$_SESSION['user_id'];
    echo "
        <form action=\"logout.php\" method=\"POST\">
        <button type=\"submit\">Logout</button>

        </form>
    ";

}
else{
    echo "Not logged in";
    echo "<br><a href='loginpage.html'>Login Page</a>";
}
?>

