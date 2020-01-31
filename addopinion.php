<?php
    session_start();
?>
<form action="addopinion.php" method="post">
    Grade : <input type="number" id="rating" name="rating" required><br>
    Comment : <input type="text" id="comment" name="comment" maxlength="200"><br>
    <input type="submit" name="addopinion" value="Rate">
</form>

<?php

if(isset($_GET['roomid'])){
    $_SESSION['roomid'] = $_GET['roomid'];
}else{
    if(isset($_POST['addopinion']) && isset($_SESSION['roomid'])){
        include 'dbconn.php';
        $rating=$_POST['rating'];
        if($rating > 10){
          $rating =10;
        }
        $sqlquery = "INSERT INTO Opinions(IDRoom,Rating,Comment) VALUES
            (".$_SESSION['roomid'].",'".$rating."','".$_POST['comment']."')";
        if($dbconn->query($sqlquery) == TRUE){
            echo "Succesfully added opinion<br>";
        }
        else{
            echo $dbconn->error;
            echo "Couldn't add opinion<br>";
        }

        unset($_SESSION['roomid']);
    }
    else{
        unset($_SESSION['roomid']);
    }
}


?>
	