<?php
session_start();
?>
    <form action="SaveInvoice.php" method="post">
        <input type="submit" name="saveinvoice" value="Ocen">
    </form>

<?php
    if(isset($_POST['saveinvoice'])){
        $servername = "localhost";
        $dbusername = "ProjectManager";
        $dbpassword = "projectmanager";
        $dbname = "PZDB";
        $dbconn = new mysqli($servername,$dbusername,$dbpassword,$dbname);
        if($dbconn->connect_error){
            die("Connection failed: ".$dbconn->connect_error);
        }
    }
?>