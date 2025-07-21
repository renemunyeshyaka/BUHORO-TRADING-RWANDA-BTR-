<?php
if(basename($_SERVER['PHP_SELF']) == 'payreport.php') 
  $cm=" class='current'";
include'header.php';
include'connection.php';
$custo=$conde=$condi=$cond=$pla='';
$dato=$datos=$Date;
$gara=$pall='';
$p=0;

// search for an item to be added to the chart
if(isset($_POST['search']))
		{
			$dato=$_POST['dato'];
			$datos=$_POST['datos'];
			$custo=$_POST['custo'];
			$pla=$_POST['pla'];
			$p=1;
		}
		
		if($custo)
		    $conde="AND `Account`='$custo'";
	
	    if($dato==$datos)
			$mpri="ON $dato";
		else
			$mpri="FROM $dato TO $datos";
                ?>
                
<div class="container-fluid main-content">
        <div class="page-title hidden-print">
          <h3 style='margin-top:-20px; margin-bottom: 5px; color:#ffcc33'>
         Trip Report
          </h3>
  
    </div>
   <div class="row">
  <div class="col-lg-2 hidden-print">
   
  <ul class="list-group">
                  
			  <li class="list-group-item">
              <a href="triprepo.php">
                <p>
                <i class="lnr lnr-plus-circle"></i>&nbsp;Trip Report
                </p>
              </a></li>

    <li class="list-group-item">
	  <a href="disrepo.php">
                <p>
                <i class="lnr lnr-menu-circle"></i>&nbsp;Dispatch Report
                </p>
              </a></li> 

    <li class="list-group-item">
	  <a href="arrirepo.php">
                <p>
                <i class="lnr lnr-menu-circle"></i>&nbsp;Departure Report
                </p>
              </a></li>  

    <li class="list-group-item">
	  <a href="mirepo.php">
                <p>
                <i class="lnr lnr-menu-circle"></i>&nbsp;Mileage Report
                </p>
              </a></li>  

    <li class="list-group-item">
	  <a href="ductrepo.php">
                <p>
                <i class="lnr lnr-menu-circle"></i>&nbsp;Deduction Report
                </p>
              </a></li>  

    <li class="list-group-item">
	  <a href="custorepo.php">
                <p>
                <i class="lnr lnr-menu-circle"></i>&nbsp;Recovery Report
                </p>
              </a></li>  

    <li class="list-group-item">
	  <a href="currerepo.php">
                <p>
                <i class="lnr lnr-menu-circle"></i>&nbsp;Currency Report
                </p>
              </a></li>   

    <li class="list-group-item active">
	  <a href="payreport.php">
                <p>
                <i class="lnr lnr-menu-circle"></i>&nbsp;Payment Report
                </p>
              </a></li>    

    <li class="list-group-item">
	  <a href="debtors.php">
                <p>
                <i class="lnr lnr-menu-circle"></i>&nbsp;Debtors Report
                </p>
              </a></li>      

    <li class="list-group-item">
	  <a href="girepo.php">
                <p>
                <i class="lnr lnr-menu-circle"></i>&nbsp;GPS Report
                </p>
              </a></li>         

    <li class="list-group-item">
	  <a href="trepo.php">
                <p>
                <i class="lnr lnr-menu-circle"></i>&nbsp;Target  Report
                </p>
              </a></li>     
              
              </ul>
  </div>
                    
           
           
    <form action="" method="post" class="form-horizontal "> 
        <div class="col-lg-10">
                  <div class="row">

				  <div class="col-lg-1"> </div>         

            <div class="col-lg-3 hidden-print" style="padding-left:50px;">
        <select class="form-control" name="custo">
				<option value='' selected='selected'>Select Customer</option>
			 <?php
			$dois=mysqli_query($conn, "SELECT `account`.`Customer`, `account`.`Number` FROM `account` INNER JOIN `income` ON `account`.`Number` = `income`.`Customer` WHERE `income`.`Status`='0' AND `income`.`External`='1' GROUP BY `account`.`Customer` ORDER BY `account`.`Customer` ASC");
			while($rois=mysqli_fetch_assoc($dois)){
				$acco=$rois['Number'];
				$caso=$rois['Customer'];
				if($acco==$custo)
					$sli="selected='selected'";
				else
					$sli='';
			echo"<option value='$acco' $sli> $caso </option>";
			}
			?>    
                            </select></div> 
							
                       <div class="col-lg-8 hidden-print"><div class="col-lg-3">
			<select class="form-control" name="pla">
				<option value='' selected='selected'>Select Vehicle</option>
			 <?php
			$doi=mysqli_query($conn, "SELECT `vehicles`.`Plate`, `income`.`Vehicle` FROM `income` INNER JOIN `vehicles` ON `vehicles`.`Number` = `income`.`Vehicle` WHERE `vehicles`.`Trip`='1' GROUP BY `income`.`Vehicle` ORDER BY `income`.`Vehicle` ASC");
			while($roi=mysqli_fetch_assoc($doi)){
				$code=$roi['Vehicle'];
				$fna=$roi['Plate'];
				if($code==$custo)
					$sle="selected='selected'";
				else
					$sle='';
			echo"<option value='$code' $sle> $fna </option>";
			}
			?>    
                            </select>
					   </div>
            <div class="col-lg-3"> 
           <div class="input-group date" data-provide="datepicker">
      <input class="form-control form-center" name="dato" type="text" value="<?php echo $dato ?>" onkeypress='return isNumberKey(event)' required>
	  <span class="input-group-addon"><i class="lnr lnr-calendar-full"></i></span>
			</div></div>


		  <div class="col-lg-3"> 
           <div class="input-group date" data-provide="datepicker">	
      <input class="form-control form-center" name="datos" type="text" value="<?php echo $datos ?>" onkeypress='return isNumberKey(event)' required>
	  <span class="input-group-addon"><i class="lnr lnr-calendar-full"></i></span>
              </div></div>                      
                       
                       <div class="col-lg-2">
                        <button class="btn  btn-primary btn-block" type="submit" name="search"><i class="lnr lnr-magnifier"></i> Search</button>
                   
					  </div>
                         </div> 
                      
                     
                  
            </form> 
             
               
            </div>
             <?php
				if($p)
