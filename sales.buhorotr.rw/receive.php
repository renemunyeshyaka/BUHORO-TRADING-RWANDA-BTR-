<?php
if(basename($_SERVER['PHP_SELF']) == 'receive.php') 
  $pp=" class='current'";
include'connection.php';
$custo='';
$conde='';
$t=0;


	// add a comment
if(isset($_POST['addco']) AND $_POST['form_token'] == $_SESSION['form_token'])
		{
				$comme=str_replace("'", "`", $_POST['comme']);
	$doin=mysql_query("UPDATE `stouse` SET `Comment` = '$comme' WHERE `Status`='0' AND `Voucher`='0' AND `Action`='RECEIVE' ORDER BY `Number` DESC");		
		}
// Close the current chart
		if(isset($_POST['receive']))
		{
			$supplier=$_POST['supplier'];
			$dato=$_POST['dato'];
			$invoice=$_POST['invoice'];
			$store=$_POST['store'];
			
		$rece=mysql_query("SELECT `Voucher` FROM `stouse` WHERE `Voucher`!='0' ORDER BY `Voucher` DESC LIMIT 1");
				$re=mysql_fetch_assoc($rece);
					$vou=$re['Voucher']+1;
					
	$so=mysql_query("UPDATE `stouse` SET `Date`='$dato', `Time`='$Time', `Destin`='$supplier', `Voucher`='$vou', `Invoice`='$invoice', `Store`='$store' WHERE `Status`='0' AND `Voucher`='0' AND `Action`='RECEIVE'");

			$then=mysql_query("UPDATE `suppliers` SET `Cdate`='$dato' WHERE `Supplier`='$supplier' LIMIT 1");

		$sepa=mysql_query("SELECT `Number`, `Date`, `Amount` FROM `payment` WHERE `Customer`='$supplier' AND `Status`='0' AND `Voucher`>='2147483647' AND `Action`='PURCHASE' AND `Payment`='10' ORDER BY `Number` DESC");
			while($repa=mysql_fetch_assoc($sepa)){
				$dte=$repa['Date'];
				$adva=$repa['Amount'];
				$nuos=$repa['Number'];

	$sso=mysql_query("INSERT INTO `supay` (`Number`, `Date`, `Payno`, `Docno`, `Amount`, `Supplier`) VALUES (NULL, '$dte', '$nuos', '$vou', '$adva', '$supplier')");

	$and=mysql_query("UPDATE `payment` SET `Payment`='2' WHERE `Number` = '$nuos' AND `Status`='0' ORDER BY `Number` ASC");
			}

				// Update quantity when there is new receive *********************************************************
   $rece=mysql_query("SELECT *FROM `stouse` WHERE `Action`='RECEIVE' AND `Voucher`='$vou' AND `Upda`='0' AND `Status`='0' ORDER BY `Voucher` DESC LIMIT 1000");
    if($fece=mysql_num_rows($rece)){
				while($re=mysql_fetch_assoc($rece)){
					$nuo=$re['Number'];
					$ito=$re['Item'];
					$qto=$re['Quantity'];
					$pri=$re['Price'];
					$sal=$re['Sales'];
					$req=$re['Requis'];
					$stor=$re['Store'];

	$do=mysql_query("UPDATE `items` SET `$stor`=`$stor`+'$qto', `Cost`='$pri', `Price`='$sal', `Star`=`Star`+'1' WHERE `Number`='$ito' ORDER BY `Number` ASC LIMIT 1");

			$dov=mysql_query("SELECT *FROM `items` WHERE `Number`='$ito' ORDER BY `Number` DESC LIMIT 1");
				$rov=mysql_fetch_assoc($dov);
						$qty=$rov["$stor"];
	$then=mysql_query("UPDATE `stouse` SET `Upda`='1', `Closing`='$qty' WHERE `Number`='$nuo' ORDER BY `Number` ASC LIMIT 1");
				
	$dou=mysql_query("UPDATE `stouse` SET `Requis`='1' WHERE `Voucher`='$req' AND `Action`='PURCHASE' ORDER BY `Number` ASC LIMIT 1000");
            }
	}
	$vous=$vou;
	include'recedoc.php';
		}

include'header.php';

