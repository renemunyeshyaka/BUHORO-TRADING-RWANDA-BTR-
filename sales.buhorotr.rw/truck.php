 <?php
 print("<div id='modal-x11' class='modal fade' role='dialog' style='border-radius:5px;'>
  <div class='modal-dialog' style='border-radius:5px;'>
  <div class='modal-content text-left' style='border-radius:5px;'>
      <form action='purchase.php' method='post'>
      <div class='modal-header text-left'>
    <h4 class='modal-title' text-left' style='color:#996633;'> CREATE NEW ORDER </h4>
      <button type='button' class='btn btn-default' data-dismiss='modal' style='margin:0px; float:right; margin-top:-30px; margin-right:15px;'>Close</button>
      </div>
      <div class='modal-body text-center' style='height:auto'>

		<div class='row' style='margin-bottom:20px;'>
		<div class='col-md-12'><div class='col-sm-6 text-center'>
    <select name='truck' class='form-control' onchange='showDiv(this.value);' title='List of Trucks' required>
		   <option value='' selected> SELECT A TRUCK </option>");			
	print("<option value='CREATE_NEW' style='color:blue;'> CREATE NEW TRUCK </option>");
	
	$dois=mysqli_query($cons, "SELECT `Number`, `Truck`, `Trailer` FROM `truck` WHERE `Upda`>'$dase' GROUP BY `Truck` ORDER BY `Truck` ASC");
			while($rois=mysqli_fetch_assoc($dois)){
			    $nuos=$rois['Number'];
				$truk=$rois['Truck'];
				$trai=$rois['Trailer'];
	    echo"<option value='$nuos'> $truk &nbsp; $trai </option>";
			}
			
			print("</select></div><div class='col-sm-6 text-center'>
           <input name='qty' class='form-control text-center' maxlength='10' type='text' placeholder='Quantity (TONS)' onkeyup='format(this);' onkeypress='return isNumberKey(event)' title='Quantity (Tons)' data-toggle='tooltip' data-placement='top' required></div>

		   </div></div>");
			?>
			
            <div class="col-md-12">
 <div id="<?php echo"CREATE_NEW" ?>" class='hiddenDiv' style="border:1px solid #6666ff; border-radius:5px; padding:15px; color:#000099; 
 font-weight:normal; height:150px; padding-top:15px; width:100%; margin-top:20px; margin-bottom:30px;">

<div class="col-md-6"><input class="form-control form-center" name="truco" type="text" placeholder="TRUCK ID" OnKeyup='return cUpper(this);' style="height:26px;"></div>
		<div class="col-md-6"><input class="form-control form-center" name="traiso" type="text" placeholder="TRAILER ID" OnKeyup='return cUpper(this);' style="height:26px;"></div>
		

<div class="col-md-6"><br><input class="form-control" name="drivo" type="text" placeholder="DRIVER NAME" OnKeyup='return cUpper(this);' style="height:26px;"></div>
		<div class="col-md-6"><br><input class="form-control" name="lico" type="text" placeholder="ID/LICENSE NO" OnKeyup='return cUpper(this);' style="height:26px;"></div>
		

		<div class="col-md-6"><br><input class="form-control form-center" name="telo" type="text" placeholder="TELEPHONE NO" onkeypress='return isNumberKey(event)' style="height:26px;"></div>

	
							</div></div>



            		
							
							<?php
	print("<div class='col-sm-6 text-center'><select name='weit' class='form-control' title='List of Weight' required>
	<option value=''> SELECT WEIGHT </option><option value='25KG'> 25KG </option><option value='50KG'> 50KG </option><option value='25KG OR 50KG'> 25KG OR 50KG </option></select></div>			
 
 <div class='col-sm-6 text-center'>
 <button class='btn btn-block btn-success' type='submit' name='adpaid' title='Save' data-toggle='tooltip' data-placement='top'>
	<i class='lnr lnr-briefcase'></i> &nbsp; SAVE </button></div> 
	  
		</div></form><br><br>");

echo"</div></div></div>";
	?>