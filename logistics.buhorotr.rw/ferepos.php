<?php
if(basename($_SERVER['PHP_SELF']) == 'ferepos.php') 
$cm=" class='current'";
include'header.php';
include'connection.php';
$custo=$conde=$condi=$cond='';
$dato=$datos=$Date;
$fuel='';
$p=0;

// search for an item to be added to the chart
if(isset($_POST['search']))
		{
			$dato=$_POST['dato'];
			$datos=$_POST['datos'];
			$custo=$_POST['custo'];
			$fuel=$_POST['fuel'];
			$p=1;
		}

		if(isset($_POST['delete_id']))
		{
			$rowid=$_POST['rowid'];
	$then=mysqli_query($conn, "DELETE FROM `consumption` WHERE `Number`='$rowid' LIMIT 1");
			$p=$_POST['p'];
			$dato=$_POST['dato'];
			$datos=$_POST['datos'];
			$custo=$_POST['custo'];
			$fuel=$_POST['fuel'];
		}
		if(isset($_POST['updat']))
		{
			$rowid=$_POST['rowid'];
			$p=$_POST['p'];
			$dato=$_POST['dato'];
			$datos=$_POST['datos'];
			$custo=$_POST['custo'];
			$fuel=$_POST['fuel'];
			$curre=$_POST['curre'];
			$qt=$_POST['qt'];
			$prio=str_replace(',', '', $_POST['prio']);
			$am=$qt*$prio;
	$then=mysqli_query($conn, "UPDATE `consumption` SET `Amount`='$am', `Price`='$prio', `Rate`='$curre' WHERE `Number`='$rowid' LIMIT 1");
		}
	
	if($dato==$datos)
			$mpri="ON $dato";
		else
			$mpri="FROM $dato TO $datos";

			if($custo)
				$condi="AND `consumption`.`Vehicle`='$custo'";

			if($fuel)
				$cond="AND `consumption`.`Station`='$fuel'";

				if($p)
			$conde="AND `consumption`.`Date` BETWEEN '$dato' AND '$datos'";
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
	  <a href="verepos.php">
                <p>
                <i class="lnr lnr-menu-circle"></i>&nbsp;Vehicles Report
                </p>
              </a></li> 

    <li class="list-group-item active">
	  <a href="ferepos.php">
                <p>
                <i class="lnr lnr-menu-circle"></i>&nbsp;Consumption Report
                </p>
              </a></li> 

    <li class="list-group-item">
	  <a href="rerepos.php">
                <p>
                <i class="lnr lnr-menu-circle"></i>&nbsp;Repair/Service Report
                </p>
              </a></li>   

    <li class="list-group-item">
	  <a href="insurepos.php">
                <p>
                <i class="lnr lnr-menu-circle"></i>&nbsp;Insurance Report
                </p>
              </a></li>  

    <li class="list-group-item">
	  <a href="insprepos.php">
                <p>
                <i class="lnr lnr-menu-circle"></i>&nbsp;Inspection Report
                </p>
              </a></li>   

    <li class="list-group-item">
	  <a href="irepos.php">
                <p>
                <i class="lnr lnr-menu-circle"></i>&nbsp;Income Report
                </p>
              </a></li> 

    <li class="list-group-item">
	  <a href="perepos.php">
                <p>
                <i class="lnr lnr-menu-circle"></i>&nbsp;Permit Report
                </p>
              </a></li> 

    <li class="list-group-item">
	  <a href="mrepos.php">
                <p>
                <i class="lnr lnr-menu-circle"></i>&nbsp;Monthly Report
                </p>
              </a></li>  

    <li class="list-group-item">
	  <a href="drepos.php">
                <p>
                <i class="lnr lnr-menu-circle"></i>&nbsp;Daily  Report
                </p>
              </a></li> 

    <li class="list-group-item">
	  <a href="vrepos.php">
                <p>
                <i class="lnr lnr-menu-circle"></i>&nbsp;System  Report
                </p>
              </a></li>    

    <li class="list-group-item">
	  <a href="anrepos.php">
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

                     <div class="col-lg-2 hidden-print"><select class="form-control" name="fuel">
				<option value='' selected='selected'>Select Station</option>
			 <?php
			$dois=mysqli_query($conn, "SELECT `Station` FROM `consumption` WHERE `Station`!='' GROUP BY `Station` ORDER BY `Station` ASC");
			while($rois=mysqli_fetch_assoc($dois)){
				$fue=$rois['Station'];
				if($fue==$fuel)
					$sli="selected='selected'";
				else
					$sli='';
			echo"<option value='$fue' $sli> $fue </option>";
			}
			?>    
                            </select></div> 
							
                       <div class="col-lg-8 hidden-print"><div class="col-lg-3">
			<select class="form-control" name="custo">
				<option value='' selected='selected'>Select Vehicle</option>
			 <?php
			$doi=mysqli_query($conn, "SELECT `vehicles`.`Plate`, `consumption`.`Vehicle` FROM `consumption` INNER JOIN `vehicles` ON `vehicles`.`Number` = `consumption`.`Vehicle` WHERE `vehicles`.`Trip`='0' AND `vehicles`.`Plate` NOT LIKE '%PETRO%' GROUP BY `consumption`.`Vehicle` ORDER BY `consumption`.`Vehicle` ASC");
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
				if($p)
