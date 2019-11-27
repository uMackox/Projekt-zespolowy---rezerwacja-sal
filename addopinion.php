<?php
    session_start();
    if(isset($_GET['roomid'])){
        $_SESSION['roomid'] = $_GET['roomid'];
    }else{
        if(isset($_POST['addopinion']) && isset($_SESSION['roomid'])){
            $servername = "localhost";
            $dbusername = "ProjectManager";
            $dbpassword = "projectmanager";
            $dbname = "PZDB";

            $dbconn = new mysqli($servername,$dbusername,$dbpassword,$dbname);

            if($dbconn->connect_error){
                die("Connection failed: ".$dbconn->connect_error);
            }

            $sqlquery = "INSERT INTO Opinie(IDSali,Ocena,komentarz) VALUES
            (".$_SESSION['roomid'].",'".$_POST['rating']."','".$_POST['comment']."')";
            if($dbconn->query($sqlquery) == TRUE){
                echo "Successfully added opinion<br>";
            }
            else{
                echo $dbconn->error;
                echo "Unable to add opinion<br>";
            }

            unset($_SESSION['roomid']);
        }
        else{
            unset($_SESSION['roomid']);
        }
    }


?>
<form action="addopinion.php" method="post">
    Ocena : <input type="text" id="rating" name="rating"><br>
    Komentarz : <input type="text" id="comment" name="comment"><br>
    <input type="submit" name="addopinion" value="Ocen">
</form>
