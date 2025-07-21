<?php
include'connection.php';
$dog=mysql_query("SELECT *FROM `sales` WHERE `Voucher`!='0' AND `Status`='0' AND `Printed`>='0' AND `Addon`='0' AND `Date`>='2019-12-01' GROUP BY `Voucher` ORDER BY `Voucher` DESC LIMIT 1");
while($rog=mysql_fetch_assoc($dog)){
	$vous=$rog['Voucher'];
$do=mysql_query("SELECT *FROM `sales` WHERE `Voucher`='$vous' AND `Status`='0' AND `Printed`>='0' AND `Addon`='0' ORDER BY `Number` ASC LIMIT 100");
if($fo=mysql_num_rows($do)){
print("<html><head>
<title>$cna</title>
</head>
<body>");

	$n=0;
	print("<style type=text/css>
@media screen {
  .DONTPrinti{ display:none;
  margin-top: 0mm; margin-bottom: 0mm; 
           margin-left: 0mm; margin-right: 0mm }
			}
@media print {
  .DONTPrint{ display:none }
  .DOCheck{ display:table}
			}
</style>
	<script type='text/javascript'>
	function printpage()
  {  
window.print();
  } 
</script>");
		$ro=mysql_fetch_assoc($do);
			$nu=$ro['Number'];
			$vous=$ro['Voucher'];
			$empo=$ro['Owner'];
			$pla=$ro['Tnumber'];
			$pt=$ro['Printed'];
			$brc=$ro['Branche'];
			$comme=$ro['Comment'];
			if($pt=='2')
				$pti="REPRINTED";
			else
				$pti="";

				$da=$ro['Date'];
				$ti=$ro['Time'];

		$doib=mysql_query("SELECT `Number`, `Name`, `Telephone` FROM `branches` WHERE `Number`='$brc' ORDER BY `Number` ASC");
			$roib=mysql_fetch_assoc($doib);
				$bra=$roib['Name'];
				$tel=$roib['Telephone'];
				$na=$roib['Name'];

					$clio=$pla;

print("<div class='DONTPrinti' style='margin-top:0px; position:relative;'><CENTER>
<TABLE RULES='ROWS' FRAME='BOX' BORDER='1' STYLE='font-family: verdana,sans-serif;
	font-size: 12px;
	color: #333333z;
	border-width: 1px;
	border-color: #999999;
	border-collapse: collapse;
	width: 290px; margin-top:0px;'>
	<TR>
	<TD><center>
		<table width=100% border='0' style='font-size:10px;'><tr>
		<th width='30%' align='center'><IMG SRC='imgs/logo.jpg' WIDTH='62' HEIGHT='42' BORDER='0'></th>
		<td colspan='2'><div align='left'> $cna <br>
		Tel: $tel <BR>
	$na </td></tr>
		</table>
		 
			</TH>
		</TR>
		<TR style='height:60px;'>
		<TD><br>&nbsp;<b>Order No: $vous &nbsp;&nbsp;&nbsp;&nbsp; $pti</b>
		<br>&nbsp;&nbsp;Time&nbsp;:$da&nbsp;&nbsp;&nbsp;&nbsp;$ti&nbsp;<br>
		&nbsp;&nbsp;&nbsp;Table&nbsp;:&nbsp;<b>$clio</b><br><hr><br>
		<table width='100%' style='font-size:12px;'>");
		$tot=0;

		// ****************************** Odered items **************************************************
	$do=mysql_query("SELECT *FROM `sales` WHERE `Voucher`='$vous' AND `Status`='0' AND `Addon`='0' ORDER BY `Number` ASC LIMIT 100");
		$fo=mysql_num_rows($do);
			while($ro=mysql_fetch_assoc($do)){
				$nuo=$ro['Number'];
				$cla=$ro['Item'];
				$pre=$ro['Price'];
				$qty=$ro['Quantity'];
				
				$to=$pre*$qty;
	
	$dot=mysql_query("SELECT *FROM `items` WHERE `Number`='$cla' ORDER BY `Number` ASC LIMIT 1");
		$rot=mysql_fetch_assoc($dot);
			$iname=$rot['Iname'];

$qto=number_format($qty);				$preo=number_format($pre);					$too=number_format($to);
		echo("<tr><td>&nbsp;$qto&nbsp;x&nbsp;$iname </td><td width='1%'><div align='right'>&nbsp;</td></tr>");
			$tot+=$to;

			// ************************************** Addon items ****************************************
$dok=mysql_query("SELECT *FROM `sales` WHERE `Voucher`='$vous' AND `Status`='0' AND `Addon`='$nuo' ORDER BY `Number` ASC LIMIT 100");
		if($fok=mysql_num_rows($dok)){
			while($rok=mysql_fetch_assoc($dok)){
				$clak=$rok['Item'];
				$qtyk=$rok['Quantity'];
	
	$dote=mysql_query("SELECT *FROM `items` WHERE `Number`='$clak' ORDER BY `Number` ASC LIMIT 1");
		$rote=mysql_fetch_assoc($dote);
			$inamee=$rote['Iname'];

		echo("<tr><td colspan='2'>&nbsp;&nbsp;&nbsp;-&nbsp;$inamee&nbsp;x&nbsp;$qtyk </td></tr>");
			}
			}
			}
				
			print("</table><br></TD></TR>");
	$toto=number_format($tot);

	print("<TR style='height:30px;'>
	<TD style='padding-right:5px'>");
	//if($fo>1)
		//echo"<DIV ALIGN='right' style='font-size:font-size:10px;'><b> TOTAL&nbsp;:&nbsp;&nbsp;$toto</b></DIV>";
	print("<FONT SIZE='1'><label style='padding-top:10px;'>&nbsp;$comme<br><br>
	&nbsp;&nbsp;Done&nbsp;by:&nbsp;$empo <br> &nbsp;&nbsp; ...............................
	<br>.</label></FONT></DIV></TD>
	</TR></TABLE> .
    </div></div><div class='DONTPrint'>");

$so=mysql_query("UPDATE `sales` SET `Printed`='1' WHERE `Voucher`='$vous' ORDER BY `Number` ASC LIMIT 100");
	?>
	 <script type="text/javascript">
    window.print();
</script>
<?php
	echo"</body></html>";
}
}
//$t=$p=999;
		?>