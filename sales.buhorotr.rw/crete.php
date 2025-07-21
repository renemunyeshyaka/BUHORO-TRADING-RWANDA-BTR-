<?php
if(basename($_SERVER['PHP_SELF']) == 'crete.php') 
  $pp=" class='current'";
include'header.php';
include'connection.php';
$pto=0;
$rowid=0;
$duse=10;
		$iname=$type=$unit=$descri=$cost=$sales='';
		$smin=$sval=$bmin=$bval='';
$qty=$daily=0;
		
$btne="<br><button class='btn btn-lg btn-block btn-success' type='submit' name='addo'>
	<i class='lnr lnr-checkmark-circle'></i>&nbsp;&nbsp;SAVE </button>";
		
		if(!$_SESSION['Aco']){
			    $dsa="";
			    $typ="password";
		}

if(isset($_POST['addo']))
		{
			$iname=$_POST['iname'];
				$iname=str_replace("'", "`", $iname);
			$type=$_POST['type'];
			$descri=$_POST['descri'];
				$descri=str_replace("'", "`", $descri);
			$cost=$_POST['cost'];
				$cost=str_replace(',', '', $cost);
			$sales=$_POST['sales'];
				$sales=str_replace(',', '', $sales);
			$unit=$_POST['unit'];
			$qty=$_POST['qty'];
			$count=$_POST['count'];
			
			$smin=$_POST['smin'];
				$smin=str_replace(',', '', $smin);
			$sval=$_POST['sval'];
				$sval=str_replace(',', '', $sval);
			$bmin=$_POST['bmin'];
				$bmin=str_replace(',', '', $bmin);
			$bval=$_POST['bval'];
				$bval=str_replace(',', '', $bval);
			$duse=$_POST['duse'];
			$daily=$_POST['daily'];
				$daily=str_replace(',', '', $daily);

	$doix=mysql_query("INSERT INTO `items` (`Number`, `Date`, `User`, `Iname`, `Descri`, `Cost`, `Price`, `Store`, `Unit`, `Type`, `Quantity`, `Smin`, `Svalue`, `Bmin`, `Bvalue`, `Direct`, `Ecode`, `Daily`) VALUES (NULL, '$Date', '$loge', '$iname', '$descri', '$cost', '$sales', '1', '$unit', '$type', '$qty', '$smin', '$sval', '$bmin', '$bval', '$duse', '$count', '$daily')");
		$iname=$type=$unit=$descri=$cost=$sales='';
		$duse=10;
		$pto=10;
			}
	

		if(isset($_POST['updo']))
		{	
			$rowid=$_POST['rowid'];
			$iname=$_POST['iname'];
				$iname=str_replace("'", "`", $iname);
			$type=$_POST['type'];
			$descri=$_POST['descri'];
				$descri=str_replace("'", "`", $descri);
			$cost=$_POST['cost'];
				$cost=str_replace(',', '', $cost);
			$sales=$_POST['sales'];
				$sales=str_replace(',', '', $sales);
			$unit=$_POST['unit'];
			$qty=$_POST['qty'];
			$count=$_POST['count'];
			
			$smin=$_POST['smin'];
				$smin=str_replace(',', '', $smin);
			$sval=$_POST['sval'];
				$sval=str_replace(',', '', $sval);
			$bmin=$_POST['bmin'];
				$bmin=str_replace(',', '', $bmin);
			$bval=$_POST['bval'];
				$bval=str_replace(',', '', $bval);
			$duse=$_POST['duse'];
			$daily=$_POST['daily'];
				$daily=str_replace(',', '', $daily);

	$doix=mysql_query("UPDATE `items` SET `Date`='$Date', `User`='$loge', `Iname`='$iname', `Descri`='$descri', `Cost`='$cost', `Price`='$sales', `Store`='1', `Unit`='$unit', `Type`='$type', `Smin`='$smin', `Svalue`='$sval', `Bmin`='$bmin', `Bvalue`='$bval', `Direct`='$duse', `Ecode`='$count', `Daily`='$daily' WHERE `Number`='$rowid' ORDER BY `Number` ASC LIMIT 1");
		$pto=40;
			
	$btne="<br><button class='btn btn-lg btn-block btn-warning' type='submit' name='updo'>
	<i class='lnr lnr-checkmark-circle'></i>&nbsp;&nbsp;UPDATE </button>";
		}

		if(isset($_POST['open']))
		{
			$rowid=$_POST['rowid'];
	$do=mysql_query("SELECT *FROM `items` WHERE `Number`='$rowid' ORDER BY `Number` DESC LIMIT 1");
		$ro=mysql_fetch_assoc($do);
			$iname=$ro['Iname'];
			$type=$ro['Type'];
			$descri=$ro['Descri'];
			$unit=$ro['Unit'];	
			$qty=$ro['Quantity'];			
			$cost=$ro['Cost'];
			$sales=$ro['Price'];

			$smin=$ro['Smin'];
			$sval=$ro['Svalue'];
			$bmin=$ro['Bmin'];
			$bval=$ro['Bvalue'];
			$duse=$ro['Direct'];
			$count=$ro['Ecode'];
			$daily=$ro['Daily'];
			
			if($_SESSION['Aco']){
			    $dsa="";
			    $typ="text";
			
			}
			else{
			    $dsa="readonly";
			    $typ="password";
			    
			}
	$btne="<br><button class='btn btn-lg btn-block btn-warning' type='submit' name='updo'>
	<i class='lnr lnr-checkmark-circle'></i>&nbsp;&nbsp;UPDATE </button>";
		}

