<?php
session_start();
if(!isset($_SESSION['name'])){
    header("Location:login.php");
}
$connection = new mysqli("localhost", "root", "", "blog");
$name=$_GET['id'];
$sqlid="SELECT user_id FROM post p JOIN user u on u.id=p.user_id WHERE u.username='$name'";
$resultid=mysqli_query($connection,$sqlid);
$fetch=mysqli_fetch_assoc($resultid);
$id=$fetch['user_id'];
$connection = new mysqli("localhost", "root", "", "blog");
$sql="SELECT p.banner,p.created_at AS Time,p.title,p.content FROM post p WHERE p.user_id='$id' ORDER BY p.created_at DESC limit 1";
$conn=mysqli_query($connection,$sql);
while($row=mysqli_fetch_assoc($conn)){
    $banner=$row['banner'];
    $title=$row['title'];
    $content=$row['content'];
    $time=substr($row['Time'],0,10);     
}
$sql2="SELect Count(p.user_id) as total from post p  Where p.user_id='$id'";
$query2=mysqli_query($connection,$sql2);
while($row2=mysqli_fetch_assoc($query2)){
    $total=$row2['total'];
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PROFILE</title>
</head>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
<body>
<section class="h-100 gradient-custom-2">
  <div class="container py-5 h-100">
    <div class="row d-flex justify-content-center align-items-center h-100">
      <div class="col col-lg-9 col-xl-7">
        <div class="card">
          <div class="rounded-top text-white d-flex flex-row" style="background-color: #000; height:200px;">
            <div class="ms-4 mt-5 d-flex flex-column" style="width: 150px;">
              <img src="https://source.unsplash.com/random/?car"
                alt="Generic placeholder image" class="img-fluid img-thumbnail mt-4 mb-2"
                style="width: 150px;height:100px; z-index: 1">
            </div>
            <div class="ms-3" style="margin-top: 80px;">
              <h5><?php echo $name; ?></h5>
              <h5>Total Post :- <?php echo $total ?></h5>
              <h5>Last Post :- <?php echo $time ?></h5>
            </div>
          </div>
          </div>
          <div class="card-body p-4 text-black">
            <div class="card" style="width: 37rem;">
               <p class="lead fw-normal mb-0">LAST POST</p>
              <img src="<?php echo $banner; ?>" class="card-img-top" style="height:50vh;" alt="CJB">
              <?php
 echo '<div class="card-body">';
  echo '<h5 class="card-title">'.$title .'</h5>';
  echo '  <p class="card-text">'. $content.'</p>';
 echo  '</div>';?>
</div>
            <div class="d-flex justify-content-between align-items-center mb-4">
              <p class="lead fw-normal mb-0">Recent Posts Title</p>
            </div>
    <?php
    $sql2="SELECT p.Title,p.id from POST p WHere p.user_id='$id' ORDER BY p.created_at DESC LIMIT 5";
    $result2=mysqli_query($connection,$sql2);
    while($row2=mysqli_fetch_assoc($result2)){
      $Title=$row2['Title'];
      $postid=$row2['id'];
    ?>
      <div class="card">
        <div class="d-flex  justify-content-between">
<div> <a href="delete.php?id=<?php echo $postid; ?>"><button type="button" class="btn btn-danger">Delete</button></a></div>      
</div>
  <div class="card-body">
<p><?php  echo $Title; ?></p>
  </div>
</div>
       <?php }?>     
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
</body>
</html>