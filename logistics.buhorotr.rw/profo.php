<?php
if(basename($_SERVER['PHP_SELF']) == 'profo.php') 
$nv=" class='current'";
include'header.php';
include'connection.php';
$dato=$datos=$Date;
$custo=$conde='';
$supplier='';
$p=0;

// delete item from a given chart
if(isset($_POST['delo']))
		{
			$rowid=$_POST['rowid'];
			$swa=$_POST['swa'];
			$then=mysqli_query($conn, "DELETE FROM `stouse` WHERE `Number`='$rowid' LIMIT 1");
		}

// delete the whole requisition
if(isset($_POST['delos']))
		{
			$rowid=$_POST['rowid'];
			$then=mysqli_query($conn, "DELETE FROM `stouse` WHERE `Voucher`='$rowid' AND `Action`='PROFORMA' LIMIT 100");
		}

// edit the whole requisition
if(isset($_POST['edits']))
		{
			$rowid=$_POST['rowid'];
	$then=mysqli_query($conn, "UPDATE `stouse` SET `User`='$loge', `Voucher`='0', `Swap`='$rowid' WHERE `Voucher`='$rowid' AND `Action`='PROFORMA' LIMIT 100");
		}

// edit an item from a given chart
if(isset($_POST['edit']))
		{
			$rowid=$_POST['rowid'];
			$qty=$_POST['qty'];
				$qty=str_replace(',', '', $qty);
			$pri=$_POST['pri'];
				$pri=str_replace(',', '', $pri);
			$curre=$_POST['curre'];
		
	$doi=mysqli_query($conn, "SELECT `Code` FROM `currency` WHERE `Rate`='$curre' ORDER BY `Code` ASC LIMIT 1");
			$roi=mysqli_fetch_assoc($doi);
				$fna=$roi['Code'];
				
			$item=str_replace("'", "`", $_POST['dst']);
	$then=mysqli_query($conn, "UPDATE `stouse` SET `Destin`='$item', `Quantity`='$qty', `Price`='$pri', `Rate`='$curre', `Currency`='$fna' WHERE `Number`='$rowid' LIMIT 1");
		}

// Search for an items to be displayed
if(isset($_POST['search']))
		{
			$dato=$_POST['dato'];
			$datos=$_POST['datos'];
			$supplier=$_POST['supplier'];
			$p=1;
		}

// Add found item to the chart
		if(isset($_POST['addo']))
		{
			$plate=$_POST['plate'];
			$qty=str_replace(',', '', $_POST['qty']);
			$pri=str_replace(',', '', $_POST['pri']);
			$item=str_replace("'", "`", $_POST['item']);
			$curre=$_POST['curre'];
		
	$doi=mysqli_query($conn, "SELECT `Code` FROM `currency` WHERE `Rate`='$curre' ORDER BY `Code` ASC LIMIT 1");
			$roi=mysqli_fetch_assoc($doi);
				$fna=$roi['Code'];
			
				
				if($qty)
	$so=mysqli_query($conn, "INSERT INTO `stouse` (`Date`, `User`, `Item`, `Quantity`, `Price`, `Destin`, `Action`, `Voucher`, `Status`, `Rate`, `Currency`) VALUES ('$Date', '$loge', '$plate', '$qty', '$pri', '$item', 'PROFORMA', '0', '0', '$curre', '$fna')");
		}

	

		$rece=mysqli_query($conn, "SELECT `Voucher` FROM `stouse` WHERE `Voucher`!='0' AND `Action`='PROFORMA' ORDER BY `Voucher` DESC LIMIT 1");
		if($fe=mysqli_num_rows($rece)){
				$re=mysqli_fetch_assoc($rece);
					$vou=$re['Voucher']+1;
		}
		else
		    $vou=1;

// Close the current chart
		if(isset($_POST['save']))
		{
			$dato=$_POST['dato'];
			$supplier=$_POST['supplier'];
			$refo=str_replace("'", "`", $_POST['refo']);
			$swa=$_POST['swa'];
			if($swa!='0')
			    $vou=$_POST['swa'];
			
	$so=mysqli_query($conn, "UPDATE `stouse` SET `Date`='$dato', `Voucher`='$vou', `Invoice`='$refo', `Customer`='$supplier' WHERE `Status`='0' AND `Voucher`='0' AND `Action`='PROFORMA' AND `User`='$loge'");
		}
		
