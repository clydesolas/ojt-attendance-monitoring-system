<?php
include 'db_connect.php';
	extract($_POST);
	$data= array();
	$qry = $conn->query("SELECT * from faculty where id_no ='$eno' ");
	if($qry->num_rows > 0){
		$emp = $qry->fetch_array();
		$save_log= $conn->query("INSERT INTO attendance (log_type,employee_id) values('$type','".$emp['id_no']."')");
		$employee = ucwords($emp['firstname'].' '.$emp['lastname']);
		if($type == 1){
			$log = '<b> time in </b>';
		}elseif($type == 4){
			$log = '<b> time out </b>';
		}
		if($save_log){
				$data['status'] = 1;
				$data['msg'] = $employee .', your '.$log.' has been recorded. <br/>' ;
			}
	}else{
		$data['status'] = 2;
		$data['msg'] = 'Unknown Employee Number';
	}
	echo json_encode($data);
	$conn->close();
?>
