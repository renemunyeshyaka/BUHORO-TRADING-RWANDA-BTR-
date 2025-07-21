<?php
if(basename($_SERVER['PHP_SELF']) == 'trepo.php') 
$cm=" class='current'";
include'header.php';
include'connection.php';
$conde=$condi='';
$custo=date("F");
$year=date("Y");
$start=$year-3;

// search for an item to be added to the chart
if(isset($_POST['search']))
		{
			$year=$_POST['year'];
			$custo=$_POST['custo'];
		}
	
	
		$m = date("m", strtotime($custo, '01'));
			$mpri="FOR $custo / $year";
			
		$std="$year-$m-01";             $end="$year-$m-31";

		
		// ******************* Select vehicle ****************
$doi=mysqli_query($conn, "SELECT `vehicles`.`Number`, `vehicles`.`Plate`, `vehicles`.`Driver` FROM `vehicles` INNER JOIN `trips` ON `vehicles`.`Number` = `trips`.`Vehicle` WHERE `vehicles`.`Trip`='1' AND `vehicles`.`Status`='0' AND `trips`.`Status`='0' GROUP BY `vehicles`.`Plate` ORDER BY `vehicles`.`Plate` ASC");
        $foi=mysqli_num_rows($doi);
            $n=1;

?>
<div class="container-fluid main-content">
        <div class="page-title hidden-print">
          <h2 style='margin-top:-20px; margin-bottom: 5px; color:#ffcc33'>
         Trip Report
          </h2>
  
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

    <li class="list-group-item active">
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

				  <div class="col-lg-2"> </div>         

                     <div class="col-lg-2 hidden-print"> </div> 
							
                       <div class="col-lg-8 hidden-print">
        <div class="col-lg-3 hidden-print"> </div><div class="col-lg-4">
	<select class="form-control" name="custo" required>
              <?php
    for ($i = 1; $i < 13;   $i++) {
     $date_str = date("F", mktime(0, 0, 0, $i, 10));
	if($date_str==$custo)
		$st='selected';
	else
		$st='';
    echo "<option value='$date_str' $st>".$date_str ."</option>";
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
					<div class="divFooter"><center><u><b>TARGET REPORT <?php echo"$mpri $std $end"; ?></b></u></center></div>
		 <div class="row">
            <div class="col-lg-12">
             <span> &nbsp;&nbsp; Total Records Found : <b><?php echo" $foi " ?></b></span>
			 <span class="pull-right">
			     &nbsp;&nbsp;<a href="#" onclick="return window.print()" class="hidden-print" title='Click to print' data-toggle='tooltip' data-placement='top'><i class="lnr lnr-printer"></i></a></span>
			 
			  <span class="pull-right hidden-print">
		&nbsp;&nbsp;&nbsp;&nbsp;<a href="#" id="exporttable" class="hidden-print" title='Export to excell' data-toggle='tooltip' data-placement='top'><i class="lnr lnr-line-spacing"></i></a></span>
            <div class="widget-container fluid-height clearfix">
            <div class="widget-content padded clearfix">

			 <table class="table table-striped table-hover" id="htmltable">     
                                      <thead>
                    <tr role="row">
                     <th class="text-center"> No </th> 
                       <th class="text-center"> Vehicle </th>
                       <th class="text-center"> Driver </th>
                        <th class="text-center"> Income </th>
                        <th class="text-center"> Fuel </th>
                        <th class="text-center"> Services </th> 
						 <th class="text-center"> Consumption </th> 
                        <th class="text-center"> Balance </th> 
                        <th class="text-center"> Trips </th> 
                        <th class="text-center"> Target </th> 
                        <th class="text-center"> Perc.&nbsp;(%) </th>
                        
                        </tr></thead>
                                        <tbody>
					<?php
                        $ti=$tf=$ts=$tr=$tg=0;
			while($roi=mysqli_fetch_assoc($doi)){
				$pla=$roi['Plate'];
				$veh=$roi['Number'];
				$dri=$roi['Driver'];
				$rep=$inco=$fue=0;
				
    // ********************** Search for trips *******************
    $tris=mysqli_query($conn, "SELECT `Number` FROM `trips` WHERE `Date` BETWEEN '$std' AND '$end' AND `Status`='0' AND `Vehicle`='$veh' ORDER BY `Number` DESC");
            $trip=mysqli_num_rows($tris);
				
    // ********************** Search for income *******************
    $incom=mysqli_query($conn, "SELECT SUM(`Amount`*`Rate`) AS 'Incom' FROM `income` WHERE `Date` BETWEEN '$std' AND '$end' AND `Status`='0' AND `Vehicle`='$veh'");
			$rinco=mysqli_fetch_assoc($incom);
				$inco=$rinco['Incom'];
    
    // ********************** Search for fuel consumption ***************
    $fuel=mysqli_query($conn, "SELECT SUM(`Amount`*`Rate`) AS 'Fuel' FROM `consumption` WHERE `Date` BETWEEN '$std' AND '$end' AND `Status`='0' AND `Vehicle`='$veh'");
			$ruel=mysqli_fetch_assoc($fuel);
				$fue=$ruel['Fuel'];
			
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

        $ti+=$inco;					$tf+=$fue;					$ts+=$rep;	
                        $tr+=$trip;                 $tg+=$targ;

	$fuo=number_format($fue, 2);	
	$incoo=number_format($inco, 2);	
	$repo=number_format($rep, 2);	
	$balo=number_format($inco-$fue-$rep, 2);	
	$consu=number_format($fue+$rep, 2);	
	$tba=number_format($trip/$targ*100, 2);     
	$stn="style='padding:1px;'";
           
	echo"<tr><td $stn class='text-center'>$n</td>
        <td $stn> $pla </td><td $stn> $dri </td>
        <td class='text-right' $stn> $incoo </td>
            <td class='text-right' $stn> $fuo </td>
			<td class='text-right' $stn> $repo </td>
			<td class='text-right' $stn> $consu </td>
			<td class='text-right' $stn> $balo </td>
			<td class='text-right' $stn> $trip </td>
			<td class='text-right' $stn> $targ </td>
			<td class='text-right' $stn> $tba% </td></tr>";
						$n++;				
						}
									
		$tba=number_format($ti-$tf-$ts, 2);					
		$tco=number_format($tf+$ts, 2);				
		$ti=number_format($ti, 2);					
		$tf=number_format($tf, 2);					
		$ts=number_format($ts, 2);
		$bas=number_format($tr/$tg*100, 2);

		?>
                    </tbody><thead> 
		<tr><th colspan='3' class='text-center'> Total Amount </th>
			<th class='text-right' style='padding:0px'><?php echo $ti ?></th>
			<th class='text-right' style='padding:0px'><?php echo $tf ?></th>
			<th class='text-right' style='padding:0px'><?php echo $ts ?></th>
			<th class='text-right' style='padding:0px'><?php echo $tco ?></th>
			<th class='text-right' style='padding:0px'><?php echo $tba ?></th>
			<th class='text-right' style='padding:0px'><?php echo $tr ?></th>
			<th class='text-right' style='padding:0px'><?php echo $tg ?></th>
			<th class='text-right' style='padding:0px'><?php echo $bas ?>%</th>
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