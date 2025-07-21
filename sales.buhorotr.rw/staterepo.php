<?php
if(basename($_SERVER['PHP_SELF']) == 'staterepo.php') 
  $cm=" class='current'";
include'header.php';
include'connection.php';
$custo='';
$conde='';
$p=0;
$dato=$datos=$Date;

// search request by date
if(isset($_POST['search']))
		{
			$dato=$_POST['dato'];
			$datos=$_POST['datos'];
			$pg=$_POST['pg'];
			$custo=$_POST['custo'];
				$p=1;
		}


// search request by date
if(isset($_POST['valid']))
		{
			$dato=$_POST['dato'];
			$datos=$_POST['datos'];
			$custo=$_POST['custo'];
			$val=$_POST['val'];
			$p=$_POST['p'];
			$naso=$_POST['naso'];

			$so=mysqli_query($cons, "UPDATE `deposit` SET `Valid`='$val' WHERE `Number`='$naso'");
		}


		// delete a given deposit record
if(isset($_POST['delo']))
		{
			$dato=$_POST['dato'];
			$datos=$_POST['datos'];
			$custo=$_POST['custo'];
			$val=$_POST['val'];
			$p=$_POST['p'];
			$naso=$_POST['naso'];
			$reco=$_POST['reco'];

	$so=mysqli_query($cons, "UPDATE `deposit` SET `Status`='1', `Valid`='0' WHERE `Number`='$naso'");

			$go=mysqli_query($cons, "UPDATE `payment` SET `Passed`='0' WHERE `Number`='$reco'");
		}
if($dato==$datos)
			$mpri="ON $dato";
		else
			$mpri="FROM $dato TO $datos";
?>

