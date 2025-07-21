<?php
$do=mysql_query("SELECT *FROM `sales` WHERE `Status`='0' AND `Voucher`='$vous' AND `Tnumber`='$tabl' ORDER BY `Number` ASC LIMIT 100");
				if($fo=mysql_num_rows($do)){
				   ?>
             

								 <form action="" method="post" class="form-horizontal "> 
				<table class="table table-striped">     
                                      <thead>
                    <tr role="row">
                     <th class="hidden-xs">&nbsp;&nbsp;&nbsp;&nbsp;# </th>
                       <th> Table </th>
                       <th> Owner </th>
                       <th> Due&nbsp;Date </th>
                        <th> Item&nbsp;Name </th>
                       <th width='5%'> Price </th>
                       <th width='5%'> Quantity </th>
						<th width='5%'>Amount</th>
                        <th class="hidden-xs hidden-print" style="width:40px; text-align:center;" colspan='2'> Options </th>
                     </tr>
                    </thead>
                                        <tbody>
					<?php
					$n=1;				$tot=0;	
						while($ro=mysql_fetch_assoc($do)){
							$num=$ro['Number'];
				$vou=$ro['Voucher'];
				$dte=$ro['Date'];
				$user=$ro['Cashier'];
				$pri=$ro['Price'];
				$prio=number_format($pri);
				$qty=$ro['Quantity'];
				$item=$ro['Item'];
				$waiter=$ro['Owner'];
				$tabl=$ro['Tnumber'];
				$sales=$ro['Orders'];

				if($sales=='0')
					$stao='Open';
				else
					$stao='Closed';
				$to=$qty*$pri;
				$too=number_format($to);

	$dop=mysql_query("SELECT *FROM `items` WHERE `Number`='$item' ORDER BY `Number` DESC LIMIT 1");
				$rop=mysql_fetch_assoc($dop);
					$iname=$rop['Iname'];

					$stn="padding:1px;";

		print("<tr><form method='post' action=''>
		<td style='padding:0px; $stn' class=hidden-xs><div align='center'>$n&nbsp;&nbsp;</td>
		<td style='padding:0px; $stn'><div align='left'> $tabl </td><td style='padding:0px; $stn'> $user </td>
		<td style='padding:0px; $stn'> $dte </td><td style='padding:0px; $stn'> $iname </td>

		<td style='padding:0px; $stn'><input name='pri' class='form-control' type='text' onkeyup='format(this);' onkeypress='return isNumberKey(event);' onChange=this.style.color='#ff3366' style='text-align:right; width:80px; height:20px; margin:0px 0px 0px 0px; padding:0px 10px 0px 0px; margin:0px;' value='$prio' readonly></td>

		<td style='padding:0px; $stn'><input name='qty' class='form-control' type='text' onkeyup='format(this);' onkeypress='return isNumberKey(event);' onChange=this.style.color='#ff3366' style='text-align:right; width:80px; height:20px; margin:0px 0px 0px 0px; padding:0px 10px 0px 0px; margin:0px;' value='$qty' readonly></td>
						
		<td style='padding:0px;$stn'><input name='tot' class='form-control' type='text' onkeyup='format(this);' onkeypress='return isNumberKey(event);' onChange=this.style.color='#ff3366' style='text-align:right; width:80px; height:20px; margin:0px 0px 0px 0px; padding:0px 10px 0px 0px; margin:0px;' value='$too' readonly></td>
						
						
						<td class='hidden-xs hidden-print' align='right' style='width:40px; padding:0px; $stn'>
         <input type='hidden' name='num' value='$num'><button type='button' class='btn btn-xs btn-warning hidden-print' name='edit' style='height:18px; padding:0px;' title='Edit' data-toggle='tooltip' data-placement='top' disabled>&nbsp;&nbsp;<i class='lnr lnr-pencil'></i>&nbsp;&nbsp;</button></td></form>
						  
		 <form method='post' action=''><td class='hidden-xs hidden-print' align='right' style='width:40px; padding:0px; $stn'>
		<input type='hidden' name='num' value='$num'>
						<input type='hidden' name='dato' value='$dato'><input type='hidden' name='datos' value='$datos'>
						<button type='button' class='btn btn-xs btn-danger hidden-print' name='delo' style='height:18px; padding:0px;' title='Delete' data-toggle='tooltip' data-placement='top' disabled>
						  &nbsp;&nbsp;<i class='lnr lnr-trash'></i>&nbsp;&nbsp;</button></td></form></tr>");
						  $n++;					$tot+=$to;
						}
						$toto=number_format($tot);			
						?>
						
                   








 </tbody>

					 <thead>
					<tr><th class="hidden-xs"><div align='center'> &nbsp;&nbsp; </th><th colspan='4'><div align='center'> Total Amount </th>
					<th colspan='3' style='padding:0px;'><div align='right'><?php echo"<input name='tot' class='form-control' type='text' onkeyup='format(this);' onkeypress='return isNumberKey(event);' onChange=this.style.color='#ff3366' style='text-align:right; width:100%; height:20px; margin:0px 0px 0px 0px; padding:0px 10px 0px 0px; margin:0px; font-weight:bold; color:#ff66cc;' value='$toto' readonly>"; ?></th><th colspan='2'><div align='center'> -- </th></tr>

					<tr><th class="hidden-xs"> </div>
					<th colspan='2'><div align='right'>
					<?php 
						 if($tot>0 AND $_SESSION['Xpai']=='1'){
						?>
			<button type='button' class='btn btn-xs btn-warning hidden-print' name='edit' style="height:22px; padding:2px; margin:5px; width:120px;" title='Add a payment' data-toggle='tooltip' data-placement='top' onclick="myFunction(); return pageScroll();" id='displayText' > &nbsp;&nbsp;<i class='lnr lnr-plus-circle'></i>&nbsp;Add Payment&nbsp;</button>
					 <?php
					}
						$pay=0;
	$spa=mysql_query("SELECT *FROM `payment` WHERE `Voucher`='$vou' AND `Status`='0' AND `Branche`='$tabl' AND `Destin`='SALES' ORDER BY `Number` ASC");
				while($rpa=mysql_fetch_assoc($spa)){
						$pay+=$rpa['Cheque']+$rpa['Bank']+$rpa['Credit']+$rpa['Cash'];
				}
				$payo=number_format($pay);
				$bal=$tot-$pay;
				$bali=number_format($bal);

				if($bal>5 OR $bal<-5){
					$balo="<div align='center'><font color='#ff3366'> $bali";
					$miss++;
				}
				else
					$balo="<div align='center'> --";
					 ?></th>
					 
					<form action='' method='post'><th colspan='2'><div align='left'>
					<?php 
						 if($pay!=0 AND $_SESSION['Cancel']=='1'){
						echo"<input type='hidden' name='vous' value='$vous'><input type='hidden' name='tabl' value='$tabl'>						
						<input type='hidden' name='dato' value='$dato'><input type='hidden' name='datos' value='$datos'>";
						?>
			<button type='submit' class='btn btn-xs btn-danger hidden-print' name='rpay' style="height:22px; padding:2px; margin:5px; width:130px;" title='Remove all payments' data-toggle='tooltip' data-placement='top'> &nbsp;&nbsp;<i class='lnr lnr-cross'></i>&nbsp;Remove Payment&nbsp;</button>
					 <?php
					}
						?>				 
					 
					 </th></form><th><div align='center'> &nbsp; </th>
		<th colspan='2'><div align='right'><?php echo $payo ?>&nbsp;&nbsp;&nbsp;&nbsp;</th><th colspan='2'><?php echo $balo ?></th></tr>

                  </table><br><form action='' method='post'>

				  <div id='myDIV' style="display: none; border:1px solid powderblue; border-radius:5px; padding:15px; color:#000099; font-weight:normal; margin:0px 20px 10px 20px; height:70px;">
		
		
		<div class="form-group">
		<div class="col-md-1"><?php echo"<input type='hidden' name='vous' value='$vous'><input type='hidden' name='tabl' value='$tabl'>
						<input type='hidden' name='dato' value='$dato'><input type='hidden' name='datos' value='$datos'>" ?> </div>

			
            <div class="col-md-2">
           <input name="cash" class="form-control" type="text" onkeyup='format(this);' onkeypress='return isNumberKey(event)' style="text-align:center;" placeholder="CASH" autofocus="autofocus" autocomplete='off'>
            </div>

            <div class="col-md-2">
           <input name="cheque" class="form-control" type="text" onkeyup='format(this);' onkeypress='return isNumberKey(event)' style='text-align:center;' placeholder="CHEQUE" autocomplete='off'>
            </div>
					
			
            <div class="col-md-2">
           <input name="bank" class="form-control" type="text" onkeyup='format(this);' onkeypress='return isNumberKey(event)' style='text-align:center;' placeholder="CC/BANK" autocomplete='off'>
            </div>

			
            <div class="col-md-2">
           <input name="credit" class="form-control" type="text" onkeyup='format(this);' onkeypress='return isNumberKey(event)' style='text-align:center;' placeholder="CREDIT" autocomplete='off' id="GlobalSearchInput">
            </div>

			<div class="col-md-2">
			<button class="btn btn-md btn-block btn-success" type="submit" name="pay"  title='PAY' data-toggle='tooltip' data-placement='top'>
			<i class="lnr lnr-plus-circle" onClick='return validatepay(form);'></i> PAY </button>
			 </div>

				</div>
		</div>


 <script type="text/javascript">

	  $(document).ready(function() {
  $("#GlobalSearchInput").keyup(function() {
    var x = document.getElementById('showSearchDiv');
    if($(this).val() == "") {
      x.style.display = 'none';
    } else {
      x.style.display = 'block';
    }
  });
});

function validatepay(formCheck) 
{ 
if (formCheck.cash.value == "" && formCheck.cheque.value == "" && formCheck.bank.value == "" && formCheck.credit.value == "")
{ 
alert("Please, enter paid amount."); 
formCheck.cash.focus();
return false;
}
if (formCheck.credit.value != "" && formCheck.account.value == "")
{ 
alert("Please, select account for credit amount."); 
formCheck.account.focus();
return false;
}
return true;
}
</script>


		<div id='showSearchDiv' style="display: none; border:1px solid powderblue; border-radius:5px; padding:15px; color:#000099; font-weight:normal; margin:0px 10px 50px 20px; height:70px;">
<div class="col-md-3"> </div>
	<div class="col-md-2"> &nbsp; </div><div class="col-md-4">
			  <select class="form-control" name="account">			
			 <?php
				echo"<option value='' style='font-size:16px; padding:5px 10px 5px 15px;' selected='selected'> SELECT CUSTOMER </option>";
				  $top=mysql_query("SELECT *FROM `account` WHERE `Status`='0' GROUP BY `Customer` ORDER BY `Customer` ASC");
						while($rop=mysql_fetch_assoc($top)){
							$sup=$rop['Customer'];
							$cus=$rop['Number'];
							if($dst==$sup)
					$s='selected';
				else
					$s='';
			echo"<option value='$cus' style='font-size:16px; padding:5px 10px 5px 15px;' $s> $sup </option>";
						}
						?>
		</select>
		<?php
							echo"<input type='hidden' name='custo' value='$num'>";
						?>
			</label>
</div>
</form>
				  
				  <?php
				}
				?>
