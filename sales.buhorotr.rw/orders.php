<?php
if(basename($_SERVER['PHP_SELF']) == 'orders.php') 
  $bb=" class='current'";
include'connection.php';
$custo='';
$conde='';
$t=$p=999;
$bta=$bin=$bpa=$bsa='success'; 
			$brc= $_SESSION['BR'];

		$do=mysql_query("SELECT *FROM `sales` WHERE `Status`='0' AND `Upda`='0' AND `Voucher`='0' AND `Cashier`='$loge' ORDER BY `Number` DESC LIMIT 100");
				if($fo=mysql_num_rows($do)){					
					$bin='info';
					$t=$p=0;
				}
				else
					$t=$p=999;

// *************************** ask to reprint a given order ***************************
if(isset($_POST['reprint']))
		{
			$t=$p=20;
			$bin='info';
			$vous=$_POST['vous'];
	$so=mysql_query("UPDATE `sales` SET `Printed`='2' WHERE `Voucher`='$vous' ORDER BY `Number` ASC LIMIT 100");
include'oreceipt.php';
		}

// *************************** ask to reprint a given invoice ***************************
		if(isset($_POST['reprinti']))
		{
			$t=$p=41;
			$bpa='info';
			$vous=$_POST['vous'];
	$so=mysql_query("UPDATE `sales` SET `Printed`='2' WHERE `Voucher`='$vous' ORDER BY `Number` ASC LIMIT 100");
include'creceipt.php';
		}

		// save a given order and print receipt
if(isset($_POST['receive']))
		{
			$waiter=$_POST['waiter'];
			$tbl=$_POST['tbl'];
			$dato=$_POST['dato'];
			$comme=$_POST['comme'];
$comme=str_replace("'", "`", $comme);
			$_SESSION['Table']='';
			
	$rece=mysql_query("SELECT `Voucher` FROM `sales` WHERE `Voucher`!='0' ORDER BY `Voucher` DESC LIMIT 1");
				$re=mysql_fetch_assoc($rece);
					$voucher=$re['Voucher']+1;

	$then=mysql_query("UPDATE `sales` SET `Voucher`='$voucher', `Tnumber`='$tbl', `Date`='$dato', `Owner`='$waiter', `Comment`='$comme' WHERE `Status`='0' AND `Upda`='0' AND `Voucher`='0' AND `Cashier`='$loge' AND `Branche`='$brc' LIMIT 100");

	$tbs=mysql_query("UPDATE `tables` SET `Date`='$dato', `S$brc`='1' WHERE `Name`='$tbl' ORDER BY `Number` ASC LIMIT 1");
		$vous=$voucher;
//include'oreceipt.php';
		}

// Save a given sale and print receipt
if(isset($_POST['receives']))
		{
			$vous=$_POST['vous'];
			$waiter=$_POST['waiter'];
			$tabl=$_POST['tabl'];
			$dato=$_POST['dato'];
			
	$rece=mysql_query("SELECT `Voucher` FROM `sales` WHERE `Voucher`!='0' ORDER BY `Voucher` DESC LIMIT 1");
				$re=mysql_fetch_assoc($rece);
					$voucher=$re['Voucher']+1;

	$then=mysql_query("SELECT *FROM `sales` WHERE `Voucher`!='0' AND `Table`='$tabl' AND `Sales`='0' ORDER BY `Number` ASC LIMIT 100");
	while($re=mysql_fetch_assoc($then)){
		$dte=$re['Date'];
		$tme=$re['Time'];
		$cas=$re['Cashier'];
		$item=$re['Item'];
		$pri=$re['Price'];
		$qts=$re['Quantity'];
		$tbs=$re['Table'];
		$own=$re['Owner'];
		$vou=$re['Voucher'];
		$upri=$re['Uprice'];
		$sour=$re['Source'];

	$do=mysql_query("INSERT INTO `sales` (`Date`, `Time`, `Cashier`, `Item`, `Price`, `Quantity`, `Table`, `Owner`, `Upda`, `Voucher`, `Orders`, `Status`, `Printed`, `Uprice`, `Source`) VALUES ('$dato', '$Time', '$waiter', '$item', '$pri', '$qts', '$tbs', '$own', '0', '$voucher', '$vou', '0', '0', '$upri', '$sour')");

	}

	$tbs=mysql_query("UPDATE `tables` SET `S$brc`='0' WHERE `Name`='$tbs' ORDER BY `Number` ASC LIMIT 1");
	
		$vous=$voucher;
include'creceipt.php';
		}






include'header.php';

 $doib=mysql_query("SELECT `Number`, `Name` FROM `branches` WHERE `Number`='$brc' ORDER BY `Number` ASC");
			$roib=mysql_fetch_assoc($doib);
				$bra=$roib['Name'];
				$brc=$roib['Number'];

