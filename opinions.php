<?php
    session_start();
    if(isset($_GET['roomid']) && isset($_SESSION['user_id'])){
        $roomid = $_GET['roomid'];

        include 'dbconn.php';
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
                echo "Grade: ".$row["Rating"]."<br>";
                echo "Comment: ".$row["Comment"]."<br>";
                echo "<br>";
            }
            $average /= $result->num_rows;
            echo "Room rating: ".$average;
        }
        else {
            echo "There are no opinions about this room yet. You can be the first one!<br>";
            if($user['Role'] == 'Tenant'){
                echo "<a href='addopinion.php?roomid=".$roomid."'>Add opinion</a><br>";
            }
        }
    }


    ?>