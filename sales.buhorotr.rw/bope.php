<?php
if(basename($_SERVER['PHP_SELF']) == 'bope.php') 
  $tt=" class='current'";
include'header.php';
include'connection.php';
$user=$loge;
$dato=$Date;
$pto=0;

if(isset($_POST['depos']))
		{
			$emplo=$_POST['emplo'];
			$amo=$_POST['amo'];
				$amo=preg_replace('/,/', '', $amo);
			$purpo=$_POST['purpo'];
				$purpo=str_replace("'", "`", $purpo);
			$part=$_POST['part'];
			$dato=$_POST['dato'];
			$payto=$_POST['payto'];
			$ope=$_POST['ope'];
			$acco=$_POST['acco'];
			$source=$_POST['source'];
			if($source=='SALES')
				$bra=$_POST['branch'];
			else
				$bra=0;

		$dos=mysqli_query($cons, "SELECT *FROM `baccount` WHERE `Account`='$source' ORDER BY `Number` ASC");
			if($fos=mysqli_num_rows($dos)){
				$ros=mysqli_fetch_assoc($dos);
					$sour=$ros['Number'];
				$bro=$_POST['branch'];
				$dose=mysqli_query($cons, "SELECT *FROM `baccount` WHERE `Number`='$acco' ORDER BY `Number` ASC");
					$rose=mysqli_fetch_assoc($dose);
						$acc=$rose['Account'];

$and=mysqli_query($cons, "INSERT INTO `deposit` (`Number`, `Date`, `Time`, `User`, `Item`, `Refer`, `Amount`, `Customer`, `Operation`, `Status`, `Valid`, `Account`, `Descri`, `Client`, `Voucher`, `Source`, `Record`) VALUES (NULL, '$dato', '$Time', '$loge', 'TRANSFER', 'x2', '$amo', '$acc', 'WITHDRAWAL', '0', '0', '$sour', '$purpo', '0', '0', 'DIRECT', '0')");

				}

$and=mysqli_query($cons, "INSERT INTO `deposit` (`Number`, `Date`, `Time`, `User`, `Item`, `Refer`, `Amount`, `Customer`, `Operation`, `Status`, `Valid`, `Account`, `Descri`, `Client`, `Voucher`, `Source`, `Record`, `Branche`) VALUES (NULL, '$dato', '$Time', '$loge', 'DEPOSIT', 'x1', '$amo', '$payto', '$ope', '0', '0', '$acco', '$purpo', '0', '0', '$source', '0', '$bra')");
		$pto=20;
		}


		if(isset($_POST['withs']))
		{
			$emplo=$_POST['emplo'];
			$amo=$_POST['amo'];
				$amo=preg_replace('/,/', '', $amo);
			$purpo=$_POST['purpo'];
				$purpo=str_replace("'", "`", $purpo);
			$part=$_POST['part'];
			$dato=$_POST['dato'];
			$payto=$_POST['payto'];
			$ope=$_POST['ope'];
			$acco=$_POST['acco'];

$and=mysqli_query($cons, "INSERT INTO `deposit` (`Number`, `Date`, `Time`, `User`, `Item`, `Refer`, `Amount`, `Customer`, `Operation`, `Status`, `Valid`, `Account`, `Descri`, `Client`, `Voucher`, `Source`, `Record`) VALUES (NULL, '$dato', '$Time', '$loge', '$part', 'x2', '$amo', '$payto', '$ope', '0', '0', '$acco', '$purpo', '0', '0', 'DIRECT', '0')");
		$pto=10;
		}

		// Delete a given particular
if(isset($_POST['editobon']))
		{
			$num=$_POST['num'];
				$soso=mysqli_query($cons, "DELETE FROM `parts` WHERE `Number`='$num' ORDER BY `Number` ASC LIMIT 1");
		}

		// Create a new particular
if(isset($_POST['eddobon']))
		{
			$namei=$_POST['namei'];
	$so=mysqli_query($cons, "INSERT INTO `parts` (`Parts`) VALUES ('$namei')");
		}
?>


