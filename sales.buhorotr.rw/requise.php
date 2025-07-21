<?php
if(basename($_SERVER['PHP_SELF']) == 'requise.php') 
  $bb=" class='current'";
include'header.php';
include'connection.php';
$custo='';
$conde='';
$t=$p=$locki=0;
 $brc=$_SESSION['BR'];	
 $doib=mysql_query("SELECT `Name` FROM `branches` WHERE `Number`='$brc' ORDER BY `Number` ASC");
			$roib=mysql_fetch_assoc($doib);
				$bra=$roib['Name'];

$fld="S$brc";			

// delete an item from a given chart
if(isset($_POST['delo']))
		{
			$rowid=$_POST['rowid'];
			$vous=$_POST['vous'];
			$item=$_POST['item'];
			$vous=$_POST['vous'];
	$then=mysql_query("UPDATE `requis` SET `Status`='1' WHERE `Item`='$item' AND `Voucher`='$vous' AND `Destin`='$bra' LIMIT 1000");
			$t=$p=1;
		}

// edit an item from a given chart
if(isset($_POST['savere']))
		{
			$n=$_POST['n'];
			$vous=$_POST['vous'];
			if($vous=='0'){
	$rece=mysql_query("SELECT `Voucher` FROM `requis` WHERE `Action`='INTERNAL' ORDER BY `Voucher` DESC LIMIT 1");
				$re=mysql_fetch_assoc($rece);
					$voucher=$re['Voucher']+1;
					$vouchers=$re['Voucher']+2;
			}
		while($n>0){
			$rowid=$_POST["rowid$n"];
			$qty=$_POST["qty$n"];
			$item=$_POST["item$n"];
			$dire=$_POST["dire$n"];
				$qty=str_replace(',', '', $qty);
				if($vous=='0'){
		if($dire=='1')
			$vot=$vouchers;
		else
			$vot=$voucher;
				}
				else
					$vot=$vous;
	$then=mysql_query("UPDATE `requis` SET `Quantity`='$qty', `Voucher`='$vot', `Changed`='1', `Viewed`='1' WHERE `Number`='$rowid' LIMIT 1");
	$then=mysql_query("UPDATE `requis` SET `Quantity`='0', `Voucher`='$vot', `Changed`='1', `Viewed`='1' WHERE `Number`!='$rowid' AND `Item`='$item' AND `Voucher`='$vous' AND `Destin`='$bra' LIMIT 1000");
			$n--;
		}
	//	$t=$p=1;
		}

// search for an item to be added to the chart
if(isset($_POST['search']))
		{
			$custo=$_POST['custo'];
			$vous=$_POST['vous'];
			$pro=$_POST['pro'];
			$p=1;
			$t=2;
		}

// open for a given requisition to mark as taken
if(isset($_POST['open']))
		{
			$vous=$_POST['vous'];
			$pro=$_POST['pro'];
			$locki=$_POST['locki'];
			$t=$p=1;
		}

if($locki=='1')
$dsn="disabled";
else
$dsn='';

		// delete an item from a given chart
if(isset($_POST['deloq']))
		{
			$vous=$_POST['vous'];
		$then=mysql_query("UPDATE `requis` SET `Status`='1' WHERE `Voucher`='$vous' AND `Destin`='$bra' LIMIT 1000");			
			$pro=$_POST['pro'];
		}

		// Add found item to the chart
		if(isset($_POST['addo']))
		{
			$n=$_POST['n'];
			$vous=$_POST['vous'];
			$pro=$_POST['pro'];

			while($n>0){
				$item=$_POST["item$n"];
				$qty=$_POST["qty$n"];
				$pri=$_POST["pri$n"];
				$cost=$_POST["cost$n"];
				$dire=$_POST["dire$n"];
				$prod=$_POST["prod$n"];

				if($qty)
		$so=mysql_query("INSERT INTO `requis` (`Number`, `Date`, `User`, `Item`, `Cost`, `Quantity`, `Price`, `Action`, `Destin`, `Voucher`, `Status`, `Produce`, `Requested`, `Direct`, `Production`) VALUES (NULL, '$Date', '$loge', '$item', '$cost', '$qty', '$pri', 'INTERNAL', '$bra', '$vous', '0', '$pro', '$qty', '$dire', '$prod')");
			$n--;
			}
			$t=$p=1;
		}

