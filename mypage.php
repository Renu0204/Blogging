<?php
require_once("middleware/auth.php");
$connection = new mysqli("localhost", "root", "", "blog");
$username = $_GET['id'];
$result = $connection->query("select * from user where username='$username'");
$user = $result->fetch_assoc();
$userId = $user['id'];
$latestPost = "SELECT banner,created_at AS Time,title,content FROM post WHERE user_id='$userId' ORDER BY created_at DESC limit 1";
$result = $connection->query($latestPost);
$blog = $result->fetch_assoc(); 
$totalPostCount = $connection
    ->query("SeLect count(user_id) as total from post Where user_id='$userId'")
    ->fetch_assoc()['total']; 
    $recent=$connection->query("SELECT id,title FROM post WHERE user_id='$userId' ORDER BY created_at DESC limit 5");
    
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
                            <img src="https://api.oyyi.xyz/v1/avatar"
                                 alt="Profile Image" class="img-fluid img-thumbnail mt-4 mb-2"
                                 style="width: 150px;height:100px; z-index: 1">
                        </div>
                        <div class="ms-3 d-flex" style="margin-top: 80px;">
<div> <h5><?php echo $user['username']; ?></h5>
                            <h5>Total Post :- <?php echo $totalPostCount ?></h5>
                            <h5>Last Post :- <?php echo $blog['Time'] ?></h5></div>
                           <div><a href="updateprofile.php?id=<?php echo $username; ?>" class="btn btn-primary">Update Profile</a></div>
                        </div>
                    </div>
                </div>
                <div class="card-body p-4 text-black">
                    <div class="card" style="width: 37rem;">
                        <p class="lead fw-normal mb-0">LAST POST</p>
                        <img src="<?php echo $blog['banner']; ?>" class="card-img-top" style="height:50vh;" alt="CJB">
                        <?php
                        echo '<div class="card-body">';
                       
                        echo '<h5 class="card-title">' . $blog['title'] . '</h5>';
                        echo '  <p class="card-text">' . substr($blog['content'], 0, 50) . '</p>';
                        echo '</div>'; ?>
                    </div>
                
                    <div class="d-flex justify-content-between align-items-center mb-4">
    <p class="lead fw-normal mb-0">Recent Posts Title</p>
</div>
<?php
while ($row = $recent->fetch_assoc()) {
    echo '<div class="card w-95">';
    echo '<div class="card-body">';
    echo '<h5 class="card-title">' . $row["title"] . '</h5>';
    echo '<div class="d-flex justify-content-between">';
    echo '<a href="edit.php?id=' . $row["id"] . '" class="btn btn-success">Edit</a>';
    echo '<a href="delete.php?id=' . $row["id"] . '" class="btn btn-danger">Delete</a>';
    echo '<a href="blog.php?id=' . $row['id'] . '" class="btn btn-primary">Read More</a>';

    echo  '</div>';
    echo '</div>';
    echo '</div>';
}
?>        
          
                </div>
            </div>
        </div>
    </div>
    </div>
</section>
</body>
</html>
