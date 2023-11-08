<?php 
$connection = new mysqli("localhost", "root", "", "blog");
require_once 'middleware/auth.php';

$id = $_GET['id'];
$name = $_SESSION['name'];
$sql = "SELECT * FROM post WHERE id=$id";
$result = $connection->query($sql);
$row = $result->fetch_assoc();
$uid = $connection->query("SELECT user_id AS uid FROM post JOIN user u ON u.id = post.user_id WHERE u.username='$name'");
$resultuid = $uid->fetch_assoc();
$uid = $resultuid['uid'];

if (isset($_POST['submit'])) {
    $title = filter_var($_POST['title'], FILTER_SANITIZE_STRING);
    $content = filter_var($_POST['content'], FILTER_SANITIZE_STRING);
  
    $update = "UPDATE `post` SET `title`='$title', `content`='$content' WHERE id=$id AND user_id=$uid";

    $res = $connection->query($update);
    if ($res) {
        header('location: '. $_SERVER['HTTP_REFERER']);
        exit;
    }
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

    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-4">
                <?php include 'error.php'; ?>
                <form action="" method="POST" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="title">Post Title</label>
                        <input type="text" class="form-control" id="title" value="<?php echo $row['title']; ?>" name="title" required>
                    </div>
                    <div class="form-group">
                        <label for="#">Write Your Blog Here</label>
                        <textarea class="form-control" id="#" name="content" rows="10"><?php echo $row['content']; ?></textarea>
                    </div>
                    <br>
                    <input type="text" value="write-post" name="type" hidden>
                    <button type="submit" name="submit" class="btn btn-primary  btn-block">UPDATE YOUR BLOG</button>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
 <!-- #region -->