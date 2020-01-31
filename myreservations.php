<?php

    session_start();
include 'dbconn.php';
    $sqlquery = "SELECT * FROM Reservations WHERE Tenant like '" . $_SESSION['user_id'] . "'";
    $result = $dbconn->query($sqlquery);

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo "Reservation date : " . $row["Date"] . "<br>";
            echo "Hours: ".$row["HStart"].":00 - ".$row["HEnd"].":00 <br>";
            echo "Room id : ".$row["IDRoom"]."<br>";
            echo "Reservation status:";
            switch ($row["Status"]){
                case 1: echo " Not confirmed <br>"; break;
                case 2: echo " Confirmed <br>"; break;
                case 3: echo " Realised <br>"; break;
                case 4: echo " Canceled <br>"; break;
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