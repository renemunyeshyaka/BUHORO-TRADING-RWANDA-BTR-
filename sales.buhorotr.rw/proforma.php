<?php
if(basename($_SERVER['PHP_SELF']) == 'proforma.php') 
  $bb=" class='current'";

include'connection.php';

$custo=$conde='';
$trig=$t='';
$cart=0;
$conde='';
$lim=15;

$rece=mysql_query("SELECT `Voucher` FROM `stouse` WHERE `Status`='10' ORDER BY `Voucher` DESC LIMIT 1");
				$recet=mysql_fetch_assoc($rece);
					$vous=$recet['Voucher']+1;
					
// Close the current chart
		if(isset($_POST['receive']) AND $_POST['form_token'] == $_SESSION['form_token'])
		{
			$supplier=$pla=$_POST['suppli'];
			$dato=$dte=$_POST['dato'];
			$source=$_POST['source'];
			$cprint=$_POST['cprint'];
			$custo=$_POST['custo'];
			$cprint=$_POST['cprint'];
			$comme=str_replace("'", "`", $_POST['comme']);
			$empo=$loge;
			$deso=$_POST['deso'];
			$plino=$_POST['plino'];
			$_SESSION['BR']=$custo;
			$cart=1;
			
		$doi=mysql_query("SELECT `Number` FROM `account` WHERE `Customer`='$supplier' AND `Status`='0' ORDER BY `Customer` ASC");
			$roi=mysql_fetch_assoc($doi);
				$cli=$roi['Number'];

	$so=mysql_query("UPDATE `stouse` SET `Date`='$dato', `Time`='$Time', `Destin`='$supplier', `Voucher`='$vous', `Invoice`='$source', `Client`='$cli', `Comment`='$comme' WHERE `User`='$loge' AND `Status`='10' AND `Voucher`='0' AND `Action`='PROFORMA' AND `Branche`='1'");

            $requi=4;

			if($Receipt)
				include'creceipt.php';
		}

include'header.php';

if (isset($_GET["br"]))
{
   $custo=$_GET['br'];
   $_SESSION['BR']=$custo;
}


// delete all items from a given chart
if(isset($_POST['delox']))
		{
			$custo=$_POST['custo'];
   $_SESSION['BR']=$custo;
			$then=mysql_query("DELETE FROM `stouse` WHERE `Action`='PROFORMA' AND `Voucher`='0' AND `User`='$loge' LIMIT 100");
		}

// Search for an item to be added to the chart
if(isset($_POST['search']))
		{
			$custo=$_POST['custo'];
			$t=1;
		}
		
		if($custo){
			$conde="AND (`Iname` LIKE '%$custo%' OR `Descri` LIKE '%$custo%')";
			$lim=100;
		}

		// Delete a given item from cart
if(isset($_POST['delo']))
		{
			$custo=$_POST['custo'];
   $_SESSION['BR']=$custo;
   $rowid=$_POST['rowid'];
   $doin=mysql_query("DELETE FROM `stouse` WHERE `Number`='$rowid' ORDER BY `Number` ASC LIMIT 1");
		}


		// Delete a given item from cart
if(isset($_POST['edit']))
		{
			$custo=$_POST['custo'];
   $_SESSION['BR']=$custo;
   $rowid=$_POST['rowid'];
		
		$qty=str_replace(',', '', $_POST['qty']);
		$pri=str_replace(',', '', $_POST['pri']);

   $doin=mysql_query("UPDATE `stouse` SET `Price`='$pri', `Quantity`='$qty' WHERE `Number`='$rowid' ORDER BY `Number` ASC LIMIT 1");
		}

		// Add selected item to PROFORMA cart
