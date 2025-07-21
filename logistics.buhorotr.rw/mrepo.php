<?php
if(basename($_SERVER['PHP_SELF']) == 'mrepo.php') 
$cm=" class='current'";
include'header.php';
include'connection.php';
$custo=$conde=$condi=$cond='';
$year=date("Y");
$start=$year-3;

// search for an item to be added to the chart
if(isset($_POST['search']))
		{
			$year=$_POST['year'];
			$custo=$_POST['custo'];
		}
	
			$mpri="FOR $year";

			if($custo)
				$condi="AND `Vehicle`='$custo'";
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

    <li class="list-group-item active">
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

                     <div class="col-lg-2 hidden-print"> </div> 
							
                       <div class="col-lg-8 hidden-print">
        <div class="col-lg-3 hidden-print"> </div><div class="col-lg-4">
			<select class="form-control" name="custo">
				<option value='' selected='selected'>Select Vehicle</option>
			 <?php
			$doi=mysqli_query($conn, "SELECT `vehicles`.`Plate`, `vehicles`.`Number` FROM `vehicles` WHERE `vehicles`.`Trip`='1' AND `vehicles`.`Status`='0' GROUP BY `vehicles`.`Plate` ORDER BY `vehicles`.`Plate` ASC");
			$foi=mysqli_num_rows($doi);
			while($roi=mysqli_fetch_assoc($doi)){
				$code=$roi['Number'];
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
            <div class="col-lg-2"> 
          <select class="form-control text-center" name="year">
              <?php
              while($start<=date("Y")){
                  if($start==$year)
                    $s="selected";
                  else
                    $s="";
        echo"<option value='$start' class='text-center' $s>$start</option>";
                  $start++;
              }
              ?>
			</select></div>                      
                       
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
					<div class="divFooter"><center><u><b>MONTHLY INCOME REPORT <?php echo"$mpri"; ?></b></u></center></div>
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
                        <th class="text-center"> Month </th> 
                        <th class="text-center"> Year </th>
                       <th class="text-center"> Vehicle </th>
                        <th class="text-center"> Income </th>
                        <th class="text-center"> Fuel </th>
                        <th class="text-center"> Services </th> 
						 <th class="text-center"> Consumption </th> 
                        <th class="text-center"> Balance </th>
                        <th class="text-center"> Trips </th>
                        <th class="text-center"> Target </th>
                        <th class="text-center"> Perc.&nbsp;(%) </th></tr></thead>
                                        <tbody>
					<?php
					$n=$t=1;					$ti=$tf=$tr=$tp=$tg=0;
						while($t<=12){
		$std="$year-$t-01";                 $end="$year-$t-31";
		$mo=date("F", strtotime($std));
		
		// ******************* Select vehicle ****************
    if($custo){
$doi=mysqli_query($conn, "SELECT `Number`, `Plate` FROM `vehicles` WHERE `Number`='$custo'");
}
else{
$doi=mysqli_query($conn, "SELECT `vehicles`.`Number`, `vehicles`.`Plate` FROM `vehicles` INNER JOIN `trips` ON `vehicles`.`Number` = `trips`.`Vehicle` WHERE `vehicles`.`Trip`='1' AND `vehicles`.`Status`='0' AND `vehicles`.`Date`<='$end' GROUP BY `vehicles`.`Plate`");
}
    $foi=mysqli_num_rows($doi);
    $inco=$fue=$rep=$trip=0;
        $tars=$foi*$targ;
    
			while($roi=mysqli_fetch_assoc($doi)){
				$pla=$roi['Plate'];
				$veh=$roi['Number'];
				
     if($foi==1)
        $fna=$pla;
     else
        $fna="ALL VEHICLES";
        
           // ********************** Search for trips *******************
    $tris=mysqli_query($conn, "SELECT `Target` FROM `trips` WHERE `Date` BETWEEN '$std' AND '$end' AND `Status`='0' AND `Vehicle`='$veh' ORDER BY `Number` DESC");
            $trip+=mysqli_num_rows($tris);
            $rip=mysqli_fetch_assoc($tris);
            //$tars=$foi*$rip['Target'];
    
    // ********************** Search for daily income ********************
    $incom=mysqli_query($conn, "SELECT SUM(`Amount`*`Rate`) AS 'Incom' FROM `income` WHERE `Date` BETWEEN '$std' AND '$end' AND `Status`='0' AND `Vehicle`='$veh'" );
			$rinco=mysqli_fetch_assoc($incom);
				$inco+=$rinco['Incom'];
    
    // ********************** Search for fuel consumption **************
    $fuel=mysqli_query($conn, "SELECT SUM(`Amount`*`Rate`) AS 'Fuel' FROM `consumption` WHERE `Date` BETWEEN '$std' AND '$end' AND `Status`='0' AND `Vehicle`='$veh'");
			$ruel=mysqli_fetch_assoc($fuel);
				$fue+=$ruel['Fuel'];
				
	// ************************* Search for repair **********************
    $repai=mysqli_query($conn, "SELECT `Number`, `Amount` FROM `repair` WHERE `Date` BETWEEN '$std' AND '$end' AND `Status`='0' AND `Vehicle`='$veh'");
			while($ria=mysqli_fetch_assoc($repai)){
				$rep+=$ria['Amount'];
				$reno=$ria['Number'];
				
	// *********************** Search for services **********************
	$stouse=mysqli_query($conn, "SELECT SUM(`Quantity`*`Price`) AS 'Stou' FROM `stouse` WHERE `Status`!='1' AND `Repair`='$reno' AND `Action`='USED'");
			$rou=mysqli_fetch_assoc($stouse);
				$rep+=$rou['Stou'];
			}
				
						}
					

$ti+=$inco;			$tp+=$trip; 		$tf+=$fue;			$tr+=$rep;	
        
        $tg+=$tars;

	$fuo=number_format($fue, 2);	
	$incoo=number_format($inco, 2);	
	$repo=number_format($rep, 2);	
	$balo=number_format($inco-$fue-$rep, 2);	
	$consu=number_format($fue+$rep, 2);
	$tag=number_format($trip/$tars*100, 2);
				
$stn="style='padding:1px;'";
           
					echo"<tr><td $stn class='text-center'>$n</td>
					<td $stn> $mo </td>
					<td class='text-right' $stn> $year </td>
                        <td $stn>&nbsp; $fna &nbsp; [$foi] </td>
                        <td class='text-right' $stn> $incoo </td>
                        <td class='text-right' $stn> $fuo </td>
						<td class='text-right' $stn> $repo </td>
						<td class='text-right' $stn> $consu </td>
						<td class='text-right' $stn> $balo </td>
						<td class='text-right' $stn> $trip </td>
						<td class='text-right' $stn> $tars </td>
						<td class='text-right' $stn> $tag% </td></tr>";
						$n++;				$t++;					
						}
									
		$tba=number_format($ti-$tf-$tr, 2);					
		$tco=number_format($tf+$tr, 2);	
		$per=number_format($tp/$tg*100, 2);
		$ti=number_format($ti, 2);					
		$tf=number_format($tf, 2);					
		$tr=number_format($tr, 2);				

		?>
                    </tbody><thead> 
		<tr><th> </th><th colspan='3'>&nbsp;&nbsp;Total Amount </th>
			<th class='text-right' style='padding:0px'><?php echo $ti ?></th>
			<th class='text-right' style='padding:0px'><?php echo $tf ?></th>
			<th class='text-right' style='padding:0px'><?php echo $tr ?></th>
			<th class='text-right' style='padding:0px'><?php echo $tco ?></th>
			<th class='text-right' style='padding:0px'><?php echo $tba ?></th>
			<th class='text-right' style='padding:0px'><?php echo $tp ?></th>
			<th class='text-right' style='padding:0px'><?php echo $tg ?></th>
			<th class='text-right' style='padding:0px'><?php echo $per ?>%</th>
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