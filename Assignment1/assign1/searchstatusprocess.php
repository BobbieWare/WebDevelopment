<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="style.css" type="text/css" />
        <title>Search Results</title>
    </head>
    <body>
        <div class="container">
            <h1 class="heading">Search Results</h1>
            <div class="content">
                <?php
                
                $status;
                
                // Checks if status contains valid contents
                if (!is_null($_GET['status']) && preg_match('/[A-Za-z0-9!\?\., ]/', $_GET['status'])) {
                    $status = $_GET['status'];
                } else {
                    echo "<p>Status for searching is not valid please try again.</p>";
                    echo '<p><button onclick="location.href=\'index.html\'" type="button">Return to Home Page</button></p>'
                    . '<p><button onclick="location.href=\'searchstatusform.html\'" type="button">Search Status</button></p>';
                    die();
                }

                $connection = mysqli_connect("", "", "", ""); // Please enter the data

                // Kills the script if connection cannot be made
                if (!$connection) {
                    die('<p>Connection not made. Killing script.</p>'. '<p><button onclick="location.href=\'index.html\'" type="button">Return to Home Page</button></p>'
                    . '<p><button onclick="location.href=\'searchstatusform.php\'" type="button">Search Status</button></p>');
                }

                // This SQL query will create the required table if it does not exist in the database
                $checkQuery = "CREATE TABLE IF NOT EXISTS `posts` (
                              `status_code` varchar(5) NOT NULL,
                              `status_message` varchar(400) NOT NULL,
                              `share` varchar(7) NOT NULL,
                              `date` date NOT NULL,
                              `likeable` tinyint(1) NOT NULL,
                              `commentable` tinyint(1) NOT NULL,
                              `shareable` tinyint(1) NOT NULL,
                              PRIMARY KEY (`status_code`)
                              ) ENGINE=InnoDB DEFAULT CHARSET=utf8;";
                
                $result = mysqli_query($connection, $checkQuery);

                // Grabs all status codes from existing posts
                $query = "SELECT * FROM posts WHERE status_message LIKE '%$status%'";

                $results = mysqli_query($connection, $query);

                if ($results->num_rows === 0) {
                    echo '<div class="container">';
                    echo '<p>Search came back empty.</p>';
                    echo '<p><button onclick="location.href=\'index.html\'" type="button">Return to Home Page</button></p>'
                    . '<p><button onclick="location.href=\'searchstatusform.html\'" type="button">Search Status</button></p>';
                } else {
                    while ($row = mysqli_fetch_assoc($results)) {
                        displayRow($row);
                    }
                    echo '<p><button onclick="location.href=\'index.html\'" type="button">Return to Home Page</button></p>'
                    . '<p><button onclick="location.href=\'searchstatusform.html\'" type="button">Search Status</button></p>';
                }

                function displayRow($row) {
                    echo '<div class="container">';
                    echo '<h2>Status Code: ', $row["status_code"], '</h2>';
                    echo '<div class="content"><p>', $row["status_message"], '</p>';
                    echo '<p>Share to: ', $row["share"], '</p>';
                    echo '<p>Date: ', $row["date"], '</p>';
                    echo '<p>Likeable: ', printBoolean($row["likeable"], '</p>');
                    echo '<p>Shareable: ', printBoolean($row["shareable"], '</p>');
                    echo '<p>Commentable: ', printBoolean($row["commentable"], '</p>');
                    echo '</div></div>';
                }

                function printBoolean($boolean) {
                    if ($boolean) {
                        return "Yes";
                    } else {
                        return "No";
                    }
                }
                ?>
            </div>
        </div>
    </body>
</html>
