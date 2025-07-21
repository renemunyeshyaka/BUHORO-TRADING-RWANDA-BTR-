<?php
// ****************************** Invoice payment modal *********************************
		echo"<div class='modal fade' id='exampleModalo$i' tabindex='-1' role='dialog' aria-labelledby='exampleModalLabel' aria-hidden='true' 
		style='top:20px;'>
  <div class='modal-dialog' role='document'>
    <div class='modal-content'>
      <div class='modal-header'>
        <h5 class='modal-title' id='exampleModalLabel'>ADD A PAYMENT 
    <label class='pull-right'><b>$dst : &nbsp;&nbsp; $balo</b>
            </label></h5>

      </div>
      <div class='modal-body' style='text-align:center; height:auto; font-size:14px;'><form action='' method='post'>";

	  if($bal>0)
		$pa=$balo;
	else
		$pa="0.00";
	 
	?>

 <div class="col-md-3" align="right">
			 <label class="control-label">Done&nbsp;By</label></div> 
			 
	<div class="col-md-4">
			 <input name="usa" class="form-control" type="text" value="<?php echo $loge ?>" style='height:30px; width:160px' readonly></div>

		<div class="col-md-1 text-right"> &nbsp;Date </div> 
			
	<div class="col-md-4"><div class="input-group date" data-provide="datepicker"><input class="form-control form-center" name="dati" type="text" value="<?php echo $Date ?>" onkeypress='return isNumberKey(event)' style="height:30px;" required><div class="input-group-addon"><span class="lnr lnr-calendar-full"></span></div>
			</div></div><div class="col-md-12"> </div><div class="row"> </div><div class="col-md-1"> </div>

<div class="col-md-2 text-right" style="margin-top:30px;"> Paid&nbsp;Amount </div> 

 <div class="col-md-3" align="right" style="margin-top:30px;">
 <input name="amo" class="form-control text-center" type="text" onkeyup='format(this);' onkeypress='return isNumberKey(event)' value="<?php echo $balo ?>" style='height:28px;' placeholder="Paid Amount"></div><div class='col-md-3' style='padding-left:0px;margin-top:30px;'>
		   <?php
		   echo"<select class='form-control' name='currency' style='padding-left:1px; padding-right:0px; font-size:14px; height:28px; padding-top:4px;' required>
		   <option value='' selected='selected'>Currency</option>";
			 
			$doi=mysqli_query($conn, "SELECT `Code`, `Rate` FROM `currency` WHERE `Code`!='' ORDER BY `Code` ASC");
			while($roi=mysqli_fetch_assoc($doi)){
				$fna=$roi['Code'];
				$rate=$roi['Rate'];
				$rte=number_format($rate, 2);
				if($curr==$fna)
					$sc="selected";
				else
					$sc="";
			echo"<option value='$rate' $sc> $fna @ $rte </option>";
			}
		
		   echo"</select>";
		   ?>
            </div>	   
		   
		   
		   
		   <div class="col-md-2" align="right" style="margin-top:30px;">
<SELECT name='pline' class='form-control' style='width:120px; font-size:14px; height:28px; padding-top:4px;' onchange='showDiv(this.value);'>
				<OPTION VALUE='CASH' SELECTED>CASH</OPTION>
				<OPTION value='DEPOSIT'>DEPOSIT</OPTION>
				<OPTION VALUE='CHEQUE'>CHEQUE</OPTION>
				<OPTION VALUE='TRANSFER'>TRANSFER</OPTION>
					</SELECT></div>
		   
	<div class="row"> </div><div class="col-md-1"> </div>	   
	<div class="col-md-2 text-right" style="margin-top:30px;"> Reference </div> <div class="col-md-4" align="right" style="margin-top:30px;">
 <input name="refo" class="form-control" type="text" style='height:28px;' placeholder="Payment Reference"></div><div class="col-md-5" style="padding-top:20px; margin-bottom:20px; height:100px; text-align:center;">
     
    <div class="fileupload fileupload-new" data-provides="fileupload" style=''>
        <span class="btn btn-default btn-file"><span class="fileupload-new">Select</span><span class="fileupload-exists">Change</span><input name="file1" id="app_file" type="file" readonly='readonly'></span><span class="fileupload-preview"></span><button class="close fileupload-exists" data-dismiss="fileupload" style="float:none" type="button">&times;</button>
        <br><small>Zip, txt, jpeg, png, pdf, doc (Max : 2M)</small></div>
             </div>
                <div class="row"> </div>

           

<?php
	echo"</div><div class='modal-header' style='height:50px; text-align:right; padding:10px 20px 5px 5px;'>
    	<input type='hidden' name='custo' value='$custo'>
		<input type='hidden' name='dato' value='$dato'>
		<input type='hidden' name='p' value='$p'>
		<input type='hidden' name='supplier' value='$supplier'>
	<input type='hidden' name='datos' value='$datos'>
	<input type='hidden' name='code' value='$code'>
	<input type='hidden' name='count' value='$count'>
	<input type='hidden' name='pall' value='$pall'>
	<input type='hidden' name='balo' value='$balo'>
	<input type='hidden' name='cuso' value='$cuso'>
	<input type='hidden' name='gara' value='$gara'>
        <button type='button' class='btn btn-sm btn-default' style='width:80px' data-dismiss='modal'>&nbsp;CLOSE&nbsp;</button>
        <button type='submit' class='btn btn-sm btn-success' style='width:80px' name='addpa'>&nbsp;&nbsp;SAVE&nbsp;&nbsp;</button>
      </div></form>
    </div></div>
    </form></div>";

	// ***************************************************** End of modal ********************************************
	?>