if(isset($_POST['addo']))
		{					
			$n=$_POST['n'];
			while($n>0){
				$item=$_POST["item$n"];
				$qty=$_POST["qty$n"];
				$pri=$_POST["pri$n"];
				$cost=$_POST["cost$n"];
				$qts=$_POST["qts$n"];
	
			if($qty)
	$dox=mysql_query("INSERT INTO `stouse` (`Date`, `Time`, `User`, `Item`, `Cost`, `Quantity`, `Price`, `Action`, `Status`, `Closing`, `Branche`) VALUES ('$Date', '$Time', '$loge', '$item', '$cost', '$qty', '$pri', 'PROFORMA', '10', '$qts', '1')");
				$n--;
			}
	}

	if(isset($_POST['paid']))
		{
			$custo=$_POST['custo'];
            $_SESSION['BR']=$custo;
			$amo=str_replace(',', '', $_POST['amo']);
			$mode=$_POST['mode'];
			$namei=str_replace("'", "`", $_POST['namei']);

if($mode=='CASH'){
	$cheno=$bna='';
	$pda=$_POST['capa'];
}
if($mode=='CREDIT'){	
	$cheno=$bna='';
	$pda=$_POST['crpa'];
	$amo=0;
	// $crdi=mysql_query("UPDATE `account` SET `Balance`=`Balance`+'$amo' WHERE `Number`='$cuso' ORDER BY `Number` ASC LIMIT 1");
}
if($mode=='CHEQUE'){	
	$cheno=$_POST['cheno'];
	$bna=$_POST['cba'];
	$pda=$_POST['chpa'];
}
if($mode=='BANK'){	
	$cheno=$_POST['slino'];
	$bna=$_POST['acco'];
	$pda=$_POST['cbpa'];

	//$and=mysql_query("INSERT INTO `deposit` (`Number`, `Date`, `Time`, `User`, `Item`, `Refer`, `Amount`, `Customer`, `Operation`, `Status`, `Valid`, `Account`, `Descri`, `Client`, `Voucher`) VALUES (NULL, '$pda', '$Time', '$loge', 'DEPOSIT', '$cheno', '$amo', '$cuso', 'PROFORMA', '0', '0', '$bna', '', '$cuso', '$rowid')"); 
}
						if($amo)
			$then=mysql_query("INSERT INTO `payment` (`Date`, `Time`, `Cashier`, `Amount`, `Pline`, `Status`, `Action`, `Description`, `Payto`, `Cheno`, `Bname`, `Pdate`, `Passed`, `Payment`, `Clearing`, `Taken`, `Changing`, `Paid`, `Branche`) VALUES ('$Date', '$Time', '$loge', '$amo', '$mode', '0', 'PROFORMA', '$namei', '', '$cheno', '$bna', '$pda', '0', '0', '0', '0', '0', '0', '1')");
		}


	

		// Amend a given PROFORMA order
if(isset($_POST['amend']))
		{
			$dato=$_POST['dato'];
			$datos=$_POST['datos'];
			$vous=$_POST['vous'];
			$custo=$_POST['custo'];
			$_SESSION['BR']=$custo;
	$so=mysql_query("UPDATE `stouse` SET `Voucher`='0', `User`='$loge', `Printed`='0' WHERE `Action`='PROFORMA' AND `Voucher`='$vous' AND `Status`='10' ORDER BY `Number` ASC LIMIT 100");
		}
		

$dom=mysql_query("DELETE FROM `stouse` WHERE `Item`='0' ORDER BY `Number` DESC LIMIT 30");

