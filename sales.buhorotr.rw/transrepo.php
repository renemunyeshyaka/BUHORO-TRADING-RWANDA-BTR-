<?php
if(basename($_SERVER['PHP_SELF']) == 'transrepo.php') 
  $cm=" class='current'";
include'connection.php';
$dato=$datos=$Date;
$conde=$custo='';
$stor=$condi='';

	if(isset($_POST['reprint']))
		{
			$vou=$_POST['vous'];
			$action='TRANSFER';
			$cprint='DEL';
	$so=mysql_query("UPDATE `stouse` SET `Printed`='2' WHERE `Voucher`='$vou' AND `Action`='TRANSFER' AND `Printed`='1' ORDER BY `Number` ASC LIMIT 100");
			
	include'creceipt.php';
			$stor=$_POST['duse'];
			$dato=$_POST['dato'];
			$datos=$_POST['datos'];
			$custo=$_POST['custo'];
		}

include'header.php';

if(isset($_POST['search']))
		{
			$dato=$_POST['dato'];
			$datos=$_POST['datos'];
			$custo=$_POST['custo'];
			$stor=$_POST['duse'];
		}
		
		if(isset($_POST['delo']))
		{
			$dato=$_POST['dato'];
			$datos=$_POST['datos'];
			$vou=$_POST['vous'];
			$stor=$_POST['duse'];
			$custo=$_POST['custo'];
			
	$see=mysql_query("SELECT `Number`, `Item`, `Quantity`, `Destin`, `Store` FROM `stouse` WHERE `Action`='TRANSFER' AND `Voucher`='$vou' AND `Status`='0' ORDER BY `Number` ASC");
	while($ree=mysql_fetch_assoc($see)){
	    $nou=$ree['Number'];
	    $item=$ree['Item'];
	    $qto=$ree['Quantity'];
	    $fsto=$ree['Store'];
	    $tsto=$ree['Destin'];
	    
	
		    $doin=mysql_query("UPDATE `items` SET `$tsto`=`$tsto`-'$qto' WHERE `Number`='$item' ORDER BY `Number` ASC LIMIT 1");
		    
		    $doout=mysql_query("UPDATE `items` SET `$fsto`=`$fsto`+'$qto' WHERE `Number`='$item' ORDER BY `Number` ASC LIMIT 1");
		    
	$then=mysql_query("DELETE FROM `stouse` WHERE `Number`='$nuo' ORDER BY `Number` ASC LIMIT 1");
	            }
		}
		
		
		
	if($custo)
		$conde="AND `Destin`='$custo'";


		if($stor)
			$conde="AND `Store`='$stor'";


		if($dato==$datos)
			$mpri="ON $dato";
		else
			$mpri="FROM $dato TO $datos";

