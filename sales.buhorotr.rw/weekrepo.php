<?php
if(basename($_SERVER['PHP_SELF']) == 'weekrepo.php') 
  $cm=" class='current'";
include'header.php';
include'connection.php';
$dato=$datos=$Date;
$custo='';
$conde='';
$t=$p=0;
$brc=$_SESSION['Branche'];
$brancho=$_SESSION['Branche'];

// search for an item to be added to the chart
if(isset($_POST['search']))
		{
			$brc=$_POST['brc'];
			$dato=$_POST['dato'];
			$p=1;
		}

			$mpri="ON $dato";

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
         Operations Report
          </h3>
                 </div>
     
        <div class="row">
  <div class="col-lg-2 hidden-print">
   
 <ul class="list-group">

    <li class="list-group-item">
	  <a href="deporepo.php">
                <p>
                <i class="lnr lnr-menu-circle"></i>&nbsp;Deposit Report
                </p>
              </a></li>  

	 <li class="list-group-item">
	  <a href="withrepo.php">
                <p>
                <i class="lnr lnr-menu-circle"></i>&nbsp;Withdrawal Report
                </p>
              </a></li> 
      
    <li class="list-group-item">
	  <a href="staterepo.php">
                <p>
                <i class="lnr lnr-menu-circle"></i>&nbsp;Bank Statement
                </p>
              </a></li>             
      
    <li class="list-group-item active">
	  <a href="weekrepo.php">
                <p>
                <i class="lnr lnr-menu-circle"></i>&nbsp;Weekly Report
                </p>
              </a></li>                    
      
    <li class="list-group-item">
	  <a href="cashrepo.php">
                <p>
                <i class="lnr lnr-menu-circle"></i>&nbsp;Cashbox Report
                </p>
              </a></li>     
      
    <li class="list-group-item">
	  <a href="payoutrepo.php">
                <p>
                <i class="lnr lnr-menu-circle"></i>&nbsp;Payout Report
                </p>
              </a></li>            
      
    <li class="list-group-item">
	  <a href="cosales.php">
                <p>
                <i class="lnr lnr-menu-circle"></i>&nbsp;Sales Report
                </p>
              </a></li>                 
      
    <li class="list-group-item">
	  <a href="perrepo.php">
                <p>
                <i class="lnr lnr-menu-circle"></i>&nbsp;Performance Report 1
                </p>
              </a></li>                     
      
    <li class="list-group-item">
	  <a href="perrepos.php">
                <p>
                <i class="lnr lnr-menu-circle"></i>&nbsp;Performance Report 2
                </p>
              </a></li>                       
      
    <li class="list-group-item">
	  <a href="perrepot.php">
                <p>
                <i class="lnr lnr-menu-circle"></i>&nbsp;Performance Report 3
                </p>
              </a></li>                  
            </ul>
  </div>  
           
       
        <div class="col-lg-10">
                  <div class="row">
         
           <div class="col-lg-4"> </div>
          
         
           

        <form action="" method="post" class="form-horizontal ">                  
  <div class="col-lg-8 hidden-print"><div class="col-lg-3"> </div>
					   
					   <div class="col-lg-3"> 
		<select class="form-control" name="brc" style='padding-right:5px;' disabled>
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
      <input class="form-control form-center" id="from" name="dato" type="text" value="<?php echo $dato ?>" onkeypress='return isNumberKey(event)' disabled>
	  <span class="input-group-addon"><i class="lnr lnr-calendar-full"></i></span>
			</div></div>
                      
                       
                       <div class="col-lg-2">
            <button class="btn  btn-primary btn-block" type="submit" name="search" disabled><i class="lnr lnr-magnifier"></i> Search</button>
                   
					  </div>
                         </div> 
                      
                     
                  
            </form> 
             
               
            </div>

					<div class="divFooter"><center><u><b>WEEKLY REPORT <?php echo"$mpri"; ?></b></u></center></div>
		 <div class="row">
            <div class="col-lg-12">
             <span>&nbsp;&nbsp;&nbsp;&nbsp;Weekly Report</span>
			 <span class="pull-right hidden-print"><?php echo $bra ?>&nbsp;&nbsp;&nbsp;&nbsp;
			 <a href="#" onclick="return window.print()" class="hidden-print" title='Click to print' data-toggle='tooltip' data-placement='top'>
			 <i class="lnr lnr-printer"></i></a></span>
            <div class="widget-container fluid-height clearfix">
            <div class="widget-content padded clearfix">
			
			             
				<table class="table table-bordered table-striped table-hover">     
                       <thead><tr role="row">
                     <th width='5%'>&nbsp;&nbsp;&nbsp;&nbsp;# </th>
                       <th width='40%' colspan='2' class='text-center'> CREDIT </th>
                       <th width='40%' colspan='2' class='text-center'> DEBIT </th>
                       <th class='text-center'> STATUS </th></tr>

					<tr role="row">
                       <th> </th>
                        <th> DESCRIPTION  </th>
                       <th width='20%'> AMOUNT </th>
                       <th width='20%'> ITEM </th>
						<th width='20%'> AMOUNT </th>
						<th> BALANCE </th>
                     </tr>
                    </thead>
                                        <tbody>
					<?php

					echo"<tr>
                       <td class='text-center'>&nbsp;1&nbsp;</td>
                        <td> MAIN STORE  </td>
                       <td class='text-right'>";
					   $store=0;
					   
	// Store value in warehouse ********************************
	$do=mysqli_query($cons, "SELECT SUM(`Quantity`*`Cost`) AS `Ware` FROM `items` WHERE `Store`<='2' AND `Status`='0' AND `Quantity`>'0' ORDER BY `Number` ASC");
			$ro=mysqli_fetch_assoc($do);
			$ware=$ro['Ware'];
			$wareo=number_format($ware);
			$store+=$ware;
			$n=1;
					   
					   echo"$wareo&nbsp;</td>
                       <td> SUPPLIERS </td>
						<td class='text-right'>";
			
			// Store receivings *********************************
