<?php
if(basename($_SERVER['PHP_SELF']) == 'requirepo.php') 
  $cm=" class='current'";
include'header.php';
include'connection.php';
$dato=$datos=$Date;
$custo=$conde='';
$p=0;

// delete the whole requisition
if(isset($_POST['delos']))
		{
			$rowid=$_POST['rowid'];
			$then=mysqli_query($conn, "DELETE FROM `stouse` WHERE `Voucher`='$rowid' AND `Action`='REQUISE' LIMIT 100");
		}

// edit the whole requisition
if(isset($_POST['edits']))
		{
			$rowid=$_POST['rowid'];
			$then=mysqli_query($conn, "UPDATE `stouse` SET `Voucher`='0' WHERE `Voucher`='$rowid' AND `Action`='REQUISE' LIMIT 100");
		}

// edit an item from a given chart
if(isset($_POST['edit']))
		{
			$rowid=$_POST['rowid'];
			$qty=$_POST['qty'];
				$qty=str_replace(',', '', $qty);
			$pri=$_POST['pri'];
				$pri=str_replace(',', '', $pri);
			$then=mysqli_query($conn, "UPDATE `stouse` SET `Quantity`='$qty', `Price`='$pri' WHERE `Number`='$rowid' LIMIT 1");
		}

// Search for an item to be added to the chart
if(isset($_POST['search']))
		{
			$dato=$_POST['dato'];
			$datos=$_POST['datos'];
			$p=1;
		}

// Add found item to the chart
		if(isset($_POST['addo']))
		{
			$n=$_POST['n'];
			while($n>0){
				$item=$_POST["item$n"];
				$qty=$_POST["qty$n"];
				$pri=$_POST["pri$n"];
				$cost=$_POST["cost$n"];
				if($qty)
		$so=mysqli_query($conn, "INSERT INTO `stouse` (`Date`, `User`, `Item`, `Quantity`, `Price`, `Destin`, `Action`, `Voucher`, `Status`) VALUES ('$Date', '$loge', '$item', '$qty', '$pri', '', 'REQUISE', '0', '0')");
			$n--;
			}
		}

		

	if($custo){
			$conde="AND (`Item` LIKE '%$custo%' OR `Type` LIKE '%$custo%')";
			$lim=100;
		}
		else{
			$conde='';
			$lim=140;
		}

		$rece=mysqli_query($conn, "SELECT `Voucher` FROM `stouse` WHERE `Voucher`!='0' ORDER BY `Voucher` DESC LIMIT 1");
				$re=mysqli_fetch_assoc($rece);
					$vou=$re['Voucher']+1;

