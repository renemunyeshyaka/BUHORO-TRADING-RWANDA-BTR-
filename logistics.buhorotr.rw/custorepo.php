<?php
if(basename($_SERVER['PHP_SELF']) == 'custorepo.php') 
  $cm=" class='current'";
include'header.php';
include'connection.php';
$custo=$conde=$condi=$cond='';
$dato=$datos=$Date;
$gara=$pall='';
$p=0;

// search for an item to be added to the chart
if(isset($_POST['search']))
		{
			$dato=$_POST['dato'];
			$datos=$_POST['datos'];
			$custo=$_POST['custo'];
			$gara=$_POST['gara'];
			$p=1;
		}

			// Delete a single payment record
if(isset($_POST['pdelex']))
		{
			$dato=$_POST['dato'];
			$datos=$_POST['datos'];
			$custo=$_POST['custo'];
			$code=$_POST['code'];
			$gara=$_POST['gara'];
			$p=$_POST['p'];
			$num=$_POST['num'];
			$link=$_POST['link'];
			$pri=$_POST['pri']*$_POST['rti'];
				$p=$_POST['p'];
				$file=$_POST['file'];
		      unlink("files/$file");
		            
	$deles=mysqli_query($conn, "DELETE FROM `payment` WHERE `Number`='$num' AND `Action`='TRANSPORT' ORDER BY `Number` DESC LIMIT 1");
						
	$deles=mysqli_query($conn, "DELETE FROM `deposit` WHERE `Item`='TRANSPORT' AND `Operation`='DEPOSIT' AND `Refer`='x1' AND `Number`='$link' ORDER BY `Number` DESC LIMIT 1");
		}
		
	// Add a payment
if(isset($_POST['addpa']))
		{
			$dato=$_POST['dato'];
			$datos=$_POST['datos'];
			$custo=$_POST['custo'];
			$gara=$_POST['gara'];
			$supplier=$_POST['supplier'];
			$refo=str_replace("'", "`", $_POST['refo']);
			$amo=str_replace(',', '', $_POST['amo']);
			$balo=str_replace(',', '', $_POST['balo']);
			$p=$_POST['p'];
			$dati=$_POST['dati'];
			$curr=$_POST['currency'];
			$pieces = explode("-", $_POST['pline']);
			$pline = $pieces[0]; 
			$count=$_POST['count'];
			$code=$_POST['code'];
			$pall=$_POST['pall'];
			$caso=$_POST['caso'];
			
			if($pall=='all'){
	$whole=mysqli_query($conn, "INSERT INTO `wholepay` (`Date`, `User`, `Supplier`, `Froda`, `Toda`, `Balance`, `Amount`, `Pline`, `Refer`) VALUES ('$dati', '$loge', '$supplier', '$dato', '$datos', '$balo', '$amo', '$pline', '$refo')");
	$last_id = mysqli_insert_id($conn);
	
	$dor=mysqli_query($conn, "SELECT `stouse`.`Voucher`, SUM(Quantity*Price) AS 'Tot' FROM `stouse` WHERE `Status`='0' AND `Voucher`!='0' AND `Action`='PROFORMA' AND `Date` BETWEEN '$dato' AND '$datos' AND `Destin`='$supplier' GROUP BY `Voucher` ORDER BY `Voucher` ASC LIMIT 2000");
	while($ror=mysqli_fetch_assoc($dor)){
	    $tot=$ror['Tot'];
	    $vou=$ror['Voucher'];
	
		$seepa=mysqli_query($conn, "SELECT SUM(`Amount`) AS 'Pay' FROM `rpay` WHERE `Voucher`='$vou' AND `Action`='$count' AND `Customer`='$caso'");
		$reepa=mysqli_fetch_assoc($seepa);
		    $pay=$reepa['Pay'];
						$bal=$tot-$pay;  
						if($amo>$bal){
			$dof=mysqli_query($conn, "INSERT INTO `rpay` (`Date`, `User`, `Amount`, `Voucher`, `Action`, `Cheno`, `Rate`, `Pline`, `whole`, `Customer`) VALUES ('$dati', '$loge', '$bal', '$vou', '$count', '$refo', '$curr', '$pline', '$last_id', '$caso')");
						}
						else{
			$dof=mysqli_query($conn, "INSERT INTO `rpay` (`Date`, `User`, `Amount`, `Voucher`, `Action`, `Cheno`, `Rate`, `Pline`, `Whole`, `Customer`) VALUES ('$dati', '$loge', '$amo', '$vou', '$count', '$refo', '$curr', '$pline', '$last_id', '$caso')");
						break;    
						}
						$amo-=$bal;
		}
	$so=mysqli_query($conn, "DELETE FROM `rpay` WHERE `Amount`='0' ORDER BY `Number` ASC LIMIT 100");
			    
			}
			else{
	$dof=mysqli_query($conn, "INSERT INTO `rpay` (`Date`, `User`, `Amount`, `Voucher`, `Action`, `Cheno`, `Rate`, `Pline`, `Customer`) VALUES ('$dati', '$loge', '$amo', '$code', '$count', '$refo', '$curr', '$pline', '$caso')");
			}
		}
	
	if($dato==$datos)
			$mpri="ON $dato";
		else
			$mpri="FROM $dato TO $datos";

			if($custo)
				$condi="AND `income`.`Vehicle`='$custo'";

			if($gara)
				$cond="AND `income`.`Customer`='$gara'";

				if($p)
			$conde="AND `income`.`Date` BETWEEN '$dato' AND '$datos'";
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

    <li class="list-group-item active">
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

    <li class="list-group-item">
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
        <select class="form-control" name="gara">
				<option value='' selected='selected'>Select Customer</option>
			 <?php
			$dois=mysqli_query($conn, "SELECT `account`.`Customer`, `account`.`Number` FROM `account` INNER JOIN `income` ON `account`.`Number` = `income`.`Customer` WHERE `income`.`Status`='0' AND `income`.`External`='1' GROUP BY `account`.`Customer` ORDER BY `account`.`Customer` ASC");
			while($rois=mysqli_fetch_assoc($dois)){
				$acco=$rois['Number'];
				$gar=$rois['Customer'];
				if($acco==$gara)
					$sli="selected='selected'";
				else
					$sli='';
			echo"<option value='$acco' $sli> $gar </option>";
			}
			?>    
                            </select></div> 
							
                       <div class="col-lg-8 hidden-print"><div class="col-lg-3">
			<select class="form-control" name="custo">
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
$do=mysqli_query($conn, "SELECT `income`.* FROM `income` INNER JOIN `vehicles` ON `vehicles`.`Number` = `income`.`Vehicle` WHERE `income`.`Status`='0' AND `vehicles`.`Trip`='1' $conde $condi $cond ORDER BY `income`.`Date` ASC");
	else
