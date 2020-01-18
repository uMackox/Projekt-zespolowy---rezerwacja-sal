<?php
    session_start();
    include 'dbconn.php';

if(isset($_SESSION['user_id'])){// Get User information
    $sqlquery = "SELECT * FROM Users WHERE Login like '".$_SESSION['user_id']."'";
    $userinfo = $dbconn->query($sqlquery);
    if($userinfo->num_rows>0){
        $userinfo = $userinfo->fetch_assoc();
        if($userinfo['Role'] == 'Agent'){
            $sqlquery = "SELECT * FROM Room WHERE Owner like '".$userinfo['Login']."'";
            $result = $dbconn->query($sqlquery);
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {

                    echo "Room name: " . $row["Name"] . "<br>";
                    echo "City: " . $row["City"] . "<br>";
                    echo "Address: " . $row["Address"] . "<br>";
                    echo "Description: " . $row["Description"] . "<br>";
                    echo "<a href='opinions.php?roomid=".$row["IDRoom"]."'>Opinions</a><br>";
                    echo "<br>";
                }
            } else {
                echo "Brak Sal do wyświetlenia";
            }
        }
    }
}
else{
    echo "You are not logged in";
}


?>
