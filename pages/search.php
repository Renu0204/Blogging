<?php
$connection = new mysqli("localhost", "root", "", "blog");

if (isset($_GET['name'])) {
    $id = $_GET['name'];
    $sql = "SELECT * FROM USER WHERE USERNAME LIKE '%$id%'";
    $result = $connection->query($sql);

    if (mysqli_num_rows($result) > 0) {
        $message = "Results for username like '$id':";
    } else {
        $message = "Is naam ka koi nahi hai.";
    }
} else {
    $message = "Koi username toh do.";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Search Results</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container">
    <h3><?php echo $message; ?></h3>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Username</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if (isset($result)) {
                while ($row = mysqli_fetch_array($result)) {
                    echo "<tr>";
                    echo "<th>" . $row['id'] . "</th>";
                    echo "<td>" . $row['username'] . "</td>";
                    echo "</tr>";
                }
            }
            ?>
        </tbody>
    </table>
</div>
</body>
</html>