// search for written item; to be added to the chart
if(isset($_POST['search']))
		{
			$custo=$_POST['custo'];
			$p=1;
			$t=2;

		$conde="AND (`Iname` LIKE '%$custo%' OR `Descri` LIKE '%$custo%')";
		if($custo)
			$lim=100;
		else
			$lim=0;
		}


// search for an item from category; to be added to the chart
if(isset($_POST['order']))
		{
			$typo=$_POST['typo'];
			$bin='info';
			$p=2;
			$t=2;

		$conde="AND (`Type`='$typo')";
			$lim=100;

	$tbs=mysql_query("UPDATE `itype` SET `Count`=`Count`+'1' WHERE `Number`='$typo' ORDER BY `Number` ASC LIMIT 1");
		}


// open for a given category to select item
if(isset($_POST['open']))
		{
			$t=$p=999;
			$bin='info';
		}


// Open a given order for reprint or sale
if(isset($_POST['prir']))
		{
			$t=$p=20;
			$bin='info';
			$vous=$_POST['vous'];
			$tabl=$_POST['tabl'];
		}

// Open all pending orders for reprint or invoice
if(isset($_POST['orders']))
		{
			$t=$p=30;
			$bin='info';
		}

// Delete a given invoice
if(isset($_POST['delosa']))
		{
			$t=$p=30;
			$bin='info';
			$vout=$_POST['vout'];
			$tabl=$_POST['tabl'];

		$ods=mysql_query("UPDATE `orders` SET `Sales`='0' WHERE `Sales`='$vout' ORDER BY `Number` ASC LIMIT 100");

	$dev=mysql_query("UPDATE `sales` SET `Status`='1', `Deleter`='$loge', `Ddate`='$Date', `Dtime`='$Time' WHERE `Voucher`='$vout' ORDER BY `Number` ASC LIMIT 100");
		}

// Delete a given order
if(isset($_POST['delos']))
		{
			$t=$p=50;
			$bsa='info';
			$vout=$_POST['vout'];
			$tabl=$_POST['tabl'];

	$dol=mysql_query("SELECT *FROM `orders` WHERE `Status`='0' AND `Voucher`!='$vout' AND `Voucher`!='0' AND `Table`='$tabl' AND `Sales`='0' ORDER BY `Number` DESC LIMIT 100");
		if(!$fol=mysql_num_rows($dol))
		$tbs=mysql_query("UPDATE `tables` SET `Status`='0' WHERE `Name`='$tabl' ORDER BY `Number` ASC LIMIT 1");

	$dev=mysql_query("UPDATE `orders` SET `Status`='1', `Deleter`='$loge', `Ddate`='$Date', `Dtime`='$Time' WHERE `Voucher`='$vout' ORDER BY `Number` ASC LIMIT 100");
	$des=mysql_query("UPDATE `payment` SET `Status`='1' WHERE `Voucher`='$vout' ORDER BY `Number` ASC LIMIT 100");
		}

// Open all pending invoices for payment
if(isset($_POST['invoice']))
		{
			$t=$p=50;
			$bsa='info';
			$bin='success';
		}
	
// open cart for tables	
if(isset($_POST['table']))
		{
			$t=$p=10;
			$bta='info';
			$bin='success';
		}

// List of all invoice waiting for payment	
if(isset($_POST['payment']))
		{
			$t=$p=40;
			$bpa='info';
			$bin='success';
		}

// Add a payment to a give invoice	
if(isset($_POST['paid']))
		{
			$t=$p=41;
			$bpa='info';
			$bin='success';
			$vous=$_POST['vous'];
			$tabl=$_POST['tabl'];
		}

	// remove all payment from a given chart
if(isset($_POST['rpay']))
		{
			$vous=$_POST['vous'];
			$tabl=$_POST['tabl'];
			$t=$p=41;
			$bpa='info';
			$bin='success';
			
   $so=mysql_query("DELETE FROM `payment` WHERE `Voucher`='$vous' AND `Status`='0' AND `Branche`='$tabl' LIMIT 20");
		$tbs=mysql_query("UPDATE `sales` SET `Paid`='0' WHERE `Voucher`='$vous' AND `Table`='$tabl' ORDER BY `Number` ASC LIMIT 100");
		$p=1;
		}



	// add a payment for a given sale
