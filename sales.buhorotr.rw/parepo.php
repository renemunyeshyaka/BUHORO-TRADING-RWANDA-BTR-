<?php
if(basename($_SERVER['PHP_SELF']) == 'parepo.php') 
  $cm=" class='current'";
include'header.php';
include'connection.php';
$dato=$datos=$Date;
$custo=$conde=$brc='';
$t=$p=0;

// search for an item to be added to the chart
if(isset($_POST['search']))
		{
			$brc=$_POST['brc'];
			$dato=$_POST['dato'];
			$datos=$_POST['datos'];
			$p=1;
		}
	
	if($dato==$datos)
			$mpri="ON $dato";
		else
			$mpri="FROM $dato TO $datos";

if($brc)
$conde="AND `Destin`='$brc'";

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

<li class="list-group-item active">
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
                       <div class="col-lg-3 hidden-print">  
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
					   </div><div class="col-lg-6 hidden-print">
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
                       
                       <div class="col-lg-3">
                        <button class="btn  btn-primary btn-block" type="submit" name="search"><i class="lnr lnr-magnifier"></i> Search</button>
                   
					  </div>
                         </div> 
                      
                     
                  
            </form> 
             
               
            </div>
             <?php
		$do=mysql_query("SELECT *FROM `stouse` WHERE `Date` BETWEEN '$dato' AND '$datos' AND `Voucher`!='0' AND `Status`='0' AND `Action`='SALES' $conde GROUP BY `Voucher` ORDER BY `Number` ASC");
				if($fo=mysql_num_rows($do)){
					?>
					<div class="divFooter"><center><u><b>PAYMENT REPORT <?php echo"$mpri"; ?></b></u></center></div>
		 <div class="row">
            <div class="col-lg-12">
             <span> &nbsp;&nbsp; Total Records Found : <b><?php echo" $fo " ?></b></span>
			 <span class="pull-right hidden-print"><?php echo $bra ?>&nbsp;&nbsp;<a href="#" onclick="return window.print()" class="hidden-print" title='Click to print' data-toggle='tooltip' data-placement='top'><i class="lnr lnr-printer"></i></a></span>
            <div class="widget-container fluid-height clearfix">
            <div class="widget-content padded clearfix">

				<table class="table table-striped">     
                                      <thead>
                    <tr role="row">
                     <th class="hidden-xs"> No </th> 
                       <th> Customer </th>
                       <th> Order&nbsp;No </th>
                       <th> Done&nbsp;By </th>
                       <th colspan='2'> &nbsp;Date&nbsp;&nbsp;&&nbsp;&nbsp;Time </th>
                       <th> Items </th>
						<th>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Amount</th>
						<th>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Cash</th>
						<th>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Deposit</th>
						<th>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Cheque</th>
						<th>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Credit</th>
                     </tr>
                    </thead>
                                        <tbody>
					<?php
					$n=1;					$tot=$tca=$tche=$tba=$tcre=0;
						while($ro=mysql_fetch_assoc($do)){
				$vou=$ro['Voucher'];
				$dte=$ro['Date'];
				$tme=$ro['Time'];
				$user=$ro['User'];
				$tabl=$ro['Destin'];
				$bch=$ro['Branche'];
				$ca=$che=$ba=$cre=$to=0;
$dor=mysql_query("SELECT `Price`, SUM(Quantity) AS 'QTO' FROM `stouse` WHERE `Voucher`='$vou' $conde GROUP BY `Item`, `Price` ORDER BY `Number` ASC");
			$for=mysql_num_rows($dor);
				while($ror=mysql_fetch_assoc($dor)){
				$pri=$ror['Price'];
				$qty=$ror['QTO'];
				$to+=$pri*$qty;
					}			
						$too=number_format($to);
	$spa=mysql_query("SELECT `Amount`, `Pline` FROM `payment` WHERE `Voucher`='$vou' AND `Status`='0' AND `Branche`='$bch' AND `Action`='SALES' ORDER BY `Number` ASC");
				while($rpa=mysql_fetch_assoc($spa)){
						$amo=$rpa['Amount'];

if($rpa['Pline']=='CASH')
	$ca+=$amo;

if($rpa['Pline']=='CHEQUE')
	$che+=$amo;

if($rpa['Pline']=='BANK')
	$ba+=$amo;

if($rpa['Pline']=='CREDIT')
	$cre+=$amo;
				}
							$pay=$ca+$ba+$che;
				
				$payo=number_format($pay);					$creo=number_format($cre);						$cao=number_format($ca);
	
	$cheo=number_format($che);																						$bao=number_format($ba);

						$stn="padding:1px;";
if($for){
		print("<tr><td class=hidden-xs style='$stn'><div align='center'>$n&nbsp;&nbsp;</td><td style='$stn'> $tabl </td>
		<td style='$stn'><div align='center'> $vou </td><td style='$stn'> $user </td><td style='$stn'> $dte </td>
		<td style='$stn'> $tme </td><td class='text-right' style='$stn'> $for&nbsp;&nbsp;</td><td style='$stn'><div align='right'> $too&nbsp;&nbsp;</td>
						<td style='$stn'><div align='right'> $cao&nbsp;&nbsp;</td><td style='$stn'><div align='right'> $bao&nbsp;&nbsp;</td>
						<td style='$stn'><div align='right'> $cheo&nbsp;&nbsp;</td><td style='$stn'><div align='right'> $creo&nbsp;&nbsp;</td></tr>");
						  $n++;				$tot+=$to;			$tca+=$ca;			$tche+=$che;		$tba+=$ba;			$tcre+=$cre;
}
						}
			$tot=number_format($tot);					$tca=number_format($tca);				$tche=number_format($tche);
						$tba=number_format($tba);								$tcre=number_format($tcre);
						?>
						
                     </tbody>

					 <thead>
					<tr><th class="hidden-xs"> </th><th colspan='6' class='text-center'> Total Amount </th>
					<th><div align='right'><?php echo $tot ?></th><th class='text-right'><?php echo $tca ?></th>
					<th class='text-right'><?php echo $tba ?></th><th class='text-right'><?php echo $tche ?></th>
					<th class='text-right'><?php echo $tcre ?></th></tr>
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
						<div style='text-align:center; font-size:24px; color:#ff9999'> Report not available on selected date </div><br><br><br><br><br><br><br>";
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