if(isset($_POST['addtype']))
		{
			$newtype=$_POST['newtype'];
			$sso=mysql_query("INSERT INTO `itype` (`Type`, `Date`) VALUES ('$newtype', '$Date')");
		}
?>


<div class="container-fluid main-content">
<div class="page-title">
        <h2 style='margin-top:-20px; margin-bottom: 5px; color:#ffcc33'>Main Store</h2>
  
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

	   <li class="list-group-item active">
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
			  <li class="list-group-item">
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
                       
            </ul>
  </div>

 <div class="col-md-10">
 <div class="widget-container fluid-height clearfix">
 <div class="widget-content padded">
 <input name="app_file_size" id="app_file_size" type="hidden">
 
 <?php 
if($pto==10)
echo"<center><div class='alert alert-danger' style='width:88%;text-align:center;float:center;background-color: #60c560;color: #ffffff;border-radius:5px;'>
		<i class='lnr lnr-checkmark-circle'></i> &nbsp;&nbsp; <button class='close' data-dismiss='alert' type='button'>&times;</button>New item is created successfully.
		</div></center>";
if($pto==40)
echo"<center><div class='alert alert-danger' style='width:88%;text-align:center;float:center;background-color: #60c560;color: #ffffff;border-radius:5px;'>
		<i class='lnr lnr-checkmark-circle'></i> &nbsp;&nbsp; <button class='close' data-dismiss='alert' type='button'>&times;</button>Item has been updated successfully.
		</div></center>";
	
			echo"<input value='$code' name='rowid' type='hidden'>";

