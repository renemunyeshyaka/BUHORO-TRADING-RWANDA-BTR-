<?php
if(basename($_SERVER['PHP_SELF']) == 'deduct.php') 
  $pp=" class='current'";
include'header.php';
include'connection.php';
$pto=0;

if(isset($_POST['submit_duct']))
		{
			$emplo=$_POST['emplo'];
			$amo=$_POST['amo'];
				$amo=preg_replace('/,/', '', $amo);
			$purpo=$_POST['purpo'];
			$m1=$_POST['m1'];
			$y1=$_POST['y1'];
			$a1=$_POST['a1'];
				$a1=preg_replace('/,/', '', $a1);
			$m2=$_POST['m2'];
			$y2=$_POST['y2'];
			$a2=$_POST['a2'];
				$a2=preg_replace('/,/', '', $a2);
			$m3=$_POST['m3'];
			$y3=$_POST['y3'];
			$a3=$_POST['a3'];
				$a3=preg_replace('/,/', '', $a3);
			$m4=$_POST['m4'];
			$y4=$_POST['y4'];
			$a4=$_POST['a4'];
				$a4=preg_replace('/,/', '', $a4);
			$user=$_POST['user'];
			$dato=$_POST['dato'];

	$temp1 = explode(".", $_FILES["file1"]["name"]);
$newfilename1 = round(microtime(true)) . '.' . end($temp1);
move_uploaded_file($_FILES["file1"]["tmp_name"], "file4/" . $newfilename1);
	if(!end($temp1))
	$newfilename1='';

			$amount=$a1+$a2+$a3+$a4;
		if($amount==$amo){
$so=mysql_query("INSERT INTO `deduct` (`Employee`, `Amount`, `Purpose`, `M1`, `Y1`, `A1`, `M2`, `Y2`, `A2`, `M3`, `Y3`, `A3`, `M4`, `Y4`, `A4`, `File1`, `User`, `Date`) VALUES ('$emplo', '$amo', '$purpo', '$m1', '$y1', '$a1', '$m2', '$y2', '$a2', '$m3', '$y3', '$a3', '$m4', '$y4', '$a4', '$newfilename1', '$loge', '$dato')");
		$pto=10;
		}
		else{
			$pto=40;
		}

			$emplox=$emplo;
			$amox=$amo;
			$purpox=$purpo;
			$m1x=$m1;
			$y1x=$y1;
			$a1x=$a1;
			$m2x=$m2;
			$y2x=$y2;
			$a2x=$a2;
			$m3x=$m3;
			$y3x=$y3;
			$a3x=$a3;
			$m4x=$m4;
			$y4x=$y4;
			$a4x=$a4;
			$userx=$user;
			$datox=$dato;
		}

		if(isset($_POST['edit_id']))
		{
			$rowid=$_POST['rowid'];
			$do=mysql_query("SELECT *FROM `deduct` WHERE `Number`='$rowid' LIMIT 1");
				$ro=mysql_fetch_assoc($do);
					$code=$ro['Number'];
					$amo=$ro['Amount'];
			$emplo=$ro['Employee'];
			$purpo=$ro['Purpose'];
			$m1=$ro['M1'];
			$y1=$ro['Y1'];
			$a1=$ro['A1'];
			$m2=$ro['M2'];
			$y2=$ro['Y2'];
			$a2=$ro['A2'];
			$m3=$ro['M3'];
			$y3=$ro['Y3'];
			$a3=$ro['A3'];
			$m4=$ro['M4'];
			$y4=$ro['Y4'];
			$a4=$ro['A4'];
			$user=$ro['User'];
			$dato=$ro['Date'];

					$file1=$ro['File1'];
					if($file1)
	$dfile="&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href='down_duct.php?link=$file1'>Download File</a>";
else
	$dfile="";

				$namb="update_duct";
				$valub="Update";
		}
		else{
			$emplo='';
			$amo='';
			$purpo='';
			$m1='';
			$y1=0;
			$a1='';
			$m2='';
			$y2=0;
			$a2='';
			$m3='';
			$y3=0;
			$a3='';
			$m4='';
			$y4=0;
			$a4='';
			$user=$loge;
			$dato=$Date;

			$dfile="";
			$rowid=0;
			
			$namb="submit_duct";
				$valub="Submit";
		}

		if(isset($_POST['update_duct']))
		{
			$rowid=$_POST['rowid'];
			$emplo=$_POST['emplo'];
			$amo=$_POST['amo'];
				$amo=preg_replace('/,/', '', $amo);
			$purpo=$_POST['purpo'];
			$m1=$_POST['m1'];
			$y1=$_POST['y1'];
			$a1=$_POST['a1'];
				$a1=preg_replace('/,/', '', $a1);
			$m2=$_POST['m2'];
			$y2=$_POST['y2'];
			$a2=$_POST['a2'];
				$a2=preg_replace('/,/', '', $a2);
			$m3=$_POST['m3'];
			$y3=$_POST['y3'];
			$a3=$_POST['a3'];
				$a3=preg_replace('/,/', '', $a3);
			$m4=$_POST['m4'];
			$y4=$_POST['y4'];
			$a4=$_POST['a4'];
				$a4=preg_replace('/,/', '', $a4);
			$user=$loge;
			$dato=$Date;

	$temp1 = explode(".", $_FILES["file1"]["name"]);
$newfilename1 = round(microtime(true)) . '.' . end($temp1);
move_uploaded_file($_FILES["file1"]["tmp_name"], "deduct/" . $newfilename1);
	if(!end($temp1)){
	$newfilename1='';
	$upda="";
	}
	else{
	$upda=", `File1`='$newfilename1'";
	}

	$amount=$a1+$a2+$a3+$a4;
		if($amount==$amo){
$so=mysql_query("UPDATE `deduct` SET `Employee`='$emplo', `Amount`='$amo', `Purpose`='$purpo', `M1`='$m1', `Y1`='$y1', `A1`='$a1', `M2`='$m2', `Y2`='$y2', `A2`='$a2', `M3`='$m3', `Y3`='$y3', `A3`='$a3', `M4`='$m4', `Y4`='$y4', `A4`='$a4', `File1`='$newfilename1', `User`='$loge', `Date`='$dato' WHERE `Number`='$rowid' LIMIT 1");
		$pto=20;
		}
		else{
			$pto=40;
		}

			$emplox=$emplo;
			$amox=$amo;
			$purpox=$purpo;
			$m1x=$m1;
			$y1x=$y1;
			$a1x=$a1;
			$m2x=$m2;
			$y2x=$y2;
			$a2x=$a2;
			$m3x=$m3;
			$y3x=$y3;
			$a3x=$a3;
			$m4x=$m4;
			$y4x=$y4;
			$a4x=$a4;
			$userx=$user;
			$datox=$dato;

				$namb="update_duct";
				$valub="Update";
		}

		if($pto=='40'){
			$emplo=$emplox;
			$amo=$amox;
			$purpo=$purpox;
			$m1=$m1x;
			$y1=$y1x;
			$a1=$a1x;
			$m2=$m2x;
			$y2=$y2x;
			$a2=$a2x;
			$m3=$m3x;
			$y3=$y3x;
			$a3=$a3x;
			$m4=$m4x;
			$y4=$y4x;
			$a4=$a4x;
			$user=$userx;
			$dato=$datox;
			}
		


