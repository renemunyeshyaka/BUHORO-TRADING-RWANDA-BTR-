 <?php
 print("<div id='modal-x11' class='modal fade' role='dialog' style='border-radius:5px;'>
  <div class='modal-dialog' style='border-radius:5px;'><div class='modal-content text-left' style='border-radius:5px;'>
      <form action='branches.php' method='post'><div class='modal-header text-left'>
        <h4 class='modal-title' text-left' style='color:#996633;'>ADD A PAYMENT &nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;  $balo RWF </h4>
      <button type='button' class='btn btn-default' data-dismiss='modal' style='margin:0px; float:right; margin-top:-30px; margin-right:15px;'>Close</button>
      </div>
      <div class='modal-body text-center' style='height:auto'>

		<div class='row' style='margin-bottom:20px;'><div class='col-sm-6 text-center'>
           <input name='amo' class='form-control text-center' maxlength='10' type='text' placeholder='Paid Amount' onkeyup='format(this);' OnClick=this.value='' value='$balo' title='Paid Amount' data-toggle='tooltip' data-placement='top' required></div>

		   <div class='col-sm-6 text-center'>
           <select name='mode' class='form-control' onchange='showDiv(this.value);' title='Customers list' required>
		   <option value='CASH' selected> Mode of Payment </option>");			
				print("<option value='CASH'> CASH </option><option value='CHEQUE'> CHEQUE </option>
				<option value='BANK'> DEPOSIT </option><option value='CREDIT'> CREDIT </option>");
			
			print("</select></div></div>");
			?>
			
            <div class="col-md-12">
 <div id="<?php echo"CHEQUE" ?>" class='hiddenDiv' style="border:1px solid #6666ff; border-radius:5px; padding:15px; color:#000099; 
 font-weight:normal; height:95px; padding-top:15px; width:100%; margin-top:10px; margin-bottom:20px;">

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
					</div>
							</div>



            <div class="col-md-12">
 <div id="<?php echo"BANK" ?>" class='hiddenDiv' style="border:1px solid #6666ff; border-radius:5px; padding:15px; color:#000099; 
 font-weight:normal; height:95px; padding-top:15px; width:100%; margin-top:0px; margin-bottom:20px;">

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
					</div>
							</div>


							
            <div class="col-md-12">
 <div id="<?php echo"CREDIT" ?>" class='hiddenDiv' style="border:1px solid #6666ff; border-radius:5px; padding:15px; color:#000099; 
 font-weight:normal; height:60px; padding-top:0px; width:100%; margin-top:0px; margin-bottom:20px;">

	<div class="col-md-6"><div align='right'><br> Date of Payment
			&nbsp;:&nbsp; </div></div><div class="col-md-6"><br>
	<input class="form-control form-center" name="crpa" type="text" value="<?php echo $Date ?>" onkeypress='return isNumberKey(event)' style="height:22px;">
		
			</div>
					</div>
							</div>


		
            <div class="col-md-12">
 <div id="<?php echo"CASH" ?>" class='hiddenDiv' style="border:1px solid #6666ff; border-radius:5px; padding:15px; color:#000099; 
 font-weight:normal; height:60px; padding-top:0px; width:100%; margin-top:0px; margin-bottom:20px;">

	<div class="col-md-6"><div align='right'><br> Date of Payment
			&nbsp;:&nbsp; </div></div><div class="col-md-6"><br>
	<input class="form-control form-center" name="capa" type="text" value="<?php echo $Date ?>" onkeypress='return isNumberKey(event)' style="height:22px;">
		
			</div>
					</div>
							</div>
		<?php
		$sos=mysql_query("SELECT `Plate`, `Location` FROM `stouse` WHERE `Voucher`='0' AND `Action`='SALES' AND `User`='$loge' AND `Status`='0' ORDER BY `Number` ASC LIMIT 100");
			if($fos=mysql_num_rows($sos)){
			$ros=mysql_fetch_assoc($sos);
				$plat=$ros['Plate'];
				$los=$ros['Location'];
			}
			else{
				$plat=$los="";
			}
		?>
			<div class="col-sm-12 text-center" style="border:1px solid #00ffff; padding-left:0px; padding-right:0px; height:45px; margin-bottom:20px; border-radius:5px; padding-top:10px;">
<div class='col-sm-6 text-center'><input class="form-control form-center text-info" name="plate" type="text" placeholder="Plate No" OnKeyup='return cUpper(this);' value="<?php echo $plat ?>" style="height:28px;"></div>
<div class='col-sm-6 text-center'><input class="form-control text-info" name="locat" type="text" placeholder="Location" value="<?php echo $los ?>" style="height:28px;"></div></div>

<div id='toggleText' style='display: none; height:80px;'>
<div class="col-md-2" style="padding-top:10px;"> Write any <br> Reference </div>
<div class="col-md-10"><textarea name="comme" class="form-control" style="margin:0px;"><?php echo $comme ?></textarea></div></div><div class="row"> </div>
							
							<?php
	print("
	<div class='col-sm-6 text-center'><input name='namei' class='form-control' type='text' style='text-align:left; background-color:transparent;' OnKeyup='return cUpper(this);' onChange=this.style.color='blue' placeholder='Seller' value='$seller' list='desco' required><datalist id='desco'>");
$select =mysql_query("SELECT `Seller` FROM `payment` WHERE (`Seller` != '' AND `Status` = '0' AND `Action`='SALES') GROUP BY `Seller` ORDER BY `Seller` ASC");
while ($row=mysql_fetch_array($select)) 
{
 echo"<option value='".$row['Seller']."'>";
}	
	
	print("</datalist></div>
 
 <div class='col-sm-2'><button type='button' class='btn btn-block btn-default' name='button' title='Add Comment' data-toggle='tooltip' data-placement='top' onclick='javascript:toggle();'> <i class='lnr lnr-pencil'></i> </button></div>
 
 <div class='col-sm-4 text-center'><input type='hidden' value='$custo' name='custo'><button class='btn btn-block btn-success' type='submit' name='paid' title='Pay' data-toggle='tooltip' data-placement='top'>
	<i class='lnr lnr-briefcase'></i> &nbsp; TAKE </button></div> 
	  
		</div></form><br><br>");

echo" </div></div></div>";
	?>