<?php
if(basename($_SERVER['PHP_SELF']) == 'balrepo.php') 
  $cm=" class='current'";
include'header.php';
include'connection.php';
$dato=$datos=$Date;
$custo=$conde='';
$t=$p=$brc=0;
 $brc=$_SESSION['BR'];	
 $doib=mysql_query("SELECT `Name` FROM `branches` WHERE `Number`='$brc' ORDER BY `Number` ASC");
			$roib=mysql_fetch_assoc($doib);
				$bra=$roib['Name'];

// search for an item to be added to the chart
if(isset($_POST['search']))
		{
			$brc=$_POST['brc'];
			$dato=$_POST['dato'];
			$datos=$_POST['datos'];
			$p=1;
		}
		
		
		if(!$_SESSION['Acrepo'])
		    $datos=$dato;
	
	if($dato==$datos)
			$mpri="ON $dato";
		else
			$mpri="FROM $dato TO $datos";

if($brc=='0' OR $brc=='')
$conde="";
else
$conde="AND `Branche`='$brc'";

$rece=mysql_query("SELECT `Name` FROM `branches` WHERE `Number`='$brc' ORDER BY `Number` DESC LIMIT 1");
				$recet=mysql_fetch_assoc($rece);
					$bra=$recet['Name'];
?>
<div class="container-fluid main-content">
        <div class="page-title hidden-print">
          <h3 style='margin-top:-20px; margin-bottom: 5px; color:#ffcc33'>
         Sales Report
          </h3>
                 </div>
     
        <div class="row">
  <div class="col-lg-2 hidden-print">
   
  <ul class="list-group">

	   <li class="list-group-item">
              <a href="stobranch.php" <?php echo $dsa ?>>
                <p>
                <i class="lnr lnr-menu-circle"></i>&nbsp;Store Status
                </p>
              </a></li>

   <li class="list-group-item">
	  <a href="createa.php" <?php echo $dsa ?>>
                <p>
                <i class="lnr lnr-plus-circle"></i>&nbsp;Create Account
                </p>
              </a></li> 

   <li class="list-group-item">
	  <a href="dadd.php" <?php echo $dsa ?>>
                <p>
                <i class="lnr lnr-plus-circle"></i>&nbsp;Pay on Account
                </p>
              </a></li>   

   <li class="list-group-item">
	  <a href="cashbox.php" <?php echo $dsa ?>>
                <p>
                <i class="lnr lnr-plus-circle"></i>&nbsp;Add to Cashbox
                </p>
              </a></li> 

   <li class="list-group-item">
	  <a href="madd.php" <?php echo $dsa ?>>
                <p>
                <i class="lnr lnr-plus-circle"></i>&nbsp;Make a Payout
                </p>
              </a></li> 
                       
            </ul><br>
			<?php
			if($brc>='1'){
				?>
<center>
<?php
/*
if($_SESSION['Phyc']){
?>
			<a href="counte.php" class="btn btn-warning" style="width:100%;"><i class="lnr lnr-layers">&nbsp;Physical Count</i></a>
<?php
}
*/
?>
		<br>
  
				 <ul class="list-group text-left">
        <?php
        if($_SESSION['Acrepo']){
            ?>
   <li class="list-group-item" style="border:1px dashed #cccccc; border-radius:5px; margin:0px 0px 4px 0px;">
	  <a href="urepo.php">
                <p>
                <i class="lnr lnr-menu-circle"></i>&nbsp;Sales Report
                </p>
              </a></li> 
              <?php
        }
        else{
        ?>
   <li class="list-group-item active" style="border:1px dashed #cccccc; border-radius:5px; margin:0px 0px 4px 0px;">
	  <a href="irepo.php">
                <p>
                <i class="lnr lnr-menu-circle"></i>&nbsp;Control Report
                </p>
              </a></li> 
              <?php
        }
        ?>

			   <li class="list-group-item" style="border:1px dashed #cccccc; border-radius:5px; margin:0px 0px 4px 0px;">
	  <a href="transit.php">
                <p>
                <i class="lnr lnr-menu-circle"></i>&nbsp;Payment Report
				<?php
$doq=mysqli_query($cons, "SELECT `Amount` FROM `payment` WHERE `Status`='0' AND `Action`='SALES' AND `Branche`='$brc' AND `Voucher`='0' ORDER BY `Number` ASC");
				if($foq=mysqli_num_rows($doq))
echo"<span class='badge' style='float:right; font-size:12px; margin-right:0px; margin-top:0px; height:18px; background-color:#ffcc66; width:auto;'> $foq </span>";
					?>
                </p>
              </a></li> 

   <li class="list-group-item" style="border:1px dashed #cccccc; border-radius:5px; margin:0px 0px 4px 0px;">
	  <a href="isrepo.php">
                <p>
                <i class="lnr lnr-menu-circle"></i>&nbsp;Cashiers Report
                </p>
              </a></li>  
			  
			  <li class="list-group-item" style="border:1px dashed #cccccc; border-radius:5px; margin:0px 0px 4px 0px;">
	  <a href="bopi.php">
                <p>
                <i class="lnr lnr-menu-circle"></i>&nbsp;Bank Deposit
                </p>
              </a></li>
	</ul>
			  <?php
			}
   ?>
            </ul>
  </div>
                    
           
           
       
        <div class="col-lg-10">
                  <div class="row">
         
           <div class="col-lg-4"> </div>
          
         
           

        <form action="" method="post" class="form-horizontal ">                  
                       <div class="col-lg-8 hidden-print"><div class="col-lg-3">  
		<select class="form-control" name="brc" style='padding-right:5px;'>
			   <?php
