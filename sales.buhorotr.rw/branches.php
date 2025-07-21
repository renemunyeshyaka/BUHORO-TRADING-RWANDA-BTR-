<?php
if(basename($_SERVER['PHP_SELF']) == 'branches.php') 
  $bb=" class='current'";

include'connection.php';

$custo='';
$conde='';
$trig=0;
$cart=0;

$rece=mysql_query("SELECT `Voucher` FROM `stouse` ORDER BY `Voucher` DESC LIMIT 1");
				$recet=mysql_fetch_assoc($rece);
					$vou=$recet['Voucher']+1;

// Close the current chart
		if(isset($_POST['receive']) AND $_POST['form_token'] == $_SESSION['form_token'])
		{
			$supplier=$_POST['suppli'];
			$dato=$_POST['dato'];
			$source=$_POST['source'];
			$cprint=$_POST['cprint'];
			$custo=$_POST['custo'];
			$_SESSION['BR']=$custo;
			$action="SALES";
			$cart=1;

			$doibi=mysql_query("SELECT `Number` FROM `account` WHERE `Customer`='$supplier' ORDER BY `Number` ASC");
					$roibi=mysql_fetch_assoc($doibi);
						$clie=$roibi['Number'];

	$so=mysql_query("UPDATE `stouse` SET `Date`='$dato', `Time`='$Time', `Destin`='$supplier', `Voucher`='$vou', `Invoice`='$source', `Client`='$clie' WHERE `User`='$loge' AND `Status`='0' AND `Voucher`='0' AND `Action`='SALES'");

	$sso=mysql_query("UPDATE `payment` SET `Date`='$dato', `Time`='$Time', `Customer`='$supplier', `Voucher`='$vou', `Client`='$clie' WHERE `Cashier`='$loge' AND `Status`='0' AND `Voucher`='0' AND `Action`='SALES'");

				$then=mysqli_query($cons, "UPDATE `account` SET `Cdate`='$dato' WHERE `Number`='$clie' ORDER BY `Number` ASC LIMIT 1");

	// **************************************** Update related store quantity *****************************************************
   $recex=mysql_query("SELECT *FROM `stouse` WHERE `Action`='SALES' AND `Voucher`='$vou' AND `Upda`='0' AND `Status`='0' ORDER BY `Voucher` DESC LIMIT 100");
		if($fecex=mysql_num_rows($recex)){
				while($rex=mysql_fetch_assoc($recex)){
					$nuo=$rex['Number'];
					$ito=$rex['Item'];
					$qto=$rex['Quantity'];
					$stor=$rex['Store'];
					$sales=$rex['Sales'];

		$dow=mysql_query("UPDATE `items` SET `$stor`=`$stor`-'$qto' WHERE `Number`='$ito' ORDER BY `Number` ASC LIMIT 1");
		
			$dova=mysql_query("SELECT *FROM `items` WHERE `Number`='$ito' ORDER BY `Number` DESC LIMIT 1");
				$rova=mysql_fetch_assoc($dova);
						$qty=$rova["$stor"];
	$thent=mysql_query("UPDATE `stouse` SET `Upda`='1', `Closing`='$qty' WHERE `Number`='$nuo' ORDER BY `Number` ASC LIMIT 1");
	
	        if($rex['Otype']=='PROFORMA' AND $sales)
	$do=mysql_query("UPDATE `stouse` SET `Sales`='$vou', `Otype`='SOLD' WHERE `Voucher`='$sales' AND `Action`='PROFORMA' AND `Status`='10' AND `Item`='$ito' ORDER BY `Number` ASC LIMIT 1");
				}
   }

   // ******************************************* Adjust payments from branch sales *****************************************************
	$doit=mysqli_query($cons, "SELECT *FROM `payment` WHERE `Status`='0' AND `Action`='SALES' AND `Voucher`='$vou' AND `Upda`='0' ORDER BY `Number` ASC LIMIT 10");
				while($roit=mysqli_fetch_assoc($doit)){
					$nuo=$roit['Number'];
					if($roit['Pline']=='CREDIT'){
						$cre=$roit['Amount'];
						$cus=$roit['Client'];
						$dte=$roit['Date'];
			$crdi=mysqli_query($cons, "UPDATE `account` SET `Balance`=`Balance`+'$cre', `Cdate`='$dte' WHERE `Number`='$cus' ORDER BY `Number` ASC LIMIT 1");
					}

					if($roit['Pline']=='BANK'){
						$pa=$roit['Amount'];
						$pda=$roit['Date'];
						$cheno=$roit['Cheno'];
						$cuso=$roit['Customer'];
						$bna=$roit['Bname'];
						$vous=$roit['Voucher'];
						$descri="Invoice No: $vous";
		$and=mysqli_query($cons, "INSERT INTO `deposit` (`Date`, `Time`, `User`, `Item`, `Refer`, `Amount`, `Customer`, `Operation`, `Status`, `Valid`, `Account`, `Descri`, `Client`, `Voucher`, `Branche`) VALUES ('$pda', '$Time', '$loge', 'DEPOSIT', '$cheno', '$pa', '$cuso', 'SALES', '0', '0', '$bna', '$descri', '$cuso', '$vous', '$custo')");
					}

			$thent=mysqli_query($cons, "UPDATE `payment` SET `Upda`='1' WHERE `Number`='$nuo' ORDER BY `Number` ASC LIMIT 1");
				}

		// ********************************** About receipt print ***************************************************************
			if($Receipt AND $cprint!='NON')
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
			$then=mysqli_query($cons, "DELETE FROM `stouse` WHERE `Action`='SALES' AND `Voucher`='0' AND `User`='$loge' LIMIT 100");
		$doit=mysqli_query($cons, "DELETE FROM `payment` WHERE `Status`='0' AND `Cashier`='$loge' AND `Action`='SALES' AND `Voucher`='0' ORDER BY `Number` ASC");
		}

