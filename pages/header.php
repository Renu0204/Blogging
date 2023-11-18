<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container-fluid">
        <a class="navbar-brand" href="#">Navbar</a>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
    <li class="nav-item">
        <a class="nav-link active" href="?route=home">Home</a>
    </li>
    <?php
    // Check if the user is not logged in (use !isset and !empty to check if 'name' is not set or empty)
    if (!isset($_SESSION['name']) || empty($_SESSION['name'])) {
        echo '<li class="nav-item">
            <a class="nav-link" href="?route=login">Login</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="?route=register">Register</a>
        </li>
        
        ';
    }else{
        echo ' <li class="nav-item">
        <form action="" method="post">
            <div class="d-flex">
            <input class="form-control mr-sm-2" type="search" placeholder="Search" name="username" aria-label="Search" required>
 <button type="submit" name="search" class="btn btn-danger">Search</button></div></form>

            </li>
            ';
    }
    ?>
   
</ul>

<?php
if(isset($_SESSION['name'])&&$_SESSION['name']){
    $name=$_SESSION['name'];
    echo "<button type='button' class='btn btn-success'>$name</button>";
    echo "<div><a href='?route=submit&type=logout' class='btn btn-danger'>Logout</a></div>";
}

?>
        </div>
    </div>
</nav>
<?php


if(isset($_POST['search'])){
    $name = $_POST['username'];
    header("location:?route=search&name=" . urlencode($name));
    exit();
}





?>