<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="CSS/navstyle.css">
    <link rel="stylesheet" href="CSS/moviepage.css">
    <script src="JS/navbar.js" defer></script>
    <script src="JS/moviepage.js" defer></script>
    <title>MoviePage</title>
</head>
<body>
    <?php 
        include "navbar.php"; 
        require('connect.php');

        $default_poster = "POSTER/movie1.png";
        $default_title = "Movie title";
    ?>

<main class="moviecatalog">
    <section class="movierowsection">
        <h2 class="rowtitle"> ภาพยนตร์ใหม่ล่าสุด <a href="movielist.php?new=true" class="viewmore">ดูเพิ่ม</a></h2>
        <div class="rowflexwrapper">
            <button class="scrollbutton left" onclick="scrollMovies('newMoviesContainer', false)"> &lt; </button>
            <div class="movierowcontainer" id="newMoviesContainer">
                <div class="moviecardwrapper">
                    <?php
                        $query_new = "SELECT movieID, moviePosterURL, movieName FROM movie ORDER BY movieID DESC LIMIT 10;";
                        $call_new = mysqli_query($connect, $query_new);

                        $movies = [];

                        if ($call_new) {
                            while ($result_new = mysqli_fetch_assoc($call_new)) {
                                $movies[] = [
                                    "poster" => $result_new["moviePosterURL"] ?: $default_poster, 
                                    "title" => $result_new["movieName"] ?: $default_title, 
                                    "id" => $result_new["movieID"]
                                ];
                            }
                        }
                        
                        foreach ($movies as $m) {
                            $link = $m["id"] ? 'href="moviedetail.php?id=' . $m["id"] . '"' : 'href="javascript:void(0);"';
                            echo '
                                <a ' . $link . ' class="moviecard">
                                    <img src="' . htmlspecialchars($m["poster"]) . '" alt="movie" class="movieposter" onerror="this.onerror=null; this.src=\'' . $default_poster . '\';">
                                    <p class="movietitle">' . htmlspecialchars($m["title"]) . '</p>
                                </a>';
                        }
                    ?>
                    <div class="moviespacer"></div>
                </div>
            </div>
            <button class="scrollbutton right" onclick="scrollMovies('newMoviesContainer', true)"> &gt; </button>
        </div>
    </section>
    
    <section class="movierowsection">
        <h2 class="rowtitle"> ภาพยนตร์ประเภทตลก <a href="movielist.php?tagID=1" class="viewmore">ดูเพิ่ม</a></h2>
        <div class="rowflexwrapper">
            <button class="scrollbutton left" onclick="scrollMovies('tag1Container', false)"> &lt; </button>
            <div class="movierowcontainer" id="tag1Container">
                <div class="moviecardwrapper">
                    <?php
                        $query_tag_1 = "
                            SELECT m.movieID, m.moviePosterURL, m.movieName 
                            FROM movie m
                            JOIN movie_tag mt ON m.movieID = mt.movieID
                            WHERE mt.tagID = 1
                            LIMIT 10;
                        ";
                        $call_tag_1 = mysqli_query($connect, $query_tag_1);
                        $movies_1 = [];
                        if ($call_tag_1) {
                            while ($result_1 = mysqli_fetch_assoc($call_tag_1)) {
                                $movies_1[] = [
                                    "poster" => $result_1["moviePosterURL"] ?: $default_poster, 
                                    "title" => $result_1["movieName"] ?: $default_title, 
                                    "id" => $result_1["movieID"]
                                ];
                            }
                        }
                        
                        foreach ($movies_1 as $m) {
                            $link = $m["id"] ? 'href="moviedetail.php?id=' . $m["id"] . '"' : 'href="javascript:void(0);"';
                            echo '
                                <a ' . $link . ' class="moviecard">
                                    <img src="' . htmlspecialchars($m["poster"]) . '" alt="movie" class="movieposter" onerror="this.onerror=null; this.src=\'' . $default_poster . '\';">
                                    <p class="movietitle">' . htmlspecialchars($m["title"]) . '</p>
                                </a>';
                        }
                    ?>
                    <div class="moviespacer"></div>
                </div>
            </div>
            <button class="scrollbutton right" onclick="scrollMovies('tag1Container', true)"> &gt; </button>
        </div>
    </section>

    <section class="movierowsection">
        <h2 class="rowtitle"> ภาพยนตร์ประเภทสยองขวัญ <a href="movielist.php?tagID=2" class="viewmore">ดูเพิ่ม</a></h2>
        <div class="rowflexwrapper">
            <button class="scrollbutton left" onclick="scrollMovies('tag2Container', false)"> &lt; </button>
            <div class="movierowcontainer" id="tag2Container">
                <div class="moviecardwrapper">
                    <?php
                        
                        $query_tag_2 = "
                            SELECT m.movieID, m.moviePosterURL, m.movieName 
                            FROM movie m
                            JOIN movie_tag mt ON m.movieID = mt.movieID
                            WHERE mt.tagID = 2
                            LIMIT 10;";
                        $call_tag_2 = mysqli_query($connect, $query_tag_2);
                        $movies_2 = [];
                        if ($call_tag_2) {
                            while ($result_2 = mysqli_fetch_assoc($call_tag_2)) {
                                $movies_2[] = [
                                    "poster" => $result_2["moviePosterURL"] ?: $default_poster, 
                                    "title" => $result_2["movieName"] ?: $default_title, 
                                    "id" => $result_2["movieID"]
                                ];
                            }
                        }
                        
                        foreach ($movies_2 as $m) {
                            $link = $m["id"] ? 'href="moviedetail.php?id=' . $m["id"] . '"' : 'href="javascript:void(0);"';
                            echo '
                                <a ' . $link . ' class="moviecard">
                                    <img src="' . htmlspecialchars($m["poster"]) . '" alt="movie" class="movieposter" onerror="this.onerror=null; this.src=\'' . $default_poster . '\';">
                                    <p class="movietitle">' . htmlspecialchars($m["title"]) . '</p>
                                </a>';
                        }
                    ?>
                    <div class="moviespacer"></div>
                </div>
            </div>
            <button class="scrollbutton right" onclick="scrollMovies('tag2Container', true)"> &gt; </button>
        </div>
    </section>

    <section class="movierowsection">
        <h2 class="rowtitle"> ภาพยนตร์ประเภทดราม่า <a href="movielist.php?tagID=3" class="viewmore">ดูเพิ่ม</a></h2>
        <div class="rowflexwrapper">
            <button class="scrollbutton left" onclick="scrollMovies('tag3Container', false)"> &lt; </button>
            <div class="movierowcontainer" id="tag3Container">
                <div class="moviecardwrapper">
                    <?php
                        $query_tag_3 = "
                            SELECT m.movieID, m.moviePosterURL, m.movieName 
                            FROM movie m
                            JOIN movie_tag mt ON m.movieID = mt.movieID
                            WHERE mt.tagID = 3
                            LIMIT 10;";
                        $call_tag_3 = mysqli_query($connect, $query_tag_3);
                        $movies_3 = [];
                        if ($call_tag_3) {
                            while ($result_3 = mysqli_fetch_assoc($call_tag_3)) {
                                $movies_3[] = [
                                    "poster" => $result_3["moviePosterURL"] ?: $default_poster, 
                                    "title" => $result_3["movieName"] ?: $default_title, 
                                    "id" => $result_3["movieID"]
                                ];
                            }
                        }
                        
                        foreach ($movies_3 as $m) {
                            $link = $m["id"] ? 'href="moviedetail.php?id=' . $m["id"] . '"' : 'href="javascript:void(0);"';
                            echo '
                                <a ' . $link . ' class="moviecard">
                                    <img src="' . htmlspecialchars($m["poster"]) . '" alt="movie" class="movieposter" onerror="this.onerror=null; this.src=\'' . $default_poster . '\';">
                                    <p class="movietitle">' . htmlspecialchars($m["title"]) . '</p>
                                </a>';
                        }
                    ?>
                    <div class="moviespacer"></div>
                </div>
            </div>
            <button class="scrollbutton right" onclick="scrollMovies('tag3Container', true)"> &gt; </button>
        </div>
    </section>

    <section class="movierowsection">
        <h2 class="rowtitle"> ภาพยนตร์ประเภทแฟนตาซี <a href="movielist.php?tagID=4" class="viewmore">ดูเพิ่ม</a></h2>
        <div class="rowflexwrapper">
            <button class="scrollbutton left" onclick="scrollMovies('tag4Container', false)"> &lt; </button>
            <div class="movierowcontainer" id="tag4Container">
                <div class="moviecardwrapper">
                    <?php
                        $query_tag_4 = "
                            SELECT m.movieID, m.moviePosterURL, m.movieName 
                            FROM movie m
                            JOIN movie_tag mt ON m.movieID = mt.movieID
                            WHERE mt.tagID = 4
                            LIMIT 10;";
                        $call_tag_4 = mysqli_query($connect, $query_tag_4);
                        $movies_4 = [];
                        if ($call_tag_4) {
                            while ($result_4 = mysqli_fetch_assoc($call_tag_4)) {
                                $movies_4[] = [
                                    "poster" => $result_4["moviePosterURL"] ?: $default_poster, 
                                    "title" => $result_4["movieName"] ?: $default_title, 
                                    "id" => $result_4["movieID"]
                                ];
                            }
                        }
                        
                        foreach ($movies_4 as $m) {
                            $link = $m["id"] ? 'href="moviedetail.php?id=' . $m["id"] . '"' : 'href="javascript:void(0);"';
                            echo '
                                <a ' . $link . ' class="moviecard">
                                    <img src="' . htmlspecialchars($m["poster"]) . '" alt="movie" class="movieposter" onerror="this.onerror=null; this.src=\'' . $default_poster . '\';">
                                    <p class="movietitle">' . htmlspecialchars($m["title"]) . '</p>
                                </a>';
                        }
                    ?>
                    <div class="moviespacer"></div>
                </div>
            </div>
            <button class="scrollbutton right" onclick="scrollMovies('tag4Container', true)"> &gt; </button>
        </div>
    </section>

    <section class="movierowsection">
        <h2 class="rowtitle"> ภาพยนตร์ประเภทไซไฟ <a href="movielist.php?tagID=5" class="viewmore">ดูเพิ่ม</a></h2>
        <div class="rowflexwrapper">
            <button class="scrollbutton left" onclick="scrollMovies('tag5Container', false)"> &lt; </button>
            <div class="movierowcontainer" id="tag5Container">
                <div class="moviecardwrapper">
                    <?php
                        $query_tag_5 = "
                            SELECT m.movieID, m.moviePosterURL, m.movieName 
                            FROM movie m
                            JOIN movie_tag mt ON m.movieID = mt.movieID
                            WHERE mt.tagID = 5
                            LIMIT 10;";
                        $call_tag_5 = mysqli_query($connect, $query_tag_5);
                        $movies_5 = [];
                        if ($call_tag_5) {
                            while ($result_5 = mysqli_fetch_assoc($call_tag_5)) {
                                $movies_5[] = [
                                    "poster" => $result_5["moviePosterURL"] ?: $default_poster, 
                                    "title" => $result_5["movieName"] ?: $default_title, 
                                    "id" => $result_5["movieID"]
                                ];
                            }
                        }
                        
                        foreach ($movies_5 as $m) {
                            $link = $m["id"] ? 'href="moviedetail.php?id=' . $m["id"] . '"' : 'href="javascript:void(0);"';
                            echo '
                                <a ' . $link . ' class="moviecard">
                                    <img src="' . htmlspecialchars($m["poster"]) . '" alt="movie" class="movieposter" onerror="this.onerror=null; this.src=\'' . $default_poster . '\';">
                                    <p class="movietitle">' . htmlspecialchars($m["title"]) . '</p>
                                </a>';
                        }
                    ?>
                    <div class="moviespacer"></div>
                </div>
            </div>
            <button class="scrollbutton right" onclick="scrollMovies('tag5Container', true)"> &gt; </button>
        </div>
    </section>

    <section class="movierowsection">
        <h2 class="rowtitle"> ภาพยนตร์ประเภทแอคชั่น <a href="movielist.php?tagID=6" class="viewmore">ดูเพิ่ม</a></h2>
        <div class="rowflexwrapper">
            <button class="scrollbutton left" onclick="scrollMovies('tag6Container', false)"> &lt; </button>
            <div class="movierowcontainer" id="tag6Container">
                <div class="moviecardwrapper">
                    <?php
                        $query_tag_6 = "
                            SELECT m.movieID, m.moviePosterURL, m.movieName 
                            FROM movie m
                            JOIN movie_tag mt ON m.movieID = mt.movieID
                            WHERE mt.tagID = 6
                            LIMIT 10;";
                        $call_tag_6 = mysqli_query($connect, $query_tag_6);
                        $movies_6 = [];
                        if ($call_tag_6) {
                            while ($result_6 = mysqli_fetch_assoc($call_tag_6)) {
                                $movies_6[] = [
                                    "poster" => $result_6["moviePosterURL"] ?: $default_poster, 
                                    "title" => $result_6["movieName"] ?: $default_title, 
                                    "id" => $result_6["movieID"]
                                ];
                            }
                        }
                        
                        foreach ($movies_6 as $m) {
                            $link = $m["id"] ? 'href="moviedetail.php?id=' . $m["id"] . '"' : 'href="javascript:void(0);"';
                            echo '
                                <a ' . $link . ' class="moviecard">
                                    <img src="' . htmlspecialchars($m["poster"]) . '" alt="movie" class="movieposter" onerror="this.onerror=null; this.src=\'' . $default_poster . '\';">
                                    <p class="movietitle">' . htmlspecialchars($m["title"]) . '</p>
                                </a>';
                        }
                    ?>
                    <div class="moviespacer"></div>
                </div>
            </div>
            <button class="scrollbutton right" onclick="scrollMovies('tag6Container', true)"> &gt; </button>
        </div>
    </section>

    <section class="movierowsection">
        <h2 class="rowtitle"> ภาพยนตร์ประเภทผจญภัย <a href="movielist.php?tagID=7" class="viewmore">ดูเพิ่ม</a></h2>
        <div class="rowflexwrapper">
            <button class="scrollbutton left" onclick="scrollMovies('tag7Container', false)"> &lt; </button>
            <div class="movierowcontainer" id="tag7Container">
                <div class="moviecardwrapper">
                    <?php
                        $query_tag_7 = "
                            SELECT m.movieID, m.moviePosterURL, m.movieName 
                            FROM movie m
                            JOIN movie_tag mt ON m.movieID = mt.movieID
                            WHERE mt.tagID = 7
                            LIMIT 10;";
                        $call_tag_7 = mysqli_query($connect, $query_tag_7);
                        $movies_7 = [];
                        if ($call_tag_7) {
                            while ($result_7 = mysqli_fetch_assoc($call_tag_7)) {
                                $movies_7[] = [
                                    "poster" => $result_7["moviePosterURL"] ?: $default_poster, 
                                    "title" => $result_7["movieName"] ?: $default_title, 
                                    "id" => $result_7["movieID"]
                                ];
                            }
                        }

                        foreach ($movies_7 as $m) {
                            $link = $m["id"] ? 'href="moviedetail.php?id=' . $m["id"] . '"' : 'href="javascript:void(0);"';
                            echo '
                                <a ' . $link . ' class="moviecard">
                                    <img src="' . htmlspecialchars($m["poster"]) . '" alt="movie" class="movieposter" onerror="this.onerror=null; this.src=\'' . $default_poster . '\';">
                                    <p class="movietitle">' . htmlspecialchars($m["title"]) . '</p>
                                </a>';
                        }
                    ?>
                    <div class="moviespacer"></div>
                </div>
            </div>
            <button class="scrollbutton right" onclick="scrollMovies('tag7Container', true)"> &gt; </button>
        </div>
    </section>

    <section class="movierowsection">
        <h2 class="rowtitle"> ภาพยนตร์ประเภทโรแมนติก <a href="movielist.php?tagID=8" class="viewmore">ดูเพิ่ม</a></h2>
        <div class="rowflexwrapper">
            <button class="scrollbutton left" onclick="scrollMovies('tag8Container', false)"> &lt; </button>
            <div class="movierowcontainer" id="tag8Container">
                <div class="moviecardwrapper">
                    <?php
                        $query_tag_8 = "
                            SELECT m.movieID, m.moviePosterURL, m.movieName 
                            FROM movie m
                            JOIN movie_tag mt ON m.movieID = mt.movieID
                            WHERE mt.tagID = 8
                            LIMIT 10;";
                        $call_tag_8 = mysqli_query($connect, $query_tag_8);
                        $movies_8 = [];
                        if ($call_tag_8) {
                            while ($result_8 = mysqli_fetch_assoc($call_tag_8)) {
                                $movies_8[] = [
                                    "poster" => $result_8["moviePosterURL"] ?: $default_poster, 
                                    "title" => $result_8["movieName"] ?: $default_title, 
                                    "id" => $result_8["movieID"]
                                ];
                            }
                        }
                        
                        foreach ($movies_8 as $m) {
                            $link = $m["id"] ? 'href="moviedetail.php?id=' . $m["id"] . '"' : 'href="javascript:void(0);"';
                            echo '
                                <a ' . $link . ' class="moviecard">
                                    <img src="' . htmlspecialchars($m["poster"]) . '" alt="movie" class="movieposter" onerror="this.onerror=null; this.src=\'' . $default_poster . '\';">
                                    <p class="movietitle">' . htmlspecialchars($m["title"]) . '</p>
                                </a>';
                        }
                    ?>
                    <div class="moviespacer"></div>
                </div>
            </div>
            <button class="scrollbutton right" onclick="scrollMovies('tag8Container', true)"> &gt; </button>
        </div>
    </section>

    <section class="movierowsection">
        <h2 class="rowtitle"> ภาพยนตร์ประเภทแอนิเมชัน <a href="movielist.php?tagID=9" class="viewmore">ดูเพิ่ม</a></h2>
        <div class="rowflexwrapper">
            <button class="scrollbutton left" onclick="scrollMovies('tag9Container', false)"> &lt; </button>
            <div class="movierowcontainer" id="tag9Container">
                <div class="moviecardwrapper">
                    <?php
                        $query_tag_9 = "
                            SELECT m.movieID, m.moviePosterURL, m.movieName 
                            FROM movie m
                            JOIN movie_tag mt ON m.movieID = mt.movieID
                            WHERE mt.tagID = 9
                            LIMIT 10;";
                        $call_tag_9 = mysqli_query($connect, $query_tag_9);
                        $movies_9 = [];
                        if ($call_tag_9) {
                            while ($result_9 = mysqli_fetch_assoc($call_tag_9)) {
                                $movies_9[] = [
                                    "poster" => $result_9["moviePosterURL"] ?: $default_poster, 
                                    "title" => $result_9["movieName"] ?: $default_title, 
                                    "id" => $result_9["movieID"]
                                ];
                            }
                        }
                        
                        foreach ($movies_9 as $m) {
                            $link = $m["id"] ? 'href="moviedetail.php?id=' . $m["id"] . '"' : 'href="javascript:void(0);"';
                            echo '
                                <a ' . $link . ' class="moviecard">
                                    <img src="' . htmlspecialchars($m["poster"]) . '" alt="movie" class="movieposter" onerror="this.onerror=null; this.src=\'' . $default_poster . '\';">
                                    <p class="movietitle">' . htmlspecialchars($m["title"]) . '</p>
                                </a>';
                        }
                    ?>
                    <div class="moviespacer"></div>
                </div>
            </div>
            <button class="scrollbutton right" onclick="scrollMovies('tag9Container', true)"> &gt; </button>
        </div>
    </section>

</main>
</body>
</html>