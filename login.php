<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="CSS/loginstyle.css">
    <script src="" defer></script>
    <title>Login</title>
</head>

<body> 
    <body>
    <h1>เข้าสู่ระบบ</h1>
    <form action="process-login.php" method="POST">
        <div>
            <input name="username" type="text" placeholder="ชื่อผู้ใช้" required>
        </div>
        <div>
            <input name="password" type="password" placeholder="รหัสผ่าน" required>
        </div>
        <button type="submit">เข้าสู่ระบบ</button>
        <a href="register.php">สร้างบัญชีใหม่</a>
    </form>
</body>
</html>