//$do=mysql_query("SELECT *FROM `position`");
//$fo=mysql_num_rows($do);
?>
<div class="container-fluid main-content">
<div class="page-title">
        <h1 style='margin-top:-20px; margin-bottom: 5px;'>Deduction</h1>
  
    </div>
<div class="row">
<div class="col-md-2">
 
  <ul class="list-group">
   
      <li class="list-group-item">
	  <a href="dlist.php">
                <p>
                <i class="lnr lnr-menu-circle"></i>&nbsp;List
                </p>
              </a></li>  

	   <li class="list-group-item active">
              <a href="deduct.php">
                <p>
                <i class="lnr lnr-plus-circle"></i>&nbsp;Add
                </p>
              </a></li> 
          </ul>
        </div>
 <div class="col-md-10">
 <div class="widget-container fluid-height clearfix">
 <div class="widget-content padded">
 <form method="post" class="form-horizontal" action="deduct.php" enctype="multipart/form-data">
 <input name="app_file_size" id="app_file_size" type="hidden">
 <br>
 <?php 
if($pto==10)
echo"<center><div class='alert alert-danger' style='width:48%;text-align:center;float:center;background-color: #60c560;color: #ffffff;border-radius:5px;'>
		<i class='lnr lnr-checkmark-circle'></i> &nbsp;&nbsp; <button class='close' data-dismiss='alert' type='button'>×</button>Deduction Record Has Been Created.
		</div></center>";
