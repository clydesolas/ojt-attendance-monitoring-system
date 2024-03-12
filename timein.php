<!DOCTYPE html>
<html lang = "en">
	<head>
		<meta charset="utf-8">
  		<meta content="width=device-width, initial-scale=1.0" name="viewport">
		<title>ATTENDANCE RECORD SYSTEM</title>
		<?php include('header.php') ?>
		<link rel="stylesheet" href="font.css">
		<link rel="stylesheet" href="texts.css">
		<link rel="stylesheet" href="asset/bootstrap-5.3.3-dist/css/bootstrap.css">
		<link rel="stylesheet" href="asset/bootstrap-5.3.3-dist/css/bootstrap.min.css">
		
	</head>

	<!--CSS STARTS HERE-->
	<style>
		.main{
			padding-top: 50px;
			padding-bottom: 50px;
		}
		.banner{
			height: 100px;
			width: 100%;
			background-color: #258942;
			background-repeat: no-repeat;
			background-size: cover;
			background-position: center;
		}
		.card-body{
			border-style: solid;
		}
		.footer{
			height:40px	;
			position: fixed;
			left: 0;
			padding-left:10px;
			bottom: 0;
			width: 100%;	
			background-color: #258942;
		}
		.form{
			padding-bottom: 50px;
		}
		.attendance_log_form{
			padding-bottom: 50px;
		}

		.container-fluid{
			margin-top: 50px;
		}
		
		.navbar-brand{
			color:white;
		}

	</style>

	<!--HTML STARTS HERE -->
	<body>
		<!--HEADER SECTION-->
		<div class="banner">
		<div class="w3-center" style="padding-top:30px;">
    <span id= "asdasd"class="w3-text-white w3-hide-small" style="font-size:35px">Intern Attendance Monitoring System</span>
		</div>
		</div>

			

		<!--MAIN CONTENT SECTION-->
		<div class="main">
			<div class = "container-fluid">

			

			<div class="attendance_log_field">
			
				<div class="col-md-4 offset-md-4">

				<div class="card" style="margin: 30px 40px;">
						<btn class="btn btn-outline-success">
							<center><a class="fs-5 text-decoration-none text-success" href="newattendance.php">View Attendance</a></center>
						</btn>
					</div>
				
					<div class="card">
						<div class="card-body">

							<div class="text-center">
								<h4><?php echo date('F d,Y') ?> <span id="now"></span></h4>
							</div>

							<div class="col-md">
								<div class="text-center mb-4" id="log_display">
									
								</div>
									<form action="" id="att-log-frm" >
										<div class="form-group">
											<label for="eno" class="control-label">Enter your Student ID Number</label>
											<input type="text" id="eno" name="eno" class="form-control col-sm-12">
										</div>
										<center>
											<button type="button" class="btn btn-outline-success log_now" data-id="1">Time in</button>
										</center>
										<br>	
										<center>
											<button type="button" class="btn btn-outline-danger log_now" data-id="4">Time out</button>
										</center>
										<div class="loading" style="display: none"><center>Please wait...</center></div>
									</form>
							</div>
						</div>						
					</div>

					

				</div>
			</div>
		</div>
		</div>

		<!--FOOTER SECTION -->
		
		<footer>
			<div class = "footer">
				|
				<a class="navbar-brand fs-5 text-center" href="newattendance.php">View Attendance</a>
			</div>
		</footer>

	</body>
	<script src="asset/bootstrap-5.3.3-dist/js/bootstrap.js>"></script>
	<script src="asset/bootstrap-5.3.3-dist/js/bootstrap.min.js"></script>
		
	<!--JAVASCRIPT STARTS HERE-->
	<script>
    $(document).ready(function(){
        var timeInStatus = {}; // Object to track time-in status per student ID

        setInterval(function(){
            var time = new Date();
            var now = time.toLocaleString('en-US', { hour: 'numeric', minute: 'numeric', second: 'numeric', hour12: true });
            $('#now').html(now);
        }, 500);

        $('.log_now').each(function(){
            $(this).click(function(){
                var _this = $(this);
                var eno = $('[name="eno"]').val();

                if(_this.attr('data-id') === '4' && !timeInStatus[eno]) {
                    alert("You need to time in first.");
                    return; // Prevent further execution
                }

                if(_this.attr('data-id') === '1' && timeInStatus[eno]) {
                    alert("You are already timed in.");
                    return; // Prevent further execution
                }

                if(eno === ''){
                    alert("Please enter your student ID number");
                } else {
                    $('.log_now').hide();
                    $('.loading').show();
                    $.ajax({
                        url:'admin/time_log.php',
                        method:'POST',
                        data:{type:_this.attr('data-id'), eno:$('[name="eno"]').val()},
                        error: function(err) {
                            console.log(err);
                            $('.log_now').show();
                            $('.loading').hide();
                        },
                        success:function(resp){
                            if(typeof resp !== undefined){
                                resp = JSON.parse(resp);

                                if(resp.status === 1){
                                    if(_this.attr('data-id') === '1') {
                                        timeInStatus[eno] = true; // Update time-in status
                                    } else {
                                        timeInStatus[eno] = false; // Update time-in status
                                    }

                                    $('[name="eno"]').val('');
                                    $('#log_display').html(resp.msg);
                                    $('.log_now').show();
                                    $('.loading').hide();
                                    setTimeout(function(){
                                        $('#log_display').html('');
                                    }, 5000);
                                } else {
                                    alert(resp.msg);
                                    $('.log_now').show();
                                    $('.loading').hide();
                                }
                            }
                        }
                    });
                }
            });
        });
    });
</script>

	
</html>