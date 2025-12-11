<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="CSS/registerstyle.css">
    <title>Login</title>
</head>
<body>
    <?php if(isset($_GET['error'])): ?>
        <div class="errorbox">
            <?= htmlspecialchars(urldecode($_GET['error'])) ?>
        </div>
    <?php endif; ?>

    <h1>สร้างบัญชีของคุณ</h1>
    <form action="process-register.php" method="POST">
        <div>
            <input name="username" type="text" placeholder="ชื่อผู้ใช้">
        </div>
        <div>
            <input name="email" type="email" placeholder="อีเมล">
        </div>
        <div>
            <input name="password1" type="password" placeholder="รหัสผ่านใหม่">
        </div>
        <div>
            <input name="password2" type="password" placeholder="ยืนยันรหัสผ่าน">
        </div>
        <button type="submit">สร้างบัญชี</button>
        <a href="login.php">เข้าสู่ระบบ</a>
    </form> 
</body>
</html>