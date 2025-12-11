<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="CSS/navstyle.css">
    <link rel="stylesheet" href="CSS/tagstyle.css">
    <script src="JS/navbar.js" defer></script>
    <script src="JS/tag.js" defer></script>
    <title>MovieTag</title>
</head>
<body>
    <?php include "navbar.php"; ?>

    <main>
        <h1>
            ประเภท
        </h1>
        <ul class="tagslist">
            <li class="tagitem" style="background-image: radial-gradient(circle at 20% 50%, rgb(150, 150, 0), rgb(200, 200, 0));">ตลก</li>
            <li class="tagitem" style="background-image: radial-gradient(circle at 20% 50%, teal, rgb(0, 160, 160));">สยองขวัญ</li>
            <li class="tagitem" style="background-image: radial-gradient(circle at 20% 50%, rgb(0, 0, 171), blue);">ดราม่า</li>
            <li class="tagitem" style="background-image: radial-gradient(circle at 20% 50%, purple, rgb(160, 0, 160));">แฟนตาซี</li>
            <li class="tagitem" style="background-image: radial-gradient(circle at 20% 50%, gray, rgb(160, 160, 160));">ไซไฟ</li>
            <li class="tagitem" style="background-image: radial-gradient(circle at 20% 50%, rgb(160, 0, 0), red);">แอคชั่น</li>
            <li class="tagitem" style="background-image: radial-gradient(circle at 20% 50%, rgb(160, 115, 0), orange);">ผจญภัย</li>
            <li class="tagitem" style="background-image: radial-gradient(circle at 20% 50%, rgb(160, 115, 120), pink);">โรแมนติก</li>
            <li class="tagitem" style="background-image: radial-gradient(circle at 20% 50%, green, rgb(115, 160, 0));">แอนิเมชัน</li>
        </ul>
    </main>
</body>
</html>