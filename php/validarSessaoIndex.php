<?php
	session_start();
	if(isset($_SESSION['login']) && isset($_SESSION['admin'])){
		header ("Location: admin/index.php");
		exit;
    }
    else if (isset($_SESSION['login']) && !isset($_SESSION['admin'])){
        header ("Location: user/index.php");
        exit;
    }
?>