<?php
$conn = new mysqli("localhost", "root", "", "blog");
$id=$_GET['id']; // post id
$sql="SELECT u.username From post p join user u on u.id=p.user_id WHERE p.id=$id; ";
// Logged user 
$loggedUsername=$_SESSION['username'];
$userId=$connection->query("select id from user where username='$loggedUsername' limit 1")->fetch_assoc()['id'];
$post = "delete from post where id = $id and user_id = $userId";
$result=$conn->query($sql);
header('location: $_server['HTTP_REFERER']');
?>