$rece=0;
	$dor=mysql_query("SELECT SUM(`Quantity`*`Price`) AS `Rece` FROM `stouse` WHERE `Status`='0' AND `Voucher`!='0' AND `Upda`='1' AND `Action`='RECEIVE' ORDER BY `Number` ASC");
		$ror=mysql_fetch_assoc($dor);
			$rece=$ror['Rece'];

$sepa=mysql_query("SELECT SUM(`Amount`) AS 'Pay' FROM `supay` WHERE `Amount`>'0' AND `Status`='0' ORDER BY `Number` DESC");
			$repa=mysql_fetch_assoc($sepa);
				$rece-=$repa['Pay'];
				
/*
						//$rece=$ror['Rece'];

			// Suppliers payments *******************************
	//$dore=mysqli_query($cons, "SELECT SUM(`Amount`) AS `Pur` FROM `payment` WHERE `Status`='0' AND `Action`='PURCHASE' AND `Voucher`!='0' ORDER BY `Number` ASC");
	$dore=mysqli_query($cons, "SELECT SUM(`supay`.`Amount`) AS 'Pur' FROM `supay` INNER JOIN `stouse` ON `supay`.`Docno`=`stouse`.`Voucher` WHERE `stouse`.`Date`>='2020-03-01' AND `stouse`.`Action`='RECEIVE' AND `supay`.`Amount` > '0' AND `supay`.`Supplier`!='' ORDER BY `supay`.`Number` ASC");
		$rore=mysqli_fetch_assoc($dore);
						$rece-=$rore['Pur'];
*/

						$receo=number_format($rece);

						$b1=$ware-$rece;				$bo1=number_format($b1);
						
						echo"$receo&nbsp;</td>
						<td class='text-right'> $bo1&nbsp;</td></tr>";
