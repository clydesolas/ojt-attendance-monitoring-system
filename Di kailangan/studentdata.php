<!DOCTYPE html>
<html>
<head>
  <title>Store form data in .txt file</title>
</head>
<body>
<!DOCTYPE html>
<html>
<head>
  <title>Student Confirmation</title>
  <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
  <div class="header">
  	<h2>Student Information</h2>
  </div>
	 
  <form method="post" action="searchindex.php">
  <div class="input-group">
      <input type="text" name="aydi" placeholder="Student ID" required autocomplete="off">
  </div>
  <div class="input-group">
      <input type="text" name="seksyon" placeholder="Year & Section" required autocomplete="off">
  </div>
  <div class="input-group">
      <input type="text" name="email" placeholder="Cvsu Email" required autocomplete="off">
  </div>
  <div class="input-group">
  		<button type="submit" class="btn" name="submit" value="submit">Confirm</button>
  </div>
  </form>
</body>
</html>
<?php
if(isset($_POST['submit'])){
$aydi = "Student ID:".$_POST['aydi']."
";
$seksyon = "Year & Section:".$_POST['seksyon']."
";
$email = "Cvsu Email:".$_POST['email']."
";
$file=fopen("file.txt", "a");
fwrite($file, $aydi);
fwrite($file, $seksyon);
fwrite($file, $email);
fclose($file);
}
?>