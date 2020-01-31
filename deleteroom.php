<?php
session_start();

if(isset($_GET['roomid']) && isset($_SESSION['user_id'])){
    include 'dbconn.php';
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
            echo "Successfully deleted room<br>";
        }
        else{
            echo $dbconn->error;
            echo "Couldn't delete room<br>";
        }
    }
    else{
        echo "You have insufficient permissions <br>";
    }
}
else{
    echo "You are not logged in<br>";
}
?>