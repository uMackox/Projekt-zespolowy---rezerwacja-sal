<?php
    session_start();

    include 'dbconn.php';
    $loggedin = 0;
    if(isset($_SESSION['user_id'])){// Get User information
        $sqlquery = "SELECT * FROM Users WHERE Login like '".$_SESSION['user_id']."'";
        $userinfo = $dbconn->query($sqlquery);
        if($userinfo->num_rows>0){
            $userinfo = $userinfo->fetch_assoc();
            if($userinfo['Role'] == 'Tenant'){
                $loggedin = 1;
            }
            else{
                $loggedin = 2;
            }
        }
    }


    $sqlquery = "SELECT * FROM Room";
    $result = $dbconn->query($sqlquery);

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {

            echo "Room name: " . $row["Name"] . "<br>";
            echo "City: " . $row["City"] . "<br>";
            echo "Address: " . $row["Address"] . "<br>";
            echo "Description: " . $row["Description"] . "<br>";
            if($loggedin == 1){
                echo "<a href='makereservation.php?roomid=".$row["IDRoom"]."'>Make reservation</a><br>";
                echo "<a href='opinions.php?roomid=".$row["IDRoom"]."'>Opinions</a><br>";
            }
            else if($loggedin == 2){
                echo "<a href='opinions.php?roomid=".$row["IDRoom"]."'>Opinions</a><br>";
            }
            echo "<br>";
        }
    } else {
        echo "Brak Sal do wyświetlenia";
    }



?>