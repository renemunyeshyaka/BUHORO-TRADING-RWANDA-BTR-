<?php
if(basename($_SERVER['PHP_SELF']) == 'casual.php') {
  $cu=" class='current'";
} else {
  $cu="";
} 
include'header.php';
include'connection.php';

if(isset($_POST['submit_employee']))
		{
			$fname=$_POST['fname'];
			$lname=$_POST['lname'];
			$address=$_POST['address'];
			$idno=$_POST['idno'];
			$contact1=$_POST['contact1'];
			$contact2=$_POST['contact2'];
			$gender=$_POST['gender'];
			$bank=$_POST['bank'];
			$branch=$_POST['branch'];
			$account=$_POST['account'];
			$remarks=$_POST['remarks'];
			$depart=$_POST['depart'];
			$salary=$_POST['salary'];
			$currentp=$_POST['currentp'];

	$do=mysql_query("INSERT INTO `casual` (`Fname`, `Lname`, `Address`, `Idno`, `Contact1`, `Contact2`, `Gender`, `Bank`, `Branch`, `Account`, `Remarks`, `Depart`, `Salary`, `Currentp`, `Owner`, `Date`) VALUES ('$fname', '$lname', '$address', '$idno', '$contact1', '$contact2', '$gender', '$bank', '$branch',  '$account', '$remarks', '$depart', '$salary', '$currentp', '$loge', '$Date')");
 
 $pto=10;
		}

			$fname='';
			$rowid='';
			$lname='';
			$address='';
			$idno='';
			$contact1='';
			$contact2='';
			$gender='Male';
			$bank='';
			$branch='';
			$account='';
			$remarks='';
			$depart='2';
			$salary='';
			$currentp='';
			$namb="submit_employee";
				$valub="Submit";

if(isset($_POST['edit_id']))
		{
			$rowid=$_POST['rowid'];
$do=mysql_query("SELECT *FROM `employees` WHERE `Eid`='$rowid' ORDER BY `Eid` ASC LIMIT 1");
while($ro=mysql_fetch_assoc($do)){
$rowid=$ro['Eid'];
$fname=$ro['Fname'];
$lname=$ro['Lname'];
$depart=$ro['Depart'];
$contact1=$ro['Contact1'];
$contact2=$ro['Contact2'];
$idno=$ro['Idno'];
$currentp=$ro['Currentp'];
$address=$ro['Address'];
$gender=$ro['Gender'];
$bank=$ro['Bank'];
$branch=$ro['Branch'];
$account=$ro['Account'];
$remarks=$ro['Remarks'];
$salary=$ro['Salary'];
$qualify=$ro['Qualify'];
}

$namb="update_employee";
				$valub="Update";

	}

	if(isset($_POST['update_employee']))
		{
			$rowid=$_POST['rowid'];
			$fname=$_POST['fname'];
			$lname=$_POST['lname'];
			$address=$_POST['address'];
			$idno=$_POST['idno'];
			$contact1=$_POST['contact1'];
			$contact2=$_POST['contact2'];
			$gender=$_POST['gender'];
			$bank=$_POST['bank'];
			$branch=$_POST['branch'];
			$account=$_POST['account'];
			$remarks=$_POST['remarks'];
			$depart=$_POST['depart'];
			$salary=$_POST['salary'];
			$currentp=$_POST['currentp'];

$namb="update_employee";
				$valub="Update";

	$do=mysql_query("UPDATE `casual` SET `Fname`='$fname', `Lname`='$lname', `Address`='$address', `Idno`='$idno', `Contact1`='$contact1', `Contact2`='$contact2', `Gender`='$gender', `Bank`='$bank', `Branch`='$branch', `Account`='$account', `Remarks`='$remarks', `Depart`='$depart', `Salary`='$salary', `Currentp`='$currentp', `Owner`='$loge' WHERE `Eid`='$rowid'");
 
 $pto=20;
		}

