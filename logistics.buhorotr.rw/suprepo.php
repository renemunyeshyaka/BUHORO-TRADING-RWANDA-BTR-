<?php
if(basename($_SERVER['PHP_SELF']) == 'recerepo.php') 
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
			$dato=$_POST['dato'];
			$datos=$_POST['datos'];
			$custo=$_POST['custo'];
			$p=$_POST['p'];
	$rece=mysqli_query($conn, "SELECT `Item`, `Quantity` FROM `stouse` WHERE `Voucher`='$rowid' AND `Action`='RECEIVE' ORDER BY `Number` ASC LIMIT 100");
				while($re=mysqli_fetch_assoc($rece)){
					$item=$re['Item'];
					$qty=$re['Quantity'];
	$doin=mysqli_query($conn, "UPDATE `items` SET `Quantity`=`Quantity`-'$qty' WHERE `Number`='$item' ORDER BY `Number` DESC LIMIT 1");
				}
			$then=mysqli_query($conn, "DELETE FROM `stouse` WHERE `Voucher`='$rowid' AND `Action`='RECEIVE' LIMIT 100");

		}
		
		// Delete a given payment
if(isset($_POST['pdelex']))
		{
			$dato=$_POST['dato'];
			$datos=$_POST['datos'];
			$supplier=$_POST['supplier'];
			$custo=$_POST['custo'];
			$p=$_POST['p'];
			$num=$_POST['num'];
	$so=mysqli_query($conn, "DELETE FROM `rpay` WHERE `Number`='$num' ORDER BY `Number` ASC LIMIT 1");		
		}
		
		
		// Add a payment
if(isset($_POST['addpa']))
		{
			$dato=$_POST['dato'];
			$datos=$_POST['datos'];
			$supplier=$_POST['supplier'];
			$refo=str_replace("'", "`", $_POST['refo']);
			$amo=str_replace(',', '', $_POST['amo']);
			$balo=str_replace(',', '', $_POST['balo']);
			$p=$_POST['p'];
			$dati=$_POST['dati'];
			$curr=$_POST['currency'];
			$pline=$_POST['pline'];
			$count=$_POST['count'];
			$code=$_POST['code'];
			$pall=$_POST['pall'];
			$custo=$_POST['custo'];
			$p=$_POST['p'];
			
			if($pall=='all'){
	$whole=mysqli_query($conn, "INSERT INTO `wholepay` (`Date`, `User`, `Supplier`, `Froda`, `Toda`, `Balance`, `Amount`, `Pline`, `Refer`) VALUES ('$dati', '$loge', '$supplier', '$dato', '$datos', '$balo', '$amo', '$pline', '$refo')");
	$last_id = mysqli_insert_id($conn);
	
	$dor=mysqli_query($conn, "SELECT `stouse`.`Voucher`, SUM(Quantity*Price) AS 'Tot' FROM `stouse` WHERE `Status`='0' AND `Voucher`!='0' AND `Action`='PURCHASE' AND `Date` BETWEEN '$dato' AND '$datos' AND `Destin`='$supplier' GROUP BY `Voucher` ORDER BY `Voucher` ASC LIMIT 2000");
	while($ror=mysqli_fetch_assoc($dor)){
	    $tot=$ror['Tot'];
	    $vou=$ror['Voucher'];
	
		$seepa=mysqli_query($conn, "SELECT SUM(`Amount`) AS 'Pay' FROM `rpay` WHERE `Voucher`='$vou' AND `Action`='PURCHASE'");
		$reepa=mysqli_fetch_assoc($seepa);
		    $pay=$reepa['Pay'];
						$bal=$tot-$pay;  
						if($amo>$bal){
			$dof=mysqli_query($conn, "INSERT INTO `rpay` (`Date`, `User`, `Amount`, `Voucher`, `Action`, `Cheno`, `Rate`, `Pline`, `whole`) VALUES ('$dati', '$loge', '$bal', '$vou', 'PURCHASE', '$refo', '$curr', '$pline', '$last_id')");
						}
						else{
			$dof=mysqli_query($conn, "INSERT INTO `rpay` (`Date`, `User`, `Amount`, `Voucher`, `Action`, `Cheno`, `Rate`, `Pline`, `Whole`) VALUES ('$dati', '$loge', '$amo', '$vou', 'PURCHASE', '$refo', '$curr', '$pline', '$last_id')");
						break;    
						}
						$amo-=$bal;
		}
	$so=mysqli_query($conn, "DELETE FROM `rpay` WHERE `Amount`='0' ORDER BY `Number` ASC LIMIT 100");
			    
			}
			else{
	$dof=mysqli_query($conn, "INSERT INTO `rpay` (`Date`, `User`, `Amount`, `Voucher`, `Action`, `Cheno`, `Rate`, `Pline`) VALUES ('$dati', '$loge', '$amo', '$code', '$count', '$refo', '$curr', '$pline')");
			}
		}

