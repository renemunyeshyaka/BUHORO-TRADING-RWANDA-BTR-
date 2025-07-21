<?php
if(basename($_SERVER['PHP_SELF']) == 'requit.php') 
  $bb=" class='current'";
include'header.php';
include'connection.php';
$custo='';
$conde='';
$t=0;
 $brc=$_SESSION['BR'];		
 $doib=mysql_query("SELECT `Name` FROM `branches` WHERE `Number`='$brc' ORDER BY `Number` ASC");
			$roib=mysql_fetch_assoc($doib);
				$bra=$roib['Name'];
// delete item from a given chart
if(isset($_POST['delo']))
		{
			$rowid=$_POST['rowid'];
			$then=mysql_query("DELETE FROM `stouse` WHERE `Number`='$rowid' LIMIT 1");
		}

// edit an item from a given chart
if(isset($_POST['edit']))
		{
			$rowid=$_POST['rowid'];
			$qty=$_POST['qty'];
				$qty=str_replace(',', '', $qty);
			$then=mysql_query("UPDATE `stouse` SET `Quantity`='$qty' WHERE `Number`='$rowid' LIMIT 1");
		}

// Search for an item to be added to the chart
if(isset($_POST['search']))
		{
			$custo=$_POST['custo'];
			$t=1;
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
		$so=mysql_query("INSERT INTO `stouse` (`Number`, `Date`, `User`, `Item`, `Cost`, `Quantity`, `Price`, `Action`, `Destin`, `Voucher`, `Status`) VALUES (NULL, '$Date', '$loge', '$item', '$cost', '$qty', '$pri', 'BRANCHEP', '$bra', '0', '0')");
			$n--;
			}
		}

		// edit a given voucher from delivery report
if(isset($_POST['edivo']))
		{
			$vous=$_POST['vous'];

			// Update quantity for items that were taken *****************************************************
   $rece=mysql_query("SELECT *FROM `stouse` WHERE `Action`='BRANCHEP' AND `Voucher`='$vous' AND `Upda`='1' AND `Status`='0' ORDER BY `Number` DESC");
   if($fece=mysql_num_rows($rece)){
				while($re=mysql_fetch_assoc($rece)){
					$nuo=$re['Number'];
					$ito=$re['Item'];
					$qto=$re['Quantity'];
					$dest=$re['Destin'];

		$doi=mysql_query("SELECT `Number` FROM `branches` WHERE `Name`='$dest' ORDER BY `Number` DESC LIMIT 1");
		if($foi=mysql_num_rows($doi) OR $dest=='PRODUCTION A' OR $dest=='PRODUCTION B'){
			$roi=mysql_fetch_assoc($doi);
				$br=$roi['Number'];
				if($dest=='PRODUCTION A')
					$bra="Produ";
				elseif($dest=='PRODUCTION B')
					$bra="Prodi";
				else
					$bra="S$br";

	$do=mysql_query("UPDATE `items` SET `Quantity`=`Quantity`+'$qto', `$bra`=`$bra`-'$qto' WHERE `Number`='$ito' ORDER BY `Number` ASC LIMIT 1");
		}
		else{
	$do=mysql_query("UPDATE `items` SET `Quantity`=`Quantity`+'$qto' WHERE `Number`='$ito' ORDER BY `Number` ASC LIMIT 1");
		}

	$then=mysql_query("UPDATE `stouse` SET `Voucher`='0', `Upda`='0', `Closing`='0' WHERE `Number`='$nuo' ORDER BY `Number` ASC LIMIT 1");
				}
   }
		}

	if($custo){
			$conde="AND (`Iname` LIKE '%$custo%' OR `Descri` LIKE '%$custo%')";
			$lim=100;
		}
		else{
			$conde='';
			$lim=140;
		}

		$rece=mysql_query("SELECT `Voucher` FROM `stouse` WHERE `Voucher`!='0' ORDER BY `Voucher` DESC LIMIT 1");
				$re=mysql_fetch_assoc($rece);
					$vou=$re['Voucher']+1;