// Delete the current chart
		if(isset($_POST['delox']))
		{
	$so=mysqli_query($conn, "DELETE FROM `stouse` WHERE `Status`='0' AND `Voucher`='0' AND `Action`='PROFORMA' AND `User`='$loge'");
		}
		
    // Search for an items to be displayed
if(isset($_POST['pdelex']))
		{
			$dato=$_POST['dato'];
			$datos=$_POST['datos'];
			$supplier=$_POST['supplier'];
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
			
			if($pall=='all'){
	$whole=mysqli_query($conn, "INSERT INTO `wholepay` (`Date`, `User`, `Supplier`, `Froda`, `Toda`, `Balance`, `Amount`, `Pline`, `Refer`) VALUES ('$dati', '$loge', '$supplier', '$dato', '$datos', '$balo', '$amo', '$pline', '$refo')");
	$last_id = mysqli_insert_id($conn);
	
	$dor=mysqli_query($conn, "SELECT `stouse`.`Voucher`, SUM(Quantity*Price) AS 'Tot' FROM `stouse` WHERE `Status`='0' AND `Voucher`!='0' AND `Action`='PROFORMA' AND `Date` BETWEEN '$dato' AND '$datos' AND `Destin`='$supplier' GROUP BY `Voucher` ORDER BY `Voucher` ASC LIMIT 2000");
	while($ror=mysqli_fetch_assoc($dor)){
	    $tot=$ror['Tot'];
	    $vou=$ror['Voucher'];
	
		$seepa=mysqli_query($conn, "SELECT SUM(`Amount`) AS 'Pay' FROM `rpay` WHERE `Voucher`='$vou' AND `Action`='PROFORMA'");
		$reepa=mysqli_fetch_assoc($seepa);
		    $pay=$reepa['Pay'];
						$bal=$tot-$pay;  
						if($amo>$bal){
			$dof=mysqli_query($conn, "INSERT INTO `rpay` (`Date`, `User`, `Amount`, `Voucher`, `Action`, `Cheno`, `Rate`, `Pline`, `whole`) VALUES ('$dati', '$loge', '$bal', '$vou', 'PROFORMA', '$refo', '$curr', '$pline', '$last_id')");
						}
						else{
			$dof=mysqli_query($conn, "INSERT INTO `rpay` (`Date`, `User`, `Amount`, `Voucher`, `Action`, `Cheno`, `Rate`, `Pline`, `Whole`) VALUES ('$dati', '$loge', '$amo', '$vou', 'PROFORMA', '$refo', '$curr', '$pline', '$last_id')");
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
		
		
	if($supplier)
			$conde="AND `Customer` = '$supplier'";
		
		$dor=mysqli_query($conn, "SELECT *FROM `stouse` WHERE `Status`='0' AND `Voucher`='0' AND `Action`='PROFORMA' AND `User`='$loge' ORDER BY `Number` DESC");
?>
<div class="container-fluid main-content">
        <div class="page-title hidden-print">
          <h2 style='margin-top:-20px; margin-bottom: 5px; color:#ffcc33'>
         Vehicles
          </h2>
  
    </div>
   <div class="row">
  <div class="col-lg-2 hidden-print">
   
  <ul class="list-group">
                  
			  <li class="list-group-item">
              <a href="ment.php">
                <p>
                <i class="lnr lnr-plus-circle"></i>&nbsp;Repair & Services
                </p>
              </a></li>

    <li class="list-group-item">
	  <a href="mainsto.php">
                <p>
                <i class="lnr lnr-menu-circle"></i>&nbsp;List of Vehicles
                </p>
              </a></li> 

	   <li class="list-group-item">
              <a href="crete.php">
                <p>
                <i class="lnr lnr-plus-circle"></i>&nbsp;Create a Vehicle
                </p>
              </a></li>  

	   <li class="list-group-item">
              <a href="tools.php">
                <p>
                <i class="lnr lnr-book"></i>&nbsp;Tools & Materials
                </p>
              </a></li>     

	   <li class="list-group-item">
              <a href="notes.php">
                <p>
                <i class="lnr lnr-plus-circle"></i>&nbsp;Notifications
                </p>
              </a></li> 
                       
            </ul><br><br>

			<li class="list-group-item" style="border:1px dashed #cccccc; border-radius:5px; margin:0px 0px 4px 0px;">
	  <a href="createa.php">
                <p>
                <i class="lnr lnr-plus-circle"></i>&nbsp;Create Customers
                </p>
              </a></li>	
              
            <li class="list-group-item" style="border:1px dashed #cccccc; border-radius:5px; margin:0px 0px 4px 0px;">
	  <a href="dispatch.php">
                <p>
                <i class="lnr lnr-plus-circle"></i>&nbsp;Create Vehicle Trip
                </p>
              </a></li>	
                  
			  <li class="list-group-item" style="border:1px dashed #cccccc; border-radius:5px; margin:0px 0px 4px 0px;">
              <a href="purcha.php">
                <p>
                <i class="lnr lnr-plus-circle"></i>&nbsp;Purchase Orders
                </p>
              </a></li>	
              
            <li class="list-group-item active" style="border:1px dashed #cccccc; border-radius:5px; margin:0px 0px 4px 0px;">
	  <a href="profo.php">
                <p>
                <i class="lnr lnr-plus-circle"></i>&nbsp;Create Proforma
                </p>
              </a></li>	
              
            <li class="list-group-item" style="border:1px dashed #cccccc; border-radius:5px; margin:0px 0px 4px 0px;">
	  <a href="payslip.php">
                <p>
                <i class="lnr lnr-plus-circle"></i>&nbsp;Payment Vouchers
                </p>
              </a></li>	
              
            <li class="list-group-item" style="border:1px dashed #cccccc; border-radius:5px; margin:0px 0px 4px 0px;">
	  <a href="conterepo.php">
                <p>
                <i class="lnr lnr-plus-circle"></i>&nbsp;Container Dispatch
                </p>
              </a></li>		
  </div>
                    
        <?php
	  $_SESSION['Dato']='';
        if($for=mysqli_num_rows($dor))
            $af="ADD ANOTHER SERVICE";
        else
            $af="CREATE NEW PROFORMA";
	    echo"<div class='modal fade' id='Modaldis' tabindex='-1' role='dialog' aria-labelledby='exampleModalLabel' aria-hidden='true'>
  <div class='modal-dialog' role='document'><div class='modal-content'><div class='modal-header text-left'>
        <h5 class='modal-title' id='exampleModalLabel'>$af
        <span class='pull-right'>  </span></h5>

      </div><form action='' method='post'>
      <div class='modal-body text-left'><div class='row'>

        <div class='form-group'>
			<div class='col-md-4' align='right'> 
    <label class='control-label' style='padding-top:10px;'>Item Description</label>
        </div>
            <div class='col-md-7'>
<input type='text' class='form-control' name='item' style='font-size:16px; height:34px;' required>
            </div></div>
		<div class='row'> </div>
		
			<div class='form-group'>	 
			  <div class='col-md-5' align='right'>
			  <label class='control-label'> &nbsp; </label></div>	

	 <div class='col-md-6'> &nbsp; </div>
		</div>
		<div class='row'> </div>
			 	
		 <div class='form-group'>	 
			  <div class='col-md-4' align='right'>
			  <label class='control-label' style='padding-top:10px;'>Quantity / Vehicle </label></div>	

	 <div class='col-md-4'>
          <input name='qty' class='form-control text-center' type='text' onkeyup='format(this);' onkeypress='return isNumberKey(event)'>
            </div>	
            
            <div class='col-md-3' style='padding-left:0px; margin-left:0px;'> 
<select class='form-control' name='plate' style='font-size:16px; height:34px;' required><option value=''> </option>";

$do=mysqli_query($conn, "SELECT `Number`, `Plate` FROM `vehicles` WHERE `Status`='0' ORDER BY `Plate` ASC");
		while($ro=mysqli_fetch_assoc($do)){
			$numb=$ro['Number'];
			$plate=$ro['Plate'];
			echo"<option value='$numb'> $plate </option>";
		}
		
		echo"<option value='0'> N/A </option></select>
            </div>
		</div>
		
		
		
		<div class='row'> </div>
		
			<div class='form-group'>	 
			  <div class='col-md-5' align='right'>
			  <label class='control-label'> &nbsp; </label></div>	

	 <div class='col-md-6'> &nbsp; </div>
		</div>
		<div class='row'> </div>
			 	
		 <div class='form-group'>	 
			  <div class='col-md-4' align='right'>
			  <label class='control-label' style='padding-top:10px;'>Price/Currency </label></div>	

	 <div class='col-md-4'>
          <input name='pri' class='form-control text-center' type='text' onkeyup='format(this);' onkeypress='return isNumberKey(event)' required>
            </div><div class='col-sm-3' style='padding-left:0px; margin-left:0px;'>
	    
	    <select class='form-control' name='curre' title='Currency' data-toggle='tooltip' data-placement='top' style='margin-left:0px;' required><option value='' selected='selected'>Currency</option>";
		
			$doi=mysqli_query($conn, "SELECT `Code`, `Rate` FROM `currency` WHERE `Code`!='' ORDER BY `Code` ASC");
			while($roi=mysqli_fetch_assoc($doi)){
				$fna=$roi['Code'];
				$rate=$roi['Rate'];
				$rte=number_format($rate, 2);
			echo"<option value='$rate'> $fna @ $rte </option>";
			}
		
		   echo"</select></div>
		</div>

		
	</div></div>
	
	<div class='modal-header text-right' style='height:50px; padding-top:15px;'>	
		<button type='button' class='btn btn-xs btn-danger' data-dismiss='modal' style='width:80px;'> CANCEL </button>
        <button type='submit' name='addo' class='btn btn-xs btn-success' style='width:80px;'> ADD </button></div>
      </form>
  </div></div>
</div>";
?>
       
        <div class="col-lg-10">
                  <div class="row">

        <form action="" method="post" class="form-horizontal"> 
	<div class="col-lg-6" style="margin-right:0px; padding-right:0px;">	   
		 <div class="col-lg-5" style="padding-left:40px;">
       <button class="btn  btn-warning btn-block" type="button" data-toggle='modal' data-target='#Modaldis' stle="font-size:13px;"><?php echo $af ?></button></div><div class="col-lg-2"> &nbsp; </div>
						
						
						<div class="col-lg-5">
			  <select class="form-control" name="supplier">			
			 <?php
		echo"<option value='' selected='selected'> SELECT CUSTOMER </option>";
			$top=mysqli_query($conn, "SELECT `Number`, `Customer` FROM `account` WHERE `Status`='0' ORDER BY `Customer` ASC");
			while($rop=mysqli_fetch_assoc($top)){
				$sup=$rop['Customer'];
				$css=$rop['Number'];
				if($supplier==$css)
					$s='selected';
				else
					$s='';
			echo"<option value='$css' $s> $sup </option>";
						}
				?>
				
			</select></div></div>
			
<div class="col-lg-6 hidden-print" style="maring-left:0px; padding-left:0px;">
						
						
           <div class="col-lg-4"> 
           <div class="input-group date" data-provide="datepicker">
      <input class="form-control form-center" id="from" name="dato" type="text" value="<?php echo $dato ?>" onkeypress='return isNumberKey(event)' required>
	  <span class="input-group-addon"><i class="lnr lnr-calendar-full"></i></span></div></div>


		  <div class="col-lg-4"> 
           <div class="input-group date" data-provide="datepicker">	
      <input class="form-control form-center" id="to" name="datos" type="text" value="<?php echo $datos ?>" onkeypress='return isNumberKey(event)' required>
	  <span class="input-group-addon"><i class="lnr lnr-calendar-full"></i></span></div></div>                    
                       
                <div class="col-lg-3 hidden-print">
        <button class="btn  btn-primary btn-block" type="submit" name="search"><i class="lnr lnr-magnifier"></i> Search</button>
                   
					  </div> </form> 
                         </div>
               
            </div>
              
              <?php
				if($for=mysqli_num_rows($dor) AND $p==0){
?>
 <div class="row">
            <div class="col-lg-12" style='margin-top:-20px;'>
             <span> &nbsp;&nbsp; Proforma Order No : <b><?php echo" $vou " ?></b></span> 
             
            <div class="widget-container fluid-height clearfix">
            <div class="widget-content padded clearfix">

<table class="table table-striped table-hover">     
                                      <thead>
                    <tr role="row">
                     <th class="hidden-xs"> No </th>
                       <th> Vehicle </th>
                        <th> Description </th>
						 <th> Price&nbsp;Per&nbsp;Unit </th>
                        <th><div align='center'> Quantity&nbsp;(L) </th>
                        <th><div align='center'> Currency </th>
						<th class='text-center'>Total&nbsp;Amount</th>
                        <th class="hidden-xs hidden-print" style="width:40px; text-align:center;" colspan='2'> Options </th>
                     </tr>
                    </thead>
                                        <tbody>
										<?php
	$n=1;			$tot=$sw=0;
					while($ror=mysqli_fetch_assoc($dor)){
						$code=$ror['Number'];
						$item=$ror['Item'];
						$qt=$ror['Quantity'];
						$dst=$ror['Destin'];
						$dte=$ror['Date'];
						$refo=$ror['Invoice'];
			            $pri=$ror['Price'];
			            $rat=$ror['Rate'];
			            $swap=$ror['Swap'];
			            $cust=$ror['Customer'];
			
			if($swap!='0'){
	$doin=mysqli_query($conn, "UPDATE `stouse` SET `Swap`='$swap' WHERE `Status`='0' AND `Voucher`='0' AND `Action`='PROFORMA' AND `User`='$loge' ORDER BY `Number` DESC");
	        $swa=$swap;
	        $sw++;
			}
						
	$do=mysqli_query($conn, "SELECT `Plate` FROM `vehicles` WHERE `Number`='$item' ORDER BY `Number` DESC");
		$ro=mysqli_fetch_assoc($do);
			$iname=$ro['Plate'];
			
		$qty=number_format($qt, 2);				$prio=number_format($pri, 2);

	$arr="";            $to=$pri*$qt;				$too=number_format($to, 2);	
		 
			  $stl="style='padding:1px;'";
		  
		print("<tr><form action='' method='post'>
                        <td $stl class=hidden-xs><div align='center'>$n&nbsp;&nbsp;</td>
						<td $stl> $iname </td><td $stl><input name='dst' class='form-control' type='text' onkeyup='format(this);'  onChange=this.style.color='#ff3366' style='text-align:left; width:390px; height:24px; margin:0px 0px 0px 0px;' value='$dst'></td>
						<td $stl><div align='center'><input name='pri' class='form-control' type='text' onkeyup='format(this);' onkeypress='return isNumberKey(event)' onChange=this.style.color='#ff3366' style='text-align:right; width:100px; height:24px; margin:0px 0px 0px 0px;' value='$prio'></td>
						<td $stl><div align='right'><input name='qty' class='form-control' type='text' onkeyup='format(this);' onkeypress='return isNumberKey(event)' onChange=this.style.color='#ff3366' style='text-align:right; width:100px; height:24px; margin:0px 0px 0px 0px;' value='$qty'></td><td $stl> <select class='form-control' name='curre' title='Currency' data-toggle='tooltip' data-placement='top' style='margin-left:0px; padding:2px; height:24px; width:120px; font-size:12px;' required>");
			 
			$doi=mysqli_query($conn, "SELECT `Code`, `Rate` FROM `currency` WHERE `Code`!='' ORDER BY `Code` ASC");
			while($roi=mysqli_fetch_assoc($doi)){
				$fna=$roi['Code'];
				$rate=$roi['Rate'];
				$rte=number_format($rate, 2);
				if($rate==$rat)
			echo"<option value='$rate' selected> $fna @ $rte </option>";
			    else
			echo"<option value='$rate'> $fna @ $rte </option>";
			}
	
		   print("</select></td>
						
						
						<td $stl><div align='right'>$too</td>
						
						
						<td class='hidden-xs hidden-print' align='right' style='width:30px; padding:0px;'>
                              <input type='hidden' name='rowid' value='$code'>
                          <button type='submit' class='btn btn-xs btn-warning hidden-print' name='edit' style='height:24px; padding:0px; margin:2px;' title='Edit' data-toggle='tooltip' data-placement='top'>
						  &nbsp;&nbsp;<i class='lnr lnr-pencil'></i>&nbsp;&nbsp;</button></td></form>
						  
						  <form method=post action=''><td class='hidden-xs hidden-print' align='right' style='width:30px; padding:0px;'>
                              <input type='hidden' name='rowid' value='$code'>
                              <input type='hidden' name='swa' value='$swa'>
                          <button type='submit' class='btn btn-xs btn-danger hidden-print' name='delo' style='height:24px; padding:0px; margin:2px;' title='Delete' data-toggle='tooltip' data-placement='top'>
						  &nbsp;&nbsp;<i class='lnr lnr-trash'></i>&nbsp;&nbsp;</button></td></form></tr>");
						  $n++;				$tot+=$to;
						}
						$toto=number_format($tot, 2);			
						?>
						
                    </tbody>

					 <thead>
					<tr><th class="hidden-xs"> </th><th colspan='2'>
					    <div align='center'> Grand Total </th>
					<th colspan='4'><div align='right'><?php echo $toto ?></th><th colspan='2'><div align='center'> -- </th></tr>
                  </table><br>
		
			<label class="control-label col-md-1"></label>

		<form method='post' action=''><label class="control-label col-md-3">
			  <select class="form-control" name="supplier" required>			
			 <?php
		    if(!$dte OR $dte=="0000-00-00")
					$dte=$Date;
		echo"<option value='' selected='selected'> SELECT CUSTOMER </option>";
			$top=mysqli_query($conn, "SELECT `Number`, `Customer` FROM `account` WHERE `Status`='0' ORDER BY `Customer` ASC");
			while($rop=mysqli_fetch_assoc($top)){
				$sup=$rop['Customer'];
				$cus=$rop['Number'];
				if($cust==$cus)
					$s='selected';
				else
					$s='';
			echo"<option value='$cus' $s> $sup </option>";
						}
				?>
				
			</select></label>
			
			<?php
	$do=mysqli_query($conn, "SELECT `Invoice` FROM `stouse` WHERE `Action`='PROFORMA' AND `Invoice`!='' ORDER BY `Number` DESC LIMIT 1");
	if($fo=mysqli_num_rows($do)){
		$ro=mysqli_fetch_assoc($do);
			$refo=$ro['Invoice'];
	    }
	    else
	        $refo="";
	    ?>

	<label class="control-label col-md-3"><input name="refo" class="form-control sm" type="text" VALUE="<?php echo $refo ?>" onclick="return pageScroll()"></label>

	<label class="control-label col-md-2">
	<div class='input-group date' data-provide='datepicker'>    
	    <input name="dato" id="from" class="form-control sm" type="text" style="text-align:center;" VALUE="<?php echo $dte ?>" onclick="return pageScroll()"><div class='input-group-addon'><span class='lnr lnr-calendar-full'></span></div></div></label>
<?php
	
	if($sw==0)
	    $swa=0;
			$btl='submit';
$tle="title='Save' data-toggle='tooltip' data-placement='top'";
echo"<input type='hidden' name='swa' value='$swa'>";
	?>
			 <label class="control-label col-md-2">
			 <button class="btn btn-md btn-block btn-info" type="<?php echo $btl ?>" name="save" <?php echo $tle ?>>
			 <i class="lnr lnr-plus-circle"></i> SAVE </button>
			 </label></form>
			 
	<label class="control-label col-md-1" title="Remove All" data-toggle="tooltip" data-placement="top">
			     <?php
			     if($n>3){
echo"<div class='modal fade' id='exampleModals' tabindex='-1' role='dialog' aria-labelledby='exampleModalLabel' aria-hidden='true' style='top:220px;'>
  <div class='modal-dialog' role='document'>
    <div class='modal-content'>
      <div class='modal-header'>
        <h5 class='modal-title' id='exampleModalLabel'>DELETE CONFIRMATION</h5>

      </div>
      <div class='modal-body' style='height:80px;'>
        <h5 style='color:#ff0033'>Are you sure you want to delete this requisition?</h5>
      </div><form method='post' action=''>
      <div class='modal-footer' style='margin-top:-10px; height:50px; padding-top:5px; border:0px solid blue;'>
        <button type='button' class='btn btn-sm btn-success' data-dismiss='modal' style='width:60px'>NO</button>
        <button type='submit' name='delox' class='btn btn-sm btn-danger' style='width:60px'>YES</button>
      </div></form>
    </div>
  </div>
</div>";
	echo"<button type='button' class='btn btn-md btn-danger hidden-print' name='delox' data-placement='top' data-toggle='modal' data-target='#exampleModals'>&nbsp;&nbsp;<i class='lnr lnr-trash'></i>&nbsp;&nbsp;</button>";
			     }
	?>
			 </label>

		<?php
				}
					else{
					    if($supplier)
					        $conde="AND `Customer`='$supplier'";
				if($p=='0')
		$dor=mysqli_query($conn, "SELECT `stouse`.*, SUM(Quantity) AS 'Qty', COUNT(DISTINCT(Item)) AS 'Ite', SUM(`Price`) AS 'Tot' FROM `stouse` WHERE `Status`='0' AND `Voucher`!='0' AND `Action`='PROFORMA' GROUP BY `Voucher` ORDER BY `Number` DESC LIMIT 20");
		        else
		$dor=mysqli_query($conn, "SELECT `stouse`.*, SUM(Quantity) AS 'Qty', COUNT(DISTINCT(Item)) AS 'Ite', SUM(`Price`) AS 'Tot' FROM `stouse` WHERE `Status`='0' AND `Voucher`!='0' AND `Action`='PROFORMA' AND `Date` BETWEEN '$dato' AND '$datos' $conde GROUP BY `Voucher` ORDER BY `Number` DESC LIMIT 8000");
				if($for=mysqli_num_rows($dor)){
?>
 <div class="row">
            <div class="col-lg-12" style='margin-top:-20px;'>
             <span> &nbsp;&nbsp; Total Records Found : <b><?php echo" $for " ?></b></span> <span class="pull-right hidden-print"><?php echo $bra ?>&nbsp;&nbsp;<a href="#" onclick="return window.print()" class="hidden-print" title='Click to print' data-toggle='tooltip' data-placement='top'><i class="lnr lnr-printer"></i></a></span>
            <div class="widget-container fluid-height clearfix">
            <div class="widget-content padded clearfix">

<table class="table table-striped table-hover">     
                                      <thead>
                    <tr role="row">
                     <th class="hidden-xs"> No </th>
                       <th class='text-center'> Due&nbsp;Date </th>
                        <th> System&nbsp;User </th>
                       <th> Customer </th>
                       <th> Description </th>
						<th class='text-center'> Quantity </th>
						<th class='text-center'> Amount </th>
						<th class='text-center'> Paid </th>
						<th class='text-center'> Balance </th>
                        <th class="hidden-xs hidden-print" style="width:40px; text-align:center;" colspan='4'> Options </th>
                     </tr>
                    </thead>
                                        <tbody>
										<?php
	$n=1;			$tqy=$tam=$tpa=$tba=0;
					while($ror=mysqli_fetch_assoc($dor)){
						$code=$ror['Voucher'];
						$date=$ror['Date'];
						$user=$ror['User'];
						$dst=$ror['Destin'];
						$ite=$ror['Ite'];
						$ref=$ror['Customer'];
						$qty=$ror['Qty'];
						$tot=$ror['Tot'];
						$count="PROFORMA";
						$pall='';
						$pay=0;
						
		$seepa=mysqli_query($conn, "SELECT *FROM `account` WHERE `Number`='$ref'");
		$reepa=mysqli_fetch_assoc($seepa);
		    $cus=$reepa['Customer'];
		    $ctin=$reepa['Tin'];
		    $cadd=$reepa['Address'];
		    $ctel=$reepa['Telephone'];
						
		$seepai=mysqli_query($conn, "SELECT SUM(`Amount`/`Rate`) AS 'Pay' FROM `rpay` WHERE `Voucher`='$code' AND `Action`='$count'");
		$reepai=mysqli_fetch_assoc($seepai);
		    $pay=$reepai['Pay'];
						$bal=$tot-$pay;
						$i=$n;
						
		$qto=number_format($qty, 2);			
		$stl="style='padding:1px; font-size:12px;'";
						
		$toto=number_format($tot);              $payo=number_format($pay);
		$balo=number_format($bal);
		
		            if($pay)
						$lin="<a href='#' data-toggle='modal' data-target='#exampleModalx$i'>";
					else
						$lin="";
		  
		print("<tr>
		<td $stl class=hidden-xs><div align='center'>$code&nbsp;&nbsp;</td>
			<td class='text-center' $stl> $date </td><td $stl> $user </td>
    	<td $stl> $cus </td><td $stl> $dst </td><td $stl><div align='right'> $qto </td><td $stl><div align='right'> $toto </td><td $stl><div align='right'>");
	
	                    $dst="PROFORMA AMOUNT";
	
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

		echo"<tr style='background-color:transparent;'>
		<form action='' method='post'>
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
<h5 style='color:#ff0033'>Are you sure you want to delete this proforma?</h5>
      </div><form method='post' action=''><input type='hidden' name='rowid' value='$code'>
      <div class='modal-footer' style='margin-top:-10px; height:50px; padding-top:5px; border:0px solid blue;'>
        <button type='button' class='btn btn-sm btn-success' data-dismiss='modal'>&nbsp;NO&nbsp;</button>
        <button type='$dbutn' name='delos' class='btn btn-sm btn-danger'>YES</button>
      </div></form>
    </div>
  </div>
</div>";
						
		print("<form method=post action=''><td class='hidden-xs hidden-print' align='right' style='width:10px; padding:0px;'>
        <input type='hidden' name='rowid' value='$code'><button type='submit' class='btn btn-xs btn-danger hidden-print' style='height:20px; padding:0px; margin:2px;' data-toggle='modal' data-target='#exampleModal$n'>  &nbsp;&nbsp;<i class='lnr lnr-trash'></i>&nbsp;&nbsp;</button></td></form>
						  
		<td class='hidden-xs hidden-print' style='width:10px; padding:0px;'><div title='Pay' data-toggle='tooltip' data-placement='top'>
	<div align='center'>");
	
	if(!$_SESSION['Psi'])	
	echo"<button type='button' class='btn btn-xs btn-success hidden-print' style='height:20px; padding:0px; margin:2px;' data-toggle='modal' data-target='#exampleModalo$i'> &nbsp;&nbsp;<i class='lnr lnr-briefcase'></i>&nbsp;&nbsp; </button>";
	
	print("</td><form action='' method='post'>
		<td class='hidden-xs hidden-print' align='right' style='width:10px; padding:0px;'><input type='hidden' name='rowid' value='$code'><button type='submit' class='btn btn-xs btn-warning hidden-print' name='edits' style='height:20px; padding:0px; margin:1px;' title='Edit' data-toggle='tooltip' data-placement='top'>&nbsp;&nbsp;<i class='lnr lnr-pencil'></i>&nbsp;&nbsp;</button></td></form>
						  
			<form action='forma.php' method='post'><td class='hidden-xs hidden-print' align='right' style='width:10px; padding:0px;'>
                <input type='hidden' name='rowid' value='$code'>
                <input type='hidden' name='date' value='$date'>
                <input type='hidden' name='dst' value='$dst'>
                <input type='hidden' name='ref' value='$ref'>
                <input type='hidden' name='ite' value='$ite'>
                <input type='hidden' name='cus' value='$cus'>
                <input type='hidden' name='cadd' value='$cadd'>
                <input type='hidden' name='ctin' value='$ctin'>
                <input type='hidden' name='ctel' value='$ctel'>
							  <input type='hidden' name='p' value='0'>
							  <input type='hidden' name='user' value='$user'>
					<input type='hidden' name='pago' value='profo.php'>
				<button type='submit' class='btn btn-xs btn-info hidden-print' name='opens' style='height:20px; padding:0px; margin:2px;' title='Open' data-toggle='tooltip' data-placement='top'>
						  &nbsp;&nbsp;<i class='lnr lnr-download'></i>&nbsp;&nbsp;</button></td></form></tr>");
						  $n++;				
						  $tqy+=$qty;            $tam+=$tot;          
						  $tpa+=$pay;            $tba+=$bal;
						}
						$tqy=number_format($tqy, 2);
						$tam=number_format($tam, 2);
						$tpa=number_format($tpa, 2);
						$tba=number_format($tba, 2);
						?>
						
                    </tbody>

					 <thead>
					<tr><th class="hidden-xs"> </th>
					<th colspan='2'><div align='center'> Grand Total </th>
					<th colspan='1'><div align='right'> &nbsp; </th>
					<th><div align='right'> &nbsp; </th>
					<th><div align='right'><?php echo $tqy ?></th>
					<th><div align='right'><?php echo $tam ?></th>
					<th><div align='right'><?php echo $tpa ?></th>
					<th><div align='right'><?php echo $tba ?></th>
					<th colspan='4' class="hidden-print" style="padding:0px;">
					   
					        <?php
					  if($supplier){
					    $i=0;
					    $balo=$tba;
					    $pall='all';
					    include'addpay.php';
		echo"<button type='button' class='btn btn-sm btn-success' style='width:100%; height:20px; padding:1px; margin:0px;' data-toggle='modal' data-target='#exampleModalo$i'><i class='lnr lnr-briefcase'></i> &nbsp;&nbsp; PAY&nbsp;ALL </button>";		      
					      
					      }
					      ?></th></tr>
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
	<div style='text-align:center; font-size:24px; color:#ff9999'>Load items/services to be issued</div><br><br><br><br><br><br><br>";
					}
		
					?>
                                      
                
              </div>
            </div></div>
                  </div>

				 
      </form>
   </div></div></div>  
   <?php
   include'footer.php';
   ?>
