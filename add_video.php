<html>

    <head> </head>
    <body>

        <form action="add_vidser.php" method=get>
            Enter title of video: <input type=text size=100 name="title"><p></p>
            Enter synopsis: <input type=textarea size=100 name="synopsis"><p></p>
            What is the video's runtime? <input type=text size=6 name="runtime" placeholder="hh:mm:ss"><p></p>
            Link to Thumbnail: <input type=text size=50 name="thumb_ref"><p></p>
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
                //SQL stuff here
            }
        ?>

    </body>

</html>