// Close the current chart
		if(isset($_POST['breceiveb']))
		{
			$taker=$_POST['taker'];
			$dato=$_POST['dato'];
			$invoice=$_POST['invoice'];
			$taker=$_POST['taker'];

	$so=mysql_query("UPDATE `stouse` SET `Date`='$dato', `Voucher`='$vou', `Invoice`='$invoice', `Person`='$taker' WHERE `Status`='0' AND `Voucher`='0' AND `Action`='BRANCHEP' AND `Destin`='$bra'");
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
                <i class="lnr lnr-menu-circle"></i>&nbsp;Items` List
                </p>
              </a></li> 

    <li class="list-group-item">
	  <a href="#">
                <p>
                <i class="lnr lnr-menu-circle"></i>&nbsp;Upload Sales
                </p>
              </a></li> 

	   <li class="list-group-item">
              <a href="stobranch.php">
                <p>
                <i class="lnr lnr-plus-circle"></i>&nbsp;Store Status
                </p>
              </a></li>

		 <li class="list-group-item">
              <a href="upitem.php">
                <p>
                <i class="lnr lnr-plus-circle"></i>&nbsp;Upload Items
                </p>
              </a></li>

	 <li class="list-group-item">
	  <a href="bconfig.php">
                <p>
                <i class="lnr lnr-menu-circle"></i>&nbsp;Configurations
                </p>
              </a></li> 
                       
            </ul><br>
			<?php
			if($brc>='1'){
				?>
<center>
		<?php
if($_SESSION['Phyc']){
?>
			<a href="counte.php" class="btn btn-info"><i class="lnr lnr-layers">&nbsp;Physical Count</i></a>
<?php
}
?>
		</center><br><br>
  
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
         
           <div class="col-lg-4"> </div>
          
         
           

        <form action="" method="post" class="form-horizontal ">                  
                       <div class="col-lg-8 no-print"><div class="col-lg-3"> 					
					   
					   </div>
            <div class="col-lg-6"> 
      <input class="form-control" name="custo" type="text" id="searchu" autofocus="autofocus" required>
			</div>                      
                       
                       <div class="col-lg-2">
                        <button class="btn  btn-primary btn-block" type="submit" name="search"><i class="lnr lnr-magnifier"></i> Search</button>
                   
					  </div>
                         </div> 
                      
                     
                  
            </form> 
             
               
            </div>
               <?php
			   if($t==1){
		$do=mysql_query("SELECT *FROM `items` WHERE `Store`<='2' AND `Status`='0' $conde ORDER BY `Number` DESC LIMIT $lim");
				if($fo=mysql_num_rows($do)){
				   ?>
                 
             <div class="row">
            <div class="col-lg-12" style='margin-top:-20px;'>
             <span> &nbsp;&nbsp; Total Records Found : <b><?php echo" $fo " ?></b></span> <span class="pull-right hidden-print"><?php echo $bra ?>&nbsp;&nbsp;<a href="#" onclick="return window.print()" class="hidden-print" title='Click to print' data-toggle='tooltip' data-placement='top'><i class="lnr lnr-printer"></i></a></span>
            <div class="widget-container fluid-height clearfix">
            <div class="widget-content padded clearfix">

								 <form action="" method="post" class="form-horizontal "> 
				<table class="table table-striped">     
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
$store=$ro['Store'];			
if($store=='1')		
	$cost=$ro['Cost'];
else
	$cost=$ro['Price'];
	
$costo=number_format($cost, 2);

			$qt=$ro['Quantity'];				$qty=number_format($qt, 2);

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
						<span class='dollars' style='text-align:right; width:130px; height:24px; font-size:18px; color:#66cccc; float:center; text-align:right;' id='result$n' onchange='format(this);'></span></div><input type='hidden' name='cost$n' value='$cost'></td></tr>");
						  $n++;
						}
						$toto=number_format($tot);			$tco=number_format($tco);
						?>
						
                    </tbody>
                  </table>

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
             <span> &nbsp;&nbsp; Purchase Voucher No : <b> $vou </b></span> <span class='pull-right hidden-print'> $bra &nbsp;&nbsp;<a href='#' onclick='return window.print()' class='hidden-print' title='Click to print' data-toggle='tooltip' data-placement='top'><i class='lnr lnr-printer'></i></a></span>
            <div class='widget-container fluid-height clearfix'>
            <div class='widget-content padded clearfix'>
			<br><br><br><br><br><br>
						<div style='text-align:center; font-size:24px; color:#ff3333'> Item not found found for your search [$custo] </div><br><br><br><br><br><br><br>";
					}  
			}
				   else{
		$dor=mysql_query("SELECT *FROM `stouse` WHERE `Status`='0' AND `Voucher`='0' AND `Action`='BRANCHEP' AND `Destin`='$bra' ORDER BY `Number` DESC");
				if($for=mysql_num_rows($dor)){
			  $click=0;
?>
 <div class="row">
            <div class="col-lg-12" style='margin-top:-20px;'>
             <span> &nbsp;&nbsp; Purchase Voucher No : <b><?php echo" $vou " ?></b></span> <span class="pull-right hidden-print"><?php echo $bra ?>&nbsp;&nbsp;<a href="#" onclick="return window.print()" class="hidden-print" title='Click to print' data-toggle='tooltip' data-placement='top'><i class="lnr lnr-printer"></i></a></span>
            <div class="widget-container fluid-height clearfix">
            <div class="widget-content padded clearfix">

<table class="table table-striped">     
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
						$cost=$ror['Cost'];	
						$qt=$ror['Quantity'];
						$dst=$ror['Destin'];
						$dte=$ror['Date'];
						$pers=$ror['Person'];
$pri=$ror['Price'];
	$do=mysql_query("SELECT *FROM `items` WHERE `Status`='0' AND `Number`='$item' ORDER BY `Number` DESC LIMIT $lim");
		$ro=mysql_fetch_assoc($do);
			$iname=$ro['Iname'];
			$kin=$ro['Type'];
			$descri=$ro['Descri'];
			$uno=$ro['Unit'];	
			$qin=$ro['Quantity'];
			
			$qty=number_format($qt, 2);			$costo=number_format($cost, 2);				$prio=number_format($pri, 2);			

$doi=mysql_query("SELECT *FROM `itype` WHERE `Number`='$kin' ORDER BY `Number` ASC");
		$roi=mysql_fetch_assoc($doi);
				$type=$roi['Type'];

				$dox=mysql_query("SELECT *FROM `unit` WHERE `Number`='$uno' ORDER BY `Number` ASC");
					$rox=mysql_fetch_assoc($dox);
							$unit=$rox['Unit'];
							if($cost==$sale)
								$arr="";
							elseif($cost>$sale)
								$arr="<i class='lnr lnr-arrow-down'></i>";
							else
								$arr="<i class='lnr lnr-arrow-up'></i>";
          $to=$pri*$qt;				$too=number_format($to, 2);			$qino=number_format($qin, 2);

		  if($qin<$qt){
			  $stl="";
		  }
		  else{
			  $stl='';
		  }
		print("<tr><form action='' method='post'>
                        <td $stl class=hidden-xs><div align='center'>$n&nbsp;&nbsp;</td>
						<td $stl> $iname </td><td $stl> $descri </td><td $stl> $type </td><td $stl><div align='right'> $qino </td>
						<td $stl> $unit </td><td $stl><div align='right'>&nbsp;$prio&nbsp;&nbsp;&nbsp;&nbsp;</td>
						<td $stl><div align='right'><input name='qty' class='form-control' type='text' onkeyup='format(this);' onkeypress='return isNumberKey(event)' onChange=this.style.color='#ff3366' style='text-align:right; width:80px; height:24px; margin:0px 0px 0px 0px;' value='$qty'></td><td $stl><div align='right'>$too</td>
						
						
						<td class='hidden-xs hidden-print' align='right' style='width:40px; padding:0px;'>
                              <input type='hidden' name='rowid' value='$code'>
                          <button type='submit' class='btn btn-xs btn-warning hidden-print' name='edit' style='height:18px; padding:0px;' title='Edit' data-toggle='tooltip' data-placement='top'>
						  &nbsp;&nbsp;<i class='lnr lnr-pencil'></i>&nbsp;&nbsp;</button></td></form>
						  
						  <form method=post action=''><td class='hidden-xs hidden-print' align='right' style='width:40px; padding:0px;'>
                              <input type='hidden' name='rowid' value='$code'>
                          <button type='submit' class='btn btn-xs btn-danger hidden-print' name='delo' style='height:18px; padding:0px;' title='Delete' data-toggle='tooltip' data-placement='top'>
						  &nbsp;&nbsp;<i class='lnr lnr-trash'></i>&nbsp;&nbsp;</button></td></form></tr>");
						  $n++;				$tot+=$to;
						}
						$toto=number_format($tot, 2);			
						?>
						
                    </tbody>

					 <thead>
					<tr><th class="hidden-xs"> </th><th colspan='5'><div align='center'> Grand Total </th>
					<th colspan='3'><div align='right'><?php echo $toto ?></th><th colspan='2'><div align='center'> -- </th></tr>
                  </table><br>
		
			<label class="control-label col-md-4"> </label>

				  <form method='post' action=''><label class="control-label col-md-2">
			 <select class="form-control" name="invoice" required>			
			 <?php
				echo"<option value='' selected='selected'> INVOICE TYPE </option>";
			echo"<option value='VAT INCLUDED'> VAT INCLUDED </option><option value='VAT EXCLUDED'> VAT EXCLUDED </option>
			<option value='NO INVOICE'> NO INVOICE </option>
			    
            </select><input type='hidden' name='rowid' value='$code'><input type='hidden' name='dst' value='$dst'>";
			?></label>


	<label class="control-label col-md-2">
<input list="take" name="taker" class="form-control" placeholder="BOUGHT BY" OnKeyup="return cUpper(this);" required></label>
<datalist id="take">
 <?php
			 $top=mysql_query("SELECT `Person` FROM `stouse` WHERE `Status`='0' AND `Person`!='' GROUP BY `Person` ORDER BY `Date` DESC LIMIT 20");
						while($rop=mysql_fetch_assoc($top)){
							$sup=$rop['Person'];
				if($pers==$sup)
					$t='selected';
				else
					$t='';
			echo"<option value='$sup' $t>";
						}
						?>
</datalist>
		</label>

	<label class="control-label col-md-2"><input name="dato" id="from" class="form-control sm" type="text" style="text-align:center;" VALUE="<?php echo $dte ?>" onclick="return pageScroll()"></label>
<?php
		
			$btl='submit';
$tle="title='Save' data-toggle='tooltip' data-placement='top'";

	?>
			 <label class="control-label col-md-2">
			 <button class="btn btn-md btn-block btn-info" type="<?php echo $btl ?>" name="breceiveb" <?php echo $tle ?>>
			 <i class="lnr lnr-plus-circle"></i> RECEIVE </button>
			 </label>

		<?php
				}
					else{
						echo"<div class='row'>
            <div class='col-lg-12' style='margin-top:-20px;'>
             <span> &nbsp;&nbsp; Purchase Voucher No : <b> $vou </b></span> <span class='pull-right hidden-print'> $bra &nbsp;&nbsp;<a href='#' onclick='return window.print()' class='hidden-print' title='Click to print' data-toggle='tooltip' data-placement='top'><i class='lnr lnr-printer'></i></a></span>
            <div class='widget-container fluid-height clearfix'>
            <div class='widget-content padded clearfix'>
			<br><br><br><br><br><br>
	<div style='text-align:center; font-size:24px; color:#ff9999'>Load purchased items</div><br><br><br><br><br><br><br>";
					}
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
