<?php
// view_posts.php
session_start();
require_once "connect.php";

$query = "SELECT posts.id, users.username, posts.content, posts.created_at FROM posts
          JOIN users ON posts.user_id = users.id
          WHERE posts.is_public = 1
          ORDER BY posts.created_at DESC";

$result = $conn->query($query);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo "Username: " . $row["username"] . "<br>";
        echo "Content: " . $row["content"] . "<br>";
        echo "Created At: " . $row["created_at"] . "<br>";
        echo "<hr>";
    }
} else {
    echo "No public posts available.";
}

$result->close();
?>