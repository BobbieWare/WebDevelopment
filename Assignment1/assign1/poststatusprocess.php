<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="style.css" type="text/css" />
        <title>Processing</title>
    </head>
    <body>
        <div class="container">
            <h1>Status Processing Page</h1>
            <div class="content">
                <?php
                
                $connection = mysqli_connect("", "", "", "");  // Please enter data.

                // If a connection cannot be made, the script ends and shows buttons to go back to the home page or the post page.
                if (!$connection) {
                    die('<p>Connection not made. Killing script.</p>' . '<p><button onclick="location.href=\'index.html\'" type="button">Return to Home Page</button></p>'
                            . '<p><button onclick="location.href=\'poststatusform.php\'" type="button">Post Status</button></p>');
                }

                // This SQL query will create the required table if it does not exist in the database.
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

                // This fucntion will be made false if any of the feilds are not valid
                $postValid = true;
                $code;

                if (!is_null($_POST['code'])) {
                    $code = $_POST['code'];
                } else {
                    $postValid = false;
                }

                // Checks to see if the code matches the required format S followed by 4 numbers
                if (!preg_match('/^S[0-9]{4}$/', $code)) {
                    $postValid = false;
                }

                $status;

                if (!is_null($_POST['text'])) {
                    $status = $_POST['text'];
                } else {
                    $postValid = false;
                }

                // Checks to see if the text matches the required format
                if (!preg_match('/[A-Za-z0-9!\?\., ]/', $status)) {
                    $postValid = false;
                }

                // If the fields are invalid, kills the script and 
                if (!$postValid) {
                    die('The status is invalid because it contains null values or inputs that do not match requirments.' . '<p><button onclick="location.href=\'index.html\'" type="button">Return to Home Page</button></p>'
                            . '<p><button onclick="location.href=\'poststatusform.php\'" type="button">Post Status</button></p>');
                }

                // Checks to see if code already exists in database.
                $query = "SELECT status_code FROM posts";

                $result = mysqli_query($connection, $query);

                if (mysqli_num_rows($result) != 0) { // if no posts exists then code skips over
                    while ($row = mysqli_fetch_assoc($result)) {
                        if ($row["status_code"] == $code) { // checks if the code already esixts 
                            die('Status code already exists.'. '<p><button onclick="location.href=\'index.html\'" type="button">Return to Home Page</button></p>'
                    . '<p><button onclick="location.href=\'poststatusform.php\'" type="button">Post Status</button></p>');
                        }
                    }
                }

                $code = $_POST['code'];
                $share = $_POST['share'];
                $date = $_POST['date'];

                $likeable;
                if (isset($_POST['likeable'])) {
                    $likeable = 1;
                } else {
                    $likeable = 0;
                }

                $commentable;
                if (isset($_POST['commentable'])) {
                    $commentable = 1;
                } else {
                    $commentable = 0;
                }
                $shareable;
                if (isset($_POST['shareable'])) {
                    $shareable = 1;
                } else {
                    $shareable = 0;
                }

                $query = "INSERT INTO posts (status_code, status_message, share, date, likeable, commentable, shareable)"
                        . " VALUES ('" . $code . "', '" . $status . "', '" . $share . "', '" . $date . "', '" . $likeable . "', '" . $commentable . "', '" . $shareable . "')";

                $result = mysqli_query($connection, $query);
                if ($result) {
                    echo "<p>Post successfully stored in database.</p>",
                    '<button onclick="location.href=\'index.html\'" type="button">Return to Home Page</button>';
                }
                ?></div>
        </div>
    </body>
</html>
