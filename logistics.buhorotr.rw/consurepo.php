<?php
if(basename($_SERVER['PHP_SELF']) == 'consurepo.php') 
  $cm=" class='current'";
include'header.php';
include'connection.php';
$datos=$Date;
$custo="GROUP";
$conde=$ito='';

$dato = strtotime("-7 days", strtotime("$Date"));
$dato = date ("Y-m-d", $dato);

// search for an item to be added to the chart
if(isset($_POST['search']))
		{
			$dato=$_POST['dato'];
			$datos=$_POST['datos'];
			$custo=$_POST['custo'];
			$ito=$_POST['ito'];
			$p=1;
		}
		
		if($dato==$datos)
			$mpri="ON $dato";
		else
			$mpri="FROM $dato TO $datos";

        if($ito)
	$conde="AND `items`.`Item` LIKE '%$ito%'";
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
                  
			  <li class="list-group-item">
              <a href="recerepo.php">
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
                  
			  <li class="list-group-item active">
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
                    
           
           
       
        <form action="" method="post" class="form-horizontal "> 
        <div class="col-lg-10">
                  <div class="row">

				  <div class="col-lg-1"> </div>  
				  
             <div class="col-lg-3 hidden-print"> 
      <input class="form-control"  name="ito" type="text" id="search" list="item" autofocus="autofocus" value="<?php echo $ito ?>">
	   <datalist id="item">
	  <?php
	$select =mysqli_query($conn, "SELECT * FROM `items` WHERE `Status` = '0' GROUP BY `Item` ORDER BY `Item` ASC");
