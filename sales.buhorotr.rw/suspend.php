<?php
if(basename($_SERVER['PHP_SELF']) == 'suspend.php') {
  $cu=" class='current'";
} else {
  $cu="";
} 
include'header.php';
include'connection.php';
$perpagevalue=20;
$cond="LIMIT $perpagevalue";
			$tbl="`employees`";
$conde='';
$condi='';

if(isset($_POST['perpage']))
		{
			$perpagevalue=$_POST['perpagevalue'];
			$cond="LIMIT $perpagevalue";
		}
if(isset($_POST['search']))
		{
			$searchkeyword=$_POST['searchkeyword'];
		if($searchkeyword)
			$conde="AND (`Fname` LIKE '%$searchkeyword%' OR `Lname` LIKE '%$searchkeyword%' OR `Address` LIKE '%$searchkeyword%' OR `Idno` LIKE '%$searchkeyword%' OR `Contact1` LIKE '%$searchkeyword%' OR `Contact2` LIKE '%$searchkeyword%' OR `Father` LIKE '%$searchkeyword%' OR `Mother` LIKE '%$searchkeyword%')";
		else
			$conde='';
		}
if(isset($_POST['submitfilter']))
		{
			$department=$_POST['department'];
		if($department)
			$condi="AND `Depart`='$department'";
		if($department==2)
			$tbl="`casual`";
		else
			$tbl="`employees`";
		}

if(isset($_POST['delete_id']))
		{
			$rowid=$_POST['rowid'];
			$then=mysql_query("UPDATE `employees` SET `Status`='1001' WHERE `Eid`='$rowid' LIMIT 1");
		}

$do=mysql_query("SELECT *FROM $tbl WHERE `Eid`!='1001' AND `Status`='1' $conde $condi $cond");
$fo=mysql_num_rows($do);
?>	  
	  
	  <div class="container-fluid main-content">
  <div class="page-title">
          <h1 style='margin-top:-20px; margin-bottom: 5px;'>
           Suspended
          </h1>
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
           <a href="suspend.php">
           <p>
           <i class="lnr lnr-plus-circle"></i>&nbsp;Suspend
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
                        Sort By</a>
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
         
         
         <!-- Search and show per page on top of table -->
         <div class="col-md-10">
          <div class="row">
           <div class="col-md-6 "> 
           <form action="employees.php" method="POST" class="form-horizontal ">
        <input name="searchkeyword" value="" type="hidden">
        <input name="column_name" value="" type="hidden">
    
            <div class="col-md-4 "> 
           <select name="perpagevalue" class="form-control">
                              <option selected="selected" value="20">20 per page</option>
                              <option value="50">50 per page</option>
                              <option value="100">100 per page</option>
                              <option value="200">200 per page</option>
                              <option value="300">300 per page</option>
                              <option value="500">500 per page</option>
                            
               </select>
          
         </div>    
          
                    <div class="col-md-2 "> 
      
                 <button class="btn  btn-primary  btn-block" type="submit" name="perpage"><i class="lnr lnr-chevron-right-circle"></i> Show</button>
				
          </div> 
    
        </form>
        </div>
          
          
           <div class="col-md-6 ">
           

        <form action="" method="post" class="form-horizontal ">
                  
                       <div class="col-md-6"> 
                       
		<span>Total Records Found : <b><?php echo" $fo / $perpagevalue" ?></b></span>
                        </div>
                       <div class="col-lg-6 input-group">
                       
                      <input class="form-control" name="searchkeyword" placeholder="search" type="text">
                      <input value="" name="department" type="hidden">
                      <span class="input-group-btn">
                        <button class="btn  btn-primary" type="submit" name="search"><i class="lnr lnr-magnifier"></i> Search</button>
                      </span>
                      
                      
                      </div>
         </form>
            </div> 
               
            </div>
            
            <div class="row" style='padding-top:-30px;'>
            <div class="col-md-12">
            <span>&nbsp;&nbsp;&nbsp;</span>  
            <div class="widget-container fluid-height clearfix" style='margin-top:-40px;'>
            <div class="widget-content padded clearfix">
                
                                 <table class="table table-striped" style='margin-top:-20px;'>     
                                      <thead>
                    <tr role="row">
                     <th> S.NO</th> 
                       <th> Code</th>
                       <th> First&nbsp;Name </th>
                       <th> Last&nbsp;Name</th> 
                       <th> Salary</th>
                       <th> Contact</th>
					   <th> ID_Number</th>
					   <th> Address</th>
					   <th><center> Post</th>
                        <th colspan='2'><center> Actions</th>
                     </tr>
                    </thead>
                                        <tbody>
                                          
				<?php
				$n=1;
				while($ro=mysql_fetch_assoc($do)){
$code=$ro['Eid'];
$fna=$ro['Fname'];
$lna=$ro['Lname'];
$dep=$ro['Depart'];
$cont=$ro['Contact1'];
$idn=$ro['Idno'];
$pos=$ro['Currentp'];
$adde=$ro['Address'];

$then=mysql_query("SELECT `Depart` FROM `depart` WHERE `Number` = '$dep'");
$ren=mysql_fetch_assoc($then);
$dep=$ren['Depart'];

$theni=mysql_query("SELECT `Postname` FROM `position` WHERE `Postid` = '$pos'");
$reni=mysql_fetch_assoc($theni);
$pos=$reni['Postname'];

	print("<tr><td class='hidden-xs'> $n</td><td class='hidden-xs'> $code</td><td> $fna</td><td> $lna</td><td class='hidden-xs'> $dep</td>
	<td align='right'> $cont</td><td class='hidden-xs' align='right'> $idn</td><td class='hidden-xs'> $adde</td><td class='hidden-xs'> $pos</td>
	
	  <td  align='right' style='width:40px;padding:0px;'><div class='action-buttons'>
                                                <a class='table-actions' href='vemployee.php?id=$code'>View</a></td>

												   
						   <form method=post action='suspend.php'><td align='right' style='width:40px; padding:0px;'>
                              <input type='hidden' name='rowid' value='$code'>
                          <button style='background-color:transparent;border:0px solid black; width:50px; margin:0px;' type='submit' name='delete_id' onclick='return checkDelete()'>
						  <span style=color:red;>Delete</span></button>
                                                    <input name=id value=29 type=hidden>
                          </td></form>
                                                </div></td></tr>");
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
                                            </li>
                      <li class="activei">
                        <a href="#">
                        Next                        </a>
                      </li>
                                             <li>
                                            </li>
                    </ul>
              </div></div></div>
                                
              </div>
            </div>
        </div>
       </div>
       </div>
       </div> </div>   
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
    return confirm('Are you sure you want to delete this record?');
}
</script>

 </body></html>