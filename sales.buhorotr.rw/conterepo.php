<?php
if(basename($_SERVER['PHP_SELF']) == 'conterepo.php') 
  $cm=" class='current'";
include'header.php';
include'connection.php';
$dato=$datos=$Date;
$custo=$conde='';
$t=$p=$brc=0;
$brc=$_SESSION['Branche'];
$brancho=$_SESSION['Branche'];

// search for an item to be added to the chart
if(isset($_POST['search']))
		{
			$brc=$_POST['brc'];
			$dato=$_POST['dato'];
			$datos=$_POST['datos'];
			$p=1;
		}
	
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
	  <a href="sarepo.php">
                <p>
                <i class="lnr lnr-menu-circle"></i>&nbsp;Sales Report
                </p>
              </a></li>  

    <li class="list-group-item">
	  <a href="surepo.php">
                <p>
                <i class="lnr lnr-menu-circle"></i>&nbsp;Item Sold Report
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
	  <a href="recorepo.php">
                <p>
                <i class="lnr lnr-menu-circle"></i>&nbsp;Recovery Report
                </p>
              </a></li>     

	 <li class="list-group-item">
	  <a href="debrepo.php">
                <p>
                <i class="lnr lnr-menu-circle"></i>&nbsp;Debtors Report
                </p>
              </a></li>    

	 <li class="list-group-item active">
	  <a href="conterepo.php">
                <p>
                <i class="lnr lnr-menu-circle"></i>&nbsp;Balance Report
                </p>
              </a></li>    

	 <li class="list-group-item">
	  <a href="balrepo.php">
                <p>
                <i class="lnr lnr-menu-circle"></i>&nbsp;Control Report
                </p>
              </a></li>     

	 <li class="list-group-item">
	  <a href="dayrepo.php">
                <p>
                <i class="lnr lnr-menu-circle"></i>&nbsp;Income Report
                </p>
              </a></li>  
                         
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
					?>
					<div class="divFooter"><center><u><b>SALES BALANCE REPORT <?php echo"$mpri"; ?></b></u></center></div>
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
                       <th> Due&nbsp;Date </th>
						<th class="text-center">Payment</th>
						<th class="text-center">Sales</th>
						<th class="text-center">Cash</th>
						<th class="text-center">Deposit</th>
						<th class="text-center">Cheque</th>
						<th class="text-center">Total</th>
						<th class="text-center">Credit</th>
						<th class="text-center">Payout</th>
						<th class="text-center">Supplier</th>
						<th class="text-center">Banked</th>
						<th class="text-center">Cashbox</th>
                     </tr>
                    </thead>
                                        <tbody>
					<?php
					$n=1;					$tot=$tca=$tche=$tba=$tcre=$tpa=$tpo=$tpu=$tde=$tto=0;							$date=$dato;
				
						while($date<=$datos){
				$ca=$che=$ba=$po=$pu=$de=$sa=$cre=$pa=$to=0;
	$spa=mysql_query("SELECT *FROM `payment` WHERE `Voucher`!='0' AND `Status`='0' AND `Date`='$date' $conde ORDER BY `Number` ASC");
				while($rpa=mysql_fetch_assoc($spa)){
						$amo=$rpa['Amount'];

			if($rpa['Action']=='SALES' OR $rpa['Action']=='PAYMENT' OR $rpa['Action']=='CASHBOX'){
				if($rpa['Pline']=='CASH')
					$ca+=$amo;

				if($rpa['Pline']=='CHEQUE')
					$che+=$amo;

				if($rpa['Pline']=='BANK')
					$ba+=$amo;

				if($rpa['Pline']=='CREDIT')
					$cre+=$amo;
					}
				
			if($rpa['Action']=='PAYOUT' AND $rpa['Pline']=='CASH'){
				$po+=$amo;
				}
			if($rpa['Action']=='PURCHASE' AND $rpa['Pline']=='CASH'){
				$pu+=$amo;
				}
			
			if($rpa['Action']=='PAYMENT'){
				$pa+=$amo;
				}

				}

	$dok=mysqli_query($cons, "SELECT SUM(Amount) AS 'Depo' FROM `deposit` WHERE `Status`='0' AND `Date`='$date' AND `Source`='SALES' $conde ORDER BY `Number` ASC LIMIT 1000");
			$rok=mysqli_fetch_assoc($dok);
				$de=$rok['Depo'];

				
$dor=mysqli_query($cons, "SELECT `Price`, `Quantity` FROM `stouse` WHERE `Voucher`!='0' AND `Status`='0' AND `Date`='$date' AND `Action`='SALES' $conde ORDER BY `Number` ASC");
				while($ror=mysqli_fetch_assoc($dor)){
				$sa+=$ror['Price']*$ror['Quantity'];
					}			
							$cashbox+=$ca-$po-$pu-$de;					$to=$ca+$che+$ba;						$too=number_format($to);
				
	$poo=number_format($po);			$creo=number_format($cre);				$cao=number_format($ca);             $deo=number_format($de);
	
	$cheo=number_format($che);				$poo=number_format($po);				$puo=number_format($pu);					$bao=number_format($ba);

$stn="padding:1px;";					$cashboxo=number_format($cashbox);				$sao=number_format($sa);				$pao=number_format($pa);

		print("<tr><td class=hidden-xs style='$stn'><div align='center'>$n&nbsp;&nbsp;</td><td class='text-center' style='$stn'> $date </td>
		<td class='text-right' style='$stn'> $pao&nbsp;&nbsp;</td><td class='text-right' style='$stn'> $sao&nbsp;&nbsp;</td>
		<td style='$stn'><div align='right'> $cao&nbsp;&nbsp;</td><td style='$stn'><div align='right'> $bao&nbsp;&nbsp;</td>
		<td style='$stn'><div align='right'> $cheo&nbsp;&nbsp;</td><td style='$stn'><div align='right'> $too&nbsp;&nbsp;</td>

		<td style='$stn'><div align='right'> $creo&nbsp;&nbsp;</td><td style='$stn'><div align='right'> $poo&nbsp;&nbsp;</td>
		<td style='$stn'><div align='right'> $puo&nbsp;&nbsp;</td><td style='$stn'><div align='right'> $deo&nbsp;&nbsp;</td>
		<td style='$stn'><div align='right'> $cashboxo&nbsp;&nbsp;</td></tr>");
						  $n++;				$tot+=$sa;			$tca+=$ca;			$tche+=$che;		$tba+=$ba;			$tcre+=$cre;			$tpa+=$pa;
			$tpo+=$po;				$tpu+=$pu;			$tde+=$de;					$tto+=$to;
			
			if($date==$Date)
			    break;
		
		$date = strtotime("+1 day", strtotime("$date"));
				$date=date("Y-m-d", $date);
}
						
	$tot=number_format($tot);					$tto=number_format($tto);				$tche=number_format($tche);					$tca=number_format($tca);
						$tba=number_format($tba);								$tcre=number_format($tcre);						$cashboxo=number_format($cashbox);
	$tpa=number_format($tpa);							$tpo=number_format($tpo);					$tpu=number_format($tpu);			$tde=number_format($tde);
						?>
						
                     </tbody>

					 <thead>
					<tr><th class="hidden-xs"> </th><th class='text-center'> Total Amount </th>
	<th><div align='right'><?php echo $tpa ?></th><th><div align='right'><?php echo $tot ?></th>
	<th class='text-right'><?php echo $tca ?></th><th class='text-right'><?php echo $tba ?></th>
	<th class='text-right'><?php echo $tche ?></th><th class='text-right'><?php echo $tto ?></th>

	<th class='text-right'><?php echo $tcre ?></th><th class='text-right'><?php echo $tpo ?></th>
	<th class='text-right'><?php echo $tpu ?></th><th class='text-right'><?php echo $tde ?></th>
	<th><div align='right'><?php echo $cashboxo ?></th></tr></thead>
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