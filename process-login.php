<?php
    session_start();
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

        $query_account = "SELECT * FROM customer WHERE username = '$input' OR email = '$input'";
        $call_account = mysqli_query($connect, $query_account);
        if(mysqli_num_rows($call_account) == 1)
        {
            $result_account = mysqli_fetch_assoc($call_account);
            $hash = $result_account['password'];
            if(password_verify($password, $hash))
            {
                $_SESSION['customerID'] = $result_account['customerID'];
                $_SESSION['loggedIn'] = 1;
                header("Location: moviepage.php");
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