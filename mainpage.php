<!DOCTYPE html>
<html lang="en">
<?php 
session_start();
include('admin/db_connect.php');
ob_start();
ob_end_flush();
?>
<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>DCS FACULTY SCHEDULE</title>
	

<?php include('./header.php'); ?>
<?php 
if(isset($_SESSION['login_id']))
header("location:index.php");

?>

</head>

				<!------CSSS start here-------->
				<style>
					.header{
						height:180px;
						width: 100%;
						background-image: url('asset/banner.png'); 
						background-repeat: no-repeat;
						background-size: cover;
						background-position: center;
					}
					body{
						width: 100%;
						height: calc(100%);
						position:fixed;
						min-height: 100vh;
    					display: flex;
    					flex-direction: column;

					}
					#main{
						padding-top: 50px;
						padding-bottom: 50px;
						display:flex;
						align: top;
						justify-content: center;
					}
					.card-body
					{
						border-style: solid;
					}
					
					.footer{
						background-color: #92BFF3; 
						margin-top:auto;
						font:color white;
					}
					.a {
						color: white;
					}

					#textbox {
						display:flex; 
						flex-flow:row wrap;
						
					}

					.left {
						width: 33.33333%;
						text-align: left;
						padding: 0.25rem 0.5rem;
						font-size: .875rem;
						line-height: 1.5;
						border-radius: 0.2rem;
					}
					.center {
						width: 33.33333%;
						text-align: center;
						padding: 0.25rem 0.5rem;
						font-size: .875rem;
						line-height: 1.5;
						border-radius: 0.2rem;
					}
					.right {
						width: 33.33333%;
						text-align: right;
						padding: 0.25rem 0.5rem;
						font-size: .875rem;
						line-height: 1.5;
						border-radius: 0.2rem;
					}

					.col-md-4{
						margin-top:50px;
					
					}
					
				
					
				</style>
				<!---CSS END--->


				<!---HTML AND PHP HERE!--->
				
<body>

	<div class="header"> </div>
		

		<main id="main">
				<div id="login" class="col-md-4">
					<div class="card">
						<div class="card-body">
								
							<form id="login-form" >
							<h4><b>DCS FACULTY SCHEDULE</b></h4>
								<div class="form-group">
									<label for="id_no" class="control-label">Please enter Faculty ID No.</label>
									<input type="text" id="id_no" name="id_no" class="form-control">
								</div>
								<center>
									<button class="btn-sm btn-block btn-wave col-md-4 btn-primary">View Faculty Schedule</button>
								</center>
							</form>
							
							<form>
							<h4><b></b></h4>
								
								
							</form>

						</div>
					</div>
				</div>
		</main>

	
	<footer class = "footer">
	<nav class="navbar navbar-default">
		<div class="container-fluid">
			<a class="navbar-brand" href="login.php">Homepage</a>
		</div>
	</nav>
	</footer>
	
</body>




<!---JAVASCRIPT BELOW HERE--->
<script>
	$('#login-form').submit(function(e){
		e.preventDefault()
		$('#login-form button[type="button"]').attr('disabled',true).html('Logging in...');
		if($(this).find('.alert-danger').length > 0 )
			$(this).find('.alert-danger').remove();
		$.ajax({
			url:'admin/ajax.php?action=login_faculty',
			method:'POST',
			data:$(this).serialize(),
			error:err=>{
				console.log(err)
		$('#login-form button[type="button"]').removeAttr('disabled').html('Login');

			},
			success:function(resp){
				if(resp == 1){
					location.href ='index.php';
				}else{
					$('#login-form').prepend('<div class="alert alert-danger">ID Number is incorrect.</div>')
					$('#login-form button[type="button"]').removeAttr('disabled').html('Login');
				}
			}
		})
	})
</script>