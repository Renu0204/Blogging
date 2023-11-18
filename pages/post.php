
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
            <?php include 'error.php'; ?>
            <form action="?route=submit" method="POST" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="picture">Profile Picture</label>
                    <input type="file" class="form-control" accept="image/*" id="picture" name="picture" required>
                </div>
                <div class="form-group">
                    <label for="title">Post Title</label>
                    <input type="text" class="form-control" id="title" name="title" required>
                </div>
                <div class="form-group">
                    <label for="#">Write Your Blog Here</label>
                    <textarea class="form-control" id="#" name="content" rows="10"></textarea>
                </div>
                <br>
                <input type="text" value="write-post" name="type" hidden>
                <button type="submit" name="submit" class="btn btn-primary  btn-block">POST YOUR BLOG</button>
            </form>
        </div>
    </div>
</div>
</form>

</body>
</html>