if($pto==20)
echo"<center><div class='alert alert-danger' style='width:48%;text-align:center;float:center;background-color: #60c560;color: #ffffff;border-radius:5px;'>
		<i class='lnr lnr-checkmark-circle'></i> &nbsp;&nbsp; <button class='close' data-dismiss='alert' type='button'>×</button>Deduction Record Has Been Updated.
		</div></center>";
if($pto==30)
echo"<center><div class='alert alert-danger' style='width:48%;text-align:center;float:center;border-radius:5px;'>
		<i class='lnr lnr-checkmark-circle'></i> &nbsp;&nbsp; <button class='close' data-dismiss='alert' type='button'>×</button>Nothing Has Been Changed.
		</div></center>";
if($pto==40)
echo"<center><div class='alert alert-danger' style='width:48%;text-align:center;float:center;border-radius:5px;'>
		<i class='lnr lnr-sad'></i> &nbsp;&nbsp; <button class='close' data-dismiss='alert' type='button'>×</button>Schedle payment is not equal to deducted amount.
		</div></center>";
	
			echo"<input value='$code' name='rowid' type='hidden'>";
			?>
			<div class="form-group">
            <label class="control-label col-md-3">Employee</label>
            <div class="col-md-6">
           <select class="form-control" name="emplo" required>
				<option value='' selected='selected'>Select Employee</option>
			 <?php
			$doi=mysql_query("SELECT *FROM `employees` WHERE `Status`='0' ORDER BY `Fname` ASC");
			while($roi=mysql_fetch_assoc($doi)){
				$code=$roi['Eid'];
				$fna=$roi['Fname'];
				$lna=$roi['Lname'];
				if($code==$emplo)
					$sle="selected='selected'";
				else
					$sle='';
			echo"<option value='$code' $sle> $fna $lna </option>";
			}
			?>    
                            </select>
            </div>
			<span style="color:#d43f3a">
                         mandatory
                      </span>  
 </div>
  <div class="form-group">
            <label class="control-label col-md-3">Total Amount</label>
            <div class="col-md-6">
              <input name="amo" class="form-control" type="text" value="<?php echo $amo ?>" onkeypress='return isNumberKey(event)' onkeyup='format(this);' required>
            </div>
			  <span style="color:#d43f3a">
                         mandatory
                      </span>  
 </div>
 <div class="form-group">
   <label class="control-label col-md-3">Purpose/Issue</label>
                  <div class="col-md-6">
              <input class="form-control" name="purpo" type="text" value="<?php echo $purpo ?>" required>
            </div> 
			  <span style="color:#d43f3a">
                         mandatory
                      </span>  
			</div>

<hr width='60%'><div style='margin-top:-30px; float: right; margin-right:40px;'>
<a href='javascript:toggle()'; id='displayText' title='Repayment Schedle'>Repayment Schedle</a></div>