$do=mysqli_query($conn, "SELECT *FROM `payment` WHERE `Status`='0' AND `Action`='TRANSPORT' AND `Date` BETWEEN '$dato' AND '$datos' $conde ORDER BY `Date` ASC, `Number` ASC");
	else
$do=mysqli_query($conn, "SELECT *FROM (SELECT *FROM `payment` WHERE `Status`='0' AND `Action`='TRANSPORT' ORDER BY `Date` DESC LIMIT 15) SUB ORDER BY `Date` ASC, `Number` ASC");
        $fo=mysqli_num_rows($do);
					?>
					<div class="divFooter"><center><u><b>PAYMENT REPORT <?php echo"$mpri"; ?></b></u></center></div>
		 <div class="row">
            <div class="col-lg-12">
             <span> &nbsp;&nbsp; Total Records Found : <b><?php echo" $fo " ?></b></span>
			 <span class="pull-right hidden-print">
			 &nbsp;&nbsp;<a href="#" onclick="return window.print()" class="hidden-print" title='Click to print' data-toggle='tooltip' data-placement='top'><i class="lnr lnr-printer"></i></a></span>
			 
			  <span class="pull-right hidden-print">
		&nbsp;&nbsp;&nbsp;&nbsp;<a href="#" id="exporttable" class="hidden-print" title='Export to excell' data-toggle='tooltip' data-placement='top'><i class="lnr lnr-line-spacing"></i></a></span>
            <div class="widget-container fluid-height clearfix">
            <div class="widget-content padded clearfix">

			 <table class="table table-striped table-hover" id="htmltable">     
                                      <thead>
                    <tr role="row">
                     <th class="text-center"> No </th>
                        <th class="text-center" width="7%"> Date </th> 
                       <th class="text-center"> Vehicle </th> 
                        <th class="text-center"> Customer </th>
                        <th class="text-center" colspan='2'> Destination </th>
						 <th class="text-center"> Amount </th> 
						 <th class="text-center"> Cash </th> 
                        <th class="text-center"> Momo </th>  
                        <th class="text-center"> Cheque </th>  
                        <th class="text-center"> Deposit </th> 
                        <th class="text-center"> Transfer </th>  
						 <th class="text-center"> Rate </th>
						 <th class="text-center"> Value&nbsp;(RWF) </th>
						 </tr></thead><tbody>
					<?php
	    $i=1;					$tinco=$tca=$tmo=$tde=$ttra=$tche=$tval=0;
	while($ro=mysqli_fetch_assoc($do)){
	    $ca=$mo=$de=$tra=$che=0;
        $code=$ro['Number'];
        $acco=$ro['Account'];
        $cust=$ro['Customer'];
        $vou=$ro['Invoice'];
        $user=$ro['User'];
        $rate=$ro['Rate'];
        $dte=$ro['Date'];
        $amo=$ro['Amount'];
        $val=$amo*$rate;
        
        if($ro['Pline']=='CASH')
            $ca=$amo;
        if($ro['Pline']=='MOMO')
            $mo=$amo;
        if($ro['Pline']=='DEPOSIT')
            $de=$amo;
        if($ro['Pline']=='TRANSFER')
            $tra=$amo;
        if($ro['Pline']=='CHEQUE')
            $che=$amo;

$seepai=mysqli_query($conn, "SELECT `District`, `Location`, `Amount`, `Plate` FROM `income` WHERE `Number`='$vou' AND `Customer`='$acco' AND `Status`='0'");
if($feepai=mysqli_num_rows($seepai)){
		$reepai=mysqli_fetch_assoc($seepai);
		    $garag=$reepai['District'];
		    $pur=$reepai['Location'];
		     $fna=$reepai['Plate'];
		     $inco=$reepai['Amount'];
	$stn="style='padding:1px; font-size:12px;'";
}
else{
	$stn="style='padding:1px; font-size:12px; color:red;'";
	$garag=$pur=$fna='';
	$inco=0;
}
					
	$cao=number_format($ca, 2);
	$moo=number_format($mo, 2);
	$deo=number_format($de, 2);
	$trao=number_format($tra, 2);
	$cheo=number_format($che, 2);
	$rato=number_format($rate, 2);
	$valo=number_format($val, 2);
	$incoo=number_format($inco, 2);
           
	 print("<tr><td $stn class='text-center'>$i</td>
	 <td class='text-center' $stn> $dte </td><td $stn>&nbsp;$fna&nbsp;</td>
    <td $stn> $cust </td><td $stn> $garag </td><td $stn> $pur </td>
			<td class='text-right' $stn> $incoo&nbsp;</td>
			<td class='text-right' $stn> $cao&nbsp;</td>
			<td class='text-right' $stn> $moo&nbsp;</td>
			<td class='text-right' $stn> $cheo&nbsp;</td>
			<td class='text-right' $stn> $deo&nbsp;</td>
			<td class='text-right' $stn> $trao&nbsp;</td>
			<td class='text-right' $stn> $rato&nbsp;</td>
    <td class='text-right' $stn> $valo&nbsp;</td></tr>");
						$i++;
						
$tca+=$ca*$rate;                $tmo+=$mo*$rate;            $tde+=$de*$rate;
	$ttra+=$tra*$rate;            $tche+=$che*$rate;            $tval+=$val;
		$tinco+=$inco*$rate;
						}
						
		$tca=number_format($tca, 2);				
		$tmo=number_format($tmo, 2);				
		$tde=number_format($tde, 2);				
		$tche=number_format($tche, 2);				
		$ttra=number_format($ttra, 2);				
		$tval=number_format($tval, 2);				
		$tinco=number_format($tinco, 2);					

		?>
                    </tbody><thead> 
<tr><th> </th><th colspan='5' style='padding:1px; font-size:12px;'>&nbsp;&nbsp;Total Amount </th>
	<th style='padding:1px; font-size:12px; text-align:center;'>&nbsp;--&nbsp;</th>
	<th class='text-right' style='padding:1px; font-size:12px;'><?php echo $tca ?>&nbsp;</th>
	<th class='text-right' style='padding:1px; font-size:12px;'><?php echo $tmo ?>&nbsp;</th>
	<th class='text-right' style='padding:1px; font-size:12px;'><?php echo $tche ?>&nbsp;</th>
	<th class='text-right' style='padding:1px; font-size:12px;'><?php echo $tde ?>&nbsp;</th>
	<th class='text-right' style='padding:1px; font-size:12px;'><?php echo $ttra ?>&nbsp;</th>
	<th class='text-right' style='padding:1px; font-size:12px; text-align:center;'>&nbsp;--&nbsp;</th>
	<th class='text-right' style='padding:1px; font-size:12px;'><?php echo $tval ?>&nbsp;</th>
	</tr>
	        </thead></table>
                  
                                      
                
              </div>
            </div></div>
                  </div>                  
                <span class="pull-right hidden-print">
			 &nbsp;&nbsp;&nbsp;&nbsp;<a href="#" onclick="return window.print()" class="hidden-print" title='Click to print' data-toggle='tooltip' data-placement='top'><i class="lnr lnr-printer"></i></a></span>
      
   </div></div></div>  
   <?php
   include'footer.php';
   ?>