<?php
if(basename($_SERVER['PHP_SELF']) == 'debrepo.php') 
  $cm=" class='current'";
include'header.php';
include'connection.php';
$dato=$datos=$Date;
$custo='';

if(isset($_POST['search']))
		{
			$dato=$_POST['dato'];
			$datos=$_POST['datos'];
		}
		
		

		if($dato==$datos)
			$mpri="ON $dato";
		else
			$mpri="FROM $dato TO $datos";

$do=mysqli_query($cons, "SELECT *FROM `account` WHERE (`Status`='0' OR (`Status`='1' AND `Cdate` BETWEEN '$dato' AND '$datos')) $conde ORDER BY `Customer` ASC");
$fo=mysqli_num_rows($do);
?>
<div class="container-fluid main-content">
        <div class="page-title hidden-print">
         <h2 class="hidden-print" style='margin-top:-20px; margin-bottom: 5px; color:#ffcc33'>
         Sales Report
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

	 <li class="list-group-item active">
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
                       <div class="col-lg-9 hidden-print"><div class="col-lg-3">
	
		<select class="form-control" name="brc" style='padding-right:5px;'>
			   <?php
if($brancho)
echo"<option value='$brc' selected> $brc </option>";
else{
echo"<option value='0' selected='selected'> SELECT BRANCH </option>";
	$seek=mysqli_query($cons, "SELECT `Invoice`, `Branche` FROM `stouse` WHERE `Branche`!='0' AND `Status`='0' AND `Upda`='1' AND `Action`='SALES' AND `Invoice`!='MAIN STORE' GROUP BY `Branche` ORDER BY `Branche` ASC LIMIT 18");
			if($feek=mysqli_num_rows($seek)){
		while($roi=mysqli_fetch_assoc($seek)){
				$fna=$roi['Invoice'];
				$num=$roi['Branche'];
				if($brc==$num)
					$s='selected';
				else
					$s='';
			echo"<option value='$num' $s> $fna &nbsp;&nbsp;</option>";
			}
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

			<div class="divFooter"><center><u><b>DEBTORS REPORT <?php echo $mpri ?></b></u></center></div>
             <div class="row">
            <div class="col-lg-12">
             <span>Total Records Found : <b><?php echo" $fo " ?></b></span>
			 <span class="pull-right"><b>&nbsp;<?php echo $bra ?>&nbsp;</b>
			 &nbsp;&nbsp;&nbsp;&nbsp;<a href="#" onclick="return window.print()" class="hidden-print" title='Print' data-toggle='tooltip' data-placement='top'><i class="lnr lnr-printer"></i></a></span><span class="pull-right"><b>&nbsp;&nbsp;&nbsp; 
			 &nbsp;&nbsp;&nbsp;<?php echo $cs ?></b></span>
            <div class="widget-container fluid-height clearfix">
            <div class="widget-content padded clearfix">
               
                                 <table class="table table-striped table-hover">     
                                      <thead>
                     <tr role="row">
                     <th class="hidden-xs"> No </th> 
                       <th> Customer&nbsp;Name </th><th> Address </th>
                       <th> Telephone </th><th> Last&nbsp;Visit </th>
                       <th><div align='right'> Opening &nbsp;&nbsp;</th>
                       <th><div align='right'> Debt &nbsp;&nbsp;</th>
                       <th><div align='right'> Paid &nbsp;&nbsp;</th>
                       <th><div align='right'> Closing &nbsp;&nbsp;</th>
                     </tr>
                    </thead>
                                        <tbody>
					<?php
					$n=1;				$topen=$tclos=$tnew=$tpay=0;
						while($ro=mysqli_fetch_assoc($do)){
				$code=$ro['Number'];
				$custo=$ro['Customer'];			
					$dte=$ro['Cdate'];
					$tele=$ro['Telephone'];
				//	$clo=$ro['Balance'];
					$addre=$ro['Address'];
					$newcre=$paycre=$new=$pay=0;

	// ********************************* new credit after dato ******************************
    
	$cuse=mysqli_query($cons, "SELECT `Destin`, SUM(`Price`*`Quantity`) AS 'TOT' FROM `stouse` WHERE `Client`='$code' AND `Action`='SALES' AND `Status`='0' AND `Upda`='1' AND `Voucher`!='0' ORDER BY `Number` ASC");
			$ruce=mysqli_fetch_assoc($cuse);
					$Fe=$ruce['Destin'];
					$newcre=$ruce['TOT'];					

	$cusea=mysqli_query($cons, "SELECT SUM(`Amount`) AS 'Amo' FROM `payment` WHERE `Client`='$code' AND `Pline`!='CREDIT' AND `Status`='0' AND `Changing`='0' AND (`Action`='SALES' OR `Action`='PAYMENT') ORDER BY `Number` ASC");
			$rpa=mysqli_fetch_assoc($cusea);
					$paycre=$rpa['Amo'];

		$clos=$newcre-$paycre;					$closo=number_format($clos);

	
	// ********************************* new credit on dato ******************************

$idox=mysqli_query($cons, "SELECT SUM(Amount) AS 'New' FROM `payment` WHERE `Status`='0' AND `Voucher`!='0' AND `Action`='SALES' AND `Pline`='CREDIT' AND `Date` BETWEEN '$dato' AND '$datos' AND `Customer`='$custo' $conde ORDER BY `Number` ASC LIMIT 1000000");

		$irox=mysqli_fetch_assoc($idox);
			$new=$irox['New'];

$idoxi=mysqli_query($cons, "SELECT SUM(Amount) AS 'Pay' FROM `payment` WHERE `Status`='0' AND `Voucher`!='0' AND `Action`='PAYMENT' AND `Pline`!='CREDIT' AND `Date` BETWEEN '$dato' AND '$datos' AND `Customer`='$custo' AND `Changing`='0' $conde ORDER BY `Number` ASC LIMIT 1000000");

		$iroxi=mysqli_fetch_assoc($idoxi);
			$pay=$iroxi['Pay'];

		//	$clos=$clo-$newcre+$paycre;					
		//	$closo=number_format($clos);		
			$newo=number_format($new);

			$open=$clos-$new+$pay;						
			$openo=number_format($open);				
			$payo=number_format($pay);

			$stn="padding-top:0px; padding-bottom:0px; font-size:13px;";

	if($open OR $new OR $pay OR $clos)
		print("<tr><td class='hidden-xs text-right' style='$stn'>&nbsp;&nbsp;&nbsp; $n &nbsp;</td>
			<td style='$stn'> $custo </td><td style='$stn'> $addre </td>
			<td style='text-align:right; $stn'> $tele </td>
			<td style='$stn' class='text-center'> $dte </td> 
			 <td style='$stn' class='text-right'> $openo </td><td style='$stn' class='text-right'> $newo </td>
			 <td style='$stn' class='text-right'> $payo </td><td style='$stn' class='text-right'> $closo </td></tr>");
		$n++;				$topen+=$open;				$tclos+=$clos;				$tnew+=$new;			$tpay+=$pay;
						}
	$topen=number_format($topen);			$tnew=number_format($tnew);			$tclos=number_format($tclos);			$tpay=number_format($tpay);					
						?>
						
                     </tbody>
					 <thead>
					<tr><th colspan='5'><div align='center'> Total Amount </th>
					<th><div align='right'><?php echo $topen ?></th>
					<th><div align='right'><?php echo $tnew ?></th>
					<th><div align='right'><?php echo $tpay ?></th>
					<th><div align='right'><?php echo $tclos ?></th></tr>
                  </table><br>

              </div>
            </div></div>
                  </div>                    
                <span class="pull-right">
			 &nbsp;&nbsp;&nbsp;&nbsp;<a href="#" onclick="return window.print()" class="hidden-print" title='Print' data-toggle='tooltip' data-placement='top'>
			 <i class="lnr lnr-printer"></i></a></span>
      
   </div></div></div> 
    
   <?php
   include'footer.php';
   ?>