?>

 <div class="container-fluid main-content">
<div class="page-title">
        <h1 style='margin-top:-20px; margin-bottom: 5px;'>New Casual</h1>
        </div>
 <div class="row">
 <div class="col-md-2">
		<ul class="list-group">
		 		 	  <li class="list-group-item">
           <a href="employees.php">
           <p>
           <i class="lnr lnr-menu-circle"></i>&nbsp;List
           </p></a>
           </li>
           
		    <li class="list-group-item">
           <a href="users.php">
           <p>
           <i class="lnr lnr-menu-circle"></i>&nbsp;Users
           </p></a>
           </li>
                          <li class="list-group-item">
           <a href="new_employee.php">
           <p>
           <i class="lnr lnr-plus-circle"></i>&nbsp;Create
           </p></a>
           </li>
		    <li class="list-group-item active">
           <a href="casual.php">
           <p>
           <i class="lnr lnr-plus-circle"></i>&nbsp;Casual
           </p></a>
           </li>
                       </ul>
                          </ul><br><br><center>
						   <span style="color:#d43f3a"><small>Mandatory fields must be filled.</small></span>
		</div>
	
 <div class="col-md-10">
 <div class="widget-container fluid-height clearfix">
 <div class="widget-content padded">
 <form method="post" class="form-horizontal" name="myform" action="casual.php" enctype="multipart/form-data">
<?php
	if($pto==10)
echo"<center><div class='alert alert-danger' style='text-align:center;float:center;background-color: #60c560;color: #ffffff; border-radius:5px;'>
		<i class='lnr lnr-checkmark-circle'></i> &nbsp;&nbsp; <button class='close' data-dismiss='alert' type='button'>×</button>New Casual Has Been Created.
		</div></center>";

	if($pto==20)
echo"<center><div class='alert alert-danger' style='text-align:center;float:center;background-color: #60c560;color: #ffffff; border-radius:5px;'>
		<i class='lnr lnr-checkmark-circle'></i> &nbsp;&nbsp; <button class='close' data-dismiss='alert' type='button'>×</button>Casual Has Been Updated.
		</div></center>";

		echo"<input value='$rowid' name='rowid' type='hidden'>";
		?>
 
 <div class="row">
 <div class="col-md-12">
 <div class="col-md-6">
 <div class="heading"><h2>Personal Details</h2></div><br>
   <div class="form-group">
            <label class="control-label col-md-3">First Name</label>
            <div class="col-md-6">
              <input class="form-control" name="fname" type="text" value="<?php echo $fname ?>" required>
            </div>
                         <span style="color:#d43f3a">
                         mandatory
                      </span>          </div>    
   <div class="form-group">
            <label class="control-label col-md-3">Last Name</label>
            <div class="col-md-6">
              <input class="form-control" name="lname" type="text" value="<?php echo $lname ?>">
            </div>
			  <span style="color:#d43f3a">
                         mandatory
                      </span>  
   </div>
   
              <div class="form-group">
                   <label class="control-label col-md-3">Address</label>
                  <div class="col-md-6">
              <textarea class="form-control" name="address"><?php echo $address ?></textarea>
            </div> 
          </div>
          <div class="form-group">
                   <label class="control-label col-md-3">ID Number</label>
                  <div class="col-md-6">
             <input class="form-control" name="idno" type="text"  value="<?php echo $idno ?>"onkeypress='return isNumberKey(event)'>
            </div> 
			  <span style="color:#d43f3a">
                         mandatory
                      </span>   
			</div>
			
		  <div class="form-group">
		  <?php
		  if($gender=='Male'){
			$male='checked';
			$female='';
		}
		  else{
			$male='';
			$female='checked';
		}
		?>

                   <label class="control-label col-md-3">Gender</label>
                  <div class="col-md-6" style='padding-top:8px;'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
              <input name="gender" type="radio" value='Male' <?php echo $male ?>> Male &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			  <input name="gender" type="radio" value='Female' <?php echo $female ?>> Female
            </div> 
          </div>
   



             
 </div>
 <div class="col-md-6">
 <div class="heading"><h2>Other Details</h2></div><br>
    <div class="form-group">
 <label class="control-label col-md-3">Contact No.1</label>
     <div class="col-md-6">
 <input class="form-control" name="contact1" type="text" value="<?php echo $contact1 ?>">
 </div>
   <span style="color:#d43f3a">
                         mandatory
                      </span>  
