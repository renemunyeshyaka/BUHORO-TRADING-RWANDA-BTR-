<?php
$do=mysql_query("SELECT *FROM `sales` WHERE `Status`='0' AND `Voucher`!='0' AND `Tnumber`='$tabl' AND `Sales`='0' AND `Date`='$Date' AND `Addon`='0' AND `Branche`='$brc' ORDER BY `Number` ASC LIMIT 100");
				if($fo=mysql_num_rows($do)){
				   ?>
             

								 <form action="" method="post" class="form-horizontal "> 
				<table class="table table-striped">     
                                      <thead>
                    <tr role="row">
                     <th class="hidden-xs">&nbsp;&nbsp;&nbsp;&nbsp;# </th>
                       <th> Order&nbsp;No </th>
                       <th> Owner </th>
                       <th> Due&nbsp;Date </th>
                        <th> Item&nbsp;Name </th>
                       <th> Price </th>
                       <th> Quantity </th>
						<th>Amount</th>
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
				$sales=$ro['Sales'];

				if($sales=='0')
					$stao='Open';
				else
					$stao='Closed';
				$to=$qty*$pri;
				$too=number_format($to);

				$stn="padding:0px;";

	$dop=mysql_query("SELECT *FROM `items` WHERE `Number`='$item' ORDER BY `Number` DESC LIMIT 1");
				$rop=mysql_fetch_assoc($dop);
					$iname=$rop['Iname'];

		print("<tr><form method='post' action=''>
		<td class=hidden-xs style='$stn'><div align='center'>$n&nbsp;&nbsp;</td><td style='$stn'><div align='center'> $vou </td>
		<td style='$stn'> $user </td><td style='$stn'> $dte </td><td style='$stn'> $iname </td>

		<td style='padding:0px;'><input name='pri' class='form-control' type='text' onkeyup='format(this);' onkeypress='return isNumberKey(event);' onChange=this.style.color='#ff3366' style='text-align:right; width:80px; height:20px; margin:0px 0px 0px 0px; padding:0px 10px 0px 0px; margin:0px;' value='$prio' readonly></td>

		<td style='padding:0px;'><input name='qty' class='form-control' type='text' onkeyup='format(this);' onkeypress='return isNumberKey(event);' onChange=this.style.color='#ff3366' style='text-align:right; width:80px; height:20px; margin:0px 0px 0px 0px; padding:0px 10px 0px 0px; margin:0px;' value='$qty' readonly></td>
						
		<td style='padding:0px;'><input name='tot' class='form-control' type='text' onkeyup='format(this);' onkeypress='return isNumberKey(event);' onChange=this.style.color='#ff3366' style='text-align:right; width:80px; height:20px; margin:0px 0px 0px 0px; padding:0px 10px 0px 0px; margin:0px;' value='$too' readonly></td>
						
						
						<td class='hidden-xs hidden-print' align='right' style='width:40px; padding:0px;'>
         <input type='hidden' name='num' value='$num'><button type='button' class='btn btn-xs btn-warning hidden-print' name='edit' style='height:18px; margin:0px;' title='Edit' data-toggle='tooltip' data-placement='top' disabled>&nbsp;&nbsp;<i class='lnr lnr-pencil'></i>&nbsp;&nbsp;</button></td></form>
						  
		 <form method='post' action=''><td class='hidden-xs hidden-print' align='right' style='width:40px; padding:0px;'>
		<input type='hidden' name='num' value='$num'><button type='button' class='btn btn-xs btn-danger hidden-print' name='delo' style='height:18px; margin:0px;' title='Delete' data-toggle='tooltip' data-placement='top' disabled> &nbsp;&nbsp;<i class='lnr lnr-trash'></i>&nbsp;&nbsp;</button></td></form></tr>");
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

		echo("<tr><td class='hidden-xs text-center' style='color:powderblue; $stn'>$n&nbsp;&nbsp;</td>
		<td style='color:powderblue; $stn' class='text-center'> $vou </td>
		<td style='color:powderblue; $stn'> $user </td><td style='color:powderblue; $stn'> $dte </td><td style='color:powderblue; $stn'> $inamee </td>

		<td style='color:powderblue; padding:0px;' class='text-center'>--</td>
		<td style='color:powderblue; padding:0px;' class='text-center'>$qtyk</td>
		<td style='color:powderblue; padding:0px;' class='text-center'>--</td>
		<td class='hidden-xs hidden-print text-center' style='color:powderblue; width:40px; padding:0px;'>--</td>						  
		 <td class='hidden-xs hidden-print text-center' style='color:powderblue; width:40px; padding:0px;'>--</td></tr>");
					$n++;
			}
		}
						}
						$toto=number_format($tot);			
						?>
						
                    </tbody>
                  </table><hr style='margin-top:-4px;'>

				  <?php
					  // ************************************ Save this order *******************************
				  if($bch)
		 echo"<form method='post' action='login.php'><input type='hidden' name='vous' value='$vous'><input type='hidden' name='tabl' value='$tabl'>";
				  else
			echo"<form method='post' action=''><input type='hidden' name='vous' value='$vous'><input type='hidden' name='tabl' value='$tabl'>";
					?>
	
	 <label class="control-label col-md-1">` </label>

				  <label class="control-label col-md-3">
			  <select class="form-control" name="waiter" required>			
			 <?php
				echo"<option value='$loge' selected='selected'> $loge </option>";
			?>			    
            </select></label>

	<label class="control-label col-md-2">
<select class="form-control" name='tbl' required></label>
 <?php
	echo"<option value='$tabl' selected='selected'> $tabl </option>";
			?>
</select>
		</label>

<?php
	if($_SESSION['Cancel']=='1')
		echo"<label class='control-label col-md-2'><input name='dato' id='from' class='form-control sm' type='text' style='text-align:center;' VALUE='$Date' onclick='return pageScroll()'></label>";
else
		echo"<label class='control-label col-md-2'><input name='dato' class='form-control sm' type='text' style='text-align:center;' VALUE='$Date' disabled></label>";
	?>

	<label class="control-label col-md-2">
		<div class="input-group">
   <span class="input-group-addon"><?php echo $curre1 ?></span>
   <input name="toto" class="form-control sm" type="text" style="text-align:center; padding-left:2px; padding-right:2px;" VALUE="<?php echo $toto ?>" readonly></div></label>



			 <label class="control-label col-md-2">
			 <?php
		if($_SESSION['Xpri']!='1')
			echo"<button class='btn btn-md btn-block btn-info' type='submit' name='receives'>
			 <i class='lnr lnr-printer'></i> INVOICE </button>";
			 ?>
			 </label>

				  
				  <?php
				}
				?>
