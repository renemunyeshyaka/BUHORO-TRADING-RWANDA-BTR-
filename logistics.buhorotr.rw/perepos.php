<?php
if(basename($_SERVER['PHP_SELF']) == 'perepos.php') 
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
			$then=mysqli_query($conn, "DELETE FROM `inspection` WHERE `Number`='$rowid' LIMIT 1");
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
				$condi="AND `permit`.`Vehicle`='$custo'";

			if($gara)
				$cond="AND `permit`.`Type`='$gara'";

				if($p)
			$conde="AND `permit`.`Date` BETWEEN '$dato' AND '$datos'";
?>
<div class="container-fluid main-content">
        <div class="page-title hidden-xs hidden-print">
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

    <li class="list-group-item">
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

    <li class="list-group-item active">
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

                     <div class="col-lg-2 hidden-print"><select class="form-control" name="gara">
				<option value='' selected='selected'>Select Type</option>
			 <?php
			$dois=mysqli_query($conn, "SELECT `Type` FROM `permit` WHERE `Type`!='' GROUP BY `Type` ORDER BY `Type` ASC");
			while($rois=mysqli_fetch_assoc($dois)){
				$fue=$rois['Type'];
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
			$doi=mysqli_query($conn, "SELECT `vehicles`.`Plate`, `insurance`.`Vehicle` FROM `insurance` INNER JOIN `vehicles` ON `vehicles`.`Number` = `insurance`.`Vehicle` WHERE `vehicles`.`Trip`='0' GROUP BY `insurance`.`Vehicle` ORDER BY `insurance`.`Vehicle` ASC");
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
$do=mysqli_query($conn, "SELECT `permit`.* FROM `permit` INNER JOIN `vehicles` ON `permit`.`Vehicle`=`vehicles`.`Number` WHERE `permit`.`Status`='0' AND `vehicles`.`Trip`='0' $conde $condi $cond ORDER BY `Number` ASC");
	else
$do=mysqli_query($conn, "SELECT *FROM (SELECT `permit`.* FROM `permit` INNER JOIN `vehicles` ON `permit`.`Vehicle`=`vehicles`.`Number` WHERE `permit`.`Status`='0' AND `vehicles`.`Trip`='0' ORDER BY `permit`.`Date` DESC LIMIT 15) SUB ORDER BY `Date` ASC");
$fo=mysqli_num_rows($do);
					?>
					<div class="divFooter"><center><u><b>PERMIT REPORT <?php echo"$mpri"; ?></b></u></center></div>
		 <div class="row">
            <div class="col-lg-12">
             <span> &nbsp;&nbsp; Total Records Found : <b><?php echo" $fo " ?></b></span>
			 <span class="pull-right"><a href="#" onclick="return window.print()" class="hidden-print" title='Click to print' data-toggle='tooltip' data-placement='top'><i class="lnr lnr-printer"></i></a></span>
            <div class="widget-container fluid-height clearfix">
            <div class="widget-content padded clearfix">

			 <table class="table table-striped table-hover">     
                                      <thead>
                    <tr role="row">
                     <th class="text-center"> No </th>
                        <th class="text-center" width="8%"> Date </th>
                        <th class="text-center"> User </th>
                        <th class="text-center"> Location </th> 
                        <th class="text-center"> Vehicle </th>
					    <th class="text-center"> Description </th> 
                        <th class="text-center" width="8%"> Starting </th> 
                        <th class="text-center" width="8%"> Ending </th>
                        <th class="text-center" width="7%"> Days </th>  
                        <th class="hidden-print text-center"> File </th>  
						<th colspan='2' class="hidden-print text-center" width="1%"> # </th></tr></thead>
                                        <tbody>
					<?php
					$n=$t=1;					$tam=$tdi=$tq=$tpa=0;
						while($ro=mysqli_fetch_assoc($do)){
$code=$ro['Number'];
$emplo=$ro['Vehicle'];
$sta=$ro['Start'];
$desi=$ro['Descri'];
$dte=$ro['Date'];
$user=$ro['User'];
$garag=$ro['Type'];
$end=$ro['Ending'];
$file=$ro['File'];
$ds="";

$all = ceil(abs(strtotime($end) - strtotime($sta)) / 86400);

if($end>$Date){
$days = ceil(abs(strtotime($end) - strtotime($Date)) / 86400);
$ds = "/ $all";
}
else
	$days="--";

$doi=mysqli_query($conn, "SELECT *FROM `vehicles` WHERE `Number`='$emplo'");
			$roi=mysqli_fetch_assoc($doi);
				$fna=$roi['Plate'];

if($end>=$Date AND $days<=10)
	$stn="style='padding:1px; color:red;'";
else
	$stn="style='padding:1px;'";
           
					print("<tr><td $stn class='text-center'>$n</td><td class='text-center' $stn> $dte </td>
                        <td $stn> $user </td><td $stn> $garag </td><td $stn>&nbsp;$fna&nbsp;</td>
						<td $stn> $desi </td><td class='text-center' $stn> $sta </td>
						<td class='text-center' $stn> $end </td>
						<td class='text-right' $stn> $days / $all &nbsp;</td>
						<td $stn class='hidden-print'> $file </td><td class='hidden-print text-left' style='width:10px; padding:0px;'>");
				

echo"<div class='modal fade' id='exampleModal$n' tabindex='-1' role='dialog' aria-labelledby='exampleModalLabel' aria-hidden='true' 
		style='top:220px;'>
  <div class='modal-dialog' role='document'>
    <div class='modal-content'>
      <div class='modal-header'>
        <h5 class='modal-title' id='exampleModalLabel'>DELETE CONFIRMATION  
		<label style='float:right;'> $fna &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		$sta &nbsp;&nbsp; $end </label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</h5>

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
						
					
				if($file)
					echo"<a href='down_inst.php?link=$file'>
				<button type='button' class='btn btn-xs btn-info hidden-print' style='height:18px; padding:0px; margin:0px;
						  width:25px;' title='Download this Image' data-toggle='tooltip' data-placement='top'>
						  &nbsp;&nbsp;<i class='lnr lnr-download'></i> &nbsp;&nbsp;</button></a>";
						  else
							  echo"&nbsp;&nbsp;";
							  

if($_SESSION['Cancel'] OR $_SESSION['Ctr']){
$tags="#exampleModal$n";
$disa="";
}
else{
    $tags="#";
    $disa="disabled";
}
						  
						
								echo"</td><td class='text-center' style='width:10px; padding:0px 0px 0px 5px;'>
						  <button type='button' class='btn btn-xs btn-danger hidden-print' style='height:18px; padding:0px; margin:0px;
						  width:25px;' data-placement='top' data-toggle='modal' data-target='$tags' $disa>
						  <i class='lnr lnr-trash'></i></button></td></tr>";
						$n++;	
						}
									
							$tam=number_format($tam, 2);					

		?>
                    </tbody></table>
                                      
                
              </div>
            </div></div>
                  </div>                  
                <span class="pull-right hidden-print">
			 &nbsp;&nbsp;&nbsp;&nbsp;<a href="#" onclick="return window.print()" class="hidden-print" title='Click to print' data-toggle='tooltip' data-placement='top'><i class="lnr lnr-printer"></i></a></span>
      
   </div></div></div>  
   <?php
   include'footer.php';
   ?>