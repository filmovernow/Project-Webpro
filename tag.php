<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="CSS/navstyle.css">
    <link rel="stylesheet" href="CSS/tagstyle.css">
    <script src="JS/navbar.js" defer></script>
    <title>MovieTag</title>
</head>
<body>
    <?php include "navbar.php"; ?>

    <main class="tagwrapper">
        <h2 class = "tagtitle">ประเภท</h2>
        <ul class="taglist">
            <a href="movielist.php?tagID=1"><li style="background-image: radial-gradient(circle at 20% 50%, rgb(150, 150, 0), rgb(200, 200, 0));">ตลก</li></a>
            <a href="movielist.php?tagID=2"><li style="background-image: radial-gradient(circle at 20% 50%, teal, rgb(0, 160, 160));">สยองขวัญ</li></a>
            <a href="movielist.php?tagID=3"><li style="background-image: radial-gradient(circle at 20% 50%, rgb(0, 0, 171), blue);">ดราม่า</li></a>
            <a href="movielist.php?tagID=4"><li style="background-image: radial-gradient(circle at 20% 50%, purple, rgb(160, 0, 160));">แฟนตาซี</li></a>
            <a href="movielist.php?tagID=5"><li style="background-image: radial-gradient(circle at 20% 50%, gray, rgb(160, 160, 160));">ไซไฟ</li></a>
            <a href="movielist.php?tagID=6"><li style="background-image: radial-gradient(circle at 20% 50%, rgb(160, 0, 0), red);">แอคชั่น</li></a>
            <a href="movielist.php?tagID=7"><li style="background-image: radial-gradient(circle at 20% 50%, rgb(160, 115, 0), orange);">ผจญภัย</li></a>
            <a href="movielist.php?tagID=8"><li style="background-image: radial-gradient(circle at 20% 50%, rgb(160, 115, 120), pink);">โรแมนติก</li></a>
            <a href="movielist.php?tagID=9"><li style="background-image: radial-gradient(circle at 20% 50%, green, rgb(115, 160, 0));">แอนิเมชัน</li></a>
        </ul>
    </main>
</body>
</html>