<?php
    session_start();
    include 'dbconn.php';
    if(isset($_GET['resid']) && isset($_SESSION['user_id'])){
        $sqlquery = "SELECT * FROM Invoices WHERE IDReservation = ".$_GET['resid'];
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
                else{ // Unauthorized user
                    echo "Cannot display invoice ";
                }
            }
            else{ // No such reservation
                echo "Cannot display invoice ";
            }
        }
        else{ // Reservation doesnt have invoice saved
            $sqlquery = "SELECT * FROM Reservations WHERE IDReservation =".$_GET['resid'];
            $reservation = $dbconn->query($sqlquery);
            if($reservation->num_rows>0){
                $reservation = $reservation->fetch_assoc();
                if($reservation['Tenant'] == $_SESSION['user_id']){
                    echo "You didnt save invoice yet.<br>";
                    echo "<a href='SaveInvoice.php?resid=".$_GET['resid']."'>Save Invoice</a><br>";
                }
            }
            else{
                echo "Cannot display invoice ";
            }
        }
    }
?>