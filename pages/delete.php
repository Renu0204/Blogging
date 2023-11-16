<?php
require_once('middleware/auth.php') ;
$conn = new mysqli("localhost", "root", "", "blog");
$id=$_GET['id']; // post id

// Logged user 
$loggedUsername=$_SESSION['name'];
$userId=$conn
    ->query("select id from user where username='$loggedUsername' limit 1")
    ->fetch_assoc()['id'];
$post = "delete from post where id = $id and user_id = $userId";
$result=$conn->query($post);
header('location: '. $_SERVER['HTTP_REFERER']);
