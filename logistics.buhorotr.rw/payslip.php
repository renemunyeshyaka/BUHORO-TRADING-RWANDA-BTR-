<?php
if(basename($_SERVER['PHP_SELF']) == 'payslip.php') 
  $nv=" class='current'";
$custo=$conde='';
include'connection.php';
$dato=$datos=$Date;
$p=0;

// Open a single record
if(isset($_POST['slip']))
		{
			$dato=$_POST['dato'];
			$datos=$_POST['datos'];
			$nuo=$_POST['nuo'];
			$p=$_POST['p'];
			$cut=$_POST['cut'];
			$custo=$_POST['custo'];
			$trip=$_POST['trip'];
			$deso=$_POST['deso'];
			$dte=$_POST['dte'];
			$typ=$_POST['typ'];
			$rate=$_POST['rate'];
			$des=$_POST['descu'];

include'slip.php';
		}

include'header.php';



if(isset($_POST['adco']))
		{
			$custo=$_POST['custo'];
			$dato=$_POST['dato'];
			$datos=$_POST['datos'];
			$trip=$_POST['trip'];
			$acut=str_replace(',', '', $_POST['acut']);
			$dcut=$_POST['dcut'];
			$trip=$_POST['trip'];
			$rate=$_POST['rate'];
			$dte=$_POST['dte'];
			$descri=str_replace("'", "`", $_POST['descri']);
			$p=$_POST['p'];
			$dedo=$_POST['dedo'];
	$do=mysqli_query($conn, "INSERT INTO `cutter` (`Date`, `User`, `Amount`, `Descri`, `Trip`, `Rate`, `Mdate`, `Deduct`) VALUES ('$dcut', '$loge', '$acut', '$descri', '$trip', '$rate', '$dte', '$dedo')");
		}

if(isset($_POST['back']))
		{
			$custo=$_POST['custo'];
			$dato=$_POST['dato'];
			$datos=$_POST['datos'];
			$p=$_POST['p'];
		}

if(isset($_POST['search']))
		{
			$custo=$_POST['custo'];
			$dato=$_POST['dato'];
			$datos=$_POST['datos'];
				$p=1;
		}

if($p==1){
    if($custo AND $dato==$Date AND $datos==$Date)
        $conde="AND `Plate` LIKE '%$custo%'";
        
    if($custo AND ($dato!=$Date OR $datos!=$Date))
        $conde="AND `Plate` LIKE '%$custo%' AND `Date` BETWEEN '$dato' AND '$datos'";
     
     if(!$custo) 
        $conde="AND `Date` BETWEEN '$dato' AND '$datos'";
        
}
	

        if($dato==$datos)
			$mpri="ON $dato";
		else
			$mpri="FROM $dato TO $datos";
?>

