<?php
if(basename($_SERVER['PHP_SELF']) == 'verepos.php') 
$cm=" class='current'";
include'header.php';
include'connection.php';
$custo='';
$conde='';

$date = strtotime("+10 days", strtotime("$Date"));
$date = date ("Y-m-d", $date);

if(isset($_POST['search']))
		{
			$custo=$_POST['custo'];
		}

		if($custo)
			$conde="AND (`Plate` LIKE '%$custo%' OR `Make` LIKE '%$custo%')";

$do=mysqli_query($conn, "SELECT *FROM `vehicles` WHERE `Status`='0' AND `Trip`='0' $conde ORDER BY `Number` ASC LIMIT 100");
$fo=mysqli_num_rows($do);
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

    <li class="list-group-item active">
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
                    
           
           
       
        <div class="col-lg-10">
                  <div class="row">
         
           <div class="col-lg-6"> </div>
          
         
           

        <form action="" method="post" class="form-horizontal ">                  
                       
            <div class="col-lg-3 hidden-xs hidden-print"> 
      <input class="form-control"  name="custo" type="text" id="search" autofocus="autofocus">
			</div>                      
                       
                       <div class="col-lg-2 hidden-xs hidden-print">
                        <button class="btn  btn-primary btn-block" type="submit" name="search"><i class="lnr lnr-magnifier"></i> Search</button>
                   
					  </div>
                         
                      
                     
                  
            </form> 
             
               
            </div>
             <div class="row">
            <div class="col-lg-12" style='margin-top:-20px;'>
             <span> &nbsp;&nbsp; Total Records Found : <b><?php echo" $fo " ?></b></span> 
			 <span class="pull-right"><a href="#" onclick="return window.print()" class="hidden-print" title='Click to print' data-toggle='tooltip' data-placement='top'><i class="lnr lnr-printer"></i></a></span>
            <div class="widget-container fluid-height clearfix">
            <div class="widget-content padded clearfix">
               
                                 <table class="table table-striped table-hover">     
                                      <thead>
                    <tr role="row">
                     <th class="hidden-xs"> NO </th>
                        <th><div align='center'> VEHICLE&nbsp;ID </th>
                       <th><div align='center'> MAKE </th>
                       <th><div align='center'> MODEL </th>
					   <th><div align='center'> CHASSIS </th>
						 <th><div align='center'> YEAR </th>
						 <th><div align='center'> FUEL </th>
						 <th><div align='center'> SOURCE </th>
							<th><div align='center'>INSURANCE</th>
							<th><div align='center'>INSPECTION</th>
							<th><div align='center'>PERMIT&nbsp;[SG]</th>
							<th><div align='center'>PERMIT&nbsp;[TP]</th>
                     </tr>
                    </thead>
                                        <tbody>
					<?php
					$n=1;				$to=0;
						while($ro=mysqli_fetch_assoc($do)){
				$code=$ro['Number'];
			$make=$ro['Make'];
			$mode=$ro['Mode'];
			$chassis=$ro['Chassis'];
			$year=$ro['Year'];

			$fuel=$ro['Fuel'];
			$vid=$ro['Plate'];
			$source=$ro['Source'];
			$driver=$ro['Driver'];
			
	$upd=mysqli_query($conn, "UPDATE `trips` SET `Driver`='$driver' WHERE `Vehicle`='$code' AND `Driver`=''");

			$dois=mysqli_query($conn, "SELECT `Start`, `Ending` FROM `inspection` WHERE `Vehicle`='$code' ORDER BY `Ending` DESC LIMIT 1");
				$rois=mysqli_fetch_assoc($dois);
					$insp=$rois['Ending'];
					$insps=$rois['Start'];

					if($insp<=$date)
						$sinsp="style='color:red'";
					else
						$sinsp="";

				$doih=mysqli_query($conn, "SELECT `Start`, `Ending` FROM `insurance` WHERE `Vehicle`='$code' ORDER BY `Ending` DESC LIMIT 1");
					$roih=mysqli_fetch_assoc($doih);
						$insu=$roih['Ending'];
						$insus=$roih['Start'];

						if($insu<=$date)
						$sinsu="style='color:red'";
					else
						$sinsu="";

		$doit=mysqli_query($conn, "SELECT `Start`, `Ending` FROM `permit` WHERE `Vehicle`='$code' AND `Type` LIKE '%SPEED%' ORDER BY `Ending` DESC LIMIT 1");
			$roit=mysqli_fetch_assoc($doit);
				$speed=$roit['Ending'];
				$speeds=$roit['Start'];

				if($speed<=$date)
						$sspeed="style='color:red'";
					else
						$sspeed="";

		$doil=mysqli_query($conn, "SELECT `Start`, `Ending` FROM `permit` WHERE `Vehicle`='$code' AND `Type` LIKE '%TRANSPORT%' ORDER BY `Ending` DESC LIMIT 1");
			$roil=mysqli_fetch_assoc($doil);
				$trans=$roil['Ending'];
				$transs=$roil['Start'];

				if($trans<=$date)
						$strans="style='color:red'";
					else
						$strans="";

						$stn="style='padding:1px; font-size:12px;'";
		 
		print("<tr><td class='hidden-xs' $stn><div align='right'>$n&nbsp;&nbsp;</td>
				<td $stn><div align='center'> $vid </td><td $stn> $make </td><td $stn> $mode </td><td $stn> $chassis </td>
				<td $stn><div align='center'> $year </td><td $stn><div align='left'> $fuel </td><td $stn><div align='center'> $source </td>
				<td style='padding:0px;' title='From: $insus    To: $insu'><div align='center' $sinsu>$insu</td>
				<td style='padding:0px;' title='From: $insps    To: $insp'><div align='center' $sinsp>$insp</td>
				<td style='padding:0px;' title='From: $speeds    To: $speed'><div align='center' $sspeed>$speed</td>
				<td style='padding:0px;' title='From: $transs    To: $trans'><div align='center' $strans>$trans</td></tr>");
							$n++;			
					}				
						?>
						
                    </tbody>
                  </table>      
                
              </div>
            </div></div>
                  </div>

				   <span class="pull-right hidden-print">
			 &nbsp;&nbsp;&nbsp;&nbsp;<a href="#" onclick="return window.print()" class="hidden-print" title='Click to print' data-toggle='tooltip' data-placement='top'><i class="lnr lnr-printer"></i></a></span>
      
   </div></div></div>  
   <?php
   include'footer.php';
   ?>
