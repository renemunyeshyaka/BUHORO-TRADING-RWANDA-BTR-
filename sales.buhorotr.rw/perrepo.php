<?php
if(basename($_SERVER['PHP_SELF']) == 'perrepo.php') 
  $cm=" class='current'";
include'header.php';
include'connection.php';
$dato=$datos=$Date;
$custo=$conde=$condi='';
$p=0;

// search for an item to be added to the chart
if(isset($_POST['search']))
		{
			$dato=$_POST['dato'];
			$datos=$_POST['datos'];
			$custo=$_POST['custo'];
			$p=1;
		}

	
		if($dato==$datos)
			$mpri="ON $dato";
		else
			$mpri="FROM $dato TO $datos";

if($custo)
$conde="AND `Seller`='$custo'";

$fo=1;
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

    <li class="list-group-item">
	  <a href="deporepo.php">
                <p>
                <i class="lnr lnr-menu-circle"></i>&nbsp;Deposit Report
                </p>
              </a></li>  

	 <li class="list-group-item">
	  <a href="withrepo.php">
                <p>
                <i class="lnr lnr-menu-circle"></i>&nbsp;Withdrawal Report
                </p>
              </a></li> 
      
    <li class="list-group-item">
	  <a href="staterepo.php">
                <p>
                <i class="lnr lnr-menu-circle"></i>&nbsp;Bank Statement
                </p>
              </a></li>             
      
    <li class="list-group-item">
	  <a href="weekrepo.php">
                <p>
                <i class="lnr lnr-menu-circle"></i>&nbsp;Weekly Report
                </p>
              </a></li>                    
      
    <li class="list-group-item">
	  <a href="cashrepo.php">
                <p>
                <i class="lnr lnr-menu-circle"></i>&nbsp;Cashbox Report
                </p>
              </a></li>       
      
    <li class="list-group-item">
	  <a href="payoutrepo.php">
                <p>
                <i class="lnr lnr-menu-circle"></i>&nbsp;Payout Report
                </p>
              </a></li>           
      
    <li class="list-group-item">
	  <a href="cosales.php">
                <p>
                <i class="lnr lnr-menu-circle"></i>&nbsp;Sales Report
                </p>
              </a></li>                 
      
    <li class="list-group-item active">
	  <a href="perrepo.php">
                <p>
                <i class="lnr lnr-menu-circle"></i>&nbsp;Performance Report 1
                </p>
              </a></li>                     
      
    <li class="list-group-item">
	  <a href="perrepos.php">
                <p>
                <i class="lnr lnr-menu-circle"></i>&nbsp;Performance Report 2
                </p>
              </a></li>                      
      
    <li class="list-group-item">
	  <a href="perrepot.php">
                <p>
                <i class="lnr lnr-menu-circle"></i>&nbsp;Performance Report 3
                </p>
              </a></li>                            
            </ul>
  </div>
                    
           
           
       
        <div class="col-lg-10">
                  <div class="row">
         
           <div class="col-lg-6 hidden-print"><div class="col-lg-2"> </div>
          
         
           

        <form action="" method="post" class="form-horizontal "> 
        <div class="col-lg-5">  </div>
                       <div class="col-lg-5">  
		<select class="form-control" name="custo" style='padding-right:5px;'>
			   <?php