$rece=mysql_query("SELECT `Voucher` FROM `stouse` WHERE `Voucher`!='0' ORDER BY `Voucher` DESC LIMIT 1");
				$re=mysql_fetch_assoc($rece);
					$vou=$re['Voucher']+1;

	if($custo){
			$conde="AND (`Iname` LIKE '%$custo%' OR `Descri` LIKE '%$custo%')";
			$lim=100;
		}
		else{
			$conde='';
			$lim=140;
		}

	$requox=mysql_query("SELECT `Voucher` FROM `requis` WHERE `Voucher`!='0' AND `Upda`='0' AND `Status`='0' AND `Destin`='$bra' AND `Viewed`='0' GROUP BY `Voucher` ORDER BY `Voucher` ASC");
			$fequox=mysql_num_rows($requox);

		if($t=='0' AND $fequox){
			$btn="button";
			$rdn="readonly='readonly'";
		}
		else{
			$btn="submit";
			$rdn="";
		}		
?>
<div class="container-fluid main-content">
        <div class="page-title">
          <h2 style='margin-top:-20px; margin-bottom: 5px; color:#ffcc33'>
         Branches
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
	  <a href="creteb.php">
                <p>
                <i class="lnr lnr-menu-circle"></i>&nbsp;Create New Item
                </p>
              </a></li> 

		 <li class="list-group-item">
              <a href="upitem.php">
                <p>
                <i class="lnr lnr-plus-circle"></i>&nbsp;Upload All Items
                </p>
              </a></li>

	 <li class="list-group-item">
	  <a href="bconfig.php">
                <p>
                <i class="lnr lnr-menu-circle"></i>&nbsp;Configurations
				<?php
				if($fcode)
					echo"<span class='badge' style='float:right; font-size:12px; margin-right:0px; margin-top:0px; height:18px; background-color:#cc3366; width:20px;'> $fcode </span>";
					?>
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

			   <li class="list-group-item active" style="border:1px dashed #cccccc; border-radius:5px; margin:0px 0px 4px 0px;">
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
         
           <div class="col-lg-4" style="text-align:center;"> <button type='button' class='btn btn-xs btn-warning hidden-print' style='height:18px; padding:0px;' title="Local Purchase" data-toggle='tooltip' data-placement='top' onclick="window.location.href='requit.php'"> &nbsp;&nbsp;<i class='lnr lnr-chart'></i> PURCHASE &nbsp;&nbsp;</button> </div>
          
         
           

        <form action="" method="post" class="form-horizontal ">                  
                       <div class="col-lg-8 no-print"><div class="col-lg-3"> 					
					   
					   </div>
            <div class="col-lg-6"> 
      <input class="form-control" name="custo" type="text" <?php echo $rdn ?> <?php echo $dsn ?> id="searchu" autofocus='on' required>
	  <?php
		echo"<input type='hidden' name='vous' value='$vous'><input type='hidden' name='pro' value='$pro'>";
		?>
			</div>                      
                       
                       <div class="col-lg-2">
                        <button class="btn  btn-primary btn-block" type="<?php echo $btn ?>" <?php echo $dsn ?> name="search"><i class="lnr lnr-magnifier"></i> Search</button>
                   
					  </div>
                         </div> 
                      
                     
                  
            </form> 
             
               
            </div>
               <?php




















			    if($t==2){
		$do=mysql_query("SELECT *FROM `items` WHERE `Store`<='2' AND `Status`='0' $conde ORDER BY `Number` DESC LIMIT $lim");
				if($fo=mysql_num_rows($do)){
				   ?>
                 
             <div class="row">
            <div class="col-lg-12" style='margin-top:-20px;'>
             <span> &nbsp;&nbsp; Total Records Found : <b><?php echo" $fo " ?></b></span>
			 <span class="pull-right hidden-print"><?php echo $bra ?>&nbsp;&nbsp;<a href="#" onclick="return window.print()" class="hidden-print" title='Click to print' data-toggle='tooltip' data-placement='top'><i class="lnr lnr-printer"></i></a></span>
            <div class="widget-container fluid-height clearfix">
            <div class="widget-content padded clearfix">

								 <form action="" method="post" class="form-horizontal "> 
				<table class="table table-striped table-hover">     
                                      <thead>
                    <tr role="row">
                     <th class="hidden-xs"> NO </th>
                       <th> Item&nbsp;Name </th>
                        <th> Description </th>
                       <th> Item&nbsp;Type </th>
                       <th>&nbsp;&nbsp;Qty&nbsp;In&nbsp;&nbsp;</th>
                       <th> Count&nbsp;Unit </th>
						 <th> Cost&nbsp;Price </th>
                        <th><div align='center'> Quantity </th>
						<th class="hidden-xs hidden-print">Total&nbsp;Amount</th>
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
if($store=='2')			
			$cost=$ro['Price'];	
else			
			$cost=$ro['Cost'];
$costo=number_format($cost, 2);

$doi=mysql_query("SELECT *FROM `itype` WHERE `Number`='$kin' ORDER BY `Number` ASC");
		$roi=mysql_fetch_assoc($doi);
				$type=$roi['Type'];

				$dox=mysql_query("SELECT *FROM `unit` WHERE `Number`='$uno' ORDER BY `Number` ASC");
					$rox=mysql_fetch_assoc($dox);
							$unit=$rox['Unit'];
          $b=$n*10;
		print("<tr>
                        <td class=hidden-xs><div align='center'>$n&nbsp;&nbsp;</td>
						<td> $iname </td><td> $descri </td><td> $type </td><td><div align='right'> $qty </td><td> $unit </td>
						<td><input name='pri$n' class='form-control' type='text' onkeyup='multiplyBy$n();' onkeypress='return isNumberKey(event)' 
						style='text-align:right; width:130px; height:24px;' id='box$b' value='$cost'></td>
						<td><input name='qty$n' class='form-control' type='text' onkeyup='multiplyBy$n();' onkeypress='return isNumberKey(event)' style='text-align:right; width:120px; height:24px; margin:0px 0px 0px 0px' id='box$n'></td>
						<td class='hidden-xs hidden-print' width='10%'><div align='right' style='border:1px solid #cccccc; width:120px; height:24px; border-radius:5px; padding:0px 10px 0px 0px;'><input type='hidden' name='item$n' value='$code'>
	<input type='hidden' name='prod$n' value='$prod'><span class='dollars' style='text-align:right; width:130px; height:24px; font-size:18px; color:#66cccc; float:center; text-align:right;' id='result$n' onchange='format(this);'></span></div>
						<input type='hidden' name='cost$n' value='$cost'><input type='hidden' name='dire$n' value='$dire'></td></tr>");
						  $n++;
						}
						$toto=number_format($tot);			$tco=number_format($tco);
						?>
						
                    </tbody>
                  </table>

				   <div class="row"><br>
                  <div class="col-lg-10"><hr></div><div class="col-lg-2">
   <?php echo"<input type='hidden' name='n' value='$n'><input type='hidden' name='vous' value='$vous'><input type='hidden' name='pro' value='$pro'>"; ?>
                 <button class="btn btn-sm btn-block btn-primary hidden-print" type="submit" name="addo" style="margin:0px 0px 0px -15px;">
				 <i class="lnr lnr-plus-circle"></i> Add to Cart </button>
              </div></div></form>
				  <?php
				}

else{
						echo"<div class='row'>
            <div class='col-lg-12' style='margin-top:-20px;'>
             <span> &nbsp;&nbsp; Store Voucher No : <b> $vou </b></span> <span class='pull-right hidden-print'> $bra &nbsp;&nbsp;<a href='#' onclick='return window.print()' class='hidden-print' title='Click to print' data-toggle='tooltip' data-placement='top'><i class='lnr lnr-printer'></i></a></span>
			 <span class='pull-right hidden-print'> $bra &nbsp;&nbsp;<a href='#' onclick='return window.print()' class='hidden-print' title='Click to print' data-toggle='tooltip' data-placement='top'><i class='lnr lnr-printer'></i></a></span>
            <div class='widget-container fluid-height clearfix'>
            <div class='widget-content padded clearfix'>
			<br><br><br><br><br><br>
						<div style='text-align:center; font-size:24px; color:#ff3333'> Item not found for your search [$custo] </div><br><br><br><br><br><br><br>";
					}  
			}















			   elseif($t==0){
		$do=mysql_query("SELECT *FROM `requis` WHERE `Status`='0' AND `Upda`='0' AND `Destin`='$bra' GROUP BY `Voucher` ORDER BY `Voucher` DESC LIMIT 20");
				if($fo=mysql_num_rows($do)){
				   ?>
                 
             <div class="row">
            <div class="col-lg-12" style='margin-top:-20px;'>
             <span> &nbsp;&nbsp; Total Records Found : <b><?php echo" $fo " ?></b></span> 
			 <span class="pull-right hidden-print"><?php echo $bra ?>&nbsp;&nbsp;<a href="#" onclick="return window.print()" class="hidden-print" title='Click to print' data-toggle='tooltip' data-placement='top'><i class="lnr lnr-printer"></i></a></span>
            <div class="widget-container fluid-height clearfix">
            <div class="widget-content padded clearfix">

								 <form action="" method="post" class="form-horizontal "> 
				<table class="table table-striped table-hover">     
                                      <thead>
                    <tr role="row">
                     <th class="hidden-xs"> NO </th>
                       <th> Voucher&nbsp;No </th>
                       <th> Done&nbsp;By </th>
                       <th> Due&nbsp;Date </th>
                        <th> Source </th>
                        <th> Destination </th>
                       <th> Items </th>
						<th><div align='right'>Total&nbsp;Amount&nbsp;&nbsp;&nbsp;&nbsp;</th>
                        <th class="hidden-xs hidden-print" style="width:40px; text-align:center;" colspan='2'> Options </th>
                     </tr>
                    </thead>
                                        <tbody>
					<?php
					$n=1;		
						while($ro=mysql_fetch_assoc($do)){
				$vou=$ro['Voucher'];
				$dte=$ro['Date'];
				$des=$ro['Destin'];
				$user=$ro['User'];
				$locki=$ro['Locked'];
				$owner=$ro['Owner'];
				$view=$ro['Viewed'];
				$to=0;
$dor=mysql_query("SELECT `Price`, `Produce`, `Direct`, SUM(Quantity) AS 'QTO' FROM `requis` WHERE `Status`='0' AND `Upda`='0' AND `Voucher`='$vou' AND `Destin`='$bra' GROUP BY `Item` ORDER BY `Number` ASC");
			$for=mysql_num_rows($dor);
				while($ror=mysql_fetch_assoc($dor)){
				$pri=$ror['Price'];
				$qty=$ror['QTO'];
				$pro=$ror['Produce'];
				$dire=$ror['Direct'];
				if($dire=='0')
					$sour="MAIN STORE";
				else
					$sour="MARKET";
			$to+=$pri*$qty;
				}			
						$too=number_format($to, 2);

						 if($_SESSION['Cancel']){
			 $dbutn='submit';
			 $disa='';
		 }
		 else{
			 $dbutn='button';
			 $disa='disabled';
		 }
		 if($owner=='SYSTEM')
			 $user="AUTO-REQUISITION";

		if($view=='0')
			$stn="style='padding:1px; color:red;'";
		else
			$stn="style='padding:1px;'";

		print("<tr><td class=hidden-xs $stn><div align='center'>$n&nbsp;&nbsp;</td><td $stn><div align='center'> $vou </td><td $stn> $user </td>
						<td $stn> $dte </td><td $stn> $des </td><td $stn> $sour </td><td class='text-center' $stn> &nbsp;&nbsp; $for </td>
						<td $stn><div align='right'> $too &nbsp;&nbsp; </td>

						<form method=post action=''><td class='hidden-xs hidden-print' align='right' style='width:40px; padding:1px;'>
       <input type='hidden' name='vous' value='$vou'> <input type='hidden' name='dte' value='$dte'> <input type='hidden' name='pro' value='$pro'>
			<input type='hidden' name='locki' value='$locki'><button type='submit' class='btn btn-xs btn-success hidden-print' name='open' style='height:18px; padding:0px; margin:0px;'>&nbsp;&nbsp;<i class='lnr lnr-download'></i>&nbsp;&nbsp;</button></td></form>
						  
						  <form method=post action=''><td class='hidden-xs hidden-print' align='right' style='width:40px; padding:1px;'>
                              <input type='hidden' name='vous' value='$vou'><input type='hidden' name='pro' value='$pro'>
                          <button type='$dbutn' class='btn btn-xs btn-danger hidden-print' name='deloq' style='height:18px; padding:0px; margin:0px;' $disa>
						  &nbsp;&nbsp;<i class='lnr lnr-trash'></i>&nbsp;&nbsp;</button></td></form></tr>");
						  $n++;
						}
						$toto=number_format($tot);			$tco=number_format($tco);
						?>
						
                    </tbody>
                  </table>

				  
				  <?php
				}
				 else{
						echo"<div class='row'>
            <div class='col-lg-12' style='margin-top:-20px;'>
             <span> &nbsp;&nbsp; Requisition Voucher No : <b> $vou </b></span>
			 <span class='pull-right hidden-print'> $bra &nbsp;&nbsp;<a href='#' onclick='return window.print()' class='hidden-print' title='Click to print' data-toggle='tooltip' data-placement='top'><i class='lnr lnr-printer'></i></a></span>
            <div class='widget-container fluid-height clearfix'>
            <div class='widget-content padded clearfix'>
			<br><br><br><br><br><br>
						<div style='text-align:center; font-size:24px; color:#ff3333'> There is no pending requisition </div><br><br><br><br><br><br><br>";
					}  
			}
				   else{
		$dor=mysql_query("SELECT *, SUM(Quantity) AS 'QTY' FROM `requis` WHERE `Status`='0' AND `Voucher`='$vous' AND `Action`='INTERNAL' AND `Upda`='0' AND `DESTIN`='$bra' GROUP BY `Item` ORDER BY `Itype` DESC");
				if($for=mysql_num_rows($dor)){
					?>
		 <div class="row">
            <div class="col-lg-12" style='margin-top:-20px;'>
             <span> &nbsp;&nbsp; Requisition Voucher No : <b><?php echo" $vous " ?></b></span>
			 <span class="pull-right hidden-print"><?php echo $bra ?>&nbsp;&nbsp;<a href="#" onclick="return window.print()" class="hidden-print" title='Click to print' data-toggle='tooltip' data-placement='top'><i class="lnr lnr-printer"></i></a></span>
            <div class="widget-container fluid-height clearfix">
            <div class="widget-content padded clearfix">

		<table class="table table-striped table-hover"><form action='' method='post'>     
                                      <thead>
                    <tr role="row">
                     <th class="hidden-xs"> NO </th>
                       <th> Item&nbsp;Name </th>
                        <th> Description </th>
                       <th> Item&nbsp;Type </th>
                       <th colspan='2'>&nbsp;&nbsp;Qty&nbsp;In&nbsp;&nbsp;</th>
						 <th> Cost&nbsp;Price </th>
						 <th><div align='center'> Request </th>
						 <th><div align='center'> Buffer </th>
                        <th><div align='center'> Given </th>
						<th>Total&nbsp;Amount</th>
                        <th class="hidden-xs hidden-print" style="width:40px; text-align:center;" colspan='2'> Options </th>
                     </tr>
                    </thead>
                                        <tbody>
										<?php
	$n=1;			$tot=0;
					while($ror=mysql_fetch_assoc($dor)){
						$code=$ror['Number'];
						$item=$ror['Item'];
						$sale=$ror['Price'];
						$qt=$ror['QTY'];
						$des=$ror['Destin'];
						$vous=$ror['Voucher'];
						$count=$ror['Count'];
						$chk=$ror['Changed'];
						$rqt=$ror['Requested'];
						$owner=$ror['Owner'];
$locked=$ror['Locked'];
	$do=mysql_query("SELECT *FROM `items` WHERE `Status`='0' AND `Number`='$item' ORDER BY `Number` DESC LIMIT $lim");
		$ro=mysql_fetch_assoc($do);
			$iname=$ro['Iname'];
			$kin=$ro['Type'];
			$descri=$ro['Descri'];
			$uno=$ro['Unit'];	
			$qin=$ro['Quantity'];
			$dire=$ro['Direct'];
			$store=$ro['Store'];
if($store=='2')				
			$cost=$ro['Price'];
else			
			$cost=$ro['Cost'];		

	$qty=number_format($rqt, 2);			$costo=number_format($cost, 2);			$sales=number_format($sale, 2);			$qto=number_format($qt, 2);
			
			if($des=='PRODUCTION A'){
				$burr=$ro['Produ'];
		
		if($burr>$rqt){
				/*	$qto="0.00";
	$then=mysql_query("UPDATE `requis` SET `Quantity`='0', `Changed`='1' WHERE `Item`='$item' AND `Voucher`='$vous' AND `Changed`='0' AND `Action`='INTERNAL' AND `Upda`='0' AND `DESTIN`='$bra' AND `Production`!='PRODUCTION B' LIMIT 1000");
*/
				}
				else{
				/*	$qto=$rqt-$burr;
	$then=mysql_query("UPDATE `requis` SET `Quantity`='$qto', `Changed`='1' WHERE `Number`='$code' AND `Item`='$item' AND `Voucher`='$vous' AND `Changed`='0' AND `Action`='INTERNAL' AND `Upda`='0' AND `DESTIN`='$bra' LIMIT 1000");
	$and=mysql_query("UPDATE `requis` SET `Quantity`='0', `Changed`='1' WHERE `Number`!='$code' AND `Item`='$item' AND `Voucher`='$vous' AND `Changed`='0' AND `Action`='INTERNAL' AND `Upda`='0' AND `DESTIN`='$bra' AND `Production`!='PRODUCTION B' LIMIT 1000");
*/
				}
			}
elseif($des=='PRODUCTION B'){
				$burr=$ro['Prodi'];
		
		if($burr>$rqt){
				/*	$qto="0.00";
	$then=mysql_query("UPDATE `requis` SET `Quantity`='0', `Changed`='1' WHERE `Item`='$item' AND `Voucher`='$vous' AND `Changed`='0' AND `Action`='INTERNAL' AND `Upda`='0' AND `DESTIN`='$bra' AND `Production`!='PRODUCTION B' LIMIT 1000");
*/
				}
				else{
			/*		$qto=$rqt-$burr;
	$then=mysql_query("UPDATE `requis` SET `Quantity`='$qto', `Changed`='1' WHERE `Number`='$code' AND `Item`='$item' AND `Voucher`='$vous' AND `Changed`='0' AND `Action`='INTERNAL' AND `Upda`='0' AND `DESTIN`='$bra' LIMIT 1000");
	$and=mysql_query("UPDATE `requis` SET `Quantity`='0', `Changed`='1' WHERE `Number`!='$code' AND `Item`='$item' AND `Voucher`='$vous' AND `Changed`='0' AND `Action`='INTERNAL' AND `Upda`='0' AND `DESTIN`='$bra' AND `Production`!='PRODUCTION B' LIMIT 1000");
*/
				}
			}
			else{
				$dois=mysql_query("SELECT `Number` FROM `branches` WHERE `Name`='$des' ORDER BY `Number` ASC LIMIT 1");
						$rois=mysql_fetch_assoc($dois);
							$bra=$rois['Number'];
							$buffer="S$bra";
				$burr=$ro["$buffer"];
				}
			
	$burro=number_format($burr, 2);									$qto=number_format($qto, 2);

			if($vous=='0')
				$stn="color:#0000cc;";
			else
				$stn="";

if($burro>$qto)
$stni="border:1px solid #F31734;";
else
$stni="";

$doi=mysql_query("SELECT *FROM `itype` WHERE `Number`='$kin' ORDER BY `Number` ASC");
		$roi=mysql_fetch_assoc($doi);
				$type=$roi['Type'];

				$dox=mysql_query("SELECT *FROM `unit` WHERE `Number`='$uno' ORDER BY `Number` ASC");
					$rox=mysql_fetch_assoc($dox);
							$unit=$rox['Unit'];

	$then=mysql_query("UPDATE `requis` SET `Price`='$cost', `Direct`='$dire' WHERE `Number`='$code' LIMIT 1");

          $to=$cost*$qt;				$too=number_format($to, 2);			$qino=number_format($qin, 2);
		print("<tr title='Number:$code'>
				<td class=hidden-xs style='$stn'><div align='center'>$n&nbsp;&nbsp;</td>
						<td style='$stn'> $iname </td><td style='$stn'> $descri </td><td style='$stn'> $type </td>
						<td style='$stn'><div align='right'> $qino </td>
						<td style='$stn'> $unit </td><td style='$stn'><div align='right'>&nbsp;$costo&nbsp;&nbsp;&nbsp;&nbsp;</td>
						<td style='$stn'><div align='right'><b> $rqt </td><td style='$stn'><div align='right'> $burro </td>
						<td><div align='right'><input name='qty$n' class='form-control' type='text' onkeyup='format(this);' onkeypress='return isNumberKey(event);' onChange=this.style.color='#ff3366' style='text-align:right; width:80px; height:20px; margin:0px 0px 0px 0px; padding:0px 10px 0px 0px; $stn $stni' value='$qto'></td><td style='$stn'><div align='right'>$too&nbsp;&nbsp;&nbsp;&nbsp;</td>				
						
				<td class='hidden-xs hidden-print' align='right' style='width:40px; padding:0px;'>
				<input type='hidden' name='rowid$n' value='$code'><input type='hidden' name='item$n' value='$item'>
				<input type='hidden' name='dire$n' value='$dire'>
                <button type='button' class='btn btn-xs btn-warning hidden-print' name='edit' style='height:18px; padding:0px;' title='Edit' data-toggle='tooltip' data-placement='top' disabled> &nbsp;&nbsp;<i class='lnr lnr-pencil'></i>&nbsp;&nbsp;</button></td>
						  
						  <td class='hidden-xs hidden-print' align='right' style='width:40px; padding:0px;'>
                          <button type='button' class='btn btn-xs btn-danger hidden-print' name='delo' style='height:18px; padding:0px;' title='Delete' data-toggle='tooltip' data-placement='top' disabled>&nbsp;&nbsp;<i class='lnr lnr-trash'></i>&nbsp;&nbsp;</button>
						  <input type='hidden' name='vous' value='$vous'><input type='hidden' name='n' value='$n'></td></tr>");
						  $n++;				$tot+=$to;
						}
						$toto=number_format($tot, 2);			
						?>
						
                    </tbody>

					 <thead>
					<tr><th class="hidden-xs"> </th><th colspan='7'><div align='center'> Grand Total </th>
					<th colspan='3'><div align='right'><?php echo $toto ?>&nbsp;&nbsp;&nbsp;&nbsp;</th><th colspan='2'><div align='center'> -- </th></tr>
                  </table><br>

				  <label class="control-label col-md-1"> </label>

				 <label class="control-label col-md-3"> </label>

	<label class="control-label col-md-3"> </label>

	<label class="control-label col-md-2"> </label>

			 <label class="control-label col-md-2">
<?php
if($locked=='0'){
				 if($owner=='SYSTEM')
					 $bnb="CONFIRM";
				 else
					 $bnb="REQUEST";
?>
	 <button class="btn btn-md btn-block btn-info" type="submit" name="savere"><i class="lnr lnr-plus-circle"></i> <?php echo $bnb ?> </button>
<?php
}
?>
			 </label>

			<label class="control-label col-md-1" style='text-align:right;'>
			  <?php
				  if($n>3 AND $_SESSION['Cancel']=='1' AND $locked=='0'){
				  echo"<input type='hidden' name='vous' value='$vous'>
<button type='submit' class='btn btn-md btn-danger hidden-print' name='deloreq'>&nbsp;&nbsp;<i class='lnr lnr-trash'></i>&nbsp;&nbsp;</button>";
			  }
	?>
			 </label>

		<?php
				}
					else{
						echo"<div class='row'>
            <div class='col-lg-12' style='margin-top:-20px;'>
             <span> &nbsp;&nbsp; Requisition Voucher No : <b> $vou </b></span>
			 <span class='pull-right hidden-print'> $bra &nbsp;&nbsp;<a href='#' onclick='return window.print()' class='hidden-print' title='Click to print' data-toggle='tooltip' data-placement='top'><i class='lnr lnr-printer'></i></a></span>
            <div class='widget-container fluid-height clearfix'>
            <div class='widget-content padded clearfix'>
			<br><br><br><br><br><br>
						<div style='text-align:center; font-size:24px; color:#ff9999'>There is no pending requisition </div><br><br><br><br><br><br><br>";
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
