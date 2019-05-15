<?php

$bookingNumber = $_POST['bookingNumber'];

$connection = mysqli_connect("127.0.0.1", "root", "", "CabsOnline");  // use own details
if (!$connection) {
    echo "<p>Connection not made. Killing script.</p>";
} else {
    $query = "UPDATE requests SET STATU` = 'assigned' WHERE BOOKING_NUMBER = " . $bookingNumber;

    $result = mysqli_query($connection, $query);
    
    echo 'The booking request ' . $bookingNumber . 'has been properly assigned';
}

