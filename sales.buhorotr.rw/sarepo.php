<?php
if(basename($_SERVER['PHP_SELF']) == 'sarepo.php') 
  $cm=" class='current'";
include'header.php';
include'connection.php';
$dato=$datos=$Date;
$custo=$conde=$condi='';
$brc=$cus='';
$t=$p=0;

$doibe=mysql_query("SELECT `Number` FROM `branches` WHERE `Name`='$brancho' ORDER BY `Number` ASC");
		$roibe=mysql_fetch_assoc($doibe);
			$numo=$roibe['Number'];
			$brc=$roibe['Number'];

// search for an item to be added to the chart
if(isset($_POST['search']))
		{
			$brc=$_POST['brc'];
			$cus=$_POST['cus'];
			$dato=$_POST['dato'];
			$datos=$_POST['datos'];
			$p=$_POST['p'];
		}

// open for a given requisition to mark as taken
if(isset($_POST['open']))
		{
			$brc=$_POST['brc'];
			$cus=$_POST['cus'];
			$vous=$_POST['vous'];
			$dato=$_POST['dato'];
			$datos=$_POST['datos'];
			$dte=$_POST['dte'];
			$p=$_POST['p'];
			$t=1;
		}

	
		if($dato==$datos)
			$mpri="ON $dato";
		else
			$mpri="FROM $dato TO $datos";

if($brc)
$conde="AND `Destin`='$brc'";

if($cus)
$condi="AND `User`='$cus'";
?>
<div class="container-fluid main-content">
        <div class="page-title hidden-print">
          <h2 style='margin-top:-20px; margin-bottom: 5px; color:#ffcc33'>
         Sales Report
          </h2>
                 </div>
     
        <div class="row">
  <div class="col-lg-2 hidden-print">
   
 <ul class="list-group">

    <li class="list-group-item active">
	  <a href="sarepo.php">
                <p>
                <i class="lnr lnr-menu-circle"></i>&nbsp;Sales Report
                </p>
              </a></li>    

    <li class="list-group-item">
	  <a href="surepo.php">
                <p>
                <i class="lnr lnr-menu-circle"></i>&nbsp;Item Sold Report
                </p>
              </a></li> 

<li class="list-group-item">
	  <a href="parepo.php">
                <p>
                <i class="lnr lnr-menu-circle"></i>&nbsp;Payment Report
                </p>
              </a></li> 

	 <li class="list-group-item">
	  <a href="crerepo.php">
                <p>
                <i class="lnr lnr-menu-circle"></i>&nbsp;Credit Report
                </p>
              </a></li> 
              
    <li class="list-group-item">
	  <a href="recorepo.php">
                <p>
                <i class="lnr lnr-menu-circle"></i>&nbsp;Recovery Report
                </p>
              </a></li>   

	 <li class="list-group-item">
	  <a href="debrepo.php">
                <p>
                <i class="lnr lnr-menu-circle"></i>&nbsp;Debtors Report
                </p>
              </a></li>  

	 <li class="list-group-item">
	  <a href="conterepo.php">
                <p>
                <i class="lnr lnr-menu-circle"></i>&nbsp;Balance Report
                </p>
              </a></li>    

	 <li class="list-group-item">
	  <a href="balrepo.php">
                <p>
                <i class="lnr lnr-menu-circle"></i>&nbsp;Control Report
                </p>
              </a></li>       

	 <li class="list-group-item">
	  <a href="dayrepo.php">
                <p>
                <i class="lnr lnr-menu-circle"></i>&nbsp;Income Report
                </p>
              </a></li> 
                         
            </ul>
  </div>
                    
           
           
       
        <div class="col-lg-10">
                  <div class="row">
         
           <div class="col-lg-6 hidden-print"><div class="col-lg-2"> </div>
          
         
           

        <form action="" method="post" class="form-horizontal "> 
        <div class="col-lg-5">  
		<?php echo"<input type='hidden' name='p' value='1'>"; ?>
		<select class="form-control" name="brc" style='padding-right:5px;'>
			   <?php
