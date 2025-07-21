<?php
session_start();
if($_SESSION['Userid'] == null)
	Header("location:index.php");
include'connection.php';
?>
<!DOCTYPE html>
<html class=""><head>
<meta http-equiv="content-type" content="text/html; charset=windows-1252">
    <title>   <?php echo $cna ?>    </title>
<link type="text/css" href="jquery.datepick.css" rel="stylesheet">
<script type="text/javascript" src="jquery.min.js"></script>
<script type="text/javascript" src="jquery.datepick.js"></script>

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
<link rel='stylesheet' type='text/css' href='css/style.css' />

 </HEAD>
 <BODY bgcolor="#COCOCO"><CENTER>

 <?php 

//	$vous=$_SESSION['Vouch'];
if(isset($_POST['opens']))
		{
			$vous=$_POST['rowid'];
		}


$tot=0;
$dore=mysql_query("SELECT *FROM `stouse` WHERE `Voucher`='$vous' AND `Action`='RECEIVE'");
while($rore=mysql_fetch_assoc($dore)){
			$vous=$rore['Voucher'];
			$dte=$rore['Date'];
			$user=$rore['User'];
			$dest=$rore['Destin'];
			$sale=$rore['Price'];
			$qt=$rore['Quantity'];
			$tot+=($sale*$qt);
}


$due=date('l jS M Y', strtotime($dte)); 

$toto=number_format($tot);
?>


</div><div id="page-wrap" style="border:0px solid blue; font-size:10px; width:90%;">
		
		<div id="identity" style="border:0px solid blue;">
		
			<?php
			echo"<table width='94%' BORDER='0'><tr><td width='1%'></th><td width='10%'>
			<IMG SRC='imgs/logo.png' WIDTH='140' HEIGHT='90' BORDER='0'></td><td>
			$cna <br>
			$adde <br>
			TIN/VAT: $tin <br>
			Phone: $pho1 <br>
			VOUCHER No: $vous </td></tr></table>";

		?>	
		
          
		<div class="DONTPrint"><div id="logon" style='height:20px; width:80px; position:relative; float:left; color:#FF6600;'>
		<INPUT TYPE="submit" VALUE="BACK" NAME="see" STYLE='cursor:pointer; height:20px; width:80px; border:1px solid grey; border-radius:5px; color:#FF6600; font-weight:bold;' onclick="window.location.href='receive.php'"> </div>
		
		
		<div id="logon" style='height:20px; width:80px; position:relative; float:right; color:#FF6600;'>
		<INPUT TYPE="submit" VALUE="PRINT" NAME="see" STYLE='cursor:pointer; height:20px; width:80px; border:1px solid grey; border-radius:5px; color:#FF6600; font-weight:bold;' onclick='javascript:printpage();window.close()'> </div></div>

	<div style="clear:both;"></div><br><br>	
		
		<span style='float:left; text-align:left;margin-bottom-20px;'><?php echo" $due &nbsp; $Time"; ?></span><br>
		<span style='float:right; text-align:right;'><b>SUPPLIER:</b><?php echo $dest ?></span><br>

		<div id="customer">
			
           <br><br><table class='gridtable' width="100%" style="margin:2px 0px 0px 0px;">
			<TR><TH style='font-size:12px;'> No </TH>
		<TH style='font-size:12px;'> DESCRIPTION </TH>
		<TH width='15%' style='font-size:12px;'> QUANTITY </TH>
		<TH width='15%' style='font-size:12px;'> UNIT&nbsp;PRICE </TH>
		<TH width='15%' style='font-size:12px;'> TOTAL&nbsp;PRICE </TH>
			</TR>

		  <?php
				$n=1;			$tot=0;
$roome=mysql_query("SELECT `items`.`Item`, `stouse`.`Quantity`, `stouse`.`Price` FROM `stouse` INNER JOIN `items` ON `stouse`.`Item`=`items`.`Number` WHERE `stouse`.`Status`='0' AND `stouse`.`Voucher`='$vous' AND `stouse`.`Action`='RECEIVE' ORDER BY `stouse`.`Number` ASC");
					while($rom=mysql_fetch_assoc($roome)){	
						$item=$rom['Item'];				
						$qty=$rom['Quantity'];
						$pri=$rom['Price'];
						$to=$pri*$qty;
			$too=number_format($to);				$prio=number_format($pri);				$qto=number_format($qty);
		 print("<tr class='item-row' onMouseover=this.bgColor='#009999' onMouseout=this.bgColor='' style='height:5px;'>
		 <td class='item-name' style='font-size:12px;'><div align='right'>&nbsp;$n&nbsp;&nbsp; </div></td>
		 <td style='font-size:12px;'> &nbsp;$item </td>
			<td align='right' style='font-size:12px;'>$qto&nbsp;</td>
		      <td align='right' style='font-size:12px;'>$prio&nbsp;</td>
		      <td align='right' style='font-size:12px;'>$too&nbsp;</td>
		  </tr> ");
			  $n++;				$tot+=$to;
	}
	while($t<=10){
		 print("<tr class='item-row' onMouseover=this.bgColor='#009999' onMouseout=this.bgColor='' style='height:5px;'>
		 <td class='item-name' style='font-size:12px;'> &nbsp; </td>
		      <td align='right' style='font-size:12px;'> &nbsp; </td>
			  <td class='item-name' style='font-size:12px;'> &nbsp; </td>
		      <td align='right' style='font-size:12px;'> &nbsp; </td>
		      <td align='right' style='font-size:12px;'> &nbsp; </td></tr> ");
		  $t++;
	}
	$toto=number_format($tot, 2);
	?>
		 
		  <tr>
		      <th colspan="2" class="total-line balance" style='font-size:12px;'>Total Amount</th>
		      <th colspan="3" class="total-value balance" align='right' style='font-size:12px;'><div class="due">RWF <?php echo"$toto"; ?>&nbsp;</div></th>
		  </tr>
		
		</table>

	
	<br><br><span style="text-align:left; float:left;">
	DELIVERED BY: ------------------------- &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;  
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;  
	RECEIVED BY: ------------------------- 
<br><br> ------------------------------------------------ &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 
----------------------------------------------------<br>
	<font size='1'>&nbsp;</font><br>
	</span> 
	
	
	<span style="text-align:right; float:right;">
	APPROVED BY: ----------------------------------- <br><br> ----------------------------------------------- <br>
	<font size='1'>Receiving Site &nbsp;&nbsp;&nbsp;&nbsp; </font><br>
	</span></div><br>

			
		
	
	</div>
<div class="DONTPrint"><div id="terms" style="margin-top:80px;"><div id="logon" style='height:20px; width:80px; position:relative; float:left; color:#FF6600; margin-top:20px;'><INPUT TYPE="submit" VALUE="BACK" NAME="see" STYLE='cursor:pointer; height:20px; width:80px; border:1px solid grey; border-radius:5px; color:#FF6600; font-weight:bold;' onclick="window.location.href='receive.php'"></div>


<div id="logon" style='height:20px; width:80px; position:relative; float:right; color:#FF6600; margin-top:20px;'><INPUT TYPE="submit" VALUE="PRINT" NAME="see" STYLE='cursor:pointer; height:20px; width:80px; border:1px solid grey; border-radius:5px; color:#FF6600; font-weight:bold;' onclick='javascript:printpage();'></div></div><br><br>
		 
</div>
 </BODY>
 </HTML>