// Close the current chart
		if(isset($_POST['save']))
		{
			$dato=$_POST['dato'];
	$so=mysqli_query($conn, "UPDATE `stouse` SET `Date`='$dato', `Voucher`='$vou' WHERE `Status`='0' AND `Voucher`='0' AND `Action`='REQUISE'");
		}
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
                  
			  <li class="list-group-item active">
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
         
           <div class="col-lg-2"> </div>
          
         
           

        <form action="" method="post" class="form-horizontal">                  
                       <div class="col-lg-10 hidden-print"><div class="col-lg-3"> 					
					   
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
                   
					  </div> </form> 
                         </div></div> 
                      
                     
                  
           
             
               
          
			<?php
			if($p==0)
		$dor=mysqli_query($conn, "SELECT `stouse`.*, SUM(`Quantity`*`Price`) AS 'Tot', COUNT(DISTINCT(Item)) AS 'Ite' FROM `stouse` WHERE `Status`='0' AND `Voucher`!='0' AND `Action`='REQUISE' GROUP BY `Voucher` ORDER BY `Number` DESC LIMIT 5");
			else
		$dor=mysqli_query($conn, "SELECT `stouse`.*, SUM(`Quantity`*`Price`) AS 'Tot', COUNT(DISTINCT(Item)) AS 'Ite' FROM `stouse` WHERE `Status`='0' AND `Voucher`!='0' AND `Action`='REQUISE' AND `Date` BETWEEN '$dato' AND '$datos' GROUP BY `Voucher` ORDER BY `Number` ASC");
				if($for=mysqli_num_rows($dor)){
?>
 <div class="row">
            <div class="col-lg-12" style='margin-top:-20px;'>
             <span> &nbsp;&nbsp; Total Records Found : <b><?php echo" $for " ?></b></span> <span class="pull-right hidden-print"><?php echo $bra ?>&nbsp;&nbsp;<a href="#" onclick="return window.print()" class="hidden-print" title='Click to print' data-toggle='tooltip' data-placement='top'><i class="lnr lnr-printer"></i></a></span>
            <div class="widget-container fluid-height clearfix">
            <div class="widget-content padded clearfix">

<table class="table table-striped">     
                                      <thead>
                    <tr role="row">
                     <th class="hidden-xs" colspan="2"> No </th>
                       <th class='text-center'> Due&nbsp;Date </th>
                        <th> System&nbsp;User </th>
                       <th> Item </th>
						<th class='text-center'> Price </th>
						<th class='text-center'> Quantity </th>
						<th class='text-center'> Total </th>
                     </tr>
                    </thead>
                                        <tbody>
										<?php
				$tos=0;
					while($ror=mysqli_fetch_assoc($dor)){
						$code=$ror['Voucher'];
						$date=$ror['Date'];
						$user=$ror['User'];
						$tot=$ror['Tot'];
						$ite=$ror['Ite'];
						$n=1;

						$stl="style='padding:1px;'";

	$doi=mysqli_query($conn, "SELECT `stouse`.`Price`, `stouse`.`Quantity`, `items`.`Item` FROM `stouse` INNER JOIN `items` ON `items`.`Number`=`stouse`.`Item` WHERE `stouse`.`Status`='0' AND `stouse`.`Action`='REQUISE' AND `stouse`.`Voucher`='$code' ORDER BY `stouse`.`Number` ASC");
			while($roi=mysqli_fetch_assoc($doi)){
				$item=$roi['Item'];
				$prix=$roi['Price'];
				$qty=$roi['Quantity'];
				$val=$prix*$qty;

		print("<tr><td $stl class='hidden-xs' colspan='2'><div align='center'>$n&nbsp;&nbsp;</td>
						<td class='text-center' $stl> $date </td><td $stl> $user </td><td $stl> $item </td>
						<td $stl><div align='right'> $prix&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
						<td $stl><div align='right'> $qty&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
						<td $stl><div align='right'> $val&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>");
						$n++;
			}
						
						$toto=number_format($tot, 2);			
		  
		print("<tr><form action='sition.php' method='post'><td class='hidden-xs hidden-print' align='right' style='width:20px; padding:0px;'>
                              <input type='hidden' name='rowid' value='$code'><input type='hidden' name='date' value='$date'>
							  <input type='hidden' name='p' value='$p'><input type='hidden' name='pago' value='requirepo.php'>
							  <button type='submit' class='btn btn-xs btn-info hidden-print' name='opens' style='height:20px; padding:0px; margin:2px;' title='Open' data-toggle='tooltip' data-placement='top'>
						  &nbsp;&nbsp;<i class='lnr lnr-download'></i>&nbsp;&nbsp;</button></td></form>
						  
						  
						  <form method=post action=''>
		<td class='hidden-xs hidden-print' align='right' style='width:20px; padding:0px;'>
                              <input type='hidden' name='rowid' value='$code'><button type='submit' class='btn btn-xs btn-danger hidden-print' style='height:20px; padding:0px; margin:2px;' data-toggle='modal' data-target='#exampleModal$n'>
						  &nbsp;&nbsp;<i class='lnr lnr-trash'></i>&nbsp;&nbsp;</button></td></form>
						<td class='text-center text-primary' $stl><b> $code </td><td $stl>  </td>
						<td class='text-center text-primary' $stl><b> $ite </td>
						<td $stl><div align='right'> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
						<td $stl><div align='right'> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
						<td class='text-primary' $stl><div align='right'><b> $toto&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>");
						
						echo"<div class='modal fade' id='exampleModal$n' tabindex='-1' role='dialog' aria-labelledby='exampleModalLabel' aria-hidden='true' 
		style='top:220px;'>
  <div class='modal-dialog' role='document'>
    <div class='modal-content'>
      <div class='modal-header'>
        <h5 class='modal-title' id='exampleModalLabel'>DELETE CONFIRMATION 
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; $toto </h5>

      </div>
      <div class='modal-body' style='height:40px;'>
        <h5 style='color:#ff0033'>Are you sure you want to delete this requisition?</h5>
      </div><form method='post' action=''><input type='hidden' name='rowid' value='$code'>
      <div class='modal-footer' style='margin-top:-10px; height:50px; padding-top:5px; border:0px solid blue;'>
        <button type='button' class='btn btn-sm btn-success' data-dismiss='modal'>&nbsp;NO&nbsp;</button>
        <button type='$dbutn' name='delos' class='btn btn-sm btn-danger'>YES</button>
      </div></form>
    </div>
  </div>
</div>";
						
						print("</tr>");
						  			$tos+=$tot;
						}
						$toto=number_format($tos, 2);
						$tos="0.00";
						?>
						
                    </tbody>

					 <thead>
					<tr><th class="hidden-xs" colspan="2"> </th><th colspan='2'><div align='center'> Grand Total </th>
					<th colspan='2'><div align='right'>&nbsp;&nbsp;&nbsp;</th>
					<th><div align='right'>&nbsp;&nbsp;&nbsp;</th>
					<th><div align='right'><?php echo $toto ?>&nbsp;&nbsp;&nbsp;</th></tr>
                  </table><br>

				  <?php




				}
				else
						echo"<div class='row'>
            <div class='col-lg-12' style='margin-top:-20px;'>
             <span> &nbsp;&nbsp; Requisition Voucher No : <b> $vou </b></span> <span class='pull-right hidden-print'> $bra &nbsp;&nbsp;<a href='#' onclick='return window.print()' class='hidden-print' title='Click to print' data-toggle='tooltip' data-placement='top'><i class='lnr lnr-printer'></i></a></span>
            <div class='widget-container fluid-height clearfix'>
            <div class='widget-content padded clearfix'>
			<br><br><br><br><br><br>
	<div style='text-align:center; font-size:24px; color:#ff9999'>Report not available on selected date</div><br><br><br><br><br><br><br>";
					
			
					?>
                                      
                
              </div>
            </div></div>
                  </div>

				 
      </form>
   </div></div></div>  
   <?php
   include'footer.php';
   ?>
