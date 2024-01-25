<?php
// view_profile.php
session_start();
require_once "connect.php";
include "function.php";


if((string)$_SESSION['loged'] === '1'){
    if(isset($_GET['username'])){
        $username = $_GET['username'];
    }
    else $username = $_SESSION['username'];
    $user = get_username($username, $conn);
    $stars = $user["stars"];
    $email = $user["email"];
}
else header('Location: login.php');

if(isset($_POST['changepass']) && $_POST['changepass']==='ok'){
    $newpass = $_POST['newpass'];
    $password = $_POST['password'];
    if(md5($password)===$user['password']){
        change_pass($username, $newpass, $conn);     
    }
    header('Location: view_profile.php?username='.$username);
}
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
            Stars: <?php echo $stars; ?>
        </p>

        <div class = 'changeinfor'> 
            <?php if($username === $_SESSION['username']):?>
                 <a href='view_profile.php?action=changepass'>
                    <button>Change password</button> 
            </a>
                <a href='changeinfor.php'>
                    <button>Change infor</button> 
            </a>
            <?php endif?>
        </div>

        <div class = 'changepass'>
            <?php if(isset($_GET['action']) && $_GET['action'] === 'changepass'): ?>
                <form action="" method="POST">
            </br>
                Recent passord:
                    <input type="password" name="password" />
                New passord:
                    <input type="password" name="newpass" />
                    <button type="submit" name="changepass" value="ok"> ok </button>
                </form> 
            <?php endif ?>                  
    </div>
</body>
</html>