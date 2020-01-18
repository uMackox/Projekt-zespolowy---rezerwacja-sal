<?php
    session_start();
    if(isset($_GET['roomid']) && isset($_SESSION['user_id'])){
        $roomid = $_GET['roomid'];

        $servername = "localhost";
        $dbusername = "ProjectManager";
        $dbpassword = "projectmanager";
        $dbname = "PZDB";

        $dbconn = new mysqli($servername,$dbusername,$dbpassword,$dbname);

        if($dbconn->connect_error){
            die("Connection failed: ".$dbconn->connect_error);
        }
        // Get user data
        $sqlquery = "SELECT * FROM Users WHERE Login like '".$_SESSION['user_id']."'";
        $user = $dbconn->query($sqlquery);
        if($user->num_rows >0){
            $user = $user->fetch_assoc();
        }
        else{
            echo $dbconn->error;
            echo "Couldnt get owner data";
            exit();
        }
        $sqlquery = "SELECT * FROM Opinions WHERE IDRoom like '".$roomid."'";
        $result = $dbconn->query($sqlquery);

        if($result->num_rows>0){
            $average = 0;
            if($user['Role'] == 'Tenant'){
                echo "<a href='addopinion.php?roomid=".$roomid."'>Add opinion</a><br>";
            }
            while ($row = $result->fetch_assoc()){
                $average += $row["Rating"];
                echo "Ocena: ".$row["Rating"]."<br>";
                echo "Komentarz: ".$row["Comment"]."<br>";
                echo "<br>";
            }
            $average /= $result->num_rows;
            echo "Średnia ocena sali: ".$average;
        }
        else {
            echo "There are no opinions about this room yet. You can be the first one!<br>";
            if($user['Role'] == 'Tenant'){
                echo "<a href='addopinion.php?roomid=".$roomid."'>Add opinion</a><br>";
            }
        }
    }


    ?>