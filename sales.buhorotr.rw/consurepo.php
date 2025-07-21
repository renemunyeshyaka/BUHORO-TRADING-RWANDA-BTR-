<?php
if(basename($_SERVER['PHP_SELF']) == 'delirepo.php') 
  $cm=" class='current'";
include'header.php';
include'connection.php';
$dato=$datos=$Date;
$conde=$custo='';
$fiva='DAILY';

if(isset($_POST['search']))
		{
			$dato=$_POST['dato'];
			$datos=$_POST['datos'];
			$custo=$_POST['custo'];
			$fiva=$_POST['fiva'];
		}
		
	if($custo=='')
		$conde="";
	elseif($custo=='PRODUCTION A')
		$conde="AND `Destin`='PRODUCTION A'";
	elseif($custo=='PRODUCTION B')
		$conde="AND `Destin`='PRODUCTION B'";
	elseif($custo=='BRANCHES')
		$conde="AND `Destin`!='PRODUCTION A' AND `Destin`!='PRODUCTION B'";
	else
		$conde="AND `Destin`='$custo'";

		if($dato==$datos)
			$mpri="ON $dato";
		else
			$mpri="FROM $dato TO $datos";
		
		if($fiva=='DAILY')
$doi=mysql_query("SELECT *FROM `stouse` WHERE `Date` BETWEEN '$dato' AND '$datos' AND `Status`='0' AND `Action`='TAKEN' AND `Voucher`!='0' AND `Destin` LIKE '%PRODUCTION%' $conde GROUP BY `Voucher` ORDER BY `Voucher` ASC");
		else
$doi=mysql_query("SELECT *FROM `stouse` WHERE `Date` BETWEEN '$dato' AND '$datos' AND `Status`='0' AND `Action`='TAKEN' AND `Voucher`!='0' AND `Destin` LIKE '%PRODUCTION%' $conde GROUP BY `Item` ORDER BY `Item` ASC");
		$fo=mysql_num_rows($doi);
?>
<div class="container-fluid main-content">
        <div class="page-title hidden-print">
          <h2 style='margin-top:-20px; margin-bottom: 5px;'>
         Production Report
          </h2>
                 </div>
     
        <div class="row">
  <div class="col-lg-2 hidden-print">
   
   <ul class="list-group">

    <li class="list-group-item">
	  <a href="prodaily.php">
                <p>
                <i class="lnr lnr-menu-circle"></i>&nbsp;Production Report
                </p>
              </a></li>
			  
	 <li class="list-group-item active">
	  <a href="consurepo.php">
                <p>
                <i class="lnr lnr-menu-circle"></i>&nbsp;Consumption Report
                </p>
              </a></li>
	
	<li class="list-group-item">
	  <a href="prodispatch.php">
                <p>
                <i class="lnr lnr-menu-circle"></i>&nbsp;Dispatch Report
                </p>
              </a></li> 
			  
	<li class="list-group-item">
	  <a href="suarepo.php">
                <p>
                <i class="lnr lnr-menu-circle"></i>&nbsp;Item Used Report
                </p>
              </a></li>

	 <li class="list-group-item">
	  <a href="prorepo.php">
                <p>
                <i class="lnr lnr-menu-circle"></i>&nbsp;Configuration Report
                </p>
              </a></li> 

	 <li class="list-group-item">
	  <a href="#">
                <p>
                <i class="lnr lnr-menu-circle"></i>&nbsp;Control Report
                </p>
              </a></li> 
                         
            </ul>
  </div>
                    
           
           
       
        <div class="col-lg-10">
                  <div class="row">
         
           <div class="col-lg-2"> </div>
          
         
           

        <form action="" method="post" class="form-horizontal ">                  
                       <div class="col-lg-10 hidden-print"><div class="col-lg-2"> 
	<select class="form-control" name="fiva" required>
			  
			   <?php
			   if($fiva=='DAILY')
			echo"<option value='DAILY'> DAILY </option><option value='TOTAL'> TOTAL </option>";
				else
			echo"<option value='TOTAL'> TOTAL </option><option value='DAILY'> DAILY </option>";
			?>    
                            </select>
		   
		   </div>  
		   
		   <div class="col-lg-2"> 
					   
			   <select class="form-control" name="custo">
			<?php
			if($custo=='PRODUCTION A')
					$p='selected';
				else
					$p='';

