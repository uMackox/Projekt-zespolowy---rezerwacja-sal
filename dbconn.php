<?php
$servername = "mysql.cba.pl";
$dbusername = "umackox";
$dbpassword = "Umackoxpz1";
$dbname = "umackox";

$dbconn = new mysqli($servername, $dbusername, $dbpassword, $dbname);

if ($dbconn->connect_error) {
    die("Connection failed: " . $dbconn->connect_error);
}
?>