<?php	
	$dox=mysql_query("SELECT *FROM `sales` WHERE `Status`='0' AND `Paid`='0' AND `Voucher`!='0' AND `Sales`!='0' GROUP BY `Voucher` ORDER BY `Voucher` ASC LIMIT 100");
		if($fox=mysql_num_rows($dox)){
	while($rox=mysql_fetch_assoc($dox)){
		$vous=$rox['Voucher'];
$do=mysql_query("SELECT *FROM `sales` WHERE `Status`='0' AND `Paid`='0' AND `Voucher`='$vous' ORDER BY `Number` ASC LIMIT 100");
			//	if($fo=mysql_num_rows($do)){
				   ?>
             
		<form action="orders.php" method="post">
				<table class="table table-striped">     
                       <thead><tr role="row">
                     <th width='5%' class="hidden-xs">&nbsp;&nbsp;&nbsp;&nbsp;# </th>
                       <th width='8%' class="hidden-xs"> Status </th>
                       <th width='8%'> Table </th>
                       <th width='17%'> Owner </th>
                       <th width='15%'> Due&nbsp;Date </th>
                        <th> Item&nbsp;Name </th>
                       <th width='5%'> Price </th>
                       <th width='5%'> Quantity </th>
						<th width='5%'>Amount</th>
                     </tr>
                    </thead>
                                        <tbody>
					<?php
					$n=1;				$tot=0;	
						while($ro=mysql_fetch_assoc($do)){
							$num=$ro['Number'];
				$vou=$ro['Voucher'];
				$dte=$ro['Date'];
				$tme=$ro['Time'];
				$user=$ro['Cashier'];
				$pri=$ro['Price'];
				$prio=number_format($pri);
				$qty=$ro['Quantity'];
				$item=$ro['Item'];
				$waiter=$ro['Owner'];
				$tabl=$ro['Table'];
				$sales=$ro['Sales'];

				if($sales=='0')
					$stao='Open';
				else
					$stao='Closed';
				$to=$qty*$pri;
				$too=number_format($to);

	$dop=mysql_query("SELECT *FROM `items` WHERE `Number`='$item' ORDER BY `Number` DESC LIMIT 1");
				$rop=mysql_fetch_assoc($dop);
					$iname=$rop['Iname'];
			$otb=0;

					$stn="padding:0px;";

		print("<tr>
		<td class=hidden-xs style='$stn'><div align='center'>$n&nbsp;&nbsp;</td>
		<td class=hidden-xs style='color:powderblue; $stn'><div align='left'> Closed </td>
		<td style='$stn'><div align='left'><b> $tabl </td><td style='$stn'> $user </td>
		<td style='$stn'> $dte &nbsp; $tme </td><td style='$stn'> $iname </td>

		<td style='padding:0px;'><input name='pri' class='form-control' type='text' onkeyup='format(this);' onkeypress='return isNumberKey(event);' onChange=this.style.color='#ff3366' style='text-align:right; width:80px; height:20px; margin:0px 2px 0px 0px; padding:0px 10px 0px 0px;' value='$prio' readonly></td>

		<td style='padding:0px;'><input name='qty' class='form-control' type='text' onkeyup='format(this);' onkeypress='return isNumberKey(event);' onChange=this.style.color='#ff3366' style='text-align:right; width:80px; height:20px; margin:0px 2px 0px 0px; padding:0px 10px 0px 0px;' value='$qty' readonly></td>
						
		<td style='padding:0px;'><input name='tot' class='form-control' type='text' onkeyup='format(this);' onkeypress='return isNumberKey(event);' onChange=this.style.color='#ff3366' style='text-align:right; width:80px; height:20px; margin:0px 0px 0px 0px; padding:0px 10px 0px 0px;' value='$too' readonly></td></tr>");
						  $n++;					$tot+=$to;
						}
						$tpo=number_format($tot);
						if($otb)
							$otbo="$otb &nbsp;&nbsp; + &nbsp;&nbsp; $tpo";
						else
							$otbo="$tpo";
						?>
						
                    </tbody><thead><tr>
					<th class='hidden-xs' style='padding:3px;'> </th><th colspan='3' style='padding:3px;'>
					<?php
						 echo"<input type='hidden' name='vous' value='$vou'><input type='hidden' name='tabl' value='$tabl'>";
						?>
                          <button type='submit' class='btn btn-xs btn-info hidden-print' name='paid' style='height:18px; padding:0px; margin:0px; width:80px;' title='Click to open this invoice' data-toggle='tooltip' data-placement='top'>
						  &nbsp;&nbsp;<i class='lnr lnr-download'></i>&nbsp;&nbsp;Open&nbsp;&nbsp;</button>
					
					<?php
						 echo"<input type='hidden' name='vout' value='$vou'><input type='hidden' name='tabl' value='$tabl'>";
					if($_SESSION['Cancel']=='0'){
						$dso='disabled';
						$btz='button';
					}
					else{
						$btz='submit';
						$dso='';
					}
					?>
                         <button type="<?php echo $btz ?>" class='btn btn-xs btn-danger hidden-print' name='delosa' style='height:18px; padding:0px; margin:0px; width:80px;' title='Delete this invoice' data-toggle='tooltip' data-placement='top' <?php echo $dso ?>>
						  &nbsp;&nbsp;<i class='lnr lnr-trash'></i>&nbsp;&nbsp;Delete&nbsp;&nbsp;</button>
					
					 </th><th colspan='2' style='color:powderblue; font-size:10px; padding:3px'><div align='center'><?php echo $vou ?></th>
					<th colspan='3' style='padding:0px;'><div align='right'><?php echo"<input name='tot' class='form-control' type='text' onkeyup='format(this);' onkeypress='return isNumberKey(event);' onChange=this.style.color='#ff3366' style='text-align:right; width:100%; height:20px; margin:0px 0px 0px 0px; padding:0px 10px 0px 0px; margin:0px; font-weight:bold; color:#ff66cc;' value='$otbo' readonly>"; ?></th></tr>
                  </table></form><br>

				  <?php
				}
	}
	?>