<?php
include'connection.php';
if(!$_SESSION['Userid']){
	Header("location:index.php");
	exit();
}
 $fname=$_SESSION['Fname'];
 $lname=$_SESSION['Lname'];
 $userid=$_SESSION['Userid'];
 $unames=$_SESSION['Uname'];
	$cna=$_SESSION['Cna'];
	$buto='';

?>
<!DOCTYPE html>
<html class=""><head>
<meta http-equiv="content-type" content="text/html; charset=windows-1252">
    <title>   <?php echo $cna ?>    </title>
<script language="JavaScript" type="text/javascript">
	function printpage()
  {  
window.print();
  }
function closeWindow() {
setTimeout(function() {
window.close();
}, 200000);
}

window.onload = closeWindow();
</script>

<script type="text/javascript">
    // Specify the normal table row background color
    //   and the background color for when the mouse 
    //   hovers over the table row.

    var TableBackgroundNormalColor = "#ffffff";
    var TableBackgroundMouseoverColor = "#9999ff";

    // These two functions need no customization.
    function ChangeBackgroundColor(row) {
        row.style.backgroundColor = TableBackgroundMouseoverColor;
    }

    function RestoreBackgroundColor(row) {
        row.style.backgroundColor = TableBackgroundNormalColor;
    }
</script>

<style type="text/css">
@media print {
  .DONTPrint{ display:none }
  .DOCheck{ display:table}
			}
</style>

<!-- CSS goes in the document HEAD or added to your external stylesheet -->
<style type="text/css">
table.gridtable {
	font-family: verdana,arial,sans-serif;
	font-size:11px;
	color:#333333;
	border-width: 1px;
	border-color: #666666;
	border-collapse: collapse;
}
table.gridtable th {
	border-width: 1px;
	padding: 2px;
	border-style: solid;
	border-color: #666666;
	background-color: #dedede;
	height: 20px;
}
table.gridtable td {
	border-width: 1px;
	padding: 2px;
	border-style: solid;
	border-color: #666666;
	background-color: #ffffff;
}
table.gridtable tr:hover td { 
background-color: #dedede;
}
</style>


</head>
<body bgcolor="#COCOCO">
<center>
		<?php
		$loge=$_SESSION['Loge'];
		$hed=mysql_query("SELECT *FROM company");
			$rd=mysql_fetch_assoc($hed);{
				$N1x=$rd['Cname'];
				$N3x=$rd['Address'];
				$N5x=$rd['TIN'];
				$N6x=$rd['Phone1'];
				$N7x=$rd['Phone2'];
				$N8x=$rd['Email'];
				$N9x=$rd['Email'];
				$N10x=$rd['Website'];
				$Date=$rd['Date'];
			}

echo"<table width='94%' BORDER='0'><tr><td width='1%'></th><td width='10%'><IMG SRC='imgs/logo.png' WIDTH='140' HEIGHT='90' BORDER='0'> </td>
	<td style='padding-left:10px' colspan='5'>
	<div align='left'>&nbsp;&nbsp;<b> $N1x </b><br>
	TEL : $N6x <br>
	E-mail : $N8x <br>
	Website : $N10x <br>
	TIN/VAT : $N5x </td></tr></table><br>";
?>