$stn="padding:0px;";
print("<div id='modal-1' class='modal fade' role='dialog'>
  <div class='modal-dialog'><div class='modal-content'>
      <div class='modal-header'>
        <button type='button' class='close' data-dismiss='modal'>&times;</button><center>
        <h5 class='modal-title' id='exampleModalLabel'> CREATE A NEW TYPE
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </h5></center></div>
    <div class='modal-body' style='height:440px; overflow-y:auto;'>
      <div align='center'>

<table class='table table-striped' width='80%'>
          <thead><tr><td class='text-center' style='$stn'> # </td>
          <form method='post' class='form-horizontal' action=''><td style='$stn'><div align='right'>
<input name='newtype' class='form-control' type='text' style='text-align:left; height:28px; margin:5px 10px 5px -10px;' placeholder='New Brand'></td>
<td width='10%' style='$stn'><button type='submit' class='btn btn-md btn-success hidden-print' name='addtype' style='height:27px; padding:2px; margin:5px;'>&nbsp;&nbsp;<span class='lnr lnr-plus-circle'></span>&nbsp;&nbsp;ADD&nbsp;&nbsp;</button> </td></form></tr>
          </thead>
          <tbody>");
$n=1;
$dotype=mysql_query("SELECT *FROM `itype` WHERE `Location`='0' AND `Type`!='' ORDER BY `Type` ASC");
			while($rotype=mysql_fetch_assoc($dotype)){
$nuo=$rotype['Number'];
$typeso=$rotype['Type'];

$doit=mysql_query("SELECT *FROM `items` WHERE `Type`='$nuo' AND `Status`='0' ORDER BY `Number` ASC");
		$roit=mysql_num_rows($doit);

print("<tr><td style='$stn'><div align='right'> $n &nbsp;&nbsp; </td><td style='$stn'> $typeso </td>
<td style='$stn'><center> $roit &nbsp;&nbsp;</button>
</td></tr>");
$n++;
}

print("</table>

 </div>
</div>
      <div class='modal-footer'>
        <button type='button' class='btn btn-warning' data-dismiss='modal'>Close</button>
      </div>
    </div></div>
    </div>");
			?>
			
         
           <div class="col-lg-4"> </div>
          
         
           

        <form action="mainsto.php" method="post" class="form-horizontal ">                  
                       <div class="col-lg-8 no-print"><div class="col-lg-3"> 					
					   
					   </div>
            <div class="col-lg-6"> 
      <input class="form-control"  name="custo" type="text" id="search" autofocus="autofocus">
			</div>                      
                       
                       <div class="col-lg-2">
                        <button class="btn  btn-primary btn-block" type="submit" name="search"><i class="lnr lnr-magnifier"></i> Search</button>
                   
					  </div>
                         </div> 
                      
                     
                  
            </form><br><br><br><hr> 
            
            
            
    <form method="post" class="form-horizontal" action="" enctype="multipart/form-data">
	<div class="form-group">
	    
	    <div class="col-md-2" align="right">
			  <label class="control-label">Brand Name</label></div>	

 <div class="col-md-3"><div class='input-group'>
           <select class="form-control" name="type" required>
				<option value='' selected='selected'>Select Type</option>
			<?php
			$doi=mysql_query("SELECT *FROM `itype` WHERE `Location`='0' AND `Type`!='' ORDER BY `Type` ASC");
			while($roi=mysql_fetch_assoc($doi)){
				$code=$roi['Number'];
				$fna=$roi['Type'];
				if($type==$code)
					$k='selected';
				else
					$k='';
			echo"<option value='$code' $k> $fna </option>";
			}
			?>   
                            </select><span class='input-group-addon'><a href='#' data-placement='top' data-toggle='modal' data-target='#modal-1'>
		 <i class="lnr lnr-sync"></i></a></span>
	
	</div>
            </div>
            
            
			<div class="col-md-2" align="right"> 
            <label class="control-label">Item Name</label></div>
            <div class="col-md-3">
           <input name="iname" class="form-control" type="text" style="text-align:left;" value="<?php echo $iname ?>" autofocus="autofocus" id="searchs" required>
            </div>
			 
			  
 </div>

 <div class="form-group">

 <div class="col-md-2" align="right">
			  <label class="control-label">Description</label></div>	

 <div class="col-md-3">
     <input name="descri" class="form-control" type="text" value="<?php echo $descri ?>">
            </div>
			

<div class="col-md-2" align="right"> 
            <label class="control-label">Count Unit</label></div>
            <div class="col-md-3">
       <select class="form-control" name="unit" required>
				<option value='' selected='selected'>Select Unit</option>
			<?php
			$doi=mysql_query("SELECT *FROM `unit` ORDER BY `Unit` ASC");
			while($roi=mysql_fetch_assoc($doi)){
				$code=$roi['Number'];
				$fna=$roi['Unit'];
				if($unit==$code)
					$k='selected';
				else
					$k='';
			echo"<option value='$code' $k> $fna </option>";
			}
			?>   
                            </select>
            </div><span style="color:#d43f3a">
                        
                      </span> 			
            </div>   

  <div class="form-group">
   <div class="col-md-2" align="right">
			  <label class="control-label"><br>Item Prices</label></div>	

 <div class="col-md-3" style="padding:0px;">
     
     
     <div class="col-md-6 text-center"><b>Cost Price</b>
           <input name="cost" class="form-control text-center" type="<?php echo $typ ?>" onkeyup='format(this);' onkeypress='return isNumberKey(event)' value="<?php echo $cost ?>" <?php echo $dsa ?>></div>
           
     <div class="col-md-6 text-center"><b>Sales Price</b>
           <input name="sales" class="form-control text-center" type="text" onkeyup='format(this);' onkeypress='return isNumberKey(event)' value="<?php echo $sales ?>"></div>
            </div>

		<div class="col-md-2" align="right"> 
            <label class="control-label">Item Status</label></div>
            <div class="col-md-3">
			<select multiple class="form-control" name='duse' style="height:50px; cursor:pointer; font-size:14px; padding-top:10px;" required>
			<?php
		if($duse=='1'){
			$d='selected';
			$s='';
		 }
		else{
			$d='';
			$s='selected';
		}
			?>
      <option value='0' <?php echo $d ?>>Stockable</option>
      <option value='1' <?php echo $s ?>>Cunsumable</option>
    </select></div>
	</div>

	<div class="form-group">
   <div class="col-md-2" align="right">
			  <label class="control-label">Store Buffer</label></div>	

 <div class="col-md-3">
           <input name="daily" class="form-control text-center" type="text" onkeyup='format(this);' onkeypress='return isNumberKey(event)' value="<?php echo $daily ?>">
            </div>

<div class="form-group">
   <div class="col-md-2" align="right">
			  <label class="control-label">Item Code</label></div>

 <div class="col-md-3">
              <input name="count" class="form-control" type="text" value="<?php echo $count ?>" style='background-color:#f9f9f9; text-align:center;'>
             </div>
	</div>
 
  <div class="form-group">
  <div class="col-md-12">
  <div class="col-sm-1"></div>
   <div class="col-sm-9" align='center' style='border:0px solid black;'><br> 
   <?php
	  echo"<input type='hidden' name='rowid' value='$rowid'><input type='hidden' name='stat' value='$stat'><input type='hidden' name='qty' value='$qty'> $btne";
	   ?>
		<br><br></div></div>
		</form></div></div></div></div>
	 
 </div></div></div>
 
<?php
include'footer.php';
?>
