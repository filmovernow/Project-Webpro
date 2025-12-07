<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="CSS/registerstyle.css">
    <script src="" defer></script>
    <title>Login</title>
</head>
<body>
    <h1>สร้างบัญชีของคุณ</h1>
    <form action="process-register.php" method="POST">
        <div>
            <input name="username" type="text" placeholder="ชื่อผู้ใช้" required>
        </div>
        <div>
            <input name="email" type="email" placeholder="อีเมล" required>
        </div>
        <div>
            <input name="password1" type="password" placeholder="รหัสผ่านใหม่" required>
        </div>
        <div>
            <input name="password2" type="password" placeholder="ยืนยันรหัสผ่าน" required>
        </div>
        <button type="submit">สร้างบัญชี</button>
        <a href="login.php">มีบัญชีแล้วใช่ไหม</a>
    </form> 
</body>
</html>