$doi=mysql_query("SELECT *FROM `stouse` WHERE `Date` BETWEEN '$dato' AND '$datos' AND `Status`='0' AND `Action`='TRANSFER' AND `Voucher`!='0' AND `Destin`!='DAMAGED/EXPIRIES' $conde $condi GROUP BY `Voucher` ORDER BY `Voucher` ASC");
$fo=mysql_num_rows($doi);
?>
<div class="container-fluid main-content">
        <div class="page-title hidden-print">
          <h2 style='margin-top:-20px; margin-bottom: 5px; color:#ffcc33'>
         Store Report
          </h2>
                 </div>
     
        <div class="row">
  <div class="col-lg-2 hidden-print">
   
   <ul class="list-group">

    <li class="list-group-item">
	  <a href="storeport.php">
                <p>
                <i class="lnr lnr-menu-circle"></i>&nbsp;Store Report
                </p>
              </a></li>  

	 <li class="list-group-item">
	  <a href="inrepo.php">
                <p>
                <i class="lnr lnr-menu-circle"></i>&nbsp;S.In Report
                </p>
              </a></li>  
      
    <li class="list-group-item">
	  <a href="outrepo.php">
                <p>
                <i class="lnr lnr-menu-circle"></i>&nbsp;S.Out Report
                </p>
              </a></li>   

			   <li class="list-group-item active">
              <a href="transrepo.php">
                <p>
                <i class="lnr lnr-menu-circle"></i>&nbsp;Transfer Report
                </p>
              </a></li> 

			   <li class="list-group-item">
              <a href="delirepo.php">
                <p>
                <i class="lnr lnr-menu-circle"></i>&nbsp;Delivery Report
                </p>
              </a></li> 
			  
			   <li class="list-group-item">
              <a href="recerepo.php">
                <p>
                <i class="lnr lnr-menu-circle"></i>&nbsp;Receiving Report
                </p>
              </a></li>

			  <li class="list-group-item">
              <a href="purrepo.php">
                <p>
                <i class="lnr lnr-menu-circle"></i>&nbsp;Purchase Report
                </p>
              </a></li>  

	 <li class="list-group-item">
	  <a href="dispatch.php">
                <p>
                <i class="lnr lnr-menu-circle"></i>&nbsp;Count Report
                </p>
              </a></li>     

	 <li class="list-group-item">
	  <a href="stobal.php">
                <p>
                <i class="lnr lnr-menu-circle"></i>&nbsp;Item Report
                </p>
              </a></li>  
                         
            </ul>
  </div>
                    
           
           
       
        <div class="col-lg-10">
                  <div class="row">
         <form action="" method="post" class="form-horizontal "> 
		 <div class="col-lg-4 hidden-print"> </div>

           <div class="col-lg-2 hidden-print"><select class='form-control' name='duse' style="padding-left:5px; padding-right:5px;">
				<option value=''> STORE </option>
		<?php
	$dob=mysqli_query($cons, "SELECT *FROM `stores` WHERE `Status`>='0' ORDER BY `Number` ASC");
		while($rob=mysqli_fetch_assoc($dob)){
			$stonum=$rob['Store'];
			$stona=$rob['Name'];
			if($stonum==$stor)
				$s="selected";
			else
				$s="";
	echo"<option value='$stonum' $s> &nbsp;&nbsp; $stona </option>";
		}
				?>
		</select></div>
                           
                       <div class="col-lg-6 hidden-print">
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

			<div class="divFooter"><center><u><b>DELIVERY REPORT <?php echo $mpri ?></b></u></center></div>
             <div class="row">
            <div class="col-lg-12">
             <span>Total Records Found : <b><?php echo" $fo " ?></b></span>
			 <span class="pull-right hidden-print"><b>MAIN STORE</b>
			 &nbsp;&nbsp;&nbsp;&nbsp;<a href="#" onclick="return window.print()" class="hidden-print" title='Click to print' data-toggle='tooltip' data-placement='top'><i class="lnr lnr-printer hidden-print"></i></a></span>
            <div class="widget-container fluid-height clearfix">
            <div class="widget-content padded clearfix">
               
			   <?php
