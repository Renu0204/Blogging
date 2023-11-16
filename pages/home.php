<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>BLOG Dashboard</title>
	 <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="fluid-container"> 
<div class="row">
	<div class="col-sm-12 form-container">
		<h1>BLOGS DASHBOARD</h1>
		<hr>
	<table class="table table-bordered border-success ">
		<tr>
			<th>No.</th>
			<th>Title</th>
			<th>Content</th>
			<th>Banner</th>
			<th>Created At</th>
		</tr>
		<?php

$connection = new mysqli("localhost", "root", "", "blog");
$sql="SELECT * FROM POST";
$result=$connection->query($sql);
while ($rows=mysqli_fetch_assoc($result)) {
	echo "<tr>";
echo "<td>".$rows['id']."</td>";
echo "<td>".$rows['title']."</td>";
echo "<td>".substr($rows['content'],0,50)."......."."<a href='?route=blog?id=$rows[id] ' class
='btn btn-danger'>READ MORE</a>"."</td>";
echo "<td><img src='".$rows['banner']."' alt='Image' height='100px' width='150px' borderradius='5px'></td>";
echo "<td>".$rows['created_at']."</td>";
echo "</tr>";
}

		?>
	</table>
	</div>
</div>
</div>
</body>
</html>