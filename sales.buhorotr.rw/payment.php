 <?php 
$do=mysql_query("SELECT *FROM `sales` WHERE `Voucher`>'0' AND `Printed`='1' AND `Status`='0' GROUP BY `Voucher` ORDER BY `Voucher` DESC LIMIT 40");
		?>
 <form action="" method="post" class="form-horizontal "> 
				<table class="table table-striped">     
                                      <thead>
                    <tr role="row">
                     <th class="hidden-xs"> NO </th> 
                       <th> Table </th>
                       <th> Invoice&nbsp;No </th>
                       <th> Done&nbsp;By </th>
                       <th> Due&nbsp;Date </th>
                        <th> Time </th>
                        <th> Waiter </th>
                       <th> Items </th>
						<th>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Amount</th>
						<th>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Paid</th>
						<th>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Credit</th>
						<th><div align='right'>&nbsp;&nbsp;Status&nbsp;&nbsp;&nbsp;&nbsp;</th>
                        <th class="hidden-xs hidden-print" style="width:40px; text-align:center;"> Option </th>
                     </tr>
                    </thead>
                                        <tbody>
					<?php
					$n=1;				$tp=$tpa=$tcre=0;
						while($ro=mysql_fetch_assoc($do)){
				$vou=$ro['Voucher'];
				$dte=$ro['Date'];
				$tme=$ro['Time'];
				$user=$ro['Owner'];
				$tabl=$ro['Tnumber'];
				$cashier=$ro['Cashier'];
				$to=$pay=$cre=0;
$dor=mysql_query("SELECT `Price`, SUM(Quantity) AS 'QTO' FROM `sales` WHERE `Voucher`='$vou' GROUP BY `Item`,`Price` ORDER BY `Number` ASC");
			$for=mysql_num_rows($dor);
				while($ror=mysql_fetch_assoc($dor)){
				$pri=$ror['Price'];
				$qty=$ror['QTO'];
			$to+=$pri*$qty;
				}			
						$too=number_format($to);
	$spa=mysql_query("SELECT *FROM `payment` WHERE `Voucher`='$vou' AND `Status`='0' AND `Branche`='$tabl' AND `Destin`='SALES' ORDER BY `Number` ASC");
				while($rpa=mysql_fetch_assoc($spa)){
						$pay+=$rpa['Cheque']+$rpa['Bank']+$rpa['Credit']+$rpa['Cash'];
						$cre+=$rpa['Credit'];
				}
				if($cre>0)
					$tbs=mysql_query("UPDATE `sales` SET `Paid`='2' WHERE `Voucher`='$vou'");
				$payo=number_format($pay-$cre);					$creo=number_format($cre);

				if($pay=='0' AND $pay!=$to){
					$stao="<div align='center' style='color:#ff66cc;'> NOT PAID";
					$lbt='warning';
				}
				if($pay!='0' AND $pay!=$to){
					$stao="<div align='center' style='color:#ffcc66'> HALF PAID";
					$lbt='warning';
				}
				if($pay==$to){
					$stao="<div align='center' style='color:#6666ff'> FULL PAID";
					$lbt='successi';
				}
				if($cre>0){
					$stao="<div align='center' style='color:#006633'> CREDIT";
				}

						$stn="padding:1px;";

		print("<tr><td class=hidden-xs style='$stn'><div align='center'>$n&nbsp;&nbsp;</td><td style='$stn'> $tabl </td>
		<td style='$stn'><div align='center'> $vou </td><td style='$stn'> $cashier </td>
						<td style='$stn'> $dte </td><td style='$stn'> $tme </td><td style='$stn'> $user </td>
						<td style='$stn'> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; $for </td><td style='$stn'><div align='right'> $too&nbsp;</td>
						<td style='$stn'><div align='right'> $payo&nbsp;</td><td style='$stn'><div align='right'> $creo&nbsp;</td>
						<td style='$stn'> $stao </td>

						<form method=post action=''> <input type='hidden' name='tabl' value='$tabl'>
						<input type='hidden' name='vous' value='$vou'><td class='hidden-xs hidden-print' align='right' style='padding:0px;'>
                          <button type='submit' class='btn btn-xs btn-$lbt hidden-print' name='paid' style='height:18px; width:90px; padding:0px; margin:0px;'  title='Click to open payment' data-toggle='tooltip' data-placement='top'>
						  &nbsp;&nbsp;<i class='lnr lnr-download'></i>&nbsp;&nbsp;PAY&nbsp;&nbsp;</button></td></form></tr>");
						  $n++;				$tp+=$to;			$tpa+=$pay;				$tcre+=$cre;
						}
						$tpo=number_format($tp);					$tpao=number_format($tpa-$tcre);				$balo=number_format($tp-$tpa);
						$tcreo=number_format($tcre);
						?>
						
                     </tbody>

					 <thead>
					<tr><th class="hidden-xs"> </th><th colspan='7'><div align='center'> Total Amount </th>
					<th><div align='right'><?php echo $tpo ?></th><th><div align='right'><?php echo $tpao ?></th>
					<th><div align='right'><?php echo $tcreo ?></th>
					<th><div align='right' style='color:#ff66cc;'><?php echo $balo ?>&nbsp;&nbsp;</th>
					<th colspan='2' class="hidden-xs hidden-print"><div align='center'> -- </th></tr>
                  </table><br>