$gto=0;
			   while($roi=mysql_fetch_assoc($doi)){
				$vous=$roi['Voucher'];
				$desto=$roi['Destin'];
	$do=mysql_query("SELECT *FROM `stouse` WHERE `Voucher` = '$vous' AND `Status`='0' AND `Action`='TRANSFER' AND `Destin`='$desto'");
				?>
                                 <table class="table table-striped table-hover">     
                                      <thead>
                     <tr role="row">
                     <th class="hidden-xs"> No </th> 
                       <th> Due&nbsp;Date </th>
                       <th> Done&nbsp;By </th>
                       <th> Destination </th>
                        <th> Brand&nbsp;Name </th>
                       <th> Item&nbsp;Name </th>
						 <th> Price/Unit </th>
						 <th colspan='2'> Quantity </th>
                       <th><div align='right'> Total&nbsp;Amount&nbsp;</th>
                     </tr>
                    </thead>
                                        <tbody>
					<?php
					$n=1;				$tp=0;	
						while($ro=mysql_fetch_assoc($do)){
				$code=$ro['Number'];
				$item=$ro['Item'];			
			$cost=$ro['Cost'];			$costo=number_format($cost, 2);
			$qt=$ro['Quantity'];
			$dte=$ro['Date'];
			$type=$ro['Destin'];
			$store=$ro['Store'];
			$pers=$ro['User'];
			$vouc=$ro['Voucher'];
			$use=$ro['User'];
			$pri=$ro['Price'];
			$stor=$ro['Store'];
			$prio=number_format($pri, 2);
	

 $dos=mysql_query("SELECT `Name` FROM `stores` WHERE `Store`='$stor' ORDER BY `Number` ASC");
		$ros=mysql_fetch_assoc($dos);
				$fsto=$ros['Name'];
	

 $dos=mysql_query("SELECT `Name` FROM `stores` WHERE `Store`='$type' ORDER BY `Number` ASC");
		$ros=mysql_fetch_assoc($dos);
				$tsto=$ros['Name'];
			
	$dov=mysql_query("SELECT *FROM `items` WHERE `Number`='$item' ORDER BY `Number` DESC LIMIT 1");
		$rov=mysql_fetch_assoc($dov);
			$kin=$rov['Type'];
			$descri=$rov['Descri'];
			$uno=$rov['Unit'];
			$iname=$rov['Iname'];
          //  $stock=$rov['Store'];

//$dow=mysql_query("UPDATE `stouse` SET `Store`='$stock' WHERE `Item`='$item' AND `Action`='TAKEN` AND `Store`='0' ORDER BY `Number` DESC LIMIT 10");
			$stn="padding:1px;";	

				$dox=mysql_query("SELECT *FROM `unit` WHERE `Number`='$uno' ORDER BY `Number` ASC");
					$rox=mysql_fetch_assoc($dox);
							$unit=$rox['Unit'];
					
	$don=mysql_query("SELECT *FROM `itype` WHERE `Number`='$kin' ORDER BY `Number` ASC");
		$ron=mysql_fetch_assoc($don);
				$tyso=$ron['Type'];

	$tot=$qt*$pri;

         $toto=number_format($tot, 2);							$qty=number_format($qt, 2);                             $typo=$type;
		print("<tr>
          <td class='hidden-xs' style='$stn'><div align='center'>$n&nbsp;&nbsp;</td>
			<td style='$stn'> $dte </td><td style='$stn'> $pers </td>
			<td style='$stn'> $fsto&nbsp;-&nbsp;$tsto </td><td style='$stn'> $tyso </td>
			<td style='$stn'> $iname </td><td style='$stn'><div align='right'> $prio &nbsp;&nbsp; </td>
				<td style='$stn'><div align='right'> $qty </td><td style='$stn'> $unit </td>
<td style='$stn'><div align='right'> $toto </td></tr>");
						  $n++;					$tp+=$tot;
						}
						$tpo=number_format($tp, 2);			
						?>
						
                     </tbody><thead>
					<?php echo"<tr title='Done by: $use' data-toggle='tooltip' data-placement='top'>"; ?>
					<form action='' method='post'>
					    <th class='text-right hidden-xs'><div align='right'>
					<?php
						 echo"<input type='hidden' name='vous' value='$vous'>
						 <input type='hidden' name='dato' value='$dato'>
						 <input type='hidden' name='custo' value='$custo'>
						 <input type='hidden' name='datos' value='$datos'>
						 <input type='hidden' name='duse' value='$duse'>";
						?>
    <button type='submit' class='btn btn-xs btn-success hidden-print' name='reprint' style='height:18px; padding:0px; margin:0px;' title='Reprint transfer voucher' data-toggle='tooltip' data-placement='top'>
			&nbsp;&nbsp;<i class='lnr lnr-printer'></i>&nbsp;&nbsp;</button>
					 </th></form>

					 <form action='' method='post'><th>
					<?php
		if($_SESSION['Edit']){
			 $dbutn='submit';
			 $disa='Click to delete this transfer';
		 }
		 else{
			 $dbutn='button';
			 $disa='You are not allowed to edit';
		 }
		
						 echo"<input type='hidden' name='vous' value='$vous'>
						 <input type='hidden' name='dato' value='$dato'>
						 <input type='hidden' name='datos' value='$datos'>
						 <input type='hidden' name='duse' value='$duse'>
						 <input type='hidden' name='custo' value='$custo'>
                         <button type='$dbutn' class='btn btn-xs btn-danger hidden-print' name='delo' style='height:18px; padding:0px; margin:0px;' title='$disa' data-toggle='tooltip' data-placement='top'>
						  &nbsp;&nbsp;<i class='lnr lnr-trash'></i>&nbsp;&nbsp;</button>";
				
					?>
					 </th></form><th><div align='center' style="color:powderblue"> STORE : <?php echo $fsto ?></th>

					<th colspan='5'><div align='center'> Total Amount </th>
					<th> </th><th><div align='right'><?php echo $tpo ?></th></tr>
                  </table><br><br>
				  <?php
$gto+=$tp;
			   }

$gto=number_format($gto, 2);
if($fo>='2'){
					 ?> 
<table class="table table-striped table-hover">     
                                      <thead>
                     <tr role="row">
                     <th class="hidden-xs" width='5%'> </th> 
<th><div align='right'> Grand Total </th>
					<th width='5%'> </th><th width='10%'><div align='right'><?php echo $gto ?>&nbsp;</th>
</tr></table> 
<?php
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
