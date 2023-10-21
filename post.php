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
<body><?php include 'header.php'; ?>

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-4">
             <?php include 'error.php';?>
             <form action= ""method="POST" enctype="multipart/form-data">
    <div class="form-group">
               <label for="picture">Profile Picture</label>
               <input type="file" class="form-control" accept="image/*" id="picture" name="picture" required>
               </div>
    <div class="form-group">
               <label for="title">Post Title</label>
               <input type="text" class="form-control" id="title" name="title" required>
               </div>
    <div class="form-group">
               <label for="exampleFormControlTextarea1">Write Your Blog Here</label>
               <textarea class="form-control" id="exampleFormControlTextarea1" name="content" rows="10"></textarea>
               </div><br> 
           <button type="submit" name="submit" class="btn btn-primary  btn-block">POST YOUR BLOG</button>
       </form>
   </div>
</div>
</div>
</form>

</body>
</html>
<?php
$connection = new mysqli("localhost", "root", "", "blog");
$user=$_SESSION['name'];
$sql="SELECT `id` FROM `user` WHERE username='$user'";
$result=$connection->query($sql);

$row=mysqli_fetch_assoc($result);
$id=$row['id'];
if(isset($_POST['submit'])){
    $folder="banner/";
    $picture=$folder.basename($_FILES['picture']['name']);
    $title=filter_var($_POST['title'],FILTER_SANITIZE_STRING);
    $content=filter_var($_POST['content'],FILTER_SANITIZE_STRING);
    if($_FILES['picture']['size']<5*1024*1024){
        if(move_uploaded_file($_FILES['picture']['tmp_name'],$folder.basename($_FILES['picture']['name']))){
            $sql="INSERT INTO `post`( `user_id`, `title`, `content`, `banner`) VALUES ('$id','$title','$content','$picture')";
        $result=$connection->query($sql);
        if($result){
   header('Location:home.php');
        }else{
            $_SESSION['error'] = json_encode(["Invalid Credentials"]);
            header("location: post.php" );
        }
        }else{
            $_SESSION['error'] = json_encode(["File NOt Moved"]);
        header("location: post.php");
        }
    }else{
        $_SESSION['error'] = json_encode(["File Size greater Than 5mb"]);
        header("location: post.php");
    }
}

?>