$do=mysqli_query($conn, "SELECT `consumption`.* FROM `consumption` INNER JOIN `vehicles` ON `vehicles`.`Number` = `consumption`.`Vehicle` WHERE  `consumption`.`Status`='0' AND `vehicles`.`Trip`='0' AND `vehicles`.`Plate` NOT LIKE '%PETRO%' $conde $condi $cond ORDER BY `consumption`.`Date` ASC");
	else
$do=mysqli_query($conn, "SELECT *FROM (SELECT `consumption`.* FROM `consumption` INNER JOIN `vehicles` ON `vehicles`.`Number` = `consumption`.`Vehicle` WHERE `consumption`.`Status`='0' AND `vehicles`.`Trip`='0' AND `vehicles`.`Plate` NOT LIKE '%PETRO%' ORDER BY `consumption`.`Date` DESC LIMIT 15) SUB ORDER BY `Date` ASC");

$fo=mysqli_num_rows($do);
					?>
					<div class="divFooter"><center><u><b>FUEL CONSUMPTION REPORT <?php echo"$mpri"; ?></b></u></center></div>
		 <div class="row">
            <div class="col-lg-12">
             <span> &nbsp;&nbsp; Total Records Found : <b><?php echo" $fo " ?></b></span>
			 <span class="pull-right hidden-print">
			 &nbsp;&nbsp;&nbsp;&nbsp;<a href="#" onclick="return window.print()" class="hidden-print" title='Click to print' data-toggle='tooltip' data-placement='top'><i class="lnr lnr-printer"></i></a></span>
			 
			  <span class="pull-right hidden-print">
			 &nbsp;&nbsp;&nbsp;&nbsp;<a href="#" onclick="exportTableToExcel('tblData')" class="hidden-print" title='Export to excell' data-toggle='tooltip' data-placement='top'><i class="lnr lnr-line-spacing"></i></a></span>
            <div class="widget-container fluid-height clearfix">
            <div class="widget-content padded clearfix">

			 <table class="table table-striped table-hover" id="tblData">     
                                      <thead>
                    <tr role="row">
                     <th class="text-center"> No </th>
                        <th class="text-center"> Date </th>
                        <th class="text-center"> Station </th>
                       <th class="text-center"> Vehicle </th>
						 <th class="text-center"> Driver </th>  
                        <th class="text-center"> Quantity </th> 
                        <th class="text-center"> Type </th>
                        <th class="text-center"> Price </th>
						 <th class="text-center"> Total&nbsp;Amount </th>
						 <th class="text-center"> Rate </th>
                        <th class="text-center"> Price </th>
						 <th class="text-center"> Total&nbsp;Value </th>
						 <th class="hidden-print text-center" width="1%"> # </th></tr></thead>
                                        <tbody>
					<?php
					$n=1;					$tam=$tdi=$tq=$tpa=$tsi=$tva=0;
						while($ro=mysqli_fetch_assoc($do)){
$code=$ro['Number'];
$emplo=$ro['Vehicle'];
$amo=$ro['Amount'];
$amoo=number_format($amo, 2);
$disco=$ro['Discount'];
$dte=$ro['Date'];
$pri=$ro['Price'];
$qty=$amo/$pri;
$fuel=$ro['Fuel'];
$tdo=$qty*$disco;
$pai=$amo-$tdo;
$purcha=$ro['Purchase'];
$plate=$ro['Plate'];
$sta=$ro['Station'];
$rate=$ro['Rate'];
$value=$amo*$rate;
$lpri=$pri*$rate;
$qt=$ro['Quantity'];

	$prio=number_format($pri, 2);
	$tdoo=number_format($tdo, 2);
	$qto=number_format($qty, 2);
	$paio=number_format($pai, 2);
	$rato=number_format($rate, 2);
	$valo=number_format($value, 2);
	$lpro=number_format($lpri, 2);

$doi=mysqli_query($conn, "SELECT `Plate`, `Driver` FROM `vehicles` WHERE `Number`='$emplo' AND `Trip`='0'");
			$roi=mysqli_fetch_assoc($doi);
				$fna=$roi['Plate'];
				$dri=$roi['Driver'];

$doil=mysqli_query($conn, "SELECT `Purchase` FROM `consumption` WHERE `Vehicle`='$emplo' AND `Purchase`!='0' AND `Purchase`<'$purcha' ORDER BY `Purchase` DESC LIMIT 1");
	if($foil=mysqli_num_rows($doil)){
			$roil=mysqli_fetch_assoc($doil);
				$dis=$purcha-$roil['Purchase'];
				$tsi+=$dis;
	}
	else
		$dis="--";
				
				if($_SESSION['Ctr'])
				    $disa="";
				else
				    $disa="disabled";
				    
                if($qty>0)	    
            $stn="style='padding:1px; font-size:12px;'";
                else    
            $stn="style='padding:1px; font-size:12px; color:red;'";
           
					print("<tr><td $stn class='text-center'>$n</td>
                <td $stn> $dte </td><td $stn> $sta </td><td $stn> $fna </td>
						<td class='text-left' style='padding:1px'> $dri </td>
						<td class='text-right' style='padding:1px'> $qto </td>
						<td style='padding:1px 5px 1px 5px;'> $fuel </td>
						<td class='text-right' style='padding:1px'> <a href='#' data-toggle='modal' data-target='#exampleModalx$n'>$prio</a> </td>
						<td class='text-right' style='padding:1px'> $amoo </td>
						<td class='text-right' style='padding:1px'> <a href='#' data-toggle='modal' data-target='#exampleModalx$n'>$rato</a> </td>");
						
			
			
			
	echo"<div class='modal fade' id='exampleModalx$n' tabindex='-1' role='dialog' aria-labelledby='exampleModalLabel' aria-hidden='true' 
		style='top:220px;'><div class='modal-dialog' role='document'>
    <div class='modal-content'><div class='modal-header'>
        <h5 class='modal-title' id='exampleModalLabel'>PRICE UPDATION
        <label class='pull-right text-right'>[<b> $sta &nbsp;&nbsp; $dte </b>]</label></h5>

      </div><form method='post' action=''>
      <div class='modal-body' style='height:80px;'>
      <div class='col-md-3 text-right'> Price&nbsp;Per&nbsp;Unit </div>
      <div class='col-md-5'>
       <input name='prio' class='form-control text-center' type='text' onkeypress='return isNumberKey(event)' onkeyup='format(this);' value='$prio' required>
       </div>
       
       <div class='col-md-4'><select class='form-control' name='curre' title='Currency' data-toggle='tooltip' data-placement='top' style='margin-left:0px;' required>";
		
			$doi=mysqli_query($conn, "SELECT `Code`, `Rate` FROM `currency` WHERE `Code`!='' ORDER BY `Code` ASC");
			while($roi=mysqli_fetch_assoc($doi)){
				$fna=$roi['Code'];
				$rat=$roi['Rate'];
				$rte=number_format($rat, 2);
				if($rate==$rat)
			echo"<option value='$rat' selected> $fna @ $rte </option>";
			    else
			echo"<option value='$rat'> $fna @ $rte </option>";
			}
		
		   echo"</select></div>
      </div>
      
      <input type='hidden' name='rowid' value='$code'>
      <input type='hidden' name='fuel' value='$fuel'>
	  <input value='$p' name='p' type='hidden'>
	  <input value='$qt' name='qt' type='hidden'>
	  <input value='$custo' name='custo' type='hidden'>
	  <input value='$dato' name='dato' type='hidden'>
	  <input value='$datos' name='datos' type='hidden'>
      <div class='modal-header text-right;' style='height:50px; padding-top:10px; padding-right:60px; text-align:right;'>
        <button type='button' class='btn btn-sm btn-danger' data-dismiss='modal'>CANCEL</button>
        <button type='submit' name='updat' class='btn btn-sm btn-success'>UPDATE</button>
      </div></form>
    </div>
  </div>
</div>";



		
		print("<td class='text-right' style='padding:1px'> $lpro </td>
						<td class='text-right' style='padding:1px'> $valo </td>");

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
      </div><form method='post' action=''><input type='hidden' name='rowid' value='$code'><input type='hidden' name='fuel' value='$fuel'>
	  <input value='$p' name='p' type='hidden'><input value='$custo' name='custo' type='hidden'>
	  <input value='$dato' name='dato' type='hidden'><input value='$datos' name='datos' type='hidden'>
      <div class='modal-footer' style='margin-top:-10px; height:50px; padding-top:5px; border:0px solid blue;'>
        <button type='button' class='btn btn-sm btn-success' data-dismiss='modal'>&nbsp;NO&nbsp;</button>
        <button type='submit' name='delete_id' class='btn btn-sm btn-danger' $disa>YES</button>
      </div></form>
    </div>
  </div>
</div>";
		

if($_SESSION['Cancel'] OR $_SESSION['Ctr']){
$tags="#exampleModal$n";
$disa="";
}
else{
    $tags="#";
    $disa="disabled";
}				
						
						
								echo"<td align='right' style='width:20px; padding:0px; padding-left:8px;'>
						  <button type='button' class='btn btn-xs btn-danger hidden-print' style='height:18px; padding:0px; margin:0px;
						  width:25px;' data-placement='top' data-toggle='modal' data-target='$tags' $disa>
						  <i class='lnr lnr-trash'></i></button></td></tr>";
						  $n++;				$tam+=$amo;			
						  $tpa+=$pai;			
						  if($qty>0)
						  $tq+=$qty;			
						  $tdi+=$tdo;             $tva+=$value;
						}
									
	$tq=number_format($tq, 2);					$tam=number_format($tam, 2);					$tba=number_format($tba, 2);
	$tva=number_format($tva, 2);				$tdi=number_format($tdi, 2);					$tsi=number_format($tsi, 2);

		?>
                    </tbody><thead> 
		<tr><th> </th><th colspan='3'>&nbsp;&nbsp;Total Amount </th>
			<th class='text-right' style='padding:0px'> </th></th>
			<th class='text-right' style='padding:0px'><?php echo $tq ?></th>
			<th class='text-right' style='padding:0px'> </th>
			<th colspan='2' class='text-right' style='padding:0px'><?php echo $tam ?></th><th> </th>
            <th class='text-right' colspan='2' style='padding:0px;'><?php echo $tva ?></th>
			<th class='hidden-print text-right' style='padding:0px'> </th></tr>
                  </thead></table>
                                      
                
              </div>
            </div></div>
                  </div>                  
                <span class="pull-right hidden-print">
			 &nbsp;&nbsp;&nbsp;&nbsp;<a href="#" onclick="return window.print()" class="hidden-print" title='Click to print' data-toggle='tooltip' data-placement='top'><i class="lnr lnr-printer"></i></a></span> 
			 
			    <span class="pull-right hidden-print">
			 &nbsp;&nbsp;&nbsp;&nbsp;<a href="#" onclick="exportTableToExcel('tblData')" class="hidden-print" title='Export to excell' data-toggle='tooltip' data-placement='top'><i class="lnr lnr-line-spacing"></i></a></span>
      
   </div></div></div>  
   <?php
   include'footer.php';
   ?>