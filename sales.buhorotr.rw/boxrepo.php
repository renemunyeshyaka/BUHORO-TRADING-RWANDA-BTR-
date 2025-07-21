<?php
if(basename($_SERVER['PHP_SELF']) == 'boxrepo.php') 
  $cm=" class='current'";
include'header.php';
include'connection.php';
$dato=$datos=$Date;
$custo='';
$conde=$waiter='';
$t=$i=0;
 $brc=$_SESSION['BR'];	
 $doib=mysql_query("SELECT `Name` FROM `branches` WHERE `Number`='$brc' ORDER BY `Number` ASC");
			$roib=mysql_fetch_assoc($doib);
				$bra=$roib['Name'];

$fld="S$brc";

// search for cashbox report
if(isset($_POST['search']))
		{
			$dato=$_POST['dato'];
			$datos=$_POST['datos'];
			$custo=$_POST['custo'];
			$waiter=$_POST['waiter'];
			$i=1;
		}

// delete a given record from cashbox report
if(isset($_POST['delo']))
		{
			$custo=$_POST['custo'];
			$dato=$_POST['dato'];
			$datos=$_POST['datos'];
			$custo=$_POST['custo'];
			$client=$_POST['client'];
			$nuos=$_POST['nuos'];
			$to=$_POST['to'];
			$i=$_POST['i'];
			
	$then=mysql_query("UPDATE `account` SET `Balance` = `Balance` + '$to' WHERE `Number` = '$client' LIMIT 1");

			$andi=mysql_query("DELETE FROM `payment` WHERE `Number`='$nuos' AND `Destin`!='SALES' ORDER BY `Number` ASC LIMIT 1");
				}

if($dato==$datos)
			$mpri="ON $dato";
		else
			$mpri="FROM $dato TO $datos";

if($waiter)
	$condi="AND `Cashier`='$waiter'";
else
	$condi='';

