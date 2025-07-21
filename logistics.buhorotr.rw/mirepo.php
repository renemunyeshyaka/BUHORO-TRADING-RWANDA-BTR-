<?php
if(basename($_SERVER['PHP_SELF']) == 'mirepo.php') 
  $cm=" class='current'";
$custo=$conde='';
include'connection.php';
$dato=$datos=$Date;
$p=0;

include'header.php';

if(isset($_POST['search']))
		{
			$custo=$_POST['custo'];
			$dato=$_POST['dato'];
			$datos=$_POST['datos'];
				$p=1;
		}

if($p==1){
        $conde="AND `Date` BETWEEN '$dato' AND '$datos'";
    if($custo AND $dato==$Date AND $datos==$Date)
        $conde="AND `Plate` LIKE '%$custo%'";
        
    if($custo AND ($dato!=$Date OR $datos!=$Date))
        $conde="AND `Plate` LIKE '%$custo%' AND `Date` BETWEEN '$dato' AND '$datos'";
}
	

        if($dato==$datos)
			$mpri="ON $dato";
		else
			$mpri="FROM $dato TO $datos";
?>

<div class="container-fluid main-content">
        <div class="page-title hidden-xs hidden-print">
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

    <li class="list-group-item active">
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

    <li class="list-group-item">
	  <a href="trepo.php">
                <p>
                <i class="lnr lnr-menu-circle"></i>&nbsp;Target  Report
                </p>
              </a></li>     
                       
            </ul><br><br>

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
				$fna=$roi['Plate'];
				if($fna==$custo)
					$sle="selected";
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
		$do=mysqli_query($conn, "SELECT *FROM `repair` WHERE (`Trip`!='0' AND `Status`='0' AND `Garage`='ROAD TALL' AND `Rate`>='1' $conde) OR (`Trip`!='0' AND `Status`='0' AND `Garage`='MILEAGE' AND `Rate`>='1' $conde) GROUP BY `Trip`, `Type` ORDER BY `Date` ASC");
		        else
		$do=mysqli_query($conn, "SELECT *FROM `repair` WHERE (`Trip`!='0' AND `Status`='0' AND `Garage`='ROAD TALL' AND `Rate`>='1') OR (`Status`='0' AND `Garage`='MILEAGE' AND `Rate`>='1') GROUP BY `Trip`,  `Type` ORDER BY `Number` DESC LIMIT 15");
				if($fo=mysqli_num_rows($do)){
				?>
                 
            <div class="divFooter"><center><u><b>MILEAGE REPORT <?php echo $mpri ?></b></u></center></div>
             <div class="row">
            <div class="col-lg-12">
             <span> &nbsp;&nbsp; Total Records Found : <b><?php echo" $fo " ?></b></span>
			 <span class="pull-right hidden-print">&nbsp;&nbsp;
			 <a href="#" onclick="return window.print()" class="hidden-print" title='Click to print' data-toggle='tooltip' data-placement='top'>
			 <i class="lnr lnr-printer"></i></a></span>
			 
			 <span class="pull-right hidden-print">
		&nbsp;&nbsp;&nbsp;&nbsp;<a href="#" id="exporttable" class="hidden-print" title='Export to excell' data-toggle='tooltip' data-placement='top'><i class="lnr lnr-line-spacing"></i></a></span>
            <div class="widget-container fluid-height clearfix">
            <div class="widget-content padded clearfix">

				<table class="table table-striped table-hover" id="htmltable">     
                                      <thead>
                    <tr role="row">
                     <th width="1%" style='padding:1px; text-align:center'> No </th>
					 <th width='8%'><div align='center'> Date </th>
		<th style='padding:1px;'><div align='center'> Plate </th>
		<th style='padding:1px;'><div align='center'> Driver </th>
			<th style='padding:1px;'><div align='center'> Destination </th>
			<th style='padding:1px;'><div align='center'> Income </th>
<th style='padding:1px;'><div align='center'> Road&nbsp;Toll </th>
			<th style='padding:1px;'><div align='center'> Mileage </th>
			<th style='padding:1px;'><div align='center'>&nbsp;&nbsp;Rate&nbsp;&nbsp;</th>
			<th style='padding:1px;'><div align='center'> Value </th>
			<th style='padding:1px;'><div align='center'> Paid </th>
			<th style='padding:1px;'><div align='center'> Balance </th>
                     </tr>
                    </thead>
                                        <tbody>
					<?php
			$i=1;		            	$tra=$tmi=$tpa=$tinco=$rt=$tba=0;
	while($ro=mysqli_fetch_assoc($do)){
				$nuo=$ro['Number'];
				$trip=$ro['Trip'];
				$dte=$ro['Date'];
				$pla=$ro['Plate'];
				$typ=$ro['Type'];

                // *********************** Trip record **********************
		$dois=mysqli_query($conn, "SELECT *FROM `trips` WHERE `Number`='$trip' ORDER BY `Number` ASC");
			$rois=mysqli_fetch_assoc($dois);
				$etd=$rois['ETD'];
				$des=$rois['Location'];
				$dri=$rois['Driver'];
				$fni=$rois['Final'];
				$roa=$mil=$pay=$inco=0;
				
		        // ******************* Road Toll & Mileage ******************
		$dois=mysqli_query($conn, "SELECT `Amount`, `Garage`, `Driver`, `Rate`, `Issue` FROM `repair` WHERE `Date`='$dte' AND `Status`='0' AND `Trip`='$trip' AND `Type`='$typ' AND (`Garage`='ROAD TOLL' OR `Garage`='MILEAGE' OR `Garage`='OTHER EXPENSE') ORDER BY `Number` ASC");
			    while($rois=mysqli_fetch_assoc($dois)){
			        $issue=$rois['Issue'];
			        $rate=$rois['Rate'];
				    if($rois['Garage']=='ROAD TOLL')
				$roa+=$rois['Amount']/$rate;
				    elseif($rois['Garage']=='MILEAGE')
				$mil+=$rois['Amount']/$rate;
				    else
				        $roa=$mil=0;
				
				if(!$dri)
				    $dri=$rois['Driver'];
			    }
			            $pa=0;
		$doz=mysqli_query($conn, "SELECT SUM(`Amount`) AS `Income` FROM `income` WHERE `Status`='0' AND `Trip`='$trip' ORDER BY `Number` DESC");
		                $roz=mysqli_fetch_assoc($doz);
			                $inco=$roz['Income'];
			      
		// ****************** Paid Amount **********************          
			 $_SESSION['Base']="jblgroup_sales";
			        include'sales.php';
	
	        $pch=mysqli_query($cons, "SELECT SUM(`Amount`) AS `Paid` FROM `mileage` WHERE `Trip`='$trip' AND `Status`='0' AND `Amount`>'0' ORDER BY `Number` ASC");
	                if($fch=mysqli_num_rows($pch)){
	                    $rch=mysqli_fetch_assoc($pch);
	                        $pa=$rch['Paid'];
	                            }
	                            if($rate=='1')
	                                $pa=0;
			    if($issue)
			            $deso="$issue";
			    else
			            $deso="$des - $fni";
						$roao=number_format($roa, 2);
						$milo=number_format($mil, 2);
						$rateo=number_format($rate, 2);
						$incoo=number_format($inco, 2);
						$to=$roa+$mil;
						$too=number_format($to, 2);
						$bal=$to-$pa;
						$balo=number_format($bal, 2);
						$pao=number_format($pa, 2);
						
			            if($typ==1)
					$stl="padding:1px; font-size:13px; color:blue;";
			            else
					$stl="padding:1px; font-size:13px;";
					
					if($rate=='1')
				        $too=$to=0;


	print("<tr><td style='$stl $clr'><div align='right'> &nbsp;$i&nbsp; </td>
	<td style='$stl $clr'><div align='center'> $dte </td>
	<td style='$stl $clr'> $pla </td><td style='$stl $clr'> $dri </td>
	<td style='$stl $clr'> $deso </td>
	<td style='$stl $clr'><div align='right'> $incoo </td>
	<td style='$stl $clr'><div align='right'> $roao </td>
	<td style='$stl $clr'><div align='right'> $milo </td>
	<td style='$stl $clr'><div align='right'> $rateo </td>
	<td style='$stl $clr'><div align='right'> $too </td>
	<td style='$stl $clr'><div align='right'> $pao </td>
	<td style='$stl $clr'><div align='right'> $balo </td></tr>");
	
	$i++;			$tra+=$roa;         $tmi+=$mil;                $tpa+=$pa;
	$tinco+=$inco;                       $rt+=$to;              $tba+=$bal;
						}
			
			$rto=number_format($rt, 2);
			$tra=number_format($tra, 2);
			$tmi=number_format($tmi, 2);
			$tpa=number_format($tpa, 2);
			$tinco=number_format($tinco, 2);
			$tba=number_format($tba, 2);
						?>
						
                    </tbody>
					 <thead>
	<tr><th> </th><th colspan='4'><div align='center'> Total Amount </th>
                <th style="padding-right:1px;"><div align='right'><?php echo $tinco ?></th>
                <th style="padding-right:1px;"><div align='right'><?php echo $tra ?></th>
                <th style="padding-right:1px;"><div align='right'><?php echo $tmi ?></th>
                <th style="padding-right:1px;"><div align='center'> -- </th>
                <th style="padding-right:1px;"><div align='right'><?php echo $rto ?></th>
                <th style="padding-right:1px;"><div align='right'><?php echo $tpa ?></th>
                <th style="padding-right:1px;"><div align='right'><?php echo $tba ?></th></tr>
                  </table>
                  
								</div></div>
								<span class="pull-right hidden-print">
			 &nbsp;&nbsp;<a href="#" onclick="return window.print()" class="hidden-print" title='Click to print' data-toggle='tooltip' data-placement='top'><i class="lnr lnr-printer"></i></a></span>
			 <br><br><br>  

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