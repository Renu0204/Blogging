<?php

session_start();
if(!isset($_SESSION['name'])){
    header('location:registration.php');
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Document</title>
</head>
<body>

    <?php include 'header.php'; ?>
<br>
<br>
<br>

   <a href="post.php"> <button type="button" class="btn btn-info">Click HERE TO CREATE YOUR BLOG</button></a>
   <br>
<br>
<br>


<?php include 'footer.php';?>
</body>
</html>