<?php

$connection = mysqli_connect("127.0.0.1", "root", "", "CabsOnline");  // use own details
if (!$connection) {
    echo "<p>Connection not made. Killing script.</p>";
} else {
    $query = "SELECT * FROM requests WHERE PICKUP_DATE=CURRENT_DATE AND STATUS='unassigned' AND PICKUP_TIME > SUBDATE(NOW(), INTERVAL 2 HOUR)";

    $result = mysqli_query($connection, $query);

    $requestCount = mysqli_num_rows($result);
    
    $requestsArray = Array();
    
    while ($r = mysqli_fetch_assoc($result))
    {
        $requestsArray[]=$r;
    }
    
    echo json_encode($requestsArray);
}
    
// sleep for 5 seconds to slow server response down
  
