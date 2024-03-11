<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8" name="viewport" content="width=device-width"/>
		<link rel="stylesheet" type="text/css" href="css/bootstrap.css"/>
	</head>
<style>

body{
	background-image: url('kabsu.jpg');
	background-repeat: no-repeat;
  	background-size: cover;
}

</style>
<body>
	
	<div class="col-md-3"></div>
	<div class="col-md-6 well">
		<h3 class="text-primary">Search Faculty NAME</h3>
		<hr style="border-top:1px dotted #ccc;"/>
		<a href="searchindex.php" class="btn btn-success">Back</a>
		<a href="login.php" class="btn btn-success">View Faculty Schedule</a>
		<?php
			require 'conn.php';
			if(ISSET($_REQUEST['id'])){
				$query = mysqli_query($conn, "SELECT * FROM `blog` WHERE `blog_id` = '$_REQUEST[id]'") or die(mysqli_error());
				$fetch = mysqli_fetch_array($query);
		?>
				<h3><?php echo $fetch['title']?></h3>
				<p><?php echo nl2br($fetch['content'])?></p>
		<?php
			}
		?>
		
	</div>
</body>
</html>