echo"<option value='0' selected='selected'> SELECT CUSTOMER </option>";
	$seek=mysql_query("SELECT `Destin` FROM `stouse` WHERE `Destin`!='' AND `Status`='0' AND `Upda`='1' AND `Action`='SALES' GROUP BY `Destin` ORDER BY `Destin` ASC LIMIT 1800");
			if($feek=mysql_num_rows($seek)){
		while($roi=mysql_fetch_assoc($seek)){
				$fna=$roi['Destin'];
				if($brc==$fna)
					$s='selected';
				else
					$s='';
			echo"<option value='$fna' $s> $fna &nbsp;&nbsp;</option>";
			}
			}

			?>			    
            </select>
					   </div>
                       <div class="col-lg-5">  
		<?php echo"<input type='hidden' name='p' value='1'>"; ?>
		<select class="form-control" name="cus" style='padding-right:5px;'>
			   <?php
echo"<option value='0' selected='selected'> SELECT CASHIER </option>";
	$seek=mysql_query("SELECT `User` FROM `stouse` WHERE `User`!='' AND `Status`='0' AND `Upda`='1' AND `Action`='SALES' GROUP BY `User` ORDER BY `User` ASC LIMIT 18");
			if($feek=mysql_num_rows($seek)){
		while($roi=mysql_fetch_assoc($seek)){
				$fna=$roi['User'];
				if($cus==$fna)
					$s='selected';
				else
					$s='';
			echo"<option value='$fna' $s> $fna &nbsp;&nbsp;</option>";
			}
			}

			?>			    
            </select>
					   </div></div>
            <div class="col-lg-6 hidden-print"><div class="col-lg-4"> 
           <div class="input-group date datepicker">
      <input class="form-control form-center" id="from" name="dato" type="text" value="<?php echo $dato ?>" onkeypress='return isNumberKey(event)' required>
	  <span class="input-group-addon"><i class="lnr lnr-calendar-full"></i></span>
			</div></div>


		  <div class="col-lg-4"> 
           <div class="input-group date datepicker">	
      <input class="form-control form-center" id="to" name="datos" type="text" value="<?php echo $datos ?>" onkeypress='return isNumberKey(event)' required>
	  <span class="input-group-addon"><i class="lnr lnr-calendar-full"></i></span>
              </div></div>                      
                       
                       <div class="col-lg-3">
                        <button class="btn  btn-primary btn-block" type="submit" name="search"><i class="lnr lnr-magnifier"></i> Search</button>
                   
					  </div>
                         </div> 
                      
                     
                  
            </form> 
             
               
            </div>
               <?php
			   if($t=='0'){
				   if($p=='0')
		$do=mysql_query("SELECT *FROM `stouse` WHERE `Upda`='1' AND `Action`='SALES' $conde $condi GROUP BY `Voucher` ORDER BY `Date` DESC LIMIT 15");
				   else
		$do=mysql_query("SELECT *FROM `stouse` WHERE `Upda`='1' AND `Date` BETWEEN '$dato' AND '$datos' AND `Action`='SALES' $conde $condi GROUP BY `Voucher` ORDER BY `Voucher` ASC LIMIT 4000");
				if($fo=mysql_num_rows($do)){
				   ?>
                 <div class="divFooter"><center><u><b>SALES REPORT <?php echo $mpri ?></b></u></center></div>
             <div class="row">
            <div class="col-lg-12">
             <span> &nbsp;&nbsp; Total Records Found : <b><?php echo" $fo " ?></b></span> 
			 <span class="pull-right"><?php echo $bra ?>&nbsp;&nbsp;<a href="#" onclick="return window.print()" class="hidden-print" title='Click to print' data-toggle='tooltip' data-placement='top'><i class="lnr lnr-printer"></i></a></span>
			 
			 <span class="pull-right hidden-print">
		&nbsp;&nbsp;&nbsp;&nbsp;<a href="#" id="exporttable" class="hidden-print" title='Export to excell' data-toggle='tooltip' data-placement='top'><i class="lnr lnr-line-spacing"></i></a></span>
                    
            <div class="widget-container fluid-height clearfix">
            <div class="widget-content padded clearfix">

			<form action="" method="post" class="form-horizontal "> 
			<table class="table table-striped table-hover" id="htmltable">     
                <thead>
                    <tr role="row">
                     <th class="text-center hidden-xs"> No </th> 
                       <th class='text-center'> Date &nbsp;&&nbsp; Time </th>
                       <th> Done&nbsp;By </th>
                       <th> Customer </th>
                       <th> Reference </th>
                       <th> Order&nbsp;No </th>
                       <th> Items </th>
						<th><div align='right'>Total&nbsp;Amount&nbsp;</th>
                        <th class="hidden-print" style="width:20px; text-align:center;"> # </th>
                     </tr>
                    </thead>
                                        <tbody>
					<?php
					$n=1;				$tp=0;
						while($ro=mysql_fetch_assoc($do)){
				$vou=$ro['Voucher'];
				$dte=$ro['Date'];
				$des=$ro['Destin'];
				$tme=$ro['Time'];
				$user=$ro['User'];
				$cashier=$ro['Cashier'];
				$brco=$ro['Branche'];
				$bra=$ro['Invoice'];
				$ftype=$ro['Comment'];
				$to=0;

$dor=mysql_query("SELECT `Price`, SUM(Quantity) AS 'QTO' FROM `stouse` WHERE `Voucher`='$vou' $conde $condi GROUP BY `Item`,`Price` ORDER BY `Number` ASC");
			$for=mysql_num_rows($dor);
				while($ror=mysql_fetch_assoc($dor)){
				$pri=$ror['Price'];
				$qty=$ror['QTO'];
			$to+=$pri*$qty;
				}


if($_SESSION['Cancel']){
$sd="submit";
$so="";
}
else{
$sd="button";
$so="disabled";
}
			
						$too=number_format($to, 2);

						$stn="padding:1px;";
if($brancho=='' OR ($brancho==$bra)){
		print("<tr><td class='hidden-xs' style='$stn'><div align='right'>$n&nbsp;&nbsp;</td>
<td class='text-center' style='$stn'>$dte&nbsp;$tme </td><td style='$stn'> $user </td><td style='$stn'>&nbsp;$des </td>
		<td style='text-align:center; $stn'> $ftype </td><td style='$stn'><div align='center'> $vou </td><td style='$stn'><div align='right'>$for </td>
		<td style='$stn'><div align='right'> $too </td>

		<form method=post action=''><td class='hidden-print text-right' align='right' style='width:40px; padding:0px;'><input type='hidden' name='brc' value='$brc'><input type='hidden' name='cus' value='$cus'>
						<input type='hidden' name='dte' value='$dte'>
       <input type='hidden' name='vous' value='$vou'> 
       <input type='hidden' name='dato' value='$dato'> 
       <input type='hidden' name='datos' value='$datos'>
       <input type='hidden' name='p' value='$p'><button type='submit' class='btn btn-xs btn-success hidden-print' name='open' style='height:18px; padding:0px; margin:0px;'  title='Open' data-toggle='tooltip' data-placement='top'>&nbsp;&nbsp;<i class='lnr lnr-download'></i>&nbsp;&nbsp;</button></td></form></tr>");
						  $n++;		$tp+=$to;
						}
}
						$tpo=number_format($tp, 2);	
						?>
						
                     </tbody>

					 <thead>
					<tr><th class="hidden-xs"> </th><th colspan='6'><div align='center'> Total Amount </th>
					<th><div align='right'><?php echo $tpo ?></th><th class="hidden-xs hidden-print"><div align='center'> -- </th></tr>
                  </table><br>

				  
				  <?php
				}
				 else{
						echo"<div class='row'>
            <div class='col-lg-12' style='margin-top:-20px;'>
             <span> &nbsp;&nbsp; Total Records Found : <b> 0 </b></span>
			 <span class='pull-right hidden-print'> $bra &nbsp;&nbsp;<a href='#' onclick='return window.print()' class='hidden-print' title='Click to print' data-toggle='tooltip' data-placement='top'><i class='lnr lnr-printer'></i></a></span>
            <div class='widget-container fluid-height clearfix'>
            <div class='widget-content padded clearfix'>
			<br><br><br><br><br><br>
						<div style='text-align:center; font-size:24px; color:#ff3333'> There is no sales on selected date </div><br><br><br><br><br><br><br>";
					}  
			}
				   else{
		$dor=mysql_query("SELECT *, SUM(Quantity) AS 'QTY' FROM `stouse` WHERE `Upda`='1' AND `Action`='SALES' AND `Voucher`='$vous' GROUP BY `Item` ORDER BY `Number` ASC");
				if($for=mysql_num_rows($dor)){
					?>
					<div class="divFooter"><center><u><b>SALES REPORT <?php echo"ON $dte"; ?></b></u></center></div>
		 <div class="row">
            <div class="col-lg-12">
             <span> &nbsp;&nbsp; Total Records Found : <b><?php echo" $for " ?></b></span>
			 <span class="pull-right"><?php echo $bra ?>&nbsp;&nbsp;<a href="#" onclick="return window.print()" class="hidden-print" title='Click to print' data-toggle='tooltip' data-placement='top'><i class="lnr lnr-printer"></i></a></span>
			 
			    <span class="pull-right hidden-print">
			 &nbsp;&nbsp;&nbsp;&nbsp;<a href="#" id="exporttable" class="hidden-print" title='Export to excell' data-toggle='tooltip' data-placement='top'><i class="lnr lnr-line-spacing"></i></a></span>
            <div class="widget-container fluid-height clearfix">
            <div class="widget-content padded clearfix">

			<div class='table-responsive'>
			<table class="table table-striped table-hover" id="htmltable">   
                                      <thead>
                    <tr role="row">
                     <th class="hidden-xs"> NO </th>
                        <th>&nbsp;&nbsp;&nbsp;Due&nbsp;Date&nbsp;&nbsp;&nbsp;</th>
                       <th> Cashier </th>
                       <th> Customer </th>
                       <th> Brand&nbsp;Name </th>
                       <th> Item&nbsp;Name </th>
                       <th colspan='2'>&nbsp;&nbsp;Quantity&nbsp;&nbsp;</th>
						 <th> Sales&nbsp;Price </th>
						<th>Total&nbsp;Amount</th>
                        <th class="hidden-xs hidden-print" style="width:40px; text-align:center;" colspan='2'> Options </th>
                     </tr>
                    </thead>
                                        <tbody>
										<?php
	$n=1;			$tot=0;
					while($ror=mysql_fetch_assoc($dor)){
						$code=$ror['Number'];
						$item=$ror['Item'];
						$sale=$ror['Price'];
						$qt=$ror['QTY'];
						$des=$ror['Branche'];
						$vous=$ror['Voucher'];
				$dte=$ror['Date'];
				$tme=$ror['Time'];
				$cashier=$ror['User'];
				$tnu=$ror['Destin'];
				$cme=$ror['Comment'];

	$do=mysql_query("SELECT *FROM `items` WHERE `Number`='$item' ORDER BY `Number` DESC LIMIT 1");
		$ro=mysql_fetch_assoc($do);
			$iname=$ro['Iname'];
			$kin=$ro['Type'];
			$descri=$ro['Descri'];
			$uno=$ro['Unit'];

			$stn="padding:1px;";

	$qty=number_format($qt, 2);			$costo=number_format($cost, 2);			$sales=number_format($sale, 2);			$qto=number_format($qt, 2);
			
$doi=mysql_query("SELECT *FROM `itype` WHERE `Number`='$kin' ORDER BY `Number` ASC");
		$roi=mysql_fetch_assoc($doi);
				$type=$roi['Type'];

				$dox=mysql_query("SELECT *FROM `unit` WHERE `Number`='$uno' ORDER BY `Number` ASC");
					$rox=mysql_fetch_assoc($dox);
							$unit=$rox['Unit'];

	//$then=mysql_query("UPDATE `requis` SET `Price`='$cost', `Direct`='$dire' WHERE `Number`='$code' LIMIT 1");

          $to=$sale*$qt;				$too=number_format($to, 2);			$qino=number_format($qin, 2);
		print("<tr><td class='hidden-xs' style='$stn'><div align='center'>$n&nbsp;&nbsp;</td>
		<td class='text-center' style='$stn'> $dte </td><td style='$stn'> $cashier </td><td style='$stn'> $tnu </td>
			<td style='$stn'> $type </td><td style='$stn'> $iname </td>
						<td style='$stn'><div align='right'> $qty </td>
				<td style='$stn'> $unit </td><td style='$stn'><div align='right'>&nbsp;$sales&nbsp;</td>
				<td style='$stn'><div align='right'>$too&nbsp;&nbsp;</td>
						
				<td class='hidden-xs hidden-print' align='right' style='width:40px; padding:0px;'>
				<input type='hidden' name='rowid$n' value='$code'><input type='hidden' name='item$n' value='$item'>
				<input type='hidden' name='dire$n' value='$dire'>
                <button type='button' class='btn btn-xs btn-warning hidden-print' name='edit' style='height:18px; padding:0px;' title='Edit' data-toggle='tooltip' data-placement='top' disabled> &nbsp;&nbsp;<i class='lnr lnr-pencil'></i>&nbsp;&nbsp;</button></td>
						  
						  <td class='hidden-xs hidden-print' align='right' style='width:40px; padding:0px;'>
                          <button type='button' class='btn btn-xs btn-danger hidden-print' name='delo' style='height:18px; padding:0px;' title='Delete' data-toggle='tooltip' data-placement='top' disabled>&nbsp;&nbsp;<i class='lnr lnr-trash'></i>&nbsp;&nbsp;</button>
						  <input type='hidden' name='vous' value='$vous'><input type='hidden' name='n' value='$n'></td></tr>");
						  $n++;				$tot+=$to;
						}
						$toto=number_format($tot, 2);			
						?>
						
                    </tbody>

					 <thead>
					<tr><th class="hidden-xs"> </th><form action='' method='post'><th class='text-right'>
					<?php 
			echo"<input type='hidden' name='dato' value='$dato'><input type='hidden' name='datos' value='$datos'>
					 <input type='hidden' name='p' value='$p'><input type='hidden' name='brc' value='$brc'>";
					 ?>
		<button type='submit' class='btn btn-xs btn-info hidden-print' name='back' style='height:18px; padding:0px; margin:0px; width:80px;' title='Back to orders list' data-toggle='tooltip' data-placement='top'>&nbsp;&nbsp;<i class='lnr lnr-chevron-left-circle'></i>&nbsp;&nbsp;Back&nbsp;&nbsp;</button></th></form>
		<th colspan='2' class='text-center'><?php echo $cme ?></th>
					<th colspan='5'><div align='center'> Total Amount </th>
					<th><div align='right'><?php echo $toto ?>&nbsp;&nbsp;</th>
					<th colspan='2' class="hidden-xs hidden-print"><div align='center'> -- </th></tr>
                  </table><br></div>

				<?php
				}
					else{
						echo"<div class='row'>
            <div class='col-lg-12' style='margin-top:-20px;'>
             <span> &nbsp;&nbsp; Total Records Found : : <b> 0 </b></span>
			 <span class='pull-right hidden-print'> $bra &nbsp;&nbsp;<a href='#' onclick='return window.print()' class='hidden-print' title='Click to print' data-toggle='tooltip' data-placement='top'><i class='lnr lnr-printer'></i></a></span>
            <div class='widget-container fluid-height clearfix'>
            <div class='widget-content padded clearfix'>
			<br><br><br><br><br><br>
						<div style='text-align:center; font-size:24px; color:#ff9999'> Report not available on selected date </div><br><br><br><br><br><br><br>";
					}
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
