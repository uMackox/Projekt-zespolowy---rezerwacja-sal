<?php
    session_start();
?>
<form action="addopinion.php" method="post">
    Ocena : <input type="number" id="rating" name="rating" required><br>
    Komentarz : <input type="text" id="comment" name="comment" maxlength="200"><br>
    <input type="submit" name="addopinion" value="Ocen">
</form>

<?php

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

        $sqlquery = "INSERT INTO Opinions(IDRoom,Rating,Comment) VALUES
            (".$_SESSION['roomid'].",'".$_POST['rating']."','".$_POST['comment']."')";
        if($dbconn->query($sqlquery) == TRUE){
            echo "Pomyślnie dodano opinię<br>";
        }
        else{
            echo $dbconn->error;
            echo "Dodanie opinii nie powiodło się<br>";
        }

        unset($_SESSION['roomid']);
    }
    else{
        unset($_SESSION['roomid']);
    }
}


?>
