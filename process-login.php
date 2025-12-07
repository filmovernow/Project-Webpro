<?php
session_start();
$open_connect = 1;
require('connect.php');

if(isset($_POST['username']) && isset($_POST['password'])){
    $username = htmlspecialchars(mysqli_real_escape_string($connect, $_POST['username']));
    $password = htmlspecialchars(mysqli_real_escape_string($connect, $_POST['password']));
    $query_check_account = "SELECT * FROM customer WHERE username = '$username'";
    $call_back_check_account = mysqli_query($connect, $query_check_account);
    if(mysqli_num_rows($call_back_check_account) == 1){
        $result_check_account = mysqli_fetch_assoc($call_back_check_account);
        $hash = $result_check_account['password'];
        if(password_verify($password, $hash)){
            $_SESSION['customerID'] = $result_check_account['customerID'];
            die(header('Location: landing.html'));
        }
        else{
            die(header('Location: login.php')); //รหัสผ่านไม่ถูกต้อง
        }

    }else{
        die(header('Location: login.php')); //ไม่มีชื่อนี้ในระบบ
    }

}else{
    die(header('Location: login.php')); //กรุณากรอกข้อมูล
}

?>