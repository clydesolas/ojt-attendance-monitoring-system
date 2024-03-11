<?php include('server.php') ?>
<!DOCTYPE html>
<html>
<head>
  <title>Student ID Confirmation</title>
  <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
  <div class="header">
  	<h2>Student ID Confirmation</h2>
  </div>
	
  <form method="post" action="register.php">
  	<?php include('errors.php'); ?>
  	<div class="input-group">
  	  <label>Student ID</label>
  	  <input type="text" name="username" value="<?php echo $username; ?>">
  	</div>
  	<div class="input-group">
  	  <label>Year & Section</label>
  	  <input type="yrsec" name="yrsec" value="<?php echo $yrsec; ?>">
  	</div>
  	<div class="input-group">
  	  <button action="studhomepage.php" type="submit" class="btn" name="reg_user">Confirm</button>
  	</div>
  </form>
</body>
</html>