<div id='toggleText' style='display: none'>
 <fieldset style='border: 1px solid #999999; padding-top:20px; border-radius:5px; float: center; margin-left:15%; margin-right:15%;'>
 <div class="form-group"> <br><br>
 <label class="control-label col-md-2">1)&nbsp;&nbsp;</label>
            <div class="col-sm-1" style='margin-right:120px;'>
 <select class="form-control" name="m1" style='width:120px;' required>
	<option value="" selected="selected"> Month </option>
              <?php
    for ($i = 1; $i < 13;   $i++) {
    $date_str = date("F", mktime(0, 0, 0, $i, 10));
	if($date_str==$m1)
		$st='selected';
	else
		$st='';
    echo "<option value='$date_str' $st>".$date_str ."</option>";
    } 
	?>
              </select>  
	 </div>
            <div class="col-sm-2" style='margin-right: 50px;'>
	<select class="form-control" name="y1" style='width:120px; margin-right: 50px;' required>
		<option value="" selected="selected"> Year </option>
                 <?php
				 $l=date("Y");
				 $e=$l+4;
    for ($i = $l; $i <= $e;   $i++) {
		if($i==$y1)
			$si='selected';
		else
			$si='';
    echo "<option value='$i' $si>".$i."</option>";
    } 
	?>
              </select>
	</div>
	 <div class="col-sm-1">
	 <input class="form-control" name="a1" type="text" value="<?php echo $a1 ?>" placeholder='Amount' style='width:120px;' onkeyup='format(this);' onkeypress='return isNumberKey(event)' required>
            </div> 


<hr>



			<div class="form-group"> <br>
 <label class="control-label col-md-2">2)&nbsp;&nbsp;</label>
            <div class="col-sm-1" style='margin-right:120px;'>
 <select class="form-control" name="m2" style='width:120px;'>
	<option value="" selected="selected"> Month </option>
              <?php
    for ($i = 1; $i < 13;   $i++) {
    $date_str = date("F", mktime(0, 0, 0, $i, 10));
	if($date_str==$m2)
		$st='selected';
	else
		$st='';
    echo "<option value='$date_str' $st>".$date_str ."</option>";
    } 
	?>
              </select>  
	 </div>
            <div class="col-sm-2" style='margin-right: 50px;'>
	<select class="form-control" name="y2" style='width:120px; margin-right: 50px;'>
		<option value="" selected="selected"> Year </option>
                 <?php
				 $l=date("Y");
				 $e=$l+4;
    for ($i = $l; $i <= $e;   $i++) {
		if($i==$y2)
			$si='selected';
		else
			$si='';
    echo "<option value='$i' $si>".$i."</option>";
    } 
	?>
              </select>
	</div>
	 <div class="col-sm-1">
	 <input class="form-control" name="a2" type="text" value="<?php echo $a2 ?>" placeholder='Amount' onkeyup='format(this);' onkeypress='return isNumberKey(event)' style='width:120px;'>
            </div> 


<hr>




			<div class="form-group"> <br>
 <label class="control-label col-md-2">3)&nbsp;&nbsp;</label>
            <div class="col-sm-1" style='margin-right:120px;'>
 <select class="form-control" name="m3" style='width:120px;'>
	<option value="" selected="selected"> Month </option>
              <?php
    for ($i = 1; $i < 13;   $i++) {
    $date_str = date("F", mktime(0, 0, 0, $i, 10));
	if($date_str==$m3)
		$st='selected';
	else
		$st='';
    echo "<option value='$date_str' $st>".$date_str ."</option>";
    } 
	?>
              </select>  
	 </div>
            <div class="col-sm-2" style='margin-right: 50px;'>
	<select class="form-control" name="y3" style='width:120px; margin-right: 50px;'>
		<option value="" selected="selected"> Year </option>
                 <?php
				 $l=date("Y");
				 $e=$l+4;
    for ($i = $l; $i <= $e;   $i++) {
		if($i==$y3)
			$si='selected';
		else
			$si='';
    echo "<option value='$i' $si>".$i."</option>";
    } 
	?>
              </select>
	</div>
	 <div class="col-sm-1">
	 <input class="form-control" name="a3" type="text" value="<?php echo $a3 ?>" placeholder='Amount' onkeyup='format(this);' onkeypress='return isNumberKey(event)' style='width:120px;'>
            </div> 



