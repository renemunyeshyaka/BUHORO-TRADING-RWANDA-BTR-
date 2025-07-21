<?php
if(basename($_SERVER['PHP_SELF']) == 'ductrepo.php') 
  $cm=" class='current'";
include'header.php';
include'connection.php';
$custo=$conde=$condi='';
$dato=$datos=$Date;
$p=0;

// search for report to be displayed
if(isset($_POST['search']))
		{
			$dato=$_POST['dato'];
			$datos=$_POST['datos'];
			$custo=$_POST['custo'];
			$p=1;
		}
		
    // take a balance from deductions
if(isset($_POST['take']))
		{
			$dato=$_POST['dato'];
			$datos=$_POST['datos'];
			$custo=$_POST['custo'];
			$code=$_POST['code'];
			$curr=$_POST['rate'];
			$amo=$_POST['amo'];
			$mi=$_POST['mi'];
			$p=$_POST['p'];
			$emplo="MILEAGE";
			$amo=$amo*$curr;
			$purpo=$_POST['purpo'];
	
	 $sup=mysqli_query($conn, "UPDATE `cutter` SET `Upda`='$mi' WHERE `Number`='$code' ORDER BY `Number` ASC LIMIT 1");
	 
	    if($mi=='1'){
	 $so=mysqli_query($conn, "INSERT INTO `stouse` (`Date`, `User`, `Item`, `Quantity`, `Price`, `Destin`, `Action`, `Voucher`, `Invoice`, `Rate`) VALUES ('$Date', '$loge', '0', '1', '$amo', '$purpo', 'CASHBOX', '$code', '$emplo', '1')");
	    }
	    elseif($mi=='0'){
	        $so=mysqli_query($conn, "DELETE FROM `stouse` WHERE `Status`='CASHBOX' AND `Voucher`='$code' AND `Invoice`='$emplo'");
	    }
		}
		
		  // Delete a given deeduction record
