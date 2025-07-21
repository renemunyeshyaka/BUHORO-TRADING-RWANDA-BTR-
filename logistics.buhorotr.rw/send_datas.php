<?php
include'connection.php';
if($_POST)
{
	$numb=$_POST['numb'];
	$coun=preg_replace('/,/', '', $_POST['coun']);
$dot=mysqli_query($conn, "UPDATE `contribute` SET `Percent`='$coun' WHERE `Number`='$numb' LIMIT 1");
}
		?>