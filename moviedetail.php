<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="CSS/navstyle.css">
    <link rel="stylesheet" href="CSS/moviedetailstyle.css">
    <script src="JS/navbar.js" defer></script>
    <title>MovieDetail</title>
</head>
<body>
    <?php 
        include "navbar.php";
        require('connect.php');

        $isLoggedIn = isset($_SESSION['customerID']) && $_SESSION['loggedIn'];

        if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
            die("ไม่พบ ID ภาพยนตร์ที่ระบุ");
        }
        $movieID = (int)mysqli_real_escape_string($connect, $_GET['id']);
        $movieSql = "SELECT movieName, movieDesc, moviePosterURL, rentalPrice FROM movie WHERE movieID = {$movieID}";
        $movieResult = mysqli_query($connect, $movieSql);

        if (mysqli_num_rows($movieResult) == 0) {
            die("ไม่พบภาพยนตร์ ID: {$movieID}");
        }

        $movieData = mysqli_fetch_assoc($movieResult);
        $ratingSql = "SELECT AVG(stars) AS average_rating, COUNT(ratingID) AS total_ratings 
                      FROM rating
                      WHERE movieID = {$movieID}";
        $ratingResult = mysqli_query($connect, $ratingSql);
        $ratingData = mysqli_fetch_assoc($ratingResult);
        $avgRating = $ratingData['average_rating'] ?? 0;
        $totalRatings = $ratingData['total_ratings'] ?? 0;
        
        $displayRating = number_format((float)$avgRating, 1, '.', '');
        $fullStars = floor($avgRating);
        $hasHalfStar = ($avgRating - $fullStars) >= 0.25 && ($avgRating - $fullStars) < 0.75;
        $emptyStars = 5 - $fullStars - ($hasHalfStar ? 1 : 0);

    ?>

<main class="container">
    <img class="moviepicture" src="<?php echo htmlspecialchars($movieData['moviePosterURL']); ?>" alt="<?php echo htmlspecialchars($movieData['movieName']); ?>">
    
    <div class="textcontainer">
        <p class="texttitle"><?php echo htmlspecialchars($movieData['movieName']); ?></p>

        <div class="moviedes">
            <p><strong>รายละเอียด:</strong></p>
            <p><?php echo nl2br(htmlspecialchars($movieData['movieDesc'])); ?></p>
        </div>
        
        <div class="ratingpricewrap">
            <div class="ratingstext">
                คะแนนเฉลี่ย: <?php echo $displayRating; ?>/5 
                <span class="totalratingscount">(จาก <?php echo $totalRatings; ?> รีวิว)</span>
            </div>
            
            <div class="ratingswrap">
                <?php for ($i = 0; $i < $fullStars; $i++): ?>
                    <img class="imgstar" src="IMAGES/fullstar.png" alt="Full Star">
                <?php endfor; 
                
                if ($hasHalfStar): ?>
                    <img class="imgstar" src="IMAGES/halfstar.png" alt="Half Star">
                <?php endif;

                for ($i = 0; $i < $emptyStars; $i++): ?>
                    <img class="imgstar" src="IMAGES/clearstar.png" alt="Empty Star">
                <?php endfor; ?>
            </div>

            <div class="priceandbutton">
                <p class="rentalprice">ราคาเช่า: <?php echo number_format($movieData['rentalPrice'], 2); ?> บาท</p>
                <?php if ($isLoggedIn): ?>
                    <form action="basket.php" method="post" style="display:inline;">
                        <input type="hidden" name="action" value="add">
                        <input type="hidden" name="movieID" value="<?php echo $movieID; ?>">
                        <button type="submit" class="addtocartbutton">เพิ่มไปยังตระกร้า</button>
                    </form>
                <?php else: ?>
                    <a href="login.php?redirect=moviedetail.php?id=<?php echo $movieID; ?>" class="loginbuttonlink">
                        <button class="addtocartbutton loginpromptbutton">โปรดเข้าสู่ระบบ</button>
                    </a>
                <?php endif; ?>
            </div>
        </div>
    </div>
</main>
</body>
</html>
<?php mysqli_close($connect); ?>