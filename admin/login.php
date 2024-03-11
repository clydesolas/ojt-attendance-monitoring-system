<!DOCTYPE html>
<html lang="en">
<?php 
session_start();
include('./db_connect.php');
ob_start();
ob_end_flush();
?>
<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>IT DEPARTMENT SCHEDULING SYSTEM</title>
 	

<?php include('./header.php'); ?>
<?php 
if(isset($_SESSION['login_id']))
header("location:index.php?page=home");

?>

</head>

<!--CSS Start Here-->
<style>
	.header{
	height: 80px;
	background: #489640;
	}	

	#login-right{
		position: absolute;
		width:50%;
		align-items: center;
		top:35%;
		bottom:25%;
		left:34%;
		right:35%;
	}

	.footer{
		height: 80 px;
		position: fixed;
		left: 0;
		bottom: 0;
		width: 100%;
		text-align: center;
		background-color: #489640;
		
	}

	.text{
		opacity:0
	}

	.welcome{
		text-align: center;
		padding-top:5%;
		font-family: 'Brush Script MT', cursive;
		
	}
	.body{
		background: black;
	}
	
	.dcslogo{
		height:35%;
		position: fixed;
      	right: 0;
     	top: 50%;
     	transform: translateY(-50%);
		margin-right:5%;
	}

	.cvsu{
		height:40%;
		position: fixed;
      	left: 0;
     	top: 50%;
     	transform: translateY(-50%);
		margin-left:5%;
	}
</style>

<!--HTML/PHP Start here-->

<body>

  <div class= "header">

  </div>
  	
	<h2 class ="welcome">Welcome, Administrator! Please enter your credentials to access the system.</h2>	
  		<div id="login-right">
			
		  <img src="../asset/dcslogo.jpg" class="dcslogo">
		  <img src="../asset/cvsu.jpg" class="cvsu">


  			<div class="card col-md-8">
			
  				<div class="card-body">
  					
  					<form id="login-form" >
  						<div class="form-group">
  							<label for="username" class="control-label">Username</label>
  							<input type="text" id="username" name="username" required class="form-control">
  						</div>
  						<div class="form-group">
  							<label for="password" class="control-label">Password</label>
  							<input type="password" id="password" name="password" required class="form-control">
  						</div>
  						<center><button class="btn-sm btn-block btn-wave col-md-4 btn-primary">Login</button></center>
  					</form>
  				</div>
  			</div>
  		</div>
   


 

  <a href="#" class="back-to-top"><i class="icofont-simple-up"></i></a>

<div class="footer">
  <p class="text">Footer</p>
</div>

</body>

<!--Javascript start here -->

<script>
	$('#login-form').submit(function(e){
		e.preventDefault()
		$('#login-form button[type="button"]').attr('disabled',true).html('Logging in...');
		if($(this).find('.alert-danger').length > 0 )
			$(this).find('.alert-danger').remove();
		$.ajax({
			url:'ajax.php?action=login',
			method:'POST',
			data:$(this).serialize(),
			error:err=>{
				console.log(err)
		$('#login-form button[type="button"]').removeAttr('disabled').html('Login');

			},
			success:function(resp){
				if(resp == 1){
					location.href ='index.php?page=home';
				}else{
					$('#login-form').prepend('<div class="alert alert-danger">Username or password is incorrect.</div>')
					$('#login-form button[type="button"]').removeAttr('disabled').html('Login');
				}
			}
		})
	})
	
</script>	
</html>