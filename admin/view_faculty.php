<?php include 'db_connect.php' ?>
<?php
if(isset($_GET['id'])){
	$qry = $conn->query("SELECT *,concat(lastname,', ',firstname,' ',middlename) as name FROM faculty where id=".$_GET['id'])->fetch_array();
	foreach($qry as $k =>$v){
		$$k = $v;
	}
}

?>
<div class="container-fluid">
	<p>Name: <b style="padding-left:40px;"><?php echo ucwords($name) ?></b></p>
	<p>Gender: <b style="padding-left:27px;"><?php echo ucwords($gender) ?></b></p>
	<p>Email: <b style="padding-left:43px;"><?php echo $email ?></b></p>
	<p>Contact: <b style="padding-left:27px;"><?php echo $contact ?></b></p>
    <p>Gender: <b style="padding-left:30px;"><?php echo $gender ?></b></p><br>
    <p>Supervisor: <b style="padding-left:8px;"><?php echo $supervisor ?></b></p>
	<p>Academic Year: <b><?php echo $academic_year ?></b></p>
    <p>Semester: <b style="padding-left:15px;"><?php echo $semester ?></b></p>
    <p>Program Code: <b><?php echo $program_code ?></b></p>
	<hr class="divider">
</div>
<div class="modal-footer display">
	<div class="row">
		<div class="col-md-12">
			<button class="btn float-right btn-secondary" type="button" data-dismiss="modal">Close</button>
		</div>
	</div>
</div>
<style>
	p{
		margin:unset;
	}
	#uni_modal .modal-footer{
		display: none;
	}
	#uni_modal .modal-footer.display {
		display: block;
	}
</style>
<script>
	
</script>