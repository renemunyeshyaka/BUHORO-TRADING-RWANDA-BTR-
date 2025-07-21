<?php
session_start();
header("Content-Type: application/xls");
header("Content-Disposition: attachment; filename=filename.xls");
header("Pragma: no-cache");
header("Expires: 0");
	$cell = $_SESSION['excell'];
include"$cell";
?> 
