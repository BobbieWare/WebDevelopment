<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="style.css" type="text/css" />
        <title>Processing</title>
    </head>
    <body>
        <h1>Status Processing Page</h1>
        <div class="content">
        <?php

        /*
         * This function is used to end the script and echos a message that relates to the error.
         */
        function dieWithMessage(String $message) {
            echo "<p>$message</p>";
            echo '<p><button onclick="location.href=\'index.html\'" type="button">Return to Home Page</button></p>'
            . '<p><button onclick="location.href=\'poststatusform.php\'" type="button">Post Status</button></p>';
            die();
        }

        $connection = @mysqli_connect("127.0.0.1", "root", "", "assignment1db");  // takes from conf
        if (!$connection) {
            dieWithMessage("<p>Connection not made. Killing script.</p>");
        }

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

        if (!$postValid) {
            dieWithMessage("The status is invalid because it contains null values or inputs that do not match requirments.");
        }

        // Checks to see if code already exists in database.
        $query = "SELECT status_code FROM posts";

        $result = mysqli_query($connection, $query);

        if (mysqli_num_rows($result) != 0) { // if no posts exists then code skips over
            while ($row = mysqli_fetch_assoc($result)) {
                if ($row["status_code"] == $code) {
                    dieWithMessage("Status code already exists.");
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
    </body>
</html>
