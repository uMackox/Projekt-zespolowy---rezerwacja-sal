<?php
    session_start();
    include 'dbconn.php';

    if(isset($_GET['idres']) && isset($_SESSION['user_id'])){
        $sqlquery = "SELECT * FROM Reservations WHERE IDReservation = ".$_GET['idres'];
        $result = $dbconn->query($sqlquery);

        if($result->num_rows>0){
            $row = $result->fetch_assoc();
            if($row['Tenant'] == $_SESSION['user_id'] && $row['Status']<3){
                $sqlquery = "DELETE FROM Reservations WHERE IDReservation = ".$row['IDReservation'];
                if($dbconn->query($sqlquery) == TRUE){
                    echo "Pomyślnie anulowano rezerwację<br>";
                }
                else{
                    echo $dbconn->error;
                    echo "Anulowanie rezerwacjii nie powiodło się<br>";
                }
            }
        }
        else{
            echo "Niepoprawny identyfikator sali <br>";
        }
    }
?>
