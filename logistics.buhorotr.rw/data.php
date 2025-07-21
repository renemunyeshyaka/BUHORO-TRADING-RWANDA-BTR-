<?php
session_start();
	$cell = $_SESSION['excel'];
	$file = $_SESSION['filename'];
header("Content-Type: application/xls");
header("Content-Disposition: attachment; filename=$file");
header("Pragma: no-cache");
header("Expires: 0");
include"$cell";
?> 
