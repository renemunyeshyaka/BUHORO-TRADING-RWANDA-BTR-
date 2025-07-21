<?php
if(basename($_SERVER['PHP_SELF']) == 'advarepo.php') 
  $cm=" class='current'";
include'header.php';
include'connection.php';
$dato=$datos=$Date;
$conde=$custo='';

if(isset($_POST['search']))
		{
			$dato=$_POST['dato'];
			$datos=$_POST['datos'];
			$custo=$_POST['custo'];
		}

if(isset($_POST['delo']))
		{
			$dato=$_POST['dato'];
			$datos=$_POST['datos'];
			$custo=$_POST['custo'];
			$rowid=$_POST['rowid'];
	$do=mysql_query("DELETE FROM `payment` WHERE `Number` = '$rowid' ORDER BY `Number` ASC LIMIT 1");	
	$do=mysql_query("DELETE FROM `supay` WHERE `Payno` = '$rowid' ORDER BY `Number` ASC LIMIT 100");	
	$do=mysql_query("DELETE FROM `deposit` WHERE `Item` = 'PAYMENT' AND `Operation`='WITHDRAWAL' AND `Record` = '$rowid' ORDER BY `Number` ASC LIMIT 100");
		}
		
	if($custo=='')
		$conde="";
	else
		$conde="AND `Customer`='$custo'";

		if($dato==$datos)
			$mpri="ON $dato";
		else
			$mpri="FROM $dato TO $datos";

$do=mysql_query("SELECT *FROM `payment` WHERE `Date` BETWEEN '$dato' AND '$datos' AND `Status`='0' AND `Action`='PURCHASE' AND `Payment`!='0' $conde GROUP BY `Number` ORDER BY `Voucher` ASC");
$fo=mysql_num_rows($do);
?>
<div class="container-fluid main-content">
        <div class="page-title hidden-print">
           <h3 style='margin-top:-20px; margin-bottom: 5px; color:#ffcc33'>
         Suppliers Report
          </h3>
                 </div>
     
        <div class="row">
  <div class="col-lg-2 hidden-print">
   
   <ul class="list-group">

    <li class="list-group-item">
	  <a href="suprepo.php">
                <p>
                <i class="lnr lnr-menu-circle"></i>&nbsp;Suppliers Report
                </p>
              </a></li> 

    <li class="list-group-item">
	  <a href="payrepo.php">
                <p>
                <i class="lnr lnr-menu-circle"></i>&nbsp;Payment Report
                </p>
              </a></li> 

    <li class="list-group-item active">
	  <a href="advarepo.php">
                <p>
                <i class="lnr lnr-menu-circle"></i>&nbsp;Advance Report
                </p>
              </a></li>  

    <li class="list-group-item">
	  <a href="subrepo.php">
                <p>
                <i class="lnr lnr-menu-circle"></i>&nbsp;Balance Report
                </p>
              </a></li> 
                         
            </ul>
  </div>
                    
           
           
       
        <div class="col-lg-10">
                  <div class="row">
         
           <div class="col-lg-1"> </div>
          
         
           

        <form action="" method="post" class="form-horizontal ">                  
                       <div class="col-lg-11 hidden-print"><div class="col-lg-3"> 
					   
			   
					   
					   </div>
					   <div class="col-lg-3"> 
					   
			   <select class="form-control" name="custo">
 <?php
				echo"<option value='' selected='selected'> SELECT SUPPLIER </option>";
				  $top=mysql_query("SELECT `Destin` FROM `stouse` WHERE `Status`='0' AND `Action`='RECEIVE' GROUP BY `Destin` ORDER BY `Destin` ASC");
						while($rop=mysql_fetch_assoc($top)){
							$sup=$rop['Destin'];
			echo"<option value='$sup'> $sup </option>";
						}
						?>
			   </select>
					   
					   </div>
            <div class="col-lg-2"> 
           <div class="input-group date datepicker">
      <input class="form-control form-center" id="from" name="dato" type="text" value="<?php echo $dato ?>" onkeypress='return isNumberKey(event)' required>
	  <span class="input-group-addon"><i class="lnr lnr-calendar-full"></i></span>
			</div></div>


		  <div class="col-lg-2"> 
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

			<div class="divFooter"><center><u><b>SUPPLIERS ADVANCE REPORT <?php echo $mpri ?></b></u></center></div>
             <div class="row">
            <div class="col-lg-12">
             <span>Total Records Found : <b><?php echo" $fo " ?></b></span>
			 <span class="pull-right hidden-print">&nbsp;&nbsp;&nbsp;&nbsp;<a href="#" onclick="return window.print()" class="hidden-print" title='Click to print' data-toggle='tooltip' data-placement='top'><i class="lnr lnr-printer hidden-print"></i></a></span>
            <div class="widget-container fluid-height clearfix">
            <div class="widget-content padded clearfix">
               
			    <?php
