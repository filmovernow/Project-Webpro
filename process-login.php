<?php
session_start();
$open_connect = 1;
require('connect.php');

if(isset($_POST['username']) && isset($_POST['password']))
{
    $input = htmlspecialchars(mysqli_real_escape_string($connect, $_POST['username']));
    $password = htmlspecialchars(mysqli_real_escape_string($connect, $_POST['password']));

    if(empty($input))
    {
        header("Location: login.php?error=" . urlencode("โปรดกรอกชื่อผู้ใช้หรืออีเมล"));
        exit();
    }

    if(empty($password))
    {
        header("Location: login.php?error=" . urlencode("โปรดกรอกรหัสผ่าน"));
        exit();
    }

    $query_check_account = "SELECT * FROM customer WHERE username = '$input' OR email = '$input'";
    $call_back_check_account = mysqli_query($connect, $query_check_account);
    if(mysqli_num_rows($call_back_check_account) == 1)
    {
        $result_check_account = mysqli_fetch_assoc($call_back_check_account);
        $hash = $result_check_account['password'];
        if(password_verify($password, $hash))
        {
            $_SESSION['customerID'] = $result_check_account['customerID'];
            $_SESSION['loggedIn'] = 1;
            header("Location: landing.php");
            die();
        }
        else
        {
            header("Location: login.php?error=" . urlencode("รหัสผ่านไม่ถูกต้อง"));
            die();
        }

    }
    else
    {
        header("Location: login.php?error=" . urlencode("ชื่อผู้ใช้หรืออีเมลผิด"));
        die();
    }

}
else
{
    header("Location: login.php?error=" . urlencode("มีคนเผลอเปลี่ยนชื่อตัวแปร เปลี่ยนให้ตรงกันด้วย"));
    die();
}

?>