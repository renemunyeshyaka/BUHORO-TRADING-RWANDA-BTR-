<?php
if(basename($_SERVER['PHP_SELF']) == 'recorepo.php') 
  $cm=" class='current'";
include'header.php';
include'connection.php';
$dato = strtotime("-2 days", strtotime("$Date"));
$dato = date ("Y-m-d", $dato);
$datos=$Date;
$custo=$condi='';
$conde='';
$t=$p=0;

// search for an item to be added to the chart
if(isset($_POST['search']))
		{
			$custo=$_POST['custo'];
			$dato=$_POST['dato'];
			$datos=$_POST['datos'];
		}

		if($dato==$datos)
			$mpri="ON $dato";
		else
			$mpri="FROM $dato TO $datos";

	if($custo){
		$conde="AND `Client`='$custo'";
	}
?>
<div class="container-fluid main-content">
        <div class="page-title hidden-print">
          <h3 style='margin-top:-20px; margin-bottom: 5px; color:#ffcc33'>
         Sales Report
          </h3>
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
              
    <li class="list-group-item active">
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
                <i class="lnr lnr-menu-circle"></i>&nbsp;Control Report
                </p>
              </a></li>    

	 <li class="list-group-item">
	  <a href="balrepo.php">
                <p>
                <i class="lnr lnr-menu-circle"></i>&nbsp;Balance Report
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
         
           <div class="col-lg-3"> </div>
          
         
           

        <form action="" method="post" class="form-horizontal ">                  
                       <div class="col-lg-3"> 
	<select class="form-control" name="custo" style='padding-right:5px;' required><?php
