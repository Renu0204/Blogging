<?php
session_start();
$connection = new mysqli("localhost", "root", "", "blog");
if (isset($_POST['type']) && $_POST["type"] === "login") {
    login();
} elseif (isset($_POST['type']) && $_POST["type"] === "register") {
    register();
} elseif (isset($_POST['type']) && $_POST["type"] === "reset") {
    resetPassword();
} elseif (isset($_POST['type']) && $_POST["type"] === "password-reset") {
    updatePassword();
}
elseif (isset($_POST['type']) && $_POST["type"] === "write-post") {
    writePost();
}
elseif (isset($_GET['type']) && $_GET["type"] === "logout") {
    session_unset();
    header("location: login.php");
}

function register(): void
{
    global $connection;
    $error = [];
    $username = filter_var($_POST['username'], FILTER_SANITIZE_STRING);
    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
    $password = $_POST['password'];
    $confirmPassword = $_POST['cpassword'];

    if ($password !== $confirmPassword) {
        $error[] = "Password and confirm password do not match";
    }
    if (strlen($password) < 8) {
        $error[] = "Password must be of length 8";
    }
    if (!checkUniqueUsername($username)) {
        $error[] = "username already taken";
    }
    $hashed = md5($password);
    if (count($error) == 0) {
        try {
            $sql = "insert into user(username,email,password) values('$username','$email','$hashed')";
            $result = $connection->query($sql);
            if ($result) {
                header("Location: login.php");
            } else {
                $error[] = "unable to create your account ";
                $_SESSION['error'] = json_encode($error);
                header("Location: " . $_SERVER['HTTP_REFERER']);
            }
        } catch (Exception $e) {
            $error[] = "unable to create your account " . $e->getMessage();
            $_SESSION['error'] = json_encode($error);
            header("Location: " . $_SERVER['HTTP_REFERER']);
        }
    } else {
        $_SESSION['error'] = json_encode($error);
        header("Location: " . $_SERVER['HTTP_REFERER']);
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

function login(): void
{
    global $connection;
    $username = filter_var($_REQUEST['username'], FILTER_SANITIZE_STRING);
    $password = md5($_REQUEST['password']);
    $query = "select * from user where username='$username' and password='$password'";
    $result = $connection->query($query);
    if ($result->num_rows > 0) {
        $_SESSION['name'] = $username;
        header("location: index.php");
    } else {
        $_SESSION['error'] = json_encode(["Invalid Credentials"]);
        header("location: " . $_SERVER['HTTP_REFERER']);
    }
    return;
}

function resetPassword()
{
    global $connection;
    $email = filter_var($_REQUEST['email'], FILTER_VALIDATE_EMAIL);
    $query = "select * from user where email='$email'";
    $result = $connection->query($query);
    if ($result->num_rows > 0) {
        $token = sha1(microtime());
        $query = "insert into reset_token(email,token) values('$email','$token')";
        $result = $connection->query($query);
        $link = "/reset.php?token=$token";
        $_SESSION['error'] = json_encode(["Reset Link has Been Sent " . $link]);
        header("location: " . $_SERVER['HTTP_REFERER']);
    } else {
        $_SESSION['error'] = json_encode(["No User Found with this email"]);
        header("location: " . $_SERVER['HTTP_REFERER']);
    }

    return;
}

function updatePassword(): void
{
    global $connection;
    $email = filter_var($_REQUEST['token-email'], FILTER_VALIDATE_EMAIL);
    $password = md5($_REQUEST['password']);
    $query = "UPDATE user SET password='$password' WHERE email='$email'";
    var_dump($query);
    $result = $connection->query($query);
    header("location: login.php");
}

function writePost(){
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
}