// delete an item from a given chart
if(isset($_POST['delo']))
		{
			$rowid=$_POST['rowid'];
			$then=mysql_query("DELETE FROM `stouse` WHERE `Number`='$rowid' LIMIT 1");
		}

// delete all items from a given chart
if(isset($_POST['delox']))
		{
			$then=mysqli_query($cons, "DELETE FROM `stouse` WHERE `Action`='RECEIVE' AND `Voucher`='0' LIMIT 100");
		}

// edit an item from a given chart
if(isset($_POST['edit']))
		{
			$rowid=$_POST['rowid'];
			$qty=$_POST['qty'];
				$qty=str_replace(',', '', $qty);
			$pre=$_POST['pre'];
				$pre=str_replace(',', '', $pre);
			$sale=$_POST['sale'];
				$sale=str_replace(',', '', $sale);
			$then=mysql_query("UPDATE `stouse` SET `Quantity`='$qty', `Price`='$pre', `Sales`='$sale' WHERE `Number`='$rowid' LIMIT 1");
		}

// search for an item to be added to the chart
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
				$pri=str_replace(',', '', $_POST["pri$n"]);
				$cosi=str_replace(',', '', $_POST["cosi$n"]);
				
				if($qty)
		$so=mysql_query("INSERT INTO `stouse` (`Number`, `Date`, `Time`, `User`, `Item`, `Cost`, `Quantity`, `Price`, `Action`, `Destin`, `Voucher`, `Status`, `Sales`) VALUES (NULL, '$Date', '$Time', '$loge', '$item', '$cosi', '$qty', '$cosi', 'RECEIVE', '', '0', '0', '$pri')");
			$n--;
			}
		}
		
		
		// Load items from purchase
		if(isset($_POST['load']))
		{
			$vous=$_POST['vous'];
	$dore=mysql_query("SELECT `stouse`.`Item`, `stouse`.`Quantity`, `stouse`.`Cost`, `items`.`Price` FROM `stouse` INNER JOIN `items` ON `stouse`.`Item`=`items`.`Number` WHERE `stouse`.`Voucher`='$vous' AND `stouse`.`Action`='PURCHASE'");
		while($rore=mysql_fetch_assoc($dore)){
				$item=$rore['Item'];
				$qty=$rore['Quantity'];
				$cost=$rore['Cost'];
				$pri=$rore['Price'];
				if($qty)
		$so=mysql_query("INSERT INTO `stouse` (`Number`, `Date`, `Time`, `User`, `Item`, `Cost`, `Quantity`, `Price`, `Action`, `Destin`, `Voucher`, `Status`, `Requis`, `Sales`) VALUES (NULL, '$Date', '$Time', '$loge', '$item', '$cost', '$qty', '$cost', 'RECEIVE', '', '0', '0', '$vous', '$pri')");
		//	$n--;
			}
		}


			// edit a given voucher from receiving report
if(isset($_POST['edivo']))
		{
			$vous=$_POST['vous'];

			// Update quantity when there is new receive *********************************************************
   $rece=mysql_query("SELECT *FROM `stouse` WHERE `Action`='RECEIVE' AND `Voucher`='$vous' AND `Upda`='1' AND `Status`='0' ORDER BY `Voucher` DESC");
    if($fece=mysql_num_rows($rece)){
				while($re=mysql_fetch_assoc($rece)){
					$nuo=$re['Number'];
					$ito=$re['Item'];
					$qto=$re['Quantity'];
					$dte=$re['Date'];
					$stor=$re['Store'];

	$sepri=mysql_query("SELECT *FROM `stouse` WHERE `Item`='$ito' AND `Action`='RECEIVE' AND `Number`!='$nuo' AND `Voucher`<'$vous' ORDER BY `Number` DESC LIMIT 1");
			$repri=mysql_fetch_assoc($sepri);
				$pri=$repri['Cost'];

	$do=mysql_query("UPDATE `items` SET `$stor`=`$stor`-'$qto', `Cost`='$pri' WHERE `Number`='$ito' ORDER BY `Number` ASC LIMIT 1");

	$then=mysql_query("UPDATE `stouse` SET `Voucher`='0', `Upda`='0', `Closing`='0' WHERE `Number`='$nuo' ORDER BY `Number` ASC LIMIT 1");
				}
	}
		}

	if($custo){
			$conde="AND (`Iname` LIKE '%$custo%' OR `Descri` LIKE '%$custo%' OR `Ecode`='$custo')";
			$lim=100;
		}
		else{
			$conde='';
			$lim=140;
		}

		$rece=mysql_query("SELECT `Voucher` FROM `stouse` WHERE `Voucher`!='0' ORDER BY `Voucher` DESC LIMIT 1");
				$re=mysql_fetch_assoc($rece);
					$vou=$re['Voucher']+1;


			if(!$_SESSION['Aco']){
			    $dsa="readonly";
			    $typ="password";
			    
			}