echo"<option value='0' selected='selected'> SELECT CUSTOMER </option>";
	$seek=mysqli_query($cons, "SELECT `Client`, `Destin` FROM `stouse` WHERE `Destin`!='' AND `Status`='0' AND `Upda`='1' AND `Action`='SALES' GROUP BY `Destin` ORDER BY `Destin` ASC LIMIT 1800");
			if($feek=mysqli_num_rows($seek)){
		while($roi=mysqli_fetch_assoc($seek)){
				$fna=$roi['Destin'];
				$cli=$roi['Client'];
				if($custo==$cli){
					$s='selected';
					$cust=$fna;
				}
				else
					$s=$cust='';
			echo"<option value='$cli' $s> $fna </option>";
			}
			}

			?>			    
            </select>
					   </div>
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
			  
	$do=mysqli_query($cons, "SELECT `Date`, `User`, `Voucher`, `Destin`, `Client`, COUNT(DISTINCT(`Item`)) AS `CON`, SUM(`Price`*`Quantity`) AS `TOT` FROM `stouse` WHERE `Date` BETWEEN '$dato' AND '$datos' AND `Action`='SALES' AND `Status`='0' AND `Upda`='1' $conde GROUP BY `Voucher` ORDER BY `Date` ASC");
			if($fo=mysqli_num_rows($do)){
					?>
					<div class="divFooter"><center><u><b>RECOVERY REPORT <?php echo"$mpri"; ?></b></u></center></div>
		 <div class="row">
            <div class="col-lg-12">
             <span> &nbsp;&nbsp; Total Records Found : <b><?php echo" $fo " ?></b></span>
			 <span class="pull-right hidden-print"><?php echo $cust ?>&nbsp;&nbsp;&nbsp;&nbsp;
			 <a href="#" onclick="return window.print()" class="hidden-print" title='Click to print' data-toggle='tooltip' data-placement='top'>
			 <i class="lnr lnr-printer"></i></a></span>
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
                $bal=0;
	        $stn="padding:0px; color:blue; font-size:12px;";
        $sepac=mysqli_query($cons, "SELECT SUM(`Price`*`Quantity`) AS 'Sale' FROM `stouse` WHERE `Status`='0' AND `Action`='SALES' AND `Voucher`!='0' AND `Upda`='1' AND `Date`<'$dato' $conde");
		$repac=mysqli_fetch_assoc($sepac);
			$bal+=$repac['Sale'];
			
	$sepac=mysqli_query($cons, "SELECT SUM(`Amount`) AS 'Amo' FROM `payment` WHERE `Status`='0' AND `Pline`!='CREDIT' AND `Voucher`!='0' AND `Date`<'$dato' $conde  AND (`Action`='SALES' OR `Action`='PAYMENT')");
		$repac=mysqli_fetch_assoc($sepac);
			$bal-=$repac['Amo'];                $balo=number_format($bal, 2);
			
			 if($bal)   
	   echo"<tr><td style='$stn' class='text-center' colspan='8'> OPENING BALANCE </td><td colspan='3' style='$stn' class='text-right'> $balo&nbsp;&nbsp;</td></tr>";
			
			
				$tba=$tpa=$tto=0;			$n=1;	        $dafo='';	
			while($ro=mysqli_fetch_assoc($do)){
				$user=$ro['User'];
				$tot=$ro['TOT'];
				$toto=number_format($tot, 2);
				$items=$ro['CON'];
				$vous=$ro['Voucher'];
				$dte=$ro['Date'];
				$code=$ro['Client'];
				$cuna=$ro['Destin'];
				$pr=1;
    
        $sedo=mysqli_query($cons, "SELECT `Date` FROM `stouse` WHERE `Date`>'$dte' AND `Status`='0' AND `Voucher`!='0' $conde ORDER BY `Date` ASC LIMIT 1");
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
    print("<tr><td style='$stn' class='text-right'> $n&nbsp;&nbsp;</td><td style='$stn' class='text-center'>&nbsp;$date&nbsp;</td><td style='$stn'>&nbsp;$user&nbsp;</td><td style='$stn'>&nbsp;$cuna&nbsp;</td><td style='$stn' class='text-center'>&nbsp;$vous&nbsp;</td><td style='$stn'>&nbsp;$item&nbsp;</td><td style='$stn' class='text-center'>&nbsp;$prico&nbsp;</td><td style='$stn' class='text-center'>&nbsp;$quanto&nbsp;</td>");
	
	if($pr==1)
		print("<td rowspan='$items' style='$stn' class='text-right'> $toto&nbsp;&nbsp;</td><td rowspan='$items' style='$stn' class='text-right'> $payo&nbsp;&nbsp;</td><td rowspan='$items' style='$stn' class='text-right'> $balo&nbsp;&nbsp;</td>");
		
		print("</tr>");
		$pr++;                  $n++;
    }
	
	$sepap=mysqli_query($cons, "SELECT `Date`, `Cashier`, `Customer`, `Amount`, `Pline` FROM `payment` WHERE (`Status`='0' AND `Action`='PAYMENT' AND `Pline`!='CREDIT' AND `Voucher`='2147483647' AND `Date` >= '$dte' AND `Date` < '$daso' AND `Amount`>'0' $conde)");
	if($fepap=mysqli_num_rows($sepap) AND $dafo!=$dte){
	    while($repap=mysqli_fetch_assoc($sepap)){
	        $user=$repap['Cashier'];
	        $repa=$repap['Amount']; 
	        $cupa=$repap['Customer'];
	        $pli=$repap['Pline'];
	        $dte=$repap['Date'];
	        $payo=number_format($repa, 2);       
	        $bal-=$repa;   
	        $balo=number_format($bal, 2);
	        $stn="padding:0px; color:blue; font-size:12px;";
	        $tpa+=$repa;
	     
	     if($repa)   
	        echo"<tr>
		<td style='$stn' class='text-right'>&nbsp;&nbsp;</td><td style='$stn' class='text-center'>&nbsp;$dte&nbsp;</td>
	<td style='$stn'>&nbsp;$user&nbsp;</td><td style='$stn'>&nbsp;$cupa&nbsp;</td><td style='$stn' class='text-center'> -- &nbsp;&nbsp;</td><td style='$stn'>&nbsp;$pli</td><td style='$stn' class='text-right'>&nbsp;--&nbsp;</td><td style='$stn' class='text-right'>&nbsp;--&nbsp;</td>
		<td style='$stn' class='text-right'> -- &nbsp;&nbsp;</td><td style='$stn' class='text-right'> $payo&nbsp;&nbsp;</td>
		<td style='$stn' class='text-right'> $balo&nbsp;&nbsp;</td></tr>";
	    }
	       }
    	$dafo=$dte;
	
						}
						
	$sepap=mysqli_query($cons, "SELECT `Date`, `Cashier`, SUM(`Amount`) AS 'Amo' FROM `payment` WHERE (`Status`='0' AND `Action`='PAYMENT' AND `Pline`!='CREDIT' AND `Voucher`='2147483647' AND `Date` >= '$date' AND `Date` <= '$datos' AND `Amount`>'0' $conde)");
	if($fepap=mysqli_num_rows($sepap)){
	    $repap=mysqli_fetch_assoc($sepap);
	        $user=$repap['Cashier'];
	        $repa=$repap['Amo']; 
	        $dte=$repap['Date'];
	        $payo=number_format($repa, 2);       
	        $bal-=$repa;   
	        $balo=number_format($bal, 2);
	        $stn="padding:0px; color:blue; font-size:12px;";
	        $tpa+=$repa;
	     
	     if($repa)   
	        echo"<tr>
		<td style='$stn' class='text-right'>&nbsp;&nbsp;</td><td style='$stn' class='text-center'>&nbsp;$dte&nbsp;</td>
	<td style='$stn'>&nbsp;$user&nbsp;</td><td style='$stn'>&nbsp;$cuna&nbsp;</td><td style='$stn' class='text-center'> -- &nbsp;&nbsp;</td><td style='$stn' class='text-right'>&nbsp;--&nbsp;</td><td style='$stn' class='text-right'>&nbsp;--&nbsp;</td><td style='$stn' class='text-right'>&nbsp;--&nbsp;</td>
		<td style='$stn' class='text-right'> -- &nbsp;&nbsp;</td><td style='$stn' class='text-right'> $payo&nbsp;&nbsp;</td>
		<td style='$stn' class='text-right'> $balo&nbsp;&nbsp;</td></tr>";
		
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