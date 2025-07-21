<?php
if(basename($_SERVER['PHP_SELF']) == 'receive.php') 
  $nv=" class='current'";
include'header.php';
include'connection.php';
$custo='';
$conde='';

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
			$pri=$_POST['pri'];
				$pri=str_replace(',', '', $pri);
			$then=mysql_query("UPDATE `stouse` SET `Quantity`='$qty', `Price`='$pri' WHERE `Number`='$rowid' LIMIT 1");
		}


		// delete the whole requisition
if(isset($_POST['delos']))
		{
			$rowid=$_POST['rowid'];
	$rece=mysql_query("SELECT `Item`, `Quantity` FROM `stouse` WHERE `Voucher`='$rowid' AND `Action`='RECEIVE' ORDER BY `Number` ASC LIMIT 100");
				while($re=mysql_fetch_assoc($rece)){
					$item=$re['Item'];
					$qty=$re['Quantity'];
	$doin=mysql_query("UPDATE `items` SET `Quantity`=`Quantity`-'$qty' WHERE `Number`='$item' ORDER BY `Number` DESC LIMIT 1");
				}
			$then=mysql_query("DELETE FROM `stouse` WHERE `Voucher`='$rowid' AND `Action`='RECEIVE' LIMIT 100");

		}

// delete the whole requisition
if(isset($_POST['edits']))
		{
			$rowid=$_POST['rowid'];
	
	$rece=mysql_query("SELECT `Item`, `Quantity` FROM `stouse` WHERE `Voucher`='$rowid' AND `Action`='RECEIVE' ORDER BY `Number` ASC LIMIT 100");
				while($re=mysql_fetch_assoc($rece)){
					$item=$re['Item'];
					$qty=$re['Quantity'];
	$doin=mysql_query("UPDATE `items` SET `Quantity`=`Quantity`-'$qty' WHERE `Number`='$item' ORDER BY `Number` DESC LIMIT 1");
				}
			$then=mysql_query("UPDATE `stouse` SET `Voucher`='0' WHERE `Voucher`='$rowid' AND `Action`='RECEIVE' LIMIT 100");
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
		$so=mysqli_query($conn, "INSERT INTO `stouse` (`Date`, `User`, `Item`, `Quantity`, `Price`, `Destin`, `Action`, `Voucher`, `Status`, `Store`) VALUES ('$Date', '$loge', '$item', '$qty', '$pri', '', 'RECEIVE', '0', '0', '1')");
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

		$rece=mysql_query("SELECT `Voucher` FROM `stouse` WHERE `Voucher`!='0' ORDER BY `Voucher` DESC LIMIT 1");
				$re=mysql_fetch_assoc($rece);
					$vou=$re['Voucher']+1;

// Close the current chart
		if(isset($_POST['receive']))
		{
			$taker=$_POST['taker'];
			$dato=$_POST['dato'];
			$invoice=$_POST['invoice'];
			$taker=$_POST['taker'];

	$so=mysql_query("UPDATE `stouse` SET `Date`='$dato', `Voucher`='$vou', `Invoice`='$invoice', `Destin`='$taker', `Store`='1' WHERE `Status`='0' AND `Voucher`='0' AND `Action`='RECEIVE'");

	$rece=mysql_query("SELECT `Item`, `Quantity` FROM `stouse` WHERE `Voucher`='$vou' AND `Action`='RECEIVE' ORDER BY `Number` ASC LIMIT 100");
				while($re=mysql_fetch_assoc($rece)){
					$item=$re['Item'];
					$qty=$re['Quantity'];
	$doin=mysql_query("UPDATE `items` SET `Quantity`=`Quantity`+'$qty' WHERE `Number`='$item' ORDER BY `Number` DESC LIMIT 1");
				}
		}
?>
<div class="container-fluid main-content">
        <div class="page-title">
          <h2 style='margin-top:-20px; margin-bottom: 5px; color:#ffcc33'>
         Materials
          </h2>
                 </div>
     
        <div class="row">
  <div class="col-lg-2 hidden-print">
   
   <ul class="list-group">

   

    <li class="list-group-item">
	  <a href="store.php">
                <p>
                <i class="lnr lnr-menu-circle"></i>&nbsp;Store Status
                </p>
              </a></li> 

	   <li class="list-group-item">
              <a href="#" data-toggle='modal' data-target='#myModo'>
                <p>
                <i class="lnr lnr-plus-circle"></i>&nbsp;Create New Item
                </p>
              </a></li> 
                  
			  <li class="list-group-item">
              <a href="requit.php">
                <p>
                <i class="lnr lnr-plus-circle"></i>&nbsp;Requisition Forms
                </p>
              </a></li>
                  
			  <li class="list-group-item active">
              <a href="receive.php">
                <p>
                <i class="lnr lnr-plus-circle"></i>&nbsp;Receive Items
                </p>
              </a></li>
                  
			  <li class="list-group-item">
              <a href="#" data-toggle='modal' data-target='#myModos'>
                <p>
                <i class="lnr lnr-plus-circle"></i>&nbsp;Used Items
                </p>
              </a></li>
	</ul>
  </div>
                    
           
       
        <div class="col-lg-10">
                  <div class="row">
         
           <div class="col-lg-4"> </div>
          
         
           

        <form action="" method="post" class="form-horizontal ">                  
                       <div class="col-lg-8 no-print"><div class="col-lg-3"> 					
					   
					   </div>
            <div class="col-lg-6 hidden-print"> 
      <input class="form-control" name="custo" type="text" id="search" autofocus="autofocus" list="item" required>
	  <datalist id="item">
	  <?php
	$select =mysqli_query($conn, "SELECT * FROM `items` WHERE `Status` = '0' GROUP BY `Item` ORDER BY `Item` ASC");
while ($row=mysqli_fetch_array($select)) 
{
 echo"<option value=".$row['Item'].">";
}
	  ?>
		</datalist></div>                      
                       
                       <div class="col-lg-2 hidden-print">
                        <button class="btn  btn-primary btn-block" type="submit" name="search"><i class="lnr lnr-magnifier"></i> Search</button>
                   
					  </div> </form> 
                         </div> 
                      
                     
                  
           
             
               
            </div>
               <?php
			   if($t==1){
		$do=mysql_query("SELECT *FROM `items` WHERE `Status`='0' $conde ORDER BY `Number` DESC LIMIT $lim");
				if($fo=mysql_num_rows($do)){
				   ?>
                 
             <div class="row">
            <div class="col-lg-12" style='margin-top:-20px;'>
             <span> &nbsp;&nbsp; Total Records Found : <b><?php echo" $fo " ?></b></span> 
			 <span class="pull-right hidden-print"><a href="#" onclick="return window.print()" class="hidden-print" title='Click to print' data-toggle='tooltip' data-placement='top'><i class="lnr lnr-printer"></i></a></span> &nbsp;&nbsp;&nbsp;&nbsp;
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
				$iname=$ro['Item'];
			$type=$ro['Type'];
			$descri=$ro['Descri'];
	$cost=$ro['Price'];
	
$costo=number_format($cost, 2);

			$qt=$ro['Quantity'];				$qty=number_format($qt, 2);
          $b=$n*10;
		print("<tr>
                        <td class=hidden-xs><div align='center'>$n&nbsp;&nbsp;</td>
						<td> $iname </td><td> $descri </td><td> $type </td><td><div align='right'> $qty </td>
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
             <span> &nbsp;&nbsp; Receiving Voucher No : <b> $vou </b></span> <span class='pull-right hidden-print'> $bra &nbsp;&nbsp;<a href='#' onclick='return window.print()' class='hidden-print' title='Click to print' data-toggle='tooltip' data-placement='top'><i class='lnr lnr-printer'></i></a></span>
            <div class='widget-container fluid-height clearfix'>
            <div class='widget-content padded clearfix'>
			<br><br><br><br><br><br>
						<div style='text-align:center; font-size:24px; color:#ff3333'> Item not found [$custo] </div><br><br><br><br><br><br><br>";
					}  
			}
				   else{
		$dor=mysql_query("SELECT *FROM `stouse` WHERE `Status`='0' AND `Voucher`='0' AND `Action`='RECEIVE' ORDER BY `Number` DESC");
				if($for=mysql_num_rows($dor)){
			  $click=0;
?>
 <div class="row">
            <div class="col-lg-12" style='margin-top:-20px;'>
             <span> &nbsp;&nbsp; Receiving Voucher No : <b><?php echo" $vou " ?></b></span> 
			 <span class="pull-right hidden-print"><a href="#" onclick="return window.print()" class="hidden-print" title='Click to print' data-toggle='tooltip' data-placement='top'><i class="lnr lnr-printer"></i></a></span> &nbsp;&nbsp;&nbsp;&nbsp;
            <div class="widget-container fluid-height clearfix">
            <div class="widget-content padded clearfix">

<table class="table table-striped table-hover">     
                                      <thead>
                    <tr role="row">
                     <th class="hidden-xs"> NO </th>
                       <th> Item&nbsp;Name </th>
                        <th> Description </th>
                       <th> Item&nbsp;Type </th>
                       <th>&nbsp;&nbsp;Qty&nbsp;In&nbsp;&nbsp;</th>
						 <th> Price&nbsp;Per&nbsp;Unit </th>
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
						$qt=$ror['Quantity'];
						$dst=$ror['Destin'];
						$dte=$ror['Date'];
						$pri=$ror['Price'];
	$do=mysql_query("SELECT *FROM `items` WHERE `Status`='0' AND `Number`='$item' ORDER BY `Number` DESC");
		$ro=mysql_fetch_assoc($do);
			$iname=$ro['Item'];
			$type=$ro['Type'];
			$descri=$ro['Descri'];
			$qin=$ro['Quantity'];
			
			$qty=number_format($qt, 2);			$costo=number_format($cost, 2);				$prio=number_format($pri, 2);

							if($cost==$sale)
								$arr="";
							elseif($cost>$sale)
								$arr="<i class='lnr lnr-arrow-down'></i>";
							else
								$arr="<i class='lnr lnr-arrow-up'></i>";
          $to=$pri*$qt;				$too=number_format($to, 2);			$qino=number_format($qin, 2);

		  if($qin<$qt){
			  $stl="style='padding:1px;'";
		  }
		  else{
			  $stl="style='padding:1px;'";
		  }
		print("<tr><form action='' method='post'>
                        <td $stl class=hidden-xs><div align='center'>$n&nbsp;&nbsp;</td>
						<td $stl> $iname </td><td $stl> $descri </td><td $stl> $type </td>
						<td $stl><div align='right'> $qino </td><td $stl><div align='right'><input name='pri' class='form-control' type='text' onkeyup='format(this);' onkeypress='return isNumberKey(event)' onChange=this.style.color='#ff3366' style='text-align:right; width:100px; height:24px; margin:0px 0px 0px 0px;' value='$prio'></td>
						<td $stl><div align='right'><input name='qty' class='form-control' type='text' onkeyup='format(this);' onkeypress='return isNumberKey(event)' onChange=this.style.color='#ff3366' style='text-align:right; width:80px; height:24px; margin:0px 0px 0px 0px;' value='$qty'></td><td $stl><div align='right'>$too</td>
						
						
						<td class='hidden-xs hidden-print' align='right' style='width:40px; padding:0px;'>
                              <input type='hidden' name='rowid' value='$code'>
                          <button type='submit' class='btn btn-xs btn-warning hidden-print' name='edit' style='height:24px; padding:0px; margin:2px;' title='Edit' data-toggle='tooltip' data-placement='top'>
						  &nbsp;&nbsp;<i class='lnr lnr-pencil'></i>&nbsp;&nbsp;</button></td></form>
						  
						  <form method=post action=''><td class='hidden-xs hidden-print' align='right' style='width:40px; padding:0px;'>
                              <input type='hidden' name='rowid' value='$code'>
                          <button type='submit' class='btn btn-xs btn-danger hidden-print' name='delo' style='height:24px; padding:0px; margin:2px;' title='Delete' data-toggle='tooltip' data-placement='top'>
						  &nbsp;&nbsp;<i class='lnr lnr-trash'></i>&nbsp;&nbsp;</button></td></form></tr>");
						  $n++;				$tot+=$to;
						}
						$toto=number_format($tot, 2);			
						?>
						
                    </tbody>

					 <thead>
					<tr><th class="hidden-xs"> </th><th colspan='4'><div align='center'> Grand Total </th>
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
<input list="take" name="taker" class="form-control" placeholder="SUPPLIER" OnKeyup="return cUpper(this);" required></label>
<datalist id="take">
 <?php
			 $top=mysql_query("SELECT `Destin` FROM `stouse` WHERE `Status`='0' AND `Destin`!='' GROUP BY `Destin` ORDER BY `Date` DESC LIMIT 20");
						while($rop=mysql_fetch_assoc($top)){
							$sup=$rop['Destin'];
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
			 <button class="btn btn-md btn-block btn-info" type="<?php echo $btl ?>" name="receive" <?php echo $tle ?>>
			 <i class="lnr lnr-plus-circle"></i> RECEIVE </button>
			 </label>

		<?php
				}
					else{
$dor=mysql_query("SELECT `stouse`.*, SUM(`Quantity`*`Price`) AS 'Tot', COUNT(DISTINCT(Item)) AS 'Ite' FROM `stouse` WHERE `Status`='0' AND `Voucher`!='0' AND `Action`='RECEIVE' GROUP BY `Voucher` ORDER BY `Number` DESC LIMIT 15");
				if($for=mysql_num_rows($dor)){
?>
 <div class="row">
            <div class="col-lg-12" style='margin-top:-20px;'>
             <span> &nbsp;&nbsp; Total Records Found : <b><?php echo" $for " ?></b></span> 
			 <span class="pull-right hidden-print"><a href="#" onclick="return window.print()" class="hidden-print" title='Click to print' data-toggle='tooltip' data-placement='top'><i class="lnr lnr-printer"></i></a></span> &nbsp;&nbsp;&nbsp;&nbsp;
            <div class="widget-container fluid-height clearfix">
            <div class="widget-content padded clearfix">

<table class="table table-striped table-hover">     
                                      <thead>
                    <tr role="row">
                     <th class="hidden-xs"> NO </th>
                       <th class='text-center'> Due&nbsp;Date </th>
                        <th> Supplier </th>
                        <th> System&nbsp;User </th>
                       <th> Items </th><th> Invoice </th>
						<th class='text-right'>Total&nbsp;Amount&nbsp;&nbsp;&nbsp;&nbsp;</th>
                        <th class="hidden-xs hidden-print" style="width:40px; text-align:center;" colspan='3'> Options </th>
                     </tr>
                    </thead>
                                        <tbody>
										<?php
	$n=1;			$tot=0;
					while($ror=mysql_fetch_assoc($dor)){
						$code=$ror['Voucher'];
						$date=$ror['Date'];
						$user=$ror['User'];
						$tot=$ror['Tot'];
						$ite=$ror['Ite'];
						$des=$ror['Destin'];
						$invo=$ror['Invoice'];
						
						$toto=number_format($tot, 2);			$stl="style='padding:1px;'";
		  
		print("<tr><td $stl class=hidden-xs><div align='center'>$n&nbsp;&nbsp;</td>
						<td class='text-center' $stl> $date </td><td $stl> $des </td><td $stl> $user </td>
						<td class='text-center' $stl> $ite </td><td class='text-left' $stl> $invo </td>
						<td $stl><div align='right'> $toto&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>");
						
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
						
						print("<form action='recedoc.php' method='post'><td class='hidden-xs hidden-print' align='right' style='width:40px; padding:0px;'>
                              <input type='hidden' name='rowid' value='$code'><button type='submit' class='btn btn-xs btn-info hidden-print' name='opens' style='height:24px; padding:0px; margin:2px;' title='Open' data-toggle='tooltip' data-placement='top'>
						  &nbsp;&nbsp;<i class='lnr lnr-download'></i>&nbsp;&nbsp;</button></td></form>						
						
								<form action='' method='post'>
						<td class='hidden-xs hidden-print' align='right' style='width:40px; padding:0px;'>
                              <input type='hidden' name='rowid' value='$code'><button type='submit' class='btn btn-xs btn-warning hidden-print' name='edits' style='height:24px; padding:0px; margin:2px;' title='Edit' data-toggle='tooltip' data-placement='top'>
						  &nbsp;&nbsp;<i class='lnr lnr-pencil'></i>&nbsp;&nbsp;</button></td>
						  
						  <form method=post action=''><td class='hidden-xs hidden-print' align='right' style='width:40px; padding:0px;'>
                              <input type='hidden' name='rowid' value='$code'><button type='submit' class='btn btn-xs btn-danger hidden-print' style='height:24px; padding:0px; margin:2px;' data-toggle='modal' data-target='#exampleModal$n'>
						  &nbsp;&nbsp;<i class='lnr lnr-trash'></i>&nbsp;&nbsp;</button></td></form></tr>");
						  $n++;				$tot+=$to;
						}
						$toto=number_format($tot, 2);			
						?>
						
                    </tbody>

					 <thead>
					<tr><th class="hidden-xs"> </th><th colspan='4'><div align='center'> Grand Total </th>
					<th colspan='2'><div align='right'><?php echo $toto ?>&nbsp;&nbsp;&nbsp;</th>
					<th class="hidden-xs hidden-print" colspan='3'><div align='center'> -- </th></tr>
                  </table><br>

				  <?php




				}
				else
						echo"<div class='row'>
            <div class='col-lg-12' style='margin-top:-20px;'>
             <span> &nbsp;&nbsp; Receiving Voucher No : <b> $vou </b></span> <span class='pull-right hidden-print'> $bra &nbsp;&nbsp;<a href='#' onclick='return window.print()' class='hidden-print' title='Click to print' data-toggle='tooltip' data-placement='top'><i class='lnr lnr-printer'></i></a></span>
            <div class='widget-container fluid-height clearfix'>
            <div class='widget-content padded clearfix'>
			<br><br><br><br><br><br>
	<div style='text-align:center; font-size:24px; color:#ff9999'>Load items to be purchased</div><br><br><br><br><br><br><br>";
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
