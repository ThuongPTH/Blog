<?php
// create_post.php
include 'function.php';
require_once "connect.php";
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $content = $_POST["content"];
    $title = $_POST["title"];
    $is_public = isset($_POST["is_public"]) ? 1 : 0;
    $userId = $_SESSION['userId'];
    add_post($title, $userId, $content, $is_public, $conn);
    die(header("Location: admin.php"));
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Post</title>
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
    <h2>Create Post</h2>
    <form action="create_post.php" method="post">
        <label for="title">Title:</label> &emsp;
        <input type="text" name="title" required>
        </br>
        </br>
        <label for="content">Content:</label>
        <textarea name="content" rows="4" cols="50" required></textarea>

        <label for="is_public">Public:</label>
        <input type="checkbox" name="is_public">

        <button type="submit">Post</button>
    </form>
</body>
</html>