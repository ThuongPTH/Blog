<?php
require_once "connect.php";

function add_post($title, $userId, $content, $is_public, $conn){
    $query = 'INSERT INTO posts (userId, title, content, is_public) VALUES (?, ?, ?, ?)';
    $exec = $conn->prepare($query);
    $exec->bind_param("issi", $userId, $title, $content, $is_public);
    $exec->execute();
    return $exec->affected_rows;
}

function add_data($username, $password, $email, $conn)
{
    $password = (string)md5($password);
    $query = 'insert into users(username, password, email) values (?, ?, ?)';
    $exec = $conn->prepare($query);
    $exec->bind_param('sss', $username, $password, $email);
    $exec->execute();
    return $exec->affected_rows;
};

function get_username($username, $conn)
{
    // $query = 'select * from users where username=?';
    // $exec = $conn->prepare($query);
    // $exec->bind_param('s', $username);
    // $exec->execute();
    // $result = $exec->get_result();
    // return $result->fetch_array(MYSQLI_ASSOC);
    $query = "select * from users where username = '$username'";
    $result = $conn->query($query);
    if ($result === false) {
        die('Error in executing the query: ' . $conn->error);
    } 
    return $result->fetch_array(MYSQLI_ASSOC);
}

function login($username, $password, $conn){
    $query = "SELECT * FROM users WHERE username = '$username' AND passsword=md5('$password')";
    $result = $conn->query($query);
    if($result){
        $row = $result->fetch_array(MYSQLI_ASSOC);
        if(isset($row['username'])) return true;
    }
    else die('Error in executing the query: ' . $conn->error);
}

function get_user($userId, $conn)
{
    $query = 'select * from users where userId=?';
    $exec = $conn->prepare($query);
    $exec->bind_param('s', $userId);
    $exec->execute();
    $result = $exec->get_result();
    return $result->fetch_array(MYSQLI_ASSOC);
}

function get_onlyusername($userId, $conn)
{
    $query = 'select username from users where userId=?';
    $exec = $conn->prepare($query);
    $exec->bind_param('s', $userId);
    $exec->execute();
    $result = $exec->get_result();
    return $result->fetch_array(MYSQLI_ASSOC);
}

function transfer($sender_id, $receiver_id, $stars, $conn){
    $query = "INSERT INTO transfers (sender_id, receiver_id, stars) VALUES (?, ?, ?)";
    $exec = $conn->prepare($query);
    $exec->bind_param("iii", $sender_id, $receiver_id, $stars);

    if ($exec->execute()) {
        // Update sender's stars
        $exec = $conn->prepare("UPDATE users SET stars = stars - ? WHERE userId = ?");
        $exec->bind_param("ii", $stars, $sender_id);
        $exec->execute();

        // Update receiver's stars
        $exec = $conn->prepare("UPDATE users SET stars = stars + ? WHERE userId = ?");
        $exec->bind_param("ii", $stars, $receiver_id);
        $exec->execute();
        $exec->close();
        die(header("Location: admin.php"));
    } else {
        die("Transfer failed");
    }
}

function get_transfer($userId, $conn)
{
    $query = "SELECT * FROM transfers
    WHERE sender_id=? OR receiver_id=? 
    ORDER BY created_at DESC";
    $exec = $conn->prepare($query);
    $exec->bind_param("ii", $userId, $userId);
    $exec->execute();
    $result = $exec->get_result();
    return $result->fetch_all(MYSQLI_ASSOC);
}

function get_post($userId, $conn)
{
    $query = "SELECT posts.postId, users.username, posts.content, posts.created_at, posts.title FROM posts 
    JOIN users ON posts.userId = users.userId 
    WHERE posts.is_public = 1 OR users.userId=?
    ORDER BY posts.created_at DESC";
    $exec = $conn->prepare($query);
    $exec->bind_param('i', $userId);
    $exec->execute();
    $result = $exec->get_result();
    return $result->fetch_all(MYSQLI_ASSOC);
}

function change_pass($username, $newpass, $conn)
{
    $newpass= (string)md5($newpass);
    $query = "UPDATE users SET password=? WHERE username=?";
    $exec = $conn->prepare($query);
    $exec->bind_param('ss',$newpass, $username);
    $exec->execute();
    return $exec->affected_rows;
}


function change_infor($username, $new_username, $new_email, $conn)
{
    $query = "UPDATE users SET username=?, email=? WHERE username=?";
    $exec = $conn->prepare($query);
    $exec->bind_param('sss',$new_username, $new_email, $username);
    $exec->execute();
    return $exec->affected_rows;
}