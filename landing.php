<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="CSS/navstyle.css">
    <link rel="stylesheet" href="CSS/landingstyle.css">
    <script src="JS/navbar.js" defer></script>
    <title>LandingPage</title>
</head>

<body> 
    <?php include "navbar.php"; ?>
    
    <main class="container">
        <div class="nameweb"><h1>ONE <br class="h1break">BY <br class="h1break">ONE</h1></div>
        <div class="image">
            <div class="bannercontainer">
                <img class="banner" src="IMAGES/banner1.png">
            </div>
        </div>    
    </main>
    
    <section>
        <p class="text">What's new</p>
        <div class="moviecardwrapper"> <?php
                require('connect.php');

                $query_new = "SELECT moviePosterURL, movieName FROM movie ORDER BY movieID DESC LIMIT 5;";
                $call_new = mysqli_query($connect, $query_new);

                $movies = [];

                if ($call_new) 
                {
                    while ($result_new = mysqli_fetch_assoc($call_new)) 
                    {
                        $movies[] = ["poster" => $result_new["moviePosterURL"], "title" => $result_new["movieName"]];
                    }
                }

                while (count($movies) < 5) 
                {
                    $movies[] = ["poster" => "POSTER/movie1.png", "title" => "More soon"];
                }

                foreach ($movies as $m) 
                {
                    echo '
                        <div class="moviecard"> <img 
                                class="moviepicture"  
                                src="' . htmlspecialchars($m["poster"]) . '" 
                                alt="' . htmlspecialchars($m["title"]) . '"
                            >
                            <p class="movietitle">' . htmlspecialchars($m["title"]) . '</p>
                        </div>';
                }
            ?>
        </div>
    </section>

    <!-- <footer>
        <div class="footerbox"></div>
    </footer> -->
    
</body>
</html>