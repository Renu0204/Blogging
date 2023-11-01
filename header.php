<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container-fluid">
        <a class="navbar-brand" href="#">Navbar</a>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link active" href="home.php">Home</a>
                </li>
                <?php
                if(!isset($_SESSION['name'])&&!$_SESSION['name']){
                    echo '<li class="nav-item">
                    <a class="nav-link" href="login.php">Login</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/register.php">Register</a>
                </li>';
                }

                ?>

            </ul>
<?php
if(isset($_SESSION['name'])&&$_SESSION['name']){
    $name=$_SESSION['name'];
    echo "<button type='button' class='btn btn-success'>$name</button>";
    echo "<div><a href='submit.php?type=logout' class='btn btn-danger'>Logout</a></div>";
}

?>
        </div>
    </div>
</nav>