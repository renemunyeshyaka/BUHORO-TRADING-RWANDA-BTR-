<?php
if(basename($_SERVER['PHP_SELF']) == 'drepo.php') 
  $cm=" class='current'";
include'header.php';
include'connection.php';
$custo=$conde=$condi=$cond='';
$datos=$Date;
$dato = strtotime("-15 days", strtotime("$Date"));
				$dato=date("Y-m-d", $dato);
$p=0;

// search for an item to be added to the chart
if(isset($_POST['search']))
		{
			$dato=$_POST['dato'];
			$datos=$_POST['datos'];
			$custo=$_POST['custo'];
		}
	
	if($dato==$datos)
			$mpri="ON $dato";
		else
			$mpri="FROM $dato TO $datos";

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

    <li class="list-group-item">
	  <a href="drerepo.php">
                <p>
                <i class="lnr lnr-menu-circle"></i>&nbsp;Draining Report
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

    <li class="list-group-item active">
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

                     <div class="col-lg-2 hidden-print"> </div> 
							
                       <div class="col-lg-8 hidden-print"><div class="col-lg-3">
			<select class="form-control" name="custo">
				<option value='' selected='selected'>Select Vehicle</option>
			 <?php
			$doi=mysql_query("SELECT `vehicles`.`Plate`, `consumption`.`Vehicle` FROM `consumption` INNER JOIN `vehicles` ON `vehicles`.`Number` = `consumption`.`Vehicle` GROUP BY `consumption`.`Vehicle` ORDER BY `consumption`.`Vehicle` ASC");
			$foi=mysqli_num_rows($doi);
			while($roi=mysql_fetch_assoc($doi)){
				$code=$roi['Vehicle'];
				$fna=$roi['Plate'];
				$pla=$roi['Plate'];
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
			$fo=(strtotime("$datos") - strtotime("$dato")) / (60 * 60 * 24);
				if($fo==0)
					$fo=1;
		
		$date=$dato;
					?>
					<div class="divFooter"><center><u><b>DAILY INCOME REPORT <?php echo"$mpri"; ?></b></u></center></div>
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
                       <th class="text-center"> Vehicle </th>
                        <th class="text-center"> Income </th>
                        <th class="text-center"> Fuel </th>
                        <th class="text-center"> Services </th> 
						 <th class="text-center"> Consumption </th> 
                        <th class="text-center"> Balance </th></tr></thead>
                                        <tbody>
					<?php
					$n=$t=1;					$ti=$tf=$tr=0;
						while($date<=$datos){
		
		// ******************* Select vehicle ****************
    if($custo){
        $conde="AND `Vehicle`='$custo'";
$doi=mysqli_query($conn, "SELECT *FROM `vehicles` WHERE `Number`='$custo'");
			$roi=mysqli_fetch_assoc($doi);
				$fna=$roi['Plate'];
}
else
    $fna="ALL VEHICLES";
    
    if($foi==1)
        $fna=$pla;    
    // ********************** Search for daily income ***********
    $incom=mysqli_query($conn, "SELECT SUM(`Amount`) AS 'Incom' FROM `income` WHERE `Date`='$date' AND `Status`='0' $conde");
			$rinco=mysqli_fetch_assoc($incom);
				$inco=$rinco['Incom'];
    
    // ********************** Search for fuel consumption ***********
    $fuel=mysqli_query($conn, "SELECT SUM(`Amount`) AS 'Fuel' FROM `consumption` WHERE `Date`='$date' AND `Status`='0' $conde");
			$ruel=mysqli_fetch_assoc($fuel);
				$fue=$ruel['Fuel'];
				
	// ********************** Search for repair/services ***********
    $repai=mysqli_query($conn, "SELECT SUM(`Amount`) AS 'Repa' FROM `repair` WHERE `Date`='$date' AND `Status`='0' $conde");
			$ria=mysqli_fetch_assoc($repai);
				$rep=$ria['Repa'];
	$stouse=mysqli_query($conn, "SELECT SUM(`Quantity`*`Price`) AS 'Stou' FROM `stouse` WHERE `Date`='$date' AND `Status`='0' AND `Repair`!='0' AND `Vehicle`!='0' AND `Action`='USED' $conde");
			$rou=mysqli_fetch_assoc($stouse);
				$rep+=$rou['Stou'];

$ti+=$inco;					$tf+=$fue;					$tr+=$rep;	

	$fuo=number_format($fue, 2);	
	$incoo=number_format($inco, 2);	
	$repo=number_format($rep, 2);	
	$balo=number_format($inco-$fue-$rep, 2);	
	$consu=number_format($fue+$rep, 2);	


				
$stn="style='padding:1px;'";
           
					echo"<tr><td $stn class='text-center'>$n</td>
					<td width='10%' class='text-center' $stn> $date </td>
                        <td $stn>&nbsp; $fna</td>
                        <td class='text-right' $stn> $incoo </td>
                        <td class='text-right' $stn> $fuo </td>
						<td class='text-right' $stn> $repo </td>
						<td class='text-right' $stn> $consu </td>
						<td class='text-right' $stn> $balo </td></tr>";
						$n++;	
						if($date==$Date)
						    break;
			$date = strtotime("+1 day", strtotime("$date"));
				$date=date("Y-m-d", $date);					
						}
									
		$tba=number_format($ti-$tf-$tr, 2);					
		$tco=number_format($tf+$tr, 2);				
		$ti=number_format($ti, 2);					
		$tf=number_format($tf, 2);					
		$tr=number_format($tr, 2);					

		?>
                    </tbody><thead> 
		<tr><th> </th><th colspan='2'>&nbsp;&nbsp;Total Amount </th>
			<th class='text-right' style='padding:0px'><?php echo $ti ?></th>
			<th class='text-right' style='padding:0px'><?php echo $tf ?></th>
			<th class='text-right' style='padding:0px'><?php echo $tr ?></th>
			<th class='text-right' style='padding:0px'><?php echo $tco ?></th>
			<th class='text-right' style='padding:0px'><?php echo $tba ?></th>
    			</tr></thead></table>
                                      
                
              </div>
            </div></div>
                  </div>                  
                <span class="pull-right hidden-print">
			 &nbsp;&nbsp;&nbsp;&nbsp;<a href="#" onclick="return window.print()" class="hidden-print" title='Click to print' data-toggle='tooltip' data-placement='top'><i class="lnr lnr-printer"></i></a></span>
      
   </div></div></div>  
   <?php
   include'footer.php';
   ?>