if($brancho)
echo"<option value='$brc' selected> $brc </option>";
else{
echo"<option value='0' selected='selected'> SELECT BRANCH </option>";
	$seek=mysql_query("SELECT `Invoice`, `Branche` FROM `stouse` WHERE `Branche`!='0' AND `Status`='0' AND `Upda`='1' AND `Action`='SALES' AND `Invoice`!='MAIN STORE' GROUP BY `Branche` ORDER BY `Branche` ASC LIMIT 18");
			if($feek=mysql_num_rows($seek)){
		while($roi=mysql_fetch_assoc($seek)){
				$fna=$roi['Invoice'];
				$num=$roi['Branche'];
				if($brc==$num)
					$s='selected';
				else
					$s='';
			echo"<option value='$num' $s> $fna &nbsp;&nbsp;</option>";
			}
			}
}
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
                        <button class="btn  btn-primary btn-block" type="submit" name="search"><i class="lnr lnr-magnifier"></i> Search</button>
                   
					  </div>
                         </div> 
                      
                     
                  
            </form> 
             
               
            </div>
             <?php
					$cashbox=$cashin=$cashout=0;						$n=1;
		$do=mysql_query("SELECT *FROM `stouse` WHERE `Date` BETWEEN '$dato' AND '$datos' AND `Voucher`!='0' AND `Status`='0' AND `Action`='SALES' $conde GROUP BY `Voucher` ORDER BY `Number` ASC");
			$fo=mysql_num_rows($do);

		$doin=mysqli_query($cons, "SELECT SUM(Amount) AS 'Cash' FROM `payment` WHERE (`Status`='0' AND `Pline`='CASH' AND `Action`='PAYMENT' AND `Date`<'$dato' $conde) OR (`Status`='0' AND `Pline`='CASH' AND `Action`='SALES' AND `Date`<'$dato' $conde) OR (`Status`='0' AND `Pline`='CASH' AND `Action`='CASHBOX' AND `Date`<'$dato' $conde)");
				$roin=mysqli_fetch_assoc($doin);
					$cashin=$roin['Cash'];

		$dout=mysqli_query($cons, "SELECT SUM(Amount) AS 'Cash' FROM `payment` WHERE (`Status`='0' AND `Pline`='CASH' AND `Action`='PAYOUT' AND `Date`<'$dato' $conde) OR (`Status`='0' AND `Pline`='CASH' AND `Action`='PURCHASE' AND `Date`<'$dato' $conde)");					
				$rout=mysqli_fetch_assoc($dout);
					$cashout=$rout['Cash'];		
		
		$ddout=mysqli_query($cons, "SELECT SUM(Amount) AS 'Cash' FROM `deposit` WHERE (`Status`='0' AND `Source`='SALES' AND `Date`<'$dato' $conde)");				
				$drout=mysqli_fetch_assoc($ddout);
					$cashout+=$drout['Cash'];					
					$cashbox=$cashin-$cashout;	
					$cashboxo=number_format($cashbox);
					?>
					<div class="divFooter"><center><u><b>CONTROL REPORT <?php echo"$mpri"; ?></b></u></center></div>
		 <div class="row">
            <div class="col-lg-12">
             <span> &nbsp;&nbsp; Total Records Found : <b><?php echo" $fo " ?></b></span>
			 <span class="pull-right"><?php echo $bra ?>&nbsp;&nbsp;<a href="#" onclick="return window.print()" class="hidden-print" title='Click to print' data-toggle='tooltip' data-placement='top'><i class="lnr lnr-printer"></i></a></span>
            <div class="widget-container fluid-height clearfix">
            <div class="widget-content padded clearfix">

				<table class="table table-striped table-hover">     
                                      <thead>
                    <tr role="row">
                     <th class="hidden-xs"> No </th>
                       <th> Description </th>
						<th class="text-center">Cash</th>
						<th class="text-center">Deposit</th>
						<th class="text-center">Cheque</th>
						<th class="text-center">Credit</th>
						<th class="text-center">Total</th>
                     </tr>
                    </thead>
                                        <tbody>
					<?php
								$ca1=$che1=$ba1=$cre1=0;
								$ca2=$che2=$ba2=$cre2=0;
								$ca3=$che3=$ba3=$cre3=0;
								$ca4=$che4=$ba4=$cre4=0;
								$ca5=$che5=$ba5=$cre5=0;
									$de=$sa=0;					$stn="color:#3333cc";
	
		print("<tr><td class=hidden-xs style='$stn'><div align='center'>$n&nbsp;&nbsp;</td><td style='$stn'>&nbsp;&nbsp;OPENING BALANCE </td>
		<td class='text-right' style='$stn'> $cashboxo&nbsp;&nbsp;</td><td class='text-right' style='$stn'> 0&nbsp;&nbsp;</td>
		<td style='$stn'><div align='right'> 0&nbsp;&nbsp;</td><td style='$stn'><div align='right'> 0&nbsp;&nbsp;</td>
		<td style='$stn'><div align='right'> $cashboxo&nbsp;&nbsp;</td></tr>");

					$n++;						$stn="";

		$dor=mysqli_query($cons, "SELECT *FROM `stouse` WHERE `Date` BETWEEN '$dato' AND '$datos' AND `Voucher`!='0' AND `Status`='0' AND `Action`='SALES' $conde GROUP BY `Number` ORDER BY `Number` ASC");
					while($ror=mysqli_fetch_assoc($dor)){
				$sa+=$ror['Price']*$ror['Quantity'];
					}	
					$sao=number_format($sa);

		print("<tr><td class=hidden-xs style='$stn'><div align='center'>$n&nbsp;&nbsp;</td><td style='$stn'>&nbsp;&nbsp;TOTAL SALES AMOUNT </td>
		<td class='text-right' style='$stn'> 0&nbsp;&nbsp;</td><td class='text-right' style='$stn'> 0&nbsp;&nbsp;</td>
		<td style='$stn'><div align='right'> 0&nbsp;&nbsp;</td><td style='$stn'><div align='right'> 0&nbsp;&nbsp;</td>
		<td style='$stn'><div align='right'><b> $sao&nbsp;&nbsp;</b></td></tr>");	

					$n++;						//SALES1|PAYMENT2|CASHBOX3|PAYOUT4|PURCHASE5				
				
	$spa=mysql_query("SELECT `Amount`, `Pline`, `Action` FROM `payment` WHERE `Voucher`!='0' AND `Status`='0' AND `Date` BETWEEN '$dato' AND '$datos' $conde ORDER BY `Number` ASC");
				while($rpa=mysql_fetch_assoc($spa)){
						$amo=$rpa['Amount'];

			if($rpa['Action']=='SALES'){
				if($rpa['Pline']=='CASH')
					$ca1+=$amo;

				if($rpa['Pline']=='CHEQUE')
					$che1+=$amo;

				if($rpa['Pline']=='BANK')
					$ba1+=$amo;

				if($rpa['Pline']=='CREDIT')
					$cre1+=$amo;
					}

			if($rpa['Action']=='PAYMENT'){
				if($rpa['Pline']=='CASH')
					$ca2+=$amo;

				if($rpa['Pline']=='CHEQUE')
					$che2+=$amo;

				if($rpa['Pline']=='BANK')
					$ba2+=$amo;

				if($rpa['Pline']=='CREDIT')
					$cre2+=$amo;
					}

			if($rpa['Action']=='CASHBOX'){
				if($rpa['Pline']=='CASH')
					$ca3+=$amo;

				if($rpa['Pline']=='CHEQUE')
					$che3+=$amo;

				if($rpa['Pline']=='BANK')
					$ba3+=$amo;

				if($rpa['Pline']=='CREDIT')
					$cre3+=$amo;
					}

			if($rpa['Action']=='PAYOUT'){
				if($rpa['Pline']=='CASH')
					$ca4+=$amo;

				if($rpa['Pline']=='CHEQUE')
					$che4+=$amo;

				if($rpa['Pline']=='BANK')
					$ba4+=$amo;

				if($rpa['Pline']=='CREDIT')
					$cre4+=$amo;
					}

			if($rpa['Action']=='PURCHASE'){
				if($rpa['Pline']=='CASH')
					$ca5+=$amo;

				if($rpa['Pline']=='CHEQUE')
					$che5+=$amo;

				if($rpa['Pline']=='BANK')
					$ba5+=$amo;

				if($rpa['Pline']=='CREDIT')
					$cre5+=$amo;
					}
				}
		// ********************************** SALES *******************************************
			$to1=$ca1+$che1+$cre1+$ba1;
$cao1=number_format($ca1);		$cheo1=number_format($che1);		$bao1=number_format($ba1);		$creo1=number_format($cre1);       $too1=number_format($to1);
		print("<tr><td class=hidden-xs style='$stn'><div align='center'>$n&nbsp;&nbsp;</td><td style='$stn'>&nbsp;&nbsp;SALES PAYMENT AMOUNT </td>
		<td class='text-right' style='$stn'> $cao1&nbsp;&nbsp;</td><td class='text-right' style='$stn'> $bao1&nbsp;&nbsp;</td>
		<td style='$stn'><div align='right'> $cheo1&nbsp;&nbsp;</td><td style='$stn'><div align='right'> $creo1&nbsp;&nbsp;</td>
		<td style='$stn'><div align='right'> $too1&nbsp;&nbsp;</td></tr>");
						  $n++;	

		// ********************************** PAYMENT *******************************************
			$to2=$ca2+$che2+$cre2+$ba2;
$cao2=number_format($ca2);		$cheo2=number_format($che2);		$bao2=number_format($ba2);		$creo2=number_format($cre2);       $too2=number_format($to2);
		print("<tr><td class=hidden-xs style='$stn'><div align='center'>$n&nbsp;&nbsp;</td><td style='$stn'>&nbsp;&nbsp;CREDIT PAYMENT AMOUNT </td>
		<td class='text-right' style='$stn'> $cao2&nbsp;&nbsp;</td><td class='text-right' style='$stn'> $bao2&nbsp;&nbsp;</td>
		<td style='$stn'><div align='right'> $cheo2&nbsp;&nbsp;</td><td style='$stn'><div align='right'> $creo2&nbsp;&nbsp;</td>
		<td style='$stn'><div align='right'> $too2&nbsp;&nbsp;</td></tr>");
						  $n++;	

		// ********************************** CASHBOX *******************************************
			$to3=$ca3+$che3+$cre3+$ba3;
$cao3=number_format($ca3);		$cheo3=number_format($che3);		$bao3=number_format($ba3);		$creo3=number_format($cre3);       $too3=number_format($to3);
		print("<tr><td class=hidden-xs style='$stn'><div align='center'>$n&nbsp;&nbsp;</td><td style='$stn'>&nbsp;&nbsp;RECEIVED CASHBOX AMOUNT </td>
		<td class='text-right' style='$stn'> $cao3&nbsp;&nbsp;</td><td class='text-right' style='$stn'> $bao3&nbsp;&nbsp;</td>
		<td style='$stn'><div align='right'> $cheo3&nbsp;&nbsp;</td><td style='$stn'><div align='right'> $creo3&nbsp;&nbsp;</td>
		<td style='$stn'><div align='right'> $too3&nbsp;&nbsp;</td></tr>");
						  $n++;	

		// ********************************** PAYOUT *******************************************
			$to4=$ca4+$che4+$cre4+$ba4;				$stn="color:#ff6666";
$cao4=number_format($ca4);		$cheo4=number_format($che4);		$bao4=number_format($ba4);		$creo4=number_format($cre4);       $too4=number_format($to4);
		print("<tr><td class=hidden-xs style='$stn'><div align='center'>$n&nbsp;&nbsp;</td><td style='$stn'>&nbsp;&nbsp;PAYOUT/EXPENSES AMOUNT </td>
		<td class='text-right' style='$stn'> $cao4&nbsp;&nbsp;</td><td class='text-right' style='$stn'> $bao4&nbsp;&nbsp;</td>
		<td style='$stn'><div align='right'> $cheo4&nbsp;&nbsp;</td><td style='$stn'><div align='right'> $creo4&nbsp;&nbsp;</td>
		<td style='$stn'><div align='right'> $too4&nbsp;&nbsp;</td></tr>");
						  $n++;	

		// ********************************** PURCHASE *******************************************
			$to5=$ca5+$che5+$cre5+$ba5;
$cao5=number_format($ca5);		$cheo5=number_format($che5);		$bao5=number_format($ba5);		$creo5=number_format($cre5);       $too5=number_format($to5);
		print("<tr><td class=hidden-xs style='$stn'><div align='center'>$n&nbsp;&nbsp;</td><td style='$stn'>&nbsp;&nbsp;SUPPLIERS PAYMENT AMOUNT </td>
		<td class='text-right' style='$stn'> $cao5&nbsp;&nbsp;</td><td class='text-right' style='$stn'> $bao5&nbsp;&nbsp;</td>
		<td style='$stn'><div align='right'> $cheo5&nbsp;&nbsp;</td><td style='$stn'><div align='right'> $creo5&nbsp;&nbsp;</td>
		<td style='$stn'><div align='right'> $too5&nbsp;&nbsp;</td></tr>");
						  $n++;	

						$deca=$deche=0;					$stn="color:#3333cc";
	$dok=mysqli_query($cons, "SELECT `Amount`,`Source` FROM `deposit` WHERE `Status`='0' AND `Date` BETWEEN '$dato' AND '$datos' AND `Source`='SALES' $conde ORDER BY `Number` ASC LIMIT 1000");
			while($rok=mysqli_fetch_assoc($dok)){
				if($rok['Source']=='SALES')
					$deca+=$rok['Amount'];
				if($rok['Source']=='CHEQUE')
					$deche+=$rok['Amount'];
			}
	$de=$deca+$deche;				$decao=number_format($deca);				$decheo=number_format($deche);				$deo=number_format($de);

		print("<tr><td class=hidden-xs style='$stn'><div align='center'>$n&nbsp;&nbsp;</td><td style='$stn'>&nbsp;&nbsp;BANK DEPOSIT AMOUNT </td>
		<td class='text-right' style='$stn'> $decao&nbsp;&nbsp;</td><td class='text-right' style='$stn'> 0&nbsp;&nbsp;</td>
		<td style='$stn'><div align='right'> $decheo&nbsp;&nbsp;</td><td style='$stn'><div align='right'> 0&nbsp;&nbsp;</td>
		<td style='$stn'><div align='right'> $deo&nbsp;&nbsp;</td></tr>");
						  $n++;	

	$cashbox+=$ca1+$ca2+$ca3-$ca4-$ca5-$de;				$tba=$ba1+$ba2+$ba3-$ba4-$ba5;				$tche=$che1+$che2+$che3-$deche;	
						  
	$cashboxo=number_format($cashbox);			$tba=number_format($tba);			$tcheo=number_format($tche);			$too=number_format($cashbox+$tche);	
						?>
						
					<tr><th class="hidden-xs"><div align='center'><?php echo $n ?>&nbsp;&nbsp;</th><th>&nbsp;&nbsp;CLOSING BALANCE </th>
	<th><div align='right'><?php echo $cashboxo ?>&nbsp;&nbsp;</th><th><div align='right'><?php echo $tba ?>&nbsp;&nbsp;</th>
	<th class='text-right'><?php echo $tcheo ?>&nbsp;&nbsp;</th><th class='text-right'><?php echo $creo1 ?></th>
	<th class='text-right'><?php echo $too ?>&nbsp;&nbsp;</th></tr></tbody>
                  </table><br>

				<?php
				/*
				}
					else{
						echo"<div class='row'>
            <div class='col-lg-12' style='margin-top:-20px;'>
             <span> &nbsp;&nbsp; Total Records Found : <b> 0 </b></span>
			 <span class='pull-right hidden-print'> $bra &nbsp;&nbsp;<a href='#' onclick='return window.print()' class='hidden-print' title='Click to print' data-toggle='tooltip' data-placement='top'><i class='lnr lnr-printer'></i></a></span>
            <div class='widget-container fluid-height clearfix'>
            <div class='widget-content padded clearfix'>
			<br><br><br><br><br><br>
						<div style='text-align:center; font-size:24px; color:#ff9999'> Report not available on selected date </div><br><br><br><br><br><br><br>";
					}
			*/
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