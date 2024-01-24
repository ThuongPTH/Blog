<?php
// view_profile.php
session_start();
require_once "connect.php";
include "function.php";


if((string)$_SESSION['loged'] === '1'){
    $username = $_GET['username'];
    $user = get_username($username, $conn);
    $stars = $user["stars"];
    $email = $user["email"];
}
else(header('Location: login.php'));
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Xíu xiu blog</title>
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
    <div class='body'>
        <h3><?php echo $username?> account</h3>
        <p> Username: <?php echo $username;?> </br> 
            Email: <?php echo $email;?> </br>
            Star: <?php echo $stars; ?>
        </p>
    <div>
</body>
</html>