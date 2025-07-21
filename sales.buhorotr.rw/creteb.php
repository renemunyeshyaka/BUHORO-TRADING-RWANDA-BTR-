<?php
if(basename($_SERVER['PHP_SELF']) == 'creteb.php') 
  $bb=" class='current'";
include'header.php';
include'connection.php';
$pto=0;
$rowid=0;
$sou='';
		$iname=$type=$unit=$descri=$cost=$sales=$ecode='';
		
$btne="<br><button class='btn btn-lg btn-block btn-success' type='submit' name='addo'>
	<i class='lnr lnr-checkmark-circle'></i>&nbsp;&nbsp;SAVE </button>";

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
			$ecode=$_POST['ecode'];
			$sou=$_POST['sou'];

	$doix=mysql_query("INSERT INTO `items` (`Number`, `Date`, `User`, `Iname`, `Descri`, `Cost`, `Price`, `Store`, `Unit`, `Type`, `Ecode`, `Source`) VALUES (NULL, '$Date', '$loge', '$iname', '$descri', '$cost', '$sales', '3', '$unit', '$type', '$ecode', '$sou')");
		$iname=$type=$unit=$sou='';						$descri=$cost=$sales=$ecode='';
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
			$ecode=$_POST['ecode'];
			$sou=$_POST['sou'];

			$then=mysql_query("DELETE  FROM `items` WHERE `Number`='$rowid' LIMIT 1");
	$doix=mysql_query("INSERT INTO `items` (`Number`, `Date`, `User`, `Iname`, `Descri`, `Cost`, `Price`, `Store`, `Unit`, `Type`, `Ecode`, `Source`) VALUES ('$rowid', '$Date', '$loge', '$iname', '$descri', '$cost', '$sales', '3', '$unit', '$type', '$ecode', '$sou')");
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
			$ecode=$ro['Ecode'];
			$sou=$ro['Source'];
			$cost=number_format($ro['Cost']);
			$sales=number_format($ro['Sales']);
	$btne="<br><button class='btn btn-lg btn-block btn-warning' type='submit' name='updo'>
	<i class='lnr lnr-checkmark-circle'></i>&nbsp;&nbsp;UPDATE </button>";
		}

?>
<div class="container-fluid main-content">
<div class="page-title">
        <h2 style='margin-top:-20px; margin-bottom: 5px; color:#ffcc33'>Branches</h2>
  
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

    <li class="list-group-item active">
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
  </div>

 <div class="col-md-10">
 <div class="widget-container fluid-height clearfix">
 <div class="widget-content padded">
 <form method="post" class="form-horizontal" action="" enctype="multipart/form-data">
 <input name="app_file_size" id="app_file_size" type="hidden">
 <br>
 <?php 
if($pto==10)
echo"<center><div class='alert alert-danger' style='width:88%;text-align:center;float:center;background-color: #60c560;color: #ffffff;border-radius:5px;'>
		<i class='lnr lnr-checkmark-circle'></i> &nbsp;&nbsp; <button class='close' data-dismiss='alert' type='button'>×</button>New item is created successfully.
		</div></center>";
if($pto==40)
echo"<center><div class='alert alert-danger' style='width:88%;text-align:center;float:center;background-color: #60c560;color: #ffffff;border-radius:5px;'>
		<i class='lnr lnr-checkmark-circle'></i> &nbsp;&nbsp; <button class='close' data-dismiss='alert' type='button'>×</button>Item has been updated successfully.
		</div></center>";
	
			echo"<input value='$code' name='rowid' type='hidden'>";
			?>
			
			<br><br><div class="form-group">
			<div class="col-md-2" align="right"> 
            <label class="control-label">Item Name</label></div>
            <div class="col-md-3">
           <input name="iname" class="form-control" type="text" style="text-align:left;" value="<?php echo $iname ?>" id="search" autofocus="autofocus" required>
            </div><span style="color:#d43f3a">
                         Required
                      </span> 
			
			 	
			 
			  <div class="col-md-2" align="right">
			  <label class="control-label">Item Type</label></div>	

 <div class="col-md-3">
           <select class="form-control" name="type" required>
				<option value='' selected='selected'>Select Type</option>
			<?php
			$doi=mysql_query("SELECT *FROM `itype` WHERE `Location`='1' ORDER BY `Type` ASC");
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
                            </select>
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
			$doi=mysql_query("SELECT *FROM `unit` WHERE `Unit`='PC' ORDER BY `Unit` ASC");
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
                         mandatory
                      </span> 			
            </div>   

  <div class="form-group">
   <div class="col-md-2" align="right">
			  <label class="control-label">Cost Price</label></div>	

 <div class="col-md-3">
           <input name="cost" class="form-control" type="text" onkeyup='format(this);' onkeypress='return isNumberKey(event)' value="<?php echo $cost ?>" placeholder="Optional">
            </div>

		<div class="col-md-2" align="right"> 
            <label class="control-label">Item Code</label></div>
            <div class="col-md-3">
              <input name="ecode" class="form-control" type="text" value="<?php echo $ecode ?>" style='background-color:#f9f9f9; text-align:center;'>
            </div>
	</div>

	<div class="form-group">
   <div class="col-md-2" align="right">
			  <label class="control-label">Sales Price</label></div>	

 <div class="col-md-3">
           <input name="sales" class="form-control" type="text" onkeyup='format(this);' onkeypress='return isNumberKey(event)' value="<?php echo $sales ?>">
            </div>

		<div class="col-md-2" align="right"> 
            <label class="control-label">Side Set</label></div>
            <div class="col-md-3">
             
       <select class="form-control" name="sou" required>
	   <?php
	   if($sou=='YES')
			echo"<option value=''>Select Option</option><option value='YES' selected='selected'>YES</option>
			<option value='NO'>&nbsp;NO</option>";
		elseif($sou=='NO')
			echo"<option value=''>Select Option</option><option value='YES'>YES</option>
			<option value='NO' selected='selected'>&nbsp;NO</option>";
		else
			echo"<option value='' selected='selected'>Select Option</option><option value='YES'>YES</option>
			<option value='NO'>&nbsp;NO</option>";
			?>
				</select>
            </div>
	</div>
 
  <div class="form-group">
  <div class="col-md-12">
  <div class="col-sm-1"></div>
   <div class="col-sm-9" align='center' style='border:0px solid black;'> 
   <?php
	  echo"<input type='hidden' name='rowid' value='$rowid'><input type='hidden' name='stat' value='$stat'> $btne";
	   ?>
		<br><br></div></div>
		</form></div></div></div></div>
	 
 </div></div></div>
 
<?php
include'footer.php';
?>