<hr>


			<div class="form-group"> <br>
 <label class="control-label col-md-2">4)&nbsp;&nbsp;</label>
            <div class="col-sm-1" style='margin-right:120px;'>
 <select class="form-control" name="m4" style='width:120px;'>
	<option value="" selected="selected"> Month </option>
              <?php
    for ($i = 1; $i < 13;   $i++) {
    $date_str = date("F", mktime(0, 0, 0, $i, 10));
	if($date_str==$m4)
		$st='selected';
	else
		$st='';
    echo "<option value='$date_str' $st>".$date_str ."</option>";
    } 
	?>
              </select>  
	 </div>
            <div class="col-sm-2" style='margin-right: 50px;'>
	<select class="form-control" name="y4" style='width:120px; margin-right: 50px;'>
		<option value="" selected="selected"> Year </option>
                 <?php
				 $l=date("Y");
				 $e=$l+4;
    for ($i = $l; $i <= $e;   $i++) {
		if($i==$y4)
			$si='selected';
		else
			$si='';
    echo "<option value='$i' $si>".$i."</option>";
    } 
	?>
              </select>
	</div>
	 <div class="col-sm-1">
	 <input class="form-control" name="a4" type="text" value="<?php echo $a4 ?>" placeholder='Amount' onkeyup='format(this);' onkeypress='return isNumberKey(event)' style='width:120px;'>
            </div> 

<hr>



</fieldset></div>
		

  <div class="form-group">
            <label class="control-label col-md-3"><br><br>Done&nbsp;by</label>
            <div class="col-md-2" style='margin-right:30px;'>
              <br><br><input name="user" class="form-control" value="<?php echo $user ?>" type="text" style='width:210px;' readonly> &nbsp;&nbsp; 
			 </div> 

			  <label class="control-label col-md-1"><br><br>Date</label>
			<div class="col-md-5"><br><br>
			  <input name="dato" class="form-control" value="<?php echo $dato ?>" type="text" style='width:210px; text-align:center;' readonly>
            </div> 
 </div>

 <div class="form-group">
    <label class="control-label col-md-3">Document File</label>
                     <div class="col-md-6">
              <div class="fileupload fileupload-new" data-provides="fileupload"><input value="<?php echo $rowid ?>" name="rowid" type="hidden">
                <span class="btn btn-default btn-file"><span class="fileupload-new">Select</span><span class="fileupload-exists">Change</span><input name="file1" id="app_file" type="file" readonly='readonly'></span><span class="fileupload-preview"></span><button class="close fileupload-exists" data-dismiss="fileupload" style="float:none" type="button">×</button>
		<?php echo $dfile ?>
				
                     
              </div>     <small>Zip, txt, jpeg, png, pdf, doc (Max : 2M)</small>
            </div>
            </div>

  <div class="form-group">
  <div class="col-md-12">
  <div class="col-md-3"></div>
   <div class="col-sm-2" align='center' style='border:0px solid black; width:255px;'>                 
    <button class="btn btn-lg btn-block btn-success" type="submit" name="<?php echo $namb ?>" style='width:210px;'>
	<i class="lnr lnr-checkmark-circle"></i> <?php echo $valub ?></button>   
	  
		</div>
		
		 <div class="col-sm-2" align='center' style='border:0px solid black; width:255px;'>
		 <button class="btn btn-lg btn-block btn-danger" type="reset" style='width:210px;'><i class="lnr lnr-undo"></i> Reset</button>  
   </div> 
  <div class="col-md-3"></div>      
 </div></div>
 
 </form>
 </div>
 </div>
 </div>
 </div> 
</div>

<script>
	 function cUpper(cObj) 
		{
		cObj.value=cObj.value.toUpperCase();
		}

var dateToday = new Date();
var dates = $("#fdate, #edate").datepicker({
	 defaultDate: "+1w",
    changeMonth: true,
    numberOfMonths: 1,
    minDate: dateToday,
    onSelect: function(selectedDate) {
        var option = this.id == "fdate" ? "minDate" : "maxDate",
            instance = $(this).data("datepicker"),
            date = $.datepicker.parseDate(instance.settings.dateFormat || $.datepicker._defaults.dateFormat, selectedDate, instance.settings);
        dates.not(this).datepicker("option", option, date);
    }
});