?>
<div class="container-fluid main-content">
        <div class="page-title">
          <h2 style='margin-top:-20px; margin-bottom: 5px; color:#ffcc33'>
         Main Store
          </h2>
                 </div>
     
        <div class="row">
  <div class="col-lg-2 hidden-print">
   
   <ul class="list-group">

    <li class="list-group-item">
	  <a href="mainsto.php">
                <p>
                <i class="lnr lnr-menu-circle"></i>&nbsp;Store Status
                </p>
              </a></li> 

	   <li class="list-group-item">
              <a href="crete.php">
                <p>
                <i class="lnr lnr-plus-circle"></i>&nbsp;Create New Items
                </p>
              </a></li>  

			  <li class="list-group-item">
              
			      <?php
			      if($_SESSION['Aco']){
			          echo"<a href='purcha.php'>";
			}
			else{
			   
			          echo"<a href='#'>";
			}
			?>
                <p>
                <i class="lnr lnr-plus-circle"></i>&nbsp;Purchase Orders
				<?php
				if($pfuquo)
					echo"<span class='badge' style='float:right; font-size:12px; margin-right:0px; margin-top:0px; height:18px; background-color:#ff66cc; width:26px;'> $pfuquo </span>";
					?>
                </p>
              </a></li> 
       <?php
if($_SESSION['Ari']){
    ?>           
			  <li class="list-group-item active">
              <a href="receive.php">
                <p>
                <i class="lnr lnr-plus-circle"></i>&nbsp;Receive Items
                </p>
              </a></li> 
<?php
}
if($_SESSION['Asd']){
    ?>
			   <li class="list-group-item">
              <a href="taken.php">
                <p>
                <i class="lnr lnr-circle-minus"></i>&nbsp;Stock &nbsp; Delivery
                </p>
              </a></li>
			     
<?php
}
if($_SESSION['Spay']){
    ?>
			  <li class="list-group-item">
              <a href="billpay.php">
                <p>
                <i class="lnr lnr-menu-circle"></i>&nbsp;Supplier Payment
                </p>
              </a></li> 
              <?php
}
if($pbuffe){
?>

 <li class="list-group-item">
              <a href="buffer.php">
                <p>
                <i class="lnr lnr-menu-circle"></i>&nbsp;Buffer &nbsp; Report
                </p>
              </a></li>	
    <?php
}
?>
                       
            </ul><br><br>
  
				 <ul class="list-group">

   <li class="list-group-item" style="border:1px dashed #cccccc; border-radius:5px; margin:0px 0px 4px 0px;">
	  <a href="createsu.php">
                <p>
                <i class="lnr lnr-menu-circle"></i>&nbsp;Create New Supplier
                </p>
              </a></li>
			  
			  </ul>
  </div>
                    
           
           
       
        <div class="col-lg-10">
                  <div class="row">
         
           <div class="col-lg-4"> </div>
          
         
           
