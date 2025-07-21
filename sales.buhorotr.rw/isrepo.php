<?php
if(basename($_SERVER['PHP_SELF']) == 'isrepo.php') 
  $bb=" class='current'";
include'header.php';
include'connection.php';
$dato=$datos=$Date;
$custo='';
$conde='';
$condi='';
$t=$p=0;
 $brc=$_SESSION['BR'];

// search for an item to be added to the chart
if(isset($_POST['search']))
		{
			$custo=$_POST['custo'];
			$dato=$_POST['dato'];
			$datos=$_POST['datos'];
			$p=1;
		}
		
		if(!$_SESSION['Acrepo'])
		    $datos=$dato;

		if($dato==$datos)
			$mpri="ON $dato";
		else
			$mpri="FROM $dato TO $datos";

	if($custo){
		$conde="AND `User`='$custo'";
		$condi="AND `Cashier`='$custo'";
	}

/*
$rece=mysql_query("SELECT `Name` FROM `branches` WHERE `Number`='$brc' ORDER BY `Number` DESC LIMIT 1");
				$recet=mysql_fetch_assoc($rece);
					$bra=$recet['Name'];
					*/
?>
<div class="container-fluid main-content">
        <div class="page-title hidden-print">
          <h3 style='margin-top:-20px; margin-bottom: 5px; color:#ffcc33'>
         Sales Report
          </h3>
                 </div>
     
        <div class="row">
  <div class="col-lg-2 hidden-print">

	   <li class="list-group-item">
              <a href="stobranch.php" <?php echo $dsa ?>>
                <p>
                <i class="lnr lnr-menu-circle"></i>&nbsp;Store Status
                </p>
              </a></li>

   <li class="list-group-item">
	  <a href="createa.php" <?php echo $dsa ?>>
                <p>
                <i class="lnr lnr-plus-circle"></i>&nbsp;Create Account
                </p>
              </a></li> 

   <li class="list-group-item">
	  <a href="dadd.php" <?php echo $dsa ?>>
                <p>
                <i class="lnr lnr-plus-circle"></i>&nbsp;Pay on Account
                </p>
              </a></li>   

   <li class="list-group-item">
	  <a href="cashbox.php" <?php echo $dsa ?>>
                <p>
                <i class="lnr lnr-plus-circle"></i>&nbsp;Add to Cashbox
                </p>
              </a></li> 

   <li class="list-group-item">
	  <a href="madd.php" <?php echo $dsa ?>>
                <p>
                <i class="lnr lnr-plus-circle"></i>&nbsp;Make a Payout
                </p>
              </a></li> 
                       
            </ul><br>
			<?php
			if($brc>='1'){
				?>

<?php
/*
if($_SESSION['Phyc']){
?>
			<a href="counte.php" class="btn btn-warning" style="width:100%;"><i class="lnr lnr-layers">&nbsp;Physical Count</i></a>
<?php
}
*/
?>
		<br><br>
   
 <ul class="list-group">
        <?php
        if($_SESSION['Acrepo']){
            ?>
   <li class="list-group-item" style="border:1px dashed #cccccc; border-radius:5px; margin:0px 0px 4px 0px;">
	  <a href="urepo.php">
                <p>
                <i class="lnr lnr-menu-circle"></i>&nbsp;Sales Report
                </p>
              </a></li> 
              <?php
        }
        else{
        ?>
   <li class="list-group-item" style="border:1px dashed #cccccc; border-radius:5px; margin:0px 0px 4px 0px;">
	  <a href="irepo.php">
                <p>
                <i class="lnr lnr-menu-circle"></i>&nbsp;Control Report
                </p>
              </a></li> 
              <?php
        }
        ?>

			   <li class="list-group-item" style="border:1px dashed #cccccc; border-radius:5px; margin:0px 0px 4px 0px;">
	  <a href="transit.php">
                <p>
                <i class="lnr lnr-menu-circle"></i>&nbsp;Payment Report
				<?php
$doq=mysqli_query($cons, "SELECT `Amount` FROM `payment` WHERE `Status`='0' AND `Action`='SALES' AND `Branche`='$brc' AND `Voucher`='0' ORDER BY `Number` ASC");
				if($foq=mysqli_num_rows($doq))
echo"<span class='badge' style='float:right; font-size:12px; margin-right:0px; margin-top:0px; height:18px; background-color:#ffcc66; width:auto;'> $foq </span>";
					?>
                </p>
              </a></li> 

   <li class="list-group-item active" style="border:1px dashed #cccccc; border-radius:5px; margin:0px 0px 4px 0px;">
	  <a href="isrepo.php">
                <p>
                <i class="lnr lnr-menu-circle"></i>&nbsp;Cashiers Report
                </p>
              </a></li>  
			  
			  <li class="list-group-item" style="border:1px dashed #cccccc; border-radius:5px; margin:0px 0px 4px 0px;">
	  <a href="bopi.php">
                <p>
                <i class="lnr lnr-menu-circle"></i>&nbsp;Bank Deposit
                </p>
              </a></li>
                         
            </ul>
			  <?php
			}
   ?>
  </div>  
           
       
        <div class="col-lg-10">
                  <div class="row">
         
           <div class="col-lg-2"> </div>
          
         
           

        <form action="" method="post" class="form-horizontal ">                  
                       <div class="col-lg-10 hidden-print"> 
                       <div class="col-lg-1"> </div>  
					   
					   <div class="col-lg-3"> 
		<select class="form-control" name="custo" style='padding-right:5px;'>
			   <?php
