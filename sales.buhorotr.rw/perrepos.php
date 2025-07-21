<?php
if(basename($_SERVER['PHP_SELF']) == 'perrepos.php') 
  $cm=" class='current'";
include'header.php';

$dato = strtotime("-7 days", strtotime("$Date"));
		$dato = date ("Y-m-d", $dato);	
		$datos=$Date;
        $page="PORTRAIT";
        $port=$land='';

	if(isset($_POST['search']))
		{
		$dato=$_POST['dato'];
		$datos=$_POST['datos'];
		$page=$_POST['page'];
		}
		
		if($dato==$datos)
			$mpri="ON dato";
		else
			$mpri="FROM $dato TO $datos";

        if($page=='PORTRAIT')
            $port="selected";
        
        if($page=='LANDSCAPE')
            $land="selected";
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
      
    <li class="list-group-item active">
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
		
                <option value='PORTRAIT' <?php echo $port ?>> PORTRAIT </option>
        <option value='LANDSCAPE' <?php echo $land ?>> LANDSCAPE </option>   
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
                 <div class="divFooter"><center><u><b>PERFORMANCE REPORT <?php echo $mpri ?></b></u></center></div>
             <div class="row">
            <div class="col-lg-12">
             <span> &nbsp;&nbsp; Total Records Found : <b><?php echo" $fo " ?></b></span> 
			 <span class="pull-right"><?php echo $bra ?>&nbsp;&nbsp;&nbsp;&nbsp;<a href="#" onclick="return window.print()" class="hidden-print" title='Click to print' data-toggle='tooltip' data-placement='top'><i class="lnr lnr-printer"></i></a></span>
			 
			 <span class="pull-right hidden-print">
		&nbsp;&nbsp;&nbsp;&nbsp;<a href="#" id="exporttable" class="hidden-print" title='Export to excell' data-toggle='tooltip' data-placement='top'><i class="lnr lnr-line-spacing"></i></a></span>
            <div class="widget-container fluid-height clearfix">
            <div class="widget-content padded clearfix">
                
	 <?php
        if($page=='PORTRAIT'){
            ?>
	<table width='100%' class='table table-bordered table-striped table-hover datatable' style='font-size:12px;' id='htmltable'><thead>
      <tr role='row'><th class='text-center' style='padding:1px;'><b>DATE</th>
        <?php
    $i=0;
    $date=$dato;
    $name=$sum=$salo=array();
    $stl="style='padding:1px;'";
    $seco=mysql_query("SELECT `Seller` FROM `payment` WHERE `Action`='SALES' AND `Status`='0' AND `Seller`!='' AND `Date` BETWEEN '$dato' AND '$datos' GROUP BY `Seller` ORDER BY `Seller` ASC");
        $feco=mysql_num_rows($seco);
    while($reco=mysql_fetch_assoc($seco)){
            $i++;
       $user=$name[$i]=$reco['Seller'];
    echo"<td colspan='2' class='text-center' style='padding:1px; text-transform: uppercase;'><b>$user</td>";
    }
    if($feco>1){
    echo"<th colspan='2' class='text-center' $stl><b> TOTAL </th>";
        $spn=($feco*2)+3;
    }
    else
        $spn=($feco*2)+1;
    
    echo"</tr><tr><th $stl> </th>";
    for($n=1; $n<=$i; $n++){
echo"<th class='text-right' $stl><b> A </th><th class='text-right' style='padding:1px; color:green;' width='5%'><b> S </th>";
    }
    
    if($feco>1)
echo"<td class='text-right' $stl><b> A </th><th class='text-right' style='padding:1px; color:green;' width='5%'><b> S </td>";

echo"</tr></thead>";
    $date=$dato;
    while($date<=$datos){
       $to=$ta=0;
       
    if((date('w', strtotime($date)))==0)
    $stl=$stn="style='padding:1px; color:blue;'";
    else{
    $stl="style='padding:1px;'";
    $stn="style='padding:1px; color:green;'";
    }
       
    echo"<tbody><tr><td class='text-center' $stl> $date </td>";
    
    for($n=1; $n<=$i; $n++){
        $user = $name[$n];
    
    $samo=mysql_query("SELECT SUM(`Price`*`Quantity`) AS `Amo`, COUNT(DISTINCT(`Voucher`)) AS `Sale` FROM `stouse` WHERE `Action` = 'SALES' AND `Status` = '0' AND `Date` = '$date' AND `Seller` = '$user' ORDER BY `User` ASC"); 
            $ramo=mysql_fetch_assoc($samo);
                $amo=$ramo['Amo'];
                $sale=$ramo['Sale'];
                $amoo=number_format($amo);
                $sum[$n]+=$amo;
                $salo[$n]+=$sale;
    
    echo"<td class='text-right' title='$user => $date AMOUNT' $stl> $amoo </td><td class='text-right' title='$user => $date SALES' $stn> $sale </td>";
        
            $to+=$amo;              $ta+=$sale;
        }
        
        if($feco>1){
            $too=number_format($to);
    echo"<td class='text-right' title='AMOUNT' $stl><b> $too </td><td class='text-right' title='SALES' $stn><b> $ta </td>";
    }
    
    echo"</tr></tbody><thead>"; 
       
    $date = strtotime("+1 day", strtotime("$date"));
    	$date = date ("Y-m-d", $date);
        }
        
        $to=$ta=0;                  
    $stl="style='padding:1px;'";
    echo"<tr><th class='text-center' $stl><b> TOTAL </th>";
    for($n=1; $n<=$i; $n++){
        $sumo = $sum[$n];
        $sale = $salo[$n];
        $user = $name[$n];
        $sumoo=number_format($sumo);
        $to+=$sumo;
        $ta+=$sale;
    
    echo"<th class='text-right' title='[AMOUNT] $user' $stl><b> $sumoo </th><th class='text-right' title='[SALES] $user' $stn><b> $sale </th>";
    }
    
    if($feco>1){
        $too=number_format($to);
    echo"<th class='text-right' title='AMOUNT' $stl><b> $too </th><th class='text-right' title='SALES' $stn><b> $ta </th>";
    }
    
    echo"</tr>";
    
    
    echo"<tr><td colspan='$spn' style='background-color:powderblue; text-align:center; color:#000000; text-transform: uppercase; font-size:10px; padding:5px;'><label class='col-sm-6 text-center' style='margin:0px;'><b>&nbsp;&nbsp;A: Sales Amount </label><label class='col-sm-6 text-center' style='margin:0px;'><b><font color='green'>&nbsp;&nbsp;S: Sales Customer </label></th></tr>";
    ?>
    
       
    </thead></table>
      <?php
        }
        else{
        ?>
    
	<table width='100%' class='table table-bordered table-striped table-hover datatable' style='font-size:12px;' id='htmltable'><thead>
      <tr role='row'><th class='text-center' width='1%'></th>
        <?php
    $i=0;
    $date=$dato;
    $adte=$sum=$sale=array();
    $stl="style='padding:1px;'";
    while($date<=$datos){
	    $i++;
	 $adte[$i] = $date;
    $dte = date('d/m', strtotime($date));
    if((date('w', strtotime($date)))==0)
    $stl="style='padding:1px; color:blue;'";
    else
    $stl="style='padding:1px;'";
    echo"<th class='text-center' $stl><b>$dte</th>"; 
$date = strtotime("+1 day", strtotime("$date"));
	$date = date ("Y-m-d", $date);
    }
    
        $spn=$i+2;
    $stl="style='padding:1px;'";
        echo"<th class='text-center' $stl><b> TOTAL </th></tr><thead><tbody>";
    $seco=mysql_query("SELECT `Seller` FROM `payment` WHERE `Action`='SALES' AND `Status`='0' AND `Seller`!='' AND `Date` BETWEEN '$dato' AND '$datos' GROUP BY `Seller` ORDER BY `Seller` ASC");
    while($reco=mysql_fetch_assoc($seco)){
       $user=$reco['Seller'];
       $to=$ta=0;
       
    echo"<tr><td colspan='$spn' style='padding:1px; background-color:powderblue; padding-left:40px; color:#000000; text-transform: uppercase;'> $user </td></tr><tr><td $stl><b>&nbsp;&nbsp;A&nbsp;&nbsp;<hr style='margin:0px;'><font color='green'>&nbsp;&nbsp;S&nbsp;&nbsp;</td>";
    
    for($n=1; $n<=$i; $n++){
        $date = $adte[$n];
    
    $samo=mysql_query("SELECT SUM(`Price`*`Quantity`) AS `Amo`, COUNT(DISTINCT(`Voucher`)) AS `Sale` FROM `stouse` WHERE `Action` = 'SALES' AND `Status` = '0' AND `Date` = '$date' AND `Seller` = '$user' ORDER BY `User` ASC"); 
            $ramo=mysql_fetch_assoc($samo);
                $amo=$ramo['Amo'];
                $salo=$ramo['Sale'];
                $amoo=number_format($amo);
                $sum[$n]+=$amo;
                $sale[$n]+=$salo;
    
        if((date('w', strtotime($date)))==0){
        $stl="style='padding:1px; color:blue;'";
        $stn="";
        }
        else{
        $stl="style='padding:1px;'";
        $stn="<font color='green'>";
        }
    echo"<td class='text-right' title='$user => $date' $stl> $amoo <hr style='margin:0px;'>$stn$salo</td>";
            $to+=$amo;              $ta+=$salo;
        }
        
        
    $stl="style='padding:1px;'";
            $too=number_format($to);
       echo"<td class='text-right' $stl><b> $too <hr style='margin:0px;'>$stn$ta </td></tr>"; 
    }
    
    if(mysql_num_rows($seco)>1){
        $to=$ta=0;
    echo"</tbody><thead><tr><td colspan='$spn' style='padding:1px; background-color:powderblue; padding-left:40px; color:#000000; text-transform: uppercase;'> TOTAL SYSTEM USERS </td></tr><tr><th class='text-center' $stl><b>&nbsp;&nbsp;A&nbsp;&nbsp;<hr style='margin:0px;'><font color='green'>&nbsp;&nbsp;S&nbsp;&nbsp;</th>";
    for($n=1; $n<=$i; $n++){
        $sumo = $sum[$n];
        $date = $adte[$n];
        $salo = $sale[$n];
        $sumoo=number_format($sumo);
        $to+=$sumo;
        $ta+=$salo;
    
        if((date('w', strtotime($date)))==0){
        $stl="style='padding:1px; color:blue;'";
        $stn="";
        }
        else{
        $stl="style='padding:1px;'";
        $stn="<font color='green'>";
        }
    echo"<th class='text-right' $stl><b> $sumoo <hr style='margin:0px;'> $stn$salo </th>";
    }
    
    $stl="style='padding:1px;'";
        $too=number_format($to);
    echo"<th class='text-right' $stl><b> $too <hr style='margin:0px;'> $stn$ta </th></tr>";
        }
    
 echo"<tr><td colspan='$spn' style='padding:1px; background-color:powderblue; text-align:center; color:#000000; text-transform: uppercase; font-size:10px;'><label class='col-sm-6 text-center' style='margin:0px;'><b> A: Sales Amount </label><label class='col-sm-6 text-center' style='margin:0px;'><b><font color='green'>&nbsp;&nbsp;S: Received Customers </label></th></tr>";
    ?>
    
       
      </thead></table>
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
      
   </div></div></div>  
   <?php
   include'footer.php';
   ?>
