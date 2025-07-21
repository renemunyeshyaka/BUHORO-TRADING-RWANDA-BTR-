<?php
if(basename($_SERVER['PHP_SELF']) == 'rerepo.php') 
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
			$then=mysqli_query($conn, "DELETE FROM `repair` WHERE `Number`='$rowid' LIMIT 1");
			$p=$_POST['p'];
			$dato=$_POST['dato'];
			$datos=$_POST['datos'];
			$custo=$_POST['custo'];
			$gara=$_POST['gara'];

	$doi=mysqli_query($conn, "SELECT *FROM `stouse` WHERE `Repair`='$rowid'");
			while($roi=mysqli_fetch_assoc($doi)){
				$numu=$roi['Number'];
				$qts=$roi['Quantity'];
				$its=$roi['Item'];
				$stor=$roi['Store'];
	$then=mysqli_query($conn, "DELETE FROM `stouse` WHERE `Number`='$numu' LIMIT 1");
	
		if($stor)
	$doin=mysqli_query($conn, "UPDATE `items` SET `Quantity`=`Quantity`+'$qts' WHERE `Number`='$its' ORDER BY `Number` DESC LIMIT 1");
			}

		}

	if(isset($_POST['deloge']))
		{
			$rowid=$_POST['rowid'];
			$p=$_POST['p'];
			$dato=$_POST['dato'];
			$datos=$_POST['datos'];
			$custo=$_POST['custo'];
			$gara=$_POST['gara'];

			$numu=$_POST['numu'];
			$qts=$_POST['qts'];
			$ites=$_POST['ites'];
			$stor=$_POST['stor'];
	$then=mysqli_query($conn, "DELETE FROM `stouse` WHERE `Number`='$numu' LIMIT 1");
	
		if($stor)
	$doin=mysqli_query($conn, "UPDATE `items` SET `Quantity`=`Quantity`+'$qts' WHERE `Number`='$ites' ORDER BY `Number` DESC LIMIT 1");
		}
	
	if($dato==$datos)
			$mpri="ON $dato";
		else
			$mpri="FROM $dato TO $datos";

			if($custo)
				$condi="AND `repair`.`Vehicle`='$custo'";

			if($gara)
				$cond="AND `repair`.`Garage`='$gara'";

				if($p)
			$conde="AND `repair`.`Date` BETWEEN '$dato' AND '$datos'";
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

    <li class="list-group-item active">
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

    <li class="list-group-item">
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
                <i class="lnr lnr-menu-circle"></i>&nbsp;Daily  Report
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
				<option value='' selected='selected'>Select Type</option>
			 <?php
			$dois=mysqli_query($conn, "SELECT `Garage` FROM `repair` WHERE `Garage`!='' GROUP BY `Garage` ORDER BY `Garage` ASC");
			while($rois=mysqli_fetch_assoc($dois)){
				$fue=$rois['Garage'];
				if($fue==$gara)
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
			$doi=mysqli_query($conn, "SELECT `vehicles`.`Plate`, `repair`.`Vehicle` FROM `repair` INNER JOIN `vehicles` ON `vehicles`.`Number` = `repair`.`Vehicle` WHERE `vehicles`.`Trip`='1' GROUP BY `repair`.`Vehicle` ORDER BY `repair`.`Vehicle` ASC");
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
      <input class="form-control form-center" id="from" name="dato" type="text" value="<?php echo $dato ?>" onkeypress='return isNumberKey(event)' required>
	  <span class="input-group-addon"><i class="lnr lnr-calendar-full"></i></span>
			</div></div>


		  <div class="col-lg-3"> 
           <div class="input-group date" data-provide="datepicker">	
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
$do=mysqli_query($conn, "SELECT `repair`.* FROM `repair` INNER JOIN `vehicles` ON `vehicles`.`Number` = `repair`.`Vehicle` WHERE `repair`.`Status`='0' AND `vehicles`.`Trip`='1' $conde $condi $cond ORDER BY `repair`.`Date` ASC");
	else
$do=mysqli_query($conn, "SELECT *FROM (SELECT `repair`.* FROM `repair` INNER JOIN `vehicles` ON `vehicles`.`Number` = `repair`.`Vehicle` WHERE `repair`.`Status`='0' AND `vehicles`.`Trip`='1' ORDER BY `repair`.`Date` DESC LIMIT 15) SUB ORDER BY `Date` ASC");
$fo=mysqli_num_rows($do);
					?>
					<div class="divFooter"><center><u><b>REPARATION REPORT <?php echo"$mpri"; ?></b></u></center></div>
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
                        <th class="text-center"> &nbsp;Type </th> 
                       <th class="text-center"> Vehicle </th>
						 <th class="text-center"> Description </th> 
                        <th class="text-center"> Driver </th> 
                        <th class="text-center" width='8%'> Quantity </th>  
                        <th class="text-center" width='8%'> Price </th>
						 <th class="text-center" width='10%'> Amount </th>
		<th class="hidden-print text-center" width="1%"> # </th></tr></thead>
                                        <tbody>
					<?php
					$n=$t=1;					$tam=$tdi=$tq=$tpa=0;
						while($ro=mysqli_fetch_assoc($do)){
							$sub=0;
$code=$ro['Number'];
$emplo=$ro['Vehicle'];
$amo=$ro['Amount'];
$amoo=number_format($amo, 2);
$desi=$ro['Issue'];
$dte=$ro['Date'];
$pri=$ro['Amount'];
$garag=$ro['Garage'];
$driv=$ro['Driver'];
$pur=$ro['Purchase'];
$tam+=$pri;	
$sub+=$pri;

	$prio=number_format($pri, 2);

$doi=mysqli_query($conn, "SELECT *FROM `vehicles` WHERE `Number`='$emplo' AND `Trip`='1'");
			$roi=mysqli_fetch_assoc($doi);
				$fna=$roi['Plate'];
				
$stn="style='padding:1px;'";
           
					print("<tr><td $stn class='text-center'>$n</td><td class='text-center' $stn> $dte </td>
					<td $stn> $garag </td><td $stn>&nbsp;$fna&nbsp;</td>
						<td $stn> $desi </td><td $stn> $driv </td><td class='text-right' $stn> 1.00 </td>
						<td class='text-right' style='padding:1px'> $prio </td>
						<td class='text-right' style='padding:1px'> $prio&nbsp;&nbsp;</td>");

echo"<div class='modal fade' id='exampleModal$n' tabindex='-1' role='dialog' aria-labelledby='exampleModalLabel' aria-hidden='true' 
		style='top:220px;'>
  <div class='modal-dialog' role='document'>
    <div class='modal-content'>
      <div class='modal-header'>
        <h5 class='modal-title' id='exampleModalLabel'>DELETE CONFIRMATION  
		<label style='float:right;'> $fna &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		$garag &nbsp;&nbsp; $prio </label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</h5>

      </div>
      <div class='modal-body' style='height:40px;'>
        <h5 style='color:#ff0033'>Are you sure you want to delete this record?</h5>
      </div><form method='post' action=''>
      <input type='hidden' name='rowid' value='$code'>
      <input type='hidden' name='gara' value='$gara'>
	  <input value='$p' name='p' type='hidden'>
	  <input value='$custo' name='custo' type='hidden'>
	  <input value='$dato' name='dato' type='hidden'>
	  <input value='$datos' name='datos' type='hidden'>
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
						
						
						
								echo"<td align='right' class='hidden-print' style='width:20px; padding:0px;'>
						  <button type='button' class='btn btn-xs btn-danger hidden-print' style='height:18px; padding:0px; margin:0px;
						  width:25px;' data-placement='top' data-toggle='modal' data-target='$tags' $disa>
						  <i class='lnr lnr-trash'></i></button></td></tr>";

			
	$dob=mysqli_query($conn, "SELECT `items`.`Item`, `stouse`.`Number`, `stouse`.`Date`, `stouse`.`Price`, `stouse`.`Quantity`, `stouse`.`Status`, `stouse`.`Store`, `stouse`.`Item` AS 'Ites' FROM `stouse` INNER JOIN `items` ON `stouse`.`Item` = `items`.`Number` WHERE `stouse`.`Status`!='1' AND `stouse`.`Repair`='$code' AND `stouse`.`Action`='USED' ORDER BY `stouse`.`Number` ASC");
		if($fob=mysqli_num_rows($dob)){
		while($rob=mysqli_fetch_assoc($dob)){
			$stl="padding:0px; color:#6600ff;";
			$numu=$rob['Number'];
			$dati=$rob['Date'];
			$pri=$rob['Price'];
			$qty=$rob['Quantity'];
			$name=$rob['Item'];
			$status=$rob['Status'];
			$stor=$rob['Store'];
			$ites=$rob['Ites'];
			$all=$pri*$qty;

				  		$tam+=$all;						$sub+=$all;
			
			if($stor=='0')
				$garag="";
			else
				$garag="[STORE]";

			$prio=number_format($pri, 2);				
			$qto=number_format($qty, 2);			
			$allo=number_format($all, 2);

print("<tr><td style='padding:0px;'></td>
<td colspan='2' style='$stl $clr'>  </div>");
	
	if($_SESSION['Etr']){
        $taga="#iModal$t";
        $disa="";
        }
    else{
    $taga="#";
    $disa="disabled";
        }		
			
	echo"<div class='modal fade' id='iModal$t' tabindex='-1' role='dialog' aria-labelledby='exampleModalLabel' aria-hidden='true' style='top:220px;'>
  <div class='modal-dialog' role='document'><div class='modal-content'><div class='modal-header'>
        <h5 class='modal-title' id='exampleModalLabel'>DELETE CONFIRMATION  
		<label style='float:right;'> $name &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 
		$allo </label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</h5>

      </div>
      <div class='modal-body' style='height:40px;'>
        <h5 style='color:#ff0033'>Are you sure you want to delete this record?</h5>
      </div><form method='post' action=''><input type='hidden' name='rowid' value='$code'>
	  <input type='hidden' name='gara' value='$gara'><input value='$p' name='p' type='hidden'>
	  <input value='$custo' name='custo' type='hidden'><input value='$dato' name='dato' type='hidden'>
	  <input value='$datos' name='datos' type='hidden'><input type='hidden' name='numu' value='$numu'>
	  <input type='hidden' name='stor' value='$stor'><input type='hidden' name='qts' value='$qty'>
	  <input type='hidden' name='ites' value='$ites'>
      <div class='modal-footer' style='margin-top:-10px; height:50px; padding-top:5px; border:0px solid blue;'>
        <button type='button' class='btn btn-sm btn-success' data-dismiss='modal'>&nbsp;NO&nbsp;</button>
        <button type='submit' name='deloge' class='btn btn-sm btn-danger' $disa>YES</button>
      </div></form>
    </div>
  </div>
</div>";

			
			print("</td><td style='text-align:center; $stl $clr'> $dati </td>
			<td colspan='2' style='$stl $clr'>$name &nbsp;&nbsp; <font size='1'>$garag</font></td>
			<td class='text-right' style='$stl $clr'>$qto</td><td class='text-right' style='$stl $clr'>$prio</td>
			<td class='text-right' style='$stl $clr'>$allo&nbsp;&nbsp;</td>
			
			<td align='right' class='hidden-print' style='width:20px; padding:0px;'>
						  <button type='button' class='btn btn-xs btn-warning hidden-print' style='height:18px; padding:0px; margin:0px;
						  width:25px;' data-placement='top' data-toggle='modal' data-target='$taga' $disa>
						  <i class='lnr lnr-trash'></i></button></td></tr>");									
											$t++;				
						}
						$sub=number_format($sub, 2);
		print("<tr><th style='padding:1px;'> </th><th colspan='5' style='padding:1px; color:teal'> Sub-Total </th>
		<th colspan='3' style='padding:1px; color:teal' class='text-right'> $sub &nbsp;</th>
		<th class='hidden-print' style='padding:1px;'> </th></tr>");
		}
						$n++;							
						}
									
							$tam=number_format($tam, 2);					

		?>
                    </tbody><thead> 
		<tr><th> </th><th colspan='5'>&nbsp;&nbsp;Total Amount </th>
			<th colspan='3' class='text-right' style='padding:0px'><?php echo $tam ?>&nbsp;&nbsp;</th>
			<th class='hidden-print text-right' style='padding:0px'> </th></tr>
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