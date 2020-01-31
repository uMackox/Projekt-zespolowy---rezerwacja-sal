<?php
session_start();

    if(isset($_GET['resid'])){
        $_SESSION['resid'] = $_GET['resid'];
    }
    if(isset($_POST['saveinvoice']) && isset($_SESSION['resid'])){
        include 'dbconn.php';
        include 'GetInvoiceInformation.php';


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
                echo "Invoice Saved";
            }
            else{
                echo $dbconn->error;
                echo "Couldnt save invoice";
            }
        }


    }
    else if(isset($_SESSION['resid'])){
        include 'dbconn.php';
        include 'GetInvoiceInformation.php';
        echo "Invoice information:<br>";
        echo "Client mail : ".$tenant['Email']."<br>";
        echo "Agent  mail : ".$owner['Email']."<br>";
        echo "Room number : ".$room['IDRoom']."<br>";
        echo "Date : ".$reservation['Date']."<br>";
        echo "Time start : ".$reservation['HStart']."<br>";
        echo "Time end   : ".$reservation['HEnd']."<br>";
        echo "Price : ".$mprice."<br>";
        echo "Status : ";
        echo " Nieopłacona <br>";

        echo "<br>";
        ?>

<form action="SaveInvoice.php" method="post">
    <input type="submit" name="saveinvoice" value="Save">
</form>
<?php
}

?>