$gto=0;
			   
				?>
                                 <table class="table table-striped table-hover">     
                                      <thead>
                     <tr role="row">
                     <th class="hidden-xs"> No </th> 
                       <th> Due&nbsp;Date </th>
                       <th> System User </th>
                       <th> Supplier </th><th> Description </th>
                        <th><div align='right'> Cash &nbsp;&nbsp;</th>
						 <th><div align='right'> Cheque &nbsp;&nbsp;</th>
						 <th><div align='right'> Deposit &nbsp;&nbsp;</th>
                       <th><div align='right'> Total&nbsp;Amount&nbsp;</th>
                       <th><div align='right'> #&nbsp;&nbsp;&nbsp;</th>
                     </tr>
                    </thead>
                                        <tbody>
					<?php
					$n=1;				$tot=$tca=$tche=$tba=0;
						while($ro=mysql_fetch_assoc($do)){
				$ca=$che=$ba=$cre=$to=0;
				$code=$ro['Number'];
			$dte=$ro['Date'];
			$des=$ro['Customer'];
			$user=$ro['Cashier'];														$stn="padding:0px;";
			$cheno=$ro['Cheno'];
			$bna=$ro['Bname'];
			$amo=$ro['Amount'];
			if($ro['Description']=='Supplier Advance')
				$stn="padding:1px; color:blue;";

			
			if($ro['Payment']=='2')
				$stn="padding:1px; color:#669900;";

		$sepa=mysql_query("SELECT `Bank` FROM `baccount` WHERE `Number`='$bna' ORDER BY `Number` DESC");
			$repa=mysql_fetch_assoc($sepa);
				$bna=$repa['Bank'];

if($ro['Pline']=='CASH')
	$ca+=$amo;

if($ro['Pline']=='CHEQUE')
	$che+=$amo;

if($ro['Pline']=='BANK')
	$ba+=$amo;

	$tot=$ca+$che+$ba;					      $toto=number_format($tot, 2);				$pay=$ca+$ba+$che;
				
				$payo=number_format($pay, 2);									$cao=number_format($ca, 2);
	
	$cheo=number_format($che, 2);																						$bao=number_format($ba, 2);
		print("<tr>
          <td class='hidden-xs' style='$stn'><div align='center'>$n&nbsp;&nbsp;</td>
			<td style='$stn'> $dte </td><td style='$stn'> $user </td><td style='$stn'> $des </td><td style='$stn'> $cheno &nbsp; $bna </td>
                <td style='$stn'><div align='right'> $cao &nbsp;&nbsp;</td><td style='$stn'><div align='right'> $cheo &nbsp;&nbsp;</td>
				<td style='$stn'><div align='right'> $bao &nbsp;&nbsp;</td><td style='$stn'><div align='right'> $toto &nbsp;</td>
				
				<form action='' method='post'><td class='hidden-xs hidden-print' align='right' style='width:40px; padding:0px; $clri'>
                          <input type='hidden' name='rowid' value='$code'><input type='hidden' name='custo' value='$custo'>
                          <input type='hidden' name='dato' value='$dato'><input type='hidden' name='datos' value='$datos'><button type='submit' name='delo' class='btn btn-xs btn-danger hidden-print' style='height:18px; padding:0px;' title='Delete' data-toggle='tooltip' data-placement='top'>&nbsp;&nbsp;<i class='lnr lnr-trash'></i>&nbsp;&nbsp;</button></td></form></tr>");
						  $n++;					$tca+=$ca;				$tche+=$che;				$tba+=$ba;
						}

						$tot=number_format($tca+$tche+$tba, 2);

			$tca=number_format($tca, 2);					$tche=number_format($tche, 2);					$tba=number_format($tba, 2);	
			
						?>
						
                     </tbody><thead>

					 <tr><th class="hidden-xs"> </th>
					<th colspan='4'><div align='center'> Total Amount </th>
					<th><div align='right'><?php echo $tca ?> </th>
					<th><div align='right'><?php echo $tche ?> </th>
					<th><div align='right'><?php echo $tba ?> </th>
					<th><div align='right'><?php echo $tot ?> </th>
					<th class='text-center hidden-xs hidden-print'> -- </th></tr>
                  </table><br> 
                
              </div>
            </div></div>
                  </div> <span class="pull-right hidden-print">
			 &nbsp;&nbsp;&nbsp;&nbsp;<a href="#" onclick="return window.print()" class="hidden-print" title='Click to print' data-toggle='tooltip' data-placement='top'><i class="lnr lnr-printer"></i></a></span>
      
   </div></div></div>
 
   <?php
   include'footer.php';
   ?>