echo"<option value='0' selected='selected'> SELECT CASHIER </option>";
	$seek=mysql_query("SELECT `User` FROM `stouse` WHERE `Status`='0' AND `Upda`='1' AND `Action`='SALES' GROUP BY `User` ORDER BY `User` ASC LIMIT 18");
			if($feek=mysql_num_rows($seek)){
		while($roi=mysql_fetch_assoc($seek)){
				$fna=$roi['User'];
				if($custo==$fna)
					$s='selected';
				else
					$s='';
			echo"<option value='$fna' $s> $fna &nbsp;&nbsp;</option>";
			}
			}

			?>			    
            </select>
					   </div>
            <div class="col-lg-3"> 
           <div class="input-group date datepicker">
      <input class="form-control form-center" id="from" name="dato" type="text" value="<?php echo $dato ?>" onkeypress="return isNumberKey(event)" style="padding-left:2px; padding-right:2px;" required><span class="input-group-addon"><i class="lnr lnr-calendar-full"></i></span>
			</div></div>


		  <div class="col-lg-3"> 
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
		$i=1;				$ptu=0;				
$dorix=mysql_query("SELECT `Voucher` FROM `stouse` WHERE `Voucher`!='0' AND `Date` BETWEEN '$dato' AND '$datos' AND `Action`='SALES' AND `Status`='0' $conde GROUP BY `Voucher` ORDER BY `Date` ASC");
				if($fox=mysql_num_rows($dorix)){
					?>
					<div class="divFooter"><center><u><b>SALES REPORT <?php echo"$mpri"; ?></b></u></center></div>
		 <div class="row">
            <div class="col-lg-12">
             <span> &nbsp;&nbsp; </span>
			 <span class="pull-right hidden-print"><?php echo $bra ?>&nbsp;&nbsp;&nbsp;&nbsp;
			 <a href="#" onclick="return window.print()" class="hidden-print" title='Click to print' data-toggle='tooltip' data-placement='top'>
			 <i class="lnr lnr-printer"></i></a></span>
            <div class="widget-container fluid-height clearfix">
            <div class="widget-content padded clearfix">
			
			<?php			 
       echo"<form action='' method='post'><table class='table table-striped table-hover'>
				<thead><tr style='background-color:#ffffff;'>
              <td style='background-color:#ffffff;' width='3%' class='text-center'> # </td>
              <td class='text-center' style='background-color:#ffffff;'> Due&nbsp;Date </td>
			  <td style='background-color:#ffffff;'> Customer </td>
              <td style='background-color:#ffffff;' class='text-center'> Item&nbsp;Name </td><td style='background-color:#ffffff;' class='text-center'>Item&nbsp;Price</td>
              <td style='background-color:#ffffff;' class='text-center'>Sales&nbsp;Price</td>
              <td style='background-color:#ffffff;' class='text-center'>Quantity</td>
              <td style='background-color:#ffffff;' class='text-center'>Total&nbsp;Sales</td>
              <td style='background-color:#ffffff;' class='text-center'>Cash</td>
              <td style='background-color:#ffffff;' class='text-center'>Deposit</td>
              <td style='background-color:#ffffff;' class='text-center'>Cheque</td><td style='background-color:#ffffff;' class='text-center'>Credit</td></tr></thead>
                                        <tbody>";
					$ptu=$pcu=0;                    $tca=$tche=$tba=$tcre=0;
					
			while($rorix=mysql_fetch_assoc($dorix)){
				$vou=$rorix['Voucher'];
				$ca=$che=$ba=$cre=0;
				    $k=1;
					
		$dori=mysql_query("SELECT *FROM `stouse` WHERE `Voucher`!='0' AND `Date` BETWEEN '$dato' AND '$datos' AND `Action`='SALES' AND `Status`='0' AND `Voucher`='$vou' $conde ORDER BY `Date` ASC");
		$fori=mysql_num_rows($dori);
			while($rori=mysql_fetch_assoc($dori)){
			    $nou=$rori['Number'];
				$qtu=$rori['Quantity'];			$qtuo=number_format($qtu, 2);
				$pru=$rori['Price'];			$pruo=number_format($pru, 2);
				$desu=$rori['Destin'];
				$tut=$qtu*$pru;					$tuto=number_format($tut, 2);
				$dtu=$rori['Date'];
				$item=$rori['Item'];						
				$cost=$rori['Cost'];			$costo=number_format($cost, 2);
				$toc=$qtu*$cost;				$toco=number_format($toc, 2);
				$bal=$tut-$toc;					$balo=number_format($bal, 2);
				$time=$rori['Time'];
				
				if($tut<$toc)
					$stn="padding:0px; color:#ff3333";
				else
					$stn="padding:0px;";

	$dov=mysql_query("SELECT *FROM `items` WHERE `Number`='$item' ORDER BY `Number` DESC LIMIT 1");
		$rov=mysql_fetch_assoc($dov);
			$ipri=$rov['Price'];            $iprio=number_format($ipri, 2);
			$iname=$rov['Iname'];
			$iteco=$rov['Cost'];
			
	if($cost=='0' AND $iteco!='0')
$upda=mysql_query("UPDATE `stouse` SET `Cost`='$iteco' WHERE `Number`='$nou'");
			
			                if($pru<$ipri)
								$arr="text-success";
							else
								$arr="";
								
								if($pru<$cost)
								$arr="text-warning";

print("<tr><td class='$arr' style='$stn'><div align='right'> $i&nbsp;&nbsp;</td>
<td class='text-center $arr' style='$stn'>&nbsp;$dtu&nbsp;$time&nbsp;</td>
<td class='$arr' style='font-size:8px; color:teal; $stn'>&nbsp;$desu&nbsp;</td>
<td class='$arr' style='$stn'>&nbsp;$iname </td>
<td class='$arr' style='$stn'><div align='right'> $iprio&nbsp;</td>
<td class='$arr' style='$stn'><div align='right'> $pruo&nbsp;</td>
<td class='$arr' style='$stn'><div align='right'> $qtuo&nbsp;</td>
<td class='$arr' style='$stn'><div align='right'> $tuto&nbsp;</td>");

if($k==1){
    	$spa=mysql_query("SELECT `Amount`, `Pline` FROM `payment` WHERE `Voucher`='$vou' AND `Status`='0' AND `Action`='SALES' $condi ORDER BY `Number` ASC");
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
					$bao=number_format($ba, 2);			
					$creo=number_format($cre, 2);				
					$cao=number_format($ca, 2);
                	$cheo=number_format($che, 2);																					
echo"<td rowspan='$fori' class='$arr' style='background-color:#ffffff; $stn'>
<div align='right'> $cao&nbsp;</td>
<td rowspan='$fori' class='$arr' style='background-color:#ffffff; $stn'>
<div align='right'> $bao&nbsp;</td>
<td rowspan='$fori' class='$arr' style='background-color:#ffffff; $stn'>
<div align='right'> $cheo&nbsp;</td>
<td rowspan='$fori' class='$arr' style='background-color:#ffffff; $stn'>
<div align='right'> $creo&nbsp;</td>";
	$tca+=$ca;			$tche+=$che;		$tba+=$ba;			$tcre+=$cre;
}

print("</tr>");
$i++;			$k++;       		$ptu+=$tut;						$pcu+=$toc;								
}
}
			
		$ptu=number_format($ptu, 2);				
		$pcu=number_format($pcu, 2);
		$tca=number_format($tca, 2);		
		$tche=number_format($tche, 2);
						$tba=number_format($tba, 2);								$tcre=number_format($tcre, 2);
print("</tbody><thead><tr><th colspan='6'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Total Amount</th>
<th class='text-right'> </th><th class='text-right'> $ptu</th>
<th class='text-right'> $tca</th><th class='text-right'> $tba</th>
<th class='text-right'> $tche</th><th class='text-right'> $tcre</th></tr></thead></table>");
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