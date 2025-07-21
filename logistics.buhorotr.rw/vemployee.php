<?php
if(basename($_SERVER['PHP_SELF']) == 'vemployee.php') {
  $py=" class='current'";
} else {
  $py="";
} 
include'header.php';
include'connection.php';

$code=$_GET['id'];

if(isset($_POST['sus_id']))
		{
			$code=$_POST['rowid'];
		$then=mysql_query("UPDATE `employees` SET `Status`='1' WHERE `Eid`='$code' ORDER BY `Eid` ASC LIMIT 1");
		}

if(isset($_POST['usus_id']))
		{
			$code=$_POST['rowid'];
		$then=mysql_query("UPDATE `employees` SET `Status`='0' WHERE `Eid`='$code' ORDER BY `Eid` ASC LIMIT 1");
		}

$do=mysql_query("SELECT *FROM `employees` WHERE `Eid`='$code' ORDER BY `Eid` ASC LIMIT 1");
while($ro=mysql_fetch_assoc($do)){
$rowid=$ro['Eid'];
$fname=$ro['Fname'];
$lname=$ro['Lname'];
$depart=$ro['Depart'];
$birth=$ro['Birth'];
$contact1=$ro['Contact1'];
$contact2=$ro['Contact2'];
$idno=$ro['Idno'];
$currentp=$ro['Currentp'];
$address=$ro['Address'];
$gender=$ro['Gender'];
$email=$ro['Email'];
$password=$ro['Password'];
$confirm_password=$ro['Password'];
$bank=$ro['Bank'];
$branch=$ro['Branch'];
$city=$ro['City'];
$account=$ro['Account'];
$remarks=$ro['Remarks'];
$father=$ro['Father'];
$mother=$ro['Mother'];
$rssb=$ro['Rssb'];
$salary=number_format($ro['Salary']);
$qualify=$ro['Qualify'];
$start=$ro['Starting'];
$status=$ro['Status'];
$photo=$ro['Photo'];
$file1=$ro['File1'];
$file2=$ro['File2'];
$file3=$ro['File3'];
	if(!$photo)
		$photo="imgs/-text.png";
	else
		$photo="photos/$photo";
}

if($status=='1'){
	$cool=" style='color:#ff0000'";
	$btn="<button class='btn btn-primary btn-block btn-success' name='usus_id' style='width:100px;' onclick='return checkDeleteu()'>Unsuspend</button>";
}
else{
	$cool="";
	$btn="<button class='btn btn-small btn-block btn-warning' name='sus_id' style='width:100px;' onclick='return checkDelete()'>Suspend</button>";
}

if($file1)
	$dfile1="&raquo;&raquo;&nbsp;File1&nbsp;:&nbsp;<a href='down_file1.php?link=$file1' title='Click to download file 1'>Download&nbsp;File&nbsp;1</a>";
else
	$dfile1="&nbsp;File1&nbsp;:&nbsp;None";

	if($file2)
	$dfile2="&raquo;&raquo;&nbsp;File2&nbsp;:&nbsp;<a href='down_file2.php?link=$file2' title='Click to download file 2'>Download&nbsp;File&nbsp;2</a>";
else
	$dfile2="&nbsp;File2&nbsp;:&nbsp;None";

	if($file3)
	$dfile3="&raquo;&raquo;&nbsp;File3&nbsp;:&nbsp;<a href='down_file3.php?link=$file3' title='Click to download file 3'>Download&nbsp;File&nbsp;3</a>";
else
	$dfile3="&nbsp;File3&nbsp;:&nbsp;None";

$de=mysql_query("SELECT *FROM `depart` WHERE `Number`='$depart' ORDER BY `Number` ASC");
			  $re=mysql_fetch_assoc($de);
					$depart=$re['Depart'];
