<?php
if(basename($_SERVER['PHP_SELF']) == 'odrepo.php') 
  $cm=" class='current'";
include'header.php';
include'connection.php';
$dato=$datos=$Date;
$custo='';
$conde='';
$t=$p=0;

// search for an item to be added to the chart
if(isset($_POST['search']))
		{
			$brc=$_POST['brc'];
			$dato=$_POST['dato'];
			$datos=$_POST['datos'];
			$p=1;
		}

// Delete a given order
if(isset($_POST['delos']))
		{
			$t=$p=50;
			$bsa='info';
			$vout=$_POST['vout'];
			$tabl=$_POST['tabl'];

			$brc=$_POST['brc'];
			$dato=$_POST['dato'];
			$datos=$_POST['datos'];

	$dol=mysql_query("SELECT *FROM `orders` WHERE `Status`='0' AND `Voucher`!='$vout' AND `Voucher`!='0' AND `Table`='$tabl' AND `Sales`='0' ORDER BY `Number` DESC LIMIT 100");
		if(!$fol=mysql_num_rows($dol))
		$tbs=mysql_query("UPDATE `tables` SET `Status`='0' WHERE `Name`='$tabl' ORDER BY `Number` ASC LIMIT 1");

	$dev=mysql_query("UPDATE `orders` SET `Status`='1', `Deleter`='$loge', `Ddate`='$Date', `Dtime`='$Time' WHERE `Voucher`='$vout' ORDER BY `Number` ASC LIMIT 100");
	$des=mysql_query("UPDATE `payment` SET `Status`='1' WHERE `Voucher`='$vout' ORDER BY `Number` ASC LIMIT 100");
		}

// open for a given requisition to mark as taken
if(isset($_POST['open']))
		{
			$brc=$_POST['brc'];
			$vous=$_POST['vous'];
			$dato=$_POST['dato'];
			$datos=$_POST['datos'];
			$dte=$_POST['dte'];
			$t=$p=1;
		}
	
	if($dato==$datos)
			$mpri="ON $dato";
		else
			$mpri="FROM $dato TO $datos";

