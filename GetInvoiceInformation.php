<?php
// Get Reservation data
$sqlquery = "SELECT * FROM Reservations WHERE IDReservation = ".$_SESSION['resid'];
$reservation = $dbconn->query($sqlquery);
if($reservation->num_rows >0){
    $reservation = $reservation->fetch_assoc();
}
else{
    echo $dbconn->error;
    echo "Couldnt get reservation data";
    exit();
}
// Get roomdata data
$sqlquery = "SELECT * FROM Room WHERE IDRoom = ".$reservation['IDRoom'];
$room = $dbconn->query($sqlquery);
if($room->num_rows >0){
    $room = $room->fetch_assoc();
}
else{
    echo $dbconn->error;
    echo "Couldnt get room data";
    exit();
}
// Get owner data
$sqlquery = "SELECT * FROM Users WHERE Login like '".$room['Owner']."'";
$owner = $dbconn->query($sqlquery);
if($owner->num_rows >0){
    $owner = $owner->fetch_assoc();
}
else{
    echo $dbconn->error;
    echo "Couldnt get owner data";
    exit();
}
// Get tenant data
$sqlquery = "SELECT * FROM Users WHERE Login like '".$reservation['Tenant']."'";
$tenant = $dbconn->query($sqlquery);
if($tenant->num_rows >0){
    $tenant = $tenant->fetch_assoc();
}
else{
    echo $dbconn->error;
    echo "Couldnt get tenant data";
    exit();
}
// Calculate room price
$mprice = $reservation['HEnd'] - $reservation['HStart'];
$mprice = $mprice * $room['PricePerHour'];
?>
