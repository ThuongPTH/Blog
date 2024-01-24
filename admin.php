<?php
include('function.php');
include 'connect.php';

session_start();

// kiểm tra xem đã có session chưa, nếu như không có -> quay lại trang login
if ((string)$_SESSION['loged'] === '1') {
    $userId = $_SESSION['userId'];
    $user = get_user($userId, $conn);
    $username = $user["username"];
    echo "Welcome, $username!";
    $posts = get_post($userId, $conn);
} else die(header('Location: login.php'));

// dashboard.php
// session_start();
// if (!isset($_SESSION["user_id"])) {
//     header("Location: login.php");
//     exit();
// }

// $user_id = $_SESSION["user_id"];
// $username = $_SESSION["username"];
// $stars = $_SESSION["stars"];

// echo "Welcome, $username! Stars: $stars";
// 
?>

<!-- // if ($_SERVER['REQUEST_METHOD'] === 'POST') {
//     if ($_POST['action'] === 'add' && $_POST['mission'] != null) {
//         add_list($id, $_POST['mission'], $conn);
//         header('Location: admin.php');
//     }
// }

// if (isset($_GET['del'])) {
//     $stt = (int)$_GET['del'];
//     del_list($stt, $conn);
//     header('Location: admin.php');
// }

// if (isset($_GET['edit'])) {
//     $stt = (int)$_GET['edit'];
// }

// if (isset($_POST['action']) && $_POST['action'] === 'ok') {
//     $update = $_POST['edit'];
//     edit_list($update, $stt, $conn);
//     header('Location: admin.php');
// }
?> -->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=, initial-scale=1.0">
    <title>Xíu xiu blog</title>
</head>

<body>
    <div class="page">
        <div class="body">
            <h2>Xíu xiu Blog</h2>
            <a href="create_post.php">
                <button>Creat post</button>
            </a>
            <a href="view_profile.php?username=<?php echo $username?>">
                <button>My account</button>
            </a>
            <a href="transfer.php">
                <button>Transfer star</button>
            </a>
            <?php if(count($posts)<1): ?>
                <p> <?php echo"No public posts available."; ?> </p>
            <?php else: ?>
                <?php for($i=0; $i<count($posts); $i++): ?>
                    <h3> <?php echo $posts[$i]["title"]."<br>"; ?> </h3>
                    <p> <?php echo $posts[$i]["content"]."<br>"; ?> </p>
                    <p> 
                        <a href='view_profile.php?username=<?php echo $posts[$i]["username"] ?>'>
                            <?php echo $posts[$i]["username"]?>
                        </a>
                        <?php echo "  Created_at: ".$posts[$i]["created_at"]; ?> </p>
                <?php endfor; ?>
            <?php endif; ?>
            <a href="logout.php">
                <button>Logout</button>
            </a>
        </div>
    </div>
</body>
</html>