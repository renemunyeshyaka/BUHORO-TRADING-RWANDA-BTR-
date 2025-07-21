<?php
if(basename($_SERVER['PHP_SELF']) == 'rules.php') 
  $pp=" class='current'";
include'header.php';
include'connection.php';
$dato=$datos=$Date;

if(isset($_POST['add']))
		{
			$descri=$_POST['descri'];
			$valu=$_POST['valu'];
			$value=$_POST['value'];
		$then=mysql_query("INSERT INTO `rules` (`Date`, `User`, `Description`, `Employer`, `Employee`) VALUES ('$Date', '$loge', '$descri', '$valu', '$value')");
		$pto='10';
		}

if(isset($_POST['upda']))
		{
			$rowid=$_POST['rowid'];
			$descri=$_POST['descri'];
			$valu=$_POST['valu'];
			$value=$_POST['value'];
		$then=mysql_query("UPDATE `rules` SET `Date`='$Date', `User`='$loge', `Description`='$descri', `Employer`='$valu', `Employee`='$value' WHERE `Number`='$rowid'");
		$pto='20';
		}

if(isset($_POST['edit_id']))
		{
			$rowid=$_POST['rowid'];
	$doi=mysql_query("SELECT *FROM `rules` WHERE `Number`='$rowid'");
		$roi=mysql_fetch_assoc($doi);
			$vu=$roi['Employer'];
			$vue=$roi['Employee'];
			$des=$roi['Description'];
			$btn="UPDATE";
			$vtn="upda";
		}
else{
	$rowid='0';
	$vu='';
	$vue='';
	$des='';
	$btn="ADD";
	$vtn="add";
}
$so=mysql_query("DELETE FROM `rules` WHERE `Employee`='0' AND `Employer`='0'");

$do=mysql_query("SELECT *FROM `rules` ORDER BY `Number` ASC LIMIT 100");
$fo=mysql_num_rows($do);
?>
<div class="container-fluid main-content">
        <div class="page-title">
          <h1 style='margin-top:-20px; margin-bottom: 5px;'>
         Leave Approval
          </h1>
                 </div>
     
        <div class="row">
  <div class="col-lg-2">
   
   <ul class="list-group">
      
     <li class="list-group-item">
           <a href="pays.php">
           <p>
           <i class="lnr lnr-plus-circle"></i>&nbsp;Payroll
           </p></a>
           </li>
		   <li class="list-group-item">
           <a href="payc.php">
           <p>
           <i class="lnr lnr-menu-circle"></i>&nbsp;Casual
           </p></a>
           </li>
		 <li class="list-group-item active">
           <a href="rules.php">
           <p>
           <i class="lnr lnr-plus-circle"></i>&nbsp;Rules
           </p></a>
           </li>
            </ul>
  </div>
                    
           
           
       
        <div class="col-lg-10">
                  <div class="row">
           <div class="col-lg-6 "> 
           <form action="" method="POST" class="form-horizontal ">
        <input name="searchkeyword" value="" type="hidden">
        <input name="column_name" value="" type="hidden">
    
            <div class="col-lg-4 "> 
           <select name="perpagevalue" class="form-control">
                              <option selected="selected" value="10">10 per page</option>
                              <option value="50">50 per page</option>
                              <option value="100">100 per page</option>
                              <option value="200">200 per page</option>
                            
               </select>
          
         </div>    
          
                    <div class="col-lg-2 "> 
      
                 <button class="btn  btn-primary  btn-block" type="submit" name="perpage"><i class="lnr lnr-chevron-right-circle"></i> Show</button>
          </div> 
    
        </form>
           
           
              </div>
          
          
           <div class="col-lg-6 ">
           

        <form action="" method="post" class="form-horizontal ">
                  
                       <div class="col-lg-6" style='width:90px;'> 
                     <input class="form-control" name="valu" placeholder="Employer" type="text" style='width:90px; text-align:center;' 
					  onkeypress='return isNumberKey(event)' value="<?php echo $vu ?>">
						</div>

						 <div class="col-lg-6" style='width:90px;'> 
                     <input class="form-control" name="value" placeholder="Employee" type="text" style='width:90px; text-align:center;' 
					  onkeypress='return isNumberKey(event)' value="<?php echo $vue ?>">
                        </div> 

                       <div class="col-lg-6 input-group">
                       <?php echo"<input type='hidden' value='$rowid' name='rowid'>"; ?>
                      <input class="form-control" name="descri" placeholder="Description" type="text" value="<?php echo $des ?>">
                      <span class="input-group-btn">
                        <button class="btn  btn-primary" type="submit" name="<?php echo $vtn ?>">
						<i class="lnr lnr-magnifier"></i> <?php echo $btn ?></button>
                      </span>
                      
                      
                      </div>
                  
            </form> 
            </div>
               
            </div>

			 <?php 
