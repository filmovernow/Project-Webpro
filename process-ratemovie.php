<?php
session_start();
require('connect.php');

//ตรวจสอบการเข้าสู่ระบบและข้อมูล POST
if (!isset($_SESSION['customerID']) || !$_SESSION['loggedIn']) {
    header("Location: login.php?error=" . urlencode("โปรดเข้าสู่ระบบก่อน"));
    exit();
}

if (!$_SERVER['REQUEST_METHOD'] === 'POST' || !isset($_POST['movie_id'], $_POST['rental_id'], $_POST['rating_stars'])) {
    header("Location: inventory.php?error=" . urlencode("ข้อมูลการให้คะแนนไม่สมบูรณ์"));
    exit();
}

$customerID = (int)$_SESSION['customerID'];
$movieID = (int)$_POST['movie_id'];
$rentalID = (int)$_POST['rental_id'];
$ratingStars = (int)$_POST['rating_stars'];

if ($ratingStars < 0 || $ratingStars > 5) {
    header("Location: watchmovie.php?id={$movieID}&error=" . urlencode("คะแนนต้องอยู่ระหว่าง 1 ถึง 5"));
    exit();
}

//ป้องกันการส่ง POST ปลอม
$checkSql = "
    SELECT r.rentalID 
    FROM rental r
    JOIN rental_movie rm ON r.rentalID = rm.rentalID
    WHERE r.rentalID = {$rentalID} 
    AND rm.movieID = {$movieID}
    AND r.customerID = {$customerID}
    AND r.expireDate >= NOW()";

$checkResult = mysqli_query($connect, $checkSql);

if (mysqli_num_rows($checkResult) === 0) {
    header("Location: inventory.php?error=" . urlencode("สิทธิ์การให้คะแนนไม่ถูกต้องหรือหมดอายุแล้ว"));
    exit();
}

//ตรวจสอบว่าเคยให้คะแนนใน rentalID นี้ไปแล้วหรือยัง
$existingRatingSql = "SELECT ratingID FROM rating WHERE rentalID = {$rentalID} AND movieID = {$movieID}";
$existingResult = mysqli_query($connect, $existingRatingSql);

if (mysqli_num_rows($existingResult) > 0 && $ratingStars == 0) {
    $deleteSql = "DELETE FROM rating WHERE rentalID = {$rentalID} AND movieID = {$movieID}";
    $querySuccess = mysqli_query($connect, $deleteSql);
    $message = "ยกเลิกการให้คะแนนสำเร็จ";
}
else if (mysqli_num_rows($existingResult) > 0) {
    $updateSql = "UPDATE rating SET stars = {$ratingStars}, ratedDate = NOW() WHERE rentalID = {$rentalID} AND movieID = {$movieID}";
    $querySuccess = mysqli_query($connect, $updateSql);
    $message = "อัปเดตคะแนนสำเร็จ";
} else {
    $insertSql = "INSERT INTO rating (rentalID, movieID, stars, ratedDate) 
                  VALUES ({$rentalID}, {$movieID}, {$ratingStars}, NOW())";
    $querySuccess = mysqli_query($connect, $insertSql);
    $message = "บันทึกคะแนนสำเร็จ";
}

if ($querySuccess) {
    header("Location: watchmovie.php?id={$movieID}&success=" . urlencode($message));
    exit();
} else {
    $errorMsg = "เกิดข้อผิดพลาดในการบันทึกคะแนน: " . mysqli_error($connect);
    header("Location: watchmovie.php?id={$movieID}&error=" . urlencode($errorMsg));
    exit();
}

?>