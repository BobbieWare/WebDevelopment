<html>    
    <head>
        <title>Status Posting System</title>
        <link rel="stylesheet" href="style.css" type="text/css" />
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
    </head>
    <body>
        <div class="container">
            <h1 class="heading">Status Posting System</h1>
            <div class="content">
                <form name="postStatus" action="poststatusprocess.php" method="POST">
                    <label>Status Code (required): </label><input type="text" name="code" value="S0000" size="5" /><br>

                    <label>Status (required): </label><input type="text" name="text" value="" /><br>

                    Share: <label><input type="radio" name="share" value="Public" checked="checked"/> Public</label>
                    <label><input type="radio" name="share" value="Friends" /> Friends</label>
                    <label><input type="radio" name="share" value="Only Me" /> Only Me</label><br>

                    <!-- The php function is used to fill the date with the current date. -->
                    <label>Date: </label><input type="date" name="date" value="<?php echo date('Y-m-d'); ?>" /><br>

                    Permission Type: <label><input type="checkbox" name="likeable" value="ON" /> Allow Like</label>
                    <label><input type="checkbox" name="commentable" value="ON" /> Allow Comment</label>
                    <label><input type="checkbox" name="shareable" value="ON" /> Allow Share</label><br>

                    <input type="submit" value="Post" name="post" />  <input type="reset" value="Reset" name="reset" /><br>

                    <button onclick="location.href = 'index.html'" type="button">Return to Home Page</button>
                </form>
            </div>
        </div>
    </body>
</html>

