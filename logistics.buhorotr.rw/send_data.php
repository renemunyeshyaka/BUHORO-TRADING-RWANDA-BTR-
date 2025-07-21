<?php
include'connection.php';
if($_POST)
{
	$ada=preg_replace('/,/', '', $_POST['ada']);
	$pad=$_POST['pad'];  // Reference
	$numb=$_POST['numb'];
	$pda=preg_replace('/,/', '', $_POST['pda']);
	$advas=$pad-$ada;
	$eid=$_POST['eid'];
	$mt=$_POST['mt'];
	$sala=preg_replace('/,/', '', $_POST['sala']);
	$coun=preg_replace('/,/', '', $_POST['coun']);

	$dots=mysqli_query($conn, "UPDATE `advance` SET `Balance`=`Balance`+'$advas' WHERE `Employee`='$eid' AND `Month`='$mt' ORDER BY `Number` DESC LIMIT 1000");

$then=mysqli_query($conn, "UPDATE `payrolls` SET `Salary`='$sala', `Counted`='$coun', `Advance`='$ada', `Payment`='$pda' WHERE `Number`='$numb' LIMIT 1");
}
		?>