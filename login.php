<?php
// login.php
session_start();
require_once "connect.php";
include 'function.php';

// nếu người dùng có session rồi thì redirect sang trang login
if (isset($_SESSION['loged']) && $_SESSION['loged'] === 'true') die(header('Location: /admin.php'));

//
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    //if ($_POST['action'] === 'register') die(header('Location: /register.php'));
    $username = $_POST["username"];
    $password = $_POST["password"];

    // Lấy các column của user trong database
    $user = get_username($username, $conn);
    
    if($user['password'] === md5($password)){
        $_SESSION['loged'] = true;
        $_SESSION['userId'] = $user['userId'] ;
        die(header('Location: admin.php'));
    }
    else{
        die('Invalid username or password <a href = "login.php"> login again </a>');
    }

    // $stmt = $conn->prepare("SELECT id, username, stars FROM users WHERE username = ? AND password = ?");
    // $stmt->bind_param("ss", $username, $password);
    // $stmt->execute();
    // $stmt->bind_result($user_id, $username, $stars);

    // if ($stmt->fetch()) {
    //     $_SESSION["userId"] = $user_id;
    //     $_SESSION["username"] = $username;
    //     $_SESSION["stars"] = $stars;
    //     header("Location: dashboard.php");
    // } else {
    //     echo "Invalid username or password";
    // }

    // $stmt->close();
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <h2>Login</h2>
    <p>Nếu chưa có tài khoản, ấn vô đây để đăng ký: 
        <a href="register.php"><button>Register</button></a>
    </p>
    <form action="" method="POST">
        Username:
        <br>
        <input type="text" name="username" placeholder="username">
        <br>
        Password:
        <br>
        <input type="password" name="password" placeholder="*******">
        <br>
        <br>
        <button type="submit" name="action" value="login">Login</button>
    </form>
</body>

</html>