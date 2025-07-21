<?php
if(basename($_SERVER['PHP_SELF']) == 'prireport.php') 
  $cm=" class='current'";
include'header.php';
include'connection.php';
$dato=$datos=$Date;
$dalo="0000-00-00";
$custo='';
$conde='';
$condi='';
$t=$p=0;
$brc=$_SESSION['Branche'];
$brancho=$_SESSION['Branche'];

// search for an item to be added to the chart
if(isset($_POST['search']))
		{
			$brc=$_POST['brc'];
			$dato=$_POST['dato'];
			$datos=$_POST['datos'];
			$custo=$_POST['custo'];
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

		if($custo)
			$condi="AND `Customer`='$custo'";
		else
			$condi="";
?>
<div class="container-fluid main-content">
        <div class="page-title hidden-print">
          <h3 style='margin-top:-20px; margin-bottom: 5px; color:#ffcc33'>
         Customers Report
          </h3>
                 </div>
     
        <div class="row">
  <div class="col-lg-2 hidden-print">
   
 <ul class="list-group">

    <li class="list-group-item">
	  <a href="prirepo.php">
                <p>
                <i class="lnr lnr-menu-circle"></i>&nbsp;Balance Report
                </p>
              </a></li>  		  

    <li class="list-group-item active">
	  <a href="prireport.php">
                <p>
                <i class="lnr lnr-menu-circle"></i>&nbsp;Details &nbsp; Report
                </p>
              </a></li>

    <li class="list-group-item">
	  <a href="odreport.php">
                <p>
                <i class="lnr lnr-menu-circle"></i>&nbsp;Invoices Report
                </p>
              </a></li>   

    <li class="list-group-item">
	  <a href="csrepo.php">
                <p>
                <i class="lnr lnr-menu-circle"></i>&nbsp;Payment Report
                </p>
              </a></li>   
                         
            </ul>
  </div>
                    
           
           
       
         <div class="col-lg-10">
                  <div class="row">
         
           <div class="col-lg-2"> </div>
          
         
           

        <form action="" method="post" class="form-horizontal ">                  
                       <div class="col-lg-10 hidden-print"><div class="col-lg-3">
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
			echo"<option value='$num' $s> $fna </option>";
			}
			}
}
			?>			    
            </select>
					   </div>

		<div class="col-lg-3">
		<select class="form-control" name="custo" style='padding-right:5px;'>
						<?php
				echo"<option value='0' selected='selected'> SELECT CUSTOMER </option>";
	$seek=mysql_query("SELECT `Customer` FROM `payment` WHERE `Branche`!='0' AND `Status`='0' AND `Upda`='1' AND `Action`='SALES' AND `Amount`>'0' GROUP BY `Customer` ORDER BY `Customer` ASC LIMIT 1000");
			if($feek=mysql_num_rows($seek)){
		while($roi=mysql_fetch_assoc($seek)){
				$fna=$roi['Customer'];
				if($custo==$fna)
					$s='selected';
				else
					$s='';
			echo"<option value='$fna' $s> $fna </option>";
			}
			}
			?>			    
            </select>
					   </div>
            <div class="col-lg-2"> 
           <div class="input-group date datepicker">
      <input class="form-control form-center" id="from" name="dato" type="text" value="<?php echo $dato ?>" onkeypress="return isNumberKey(event)" style="padding-left:2px; padding-right:2px;" required>
	  <span class="input-group-addon"><i class="lnr lnr-calendar-full"></i></span>
			</div></div>


		  <div class="col-lg-2"> 
           <div class="input-group date datepicker">	
      <input class="form-control form-center" id="to" name="datos" type="text" value="<?php echo $datos ?>" onkeypress="return isNumberKey(event)" style="padding-left:2px; padding-right:2px;" required>
	  <span class="input-group-addon"><i class="lnr lnr-calendar-full"></i></span>
              </div></div>                        
                       
                       <div class="col-lg-2">
                        <button class="btn  btn-primary btn-block" type="submit" name="search"><i class="lnr lnr-magnifier"></i> Search</button>
                   
					  </div>
                         </div> 
                      
                     
                  
            </form> 
             
               
            </div>
                <?php
				if($p==0)
	$dox=mysqli_query($cons, "SELECT `Date` FROM (SELECT *FROM `payment` WHERE (`Status`='0' AND `Voucher`!='0' AND `Action`='SALES' $conde $condi) GROUP BY `Date` ORDER BY `Date` DESC LIMIT 10) SUB ORDER BY `Date` ASC");
				else
	$dox=mysqli_query($cons, "SELECT `Date` FROM `payment` WHERE (`Status`='0' AND `Voucher`!='0' AND `Action`='SALES' AND `Date` BETWEEN '$dato' AND '$datos' $conde $condi) GROUP BY `Date` ORDER BY `Date` ASC");
				if($fox=mysqli_num_rows($dox)){	
					?>
					<div class="divFooter"><center><u><b>CUSTOMERS REPORT <?php echo"$mpri"; ?></b></u></center></div>
		 <div class="row">
            <div class="col-lg-12">
             <span> &nbsp;&nbsp; Total Records Found : <b><?php echo" $fox " ?></b></span>
			 <span class="pull-right hidden-print"><a href="#" onclick="return window.print()" class="hidden-print" title='Click to print' data-toggle='tooltip' data-placement='top'><i class="lnr lnr-printer"></i></a></span>
			  <span class="pull-right"><?php echo $custo ?> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b> <?php echo $per ?>
			  &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; </b></span> 
            <div class="widget-container fluid-height clearfix">
            <div class="widget-content padded clearfix">

			<form action="" method="post">
				<div class='table-responsive'><table class="table table-striped table-hover">     
                       <thead><tr role="row">
                     <th width='3%' class="text-center">&nbsp;&nbsp;No&nbsp;&nbsp;</th>
                       <th class='text-center'> DATE </th> 
                       <th> CASHIER </th>
                       <th> ORDER&nbsp;No </th>
                       <th> CUSTOMER </th>
                       <th class='text-right'> ITEMS&nbsp;&nbsp;&nbsp;</th>
                       <th class='text-right'> SALES AMOUNT </th><th class='text-right'> PAID AMOUNT </th><th class='text-right'> BALANCE </th>
                     </tr>
                    </thead>
                                        <tbody>
			
			<?php
							$n=1;							$tot=$tsa=$tpa=0;
				while($rox=mysqli_fetch_assoc($dox)){
					$date=$rox['Date'];

	if($p==0)
	$doxe=mysqli_query($cons, "SELECT *FROM (SELECT *FROM `payment` WHERE (`Status`='0' AND `Voucher`!='0' AND `Action`='SALES' $conde $condi) GROUP BY `Voucher` ORDER BY `Voucher` DESC LIMIT 10) SUB ORDER BY `Voucher` ASC");
				else
	$doxe=mysqli_query($cons, "SELECT *FROM `payment` WHERE (`Status`='0' AND `Voucher`!='0' AND `Action`='SALES' AND `Date` = '$date' $conde $condi) GROUP BY `Voucher` ORDER BY `Voucher` ASC");
						
	while($roxe=mysqli_fetch_assoc($doxe)){
		$vous=$roxe['Voucher'];
		$cust=$roxe['Customer'];
		$cashi=$roxe['Cashier'];
		$tit='';

				$stn="padding:0px;";

		$nt=mysqli_query($cons, "SELECT `Item` FROM `stouse` WHERE `Voucher`='$vous' AND `Status`='0' AND `Action`='SALES' GROUP BY `Item` ORDER BY `Item` ASC");
			$ft=mysqli_num_rows($nt);

					$invos=0;
		$nt=mysqli_query($cons, "SELECT `Item`, `Quantity`, `Price` FROM `stouse` WHERE `Voucher`='$vous' AND `Status`='0' AND `Action`='SALES'");
			while($rt=mysqli_fetch_assoc($nt)){
				$qs=$rt['Quantity'];
				$pc=$rt['Price'];						$pco=number_format($pc, 2);
				$ito=$rt['Item'];
		
		$mdov=mysql_query("SELECT `Iname` FROM `items` WHERE `Number`='$ito' ORDER BY `Number` DESC LIMIT 1");
			$mrov=mysql_fetch_assoc($mdov);
				$item=$mrov['Iname'];

				$invos+=($qs*$pc);
				$tit="$tit
$qs x $item x $pco";
			}		
				$tot+=$invos;							$tsa+=$invos;							$invoso=number_format($invos, 2);

				$bal+=$invos;							$balo=number_format($bal, 2);
				
		echo"<tr title='$tit' data-toggle='tooltip' data-placement='top'><td style='$stn' class='text-right'> $n &nbsp;&nbsp;</th>
		<td class='text-center' style='$stn'> $date </td><td style='$stn'> $cashi </td><td class='text-center' style='$stn'> $vous </td>
		<td style='$stn'> $cust </td><td class='text-right' style='$stn'> $ft&nbsp;&nbsp;</td><td class='text-right' style='$stn'> $invoso&nbsp;&nbsp;</td>
		<td class='text-right' style='$stn'> &nbsp;&nbsp;</td><td class='text-right' style='$stn'> &nbsp;&nbsp;</td></tr>";

	$do=mysqli_query($cons, "SELECT *FROM `payment` WHERE (`Status`='0' AND `Voucher`='$vous' AND `Action`='SALES' $conde $condi) OR (`Status`='0' AND `Voucher`='$vous' AND `Action`='PAYMENT' $conde $condi) ORDER BY `Number` ASC LIMIT 100");
				$fo=mysqli_num_rows($do);
						
			while($ro=mysqli_fetch_assoc($do)){
				$dte=$ro['Date'];
				$user=$ro['Cashier'];
				$amo=$ro['Amount'];
				$amoo=number_format($amo, 2);
				$pli=$ro['Pline'];

				if($pli!='CREDIT'){
				$tot-=$amo;							$bal-=$amo;							$tpa+=$amo;
				}

				if($pli=='CASH')
					$des="";
				elseif($pli=='CREDIT')
					$des=$ro['Pdate'];
				elseif($pli=='CHEQUE'){
					$cheno=$ro['Cheno'];
					$bna=$ro['Bname'];
					$des="Cheque&nbsp;No:$cheno&nbsp;&nbsp;/&nbsp;&nbsp;Bank: $bna";
				}
				elseif($pli=='BANK'){
					$cheno=$ro['Cheno'];
					$bna=$ro['Bname'];
			$dois=mysqli_query($cons, "SELECT *FROM `baccount` WHERE `Number`='$bna' ORDER BY `Number` ASC");
			$rois=mysqli_fetch_assoc($dois);
				$bank=$rois['Bank'];
				$acco=$rois['Account'];
					$des="Slip&nbsp;No:$cheno&nbsp;&nbsp;/&nbsp;&nbsp;Account: $acco&nbsp;&nbsp;/&nbsp;&nbsp;$bank";
				}

			if($pli=='CREDIT')
				$stn="color:#336699; padding:0px;";	
			else
				$stn="color:#3333ff; padding:0px;";

			$balo=number_format($bal, 2);

		print("<tr>
		<td colspan='2' style='$stn' class='text-right'> &nbsp;&nbsp;</td><td style='$stn'> $dte </td>
		<td colspan='2' style='$stn'> $user </td><td colspan='2' style='$stn'> $pli&nbsp;&nbsp;&nbsp;&nbsp;$des</td>
		<td style='$stn' class='text-right'> $amoo &nbsp;&nbsp;</td><td class='text-right' style='$stn'> $balo&nbsp;&nbsp;</td></tr>");
						  $n++;					$tot+=$bal;					//	$tba+=$bal;				$tpa+=$pa;				$tq+=$qty;
						}

	}






$nd=mysqli_query($cons, "SELECT `Date` FROM `payment` WHERE (`Status`='0' AND `Voucher`!='0' AND `Action`='SALES' AND `Date` > '$date' AND `Date` <= '$datos' $conde $condi) GROUP BY `Date` ORDER BY `Date` ASC LIMIT 1");
			if($fd=mysqli_num_rows($nd)){
				$rd=mysqli_fetch_assoc($nd);
					$dasi=$rd['Date'];
			}
			else
				$dasi=$datos;















$do=mysqli_query($cons, "SELECT *FROM `payment` WHERE (`Date` >= '$date' AND `Date` < '$dasi' AND `Status`='0' AND `Voucher`!='0' AND `Action`='PAYMENT' $conde $condi) ORDER BY `Number` ASC LIMIT 100");
				if($fo=mysqli_num_rows($do) AND $custo AND $dalo!=$date){
						
			while($ro=mysqli_fetch_assoc($do)){
				$dte=$ro['Date'];
				$user=$ro['Cashier'];
				$cu=$ro['Customer'];
				$amo=$ro['Amount'];
				$amoo=number_format($amo, 2);
				$pli=$ro['Pline'];

				if($pli!='CREDIT'){
				$tot-=$amo;							$bal-=$amo;							$tpa+=$amo;
				}

				if($pli=='CASH')
					$des="";
				elseif($pli=='CREDIT')
					$des=$ro['Pdate'];
				elseif($pli=='CHEQUE'){
					$cheno=$ro['Cheno'];
					$bna=$ro['Bname'];
					$des="Cheque&nbsp;No:$cheno&nbsp;&nbsp;/&nbsp;&nbsp;Bank: $bna";
				}
				elseif($pli=='BANK'){
					$cheno=$ro['Cheno'];
					$bna=$ro['Bname'];
			$dois=mysqli_query($cons, "SELECT *FROM `baccount` WHERE `Number`='$bna' ORDER BY `Number` ASC");
			$rois=mysqli_fetch_assoc($dois);
				$bank=$rois['Bank'];
				$acco=$rois['Account'];
					$des="Slip&nbsp;No:$cheno&nbsp;&nbsp;/&nbsp;&nbsp;Account: $acco&nbsp;&nbsp;/&nbsp;&nbsp;$bank";
				}

			if($pli=='CREDIT')
				$stn="color:#ffcc99; padding:0px;";	
			else
				$stn="color:#006600; padding:0px;";

			$balo=number_format($bal, 2);

		print("<tr>
		<td style='$stn' class='text-right'> &nbsp;&nbsp;</td><td style='$stn'> $dte </td>
		<td colspan='2' style='$stn'> $user </td><td style='$stn'> $cu </td><td colspan='2' style='$stn'> $pli&nbsp;&nbsp;&nbsp;&nbsp;$des</td>
		<td style='$stn' class='text-right'> $amoo &nbsp;&nbsp;</td><td class='text-right' style='$stn'> $balo&nbsp;&nbsp;</td></tr>");
						  $n++;				//	$tot+=$amo;					$tba+=$bal;				$tpa+=$pa;				$tq+=$qty;
						}
			}
			$dalo=$date;
	}
	



			
	
	$balo=number_format($bal, 2);							$tsa=number_format($tsa, 2);							$tpa=number_format($tpa, 2);			
				  print("<tr><th class='text-center' colspan='4'>TOTAL AMOUNT</th>
				  <th colspan='2' class='text-left'> </th><th class='text-right'> $tsa </th><th class='text-right'> $tpa </th>
						<th class='text-right'> $balo </th></tr></table><br></div>");

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