if($custo=='PRODUCTION B')
					$pe='selected';
				else
					$pe='';

				echo"<option value='' selected='selected'> SELECT DESTINATION </option>
				<option value='PRODUCTION A' $p> SNACKS </option><option value='PRODUCTION B' $pe> BAKERY </option>";
	/*		
	$dois=mysql_query("SELECT `Name` FROM `branches` ORDER BY `Number` ASC");
			while($rois=mysql_fetch_assoc($dois)){
				$fna=$rois['Name'];
				if($custo==$fna)
					$t='selected';
				else
					$t='';
			echo"<option value='$fna' $t> $fna </option>";
			}
			*/
			?>		</select>
					   
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

			<div class="divFooter"><center><u><b>CONSUMPTION REPORT <?php echo $mpri ?></b></u></center></div>
             <div class="row">
            <div class="col-lg-12">
             <span>Total Records Found : <b><?php echo" $fo " ?></b></span>
			 <span class="pull-right hidden-print"><b>PRODUCTION</b>
			 &nbsp;&nbsp;&nbsp;&nbsp;<a href="#" onclick="return window.print()" class="hidden-print" title='Click to print' data-toggle='tooltip' data-placement='top'><i class="lnr lnr-printer hidden-print"></i></a></span>
            <div class="widget-container fluid-height clearfix">
            <div class="widget-content padded clearfix">
               
			   <?php
			   if($fiva=='DAILY'){
$gto=0;
			   while($roi=mysql_fetch_assoc($doi)){
				$vous=$roi['Voucher'];
	$do=mysql_query("SELECT *FROM `stouse` WHERE `Voucher` = '$vous' AND `Status`='0' AND `Action`='TAKEN'");
				?>
                                 <table class="table table-striped table-hover">     
                                      <thead>
                     <tr role="row">
                     <th class="hidden-xs"> No </th> 
                       <th> Due&nbsp;Date </th>
                       <th> Destination </th>
                       <th> Taken&nbsp;by </th>
                       <th> Item&nbsp;Name </th>
                        <th> Description </th>
						 <th> Price/Unit </th>
						 <th colspan='2'> Quantity </th>
                       <th><div align='right'> Total&nbsp;Amount&nbsp;</th>
                     </tr>
                    </thead>
                                        <tbody>
					<?php
					$n=1;				$tp=0;	
						while($ro=mysql_fetch_assoc($do)){
				$code=$ro['Number'];
				$item=$ro['Item'];			
			$cost=$ro['Cost'];			$costo=number_format($cost, 2);
			$qt=$ro['Quantity'];
			$dte=$ro['Date'];
			$type=$ro['Destin'];
			$pers=$ro['Person'];
			$vouc=$ro['Voucher'];

			if($type=='PRODUCTION'){
			$pri=$ro['Cost'];				
			$prio=number_format($pri, 2);
			}
			else{
			$pri=$ro['Price'];				
			$prio=number_format($pri, 2);
			}

	$dov=mysql_query("SELECT *FROM `items` WHERE `Number`='$item' ORDER BY `Number` DESC LIMIT 1");
		$rov=mysql_fetch_assoc($dov);
			$kin=$rov['Type'];
			$descri=$rov['Descri'];
			$uno=$rov['Unit'];
			$iname=$rov['Iname'];

			$stn="padding:1px;";	

				$dox=mysql_query("SELECT *FROM `unit` WHERE `Number`='$uno' ORDER BY `Number` ASC");
					$rox=mysql_fetch_assoc($dox);
							$unit=$rox['Unit'];

	$tot=$qt*$pri;

         $toto=number_format($tot, 2);					
									$qty=number_format($qt, 2);
		print("<tr>
          <td class='hidden-xs' style='$stn'><div align='center'>$n&nbsp;&nbsp;</td>
			<td style='$stn'> $dte </td><td style='$stn'> $type </td><td style='$stn'> $pers </td>
			<td style='$stn'> $iname </td><td style='$stn'> $descri </td><td style='$stn'><div align='right'> $prio &nbsp;&nbsp; </td>
				<td style='$stn'><div align='right'> $qty </td><td> $unit </td><td style='$stn'><div align='right'> $toto </td></tr>");
						  $n++;					$tp+=$tot;
						}
						$tpo=number_format($tp, 2);			
						?>
						
                     </tbody><thead>
					<tr><form action='delidoc.php' method='post' target='_blank'><th class='hidden-xs'>
					<?php
						 echo"<input type='hidden' name='vous' value='$vous'>";
						?>
                          <button type='submit' class='btn btn-xs btn-success hidden-print' name='open' style='height:18px; padding:0px; margin:0px;' title='Click to open delivery voucher' data-toggle='tooltip' data-placement='top'>
						  &nbsp;&nbsp;<i class='lnr lnr-download'></i>&nbsp;&nbsp;</button>
					 </th></form>

					 <form action='taken.php' method='post'><th>
					<?php
			$dor=mysql_query("SELECT *FROM `stouse` WHERE `Status`='0' AND `Voucher`='0' AND `Action`='TAKEN' ORDER BY `Number` DESC");
				if($for=mysql_num_rows($dor) OR $type=='PRODUCTION A' OR $type=='PRODUCTION B'){
		echo"<input type='hidden' name='vous' value='$vous'>						
                         <button type='button' class='btn btn-xs btn-warning hidden-print' name='edivo' style='height:18px; padding:0px; margin:0px;' title='Not allowed at this moment' data-toggle='tooltip' data-placement='top' disabled>
						  &nbsp;&nbsp;<i class='lnr lnr-pencil'></i>&nbsp;&nbsp;</button>";
				}
				else{
						 echo"<input type='hidden' name='vous' value='$vous'>						
                         <button type='button' class='btn btn-xs btn-warning hidden-print' name='edivo' style='height:18px; padding:0px; margin:0px;' title='Click to edit this delivery' data-toggle='tooltip' data-placement='top' disabled>
						  &nbsp;&nbsp;<i class='lnr lnr-pencil'></i>&nbsp;&nbsp;</button>";
				}
					?>
					 </th></form>

					<th colspan='5'><div align='center'> Total Amount </th>
					<th> </th><th colspan='2'><div align='right'><?php echo $tpo ?></th></tr>
                  </table><br>
				  <?php
$gto+=$tp;
			   }

$gto=number_format($gto, 2);
if($fo>='2'){
					 ?> 
<table class="table table-striped table-hover">     
                                      <thead>
                     <tr role="row">
                     <th class="hidden-xs" width='5%'> </th> 
<th><div align='right'> Grand Total </th>
					<th width='5%'> </th><th width='10%'><div align='right'><?php echo $gto ?></th>
</tr></table> 
<?php
}
			   }
			   else{
				?>
                                 <table class="table table-striped table-hover">     
                                      <thead>
                     <tr role="row">
                     <th class="hidden-xs"> No </th> 
                       <th> Due&nbsp;Date </th>
                       <th> Destination </th>
                       <th> Taken&nbsp;by </th>
                       <th> Item&nbsp;Name </th>
                        <th> Description </th>
						 <th> Price/Unit </th>
						 <th colspan='2'><div align='center'> Quantity </th>
                       <th><div align='right'> Total&nbsp;Amount&nbsp;</th>
                     </tr>
                    </thead>
                                        <tbody>
	<?php
					$tp=0;		$n=1;
 while($roi=mysql_fetch_assoc($doi)){
				$item=$roi['Item'];
	$do=mysql_query("SELECT *FROM `stouse` WHERE `Item` = '$item' AND `Date` BETWEEN '$dato' AND '$datos' AND `Status`='0' AND `Action`='TAKEN' AND `Voucher`!='0' AND `Destin` LIKE '%PRODUCTION%' $conde");
					
									$tot=$qty=0;	
						while($ro=mysql_fetch_assoc($do)){
				$code=$ro['Number'];
				$item=$ro['Item'];			
			$cost=$ro['Cost'];			//$costo=number_format($cost, 2);
			$qt=$ro['Quantity'];
			$dte=$ro['Date'];
			$type=$ro['Destin'];
			$pers=$ro['Person'];
			$vouc=$ro['Voucher'];

			if($type=='PRODUCTION'){
			$pri=$ro['Cost'];				
			//$prio=number_format($pri, 2);
			}
			else{
			$pri=$ro['Price'];				
		//	$prio=number_format($pri, 2);
			}

	$dov=mysql_query("SELECT *FROM `items` WHERE `Number`='$item' ORDER BY `Number` DESC LIMIT 1");
		$rov=mysql_fetch_assoc($dov);
			$kin=$rov['Type'];
			$descri=$rov['Descri'];
			$uno=$rov['Unit'];
			$iname=$rov['Iname'];

			$stn="padding:1px;";	

				$dox=mysql_query("SELECT *FROM `unit` WHERE `Number`='$uno' ORDER BY `Number` ASC");
					$rox=mysql_fetch_assoc($dox);
							$unit=$rox['Unit'];

	$tot+=$qt*$pri;
	$qty+=$qt;
						}

         $toto=number_format($tot, 2);					$prio=number_format($tot/$qty, 2);					$qty=number_format($qty, 2);			
		print("<tr><td class='hidden-xs' style='$stn'><div align='center'>$n&nbsp;&nbsp;</td>
			<td style='$stn'> $dte </td><td style='$stn'> $type </td><td style='$stn'> $pers </td>
			<td style='$stn'> $iname </td><td style='$stn'> $descri </td><td style='$stn'><div align='right'> $prio &nbsp;&nbsp; </td>
				<td style='$stn'><div align='right'> $qty </td><td> $unit </td><td style='$stn'><div align='right'> $toto </td></tr>");
						  $n++;					$tp+=$tot;
						}
						$tpo=number_format($tp, 2);	
		echo"</tbody><thead><tr><th colspan='8'><div align='center'> TOTAL AMOUNT </th><th colspan='2'><div align='right'> $tpo </th></tr></table>";
			   }



?>                
              </div>
            </div></div>
                  </div>                    
                <span class="pull-right hidden-print">
			 &nbsp;&nbsp;&nbsp;&nbsp;<a href="#" onclick="return window.print()" class="hidden-print" title='Click to print' data-toggle='tooltip' data-placement='top'><i class="lnr lnr-printer"></i></a></span>
      
   </div></div></div> 
    
   <?php
   include'footer.php';
   ?>