if(isset($_POST['pay']))
		{
			$cash=$_POST['cash'];
			$cash=str_replace(',', '', $cash);
			$cheque=$_POST['cheque'];
			$cheque=str_replace(',', '', $cheque);
			$bank=$_POST['bank'];
			$bank=str_replace(',', '', $bank);
			$credit=$_POST['credit'];
			$credit=str_replace(',', '', $credit);
			$vous=$_POST['vous'];
			$tabl=$_POST['tabl'];
			$account=$_POST['account'];
           $sale=1;
		if($cash OR $cheque OR $bank OR $credit)
   $then=mysql_query("INSERT INTO `payment` (`Number`, `Date`, `Time`, `Cashier`, `Cash`, `Cheque`, `Bank`, `Credit`, `Voucher`, `Branche`, `Status`, `Customer`, `Destin`) VALUES (NULL, '$Date', '$Time', '$loge', '$cash', '$cheque', '$bank', '$credit', '$vous', '$tabl', '0', '$account', 'SALES')");

		$so=mysql_query("DELETE FROM `payment` WHERE `Cash`='0' AND `Cheque`='0' AND `Bank`='0' AND `Credit`='0'");
		$tbs=mysql_query("UPDATE `sales` SET `Paid`='1', `Customer`='$account' WHERE `Voucher`='$vous' AND `Table`='$tabl' ORDER BY `Number` ASC LIMIT 100");
		$t=$p=41;
			$bpa='info';
			$bin='success';
		}


		// Add items from a given cart to a given order
		if(isset($_POST['addo']))
		{
			$n=$_POST['n'];
			$i=0;
			while($n>0){
				$item=$_POST["item$n"];
				$qty=$_POST["qty$n"];
			$qty=str_replace(',', '', $qty);
				$pri=$_POST["pri$n"];
				$upri=$_POST["upri$n"];
				$sour=$_POST["sour$n"];
				$type=$_POST["type$n"];
				$cost=$_POST["cost$n"];

				if($qty){
		$so=mysql_query("INSERT INTO `sales` (`Number`, `Date`, `Time`, `Cashier`, `Item`, `Price`, `Quantity`, `Branche`, `Owner`, `Uprice`, `Source`, `Itype`, `Ucost`) VALUES (NULL, '$Date', '$Time', '$loge', '$item', '$pri', '$qty', '$brc', '', '$upri', '$sour', '$type', '$cost')");
					$i++;
				}
			$n--;
			}
			if($i>0)
				$t=$p=0;
			$bin='info';
		}
		

		// Add sides from a given cart to a given order
		if(isset($_POST['addon']))
		{
			$num=$_POST['num'];
			$n=$_POST['k'];
			$qty=$_POST['qty'];
		$dof=mysql_query("DELETE FROM `sales` WHERE `Addon`='$num' AND `Cashier`='$loge' AND `Branche`='$brc' AND `Voucher`='0' AND `Price`='0'");
			while($n>0){
				$item=$_POST["add$n"];
												
		$dop=mysql_query("SELECT *FROM `items` WHERE `Number`='$item' ORDER BY `Number` DESC LIMIT 1");
			$rop=mysql_fetch_assoc($dop);
				$pri=$rop['Price'];
				$upri=$rop['Price'];
				$sour=$rop['Source'];
				$type=$rop['Type'];
				$cost=$rop['Cost'];
		
		$doi=mysql_query("SELECT *FROM `itype` WHERE `Number`='$type' GROUP BY `Type` ORDER BY `Number` ASC");
			$roi=mysql_fetch_assoc($doi);
				$type=$roi['Type'];

				if($item){
		$so=mysql_query("INSERT INTO `sales` (`Number`, `Date`, `Time`, `Cashier`, `Item`, `Price`, `Quantity`, `Branche`, `Owner`, `Uprice`, `Source`, `Itype`, `Addon`, `Ucost`) VALUES (NULL, '$Date', '$Time', '$loge', '$item', '$pri', '$qty', '$brc', '', '$upri', '$sour', '$type', '$num', '$cost')");
				}
			$n--;
			}
			$bin='info';
		}			

// delete an item from a given chart
if(isset($_POST['delo']))
		{
			$num=$_POST['num'];
			$then=mysql_query("DELETE FROM `sales` WHERE `Number`='$num' ORDER BY `Number` ASC LIMIT 1");
			$then=mysql_query("DELETE FROM `sales` WHERE `Addon`='$num' ORDER BY `Number` ASC LIMIT 1");
		}

// Edit an item from a given chart
if(isset($_POST['edit']))
		{
			$num=$_POST['num'];
			$qty=$_POST['qty'];
			$qty=str_replace(',', '', $qty);
			$then=mysql_query("UPDATE `sales` SET `Quantity` = '$qty' WHERE `Number` = '$num' ORDER BY `Number` ASC LIMIT 1");
		}
