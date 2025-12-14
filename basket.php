<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="CSS/navstyle.css">
    <link rel="stylesheet" href="CSS/basketstyle.css">
    <script src="JS/navbar.js" defer></script>
    <title>Basket</title>
</head>
<body>
    <?php
        // Header เพื่อป้องกันการแคชและการส่ง POST ซ้ำเมื่อผู้ใช้กด Back
        header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
        header("Cache-Control: post-check=0, pre-check=0", false);
        header("Pragma: no-cache");
        include "navbar.php"; 
        require('connect.php');

        if (!isset($_SESSION['customerID']) || !$_SESSION['loggedIn']) {
            header("Location: login.php?error=" . urlencode("โปรดเข้าสู่ระบบก่อน")); 
            die();
        }

        if (!isset($_SESSION['cart'])) {
            $_SESSION['cart'] = [];
        }

        $message = '';
        $movieIDs_in_cart = array_column($_SESSION['cart'], 'movieID');

        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action'])) {
            $action = $_POST['action'];
            $movieID = isset($_POST['movieID']) ? (int)$_POST['movieID'] : 0;

            if ($action === 'add' && $movieID > 0) {
                if (!in_array($movieID, $movieIDs_in_cart)) {
                    
                    $customerID = (int)$_SESSION['customerID'];
                    $checkRentalSql = "
                        SELECT 
                            r.rentalID 
                        FROM 
                            rental r
                        JOIN 
                            rental_movie rm ON r.rentalID = rm.rentalID
                        WHERE 
                            r.customerID = {$customerID} 
                            AND rm.movieID = {$movieID} 
                            AND r.expireDate >= CURDATE()
                        LIMIT 1";
                    
                    $checkRentalResult = mysqli_query($connect, $checkRentalSql);
                    
                    if (mysqli_num_rows($checkRentalResult) > 0) {
                        //พบว่าลูกค้ามีสิทธิ์การรับชมที่ยังไม่หมดอายุ
                        $message = "ภาพยนตร์นี้มีอยู่ในคลังสินค้าของคุณแล้ว และยังไม่หมดอายุ";
                    } else {
                        //ถ้าไม่อยู่ในตะกร้าและไม่มีสิทธิ์เช่าเดิมที่ยังไม่หมดอายุ ให้ดำเนินการเพิ่มลงในตะกร้า
                        $movieSql = "SELECT movieName, movieDesc, moviePosterURL, rentalPrice FROM movie WHERE movieID = {$movieID}";
                        $movieResult = mysqli_query($connect, $movieSql);
                        if ($movieData = mysqli_fetch_assoc($movieResult)) {
                            
                            $purchaseDate = date('Y-m-d'); 
                            $expireDate = date('Y-m-d', strtotime('+7 days'));

                            $_SESSION['cart'][] = [
                                'movieID' => $movieID,
                                'movieName' => $movieData['movieName'],
                                'movieDesc' => $movieData['movieDesc'],
                                'moviePosterURL' => $movieData['moviePosterURL'],
                                'rentalPrice' => (float)$movieData['rentalPrice'],
                                'purchaseDate' => $purchaseDate,
                                'expireDate' => $expireDate,
                            ];
                            $message = "เพิ่ม '{$movieData['movieName']}' ลงในตะกร้าแล้ว";
                        } else {
                            $message = "ไม่พบภาพยนตร์ที่ต้องการเพิ่ม";
                        }
                    }
                } else {
                    $message = "ภาพยนตร์นี้อยู่ในตะกร้าแล้ว";
                }
            } 
            
            if ($action === 'remove' && $movieID > 0) {
                foreach ($_SESSION['cart'] as $key => $item) {
                    if ($item['movieID'] == $movieID) {
                        $removedName = $item['movieName'];
                        unset($_SESSION['cart'][$key]);
                        $_SESSION['cart'] = array_values($_SESSION['cart']);
                        $message = "ลบ '{$removedName}' ออกจากตะกร้าแล้ว";
                        break;
                    }
                }
            }
            
            header("Location: basket.php?msg=" . urlencode($message));
            exit();
        }

        if (isset($_GET['msg'])) {
            $message = htmlspecialchars($_GET['msg']);
        }

        $cartItems = $_SESSION['cart'];
        $customerID = $_SESSION['customerID'];
        $totalPrice = array_sum(array_column($cartItems, 'rentalPrice'));
        $_SESSION['totalPrice'] = $totalPrice;

        function formatThaiDate($date) {
            if (!$date) return '-';
            $timestamp = strtotime($date);
            return date("d/m/Y", $timestamp);
        }
    ?>

</body>
    <main class="basketwrapper">
        <div class="basketheader">
            <h2 class="baskettitle">ตะกร้าสินค้า</h2>
            <a href="moviepage.php" class="continueshopping_linkheader">
                <button class="continueshopping_buttonheader">หาภาพยนต์เพิ่มเติม</button>
            </a>
        </div>
        <?php if ($message): ?>
            <div class="messagebox"><?php echo $message; ?></div>
        <?php endif; ?>

        <div class="movielistcontainer">
            <?php 
            if (count($cartItems) > 0):
                foreach ($cartItems as $row): 
                    $movieID = htmlspecialchars($row['movieID']);
            ?>
                <div class="movieitem">
                    <img class="basketposter" 
                        src="<?php echo htmlspecialchars($row['moviePosterURL']); ?>" 
                        alt="<?php echo htmlspecialchars($row['movieName']); ?>">
                    
                    <div class="moviedetails">
                        <p class="movietitle"><?php echo htmlspecialchars($row['movieName']); ?></p>
                        <p class="moviedesc"><?php echo htmlspecialchars($row['movieDesc']); ?></p>
                        
                        <div class="datesdetail">
                            <p><strong>วันที่สั่งซื้อ:</strong> <?php echo formatThaiDate($row['purchaseDate']); ?></p>
                            <p><strong>วันหมดอายุ:</strong> <?php echo formatThaiDate($row['expireDate']); ?></p>
                        </div>
                    </div>

                    <div class="movieactions">
                        <div class="priceandremove">
                            <p class="rentalprice">฿<?php echo number_format($row['rentalPrice'], 2); ?></p>
                            
                            <form action="basket.php" method="post">
                                <input type="hidden" name="action" value="remove">
                                <input type="hidden" name="movieID" value="<?php echo $movieID; ?>">
                                <button type="submit" class="removebutton">ลบ</button>
                            </form>
                        </div>
                    </div>
                </div>
            <?php 
                endforeach; 
            ?>
            
            <div class="cartsummary">
                <p class="totaltext">รวมทั้งหมด (<?php echo count($cartItems); ?> รายการ):</p>
                <p class="totalprice">฿<?php echo number_format($totalPrice, 2); ?></p>
                <a href="payment.php" class="checkoutlink">
                    <button class="checkoutbutton" <?php echo count($cartItems) == 0 ? 'disabled' : ''; ?>>ดำเนินการชำระเงิน</button>
                </a>
            </div>
            <?php else: ?>
                <p class="nomovies">ไม่มีภาพยนตร์ในตะกร้าสินค้าของคุณ</p>
            <?php endif; ?>
        </div>
    </main>
</html>