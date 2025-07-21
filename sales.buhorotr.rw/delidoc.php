<?php
session_start();
if($_SESSION['Userid'] == null)
	Header("location:index.php");
?>
<!DOCTYPE html>
<HTML>
 <HEAD>
  <TITLE> DELIVERY </TITLE>
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
<link rel='stylesheet' type='text/css' href='css/style.css' />

 </HEAD>
 <BODY bgcolor="#COCOCO"><CENTER>

 <?php 
include'connection.php';

//	$vous=$_SESSION['Vouch'];
if(isset($_POST['open']))
		{
			$vous=$_POST['vous'];
		}


$tot=0;
$dore=mysql_query("SELECT *FROM `stouse` WHERE `Voucher`='$vous' AND `Action`='TAKEN'");
while($rore=mysql_fetch_assoc($dore)){
			$vous=$rore['Voucher'];
			$dte=$rore['Date'];
			$user=$rore['User'];
			$dest=$rore['Destin'];
			$pers=$rore['Person'];
			$sale=$rore['Price'];
			$qt=$rore['Quantity'];
			$tot+=($sale*$qt);
}


$due=date('l jS M Y', strtotime($dte)); 

$toto=number_format($tot);
?>


</div><div id="page-wrap">

		<textarea id="header" style='border: 1px solid #000000'>DELIVERY VOUCHER No <?php echo $vous ?></textarea>
		
		<div id="identity" style="border:0px solid blue;">
		
            <textarea id="address" style='background-color: transparent; height:80px; width:420px; margin-bottom:-20px'>
			<?php
			echo"$cna 
			$adde 
			TIN/VAT: $tin 
			Phone: $pho1  $pho2";

		?></textarea>

          
		<div id="logon" style='height:20px; width:80px; position:relative; float:right; color:#FF6600;'><div class="DONTPrint"> 
		<INPUT TYPE="submit" VALUE="PRINT" NAME="see" STYLE='cursor:pointer; height:20px; width:80px; border:1px solid grey; border-radius:5px; color:#FF6600; font-weight:bold;' onclick='javascript:printpage();window.close()'> </div></div>

		<div style="clear:both; border:0px solid blue;"></div>
		
		<span style='float:left; text-align:left;margin-bottom-20px;'>&nbsp;<br><?php echo" $due &nbsp; $Time"; ?></span>
		<span style='float:right; text-align:right;'><b>DESTINATION:</b><?php echo"$dest / $pers"; ?>&nbsp;</span><br><br>

		<div id="customer">
			
           <table id='items'>
			<TR>
		<TH width='10%'> No </TH>
		<TH> DESCRIPTION </TH>
		<TH width='15%'> UNITY </TH>
		<TH width='15%'> QUANTITY </TH>
		<TH width='15%'>PRICE</TH>
		<TH width='15%'>TOTAL</TH>
			</TR>

		  <?php
		  					$n=1;				$amo=0;
	$do=mysql_query("SELECT *FROM `stouse` WHERE `Voucher` = '$vous' AND `Status`='0' AND `Action`='TAKEN'");

			 	while($ro=mysql_fetch_assoc($do)){
				$code=$ro['Number'];
				$item=$ro['Item'];			
			$cost=$ro['Cost'];			$costo=number_format($cost, 2);
			$qt=$ro['Quantity'];			$qto=number_format($qt, 2);
			$dte=$ro['Date'];
			$type=$ro['Destin'];
			$pers=$ro['Person'];

			if($type=='PRODUCTION A' OR $type=='PRODUCTION B'){
			$pri=$ro['Cost'];				
			$prio=number_format($pri, 2);
			}
			else{
			$pri=$ro['Price'];				
			$prio=number_format($pri, 2);
			}

	$dov=mysql_query("SELECT *FROM `items` WHERE `Number`='$item' ORDER BY `Number` DESC LIMIT 1");
		$rov=mysql_fetch_assoc($dov);
			$kin=$rov['Type'];
			$descri=$rov['Descri'];
			$uno=$rov['Unit'];
			$iname=$rov['Iname'];				

				$dox=mysql_query("SELECT *FROM `unit` WHERE `Number`='$uno' ORDER BY `Number` ASC");
					$rox=mysql_fetch_assoc($dox);
							$unit=$rox['Unit'];
	$tot=$qt*$pri;

		  $toto=number_format($tot, 2);					$amoo=number_format($amo, 2);
		 print("<tr class='item-row' onMouseover=this.bgColor='#009999' onMouseout=this.bgColor='' style='height:5px;'>
		 <td class='item-name'><div align='center'><span> &nbsp; $n &nbsp; </span></div></td> 
		 <td class='item-name'><span>&nbsp;$iname $descri </span></td>
			<td class='item-name'><span>&nbsp;$unit </span></td>
			<td align='right'><span class='cost'>$qto&nbsp;</span></td>
		      <td align='right'><span class='qty'>$prio&nbsp;</span></td>
		      <td align='right'><span class='price'>$toto&nbsp;</span></td>
		  </tr> ");
			  $n++;				$amo+=$tot;
	}
	while($t<=6){
		 print("<tr class='item-row' onMouseover=this.bgColor='#009999' onMouseout=this.bgColor='' style='height:5px;'>
		 <td class='item-name'><span> &nbsp; </span></td> <td class='item-name'><span> &nbsp; </span></td>
		      <td align='right'><span class='cost'> &nbsp; </span></td><td class='item-name'><span> &nbsp; </span></td>
		      <td align='right'><span class='qty'> &nbsp; </span></td>
		      <td align='right'><span class='price'> &nbsp; </span></td></tr> ");
		  $t++;
	}
	$amoo=number_format($amo, 2);
	?>
		 
		  <tr>
		      <td colspan="3" class="total-line balance">Total Amount</td>
		      <td colspan="3" class="total-value balance" align='right'><div class="due">RWF <?php echo"$amoo"; ?>&nbsp;</div></td>
		  </tr>
		
		</table><br>

		<div width='98%' style='font-family: verdana,arial,sans-serif; font-size:11px;'>
	COMMENT/OBSERVATION ------------------------------------ ----------------------------------------------- ------------------------ <br><br>
	------------------------------------ ------------------------------------------- ----------------------- --------------------------------- <BR><BR>

	
	<br><br><span style="text-align:left; float:left;">
	GIVEN BY: ------------------------------------- <br><br> ------------------------------------------------- <br>
	<font size='1'>Main Store</font><br>
	</span> 
	
	
	<span style="text-align:right; float:right;">
	<br>DELIVERED BY: ------------------------------------- <br><br> ------------------------------------------------- <br>
	</span>

<span style="text-align:right; float:right;">
	<br>RECEIVED BY: ----------------------------------- <br><br> ----------------------------------------------- <br>
	<font size='1'>Receiving Site</font><br>
	</span><br></div>

			
		<div id="terms"><br><br><div id="logon" style='height:20px; width:180px; position:relative; float:right; color:#FF6600;'><div class="DONTPrint"> <INPUT TYPE="submit" VALUE="PRINT" NAME="see" STYLE='cursor:pointer; height:20px; width:80px; border:1px solid grey; border-radius:5px; color:#FF6600; font-weight:bold;' onclick='javascript:printpage();window.close()'> </div></div><br><br>
		  <h5>Terms</h5>
		  <textarea style='padding-top: 15px; font-size:10px;'>This document must be signed at delivery site by both side [Deliver and Receiver].</textarea>
		</div>
	
	</div>
<div class="DONTPrint"><BR><div class="row hidden-print" style='position: fixed; width:100%; margin:0px; left: 0px; bottom: 0px; background-color: #996633; color: white; text-align: center; height:30px; padding-top:6px; clear: both; z-index: 10;'>
&nbsp;&nbsp;

</div>
 </BODY>
 </HTML>
