<?php
$do=mysql_query("SELECT *FROM `stouse` WHERE `Voucher`='$vou' AND `Status`='0' AND `Printed`!='1' AND `Action`='$action' ORDER BY `Number` ASC LIMIT 100");
if($fo=mysql_num_rows($do)){
print("<html><head>
<title>$cna</title>
</head>
<body></div>");

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
</script>

<div class='DONTPrinti' style='position:relative; width:510px;'><CENTER>");
		$ro=mysql_fetch_assoc($do);
			$nu=$ro['Number'];
			$vou=$ro['Voucher'];
			$empo=$ro['User'];
			$pla=$ro['Destin'];
			$tra=$ro['Store'];
			$cli=$ro['Client'];
			$pt=$ro['Printed'];
			$cus=$ro['Invoice'];
			$brc=$ro['Branche'];
			$pers=$ro['Person'];
			$plat=$ro['Plate'];
			$locat=$ro['Location'];
			$comme=$ro['Comment'];
			
			if(!$plat)
			    $plat="--------";
			    
			if($pt=='2')
				$pti="(Duplicate)";
			else
				$pti="(Original)";

				$da=$ro['Date'];
				$ti=$ro['Time'];
				
				$pieces = explode(" ", $empo);
                    $empo = $pieces[0];										$dat=date('d-M-Y', strtotime($da));


				$doibi=mysql_query("SELECT `Customer`, `Address`, `Telephone`, `Tin`, `Delegator` FROM `account` WHERE `Number`='$cli' ORDER BY `Number` ASC");
					$roibi=mysql_fetch_assoc($doibi);
						$clie=$roibi['Customer'];
						$addie=$roibi['Address'];
						$tini=$roibi['Tin'];
						$dele=$roibi['Delegator'];
						$year=date('Y', strtotime($da));

if($cprint=='INVO' OR $cprint=='ALL'){
    
		$tot=$box=0;						$n=1;
	$do=mysql_query("SELECT *FROM `stouse` WHERE `Voucher`='$vou' AND `Status`='0' AND `Action`='$action' ORDER BY `Number` ASC LIMIT 100");
		$fo=mysql_num_rows($do);
		
		$pre=10-$fo;                    $fre=10-$fo;
print("<h4> INVOICE - $tax </h4>
<label style='float:right; text-align:right; margin-top:-25px; margin-right:20px; font-size:10px;'> $pti </label>
<TABLE BORDER='1' STYLE='font-size: 11px;
	border-width: 1px;
	border-color: #999999;
	border-collapse: collapse;
	width: 99%; margin-top:0px;
	font-weight:bold; margin-top:-15px;
	padding-top:0px; color: #333333z;'>
	<TR><TD ROWSPAN='6' WIDTH='50%' VALIGN='TOP'>

		<table width=100% border='0' style='font-size:11px; font-weight:bold;'>
		<tr><td width='1%' align='right'><img src='imgs/logo.png' width='100px' height='70px'></td>
   <td colspan='2'><div align='left'><b> $cna </b><br>$city - $country<br>TIN/VAT: $tax<br>TEL: $pho1 / $pho2
   <br> $mail </div></td></tr></table><hr width='96%' style='float:left; border: 1px solid #999999;'>
   
   &nbsp;Customer <br>
   &nbsp;$clie <br>
   &nbsp;$addie <br>
   &nbsp;TIN: $tini <br><br>");
   if($dele)
        echo"&nbsp;Delegator <br>   &nbsp;$dele<br>";
   
   print("</TD></TR>

<TR style='height:40px;'><TD>&nbsp;INVOICE No. <br> &nbsp;&nbsp; BTR/NS/$vou/$year </TD>
<TD>&nbsp;Dated <br> &nbsp;&nbsp; $dat </TD></TR>

<TR style='height:40px;'><TD>&nbsp;Delivery Note <br> &nbsp;&nbsp; BTR/DEL/$vou/$year </TD>
<TD>&nbsp;Made/Terms of Payment <br> &nbsp;&nbsp;1 Day </TD></TR>

<TR style='height:40px;'><TD VALIGN='TOP'>&nbsp;Despatched through <br>
&nbsp;&nbsp;&nbsp;&nbsp; $plat </TD>
<TD VALIGN='TOP'>&nbsp;Location <br>&nbsp;$locat </TD></TR>

<TR style='height:40px;'><TD colspan='2' valign='top'>&nbsp;Reference <br>
&nbsp;&nbsp; $comme </TD></TR>

<TR style='height:40px;'><TD colspan='2' valign='top'>&nbsp;Terms of Delivery");
while($pre>0){
echo"<br>";
$pre--;
}
print("</TD></TR>









		<TR><TD COLSPAN='3'> 

		<table width='100%' border='1' style='font-size:11px; border-width: 1px;
	border-color: #999999; border-collapse: collapse;'><tr style='height:20px;'>
		<th width='5%' style='text-align:center;'> No </th>
		<th style='text-align:center;'> Description of Goods </th>
		<th width='15%' style='text-align:center;'> Quantity </th>
		<th width='15%' style='text-align:center;'> Rate </th>
		<th width='5%' style='text-align:center;'> Per </th>
		<th width='15%' style='text-align:center;'> Amount </th></tr>");
		
			while($ro=mysql_fetch_assoc($do)){
				$cla=$ro['Item'];
				$pre=$ro['Price'];
				$qty=$ro['Quantity'];

				
				$to=$pre*$qty;
	
	$doi=mysql_query("SELECT `items`.`Iname`, `unit`.`Unit` FROM `items` INNER JOIN `unit` ON `items`.`Unit` = `unit`.`Number` WHERE `items`.`Number`='$cla' ORDER BY `items`.`Number` ASC LIMIT 1");
		$roi=mysql_fetch_assoc($doi);
			$iname=$roi['Iname'];
			$unit=$roi['Unit'];

    $qto=number_format($qty);				$preo=number_format($pre);					$too=number_format($to);
		echo("<tr><td align='right'> $n&nbsp;&nbsp;</td><td>$iname </td><td><div align='right'>&nbsp;$qto&nbsp;$unit</td>
		<td><div align='right'>&nbsp;$preo&nbsp;</td><td> $unit </td>
		<td><div align='right'>&nbsp;$too&nbsp;</td></tr>");
			$tot+=$to;				$n++;				$box+=$qty;
			}
		$toto=number_format($tot);				$boxo=number_format($box);
	print("<tr><th> </th><th style='text-align:right'> Total &nbsp;</th>
	<th style='text-align:right'>&nbsp;$boxo&nbsp;$unit</th><th> </th><th> </th>
	<th style='text-align:right'>&nbsp;$toto&nbsp;</th></tr></table><br>
	</TD></TR>");
	
			include'inword.php';
	print("<TR><TD COLSPAN='3' style='padding-left:5px;'> Amount Chargeable 
	(in words) 
	 <div style='width:320px;'>".convert_number_to_words($tot)." rwanda francs only </div><br><br>");
while($fre>0){
echo"<br>";
$fre--;
}
print("Remarks: <br> SALES OF $box $unit OF GOODS <br> Party's VAT No. : $tini 
	 <br><br><br><u>Decralation</u><br>
	 Certified that all particulars shown in the <br>
	 above invoice are true and correct. <br>
	 Goods Once Sold not Returnable. <br><br>
	 
	 <div style='width:240px; height:100px; margin-top:-98px; float:right; text-align:center; border: 1px solid #999999; border-collapse: collapse; padding:10px; font-size:10px;'> For $cna <br><br><br><br><br><br> Authorized Signature</div>
	 </TD></TR></TABLE><font size='2'>SUBJECT TO $city, $country JURISDICTION</font><br>
	<font size='1'>This is a Computer Generated Invoice</font><br>");
	
	if($cprint=='DEL' OR $cprint=='ALL')
	    echo"<p style='page-break-before: always'>";
}
	
	


























if($cprint=='DEL' OR $cprint=='ALL'){
    $dos=mysql_query("SELECT `Store` FROM `stouse` WHERE `Voucher`='$vou' AND `Status`='0' AND `Action`='$action' GROUP BY `Store` ORDER BY `Number` ASC LIMIT 100");
    $fos=mysql_num_rows($dos);              $k=1;
                         
			while($ros=mysql_fetch_assoc($dos)){
				$store=$ros['Store'];
                         $pre=8-$fos;              $fre=8-$fos;

	print("<h4> DELIVERY NOTE </h4>
<label style='float:right; text-align:right; margin-top:-25px; margin-right:20px; font-size:10px;'> $pti </label>
<TABLE BORDER='1' STYLE='font-size: 11px;	
	border-width: 1px;
	border-color: #999999;
	border-collapse: collapse;
	width: 99%; margin-top:0px;
	font-weight:bold; margin-top:-15px;
	padding-top:0px; color: #333333z;'>
	<TR><TD ROWSPAN='6' WIDTH='50%' VALIGN='TOP'>

		<table width=100% border='0' style='font-size:11px; font-weight:bold;'>
		<tr><td width='1%' align='right'><img src='imgs/logo.png' width='100px' height='70px'></td>
   <td colspan='2'><div align='left'><b> $cna </b><br>$city - $country<br>TIN/VAT: $tax<br>TEL: $pho1 / $pho2
   <br> $mail </div></td></tr></table><hr width='96%' style='float:left; border: 1px solid #999999;'>");
  
  if($action=='SALES'){
   print("&nbsp;Customer <br>
   &nbsp;$clie <br>
   &nbsp;$addie <br>
   &nbsp;TIN: $tini <br><br>");
   if($dele)
        echo"&nbsp;Delegator <br>   &nbsp;$dele<br>";
        }
        elseif($action=='TRANSFER'){
	$dos=mysql_query("SELECT `Name` FROM `stores` WHERE `Store`='$tra' ORDER BY `Number` ASC");
		$ros=mysql_fetch_assoc($dos);
				$frs=$ros['Name'];
				
	$dos=mysql_query("SELECT `Name` FROM `stores` WHERE `Store`='$pla' ORDER BY `Number` ASC");
		$ros=mysql_fetch_assoc($dos);
				$trs=$ros['Name'];
				echo"&nbsp;FROM: $frs <br>
				&nbsp;To: $trs <br>
				&nbsp;DONE BY: $empo";
        }
        elseif($action=='TAKEN'){
	$dos=mysql_query("SELECT `Name` FROM `stores` WHERE `Store`='$tra' ORDER BY `Number` ASC");
		$ros=mysql_fetch_assoc($dos);
				$frs=$ros['Name'];
				
				echo"&nbsp;FROM: $frs <br>
				&nbsp;To: $pla <br>
				&nbsp;DONE BY: $empo <br>
				&nbsp;TAKEN BY: $pers";
        }
        
        if($action=='TAKEN')
            $acts="DELIVERY";
        else
            $acts=$action;
   
   print("</TD></TR>

<TR style='height:40px;'><TD>&nbsp;Delivery Note <br> &nbsp;&nbsp; BTR/DEL/$vou/$year </TD>
<TD>&nbsp;Dated <br> &nbsp;&nbsp; $dat </TD></TR>

<TR style='height:40px;'>
<TD style='text-align:center;padding-top:6px; font-size:16px;'> $acts </TD>
<TD>&nbsp;Made/Terms of Payment <br> &nbsp;&nbsp;1 Day </TD></TR>

<TR style='height:40px;'><TD VALIGN='TOP'>&nbsp;Despatched through <br> 
&nbsp;&nbsp;&nbsp;&nbsp; $plat </TD>
<TD VALIGN='TOP'>&nbsp;Location <br>&nbsp;$locat </TD></TR>

<TR style='height:40px;'><TD colspan='2' valign='top'>&nbsp;Reference <br>
&nbsp;&nbsp; $comme </TD></TR>

<TR style='height:40px;'><TD colspan='2' valign='top'>&nbsp;Terms of Delivery");
while($pre>0){
echo"<br>";
$pre--;
}
print("</TD></TR>









		<TR><TD COLSPAN='3'> 

		<table width='100%' border='1' style='font-size:11px; border-width: 1px;
	border-color: #999999; border-collapse: collapse;'><tr style='height:20px;'>
		<th width='5%' style='text-align:center;'> No </th>
		<th style='text-align:center;'> Description of Goods </th>
		<th width='15%' style='text-align:center;'> Quantity </th>
		<th width='15%' style='text-align:center;'> Store </th></tr>");
		$tot=$box=0;						$n=1;
	$do=mysql_query("SELECT *FROM `stouse` WHERE `Voucher`='$vou' AND `Status`='0' AND `Action`='$action' AND `Store`='$store' ORDER BY `Number` ASC LIMIT 100");
		$fo=mysql_num_rows($do);
			while($ro=mysql_fetch_assoc($do)){
				$cla=$ro['Item'];
				$pre=$ro['Price'];
				$qty=$ro['Quantity'];
				$stor=$ro['Store'];
				
	$dok=mysql_query("SELECT `Name` FROM `stores` WHERE `Store`='$stor' ORDER BY `Number` ASC");
		$rok=mysql_fetch_assoc($dok);
				$stor=$rok['Name'];
				
				$to=$pre*$qty;
	
	$doi=mysql_query("SELECT `items`.`Iname`, `unit`.`Unit` FROM `items` INNER JOIN `unit` ON `items`.`Unit` = `unit`.`Number` WHERE `items`.`Number`='$cla' ORDER BY `items`.`Number` ASC LIMIT 1");
		$roi=mysql_fetch_assoc($doi);
			$iname=$roi['Iname'];
			$unit=$roi['Unit'];

$qto=number_format($qty);				$preo=number_format($pre);					$too=number_format($to);
		echo("<tr><td align='right'> $n&nbsp;&nbsp;</td><td>$iname </td>
		<td><div align='right'>&nbsp;$qto&nbsp;$unit&nbsp;</td><td>&nbsp; $stor </td></tr>");
			$tot+=$to;				$n++;				$box+=$qty;
			}
		$toto=number_format($tot);				$boxo=number_format($box);
	print("<tr><th> </th><th style='text-align:right'> Total &nbsp;</th>
	<th style='text-align:right'>&nbsp;$boxo&nbsp;$unit&nbsp;</th>
	<th> </th></tr></table><br></TD></TR>");
	
		print("<TR><TD COLSPAN='3' style='padding-left:5px;'>");
	/*
while($fre>0){
echo"<br>";
$fre--;
}
*/

	include 'phpqrcode/qrlib.php';
$text = "https://sales.buhorotr.rw/jksdfhgksjdgfbkjgf/rsdzfhkfgsfdasdhjx.php?vjghfcdxszdhvgbjhvcxfzdbnvs=$vou&kgfhgvdbfghb=$action&khjgdgfhjfhgfdghdg=$store";
    QRcode::png($text, 'qrcodes/image.png');
    echo"<div style='float:right; text-align:right; padding:10px 20px 10px 10px; height:120px;'><img src='qrcodes/image.png' alt='' height='110' width='120'></div>";
    
    print("<br><br><br><br><br><br><br><br><br><br><br>Remarks: <br> BEING DELIVERED $box $unit OF GOODS <br> Party's VAT No. : $tini <br><br><br><u>Decralation</u><br>	 Received in good condition. <br><br>
	 
	 <div style='width:240px; height:100px; margin-top:-98px; float:right; text-align:center; border: 1px solid #999999; border-collapse: collapse; padding:10px; font-size:10px;'> For $cna <br><br><br><br><br><br> Authorized Signature</div>
	 
	 </TD></TR></TABLE><font size='2'>SUBJECT TO $city, $country JURISDICTION</font><br>
	<font size='1'>This is a Computer Generated Document</font><br>");
	if($k!=$fos)
	    echo"<p style='page-break-before: always'>";
	                $k++;
			}	
}
	print("</DIV><div class='DONTPrint'>");

if($action=='SALES'){
$so=mysql_query("UPDATE `stouse` SET `Printed`='1', `Client`='$cli' WHERE `Voucher`='$vou' AND `Action`='$action' ORDER BY `Number` ASC LIMIT 100");
$so=mysql_query("UPDATE `payment` SET `Client`='$cli' WHERE `Voucher`='$vou' AND `Action`='SALES' ORDER BY `Number` ASC LIMIT 100");
}
else{
$so=mysql_query("UPDATE `stouse` SET `Printed`='1' WHERE `Voucher`='$vou' AND `Action`='$action' ORDER BY `Number` ASC LIMIT 100");
    
}
	?>
	
	 <script type="text/javascript">
    window.print();
</script>
<?php
	echo"</center></div><div class='DONTPrint'></body></html>";
}






















if($requi==4){
$do=mysql_query("SELECT `Date`, `Destin`, `User`, `Client`, `Comment` FROM `stouse` WHERE `Voucher`='$vous' AND `Status`='10' AND `Printed`!='1' AND `Action`='PROFORMA' ORDER BY `Number` ASC LIMIT 1");
if($fo=mysql_num_rows($do)){
print("<html><head>
<title>$cna</title>
</head><body></div>");

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
</script>

<div class='DONTPrinti' style='border:4px solid black; border-radius:5px; height:99%;'><center>");

		$ro=mysql_fetch_assoc($do);
			$empo=$ro['User'];
			$pla=$ro['Destin'];
			$cli=$ro['Client'];
			$comme=$ro['Comment'];
			/*
			$cus=$ro['Invoice'];
			$brc=$ro['Branche'];
			$pers=$ro['Person'];
			$plat=$ro['Plate'];
			$locat=$ro['Location'];
			*/

				$da=$ro['Date'];
				
				$pieces = explode(" ", $empo);
                    $empo = $pieces[0];									
                    $dat=date('d-M-Y', strtotime($da));
                    $yea=date('y', strtotime($da));
                    
                    $expe = strtotime("+5 days", strtotime("$da"));
                    $expe = date ("d-M-Y", $expe);

				$doibi=mysql_query("SELECT `Customer`, `Address`, `Telephone`, `Tin`, `Delegator` FROM `account` WHERE `Number`='$cli' ORDER BY `Number` ASC");
					$roibi=mysql_fetch_assoc($doibi);
						$clie=$roibi['Customer'];
						$addie=$roibi['Address'];
						$tini=$roibi['Tin'];
						$dele=$roibi['Delegator'];
						$teli=$roibi['Telephone'];

		
echo"<div style='width:100%; height:100%; border:1px solid #000000;'>
<table width='100%'><tr><td width='55%'><img src='imgs/logo.png' width='100px' height='70px'><br> $city - $country<br>TIN/VAT: $tax<br>TEL: $pho1 / $pho2 <br> E-mail: $mail <br></br></td><td width='10%'> &nbsp; </td><td>
   <label style='float:right; text-align:right; color:#0020C2;'><b> PROFORMA INVOICE </b> &nbsp;&nbsp; </label><br> Date: <font color='#ffffff'>Expiration</font> &nbsp;&nbsp;&nbsp; $dat </label><br> Expiration Date: &nbsp;&nbsp;&nbsp; $expe </label><br>
   
   <b>REF: BTR/$vous/$yea <br><br><br></td></tr>
   
   <tr style='height:30px;'><th style='background-color:#0020C2; font-size:18px; color:#ffffff; text-align:left'> &nbsp;CUSTOMER </th><th> </th><th style='background-color: #0020C2; font-size:18px; color:#ffffff; text-align:left'> &nbsp;DELIVERY DETAILS </th></tr>
   
   <tr><td> $clie <br>$addie <br> TEL: $teli <br><br><br><br></td>
   <td> </td><td valign='top'>$comme </td></tr></table>

<table width='100%'><tr><th> No </th><th> DESCRIPTION </th><th width='15%'> QUANTITY </th><th width='15%'> UNIT&nbsp;PRICE </th><th width='15%'> AMOUNT </th><tr>";

$do=mysql_query("SELECT `items`.`Iname`, `stouse`.`Quantity`, `stouse`.`Price` FROM `stouse` INNER JOIN `items` ON `stouse`.`Item` = `items`.`Number` WHERE `stouse`.`Voucher`='$vous' AND `stouse`.`Status`='10' AND `stouse`.`Printed`!='1' AND `stouse`.`Action`='PROFORMA' ORDER BY `stouse`.`Number` ASC LIMIT 100");
        $n=1;               $tot=0;
while($ro=mysql_fetch_assoc($do)){
			$item=$ro['Iname'];
			$qty=$ro['Quantity'];           $qto=number_format($qty);
			$pri=$ro['Price'];              $prio=number_format($pri);
			
	$amo=$pri*$qty;                         $amoo=number_format($amo);
	
echo"<tr><td align='center'> $n </td><td> $item </td><td align='right' style='padding-right:20px;'> $qto </td><td align='right'> $prio </td><td align='right'> $amoo </td></tr>";
        $n++;                   $tot+=$amo;
}
while($n<10){
 echo"<tr><td colspan='5'> &nbsp; </td></tr>";   
    $n++;
}
        $toto=number_format($tot);
echo"<tr><td colspan='2'> </td><td colspan='2' align='right'><b> TOTAL AMOUNT </b></td><td align='right'><b> $toto </b></td></tr>

<tr><th colspan='2'><div style='background-color: #0020C2; font-size:16px; color:#ffffff; text-align:left; height:25px; padding-top:7px;'>&nbsp;TERMS OF SALE AND OTHER COMMENTS</th><td colspan='2' align='center'> &nbsp; Currency <br><br></td><td align='right'> RWF <br><br></td></tr></table>

<div style='float:left; text-align:left'>
 &nbsp; 1. Delivery will be made after receiving total amount of proforma invoice <br>
 &nbsp; 2. Payment is only accepted through company's bank account <br>
 &nbsp; 3. Validity of this proforma is 5 days from the date of receive proforma invoice<br>
 &nbsp; 4. BANK NAME: <b>BK</b>, ACCOUNT NUMBER: <b> 000930067466719</b><br>
 &nbsp;  &nbsp;<b> $cna </b></div>
 
 <div style='position:fixed; right:120px; bottom:0px; padding-bottom:20px;'>
 <img src='imgs/sign.png' width='222px' height='182px'></div>

</div>";		
		
		
		
$so=mysql_query("UPDATE `stouse` SET `Printed`='1' WHERE `Voucher`='$vous' AND `Action`='PROFORMA' ORDER BY `Number` ASC LIMIT 100");		
		
			?>
	
	 <script type="text/javascript">
    window.print();
</script>
<?php
	echo"</center></div><div class='DONTPrint'></body></html>";
}
exit;
}

?>