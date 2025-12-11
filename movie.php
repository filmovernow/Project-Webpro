<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="CSS/navstyle.css">
    <link rel="stylesheet" href="CSS/moviestyle.css">
    <script src="JS/navbar.js" defer></script>
    <title>Movie</title>
</head>
<body>
    <?php include "navbar.php"; ?>

    <main class="container">
        <img class="moviepicture" src="IMAGES\movie1.png">
            <div class="textcontainer">
                <p class="texttitle">Movie title</p>
                <div class="moviedes">Movie description: </div>
                <div class="ratingstext">Ratings: x.x/5</div>
                <div class="ratingswrap">
                    <img class="imgstar" src="IMAGES/fullstar.png">
                    <img class="imgstar" src="IMAGES/fullstar.png">
                    <img class="imgstar" src="IMAGES/fullstar.png">
                    <img class="imgstar" src="IMAGES/halfstar.png">
                    <img class="imgstar" src="IMAGES/clearstar.png">                    
                </div>
                    <button class="addtocartbutton">เพิ่มไปยังตระกร้า</button>
            </div>
    </main>

    <footer>
        <div class="footerbox"></div>
    </footer>
</body>
</html>