?>
<div class="container-fluid main-content">
        <div class="page-title">
          <h2 style='margin-top:-20px; margin-bottom: 5px; color:#ffcc33'>
       Sales/Payment
          </h2>
                 </div>
     
        <div class="row">
  <div class="col-lg-2 hidden-print">
   
 <ul class="list-group">

    <li class="list-group-item">
	  <a href="ilist.php">
                <p>
                <i class="lnr lnr-menu-circle"></i>&nbsp;Sales Items
                </p>
              </a></li>

	   <li class="list-group-item">
              <a href="stobranch.php">
                <p>
                <i class="lnr lnr-plus-circle"></i>&nbsp;Store Status
                </p>
              </a></li>         
                       
            </ul>
			<?php
			if($brc>='1'){
				?>
<center>
<?php
if($_SESSION['Phyc']){
?>
			<a href="counte.php" class="btn btn-warning" style="width:100%;"><i class="lnr lnr-layers">&nbsp;Physical Count</i></a>
<?php
}
?>

<?php
if($_SESSION['Moder']){
?>
			<a href="orders.php" class="btn btn-info" style="width:100%;"><i class="lnr lnr-cart">&nbsp;Make Sales Order</i></a>
<?php
}
?>
		</center><br>
  
				 <ul class="list-group">

   <li class="list-group-item" style="border:1px dashed #cccccc; border-radius:5px; margin:0px 0px 4px 0px;">
	  <a href="urepo.php">
                <p>
                <i class="lnr lnr-menu-circle"></i>&nbsp;Sales Report
                </p>
              </a></li> 
			  
			  <li class="list-group-item" style="border:1px dashed #cccccc; border-radius:5px; margin:0px 0px 4px 0px;">
	  <a href="breceive.php">
                <p>
                <i class="lnr lnr-menu-circle"></i>&nbsp;Receiving Report
                </p>
              </a></li> 

			   <li class="list-group-item" style="border:1px dashed #cccccc; border-radius:5px; margin:0px 0px 4px 0px;">
	  <a href="requise.php">
                <p>
                <i class="lnr lnr-menu-circle"></i>&nbsp;Create Requisition<?php
				if($fequox)
					echo"<span class='badge' style='float:right; font-size:12px; margin-right:0px; margin-top:0px; height:18px; background-color:#ffcc66; width:20px;'> $fequox </span>";
					?>
                </p>
              </a></li> 
	</ul>
			  <?php
			}
   ?>
  </div> 
       
        <div class="col-lg-10">
                  <div class="row">
         
           <div class="col-lg-4"> </div>
                           
                       <div class="col-lg-8 hidden-print"><div class="col-lg-1"> 					
					   
					   </div>
             <form action="" method="post"> <div class="col-lg-6"> 
      <input class="form-control" name="custo" type="text" <?php echo $rdn ?> id="searchi" autofocus='autofocus'>
	 			</div>                      
                       
                       <div class="col-lg-2">
         <button class="btn  btn-primary btn-block" type="<?php echo $btn ?>" name="search"><i class="lnr lnr-magnifier"></i> Search </button>
                   
					  </div> <div class="col-lg-2">
                        <button class="btn  btn-success btn-block" type="<?php echo $btn ?>" name="open"><i class="lnr lnr-menu-circle"></i> Items </button>
                   
					  </div> </form>
                         </div>
            </div>

				
			 <div class="row">
            <div class="col-lg-12" style='margin-top:-10px;'><form action="" method="post" class="form-horizontal ">
             <span><button type='submit' class='btn btn-xs btn-<?php echo $bta ?> hidden-print' name='table' style='height:20px; padding:0px; width:80px; margin-left:30px;' title='Table' data-toggle='tooltip' data-placement='top'><i class="lnr lnr-cart"></i> &nbsp;&nbsp; Table </button></span>

			 <span><button type='submit' class='btn btn-xs btn-<?php echo $bin ?> hidden-print' name='orders' style='height:20px; padding:0px; width:80px; margin-left:10px;' title='Orders' data-toggle='tooltip' data-placement='top'><i class="lnr lnr-printer"></i> &nbsp;&nbsp; Orders </button></span>

			 <span><button type='submit' class='btn btn-xs btn-<?php echo $bsa ?> hidden-print' name='invoice' style='height:20px; padding:0px; width:80px; margin-left:10px;' title='Invoice' data-toggle='tooltip' data-placement='top'><i class="lnr lnr-dice"></i> &nbsp;&nbsp; Invoices </button></span>

			 <span><button type='submit' class='btn btn-xs btn-<?php echo $bpa ?> hidden-print' name='payment' style='height:20px; padding:0px; width:80px; margin-left:10px;' title='Payment' data-toggle='tooltip' data-placement='top'><i class="lnr lnr-laptop-phone"></i> Payment </button></span>

			 <span class="pull-right hidden-print" style="color:#ffcc66"><?php echo $bra ?>&nbsp;&nbsp;
			 <?php
			 if($t=='20' AND $_SESSION['Xpri']=='1')
			 echo"<input type='hidden' name='vous' value='$vous'><button class='btn btn-xs btn- hidden-print' name='reprint' title='Click to reprint this order' data-toggle='tooltip' data-placement='top'>
			 <i class='lnr lnr-printer'></i></button>";
			 elseif($t=='41' AND $_SESSION['Xpri']=='1')
			 echo"<input type='hidden' name='vous' value='$vous'><button class='btn btn-xs btn- hidden-print' name='reprinti' title='Click to reprint this invoice' data-toggle='tooltip' data-placement='top'>
			 <i class='lnr lnr-printer'></i></button>";
			 else
			 echo'&nbsp;&nbsp;';
			 ?></span></form><hr style="margin:0px;">
            <div class="widget-container fluid-height clearfix"><div class="widget-content padded clearfix">

               <?php			   
	$dom=mysql_query("DELETE FROM `orders` WHERE `Quantity`='0' ORDER BY `Number` DESC LIMIT 30");

			if($t=='10'){
				include'table.php';
			}

			elseif($t=='20'){
				include'printr.php';
			}

			elseif($t=='30'){
				include'myorder.php';
			}

			elseif($t=='40'){
				include'payment.php';
			}

			elseif($t=='41'){
				include'paid.php';
			}

			elseif($t=='50'){
				include'mysales.php';
			}

			    elseif($t==2){
		$do=mysql_query("SELECT *FROM `items` WHERE `Store`='3' AND `Status`='0' $conde ORDER BY `Number` DESC LIMIT $lim");
				if($fo=mysql_num_rows($do)){
				   ?>
                 
      	 <form action="" method="post" class="form-horizontal "><label style="float:right">
		 <button type="submit" name="addo" class="btn btn-sm btn-info hidden-print" style="width: 50px; height: 50px; 
            padding: 0px 0px 0px 0px; 
            border-radius: 25px; margin-left:-20px;
            font-size: 12px; position: fixed; 
            text-align: center;"><i class="lnr lnr-cart"></i> <br> Add </button></label>
		 
				<table class="table table-striped table-hover">     
                                      <thead>
                    <tr role="row">
                     <th class="hidden-xs"> No </th>
                       <th> Item&nbsp;Name </th>
                        <th> Description </th>
                       <th> Item&nbsp;Type </th>
                       <th>&nbsp;&nbsp;Qty&nbsp;In&nbsp;&nbsp;</th>
						 <th width='5%'> Price </th>
                        <th width='5%'><div align='center'> Quantity </th>
						<th width='5%'> Amount </th>
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
			$qt=$ro['Quanity'];				$qty=number_format($qt, 2);
			$dire=$ro['Direct'];
			$prod=$ro['Production'];
			$store=$ro['Store'];
			$cos=$ro['Cost'];
			$cost=$ro['Price'];	
			$sour=$ro['Source'];
$costo=number_format($cost, 2);
$b=$n*10;

$doi=mysql_query("SELECT *FROM `itype` WHERE `Number`='$kin' ORDER BY `Number` ASC");
		$roi=mysql_fetch_assoc($doi);
				$type=$roi['Type'];
         
		print("<tr>
                        <td class=hidden-xs><div align='center'>$n&nbsp;&nbsp;</td>
						<td> $iname </td><td> $descri </td><td> $type </td><td><div align='center'> $qty </td>
						<td><input name='pri$n' class='form-control' type='text' onkeyup='multiplyBy$n();' onkeypress='return isNumberKey(event)' 
						style='text-align:right; width:80px; height:24px;' id='box$b' value='$cost'></td>
						<td><input name='qty$n' class='form-control' type='text' onkeyup='multiplyBy$n();' onkeypress='return isNumberKey(event)' style='text-align:right; width:80px; height:24px; margin:0px 0px 0px 0px' id='box$n' onclick=this.value='1' autocomplete='off'></td>
		<td width='10%'><div align='right' style='border:1px solid #cccccc; width:80px; height:24px; border-radius:5px; padding:0px 10px 0px 0px;'>
		<input type='hidden' name='item$n' value='$code'><input type='hidden' name='upri$n' value='$cost'>
		<input type='hidden' name='sour$n' value='$sour'><input type='hidden' name='cost$n' value='$cos'>
		
		<span class='dollars' style='text-align:right; width:80px; height:24px; font-size:18px; color:#66cccc; float:center; text-align:right;' id='result$n' onchange='format(this);'></span></div><input type='hidden' name='dire$n' value='$dire'><input type='hidden' name='type$n' value='$type'></td></tr>");
						  $n++;
						}
						$toto=number_format($tot);			$tco=number_format($tco);
						?>
						
                    </tbody>
                  </table>

				   <div class="row">
                  <div class="col-lg-10"><hr></div><div class="col-lg-2">
   <?php echo"<input type='hidden' name='n' value='$n'><input type='hidden' name='vous' value='$vous'><input type='hidden' name='pro' value='$pro'>"; ?>
                 <button class="btn btn-sm btn-block btn-info hidden-print" type="submit" name="addo" style="margin:0px 0px 0px -15px;">
				 <i class="lnr lnr-cart"></i> &nbsp; Add to Cart </button></div></div></form>
				  <?php
				}

else{
						echo"<br><br><br><br><br><br>
						<div style='text-align:center; font-size:24px; color:#ff3333'> Item not found for your search [$custo] </div><br><br><br><br><br><br><br>";
					}  
			}




	
		  // ***************************************** List all item categories for selection *********************************************
				   elseif($t==999){
		$dor=mysql_query("SELECT `Number`, `Type` FROM `itype` WHERE `Location`='1' GROUP BY `Type` ORDER BY `Count` DESC");
				if($for=mysql_num_rows($dor)){
							$n=1;
					while($rop=mysql_fetch_assoc($dor)){
							$num=$rop['Number'];
							$sup=$rop['Type'];

			$dox=mysql_query("SELECT *FROM `items` WHERE `Store`='3' AND `Status`='0' AND `Type`='$num'");
				if($fox=mysql_num_rows($dox)){
					$btn='submit';
					$dso='';
					$bdr="border:1px solid #99ccff;";
					$then=mysql_query("UPDATE `itype` SET `Items`='$fox' WHERE `Number`='$num' AND `Items`!='$fox' LIMIT 1");
				}
				else{
					$btn='button';
					$dso='disabled';
					$bdr='';
				}

		echo"<div class='col-lg-3'><form action='' method='post' class='form-horizontal'>
		<button type='$btn' name='order' class='btn btn-lg btn-block btn-warning' style='margin-bottom:20px; font-size:14px; color:black; $bdr' title='$sup' data-toggle='tooltip' data-placement='top' $dso> $sup 
				<span class='badge' style='float:right; background-color:#99ccff;margin-right:5px; top:0px;'> $n </span><br>
				<input type='hidden' name='typo' value='$num'>
				<font size='1' style='margin:10px 0px 0px 10px; color:#ffff33; float:left;'>
				ITEMS: <font color='#ff0033' size='1'><b> $fox </b></font></font>
				
		<span class='badge' style='float:right; font-size:12px; margin:20px 10px -10px 0px; background-color:#ff66cc;'> </span>
				</button></form></div>";
						$n++;
					}


				}
					else{
						echo"<br><br><br><br><br><br>
						<div style='text-align:center; font-size:24px; color:#ff9999'> Load items to create new order </div><br><br><br><br><br><br><br>";
					}
			}










					   if($t==0){
		$do=mysql_query("SELECT *FROM `sales` WHERE `Status`='0' AND `Upda`='0' AND `Voucher`='0' AND `Cashier`='$loge' AND `Branche`='$brc' AND `Addon`='0' ORDER BY `Number` DESC LIMIT 100");
				if($fo=mysql_num_rows($do)){
				   ?>
             

				<table class="table table-striped table-hover">     
                                      <thead>
                    <tr role="row">
                     <th class="hidden-xs">&nbsp;&nbsp;&nbsp;&nbsp;# </th>
                       <th> Status </th>
                       <th> Owner </th>
                       <th> Due&nbsp;Date </th>
                        <th> Item&nbsp;Name </th>
                       <th> Price </th>
                       <th> Quantity </th>
						<th>Amount</th>
                        <th class="hidden-xs hidden-print" style="width:40px; text-align:center;" colspan='2'> Options </th>
                     </tr>
                    </thead>
                                        <tbody>
					<?php
					$n=1;				$tot=0;	
						while($ro=mysql_fetch_assoc($do)){
							$num=$ro['Number'];
				$vou=$ro['Voucher'];
				$dte=$ro['Date'];
				$user=$ro['Cashier'];
				$pri=$ro['Price'];
				$prio=number_format($pri);
				$qty=$ro['Quantity'];
				$item=$ro['Item'];
				$to=$qty*$pri;
				$too=number_format($to);

	$dop=mysql_query("SELECT *FROM `items` WHERE `Number`='$item' ORDER BY `Number` DESC LIMIT 1");
				$rop=mysql_fetch_assoc($dop);
					$inamu=$rop['Iname'];
					$sour=$rop['Source'];

		print("<tr>
		<td class=hidden-xs><div align='center'><input type='hidden' name='num' value='$num'>
		<a href='#' data-placement='top' data-toggle='modal' data-target='#modal-x3123$n'>
		<button type='submit' class='btn btn-xs btn-info hidden-print' name='edit' style='height:18px; padding:0px; margin:0px;' title='Edit' data-toggle='tooltip' data-placement='top'>&nbsp;&nbsp;<i class='lnr lnr-layers'></i>&nbsp;&nbsp;</button></a>");





		
		// *********************************** Model for kitchen/side addition ****************************************
		
		echo"<div id='modal-x3123$n' class='modal fade' role='dialog'>
  <div class='modal-dialog' role='document'>
    <div class='modal-content'>
      <div class='modal-header'>
        <h5 class='modal-title text-left' id='exampleModalLabel'> $iname </h5>
		<div style='float:right; margin-top:-10px; width:280px; text-align:right; color:blue;' 
		title='Load Balance to Sales' data-toggle='tooltip' data-placement='top'>SIDE ADDITION</div></div>

      <form method='post' action=''><div class='modal-body' style='background-color:#ffffff;'>
       <center><div style='border:1px solid #ddd; border-radius:5px; background-color:#ffffff;'>
	   <table width='98%' style='background-color:#ffffff;'>
	   <tr style='background-color:#ffffff;'><td rowspan='2' width='55%' style='background-color:#ffffff; vertical-align:top;'>
	   <div align='center' style='color:red;'> MAIN </div>";
				
				$k=1;						$add=0;
	   $doni=mysql_query("SELECT *FROM `items` WHERE `Store`='3' AND `Status`='0' AND `Type`='60' AND `Descri`='MAIN' ORDER BY `Iname` ASC LIMIT 100");
			while($roni=mysql_fetch_assoc($doni)){
						$code=$roni['Number'];
						$iname=$roni['Iname'];
				$seki=mysql_query("SELECT `Addon` FROM `sales` WHERE `Item`='$code' AND `Addon`='$num'");
					if($feki=mysql_num_rows($seki)){
						$chk='checked';
						$add++;
					}
					else
						$chk='';
			echo"<div class='text-left' style='background-color:#ffffff;'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 
			<label style='cursor:pointer;'><input name='add$k' type='checkbox' value='$code' $chk> &nbsp; $iname </label></div>";
				$k++;
			}

			echo"</td><td style='background-color:#ffffff; vertical-align:top;'><div align='center' style='color:red;'> VEG. </div>";
				
			//	$k=1;
	   $donie=mysql_query("SELECT *FROM `items` WHERE `Store`='3' AND `Status`='0' AND `Type`='60' AND `Descri`='VEG' ORDER BY `Iname` ASC LIMIT 100");
			while($ronie=mysql_fetch_assoc($donie)){
						$codee=$ronie['Number'];
						$inamee=$ronie['Iname'];
				$sekie=mysql_query("SELECT `Addon` FROM `sales` WHERE `Item`='$codee' AND `Addon`='$num'");
					if($fekie=mysql_num_rows($sekie)){
						$chke='checked';
						$add++;
					}
					else
						$chke='';
			echo"<div class='text-left' style='background-color:#ffffff;'>&nbsp;&nbsp; 
			<label style='cursor:pointer;'><input name='add$k' type='checkbox' value='$codee' $chke> &nbsp; $inamee </label></div>";
				$k++;
			}
					
			echo"<tr style='background-color:#ffffff; vertical-align:top;'><td style='background-color:#ffffff;'>
			<div align='center' style='color:red;'> SAUCE </div>";
				
			//	$k=1;
	   $donia=mysql_query("SELECT *FROM `items` WHERE `Store`='3' AND `Status`='0' AND `Type`='60' AND `Descri`='SAUCE' ORDER BY `Iname` ASC LIMIT 100");
			while($ronia=mysql_fetch_assoc($donia)){
						$codea=$ronia['Number'];
						$inamea=$ronia['Iname'];
				$sekia=mysql_query("SELECT `Addon` FROM `sales` WHERE `Item`='$codea' AND `Addon`='$num'");
					if($fekia=mysql_num_rows($sekia)){
						$chka='checked';
						$add++;
					}
					else
						$chka='';
			echo"<div class='text-left' style='background-color:#ffffff;'>&nbsp;&nbsp; 
			<label style='cursor:pointer;'><input name='add$k' type='checkbox' value='$codea' $chka> &nbsp; $inamea </label></div>";
				$k++;
			}
					
			echo"</tr></table></div>
      </div><input type='hidden' name='k' value='$k'><input type='hidden' name='num' value='$num'><input type='hidden' name='qty' value='$qty'>
      <div class='modal-footer' style='margin-top:-10px; height:50px; padding-top:10px; border:0px solid blue;'>
	   <font color='red' size='2'>Select atleast two options</font> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 
	   &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 

	   <button type='button' class='btn btn-sm btn-warning' data-dismiss='modal'>&nbsp;CLOSE&nbsp;</button>
        <button type='submit' name='addon' class='btn btn-sm btn-success'>ADD-ON</button>
      </div></form>
    </div>
  </div>
</div>";
		
		
		if($sour=='YES'){
			if($add>0)
				$clr="color:blue;";
			else
				$clr="color:red;";
		}
		else
			$clr='';
		
		
		
		print("</td><td style='$clr'><div align='left'> Order </td><td style='$clr'> $user </td><td style='$clr'> $dte </td><td style='$clr'> $inamu </td>

		<td style='padding:0px;'><input name='pri' class='form-control' type='text' onkeyup='format(this);' onkeypress='return isNumberKey(event);' onChange=this.style.color='#ff3366' style='text-align:right; width:80px; height:20px; margin:0px 0px 0px 0px; padding:0px 10px 0px 0px; margin:0px; $clr' value='$prio' readonly></td>

		<td style='padding:0px;'><input name='qty' class='form-control' type='text' onkeyup='format(this);' onkeypress='return isNumberKey(event);' onChange=this.style.color='#ff3366' style='text-align:right; width:80px; height:20px; margin:0px 0px 0px 0px; padding:0px 10px 0px 0px; margin:0px; $clr' value='$qty'></td>
						
		<td style='padding:0px;'><input name='tot' class='form-control' type='text' onkeyup='format(this);' onkeypress='return isNumberKey(event);' onChange=this.style.color='#ff3366' style='text-align:right; width:80px; height:20px; margin:0px 0px 0px 0px; padding:0px 10px 0px 0px; margin:0px; $clr' value='$too' readonly></td>
						
						
				<form method='post' action=''><td class='hidden-xs hidden-print' align='right' style='width:40px; padding:0px;'>
         <input type='hidden' name='num' value='$num'><button type='submit' class='btn btn-xs btn-warning hidden-print' name='edit' style='height:18px; padding:0px; margin:0px;' title='Edit' data-toggle='tooltip' data-placement='top'>&nbsp;&nbsp;<i class='lnr lnr-pencil'></i>&nbsp;&nbsp;</button></td></form>
						  
		 <form method='post' action=''><td class='hidden-xs hidden-print' align='right' style='width:40px; padding:0px;'>
		<input type='hidden' name='num' value='$num'><button type='submit' class='btn btn-xs btn-danger hidden-print' name='delo' style='height:18px; padding:0px; margin:0px;' title='Delete' data-toggle='tooltip' data-placement='top'>
						  &nbsp;&nbsp;<i class='lnr lnr-trash'></i>&nbsp;&nbsp;</button></td></form></tr>");
						  $n++;					$tot+=$to;
						}
						$toto=number_format($tot);			
						?>
						
                    </tbody>
                  </table><hr style='margin-top:-4px;'>

				  <?php
					  // ************************************ Save this order *******************************
				  if($bch)
					  echo"<form method='post' action='login.php'>";
				  else
					  echo"<form method='post' action=''>";
					?>

					<div class="col-md-2"> </div>
<div class="col-md-8"><div id='toggleText' style='display: none;'> &nbsp;&nbsp; Comment Here
<textarea name="comme" class="form-control" style="margin:0px;"> </textarea></div></div>
</div><div class="col-md-2"> </div>
	

	<div class="col-md-12"> </div>
	 <label class="control-label col-md-1" style="text-align:right;"> <button type='button' class='btn btn-md btn-warning hidden-print' name='button' title='Add Comment' data-toggle='tooltip' data-placement='top' onclick="javascript:toggle(); ">&nbsp;&nbsp;<i class='lnr lnr-pencil'></i>&nbsp;&nbsp;</button> </label>

		 <label class="control-label col-md-3">
			  <select class="form-control" name="waiter" required>			
			 <?php
				echo"<option value='$loge' selected='selected'> $loge </option>";
			if($_SESSION['Access']!='6'){
	$doi=mysql_query("SELECT `Fname`,`Lname` FROM `employees` WHERE `Currentp`<='2' ORDER BY `Fname` ASC");
			while($roi=mysql_fetch_assoc($doi)){
				$fna=$roi['Fname'];
				$lna=$roi['Lname'];
			$dst="$fna $lna";
	echo"<option value='$dst' style='height:40px'> $dst </option>";
			}
			}
			?>			    
            </select></label>

	<label class="control-label col-md-2">
<select class="form-control" name='tbl' required></label>
 <?php
				echo"<option value='' selected='selected'> TABLE # </option>";
 $top=mysql_query("SELECT `Name`, `S$brc`, `Date` FROM `tables` ORDER BY `Name` ASC LIMIT 40");
		while($rop=mysql_fetch_assoc($top)){
			$sup=$rop['Name'];
			$sta=$rop["S$brc"];
			if($sta=='1' AND $rop['Date']==$Date){
				$stl="color:#ff66cc;";
				$a1="[";
				$a2="]";
			}
			else{
				$stl=$a1=$a2='';
			}
	echo"<option value='$sup' style='height:40px; $stl'> $a1$sup$a2 </option>";
						}
						?>
</select>
		</label>

<?php
	if($_SESSION['Cancel']=='1')
		echo"<label class='control-label col-md-2'><input name='dato' id='from' class='form-control sm' type='text' style='text-align:center;' VALUE='$Date' onclick='return pageScroll()'></label>";
else
		echo"<label class='control-label col-md-2'><input name='dato' class='form-control sm' type='text' style='text-align:center;' VALUE='$Date' disabled></label>";
	?>
			<label class="control-label col-md-2">
		<div class="input-group">
   <span class="input-group-addon"><?php echo $curre1 ?></span>
   <input name="toto" class="form-control sm" type="text" style="text-align:center;" VALUE="<?php echo $toto ?>" readonly></div></label>

				  <label class="control-label col-md-2">
			 <button class="btn btn-md btn-block btn-info" type="submit" name="receive">
			 <i class="lnr lnr-printer"></i> ORDER </button>
			 </label>
</div>
				  <?php
				}
				 else{
						echo"<br><br><br><br><br><br>
			<div style='text-align:center; font-size:24px; color:powderblue'> Load items to create a new order. </div><br><br><br><br><br><br><br>";
					}  
			}
					?>
                                      
                
              </div>
            </div></div>
                  </div>
      
   </div></div></div>  
   <?php
   include'footer.php';
   ?>
