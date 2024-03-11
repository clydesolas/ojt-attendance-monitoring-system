<!DOCTYPE html>
<html>
<head>
<title>DCS STUDENT HOMEPAGE</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="font.css">
<link rel="stylesheet" href="texts.css">

<style>
body, html {height: 100%}
body,h1,h2,h3,h4,h5,h6 {font-family: "Cambria", sans-serif}
.menu {display: none}
.bgimg {
  background-repeat: no-repeat;
  background-size: cover;
  background-image: url("kabsu.jpg");
  min-height: 90%;
}

.navbar {
  overflow: hidden;
  background-color: #333;
  position: fixed;
  bottom: 0;
  width: 100%;
}

.navbar a {
  float: left;
  display: block;
  color: #f2f2f2;
  text-align: center;
  padding: 14px 16px;
  text-decoration: none;
  font-size: 17px;
}

.navbar a:hover {
  background: #f1f1f1;
  color: black;
}

.navbar a.active {
  background-color: #04AA6D;
  color: white;
}

.main {
  padding: 16px;
  margin-bottom: 30px;
}
.footer{
height: 5%;
background: #489640;

}

.header{
height: 5%;
background: #489640;
}


</style>
</head>
<body>

<!-- Navbar (sit on top) -->
<div class="header">

</div>
  
<!-- Header with image -->
<header class="bgimg w3-display-container w3-grayscale-min" id="home">
  <div class="w3-display-middle w3-center">
    <span id= "asdasd"class="w3-text-black w3-hide-small" style="font-size:50px">Department of Computer Studies</span>
    <p><a href="studsearchindex.php" class="w3-button w3-xxlarge  w3-round-xxlarge w3-green" id="btns">Search Faculty ID</a></p>
    <p><a href="newattendance.php" class="w3-button w3-xxlarge  w3-round-xxlarge w3-green" id="btns">View Faculty Attendance</a></p>
    <p><a href="login.php" class="w3-button w3-xxlarge w3-round-xxlarge w3-green" id="btns">Go back to Homepage</a></p>
  </div>
  

  
</header>

<div class="footer">
</div>



</body>
</html>
