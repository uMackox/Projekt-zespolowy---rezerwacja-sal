<?php
session_start();

?>

<?php
    if(isset($_POST['addroom']) && isset($_SESSION['user_id'])){
        $servername = "localhost";
        $dbusername = "ProjectManager";
        $dbpassword = "projectmanager";
        $dbname = "PZDB";

        $dbconn = new mysqli($servername,$dbusername,$dbpassword,$dbname);

        if($dbconn->connect_error){
            die("Connection failed: ".$dbconn->connect_error);
        }
        // check role
        $sqlquery = "Select * FROM Users Where Login like '".$_SESSION['user_id']."'";
        $result = $dbconn->query($sqlquery);
        $result = $result->fetch_assoc();
            if($result['Role'] == "Agent"){
                $sqlquery = "INSERT INTO Room(Owner,Name,Address,City,Description) VALUES
                ('".$result['Login']."','".$_POST['name']."','".$_POST['address']."','".$_POST['city']."','".$_POST['description']."')";
                if($dbconn->query($sqlquery) == TRUE){
                    echo "Pomyślnie dodano salę<br>";
                }
                else{
                    echo $dbconn->error;
                    echo "Dodanie salii nie powiodło się<br>";
                }
            }
            else{
                echo "Nie posiadasz odpowiednich uprawnień <br>";
            }
    }
    else if(isset($_SESSION['user_id'])) {
        ?>
        <form action="addroom.php" method="post">
            Nazwa sali : <input type="text" id="name" name="name" required><br>
            Adres : <input type="text" id="address" name="address" required><br>
            Miasto : <input type="text" id="city" name="city" required><br>
            Opis : <input type="text" id="description" name="description" maxlength="200"><br>
            <input type="submit" name="addroom" value="Dodaj">
        </form>
        <?php
    }
    else{
        echo "Nie jesteś zalogowany<br>";
    }
?>
