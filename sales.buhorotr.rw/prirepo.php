<?php
if(basename($_SERVER['PHP_SELF']) == 'prirepo.php') 
  $cm=" class='current'";
include'header.php';
include'connection.php';
$dato=$datos=$Date;
$custo='';
$conde='';
$condi='';
$t=$p=0;
$brc=$_SESSION['Branche'];
$brancho=$_SESSION['Branche'];

// search for an item to be added to the chart
if(isset($_POST['search']))
		{
			$brc=$_POST['brc'];
			$custo=$_POST['custo'];
			$p=1;
		}
		
		// open a given customer account
if(isset($_POST['open']))
		{
			$brc=$_POST['brc'];
			$custo=$_POST['custo'];
			$code=$_POST['code'];
			$cuna=$_POST['cuna'];
			$p=$_POST['p'];
			$t=1;
		}
	
		if($dato==$datos)
			$mpri="ON $dato";
		else
			$mpri="FROM $dato TO $datos";

	if($brc=='0' OR $brc=='')
		$conde="";
	else
		$conde="AND `Branche`='$brc'";

	if($custo)
		$condi="AND `Customer`='$custo'";
	else
		$condi="";
?>
<div class="container-fluid main-content">
        <div class="page-title hidden-print">
          <h3 style='margin-top:-20px; margin-bottom: 5px; color:#ffcc33'>
         Customers Report
          </h3>
                 </div>
     
        <div class="row">
  <div class="col-lg-2 hidden-print">
   
 <ul class="list-group">

    <li class="list-group-item active">
	  <a href="prirepo.php">
                <p>
                <i class="lnr lnr-menu-circle"></i>&nbsp;Balance Report
                </p>
              </a></li>  		  

    <li class="list-group-item">
	  <a href="prireport.php">
                <p>
                <i class="lnr lnr-menu-circle"></i>&nbsp;Details &nbsp; Report
                </p>
              </a></li>

    <li class="list-group-item">
	  <a href="odreport.php">
                <p>
                <i class="lnr lnr-menu-circle"></i>&nbsp;Invoices Report
                </p>
              </a></li>  

    <li class="list-group-item">
	  <a href="csrepo.php">
                <p>
                <i class="lnr lnr-menu-circle"></i>&nbsp;Payment Report
                </p>
              </a></li>  
                         
            </ul>
  </div>
                    
           
           
       
         <div class="col-lg-10">
                  <div class="row">
         
           <div class="col-lg-4"> </div>
          
         
           

        <form action="" method="post" class="form-horizontal ">                  
        <div class="col-lg-8 hidden-print"><div class="col-lg-4">
		
					   </div><div class="col-lg-5"> 
          <input class="form-control" name="custo" type="text" id="searcho" autofocus="autofocus"></div>                      
                       
                       <div class="col-lg-2">
                        <button class="btn  btn-primary btn-block" type="submit" name="search"><i class="lnr lnr-magnifier"></i> Search</button>
                   
					  </div>
                         </div> 
                      
                     
                  
            </form> 
             
               
            </div>
                <?php
			   if($t==0){
		$do=mysqli_query($cons, "SELECT *FROM `account` WHERE `Balance` > '1' $conde $condi ORDER BY `Customer` ASC LIMIT 1000");
				if($fo=mysqli_num_rows($do)){
				   ?>
                 <div class="divFooter"><center><u><b>CUSTOMERS REPORT <?php echo $mpri ?></b></u></center></div>
             <div class="row">
            <div class="col-lg-12">
             <span> &nbsp;&nbsp; Total Records Found : <b><?php echo" $fo " ?></b></span> 
			 <span class="pull-right hidden-print"><?php echo $bra ?>&nbsp;&nbsp;<a href="#" onclick="return window.print()" class="hidden-print" title='Click to print' data-toggle='tooltip' data-placement='top'><i class="lnr lnr-printer"></i></a></span>
            <div class="widget-container fluid-height clearfix">
            <div class="widget-content padded clearfix">

								 <form action="" method="post" class="form-horizontal "> 
				<table class="table table-striped table-hover">     
                                      <thead>
                    <tr role="row">
                     <th class="hidden-xs" width='5%'> &nbsp;&nbsp;NO </th> 
                       <th> CUSTOMER </th><th> SALES </th>
					   <th class='text-center'> UPDATE </th>
						<th class='text-center'> TELEPHONE </th>
                       <th class='text-center'> ADDRESS </th>
                       <th class='text-right'> COUNTED &nbsp;&nbsp;&nbsp;</th>
                       <th class='text-right'> BALANCE &nbsp;&nbsp;&nbsp;</th>
                        <th class="hidden-xs hidden-print" style="width:40px; text-align:center;"> # </th>
                     </tr>
                    </thead>
                                        <tbody>
					<?php
					$n=1;				$tpa=$tto=$tco=0;
						while($ro=mysqli_fetch_assoc($do)){
							$code=$ro['Number'];
				$custo=$ro['Customer'];
				$dte=$ro['Cdate'];
				$tele=$ro['Telephone'];
				$adde=$ro['Address'];
				$bal=$ro['Balance'];
				$brc=$ro['Branche'];

				$tot=0;
	$cuse=mysql_query("SELECT `Destin`, COUNT(DISTINCT(`Voucher`)) AS 'CON', SUM(`Price`*`Quantity`) AS 'TOT' FROM `stouse` WHERE `Client`='$code' AND `Action`='SALES' AND `Status`='0' AND `Upda`='1' ORDER BY `Number` ASC");
			$ruce=mysql_fetch_assoc($cuse);
					$tot=$ruce['TOT'];
					$con=$ruce['CON'];

			$pay=0;
	$cusea=mysql_query("SELECT SUM(`Amount`) AS 'Amo' FROM `payment` WHERE `Client`='$code' AND `Pline`!='CREDIT' AND `Status`='0' AND (`Action`='SALES' OR `Action`='PAYMENT') ORDER BY `Number` ASC");
			$rpa=mysql_fetch_assoc($cusea);
					$pay=$rpa['Amo'];

					$bas=$tot-$pay;

$doix=mysql_query("SELECT `Name` FROM `branches` WHERE `Number`='$brc' ORDER BY `Number` ASC");
			$roix=mysql_fetch_assoc($doix);
				$fna=$roix['Name'];

								$balo=number_format($bal, 2);					$baso=number_format($bas, 2);

						$stn="padding:0px;";

						if($_SESSION['Cancel']=='0'){
						$dso='disabled';
						$btz='button';
					}
					else{
						$btz='submit';
					}

		print("<tr><td class=hidden-xs style='$stn'><div align='right'>&nbsp;&nbsp;$n&nbsp;&nbsp;&nbsp;&nbsp;</td>
		
		<td style='$stn'> $custo </td><td class='text-center' style='$stn'> $con </td><td style='$stn' class='text-center'> $dte </td>
		<td class='text-right' style='$stn'> $tele&nbsp;&nbsp;</td>
		<td style='$stn'> $adde </td>

		<td style='$stn'><div align='right'> $baso&nbsp;&nbsp;</td>
		<td style='$stn'><div align='right'> $balo&nbsp;&nbsp;</td>

						<form method=post action=''> <input type='hidden' name='brc' value='$brc'><input type='hidden' name='p' value='$p'>
						<input type='hidden' name='dte' value='$dte'>
						<td class='hidden-xs hidden-print' align='right' style='width:40px; padding:0px;'>
       <input type='hidden' name='code' value='$code'>
       <input type='hidden' name='cuna' value='$custo'>
	   <input type='hidden' name='p' value='$p'>
	   <input type='hidden' name='brc' value='$brc'> 

                          <button type='submit' class='btn btn-xs btn-success hidden-print' name='open' style='height:18px; padding:0px; margin:0px;'  title='Open' data-toggle='tooltip' data-placement='top'> &nbsp;&nbsp;<i class='lnr lnr-download'></i>&nbsp;&nbsp;</button></td></form></tr>");
	 $n++;					$tco+=$bas; 				$tto+=$bal;
						}
	$tto=number_format($tto, 2);                $tco=number_format($tco, 2);				
						?>
						
                     </tbody>

					 <thead>
					<tr><th class='hidden-xs'> </th><th colspan='5'> Total Amount </th>
					<th><div align='right'><?php echo $tco ?></th>
					<th><div align='right'><?php echo $tto ?></th><th class="hidden-xs hidden-print"><div align='center'> -- </th></tr>
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
	<div style='text-align:center; font-size:24px; color:#ff3333'> Report not available on selected condition </div><br><br><br><br><br><br><br>";
					}  
			}
				   else{
	$do=mysqli_query($cons, "SELECT `Date`, `User`, `Voucher`, COUNT(DISTINCT(`Item`)) AS `CON`, SUM(`Price`*`Quantity`) AS `TOT` FROM `stouse` WHERE `Client`='$code' AND `Action`='SALES' AND `Status`='0' AND `Upda`='1' GROUP BY `Voucher` ORDER BY `Date` ASC");
			if($fo=mysqli_num_rows($do)){
					?>
					<div class="divFooter"><center><u><b>SALES REPORT <?php echo"$mpri"; ?></b></u></center></div>
		 <div class="row">
            <div class="col-lg-12">
             <span> &nbsp;&nbsp; Total Records Found : <b><?php echo $fo ?></b></span>
			 <span class="pull-right hidden-print"><a href="#" onclick="return window.print()" class="hidden-print" title='Click to print' data-toggle='tooltip' data-placement='top'><i class="lnr lnr-printer"></i></a></span>
			  <span class="pull-right"><?php echo $sup ?> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b> <?php echo $per ?>
			  &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; </b></span> 
            <div class="widget-container fluid-height clearfix">
            <div class="widget-content padded clearfix">

			<form action="" method="post">
				<table class="table table-striped table-hover">     
                       <thead><tr role="row">
                     <th width='3%' class="text-center">&nbsp;&nbsp;No&nbsp;&nbsp;</th>
                       <th class='text-center'>&nbsp;&nbsp;&nbsp;DATE&nbsp;&nbsp;&nbsp;&nbsp;</th>
                       <th> CASHIER </th><th> CUSTOMER </th>
                       <th> INVOICE&nbsp;No </th><th> ITEMS </th>
                       <th> PRICE </th><th> QUANTITY </th><th> AMOUNT </th>
						<th class='text-right'> PAYMENT </th>
						<th class='text-right'> BALANCE&nbsp;&nbsp;</th>
                     </tr>
                    </thead>
                                        <tbody>
			
			<?php
				$tba=$tpa=$tto=0;			$n=1;	        $dafo='';	
			while($ro=mysqli_fetch_assoc($do)){
				$user=$ro['User'];
				$tot=$ro['TOT'];
				$toto=number_format($tot, 2);
				$items=$ro['CON'];
				$vous=$ro['Voucher'];
				$dte=$ro['Date'];
				$pr=1;
    
    $sedo=mysqli_query($cons, "SELECT `Date` FROM `stouse` WHERE `Date`>'$dte' AND `Status`='0' AND `Voucher`!='0' AND `Client`='$code' ORDER BY `Date` ASC LIMIT 1");
    $redo=mysqli_fetch_assoc($sedo);
        $daso=$redo['Date'];
				
	$sepac=mysqli_query($cons, "SELECT SUM(`Amount`) AS 'Amo' FROM `payment` WHERE `Status`='0' AND `Client`='$code' AND `Action`='SALES' AND `Pline`!='CREDIT' AND `Voucher`='$vous'");
		$repac=mysqli_fetch_assoc($sepac);
			$pai=$repac['Amo'];
								$stn="padding:0px; font-size:12px;";
			
						$bal+=($tot-$pai);
				$balo=number_format($bal, 2);
				$amoo=number_format($amo, 2);
				$payo=number_format($pai, 2);
        /*
	print("<tr><td style='$stn' class='text-right'>$n&nbsp;&nbsp;</td><td style='$stn' class='text-center'>&nbsp;$dte&nbsp;</td>
	<td style='$stn'>&nbsp;$user&nbsp;</td><td style='$stn'>&nbsp;$cuna&nbsp;</td><td style='$stn' class='text-center'>&nbsp;$vous&nbsp;</td><td style='$stn' class='text-center'>&nbsp;$items&nbsp;</td>
		<td style='$stn' class='text-right'> $toto&nbsp;&nbsp;</td><td style='$stn' class='text-right'> $payo&nbsp;&nbsp;</td>
		<td style='$stn' class='text-right'> $balo&nbsp;&nbsp;</td></tr>");
		*/
		
             $tpa+=$pai;             $tto+=$tot;     
             
    $sse=mysqli_query($cons, "SELECT `stouse`.`Date`, `stouse`.`Price`, `stouse`.`Quantity`, `items`.`Iname` FROM `stouse` INNER JOIN `items` ON `stouse`.`Item` = `items`.`Number` WHERE `stouse`.`Status`='0' AND `stouse`.`Voucher`='$vous' AND `stouse`.`Client`='$code'");
    while($rre=mysqli_fetch_assoc($sse)){
        $item=$rre['Iname'];
        $price=$rre['Price'];               $prico=number_format($price, 2);
        $quanty=$rre['Quantity'];           $quanto=number_format($quanty, 2);
        $date=$rre['Date'];
        $tam=$price*$quanty;                $tamo=number_format($tam, 2);
    print("<tr><td style='$stn' class='text-right'> $n&nbsp;&nbsp;</td><td style='$stn' class='text-center'>&nbsp;$date&nbsp;</td><td style='$stn'>&nbsp;$user&nbsp;</td><td style='$stn'>&nbsp;$cuna&nbsp;</td><td style='$stn' class='text-center'>&nbsp;$vous&nbsp;</td>
	<td style='$stn'>&nbsp;$item&nbsp;</td><td style='$stn' class='text-center'>&nbsp;$prico&nbsp;</td><td style='$stn' class='text-center'>&nbsp;$quanto&nbsp;</td>");
	
	if($pr==1)
		print("<td rowspan='$items' style='$stn' class='text-right'> $toto&nbsp;&nbsp;</td><td rowspan='$items' style='$stn' class='text-right'> $payo&nbsp;&nbsp;</td><td rowspan='$items' style='$stn' class='text-right'> $balo&nbsp;&nbsp;</td>");
		
		print("</tr>");
		$pr++;                  $n++;
    }
	
	$sepap=mysqli_query($cons, "SELECT `Cashier`, SUM(`Amount`) AS 'Amo' FROM `payment` WHERE (`Status`='0' AND `Client`='$code' AND `Action`='PAYMENT' AND `Pline`!='CREDIT' AND `Voucher`='2147483647' AND `Date` >= '$dte' AND `Date` < '$daso' AND `Amount`>'0')");
	if($fepap=mysqli_num_rows($sepap) AND $dafo!=$dte){
	    $repap=mysqli_fetch_assoc($sepap);
	        $user=$repap['Cashier'];
	        $repa=$repap['Amo'];         
	        $payo=number_format($repa, 2);       
	        $bal-=$repa;   
	        $balo=number_format($bal, 2);
	        $stn="padding:0px; color:blue; font-size:12px;";
	        $tpa+=$repa;
	     
	     if($repa)   
	echo"<tr><td style='$stn' class='text-right'>&nbsp;&nbsp;</td><td style='$stn' class='text-center'>&nbsp;$dte&nbsp;</td>
	<td style='$stn'>&nbsp;$user&nbsp;</td><td style='$stn'>&nbsp;$cuna&nbsp;</td><td style='$stn' class='text-center'> -- &nbsp;&nbsp;</td><td style='$stn' class='text-right'>&nbsp;--&nbsp;</td><td style='$stn' class='text-right'>&nbsp;--&nbsp;</td><td style='$stn' class='text-right'>&nbsp;--&nbsp;</td>
	<td style='$stn' class='text-right'> -- &nbsp;&nbsp;</td><td style='$stn' class='text-right'> $payo&nbsp;&nbsp;</td>
		<td style='$stn' class='text-right'> $balo&nbsp;&nbsp;</td></tr>";
	       }
    	            $dafo=$dte;
	
						}
						
	$sepap=mysqli_query($cons, "SELECT `Cashier`, `Amount`, `Pline` FROM `payment` WHERE (`Status`='0' AND `Client`='$code' AND `Action`='PAYMENT' AND `Pline`!='CREDIT' AND `Voucher`='2147483647' AND `Date` >= '$date' AND `Date` <= '$Date' AND `Amount`>'0')");
	if($fepap=mysqli_num_rows($sepap)){
	    while($repap=mysqli_fetch_assoc($sepap)){
	        $user=$repap['Cashier'];
	        $repa=$repap['Amount'];  
	        $pli=$repap['Pline'];       
	        $payo=number_format($repa, 2);       
	        $bal-=$repa;   
	        $balo=number_format($bal, 2);
	        $stn="padding:0px; color:blue; font-size:12px;";
	        $tpa+=$repa;
	     
	     if($repa)   
	        echo"<tr>
		<td style='$stn' class='text-right'>&nbsp;&nbsp;</td><td style='$stn' class='text-center'>&nbsp;$dte&nbsp;</td>
	<td style='$stn'>&nbsp;$user&nbsp;</td><td style='$stn'>&nbsp;$cuna&nbsp;</td><td style='$stn' class='text-center'> -- &nbsp;&nbsp;</td><td style='$stn'>&nbsp;$pli</td><td style='$stn' class='text-right'>&nbsp;--&nbsp;</td><td style='$stn' class='text-right'>&nbsp;--&nbsp;</td>
		<td style='$stn' class='text-right'> -- &nbsp;&nbsp;</td><td style='$stn' class='text-right'> $payo&nbsp;&nbsp;</td>
		<td style='$stn' class='text-right'> $balo&nbsp;&nbsp;</td></tr>";
	    }
	}
					
	
					
				   $pao=number_format($tpa, 2);
			$tot=number_format($tto, 2);	

				  print("<th class='text-center' colspan='6'>CLOSING BALANCE</th>
				  <th class='text-right'> </th><th> </th>
				  <th class='text-right'> $tot </th>
				  <th class='text-right'> $pao </th>
				  <th class='text-right'> $balo </th></table><br><br>");
				}
					else{
						echo"<div class='row'>
            <div class='col-lg-12' style='margin-top:-20px;'>
             <span> &nbsp;&nbsp; Total Records Found : <b> 0 </b></span>
			 <span class='pull-right hidden-print'> $bra &nbsp;&nbsp;<a href='#' onclick='return window.print()' class='hidden-print' title='Click to print' data-toggle='tooltip' data-placement='top'><i class='lnr lnr-printer'></i></a></span>
            <div class='widget-container fluid-height clearfix'>
            <div class='widget-content padded clearfix'>
			<br><br><br><br><br><br>
	<div style='text-align:center; font-size:24px; color:#ff9999'> Report not available on selected condition </div><br><br><br><br><br><br><br>";
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