?>
<div class="container-fluid main-content">
<div class="page-title">
<div class="row">
<div class="col-md-6">
<h1 style='margin-top:-20px; margin-bottom: 5px;'>Employee Profile</h1>
</div>
<div class="col-md-6">
 <div class="col-md-5 pull-right" style='text-align:right;'>
 <form method='post' action='vemployee.php'>
 <?php
	echo"<input type='hidden' name='rowid' value='$code'>";
	?>
	<table><tr><td align='right'> <?php echo $btn ?></td>
</form> <form method='post' action='new_employee.php'>
	<td align='right'> <?php
	echo"<input type='hidden' name='rowid' value='$code'>";
	?>
	<button class="btn btn-primary btn-block" name='edit_id' style='width:100px;'>Edit</button>	
	</td></tr></table></form>
 </div></div>
</div></div>
  <div class="row">
        <div class="col-md-2">
		<ul class="list-group">
			 			  <li class="list-group-item active">
           <a href="employees.php">
           <p>
           <i class="lnr lnr-menu-circle"></i>&nbsp;List of Employees
           </p></a>
           </li>
                          <li class="list-group-item">
           <a href="new_employee.php">
           <p>
           <i class="lnr lnr-plus-circle"></i>&nbsp;Create Employee
           </p></a>
           </li>
                       </ul>
		
         
  
            <div class="widget-container fluid-height">
              <div class="widget-content">
               
                <div class="panel-group" id="accordion">
                  <div class="panel">
                    <div class="panel-heading">
                    </div> 
                  </div>
                  <div class="panel">
                    <div class="panel-heading">
                      <div class="panel-title">
                      </div>
                    </div>
                    <div class="panel-collapse collapse in" id="collapseTwo">
                    </div>
                  </div>
                  <div class="panel filter-categories">
                    <div class="panel-heading">
                      <div class="panel-title">
               <a class="accordion-toggle collapsed" data-parent="#accordion" data-toggle="collapse" href="#collapseThree">
                        <div class="caret pull-right"></div>  
                        Calculation</a>
                      </div>
                    </div>
                    <div class="panel-collapse collapse in" id="collapseThree">
                      <div class="panel-body">
                      <form method="POST" action="employees.php">
                      <input value="view_employees" name="user" type="hidden">
                      <select class="form-control" name="department">
                      <option selected="selected" value="">Show All</option>
 <?php
		$de=mysql_query("SELECT *FROM `depart` ORDER BY `Number` ASC");
			  while($re=mysql_fetch_assoc($de)){
					$ne=$re['Number'];
					$dep=$re['Depart'];
			echo"<option value='$ne' $sed>$dep</option>";
			  }
			  ?>                      
                      </select><br>
                      <button class="btn btn-block btn-primary" type="submit" name="submitfilter">
                      <i class="lnr lnr-checkmark-circle"></i> Submit</button>
                      </form></div></div>   </div>
                </div>
              </div>
            </div>        
         </div>
 
  <div class="col-md-10" <?php echo $cool ?>>  
