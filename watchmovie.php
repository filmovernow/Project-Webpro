<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="CSS/navstyle.css">
    <link rel="stylesheet" href="CSS/watchmoviestyle.css">
    <script src="JS/navbar.js" defer></script>
    <title>WatchMovie</title>
</head>
<body>
    <?php 
        include "navbar.php";
        require('connect.php');

        if (!isset($_SESSION['customerID']) || !$_SESSION['loggedIn']) {
            header("Location: login.php?error=" . urlencode("โปรดเข้าสู่ระบบก่อน")); 
            die();
        }

        if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
            header("Location: inventory.php?error=" . urlencode("ไม่พบภาพยนตร์")); 
            die();
        }

        $customerID = (int)$_SESSION['customerID'];
        $movieID = (int)$_GET['id'];
        
        //ตรวจสอบสิทธิ์การรับชม (ต้องเคยเช่าและยังไม่หมดอายุ)
        $authSql = "
            SELECT 
                m.movieName, 
                m.movieVideoURL, 
                m.moviePosterURL,
                r.rentalID,
                COALESCE(cust_rating.stars, 0) AS customerRating
            FROM 
                rental_movie rm
            JOIN 
                rental r ON rm.rentalID = r.rentalID
            JOIN 
                movie m ON rm.movieID = m.movieID
            LEFT JOIN
                rating cust_rating ON r.rentalID = cust_rating.rentalID AND m.movieID = cust_rating.movieID
            WHERE 
                r.customerID = {$customerID} 
                AND m.movieID = {$movieID} 
                AND r.expireDate >= NOW()
            ORDER BY r.expireDate DESC
            LIMIT 1";

        $authResult = mysqli_query($connect, $authSql);
        
        if (mysqli_num_rows($authResult) === 0) {
            header("Location: inventory.php?error=" . urlencode("ภาพยนตร์นี้หมดอายุการรับชมแล้ว หรือคุณไม่ได้รับสิทธิ์")); 
            die();
        }

        $movieData = mysqli_fetch_assoc($authResult);
        $movieName = htmlspecialchars($movieData['movieName']);
        $videoURL = htmlspecialchars($movieData['movieVideoURL']);
        $defaultVideo = "VIDEO/movie1.mp4";

        if (empty($videoURL)) {
            $videoURL = $defaultVideo;
        }
        else if(!file_exists($videoURL)){
            $videoURL = $defaultVideo;
        }

        $customerRating = (int)$movieData['customerRating'];
        $recommendations = [];
        $recSql = "
            SELECT movieID, moviePosterURL, movieName
            FROM movie 
            WHERE movieID != {$movieID} 
            ORDER BY RAND() 
            LIMIT 5";
        
        $recResult = mysqli_query($connect, $recSql);
        
        if ($recResult) {
            while ($recRow = mysqli_fetch_assoc($recResult)) {
                $recommendations[] = $recRow;
            }
        }
        
        while (count($recommendations) < 5) {
            $recommendations[] = [
                "movieID" => 0, 
                "moviePosterURL" => "POSTER/default_poster.png",
                "movieName" => "More soon"
            ];
        }

        $fullStars = $customerRating;
        $emptyStars = 5 - $customerRating;
    ?>

    <main class="watchmoviewrapper">
        <div class="watchmovieheader">
            <h2 class="watchtitle"><?php echo $movieName; ?></h2>
            <a href="inventory.php" class="backtoinventory_linkheader">
                <button class="backtoinventory_buttonheader">ย้อนกลับไป Inventory</button>
            </a>
        </div>
        <div class="videoplayercontainer">
            <video class="movieplayer" controls controlslist="nodownload">
                <source src="<?php echo $videoURL; ?>" type="video/mp4"> เบราว์เซอร์ของคุณไม่รองรับการเล่นวิดีโอ
            </video>
        </div>

        <section class="detailssection">
            <h3 class="ratingscore">ให้คะแนนเรื่องนี้</h3>
            <form class="ratingswrap" method="POST" action="process-ratemovie.php">
                <input type="hidden" name="movie_id" value="<?php echo $movieID; ?>">
                <input type="hidden" name="rental_id" value="<?php echo $movieData['rentalID']; ?>">
                
                <div class="stargroup">
                    <?php for ($i = 1; $i <= 5; $i++): ?>
                        <button type="submit" name="rating_stars" value="<?php echo $i; ?>" class="ratingstarbutton">
                            <img 
                                class="imgstar" 
                                src="IMAGES/<?php echo ($i <= $fullStars) ? 'fullstar.png' : 'clearstar.png'; ?>" 
                                alt="<?php echo $i; ?> Star"
                                data-rating="<?php echo $i; ?>"
                            >
                        </button>
                    <?php endfor; ?>
                </div>
                <?php if ($fullStars > 0): ?>
                    <button type="submit" name="rating_stars" value="0" class="deleterating_btn">ยกเลิกการให้คะแนน</button>
                <?php else: ?>
                    <p class="unratedtext">ยังไม่ได้ให้คะแนน</p>
                <?php endif; ?>
            </form>

            <h3 class="rectext">ภาพยนตร์แนะนำ</h3>
            
            <div class="recmoviecardwrapper">
                <?php foreach ($recommendations as $rec): ?>
                    <?php 
                        $recMovieID = (int)$rec['movieID'];
                        $recLink = $recMovieID > 0 ? "moviedetail.php?id=" . $recMovieID : "#"; 
                    ?>
                    <div class="recmoviecard">
                        <a href="<?php echo $recLink; ?>">
                            <img 
                                class="moviepicture" 
                                src="<?php echo htmlspecialchars($rec['moviePosterURL']); ?>" 
                                alt="<?php echo htmlspecialchars($rec['movieName']); ?>"
                            >
                            <p class="movietitle"><?php echo htmlspecialchars($rec['movieName']); ?></p>
                        </a>
                    </div>
                <?php endforeach; ?>
            </div>
        </section>
    </main>
</body>
</html>