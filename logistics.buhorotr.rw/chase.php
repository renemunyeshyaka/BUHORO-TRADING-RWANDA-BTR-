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
			
			
    @media screen {
        div.divFooter {
            display: none;
        }
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

<link rel="shortcut icon" type="image/png" href="imgs/logo.png"/>
</head>
<body bgcolor="#COCOCO">
<center>
		<?php
		$loge=$_SESSION['Loge'];
		$hed=mysqli_query($conn, "SELECT *FROM company");
			$rd=mysqli_fetch_assoc($hed);{
				$N1x=$rd['Cname'];
				$N3x=$rd['Address'];
				$N5x=$rd['Tax'];
				$N6x=$rd['Phone1'];
				$N7x=$rd['Phone2'];
				$N8x=$rd['Email'];
				$N9x=$rd['Email'];
				$N10x=$rd['Website'];
				$Date=$rd['Date'];
			}
?><div class='divFooter'>
<IMG SRC="imgs/header.jpg" WIDTH="100%" HEIGHT="90" BORDER="0" ALT=""></div>
<br><br><br>
	<script>
function goBack() {
  window.history.back();
}
</script>

<?php
	if(isset($_POST['opens']))
		{
			$rowid=$_POST['rowid'];
			$date=$_POST['date'];
			$dato=$_POST['dato'];
			$datos=$_POST['datos'];
			$pago=$_POST['pago'];
			$user=$_POST['user'];
			$dst=$_POST['dst'];
			$ref=$_POST['ref'];
			$ite=$_POST['ite'];
			$p=$_POST['p'];
			$t=1;
		}
			$due=date('l jS M Y', strtotime($date)); 
			
	$top=mysqli_query($conn, "SELECT *FROM `suppliers` WHERE `Supplier`='$dst' ORDER BY `Supplier` ASC");
			$rop=mysqli_fetch_assoc($top);
				$adds=$rop['Address'];
				$tess=$rop['Telephone'];
				$emes=$rop['Email'];
	
	echo"<div class='DONTPrint'><table width=80% border=0><tr>
	<td><a href='$pago'><font face='Agency FB' color='blue' size='3'> BACK </a></td>
<td><div align=right><a href='#' onclick='javascript:printpage();window.close()'>
<font face='Agency FB' color='blue' size='3'> PRINT </a></td></tr></table></div>

	        <table width='98%' class='gridtable'>
	<tr style='height:30px;'><th width='5%' style='border: 0px dotted #99cccc; font-size:24px; background-color:transparent;'><b><u> FUEL PURCHASE ORDER </u></b></th></tr></table><br>
	
	<div style='padding-left:20px; float:left; 
	text-align:left; margin-bottom:40px;'>
	<u><b>SUPPLIER</b></u>: $dst <br>
	&nbsp;<u><b>ADDRESS</b></u>: $adds <br> 
	&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	$tess <br>&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Email: 
	<font color='blue'> $emes </font></div>
	
	
	<table width='92%'><tr><td align='left'><b><u>DATE</u>:</b> $due </td>
 <td align='right'><b><u>F.P.O No</u>:</b> 0$rowid </td></tr></table><br>";

	print("<table width='98%' class='gridtable'>
			<tr style='height:20px;'>
			<th width='8%' style='font-size:12px;'> No </th>
			<th style='font-size:12px;'> PLATE NUMBER </th>
			<th width='32%' style='font-size:12px;'> POINT OF FUELING </th>
			<th width='14%' style='font-size:12px;'> QTY&nbsp;(LTS) </th>
			<th width='14%' style='font-size:12px;'> TOTAL&nbsp;(LTS) </th>");

		$n=1;			$tot=0;
$roome=mysqli_query($conn, "SELECT `vehicles`.`Plate`, `stouse`.`Quantity`, `stouse`.`Price` FROM `stouse` INNER JOIN `vehicles` ON `stouse`.`Item`=`vehicles`.`Number` WHERE `stouse`.`Status`='0' AND `stouse`.`Voucher`='$rowid' AND `stouse`.`Action`='PURCHASE' ORDER BY `stouse`.`Number` ASC");
					while($rom=mysqli_fetch_assoc($roome)){	
						$item=$rom['Plate'];				
						$qty=$rom['Quantity'];
						$to+=$qty;
			$too=number_format($to);				$qto=number_format($qty);
echo"<tr><td style='font-size:12px; text-align:right'> $n &nbsp;&nbsp;</td>
<td style='font-size:12px; text-align:center'> $item </td>";

if($n==1)
echo"<td style='font-size:12px; text-align:center;' 
rowspan='$ite'> $ref </td>";

echo"<td style='font-size:12px; text-align:right;'> $qto&nbsp;</td>
<td style='font-size:12px; text-align:right;'> $too&nbsp;</td></tr>";
		$n++;				
					}
		$toto=number_format($tot);
?>			
<tr><th style='font-size:12px; text-align:left; padding-left:35px;' colspan='5'><b> TOTAL QUANTITY (LTS) 
<label style="font-size:12px; text-align:right; float:right"><b><?php echo $too ?>&nbsp;</th></tr>
	</table><BR><BR>
	
	<?php
	$sig=mysqli_query($conn, "SELECT `Signature` FROM `employees` WHERE `Fullname`='$user'");
    if(mysqli_num_rows($sig)){
        $si=mysqli_fetch_assoc($sig);
            $mg=$si['Signature'];
        $img="<IMG SRC='photos/$mg' WIDTH='140' HEIGHT='50' BORDER='0'>";
    }
    else
        $img="";
	print("<div align='left' style='padding-left:30px;'>
	<b><u>Note</u>(s)</b>:<br>
	- &nbsp;In case of cover fueling, the company will not bear such extra costs.<br>
	- &nbsp;Trucks are fueled diesel; do not put any other products.<br>
	- &nbsp;We only count official receipts.<br>
	- &nbsp;If trucks didn't fuel all the order, just invoice topped one. Don't give the balance on this way back. <br><br><br>
	The management of the company.

<div class='divFooter' style='position: fixed; width:100%; margin:0px; left: 0px; bottom: 50px; right:0px;'>
	<table width='100%'><tr><td width='50%'>	
<img src='imgs/stamp.JPG' width='334' height='200' border='0' alt=''>
</td><td align='right'> Done by: $user <br>$img</td></tr></table></div>
</div>	
	<div class='DONTPrint'><BR><HR WIDTH=98%><table width=80% border=0><tr>
	<td><a href='$pago'><font face='Agency FB' color='blue' size='3'> BACK </a></td>
<td><div align=right><a href='#' onclick='javascript:printpage();window.close()'>
<font face='Agency FB' color='blue' size='3'> PRINT </a></td></tr></table><br><br><br><br>");
		
				?>
		</div>		
		<div class="divFooter">
		    
		<div style="left: 0px; bottom: 0px; width: 100%; position:fixed;
text-align: center;"><IMG SRC="imgs/footer.jpg" WIDTH="100%" HEIGHT="60" BORDER="0" ALT=""></div>
            </div>
      </body>
</html>