while ($row=mysqli_fetch_array($select)) 
{
 echo"<option value=".$row['Item'].">";
}
	  ?>
		</datalist>
			</div> 
                         
                       <div class="col-lg-8 hidden-print"><div class="col-lg-3">
			<select class="form-control" name="custo">
				<option value='GROUP' selected='selected'>SELECT ITEMS</option>
			<option value='GROUP'> GROUPED ITEMS </option><option value='DETAIL'> DETAILLED ITEMS </option>
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
<?php
// *************************** Detailled Items *************************
if($custo=='DETAIL'){
$do=mysqli_query($conn, "SELECT `items`.`Item`, `items`.`Type`, `stouse`.`Number`, `stouse`.`Vehicles`, `stouse`.`Date`, `stouse`.`Quantity`, `stouse`.`Price`, `stouse`.`Repair` FROM `stouse` INNER JOIN `items` ON `stouse`.`Item` = `items`.`Number` WHERE (`stouse`.`Action`='USED' OR `stouse`.`Action`='PURCHASE') AND `stouse`.`Status`='0' AND `stouse`.`Store`='1' AND `stouse`.`Date` BETWEEN '$dato' AND '$datos' $conde  ORDER BY `stouse`.`Date` ASC");
$fo=mysqli_num_rows($do);
?>
<div class="divFooter"><center><u><b>CONSUMPTION REPORT <?php echo"$mpri"; ?></b></u></center></div>
             <div class="row">
            <div class="col-lg-12" style='margin-top:-20px;'>
             <span> &nbsp;&nbsp; Total Records Found : <b><?php echo" $fo " ?></b></span>
			 <span class="pull-right"><a href="#" onclick="return window.print()" class="hidden-print" title='Click to print' data-toggle='tooltip' data-placement='top'><i class="lnr lnr-printer"></i></a></span>
            <div class="widget-container fluid-height clearfix">
            <div class="widget-content padded clearfix">
               
                                 <table class="table table-striped table-hover">     
                                      <thead>
                    <tr role="row">
                     <th> No </th>
                        <th><div align='center'> DATE </th>
                        <th><div align='center'> ITEM&nbsp;NAME </th>
                       <th><div align='center'> ITEM&nbsp;TYPE </th>
					   <th width='30%'><div align='center'> DESCRIPTION </th>
						 <th><div align='center'> VEHICLE </th>
						 <th><div align='center'> PRICE </th>
						 <th><div align='center'> QUANTITY </th>
							<th><div align='center'>AMOUNT</th>
                     </tr>
                    </thead>
                                        <tbody>
					<?php
					$n=1;				$to=0;
						while($ro=mysqli_fetch_assoc($do)){
				$code=$ro['Number'];
				$stat=$ro['Vehicles'];
				$dat=$ro['Date'];
			$ite=$ro['Item'];
			$pri=$ro['Price'];
			$qty=$ro['Quantity'];
			$val=$qty*$pri;
				$item=$ro['Item'];
				$type=$ro['Type'];
				$repa=$ro['Repair'];

			$sdo=mysqli_query($conn, "SELECT `Plate` FROM `vehicles` WHERE `Number`='$stat' ORDER BY `Number` DESC");
				$sro=mysqli_fetch_assoc($sdo);
				    $pla=$sro['Plate'];
				    
			$rdo=mysqli_query($conn, "SELECT `Issue` FROM `repair` WHERE `Number`='$repa' ORDER BY `Number` DESC");
				$rro=mysqli_fetch_assoc($rdo);
				    $dest=$rro['Issue'];


	$prio=number_format($pri,2);				$qto=number_format($qty,2);					$valo=number_format($val,2);
			$stl="style='padding:1px;'";
		 
		print("<tr>
                        <td $stl><div align='right'>$n&nbsp;&nbsp;</td>
						<td class='text-center' $stl> $dat </td>
						<td $stl> $item </td><td $stl> $type </td>
						<td $stl> $dest </td><td $stl> $pla </td>
						<td $stl class='text-right'> $prio </td>
						<td $stl class='text-right'> $qto </td>
						<td class='text-right' style='padding:1px 10px 1px 1px;'>$valo</div></tr>");
							$n++;                    $to+=$val;
						}
						$to=number_format($to, 2);					
						?>
						
                    </tbody>
					<tr><th> </th><th colspan='6'>&nbsp;&nbsp;&nbsp;&nbsp; TOTAL VALUE </th>
					<th class='text-right' colspan='3'><?php echo $to ?>&nbsp;</th></tr>
                  </table>
              </div></div>

                  </div>                     
                
              </div><span class="pull-right hidden-print">
			 &nbsp;&nbsp;&nbsp;&nbsp;<a href="#" onclick="return window.print()" class="hidden-print" title='Click to print' data-toggle='tooltip' data-placement='top'><i class="lnr lnr-printer"></i></a></span>
            </div></div>
                  </div>
        
   <?php
}
   else{

	   // ****************************************** GROUPED ITEMS *******************************************
$dos=mysqli_query($conn, "SELECT `stouse`.`Item`, `stouse`.`Destin`, `stouse`.`Date` FROM `stouse` INNER JOIN `items` ON `stouse`.`Item` = `items`.`Number` WHERE (`stouse`.`Action`='USED' OR `stouse`.`Action`='PURCHASE') AND `stouse`.`Status`='0' AND `stouse`.`Store`='1' AND `stouse`.`Date` BETWEEN '$dato' AND '$datos' $conde GROUP BY `stouse`.`Item` ORDER BY `stouse`.`Date` DESC");
	$fos=mysqli_num_rows($dos);
?>
<div class="divFooter"><center><u><b>CONSUMPTION REPORT <?php echo"$mpri"; ?></b></u></center></div>
             <div class="row">
            <div class="col-lg-12" style='margin-top:-20px;'>
             <span> &nbsp;&nbsp; Total Records Found : <b><?php echo" $fos " ?></b></span>
			 <span class="pull-right"><a href="#" onclick="return window.print()" class="hidden-print" title='Click to print' data-toggle='tooltip' data-placement='top'><i class="lnr lnr-printer"></i></a></span>
            <div class="widget-container fluid-height clearfix">
            <div class="widget-content padded clearfix">
               
                                 <table class="table table-striped table-hover">     
                                      <thead>
                    <tr role="row">
                     <th> No </th>
                        <th><div align='center'> DATE </th>
                        <th><div align='center'> ITEM&nbsp;NAME </th>
                       <th><div align='center'> ITEM&nbsp;TYPE </th>
					   <th><div align='center'> DESCRIPTION </th>
						 <th><div align='center'> PRICE </th>
						 <th><div align='center'> QUANTITY </th>
							<th><div align='center'>AMOUNT</th>
                     </tr>
                    </thead>
                                        <tbody>
					<?php
					$n=1;				$to=0;
	while($ros=mysqli_fetch_assoc($dos)){
				$item=$ros['Item'];
				$dest=$ros['Destin'];
				$dat=$ros['Date'];

	$do=mysqli_query($conn, "SELECT `items`.`Item`, `items`.`Type`, SUM(`stouse`.`Quantity`) AS `Qty`, SUM(`stouse`.`Quantity`*`stouse`.`Price`) AS `Amo` FROM `stouse` INNER JOIN `items` ON `stouse`.`Item` = `items`.`Number` WHERE (`stouse`.`Action`='USED' OR `stouse`.`Action`='PURCHASE') AND `stouse`.`Status`='0' AND `stouse`.`Store`='1' AND `stouse`.`Item`='$item' AND `Date` BETWEEN '$dato' AND '$datos' $conde  GROUP BY `stouse`.`Item` ORDER BY `stouse`.`Number` ASC");
		$ro=mysqli_fetch_assoc($do);
			$val=$ro['Amo'];
			$qty=$ro['Qty'];
			$pri=$val/$qty;
			$item=$ro['Item'];
			$type=$ro['Type'];

			$prio=number_format($pri,2);				$qto=number_format($qty,2);					$valo=number_format($val,2);
			$stl="style='padding:1px;'";
		 
		print("<tr>
                        <td $stl><div align='right'>$n&nbsp;&nbsp;</td>
						<td class='text-center' $stl> $dat </td>
						<td $stl> $item </td><td $stl> $type </td><td $stl> $dest </td>
						<td $stl class='text-right'> $prio </td>
						<td $stl class='text-right'> $qto </td>
						<td class='text-right' style='padding:1px 10px 1px 1px;'>$valo</div></tr>");
							$n++;                    $to+=$val;
						}
						$to=number_format($to, 2);					
						?>
						
                    </tbody>
					<tr><th> </th><th colspan='5'>&nbsp;&nbsp;&nbsp;&nbsp; TOTAL VALUE </th>
					<th class='text-right' colspan='3'><?php echo $to ?>&nbsp;</th></tr>
                  </table>
              </div></div>

                  </div>                     
                
              </div><span class="pull-right hidden-print">
			 &nbsp;&nbsp;&nbsp;&nbsp;<a href="#" onclick="return window.print()" class="hidden-print" title='Click to print' data-toggle='tooltip' data-placement='top'><i class="lnr lnr-printer"></i></a></span>
            </div></div>
                  </div>
	
	<?php
   }
   include'footer.php';
   ?>