$('#app_file').bind('change', function() {
	  $('#app_file_size').val(this.files[0].size);
	  var a = this.files[0].size;
	  var b= 2097152;
	if(a>b)
	  alert("File size must be less than 2M");
	});
</script><div id="ui-datepicker-div" class="ui-datepicker ui-widget ui-widget-content ui-helper-clearfix ui-corner-all"></div>  
  <script>
$(document).ready(function(){
	$(".pdf").click(function(){
		$("#table1").hide();
		setTimeout(function(){$("#table1").show()},1000);
		});
});
</script>
  <!-- used for show calendar -->
   <script src="style/bootstrap.js" type="text/javascript"></script>
  <script src="style/jquery_002.js" type="text/javascript"></script>
 <!-- ****************************** -->
  
   <script src="style/jquery.js" type="text/javascript"></script>
  <script src="style/datatable-editable.js" type="text/javascript"></script>
  <!-- used for calendar -->
 <script src="style/jquery_003.js" type="text/javascript"></script>
 <!-- ******************************* -->
  
  <script src="style/bootstrap-fileupload.js" type="text/javascript"></script>
   <script src="style/bootstrap-timepicker.js" type="text/javascript"></script>
   <script src="style/jquery_004.js" type="text/javascript"></script>
   
    
     <script>
     /*   for mobile navigation */
     $('.navbar-toggle').click(function() {
         return $('body, html').toggleClass("nav-open");
       });

     /*
      * =============================================================================
      *   DataTables
      * =============================================================================
      */
     $("#dataTable1").dataTable({
       "sPaginationType": "full_numbers",
       aoColumnDefs: [
         {
           bSortable: false,
           aTargets: [0, -1]
         }
       ]
     });
     $('.table').each(function() {
       return $(".table #checkAll").click(function() {
         if ($(".table #checkAll").is(":checked")) {
           return $(".table input[type=checkbox]").each(function() {
             return $(this).prop("checked", true);
           });
         } else {
           return $(".table input[type=checkbox]").each(function() {
             return $(this).prop("checked", false);
           });
         }
       });
     });


     /*
      * =============================================================================
      *   Bootstrap Popover
      * =============================================================================
      */
     
     $(".popover-trigger").popover(); 
     /*
      * =============================================================================
      *   Datepicker
      * =============================================================================
      */
   
    var date = new Date();
    $("#from").datepicker();
    
    $("#to").datepicker();
    $("#dob").datepicker();     
   
    
     if($("#watermark_yes").is(":checked")){
     	  $("#watermark").show();
       }
     else{
     $("#watermark").hide();
     }
     $("#watermark_yes").click(function(){
 	    $("#watermark").show();
 	});
     $("#watermark_no").click(function(){
   	    $("#watermark").hide();
   	});
     </script>
  
  <script>
  $(document).ready(function (){
	  $(".fancybox").fancybox({
	      maxWidth: 700,
	      height: 'auto',
	      fitToView: false,
	      autoSize: true,
	      padding: 15,
	      nextEffect: 'fade',
	      prevEffect: 'fade',
	      helpers: {
	        title: {
	          type: "outside"
	        }
	      }
	    });
     var a = $("#db_country").val();     
     $("#country").val(a);
	  });
  </script>
 <script>
  $(document).ready(function (){
     var a = $("#db_timezone").val();     
     $("#timezone").val(a);
	  });
  $('#timepicker1').timepicker();
  $('#timepicker2').timepicker();
  $('#timepicker3').timepicker();
  $('#timepicker4').timepicker();
  $('#timepicker5').timepicker();
  $('#timepicker6').timepicker();
  $('#timepicker7').timepicker();
  $('#timepicker8').timepicker();
  $('#timepicker9').timepicker();
  $('#timepicker10').timepicker();
  $('#timepicker11').timepicker();
  $('#timepicker12').timepicker();
  $('#timepicker13').timepicker();
  $('#timepicker14').timepicker();

   /*$("#timepicker1").timepicker({
	      minuteStep: 1,
	      showSeconds: true,
	      showMeridian: false
	    });
   $("#timepicker2").timepicker({
	      minuteStep: 1,
	      showSeconds: true,
	      showMeridian: false
	    });*/
 
  </script>
  
   <script>
  $(document).ready(function (){
     var a = $("#date_format").val();     
     $("#dateformat").val(a);
	  });
  </script>
     
   <script>
   $("#enable_check").click(function(){
	   if($("#enable_check").is(":checked")){
           $("#time1").hide();
           $("#time2").hide();
		   }
		   else {
			   $("#time1").show();
			   $("#time2").show();
			   }
	   });
   </script>
   <script>
   $("#emp_view_check").click(function(){
	  
   if($("#emp_view_check").is(":checked")){
	   
	  	  $("#emp_edit_check").show();
		  	$("#emp_del_check").show();
			$("#emp_add_check").show();
	    }
	  else{
	  $("#emp_edit_check").hide();
	  $("#emp_del_check").hide();
		$("#emp_add_check").hide();
	  }
	  });

   $("#dep_view_check").click(function(){
		  
	   if($("#dep_view_check").is(":checked")){
		   
		  	  $("#dep_edit_check").show();
			  	$("#dep_del_check").show();
			  	 $("#dep_add_check").show();
		    }
		  else{
		  $("#dep_edit_check").hide();
		  $("#dep_del_check").hide();
		  $("#dep_add_check").hide();
		  }
		  });
   $("#holiday_view_check").click(function(){
		  
	   if($("#holiday_view_check").is(":checked")){
		   
		  	  $("#holiday_edit_check").show();
			  	$("#holiday_del_check").show();
				$("#holiday_add_check").show();
		    }
		  else{
		  $("#holiday_edit_check").hide();
		  $("#holiday_del_check").hide();
			$("#holiday_add_check").hide();
		  }
		  });
   $("#task_view_check").click(function(){
		  
	   if($("#task_view_check").is(":checked")){
		  	  $("#task_edit_check").show();
			  	$("#task_del_check").show();
				$("#task_add_check").show();
		    }
		  else{
		  $("#task_edit_check").hide();
		  $("#task_del_check").hide();
			$("#task_add_check").hide();
		  }
		  });
   $("#payslip_view_check").click(function(){
		  
	   if($("#payslip_view_check").is(":checked")){
			  	$("#payslip_del_check").show();
			  	$("#payslip_add_check").show();
		    }
		  else{
		  
		  $("#payslip_del_check").hide();
		  $("#payslip_add_check").hide();
		  }
		  });
   $("#template_view_check").click(function(){
		  
	   if($("#template_view_check").is(":checked")){
		   
		   $("#template_edit_check").show();
			  	$("#template_del_check").show();
			  	$("#template_add_check").show();
		    }
		  else{
		  $("#template_edit_check").hide();
		  $("#template_del_check").hide();
		  $("#template_add_check").hide();
		  }
		  });
   </script>
   
  <script>
  
  
  if($("#fixed_based").is(":checked")){
	 
	  	  $("#annual_fixed_leaves").show();
	    }
	  else{
		  $("#annual_fixed_leaves").hide();
	  }
  $("#fixed_based").click(function(){
	  $("#service_based").removeAttr("checked");
	    $("#annual_fixed_leaves").show();
	    $("#service_based_leaves").hide();
	    $("#service_based_heading").hide();
	    $("#annual").show();
	});
  $("#service_based").click(function(){
	  $("#fixed_based").removeAttr("checked");
	    $("#service_based_leaves").show();
	    $("#annual_fixed_leaves").show();
	    $("#service_based_heading").show();
	    $("#annual").hide();
	    
	});
  if($("#service_based").is(":checked")){
	  
  	  $("#service_based_leaves").show();
  	  $("#annual_fixed_leaves").show();
    	$("#service_based_heading").show();
    	$("#annual").hide();
    }
  else{
	  $("#service_based_leaves").hide();
  }

   </script>
  
    <script>
   $("#sun_check").click(function(){
	   if($("#sun_check").is(":checked")){
		   $("#timepicker13").attr("disabled",true);
		   $("#timepicker14").attr("disabled",true);
         }
		   else {
			   $("#timepicker13").attr("disabled",false);
			   $("#timepicker14").attr("disabled",false);
			   }
	   });
   $("#mon_check").click(function(){
	   if($("#mon_check").is(":checked")){
		   $("#timepicker1").attr("disabled",true);
		   $("#timepicker2").attr("disabled",true);
         }
		   else {
			   $("#timepicker1").attr("disabled",false);
			   $("#timepicker2").attr("disabled",false);
			   }
	   });
   $("#tues_check").click(function(){
	   if($("#tues_check").is(":checked")){
		   $("#timepicker3").attr("disabled",true);
		   $("#timepicker4").attr("disabled",true);
         }
		   else {
			   $("#timepicker3").attr("disabled",false);
			   $("#timepicker4").attr("disabled",false);
			   }
	   });
   $("#wed_check").click(function(){
	   if($("#wed_check").is(":checked")){
		   $("#timepicker5").attr("disabled",true);
		   $("#timepicker6").attr("disabled",true);
         }
		   else {
			   $("#timepicker5").attr("disabled",false);
			   $("#timepicker6").attr("disabled",false);
			   }
	   });
   $("#thurs_check").click(function(){
	   if($("#thurs_check").is(":checked")){
		   $("#timepicker7").attr("disabled",true);
		   $("#timepicker8").attr("disabled",true);
         }
		   else {
			   $("#timepicker7").attr("disabled",false);
			   $("#timepicker8").attr("disabled",false);
			   }
	   });
   $("#fri_check").click(function(){
	   if($("#fri_check").is(":checked")){
		   $("#timepicker9").attr("disabled",true);
		   $("#timepicker10").attr("disabled",true);
         }
		   else {
			   $("#timepicker9").attr("disabled",false);
			   $("#timepicker10").attr("disabled",false);
			   }
	   });
   $("#sat_check").click(function(){
	   if($("#sat_check").is(":checked")){
		   $("#timepicker11").attr("disabled",true);
		   $("#timepicker12").attr("disabled",true);
         }
		   else {
			   $("#timepicker11").attr("disabled",false);
			   $("#timepicker12").attr("disabled",false);
			   }
	   });

	   // Toggle repayment schedle
	   function toggle() {
	var ele = document.getElementById("toggleText");
	var text = document.getElementById("displayText");
	if(ele.style.display == "block") {
    		ele.style.display = "none";
		text.innerHTML = "<U>Repayment Schedle</U>";
  	}
	else {
		ele.style.display = "block";
		text.innerHTML = "<U>Repayment Schedle</U>";
	}
	}

	   function toggle1() {
	var ele = document.getElementById("toggle1Text");
	var text = document.getElementById("display1Text");
	if(ele.style.display == "block") {
    		ele.style.display = "none";
		text.innerHTML = "<U>Add</U>";
  	}
	else {
		ele.style.display = "block";
		text.innerHTML = "<U>Add</U>";
	}
	}

		function format(input)
{
    var nStr = input.value + '';
    nStr = nStr.replace( /\,/g, "");
    var x = nStr.split( '.' );
    var x1 = x[0];
    var x2 = x.length > 1 ? '.' + x[1] : '';
    var rgx = /(\d+)(\d{3})/;
    while ( rgx.test(x1) ) {
        x1 = x1.replace( rgx, '$1' + ',' + '$2' );
    }
    input.value = x1 + x2;
}

 // validate input to be numbers only
	 function isNumberKey(evt)
      {
         var charCode = (evt.which) ? evt.which : event.keyCode
         if (charCode > 31 && (charCode < 42 || charCode > 57))
            return false;

         return true;
      }
  
   </script>
 </body></html>
