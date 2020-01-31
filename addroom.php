<?php
session_start();

?>

<?php
    if(isset($_POST['addroom']) && isset($_SESSION['user_id'])){
        include 'dbconn.php';
        // check role
        $sqlquery = "Select * FROM Users Where Login like '".$_SESSION['user_id']."'";
        $result = $dbconn->query($sqlquery);
        $result = $result->fetch_assoc();
            if($result['Role'] == "Agent"){
                if($_POST['priceperhour']>=0){
                   $sqlquery = "INSERT INTO Room(Owner,Name,Address,City,Description,PricePerHour) VALUES
                   ('".$result['Login']."','".$_POST['name']."','".$_POST['address']."','".$_POST['city']."','".$_POST['description']."',".$_POST['priceperhour'].")";
                   if($dbconn->query($sqlquery) == TRUE){
                      echo "Successfully added room<br>";
                   }
                   else{
                       echo $dbconn->error;
                       echo "Couldn't add room<br>";
                   }
                }
                else{
                  echo "Invalid price";
                }
                
            }
            else{
                echo "You have insufficient permissions. <br>";
            }
    }
    else if(isset($_SESSION['user_id'])) {
        ?>
        <form action="addroom.php" method="post">
            Room name : <input type="text" id="name" name="name" required><br>
            Address : <input type="text" id="address" name="address" required><br>
            City : <input type="text" id="city" name="city" required><br>
            Description : <input type="text" id="description" name="description" maxlength="200"><br>
            Price per hour : <input type="number" id="priceperhour" name="priceperhour"><br>
            <input type="submit" name="addroom" value="Add">
        </form>
        <?php
    }
    else{
        echo "You are not logged in<br>";
    }
?>
							