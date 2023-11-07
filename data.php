<?php
/*
   username varchar(50) not null unique,
    email varchar(50) not null unique,
    password varchar(32) not null,
*/

$connection = new mysqli("localhost", "root", "", "blog");

foreach ($fakeUser as $u) {
    $email = $u["email"];
    $username = $u["username"];
    $password = md5($u["password"]);
    $query = "insert into user (email,username,password) values ('$email','$username','$password')";
    $result = $connection->query($query);
    if ($result) {
        echo "Data inserted \n";
    }
}
/*
 user_id int not null, // 1 -> 100
    title varchar(255) not null, word 10
    content largetext not null,
    banner varchar(255) not null,
*/

$blogUrl = "https://api.oyyi.xyz/v1/fake/get?user_id=number,1,100&title=word,10&content=word,1000&count=500";
$fakeBlog  = json_decode(file_get_contents($blogUrl), true);
foreach ($fakeBlog as $blog){
    $title = $blog['title'];
    $content = $blog['content'];
    $user_id = $blog['user_id'];
    $banner = "banner\5.jpg";
    $query = "insert into post(user_id,title,content,banner) values($user_id,'$title','$content','$banner')";
    if($connection->query($query)){
        echo "Blog Inserted";
    }
}
?>
