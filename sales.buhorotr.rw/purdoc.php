<?php
session_start();
if($_SESSION['Userid'] == null)
	Header("location:index.php");
?>
<!DOCTYPE html>
<HTML>
 <HEAD>
  <TITLE> PURCHASE </TITLE>
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

	//$vous=$_SESSION['Vouch'];
if(isset($_POST['vous']))
		{
			$vous=$_POST['vous'];
		}


$tot=0;
$dore=mysql_query("SELECT *FROM `stouse` WHERE `Voucher`='$vous' AND `Action`='PURCHASE'");
while($rore=mysql_fetch_assoc($dore)){
			$vouch=$rore['Voucher'];
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


</div><div id="page-wrap">

		<textarea id="header" style='border: 1px solid #000000'>PURCHASE ORDER</textarea>
		
		<div id="identity">
		
            <textarea id="address" STYLE='background-color: transparent; height:80px; width:410px;'>
			<?php
			echo"$cna 
			$adde 
			TIN/VAT: $tin 
			Phone: $pho1  $pho2";

		?></textarea>

          
		<div id="logon" style='height:20px; width:80px; position:relative; float:right; color:#FF6600;'><div class="DONTPrint"> <INPUT TYPE="submit" VALUE="PRINT" NAME="see" STYLE='cursor:pointer; height:20px; width:80px; border:1px solid grey; border-radius:5px; color:#FF6600; font-weight:bold;' onclick='javascript:printpage();window.close()'> </div></div>


		<div style="clear:both"></div>
		
		<div id="customer">
<br>
            <textarea id="customer-title" STYLE='background-color: transparent; text-align:left;'><?php echo $dest ?>

KIGALI</textarea>

            <table id="meta">
                <tr style='height:20px;'>
                    <td class="meta-head">P/O No</td>
                    <td><div STYLE='background-color: transparent;'> # 0<?php echo $vous ?></textarea></td>
                </tr>
                <tr style='height:20px;'>

                    <td class="meta-head">Due Date</td>
                    <td><div STYLE='background-color: transparent;'><?php echo $due ?></textarea></td>
                </tr>
                <tr style='height:20px;'>
                    <td class="meta-head">Amount</td>
                    <td><div STYLE='background-color: transparent;'>FRW <?php echo $toto ?></div></td>
                </tr>

            </table>
		
		</div>
		
		<table id="items">
		
		  <tr>
		      <th width='8%'>No</th>
		      <th width='20%'>Brand&nbsp;Name</th><th>Item</th>
		      <th width='14%'>Price/Unit</th>
		      <th width='11%'>Quantity</th>
		      <th width='15%'>Amount</th>
		  </tr>

		  <?php
			 		$n=1;			$tot=0;
		$dore=mysql_query("SELECT *FROM `stouse` WHERE `Voucher`='$vous' AND `Action`='PURCHASE'");
	while($rox=mysql_fetch_assoc($dore)){
		$item=$rox['Item'];
		$qty=$rox['Quantity'];
		$pri=$rox['Price'];
			$amo=$qty*$pri;

			$do=mysql_query("SELECT *FROM `items` WHERE `Number`='$item' ORDER BY `Number` DESC LIMIT 1");
					$ro=mysql_fetch_assoc($do);
						$iname=$ro['Iname'];
						$kin=$ro['Type'];
						$descri=$ro['Descri'];
						$uno=$ro['Unit'];
			$count=$ro['Count'];
			if($count=='0')
				$count=1;
			$qty=round($qty/$count);
			$pri=$pri*$count;

				$dox=mysql_query("SELECT *FROM `unit` WHERE `Number`='$uno' ORDER BY `Number` ASC");
					$rox=mysql_fetch_assoc($dox);
							$unit=$rox['Unit'];
							
		$doxi=mysql_query("SELECT *FROM `itype` WHERE `Number`='$kin' ORDER BY `Type` ASC");
					$roxi=mysql_fetch_assoc($doxi);
							$type=$roxi['Type'];

	$prio=number_format($pri, 2);				$amoo=number_format($amo, 2);
		 print("<tr class='item-row' onMouseover=this.bgColor='#009999' onMouseout=this.bgColor='' style='height:5px;'>
		 <td class='item-name'><div align='center'><span> &nbsp; $n &nbsp; </span></div></td><td class='description'><span> &nbsp; $type </span></td>
		       
		 <td class='item-name'><span> &nbsp; $iname </span></td>");

		 print("<td align='right'><span class='cost'>$prio</span></td>
		      <td align='right'><span class='qty'>$qty</span></td>
		      <td align='right'><span class='price'>$amoo&nbsp;</span></td>
		  </tr> ");
			  $n++;				$tot+=$amo;
	}
	while($t<=6){
		 print("<tr class='item-row' onMouseover=this.bgColor='#009999' onMouseout=this.bgColor='' style='height:5px;'>
		 <td class='item-name'><span> &nbsp; </span></td> <td class='item-name'><span> &nbsp; </span></td>
		 <td class='description'><span> &nbsp; </span></td>
		      <td align='right'><span class='cost'> &nbsp; </span></td>
		      <td align='right'><span class='qty'> &nbsp; </span></td>
		      <td align='right'><span class='price'> &nbsp; </span></td></tr> ");
		  $t++;
	}

	$tb=number_format($tb, 2);
	$ta=number_format($ta, 2);
	$vat=number_format($vat, 2);
	$toto=number_format($tot, 2);

	 print(" <tr class='item-row' onMouseover=this.bgColor='#009999' onMouseout=this.bgColor=''>
		 <td class='item-name' colspan='6'><span> <hr> </span></td></tr> ");
	?>
		  
		
		  
		
		  <tr>
		      <td colspan="3" class="total-line balance">Total Amount</td>
		      <td colspan="3" class="total-value balance" align='right'><div class="due">RWF <?php echo $toto ?></div></td>
		  </tr>
		
		</table>
		
		<div id="terms"><br><br><div id="logon" style='height:20px; width:180px; position:relative; float:right; color:#FF6600;'><div class="DONTPrint"> <INPUT TYPE="submit" VALUE="PRINT" NAME="see" STYLE='cursor:pointer; height:20px; width:80px; border:1px solid grey; border-radius:5px; color:#FF6600; font-weight:bold;' onclick='javascript:printpage();window.close()'> </div></div><br><br>
		  <h5>Terms</h5>
		  <textarea style='padding-top: 15px; font-size:10px;'>The above mantionned items will be reveived upon delivery with a purchase invoice.</textarea>
		</div>
	
	</div>
<div class="DONTPrint"><BR><div class="row hidden-print" style='position: fixed; width:100%; margin:0px; left: 0px; bottom: 0px; background-color: #996633; color: white; text-align: center; height:30px; padding-top:6px; clear: both; z-index: 10;'>
&nbsp;&nbsp;

</div>
 </BODY>
 </HTML>
