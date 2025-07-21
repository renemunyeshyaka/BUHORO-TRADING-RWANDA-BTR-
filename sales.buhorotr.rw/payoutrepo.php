<?php
if(basename($_SERVER['PHP_SELF']) == 'payoutrepo.php') 
  $cm=" class='current'";
include'header.php';
include'connection.php';
$custo='';
$conde='';
$dato=$datos=$Date;

// search request by date
if(isset($_POST['search']))
		{
			$custo=$_POST['custo'];
			$dato=$_POST['dato'];
			$datos=$_POST['datos'];
				$p=1;
		}

		if($dato==$datos)
			$mpri="ON $dato";
		else
			$mpri="FROM $dato TO $datos";
			
			if($custo)
			    $conde="AND `Payto`='$custo'";
?>

<div class="container-fluid main-content">
        <div class="page-title hidden-print">
          <h2 style='margin-top:-20px; margin-bottom: 5px; color:#ffcc33'>
        Operations Report
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
      
    <li class="list-group-item active">
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
      
    <li class="list-group-item">
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
         
           <div class="col-lg-2"> </div>
          
         
           

        <form action="" method="post" class="form-horizontal ">                  
                       <div class="col-lg-10 hidden-print">
                           <div class="col-lg-2"> </div><div class="col-lg-3"> 
		<select class="form-control" name="custo" style='padding-right:5px;'>
			   <?php
echo"<option value='0' selected='selected'> SELECT DESTINATION </option>";
	$seek=mysql_query("SELECT `Payto` FROM `payment` WHERE `Status`='0' AND `Upda`='1' AND `Action`='PAYOUT' GROUP BY `Payto` ORDER BY `Payto` ASC LIMIT 58");
			if($feek=mysql_num_rows($seek)){
		while($roi=mysql_fetch_assoc($seek)){
				$fna=$roi['Payto'];
				if($custo==$fna)
					$s='selected';
				else
					$s='';
			echo"<option value='$fna' $s> $fna </option>";
			}
			}

			?>			    
            </select>					
					   </div><div class="col-lg-7">
             <div class="col-lg-4"> 
           <div class="input-group date datepicker">
      <input class="form-control form-center" id="from" name="dato" type="text" value="<?php echo $dato ?>" onkeypress='return isNumberKey(event)' required>
	  <span class="input-group-addon"><i class="lnr lnr-calendar-full"></i></span>
			</div></div>


		  <div class="col-lg-4"> 
           <div class="input-group date datepicker">	
      <input class="form-control form-center" id="to" name="datos" type="text" value="<?php echo $datos ?>" onkeypress='return isNumberKey(event)' required>
	  <span class="input-group-addon"><i class="lnr lnr-calendar-full"></i></span>
              </div></div>                     
                       
                       <div class="col-lg-3"><?php echo"<input type='hidden' name='pg' value='$pg'>"; ?>
                        <button class="btn  btn-primary btn-block" type="submit" name="search"><i class="lnr lnr-magnifier"></i> Search</button>
                   
					  </div></div>
                         </div></form>               
            </div>
               <?php
				if($p)
		$dok=mysqli_query($cons, "SELECT *FROM `payment` WHERE `Status`='0' AND `Date` BETWEEN '$dato' AND '$datos' AND `Action`='PAYOUT' $conde ORDER BY `Date` ASC LIMIT 1000");
				else
		$dok=mysqli_query($cons, "SELECT *FROM (SELECT *FROM `payment` WHERE `Status`='0' AND `Date` <= '$Date' AND `Action`='PAYOUT' $conde ORDER BY `Date` DESC LIMIT 10) SUB ORDER BY `Date` ASC");
				if($fo=mysqli_num_rows($dok)){
				?>
                 
             <div class="divFooter"><center><u><b>PAYOUT REPORT <?php echo $mpri ?></b></u></center></div>
             <div class="row">
            <div class="col-lg-12">
             <span> &nbsp;&nbsp; Total Records Found : <b><?php echo" $fo " ?></b></span>
			 <span class="pull-right hidden-print"><?php echo"$bank   $account"; ?>&nbsp;&nbsp;
			 <a href="#" onclick="return window.print()" class="hidden-print" title='Click to print' data-toggle='tooltip' data-placement='top'>
			 <i class="lnr lnr-printer"></i></a></span>
            <div class="widget-container fluid-height clearfix">
            <div class="widget-content padded clearfix">

								<table class="table table-striped table-hover">     
                                      <thead>
                    <tr role="row">
                     <th class="hidden-xs" style='padding:1px;'>&nbsp;&nbsp;&nbsp;No&nbsp;&nbsp;&nbsp;</th>
					 <th width='8%' style='padding:1px;'>&nbsp;&nbsp;Date </th>
                       <th style='padding:1px;'>&nbsp;&nbsp;Done By </th>
                       <th style='padding:1px;'>&nbsp;&nbsp;Destination </th>
                       <th style='padding:1px;'>&nbsp;&nbsp;Paid To </th>
                       <th style='padding:1px;'>&nbsp;&nbsp;&nbsp;&nbsp;Description </th>
					   <th style='padding:1px;'><div align='center'>&nbsp;&nbsp;Amount </th>
							</tr></thead>
                                        <tbody>
					<?php
								$i=1;			$tpin=$tpout=0;
						while($rok=mysqli_fetch_assoc($dok)){
				$code=$rok['Number'];
			$sour=$rok['Cashier'];
			$dte=$rok['Date'];
			$dest=$rok['Description'];
			$bna=$rok['Payto'];
			$cno=$rok['Customer'];
			$mode=$rok['Pline'];

												
			$amo=$rok['Amount'];							
			$amoo=number_format($amo);
			$stl="padding:1px;";

				print("<tr><td width='5%' class='hidden-xs' style='$stl $clr'>
				<div align='right'>$i&nbsp;&nbsp;</td>
				<td style='$stl $clr'><div align='center'>&nbsp;$dte&nbsp;</td><td style='$stl $clr'>&nbsp; $sour </td>
						<td style='$stl $clr'>&nbsp; $bna </td>
						<td style='$stl $clr'>&nbsp; $cno </td>
						<td style='$stl $clr'>&nbsp; $dest </td>
						<td style='$stl $clr'><div align='right'> $amoo &nbsp;</td></tr>");
									$i++;					$tpin+=$amo;
						}
						$tp=number_format($tpin);	
						?>
						
                    </tbody>
					 <thead>
					<tr><th class='hidden-xs'> </th><th colspan='4'><div align='center'> Total Amount </th><th colspan='2'>
					    <div align='right'><?php echo $tp ?></th>
								</tr></table><br><br>
								</div></div>
								<span class="pull-right hidden-print">
			 <a href="#" onclick="return window.print()" class="hidden-print" title='Click to print' data-toggle='tooltip' data-placement='top'>
			 <i class="lnr lnr-printer"></i></a></span><br><br><br>

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