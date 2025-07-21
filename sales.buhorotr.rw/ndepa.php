<?php
if(basename($_SERVER['PHP_SELF']) == 'npost.php') 
  $cm=" class='current'";
include'header.php';
include'connection.php';

if(isset($_POST['submit_post']))
		{
			$postna=$_POST['postna'];
			$postown=$_POST['postown'];
			$month=$_POST['month'];
			$year=$_POST['year'];
			$contract=$_POST['contract'];
			$starting="$month/$year";

	$temp1 = explode(".", $_FILES["file1"]["name"]);
$newfilename1 = round(microtime(true)) . '.' . end($temp1);
move_uploaded_file($_FILES["file1"]["tmp_name"], "contact/" . $newfilename1);
	if(!end($temp1))
	$newfilename1='';

$so=mysql_query("INSERT INTO `department` (`Depname`, `Starting`, `Done`, `Date`) VALUES ('$postna', '$starting', '$loge', '$Date')");

$pto=10;
		}

		if(isset($_POST['edit_id']))
		{
			$rowid=$_POST['rowid'];
			$do=mysql_query("SELECT *FROM `department` WHERE `Depid`='$rowid' LIMIT 1");
				$ro=mysql_fetch_assoc($do);
					$code=$ro['Depid'];
					$pna=$ro['Depname'];
					$starting=$ro['Starting'];

					/*
					$contra=$ro['Contract'];
					$file1=$ro['File1'];
					if($file1)
	$dfile="&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href='down_contra.php?link=$file1'>Download File</a>";
else
	$dfile="";
	*/
					$coupe = explode("/", $starting);
							$month=$coupe[0]; 
							$year=$coupe[1];
				$namb="update_post";
				$valub="Update";
		}
		else{
			$code='';
			$pna='';
			$month='';
			$year='';
			$namb="submit_post";
			$valub="Submit";
			$dfile='';
		}

		if(isset($_POST['update_post']))
		{
			$rowid=$_POST['rowid'];
			$postna=$_POST['postna'];
			$month=$_POST['month'];
			$year=$_POST['year'];
			$starting="$month/$year";

/*
	$temp1 = explode(".", $_FILES["file1"]["name"]);
$newfilename1 = round(microtime(true)) . '.' . end($temp1);
move_uploaded_file($_FILES["file1"]["tmp_name"], "contract/" . $newfilename1);
	if(!end($temp1)){
	$newfilename1='';
	$upda="";
	}
	else{
	$upda=", `File1`='$newfilename1'";
	}
*/
$so=mysql_query("UPDATE `department` SET `Depname`='$postna', `Starting`='$starting', `Done`='$loge' WHERE `Depid`='$rowid' LIMIT 1");
//$fo=mysql_num_rows($so);
$fo=1;

$do=mysql_query("SELECT *FROM `department` WHERE `Depid`='$rowid'");
				$ro=mysql_fetch_assoc($do);
					$code=$ro['Depid'];
					$pna=$ro['Depname'];
					$starting=$ro['Starting'];
					$coupe = explode("/", $starting);
							$month=$coupe[0]; 
							$year=$coupe[1];
				$namb="update_post";
				$valub="Update";
if($fo)
	$pto=20;
else
	$pto=30;
		}


//$do=mysql_query("SELECT *FROM `position`");
//$fo=mysql_num_rows($do);
?>
<div class="container-fluid main-content">
<div class="page-title">
        <h1 style='margin-top:-20px; margin-bottom: 5px;'>New Department</h1>
  
    </div>
<div class="row">
<div class="col-md-2">
 
  <ul class="list-group">
   
        <li class="list-group-item">
		<a href="postm.php">
                <p>
                <i class="lnr lnr-menu-circle"></i>&nbsp;Post List
                </p>
              </a></li>   
           <li class="list-group-item ">
           <a href="npost.php">
           <p>
           <i class="lnr lnr-plus-circle"></i>&nbsp;Create New
           </p></a>
           </li>

	   <li class="list-group-item">
              <a href="depam.php">
                <p>
                <i class="lnr lnr-menu-circle"></i>&nbsp;Department
                </p>
              </a></li>   
           <li class="list-group-item  active">
           <a href="ndepa.php">
           <p>
           <i class="lnr lnr-plus-circle"></i>&nbsp;Create New
           </p></a>
           </li>
          
        </div>
 <div class="col-md-10">
 <div class="widget-container fluid-height clearfix">
 <div class="widget-content padded">
 <form method="post" class="form-horizontal" action="ndepa.php" enctype="multipart/form-data">
 <input name="app_file_size" id="app_file_size" type="hidden">
 <br>
 <?php 
if($pto==10)
echo"<center><div class='alert alert-danger' style='width:48%;text-align:center;float:center;background-color: #60c560;color: #ffffff;border-radius:5px;'>
		<i class='lnr lnr-checkmark-circle'></i> &nbsp;&nbsp; <button class='close' data-dismiss='alert' type='button'>×</button>New Department Has Been Created.
		</div></center>";
if($pto==20)
echo"<center><div class='alert alert-danger' style='width:48%;text-align:center;float:center;background-color: #60c560;color: #ffffff;border-radius:5px;'>
		<i class='lnr lnr-checkmark-circle'></i> &nbsp;&nbsp; <button class='close' data-dismiss='alert' type='button'>×</button>Current Department Has Been Updated.
		</div></center>";
if($pto==30)
echo"<center><div class='alert alert-danger' style='width:48%;text-align:center;float:center;border-radius:5px;'>
		<i class='lnr lnr-checkmark-circle'></i> &nbsp;&nbsp; <button class='close' data-dismiss='alert' type='button'>×</button>Nothing Has Been Changed.
		</div></center>";
	
			echo"<input value='$code' name='rowid' type='hidden'>";
			?>
  <div class="form-group">
            <label class="control-label col-md-3">Department Name</label>
            <div class="col-md-6">
              <input name="postna" class="form-control" type="text" value="<?php echo $pna ?>" OnKeyup='return cUpper(this);' required>
            </div>
			  <span style="color:#d43f3a">
                         mandatory
                      </span>  
 </div>
 <div class="form-group">
   <label class="control-label col-md-3">Post Owner</label>
                  <div class="col-md-6">
              <input class="form-control" name="postown" type="text" value="<?php echo $pna ?>">
            </div> 
			  <span style="color:#d43f3a">
                         mandatory
                      </span>  
			</div>



  <div class="form-group">
 <label class="control-label col-md-3">Starting Date</label>
            <div class="col-sm-2" style='margin-right:132px;'>
 <select class="form-control" name="month" style='width:200px;'>
	<option value="" selected="selected"> </option>
              <?php
    for ($i = 0; $i < 12;   $i++) {
    $date_str = date('F', strtotime("+ $i months"));
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
	<select class="form-control" name="year" style='width:200px;'>
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

  <div class="form-group">
            <label class="control-label col-md-3">Done&nbsp;by</label>
            <div class="col-md-6">
              <input name="contract" class="form-control" value="<?php echo $loge ?>" type="text">
            </div> 
 </div>

 <div class="form-group">
    <label class="control-label col-md-3">Document File</label>
                     <div class="col-md-6">
              <div class="fileupload fileupload-new" data-provides="fileupload"><input value="" name="" type="hidden">
                <span class="btn btn-default btn-file"><span class="fileupload-new">Select</span><span class="fileupload-exists">Change</span><input name="file1" id="app_file" type="file" readonly='readonly'></span><span class="fileupload-preview"></span><button class="close fileupload-exists" data-dismiss="fileupload" style="float:none" type="button">×</button>

				
                     
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
  
   </script>
 </body></html>