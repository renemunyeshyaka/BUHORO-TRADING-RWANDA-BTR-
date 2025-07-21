<?php
if(basename($_SERVER['PHP_SELF']) == 'dayrepo.php') 
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
		//	$brc=$_POST['brc'];
			$dato=$_POST['dato'];
			$datos=$_POST['datos'];
			$custo=$_POST['custo'];
			$p=1;
		}

		if($dato==$datos)
			$mpri="ON $dato";
		else
			$mpri="FROM $dato TO $datos";

	if($brc=='0' OR $brc=='')
		$conde="";
	else
		$conde="AND `Branche`='$brc'";

		if($custo=='DAY-WISE')
			$g='selected';
		else
			$g='';

$rece=mysql_query("SELECT `Name` FROM `branches` WHERE `Number`='$brc' ORDER BY `Number` DESC LIMIT 1");
				$recet=mysql_fetch_assoc($rece);
					$bra=$recet['Name'];
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

	 <li class="list-group-item active">
	  <a href="dayrepo.php">
                <p>
                <i class="lnr lnr-menu-circle"></i>&nbsp;Income Report
                </p>
              </a></li> 
                         
            </ul>
  </div>  
           
       
        <div class="col-lg-10">
                  <div class="row">
         
           <div class="col-lg-2"> </div>
          
         
           

        <form action="" method="post" class="form-horizontal ">                  
                       <div class="col-lg-10 hidden-print">
                           <div class="col-lg-2"> 		   </div> 
                       
                       <div class="col-lg-3"> 
					 <select class="form-control" name="custo">
			   <option value='' selected>ALL ITEMS</option>
			   <option value='DAY-WISE' <?php echo $g ?>>DAY-WISE</option></select></div>  
					   
					   
            <div class="col-lg-2"> 
           <div class="input-group date datepicker">
      <input class="form-control form-center" id="from" name="dato" type="text" value="<?php echo $dato ?>" onkeypress="return isNumberKey(event)" style="padding-left:2px; padding-right:2px;" required><span class="input-group-addon"><i class="lnr lnr-calendar-full"></i></span>
			</div></div>


		  <div class="col-lg-2"> 
           <div class="input-group date datepicker">	
      <input class="form-control form-center" id="to" name="datos" type="text" value="<?php echo $datos ?>" onkeypress="return isNumberKey(event)" style="padding-left:2px; padding-right:2px;" required><span class="input-group-addon"><i class="lnr lnr-calendar-full"></i></span>
              </div></div>                      
                       
                       <div class="col-lg-2">
                        <button class="btn  btn-primary btn-block" type="submit" name="search"><i class="lnr lnr-magnifier"></i> Search</button>
                   
					  </div>
                         </div> 
                      
                     
                  
            </form> 
             
               
            </div>
               <?php
			  if($custo==''){
		$i=1;				$ptu=0;				
$dori=mysql_query("SELECT *FROM `stouse` WHERE `Voucher`!='0' AND `Date` BETWEEN '$dato' AND '$datos' AND `Action`='SALES' AND `Status`='0' $conde ORDER BY `Date` ASC");
				if($fox=mysql_num_rows($dori)){
					?>
					<div class="divFooter"><center><u><b>INCOME REPORT <?php echo"$mpri"; ?></b></u></center></div>
		 <div class="row">
            <div class="col-lg-12">
             <span> &nbsp;&nbsp; Total Records Found : <b><?php echo" $fox " ?></b></span>
			 <span class="pull-right hidden-print"><?php echo $bra ?>&nbsp;&nbsp;&nbsp;&nbsp;
			 <a href="#" onclick="return window.print()" class="hidden-print" title='Click to print' data-toggle='tooltip' data-placement='top'>
			 <i class="lnr lnr-printer"></i></a></span>
            <div class="widget-container fluid-height clearfix">
            <div class="widget-content padded clearfix">
			
			<?php			 
       echo"<form action='' method='post'><table class='table table-striped table-hover'>
				<thead><tr style='background-color:#ffffff;'>
              <td style='background-color:#ffffff;' width='6%' class='text-center'> # </td>
              <td class='text-center' style='background-color:#ffffff;'> Due&nbsp;Date </td>
			  <td style='background-color:#ffffff;'> Customer </td>
              <td style='background-color:#ffffff;' class='text-center'> Item&nbsp;Name </td>
			  <td style='background-color:#ffffff;'> Cost&nbsp;Price </td>
              <td style='background-color:#ffffff;' class='text-center'>Sales&nbsp;Price</td>
              <td style='background-color:#ffffff;' class='text-center'>Quantity</td>
              <td style='background-color:#ffffff;' class='text-center'>Total&nbsp;Cost</td>
              <td style='background-color:#ffffff;' class='text-center'>Total&nbsp;Sales</td>
              <td style='background-color:#ffffff;' class='text-center'>Income</td>
					</tr></thead>
                                        <tbody>";
					$ptu=$pcu=0;
			while($rori=mysql_fetch_assoc($dori)){
				$qtu=$rori['Quantity'];					$qtuo=number_format($qtu, 2);
				$pru=$rori['Price'];					$pruo=number_format($pru, 2);
				$desu=$rori['Destin'];
				$tut=$qtu*$pru;							$tuto=number_format($tut, 2);
				$dtu=$rori['Date'];
				$item=$rori['Item'];						
				$cost=$rori['Cost'];					$costo=number_format($cost, 2);
				$toc=$qtu*$cost;						$toco=number_format($toc, 2);
				$bal=$tut-$toc;							$balo=number_format($bal, 2);
				
				if($tut<$toc)
					$stn="padding:0px; color:#ff3333";
				else
					$stn="padding:0px;";

	$dov=mysql_query("SELECT *FROM `items` WHERE `Number`='$item' ORDER BY `Number` DESC LIMIT 1");
		$rov=mysql_fetch_assoc($dov);
			$ipri=$rov['Price'];
			$iname=$rov['Iname'];

print("<tr><td style='$stn'><div align='right'> $i &nbsp;&nbsp; </td>
<td class='text-center' style='$stn'> $dtu&nbsp;</td><td style='$stn'> $desu </td>
<td style='$stn'>&nbsp;$iname </td><td style='$stn'><div align='right'> $costo&nbsp;&nbsp;</td>

<td style='$stn'><div align='right'> $pruo&nbsp;&nbsp;</td><td style='$stn'><div align='right'> $qtuo&nbsp;&nbsp;</td>
<td style='$stn'><div align='right'> $toco&nbsp;&nbsp;</td><td style='$stn'><div align='right'> $tuto&nbsp;&nbsp;</td>
<td style='$stn'><div align='right'> $balo&nbsp;&nbsp;</td></tr>");
$i++;					$ptu+=$tut;						$pcu+=$toc;								
}

		$bal=number_format($ptu-$pcu, 2);							$ptu=number_format($ptu, 2);						$pcu=number_format($pcu, 2);
print("</tbody><thead><tr><th colspan='7'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Total Amount</th>
<th class='text-right'> $pcu</th><th class='text-right'> $ptu</th><th class='text-right'> $bal</th></tr></thead></table>");
				}
					else{
						echo"<div class='row'>
            <div class='col-lg-12' style='margin-top:-20px;'>
             <span> &nbsp;&nbsp; Total Records Found : <b> 0 </b></span>
			 <span class='pull-right hidden-print'> $bra &nbsp;&nbsp;<a href='#' onclick='return window.print()' class='hidden-print' title='Click to print' data-toggle='tooltip' data-placement='top'><i class='lnr lnr-printer'></i></a></span>
            <div class='widget-container fluid-height clearfix'>
            <div class='widget-content padded clearfix'>
			<br><br><br><br><br><br>
						<div style='text-align:center; font-size:24px; color:#ff9999'> Report not available on selected date </div><br><br><br><br><br><br><br>";
					}
			}
			else{



$dox=mysql_query("SELECT *FROM `stouse` WHERE `Voucher`!='0' AND `Date` BETWEEN '$dato' AND '$datos' AND `Action`='SALES' AND `Status`='0' $conde GROUP BY `Date` ORDER BY `Date` ASC");
				if($fox=mysql_num_rows($dox)){
					?>
					<div class="divFooter"><center><u><b>INCOME REPORT <?php echo"$mpri"; ?></b></u></center></div>
		 <div class="row">
            <div class="col-lg-12">
             <span> &nbsp;&nbsp; Total Records Found : <b><?php echo" $fox " ?></b></span>
			 <span class="pull-right hidden-print"><?php echo $bra ?>&nbsp;&nbsp;&nbsp;&nbsp;
			 <a href="#" onclick="return window.print()" class="hidden-print" title='Click to print' data-toggle='tooltip' data-placement='top'>
			 <i class="lnr lnr-printer"></i></a></span>
            <div class="widget-container fluid-height clearfix">
            <div class="widget-content padded clearfix">
			
			<?php			 
       echo"<form action='' method='post'><table class='table table-striped'>
				<thead><tr style='background-color:#ffffff;'>
              <td style='background-color:#ffffff;' width='6%' class='text-center'> # </td>
              <td class='text-center' style='background-color:#ffffff;'> Due&nbsp;Date </td>
			  <td style='background-color:#ffffff;'> Day </td>
              <td style='background-color:#ffffff;' class='text-center'> Sales </td>
			  <td style='background-color:#ffffff;' class='text-center'> Items </td>
              <td style='background-color:#ffffff;' class='text-center'>Total&nbsp;Cost</td>
              <td style='background-color:#ffffff;' class='text-center'>Total&nbsp;Sales</td>
              <td style='background-color:#ffffff;' class='text-center'>Income</td>
              <td style='background-color:#ffffff;' class='text-center'>Payout</td>
              <td style='background-color:#ffffff;' class='text-center'>Balance</td>
					</tr></thead>
                                        <tbody>";
				$i=1;                               $tam=$tba=0;
		while($rox=mysql_fetch_assoc($dox)){
				$dte=$rox['Date'];	

	$dor=mysql_query("SELECT SUM(Quantity*Cost) AS 'Cost', SUM(Quantity*Price) AS 'Sales' FROM `stouse` WHERE `Voucher`!='0' AND `Date`='$dte' AND `Action`='SALES' AND `Status`='0' $conde ORDER BY `Number` ASC");
				$ror=mysql_fetch_assoc($dor);
				$toc=$ror['Cost'];							$tut=$ror['Sales'];
			$tuto=number_format($tut, 2);										$toco=number_format($toc, 2);
				$inco=$tut-$toc;						
				$incoo=number_format($inco, 2);

    	$spa=mysql_query("SELECT SUM(`Amount`) AS `Amon` FROM `payment` WHERE `Voucher`!='0' AND `Status`='0' AND `Date`='$dte' AND `Action`='PAYOUT' $conde ORDER BY `Number` ASC");
				$rpa=mysql_fetch_assoc($spa);
						$amo=$rpa['Amon'];					
				$amoo=number_format($amo, 2);
				        $bal=$inco-$amo;
				$balo=number_format($bal, 2);

	$dos=mysql_query("SELECT *FROM `stouse` WHERE `Voucher`!='0' AND `Date`='$dte' AND `Action`='SALES' AND `Status`='0' $conde GROUP BY `Destin` ORDER BY `Destin` ASC");
						$fos=mysql_num_rows($dos);

	$doi=mysql_query("SELECT *FROM `stouse` WHERE `Voucher`!='0' AND `Date`='$dte' AND `Action`='SALES' AND `Status`='0' $conde GROUP BY `Item` ORDER BY `Item` ASC");
						$foi=mysql_num_rows($doi);
				
				if($tut<$toc)
					$stn="padding:0px; color:#ff3333";
				else
					$stn="padding:0px;";

$dname = date('l', strtotime($dte));

print("<tr><td style='$stn'><div align='right'> $i &nbsp;&nbsp; </td>
<td class='text-center' style='$stn'> $dte&nbsp;</td><td style='$stn'> $dname </td>
<td class='text-center' style='$stn'> $fos </td><td class='text-center' style='$stn'><div align='center'> $foi </td>

<td style='$stn'><div align='right'> $toco&nbsp;&nbsp;</td><td style='$stn'><div align='right'> $tuto&nbsp;&nbsp;</td>
<td style='$stn'><div align='right'> $incoo&nbsp;&nbsp;</td>
<td style='$stn'><div align='right'> $amoo&nbsp;&nbsp;</td>
<td style='$stn'><div align='right'> $balo&nbsp;&nbsp;</td></tr>");
$i++;					$ptu+=$tut;						$pcu+=$toc;	
$tam+=$amo;                         $tba+=$bal;
}

		$inc=number_format($ptu-$pcu, 2);
		$tam=number_format($tam, 2);	
		$tba=number_format($tba, 2);			
		$ptu=number_format($ptu, 2);				
		$pcu=number_format($pcu, 2);
print("</tbody><thead><tr><th colspan='5'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Total Amount</th>
<th class='text-right'> $pcu</th><th class='text-right'> $ptu</th>
<th class='text-right'> $inc</th><th class='text-right'> $tam</th>
<th class='text-right'> $tba</th></tr></thead></table>");
				}
					else{
						echo"<div class='row'>
            <div class='col-lg-12' style='margin-top:-20px;'>
             <span> &nbsp;&nbsp; Total Records Found : <b> 0 </b></span>
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