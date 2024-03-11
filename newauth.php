<?php
	session_start();
	if(!isset($_SESSION['login_id'])){
	}
	require_once 'newdb_connect.php';
	$user_qry = $conn->query("SELECT * FROM attendance WHERE `id` ") or die(mysqli_error());
	$user = $user_qry->fetch_array();

?>