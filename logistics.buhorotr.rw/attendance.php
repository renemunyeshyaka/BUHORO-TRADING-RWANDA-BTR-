<?php
if(basename($_SERVER['PHP_SELF']) == 'attendance.php') 
  $ca=" class='current'";
include'header.php';
include'connection.php';
$dato=$datos=$Date;

if(isset($_POST['submit_show']))
		{
		$dato=$_POST['dato'];
		$datos=$_POST['datos'];
		}

if(isset($_POST['submit_add']))
		{
		$employee=$_POST['employee'];
		$dato=$_POST['dato'];
		$datos=$_POST['datos'];
	$do=mysql_query("SELECT *FROM `employees` WHERE `Eid`='$employee'");
		$ro=mysql_fetch_assoc($do);
			$currentp=$ro['Currentp'];
		
			$date=$dato;
	while(strtotime("$date") <= strtotime("$datos")){

	$then=mysql_query("INSERT INTO `attendance` (`Employee`, `Currentp`, `Owner`, `Date`) VALUES ('$employee', '$currentp', '$loge', '$date')");
			//echo"///// $date <br>";

			$originalDate = $date;
		$newDate = date("Y-m-d", strtotime($originalDate));
			$date = strtotime("+1 day", strtotime("$newDate"));
				$date = date("d-m-Y", $date);				
			
	}
		}
	
	if(isset($_POST['delete_id']))
		{
			$rowid=$_POST['rowid'];
		$dato=$_POST['dato'];
		$datos=$_POST['datos'];
			$then=mysql_query("UPDATE `attendance` SET `Status`='1' WHERE `Number`='$rowid' LIMIT 1");
		}

	if($employee)
		$con="AND `Employee` = '$employee'";
	else
		$con='';

	$do=mysql_query("SELECT *FROM `attendance` WHERE `Date` BETWEEN '$dato' AND '$datos' AND `Status`='0' $con ORDER BY `Date` ASC");
				$fo=mysql_num_rows($do);
?>
<div class="container-fluid main-content">
<div class="page-title">
 
 <h1 style='margin-top:-20px; margin-bottom: 5px;'>Absence List</h1>

</div>
<div class="row"></div>
 <div class="row">

        <div class="col-md-12">
         <div class="row">
           <div class="col-md-6 "> 
           <form action="attendance.php" method="POST" class="form-horizontal ">
        <input name="searchkeyword" value="" type="hidden">
        <input name="column_name" value="" type="hidden">
    <table border='0'><tr><th>
            <div class="col-md-4 " style='width:150px;'> 
           <div class="input-group date datepicker" style='width:140px;'>
      <input class="form-control form-center" id="from" name="dato" type="text" value="<?php echo $dato ?>" onkeypress='return isNumberKey(event)' required>
	  <span class="input-group-addon"><i class="lnr lnr-calendar-full"></i></span>
			</div></div>
</th><th>

		  <div class="col-md-4 " style='width:150px;'> 
           <div class="input-group date datepicker" style='width:140px;'>	
      <input class="form-control form-center" id="to" name="datos" type="text" value="<?php echo $datos ?>" onkeypress='return isNumberKey(event)' required>
	  <span class="input-group-addon"><i class="lnr lnr-calendar-full"></i></span>
              </div></div> 
          
		  </th><th align='left'>
            
          
                    <div class="col-md-2" style='width:90px; top:2px;'> 
      
                 <button class="btn  btn-primary  btn-block" type="submit" name="submit_show"><i class="lnr lnr-chevron-right-circle"></i> Show</button>
          </div></th></tr></table> </div>





		    <div class="col-md-6 " style='text-align:right;'> 
        <input name="searchkeyword" value="" type="hidden">
        <input name="column_name" value="" type="hidden">
    
	    
          
                    <div class="col-md-2 " style='float:right'> 
                 <button class="btn  btn-primary  btn-block btn-success" type="submit" name="submit_add" onClick='return validate(form);'>Add</button>
          </div> 
            <div class="col-md-4 " style='float:right'> 
           <select name="employee" class="form-control" style='width:200px;'>
                              <option selected="selected" value=""> --Select Employee-- </option>
