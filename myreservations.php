<?php

    session_start();
include 'dbconn.php';
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
            echo "<a href='CheckInvoice.php?resid=".$row['IDReservation']."'>Check invoice</a><br>";
            echo "<a href='SaveInvoice.php?resid=".$row['IDReservation']."'>Save Invoice</a><br>";
            if($row['Status']<3){
                echo "<a href='cancelreservation.php?resid=".$row['IDReservation']."'>Cancel reservation</a><br>";
            }
            echo "<br>";
        }
    } else {

    }


    ?>