<?php
session_start();
?>
    <form action="SaveInvoice.php" method="post">
        <input type="submit" name="saveinvoice" value="Zapisz">
    </form>

<?php
    if(isset($_GET['resid'])){
        $_SESSION['resid'] = $_GET['resid'];
    }
    if(isset($_POST['saveinvoice']) && isset($_SESSION['resid'])){
        include 'dbconn.php';


        // Get Reservation data
        $sqlquery = "SELECT * FROM Reservations WHERE IDReservation = ".$_SESSION['resid'];
        $reservation = $dbconn->query($sqlquery);
        if($reservation->num_rows >0){
            $reservation = $reservation->fetch_assoc();
        }
        else{
            echo $dbconn->error;
            echo "Couldnt get reservation data";
            exit();
        }
        // Get roomdata data
        $sqlquery = "SELECT * FROM Room WHERE IDRoom = ".$reservation['IDRoom'];
        $room = $dbconn->query($sqlquery);
        if($room->num_rows >0){
            $room = $room->fetch_assoc();
        }
        else{
            echo $dbconn->error;
            echo "Couldnt get room data";
            exit();
        }
        // Get owner data
        $sqlquery = "SELECT * FROM Users WHERE Login like '".$room['Owner']."'";
        $owner = $dbconn->query($sqlquery);
        if($owner->num_rows >0){
            $owner = $owner->fetch_assoc();
        }
        else{
            echo $dbconn->error;
            echo "Couldnt get owner data";
            exit();
        }
        // Get tenant data
        $sqlquery = "SELECT * FROM Users WHERE Login like '".$reservation['Tenant']."'";
        $tenant = $dbconn->query($sqlquery);
        if($tenant->num_rows >0){
            $tenant = $tenant->fetch_assoc();
        }
        else{
            echo $dbconn->error;
            echo "Couldnt get tenant data";
            exit();
        }
        // Calculate room price
        $mprice = $reservation['HEnd'] - $reservation['HStart'];
        $mprice = $mprice * $room['PricePerHour'];

        // check if there is already invoice for given reservation
        $sqlquery = "SELECT * FROM Invoices WHERE IDReservation =".$_SESSION['resid'];
        $check = $dbconn->query($sqlquery);
        if($check->num_rows >0){ // Update invoice
            $check = $check->fetch_assoc();
            $sqlquery = "UPDATE Invoices 
            SET ClientMail='".$tenant['Email']."',AgentMail='".$owner['Email']."',Room=".$room['IDRoom'].",date='".$reservation['Date']."',time_start=".$reservation['HStart'].",time_end=".$reservation['HEnd'].",Price=".$mprice." 
            WHERE IDInvoice = ".$check['IDInvoice'];
            if($dbconn->query($sqlquery) == TRUE){
                echo "Zapisano fakturę";
            }
            else{
                echo $dbconn->error;
                echo "Couldnt save invoice";
            }

        }
        else{ // Save invoice
            $sqlquery = "INSERT INTO Invoices(IDReservation,ClientMail,AgentMail,Room,date,time_start,time_end,Price,Status) VALUES
                ('".$_SESSION['resid']."','".$tenant['Email']."','".$owner['Email']."',".$room['IDRoom'].",'".$reservation['Date']."',".$reservation['HStart'].",".$reservation['HEnd'].",".$mprice.","."1".")";
            if($dbconn->query($sqlquery) == TRUE){
                echo "Zapisano fakturę";
            }
            else{
                echo $dbconn->error;
                echo "Couldnt save invoice";
            }
        }


    }
    else{
        echo "nie ma mnie tam";
    }

?>