<?php
session_start();

if(isset($_GET['roomid']) && isset($_SESSION['user_id'])){
    $servername = "localhost";
    $dbusername = "ProjectManager";
    $dbpassword = "projectmanager";
    $dbname = "PZDB";

    $dbconn = new mysqli($servername,$dbusername,$dbpassword,$dbname);

    if($dbconn->connect_error){
        die("Connection failed: ".$dbconn->connect_error);
    }
    // check onweship
    $sqlquery = "Select * FROM Room Where IDRoom like '".$_GET['roomid']."'";
    $result = $dbconn->query($sqlquery);
    $result = $result->fetch_assoc();
    if($result['Owner'] == $_SESSION['user_id']){

        $sqlquery = "DELETE FROM Room WHERE IDRoom like'".$_GET['roomid']."'";
        if($dbconn->query($sqlquery) == TRUE){
            echo "Pomyślnie usunieto sale<br>";
        }
        else{
            echo $dbconn->error;
            echo "Usiniecie salii nie powiodło się<br>";
        }
    }
    else{
        echo "Nie posiadasz odpowiednich uprawnień <br>";
    }
}
else{
    echo "Nie jesteś zalogowany<br>";
}
?>