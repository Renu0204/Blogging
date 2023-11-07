<?php
$connection = new mysqli("localhost", "root", "", "blog");
require_once'middleware/auth.php';
$name=$_GET['id'];
$sql=$connection->query("SELECT * FROM user WHERE username='$name'");
$result=$sql->fetch_assoc();
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Update Your Profile</title>
</head>
<body>
<?php  include "header.php"; ?>
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">Update</div>
                <div class="card-body">
                    <?php include "error.php"; ?>
                    <form method="post" action="">
                        <div class="form-group mt-3">
                            <label for="username">Username</label>
                            <input type="text" value="<?php echo $result['username']; ?>" class="form-control" name="username" id="username" placeholder="Enter your username" required>
                        </div>
                        <div class="form-group mt-3">
                            <label for="email">Email</label>
                            <input type="email" value="<?php echo $result['email']; ?>"class="form-control" name="email" id="email" placeholder="Enter your email" required>
                        </div>
                        <input type="text" value="updateprofile" name="type" hidden>
                        <button type="submit" name="submit" class="btn btn-primary w-100 mt-5">Update</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?php include "footer.php"; ?>
</body>
</html>
<?php
$name=$_SESSION['name'];
$sqlid=$connection->query("SELECT `id`fROM `user` WHERE username='$name' ");
$resultid=$sqlid->fetch_assoc();
$userid=$resultid['id'];
if(isset($_POST["submit"]))
{
    $username = filter_var($_POST['username'], FILTER_SANITIZE_STRING);
    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL); 
    if (!checkUniqueUsername($username)) {
        $error[] = "username already taken";
        $_SESSION['error'] = json_encode($error);
    }
    $sql="UPDATE `user` SET `username`='$username',`email`='$email' WHERE username='$name' AND id='$userid'";
    $result=$connection->query($sql);
    if($result){
        header("Location:mypage.php?id=$username");
    }else{
        $error="Fail To update";
        $_SESSION["error"] = json_encode($error);
    }

}
function checkUniqueUsername($username): bool
{
    global $connection;
    $sql = "SELECT username FROM user where username= '$username'";
    $result = $connection->query($sql);
    if ($result->num_rows > 0) {
        return false;
    } else {
        return true;
    }
}
?>