<?php
if(basename($_SERVER['PHP_SELF']) == 'pays.php') 
  $pr=" class='current'";
include'header.php';
include'connection.php';
$year=date("Y");
$namb="submit_pay";
			$valub="Submit";
			$dato=$Date;
			$month='';

?>
<div class="container-fluid main-content">
<div class="page-title">
 
 <h1 style='margin-top:-20px; margin-bottom: 5px;'>Create Payroll</h1>
  
    </div>
<div class="row">
<div class="col-md-2">
 
  <ul class="list-group">
   
         
        <li class="list-group-item active">
           <a href="slips.php">
           <p>
           <i class="lnr lnr-plus-circle"></i>&nbsp;Payrolls
           </p></a>
           </li>
		   <li class="list-group-item">
           <a href="dlist.php">
           <p>
           <i class="lnr lnr-menu-circle"></i>&nbsp;Deduction
           </p></a>
           </li>
		 <li class="list-group-item">
           <a href="alist.php">
           <p>
           <i class="lnr lnr-plus-circle"></i>&nbsp;Allowance
           </p></a>
           </li>
		 <li class="list-group-item">
           <a href="adlist.php">
           <p>
           <i class="lnr lnr-plus-circle"></i>&nbsp;Advance
           </p></a>
           </li>
            </ul>
       
          
        </div>
 <div class="col-md-10">
 <div class="widget-container fluid-height clearfix">
 <div class="widget-content padded">
 <form method="post" class="form-horizontal" action="slips.php" enctype="multipart/form-data">
 <input name="app_file_size" id="app_file_size" type="hidden">

  <?php 
if($pto==10)
echo"<center><div class='alert alert-danger' style='width:48%;text-align:center;float:center;background-color: #60c560;color: #ffffff;border-radius:5px;'>
		<i class='lnr lnr-checkmark-circle'></i> &nbsp;&nbsp; <button class='close' data-dismiss='alert' type='button'>×</button>New Payrool Has Been Submitted.
		</div></center>";

if($pto==20)
echo"<center><div class='alert alert-danger' style='width:48%;text-align:center;float:center;background-color: #60c560;color: #ffffff;border-radius:5px;'>
		<i class='lnr lnr-checkmark-circle'></i> &nbsp;&nbsp; <button class='close' data-dismiss='alert' type='button'>×</button>Payrool Request Has Been Updated.
		</div></center>";

		echo"<input value='$rowid' name='rowid' type='hidden'><input value='$file1' name='file1' type='hidden'>";
		?>

 <div class="form-group">
            <label class="control-label col-md-3">Due Date</label>
            <div class="col-sm-2" style='width:240px;'>
			 <div class="input-group date datepicker">
      <input class="form-control form-center" id="from" name="dato" type="text" value="<?php echo $dato ?>" onkeypress='return isNumberKey(event)' required>
	  <span class="input-group-addon"><i class="lnr lnr-calendar-full"></i></span>
              </div>
            </div>
           
 </div>

  <div class="form-group">
            <label class="control-label col-md-3">Done by</label>
            <div class="col-md-6">
              <input name="user" class="form-control" type="text" value="<?php echo $loge ?>" readonly="readonly" required>
            </div>
 </div>


 <div class="form-group">
 <label class="control-label col-md-3">Month / Year</label>
            <div class="col-sm-2" style='margin-right:132px;'>
 <select class="form-control" name="month" style='width:200px;' required>
	<option value="" selected="selected"> </option>
              <?php
    for ($i = 1; $i < 13;   $i++) {
     $date_str = date("F", mktime(0, 0, 0, $i, 10));
	if($date_str==$month)
		$st='selected';
	else
		$st='';
    echo "<option value='$date_str' $st>".$date_str ."</option>";
    } 
	?>
              </select>  
	 </div>
            <div class="col-sm-2">
	<select class="form-control" name="year" style='width:203px;' required>
		<option value="" selected="selected"> </option>
                 <?php
				 $l=date("Y")+2;
				 $e=$l-11;
    for ($i = $l; $i > $e;   $i--) {
		if($i==$year)
			$si='selected';
		else
			$si='';
    echo "<option value='$i' $si>".$i."</option>";
    } 
	?>
              </select> 
	</div></div>


 <div class="form-group"><br><br>
  <div class="col-md-2"> </div>
    <label class="control-label col-md-3">Document File</label>
                     <div class="col-md-6">
              <div class="fileupload fileupload-new" data-provides="fileupload"><input value="" name="" type="hidden">
                <span class="btn btn-default btn-file"><span class="fileupload-new">Select</span><span class="fileupload-exists">Change</span><input name="file1" id="app_file" type="file"></span><span class="fileupload-preview"></span><button class="close fileupload-exists" data-dismiss="fileupload" style="float:none" type="button">×</button>
				
				<?php echo $dfile ?>
                     
              </div>     <small>Zip, txt, jpeg, png, pdf, doc (Max : 2M)</small>
            </div> 
            
            
            
            </div>
  <div class="form-group">
  <div class="col-md-12">
  <div class="col-md-3"></div>
   <div class="col-md-3">                 
    <button class="btn btn-lg btn-block btn-success" type="submit" name="<?php echo $namb ?>"><i class="lnr lnr-checkmark-circle"></i> <?php echo $valub ?> </button>         
   </div>   
		
		 <div class="col-sm-2" align='center' style='border:0px solid black; width:255px;'>
		 <button class="btn btn-lg btn-block btn-danger" type="button" style='width:210px;' onClick="location.href='slips.php'">
		 <i class="lnr lnr-undo"></i> Cancel </button>    
 </div></div>
 
 </form>
 </div>
 </div>
<?php
include'footer.php';
?>