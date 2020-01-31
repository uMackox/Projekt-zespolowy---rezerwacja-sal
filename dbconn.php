<?php
$servername = "###";
$dbusername = "###";
$dbpassword = "###";
$dbname = "###";

$dbconn = new mysqli($servername, $dbusername, $dbpassword, $dbname);

if ($dbconn->connect_error) {
    die("Connection failed: " . $dbconn->connect_error);
}
?>
