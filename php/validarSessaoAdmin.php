<?php
	session_start();
	if(!isset($_SESSION['login']) || !isset($_SESSION['admin'])){
		header ("Location: ../no-session.php");
		exit;
	}
?>