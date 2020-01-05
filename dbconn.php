<?php
$servername = "localhost";
$dbusername = "ProjectManager";
$dbpassword = "projectmanager";
$dbname = "PZDB";

$dbconn = new mysqli($servername, $dbusername, $dbpassword, $dbname);

if ($dbconn->connect_error) {
    die("Connection failed: " . $dbconn->connect_error);
}
?>