<div class="col-md-3">
            <div class="widget-container fluid-height">
              <div class="heading">
                <h4>Profile Picture</h4>
              </div>
              <div class="widget-content padded " style="text-align:center;">
                            	<img src="<?php echo $photo ?>" width="60%"><br><br>
								Gender: <?php echo $gender ?>  <hr><div style='padding-top:16px;'>
								Calculation: <?php echo $depart ?> </div>
                            </div>
            </div>
          </div>
          <div class="col-md-5">
            <div class="widget-container fluid-height">
              <div class="heading">
               <h4>Personal Details</h4>
              </div>
             <div class="widget-content padded">
  <strong>Full Name:</strong>
   <p><?php echo" $fname $lname"; ?></p>
    <strong>Email:</strong>
     <p><?php echo $email ?></p>
     <strong>Phone No:</strong>
    <p><?php echo"$contact1, $contact2" ?></p>
  <strong>Date Of Birth:</strong>                  
 <p><?php echo $birth ?></p>
 <strong>Address:</strong>                
 <p><?php echo $address ?></p>            
 </div>
  </div>
   </div>
          <div class="col-md-4">
            <div class="widget-container fluid-height">
              <div class="heading">
                <h4>Official Details</h4>
              </div>
              <div class="widget-content padded">
             <strong>Father`s Name:</strong>
                  <p><?php echo $father ?>                 </p>
         <strong>Mother`s Name:</strong>
                 <p><?php echo $mother ?>                  </p>
                  <strong>Employee Code:</strong>
                 <p><?php echo $code ?></p>
                  <strong> Current Post:</strong>
		<?php
			$dei=mysql_query("SELECT *FROM `position` WHERE `Postid`='$currentp' ORDER BY `Postname` ASC");
			 if($fei=mysql_num_rows($dei)){
				 $rei=mysql_fetch_assoc($dei);
					$post=$re['Postname'];
			echo"<p> $post </p>";
			 }
			 else
				echo"<p> N/A </p>";
			?>
                  <strong>Salary:</strong>
                 <p>RWF&nbsp;<?php echo $salary ?>
                 </p>
              </div>
            </div>
          </div>
        </div>

</div>
<div class="row"> </div>
<div class="row">
<div class="col-md-2"></div>
<div class="col-md-10" <?php echo $cool ?>>
<div class="col-md-4">
<div class="widget-container fluid-height clearfix">
<div class="heading"><h4>Related Documents</h4></div>
<div class="widget-content padded"><center>
     
                    <?php echo $dfile1 ?>
                            <br> 

  
                    <?php echo $dfile2 ?>
                            <br>       


                    <?php echo $dfile3 ?>
                                 <br><br>
 </center></div>
 </div>
</div>
<div class="col-md-4">
<div class="widget-container fluid-height clearfix">
 <div class="heading"><h4>Identity Documents</h4></div>
 <div class="widget-content padded">
 <strong>ID/Passport No : </strong>&nbsp;&nbsp;<?php echo $idno ?>        <br>    
         <p></p>
        <strong>RSSB Number &nbsp;&nbsp;: </strong> &nbsp;&nbsp; <?php echo $rssb ?>     <p> 
             </p>
  </div> 
 </div>
</div> <div class="col-md-4">
<div class="widget-container fluid-height clearfix">
 <div class="heading"><h4>Bank details</h4></div>
 <div class="widget-content padded">
                <ul>
				<li>
                 <strong>Bank Name: </strong> &nbsp;&nbsp; <?php echo $bank ?>                  </li>
                  <li>
                    <strong>Account Number: </strong> &nbsp;&nbsp; <?php echo $account ?>                    </li>
                  <li>
                  <strong>Branch:  </strong>&nbsp;&nbsp; <?php echo $branch ?>                    </li>
				  </ul>
  </div> 
 </div>
</div></div>
</div>

<div class="row">
<div class="col-md-2"></div>
<div class="col-md-10">

<div class="widget-container fluid-height clearfix" style='width:99%; float:center;'>
 <div class="heading"><h4>Additional Information&nbsp;&nbsp;&nbsp;&nbsp;<br><br>
 <div align='right'><span class="badge"><?php echo $code ?></span></div></h4>
 <strong></strong>
 </div>
 
 <div class="widget-content padded">
 <div class="col-md-12">
 <div class="col-md-6">
                <ul>
                                                                        
                                                                        
                  </ul></div>
                
                
                <div class="col-md-6">
                 <ul>                                                   
                                                                        
                                            </ul>
                
                </div>
                </div>
  </div> 
 </div>
      
</div></div>
</div>

  
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

    <script language="JavaScript" type="text/javascript">
function checkDelete(){
    return confirm('Are you sure you want to suspend this employee?');
}
</script>

 <script language="JavaScript" type="text/javascript">
function checkDeleteu(){
    return confirm('Are you sure you want to unsuspend this employee?');
}
</script>
 </body></html>