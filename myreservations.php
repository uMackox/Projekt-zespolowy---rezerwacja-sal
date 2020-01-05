<?php

    session_start();
    $servername = "localhost";
    $dbusername = "ProjectManager";
    $dbpassword = "projectmanager";
    $dbname = "PZDB";

    $dbconn = new mysqli($servername, $dbusername, $dbpassword, $dbname);

    if ($dbconn->connect_error) {
        die("Connection failed: " . $dbconn->connect_error);
    }

    $sqlquery = "SELECT * FROM Reservations WHERE Tenant like '" . $_SESSION['user_id'] . "'";
    $result = $dbconn->query($sqlquery);

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo "Data rezerwacji : " . $row["Date"] . "<br>";
            echo "Godzina rezerwacji: ".$row["HStart"].":00 - ".$row["HEnd"].":00 <br>";
            echo "ID sali : ".$row["IDRoom"]."<br>";
            echo "Status rezerwacji:";
            switch ($row["Status"]){
                case 1: echo " Niepotwierdzona <br>"; break;
                case 2: echo " Potwierdzona <br>"; break;
                case 3: echo " Zrealizowana <br>"; break;
                case 4: echo " Anulowana <br>"; break;
            }
            echo "<br>";
        }
    } else {

    }


    ?>