<?php
// register.php
require_once "connect.php";
include 'function.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    //if ($_POST['action'] === 'login') die(header('Location:/login.php'));
    $username = (string)$_POST["username"];
    $password = (string)$_POST["password"];
    $password2 = (string)$_POST['password2'];
    $email = (string)$_POST['email'];
    if ($password != $password2) {
        die('Sai passwork! Đăng ký không thành công <a href = "/register.php"> Resiter again </a>');
    } else {
        if (get_username($username, $conn) === null) {
            add_data($username, $password, $email, $conn);
            die(header('Location:login.php'));
        } else die('Username đã tồn tại! Đăng ký không thành công <a href = "register.php"> Resiter again </a>');
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Xíu xiu blog</title>
</head>

<body>
    <h2>Đăng ký tài khoản để vô Blog</h2>
    <p>Nếu đã có tài khoản, ấn vô login để đăng nhập: 
        <a href="login.php"><button>Login</button></a>
    </p>
    <form action="" method="POST">
        Username:
        <br>
        <input type="text" name="username" placeholder="username" />
        <br>
        Email:
        <br>
        <input type="text" name="email" placeholder="example@mail.com" />
        <br>
        Password:
        <br>
        <input type="password" name="password" placeholder="******" />
        <br>
        Password again:
        <br>
        <input type="password" name="password2" placeholder="re-enter password" />
        <br>
        <br>
        <button type="submit" name="action" value="register">Register</button> &emsp;
    </form>
</body>

</html>