<div class="container-fluid main-content">
        <div class="page-title hidden-print">
          <h2 style='margin-top:-20px; margin-bottom: 5px; color:#ffcc33'>
        Operations
          </h2>
                 </div>
     
         <div class="row">
  <div class="col-lg-2 hidden-print">
   
   <ul class="list-group">
                  
			  <li class="list-group-item">
              <a href="ment.php">
                <p>
                <i class="lnr lnr-plus-circle"></i>&nbsp;Repair & Services
                </p>
              </a></li>

    <li class="list-group-item">
	  <a href="mainsto.php">
                <p>
                <i class="lnr lnr-menu-circle"></i>&nbsp;List of Vehicles
                </p>
              </a></li> 

	   <li class="list-group-item">
              <a href="crete.php">
                <p>
                <i class="lnr lnr-plus-circle"></i>&nbsp;Create a Vehicle
                </p>
              </a></li>  

	   <li class="list-group-item">
              <a href="tools.php">
                <p>
                <i class="lnr lnr-book"></i>&nbsp;Tools & Materials
                </p>
              </a></li>    

	   <li class="list-group-item">
              <a href="notes.php">
                <p>
                <i class="lnr lnr-plus-circle"></i>&nbsp;Notifications
                </p>
              </a></li> 
                       
            </ul><br><br>

			<li class="list-group-item" style="border:1px dashed #cccccc; border-radius:5px; margin:0px 0px 4px 0px;">
	  <a href="createa.php">
                <p>
                <i class="lnr lnr-plus-circle"></i>&nbsp;Create Customers
                </p>
              </a></li>	
              
            <li class="list-group-item" style="border:1px dashed #cccccc; border-radius:5px; margin:0px 0px 4px 0px;">
	  <a href="dispatch.php">
                <p>
                <i class="lnr lnr-plus-circle"></i>&nbsp;Create Vehicle Trip
                </p>
              </a></li>	
        
                <?php
              if($_SESSION['Cpo']){
                  ?>
			  <li class="list-group-item" style="border:1px dashed #cccccc; border-radius:5px; margin:0px 0px 4px 0px;">
              <a href="purcha.php">
                <p>
                <i class="lnr lnr-plus-circle"></i>&nbsp;Purchase Orders
                </p>
              </a></li>
              <?php
              }
              if($_SESSION['Cpi']){
                  ?>
            <li class="list-group-item" style="border:1px dashed #cccccc; border-radius:5px; margin:0px 0px 4px 0px;">
	  <a href="profo.php">
                <p>
                <i class="lnr lnr-plus-circle"></i>&nbsp;Create Proforma
                </p>
              </a></li>	
              <?php
              }
              ?>
              
            <li class="list-group-item active" style="border:1px dashed #cccccc; border-radius:5px; margin:0px 0px 4px 0px;">
	  <a href="payslip.php">
                <p>
                <i class="lnr lnr-plus-circle"></i>&nbsp;Payment Vouchers
                </p>
              </a></li>	
              
            <li class="list-group-item" style="border:1px dashed #cccccc; border-radius:5px; margin:0px 0px 4px 0px;">
	  <a href="conterepo.php">
                <p>
                <i class="lnr lnr-plus-circle"></i>&nbsp;Container Dispatch
                </p>
              </a></li>	
  </div>
       
        <div class="col-lg-10">
                  <div class="row"><form action='' method='post'>
	<div class="col-lg-4 hidden-print" style="padding-left:50px; padding-right:50px;"> </div>
           

        <form action="" method="post" class="form-horizontal ">                 
                       <div class="col-lg-8 hidden-print" style="padding-right:50px;"> <div class="col-lg-4"> 	
      <select class="form-control" name="custo">
				<option value='' selected='selected'>Select Vehicle</option>
			 <?php
			$doi=mysqli_query($conn, "SELECT `vehicles`.`Plate`, `repair`.`Vehicle` FROM `repair` INNER JOIN `vehicles` ON `vehicles`.`Number` = `repair`.`Vehicle` GROUP BY `repair`.`Vehicle` ORDER BY `repair`.`Vehicle` ASC");
			while($roi=mysqli_fetch_assoc($doi)){
				$code=$roi['Vehicle'];
				$fna=$roi['Plate'];
				if($fna==$custo)
					$sle="selected='selected'";
				else
					$sle='';
			echo"<option value='$fna' $sle> $fna </option>";
			}
			?>    
                            </select>
	              </div> 
             <div class="col-lg-3"> 
           <div class="input-group date" data-provide="datepicker">
      <input class="form-control form-center" id="from" name="dato" type="text" value="<?php echo $dato ?>" onkeypress='return isNumberKey(event)' required>
	  <span class="input-group-addon"><i class="lnr lnr-calendar-full"></i></span>
			</div></div>


		  <div class="col-lg-3"> 
           <div class="input-group date" data-provide="datepicker">	
      <input class="form-control form-center" id="to" name="datos" type="text" value="<?php echo $datos ?>" onkeypress='return isNumberKey(event)' required>
	  <span class="input-group-addon"><i class="lnr lnr-calendar-full"></i></span>
              </div></div>                     
                       
                       <div class="col-lg-2"><?php echo"<input type='hidden' name='pg' value='$pg'>"; ?>
                        <button class="btn  btn-primary btn-block" type="submit" name="search"><i class="lnr lnr-magnifier"></i> Search</button>
                   
					  </div>
                         </div></form>               
            </div>
               <?php
               if($p)
		$do=mysqli_query($conn, "SELECT *FROM `repair` WHERE (`Trip`!='0' AND `Status`='0' AND `Garage`='ROAD TOLL' $conde) OR (`Trip`!='0' AND `Status`='0' AND `Garage`='MILEAGE' $conde) OR (`Trip`!='0' AND `Status`='0' AND `Garage`='OTHER EXPENSE' $conde) OR (`Trip`!='0' AND `Status`='0' AND `Garage`='GPS SERVICES' $conde) OR (`Trip`!='0' AND `Status`='0' AND `Garage`='BOND' $conde) GROUP BY `Number` ORDER BY `Date` ASC");
		        else
		$do=mysqli_query($conn, "SELECT *FROM `repair` WHERE (`Trip`!='0' AND `Status`='0' AND `Garage`='ROAD TOLL') OR (`Trip`!='0' AND `Status`='0' AND `Garage`='MILEAGE') OR (`Trip`!='0' AND `Status`='0' AND `Garage`='OTHER EXPENSE' $conde) OR (`Trip`!='0' AND `Status`='0' AND `Garage`='GPS SERVICES' $conde) OR (`Trip`!='0' AND `Status`='0' AND `Garage`='BOND' $conde) GROUP BY `Number` ORDER BY `Number` DESC LIMIT 15");
				if($fo=mysqli_num_rows($do)){
				?>
                 
            <div class="divFooter"><center><u><b>RECEIPTS REPORT <?php echo $mpri ?></b></u></center></div>
             <div class="row">
            <div class="col-lg-12">
             <span> &nbsp;&nbsp; Total Records Found : <b><?php echo" $fo " ?></b></span>
			 <span class="pull-right hidden-print">&nbsp;&nbsp;
			 <a href="#" onclick="return window.print()" class="hidden-print" title='Click to print' data-toggle='tooltip' data-placement='top'>
			 <i class="lnr lnr-printer"></i></a></span>
            <div class="widget-container fluid-height clearfix">
            <div class="widget-content padded clearfix">

				<table class="table table-striped table-hover">     
                                      <thead>
                    <tr role="row">
                     <th width="1%" style='padding:1px; text-align:center'> No </th>
					 <th width='8%'><div align='center'> Date </th>
		<th style='padding:1px;'><div align='center'> Driver </th>
		<th style='padding:1px;'><div align='center'> Plate </th>
			<th style='padding:1px;'><div align='center'> Destination </th>
<th style='padding:1px;'><div align='center'> Road&nbsp;Toll </th>
			<th style='padding:1px;'><div align='center'> Mileage </th>
			<th style='padding:1px;'><div align='center'> Other </th>
			<th style='padding:1px;'><div align='center'> Rate </th>
			<th style='padding:1px;'><div align='center'> Value </th>
			<th style='padding:1px;'><div align='center'> Deduct </th>
			<th style='padding:1px;'><div align='center'> Paid </th>
		<th colspan='2' class="hidden-print" style='padding:1px; width:40px;'>
		    <div align='center'>&nbsp;#&nbsp;</th>
                     </tr>
                    </thead>
                                        <tbody>
					<?php
			$i=1;		            	$tra=$tmi=$tpa=$toth=$rt=$tsa=$tcu=0;
	while($ro=mysqli_fetch_assoc($do)){
				$nuo=$ro['Number'];
				$trip=$ro['Trip'];
				$dte=$ro['Date'];
				$pla=$ro['Plate'];
				$typ=$ro['Type'];
				$gars=$ro['Garage'];
				$vehs=$ro['Vehicle'];

                // *********************** Trip record **********************
		$dois=mysqli_query($conn, "SELECT *FROM `trips` WHERE `Number`='$trip' ORDER BY `Number` ASC");
			$rois=mysqli_fetch_assoc($dois);
				$etd=$rois['ETD'];
				$des=$rois['Location'];
				$dri=$rois['Driver'];
				$fni=$rois['Final'];
				    $roa=$mil=$pay=$othe=$pa=$cut=0;
				
		        // ******************* Road Toll & Mileage ******************
		$dois=mysqli_query($conn, "SELECT `Amount`, `Garage`, `Driver`, `Rate` FROM `repair` WHERE `Number`='$nuo' AND `Status`='0' AND `Trip`='$trip' AND `Type`='$typ' AND `Date`='$dte' AND (`Garage`='ROAD TOLL' OR `Garage`='MILEAGE' OR `Garage`='OTHER EXPENSE' OR `Garage`='GPS SERVICES' OR `Garage`='BOND') ORDER BY `Number` ASC");
			    while($rois=mysqli_fetch_assoc($dois)){
			        $rate=$rois['Rate'];
				    if($rois['Garage']=='ROAD TOLL')
				$roa+=$rois['Amount'];
				    elseif($rois['Garage']=='MILEAGE')
				$mil+=$rois['Amount'];
				    else
				$othe+=$rois['Amount'];
				
				if(!$dri)
				    $dri=$rois['Driver'];
			    }
			    
			    $deso="$des - $fni";
			    
			    	// ****************** Paid Amount **********************          
			 $_SESSION['Base']="jblgroup_sales";
			        include'sales.php';
	
	$pch=mysqli_query($cons, "SELECT SUM(`Amount`) AS `Paid` FROM `mileage` WHERE `Trip`='$trip' AND `Status`='0' AND `Amount`>'0' ORDER BY `Number` ASC");
	                if($fch=mysqli_num_rows($pch)){
	                    $rch=mysqli_fetch_assoc($pch);
	                        $pa=$rch['Paid'];
	 $sup=mysqli_query($conn, "UPDATE `cutter` SET `Driver`='$dri' WHERE `Trip`='$trip' AND `Driver`!='$dri' AND `Mdate`='$dte' ORDER BY `Number` ASC");
	                            }
	                            
	        /*
	$then=mysqli_query($conn, "SELECT `Number` FROM `repair` WHERE `Number`<'$nuo' AND `Trip`='$trip' AND `Vehicle`='$vehs' AND `Amount`>'100000' AND `Type`='0' AND `Garage`='$gars' ORDER BY `Number` ASC LIMIT 2");
	if($fen=mysqli_num_rows($then)){
	    $cut=0;
	}
	else{
	*/
	          if($gars=='MILEAGE'){                 
	   // *********************** Load deduction *******************
	   	$doil=mysqli_query($conn, "SELECT `Descri`, SUM(`Amount`) AS 'Cut' FROM `cutter` WHERE `Trip`='$trip' ORDER BY `Number` ASC");
			$roil=mysqli_fetch_assoc($doil);
				$cut=$roil['Cut'];
				$descu=$roil['Descri'];
				
		//		if($rate=='1')
			//	    $pa=$cut=0;
			
			    if($mil=='0' OR $mil<='200000')
			        $cut=0;
	}
			    
						$roao=number_format($roa, 2);
						$milo=number_format($mil, 2);
						$rateo=number_format($rate);
						$otheo=number_format($othe, 2);
						$to=($roa+$mil+$othe)/$rate;
						$cuto=number_format($cut, 2);
						$pao=number_format($pa, 2);
						$too=number_format($to, 2);
						
			if($typ==1)
					$stl="padding:1px; font-size:13px; color:blue;";
			else
					$stl="padding:1px; font-size:13px;";
					
					if($rate=='1')
				$too=$to=0;
				
		if($pa OR $typ==1)
	$mode="disabled readonly";
		else
	$mode="data-placement='top' data-toggle='modal' data-target='#modalcut$i'";


	print("<tr><td class='text-right' style='$stl $clr'>
	
	<div class='modal fade' id='modalcut$i' tabindex='-1' role='dialog' aria-labelledby='exampleModalLabel' aria-hidden='true' style='top:120px;'>
  <div class='modal-dialog' role='document'>
    <div class='modal-content text-left'>
      <div class='modal-header'>
        <h5 class='modal-title' id='exampleModalLabel'>ADD DEDUCTION PAYMENT 
        <label class='pull-right text-right'><b> $dri </b></label></h5>

      </div><form method='post' action=''>
      <div class='modal-body' style='height:170px; text-align:center;'>
        <center><table width='90%' style='background-color:#f9f9f9; border:0px; border-radius:5px;'><tr>
        <td style='background-color:#f9f9f9; border:0px;' valign='top'>
         &nbsp;&nbsp;&nbsp;&nbsp; Amount <br><div class='input-group'>
    <input name='acut' class='form-control' type='text' style='text-align:center; padding-right:2px;' onkeyup='format(this);' onkeypress='return isNumberKey(event)' required><span class='input-group-addon text-info'>RWF</span>
            </div>
        </td><td rowspan='2' width='70%' style='background-color:#f9f9f9; border:0px; padding-left:30px;' valign='top'>&nbsp;&nbsp;&nbsp;&nbsp; Description <br>
<textarea class='form-control' name='descri' style='height:40px; font-size:14px;'></textarea><br><select class='form-control' name='dedo' required>
		<option value='' selected='selected'>Select Deduction</option>");
			 
$doi=mysqli_query($conn, "SELECT `Number`, `Amount`, `Purpose`, `Pdate` FROM `deduct` WHERE `Status`='2' AND `Driver`='$dri' ORDER BY `Number` DESC LIMIT 10");
                $col=$cutt=$cpa=0;
			while($roi=mysqli_fetch_assoc($doi)){
				$code=$roi['Number'];
			
	$cuts=mysqli_query($conn, "SELECT SUM(`Amount`) AS `Pay` FROM `cutter` WHERE `Deduct`='$code' AND `Driver`='$dri' AND `Status`='0'");
	        if($futs=mysqli_num_rows($cuts)){
            $ruts=mysqli_fetch_assoc($cuts);
                $amo=$roi['Amount']-$ruts['Pay'];
                $cpa+=$ruts['Pay'];
	            }
	        else
                $amo=$roi['Amount'];
				$amoo=number_format($amo);
				$pupo=$roi['Purpose'];
				$pdat=$roi['Pdate'];
			if($amo>='0'){
			    $cutt+=$amo;
	echo"<option value='$code'> $amoo &nbsp; $pupo &nbsp; [$pdat] </option>";
	            $col++;
			}
			}
		    
		        if($col AND $cutt>$cpa)
		    $stl="padding:1px; font-size:13px; color:#ff99cc;";
		    
                        print("</select></td></tr>
        <tr><td style='background-color:#f9f9f9; border:0px;'><div class='input-group date' data-provide='datepicker'><input class='form-control form-center' name='dcut' type='text' value='$Date' onkeypress='return isNumberKey(event)' style='padding-left:2px; padding-right:2px;' required><div class='input-group-addon'><span class='lnr lnr-calendar-full'></span></div></td></tr>
        </table></center>
      </div>
      <div class='modal-footer' style='margin-top:-10px; height:50px; padding-top:5px; border:0px solid blue;'>
        	<input type='hidden' name='trip' value='$trip'> 
	        <input type='hidden' name='rate' value='$rate'> 
	        <input type='hidden' name='dte' value='$dte'> 
    <button type='button' class='btn btn-sm btn-warning' data-dismiss='modal' style='width:110px'>CANCEL</button>
    <button type='submit' name='adco' class='btn btn-sm btn-success' style='width:110px'>SAVE</button>
      </div></form>
    </div>
  </div>
</div>

             &nbsp;$i&nbsp;</td>
	<td style='$stl $clr'><div align='center'> $dte </td>
	<td style='$stl $clr'> $dri </td><td style='$stl $clr'> $pla </td>
	<td style='$stl $clr'> $deso </td>
	<td style='$stl $clr'><div align='right'> $roao </td>
	<td style='$stl $clr'><div align='right'> $milo </td>
	<td style='$stl $clr'><div align='right'> $otheo </td>
	<td style='$stl $clr'><div align='right'> $rateo </td>
	<td style='$stl $clr'><div align='right'> $too </td>
	<td style='$stl $clr'><div align='right'> $cuto </td>
	<td style='$stl $clr'><div align='right'> $pao </td>
	
	<td class='hidden-xs hidden-print' align='right' style='padding:0px;'>
	<button type='submit' class='btn btn-xs btn-warning hidden-print' style='height:18px; padding:0px; margin:2px; width:25px;' $mode>
	&nbsp;&nbsp;<i class='lnr lnr-circle-minus'></i>&nbsp;&nbsp;</button></td>");


	print("<form action='' method='post'>
	<td class='hidden-print' style='padding:0px;'><div title='Open' data-toggle='tooltip' data-placement='top'> 
	<input type='hidden' name='nuo' value='$nuo'> 
	<input type='hidden' name='dato' value='$dato'> 
	<input type='hidden' name='datos' value='$datos'> 
	<input type='hidden' name='custo' value='$custo'>  
	<input type='hidden' name='trip' value='$trip'>   
	<input type='hidden' name='deso' value='$deso'> 
	<input type='hidden' name='dte' value='$dte'>
	<input type='hidden' name='p' value='$p'>
	<input type='hidden' name='cut' value='$cut'>
	<input type='hidden' name='descu' value='$descu'>
	<input type='hidden' name='typ' value='$typ'> 
	<input type='hidden' name='rate' value='$rate'>
	<div align='right'>");
	
	if(!$_SESSION['Egsr'])	
	echo"<button type='submit' class='btn btn-xs btn-success hidden-print' style='height:18px; width:25px; padding:0px; margin:0px; margin-right:2px;' name='slip'> &nbsp;<i class='lnr lnr-download'></i>&nbsp; </button>";
	
	echo"</td></form></tr>";
	$i++;			$tra+=$roa;         $tmi+=$mil;                $tpa+=$pay;
	$toth+=$othe;                       $rt+=$to;                   $tsa+=$pa;
	$tcu+=$cut;
						}
			
			$tba=number_format($rt, 2);
			$tra=number_format($tra, 2);
			$tmi=number_format($tmi, 2);
			$tpa=number_format($tpa, 2);
			$toth=number_format($toth, 2);
			$tsa=number_format($tsa, 2);
			$tcu=number_format($tcu, 2);
						?>
						
                    </tbody><thead>
	<tr><th> </th><th colspan='4'><div align='center'> Total Amount </th>
                <th style="padding-right:1px;"><div align='right'><?php echo $tra ?></th>
                <th style="padding-right:1px;"><div align='right'><?php echo $tmi ?></th>
                <th style="padding-right:1px;"><div align='right'><?php echo $toth ?></th>
                <th style="padding-right:1px;"><div align='center'> -- </th>
                <th style="padding-right:1px;"><div align='right'><?php echo $tba ?></th>
                <th style="padding-right:1px;"><div align='right'><?php echo $tcu ?></th>
                <th style="padding-right:1px;"><div align='right'><?php echo $tsa ?></th>
	<th class='hidden-print' colspan='2'><div align='center'> -- </th></tr>
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