$do=mysql_query("SELECT *FROM `branches` WHERE `Status`='0' ORDER BY `Number` ASC LIMIT $lim");
$fo=mysql_num_rows($do);
?>
<div class="container-fluid main-content">
        <div class="page-title hidden-print">
          <h2 style='margin-top:-20px; margin-bottom: 5px; color:#ffcc33'>
       Sales/Payment
          </h2>
                 </div>
			<?php
				 if($fo=='1')
					$dsa='';
				else
					$dsa="style='pointer-events: none;'";
			?>
     
        <div class="row">
  <div class="col-lg-2 hidden-print">
   
   <ul class="list-group">

	   <li class="list-group-item active">
              <a href="proforma.php" <?php echo $dsa ?>>
                <p>
                <i class="lnr lnr-plus-circle"></i>&nbsp;Create New Proforma
                </p>
              </a></li>

   <li class="list-group-item">
	  <a href="boorepo.php" <?php echo $dsa ?>>
                <p>
                <i class="lnr lnr-menu-circle"></i>&nbsp;Proformas` Report
                </p>
              </a></li> 

	   <li class="list-group-item">
              <a href="branches.php">
                <p>
                <i class="lnr lnr-plus-circle"></i>&nbsp;Sales/Payment
                </p>
              </a></li>   
                       
            </ul><br><br>
  
				 <ul class="list-group text-left">
        <?php
        if($_SESSION['Acrepo']=='1000'){
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
$doq=mysqli_query("SELECT `Amount` FROM `payment` WHERE `Status`='0' AND `Action`='PROFORMA' AND `Voucher`='0' ORDER BY `Number` ASC");
				if($foq=mysqli_num_rows($doq))
echo"<span class='badge' style='float:right; font-size:12px; margin-right:0px; margin-top:0px; height:18px; background-color:#ffcc66; width:auto;'> $foq </span>";
					?>
                </p>
              </a></li> 

   <li class="list-group-item" style="border:1px dashed #cccccc; border-radius:5px; margin:0px 0px 4px 0px;">
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
			
             ?>
  </div>
                    
           
           
       
        <div class="col-lg-10">               
             <div class="row">
            <div class="col-lg-12" style='margin-top:-20px;'>
			 <?php
			 if($fo==1){
				 echo"<label class='col-md-5'> </label>
				 <form action='' method='post'><label class='col-md-4'>";
			 echo"<input class='form-control' name='custo' type='text' id='searchu' autofocus='autofocus' required>
				</label><label class='col-md-2'><button class='btn  btn-primary btn-block' type='submit' name='search'><i class='lnr lnr-magnifier'></i> Search</button></label></form>";
						}
				 ?>
				 <div class="row"></div>
            <div class="widget-container fluid-height clearfix">
            <div class="widget-content padded clearfix"></form>
        <?php
			   if($t==1){
		$do=mysql_query("SELECT *FROM `items` WHERE `Store`<='2' AND `Status`='0' $conde ORDER BY `Number` ASC LIMIT $lim");
				if($fo=mysql_num_rows($do)){
				   ?>
                 
                  <div class="table-responsive">
			<form action="" method="post" class="form-horizontal "> 
				<table class="table table-striped table-hover">     
                                      <thead>
                    <tr role="row">
                     <th class="hidden-xs"> No </th>
                       <th> Item&nbsp;Name </th>
                        <th> Description </th>
             <th colspan='2'>&nbsp;&nbsp;Qty&nbsp;In&nbsp;/&nbsp;Unit </th>
					<th> Sales&nbsp;Price </th>
                        <th><div align='center'> Quantity </th>
						<th class="hidden-print">Total&nbsp;Amount</th>
                     </tr>
                    </thead>
                                        <tbody>
					<?php
					$n=1;		
						while($ro=mysql_fetch_assoc($do)){
				$code=$ro['Number'];
				$iname=$ro['Iname'];
			$kin=$ro['Type'];
			$descri=$ro['Descri'];
			$uno=$ro['Unit'];
			$batch=$ro['Batch'];
			$expiry=$ro['Expiry'];	
$store=$ro['Store'];			
if($store=='1')		
	$cost=$ro['Price'];
else
	$cost=$ro['Price'];
	
$costo=number_format($cost, 2);

$qt=$ro['S1']+$ro['S2']+$ro['S3'];				$qty=number_format($qt, 2);

$doi=mysql_query("SELECT *FROM `itype` WHERE `Number`='$kin' ORDER BY `Number` ASC");
		$roi=mysql_fetch_assoc($doi);
				$type=$roi['Type'];

				$dox=mysql_query("SELECT *FROM `unit` WHERE `Number`='$uno' ORDER BY `Number` ASC");
					$rox=mysql_fetch_assoc($dox);
							$unit=$rox['Unit'];
          $b=$n*10;
          		
	 if(!$_SESSION['Aco']){
				    $costo="******&nbsp;&nbsp;";
			    $dsa="readonly";
			    $typ="password";
				    $id="";
				}
				else{
				    $costo=number_format($cost, 2);
				    $id="id='result$n'";
				    $dsa="";
				    $typ="text";
				}
		print("<tr><td class=hidden-xs><div align='center'>$n&nbsp;&nbsp;</td><td> $iname </td><td> $descri </td><td><div align='right'> $qty </td><td> $unit </td><td><input name='pri$n' class='form-control' type='$typ' onkeyup='multiplyBy$n();' onkeypress='return isNumberKey(event)' style='text-align:right; width:130px; height:24px;' id='box$b' value='$cost' $dsa></td>
				<td><input name='qty$n' class='form-control' type='text' onkeyup='multiplyBy$n();' onkeypress='return isNumberKey(event)' style='text-align:right; width:120px; height:24px; margin:0px 0px 0px 0px' id='box$n'></td>
				<td class='hidden-print' width='10%'><div align='right' style='border:1px solid #cccccc; width:120px; height:24px; border-radius:5px; padding:0px 10px 0px 0px;'><input type='hidden' name='item$n' value='$code'><input type='hidden' name='qts$n' value='$qt'>
						<span class='dollars' style='text-align:right; width:130px; height:24px; font-size:18px; color:#66cccc; float:center; text-align:right;' $id onchange='format(this);'></span></div><input type='hidden' name='cost$n' value='$cost'></td></tr>");
						  $n++;
						}
						$toto=number_format($tot);			$tco=number_format($tco);
						?>
						
                    </tbody>
                  </table></div>

				   <div class="row"><br>
                  <div class="col-lg-10"><hr></div><div class="col-lg-2">
                 <?php echo"<input type='hidden' name='n' value='$n'>"; ?>
                 <button class="btn btn-sm btn-block btn-primary hidden-print" type="submit" name="addo" style="margin:0px 0px 0px -15px;">
				 <i class="lnr lnr-plus-circle"></i> Add to Cart </button>
              </div></div></form>
				  <?php
				}
				 else{
						echo"<div class='row'>
            <div class='col-lg-12' style='margin-top:-20px;'>
             <span> &nbsp;&nbsp; Store Voucher No : <b> $vou </b></span>
            <div class='widget-container fluid-height clearfix'>
            <div class='widget-content padded clearfix'>
			<br><br><br><br><br><br>
						<div style='text-align:center; font-size:24px; color:#ff3333'> Item not found for your search [$custo] </div><br><br><br><br><br><br><br>";
					}  
			}
				   else{
			$n=1;
      // ****************************** Found branches' list **************************************************** 
			while($ro=mysql_fetch_assoc($do)){
				$num=$ro['Number'];
				$name=$ro['Name'];
				$loc=$ro['Location'];
				$udate=$ro['Udate'];
				$utime=$ro['Utime'];
				$tag=$ro['Tag'];
				$tele=$ro['Telephone'];
				$_SESSION['Table']='';

	$ndy=(strtotime("$Date") - strtotime("$udate")) / (60 * 60 * 24);
		if($ndy>3)
			$cln="#ff0000";
		elseif($ndy<=3 AND $ndy>1)
			$cln="#00cc00";
		else
			$cln='';

		if($_SESSION['Abra']=='1' OR $_SESSION['Access']=='5')
			print("<form action='' method='post'>");

		$dom=mysql_query("SELECT `Date`,`Time` FROM `stouse` WHERE `Branche`='$num' ORDER BY `Date` DESC LIMIT 1");
			if($fom=mysql_num_rows($dom)){
			$rom=mysql_fetch_assoc($dom);
				$uda=$rom['Date'];
				$uti=$rom['Time'];
				$uty='';
				$utyo="<font color='#ff0099'>[$uty]</font>";
			}
			else{
				$uda="0000-00-00";
				$uti="00:00:00";
				$uty=$utyo="";
			}
			
			 if($_SESSION['Branche']==$name OR $_SESSION['Branche']==''){
			 $dbutn='submit';
			 $disa='';
		 }
		 else{
			 $dbutn='button';
			 $disa='You are not allowed to open this branch';
		 }
		 if($fo==1){
			 $hg='425px;';
			 $cl=3;
			 $sn="hidden-xs";
		 }
		 else{
			 $hg='90px;';
			 $cl=6;
			 $sn="";
		 }
		print("</form><form action='proforma.php' method='post'><div class='col-md-$cl $sn'>
		<button type='$dbutn' class='btn btn-lg btn-block btn-secondary' style='margin-bottom:10px; margin-top:10px; height:$hg' title='$disa' data-toggle='tooltip' data-placement='top'> $name <font style='font-size:14px;'> &nbsp; </font>
				<span class='badge' style='float:right; background-color:#99ccff;margin-right:5px; top:-20px;'> $loc </span><br><br>
				<font style='color:#FF6600; font-size:14px;'> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$tele </font>
				<input type='hidden' name='custo' value='$num'><br>
				<span class='badge' style='float:right; font-size:12px; margin-right:10px; margin-top:5px; background-color:#ff66cc;'> $n </span>
				<font size='1' style='margin-left:20px; color:#66cc99;'>
				<b>&nbsp;&nbsp;&nbsp;&nbsp;UPDATE:</b> $uda&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$uti </font><br><br><br><br><center>
				<div style='height:32px; width:220px; border:1px solid #0020C2; border-radius:5px; padding-top:5px; float:center; text-align:center; color:#0020C2;'> PROFORMA </div></center></button></div></form>");
						  $n++;
						}
						if($fo=='1'){
							$custo=$num;
						?>
				<div class='col-md-9 text-center'>

<?php
	$do=mysql_query("SELECT *FROM `stouse` WHERE `Status`='10' AND `Upda`='0' AND `Voucher`='0' AND `User`='$loge' AND `Branche`='1' ORDER BY `Number` DESC LIMIT 100");
				if(!$fo=mysql_num_rows($do)){

			if($cart)
echo"<div class='form-group'><div class='col-sm-12 text-center' style='border:1px solid powderblue; border-radius:5px; height:424px; color:#66cc00; margin-top:10px;'><br><br><br><b>Proforma invoice has been saved successfull! </b><br><br>
<br><img src='imgs/emptycart.png' class='rounded float-left' alt='Empty Cart' style='height:280px; width:340px;'></div></div>";
			else
echo"<div class='form-group'><div class='col-sm-12 text-center' style='border:1px solid powderblue; border-radius:5px; height:424px; color:#ff3366; margin-top:10px;'><br><br><br><b>Your cart is empty, please load items! </b><br><br>
<br><img src='imgs/emptycart.png' class='rounded float-left' alt='Empty Cart' style='height:280px; width:340px;'></div></div>";

				}
				else{

echo"<div class='col-sm-12 text-center' style='border:1px solid powderblue; border-radius:5px; height:345px; margin:10px 0px 10px 0px; overflow-y:auto;'>

<table class='table table-striped table-hover'>     
                                      <thead>
                    <tr role='row'>
                     <th width='2%'>&nbsp;&nbsp;#&nbsp;</th>
                       <th width='6%' class='text-center'>&nbsp;&nbsp;Stock&nbsp;&nbsp;</th>
                        <th>&nbsp;&nbsp;&nbsp; Item&nbsp;Name </th>
                       <th width='5%'>&nbsp;&nbsp;&nbsp;Price </th>
                       <th width='5%'>Quantity</th>
						<th width='5%'>&nbsp;&nbsp;Amount</th>
                        <th width='5%' class='hidden-xs hidden-print' style='width:20px; text-align:center;' colspan='2'> Options </th>
                     </tr>
                    </thead>
                                        <tbody>";
					
					$n=1;				$tot=$click=$store=$shop=0;	
			while($ro=mysql_fetch_assoc($do)){
				$code=$ro['Number'];
				$vou=$ro['Voucher'];
				$pri=$ro['Price'];
				$prio=number_format($pri);
				$qty=$ro['Quantity'];
				$item=$ro['Item'];
				$to=$qty*$pri;
				$too=number_format($to);
				$dte=$ro['Date'];
				$cuso=$ro['Destin'];
				$dst=$ro['Invoice'];
				$comme=$ro['Comment'];

	$dop=mysql_query("SELECT *FROM `items` WHERE `Number`='$item' ORDER BY `Number` DESC LIMIT 1");
				$rop=mysql_fetch_assoc($dop);
					$inamu=$rop['Iname'];
					$sour=$rop['Source'];
					$qts=$rop['S1']+$rop['S2']+$rop['S3'];
					$tys=$rop['Type'];
					$qtb=$rop["S$custo"];
					$atp=number_format($rop['Price']);
$bat=$rop['Batch'];
$exp=$rop['Expiry'];
$des=$rop['Descri'];
		if($qts<$qty)
			$store++;

		if($qtb<$qty)
			$shop++;
			
	
	$dops=mysql_query("SELECT *FROM `itype` WHERE `Number`='$tys' ORDER BY `Number` DESC LIMIT 1");
				$rops=mysql_fetch_assoc($dops);
					$typ=$rops['Type'];

					echo"<div class='modal fade text-left' id='exampleModal$n' tabindex='-1' role='dialog' 
					aria-labelledby='exampleModalLabel' aria-hidden='true' style='top:220px;'>
  <div class='modal-dialog' role='document'>
    <div class='modal-content'>
      <div class='modal-header'>
        <h5 class='modal-title' id='exampleModalLabel'>DELETE CONFIRMATION 
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; $inamu </h5>

      </div>
      <div class='modal-body' style='height:40px;'>
        <h5 style='color:#ff0033'>Are you sure you want to remove this item?</h5>
      </div><form method='post' action=''><input type='hidden' name='rowid' value='$code'>
	  <input type='hidden' name='custo' value='$custo'><input type='hidden' name='fo' value='$fo'>
      <div class='modal-footer text-right' style='margin-top:-10px; height:50px; padding-top:5px; border:0px solid blue;'>
        <button type='button' class='btn btn-sm btn-success' data-dismiss='modal'>&nbsp;NO&nbsp;</button>
        <button type='submit' name='delo' class='btn btn-sm btn-danger' $disa>YES</button>
      </div></form>
    </div>
  </div>
</div>";
				 if(($qts+$qtb)<$qty){
			  $stl="color:#ff3333;";
			  $click++;
		  }
		  else{
			  $stl='';
		  }

		echo"<tr><form method='post' action=''>
		<td style='padding:0px; color:powderblue;'><div align='center'><input type='hidden' name='num' value='$num'> $n </td>
			<td style='padding:0px; $stl $clr'> $qts </td><td class='text-left' style='$stl $clr'>$inamu&nbsp;$des&nbsp;</td>

		<td style='padding:0px; $stl'><input name='pri' class='form-control' type='text' onkeyup='format(this);' onkeypress='return isNumberKey(event);' onChange=this.style.color='#ff3366' style='text-align:right; width:70px; height:24px; margin:0px 0px 0px 0px; padding:0px 10px 0px 0px; margin:0px; $clr $stl' value='$prio'></td>

		<td style='padding:0px 5px 0px 5px; text-align:right'><input name='qty' class='form-control' type='text' onkeyup='format(this);' onkeypress='return isNumberKey(event);' onChange=this.style.color='#ff3366' style='text-align:right; width:60px; height:24px; margin:0px 0px 0px 0px; padding:0px 10px 0px 0px; margin:0px; $clr $stl' value='$qty' onclick=this.value=''></td>
						
		<td style='padding:0px;'><input name='tot' class='form-control' type='text' onkeyup='format(this);' onkeypress='return isNumberKey(event);' onChange=this.style.color='#ff3366' style='text-align:right; width:80px; height:24px; margin:0px 0px 0px 0px; padding:0px 10px 0px 0px; margin:0px; $clr $stl' value='$too' readonly></td>
						
						
				<td class='hidden-xs hidden-print' align='right' style='width:20px; padding:0px;'>
         <input type='hidden' name='rowid' value='$code'><input type='hidden' name='custo' value='$custo'>
		 <button type='submit' class='btn btn-xs btn-warning hidden-print' name='edit' style='height:22px; padding:0px; margin:0px;' title='Edit' data-toggle='tooltip' data-placement='top'>&nbsp;&nbsp;<i class='lnr lnr-pencil'></i>&nbsp;&nbsp;</button></td>
						  
				<td class='hidden-xs hidden-print' align='right' style='width:20px; padding:0px;'><div title='Remove' data-toggle='tooltip' data-placement='top'>
		<input type='hidden' name='num' value='$num'><button type='button' class='btn btn-xs btn-danger hidden-print' style='height:22px; padding:0px; margin:0px;' data-toggle='modal' data-target='#exampleModal$n'>&nbsp;&nbsp;<i class='lnr lnr-trash'></i>&nbsp;&nbsp;</button></div></td></form></tr>";
						  $n++;					$tot+=$to;
						}
						$toto=number_format($tot);			
						
			echo"</tbody><tr><th colspan='3' class='text-center'> Total Amount </th><th colspan='3' class='text-right'>$curre1 &nbsp; $toto </th>
			<th colspan='2' class='hidden-xs hidden-print'> </th></tr>
                  </table><hr style='margin-top:-10px;'></div>";

				$pa=$cre=0;             	$plino='';
		$doit=mysql_query("SELECT `Amount`, `Pline`, `Description` FROM `payment` WHERE `Status`='0' AND `Action`='PROFORMA' AND `Cashier`='$loge' AND `Branche`='1' AND `Voucher`='0' ORDER BY `Number` ASC");
				while($roit=mysql_fetch_assoc($doit)){
				    $deso=$roit['Description'];
				    $plin=$roit['Pline'];
				    $plino="$plino $plin";
					if($roit['Pline']=='CREDIT')
						$cre+=$roit['Amount'];
					else
						$pa+=$roit['Amount'];
				}
				$bal=$tot-$cre-$pa;

			//	if($bal>10 OR $click>0)
				//	$disa="disabled";

				echo"<div id='modal-k' class='modal fade text-left' role='dialog' style='top:220px;'>
  <div class='modal-dialog' role='document'><div class='modal-content'><div class='modal-header'>
        <h5 class='modal-title' id='exampleModalLabel'>DELETE CONFIRMATION 
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </h5>

      </div>
      <div class='modal-body' style='height:40px;'>
        <h5 style='color:#ff0033'>Are you sure you want to remove the payment?</h5>
      </div><form method='post' action=''><input type='hidden' name='custo' value='$custo'>
      <div class='modal-footer text-right' style='margin-top:-10px; height:50px; padding-top:5px; border:0px solid blue;'>
        <button type='button' class='btn btn-sm btn-success' data-dismiss='modal'>&nbsp;NO&nbsp;</button>
        <button type='submit' name='delopa' class='btn btn-sm btn-danger'>YES</button>
      </div></form>
    </div>
  </div>
</div>";
			$afs="ADD AN ADVANCE";		  
		$pao=number_format($pa);				$creo=number_format($cre);					$balo=number_format($bal);					 include'paying.php';
?>


	<div class="row"><div class="col-sm-12" style="font-size:12px;">
	<table width='100%'><tr style="height:10px;">
	<td width='25%'> TOTAL : <b><?php echo $toto ?></b></td>
	<td width='25%'> PAID : <b><?php echo $pao ?></b></td>
<td width='25%'> CREDIT : <b><?php echo $creo ?></b></td>
<td width='25%' style="padding-left:0px; padding-right:0px; font-size:12px;"> BALANCE : <b><?php echo $balo ?></b>
<?php
		if($pa OR $cre)
echo"<button type='button' class='btn btn-sm btn-danger hidden-print' style='margin:0px; padding:0px 5px 0px 20px; 
	margin-top:-3px; height:18px; border:0px; color:#ff6600; background-color:transparent;' data-placement='top' data-toggle='modal' data-target='#modal-k' title='Remove the payment'>
	<i class='lnr lnr-trash'></i></button>";
	?>

	</td></tr></table>
	</div>

<div class="col-sm-12" style="margin:-15px; 5px; 0px 5px; padding-top:0px; height:20px; margin-left:-5px;"><hr style="border:1px solid powderblue;"></div>

<form action='' method='post'><div class="col-sm-4" style="padding-right:0px; padding-top:5px;"><input name="comme" class="form-control sm" type="text" placeholder="Delivery Details" value="<?php echo $comme ?>"> 
    <!--
<button class="btn btn-md btn-block btn-warning" type="button" data-toggle="modal" data-target="#modal-x11">
	<i class='lnr lnr-briefcase'></i> PAY </button>
	--></div>
	
	   <?php
	if($_SESSION['Adat'])
	    $idf="id='from'";
	else
	    $idf="readonly";
	    ?>

	<div class="col-sm-2" style="padding-top:5px;">
	<input name="dato" <?php echo $idf ?> class="form-control sm" type="text" style="text-align:center; padding-left:1px; padding-right:1px;" VALUE="<?php echo $dte ?>" onclick="return pageScroll()"><?php echo"<input type='hidden' value='$custo' name='custo'>"; ?></div>
	
	<div class="col-sm-3" style="padding:5px; margin-left:0px;">
	 <select class="form-control" name="suppli" required>	
	 <option value=''> SELECT CUSTOMER </option>
			 <?php			
	$doi=mysql_query("SELECT `Customer` FROM `account` WHERE `Status`='0' ORDER BY `Customer` ASC");
			while($roi=mysql_fetch_assoc($doi)){
				$fna=$roi['Customer'];
				if($cuso==$fna)
					$s='selected';
				else
					$s='';
			echo"<option value='$fna' $s> $fna </option>";
			}
			
				if($dst!='MAIN STORE')
					$dst='';
					
			?>			    
            </select>
			 <input type="hidden" class="form-control" name="source" style="padding-left:10px; padding-right:5px;" value="<?php echo $dst ?>" required>
			 
			 </div>


   <div class="col-sm-2" style="padding-top:5px;">
   <?php
 // form token 
        $form_token = uniqid();
 
        // create form token session variable and store generated id in it.
        $_SESSION['form_token'] = $form_token;
  	  echo"<input type='hidden' name='custo' value='$custo'><input type='hidden' name='form_token' value='$form_token'>
       <input type='hidden' name='deso' value='$deso'>
       <input type='hidden' name='plino' value='$plino'>
  <button class='btn btn-md btn-block btn-success' type='$bton' name='receive' $disa>
	<i class='lnr lnr-arrow-up-circle'></i> SAVE </button>";
	   ?>
		</div></form><form action="" method="post">
			 
			  <div class="col-sm-1" style="margin-top:5px;">
			    <?php
				  if($n>3){
				  echo"<input type='hidden' name='custo' value='$custo'><button type='submit' class='btn btn-md btn-danger hidden-print' name='delox' title='Remove All' data-toggle='tooltip' data-placement='top'>&nbsp;&nbsp;<i class='lnr lnr-trash'></i>&nbsp;&nbsp;</button>";
			  }
			  ?>
			  </div></form>
		<?php
						}
						}

	   ?>

		</div></div>
                  </div>

<?php
			 if($fo=='1'){
				 ?>
				 <br><br><center>
				 Last sales uploaded: <?php echo"<b>$uda&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$uti</b>&nbsp;&nbsp;&nbsp;"; ?></center>
		<?php
						}
						}
	   ?>
              </div></div>
            </div></div>
                  </div>
      
   </div></div></div>

   <?php
 include'footer.php';
   ?>
