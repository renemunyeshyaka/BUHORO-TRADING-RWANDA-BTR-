<?php
include'header.php';
include'connection.php';
 $oldpassword='';
    $newpassword='';
		$confirmpassword='';
if(isset($_POST['submit_changepassword']))
	{
    $oldpassword=$_POST['oldpassword'];
    $newpassword=$_POST['newpassword'];
    $confirmpassword=$_POST['confirmpassword'];

	if($oldpassword=='')
		$pto=10;
	elseif($newpassword=='')
		$pto=11;
	elseif($confirmpassword=='')
		$pto=12;
	else{
	if($newpassword!=$confirmpassword){
    $newpassword='';
		$confirmpassword='';
		$pto=13;
	}
	else{
		$unames=$_SESSION['Uname'];
		$oldpasswo=md5($oldpassword);
		$newpasswo=md5($newpassword);

		$dot=mysql_query("SELECT *FROM `employees` WHERE `Email`='$unames' AND `Password`='$oldpasswo' LIMIT 1");
	$fot=mysql_num_rows($dot);
		if($fot){

	$do=mysql_query("UPDATE `employees` SET `Password`='$newpasswo' WHERE `Email`='$unames' AND `Password`='$oldpasswo'");
		$oldpassword='';
		 $newpassword='';
		$confirmpassword='';
		$pto=14;
		}
		else{
			$pto=15;
			 $oldpassword='';
		}
	}

	}
	}

	$_SESSION['Oldpassword']=$oldpassword;
	$_SESSION['Newpassword']=$newpassword;
	$_SESSION['Confirmpassword']=$Confirmpassword;
?>
<div class="container-fluid main-content">
<div class="page-title">

        <h1>Change Password</h1>
    </div>
<div class="row">
 <div class="col-md-12">
 <div class="widget-container fluid-height clearfix">
 <div class="widget-content padded" style='padding-top:40px;'>
 <form method="post" class="form-horizontal" action="password.php" enctype="multipart/form-data">

<?php
	$oldpassword=$_SESSION['Oldpassword'];
	$newpassword=$_SESSION['Newpassword'];
	$Confirmpassword=$_SESSION['Confirmpassword'];
if($pto==10)
echo"<center><div class='alert alert-danger' style='width:48%;text-align:center;float:center;border-radius:5px;'>
		<i class='lnr lnr-sad'></i> &nbsp;&nbsp; <button class='close' data-dismiss='alert' type='button'>×</button>Old Password Cannot Be Empty.
		</div>";

if($pto==11)
echo"<center><div class='alert alert-danger' style='width:48%;text-align:center;float:center;border-radius:5px;'>
		<i class='lnr lnr-sad'></i> &nbsp;&nbsp; <button class='close' data-dismiss='alert' type='button'>×</button>New Password Cannot Be Empty.
		</div></center>";

if($pto==12)
echo"<center><div class='alert alert-danger' style='width:48%;text-align:center;float:center;border-radius:5px;'>
		<i class='lnr lnr-sad'></i> &nbsp;&nbsp; <button class='close' data-dismiss='alert' type='button'>×</button>Confirm Password Cannot Be Empty.
		</div></center>";

if($pto==13)
echo"<center><div class='alert alert-danger' style='width:48%;text-align:center;float:center;border-radius:5px;'>
		<i class='lnr lnr-sad'></i> &nbsp;&nbsp; <button class='close' data-dismiss='alert' type='button'>×</button>Password Does Not Match.
		</div></center>";

if($pto==14)
echo"<center><div class='alert alert-danger' style='width:48%;text-align:center;float:center;background-color: #60c560;color: #ffffff;border-radius:5px;'>
		<i class='lnr lnr-checkmark-circle'></i> &nbsp;&nbsp; <button class='close' data-dismiss='alert' type='button'>×</button>Your Password Has Been Changed.
		</div></center>";

if($pto==15)
echo"<center><div class='alert alert-danger' style='width:48%;text-align:center;float:center;border-radius:5px;'>
		<i class='lnr lnr-sad'></i> &nbsp;&nbsp; <button class='close' data-dismiss='alert' type='button'>×</button>Old Password Is Incorrect.
		</div></center>";

		?>

 <div class="row">
 <div class="col-md-12">
 <div class="form-group">
 <label class="control-label col-md-3">Old Password</label>
            <div class="col-md-6">
              <input class="form-control" name="oldpassword" value="<?php echo $oldpassword ?>" type="password">
            </div>
          </div>
 <div class="form-group">
 <label class="control-label col-md-3">New Password</label>
            <div class="col-md-6">
              <input class="form-control" name="newpassword" value="<?php echo $newpassword ?>" type="password">
            </div>
          </div>
 <div class="form-group">
 <label class="control-label col-md-3">Confirm Password</label>
            <div class="col-md-6">
              <input class="form-control" name="confirmpassword" value="<?php echo $confirmpassword ?>" type="password">
            </div>
          </div>
  <div class="form-group">
   <div class="col-md-12">  
   <div class="col-md-3"></div>  
   <div class="col-md-6">             
    <button class="btn btn-lg btn-block btn-success" type="submit" name="submit_changepassword"><i class="lnr lnr-chevron-up-circle"></i> Update</button>  
    </div>       
   <div class="col-md-3"></div>
   </div>
 </div>
 </div></div>
 </form>
</div>
</div>
</div>
</div></div>  
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
 <script src="Shift_files/jquery_003.js" type="text/javascript"></script>
 <!-- ******************************* -->
  
  <script src="style/bootstrap-fileupload.js" type="text/javascript"></script>
   <script src="style/bootstrap-datepicker.js" type="text/javascript"></script>
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