<?php
if($_SESSION['Ari']){
    ?>
        <form action="" method="post" class="form-horizontal ">  
        <?php
}
?>
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
		$do=mysql_query("SELECT *FROM `items` WHERE `Store`='1' AND `Status`='0' $conde ORDER BY `Number` DESC LIMIT $lim");
				if($fo=mysql_num_rows($do)){
				   ?>
                 
             <div class="row">
            <div class="col-lg-12" style='margin-top:-20px;'>
             <span> &nbsp;&nbsp; Total Records Found : <b><?php echo" $fo " ?></b></span>
            <div class="widget-container fluid-height clearfix">
            <div class="widget-content padded clearfix">

								 <form action="" method="post" class="form-horizontal "> 
				<table class="table table-striped">     
                                      <thead>
                    <tr role="row">
                     <th class="hidden-xs"> No </th>
                       <th> Brand&nbsp;Name </th>
                       <th> Item&nbsp;Name </th>
                        <th> Description </th>
        <th colspan='2'>&nbsp;&nbsp;Qty&nbsp;In&nbsp;/&nbsp;Unit </th>
						 <th> Sales&nbsp;Price </th>
                        <th><div align='center'> Quantity </th><th><div align='center'> Cost&nbsp;Price </th>
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
			$cost=$ro['Cost'];			
			$qt=$ro['Quantity'];				$qty=number_format($qt, 2);
			$pr=$ro['Price'];               $pro=number_format($pr, 2);
			
				if(!$_SESSION['Aco']){
				    $costo="******&nbsp;&nbsp;";
				    $id="";
			    $dsa="readonly";
			    $typ="password";
				}
				else{
				    $costo=number_format($cost, 2);
				    $id="id='result$n'";
				    $dsa="";
				    $typ="text";
				}

$doi=mysql_query("SELECT *FROM `itype` WHERE `Number`='$kin' ORDER BY `Number` ASC");
		$roi=mysql_fetch_assoc($doi);
				$type=$roi['Type'];

				$dox=mysql_query("SELECT *FROM `unit` WHERE `Number`='$uno' ORDER BY `Number` ASC");
					$rox=mysql_fetch_assoc($dox);
							$unit=$rox['Unit'];
          $b=$n*10;
		print("<tr>
                        <td class=hidden-xs><div align='center'>$n&nbsp;&nbsp;</td><td> $type </td>
						<td> $iname </td><td> $descri </td><td><div align='right'> $qty </td><td> $unit </td>
						<td><div align='right'>&nbsp;$pro&nbsp;&nbsp;</td>
						<td><input name='qty$n' class='form-control' type='text' onkeyup='multiplyBy$n();' onkeypress='return isNumberKey(event)' style='text-align:right; width:120px; height:24px; margin:0px 0px 0px 0px' id='box$n'></td>
						<td><input name='cosi$n' class='form-control' value='$cost' onclick=this.value='' type='$typ' onkeyup='multiplyBy$n();' onkeypress='return isNumberKey(event)' 
						style='text-align:right; width:130px; height:24px;' id='box$b' $dsa></td>
						<td class='hidden-xs hidden-print' width='10%'><div align='right' style='border:1px solid #cccccc; width:120px; height:24px; border-radius:5px; padding:0px 10px 0px 0px;'><input type='hidden' name='item$n' value='$code'><input type='hidden' name='pri$n' value='$pr'>
						<span class='dollars' style='text-align:right; width:130px; height:24px; font-size:18px; color:#66cccc; float:center; text-align:right;' $id onchange='format(this);'></span></div><input type='hidden' name='cost$n' value='$cost'></td></tr>");
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
             <span> &nbsp;&nbsp; Receiving Voucher No : <b> $vou </b></span>
            <div class='widget-container fluid-height clearfix'>
            <div class='widget-content padded clearfix'>
			<br><br><br><br><br><br>
						<div style='text-align:center; font-size:24px; color:#ff3333'> Item not found for your search [$custo] </div><br><br><br><br><br><br><br>";
					}  
			}
				   else{
		$dor=mysql_query("SELECT *FROM `stouse` WHERE `Status`='0' AND `Voucher`='0' AND `Action`='RECEIVE' ORDER BY `Number` DESC");
				if($for=mysql_num_rows($dor)){
?>
 <div class="row">
            <div class="col-lg-12" style='margin-top:-20px;'>
             <span> &nbsp;&nbsp; Receiving Voucher No : <b><?php echo" $vou " ?></b></span>
            <div class="widget-container fluid-height clearfix">
            <div class="widget-content padded clearfix">

<table class="table table-striped">     
                                      <thead>
                    <tr role="row">
                     <th class="hidden-xs"> No </th>
                       <th> Brand&nbsp;Name </th>
                       <th> Item&nbsp;Name </th>
                       <th colspan='2'>&nbsp;&nbsp;Qty&nbsp;In&nbsp;/&nbsp;Unit &nbsp;</th>
						 <th> Cost&nbsp;Price </th>
                       <th> Sales&nbsp;Price </th>
                        <th><div align='center'> Quantity </th><th><div align='center'> Cost&nbsp;Price </th>
						<th COLSPAN='2'>Total&nbsp;Amount</th>
                        <th class="hidden-xs hidden-print" style="width:40px; text-align:center;" colspan='2'> Options </th>
                     </tr>
                    </thead>
                                        <tbody>
										<?php
	$n=1;			$tot=$tq=0;
					while($ror=mysql_fetch_assoc($dor)){
						$code=$ror['Number'];
						$item=$ror['Item'];
						$sale=$ror['Price'];
						$qt=$ror['Quantity'];
						$dst=$ror['Destin'];
						$dte=$ror['Date'];
						$pri=$ror['Sales'];
						$stor=$ror['Store'];
						$cos=$ror['Comment'];
						$tq+=$qt;
          $to=$sale*$qt;					
	$do=mysql_query("SELECT *FROM `items` WHERE `Status`='0' AND `Number`='$item' ORDER BY `Number` DESC LIMIT $lim");
		$ro=mysql_fetch_assoc($do);
			$iname=$ro['Iname'];
			$kin=$ro['Type'];
			$descri=$ro['Descri'];
			$uno=$ro['Unit'];	
			$qin=$ro['Quantity'];			
						$cost=$ro['Cost'];	
			
	$qty=number_format($qt, 2);		
	 if($_SESSION['Aco']){
	     $costo=number_format($cost, 2);
	     $too=number_format($to, 2);	 
	     }
	     else{
	        $costo="******&nbsp;&nbsp;";
	        $too="******&nbsp;&nbsp;";
			    $dsa="readonly";
			    $typ="password";
	     }
	        
	  $sales=number_format($sale, 2);           $prio=number_format($pri, 2);      

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
								$arr="<i class='lnr lnr-arrow-up'></i>";	$qino=number_format($qin, 2);
		print("<tr><form action='' method='post'>
                <td class=hidden-xs><div align='center'>$n&nbsp;&nbsp;</td><td> $type </td>
						<td> $iname </td><td><div align='right'> $qino </td>
						<td> $unit </td><td><div align='right'>&nbsp;$costo&nbsp;</td><td style='width:60px;'><div align='right'><input name='sale' class='form-control text-success' type='text' onkeyup='format(this);' onkeypress='return isNumberKey(event)' onChange=this.style.color='#ff3366' style='text-align:right; width:90px; height:20px; margin:0px 0px 0px 0px; padding:0px 10px 0px 0px;' value='$prio'></td>
						
						<td style='width:60px;'><div align='right'><input name='qty' class='form-control' type='text' onkeyup='format(this);' onkeypress='return isNumberKey(event)' style='text-align:right; width:80px; height:20px; margin:0px 0px 0px 0px; padding:0px 10px 0px 0px;' value='$qty'></td><td style='width:60px;'><div align='right'><input name='pre' class='form-control' type='$typ' onkeyup='format(this);' onkeypress='return isNumberKey(event)' onChange=this.style.color='#ff3366' style='text-align:right; width:90px; height:20px; margin:0px 0px 0px 0px; padding:0px 10px 0px 0px;' value='$sales' $dsa></td><td><div align='right'>$too</td><td width='1%'>$arr</td>
						
						
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
					<tr><th class="hidden-xs"> </th><th colspan='6'><div align='center'> Grand Total </th><th colspan='1'><div align='right'><?php echo $tq ?></th>
					<th colspan='2'><div align='right'><?php echo $toto ?></th><th colspan='3'><div align='center'> -- </th></tr>
                  </table><br>
                  
                  
                  
                  
                  <?php
                  // ***************** Reference modal ********************
                  ?>
                   <div class='modal fade text-left' id='exampleModal91' style='top:80px;'>
  <div class='modal-dialog' role='document'>
    <div class='modal-content' style='border-radius:5px;'>
      <div class='modal-header' style='border-radius:5px;'>
    <h5 class='modal-title'>ADD REFERENCE </h5></div>
    <form method='post' action=''>
      <div class='modal-body' style='height:100px; padding:20px;'>
        <div class="form-group">
            
            <div class="col-lg-12 hidden-print"><textarea name="comme" class="form-control" style="margin:0px;" placeholder="Write any reference here"><?php echo $cos ?></textarea></div>
      </div></div>
      
                <?php
        $form_token = uniqid();
        $_SESSION['form_token'] = $form_token;
  	  echo"<input type='hidden' name='form_token' value='$form_token'>";
			 ?>

      <div class='modal-header text-right' style='padding-top:10px; height:50px; border:0px solid blue;'>
        <button type='button' class='btn btn-sm btn-warning' data-dismiss='modal' style='width:80px;'>&nbsp;CANCEL&nbsp;</button>
        <button type='submit' name='addco' class='btn btn-sm btn-success' style='width:80px;'><i class='lnr lnr-checkmark-circle'></i> ADD </button>
      </div>
    </form></div>
  </div>
</div>
<?php 
// ************************ End of reference modal **********************
?>

				  <label class="control-label col-md-1"><button type='button' class='btn btn-md btn-default hidden-print' name='button' title='Add Reference' data-toggle='modal' data-target='#exampleModal91'>&nbsp;&nbsp;<i class='lnr lnr-pencil'></i>&nbsp;&nbsp;</button></label>

	<form method='post' action=''><label class="control-label col-md-3">
			  <select class="form-control" name="supplier" required>			
			 <?php
					  if($dst=='')
					$dte=$Date;
				echo"<option value='' selected='selected'> SELECT SUPPLIER </option>";
				  $top=mysql_query("SELECT *FROM `suppliers` WHERE `Status`='0' ORDER BY `Supplier` ASC");
						while($rop=mysql_fetch_assoc($top)){
							$sup=$rop['Supplier'];
							if($dst==$sup)
					$s='selected';
				else
					$s='';
			echo"<option value='$sup' $s> $sup </option>";
						}
						
			echo"</select><input type='hidden' name='rowid' value='$code'><input type='hidden' name='tag' value='$tag'>";
			?></label><label class="control-label col-md-5">

	<label class="control-label col-md-5"><select class="form-control" name="invoice">			
			 <?php
				echo"<option value='' selected='selected'> INVOICE TYPE </option>";
			echo"<option value='VAT INCLUDED'> VAT INCLUDED </option><option value='VAT EXCLUDED'> VAT EXCLUDED </option>
			<option value='NO INVOICE'> NO INVOICE </option>
			    
            </select><input type='hidden' name='rowid' value='$code'><input type='hidden' name='tag' value='$tag'>";
			?></label>

	<label class="control-label col-md-3"><input name="dato" id="from" class="form-control sm" type="text" style="text-align:center; width:100px;" VALUE="<?php echo $dte ?>" onclick="return pageScroll()"></label>

<label class="control-label col-md-4">
		<select class='form-control' name='store' style="padding-left:5px; padding-right:5px;" required><option value=''> STORE </option>
		<?php
	$dob=mysqli_query($cons, "SELECT *FROM `stores` WHERE `Status`>='0' ORDER BY `Number` ASC");
		while($rob=mysqli_fetch_assoc($dob)){
			$stonum=$rob['Store'];
			$stona=$rob['Name'];
			if($stonum==$stor)
				$s="selected";
			else
				$s="";
	echo"<option value='$stonum' $s> &nbsp;&nbsp; $stona </option>";
		}
				?>
		</select></label></label>

			 <label class="control-label col-md-2">
			 <button class="btn btn-md btn-block btn-info" type="submit" name="receive"><i class="lnr lnr-plus-circle"></i> RECEIVE </button>
			 </label></form><form action="" method="post">
			 
			  <label class="control-label col-md-1" style="text-align:right;">
			    <?php
				  if($n>3){
				  echo"<button type='submit' class='btn btn-md btn-danger hidden-print' name='delox' title='Remove All' data-toggle='tooltip' data-placement='top'>&nbsp;&nbsp;<i class='lnr lnr-trash'></i>&nbsp;&nbsp;</button>";
			  }
			  ?>
			  </label></form>

		<?php
				}
					else{
						echo"<div class='row'>
            <div class='col-lg-12' style='margin-top:-20px;'>
             <span> &nbsp;&nbsp; Receiving Voucher No : <b> $vou </b></span>
            <div class='widget-container fluid-height clearfix'>
            <div class='widget-content padded clearfix'>
			<br><br><br><br><br><br>
						<div style='text-align:center; font-size:24px; color:#ff9999'>Load items to be received </div><br><br><br><br><br><br><br>";
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
