<html>

    <head>
      <link rel=stylesheet href="allPages.css">
    </head>
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
            include '../config.inc';
            if (isset($_GET["form_submitted"])) {
                if ($_GET["title"] == "") {
                    echo "A title is required, please try again.";
                }
                else {
                    $conn = new mysqli($servername, $username, $password, $dbname);
                    if ($conn->connect_error) {
                        die("Connection Failed: " . $conn->connect_error);
                    }

                    $title = $conn->real_escape_string($_GET["title"]);
                    $synopsis = $conn->real_escape_string($_GET["synopsis"]);
                    $thumb_ref = $conn->real_escape_string($_GET["thumb_ref"]);

                    $insert = "INSERT INTO series (title, synopsis, rating, thumbnail_reference) VALUES ('" . $title . "', '" . $synopsis . "', '" . $_GET["rating"] . "', '" . $thumb_ref . "')";
                    $result = $conn->query($insert);

                    if ($result == 1) {
                        echo "The series has been successfully submitted";
                    }
                    else echo "Series failed to add, please try again";
                }

                $conn->close();
            }
        ?>
        <br><br><br>
        <a href="add_video.php" class="popbutton" style="padding:10px">Add Video</a>
        <a href="start.php" class="popbutton" style="padding:10px;">Start Page</a>

    </body>

</html>