<div class="container-fluid main-content">
        <div class="page-title hidden-print">
          <h2 style='margin-top:-20px; margin-bottom: 5px; color:#ffcc33'>
        Operations
          </h2>
                 </div>
     
         <div class="row">
  <div class="col-lg-2 hidden-print">
   
   <ul class="list-group">

    <li class="list-group-item">
	  <a href="deposit.php">
                <p>
                <i class="lnr lnr-menu-circle"></i>&nbsp;Bank Slip Record
                </p>
              </a></li>  

	 <li class="list-group-item">
	  <a href="cheque.php">
                <p>
                <i class="lnr lnr-briefcase"></i>&nbsp;Cheque Record
                </p>
		<?php
		if($fequo)
		echo"<span class='badge' style='float:right; font-size:11px; margin-right:5px; height:18px; background-color:#66ff33; width:25px; text-align:center; margin-top:-35px; color:#ffffff;'> $fequo </span>";
			?>
              </a></li>
      
    <li class="list-group-item">
	  <a href="suppli.php">
                <p>
                <i class="lnr lnr-plus-circle"></i>&nbsp;Cheque &nbsp; Payout
                </p>
              </a></li> 
      
    <li class="list-group-item">
	  <a href="billpay.php">
                <p>
                <i class="lnr lnr-plus-circle"></i>&nbsp;Supplier Payment
                </p>
              </a></li> 
      
    <li class="list-group-item active">
	  <a href="bope.php">
                <p>
                <i class="lnr lnr-laptop-phone"></i>&nbsp;Bank Operation
                </p>
              </a></li>   
                         
            </ul><br><br>	
			 
  </div>
 <div class="col-md-10">
 <div class="widget-container fluid-height clearfix" style='margin-top:-40px;'>
 <div class="widget-content padded">
 <form method="post" class="form-horizontal" action="" enctype="multipart/form-data">
 <input name="app_file_size" id="app_file_size" type="hidden">
 <br>
 <?php 
 $amos=number_format($amo);
if($pto==10)
echo"<center><div class='alert alert-danger' style='width:48%;text-align:center;float:center;background-color: #60c560;color: #ffffff;border-radius:5px;'>
		<i class='lnr lnr-checkmark-circle'></i> &nbsp;&nbsp; <button class='close' data-dismiss='alert' type='button'>&times;</button> Withdrawal operation is saved successfull.
		</div></center>";
if($pto==20)
echo"<center><div class='alert alert-danger' style='width:48%;text-align:center;float:center;background-color: #60c560;color: #ffffff;border-radius:5px;'>
		<i class='lnr lnr-checkmark-circle'></i> &nbsp;&nbsp; <button class='close' data-dismiss='alert' type='button'>&times;</button> Deposit operation is saved successfull.
		</div></center>";
	
			echo"<input value='$code' name='rowid' type='hidden'>";
			?>
			<div class="form-group">
            <label class="control-label col-md-3">Operation Type</label>
            <div class="col-md-6">
           <select class="form-control" name="ope" required onchange='showDiv(this.value);'>
				<option value='' selected='selected'>Select Operation</option>			
	<OPTION VALUE="WITHDRAWAL">WITHDRAWAL</OPTION>
		<OPTION VALUE="DEPOSIT">DEPOSIT</OPTION>