// When click to open only one branch
if(isset($_POST['search']))
		{
			$custo=$_POST['custo'];
   $_SESSION['BR']=$custo;
		}

		// Delete a given item from cart
if(isset($_POST['delo']))
		{
			$custo=$_POST['custo'];
   $_SESSION['BR']=$custo;
   $rowid=$_POST['rowid'];
   $doin=mysqli_query($cons, "DELETE FROM `stouse` WHERE `Number`='$rowid' ORDER BY `Number` ASC LIMIT 1");
   if($_POST['fo']=='1')
		$doit=mysqli_query($cons, "DELETE FROM `payment` WHERE `Status`='0' AND `Cashier`='$loge' AND `Action`='SALES' AND `Voucher`='0' ORDER BY `Number` ASC");
		}


		// Remove all payment
if(isset($_POST['delopa']))
		{
			$custo=$_POST['custo'];
   $_SESSION['BR']=$custo;
	$doit=mysqli_query($cons, "DELETE FROM `payment` WHERE `Status`='0' AND `Cashier`='$loge' AND `Action`='SALES' AND `Voucher`='0' ORDER BY `Number` ASC");
		}


		// Delete a given item from cart
if(isset($_POST['edit']))
		{
			$custo=$_POST['custo'];
   $_SESSION['BR']=$custo;
   $rowid=$_POST['rowid'];
		
		$qty=str_replace(',', '', $_POST['qty']);
		$pri=str_replace(',', '', $_POST['pri']);
			$store=$_POST['store'];

   $doin=mysqli_query($cons, "UPDATE `stouse` SET `Price`='$pri', `Quantity`='$qty', `Store`='$store' WHERE `Number`='$rowid' ORDER BY `Number` ASC LIMIT 1");
		}
		
		
			// Add items to sales cart from proforma
if(isset($_POST['ameni']))
		{
			$vous=$_POST['vous'];
	$dop=mysql_query("SELECT *FROM `stouse` WHERE `Voucher`='$vous' AND `Status`='10' AND `Action`='PROFORMA' ORDER BY `Number` ASC LIMIT 100");
		if($fop=mysql_num_rows($dop)){
			while($rop=mysql_fetch_assoc($dop)){
				$item=$rop['Item'];
				$pri=$rop['Price'];
				$sour=$rop['Source'];
				$cost=$rop['Cost'];
				$qty=$rop['Quantity'];
				$dest=$rop['Destin'];
				$clie=$rop['Client'];
				$comme=$rop['Comment'];
				$store="S3";
				$custo=1;
	
	$dox=mysql_query("INSERT INTO `stouse` (`Date`, `Time`, `User`, `Item`, `Cost`, `Quantity`, `Price`, `Action`, `Destin`, `Comment`, `Otype`, `Store`, `Branche`, `Sales`, `Client`) VALUES ('$Date', '$Time', '$loge', '$item', '$cost', '$qty', '$pri', 'SALES', '$dest', '$comme', 'PROFORMA', '$store', '$custo', '$vous', '$clie')");
			}
		}
		}

		// Add selected item to sales cart
