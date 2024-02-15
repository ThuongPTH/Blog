<?php
// transfer.php
session_start();
require_once "connect.php";
include ("function.php");

if ((string)$_SESSION['loged'] === '1') {
    $userId = $_SESSION['userId'];
    $user = get_user($userId, $conn);
    $trans = get_transfer($userId, $conn);
} else die(header('Location: login.php'));

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $receiver_username = (string)$_POST['receiver_username'];
    $receiver= get_username($receiver_username, $conn);
    if($receiver===NULL) die("Người dùng không tồn tại <a href='transfer.php'>Transfer again</a>");
    $receiver_id = $receiver['userId'];
    $stars = $_POST['stars'];
    if($stars <= $user['stars'] && $stars >=0){
        transfer($userId, $receiver_id, $stars, $conn);
    }
    else{
        die("Bạn không đủ sao để thực hiện giao dịch này");        
    }   

}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Transfer Stars</title>
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
    <h2>Transfer Stars</h2>
    <p>Số stars hiện có: <?php echo $user['stars'];?></p>
    <form action="transfer.php" method="post">
        <label for="receiver_username">Receiver username:</label>
        <input type="text" name="receiver_username" required>

        <label for="stars">Stars:</label>
        <input type="number" name="stars" required>

        <button type="submit">Transfer</button>
    </form>

    <h2>Transaction history</h2>
    <?php if(count($trans)<1): ?>
        <p> <?php echo"No transaction available."; ?> </p>
    <?php else: ?>
        <?php for($i=0; $i<count($trans); $i++): ?>
            <?php if($userId == $trans[$i]['sender_id']): ?>
                <?php $receiver = get_user($trans[$i]['receiver_id'], $conn); ?>
                <?php $receiver_username = $receiver['username']?>
                <p> <?php echo "-> Send: ".$trans[$i]['stars']." stars "." \t To: ".$receiver_username."\t At: ".$trans[$i]['created_at']; ?> </p>
            <?php else:?>
                <?php $sender = get_user($trans[$i]['sender_id'], $conn); ?>
                <?php $sender_username = $sender['username']?>
                <p> <?php echo "<- Receive: ".$trans[$i]['stars']." stars "." "."From: ".$sender_username." "."At: ".$trans[$i]['created_at']; ?> </p> 
                <?php endif; ?>
        <?php endfor; ?>
    <?php endif; ?>

</body>
</html>