<?php
    session_start();
?>

<nav class="navbar">
    <a href="landing.php"><img class="logo" src="IMAGES/logo.png" alt="LOGO"></a>

    <ul class="menu">
        <li><a href="moviepage.php">Home</a></li>
        <li><a href="tag.php">Tags</a></li>
    </ul>

    <div class="searcharea">
        <input class="searchbar" type="text" placeholder="Search...">
        <button class="searchbtn">
            <img class="search" src="IMAGES/search.png" alt="Search">
        </button>
    </div>

    <div class="profile-wrapper">
        <img class="profile" src="IMAGES/profile.png" alt="PROFILE">

        <ul class="dropdown">
            <?php if (!empty($_SESSION['loggedIn'])): ?>
                <li><a href="basket.php">Basket</a></li>
                <li><a href="inventory.php">Inventory</a></li>
                <li><a href="logout.php">Logout</a></li>
            <?php else: ?>
                <li><a href="register.php">Register</a></li>
                <li><a href="login.php">Login</a></li>
            <?php endif; ?>
        </ul>
    </div>
</nav>