</div>
 <div class="form-group">
 <label class="control-label col-md-3">Contact No.2</label>
     <div class="col-md-6">
                <input class="form-control" name="contact2" type="text" value="<?php echo $contact2 ?>">
              </div>           
              </div>
            


  <div class="form-group">
            <label class="control-label col-md-3">Salary Count</label>
            <div class="col-md-6">
              <select class="form-control" name="depart">
			  <?php
		$de=mysql_query("SELECT *FROM `depart` ORDER BY `Number` ASC");
			  while($re=mysql_fetch_assoc($de)){
					$ne=$re['Number'];
					$dep=$re['Depart'];
					if($ne==$depart)
						$sed="selected=selected'";
					else
						$sed="";
			echo"<option value='$ne' $sed>$dep</option>";
			  }
			  ?>
                            </select>
            </div>
                         <span style="color:#d43f3a">
                         mandatory
                      </span>     </div> 
  <div class="form-group">
            <label class="control-label col-md-3">Employee Salary</label>
            <div class="col-md-6" TITLE="Rwandan Francs">
             <div class="input-group">
            <span class="input-group-addon">RWF</span>
              <input class="form-control" name="salary" value="<?php echo $salary ?>" type="text" onkeypress='return isNumberKey(event)'>
            </div>
          </div>
                     <span style="color:#d43f3a">
                       mandatory
                      </span>          </div>
  
 




     <div class="form-group">
    <label class="control-label col-md-3">Current&nbsp;Post</label>
            <div class="col-md-6">
              <select class="form-control" name="currentp">
              <option value="0">Select&nbsp;Post</option>
			  	  <?php
		$de=mysql_query("SELECT *FROM `position` WHERE `Status` = '0' ORDER BY `Postname` ASC");
			  while($re=mysql_fetch_assoc($de)){
					$ne=$re['Postid'];
					$dep=$re['Postname'];
					$tit=$re['Owner'];
					if($ne==$currentp)
						$sed="selected=selected'";
					else
						$sed="";
			echo"<option value='$ne' $sed title='$tit'>$dep</option>";
			  }
			  ?>
                            </select>
            </div>
                         <span style="color:#d43f3a">
                         mandatory
                      </span>    </div>          
 </div>
 </div></div>
          <div class="row">
          <div class="col-md-12">
          <div class="form-group">
          <div class="col-md-6">
          <div class="heading">
 <h2>Bank Details</h2>
 </div></div></div>
 <div class="col-md-6">
 <div class="form-group">
            <label class="control-label col-md-3">Bank Name</label>
            <div class="col-md-6">
           <input class="form-control" name="bank" type="text" value="<?php echo $bank ?>">
            </div>
			  <span style="color:#d43f3a">
                       &nbsp;
                      </span>   
 </div>
           
          <div class="form-group">
            <label class="control-label col-md-3">Branch</label>
            <div class="col-md-6">
              <input class="form-control" name="branch" type="text" value="<?php echo $branch ?>">
            </div>
</div>
         
</div> </div>
<div class="col-md-6">
<div class="form-group">
            <label class="control-label col-md-3">Account Number</label>
            <div class="col-md-6">
              <input class="form-control" name="account" type="text" value="<?php echo $account ?>">
            </div>
			  <span style="color:#d43f3a">
                         &nbsp;
                      </span>   
