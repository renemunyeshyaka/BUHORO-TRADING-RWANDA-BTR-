 <?php
 print("<div id='modal-x11' class='modal fade' role='dialog' style='border-radius:5px;'>
  <div class='modal-dialog' style='border-radius:5px;'><div class='modal-content text-left' style='border-radius:5px;'>
      <form action='billpay.php' method='post'><div class='modal-header text-left'>
        <h4 class='modal-title' text-left' style='color:#996633;'>SUPPLIER'S ADVANCE </h4>
      <button type='button' class='btn btn-default' data-dismiss='modal' style='margin:0px; float:right; margin-top:-30px; margin-right:15px;'>Close</button>
      </div>
      <div class='modal-body text-center' style='height:auto'>

		<div class='row' style='margin-bottom:20px;'><div class='col-sm-6 text-center'>
           <input name='amo' class='form-control text-center' maxlength='10' type='text' placeholder='Paid Amount' onkeyup='format(this);' OnClick=this.value='' title='Advance Amount' data-toggle='tooltip' data-placement='top' required></div>

		   <div class='col-sm-6 text-center'>
           <select name='mode' class='form-control' onchange='showDiv(this.value);' title='Customers list' required>
		   <option value='A-CASH' selected> Mode of Payment </option>");			
				print("<option value='A-CASH'> CASH </option><option value='A-CHEQUE'> CHEQUE </option>
				<option value='A-BANK'> DEPOSIT </option>");
			
			print("</select></div></div>");
			?>
			
            <div class="col-md-12">
 <div id="<?php echo"A-CHEQUE" ?>" class='hiddenDiv' style="border:1px solid #6666ff; border-radius:5px; padding:15px; color:#000099; 
 font-weight:normal; height:140px; padding-top:15px; width:100%; margin-top:10px; margin-bottom:20px;">

<div class="col-md-6"> <input class="form-control form-center" name="cheno" type="text" placeholder="CHEQUE No" onkeypress='return isNumberKey(event)' style="height:22px;"></div>
		<div class="col-md-6"><div align='right'><select class="form-control" name="cba" style="height:22px; padding:0px;">
				<option value='' selected='selected'>BANK NAME</option>
			<?php
			$dois=mysqli_query($cons, "SELECT `Fnames` FROM `banks` ORDER BY `Fnames` ASC");
			while($rois=mysqli_fetch_assoc($dois)){
				$bank=$rois['Fnames'];
			echo"<option value='$bank'> $bank </option>";
			}
			?>   
                            </select></div></div>

	<div class="col-md-6"><div align='right'><br> Date of Payment
			&nbsp;:&nbsp; </div></div><div class="col-md-6"><br>
	<input class="form-control form-center" name="chpa" type="text" value="<?php echo $Date ?>" onkeypress='return isNumberKey(event)' style="height:22px;">
		
			</div>					

					<div class="col-md-6"><div align='right'><br> Select a Branch
			&nbsp;:&nbsp; </div></div><div class="col-md-6"><br>
			 <select class="form-control" name="cbra" onclick="return pageScroll()" style="height:22px;; padding:0px;">			
			 <?php
				echo"<option value='' selected='selected'> SELECT A BRANCH </option>";
							
	$doi=mysql_query("SELECT `Number`, `Name` FROM `branches` WHERE `Status`='0' ORDER BY `Number` ASC");
		$foi=mysql_num_rows($doi);
			while($roi=mysql_fetch_assoc($doi)){
				$fna=$roi['Name'];
				$num=$roi['Number'];
				if($dst==$fna OR $foi==1)
					$s='selected';
				else
					$s='';
			echo"<option value='$num' $s> $fna </option>";
			}
			?>			    
            </select>
					</div></div>

							</div>



            <div class="col-md-12">
 <div id="<?php echo"A-BANK" ?>" class='hiddenDiv' style="border:1px solid #6666ff; border-radius:5px; padding:15px; color:#000099; 
 font-weight:normal; height:140px; padding-top:15px; width:100%; margin-top:0px; margin-bottom:20px;">

<div class="col-md-6"> <input class="form-control form-center" name="slino" type="text" placeholder="BANK SLIP No" onkeypress='return isNumberKey(event)' style="height:22px;"></div>
		<div class="col-md-6"><div align='right'><select class="form-control" name="acco" style="height:22px; padding:0px;">
				<option value='' selected='selected'>ACCOUNT NUMBER</option>
			<?php
			$dois=mysqli_query($cons, "SELECT *FROM `baccount` WHERE `Status`='0' ORDER BY `Number` ASC");
			while($rois=mysqli_fetch_assoc($dois)){
				$nu=$rois['Number'];
				$bank=$rois['Bank'];
				$acco=$rois['Account'];
				$purpo=$rois['Purpose'];
			echo"<option value='$nu' title='$purpo'> $bank $acco </option>";
			}
			?>   
                            </select></div></div>

	<div class="col-md-6"><div align='right'><br> Date of Deposit
			&nbsp;:&nbsp; </div></div><div class="col-md-6"><br>
	<input class="form-control form-center" name="cbpa" type="text" value="<?php echo $Date ?>" onkeypress='return isNumberKey(event)' style="height:22px;">
		
			</div>
					
					<div class="col-md-6"><div align='right'><br> Select a Branch
			&nbsp;:&nbsp; </div></div><div class="col-md-6"><br>
			 <select class="form-control" name="bbra" onclick="return pageScroll()" style="height:22px;; padding:0px;">			
			 <?php
				echo"<option value='' selected='selected'> SELECT A BRANCH </option>";
							
	$doi=mysql_query("SELECT `Number`, `Name` FROM `branches` WHERE `Status`='0' ORDER BY `Number` ASC");
		$foi=mysql_num_rows($doi);
			while($roi=mysql_fetch_assoc($doi)){
				$fna=$roi['Name'];
				$num=$roi['Number'];
				if($dst==$fna OR $foi==1)
					$s='selected';
				else
					$s='';
			echo"<option value='$num' $s> $fna </option>";
			}
			?>			    
            </select>
					</div></div>
							</div>

		
            <div class="col-md-12">
 <div id="<?php echo"A-CASH" ?>" class='hiddenDiv' style="border:1px solid #6666ff; border-radius:5px; padding:15px; color:#000099; 
 font-weight:normal; height:100px; padding-top:0px; width:100%; margin-top:0px; margin-bottom:20px;">

	<div class="col-md-6"><div align='right'><br> Date of Payment
			&nbsp;:&nbsp; </div></div><div class="col-md-6"><br>
	<input class="form-control form-center" name="capa" type="text" value="<?php echo $Date ?>" onkeypress='return isNumberKey(event)' style="height:22px;">
		
			</div>
			<div class="col-md-6"><div align='right'><br> Select a Branch
			&nbsp;:&nbsp; </div></div><div class="col-md-6"><br>
			 <select class="form-control" name="abra" onclick="return pageScroll()" style="height:22px;; padding:0px;">			
			 <?php
				echo"<option value='' selected='selected'> SELECT A BRANCH </option>";
							
	$doi=mysql_query("SELECT `Number`, `Name` FROM `branches` WHERE `Status`='0' ORDER BY `Number` ASC");
		$foi=mysql_num_rows($doi);
			while($roi=mysql_fetch_assoc($doi)){
				$fna=$roi['Name'];
				$num=$roi['Number'];
				if($dst==$fna OR $foi==1)
					$s='selected';
				else
					$s='';
			echo"<option value='$num' $s> $fna </option>";
			}
			?>			    
            </select>
					</div></div>
						</div>
					
							
							<?php
	print("<div class='col-sm-6 text-center'><input class='form-control' name='supo' type='text' placeholder='Select a Supplier' list='searchu' style='border:1px solid aqua;' required><datalist id='searchu'>");

	$select =mysql_query("SELECT `Supplier` FROM `suppliers` WHERE `Supplier` LIKE '%".$search."%' AND `Status` = '0' GROUP BY `Supplier` ORDER BY `Supplier` ASC");
while ($row=mysql_fetch_array($select)) 
{
 $data = $row['Supplier'];
 echo"<option value='$data'>";
}
	
	print("</datalist></div>			
 
 <div class='col-sm-6 text-center'>
 <button class='btn btn-block btn-success' type='submit' name='adpaid' title='Save' data-toggle='tooltip' data-placement='top'>
	<i class='lnr lnr-briefcase'></i> &nbsp; SAVE </button></div> 
	  
		</div></form><br><br>");

echo" </div></div></div>";
	?>