if(isset($_POST['delo']))
		{
			$dato=$_POST['dato'];
			$datos=$_POST['datos'];
			$custo=$_POST['custo'];
			$code=$_POST['code'];
	
	 $sup=mysqli_query($conn, "DELETE FROM `cutter` WHERE `Number`='$code' ORDER BY `Number` ASC LIMIT 1");
		}
	
	if($dato==$datos)
			$mpri="ON $dato";
		else
			$mpri="FROM $dato TO $datos";

			if($custo)
				$conde="AND `Driver`='$custo'";
				
	 $sup=mysqli_query($conn, "DELETE `cutter` WHERE `Amount`='0' ORDER BY `Number` ASC LIMIT 10");
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

    <li class="list-group-item active">
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
                       
            </ul><br><br>
  </div>
                    
           
           
    <form action="" method="post" class="form-horizontal "> 
        <div class="col-lg-10">
                  <div class="row">

				  <div class="col-lg-4"> </div>         

                         
                       <div class="col-lg-8 hidden-print"><div class="col-lg-3">
			<select class="form-control" name="custo" style="margin-left:-55px; width:220px;">
				<option value='' selected='selected'>Select a Driver</option>
			 <?php
			$doi=mysqli_query($conn, "SELECT `trips`.`Driver` FROM `trips` INNER JOIN `cutter` ON `trips`.`Number` = `cutter`.`Trip` WHERE `cutter`.`Status`='0' AND `trips`.`Driver`!='' GROUP BY `trips`.`Driver` ORDER BY `trips`.`Driver` ASC");
			while($roi=mysqli_fetch_assoc($doi)){
				$drive=$roi['Driver'];
				if($drive==$custo)
					$sle="selected='selected'";
				else
					$sle='';
			echo"<option value='$drive' $sle> $drive </option>";
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
$do=mysqli_query($conn, "SELECT *FROM `cutter` WHERE `Status`='0' AND `Date` BETWEEN '$dato' AND '$datos' $conde ORDER BY `Number` ASC");
	else
$do=mysqli_query($conn, "SELECT *FROM (SELECT *FROM `cutter` WHERE `Status`='0' ORDER BY `Date` DESC LIMIT 15) SUB ORDER BY `Date` ASC");
if($fo=mysqli_num_rows($do)){
					?>
					<div class="divFooter"><center><u><b>DEDUCTION REPORT <?php echo"$mpri"; ?></b></u></center></div>
		 <div class="row">
            <div class="col-lg-12">
             <span> &nbsp;&nbsp; Total Records Found : <b><?php echo" $fo " ?></b></span>
			 <span class="pull-right">
			     &nbsp;&nbsp;<a href="#" onclick="return window.print()" class="hidden-print" title='Click to print' data-toggle='tooltip' data-placement='top'><i class="lnr lnr-printer"></i></a></span>
			     
			     <span class="pull-right hidden-print">
		&nbsp;&nbsp;&nbsp;&nbsp;<a href="#" id="exporttable" class="hidden-print" title='Export to excell' data-toggle='tooltip' data-placement='top'><i class="lnr lnr-line-spacing"></i></a></span>
            <div class="widget-container fluid-height clearfix">
            <div class="widget-content padded clearfix">

			   <table class="table table-striped table-hover" id="htmltable">     
                                      <thead>
                    <tr role="row">
                     <th> No </th>
                        <th> Due&nbsp;Date </th>
                       <th> Vehicle&nbsp;ID</th>  
                       <th> Employee`s&nbsp;Name</th>
                        <th width='30%'> Purpose/Issue </th>
			<th class="text-right"> Amount&nbsp;&nbsp;&nbsp;&nbsp;</th>
			<th class="text-right"> Paid&nbsp;&nbsp;&nbsp;&nbsp;</th>
			<th class="text-right"> Balance&nbsp;&nbsp;&nbsp;&nbsp;</th>
			    <th colspan='2' width='1%'> Options </th>
                     </tr>
                    </thead>
                                        <tbody>
					<?php
					$n=1;					$to=$tp=$tb=0;
						while($ro=mysqli_fetch_assoc($do)){
$code=$ro['Number'];
$emplo=$ro['Driver'];
$amo=$ro['Amount'];
$purpo=$ro['Descri'];
$dte=$ro['Date'];
$trip=$ro['Trip'];
$upda=$ro['Upda'];

$sepa=mysqli_query($conn, "SELECT `Plate` FROM `trips` WHERE `Number`='$trip'");
$repa=mysqli_fetch_assoc($sepa);
$pla=$repa['Plate'];

if($upda=='1'){
$stn="style='padding:1px;'";
$lnr="warning";
$clr="";
$mi=0;
$pa=$amo;
$act="circle-minus";
}
else{
$stn="style='padding:1px; color:blue;'";
$clr="color:blue;";
$lnr="info";
$pa=0;
$mi=1;
$act="checkmark-circle";
}

$bal=$amo-$pa;
	$amoo=number_format($amo);
	$balo=number_format($bal);
	$pao=number_format($pa);
	$rateo=number_format($ro['Rate']);
	
if($_SESSION['Cancel'] OR $_SESSION['Eccr'] OR $_SESSION['Ctr']){
$tags="#ModalDele$n";
$disa="";
}
else{
    $tags="#";
    $disa="disabled";
}
           
print("<tr title='Rate: $rateo' data-toggle='tooltip' data-placement='top'>
<td $stn class='text-right'>$n&nbsp;&nbsp;&nbsp;&nbsp;</td><td $stn> $dte </td>
        <td $stn> $pla </td><td $stn> $emplo </td><td $stn> $purpo </td>
	<td class='text-right' style='padding:0px 10px 0px 0px; $clr'> $amoo </td>
	<td class='text-right' style='padding:0px 10px 0px 0px; $clr'> $pao </td>
	<td class='text-right' style='padding:0px 10px 0px 0px; $clr'> $balo </td>");
	
	// ************************************* Delete modal ******************************************
		echo"<div class='modal fade' id='ModalDele$n' tabindex='-1' role='dialog' 
		aria-labelledby='exampleModalLabel' aria-hidden='true' style='top:220px;'>
  <div class='modal-dialog' role='document'>
    <div class='modal-content text-left'><div class='modal-header text-left'>
        <h5 class='modal-title' id='exampleModalLabel'>DELETE CONFIRMATION 
&nbsp;&nbsp;&nbsp;&nbsp;<label class='pull-right'><b>$emplo</b></label></h5>

      </div><form action='' method='post'>
      <div class='modal-body' style='height:80px;'>
        <h5>Are sure you want to delete this record? &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		[ USD <b>$amoo</b> ]</h5><br></div><form method='post' action=''>
			<input type='hidden' name='code' value='$code'>	
			<input type='hidden' name='dato' value='$dato'>				
	<input type='hidden' name='datos' value='$datos'>				
	<input type='hidden' name='amo' value='$amo'>						
	<input type='hidden' name='mi' value='$mi'>				
	<input type='hidden' name='rate' value='$rate'>			
	<input type='hidden' name='purpo' value='$purpo'>			
	<input type='hidden' name='p' value='$p'>
      <div class='modal-header text-right' style='margin-top:-10px; height:50px; padding-top:10px; border:0px solid blue;'>
        <button type='button' class='btn btn-sm btn-success' data-dismiss='modal'>&nbsp;&nbsp;NO&nbsp;</button>
        <button type='submit' name='delo' class='btn btn-sm btn-danger'>YES</button>
      </div></form>
    </div>
  </div>
</div>";
	
	echo("<form action='' method='post'><td style='padding:0px; width:20px; text-align:right;'>					<input type='hidden' name='code' value='$code'>				<input type='hidden' name='dato' value='$dato'>				
	<input type='hidden' name='datos' value='$datos'>				
	<input type='hidden' name='amo' value='$amo'>						
	<input type='hidden' name='mi' value='$mi'>				
	<input type='hidden' name='rate' value='$rate'>			
	<input type='hidden' name='purpo' value='$purpo'>			
	<input type='hidden' name='p' value='$p'>
	<button type='submit' class='btn btn-xs btn-$lnr hidden-print' style='height:18px; width:25px; padding:0px; margin:0px; margin-right:2px;' name='take'> &nbsp;<i class='lnr lnr-$act'></i>&nbsp; </button></td>
	<td style='padding:0px; width:20px; text-align:right;'>
	<button type='button' class='btn btn-xs btn-danger hidden-print' style='height:18px; width:25px; padding:0px; margin:0px; margin-right:2px;'  data-toggle='modal' data-target='$tags' $disa> &nbsp;<i class='lnr lnr-trash'></i>&nbsp; </button>	
	</form></td></tr>");
		$n++;				$to+=$amo;            $tp+=$pa;          $tb+=$bal;
						}
	$to=number_format($to);
	$tp=number_format($tp);
	$tb=number_format($tb);
						?>
						
                    </tbody>
	<tr><th> <th><th colspan='3'>&nbsp;&nbsp;&nbsp;&nbsp;Total Amount </th>
<th class="text-right" style='padding:0px 10px 0px 0px;'><?php echo $to ?></th>
<th class="text-right" style='padding:0px 10px 0px 0px;'><?php echo $tp ?></th>
<th class="text-right" style='padding:0px 10px 0px 0px;'><?php echo $tb ?></th>
		<th> -- </th></th></tr>
                  </table>
                                      
                
              </div>
            </div></div>
                  </div>                  
                <span class="pull-right hidden-print">
			 &nbsp;&nbsp;<a href="#" onclick="return window.print()" class="hidden-print" title='Click to print' data-toggle='tooltip' data-placement='top'><i class="lnr lnr-printer"></i></a></span>
			 
      
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
   </div></div></div>  
   <?php
   include'footer.php';
   ?>