<div class="container-fluid main-content">
        <div class="page-title hidden-print">
          <h2 style='margin-top:-20px; margin-bottom: 5px; color:#ffcc33'>
        Operations Report
          </h2>
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
      
    <li class="list-group-item active">
	  <a href="staterepo.php">
                <p>
                <i class="lnr lnr-menu-circle"></i>&nbsp;Bank Statement
                </p>
              </a></li>               
      
    <li class="list-group-item">
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
         
           <div class="col-lg-3"> </div>
          
         
           

        <form action="" method="post" class="form-horizontal ">                  
                       <div class="col-lg-8 hidden-print"><div class="col-lg-4"> 					
					  <select class="form-control" name="custo">
			 <?php
				echo"<option value='' selected='selected'> SELECT ACCOUNT </option>";
		$doi=mysqli_query($cons, "SELECT *FROM `baccount` ORDER BY `Number` ASC");
			while($roi=mysqli_fetch_assoc($doi)){
				$nu=$roi['Number'];
				$fna=$roi['Bank'];
				$acco=$roi['Account'];
				if($custo==$nu)
					$s="selected";
				else
					$s="";
			echo"<option value='$nu' title='$purpo' $s> $fna $acco </option>";
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
                       
                       <div class="col-lg-2"><?php echo"<input type='hidden' name='pg' value='$pg'>"; ?>
                        <button class="btn  btn-primary btn-block" type="submit" name="search"><i class="lnr lnr-magnifier"></i> Search</button>
                   
					  </div>
                         </div></form>               
            </div>
               <?php
					if($custo){
						$conde="AND `Account`='$custo'";
				$doin=mysqli_query($cons, "SELECT *FROM `baccount` WHERE `Number`='$custo' ORDER BY `Number` ASC");
						$roi=mysqli_fetch_assoc($doin);
							$bank=$roi['Bank'];
							$account=$roi['Account'];
					  }
					  else{
						  $bank=$account='';
					  }

				if($p)
		$dok=mysqli_query($cons, "SELECT *FROM `deposit` WHERE `Status`='0' AND `Date` BETWEEN '$dato' AND '$datos' $conde ORDER BY `Number` ASC LIMIT 1000");
				else
		$dok=mysqli_query($cons, "SELECT *FROM (SELECT *FROM `deposit` WHERE `Status`='0' AND `Date` <= '$Date' $conde ORDER BY `Number` DESC LIMIT 20) SUB ORDER BY `Date` ASC");
				if($fo=mysqli_num_rows($dok)){
				?>
                 
            <div class="divFooter"><center><u><b>BANK STATEMENT REPORT <?php echo $mpri ?></b></u></center></div>
             <div class="row">
            <div class="col-lg-12">
             <span> &nbsp;&nbsp; Total Records Found : <b><?php echo" $fo " ?></b></span>
			 <span class="pull-right hidden-print"><?php echo"$bank   $account"; ?>&nbsp;&nbsp;
			 <a href="#" onclick="return window.print()" class="hidden-print" title='Click to print' data-toggle='tooltip' data-placement='top'>
			 <i class="lnr lnr-printer"></i></a></span>
            <div class="widget-container fluid-height clearfix">
            <div class="widget-content padded clearfix">

								<table class="table table-striped table-hover">     
                                      <thead>
                    <tr role="row">
                     <th class="hidden-xs" style='padding:1px;'>&nbsp; No </th>
					 <th width='8%' style='padding:1px;'>&nbsp;&nbsp;&nbsp;Date </th>
        <th style='padding:1px;'>&nbsp;&nbsp;Source </th><th style='padding:1px;'>&nbsp;&nbsp;&nbsp;&nbsp;Destination </th>
		<th style='padding:1px;'>&nbsp;&nbsp;&nbsp;&nbsp;Account </th><th style='padding:1px;'><div align='center'>&nbsp;&nbsp;&nbsp;Purpose </th>
		<th style='padding:1px;'><div align='center'>&nbsp;&nbsp;&nbsp;Description </th><th style='padding:1px;'><div align='center'>&nbsp;&nbsp;Credit </th>
					   <th><div align='center'>&nbsp;&nbsp;Debit </th><th style='padding:1px;'><div align='center'>&nbsp;&nbsp;Balance </th>
								</tr></thead>
                                        <tbody>
					<?php

			// Calculate all deposits **********************************************
	$doin=mysqli_query($cons, "SELECT SUM(Amount) AS `Depo` FROM `deposit` WHERE `Status`='0' AND `Date` < '$dato' AND `Date`>='2020-01-01' AND `Item`='DEPOSIT' AND `Account`='$custo' ORDER BY `Number` ASC");
		$roin=mysqli_fetch_assoc($doin);
			$depo=$roin['Depo'];

			// Calculate all withdrawals **********************************************
	$dout=mysqli_query($cons, "SELECT SUM(Amount) AS `With` FROM `deposit` WHERE `Status`='0' AND `Date` < '$dato' AND `Date`>='2020-01-01' AND `Item`!='DEPOSIT' AND `Account`='$custo' ORDER BY `Number` ASC");
		$rout=mysqli_fetch_assoc($dout);
			$with=$rout['With'];

			$bal=$depo-$with;

								$i=1;			$tpin=$tpout=0;
						while($rok=mysqli_fetch_assoc($dok)){
				$code=$rok['Number'];
				$cheno=$rok['Refer'];
			$sour=$rok['Customer'];
			$dte=$rok['Date'];
			$dest=$rok['Source'];
			$bna=$rok['Operation'];				
			$pda=$rok['Descri'];				
			$item=$rok['Item'];
			$valide=$rok['Valid'];
			$reco=$rok['Record'];
			$acco=$rok['Account'];
			if($dest=='DIRECT')
				$dest="CASH";

			$doi=mysqli_query($cons, "SELECT *FROM `baccount` WHERE `Number`='$acco' ORDER BY `Number` ASC");
				$roi=mysqli_fetch_assoc($doi);
					$fna=$roi['Bank'];
					$acco=$roi['Account'];
												$pin=$pout=0;
			$amo=$rok['Amount'];								$amoo=number_format($amo);
			$stl="padding:1px;";

					if($item=='DEPOSIT'){
						$pin=$amo;
						$bal+=$amo;
					}
					else{
						$pout=$amo;	
						$bal-=$amo;
					}
							$balo=number_format($bal);						$pino=number_format($pin);					$pouto=number_format($pout);

				print("<tr><td class='hidden-xs' style='$stl $clr'><div align='right'>$i&nbsp;&nbsp;</td>
						<td style='$stl $clr'><div align='center'>&nbsp;$dte&nbsp;</td><td style='$stl $clr'>&nbsp; $dest </td>
						<td style='$stl $clr'>&nbsp; $sour </td><td style='$stl $clr'><div align='left'> $acco &nbsp;</td>
						<td style='$stl $clr'><div align='left'>&nbsp; $bna </td><td style='$stl $clr'><div align='left'> $pda </td>
						<td style='$stl $clr'><div align='right'> $pino &nbsp;</td><td style='$stl $clr'><div align='right'> $pouto &nbsp;</td>
						<td style='$stl $clr'><div align='right'> $balo &nbsp;</td></tr>");
									$i++;					$tpin+=$pin;				$tpout+=$pout;
						}
						$tp=number_format($tpin);				$tr=number_format($tpout);				$tb=number_format($tb);	
						?>
						
                    </tbody>
					 <thead>
					<tr><th class='hidden-xs'> </th><th colspan='6'><div align='center'> Total Amount </th>
					<th><div align='right'><?php echo $tp ?></th><th><div align='right'><?php echo $tr ?></th><th><div align='right'><?php echo $balo ?></th></tr>
                  </table> 
								</div></div>
								<span class="pull-right hidden-print">
			 <a href="#" onclick="return window.print()" class="hidden-print" title='Click to print' data-toggle='tooltip' data-placement='top'>
			 <i class="lnr lnr-printer"></i></a></span><br><br><br>

			<?php
				}
				else{
						echo"<div class='row'>
            <div class='col-lg-12' style='margin-top:-20px;'>
             <span> &nbsp;&nbsp; Total Records Found : <b> 0 </b></span>
            <div class='widget-container fluid-height clearfix'>
            <div class='widget-content padded clearfix'>
			<br><br><br><br><br><br>
	<div style='text-align:center; font-size:24px; color:#ff9999'>Report not available on selected date </div><br><br><br><br><br><br>";
					}
			
					?>
                                      
                
              </div>
            </div></div>
                  </div>
   <?php
   include'footer.php';
   ?>