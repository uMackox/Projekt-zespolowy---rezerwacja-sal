<?php

    $servername = "localhost";
    $dbusername = "ProjectManager";
    $dbpassword = "projectmanager";
    $dbname = "PZDB";

    $dbconn = new mysqli($servername, $dbusername, $dbpassword, $dbname);

    if ($dbconn->connect_error) {
        die("Connection failed: " . $dbconn->connect_error);
    }

    $sqlquery = "SELECT * FROM Room";
    $result = $dbconn->query($sqlquery);

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {

            echo "Nazwa sali: " . $row["Name"] . "<br>";
            echo "Miasto: " . $row["City"] . "<br>";
            echo "Adres: " . $row["Address"] . "<br>";
            echo "Opis: " . $row["Description"] . "<br>";
            echo "<br>";
        }
    } else {
        echo "Brak Sal do wyświetlenia";
    }



?>