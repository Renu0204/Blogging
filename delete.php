<?php
$conn = new mysqli("localhost", "root", "", "blog");
$id=$_GET['id'];
$sql="SELECT u.username From post p join user u on u.id=p.user_id WHERE p.id=$id; ";
$result=mysqli_query($conn,$sql);
while($row=mysqli_fetch_assoc($result)){
$name=$row['username'];
}

$sql1= "DELETE FROM `post` WHERE id=$id";
$result1=$conn->query($sql1);
if($result1){
    header("Location:profile.php?id=$name");
}
?>