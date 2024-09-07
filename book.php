<?php
require_once('dbconnection.php');

$flight_id = 0;
$user_id =0;
$seat =0;
$destination ='';
$departure='';
$date='';
if (isset($_POST['flight_id'])) {
    $flight_id = intval($_POST['flight_id']);
}

if (isset($_POST['id'])) {
    $user_id = intval($_POST['id']);
}


if (isset($_POST['departure'])) {
    $departure = mysqli_real_escape_string($con,$_POST['departure']);
}


if (isset($_POST['destination'])) {
    $destination = mysqli_real_escape_string($con,$_POST['destination']);
}


if (isset($_POST['date'])) {
    $date = mysqli_real_escape_string($con,$_POST['date']);
}

if (isset($_POST['seat'])) {
    $seat = intval($_POST['seat'])-1;
}

$query_insert_booking = "
        INSERT INTO bookings (user_id, flight_id, seat,destination,departure, date)
        VALUES ($user_id,$flight_id, $seat, '$destination','$departure','$date')"; 

$insert_booking = mysqli_query($con, $query_insert_booking);

$query_update_flight = "
        UPDATE flights
        SET seat = seat - 1
        WHERE id = $flight_id";

$update_flight = mysqli_query($con, $query_update_flight);
header("Location:passanger.php?data=$user_id");
exit();

?>