$n++;


		// ********************************** Store at branches *******************************************
		$doi=mysql_query("SELECT `Number`, `Name` FROM `branches` WHERE `Status`='10' ORDER BY `Number` ASC");
			while($roi=mysql_fetch_assoc($doi)){
				$fna=$roi['Name'];
				$nuo=$roi['Number'];
				$fld="S$nuo";

		$dob=mysqli_query($cons, "SELECT SUM(`$fld`*`Cost`) AS `Bra` FROM `items` WHERE `Store`<='2' AND `Status`='0' AND `$fld`>'0' ORDER BY `Number` ASC");
			$rob=mysqli_fetch_assoc($dob);
			$bra=$rob['Bra'];
			$brao=number_format($bra);
			$store+=$bra;	

			echo"<tr><td style='$stn'><div align='center'>&nbsp;$n&nbsp;</td><td style='$stn'> $fna </td>
		<td style='$stn'><div align='right'> $brao&nbsp;</td><td style='$stn'><div align='left'><b> &nbsp; </td>
		<td style='$stn'> &nbsp; </td><td style='$stn'> &nbsp; </td></tr>";
$n++;
			}
				$sp=$store-$rece;
			$storeo=number_format($store);							$spo=number_format($sp);
				// ******************************* Total Store (Warehouse + Branches) *************************
			echo"<tr><td style='$stn'><div align='center'>&nbsp;$n&nbsp;</td><td style='$stn'><b> TOTAL STOCK </td>
		<td style='$stn'><div align='right'><b> $storeo&nbsp;</td><td style='$stn'><div align='left'><b> &nbsp; </td>
		<td style='$stn'> &nbsp; </td><td style='$stn' class='text-right'><b> $spo&nbsp;</td></tr>";
$n++;

			// ****************************** Customers balance **********************************************

	$cus=mysqli_query($cons, "SELECT SUM(`Balance`) AS `Bce` FROM `account` WHERE `Balance`>'0' AND `Status`='0' ORDER BY `Number` ASC");
		$ruc=mysqli_fetch_assoc($cus);
			$bce=$ruc['Bce'];
			$bceo=number_format($bce);
			$sp+=$bce;												$spo=number_format($sp);
			$store+=$bce;	

			echo"<tr><td style='$stn'><div align='center'>&nbsp;$n&nbsp;</td><td style='$stn'> CUSTOMERS </td>
		<td style='$stn'><div align='right'> $bceo&nbsp;</td><td style='$stn'><div align='left'> &nbsp; </td>
		<td style='$stn'> &nbsp; </td><td style='$stn' class='text-right'> $spo&nbsp;</td></tr>";
$n++;

// ********************************** Balance for bank accounts *******************************************
		$doib=mysql_query("SELECT `Number`, `Bank`, `Account` FROM `baccount` WHERE `Status`='0' ORDER BY `Number` DESC");
			while($roib=mysql_fetch_assoc($doib)){
				$fna=$roib['Bank'];
				$acco=$roib['Account'];
				$nuo=$roib['Number'];

		$dobi=mysqli_query($cons, "SELECT SUM(IF(`Operation`!='WITHDRAWAL', `Amount`, 0)) AS `Depo`, SUM(IF(`Operation`='WITHDRAWAL', `Amount`, 0)) AS `With` FROM `deposit` WHERE `Account`='$nuo' AND `Status`='0' ORDER BY `Number` ASC");
			$robi=mysqli_fetch_assoc($dobi);
			$bank=$robi['Depo']-$robi['With'];
			$banko=number_format($bank);
			$sp+=$bank;											$spo=number_format($sp);
			$store+=$bank;	

			echo"<tr><td style='$stn'><div align='center'>&nbsp;$n&nbsp;</td><td style='$stn'> $acco/$fna </td>
		<td style='$stn'><div align='right'> $banko&nbsp;</td><td style='$stn'><div align='left'><b> &nbsp; </td>
		<td style='$stn'> &nbsp; </td><td style='$stn' class='text-right'> $spo&nbsp;</td></tr>";
$n++;
			}
							$storeo=number_format($store);
			echo"<tr><td colspan='2' style='$stn'><div align='center'><b>&nbsp;TOTAL BALANCE&nbsp;</td>
		<td style='$stn'><div align='right'><b> $storeo&nbsp;</td><td style='$stn'><div align='left'><b> &nbsp; </td>
		<td style='$stn' class='text-right'><b> $receo&nbsp;</td><td style='$stn' class='text-right'><b> $spo&nbsp;</td></tr>";

					?>	
						
            </tbody></table>

                 </div> </div>                  
                <span class="pull-right hidden-print">
			 &nbsp;&nbsp;&nbsp;&nbsp;<a href="#" onclick="return window.print()" class="hidden-print" title='Click to print' data-toggle='tooltip' data-placement='top'><i class="lnr lnr-printer"></i></a></span>
      <br><br><br>
   </div></div> 
   <?php
   include'footer.php';
   ?>