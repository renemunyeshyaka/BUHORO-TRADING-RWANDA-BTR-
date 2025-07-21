<?php
$serv="localhost";  
$log="buhorotr_user";
$pass="User@2119";
$dbname="buhorotr_sales";
$Time = gmdate('H:i:s', strtotime('+2 hours'));
$conn=mysql_connect($serv,$log,$pass); mysql_select_db($dbname);
  $cons = mysqli_connect($serv,$log,$pass, $dbname);
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
			$bch=$_POST['bch'];
			$curre1=$_POST['curre1'];
			$curre2=$_POST['curre2'];
			$receipt=$_POST['receipt'];
			
			$temp = explode(".", $_FILES["logo"]["name"]);
			$type = end($temp);
			$size = $_FILES["logo"]["size"];
			$name = $_FILES["logo"]["name"];
	if($size > 0 AND $type == 'png' AND $name == 'logo.png'){
			    unlink("imgs/logo.png");

                $newfilename = $_FILES["logo"]["name"];
move_uploaded_file($_FILES["logo"]["tmp_name"], "imgs/" . $newfilename);
}

	$doin=mysql_query("UPDATE `company` SET `Email`='$mail', `Website`='$web', `Address`='$adde', `Country`='$country', `State`='$country', `City`='$city', `Phone1`='$pho1', `Phone2`='$pho2', `TIN`='$tax', `Branches`='$bch', `Currency`='$curre1', `Receipt`='$receipt'");
		}
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