?>
<div class="container-fluid main-content">
        <div class="page-title hidden-print">
          <h3 style='margin-top:-20px; margin-bottom: 5px; color:#ffcc33'>
         Orders Report
          </h3>
                 </div>
     
        <div class="row">
  <div class="col-lg-2 hidden-print">
   
 <ul class="list-group">

    <li class="list-group-item active">
	  <a href="odrepo.php">
                <p>
                <i class="lnr lnr-menu-circle"></i>&nbsp;Orders Report
                </p>
              </a></li>  		  

    <li class="list-group-item">
	  <a href="sarepo.php">
                <p>
                <i class="lnr lnr-menu-circle"></i>&nbsp;Invoices Report
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
	  <a href="prirepo.php">
                <p>
                <i class="lnr lnr-menu-circle"></i>&nbsp;Prices Report
                </p>
              </a></li>   

	 <li class="list-group-item">
	  <a href="boxrepo.php">
                <p>
                <i class="lnr lnr-menu-circle"></i>&nbsp;Cashbox Report
                </p>
              </a></li>    

	 <li class="list-group-item">
	  <a href="breceive.php">
                <p>
                <i class="lnr lnr-menu-circle"></i>&nbsp;Receive Report
                </p>
              </a></li>  

	 <li class="list-group-item">
	  <a href="brarepo.php">
                <p>
                <i class="lnr lnr-menu-circle"></i>&nbsp;Config. Report
                </p>
              </a></li> 
                         
            </ul>
  </div>
                    
           
           
       
        <div class="col-lg-10">
                  <div class="row">
         
           <div class="col-lg-4"> </div>
          
         
           

        <form action="" method="post" class="form-horizontal ">                  
                       <div class="col-lg-8 hidden-print"><div class="col-lg-3"> 
		<input type="hidden" class="form-control" name="brc" value="">
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
			   if($t==0){
				   if($p==0)
		$do=mysql_query("SELECT *FROM `orders` WHERE `Upda`!='10' AND `Status`='0' GROUP BY `Voucher` ORDER BY `Date` DESC LIMIT 40");
				   else
		$do=mysql_query("SELECT *FROM `orders` WHERE `Upda`!='10' AND `Status`='0' AND `Date` BETWEEN '$dato' AND '$datos' GROUP BY `Voucher` ORDER BY `Voucher` ASC LIMIT 400");
				if($fo=mysql_num_rows($do)){
				   ?>
                 <div class="divFooter"><center><u><b>ORDERS REPORT <?php echo $mpri ?></b></u></center></div>
             <div class="row">
            <div class="col-lg-12">
             <span> &nbsp;&nbsp; Total Records Found : <b><?php echo" $fo " ?></b></span> 
			 <span class="pull-right hidden-print"><?php echo $bra ?>&nbsp;&nbsp;<a href="#" onclick="return window.print()" class="hidden-print" title='Click to print' data-toggle='tooltip' data-placement='top'><i class="lnr lnr-printer"></i></a></span>
            <div class="widget-container fluid-height clearfix">
            <div class="widget-content padded clearfix">

								 <form action="" method="post" class="form-horizontal "> 
				<table class="table table-striped">     
                                      <thead>
                    <tr role="row">
                     <th class="hidden-xs"> NO </th> 
                       <th> Table </th>
                       <th> Order&nbsp;No </th>
                       <th> Done&nbsp;By </th>
                       <th> Due&nbsp;Date </th>
                        <th> Time </th>
                        <th> Waiter </th>
                       <th> Items </th>
						<th><div align='right'> Value &nbsp;&nbsp;&nbsp;</th>
                       <th><div align='right'> Invoiced &nbsp;&nbsp;&nbsp;</th>
                       <th><div align='right'> Paid &nbsp;&nbsp;&nbsp;</th>
                        <th class="hidden-xs hidden-print" style="width:40px; text-align:center;" colspan='2'> Options </th>
                     </tr>
                    </thead>
                                        <tbody>
					<?php
					$n=1;				$tp=0;
						while($ro=mysql_fetch_assoc($do)){
				$vou=$ro['Voucher'];
				$dte=$ro['Date'];
				$tme=$ro['Time'];
				$user=$ro['Owner'];
				$tabl=$ro['Table'];
				$cashier=$ro['Cashier'];
				$sales=$ro['Sales'];
				$comme=$ro['Comment'];

				if($sales=='0'){
					$invo="<span class='label label-warning' style='height:18px; padding:0px; margin:1px; width:80px;'>NO</span>";
					$dso='';
				}
				else{
					$invo="<span class='label label-primary' style='height:18px; padding:0px; margin:1px; width:80px;'>YES</span>";
					$dso='disabled';
				}
		
		$pa=mysql_query("SELECT *FROM  `payment` WHERE `Voucher`='$sales' AND `Destin`='SALES'");
			if($fa=mysql_num_rows($pa))
				$pdo="<span class='label label-primary' style='height:18px; padding:0px; margin:1px; width:80px;'>YES</span>";
			else
				$pdo="<span class='label label-danger' style='height:18px; padding:0px; margin:1px; width:80px;'>NO</span>";

				$to=0;
$dor=mysql_query("SELECT `Price`, SUM(Quantity) AS 'QTO' FROM `orders` WHERE `Voucher`='$vou' GROUP BY `Item`,`Price` ORDER BY `Number` ASC");
			$for=mysql_num_rows($dor);
				while($ror=mysql_fetch_assoc($dor)){
				$pri=$ror['Price'];
				$qty=$ror['QTO'];
			$to+=$pri*$qty;
				}			
						$too=number_format($to, 2);

						$stn="padding:0px;";

						if($_SESSION['Cancel']=='0'){
						$dso='disabled';
						$btz='button';
					}
					else{
						$btz='submit';
					}

		print("<tr><td class=hidden-xs style='$stn'><div align='center'>$n&nbsp;&nbsp;</td><td style='$stn'> $tabl </td>
		<td style='$stn'><div align='center'> $vou </td><td style='$stn'> $cashier </td>
						<td style='$stn'> $dte </td><td style='$stn'> $tme </td><td style='$stn'> $user </td>
						<td style='$stn'><div align='right'> $for&nbsp;&nbsp;</td><td style='$stn'><div align='right'> $too &nbsp;&nbsp; </td>
						<td style='$stn'><div align='center'>&nbsp;$invo&nbsp;</td><td style='$stn'><div align='center'>&nbsp;$pdo&nbsp;</td>

						<form method=post action=''> <input type='hidden' name='brc' value='$brc'>
						<input type='hidden' name='dte' value='$dte'><td class='hidden-xs hidden-print' align='right' style='width:40px; padding:0px;'>
       <input type='hidden' name='vous' value='$vou'> <input type='hidden' name='dato' value='$dato'> 
	   <input type='hidden' name='datos' value='$datos'> <input type='hidden' name='brc' value='$brc'>
                          <button type='submit' class='btn btn-xs btn-success hidden-print' name='open' style='height:18px; padding:0px; margin:0px;'  title='Open' data-toggle='tooltip' data-placement='top'>
						  &nbsp;&nbsp;<i class='lnr lnr-download'></i>&nbsp;&nbsp;</button></td></form>
						  
						  <form method=post action=''><td class='hidden-xs hidden-print' align='right' style='width:40px; padding:0px;'>
        <input type='hidden' name='vout' value='$vou'> <input type='hidden' name='dato' value='$dato'> 
		<input type='hidden' name='datos' value='$datos'> <input type='hidden' name='brc' value='$brc'>
		<input type='hidden' name='tabl' value='$tabl'>
       <button type='$btz' class='btn btn-xs btn-danger hidden-print' name='delos' style='height:18px; padding:0px; margin:0px;' title='Delete' data-toggle='tooltip' data-placement='top' $dso>
						  &nbsp;&nbsp;<i class='lnr lnr-trash'></i>&nbsp;&nbsp;</button></td></form></tr>");
						  $n++;		$tp+=$to;
						}
						$tpo=number_format($tp, 2);	
						?>
						
                     </tbody>

					 <thead>
					<tr><th class='hidden-xs'> </th><th colspan='7'><div align='center'> Total Amount </th>
					<th><div align='right'><?php echo $tpo ?>&nbsp;&nbsp;</th><th colspan='2'> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </th>
					<th colspan='2' class="hidden-xs hidden-print"><div align='center'> -- </th></tr>
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
		$dor=mysql_query("SELECT *, SUM(Quantity) AS 'QTY' FROM `orders` WHERE `Voucher`='$vous' AND `Status`='0' GROUP BY `Item`,`Price` ORDER BY `Number` ASC");
				if($for=mysql_num_rows($dor)){
					?>
					<div class="divFooter"><center><u><b>ORDER REPORT <?php echo"ON $dte"; ?></b></u></center></div>
		 <div class="row">
            <div class="col-lg-12">
             <span> &nbsp;&nbsp; Order No : <b><?php echo" $vous " ?></b></span>
			 <span class="pull-right"><?php echo $bra ?>&nbsp;&nbsp;<a href="#" onclick="return window.print()" class="hidden-print" title='Click to print' data-toggle='tooltip' data-placement='top'><i class="lnr lnr-printer"></i></a></span>
            <div class="widget-container fluid-height clearfix">
            <div class="widget-content padded clearfix">

		<table class="table table-striped"><form action='' method='post'>     
                                      <thead>
                    <tr role="row">
                     <th class="hidden-xs"> NO </th>
                        <th>&nbsp;&nbsp;&nbsp;Due&nbsp;Date&nbsp;&nbsp;&nbsp;</th>
                       <th> Waiter </th>
                       <th> Item&nbsp;Name </th>
                       <th> Item&nbsp;Type </th>
                       <th colspan='2'>&nbsp;&nbsp;Quantity&nbsp;&nbsp;</th>
						 <th> Sales&nbsp;Price </th>
						<th>Sales&nbsp;Amount</th>
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
				$cashier=$ror['Owner'];
				$comme=$ror['Comment'];

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

	$then=mysql_query("UPDATE `requis` SET `Price`='$cost', `Direct`='$dire' WHERE `Number`='$code' LIMIT 1");

          $to=$sale*$qt;				$too=number_format($to, 2);			$qino=number_format($qin, 2);
		print("<tr><td class='hidden-xs' style='$stn'><div align='center'>$n&nbsp;&nbsp;</td>
		<td style='$stn'> $dte </td><td style='$stn'> $cashier </td>
						<td style='$stn'> $iname </td><td style='$stn'> $type </td>
						<td style='$stn'><div align='right'> $qty </td>
						<td style='$stn'> $unit </td><td style='$stn'><div align='right'>&nbsp;$sales&nbsp;</td>
						<td style='$stn'><div align='right'>$too&nbsp;&nbsp;&nbsp;&nbsp;</td>			
						
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
					<tr><th class="hidden-xs"> </th><th colspan="3"><?php echo $comme ?></th>
					<th colspan='3'><div align='center'> Total Amount </th>
					<th colspan='2'><div align='right'><?php echo $toto ?>&nbsp;&nbsp;&nbsp;</th><th class="hidden-xs hidden-print"> </th>
					<th colspan='2' class="hidden-xs hidden-print"><div align='center'> -- </th></tr>
                  </table>

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
						<div style='text-align:center; font-size:24px; color:#ff9999'>Sales not found on selected date </div><br><br><br><br><br><br><br>";
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