// search for an item to be added to the chart
if(isset($_POST['search']))
		{
			$dato=$_POST['dato'];
			$datos=$_POST['datos'];
			$custo=$_POST['custo'];
			$p=1;
		}

			if($custo)
				$conde="AND `Destin`='$custo'";
		
		if($dato==$datos)
			$mpri="ON $dato";
		else
			$mpri="FROM $dato TO $datos";
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
                  
			  <li class="list-group-item active">
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

				  <div class="col-lg-4"> </div>         

                         
                       <div class="col-lg-8 hidden-print"><div class="col-lg-3">
			<select class="form-control" name="custo" style="margin-left:-55px; width:220px;">
				<option value='' selected='selected'>Select Supplier</option>
			 <?php
			$doi=mysqli_query($conn, "SELECT `Destin` FROM `stouse` WHERE `Status`='0' AND `Action`='RECEIVE' AND `Destin`!='' GROUP BY `Destin` ORDER BY `Destin` ASC");
			while($roi=mysqli_fetch_assoc($doi)){
				$desto=$roi['Destin'];
				if($desto==$custo)
					$sle="selected='selected'";
				else
					$sle='';
			echo"<option value='$desto' $sle> $desto </option>";
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
<?php
	$dor=mysqli_query($conn, "SELECT `stouse`.*, SUM(`Quantity`*`Price`) AS 'Tot', COUNT(DISTINCT(Item)) AS 'Ite' FROM `stouse` WHERE `Status`='0' AND `Voucher`!='0' AND `Action`='RECEIVE' AND `Date` BETWEEN '$dato' AND '$datos' $conde GROUP BY `Voucher` ORDER BY `Number` DESC");
				if($for=mysqli_num_rows($dor)){
?>


<div class="divFooter"><center><u><b>SUPPLIERS REPORT <?php echo"$mpri"; ?></b></u></center></div>
             <div class="row">
            <div class="col-lg-12" style='margin-top:-20px;'>
             <span> &nbsp;&nbsp; Total Records Found : <b><?php echo" $fo " ?></b></span>
			 <span class="pull-right"><a href="#" onclick="return window.print()" class="hidden-print" title='Click to print' data-toggle='tooltip' data-placement='top'><i class="lnr lnr-printer"></i></a></span>
            <div class="widget-container fluid-height clearfix">
            <div class="widget-content padded clearfix">
               
                               <table class="table table-striped table-hover">     
                                      <thead>
                    <tr role="row">
                     <th class="hidden-xs"> No </th>
                       <th class='text-center'> Due&nbsp;Date </th>
                        <th> Supplier </th>
                        <th> System&nbsp;User </th>
                       <th> Items </th><th> Invoice </th>
						<th class='text-right'> Amount </th>
						<th class='text-center'> Paid </th>
						<th class='text-center'> Balance </th>
                        <th class="hidden-xs hidden-print" style="width:40px; text-align:center;" colspan='4'> Options </th>
                     </tr>
                    </thead>
                                        <tbody>
										<?php
	$n=1;			        $tam=$tpa=$tba=0;
					while($ror=mysqli_fetch_assoc($dor)){
						$code=$ror['Voucher'];
						$date=$ror['Date'];
						$user=$ror['User'];
						$tot=$ror['Tot'];
						$ite=$ror['Ite'];
						$des=$ror['Destin'];
						$invo=$ror['Invoice'];
						$count="RECEIVE";
						$pall='';
						$pay=0;
						
		$seepa=mysqli_query($conn, "SELECT SUM(`Amount`) AS 'Pay' FROM `rpay` WHERE `Voucher`='$code' AND `Action`='$count'");
		$reepa=mysqli_fetch_assoc($seepa);
		    $pay=$reepa['Pay'];
						$bal=$tot-$pay;
						$i=$n;
						
							$toto=number_format($tot);         
							$payo=number_format($pay);
		                    $balo=number_format($bal);
		
		            if($pay)
						$lin="<a href='#' data-toggle='modal' data-target='#exampleModalx$i'>";
					else
						$lin="";
						
						$stl="style='padding:1px; font-size:12px;'";
		  
		print("<tr><td $stl class=hidden-xs>
		<div align='center'>$n&nbsp;&nbsp;</td>
						<td class='text-center' $stl> $date </td>
						<td $stl> $des </td><td $stl> $user </td>
						<td class='text-center' $stl> $ite </td>
						<td class='text-left' $stl> $invo </td>
						<td $stl><div align='right'> $toto </td><td $stl><div align='right'>");
	
	
	
	// ************************************* Open payment modal ******************************************
		echo"<div class='modal fade' id='exampleModalx$i' tabindex='-1' role='dialog' aria-labelledby='exampleModalLabel' aria-hidden='true' style='top:220px;'>
  <div class='modal-dialog' role='document'>
    <div class='modal-content'>
      <div class='modal-header'>
        <h5 class='modal-title' id='exampleModalLabel'>PAYMENT REPORT 
&nbsp;&nbsp;&nbsp;&nbsp;<label class='pull-right'><b>$ $payo</b></label></h5>

      </div>
      <div class='modal-body' style='height:auto;'>
	  <table class='table table-striped table-hover '><thead><tr>
	  <th width='14%' class='text-center'> Date </th>
	  <th class='text-center'> User </th>
	  <th width='12%' class='text-center'> Mode </th>
	  <th class='text-center'> Reference </th>
	  <th class='text-center'> Rate </th>
	  <th class='text-center'> Amount </th><th width='1%'> # </th>
	  </tr></thead></tbody>";
				$k=9000000000;				$sts="padding:1px; font-size:12px; background-color:transparent;";
$spai=mysqli_query($conn, "SELECT *FROM `rpay` WHERE `Voucher`='$code' AND `Action`='$count' ORDER BY `Number` ASC");
				while($rpai=mysqli_fetch_assoc($spai)){
					$prs=number_format($rpai['Amount'], 2);
					$mod=$rpai['Pline'];
					$cur=$rpai['Rate'];
					$rat=number_format($rpai['Rate'], 2);
					$refe=$rpai['Cheno'];
					$dti=$rpai['Date'];
					$num=$rpai['Number'];
					$user=$rpai['User'];

		echo"<tr style='background-color:transparent;'><form action='' method='post'>
		<td class='text-center' style='$sts'> $dti </td>
		<td style='$sts'> $user </td><td style='$sts'> $mod </td>
<td style='$sts'> $refe </td><td style='$sts' class='text-center'> $cur </td>
		
		<td style='text-align:right; $sts'>
		<div title='Rate: $rat' data-toggle='tooltip' 
		data-placement='top'> $prs </div></td><td style='$sts'>
	
		<div title='Delete' data-toggle='tooltip' data-placement='top'>
		<input type='hidden' name='dato' value='$dato'>
	  <input type='hidden' name='num' value='$num'>
	  <input type='hidden' name='datos' value='$datos'>
	  <input type='hidden' name='p' value='$p'>
	  <input type='hidden' name='naso' value='$code'>
	  <input type='hidden' name='supplier' value='$supplier'>
		
		<button type='submit' class='btn btn-xs btn-link text-danger hidden-print' style='height:16px; padding:0px; margin:0px; width:auto; margin-top:-5px;' name='pdelex'>&nbsp;&nbsp;<i class='lnr lnr-trash'></i>&nbsp;&nbsp;</button></div></td></form></tr>";
			$k++;
				}        

      echo"</tbody></table></div><div class='modal-header text-right' 
	  style='margin-top:-10px; height:40px; padding-top:10px; border:0px solid blue;'>
  <button type='button' class='btn btn-xs btn-warning' data-dismiss='modal'>&nbsp;&nbsp;&nbsp;CLOSE&nbsp;&nbsp;&nbsp;</button>
      </div>
    </div>
  </div>
</div>";
	// ****************************************** End of modal ****************************************	


print("$lin $payo </a></td><td $stl><div align='right'> $balo </td>");
	
	include'addpay.php';
						
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

	include'addpay.php';
						
						print("<form action='recedoc.php' method='post'><td class='hidden-xs hidden-print' align='right' style='width:10px; padding:0px;'>
                        <input type='hidden' name='rowid' value='$code'>
                    <input type='hidden' name='page' value='suprepo.php'>
                    <button type='submit' class='btn btn-xs btn-info hidden-print' name='opens' style='height:20px; padding:0px; margin:2px;' title='Open' data-toggle='tooltip' data-placement='top'>
						  &nbsp;&nbsp;<i class='lnr lnr-download'></i>&nbsp;&nbsp;</button></td></form>
						  
		<td class='hidden-xs hidden-print' style='width:10px; padding:0px;'><div title='Pay' data-toggle='tooltip' data-placement='top'>
	<div align='center'>");
	
	if(!$_SESSION['Psi'])	
	echo"<button type='button' class='btn btn-xs btn-success hidden-print' style='height:20px; padding:0px; margin:2px;' data-toggle='modal' data-target='#exampleModalo$i'> &nbsp;&nbsp;<i class='lnr lnr-briefcase'></i>&nbsp;&nbsp; </button>";
	
	print("</td>						
						
								<form action='receive.php' method='post'>
						<td class='hidden-xs hidden-print' align='right' style='width:10px; padding:0px;'>
                    <input type='hidden' name='rowid' value='$code'>
                    <button type='submit' class='btn btn-xs btn-warning hidden-print' name='edits' style='height:20px; padding:0px; margin:2px;' title='Edit' data-toggle='tooltip' data-placement='top'>
						  &nbsp;&nbsp;<i class='lnr lnr-pencil'></i>&nbsp;&nbsp;</button></td></form>
						  
						  <form method=post action=''><td class='hidden-xs hidden-print' align='right' style='width:10px; padding:0px;'>
                              <input type='hidden' name='rowid' value='$code'><button type='submit' class='btn btn-xs btn-danger hidden-print' style='height:20px; padding:0px; margin:2px;' data-toggle='modal' data-target='#exampleModal$n'>
						  &nbsp;&nbsp;<i class='lnr lnr-trash'></i>&nbsp;&nbsp;</button></td></form></tr>");
						  $n++;		             $tam+=$tot;          
						  $tpa+=$pay;            $tba+=$bal;
						}
						
						$tam=number_format($tam, 2);
						$tpa=number_format($tpa, 2);
						$tba=number_format($tba, 2);			
						?>
						
                    </tbody>

					 <thead>
					<tr><th class="hidden-xs"> </th><th colspan='4'><div align='center'> Grand Total </th><th> </th>
					<th><div align='right'><?php echo $tam ?></th>
					<th><div align='right'><?php echo $tpa ?></th>
					<th><div align='right'><?php echo $tba ?></th>
					<th class="hidden-xs hidden-print" colspan='4'><div align='center'> -- </th></tr>
                  </table><br>
              </div></div>
              

                  </div>  
                  <?php
				}
				else
						echo"<div class='row'>
            <div class='col-lg-12' style='margin-top:-20px;'>
             <span> &nbsp;&nbsp; Total Records Found : <b> 0 </b></span> <span class='pull-right hidden-print'> $bra &nbsp;&nbsp;<a href='#' onclick='return window.print()' class='hidden-print' title='Click to print' data-toggle='tooltip' data-placement='top'><i class='lnr lnr-printer'></i></a></span>
            <div class='widget-container fluid-height clearfix'>
            <div class='widget-content padded clearfix'>
			<br><br><br><br><br><br>
	<div style='text-align:center; font-size:24px; color:#ff9999'>Report not available on selected date</div><br><br><br><br><br><br><br>";
					
				?>
                
              </div><span class="pull-right hidden-print">
			 &nbsp;&nbsp;&nbsp;&nbsp;<a href="#" onclick="return window.print()" class="hidden-print" title='Click to print' data-toggle='tooltip' data-placement='top'><i class="lnr lnr-printer"></i></a></span>
            </div></div>
                  </div>
        
   <?php
   include'footer.php';
   ?>
