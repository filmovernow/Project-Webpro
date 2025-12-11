<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="CSS/navstyle.css">
    <link rel="stylesheet" href="CSS/landingstyle.css">
    <script src="JS/navbar.js" defer></script>
    <script src="JS/landing.js" defer></script>
    <title>LandingPage</title>
</head>

<body> 
    <?php include "navbar.php"; ?>
    
    <main class="container">
        <div class="nameweb"><h1>ONE <br class="h1break">BY <br class="h1break">ONE</h1></div>
        <div class="image">
            <div class="bannercontainer">
                <img class="banner" src="IMAGES/banner1.jpg">
                    <div class="circlewrapper">
                        <div class="circle"></div>
                        <div class="circle"></div>
                        <div class="circle"></div>
                    </div>
            </div>
        </div>    
    </main>
    
    <section>
        <p class="text">What's new</p>
        <div class="moviepicturewrapper">
            <img class="moviepicture" src="IMAGES\movie1.png">
            <img class="moviepicture" src="IMAGES\movie1.png">
            <img class="moviepicture" src="IMAGES\movie1.png">
            <img class="moviepicture" src="IMAGES\movie1.png">
            <img class="moviepicture" src="IMAGES\movie1.png">
        </div>
    </section>

    <footer>
        <div class="footerbox"></div>
    </footer>
</body>
</html>