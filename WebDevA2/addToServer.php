<?php

// get name and password passed from client
$name = $_POST['name'];
$phone = $_POST['phone'];
$unitNumber = $_POST['unitNumber'];
if ($unitNumber == "") {
    $unitNumber = "null";
}
$street = $_POST['street'];
$destination = $_POST['destination'];
$date = $_POST['date'];
$time = $_POST['time'];

$connection = @mysqli_connect("127.0.0.1", "root", "", "CabsOnline");  // use own details
if (!$connection) {
    echo "<p>Connection not made. Killing script.</p>";
} else {
    $query = "SELECT * FROM requests";

    $result = mysqli_query($connection, $query);
    

    $requestCount = mysqli_num_rows($result);

    $bookingNumber = $requestCount + 1;

    $bookingDateTime = date('Y-m-d h:i:s');

    $storeSql = "INSERT INTO requests (BOOKING_NUMBER, CUSTOMER_NAME, "
            . "CUSTOMER_PHONE, UNIT_NUMBER,STREET_ADDRESS, DESTINATION_SUBURB, "
            . "PICKUP_DATE, PICKUP_TIME, STATUS, DATETIME_BOOKED) VALUES ('" . $bookingNumber . "', '" . $name . "', '" . $phone . "', "
            . $unitNumber . ", '" . $street . "', '" . $destination . "', '" . $date . "', '" . $time . "', 'unassigned', '" . $bookingDateTime . "')";

    mysqli_query($connection, $storeSql);
    
// sleep for 5 seconds to slow server response down
    sleep(5);
// write back the password concatenated to end of the name
    
    
    echo ("Thank you! Your booking reference  number  is  " . $bookingNumber . ".  You  will  be  picked  up  in  front  of  your  provided address  at  " . $time . "  on  " . $date . ".");
}
?>
