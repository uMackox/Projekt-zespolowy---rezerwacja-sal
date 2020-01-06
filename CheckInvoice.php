<?php
    session_start();
    include 'dbconn.php';
    if(isset($_GET['invid']) && isset($_SESSION['user_id'])){
        $sqlquery = "SELECT * FROM Invoices WHERE IDInvoice = ".$_GET['invid'];
        $invoice = $dbconn->query($sqlquery);
        if($invoice->num_rows>0){
            $invoice = $invoice->fetch_assoc();
            // Check if invoice belongs to requestee
            $sqlquery = "SELECT * FROM Reservations WHERE IDReservation =".$invoice['IDReservation'];
            $reservation = $dbconn->query($sqlquery);
            if($reservation->num_rows>0){
                $reservation = $reservation->fetch_assoc();
                if($reservation['Tenant'] == $_SESSION['user_id']){
                    echo "Client mail : ".$invoice['ClientMail']."<br>";
                    echo "Agent  mail : ".$invoice['AgentMail']."<br>";
                    echo "Room number : ".$invoice['Room']."<br>";
                    echo "Date : ".$invoice['date']."<br>";
                    echo "Time start : ".$invoice['time_start']."<br>";
                    echo "Time end   : ".$invoice['time_end']."<br>";
                    echo "Price : ".$invoice['Price']."<br>";
                    echo "Status : ";
                    switch ($invoice["Status"]){
                        case 1: echo " Nieopłacona <br>"; break;
                        case 2: echo " Opłacona <br>"; break;
                    }
                    echo "<br>";

                }
                else{
                    echo "Cannot display invoice";
                }
            }
            else{
                echo "Cannot display invoice";
            }
        }
        else{
            echo "Cannot display invoice";
        }
    }
?>