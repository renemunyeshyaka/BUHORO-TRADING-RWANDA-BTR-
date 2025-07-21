<?php
if(basename($_SERVER['PHP_SELF']) == 'brecive.php') 
  $bb=" class='current'";
include'header.php';
include'connection.php';
$dato=$datos=$Date;
$conde='';
$custo='DAILY';
 $brc=$_SESSION['BR'];	
$brancho=$_SESSION['Branche'];
$brc=$_SESSION['Branche'];

 $doib=mysql_query("SELECT `Name` FROM `branches` WHERE `Number`='$brc' ORDER BY `Number` ASC");
			$roib=mysql_fetch_assoc($doib);
				$bra=$roib['Name'];

$fld="S$brc";			

if(isset($_POST['search']))
		{
			$dato=$_POST['dato'];
			$brc=$_POST['brc'];
			$datos=$_POST['datos'];
			$custo=$_POST['custo'];
		}

	if($brc=='' OR $brc=='0')
		$conde='';
	else	
		$conde="AND `Destin`='$brc'";

		if($dato==$datos)
			$mpri="ON $dato";
		else
			$mpri="FROM $dato TO $datos";

if($custo=='DAILY'){
$doi=mysql_query("SELECT *FROM `stouse` WHERE `Date` BETWEEN '$dato' AND '$datos' AND `Status`='0' AND `Action`='BRANCHEP' AND `Voucher`!='0' $conde GROUP BY `Voucher` ORDER BY `Voucher` ASC");
}
else{
$doi=mysql_query("SELECT *FROM `stouse` WHERE `Date` BETWEEN '$dato' AND '$datos' AND `Status`='0' AND `Action`='BRANCHEP' AND `Voucher`!='0' $conde GROUP BY `Item` ORDER BY `Voucher` ASC");
}
$fo=mysql_num_rows($doi);
?>
<div class="container-fluid main-content">
        <div class="page-title hidden-print">
          <h2 style='margin-top:-20px; margin-bottom: 5px;'>
         Branches Report
          </h2>
                 </div>
     
        <div class="row">
  <div class="col-lg-2 hidden-print">
   
 <ul class="list-group">

    <li class="list-group-item">
	  <a href="sarepo.php">
                <p>
                <i class="lnr lnr-menu-circle"></i>&nbsp;Sales Report
                </p>
              </a></li>    

    <li class="list-group-item">
	  <a href="surepo.php">
                <p>
                <i class="lnr lnr-menu-circle"></i>&nbsp;Item Used Report
                </p>
              </a></li> 

<li class="list-group-item active">
	  <a href="preceive.php">
                <p>
                <i class="lnr lnr-menu-circle"></i>&nbsp;Purchase Report
                </p>
              </a></li> 

	 <li class="list-group-item">
	  <a href="brarepo.php">
                <p>
                <i class="lnr lnr-menu-circle"></i>&nbsp;Config Report
                </p>
              </a></li>  

	 <li class="list-group-item">
	  <a href="stobrarepo.php">
                <p>
                <i class="lnr lnr-menu-circle"></i>&nbsp;Store Report
                </p>
              </a></li> 
                         
            </ul>
  </div>
                    
                    
           
           
       
        <div class="col-lg-10">
                  <div class="row">
         
           <div class="col-lg-2"> </div>
          
         
           

        <form action="" method="post" class="form-horizontal ">                  
                       <div class="col-lg-10 hidden-print"><div class="col-lg-2"> 
					   <?php
					   if($custo=='DAILY'){
						   $d='selected';
						   $t='';
		}
		else{
			$t='selected';
			$d='';
		}
		?>
			   <select class="form-control" name="custo">
				<option value='DAILY' <?php echo $d ?>> DAILY </option>
				<option value='TOTAL' <?php echo $t ?>> TOTAL </option></select>
					   
					   </div><div class="col-lg-2"> 
		<select class="form-control" name="brc" style='padding-right:5px;'>
			   <?php
