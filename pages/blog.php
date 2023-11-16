<!DOCTYPE html>
<html>
<?php

$connection = new mysqli("localhost", "root", "", "blog");
$id=$_GET['id'];
$sql="SELECT p.*, u.username FROM post p JOIN user u ON p.user_id=u.id WHERE p.id=$id";
$result=mysqli_query($connection,$sql);	
while($row=mysqli_fetch_array($result)){
$title=$row['title'];
$content=$row['content'];
$picture=$row['banner'];
$name=$row['username'];

}

?>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap/dist/css/bootstrap.min.css">
    <style type="text/css">
       
        .container {
          
            display: flex;
            justify-content: center;
            align-items: center;
            height: 110vh;
        }
        .card {
            box-shadow: 0 4px 10px 0 rgba(0, 0, 0, 0.6);
            text-align: center;
        }
    </style>
</head>
<body>
<div class="container">
    <div class="card text-dark  border-danger mb-3" style="width: 100%;">
        <img src="<?php echo $picture ?>" class="card-img-top" width="300" height="400" alt="Card image">
        <div class="card-body text-danger">
            <h5 class="card-title"><?php echo $title;?></h5>
            <p class="card-text"><?php echo $content;?></p>
            <p class="card-text">Author :   <?php echo $name?></p>
            <a href="?route=home" class="btn btn-primary">GoBack</a>
        </div>
    </div>
</div>
</body>
</html>