if(isset($_POST['take']))
		{
			$ito=str_replace("'", "`", $_POST['ito']);
			$custo=$_POST['custo'];
			$store=$_POST['store'];
				$_SESSION['BR']=$custo;
				$pieces = explode(" @ ", $ito);
					$item=$pieces[0]; // piece1
					$price=$pieces[1]; // piece2
		
		$qty=str_replace(',', '', $_POST['qty']);
		$pri=str_replace(',', '', $_POST['pri']);

		$dop=mysql_query("SELECT *FROM `items` WHERE `Iname`='$item' OR `Ecode`='$item' ORDER BY `Number` DESC LIMIT 1");
		if($fop=mysql_num_rows($dop)){
			$rop=mysql_fetch_assoc($dop);
				$item=$rop['Number'];
				$upri=$rop['Price'];
				$sour=$rop['Source'];
				$cost=$rop['Cost'];

				if(!$pri)
					$pri=$upri;
	
	$dox=mysql_query("INSERT INTO `stouse` (`Date`, `Time`, `User`, `Item`, `Cost`, `Quantity`, `Price`, `Action`, `Store`, `Branche`) VALUES ('$Date', '$Time', '$loge', '$item', '$cost', '$qty', '$pri', 'SALES', '$store', '$custo')");
		}
		else{
			echo"<center><div class='alert alert-sm alert-danger' style='margin:-20px 80px 20px 80px; height:25px; text-align:center; float:center; border-radius:5px; padding-top:1px;'><i class='lnr lnr-warning'></i> &nbsp;&nbsp; <button class='close' data-dismiss='alert' type='button'>×</button> Item not found, please try again. </div></center>";
		}
	}

	if(isset($_POST['paid']))
		{
			$custo=$_POST['custo'];
            $_SESSION['BR']=$custo;
			$amo=str_replace(',', '', $_POST['amo']);
			$mode=$_POST['mode'];
				$plate=str_replace("'", "`", $_POST['plate']);
				$locat=str_replace("'", "`", $_POST['locat']);
			    $comme=str_replace("'", "`", $_POST['comme']);
			$namei=str_replace("'", "`", $_POST['namei']);

if($mode=='CASH'){
	$cheno=$bna='';
	$pda=$_POST['capa'];
}
if($mode=='CREDIT'){	
	$cheno=$bna='';
	$pda=$_POST['crpa'];
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
}


$sos=mysqli_query($cons, "UPDATE `stouse` SET `Comment`='$comme', `Plate`='$plate', `Location`='$locat', `Seller`='$namei' WHERE `Voucher`='0' AND `Action`='SALES' AND `User`='$loge' AND `Status`='0' ORDER BY `Number` ASC LIMIT 100");

			$then=mysqli_query($cons, "INSERT INTO `payment` (`Date`, `Time`, `Cashier`, `Amount`, `Pline`, `Status`, `Action`, `Description`, `Payto`, `Cheno`, `Bname`, `Pdate`, `Passed`, `Payment`, `Clearing`, `Taken`, `Changing`, `Paid`, `Branche`, `Seller`) VALUES ('$Date', '$Time', '$loge', '$amo', '$mode', '0', 'SALES', '', '', '$cheno', '$bna', '$pda', '0', '0', '0', '0', '0', '0', '$custo', '$namei')");
		}


	

		// Amend a given sales order
