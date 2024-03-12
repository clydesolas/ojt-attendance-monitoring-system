<!DOCTYPE html>
<?php
	require_once 'newauth.php';
	require_once 'conn.php';
	require_once 'search.php';
?>
<html lang = "eng">
	<head>
		<title>Attendance List</title>
		<meta charset="UTF-8" name="viewport" content="width=device-width"/>
		<link rel="stylesheet" type="text/css" href="css/bootstrap.css"/>
	</head>
	
<style>
ul {
  list-style-type: none;
  margin: 0;
  padding: 0;
  overflow: hidden;
  background-color: green;
}

li {
  float: left;
}

li a {
  display: block;
  color: white;
  text-align: center;
  padding: 14px 16px;
  text-decoration: none;
}

li a:hover{
  background-color: green;
}

body{
	background-image: url('kabsu.jpg');
	background-repeat: no-repeat;
  	background-size: cover;
	width:100%;
	height: 100%;
}

h3 {
  text-align: center;
}
</style>

<navbar></navbar>
	
	<body>
			

		<div class = "container-fluid admin" >
			<div class = "alert alert-primary"><a href="timein.php"><b>Back to log-page</b></a><br></div>
			<h3>Attendance List</h3><br>
			<div class = "modal fade" id = "delete" tabindex = "-1" role = "dialog" aria-labelledby = "myModallabel">
			</div>
			<div class = "well col-lg-12" style="overflow-x:scroll; max-height: 600px;">
				<table id="table" class="table table-bordered table-striped">
					<thead>
						<tr>
							<th class="text-center">Studnent ID</th>
							<th class="text-center">Name</th>
							<th class="text-center">Date</th>
							<th class="text-center">Log Type</th>
							<th class="text-center">Time</th>
						</tr>
					</thead>
					<tbody>
					<?php
						$attendance_qry = $conn->query("SELECT a.*,concat(f.firstname,' ',f.middlename,' ',f.lastname) as name, f.id_no FROM `attendance` a inner join faculty f on f.id_no = a.employee_id ") or die(mysqli_error());
						while($row = $attendance_qry->fetch_array()){	
					?>	
						<tr>
							<td><?php echo $row['id_no']?></td>
							<td><?php echo htmlentities($row['name'])?></td>
							<td><?php echo date("F d, Y", strtotime($row['datetime_log']))?></td>
							<?php 
							if($row['log_type'] ==1){
								$log = "TIME IN";
							}elseif($row['log_type'] ==4){
								$log = "TIME OUT";
							}
							?>
							<td><?php echo $log ?></td>
							<td><?php echo date("h:i a", strtotime($row['datetime_log']))?></td>
						</tr>
					<?php
						}
					?>	
					</tbody>
				</table>
			<br />
			<br />	
			<br />	
			</div>
		</div>
		
	</body>
	<script type = "text/javascript">
		$(document).ready(function(){
			$('#table').DataTable();
		});
	</script>
	<script type = "text/javascript">
		$(document).ready(function(){
			$('.remove_log').click(function(){
				var id=$(this).attr('data-id');
				var _conf = confirm("Are you sure to delete this data ?");
				if(_conf == true){
					$.ajax({
						url:'delete_log.php?id='+id,
						error:err=>console.log(err),
						success:function(resp){
							if(typeof resp != undefined){
								resp = JSON.parse(resp)
								if(resp.status == 1){
									alert(resp.msg);
									location.reload()
								}
							}
						}
					})
				}
			});
		});
	</script>
</html>