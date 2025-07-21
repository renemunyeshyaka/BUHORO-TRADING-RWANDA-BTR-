<?php
$do=mysql_query("SELECT *FROM `sales` WHERE `Status`='0' AND `Upda`='0' AND `Voucher`='0' AND `Cashier`='$loge' AND `Branche`='$brc' ORDER BY `Number` ASC LIMIT 100");
				if($fo=mysql_num_rows($do)){
					$t=0;
				}
				else{
$dox=mysql_query("SELECT *FROM `sales` WHERE `Status`='0' AND `Voucher`!='0' AND `Sales`='0' AND `Branche`='$brc' AND `Date`='$Date' GROUP BY `Voucher` ORDER BY `Voucher` DESC LIMIT 10");
if($fox=mysql_num_rows($dox)){
	while($rox=mysql_fetch_assoc($dox)){
		$vous=$rox['Voucher'];
$do=mysql_query("SELECT *FROM `sales` WHERE `Status`='0' AND `Voucher`='$vous' AND `Branche`='$brc' AND `Addon`='0' ORDER BY `Number` ASC LIMIT 100");
			//	if($fo=mysql_num_rows($do)){
				   ?>
             
		<form action="orders.php" method="post">
				<table class="table table-striped">     
                       <thead><tr role="row">
                     <th width='5%' class="hidden-xs">&nbsp;&nbsp;&nbsp;&nbsp;# </th>
                       <th width='8%' class="hidden-xs"> Order&nbsp;No </th>
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
				$tabl=$ro['Tnumber'];
				$sales=$ro['Sales'];
				$comme=$ro['Comment'];

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

		$dol=mysql_query("SELECT *FROM `sales` WHERE `Status`='0' AND `Upda`='0' AND `Voucher`!='$vous' AND `Voucher`!='0' AND `Tnumber`='$tabl' AND `Sales`='0' ORDER BY `Number` DESC LIMIT 100");
		if($fol=mysql_num_rows($dol)){
			while($rol=mysql_fetch_assoc($dol)){
				$prl=$rol['Price'];
				$qtl=$rol['Quantity'];
				$otb+=($prl*$qtl);
			}
			$otb=number_format($otb);
		}

					$stn="padding:0px;";

		print("<tr>
		<td class=hidden-xs style='$stn'><div align='center'>$n&nbsp;&nbsp;</td>
		<td class=hidden-xs style='color:red; $stn'><div align='center'> $vou </td>
		<td style='$stn'><div align='left'><b> $tabl </td><td style='$stn'> $waiter </td>
		<td style='$stn'> $dte &nbsp; $tme </td><td style='$stn'> $iname </td>

		<td style='padding:0px;'><input name='pri' class='form-control' type='text' onkeyup='format(this);' onkeypress='return isNumberKey(event);' onChange=this.style.color='#ff3366' style='text-align:right; width:80px; height:20px; margin:0px 2px 0px 0px; padding:0px 10px 0px 0px;' value='$prio' readonly></td>

		<td style='padding:0px;'><input name='qty' class='form-control' type='text' onkeyup='format(this);' onkeypress='return isNumberKey(event);' onChange=this.style.color='#ff3366' style='text-align:right; width:80px; height:20px; margin:0px 2px 0px 0px; padding:0px 10px 0px 0px;' value='$qty' readonly></td>
						
		<td style='padding:0px;'><input name='tot' class='form-control' type='text' onkeyup='format(this);' onkeypress='return isNumberKey(event);' onChange=this.style.color='#ff3366' style='text-align:right; width:80px; height:20px; margin:0px 0px 0px 0px; padding:0px 10px 0px 0px;' value='$too' readonly></td></tr>");
						  $n++;					$tot+=$to;



						  // ************************************** Addon items ****************************************
$dok=mysql_query("SELECT *FROM `sales` WHERE `Voucher`='$vou' AND `Status`='0' AND `Addon`='$num' ORDER BY `Number` ASC LIMIT 100");
		if($fok=mysql_num_rows($dok)){
			while($rok=mysql_fetch_assoc($dok)){
				$clak=$rok['Item'];
				$qtyk=$rok['Quantity'];
	
	$dote=mysql_query("SELECT *FROM `items` WHERE `Number`='$clak' ORDER BY `Number` ASC LIMIT 1");
		$rote=mysql_fetch_assoc($dote);
			$inamee=$rote['Iname'];

		echo("<tr><td class='hidden-xs text-center' style='$stn'>$n&nbsp;&nbsp;</td>
		<td style='color:red; $stn' class='text-center'> $vou </td><td style='$stn'><div align='left'><b> $tabl </td>
		<td style='color:powderblue; $stn'> $waiter </td><td style='color:powderblue; $stn'> $dte &nbsp; $tme </td>
		<td style='color:powderblue; $stn'> $inamee </td>

		<td style='color:powderblue; padding:0px;' class='text-center'>--</td>
		<td style='color:powderblue; padding:0px;' class='text-center'>$qtyk</td>
		<td style='color:powderblue; padding:0px;' class='text-center'>--</td></tr>");
					$n++;
			}
		}
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
                          <button type='submit' class='btn btn-xs btn-info hidden-print' name='prir' style='height:18px; padding:0px; margin:0px; width:80px;' title='Click to open this order' data-toggle='tooltip' data-placement='top'>
						  &nbsp;&nbsp;<i class='lnr lnr-download'></i>&nbsp;&nbsp;Open&nbsp;&nbsp;</button>
					
					<?php
 echo"<input type='hidden' name='vout' value='$vou'><input type='hidden' name='tabl' value='$tabl'><input type='hidden' name='sales' value='$sales'>";
					if($_SESSION['Cancel']=='0'){
						$dso='disabled';
						$btz='button';
					}
					else{
						$btz='submit';
						$dso='';
					}
					?>
                         <button type="<?php echo $btz ?>" class='btn btn-xs btn-danger hidden-print' name='delos' style='height:18px; padding:0px; margin:0px; width:80px;' title='Delete this order' data-toggle='tooltip' data-placement='top' <?php echo $dso ?>>
						  &nbsp;&nbsp;<i class='lnr lnr-trash'></i>&nbsp;&nbsp;Delete&nbsp;&nbsp;</button>
					
					 </th><th colspan='2' style='color:grey; font-size:10px; padding:3px 3px 3px 20px;'><div align='left'><?php echo $comme ?></th>
					<th colspan='3' style='padding:0px;'><div align='right'><?php echo"<input name='tot' class='form-control' type='text' onkeyup='format(this);' onkeypress='return isNumberKey(event);' onChange=this.style.color='#ff3366' style='text-align:right; width:100%; height:20px; margin:0px 0px 0px 0px; padding:0px 10px 0px 0px; margin:0px; font-weight:bold; color:#ff66cc;' value='$otbo' readonly>"; ?></th></tr>
                  </table></form><br>

				  <?php
				}
}
				  else{
						echo"<br><br><br><br><br><br>
			<div style='text-align:center; font-size:24px; color:powderblue'> Load items to create a new order. </div><br><br><br><br><br><br><br>";
					}
}
	?>