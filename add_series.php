<html>

    <head> </head>
    <body>

        <form action="add_series.php" method=get>
            Enter Title of Series: <input type=text size=30 name="title"><p></p>
            Enter Synopsis: <input type=textarea size=100 name="synopsis"><p></p>
            Rating: <input type=number name="rating" min="0" max="5" step="0.1" placeholder="X.X"><p></p>
            Link to Thumbnail: <input type=text size=50 name="thumb_ref"><p></p>
            <input type=submit value="Submit">
            <input type=hidden name="form_submitted" value="1">
        </form>

        <?php
            include '/users/kent/student/sopatz/config.inc';
            if (isset($_GET["form_submitted"])) {
                $conn = new mysqli($servername, $username, $password, $dbname);
                if ($conn->connect_error) {
                    die("Connection Failed: " . $conn->connect_error);
                }
                //SQL stuff here
            }
        ?>

    </body>

</html>
