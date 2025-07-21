<?php
 echo"<div class='modal fade' id='modal-xi1020$n' tabindex='-1' role='dialog' aria-labelledby='exampleModalLabel' aria-hidden='true'>
  <div class='modal-dialog' role='document'><div class='modal-content'><div class='modal-header text-left'><form action='' method='post' class='form-horizontal' enctype='multipart/form-data'>
        <h5 class='modal-title' id='exampleModalLabel'>LOAD CONTAINER INTERCHANGE <span class='pull-right'>
	<input type='hidden' value='$code' name='code'>
		<button type='$dbl' name='codele' class='btn btn-xs btn-danger' style='width:80px;'> DELETE </button>
		
		<button type='button' class='btn btn-xs btn-default' data-dismiss='modal' style='width:80px;'> CLOSE </button></span></h5></form>

      </div><form action='' method='post' class='form-horizontal' enctype='multipart/form-data'>
      <div class='modal-body text-left'><div class='row'>

        <div class='form-group'>
			<div class='col-md-5' align='right' style='padding-top:10px'> 
            <label class='control-label'>Container&nbsp;a&nbsp;No</label></div>
            <div class='col-md-6'>
<select class='form-control' name='conte' style='font-size:16px; height:34px;' required>
	 <option value='$conte'> $conte </option></select></div>    
		</div></div>
		
		
		<div class='row'>
		<div class='form-group'>
			<div class='col-md-5' align='right' style='padding-top:10px'> 
            <label class='control-label'>Date of Return</label></div>
            <div class='col-md-6'><div class='input-group date' data-provide='datepicker'><input class='form-control form-center' name='rdate' type='text' value='$Date' onkeypress='return isNumberKey(event)' required><div class='input-group-addon'><span class='lnr lnr-calendar-full'></span></div></div></div></div>
            </div>
           
           <div class='row'> 
        <div class='form-group'>
			<div class='col-md-5' align='right' style='padding-top:10px'> 
            <label class='control-label'>Description</label></div>
            <div class='col-md-6'><input class='form-control' value='$deso' name='deso' type='text'></div></div></div>   
            
        
        
        
        
                 <div class='row' style='text-align:center;'>
 <div class='fileupload fileupload-new' data-provides='fileupload' style=''>
        <span class='btn btn-default btn-file'><span class='fileupload-new'>Select</span><span class='fileupload-exists'>Change</span><input name='file1' id='app_file' type='file' readonly='readonly'></span><span class='fileupload-preview'></span><button class='close fileupload-exists' data-dismiss='fileupload' style='float:none' type='button'>&times;</button>
        <br><small>Zip, txt, jpeg, png, pdf, doc (Max : 2M)</small></div>
             </div><br><br>    
                </div>
		
	<div class='modal-header text-right' style='height:50px; padding-top:15px;'>	<input type='hidden' value='$p' name='p'>
	<input type='hidden' value='$dato' name='dato'>
	<input type='hidden' value='$datos' name='datos'>
	<input type='hidden' value='$custo' name='custo'>
	<input type='hidden' value='$code' name='code'>
		<button type='button' class='btn btn-xs btn-default' data-dismiss='modal' style='width:80px;'> CLOSE </button>
        <button type='submit' name='savere' class='btn btn-xs btn-success' style='width:80px;'> SAVE </button></div>
      </form>
  </div></div>
</div>";
?>