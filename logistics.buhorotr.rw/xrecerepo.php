<?php
if(basename($_SERVER['PHP_SELF']) == 'xrecerepo.php') 
  $cm=" class='current'";
include'header.php';
$dato=$datos=$Date;
$conde=$custo='';

if(isset($_POST['search']))
		{
			$dato=$_POST['dato'];
			$datos=$_POST['datos'];
			$custo=$_POST['custo'];
		}
		
	if($custo)
		$conde="AND `Destin`='$custo'";

		if($dato==$datos)
			$mpri="ON $dato";
		else
			$mpri="FROM $dato TO $datos";

$doi=mysqli_query($conn, "SELECT *FROM `stouse` WHERE `Date` BETWEEN '$dato' AND '$datos' AND `Status`='0' AND `Action`='RECEIVE' AND `Voucher`!='0' $conde GROUP BY `Voucher` ORDER BY `Date` ASC");
$fo=mysqli_num_rows($doi);
?>

<div class="container-fluid main-content">
        <div class="page-title hidden-xs hidden-print">
          <h2 style='margin-top:-20px; margin-bottom: 5px; color:#ffcc33'>
         Store Report
          </h2>
                 </div>
     
        <div class="row">
  <div class="col-lg-2 hidden-print">
   
   <ul class="list-group">

    <li class="list-group-item">
	  <a href="storepo.php">
                <p>
                <i class="lnr lnr-menu-circle"></i>&nbsp;Store Status
                </p>
              </a></li>
                  
			  <li class="list-group-item">
              <a href="recerepo.php">
                <p>
                <i class="lnr lnr-plus-circle"></i>&nbsp;S.In &nbsp;Report
                </p>
              </a></li>
                  
			  <li class="list-group-item active">
              <a href="xrecerepo.php">
                <p>
                <i class="lnr lnr-plus-circle"></i>&nbsp;Receiving Report
                </p>
              </a></li>
                  
			  <li class="list-group-item">
              <a href="requirepo.php">
                <p>
                <i class="lnr lnr-plus-circle"></i>&nbsp;Requisition Report
                </p>
              </a></li>
                  
			  <li class="list-group-item">
              <a href="consurepo.php">
                <p>
                <i class="lnr lnr-plus-circle"></i>&nbsp;Consumption Report
                </p>
              </a></li> 
                  
			  <li class="list-group-item">
              <a href="balrepo.php">
                <p>
                <i class="lnr lnr-menu-circle"></i>&nbsp;Balance Report
                </p>
              </a></li>   
                  
			  <li class="list-group-item">
              <a href="suprepo.php">
                <p>
                <i class="lnr lnr-plus-circle"></i>&nbsp;Suppliers Report
                </p>
              </a></li> 
                  
			  <li class="list-group-item">
              <a href="counting.php">
                <p>
                <i class="lnr lnr-menu-circle"></i>&nbsp;Counting Papers
                </p>
              </a></li> 
                       
            </ul><br><br><br>
  </div>
                    
                    
           
           
       
        <div class="col-lg-10">
                  <div class="row">
         
           <div class="col-lg-3"> </div>
        <form action="" method="post" class="form-horizontal ">    
          
         <div class="col-lg-3"> 
					   
			   <select class="form-control" name="custo">
            <?php
		echo"<option value='' selected='selected'> SELECT SUPPLIER </option>";
	$top=mysqli_query($conn, "SELECT `Destin` FROM `stouse` WHERE `Status`='0' AND `Action`='RECEIVE' GROUP BY `Destin` ORDER BY `Destin` ASC");
			while($rop=mysqli_fetch_assoc($top)){
				$sup=$rop['Destin'];
			echo"<option value='$sup'> $sup </option>";
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

			<div class="divFooter"><center><u><b>RECEIVING REPORT <?php echo $mpri ?></b></u></center></div>
             <div class="row">
            <div class="col-lg-12">
             <span>Total Records Found : <b><?php echo" $fo " ?></b></span>
			 <span class="pull-right hidden-print"><b>MAIN STORE</b>
			 &nbsp;&nbsp;&nbsp;&nbsp;<a href="#" onclick="return window.print()" class="hidden-print" title='Click to print' data-toggle='tooltip' data-placement='top'><i class="lnr lnr-printer hidden-print"></i></a></span>
            <div class="widget-container fluid-height clearfix">
            <div class="widget-content padded clearfix">
               
			    <?php
$gto=0;
			   while($roi=mysqli_fetch_assoc($doi)){
				$vous=$roi['Voucher'];
				
	$do=mysqli_query($conn, "SELECT *FROM `stouse` WHERE `Voucher` = '$vous' AND `Status`='0' AND `Action`='RECEIVE'");
				?>
                                 <table class="table table-striped table-hover">     
                                      <thead>
                     <tr role="row">
                     <th class="hidden-xs"> No </th> 
                       <th> Due&nbsp;Date </th>
                        <th> Item&nbsp;Type </th>
                       <th> Item&nbsp;Name </th>
                       <th> Supplier </th>
						 <th> Price/Unit </th>
						 <th colspan='2'> Quantity </th>
                       <th><div align='right'> Total&nbsp;Amount&nbsp;</th>
                     </tr>
                    </thead>
                                        <tbody>
					<?php
					$n=1;				$tp=0;	
						while($ro=mysqli_fetch_assoc($do)){
				$code=$ro['Number'];
				$item=$ro['Item'];			
			$cost=$ro['Cost'];			$costo=number_format($cost, 2);
			$qt=$ro['Quantity'];
			$dte=$ro['Date'];
			$type=$ro['Destin'];
			$use=$ro['User'];
			$pri=$ro['Price'];				
			$prio=number_format($pri, 2);
			
	$dov=mysqli_query($conn, "SELECT *FROM `items` WHERE `Number`='$item' ORDER BY `Number` DESC LIMIT 1");
		$rov=mysqli_fetch_assoc($dov);
			$tyso=$rov['Type'];
			$descri=$rov['Descri'];
			$iname=$rov['Item'];

                    $stn="padding:1px;";				
							$unit="PC";

	$tot=$qt*$pri;

         $toto=number_format($tot, 2);					
									$qty=number_format($qt, 2);
		print("<tr>
          <td class='hidden-xs' style='$stn'><div align='center'>$n&nbsp;&nbsp;</td>
			<td style='$stn'> $dte </td><td style='$stn'> $tyso </td><td style='$stn'> $iname </td>
                <td style='$stn'> $type </td><td style='$stn'><div align='right'> $prio &nbsp;&nbsp; </td>
				<td style='$stn'><div align='right'> $qty </td><td style='$stn'> $unit </td>
<td style='$stn'><div align='right'> $toto </td></tr>");
						  $n++;					$tp+=$tot;
						}
						$tpo=number_format($tp, 2);			
						?>
						
                     </tbody><thead>
		<?php echo"<tr title='Done by: $use' data-toggle='tooltip' data-placement='top'>"; ?>
	<form action='recedoc.php' method='post'><th class='text-right hidden-xs'>
					<?php
				echo"<input type='hidden' name='rowid' value='$vous'>
			<input type='hidden' name='page' value='xrecerepo.php'>";
						?>
                          <button type='submit' class='btn btn-xs btn-success hidden-print' name='opens' style='height:18px; padding:0px; margin:0px;' title='Click to open delivery voucher' data-toggle='tooltip' data-placement='top'>
						  &nbsp;&nbsp;<i class='lnr lnr-download'></i>&nbsp;&nbsp;</button>
					 </th></form>

		<form action='receive.php' method='post'><th>
					<?php
		if($_SESSION['Ecx']){
			 $dbutn='submit';
			 $disa='Click to edit this receiving';
		 }
		 else{
			 $dbutn='button';
			 $disa='You are not allowed to edit';
		 }
			$dor=mysqli_query($conn, "SELECT *FROM `stouse` WHERE `Status`='0' AND `Voucher`='0' AND `Action`='RECEIVE' ORDER BY `Number` DESC");
				if($for=mysqli_num_rows($dor)){
		echo"<input type='hidden' name='vous' value='$vous'>						
                         <button type='button' class='btn btn-xs btn-warning hidden-print' name='edivo' style='height:18px; padding:0px; margin:0px;' title='Not allowed at this moment' data-toggle='tooltip' data-placement='top'>
						  &nbsp;&nbsp;<i class='lnr lnr-pencil'></i>&nbsp;&nbsp;</button>";
				}
				else{
						 echo"<input type='hidden' name='vous' value='$vous'>						
                         <button type='$dbutn' class='btn btn-xs btn-warning hidden-print' name='edivo' style='height:18px; padding:0px; margin:0px;' title='$disa' data-toggle='tooltip' data-placement='top'>
						  &nbsp;&nbsp;<i class='lnr lnr-pencil'></i>&nbsp;&nbsp;</button>";
				}
					?>
					 </th></form><th><div align="center" style="color:#fa34a1;"><?php echo $vous ?></div></th>
					<th colspan='4'><div align='right'> Total Amount </th>
					<th> </th><th><div align='right'><?php echo $tpo ?></th></tr>
                  </table> <br><br>
				  <?php
			/*
				  if($dato>='2022-12-01' AND $datos<='2023-01-31'){	
		$seep=mysqli_query($conn, "SELECT `Number` FROM `services` WHERE `Supplier`='$type' AND `Date`='$dte'");
			if(!$reep=mysqli_num_rows($seep))
	$then=mysqli_query($conn, "INSERT INTO `services` (`Date`, `User`, `Item`, `Supplier`, `Amount`, `Invoice`, `Purpose`, `Status`, `Currency`, `Rate`, `Vat`, `Holdings`) VALUES ('$dte', '$use', 'LOGISTICS', '$type', '$tp', 'N/A', 'SPAREPARTS', '0', 'RWF', '1', '0', '0')");
				  }
	*/
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
                  </div> <span class="pull-right hidden-print">
			 &nbsp;&nbsp;&nbsp;&nbsp;<a href="#" onclick="return window.print()" class="hidden-print" title='Click to print' data-toggle='tooltip' data-placement='top'><i class="lnr lnr-printer"></i></a></span>
      
   </div></div></div>
 
   <?php
   include'footer.php';
   ?>
