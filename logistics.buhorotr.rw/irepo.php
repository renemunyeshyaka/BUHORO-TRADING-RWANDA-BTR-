<?php
if(basename($_SERVER['PHP_SELF']) == 'irepo.php') 
  $cm=" class='current'";
include'header.php';
include'connection.php';
$custo=$conde=$condi=$cond='';
$dato=$datos=$Date;
$gara='';
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

	if(isset($_POST['delete_id']))
		{
			$rowid=$_POST['rowid'];
			$then=mysqli_query($conn, "DELETE FROM `income` WHERE `Number`='$rowid' LIMIT 1");
			$p=$_POST['p'];
			$dato=$_POST['dato'];
			$datos=$_POST['datos'];
			$custo=$_POST['custo'];
			$gara=$_POST['gara'];
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
         Vehicles Report
          </h3>
                 </div>
     
        <div class="row">
  <div class="col-lg-2 hidden-print">
   
  <ul class="list-group">   

    <li class="list-group-item">
	  <a href="verepo.php">
                <p>
                <i class="lnr lnr-menu-circle"></i>&nbsp;Vehicles Report
                </p>
              </a></li> 

    <li class="list-group-item">
	  <a href="ferepo.php">
                <p>
                <i class="lnr lnr-menu-circle"></i>&nbsp;Consumption Report
                </p>
              </a></li> 

    <li class="list-group-item">
	  <a href="rerepo.php">
                <p>
                <i class="lnr lnr-menu-circle"></i>&nbsp;Repair/Service Report
                </p>
              </a></li>   

    <li class="list-group-item">
	  <a href="insurepo.php">
                <p>
                <i class="lnr lnr-menu-circle"></i>&nbsp;Insurance Report
                </p>
              </a></li>  

    <li class="list-group-item">
	  <a href="insprepo.php">
                <p>
                <i class="lnr lnr-menu-circle"></i>&nbsp;Inspection Report
                </p>
              </a></li>   

    <li class="list-group-item active">
	  <a href="irepo.php">
                <p>
                <i class="lnr lnr-menu-circle"></i>&nbsp;Income Report
                </p>
              </a></li> 

    <li class="list-group-item">
	  <a href="perepo.php">
                <p>
                <i class="lnr lnr-menu-circle"></i>&nbsp;Permit Report
                </p>
              </a></li>  

    <li class="list-group-item">
	  <a href="mrepo.php">
                <p>
                <i class="lnr lnr-menu-circle"></i>&nbsp;Monthly Report
                </p>
              </a></li>  

    <li class="list-group-item">
	  <a href="drepo.php">
                <p>
                <i class="lnr lnr-menu-circle"></i>&nbsp;Daily Report
                </p>
              </a></li>

    <li class="list-group-item">
	  <a href="vrepo.php">
                <p>
                <i class="lnr lnr-menu-circle"></i>&nbsp;System  Report
                </p>
              </a></li>     

    <li class="list-group-item">
	  <a href="anrepo.php">
                <p>
                <i class="lnr lnr-menu-circle"></i>&nbsp;Analysis  Report
                </p>
              </a></li>  
                         
            </ul>
  </div>
                    
           
           
    <form action="" method="post" class="form-horizontal "> 
        <div class="col-lg-10">
                  <div class="row">

				  <div class="col-lg-2"> </div>         

                     <div class="col-lg-2 hidden-print"><select class="form-control" name="gara">
				<option value='' selected='selected'>Select Customer</option>
			 <?php
	$dois=mysqli_query($conn, "SELECT `account`.`Customer`, `account`.`Number` FROM `account` INNER JOIN `income` ON `account`.`Number` = `income`.`Customer` WHERE `income`.`Status`='0' GROUP BY `account`.`Customer` ORDER BY `account`.`Customer` ASC");
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
					<div class="divFooter"><center><u><b>INCOME REPORT <?php echo"$mpri"; ?></b></u></center></div>
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
                        <th class="text-center"> Driver </th>
                        <th class="text-center" colspan='2'> Destination </th>
						 <th class="text-center"> Customer </th> 
                        <th class="text-center"> Weight </th>  
                        <th class="text-center"> Distance </th>
						 <th class="text-center"> Amount </th>
						 <th class="text-center"> Rate </th>
						 <th class="text-center"> Value&nbsp;(RWF) </th>
						 <th class="hidden-print text-center" width="1%"> # </th></tr></thead>
                                        <tbody>
					<?php
			$n=$t=1;					$tam=$tdi=$twe=$tva=0;
	while($ro=mysqli_fetch_assoc($do)){
$code=$ro['Number'];
$emplo=$ro['Vehicle'];
$amo=$ro['Amount'];
$amoo=number_format($amo, 2);
$wei=$ro['Weight'];
$dte=$ro['Date'];
$vou=$ro['Voucher'];
$descri=$ro['Customer'];
$garag=$ro['District'];
$driv=$ro['Driver'];
$pur=$ro['Location'];
$dista=$ro['Distance'];
$rate=$ro['Rate'];
$val=$amo*$rate;
			$tdi+=$dista;	     	$twe+=$wei;	          $tva+=$val;

           
if($amo>'10000' AND $rate=='1')
$tam+=($amo/$rase);	
else
$tam+=$amo;	

	$disto=number_format($dista, 2);					
	$weo=number_format($wei, 2);
	$valo=number_format($val, 2);
	$rato=number_format($rate, 2);
	
	$setri=mysqli_query($conn, "SELECT `Customer` FROM `account` WHERE `Number`='$descri'");
    $file=mysqli_fetch_assoc($setri);
    $descri=$file['Customer'];

$doi=mysqli_query($conn, "SELECT *FROM `vehicles` WHERE `Number`='$emplo' AND `Trip`='1'");
			$roi=mysqli_fetch_assoc($doi);
				$fna=$roi['Plate'];
	
	$seco=mysqli_query($conn, "SELECT *FROM `trip_note` WHERE `Trip`='".$ro['Trip']."'");
        if($feco=mysqli_num_rows($seco)){
            $stn="style='padding:1px; font-size:12px; color:#C27935;'";
            $clr="color:#C27935;";
        }
        else{
            $stn="style='padding:1px; font-size:12px;'";
            $clr="";
        }
           
	        print("<tr><td $stn class='text-center'>$n</td><td class='text-center' $stn> $dte </td><td $stn>&nbsp;$fna&nbsp;</td>
            <td $stn> $driv </td><td $stn> $garag </td><td $stn> $pur </td>
    <td $stn> $descri </td><td class='text-right' $stn> $weo&nbsp;TON </td>
			<td class='text-right' style='padding:1px; font-size:12px; $clr'> $disto&nbsp;KM </td>
			<td class='text-right' style='padding:1px; font-size:12px; $clr'> $amoo&nbsp;&nbsp;</td>
			<td class='text-right' style='padding:1px; font-size:12px; $clr'> $rato&nbsp;&nbsp;</td>
		<td class='text-right' style='padding:1px; font-size:12px; $clr'> $valo&nbsp;&nbsp;</td>");

echo"<div class='modal fade' id='exampleModal$n' tabindex='-1' role='dialog' aria-labelledby='exampleModalLabel' aria-hidden='true' 
		style='top:220px;'>
  <div class='modal-dialog' role='document'>
    <div class='modal-content'>
      <div class='modal-header'>
        <h5 class='modal-title' id='exampleModalLabel'>DELETE CONFIRMATION  
		<label style='float:right;'> $fna &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		$amoo </label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</h5>

      </div>
      <div class='modal-body' style='height:40px;'>
        <h5 style='color:#ff0033'>Are you sure you want to delete this record?</h5>
      </div><form method='post' action=''><input type='hidden' name='rowid' value='$code'><input type='hidden' name='gara' value='$gara'>
	  <input value='$p' name='p' type='hidden'><input value='$custo' name='custo' type='hidden'>
	  <input value='$dato' name='dato' type='hidden'><input value='$datos' name='datos' type='hidden'>
      <div class='modal-footer' style='margin-top:-10px; height:50px; padding-top:5px; border:0px solid blue;'>
        <button type='button' class='btn btn-sm btn-success' data-dismiss='modal'>&nbsp;NO&nbsp;</button>
        <button type='submit' name='delete_id' class='btn btn-sm btn-danger' $disa>YES</button>
      </div></form>
    </div>
  </div>
</div>";

if($_SESSION['Cancel']){
$tags="#exampleModal$n";
$disa="";
}
else{
    $tags="#";
    $disa="disabled";
}
						
						
								echo"<td align='right' style='width:20px; padding:0px;'>
						  <button type='button' class='btn btn-xs btn-danger hidden-print' style='height:18px; padding:0px; margin:0px;
						  width:25px;' data-placement='top' data-toggle='modal' data-target='$tags' $disa>
						  <i class='lnr lnr-trash'></i></button></td></tr>";
						$n++;							
						}
									
		$tam=number_format($tam, 2);				
		$tdi=number_format($tdi, 2);				
		$twe=number_format($twe, 2);				
		$tva=number_format($tva, 2);					

		?>
                    </tbody><thead> 
		<tr><th> </th><th colspan='6'>&nbsp;&nbsp;Total Amount </th>
	<th class='text-right' style='padding:0px'><?php echo"$twe&nbsp;&nbsp;" ?></th>
	<th class='text-right' style='padding:0px'><?php echo"$tdi&nbsp;&nbsp;" ?></th>
	<th class='text-right' style='padding:0px'><?php echo $tam ?>&nbsp;&nbsp;</th><th> </th>
			<th class='text-right' style='padding:0px'><?php echo $tva ?>&nbsp;&nbsp;</th>
			<th class='hidden-print text-right' style='padding:0px'> </th></tr>
                  </thead></table>
                                      
                
              </div>
            </div></div>
                  </div>                  
                <span class="pull-right hidden-print">
			 &nbsp;&nbsp;&nbsp;&nbsp;<a href="#" onclick="return window.print()" class="hidden-print" title='Click to print' data-toggle='tooltip' data-placement='top'><i class="lnr lnr-printer"></i></a></span>
			 <span class="pull-right hidden-print">
			 &nbsp;&nbsp;&nbsp;&nbsp;<a href="#" onclick="exportTableToExcel('inco_Data')" class="hidden-print" title='Export to excell' data-toggle='tooltip' data-placement='top'><i class="lnr lnr-line-spacing"></i></a></span>
      
   </div></div></div>  
   <?php
   include'footer.php';
   ?>