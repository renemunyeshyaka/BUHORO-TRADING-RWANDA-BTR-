<?php		
	include'expohead.php';
	?>
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
			$p=$_POST['p'];
			$t=1;
		}
			$due=date('l jS M Y', strtotime($date)); 

	echo"<div style='float:right; margin-right:40px; margin-top:-80px;'><b> $due </b></div>
	
	<div class='DONTPrint'><table width=80% border=0><tr>
	<td><a href='$pago'><font face='Agency FB' color='blue' size='3'> BACK </a></td>
<td><div align=right><a href='#' onclick='javascript:printpage();window.close()'>
<font face='Agency FB' color='blue' size='3'> PRINT </a></td></tr></table></div>

	<table width='98%' class='gridtable'>
			<tr style='height:30px;'><th width='5%' style='border: 1px dotted #99cccc;'> REQUISITION FROM No: $rowid </th></tr></table><br>";

	print("<table width='98%' class='gridtable'>
			<tr style='height:20px;'>
			<th width='10%' style='font-size:12px;'> No </th>
			<th style='font-size:12px;'> Description </th>
			<th width='15%' style='font-size:12px;'> Unit&nbsp;Price </th>
			<th width='15%' style='font-size:12px;'> Quantity </th>
			<th width='15%' style='font-size:12px;'> Total&nbsp;Amount </th>");

		$n=1;			$tot=0;
$roome=mysql_query("SELECT `items`.`Item`, `stouse`.`Quantity`, `stouse`.`Price` FROM `stouse` INNER JOIN `items` ON `stouse`.`Item`=`items`.`Number` WHERE `stouse`.`Status`='0' AND `stouse`.`Voucher`='$rowid' AND `stouse`.`Action`='REQUISE' ORDER BY `stouse`.`Number` ASC");
					while($rom=mysql_fetch_assoc($roome)){	
						$item=$rom['Item'];				
						$qty=$rom['Quantity'];
						$pri=$rom['Price'];
						$to=$pri*$qty;
			$too=number_format($to);				$prio=number_format($pri);				$qto=number_format($qty);
echo"<tr><td style='font-size:12px; text-align:right'> $n &nbsp;&nbsp;</td>
<td style='font-size:12px; text-align:left'> $item </td>
<td style='font-size:12px; text-align:right;'> $prio &nbsp;&nbsp;</td>
<td style='font-size:12px; text-align:right;'> $qto &nbsp;&nbsp;</td>
<td style='font-size:12px; text-align:right;'> $too &nbsp;&nbsp;</td></tr>";
		$n++;				$tot+=$to;
					}
		while($n<=10){
			echo"<tr><td style='font-size:12px;'> &nbsp; </td>
		<td style='font-size:12px; text-align:left'> &nbsp; </td>
<td style='font-size:12px; text-align:right;'> &nbsp; </td>
<td style='font-size:12px; text-align:right;'> &nbsp; </td>
<td style='font-size:12px; text-align:right;'> &nbsp; </td></tr>";
		$n++;
		}
		$toto=number_format($tot);
?>			
<tr><th style='font-size:12px; text-align:center;' colspan='2'><b> Total Amount </th>
<th style='font-size:12px; text-align:right;' colspan='3'><b><?php echo $toto ?>&nbsp;&nbsp;</th></tr>
	</table><BR><BR>
	
	<?php
	print("<BR><BR><div align='right' style='padding-right:80px;'>Printed by $loge <BR>
Printed on $Dati &nbsp; $Time <br> ............................................. &nbsp;&nbsp;&nbsp;&nbsp;</div>
	
	<div class='DONTPrint'><BR><HR WIDTH=98%><table width=80% border=0><tr>
	<td><a href='pago'><font face='Agency FB' color='blue' size='3'> BACK </a></td>
<td><div align=right><a href='#' onclick='javascript:printpage();window.close()'>
<font face='Agency FB' color='blue' size='3'> PRINT </a></td></tr></table><br><br><br><br>");
		
				?>
      </body>
</html>
