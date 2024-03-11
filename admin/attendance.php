<!DOCTYPE html>
<?php
	require_once 'auth.php';
?>
<html lang = "eng">
	<head>
		<title>Attendance List</title>
		<?php include('header.php'); ?>
	</head>

	<body>
	<?php include('navbar.php') ?>
		<div class = "container-fluid admin" >
			<div class = "alert alert-primary">Attendance List</div>
			<div class = "modal fade" id = "delete" tabindex = "-1" role = "dialog" aria-labelledby = "myModallabel">
			</div>
			<div class = "well col-lg-12">
				<table id="table" class="table table-bordered table-striped">
					<thead>
						<tr>
							<th class="text-center">Employee ID</th>
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
								$log = "TIME IN AM";
							}elseif($row['log_type'] ==2){
								$log = "TIME OUT AM";
							}
							elseif($row['log_type'] ==3){
								$log = "TIME IN PM";
							}elseif($row['log_type'] ==4){
								$log = "TIME OUT PM";
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