if($pto==10)
echo"<center><div class='alert alert-danger' style='width:48%;text-align:center;float:center;background-color: #60c560;color: #ffffff;border-radius:5px;'>
		<i class='lnr lnr-checkmark-circle'></i> &nbsp;&nbsp; <button class='close' data-dismiss='alert' type='button'>×</button>New Rule Has Been Created.
		</div></center>";
if($pto==20)
echo"<center><div class='alert alert-danger' style='width:48%;text-align:center;float:center;background-color: #60c560;color: #ffffff;border-radius:5px;'>
		<i class='lnr lnr-checkmark-circle'></i> &nbsp;&nbsp; <button class='close' data-dismiss='alert' type='button'>×</button>Existing Rule Has Been Updated.
		</div></center>";
		?>
             
             <div class="row">
            <div class="col-lg-12">
             <span>Total Records Found : <b><?php echo $fo ?></b></span>
            <div class="widget-container fluid-height clearfix">
            <div class="widget-content padded clearfix">
               
                                 <table class="table table-striped">     
                                      <thead>
                    <tr role="row">
                     <th class="hidden-xs"> S.NO</th>
                       <th class="hidden-xs"> Date </th> 
                       <th> Description </th> 
						 <th> Employer </th>
                        <th> Employee </th>
                        <th class="hidden-xs"> Status </th>
                        <th style="text-align:center;">Actions</th>
                     </tr>
                    </thead>
                                        <tbody>
					<?php
					$n=1;
						while($ro=mysql_fetch_assoc($do)){
$code=$ro['Number'];
$dati=$ro['Date'];
$empoe=$ro['Employee'];
$empor=$ro['Employer'];
$descri=$ro['Description'];
	
	if($empoe<100)
		$per="%";
	else
		$per="";

			$lbt="<td style='width:20px;'><span class='label label-success' style='width:80px;'>ACTIVE</span></td>";
			
		print("<tr>
                        <td class=hidden-xs style='text-align:center;'>$n</td>
                        <td class='hidden-xs'> $dati </td><td> $descri </td>
						<td> $empor $per </td><td class='hidden-xs'> $empoe $per </td> $lbt 

                     <form method=post action='rules.php'><td align='right' style='width:20px;padding-right:10px;'>
                        <input type='hidden' name='rowid' value='$code'>
									
					  <button style='background-color:transparent; border:0px solid black; width:50px;' type='submit' name='edit_id'>
						  <span style=color:red;>Edit</span></button> 
                          </td></form></tr>");
						  $n++;
						}
						?>
						
                    </tbody>   
                  </table>
                    <div class="row">
                  <div class="col-lg-12">
                  <div class="pull-right">
                  <ul class="pagination">
                      <li>
                                            </li>
                      <li class="active">
                        <a href="#">
                        1                        </a>
                      </li>
                                             <li>
                        <a href="#">
                        2                        </a>
                      </li>
                                             <li>
                                              <a class="icon" href="#">
                        <i class="lnr lnr-chevron-right"></i></a>
                                           </li>
                    </ul>
              </div></div></div>                     
                
              </div>
            </div></div>
                  </div>
      
   </div></div></div>  
  <script>
	 // validate input to be numbers only
	 function isNumberKey(evt)
      {
         var charCode = (evt.which) ? evt.which : event.keyCode
         if (charCode > 31 && (charCode < 42 || charCode > 57))
            return false;

         return true;
      }
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
 </body></html>