$do=mysqli_query($conn, "SELECT *FROM (SELECT `income`.* FROM `income` INNER JOIN `vehicles` ON `vehicles`.`Number` = `income`.`Vehicle` WHERE `income`.`Status`='0' AND `vehicles`.`Trip`='1' ORDER BY `income`.`Date` DESC LIMIT 15) SUB ORDER BY `Date` ASC");
$fo=mysqli_num_rows($do);
					?>
					<div class="divFooter"><center><u><b>CUSTOMERS REPORT <?php echo"$mpri"; ?></b></u></center></div>
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
                        <th class="text-center" width="8%"> Date </th> 
                       <th class="text-center"> Vehicle </th> 
                        <th class="text-center"> Customer </th>
                        <th class="text-center" colspan='2'> Destination </th>
						 <th class="text-center"> Amount </th>
						 <th class="text-center"> Rate </th>
						 <th class="text-center"> Value&nbsp;(RWF) </th> 
                        <th class="text-center"> Paid </th>  
                        <th class="text-center"> Balance </th></tr></thead>
                                        <tbody>
					<?php
			$i=$t=1;					$tam=$tdi=$twe=$tva=$tpa=0;
	while($ro=mysqli_fetch_assoc($do)){
$code=$ro['Trip'];
$naso=$ro['Number'];
$emplo=$ro['Vehicle'];
$amo=$ro['Amount'];
$amoo=number_format($amo, 2);
$dte=$ro['Date'];
$vou=$ro['Voucher'];
$caso=$ro['Customer'];
$garag=$ro['District'];
$pur=$ro['Location'];
$rate=$ro['Rate'];
$val=$amo*$rate;
$count="TRANSPORT";
$pay=0;
						
	$seepai=mysqli_query($conn, "SELECT SUM(`Amount`*`Rate`) AS 'Pay' FROM `payment` WHERE `Invoice`='$naso' AND `Action`='$count' AND `Status`='0'");
		$reepai=mysqli_fetch_assoc($seepai);
		    $pay=$reepai['Pay'];
		    if($gara)
		        $pall="ALL";
		    
		$bal=$val-$pay;	 
		
		if($bal>10 AND $rate>1000){
                $val=$amo*$rase;
		        $bal=$val-$pay;	
		 $then=mysqli_query($conn, "UPDATE `income` SET `Rate`='$rase' WHERE `Number`='$naso' AND `Rate`>'1000' ORDER BY `Number` ASC LIMIT 1");
		            }


$twe+=$wei;	          $tva+=$val;
$tpa+=$pay;            
if($amo>'10000' AND $rate=='1')
$tam+=($amo/$rase);	
else
$tam+=$amo;	
					
	$payo=number_format($pay, 2);
	$valo=number_format($val, 2);
	$rato=number_format($rate, 2);
	$balo=number_format($bal, 2);
	
	$setri=mysqli_query($conn, "SELECT `Customer` FROM `account` WHERE `Number`='$caso'");
        $file=mysqli_fetch_assoc($setri);
            $cust=$file['Customer'];

$doi=mysqli_query($conn, "SELECT *FROM `vehicles` WHERE `Number`='$emplo' AND `Trip`='1'");
			$roi=mysqli_fetch_assoc($doi);
				$fna=$roi['Plate'];
				
	    if($pay)
	$lin="<a href='#' data-toggle='modal' data-target='#exampleModalx$i'>";
		else
	$lin="";
	
            $stn="style='padding:1px; font-size:13px;'";
           
	 print("<tr><td $stn class='text-center'>$i</td>
	 <td class='text-center' $stn> $dte </td><td $stn>&nbsp;$fna&nbsp;</td>
    <td $stn> $cust </td><td $stn> $garag </td><td $stn> $pur </td>
			<td class='text-right' $stn> $amoo&nbsp;</td>
			<td class='text-right' $stn> $rato&nbsp;</td>
    <td class='text-right' $stn> $valo&nbsp;</td><td class='text-right' $stn>");
	
	            $dst="TRANSPORT AMOUNT";
	
	// ************************************* Open payment modal ******************************************
		echo"<div class='modal fade' id='exampleModalx$i' tabindex='-1' role='dialog' aria-labelledby='exampleModalLabel' aria-hidden='true' style='top:220px;'>
  <div class='modal-dialog' role='document'>
    <div class='modal-content'>
      <div class='modal-header'>
        <h5 class='modal-title' id='exampleModalLabel'>PAYMENT REPORT 
&nbsp;&nbsp;&nbsp;&nbsp;<label class='pull-right'><b>$ $payo</b></label></h5>

      </div>
      <div class='modal-body' style='height:auto;'>
	  <table class='table table-striped table-hover '><thead><tr>
	  <th width='14%' class='text-center'> Date </th>
	  <th class='text-center'> User </th>
	  <th width='12%' class='text-center'> Mode </th>
	  <th class='text-center'> Reference </th>
	  <th class='text-center'> Rate </th>
	  <th class='text-center'> Amount </th>
	  </tr></thead></tbody>";
				$k=9000000000;				$sts="padding:1px; font-size:12px; background-color:transparent;";
$spai=mysqli_query($conn, "SELECT *FROM `payment` WHERE `Invoice`='$naso' AND `Action`='TRANSPORT' AND `Status`='0' ORDER BY `Number` ASC");
				while($rpai=mysqli_fetch_assoc($spai)){
					$prs=number_format($rpai['Amount'], 2);
					$mod=$rpai['Pline'];
					$cur=$rpai['Rate'];
					$rat=number_format($rpai['Rate'], 2);
					$refe=$rpai['Cheno'];
					$dti=$rpai['Date'];
					$num=$rpai['Number'];
					$user=$rpai['User'];

		echo"<tr style='background-color:transparent;'>
		<td class='text-center' style='$sts'> $dti </td>
		<td style='$sts'> $user </td><td style='$sts'> $mod </td>
<td style='$sts'> $refe </td><td style='$sts' class='text-center'> $cur </td>
		
		<td style='text-align:right; $sts'>
		<div title='Rate: $rat' data-toggle='tooltip' 
		data-placement='top'> $prs&nbsp;&nbsp;</div></td></tr>";
			$k++;
				}        

      echo"</tbody></table></div><div class='modal-header text-right' 
	  style='margin-top:-10px; height:40px; padding-top:10px; border:0px solid blue;'>
  <button type='button' class='btn btn-xs btn-warning' data-dismiss='modal'>&nbsp;&nbsp;&nbsp;CLOSE&nbsp;&nbsp;&nbsp;</button>
      </div>
    </div>
  </div>
</div>";
	// ****************************************** End of modal ****************************************	


print("$lin $payo </a></td><td $stn><div align='right'> $balo&nbsp;&nbsp;</td></tr>");
						$i++;							
						}
			
			$tba=$tva-$tpa;						
		$tam=number_format($tam, 2);				
		$tpa=number_format($tpa, 2);				
		$tba=number_format($tba, 2);				
		$tva=number_format($tva, 2);					

		?>
                    </tbody><thead> 
<tr><th> </th><th colspan='5' style='padding:2px'>&nbsp;&nbsp;Total Amount </th>
	<th class='text-right' style='padding:2px'><?php echo $tam ?></th><th> </th>
			<th class='text-right' style='padding:2px'><?php echo $tva ?></th>
			<th class='text-right' style='padding:2px'><?php echo $tpa ?></th>
<th class='text-right' style='padding:2px'><?php echo $tba ?>&nbsp;</th></tr>
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