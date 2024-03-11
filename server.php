<?php
session_start();

// initializing variables
$username = "";
$yrsec    = "";
$errors = array(); 

// connect to the database
$db = mysqli_connect('localhost', 'root', '', 'scheduling_db');

// REGISTER USER
if (isset($_POST['reg_user'])) {
  // receive all input values from the form
  $username = mysqli_real_escape_string($db, $_POST['username']);
  $yrsec = mysqli_real_escape_string($db, $_POST['yrsec']);

  // form validation: ensure that the form is correctly filled ...
  // by adding (array_push()) corresponding error unto $errors array
  if (empty($username)) { array_push($errors, "Student ID is required"); }
  if (empty($yrsec)) { array_push($errors, "Year & Section is required"); }
  }

  // first check the database to make sure 
  // a user does not already exist with the same username
  $user_check_query = "SELECT * FROM students WHERE username='$username' LIMIT 1";
  $result = mysqli_query($db, $user_check_query);
  $user = mysqli_fetch_assoc($result);
  

  // If no errors occured
  if (count($errors) == 0) {
  	$password = md5($password_1);//encryption of password before saving in database

  	$query = "INSERT INTO students (username, yrsec) 
  			  VALUES('$username', '$yrsec')";
  	mysqli_query($db, $query);
  	$_SESSION['username'] = $username;
  	$_SESSION['success'] = "You are now logged in";
  	header('location: register.php');
  }

// ... 
// ... 

// LOGIN USER
if (isset($_POST['login_user'])) {
  $username = mysqli_real_escape_string($db, $_POST['username']);
  $password = mysqli_real_escape_string($db, $_POST['password']);

  if (empty($username)) {
  	array_push($errors, "Student ID is required");
  }

  if (count($errors) == 0) {
  	$password = md5($password);
  	$query = "SELECT * FROM students WHERE username='$username' AND password='$password'";
  	$results = mysqli_query($db, $query);
  	if (mysqli_num_rows($results) == 1) {
  	  $_SESSION['username'] = $username;
  	  $_SESSION['success'] = "You are now logged in";
  	  header('location: register.php');
  	}else {
  		array_push($errors, "Wrong student ID/password combination");
  	}
  }
}

?>