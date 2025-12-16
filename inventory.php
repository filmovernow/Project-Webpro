<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="CSS/navstyle.css">
    <link rel="stylesheet" href="CSS/inventorystyle.css">
    <script src="JS/navbar.js" defer></script>
    <title>Inventory</title>
</head>
<body>
    <?php
        include "navbar.php";
        require('connect.php');

        if (!isset($_SESSION['customerID']) || !$_SESSION['loggedIn']) {
            header("Location: login.php?error=" . urlencode("โปรดเข้าสู่ระบบก่อน")); 
            die();
        }

        $customerID = (int)$_SESSION['customerID'];

        function formatThaiDateTime($date) {
            if (!$date) return '-';
            $timestamp = strtotime($date);
            return date("d/m/Y", $timestamp);
        }

        $limit = 5;
        $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
        $page = max(1, $page);
        $countSql = "SELECT COUNT(rm.movieID) AS total_rows 
                     FROM rental_movie rm
                     JOIN rental r ON rm.rentalID = r.rentalID
                     WHERE r.customerID = {$customerID}
                     AND r.expireDate >= NOW()";
        
        $countResult = mysqli_query($connect, $countSql);
        $totalRows = mysqli_fetch_assoc($countResult)['total_rows'];
        $totalPages = ceil($totalRows / $limit);
        $page = min($page, $totalPages > 0 ? $totalPages : 1);
        $offset = ($page - 1) * $limit;
        $startPage = max(1, $page - 2);
        $endPage = min($totalPages, $page + 2);

        function getPaginationUrl($pageNumber) {
            $params = $_GET;
            $params['page'] = $pageNumber;
            return 'inventory.php?' . http_build_query($params); 
        }

        $sql = "
            SELECT 
                m.movieID,
                m.movieName, 
                m.movieDesc,
                m.moviePosterURL,
                r.rentalDate,
                r.expireDate,
                -- ดึงเรตติ้งที่ถูกต้องโดย Join ด้วยทั้ง rentalID และ movieID
                COALESCE(cust_rating.stars, 0) AS customerRating
            FROM 
                rental_movie rm
            JOIN 
                movie m ON rm.movieID = m.movieID
            JOIN 
                rental r ON rm.rentalID = r.rentalID
            LEFT JOIN 
                rating cust_rating ON r.rentalID = cust_rating.rentalID AND m.movieID = cust_rating.movieID
            WHERE 
                r.customerID = {$customerID}
                AND r.expireDate >= NOW()
            ORDER BY 
                r.rentalDate DESC
            LIMIT {$limit} OFFSET {$offset}";

        $result = mysqli_query($connect, $sql);
    ?>

    
    <main class="inventorywrapper">
        <h2 class="inventorytitle">คลังหนังของคุณ</h2>

        <?php if ($totalPages > 1): ?>
            <div class="paginationwrapper toppagination">
                <?php if ($page > 1): ?>
                    <a href="<?php echo getPaginationUrl($page - 1); ?>" class="arrow"><</a>
                <?php else: ?>
                    <span class="arrow disabled"><</span> 
                <?php endif; ?>

                <?php for ($i = $startPage; $i <= $endPage; $i++): ?>
                    <?php if ($i == $page): ?>
                        <span class="currentpage"><?php echo $i; ?></span>
                    <?php else: ?>
                        <a href="<?php echo getPaginationUrl($i); ?>"><?php echo $i; ?></a>
                    <?php endif; ?>
                <?php endfor; ?>

                <?php if ($page < $totalPages): ?>
                    <a href="<?php echo getPaginationUrl($page + 1); ?>" class="arrow">></a>
                <?php else: ?>
                    <span class="arrow disabled">></span> 
                <?php endif; ?>
            </div>
        <?php endif; ?>
        
        <div class="movielistcontainer">
            <?php 
            if (mysqli_num_rows($result) > 0):
                while ($row = mysqli_fetch_assoc($result)): 
                    $movieID = htmlspecialchars($row['movieID']);
                    $rating = (int)$row['customerRating'];
                    $fullStars = $rating;
                    $emptyStars = 5 - $rating;
            ?>
                <div class="movieitem">
                    <img class="inventoryposter" 
                          src="<?php echo htmlspecialchars($row['moviePosterURL']); ?>" 
                          alt="<?php echo htmlspecialchars($row['movieName']); ?>">
                    
                    <div class="moviedetails">
                        <p class="movietitle"><?php echo htmlspecialchars($row['movieName']); ?></p>
                        <p class="moviedesc"><?php echo htmlspecialchars($row['movieDesc']); ?></p>
                        
                        <div class="rentaldates">
                            <p><strong>วันที่เช่า:</strong> <?php echo formatThaiDateTime($row['rentalDate']); ?></p>
                            <p><strong>หมดอายุ:</strong> <?php echo formatThaiDateTime($row['expireDate']); ?></p>
                        </div>
                    </div>

                    <div class="movieactions">
                        
                        <div class="ratingdisplay">
                            <p class="ratingtext">Your rating</p>
                            <div class="ratingstars">
                                <?php if ($fullStars == 0): ?>
                                    <span class="unratedtext">ยังไม่ได้ให้คะแนน</span>
                                <?php else: ?>
                                    <?php for ($i = 0; $i < $fullStars; $i++): ?>
                                        <img src="IMAGES/fullstar.png" alt="Full Star" class="staricon">
                                    <?php endfor; ?>
                                    <?php for ($i = 0; $i < $emptyStars; $i++): ?>
                                        <img src="IMAGES/clearstar.png" alt="Empty Star" class="staricon">
                                    <?php endfor; ?>
                                <?php endif; ?>
                            </div>
                        </div>
                        
                        <a href="watchmovie.php?id=<?php echo $movieID; ?>" class="playbuttonlink">
                            <button class="playbutton">▶</button>
                        </a>
                    </div>
                </div>
                
            <?php 
                endwhile; 
            else:
            ?>
                <p class="nomovies">ไม่พบภาพยนตร์ที่เช่าในคลังของคุณ</p>
            <?php
            endif;
            ?>
        </div>
        
        <?php if ($totalPages > 1): ?>
            <div class="paginationwrapper bottompagination">
                <?php if ($page > 1): ?>
                    <a href="<?php echo getPaginationUrl($page - 1); ?>" class="arrow"><</a>
                <?php else: ?>
                    <span class="arrow disabled"><</span> 
                <?php endif; ?>

                <?php for ($i = $startPage; $i <= $endPage; $i++): ?>
                    <?php if ($i == $page): ?>
                        <span class="currentpage"><?php echo $i; ?></span>
                    <?php else: ?>
                        <a href="<?php echo getPaginationUrl($i); ?>"><?php echo $i; ?></a>
                    <?php endif; ?>
                <?php endfor; ?>

                <?php if ($page < $totalPages): ?>
                    <a href="<?php echo getPaginationUrl($page + 1); ?>" class="arrow">></a>
                <?php else: ?>
                    <span class="arrow disabled">></span> 
                <?php endif; ?>
            </div>
        <?php endif; ?>
    </main>
</body>
</html>