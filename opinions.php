<?php
    if(isset($_GET['roomid'])){
        $roomid = $_GET['roomid'];

        $servername = "localhost";
        $dbusername = "ProjectManager";
        $dbpassword = "projectmanager";
        $dbname = "PZDB";

        $dbconn = new mysqli($servername,$dbusername,$dbpassword,$dbname);

        if($dbconn->connect_error){
            die("Connection failed: ".$dbconn->connect_error);
        }

        $sqlquery = "SELECT * FROM Opinions WHERE IDRoom like '".$roomid."'";
        $result = $dbconn->query($sqlquery);

        if($result->num_rows>0){
            $average = 0;
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
            echo "Brak opinii o sali";
        }
    }

    ?>