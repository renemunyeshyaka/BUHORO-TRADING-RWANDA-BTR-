<?php
include'connection.php';
if(isset($_GET['vjghfcdxszdhvgbjhvcxfzdbnvs']))
			{
			$vou=$_GET['vjghfcdxszdhvgbjhvcxfzdbnvs'];
			$store=$_GET['khjgdgfhjfhgfdghdg'];
			$action=$_GET['kgfhgvdbfghb'];
	
$do=mysql_query("SELECT *FROM `stouse` WHERE `Voucher`='$vou' AND `Status`='0' AND `Action`='$action' AND `Store`='$store' ORDER BY `Number` ASC LIMIT 100");
        $fo=mysql_num_rows($do);
        $ro=mysql_fetch_assoc($do);
			$nu=$ro['Number'];
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

				$da=$ro['Date'];
				$ti=$ro['Time'];
				
				$pieces = explode(" ", $empo);
                    $empo = $pieces[0];		
            $dat=date('d-M-Y', strtotime($da));


$doibi=mysql_query("SELECT `Customer`, `Address`, `Telephone`, `Tin`, `Delegator` FROM `account` WHERE `Number`='$cli' ORDER BY `Number` ASC");
		$roibi=mysql_fetch_assoc($doibi);
			$clie=$roibi['Customer'];
			$addie=$roibi['Address'];
			$tini=$roibi['Tin'];
			$dele=$roibi['Delegator'];
			$year=date('Y', strtotime($da));
			
	$k=1;                      $pre=8-$fos;                   $fre=8-$fos;

	print("<h4> DELIVERY NOTE </h4>
<label style='float:right; text-align:right; margin-top:-25px; font-size:12px;'><b> QR SCAN &nbsp;&nbsp; </b></label>
<TABLE BORDER='1' STYLE='font-size: 11px;	
	border-width: 1px;
	border-color: #999999;
	border-collapse: collapse;
	width: 99%; margin-top:0px;
	font-weight:bold; margin-top:-15px;
	padding-top:0px; color: #333333z;'>
	<TR><TD ROWSPAN='6' WIDTH='50%' VALIGN='TOP'>

		<table width=100% border='0' style='font-size:11px; font-weight:bold;'>
		<tr><td width='1%' align='right'><img src='../imgs/logo.png' width='100px' height='70px'></td>
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

		<table width='100%' border='1' style='font-size:14px; border-width: 1px;
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
	print("<tr><th> </th><th style='text-align:right'> TOTAL &nbsp;</th>
	<th style='text-align:right'>&nbsp;$boxo&nbsp;$unit&nbsp;</th>
	<th> </th></tr></table><br></TD></TR>");
	
	/*	
	print("<TR><TD COLSPAN='3' style='padding-left:5px;'> <br><br>");
	/*
while($fre>0){
echo"<br>";
$fre--;
}


	include 'phpqrcode/qrlib.php';
    $text = "https://sales.buhorotr.rw/jksdfhgksjdgfbkjgf/rsdzfhkfgsfdasdhjx.php?vjghfcdxszdhvgbjhvcxfzdbnvs=$vou&kgfhgvdbfghb=$action&khjgdgfhjfhgfdghdg=$store";
    QRcode::png($text, 'qrcodes/image.png');
    echo"<img src='qrcodes/image.png' alt='' height='110' width='120'>";
    
    
print("Remarks: <br> BEING DELIVERED $box $unit OF GOODS <br> Party's VAT No. : $tini <br><br><br>
	 <u>Decralation</u><br>
	 Received in good condition. <br><br>
	 
	 <div style='width:240px; height:100px; margin-top:-98px; float:right; text-align:center; border: 1px solid #999999; border-collapse: collapse; padding:10px; font-size:10px;'> For $cna <br><br><br><br><br><br> Authorized Signature</div>
	 
	 </TD></TR></TABLE><font size='2'>SUBJECT TO $city, $country JURISDICTION</font><br>
	<font size='1'>This is a Computer Generated Document</font><br>");
	if($k!=$fos)
	    echo"<p style='page-break-before: always'>";
	                $k++;
				

	print("</DIV><div class='DONTPrint'>");
	*/
	echo"</table></body></html>";
}
else
header("location:https://buhorotr.rw");
		?>