?>
<div class="container-fluid main-content">
        <div class="page-title">
          <h3 style='margin-top:-20px; margin-bottom: 5px; color:#ffcc33'>
       Cashbox Report
          </h3>
                 </div>
     
        <div class="row">
  <div class="col-lg-2 hidden-print">
   
 <ul class="list-group">

    <li class="list-group-item">
	  <a href="odrepo.php">
                <p>
                <i class="lnr lnr-menu-circle"></i>&nbsp;Orders Report
                </p>
              </a></li>  		  

    <li class="list-group-item">
	  <a href="sarepo.php">
                <p>
                <i class="lnr lnr-menu-circle"></i>&nbsp;Invoices Report
                </p>
              </a></li>  

    <li class="list-group-item">
	  <a href="parepo.php">
                <p>
                <i class="lnr lnr-menu-circle"></i>&nbsp;Payment Report
                </p>
              </a></li>  

    <li class="list-group-item">
	  <a href="crerepo.php">
                <p>
                <i class="lnr lnr-menu-circle"></i>&nbsp;Credit Report
                </p>
              </a></li> 

    <li class="list-group-item">
	  <a href="prirepo.php">
                <p>
                <i class="lnr lnr-menu-circle"></i>&nbsp;Prices Report
                </p>
              </a></li>   

	 <li class="list-group-item active">
	  <a href="boxrepo.php">
                <p>
                <i class="lnr lnr-menu-circle"></i>&nbsp;Cashbox Report
                </p>
              </a></li>    

	 <li class="list-group-item">
	  <a href="breceive.php">
                <p>
                <i class="lnr lnr-menu-circle"></i>&nbsp;Receive Report
                </p>
              </a></li>  

	 <li class="list-group-item">
	  <a href="brarepo.php">
                <p>
                <i class="lnr lnr-menu-circle"></i>&nbsp;Config. Report
                </p>
              </a></li> 
                         
            </ul>
		
			  <?php
			
		if($_SESSION['Xbra']){
			 $dbutn='submit';
			 $disa='';
		 }
		 else{
			 $dbutn='button';
			 $disa='You are not allowed to use this button';
		 }
   ?>
  </div>
                    
           
           
       
        <div class="col-lg-10">
                  <div class="row">
        <form action="" method="post" class="form-horizontal ">
         
           <div class="col-lg-2"> </div><div class="col-lg-2"> <select class="form-control" name="waiter" required>			
			 <?php
				echo"<option value='$loge' selected='selected'> $loge </option>";
			if($_SESSION['Access']>='2'){
	$doi=mysql_query("SELECT `Cashier` FROM `payment` WHERE `Cashier`!='$loge' AND `Cashier`!='' ORDER BY `Number` DESC LIMIT 30");
			while($roi=mysql_fetch_assoc($doi)){
				$fna=$roi['Cashier'];
			$dst="$fna";
	echo"<option value='$dst' style='height:40px'> $dst </option>";
			}
			}
			?>			    
            <option value=''> ALL CASHIERS </option></select> </div>
          
         
                            
                       <div class="col-lg-8 hidden-print"><div class="col-lg-4"> 					
					   <select class="form-control" name="custo">
			<?php
				if($custo=='SALES'){
					$s='selected';
					$conde="AND `Destin` = 'SALES'";
					}
				else
					$s='';
					
				if($custo=='PAYOUT'){
					$e='selected';
					$conde="AND `Cash` < '0'";
					}
				else
					$e='';
					
				if($custo=='PAYMENT'){
					$p='selected';
					$conde="AND `Destin` != 'SALES' AND `Cash` >= '0'";
					}
				else
					$p='';
				echo"<option value='' selected='selected'> SELECT DESTINATION </option>
				<option value='SALES' $s> SALES </option><option value='PAYOUT' $e> PAYOUT </option><option value='PAYMENT' $p> PAYMENT </option>";
				?>
				</select>
					   </div>
            <div class="col-lg-3"> 
           <div class="input-group date datepicker">
      <input class="form-control form-center" id="from" name="dato" type="text" value="<?php echo $dato ?>" onkeypress='return isNumberKey(event)' required>
	  <span class="input-group-addon"><i class="lnr lnr-calendar-full"></i></span>
			</div></div>


		  <div class="col-lg-3"> 
           <div class="input-group date datepicker">	
      <input class="form-control form-center" id="to" name="datos" type="text" value="<?php echo $datos ?>" onkeypress='return isNumberKey(event)' required>
	  <span class="input-group-addon"><i class="lnr lnr-calendar-full"></i></span>
              </div></div>                      
                       
                       <div class="col-lg-2">
                        <button class="btn  btn-primary btn-block" type="<?php echo $dbutn ?>" name="search" title="<?php echo $disa ?>" data-toggle='tooltip' data-placement='top'><i class="lnr lnr-magnifier"></i> Search</button>
                   
					  </div>
                         </div> 
                      
                     
                  
            </form> 
             
               
            </div>
               <?php
			   if($t==0){
				   if($i==0)
		$do=mysql_query("SELECT *FROM `payment` WHERE `Status`='0' $conde GROUP BY `Number` ORDER BY `Date` DESC, `Number` DESC LIMIT 20");
				   else
		$do=mysql_query("SELECT *FROM `payment` WHERE `Date` BETWEEN '$dato' AND '$datos' AND `Status`='0' $conde GROUP BY `Number` ORDER BY `Number` ASC LIMIT 4000");
				if($fo=mysql_num_rows($do)){
				   ?>
            <div class="divFooter"><center><u><b>CASHBOX REPORT <?php echo $mpri ?></b></u></center></div>     
             <div class="row">
            <div class="col-lg-12">
             <span> &nbsp;&nbsp; Total Records Found : <b><?php echo" $fo " ?></b></span> 
			 <span class="pull-right"><?php echo $bra ?>&nbsp;&nbsp;<a href="#" onclick="return window.print()" class="hidden-print" title='Click to print' data-toggle='tooltip' data-placement='top'><i class="lnr lnr-printer"></i></a></span>
            <div class="widget-container fluid-height clearfix">
            <div class="widget-content padded clearfix">

								 <form action="" method="post" class="form-horizontal "> 
				<table class="table table-striped">     
                                      <thead>
                    <tr role="row">
                     <th class="hidden-xs"> NO </th> 
                       <th> Cashier </th>
                       <th> Customer </th>
                       <th>&nbsp;&nbsp;&nbsp;Date </th>
                        <th> Time </th>
                       <th> Destination </th>
                       <th> Purpose </th>
                        <th><div align='center'> Cash </th>
                        <th><div align='center'> Cheque </th>
                        <th><div align='center'> Bank </th>
                        <th><div align='center'> Credit </th>
                        <th class="hidden-xs hidden-print" style="width:40px; text-align:center;" colspan='2'> Options </th>
                     </tr>
                    </thead>
                                        <tbody>
					<?php
					$n=1;				$tp=0;				$tca=$tche=$tba=$tcre=0;
						while($ro=mysql_fetch_assoc($do)){
						$nuos=$ro['Number'];
				$vou=$ro['Voucher'];
				$dte=$ro['Date'];
				$des=$ro['Branche'];
				$tme=$ro['Time'];
				$cashier=$ro['Cashier'];
				$client=$ro['Customer'];
				$dest=$ro['Destin'];
				$descri=$ro['Description'];
				$payto=$ro['Payto'];

				if($dest=='SALES'){
					$descri="Invoice No:$vou";
					$dis="disabled";
				}
				else{
					$dis='';
				}
				
						$che=$ro['Cheque'];
						$ba=$ro['Bank'];
						$cre=$ro['Credit'];
						$ca=$ro['Cash'];
				
				if($client=='0'){
					$clio=$payto;
				}
				else{
				$top=mysql_query("SELECT *FROM `account` WHERE `Number`='$client' ORDER BY `Customer` ASC");
						$rop=mysql_fetch_assoc($top);
							$clio=$rop['Customer'];
				}

				if($clio==''){
					$clio='DIRECT';
				}

				$to=$ca+$ba+$che+$cre;
				$cao=number_format($ca, 2);
				$bao=number_format($ba, 2);
				$creo=number_format($cre, 2);
				$cheo=number_format($che, 2);

						$too=number_format($to, 2);
				
				if($to<=0 AND $vou>='2147483640')
					$stn="padding:1px; font-size:13px; color:#ff6633;";
				elseif($to>0 AND $vou>='2147483640')
					$stn="padding:1px; font-size:13px; color:#009900;";
				else{
					if($cre)
						$stn="padding:1px; font-size:13px; color:#0033cc;";
					else
						$stn="padding:1px; font-size:13px;";
					}

		print("<tr><td class=hidden-xs style='$stn'><div align='center'>$n&nbsp;&nbsp;</td>
		<td style='$stn'> $cashier </td><td style='$stn'>&nbsp;&nbsp;$clio&nbsp;</td>		
						<td style='$stn'>&nbsp;&nbsp;$dte&nbsp;&nbsp;</td><td style='$stn'> $tme </td>
						<td style='text-align:left; $stn'>&nbsp;$dest </td>
						<td style='text-align:left; $stn'>&nbsp;$descri </td>
						<td style='$stn'><div align='right'>&nbsp;$cao&nbsp;</td>
						<td style='$stn'><div align='right'>&nbsp;$cheo&nbsp;</td>
						<td style='$stn'><div align='right'>&nbsp;$bao&nbsp;</td>
						<td style='$stn'><div align='right'>&nbsp;$creo&nbsp;</td>

						<form method=post action=''>  
						<td class='hidden-xs hidden-print' align='right' style='width:40px; padding:0px;'>
       <input type='hidden' name='vous' value='$vou'> <input type='hidden' name='dato' value='$dato'> <input type='hidden' name='datos' value='$datos'>
	   <input type='hidden' name='dte' value='$dte'><input type='hidden' name='i' value='$i'>
                          <button type='button' class='btn btn-xs btn-warning hidden-print' name='edit' style='height:18px; padding:0px; margin:0px;'  title='Edit' data-toggle='tooltip' data-placement='top' disabled>
						  &nbsp;&nbsp;<i class='lnr lnr-pencil'></i>&nbsp;&nbsp;</button></td></form>
						  
						  <form method='post' action=''><td class='hidden-xs hidden-print' align='right' style='width:40px; padding:0px;'>
						  <input type='hidden' name='i' value='$i'>
        <input type='hidden' name='nuos' value='$nuos'> <input type='hidden' name='dato' value='$dato'> <input type='hidden' name='datos' value='$datos'>
		<input type='hidden' name='to' value='$to'><input type='hidden' name='custo' value='$custo'><input type='hidden' name='client' value='$client'>
       <button type='submit' class='btn btn-xs btn-danger hidden-print' name='delo' title='Delete this payment' data-toggle='tooltip' data-placement='top' style='height:18px; padding:0px; margin:0px;' $dis> &nbsp;&nbsp;<i class='lnr lnr-trash'></i>&nbsp;&nbsp;</button></td></form></tr>");
						  $n++;		$tp+=$to;			$tca+=$ca;				$tche+=$che;             $tba+=$ba;         	  $tcre+=$cre;
						}
						$tpo=number_format($tp, 2);	
						$tcao=number_format($tca, 2);
				$tbao=number_format($tba, 2);
				$tcreo=number_format($tcre, 2);
				$tcheo=number_format($tche, 2);
						?>
						
                     </tbody>

					 <thead>
					<tr><th class="hidden-xs"> </th><th colspan='6'><div align='center'> Total Amount </th>
					<th><div align='right'><?php echo $tcao ?></th>
					<th><div align='right'><?php echo $tcheo ?></th>
					<th><div align='right'><?php echo $tbao ?></th>
					<th><div align='right'><?php echo $tcreo ?></th>
					<th colspan='2' class="hidden-xs hidden-print"><div align='center'> -- </th></tr>
                  </table><br>

				  
				  <?php
				}
				 else{
						echo"<div class='row'>
            <div class='col-lg-12' style='margin-top:-20px;'>
             <span> &nbsp;&nbsp; Total Records Found : <b> 0 </b></span>
			 <span class='pull-right hidden-print'> $bra &nbsp;&nbsp;<a href='#' onclick='return window.print()' class='hidden-print' title='Click to print' data-toggle='tooltip' data-placement='top'><i class='lnr lnr-printer'></i></a></span>
            <div class='widget-container fluid-height clearfix'>
            <div class='widget-content padded clearfix'>
			<br><br><br><br><br><br>
						<div style='text-align:center; font-size:24px; color:#ff3333'> There is no payment on selected date </div><br><br><br><br><br><br><br>";
					}  
			}
				   else{
		$dor=mysql_query("SELECT *, SUM(Quantity) AS 'QTY' FROM `sales` WHERE `Upda`='1' AND `Branche`='$brc' AND `Voucher`='$vous' AND `Status`='0' GROUP BY `Item`,`Price` ORDER BY `Number` ASC");
				if($for=mysql_num_rows($dor)){
					?>

		<div class="divFooter"><center><u><b>SALES REPORT <?php echo"ON $dte"; ?></b></u></center></div>
		 <div class="row">
            <div class="col-lg-12">
             <span> &nbsp;&nbsp; Total Records Found : <b><?php echo" $for " ?></b></span>
			 <span class="pull-right hidden-print"><?php echo $bra ?>&nbsp;&nbsp;<a href="#" onclick="return window.print()" class="hidden-print" title='Click to print' data-toggle='tooltip' data-placement='top'><i class="lnr lnr-printer"></i></a></span>
            <div class="widget-container fluid-height clearfix">
            <div class="widget-content padded clearfix">

		<table class="table table-striped"><form action='' method='post'>     
                                      <thead>
                    <tr role="row">
                     <th class="hidden-xs"> NO </th>
                        <th>&nbsp;&nbsp;Customer&nbsp;</th>
                        <th>&nbsp;&nbsp;&nbsp;Date&nbsp;</th>
                        <th>&nbsp;&nbsp;Time&nbsp;</th>
                       <th> Cashier </th>
                       <th> Item&nbsp;Name </th>
                       <th colspan='2'>&nbsp;&nbsp;Quantity&nbsp;&nbsp;</th>
						 <th> Sales&nbsp;Price </th>
						<th><div align='right'>Total&nbsp;Amount</th>
                        <th class="hidden-xs hidden-print"><div align='center'> &nbsp;&nbsp; </th>
                        <th class="hidden-xs hidden-print" style="width:40px; text-align:center;" colspan='2'> Options </th>
                     </tr>
                    </thead>
                                        <tbody>
										<?php
	$n=1;			$tot=0;
					while($ror=mysql_fetch_assoc($dor)){
						$code=$ror['Number'];
						$item=$ror['Item'];
						$sale=$ror['Price'];
						$qt=$ror['QTY'];
						$des=$ror['Branche'];
						$vous=$ror['Voucher'];
				$dte=$ror['Date'];
				$tme=$ror['Time'];
				$cashier=$ror['Cashier'];
				$client=$ror['Customer'];

				if($client=='0'){
					$clio="DIRECT";
				}
				else{
				$top=mysql_query("SELECT *FROM `account` WHERE `Number`='$client' ORDER BY `Customer` ASC");
						$rop=mysql_fetch_assoc($top);
							$clio=$rop['Customer'];
				}

				$stn="padding:1px;";

	$do=mysql_query("SELECT *FROM `items` WHERE `Number`='$item' ORDER BY `Number` DESC LIMIT 1");
		$ro=mysql_fetch_assoc($do);
			$iname=$ro['Iname'];
			$kin=$ro['Type'];
			$descri=$ro['Descri'];
			$uno=$ro['Unit'];

	$qty=number_format($qt, 2);			$costo=number_format($cost, 2);			$sales=number_format($sale, 2);			$qto=number_format($qt, 2);
			
$doi=mysql_query("SELECT *FROM `itype` WHERE `Number`='$kin' ORDER BY `Number` ASC");
		$roi=mysql_fetch_assoc($doi);
				$type=$roi['Type'];

				$dox=mysql_query("SELECT *FROM `unit` WHERE `Number`='$uno' ORDER BY `Number` ASC");
					$rox=mysql_fetch_assoc($dox);
							$unit=$rox['Unit'];

	$then=mysql_query("UPDATE `requis` SET `Price`='$cost', `Direct`='$dire' WHERE `Number`='$code' LIMIT 1");

          $to=$sale*$qt;				$too=number_format($to, 2);			$qino=number_format($qin, 2);
		print("<tr><td class='hidden-xs' style='$stn'><div align='center'>$n&nbsp;&nbsp;</td>
		<td style='$stn'> $clio </td><td style='$stn'>&nbsp;&nbsp;$dte&nbsp;&nbsp;</td>
		<td style='$stn'> $tme </td><td style='$stn'> $cashier </td>
						<td style='$stn'> $iname </td><td style='$stn'><div align='right'> $qty </td>
						<td style='$stn'> $unit </td><td style='$stn'><div align='right'>&nbsp;$sales&nbsp;</td>
						<td style='$stn'><div align='right'>$too&nbsp;</td><td class='hidden-xs hidden-print'> </td>				
						
				<td class='hidden-xs hidden-print' align='right' style='width:40px; padding:0px;'>
				<input type='hidden' name='rowid$n' value='$code'><input type='hidden' name='item$n' value='$item'>
				<input type='hidden' name='dire$n' value='$dire'>
                <button type='button' class='btn btn-xs btn-warning hidden-print' name='edit' style='height:18px; padding:0px; margin:1px 0px; 1px 0px;' title='Edit' data-toggle='tooltip' data-placement='top' disabled> &nbsp;&nbsp;<i class='lnr lnr-pencil'></i>&nbsp;&nbsp;</button></td>
						  
						  <td class='hidden-xs hidden-print' align='right' style='width:40px; padding:0px;'>
                          <button type='button' class='btn btn-xs btn-danger hidden-print' name='delo' style='height:18px; padding:0px; margin:1px 4px; 1px 0px;' title='Delete' data-toggle='tooltip' data-placement='top' disabled>&nbsp;&nbsp;<i class='lnr lnr-trash'></i>&nbsp;&nbsp;</button>
						  <input type='hidden' name='vous' value='$vous'><input type='hidden' name='n' value='$n'></td></tr>");
						  $n++;				$tot+=$to;
						}
						$toto=number_format($tot, 2);			
						?>
						
                    </tbody>

					 <thead>
					<tr><th class="hidden-xs"> </th><th colspan='8'><div align='center'> Total Amount </th>
					<th><div align='right'><?php echo $toto ?></th><th class="hidden-xs hidden-print"> </th>
					<th colspan='2' class="hidden-xs hidden-print"><div align='right'>
					<?php
						 if($_SESSION['Cancel']=='1')
						  echo"<input type='hidden' name='p' value='$p'>
        <input type='hidden' name='vous' value='$vous'> <input type='hidden' name='dato' value='$dato'> <input type='hidden' name='datos' value='$datos'>
	<button type='submit' class='btn btn-xs btn-danger hidden-print' name='deloreq' style='width:60px; margin:4px 0px 4px 0px;' title='Delete all' data-toggle='tooltip' data-placement='top'>&nbsp;&nbsp;<i class='lnr lnr-trash'></i>&nbsp;&nbsp;</button>";
	?></th></tr>


	<?php
		$ca=$che=$ba=$cre=0;
			$spa=mysql_query("SELECT *FROM `payment` WHERE `Voucher`='$vous' AND `Status`='0' AND `Branche`='$brc' AND `Destin`='SALES' ORDER BY `Number` ASC");
				while($rpa=mysql_fetch_assoc($spa)){
						$che+=$rpa['Cheque'];
						$ba+=$rpa['Bank'];
						$cre+=$rpa['Credit'];
						$ca+=$rpa['Cash'];
				}
				$cao=number_format($ca, 2);
				$bao=number_format($ba, 2);
				$creo=number_format($cre, 2);
				$cheo=number_format($che, 2);

echo"<tr><th class='hidden-xs'> </th><th colspan='9'><div align='center'><font color='#006600'> CASH&nbsp;:&nbsp;$cao </font> 
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<font color='#663300'> CHEQUE&nbsp;:&nbsp;$cheo </font> 
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<font color='#6600ff'> CC/BANK&nbsp;:&nbsp;$bao </font> 
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<font color='#ff3399'> CREDIT&nbsp;:&nbsp;$creo </font></th>
		<th class='hidden-xs hidden-print'> </th><th colspan='2' class='hidden-xs hidden-print'><div align='right'>";
					
					 if($_SESSION['Xpri']=='1')
						  echo"<input type='hidden' name='custo' value='$num'>
	<button type='submit' class='btn btn-xs btn-success hidden-print' name='pri' style='width:60px; margin:4px 0px 4px 0px;' title='Reprint Receipt' data-toggle='tooltip' data-placement='top'>&nbsp;&nbsp;<i class='lnr lnr-printer'></i>&nbsp;&nbsp;</button>";
	
	echo"</th></tr>";

				?>
                  </table>

				<?php
				}
					else{
						echo"<div class='row'>
            <div class='col-lg-12' style='margin-top:-20px;'>
             <span> &nbsp;&nbsp; Total Records Found : : <b> 0 </b></span>
			 <span class='pull-right hidden-print'> $bra &nbsp;&nbsp;<a href='#' onclick='return window.print()' class='hidden-print' title='Click to print' data-toggle='tooltip' data-placement='top'><i class='lnr lnr-printer'></i></a></span>
            <div class='widget-container fluid-height clearfix'>
            <div class='widget-content padded clearfix'>
			<br><br><br><br><br><br>
						<div style='text-align:center; font-size:24px; color:#ff9999'>Payment not found on selected date </div><br><br><br><br><br><br><br>";
					}
			}

?>       
              </div>
            </div></div>
                  </div>                  
                <span class="pull-right hidden-print">
			 &nbsp;&nbsp;&nbsp;&nbsp;<a href="#" onclick="return window.print()" class="hidden-print" title='Click to print' data-toggle='tooltip' data-placement='top'><i class="lnr lnr-printer"></i></a></span>
      
   </div></div></div>  
   <?php
   include'footer.php';
   ?>