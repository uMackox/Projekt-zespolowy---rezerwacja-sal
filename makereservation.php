<?php
    session_start();
    if(isset($_GET['roomid'])){
        $_SESSION['roomid'] = $_GET['roomid'];
    }

    $servername = "localhost";
    $dbusername = "ProjectManager";
    $dbpassword = "projectmanager";
    $dbname = "PZDB";

    $dbconn = new mysqli($servername,$dbusername,$dbpassword,$dbname);

    if($dbconn->connect_error){
        die("Connection failed: ".$dbconn->connect_error);
    }
    if(!isset($_SESSION['availability'])) {
        ?>
        <form action="makereservation.php" method="post">
            Data rezerwacji : <input type="date" id="resdate" name="resdate" required><br>
            Godzina początku : <input type="number" id="hstart" name="hstart" maxlength="2" max="23"><br>
            Godzina końca : <input type="number" id="hend" name="hend" maxlength="2" max="24"><br>
            <input type="submit" name="checkavailability" value="Sprawdź dostępność">
        </form>

        <?php
    }
    else{
        ?>
        <form action="makereservation.php" method="post">
            Wybrany termin jest dostępny. Czy chcesz zarezerwować?<br>
            <label for="confirm">Tak</label>
            <input type="radio" name="confirmation" id="confirm" value="yes">
            <label for="decline">Nie</label>
            <input type="radio" name="confirmation" id="decline" value="no">
            <input type="submit" name="reservationconfirm" value="Potwierdź">
        </form>

        <?php
    }


    if(isset($_POST['checkavailability']) && isset($_SESSION['roomid'])){
        $sqlquery = "SELECT * FROM Reservations WHERE Date = '".$_POST['resdate']."'";
        $result = $dbconn->query($sqlquery);
        $flag=0;
        $start = $_POST['hstart'];
        $end =  $_POST['hend'];
        if($result->num_rows>0){

            while ($row = $result->fetch_assoc()){
                if($start > $row['HStart'] && $start < $row['HEnd'] ){
                    $flag = 1;
                }
                else if($end > $row['HStart'] && $end < $row['HEnd']){
                    $flag = 1;
                }
                else if($start<$row['HStart'] && $end >$row['HEnd']){
                    $flag = 1;
                }
                else if($start == $row['HStart'] && $end>$start){
                    $flag = 1;
                }
                else if($end<$start){
                    $flag = 1;
                }
            }
            if(!$flag){
                $sqlquery = "INSERT INTO Reservations(Date,HStart,HEnd,IDRoom,Tenant,Status) VALUES
                ('".$_POST['resdate']."',".$start.",".$end.",'".$_SESSION['roomid']."','".$_SESSION['user_id']."',"."1".")";
                if($dbconn->query($sqlquery) == TRUE){
                    $_SESSION['availability'] = 1;
                    header("Location: ./makereservation.php");
                    exit;
                }
                else{
                    echo $dbconn->error;
                }
            }
            else{
                echo "Selected hours are unavailable<br>";
                // Display available hours
                $sqlquery = "SELECT * FROM Reservations WHERE Date = '".$_POST['resdate']."' ORDER BY HStart ASC";
                $result = $dbconn->query($sqlquery);
                $flag=0;
                $previoush =0;
                if($result->num_rows>0) {
                    $start = $_POST['hstart'];
                    $end = $_POST['hend'];
                    echo "Available hours: <br>";
                    while ($row = $result->fetch_assoc()) {
                        if($row['HStart']>$previoush){
                            $flag = 1;
                            echo $previoush." - ".$row['HStart'].'<br>';
                            $previoush = $row['HEnd'];
                        }
                        else{

                            $previoush = $row['HEnd'];
                        }
                    }
                    if($previoush<24){
                        $flag = 1;
                        echo $previoush." - 24<br>";
                    }
                    if($flag == 0 ){
                        echo "There are no available hours on specified date<br>";
                    }
                }

            }
        }
        else{
            $sqlquery = "INSERT INTO Reservations(Date,HStart,HEnd,IDRoom,Tenant,Status) VALUES
                ('".$_POST['resdate']."',".$start.",".$end.",'".$_SESSION['roomid']."','".$_SESSION['user_id']."',"."1".")";
            if($dbconn->query($sqlquery) == TRUE){
                $_SESSION['availability'] = 1;
                header("Location: ./makereservation.php");
                exit;
            }
            else{
                echo $dbconn->error;
            }
        }

    }
    else if(isset($_POST['reservationconfirm'])){
        if($_POST['confirmation'] == 'yes'){
            $sqlquery = "UPDATE Reservations SET Status = 2 WHERE Tenant like '".$_SESSION['user_id']."'";
            if($dbconn->query($sqlquery) == TRUE){
                unset($_SESSION['availability']);
                echo "Pomyślnie dokonano rezerwacji";

            }
        }
        else{
            $sqlquery = "DELETE FROM Reservations WHERE Tenant like '".$_SESSION['user_id']."' AND Status = 1";
            $dbconn->query($sqlquery);
            unset($_SESSION['availability']);
            echo "Anulowano rezerwację";
        }
    }



?>
