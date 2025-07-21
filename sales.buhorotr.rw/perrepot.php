<?php
if(basename($_SERVER['PHP_SELF']) == 'perrepot.php') 
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

if($custo){
$conde="AND `Seller`='$custo'";
$condi="AND `stouse`.`Seller`='$custo'";
}

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
      
    <li class="list-group-item active">
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
    	$seek=mysql_query("SELECT `Seller` FROM `payment` WHERE `Seller`!='' AND `Status`='0' AND `Action`='SALES' AND `Date` BETWEEN '$dato' AND '$datos' $conde GROUP BY `Seller` ORDER BY `Seller` ASC LIMIT 30");
			if($feek=mysql_num_rows($seek)){
			    $seller=array();                    $s=1;
		while($reek=mysql_fetch_assoc($seek)){
				$seller[$s]=$reek['Seller']; 
				    $s++;
		}
			
		
		$sit=mysql_query("SELECT `items`.`Number`, `items`.`Iname` FROM `items` INNER JOIN `stouse` ON `items`.`Number` = `stouse`.`Item` WHERE `stouse`.`Status`='0' AND `stouse`.`Action`='SALES' AND `stouse`.`Voucher`!='0' AND `stouse`.`Date` BETWEEN '$dato' AND '$datos' $condi GROUP BY `stouse`.`Item` ORDER BY `items`.`Type` ASC");
		    if($fit=mysql_num_rows($sit)){
		        $item=array();                     $t=1;
		while($rit=mysql_fetch_assoc($sit)){
		    $item[$t]=$rit['Iname'];
		    $ito[$t]=$rit['Number'];
		        $t++;
		}
		    }
				   ?>
                 <div class="divFooter"><center><u><b>PERFORMANCE REPORT <?php echo $mpri ?></b></u></center></div>
             <div class="row">
            <div class="col-lg-12">
             <span> &nbsp;&nbsp; Total Records Found : <b><?php echo" $feek " ?></b></span> 
			 <span class="pull-right"><?php echo $bra ?>&nbsp;&nbsp;<a href="#" onclick="return window.print()" class="hidden-print" title='Click to print' data-toggle='tooltip' data-placement='top'><i class="lnr lnr-printer"></i></a></span>
			 
			 <span class="pull-right hidden-print">
		&nbsp;&nbsp;&nbsp;&nbsp;<a href="#" id="exporttable" class="hidden-print" title='Export to excell' data-toggle='tooltip' data-placement='top'><i class="lnr lnr-line-spacing"></i></a></span>
            <div class="widget-container fluid-height clearfix">
            <div class="widget-content padded clearfix">
                
                
                <?php
        for($i=1; $i<$s; $i++){
            $sale=$seller[$i];
        echo"<h3 style='margin-left:30px; margin-bottom:0px;' class='text-success'> $sale </h3>";
        ?>
	<table class="table table-striped table-hover table-bordered" style="font-size:11px;" id='htmltable'><thead>
    <tr role="row"><th class='text-center' style="font-size:10px;" rowspan='2'> No </th>
    <th class="text-center" style="font-size:10px;" rowspan='2'> DATE  </th>
    <th style="text-align:center; font-size:10px;" rowspan='2'> CUSTOMER </th>
        <?php
        for($k=1; $k<$t; $k++){
            $ite=$item[$k];
echo"<th style='text-align:center; font-size:10px;' colspan='2'> $ite </th>";
        }
        ?>
		<th style='text-align:center;' style="font-size:10px;" rowspan='2'> TOTAL&nbsp;AMOUNT </th></tr>
		<tr><?php
        for($k=1; $k<$t; $k++){
    echo"<th style='text-align:center; font-size:10px;'> QTY </th><th style='text-align:center; font-size:10px;'> P/U </th>";
        }
        ?></tr></thead><tbody>
					<?php
    $n=1;                           $stn="padding:0px; font-size:11px;"; 
                    $stl="padding:0px; color:powderblue; font-size:11px;";
                    $sto=0;             $tot=array();
    		
    $seco=mysql_query("SELECT `Date`, `Customer`, `Voucher` FROM `payment` WHERE `Action`='SALES' AND `Seller`='$sale' AND `Status`='0' AND `Date` BETWEEN '$dato' AND '$datos' AND `Voucher`!='0' GROUP BY `Voucher` ORDER BY `Voucher` ASC");
        while($reco=mysql_fetch_assoc($seco)){
            $cuso=$reco['Customer'];
            $vous=$reco['Voucher'];
            $date=$reco['Date'];
            $tam=0;
				
	print("<tr><td class='text-center' style='$stn'>$n</td><td class='text-center' style='$stn'>$date</td><td style='$stn'>$cuso</td>");
    
    for($k=1; $k<$t; $k++){
        $nuos=$ito[$k];
        
    $sall=mysql_query("SELECT SUM(`Quantity`*`Price`) AS `Amo`, SUM(`Quantity`) AS `Qty`, `Price` FROM `stouse` WHERE `Voucher`='$vous' AND `Action`='SALES' AND `Status`='0' AND `Item`='$nuos'");
		$rall=mysql_fetch_assoc($sall);
			$qty=$rall['Qty'];
		    $pri=number_format($rall['Price']);
		    $tam+=$rall['Amo'];
		    $sto+=$rall['Amo'];
		    $tot[$k]+=$qty;
				
	print("<td style='text-align:center; $stn'> $qty </td>
		<td style='text-align:right; $stn'> $pri </td>");
    }
    
        $tamo=number_format($tam);
    print("<td style='text-align:right; $stn'> $tamo </td><tr>");
            $n++;
		}
    ?>
					 <thead>
	<tr><th colspan='3' style="color:blue; padding:1px; font-size:11px;"><div align='center'> TOTAL VALUE </th>
	
	    <?php
	for($k=1; $k<$t; $k++){
        $tote=number_format($tot[$k]);
		echo"<th style='color:blue; padding:1px; font-size:11px;' colspan='2'><div align='center'> $tote </th>";
	}
	
	        $sto=number_format($sto);
	?>
		<th style="padding:1px; color:blue; font-size:11px;"><div align='right'><?php echo $sto ?></th></tr></table><br><br>
                  
        <?php
        }
        ?>

			  </div>
            </div></div>
                  </div>                  
                <span class="pull-right hidden-print">
			 &nbsp;&nbsp;&nbsp;&nbsp;<a href="#" onclick="return window.print()" class="hidden-print" title='Click to print' data-toggle='tooltip' data-placement='top'><i class="lnr lnr-printer"></i></a></span>
			 
			 <span class="pull-right hidden-print">
		&nbsp;&nbsp;&nbsp;&nbsp;<a href="#" id="exporttable" class="hidden-print" title='Export to excell' data-toggle='tooltip' data-placement='top'><i class="lnr lnr-line-spacing"></i></a></span>
			 
			 	  
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
                             
      
   </div></div></div>  
   <?php
   include'footer.php';
   ?>
