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
<br><br><script>
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
			$cus=$_POST['cus'];
			$dst=$_POST['dst'];
			$ref=$_POST['ref'];
			$ite=$_POST['ite'];
			$ctin=$_POST['ctin'];
			$cadd=$_POST['cadd'];
			$ctel=$_POST['ctel'];
			$p=$_POST['p'];
			$t=1;
		}
			$due=date('l jS M Y', strtotime($date)); 
	
	echo"<div class='DONTPrint'><table width=80% border=0><tr>
	<td><a href='$pago'><font face='Agency FB' color='blue' size='3'> BACK </a></td>
<td><div align=right><a href='#' onclick='javascript:printpage();window.close()'>
<font face='Agency FB' color='blue' size='3'> PRINT </a></td></tr></table></div>

	        <table width='70%' class='gridtable'>
	<tr style='height:30px;'><th width='100%' style='border: 0px dotted #99cccc; font-size:24px; background-color:#F3EF53; border-radius:5px; height:60px;'><b><u> PROFORMA INVOICE No: $rowid </u></b></th></tr></table><br><br>
	
	<div style='padding-left:20px; float:left; 
	text-align:left; margin-bottom:20px;'>
	<u><b>TO</b></u>: $cus <br>
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; TIN:  $ctin <br>
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; TEL: $ctel <br> 
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Address: $cadd </div>
	
	
	<table width='92%'><tr><td align='left'> </td>
 <td align='right' style='font-size:18px;'><b><u>DATE</u>:</b> $due </td>
 </tr></table><br>";

	print("<table width='98%' class='gridtable'>
			<tr style='height:20px;'>
			<th width='5%' style='font-size:12px;'> No </th>
			<th style='font-size:12px;'> DESCRIPTION </th>
			<th width='14%' style='font-size:12px;'> PLATE No </th>
			<th width='10%' style='font-size:12px;'> QTY(TON) </th>
			<th width='10%' style='font-size:12px;'> U.P </th>
			<th width='10%' style='font-size:12px;'> T.P </th></tr>");

		$n=1;			$tot=$tqt=0;
$roome=mysqli_query($conn, "SELECT `stouse`.`Quantity`, `stouse`.`Price`, `stouse`.`Destin`, `stouse`.`Invoice`, `stouse`.`Currency`, `stouse`.`Item`, `stouse`.`User`, `stouse`.`Date` FROM `stouse` WHERE `stouse`.`Status`='0' AND `stouse`.`Voucher`='$rowid' AND `stouse`.`Action`='PROFORMA' ORDER BY `stouse`.`Number` ASC");
					while($rom=mysqli_fetch_assoc($roome)){	
						$item=$rom['Item'];
						$user=$rom['User'];
						$dati=$rom['Date'];
						
	$dose=mysqli_query($conn, "SELECT `Plate` FROM `vehicles` WHERE `Number`='$item' ORDER BY `Plate` ASC");
		if($fose=mysqli_num_rows($dose)){
		    $rose=mysqli_fetch_assoc($dose);
			    $item=$rose['Plate'];
		}
		else
		    $item="N/A";
			
						$qty=$rom['Quantity'];
						$pri=$rom['Price'];
						$dest=$rom['Destin'];
						$invo=$rom['Invoice'];
						$curre=$rom['Currency'];
						$to=$pri;
			$too=number_format($to);				$qto=number_format($qty);
    $prio=number_format($pri);
echo"<tr style='height:20px;'>
<td style='font-size:12px; text-align:right'> $n&nbsp;</td>
<td style='font-size:12px; text-align:left'> $dest </td>
<td style='font-size:12px; text-align:center;'> $item </td>
<td style='font-size:12px; text-align:right;'> $qto&nbsp;</td>
<td style='font-size:12px; text-align:right;'> $prio&nbsp;</td>
<td style='font-size:12px; text-align:right;'> $too&nbsp;</td></tr>";
		$n++;		        $tot+=$to;                  $tqt+=$qty;		
					}
					while($n<=10){
		echo"<tr style='height:20px;'><td style='font-size:12px;'> &nbsp; </td>
	<td style='font-size:12px;'> &nbsp; </td><td style='font-size:12px;'> &nbsp; </td><td style='font-size:12px;'> &nbsp; </td><td style='font-size:12px;'> &nbsp; </td><td style='font-size:12px;'> &nbsp; </td></tr>";
	$n++;
	}
		
		
		$toto=number_format($tot);                 $tqt=number_format($tqt);
?>			
<tr><th style='font-size:14px; text-align:left; padding-left:35px;' colspan='3'><b> TOTAL </th><th style='font-size:14px; text-align:right;'><b><?php echo $tqt ?>&nbsp;</th><th colspan='2' style='font-size:14px; text-align:right;'><b><?php echo" $curre &nbsp; $toto"  ?>&nbsp;</th></tr>
	</table><BR><BR>
	
	<?php
	print("<div align='left' style='padding-left:30px; font-size:18px;'>
	<b><u>NOTE</u></b>:<label> $invo </label><br><br></div>
	
	
	<div style='width:80%; text-align:right; font-size:14px;'><br><br>
		Done by:<b> $user </b><br> Done at: <b>$dati &nbsp; $Time</b> <br><br>
		<font size='1'> -------------------------------------- </font><br><br>
		
			
		</div><br><br><br>
	
	

	
	<div class='DONTPrint'><BR><HR WIDTH=98%><table width=80% border=0><tr>
	<td><a href='$pago'><font face='Agency FB' color='blue' size='3'> BACK </a></td>
<td><div align=right><a href='#' onclick='javascript:printpage();window.close()'>
<font face='Agency FB' color='blue' size='3'> PRINT </a></td></tr></table><br><br><br><br>");
		
				?>
		</div>		
		<div class="divFooter" style="left: 0px; bottom: 0px; right:0px; width: 100%; text-align: center; position:fixed;"><IMG SRC="imgs/footer.jpg" WIDTH="100%" HEIGHT="60" BORDER="0" ALT=""></div>
            
      </body>
</html>