if($brancho)
echo"<option value='$brancho' selected> $brancho </option>";
else{
echo"<option value='0' selected='selected'> SELECT BRANCH </option>";
$doix=mysql_query("SELECT `Number`, `Name` FROM `branches` ORDER BY `Number` ASC");
}
			while($roix=mysql_fetch_assoc($doix)){
				$num=$roix['Number'];
		$seek=mysql_query("SELECT `Branche` FROM `sales` WHERE `Branche`='$num' ORDER BY `Number` ASC LIMIT 1");
			if($feek=mysql_num_rows($seek)){
				$fna=$roix['Name'];
				if($brc==$fna)
					$s='selected';
				else
					$s='';
			echo"<option value='$fna' $s> $fna </option>";
			}
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

			<div class="divFooter"><center><u><b><?php echo $bra ?> / PURCHASE REPORT <?php echo $mpri ?></b></u></center></div>
             <div class="row">
            <div class="col-lg-12">
             <span>Total Records Found : <b><?php echo" $fo " ?></b></span>
			 <span class="pull-right hidden-print"><b><?php echo $brc ?></b>
			 &nbsp;&nbsp;&nbsp;&nbsp;<a href="#" onclick="return window.print()" class="hidden-print" title='Click to print' data-toggle='tooltip' data-placement='top'><i class="lnr lnr-printer hidden-print"></i></a></span>
            <div class="widget-container fluid-height clearfix">
            <div class="widget-content padded clearfix">
               
			   <?php
$gto=0;
if($custo=='DAILY'){
			   while($roi=mysql_fetch_assoc($doi)){
				$vous=$roi['Voucher'];
	$do=mysql_query("SELECT *FROM `stouse` WHERE `Voucher` = '$vous' AND `Status`='0' AND `Action`='BRANCHEP'");

				?>
                                 <table class="table table-striped table-hover">     
                                      <thead>
                     <tr role="row">
                     <th class="hidden-xs"> No </th> 
                       <th> Due&nbsp;Date </th>
                       <th> Destination </th>
                       <th> Brought&nbsp;by </th>
                       <th> Item&nbsp;Name </th>
                        <th> Description </th>
						 <th> Price/Unit </th>
						 <th> Quantity </th>
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
		print("<tr title='$code'>
          <td class='hidden-xs' style='$stn'><div align='center'>$n&nbsp;&nbsp;</td>
			<td style='$stn'> $dte </td><td style='$stn'> $type </td><td style='$stn'> $pers </td>
			<td style='$stn'> $iname </td><td style='$stn'> $descri </td><td style='$stn'><div align='right'> $prio &nbsp;&nbsp; </td>
				<td style='$stn'> $qty&nbsp;&nbsp;$unit </td><td style='$stn'><div align='right'> $toto&nbsp;</td></tr>");
						  $n++;					$tp+=$tot;
						}
						$tpo=number_format($tp, 2);
			   ?>
						
                     </tbody><thead>
					<tr><th class='hidden-xs'>
					<?php
						 echo"<input type='hidden' name='vous' value='$vous'>";
						?>
                          
					 </th></form>

					 <form action='taken.php' method='post'><th> 	 </th></form>

					<th colspan='5'><div align='center'> Total Amount </th>
					<th> </th><th><div align='right'><?php echo $tpo ?></th></tr>
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
					<th width='5%'> </th><th width='10%'><div align='right'><?php echo $gto ?>&nbsp;</th>
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
                       <th>&nbsp;&nbsp;Due&nbsp;Date&nbsp;&nbsp;</th>
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
				   $tp=0;				$n=1;				
			   while($roi=mysql_fetch_assoc($doi)){
				$its=$roi['Item'];
	$do=mysql_query("SELECT *FROM `stouse` WHERE `Item` = '$its' AND `Date` BETWEEN '$dato' AND '$datos' AND `Status`='0' AND `Action`='BRANCHEP' AND `Voucher`!='0' $conde");
			$ffo=mysql_num_rows($do);
						$tco=$tpri=0;					$tot=$qty=0;				
						while($ro=mysql_fetch_assoc($do)){
				$code=$ro['Number'];
				$item=$ro['Item'];			
			$cost=$ro['Cost'];			$costo=number_format($cost, 2);
			$qt=$ro['Quantity'];
			$dte=$ro['Date'];
			$type=$ro['Destin'];
			$pers=$ro['Person'];
			$pri=$ro['Price'];	
			$tot=$qt*$pri;
			$tco+=$tot;
			$tpri+=$pri;
			$tp+=$tot;
			$qty+=$qt;
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

         $toto=number_format($tco, 2);			$prio=number_format($tco/$qty, 2);				$qty=number_format($qty, 2);						
															
		print("<tr title='$code'>
          <td class='hidden-xs' style='$stn'><div align='center'>$n&nbsp;&nbsp;</td>
			<td style='$stn'> $dte </td><td style='$stn'> $type </td><td style='$stn'> $pers </td>
			<td style='$stn'> $iname </td><td style='$stn'> $descri </td><td style='$stn'><div align='right'> $prio&nbsp;&nbsp;&nbsp;&nbsp;</td>
				<td style='$stn'><div align='right'> $qty </td><td> $unit </td><td style='$stn'><div align='right'> $toto&nbsp;</td></tr>");
						  $n++;					
						}
						$tpo=number_format($tp, 2);
			   
						?>
						
                     </tbody><thead>
					<tr><th class='hidden-xs'>
					<?php
						 echo"<input type='hidden' name='vous' value='$vous'>";
						?>
                          
					 </th></form>

					 <form action='taken.php' method='post'><th> 	 </th></form>

					<th colspan='5'><div align='center'> Total Amount </th>
					<th> </th><th colspan='2'><div align='right'><?php echo $tpo ?></th></tr>
                  </table><br>
				  <?php
$gto+=$tp;
			   }

$gto=number_format($gto, 2);
if($fo>='20000000'){
					 ?> 
<table class="table table-striped table-hover">     
                                      <thead>
                     <tr role="row">
                     <th class="hidden-xs" width='5%'> </th> 
<th><div align='right'> Grand Total </th>
					<th width='5%'> </th><th width='10%'><div align='right'><?php echo $gto ?>&nbsp;</th>
</tr></table> 
<?php
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
