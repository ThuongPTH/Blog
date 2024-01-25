<?php
session_start();
require_once "connect.php";
include "function.php";


if(isset($_SESSION['loged']) && (string)$_SESSION['loged'] === '1'){
    $username = $_SESSION['username'];
    $user = get_username($username, $conn);
    $password = $user['password'];
    $email = $user['email'];
}
else header('Location: login.php');

if(isset($_POST['save']) && $_POST['save']==='ok'){
    $new_username = $_POST['username'];
    $new_email = $_POST['email'];
    $password2 = $_POST['password'];
    if($new_email== null) $new_email=$email;
    if($new_username == null) $new_username=$username;
    if($password === md5($password2)){
        if (get_username($username, $conn) === null || $new_username === $username) {
            change_infor($username, $new_username, $new_email, $conn);
            die('Thay đổi thông tin thành công <a href = "admin.php"> Home </a>');
        } else die('Username đã tồn tại! Thay đổi thông tin không thành công <a href = "changeinfor.php"> Change again </a>');
    }
    else die('Sai Password! Thay đổi thông tin không thành công <a href = "changeinfor.php"> Change again </a>');
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Change Information</title>
</head>
<body>
    <div style="background-color:rgb(209, 191, 218); height:50px;">
        <nav class="navbar navbar-expand-sm bg-dark">
            <div class="container-fluid">
            <!-- Links -->
            <ul class="navbar-nav">
</br>
                <li class="nav-item">
                <a 
                    class="nav-link request()->is('/') ? 'active' : '' " 
                    href="admin.php">Home
                </a>
                </li>
            </ul>
            </div>      
        </nav>    
    </div>

    <h2>Change Information</h2>
    <form action="" method="POST">
        New Username:
        <br>
        <input type="text" name="username" placeholder="<?php echo $username;?>" />
        <br>
        New Email:
        <br>
        <input type="text" name="email" placeholder="<?php echo $email;?>" />
        <br>
        Recent Password:
<br>
        <input type="password" name="password" placeholder="******" />
</br>
</br>
        <button type="submit" name="save" value="ok">Save Changes</button>
    </form>
</body>
</html>