</div>


          
          <div class="form-group">
            <label class="control-label col-md-3">Remarks</label>
            <div class="col-md-6">
              <textarea class="form-control" name="remarks"><?php echo $remarks ?></textarea>
            </div>
             </div>
           </div>  
</div>
  <div class="form-group">
  <div class="col-md-12">
   <div class="col-md-6">                 
    <button class="btn btn-lg btn-block btn-success" type="submit"  name="<?php echo $namb ?>" onClick='return validatepass(form);'><i class="lnr lnr-checkmark-circle"></i> <?php echo $valub ?> </button>         
   </div> 
  <div class="col-md-6">                 
  <button class="btn btn-lg btn-block btn-danger" type="reset"><i class="lnr lnr-undo"></i> Reset</button>         
  </div>       
 </div></div>
  </form>
 </div>
 </div>
 </div>
 </div>
 </div>

 <script> 
 //For profile pic size
  $('#profile_pic').bind('change', function() {
  $('#profilesize').val(this.files[0].size);
  var a = this.files[0].size;
  var b= 2097152;
if(a>b)
  alert("File size must be less than 2M");
});
  // For qualification files
          $('#qual_1').bind('change', function() {

        	  $('#qualification_1').val(this.files[0].size);
        	  var a = this.files[0].size;
        	  var b= 2097152;
        	if(a>b)
        	  alert("File size must be less than 2M");

        	});
          $('#qual_2').bind('change', function() {

        	  $('#qualification_2').val(this.files[0].size);
        	  var a = this.files[0].size;
        	  var b= 2097152;
        	if(a>b)
        	  alert("File size must be less than 2M");

        	});
          $('#qual_3').bind('change', function() {

        	  $('#qualification_3').val(this.files[0].size);
        	  var a = this.files[0].size;
        	  var b= 2097152;
        	if(a>b)
        	  alert("File size must be less than 2M");

        	});
          $('#qual_4').bind('change', function() {

        	  $('#qualification_4').val(this.files[0].size);
        	  var a = this.files[0].size;
        	  var b= 2097152;
        	if(a>b)
        	  alert("File size must be less than 2M");

        	});
          $('#qual_5').bind('change', function() {

        	  $('#qualification_5').val(this.files[0].size);
        	  var a = this.files[0].size;
        	  var b= 2097152;
        	if(a>b)
        	  alert("File size must be less than 2M");

        	});

        	//for addressproof and idproof
          $('#add_proof').bind('change', function() {

        	  $('#add_proof_size').val(this.files[0].size);
        	  var a = this.files[0].size;
        	  var b= 2097152;
        	if(a>b)
        	  alert("File size must be less than 2M");

        	});
          $('#id_proof').bind('change', function() {

        	  $('#id_proof_size').val(this.files[0].size);
        	  var a = this.files[0].size;
        	  var b= 2097152;
        	if(a>b)
        	  alert("File size must be less than 2M");

        	});
          </script>
   
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
   <script src="style/bootstrap-datepicker.js" type="text/javascript"></script>
   <script src="style/bootstrap-timepicker.js" type="text/javascript"></script>
   <script src="style/jquery_004.js" type="text/javascript"></script>
   
    
     <script>
	 // validate input to be numbers only
	 function isNumberKey(evt)
      {
         var charCode = (evt.which) ? evt.which : event.keyCode
         if (charCode > 31 && (charCode < 42 || charCode > 57))
            return false;

         return true;
      }
	  // if password are not matching
function validatepass(formCheck) 
{ 
if (formCheck.password.value != formCheck.confirm_password.value)
{  
formCheck.confirm_password.focus();
return false;
}
return true;
}

	  // check password confirmation
	  $('#confirm_password').on('keyup', function () {
    if ($(this).val() == $('#password').val()) {
        $('#message').html('Matching').css('color', 'green');
    } else $('#message').html('Not matching').css('color', 'red');
});

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