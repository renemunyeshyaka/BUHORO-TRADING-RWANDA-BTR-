<?php
session_start();
$serv="localhost";  
$log="buhorotr_user";
$pass="User@2119";
$dbname="buhorotr_logistics";
$Time=gmdate("H:i:s");

$DBase=mysql_connect($serv,$log,$pass); mysql_select_db("buhorotr_logistics");
$conn = mysqli_connect("$serv", "$log", "$pass", "$dbname");

if(isset($_POST['submit_settings']))
		{
			$mail=$_POST['mail'];
			$web=$_POST['web'];
			$adde=$_POST['adde'];
			$country=$_POST['country'];
			$city=$_POST['city'];
			$pho1=$_POST['pho1'];
			$pho2=$_POST['pho2'];
			$tax=$_POST['tax'];
			$curre=$_POST['curre'];
			$parti=$_POST['parti'];
			$reco=$_POST['reco'];

	$doin=mysqli_query($conn, "UPDATE `company` SET `Email`='$mail', `Website`='$web', `Address`='$adde', `Country`='$country', `State`='$country', `City`='$city', `Phone1`='$pho1', `Phone2`='$pho2', `Tax`='$tax', `Currency`='$curre', `Participation`='$parti', `Company`='$reco'");
		}

$hed=mysql_query("SELECT *FROM company");
	$rd=mysql_fetch_assoc($hed);
		$web=$rd['Website'];
		$mail=$rd['Email'];
		$pho1=$rd['Phone1'];
		$pho2=$rd['Phone2'];
		$adde=$rd['Address'];
		$tax=$rd['Tax'];
		$country=$rd['Country'];
		$curre=$rd['Currency'];
		$city=$rd['City'];
		$parti=$rd['Participation'];
		$reco=$rd['Company'];
		$cna=$rd['Cname'];
		
$Date=gmdate("Y-m-d");
$Dati=gmdate("Y-m-d");
$loge=$_SESSION['Loge'];
$_SESSION['Web']=$web;
 $_SESSION['Cna']=$cna;
$pto=0;
?>
