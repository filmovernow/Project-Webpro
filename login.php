<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="CSS/navstyle.css">
    <link rel="stylesheet" href="CSS/loginstyle.css">
    <script src="JS/navbar.js" defer></script>
    <title>Login</title>
</head>
<body>
    <?php include "navbar.php"; ?>

    <main>
        <?php if(isset($_GET['error'])): ?>
            <div class="errorbox">
                <?= htmlspecialchars(urldecode($_GET['error'])) ?>
            </div>
        <?php endif; ?>
        
        <?php if(isset($_GET['success'])): ?>
            <div class="successbox">
                <?= htmlspecialchars(urldecode($_GET['success'])) ?>
            </div>
        <?php endif; ?>

        <form action="process-login.php" method="POST">
            <h1>เข้าสู่ระบบ</h1>
            <div>
                <input name="username" type="text" placeholder="ชื่อผู้ใช้หรืออีเมล">
            </div>
            <div>
                <input name="password" type="password" placeholder="รหัสผ่าน">
            </div>
            <button class="submit" type="submit">เข้าสู่ระบบ</button>
            <a href="register.php">สร้างบัญชีใหม่</a>
        </form>
    </main>
</body>
</html>