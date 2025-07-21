<HTML>
 <HEAD>
  <TITLE> RECEIVE </TITLE>

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

<style type=text/css>
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

 </HEAD>
 <BODY>

 <?php
$tot=0;
$dore=mysql_query("SELECT `Date`, `Destin`, `Store` FROM `stouse` WHERE `Voucher`='$vous' AND `Action`='RECEIVE'");
while($rore=mysql_fetch_assoc($dore)){
			$dest=$rore['Destin'];
			$dte=$rore['Date'];
			$stor=$rore['Store'];
}

$dob=mysqli_query($cons, "SELECT `Name` FROM `stores` WHERE `Status`>='0' AND `Store`='$stor' ORDER BY `Number` ASC");
                		    $rob=mysqli_fetch_assoc($dob);
		                    	$stor=$rob['Name'];

$rece='RECEIVING';
$due=date('l jS M Y', strtotime($dte)); 
$rece=implode('&nbsp;&nbsp;&nbsp;&nbsp;', str_split($rece));
?>


<div class='DONTPrinti' id="page-wrap" style="border:0px solid blue; 
font-size:10px; width:510px; float:left;">

		<div style='height:45px; text-align:center; padding:5px; font-size:24px; border:1px solid #090909; background-color:#fdfdfd; border-collapse: collapse;'><?php echo $rece; ?></div>
		
	<br><br>
		
            <textarea id="address" style='background-color: transparent; height:120px; width:350px; margin-bottom:-20px; font-size:10px; border:0px;'>
			<?php
			echo"$cna 
			$city - $country 
			TIN/VAT: $tax 
			TEL: $pho1 / $pho2 
                        $mail";

		?>
        </textarea><br>
        
        <div style="float:right;padding-right:10px; font-size:12px;">
            <?php echo" 
			VOUCHER No: <b>$vous</b><br>
			STORE: <b>$stor</b>";
			?>
        </div><br><br>
		
          
		

	<div style="clear:both;"></div>	
		
		<span style='float:left; text-align:left;margin-bottom-20px;'><?php echo"&nbsp; $due &nbsp;"; ?></span><br>
		<span style='float:right; text-align:right;'><b>SUPPLIER:</b><?php echo $dest ?> &nbsp;</span><br>

		<div id="customer">
			
           <table BORDER='1' STYLE="font-size: 11px;
	border-width: 1px;
	border-color: #999999;
	border-collapse: collapse;
	width: 100%; margin-top:0px;
	font-weight:bold; margin-top:-15px;
	padding-top:0px; color: #333333z;">
			<TR style="height:20px;">
		<TH><center> DESCRIPTION </TH>
		<TH width='15%'><center> QUANTITY </TH>
		<TH width='10%'><center> UNIT </TH>
		<TH width='15%'><center> PRICE </TH>
		<TH width='15%'><center> TOTAL </TH>
			</TR>

		  <?php
		  					$n=1;				$amo=$tqt=0;
	$do=mysql_query("SELECT *FROM `stouse` WHERE `Voucher` = '$vous' AND `Status`='0' AND `Action`='RECEIVE'");

			 	while($ro=mysql_fetch_assoc($do)){
				$code=$ro['Number'];
				$item=$ro['Item'];			
			$cost=$ro['Cost'];			$costo=number_format($cost);
			$qt=$ro['Quantity'];			$qto=number_format($qt);
			$dte=$ro['Date'];
			$type=$ro['Destin'];
			$pers=$ro['Person'];
			$comm=$ro['Comment'];
			$pri=$ro['Price'];				
			$prio=number_format($pri, 2);
			

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

	    $toto=number_format($tot);				$amoo=number_format($amo);
		 print("<tr class='item-row' onMouseover=this.bgColor='#009999' onMouseout=this.bgColor='' style='height:5px;'>
		 <td class='item-name'><span>&nbsp;$n.&nbsp;$iname $descri </span></td>
			<td align='right'><span class='cost'>$qto&nbsp;</span></td>
			<td class='item-name'><span>&nbsp;$unit </span></td>
		      <td align='right'><span class='qty'>$prio&nbsp;</span></td>
		      <td align='right'><span class='price'>$toto&nbsp;</span></td>
		  </tr> ");
			  $n++;				$amo+=$tot;         $tqt+=$qt;
	}
	while($t<=6){
		 print("<tr class='item-row' onMouseover=this.bgColor='#009999' onMouseout=this.bgColor='' style='height:5px;'>
		 <td class='item-name'><span> &nbsp; </span></td>
		      <td align='right'><span class='cost'> &nbsp; </span>
			</td><td class='item-name'><span> &nbsp; </span></td>
		      <td align='right'><span class='qty'> &nbsp; </span></td>
		      <td align='right'><span class='price'> &nbsp; </span></td></tr> ");
		  $t++;
	}
	$amoo=number_format($amo);                  $tqto=number_format($tqt);
	?>
		 
		  <tr>
		      <td colspan="2" class="total-line balance">Total Amount
		      <label style="float:right;"><b><?php echo $tqto ?></b></label>
		  </td><td colspan="3" class="total-value balance" align='right'>
		      <div class="due">RWF <?php echo"$amoo"; ?>&nbsp;</div></td>
		  </tr>
		
		</table>
		
		<?php
	if($comm)
	echo"<br> &nbsp;&nbsp;&nbsp;&nbsp; <b>Reference:</b> $comm";
		?>
	<br><br><span style="text-align:left; float:left;">
	SUPPLIED BY: ------------------------- &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; RECEIVED BY: ---------------------------- 
<br><br> ------------------------------------------------ &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; ---------------------------------------------<br>
	<font size='1'>&nbsp;</font><br>
	</span> 
	
	
	<span style="text-align:right; float:right;"><br><br><br>
	<br>APPROVED BY: ----------------------------------- <br><br> ----------------------------------------------- <br>
	<font size='1'> &nbsp;&nbsp;&nbsp; </font><br>
	</span></div><br>

			
		<br><br>
		  <h5>&nbsp;</h5>
		  <label style='padding-top: 15px; font-size:10px;'>&nbsp;</label>
		</div>
	
	</div>
<div class="DONTPrint">

 <script type="text/javascript">
    window.print();
</script>
 </BODY>
 </HTML>
