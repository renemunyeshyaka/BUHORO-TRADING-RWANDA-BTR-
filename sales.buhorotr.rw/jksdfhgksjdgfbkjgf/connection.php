<?php
$serv="localhost";  
$log="buhorotr_user";
$pass="User@2119";
$dbname="buhorotr_sales";
$Time = gmdate('H:i:s', strtotime('+2 hours'));
$conn=mysql_connect($serv,$log,$pass); mysql_select_db($dbname);
$cons = mysqli_connect($serv,$log,$pass, $dbname);
$hed=mysql_query("SELECT *FROM company");
	$rd=mysql_fetch_assoc($hed);
		$web=$rd['Website'];
		$cna=$rd['Cname'];
		$adde=$rd['Address'];
		$mail=$rd['Email'];
		$pho1=$rd['Phone1'];
		$pho2=$rd['Phone2'];
		$bch=$rd['Branches'];
		$tax=$rd['TIN'];
		$city=$rd['City'];
		$country=$rd['Country'];
		$curre1=$rd['Currency'];
		$curre2=$rd['Currency'];
		$Receipt=$rd['Receipt'];
$Date = gmdate("Y-m-d");
$Dati = gmdate("Y-m-d");
session_start();
$loge=$_SESSION['Loge'];
$_SESSION['Web']=$web;
$_SESSION['Cna']=$cna;
$pto=0;
?>