<?php
			$doi=mysql_query("SELECT *FROM `employees` WHERE `Status`='0' ORDER BY `Fname` ASC");
			while($roi=mysql_fetch_assoc($doi)){
$code=$roi['Eid'];
$fna=$roi['Fname'];
$lna=$roi['Lname'];
//$doh=mysql_query("SELECT *FROM `attendance` WHERE `Employee`='$code' AND `Date`='$Date' AND `Status`='0'");
			//	if(!$foh=mysql_num_rows($doh))
						echo"<option value='$code'> $fna $lna </option>";
			}
			?>                            
               </select>
          
         </div></form></div>
         
         <!--  Mark Attendance -->
<!-- mark attendance end  -->
         
         
         
         
          </div>
          <div class="row">
            <div class="col-md-12">
     
              <span>Total Records Found : <b><?php echo $fo ?></b></span>
            <div class="widget-container fluid-height clearfix">
            <div class="widget-content padded clearfix">
                
                                 <table class="table table-striped">
                       
                                      <thead>
                    <tr role="row">
                      <th class="hidden-xs"> S.NO</th> 					  
                       <th class="hidden-xs"> Code</th>
                       <th> First&nbsp;Name </th>
                       <th> Last&nbsp;Name </th> 
                       <th class="hidden-xs"> Current Post </th> 
                       <th> Date </th>
                       <th style='padding-right:40px;'><div align='right'>Status</div></th>
                        <th style="width: 40px;text-align:center;">Actions</th>
                     </tr>
                    </thead>
                                        <tbody>
<?php
$n=1;
	while($ro=mysql_fetch_assoc($do)){
$numb=$ro['Number'];
$eid=$ro['Employee'];
$curp=$ro['Currentp'];
$dati=$ro['Date'];
$leave=$ro['Leave'];
	if($leave){
		$lbt="<span class='label label-success' style='width:80px;'>LEAVE</span>";
		$act="<td><center> -- </td>";
	}
	else{
		$lbt="<span class='label label-danger' style='width:80px;'>ABSENT</span>";
		$act="<form method=post action='attendance.php'><td align='right' style='width:40px; padding:0px;'>
                              <center><input type='hidden' name='dato' value='$dato'>
<input type='hidden' name='datos' value='$datos'><input type='hidden' name='rowid' value='$numb'>
                          <button style='background-color:transparent;border:0px solid black; width:50px; margin:0px;' type='submit' name='delete_id'>
						  <span style=color:red;>Delete</span></button>
                                                    <input name=id value=29 type=hidden>
                          </td></form>";
	}

$dox=mysql_query("SELECT *FROM `employees` WHERE `Eid`='$eid'");
		$rox=mysql_fetch_assoc($dox);
			$fn=$rox['Fname'];
			$ln=$rox['Lname'];

$theni=mysql_query("SELECT `Postname` FROM `position` WHERE `Postid` = '$curp'");
	$reni=mysql_fetch_assoc($theni);
		$pos=$reni['Postname'];
           
		print("<tr>
                        <td class=hidden-xs>$n</td>
                        <td class=hidden-xs>$eid</td>
                        <td> $fn </td><td> $ln </td>
                        <td class=hidden-xs> $pos </td>
                        <td> $dati </td>
                        <td align='right'> $lbt </td>
                          $act              	
                        <tr>");
	$n++;
	}
	?>
              
                    </tbody>   
                  </table>
                                      <div class="row">
                  <div class="col-md-12">
                  <div class="pull-right">
                  <ul class="pagination">
                      <li>
                                 <a class="icon" href="#">
           <i class="lnr lnr-chevron-left"></i></a>
                                            </li>
                      <li class="active">
                        <a href="#">
                        1                       </a>
                      </li>

                                            <li>
                                              <a class="icon" href="#">
                        <i class="lnr lnr-chevron-right"></i></a>
                                           </li>
                    </ul>
              </div></div></div>
                                
              </div>
            </div>
        </div>
</div></div></div></div>
  
  <script>
  function validate(formCheck) 
{ 
if (formCheck.employee.value=="")
{ 
alert("Please, select an employee !"); 
formCheck.employee.focus();
return false;
}
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
	  // validate input to be numbers only
	 function isNumberKey(evt)
      {
         var charCode = (evt.which) ? evt.which : event.keyCode
         if (charCode > 31 && (charCode < 42 || charCode > 57))
            return false;

         return true;
      }
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
