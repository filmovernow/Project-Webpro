<?php

$open_connect = 1;
require('connect.php');

if(isset($_POST['username']) && isset($_POST['email']) 
    && isset($_POST['password1']) && isset($_POST['password2']))
{
    $username = htmlspecialchars(mysqli_real_escape_string($connect, $_POST['username']));
    $email = htmlspecialchars(mysqli_real_escape_string($connect, $_POST['email']));
    $password1 = htmlspecialchars(mysqli_real_escape_string($connect, $_POST['password1']));
    $password2 = htmlspecialchars(mysqli_real_escape_string($connect, $_POST['password2']));

    if(empty($username))
    {
        header("Location: register.php?error=" . urlencode("โปรดใส่ชื่อของคุณ"));
        die();
    }
    if(empty($email))
    {
        header("Location: register.php?error=" . urlencode("โปรดใส่อีเมลของคุณ"));
        die();
    }
    if(empty($password1))
    {
        header("Location: register.php?error=" . urlencode("โปรดใส่รหัสของคุณ"));
        die();
    }
    if(empty($password2))
    {
        header("Location: register.php?error=" . urlencode("โปรดยืนยันรหัสของคุณ"));
        die();
    }
    if($password1 != $password2)
    {
        header("Location: register.php?error=" . urlencode("รหัสทั้งสองต้องตรงกัน"));
        die();
    }
    else
    {
        $query_check_email_account = "SELECT email FROM customer WHERE email = '$email'";
        $query_check_username_account = "SELECT username FROM customer WHERE username = '$username'";
        $call_back_query_check_email_account = mysqli_query($connect, $query_check_email_account);
        $call_back_query_check_username_account = mysqli_query($connect, $query_check_username_account);
        if(mysqli_num_rows($call_back_query_check_email_account) > 0)
        {
            header("Location: register.php?error=" . urlencode("อีเมลนี้ถูกใช้งานแล้ว"));
            die();
        }
        elseif(mysqli_num_rows($call_back_query_check_username_account) > 0)
        {
            header("Location: register.php?error=" . urlencode("ชื่อผู้ใช้นี้ถูกใช้งานแล้ว"));
            die();
        }
        else
        {
            $algo = PASSWORD_ARGON2ID;
            $options = [
            'cost' => PASSWORD_ARGON2_DEFAULT_MEMORY_COST,
            'time_cost' => PASSWORD_ARGON2_DEFAULT_TIME_COST,
            'threads' => PASSWORD_ARGON2_DEFAULT_THREADS
            ];
            $password_account = password_hash($password1, $algo, $options); //นำรหัสผ่าน เข้ารหัสด้วยวิธี ARGON2ID
            $query_create_account = "INSERT INTO customer VALUES('', '$username', '$password_account', '$email')";
            $call_back_create_account = mysqli_query($connect, $query_create_account);
            if($call_back_create_account)
            {
                header("Location: login.php?success=" . urlencode("สร้างบัญชีสำเร็จ"));
                die();
            }
            else
            {
                header("Location: register.php?error= ". urlencode("เกิดข้อผิดพลาดในการสร้างบัญชี"));
                die();
            }
        }
    }
}
else
{
    header("Location: register.php?error=" . urlencode("มีคนเผลอเปลี่ยนชื่อตัวแปร เปลี่ยนให้ตรงกันด้วย"));
    die();
}

?>