echo"<option value='' selected='selected'> SELECT SELLER </option>";
	$seek=mysql_query("SELECT `Seller` FROM `payment` WHERE `Seller`!='' AND `Status`='0' AND `Action`='SALES' GROUP BY `Seller` ORDER BY `Seller` ASC LIMIT 30");
			if($feek=mysql_num_rows($seek)){
		while($roi=mysql_fetch_assoc($seek)){
				$fna=$roi['Seller'];
				if($custo==$fna)
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
				   if($p=='0')
		$do=mysql_query("SELECT `Date`, SUM(`Amount`) AS `Amo` FROM `payment` WHERE `Action`='SALES' AND `Seller`!='' GROUP BY `Date` ORDER BY `Date` DESC LIMIT 1");
				   else
		$do=mysql_query("SELECT `Date`, SUM(`Amount`) AS `Amo` FROM `payment` WHERE `Date` BETWEEN '$dato' AND '$datos' AND `Action`='SALES' AND `Seller`!='' $conde GROUP BY `Date` ORDER BY `Date` ASC LIMIT 4000");
				if($fo=mysql_num_rows($do)){
				   ?>
                 <div class="divFooter"><center><u><b>PERFORMANCE REPORT <?php echo $mpri ?></b></u></center></div>
             <div class="row">
            <div class="col-lg-12">
             <span> &nbsp;&nbsp; Total Records Found : <b><?php echo" $fo " ?></b></span> 
			 <span class="pull-right"><?php echo $bra ?>&nbsp;&nbsp;&nbsp;&nbsp;<a href="#" onclick="return window.print()" class="hidden-print" title='Click to print' data-toggle='tooltip' data-placement='top'><i class="lnr lnr-printer"></i></a></span>
			 
			 <span class="pull-right hidden-print">
		&nbsp;&nbsp;&nbsp;&nbsp;<a href="#" id="exporttable" class="hidden-print" title='Export to excell' data-toggle='tooltip' data-placement='top'><i class="lnr lnr-line-spacing"></i></a></span>
            <div class="widget-container fluid-height clearfix">
            <div class="widget-content padded clearfix">

								 <form action="" method="post" class="form-horizontal "> 
				<table class="table table-striped table-hover" id='htmltable'>     
                                      <thead>
                    <tr role="row"> 
                       <th class='text-center'> Date  </th>
                       <th> Seller </th>
                       <th style='text-align:center;'> Sales </th>
                       <th style='text-align:center;'> Cash </th>
                       <th style='text-align:center;'> Deposit </th>
                       <th style='text-align:center;'> Cheque </th>
                       <th style='text-align:center;'> Credit </th>
					   <th style='text-align:center;'> Total </th>
					   <th style='text-align:center;'> Percentage </th></tr>
                    </thead>
                                        <tbody>
					<?php
    $n=1;	                	$tsa=$tca=$tde=$tche=$tcre=$all=$tam=0;
    		
    		$asa=$aca=$ade=$ache=$acre=$asel=array();
    		
    $stn="padding:1px;";                $stl="padding:1px;color:powderblue;";
		while($ro=mysql_fetch_assoc($do)){
				$dte=$ro['Date'];
				$amo=$ro['Amo'];
				
				$itsa=$itca=$itde=$itche=$itcre=0;
	$dor=mysql_query("SELECT `Seller`, COUNT(DISTINCT(`Voucher`)) AS `Sales`, SUM(IF(`Pline`='CASH', `Amount`,0)) AS `Cash`, SUM(IF(`Pline`='BANK', `Amount`,0)) AS `Deposit`, SUM(IF(`Pline`='CHEQUE', `Amount`,0)) AS `Cheque`, SUM(IF(`Pline`='CREDIT', `Amount`,0)) AS `Credit` FROM `payment` WHERE `Date`='$dte' AND `Status`='0' AND `Action`='SALES' AND `Seller`!='' $conde GROUP BY `Seller` ORDER BY `Sales` DESC");
        	$for=mysql_num_rows($dor);
        	if($for>$all)
        	    $all=$for;
				
	print("<tr><td class='text-center' style='$stn' rowspan='$for'>$dte</td>");
    
    
		while($ror=mysql_fetch_assoc($dor)){
				$seller=$ror['Seller'];
				$sales=$ror['Sales'];
				$cash=$ror['Cash'];
				$casho=number_format($cash);
				$deposit=$ror['Deposit'];
				$deposito=number_format($deposit);
				$cheque=$ror['Cheque'];
				$chequeo=number_format($cheque);
				$credit=$ror['Credit'];
				$credito=number_format($credit);
				$tosa=$cash+$cheque+$credit+$deposit;
				$tosao=number_format($tosa);
				
				$per=number_format($tosa/$amo*100, 2);
				
		print("<td style='$stn'> $seller </td>
		<td style='text-align:center; $stn'> $sales </td>
		<td style='text-align:right; $stn'> $casho </td>
		<td style='text-align:right; $stn'> $deposito </td>
		<td style='text-align:right; $stn'> $chequeo </td>
		<td style='text-align:right; $stn'> $credito </td>
		<td style='text-align:right; $stn'> $tosao </td>
		<td style='text-align:right; $stn'> $per % &nbsp; </td></tr>");
		$itsa+=$sales;
		$itca+=$cash;
		$itde+=$deposit;
		$itche+=$cheque;
		$itcre+=$credit;
		
			$asa[$seller]+=$sales;
			$aca[$seller]+=$cash;
			$ade[$seller]+=$deposit;
			$ache[$seller]+=$cheque;
			$acre[$seller]+=$credit;
			$asel[$seller]=$seller;
						}
						
			if($custo==''){
						$itsao=number_format($itsa);
						$itcao=number_format($itca);
						$itdeo=number_format($itde);
						$itcheo=number_format($itche);
						$itcreo=number_format($itcre);
						$tosa=$itca+$itde+$itche+$itcre;
						$tosao=number_format($tosa);
	echo"<tr><th colspan='2' style='text-align:center; $stl'> Total Amount [$dte]</th>
	<th style='text-align:center; $stl'> $itsao </th>
	<th style='text-align:right; $stl'> $itcao </th>
	<th style='text-align:right; $stl'> $itdeo </th>
	<th style='text-align:right; $stl'> $itcheo </th>
	<th style='text-align:right; $stl'> $itcreo </th>
	<th style='text-align:right; $stl'> $tosao </th>
	<th style='text-align:right; $stl'> 100.00 % &nbsp;</th></tr>";
	            $tam+=$tosa;
			}
						
		$tsa+=$itsa;
		$tca+=$itca;
		$tde+=$itde;
		$tche+=$itche;
		$tcre+=$itcre;
						$n++;
}
						$tsao=number_format($tca+$tde+$tche+$tcre);
						$tsa=number_format($tsa);	
						$tca=number_format($tca);	
						$tde=number_format($tde);	
						$tche=number_format($tche);	
						$tcre=number_format($tcre);		
						?>
						
                     </tbody>
<?php
if($dato!=$datos){
                        if($custo==''){
 	$dor=mysql_query("SELECT `Seller`, COUNT(DISTINCT(`Voucher`)) AS `Sales`, SUM(IF(`Pline`='CASH', `Amount`,0)) AS `Cash`, SUM(IF(`Pline`='BANK', `Amount`,0)) AS `Deposit`, SUM(IF(`Pline`='CHEQUE', `Amount`,0)) AS `Cheque`, SUM(IF(`Pline`='CREDIT', `Amount`,0)) AS `Credit` FROM `payment` WHERE `Date` BETWEEN '$dato' AND '$datos' AND `Status`='0' AND `Action`='SALES' AND `Seller`!='' GROUP BY `Seller` ORDER BY `Sales` DESC");
        	$for=mysql_num_rows($dor);
				
	print("<tr title='$tam'><td class='text-center' style='$stn' rowspan='$for'>From:$dato 
	<br> To:$datos</td>");
    
    
		while($ror=mysql_fetch_assoc($dor)){
				$seller=$ror['Seller'];
				$sales=$ror['Sales'];
				$cash=$ror['Cash'];
				$casho=number_format($cash);
				$deposit=$ror['Deposit'];
				$deposito=number_format($deposit);
				$cheque=$ror['Cheque'];
				$chequeo=number_format($cheque);
				$credit=$ror['Credit'];
				$credito=number_format($credit);
				$tosa=$cash+$cheque+$credit+$deposit;
				$tosao=number_format($tosa);
				
				$per=number_format($tosa/$tam*100, 2);
				
		print("<td style='$stn'> $seller </td>
		<td style='text-align:center; $stn'> $sales </td>
		<td style='text-align:right; $stn'> $casho </td>
		<td style='text-align:right; $stn'> $deposito </td>
		<td style='text-align:right; $stn'> $chequeo </td>
		<td style='text-align:right; $stn'> $credito </td>
		<td style='text-align:right; $stn'> $tosao </td>
		<td style='text-align:right; $stn'> $per % &nbsp; </td></tr>");   
		}
        
    }
    ?>
					 <thead>
		<tr><th colspan='2' style='color:blue;'><div align='center'> Grand Total [All Sellers] </th>
		<th style='padding:1px;color:blue;'><div align='center'><?php echo $tsa ?></th>
		<th style='padding:1px;color:blue;'><div align='right'><?php echo $tca ?></th>
		<th style='padding:1px;color:blue;'><div align='right'><?php echo $tde ?></th>
		<th style='padding:1px;color:blue;'><div align='right'><?php echo $tche ?></th>
		<th style='padding:1px;color:blue;'><div align='right'><?php echo $tcre ?></th>
	<th style='padding:1px;color:blue;'><div align='right'><?php echo $tsao ?></th><th style='padding:1px;color:blue;'><div align='right'> 100.00 % &nbsp;</th></tr>
	
	<?php
}
?>
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
			
					?>
                                      
                
              </div>
            </div></div>
                  </div>                  
                <span class="pull-right hidden-print">
			 &nbsp;&nbsp;&nbsp;&nbsp;<a href="#" onclick="return window.print()" class="hidden-print" title='Click to print' data-toggle='tooltip' data-placement='top'><i class="lnr lnr-printer"></i></a></span>
			 
			 <span class="pull-right hidden-print">
		&nbsp;&nbsp;&nbsp;&nbsp;<a href="#" id="exporttable" class="hidden-print" title='Export to excell' data-toggle='tooltip' data-placement='top'><i class="lnr lnr-line-spacing"></i></a></span>
      
   </div></div></div>  
   <?php
   include'footer.php';
   ?>
