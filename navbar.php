<?php
    session_start();
?>

<nav class="navbar">
    <a href="landing.php"><img class="logo" src="IMAGES/logo.png" alt="LOGO"></a>

    <ul class="menu">
        <li><a href="moviepage.php">หน้าหลัก</a></li>
        <li><a href="tag.php">ประเภท</a></li>
    </ul>

    <form class="searcharea" action="movielist.php" method="GET">
        <input class="searchbar" type="text" placeholder="Search..." name="search">
        <button class="searchbtn" type="submit">
            <img class="search" src="IMAGES/search.png" alt="Search">
        </button>
        <div class="navspacer"></div>
    </form>

    <div class="profilewrapper">
        <img class="profile" src="IMAGES/profile.png" alt="PROFILE">

        <ul class="dropdown">
            <?php if (!empty($_SESSION['loggedIn'])): ?>
                <li><a href="basket.php">ตระกร้า</a></li>
                <li><a href="inventory.php">คลัง</a></li>
                <li><a href="logout.php">Logout</a></li>
            <?php else: ?>
                <li><a href="register.php">Register</a></li>
                <li><a href="login.php">Login</a></li>
            <?php endif; ?>
        </ul>
    </div>
</nav>
