<html>

    <head> </head>
    <body>

        <form action="add_video.php" method=get>
            Title of Video: <input type=text size=50 name="title"><p></p>
            Synopsis: <input type=textarea size=100 name="synopsis"><p></p>
            What is the video's runtime? <input type=text size=5 name="runtime" placeholder="hh:mm:ss"><p></p>
            Thumbnail Reference: <input type=text size=30 name="thumb_ref" placeholder="images/..."><p></p>
            Video Reference: <input type=text size=30 name="vid_ref"><p></p>
            Rating: <input type=number name="rating" min="0" max="5" step="0.1" placeholder="X.X"><p></p>
            Subscription Plan Required to Watch:<br>
            <input type=radio id="basic" name="subsc_plan" value="basic">
            <label for="basic">Basic Subscription</label><br>
            <input type=radio id="premium" name="subsc_plan" value="premium">
            <label for="premium">Premium Subscription</label><p></p>
            Type of video:<br>
            <input type=radio id="movie" name="vid_type" value="movie">
            <label for="movie">Movie</label><br>
            <input type=radio id="episode" name="vid_type" value="episode">
            <label for="episode">Episode of a Show</label><p></p>

            <label for="genre">Genre: </label><span style="display: inline; float: none;"></span>
            <select id="genre" name="genre" class="form-control">
                <option value="action">Action</option>
                <option value="adventure">Adventure</option>
                <option value="animation">Animation</option>
                <option value="comedy">Comedy</option>
                <option value="documentary">Documentary</option>
                <option value="drama">Drama</option>
                <option value="fantasy">Fantasy</option>
                <option value="historical">Historical</option>
                <option value="horror">Horror</option>
                <option value="musical">Musical</option>
                <option value="mystery">Mystery</option>
                <option value="romance">Romance</option>
                <option value="sci-fi">Sci-Fi</option>
                <option value="thriller">Thriller</option>
                <option value="western">Western</option>
            </select><p></p><hr>
            Add Video to Series:<p></p>
            Series ID: <input type=number name="series_ID" min="1" max="99999" step="1"><p></p>
            Season Number: <input type=number name="season_number" min="1" max="99" step="1"><p></p>
            Episode Number: <input type=number name="episode_number" min="0" max="999" step="1"><p></p>
            <p></p><input type=submit value="Submit">
            <input type=hidden name="form_submitted" value="1">
        </form>
        <?php
            include '/users/kent/student/sopatz/config.inc';
            if (isset($_GET["form_submitted"])) {
                $conn = new mysqli($servername, $username, $password, $dbname);
                if ($conn->connect_error) {
                    die("Connection Failed: " . $conn->connect_error);
                }

                //Sanitizing text variables to prevent SQL injection
                $title = $conn->real_escape_string($_GET["title"]);
                $synopsis = $conn->real_escape_string($_GET["synopsis"]);
                $runtime = $conn->real_escape_string($_GET["runtime"]);
                $thumb_ref = $conn->real_escape_string($_GET["thumb_ref"]);
                $vid_ref = $conn->real_escape_string($_GET["vid_ref"]);

                //Variables that do not need to be sanitized
                $rating = $_GET["rating"];
                $subsc_plan = $_GET["subsc_plan"];
                $vid_type = $_GET["vid_type"];
                $genre = $_GET["genre"];

                $insert_video = "INSERT INTO video (title, synopsis, runtime, thumbnail_reference, video_reference, rating, subsc_plan_required, vid_type, genre)
                                 VALUES ('" . $title . "', '" . $synopsis . "', '" . $runtime . "', '" . $thumb_ref . "', '" . $vid_ref . "', '" . $rating . "', '" . $subsc_plan . "', '" . $vid_type . "', '" . $genre . "')";
                $result = $conn->query($insert_video);

                if ($result != 1) {
                    echo "Video failed to add, please try again";
                }
                else {
                    echo "The video has been successfully submitted";
                    $result = $conn->query("SELECT MAX(ID) FROM video");
                    $video_ID = $result->fetch_assoc()["MAX(ID)"];
                    $series_ID = $_GET["series_ID"];
                    $season_number = $_GET["season_number"];
                    $episode_number = $_GET["episode_number"];

                    $insert_into_series = "INSERT INTO is_part_of VALUES('" . $video_ID . "', '" . $series_ID . "', '" . $season_number . "', '" . $episode_number . "')";
                    $result = $conn->query($insert_into_series);
                    if ($result == 1) echo "<p>Video successfully added to series</p>";
                    else echo "<p>Video could not be added to series</p>";
                }

                $conn->close();
            }
        ?>

    </body>

</html>