if(isset($_POST['amend']))
		{
			$dato=$_POST['dato'];
			$datos=$_POST['datos'];
			$vous=$_POST['vous'];
	$so=mysql_query("UPDATE `stouse` SET `User`='$loge', `Status`='2', `Printed`='2' WHERE `Action`='SALES' AND `Voucher`='$vous' ORDER BY `Number` ASC LIMIT 100");
	
	$sso=mysql_query("UPDATE `payment` SET `Cashier`='$loge', `Status`='2' WHERE `Action`='SALES' AND `Voucher`='$vous' ORDER BY `Number` ASC LIMIT 10");

				include'amend.php';
		}
		
	$custo=$_SESSION['BR'];
		if($custo!='' AND $custo!='0'){
			$conde="AND (`Number` = '$custo')";
			$lim=1;
		}
		else{
			$conde='';
			$lim=15;
		}
$dom=mysql_query("DELETE FROM `stouse` WHERE `Item`='0' ORDER BY `Number` DESC LIMIT 30");

$do=mysql_query("SELECT *FROM `branches` WHERE `Status`='0' $conde ORDER BY `Number` ASC LIMIT $lim");
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

	   <li class="list-group-item">
              <a href="stobranch.php" <?php echo $dsa ?>>
                <p>
                <i class="lnr lnr-menu-circle"></i>&nbsp;Store Status
                </p>
              </a></li>

   <li class="list-group-item">
	  <a href="createa.php" <?php echo $dsa ?>>
                <p>
                <i class="lnr lnr-plus-circle"></i>&nbsp;Create Account
                </p>
              </a></li> 

   <li class="list-group-item">
	  <a href="dadd.php" <?php echo $dsa ?>>
                <p>
                <i class="lnr lnr-plus-circle"></i>&nbsp;Pay on Account
                </p>
              </a></li> 

   <li class="list-group-item">
	  <a href="cashbox.php" <?php echo $dsa ?>>
                <p>
                <i class="lnr lnr-plus-circle"></i>&nbsp;Add to Cashbox
                </p>
              </a></li> 

   <li class="list-group-item">
	  <a href="madd.php" <?php echo $dsa ?>>
                <p>
                <i class="lnr lnr-circle-minus"></i>&nbsp;Make a Payout
                </p>
              </a></li> 
              
     <li class="list-group-item">
	  <a href="boorepo.php" <?php echo $dsa ?>>
                <p>
                <i class="lnr lnr-circle-minus"></i>&nbsp;Proforma Invoice
                </p>
              </a></li>
                       
            </ul><br><center>
			<?php
				
 $brc=$_SESSION['BR'];	
 $doib=mysql_query("SELECT `Name` FROM `branches` WHERE `Number`='$brc' ORDER BY `Number` ASC");
			$roib=mysql_fetch_assoc($doib);
				$bra=$roib['Name'];
				$fld="S$brc";

			if($fo=='1'){
$_SESSION['Branchei']=$bra;

	/*
if($_SESSION['Phyc']){
?>
			<a href="counte.php" class="btn btn-warning" style="width:100%;"><i class="lnr lnr-layers">&nbsp;Physical Count</i></a>
<?php
}
*/
?>

		</center><br>
  
				 <ul class="list-group">
        <?php
        if($_SESSION['Acrepo']){
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
$doq=mysqli_query($cons, "SELECT `Amount` FROM `payment` WHERE `Status`='0' AND `Action`='SALES' AND `Voucher`='0' ORDER BY `Number` ASC");
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
			}
   ?>
  </div>
                    
           
           
       
        <div class="col-lg-10">               
             <div class="row">
            <div class="col-lg-12" style='margin-top:-20px;'>
             <span>Total Records Found : <b><?php echo" $fo " ?></b></span>
			 <?php
			 if($fo==1){
				 echo"<span class='pull-right' style='width:580px;'><form action='' method='post'><div class='col-md-8 col-sm' align='right'>";
		
			echo"<div class='modal fade text-left' id='exampleModal91' tabindex='-1' role='dialog' aria-labelledby='exampleModalLabel' aria-hidden='true' 
		style='top:200px;'>
  <div class='modal-dialog' role='document'>
    <div class='modal-content' style='border-radius:5px;'>
      <div class='modal-header' style='border-radius:5px;'>
        <h5 class='modal-title' id='exampleModalLabel'>ADD ITEM TO CART 
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </h5>";

					 $dois=mysql_query("SELECT `Number` FROM `branches` WHERE `Status`='0' ORDER BY `Number` ASC");
			if($fois=mysql_num_rows($dois)=='1'){
			$rois=mysql_fetch_assoc($dois);
				$custo=$rois['Number'];
				$_SESSION['BR']=$custo;	
			}

		echo"</div>
      <div class='modal-body' style='height:100px;'>
        <h5 style='color:#ff0033'>
		<div class='col-md-3 col-sm' align='right'>Sold Quantity &nbsp;&nbsp;&nbsp; <br>
		<input name='qty' class='form-control text-center' type='text' onkeyup='format(this);' onkeypress='return isNumberKey(event)' value='1' onfocus=this.value='' required></div>
		<div class='col-md-4 col-sm'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Sales Unit Price <br>		
		<input name='pri' class='form-control text-center' type='text' onkeyup='format(this);' onkeypress='return isNumberKey(event)'>
		</div><div class='col-md-4 col-sm'>&nbsp;&nbsp; Select Store <br><select class='form-control' name='store' required>
		<option value=''> STORE </option>";
		
		 $dob=mysqli_query($cons, "SELECT *FROM `stores` WHERE `Status`>='0' ORDER BY `Number` ASC");
		while($rob=mysqli_fetch_assoc($dob)){
			$stonum=$rob['Store'];
			$stona=$rob['Name'];
	echo"<option value='$stonum'> &nbsp; $stona </option>";
		}
		echo"</select>
		</div></h5>

      </div><input type='hidden' name='custo' value='$custo'>

      <div class='modal-header text-right' style='padding-top:10px; height:50px; border:0px solid blue;'>
        <button type='button' class='btn btn-sm btn-warning' data-dismiss='modal' style='width:80px;'>&nbsp;CANCEL&nbsp;</button>
        <button type='submit' name='take' class='btn btn-sm btn-success' style='width:80px;'><i class='lnr lnr-plus-circle'></i> ADD </button>
      </div>
    </div>
  </div>
</div>";
			 echo"<input class='form-control input-sm text-center' style='font-size:18px;' name='ito' type='text' id='searchi' autofocus required>
				</div><div class='col-md-4 col-sm' align='right'><input type='hidden' name='custo' value='$custo'>
                        <button class='btn btn-sm  btn-primary btn-block' style='font-size:18px; padding-top:0px; padding-bottom:0px;' type='submit' data-toggle='modal' data-target='#exampleModal91'>
						<i class='lnr lnr-cart'></i> &nbsp; TAKE </button> </div></form></span>";
		}
				 ?>
            <div class="widget-container fluid-height clearfix">
            <div class="widget-content padded clearfix"></form>
        <?php
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
		print("</form><form action='branches.php' method='post'><div class='col-md-$cl $sn'>
		<button type='$dbutn' name='search' class='btn btn-lg btn-block btn-secondary' style='margin-bottom:10px; margin-top:10px; height:$hg' title='$disa' data-toggle='tooltip' data-placement='top'> $name <font style='font-size:14px;'> &nbsp; </font>
				<span class='badge' style='float:right; background-color:#99ccff;margin-right:5px; top:50px;'> $loc </span><br>
				<font style='color:#FF6600; font-size:14px;'> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$pho1 </font>
				<input type='hidden' name='custo' value='$num'><br>
				<span class='badge' style='float:right; font-size:12px; margin-right:10px; margin-top:5px; background-color:#ff66cc;'> $n </span>
				<font size='1' style='margin-left:20px; color:#66cc99;'>
				<b>&nbsp;&nbsp;&nbsp;&nbsp;UPDATE:</b> $uda&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$uti </font><br><br><br><br><center>
				<div style='height:32px; width:200px; border:1px solid #0020C2; border-radius:5px; padding-top:5px; float:center; text-align:center; color:#0020C2;'> SALES </div></center></button></div></form>");
						  $n++;
						}
						if($fo=='1'){
							$custo=$num;
						?>
				<div class='col-md-9 text-center'>

<?php
	$do=mysql_query("SELECT *FROM `stouse` WHERE `Status`='0' AND `Upda`='0' AND `Voucher`='0' AND `User`='$loge' ORDER BY `Number` DESC LIMIT 100");
				if(!$fo=mysql_num_rows($do)){

			if($cart)
echo"<div class='form-group'><div class='col-sm-12 text-center' style='border:1px solid powderblue; border-radius:5px; height:424px; color:#66cc00; margin-top:10px;'><br><br><br><b>Invoice has been successfull saved! </b><br><br>
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
                       <th width='6%' class='text-center'>S.In</th>
                       <th width='6%' class='text-center'>Store</th>
                        <th>&nbsp;&nbsp;&nbsp; Item&nbsp;Name </th>
                       <th width='5%'>&nbsp;&nbsp;&nbsp;Price </th>
                       <th width='5%'>Quantity</th>
						<th width='5%'>&nbsp;&nbsp;Amount</th>
                        <th width='5%' class='hidden-xs hidden-print' style='width:20px; text-align:center;' colspan='2'> Options </th>
                     </tr>
                    </thead>
                                        <tbody>";
					
					$n=1;				$tot=$click=$store=0;	
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
				$stor=$ro['Store'];
				$comme=$ro['Comment'];
				$seller=$ro['Seller'];

	$dob=mysqli_query($cons, "SELECT `Name` FROM `stores` WHERE `Store`='$stor' ORDER BY `Number` ASC");
		$rob=mysqli_fetch_assoc($dob);
			$stok=$rob['Name'];

	$dop=mysql_query("SELECT *FROM `items` WHERE `Number`='$item' ORDER BY `Number` DESC LIMIT 1");
				$rop=mysql_fetch_assoc($dop);
					$inamu=$rop['Iname'];
					$sour=$rop['Source'];
					$dail=$rop['Daily'];
					$sin=$rop['S1']+$rop['S2']+$rop['S3'];
					$qts=$rop["$stor"];
					$atp=number_format($rop['Price']);

		if($qts<$qty)
			$store++;

					echo"<div class='modal fade text-left' id='exampleModal$n' tabindex='-1' role='dialog' 
					aria-labelledby='exampleModalLabel' aria-hidden='true' style='top:220px;'>
  <div class='modal-dialog' role='document'>
    <div class='modal-content' style='border-radius:5px;'>
      <div class='modal-header' style='border-radius:5px;'>
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


echo"<div class='modal fade text-left' id='exampleModals$n' tabindex='-1' role='dialog' 
					aria-labelledby='exampleModalLabel' aria-hidden='true' style='top:220px;'>
  <div class='modal-dialog' role='document'>
    <div class='modal-content' style='border-radius:5px;'>
      <div class='modal-header' style='border-radius:5px;'>
        <h5 class='modal-title' id='exampleModalLabel'>CHANGE STORE 
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; $inamu </h5>

      </div>
      <div class='modal-body' style='height:120px;'>
	  <div class='col-sm-12'><div class='col-sm-2'> </div>
		<div class='col-sm-3 text-center'> PRICE </div>
		<div class='col-sm-3 text-center'> STORE </div>
		<div class='col-sm-3 text-center'> QUANTITY </div><div class='col-sm-1'> </div>
		</div>

	  <form method='post' action=''><div class='col-sm-12'>
        <h5 style='color:#ff0033'><div class='col-sm-2'>  </div>
		
		<div class='col-sm-3'>
		<input type='text' class='form-control text-center' value='$prio' onkeyup='format(this);' onkeypress='return isNumberKey(event);' name='pri'>
		</div>
		<div class='col-sm-3'>
		<select class='form-control' name='store' required>";		
	$dob=mysqli_query($cons, "SELECT *FROM `stores` WHERE `Status`>='0' ORDER BY `Number` ASC");
		while($rob=mysqli_fetch_assoc($dob)){
			$stonum=$rob['Store'];
			$stona=$rob['Name'];
			if($stonum==$stor)
				$s="selected";
			else
				$s="";
	echo"<option value='$stonum' $s> &nbsp; $stona </option>";
		}
		echo"</select></div><div class='col-sm-3'>
		<input type='text' class='form-control text-center' value='$qty' onkeyup='format(this);' onkeypress='return isNumberKey(event);' name='qty'></div>
		<div class='col-sm-1'> </div>
		</h5></div><br><br><hr style='border:1px solid #c6c6c6;'>
      </div><input type='hidden' name='rowid' value='$code'>
	  <input type='hidden' name='custo' value='$custo'><input type='hidden' name='fo' value='$fo'>
      <div class='modal-footer text-right' style='margin-top:-10px; height:50px; padding-top:5px; border:0px solid blue;'>
        <button type='button' class='btn btn-sm btn-warning' data-dismiss='modal' style='width:80px;'> CANCEL </button>
        <button type='submit'  name='edit' class='btn btn-sm btn-success' style='width:80px;' $disa> SAVE </button>
      </div></form>
    </div>
  </div>
</div>";

		if($qts<$qty){
			  $stl="color:#ff3333;";
			  $click++;
		  }
		  else{
			  $stl='';
		  }
		  
		  if($dail>0 AND $dail>=$sin){
			  $stl="color:green;";
		  }

		echo"<tr><form method='post' action=''>
		<td style='padding:0px; color:powderblue; $stl'><div align='center'><input type='hidden' name='num' value='$num'> $n </td>
			<td style='padding:0px; $stl $clr'> $qts </td><td style='padding:0px; $stl $clr'>
			<a href='#' data-placement='top' data-toggle='modal' data-target='#exampleModals$n'> $stok </a></td>
			<td class='text-left' style='$stl $clr'>&nbsp;$inamu&nbsp;@&nbsp;$atp&nbsp;</td>

		<td style='padding:0px; $stl'><input name='pri' class='form-control' type='text' onkeyup='format(this);' onkeypress='return isNumberKey(event);' onChange=this.style.color='#ff3366' style='text-align:right; width:70px; height:22px; margin:0px 0px 0px 0px; padding:0px 10px 0px 0px; margin:0px; $clr $stl' value='$prio' readonly></td>

		<td style='padding:0px 5px 0px 5px; text-align:right'><input name='qty' class='form-control' type='text' onkeyup='format(this);' onkeypress='return isNumberKey(event);' onChange=this.style.color='#ff3366' style='text-align:right; width:60px; height:22px; margin:0px 0px 0px 0px; padding:0px 10px 0px 0px; margin:0px; $clr $stl' value='$qty' readonly></td>
						
		<td style='padding:0px;'><input name='tot' class='form-control' type='text' onkeyup='format(this);' onkeypress='return isNumberKey(event);' onChange=this.style.color='#ff3366' style='text-align:right; width:90px; height:22px; margin:0px 0px 0px 0px; padding:0px 10px 0px 0px; margin:0px; $clr $stl' value='$too' readonly></td>
						
						
				<td class='hidden-xs hidden-print' align='right' style='width:20px; padding:0px;'>
         <input type='hidden' name='rowid' value='$code'><input type='hidden' name='custo' value='$custo'>
		 <button type='button' class='btn btn-xs btn-warning hidden-print' style='height:20px; padding:0px; margin:0px;' title='Edit' data-placement='top' data-toggle='modal' data-target='#exampleModals$n'>&nbsp;&nbsp;<i class='lnr lnr-pencil'></i>&nbsp;&nbsp;</button></td>
						  
				<td class='hidden-xs hidden-print' align='right' style='width:20px; padding:0px;'><div title='Remove' data-toggle='tooltip' data-placement='top'>
		<input type='hidden' name='num' value='$num'><button type='button' class='btn btn-xs btn-danger hidden-print' style='height:20px; padding:0px; margin:0px;' data-toggle='modal' data-target='#exampleModal$n'>&nbsp;&nbsp;<i class='lnr lnr-trash'></i>&nbsp;&nbsp;</button></div></td></form></tr>";
						  $n++;					$tot+=$to;
						}
						$toto=number_format($tot);			
						
			echo"</tbody><tr><th> </th><th colspan='3' class='text-center'> Total Amount </th>
			<th colspan='3' class='text-right'>$curre1 &nbsp; $toto </th>
			<th colspan='2' class='hidden-xs hidden-print'> </th></tr>
                  </table><hr style='margin-top:-10px;'></div>";

				$pa=$cre=0;
		$doit=mysqli_query($cons, "SELECT `Amount`, `Pline` FROM `payment` WHERE `Status`='0' AND `Action`='SALES' AND `Cashier`='$loge' AND `Voucher`='0' ORDER BY `Number` ASC");
				while($roit=mysqli_fetch_assoc($doit)){
					if($roit['Pline']=='CREDIT')
						$cre+=$roit['Amount'];
					else
						$pa+=$roit['Amount'];
				}
				$bal=$tot-$cre-$pa;

				if($bal>100 OR $click>0)
					$disa="disabled";

				echo"<div id='modal-k' class='modal fade text-left' role='dialog' style='top:220px;'>
  <div class='modal-dialog' role='document'><div class='modal-content' style='border-radius:5px;'>
  <div class='modal-header' style='border-radius:5px;'>
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
				  
		$pao=number_format($pa);				$creo=number_format($cre);					$balo=number_format($bal);					 include'paying.php';
?>


	<div class="row"><div class="col-sm-12" style="font-size:12px;">
	<table width='100%'><tr style="height:10px;">
	<td width='25%'> BALANCE : <b><?php echo $balo ?></b></td>
	<td width='25%'> PAID : <b><?php echo $pao ?></b></td>
<td width='25%'> CREDIT : <b><?php echo $creo ?></b></td>
<td width='25%' style="padding-left:0px; padding-right:0px; font-size:12px;"> TOTAL : <b><?php echo $toto ?></b>
<?php
		if($pa OR $cre)
echo"<button type='button' class='btn btn-sm btn-danger hidden-print' style='margin:0px; padding:0px 5px 0px 20px; 
	margin-top:-3px; height:18px; border:0px; color:#ff6600; background-color:transparent;' data-placement='top' data-toggle='modal' data-target='#modal-k' title='Remove the payment'>
	<i class='lnr lnr-trash'></i></button>";
	?>

	</td></tr></table>
	</div>

<div class="col-sm-12" style="margin:-15px; 5px; 0px 5px; padding-top:0px; height:20px; margin-left:-5px;"><hr style="border:1px solid powderblue;"></div>

<form action='' method='post'><div class="col-sm-1" style="border:0px solid blue; padding-left:0px; padding-right:0px; padding-top:5px; margin-left:40px;">
<button class="btn btn-md btn-block btn-warning" type="button" data-toggle="modal" data-target="#modal-x11">
	<i class='lnr lnr-briefcase'></i> PAY </button></div>
	
	   <?php
	if($_SESSION['Adat'])
	    $idf="id='from'";
	else
	    $idf="readonly";
	    ?>

	<div class="col-sm-2" style="padding-top:5px;">
	<input name="dato" <?php echo $idf ?> class="form-control sm" type="text" style="text-align:center; padding-left:1px; padding-right:1px;" VALUE="<?php echo $dte ?>" onclick="return pageScroll()"><?php echo"<input type='hidden' value='$custo' name='custo'>"; ?></div>
	
	<div class="col-sm-3" style="padding-top:5px; width:220px;">
	 <select class="form-control" name="suppli" required>	
	 <option value=''> SELECT CUSTOMER </option>
			 <?php			
	$doi=mysqli_query($cons, "SELECT `Customer` FROM `account` WHERE `Status`='0' ORDER BY `Customer` ASC");
			while($roi=mysqli_fetch_assoc($doi)){
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
            </select></div><div class="col-sm-1" style="width:20px;">
			 <input type="hidden" class="form-control" name="source" style="padding-left:10px; padding-right:5px;" value="<?php echo $dst ?>" required>
			 
			 </div><div class="col-sm-1" style="padding-left:2px; padding-right:2px; padding-top:5px; width:100px;">
	 <select class="form-control" name="cprint" required>	
	 <option value=''> PRINT </option>
	 <option value='ALL'> ALL </option>
	 <option value='INVO'> INVO </option>
	 <option value='DEL'> DEL </option>
	 <option value='NON'> NONE </option></select>
	 </div>


   <div class="col-sm-2" style="border:0px solid blue; padding-left:0px; padding-right:0px; padding-top:5px;">
   <?php
 // form token 
        $form_token = uniqid();
 
        // create form token session variable and store generated id in it.
        $_SESSION['form_token'] = $form_token;
  	  echo"<input type='hidden' name='custo' value='$custo'><input type='hidden' name='form_token' value='$form_token'>
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
	   ?>
              </div></div>
            </div></div>
                  </div>
      
   </div></div></div>

   <?php
 include'footer.php';
   ?>
