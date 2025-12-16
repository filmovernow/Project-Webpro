<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="CSS/navstyle.css">
    <link rel="stylesheet" href="CSS/movieliststyle.css"> 
    <script src="JS/navbar.js" defer></script>
    <title>MovieList</title>
</head>
<body>
    <?php 
        include "navbar.php";
        require('connect.php');

        $searchTerm = '';
        $tagId = null;
        $sql = "SELECT m.movieName, m.movieID, m.moviePosterURL FROM movie m";
        $where = [];
        $orderBy = " ORDER BY m.movieName ASC";
        $needsJoin = false;

        if (isset($_GET['search'])) {
            $searchTerm = mysqli_real_escape_string($connect, trim($_GET['search']));
            if (!empty($searchTerm)) {
                $where[] = "m.movieName LIKE '%" . $searchTerm . "%'";
            }
        }
        
        if (isset($_GET['tagID']) && is_numeric($_GET['tagID'])) {
            $tagId = (int)mysqli_real_escape_string($connect, $_GET['tagID']);
            $needsJoin = true;
            $where[] = "mt.tagID = " . $tagId;
            
            $tagResult = mysqli_query($connect, "SELECT tag FROM tag WHERE tagID = {$tagId}");
            if ($tagRow = mysqli_fetch_assoc($tagResult)) {
                $tagName = htmlspecialchars($tagRow['tag']);
            } else {
                $tagName = "ไม่พบประเภท";
            }
        }
        
        if (isset($_GET['new'])) {
            $orderBy = " ORDER BY m.movieID DESC";
        }

        $limit = 24; 
        $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
        $page = max(1, $page);
        $countSql = "SELECT COUNT(DISTINCT m.movieID) AS total_rows FROM movie m";
        
        if ($needsJoin) {
            $countSql .= " JOIN movie_tag mt ON m.movieID = mt.movieID";
        }
        
        if (!empty($where)) {
            $countSql .= " WHERE " . implode(' AND ', $where);
        }
        
        $countResult = mysqli_query($connect, $countSql);
        $totalRows = mysqli_fetch_assoc($countResult)['total_rows'];
        $totalPages = ceil($totalRows / $limit);
        $page = min($page, $totalPages > 0 ? $totalPages : 1);
        $offset = ($page - 1) * $limit;

        if ($needsJoin) { 
            $sql .= " JOIN movie_tag mt ON m.movieID = mt.movieID";
        }
        
        if (!empty($where)) {
            $sql .= " WHERE " . implode(' AND ', $where);
        }
        
        $sql .= $orderBy;
        $sql .= " LIMIT {$limit} OFFSET {$offset}";
        $result = mysqli_query($connect, $sql);

        $startPage = max(1, $page - 2);
        $endPage = min($totalPages, $page + 2);

        function getPaginationUrl($pageNumber) {
            $params = $_GET;
            $params['page'] = $pageNumber;
            return 'movielist.php?' . http_build_query($params);
        }
    ?>

<main class="movielistcontainer">
    <?php if (!empty($searchTerm)): ?>
        <h2 class="title">ผลการค้นหาสำหรับ: <?php echo htmlspecialchars($searchTerm); ?></h2>
    <?php elseif (!is_null($tagId)): ?>
        <h2 class="title">ภาพยนตร์ประเภท: <?php echo $tagName; ?></h2> 
    <?php elseif (isset($_GET['new'])): ?>
        <h2 class="title">หนังใหม่ล่าสุด</h2> 
    <?php else: ?>
        <h2 class="title">ภาพยนตร์ทั้งหมด</h2>
    <?php endif; ?>

    <?php if ($totalPages > 1): ?>
        <div class="paginationwrapper toppagination"> 	
            <?php
            if ($page > 1): ?>
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

            <?php
            if ($page < $totalPages): ?>
                <a href="<?php echo getPaginationUrl($page + 1); ?>" class="arrow">></a>
            <?php else: ?>
                <span class="arrow disabled">></span> 
            <?php endif; ?>
        </div>
    <?php endif; ?>

    <div class="moviegrid">
        <?php if (mysqli_num_rows($result) > 0): ?>
            <?php while($row = mysqli_fetch_assoc($result)): ?>
                <div class="moviecard">
                    <a href="moviedetail.php?id=<?php echo $row['movieID']; ?>">
                        <img src="<?php echo htmlspecialchars($row['moviePosterURL']); ?>" alt="<?php echo htmlspecialchars($row['movieName']); ?>">
                        <h3><?php echo htmlspecialchars($row['movieName']); ?></h3>
                    </a>
                </div>
            <?php endwhile; ?>
        <?php else: ?>
            <p class="notfound">ขออภัย ไม่พบผลลัพธ์สำหรับการค้นหาของคุณ</p>
        <?php endif; ?>
    </div>

    <?php if ($totalPages > 1): ?>
        <div class="paginationwrapper bottompagination">
            <?php
            if ($page > 1): ?>
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

            <?php
            if ($page < $totalPages): ?>
                <a href="<?php echo getPaginationUrl($page + 1); ?>" class="arrow">></a>
            <?php else: ?>
                <span class="arrow disabled">></span> 
            <?php endif; ?>
        </div>
    <?php endif; ?>
</main>
</body>
</html>