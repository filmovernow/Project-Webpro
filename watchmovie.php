<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="CSS/navstyle.css">
    <link rel="stylesheet" href="CSS/watchmovie.css">
    <script src="JS/navbar.js" defer></script>
    <title>WatchMovie</title>
        
</head>
<body>
    <?php include "navbar.php"; ?>

    <main>
        <header class="headtext">
            <p>Movie title</p>
        </header>
        <video class="movieplayer" controls>
            <source src="MOVIES/samplemovie.mp4" type="video/mp4">
        </video>
        
        <section>
            <p class="ratingscore">Add your rating</p>
                <div class="ratingswrap">
                        <img class="imgstar" src="IMAGES/fullstar.png">
                        <img class="imgstar" src="IMAGES/fullstar.png">
                        <img class="imgstar" src="IMAGES/fullstar.png">
                        <img class="imgstar" src="IMAGES/halfstar.png">
                        <img class="imgstar" src="IMAGES/clearstar.png">                    
                </div>
            <p class="rectext">Movie Recommendations</p>
                <div class="recmov">
                    <img class="moviepicture" src="IMAGES\movie1.png">
                    <img class="moviepicture" src="IMAGES\movie1.png">
                    <img class="moviepicture" src="IMAGES\movie1.png">
                    <img class="moviepicture" src="IMAGES\movie1.png">
                    <img class="moviepicture" src="IMAGES\movie1.png">
                </div>
        </section>
    </main>
    <footer>
        <div class="footerbox"></div>
    </footer>
</body>
</html>