</SELECT>
            </div>
			<span style="color:#d43f3a">
                         *
                      </span>  
 </div>
  <div class="form-group">
            <label class="control-label col-md-3">Total Amount</label>
            <div class="col-md-6">
              <input name="amo" class="form-control" type="text" onkeypress='return isNumberKey(event)' onkeyup='format(this);' required>
            </div>
			  <span style="color:#d43f3a">
                         *
                      </span>  
 </div>
 <div class="form-group">
   <label class="control-label col-md-3">Description</label>
                  <div class="col-md-6">
              <input class="form-control" name="purpo" type="text">
            </div> 
			  <span style="color:#d43f3a">
                         *
                      </span>  
			</div>

 <div class="form-group">
   <label class="control-label col-md-3">Done&nbsp;By&nbsp;&nbsp;</label>
                  <div class="col-md-6">
              <input class="form-control" name="payto" type="text" id="searcho" OnKeyup="return cUpper(this);">
            </div> 
			  <span style="color:#d43f3a">
                         *
                      </span>  
			</div>

	<div class="form-group">
   <label class="control-label col-md-3">Account</label>
                  <div class="col-md-6">
             <select class="form-control" name="acco" required>
				<option value='' selected='selected'>SELECT ACCOUNT</option>
			<?php
			$doi=mysqli_query($cons, "SELECT *FROM `baccount` ORDER BY `Number` ASC");
			while($roi=mysqli_fetch_assoc($doi)){
				$nu=$roi['Number'];
				$fna=$roi['Bank'];
				$acco=$roi['Account'];
			echo"<option value='$nu' title='$fna $acco'> $fna $acco </option>";
			}
			?>   
                            </select>
            </div> 
			  <span style="color:#d43f3a">
                         *
                      </span>  
			</div>

  <div class="form-group">
            <label class="control-label col-md-3"><br>&nbsp;</label>
            <div class="col-md-2" style='margin-right:30px;'>
              <br><input name="user" class="form-control" value="<?php echo $user ?>" type="text" style='width:210px;' readonly> &nbsp;&nbsp; 
			 </div> 

			  <label class="control-label col-md-1"><br>Date</label>
			<div class="col-md-5"><br>
			  <input name="dato" id="from" class="form-control" value="<?php echo $dato ?>" type="text" style='width:210px; text-align:center;' required>
            </div> 
 </div>

 <div class="form-group">
  <label class="control-label col-md-2"> </label>
    <label class="control-label col-md-3">Document File</label>
                     <div class="col-md-1">
              <div class="fileupload fileupload-new" data-provides="fileupload"><input value="<?php echo $rowid ?>" name="rowid" type="hidden">
                <span class="btn btn-default btn-file"><span class="fileupload-new">Select</span><span class="fileupload-exists">Change</span><input name="file1" id="app_file" type="file" readonly='readonly'></span><span class="fileupload-preview"></span><button class="close fileupload-exists" data-dismiss="fileupload" style="float:none" type="button">×</button>
		<?php echo $dfile ?>
				
                     
              </div></div>
			  
			  &nbsp;&nbsp;&nbsp;&nbsp;<small>Zip, txt, jpeg, png, pdf, doc (Max : 2M)</small>
            
            </div>

  <div class="form-group">
  <div class="col-md-12">
  
		<div class="col-sm-1"> </div>
		 <div class="col-sm-9" align='center' style='border:0px solid black;'>
		 
		 <div id='DEPOSIT' class='hiddenDiv' style='border:0px;'>
		 <?php
		 if($_SESSION['Xacco']=='1'){
			 ?>
			 <div class="col-sm-1">  </div><div class="col-sm-5">
 <select class="form-control" name="source">
				<option value='SALES' selected='selected'>SALES</option>
			 <option value='CHEQUE'> CHEQUE </option><option value='OTHER'> OTHER </option>
			 <?php
			$doi=mysqli_query($cons, "SELECT *FROM `baccount` ORDER BY `Number` ASC");
			while($roi=mysqli_fetch_assoc($doi)){
				$nu=$roi['Number'];
				$fna=$roi['Bank'];
				$acco=$roi['Account'];
			echo"<option value='$acco' title='$fna $acco'> $fna $acco </option>";
			}
			?>   
                            </select>
	
	</div><div class="col-sm-5" style="margin-left:0px;">
	
	
	 <select class="form-control" name="branch">			
			 <?php
				echo"<option value='' selected='selected'> SELECT BRANCH </option>";
							
	$doi=mysql_query("SELECT `Number`, `Name` FROM `branches` WHERE `Status`='0' ORDER BY `Number` ASC");
			while($roi=mysql_fetch_assoc($doi)){
				$fna=$roi['Name'];
				$num=$roi['Number'];
			echo"<option value='$num' selected> $fna </option>";
			}
			?>			    
            </select></div>
			
			<div class="col-sm-1"> </div><br><br><br>
		 <button class="btn btn-lg btn-block btn-info" type="submit" name="depos"><i class="lnr lnr-exit-up"></i>&nbsp;&nbsp;BANK DEPOSIT </button> 
		 <?php
		}
		?></div>

			 <div id='WITHDRAWAL' class='hiddenDiv' style='border:0px;'>
		 <?php
		 if($_SESSION['Xacco']=='1'){
			 ?>
		
  <div class="col-sm-2">  </div><div class="col-sm-9">
  <div class='input-group'><select class="form-control" name="part">
				<option value='' selected='selected'> SELECT PARTICULAR </option>
			<?php
			$doi=mysqli_query($cons, "SELECT *FROM `parts` ORDER BY `Number` ASC");
			while($roi=mysqli_fetch_assoc($doi)){
				$nu=$roi['Number'];
				$fna=$roi['Parts'];
			echo"<option value='$fna' title='$fna'> $fna </option>";
			}
			?>   
         </select><span class='input-group-addon'><a href='#' data-placement='top' data-toggle='modal' data-target='#modal-x1123'>
		 <i class="lnr lnr-sync"></i></a></span>
	
	</div></div><div class="col-sm-1"> </div><br><br><br>

<button class="btn btn-lg btn-block btn-info" type="submit" name="withs">
		 <i class="lnr lnr-enter-down"></i>&nbsp;&nbsp;WITHDRAWAL </button> </div>
   </div>
      
 </div></div></form>
		 <?php
		}
 else{
			 ?></div>
   </div>
      
 </div></div></form>
 <?php
 }







 // ********************************************* Charge Types **************************************************************
	echo"<div id='modal-x1123' class='modal fade' role='dialog'>
  <div class='modal-dialog' role='document'>
    <div class='modal-content'>
      <div class='modal-header'>
        <h5 class='modal-title' id='exampleModalLabel'> CREATE A NEW PARTICULAR
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </h5>

      </div>
      <div class='modal-body' style='height:440px; overflow-y:auto;'>
	  <table class='table table-striped table-hover' style='margin-top:-15px;'>";
			$stl="padding:0px 2px; 0px 2px";
			$clr="";	  

		print("<tr><form method='post' action=''><td class='hidden-xs' style='$stl $clr'>
		<div align='center'>&nbsp;&nbsp;&nbsp;&nbsp;1&nbsp;&nbsp;</td>

						<td style='$stl $clr'><div align='left'>
						<input name='namei' class='form-control' type='text' style='text-align:left; width:320px; height:24px; margin:0px 0px 0px 0px; padding:0px 10px 0px 10px; background-color:transparent;' OnKeyup='return cUpper(this);' onChange=this.style.color='#ff3366'></td>

				<td style='$stl $clr'><div align='center'><button type='submit' class='btn btn-xs btn-success hidden-print' name='eddobon' style='height:22px; margin:0px 0px 0px 0px; padding:0px;' title='Add New' data-toggle='tooltip' data-placement='top'>&nbsp;&nbsp;<i class='lnr lnr-plus-circle'></i>&nbsp;&nbsp;</button></td></form></tr>");

				$i=2;
	  $dob=mysqli_query($cons, "SELECT *FROM `parts` ORDER BY `Parts` ASC");
		while($rob=mysqli_fetch_assoc($dob)){
			$num=$rob['Number'];
			$acco=$rob['Parts'];

			print("<tr style='height:10px;'><form method='post' action=''>
			<td class='hidden-xs' style='$stl $clr'><div align='center'>&nbsp;&nbsp;&nbsp;&nbsp;$i&nbsp;&nbsp;</td>

						<td style='$stl $clr'><div align='left'><input type='hidden' name='num' value='$num'>
						<input name='name' class='form-control' type='text' style='text-align:left; width:320px; height:24px; margin:0px 0px 0px 0px; padding:0px 10px 0px 10px; background-color:transparent;' OnKeyup='return cUpper(this);' value='$acco' onChange=this.style.color='#ff3366'></td>

						<td style='$stl $clr'><div align='center'><button type='submit' class='btn btn-xs btn-danger hidden-print' name='editobon' style='height:22px; margin:0px 0px 0px 0px; padding:0px;' title='Edit' data-toggle='tooltip' data-placement='top'>&nbsp;&nbsp;<i class='lnr lnr-trash'></i>&nbsp;&nbsp;</button></td></form></tr>");

						$i++;
		}

			echo"</table></div><div class='modal-header text-right' style='margin-top:-10px; height:50px; padding-top:15px; border:0px solid blue;'>
       
        <button type='button' class='btn btn-sm btn-warning' data-dismiss='modal' style='height:30px; padding-top:0px; width:120px;'>CLOSE</button>
      </div>
    </div>
  </div>
</div>";

// *************************************************** End of Modal ************************************************************
 ?>
 
 </form>
 </div>
 </div>
 </div>
 </div> 
</div>  
   <?php
   include'footer.php';
   ?>