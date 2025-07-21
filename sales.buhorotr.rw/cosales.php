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
		//	$custo=$_POST['custo'];
			$p=1;
		}

		if($dato==$datos)
			$mpri="ON $dato";
		else
			$mpri="FROM $dato TO $datos";
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
      
    <li class="list-group-item">
	  <a href="payoutrepo.php">
                <p>
                <i class="lnr lnr-menu-circle"></i>&nbsp;Payout Report
                </p>
              </a></li>           
      
    <li class="list-group-item active">
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
                           <div class="col-lg-2"> 		   </div> 
                       
                       <div class="col-lg-3"> </div>  
					   
					   
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
               
    $doxi=mysql_query("SELECT *FROM `stouse` WHERE `Voucher`!='0' AND `Date` BETWEEN '$dato' AND '$datos' AND `Action`='SALES' AND `Status`='0' GROUP BY `Date` ORDER BY `Date` ASC");

$dox=mysql_query("SELECT `items`.`Type` FROM `stouse` INNER JOIN `items` ON `stouse`.`Item`=`items`.`Number` WHERE `stouse`.`Voucher`!='0' AND `stouse`.`Date` BETWEEN '$dato' AND '$datos' AND `stouse`.`Action`='SALES' AND `stouse`.`Status`='0' GROUP BY `items`.`Type` ORDER BY `items`.`Type` ASC");
            $fox=mysql_num_rows($dox);
            
				if($foxi=mysql_num_rows($doxi)){
					?>
					<div class="divFooter"><center><u><b>SALES REPORT <?php echo"$mpri"; ?></b></u></center></div>
		 <div class="row">
            <div class="col-lg-12">
             <span> &nbsp;&nbsp; Total Records Found : <b><?php echo" $foxi " ?></b></span>
			 <span class="pull-right hidden-print">
			 <a href="#" onclick="return window.print()" class="hidden-print" title='Click to print' data-toggle='tooltip' data-placement='top'>
			 <i class="lnr lnr-printer"></i></a></span>
            <div class="widget-container fluid-height clearfix">
            <div class="widget-content padded clearfix">
			
			<?php
			$type=array();
       echo"<form action='' method='post'>
       <table class='table table-striped' style='font-size:11px;'>
				<thead><tr style='background-color:#ffffff;'>
              <td style='background-color:#ffffff;' width='6%' class='text-center'> # </td>
              <td class='text-center' style='background-color:#ffffff;'> &nbsp; Date &nbsp; </td>";
                $k=1;
              while($rox=mysql_fetch_assoc($dox)){
                  $kin=$rox['Type'];
                  $type[$k]=$kin;
    $don=mysql_query("SELECT *FROM `itype` WHERE `Number`='$kin' ORDER BY `Number` ASC");
		$ron=mysql_fetch_assoc($don);
				$tyso=$ron['Type'];
				$k++;
            
            echo"<td class='text-center' style='background-color:#ffffff;'> $tyso </td>";
              }
      
      echo"<td style='background-color:#ffffff;' class='text-center'>Total</td>
					</tr></thead>
                                        <tbody>";
				$i=1;                               $tco=array();
		while($roxi=mysql_fetch_assoc($doxi)){
				$dte=$roxi['Date'];	
				
	print("<tr><td style='$stn'><div align='right'> $i &nbsp;&nbsp; </td>
<td class='text-center' style='$stn'> $dte&nbsp;</td>");
$tot=0;
    for($n=1; $n<=$fox; $n++){
        $item=$type[$n];

	$dor=mysql_query("SELECT SUM(`stouse`.`Quantity`*`stouse`.`Price`) AS 'Sales' FROM `stouse` INNER JOIN `items` ON `items`.`Number` = `stouse`.`Item` WHERE `stouse`.`Voucher`!='0' AND `stouse`.`Date`='$dte' AND `stouse`.`Action`='SALES' AND `stouse`.`Status`='0' AND `items`.`Type`='$item' ORDER BY `stouse`.`Number` ASC");
				$ror=mysql_fetch_assoc($dor);			
				$tut=$ror['Sales'];
			$tuto=number_format($tut, 2);
					$stn="padding:1px;";
					$tco[$n]+=$tut;

print("<td style='$stn'><div align='right'> $tuto </td>");
$tot+=$tut;
}
$toto=number_format($tot);
echo"<td style='$stn'><div align='right'> $toto </td></tr>";
$i++;					$ptu+=$tut;						$pcu+=$toc;	
$tam+=$amo;                         $tba+=$bal;
}

		$inc=number_format($ptu-$pcu, 2);
		$tam=number_format($tam, 2);	
		$tba=number_format($tba, 2);			
		$ptu=number_format($ptu, 2);				
		$pcu=number_format($pcu, 2);
print("</tbody><thead><tr><th colspan='2' class='text-center'>Total </th>");
$gto=0;
for($n=1; $n<=$fox; $n++){
    $tot=$tco[$n];
    $gto+=$tot;
    
    $toto=number_format($tot);
echo"<th class='text-right'> $toto </th>";
}
$gto=number_format($gto);
echo"<th class='text-right'> $gto </th></tr></thead></table>";
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