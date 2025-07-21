<?php
if(basename($_SERVER['PHP_SELF']) == 'payc.php') 
  $pp=" class='current'";
include'header.php';
include'connection.php';


 $doit=mysql_query("SELECT *FROM `payrolls` WHERE `Level`='2' ORDER BY `Number` DESC");
if($foit=mysql_num_rows($doit)){
		$roit=mysql_fetch_assoc($doit);
			$dat=$roit['Ending'];
}
else
$dat=$Date;

		$dato = strtotime("+1 day", strtotime("$dat"));
				 $dato=date("d-m-Y", $dato);

		$datos = strtotime("+6 day", strtotime("$dato"));
				 $datos=date("d-m-Y", $datos);


if(isset($_POST['search']))
		{
			$dato=$_POST['dato'];
			$datos=$_POST['datos'];
			$currentp=$_POST['currentp'];
		}

		if($currentp)
			$cp="AND `Currentp`='$currentp'";
			else
				$cp='';

$do=mysql_query("SELECT *FROM `employees` WHERE `Eid`!='1001' AND `Status`='0' AND `Depart`='2' $cp ORDER BY `Fname` ASC");
		$fo=mysql_num_rows($do);

?>

<div class="container-fluid main-content">
<div class="page-title">
 
 <h1 style='margin-top:-20px; margin-bottom: 5px;'>Casual Payroll</h1>


                 </div>
<div class="row"></div>   
     
        <div class="row">             
           
           
       
        <div class="col-lg-10">
                  <div class="row">
           <div class="col-lg-6"> 
        <input name="searchkeyword" value="" type="hidden">
        <input name="column_name" value="" type="hidden">   
                 
    
        </form>
           
           
              </div>
          
          
           <div class="col-lg-6" style='float:right; border:0px solid blue;'> </div>
		   
		   
		   <div class="col-lg-12" style='float:right; border:0px solid blue;'> <div align='right'>           

        <form action="" method="post" class="form-horizontal ">
              <table style='margin-top:-40px; margin-right:-40px;' border='0'>
			  <tr><td> <div class="col-md-4" style='width:140px; padding-top:5px;'> 
			  
			  <select class="form-control" name="currentp" style='width:140px; margin-right:-10px; margin-top:-5px;'>
			  <option value="0">Select&nbsp;Position</option>
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
                            </select></div></td><td>  <div class="col-md-4" style='width:142px;'> 
           <div class="input-group date datepicker" style='width:140px;'>
      <input class="form-control form-center" id="from" name="dato" type="text" value="<?php echo $dato ?>" onkeypress='return isNumberKey(event)' required>
	  <span class="input-group-addon"><i class="lnr lnr-calendar-full"></i></span>
			</div></div>
		</td><td>

		  <div class="col-md-4" style='width:142px;'> 
           <div class="input-group date datepicker" style='width:140px;'>	
      <input class="form-control form-center" id="to" name="datos" type="text" value="<?php echo $datos ?>" onkeypress='return isNumberKey(event)' required>
	  <span class="input-group-addon"><i class="lnr lnr-calendar-full"></i></span>
              </div></div> 
          
		  </td><td> <div class="col-md-4" style='width:100px; padding-top:5px;'>  
			
                      <span class="input-group-btn">
                        <button class="btn  btn-primary" type="submit" name="search" style='border-radius:5px;'><i class="lnr lnr-magnifier"></i> Search</button>
                      </span>
				</div>
					  </td></tr></table>
                       </div>
            </form> 
           </div> </div>             
               
           </div></div>
		   <?php
		   $days = date(' t ', strtotime($mt) );
		   ?>

             <div class="row"><form action='slips.php' method='post' name='myform'>
            <div class="col-lg-12" style='text-align:left; margin-top:-20px; border:0px solid black;'>
             <span>Total Records Found : <b><?php echo" $fo "; ?></b></span>
			 <div style='text-align:right; margin-top:-20px; padding-right:20px;'>
<li>
         <a href="javascript:void();" onclick="javascript:checkAll('myform', true);">Check All</a> | 
         <a href="javascript:void();" onclick="javascript:checkAll('myform', false);">UnCheck All</a>
</li></div>
             <div class="widget-container fluid-height clearfix">
            <div class="widget-content padded clearfix">
                
                                <table class="table table-striped">     
                                      <thead>
                    <tr role="row">
                     <th class="hidden-xs"> S.NO</th>
			<th class="hidden-xs"> EMPLOYEE </th><th class="hidden-xs" align='left'> POSITION </th>
					  <th class="hidden-xs" align='left'> AMOUNT </th>
					  <?php
					$date=$dato;
					  while(strtotime($date) <= strtotime($datos)){
						   $pieces = explode("-", $date);
								$i=$pieces[0];
						  echo"<th> $i </th>";
				 $date = strtotime("+1 day", strtotime("$date"));
				 $date=date("d-m-Y", $date);
								 }
								 ?>
						
                     </tr>
                    </thead>
                                        <tbody>
					<?php
					$n=$t=1;
						while($ro=mysql_fetch_assoc($do)){
$code=$ro['Eid'];
$fna=$ro['Fname'];
$lna=$ro['Lname'];
$sal=$ro['Salary'];
$curp=$ro['Currentp'];

$dei=mysql_query("SELECT *FROM `position` WHERE `Postid`='$curp' ORDER BY `Postname` ASC");
			 if($fei=mysql_num_rows($dei)){
				 $rei=mysql_fetch_assoc($dei);
					$post=$rei['Postname'];
			 }
			 else
				 $post="N/A";

$salo=number_format($sal);
$mto = date('m', strtotime("$mt"));
        
		print("<tr>
                        <td class=hidden-xs align='center'>$t</td>
                        <td> $fna $lna </td> <td class='hidden-xs' align='left'> $post </td> <td class='hidden-xs' align='center'> $salo </td>");
 $date=$dato; 
 while(strtotime($date) <= strtotime($datos)){
			 $pieces = explode("-", $date);
					$i=$pieces[0];
					$mt=$pieces[1];
					 $mt = date("F", mktime(0, 0, 0, $mt, 10));
					   $yr=$pieces[2];

	 if($i%2==0)
		 $clr="";
	 else
		 $clr="";

	 $doi=mysql_query("SELECT *FROM `payrolls` WHERE `Employee`='$code' AND `Month`='$mt' AND `Year`='$yr' AND `D$i`='1'");
		$foi=mysql_num_rows($doi);
		if($foi)
			$sl="checked";
		else
			$sl="";

//if(!$foi)
//$sl="checked";

	$dto=$date;

						  echo"<td title='$fna $lna // $i $mt $yr
			Salary: $salo
			$dto' style='background-color: $clr;'>  
  <input type='checkbox' class='input-assumpte' id='input-confidencial' name='cheko$n' value='1' $sl>  
		<input type='hidden' name='code$n' value='$code'><input type='hidden' name='sal$n' value='$sal'>
		<input type='hidden' name='curp$n' value='$curp'><input type='hidden' name='date$n' value='$date'></td>";
					$date = strtotime("+1 day", strtotime("$date"));
				 $date=date("d-m-Y", $date);
						    $n++;
 }
						
                    print("</tr>");	
						$t++;
						}
						?>
						
                    </tbody>   
                  </table> <HR STYLE='margin-top:-8px;'>
                                      <div class="row">
                  <div class="col-md-12">
                  <div class="pull-right" style='width:280px; padding-right:40px;'>
              <?php
					echo"<input type='hidden' name='n' value='$n'><input type='hidden' name='dato' value='$dato'>
					<input type='hidden' name='datos' value='$datos'>";

		if($dato!=$datos){
					?>
                       <button class="btn btn-lg btn-block btn-success" type="submit" name="submit">
					   <i class="lnr lnr-checkmark-circle"></i> Submit </button> 
					   
					   <?php
		}
					   $set=mysql_query("UPDATE `payrolls` SET `Total`=`D01` + `D02` + `D03` + `D04` + `D05` + `D06` + `D07` 
					   + `D08` + `D09` + `D10` + `D11` + `D12` + `D13` + `D14` + `D15` + `D16` + `D17` + `D18` + `D19` + `D20` 
					   + `D21` + `D22` + `D23` + `D24` + `D25` + `D26` + `D27` + `D28` + `D29` + `D30` + `D31`
					   WHERE `Total`='0' AND `Level`='2' ORDER BY `Number` DESC LIMIT 100");
					  
					   ?>
              </div></div></div></form>
                                
              </div>
            </div><br><br>
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
   
    <script type="text/javascript">
function checkAll(formname, checktoggle)
{
     var checkboxes = new Array();
      checkboxes = document[formname].getElementsByTagName('input');
      for (var i = 0; i < checkboxes.length; i++) {
          if (checkboxes[i].type === 'checkbox') {
               checkboxes[i].checked = checktoggle;
          }
      }
}
</script>

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

    <script language="JavaScript" type="text/javascript">
function checkDelete(){
    return confirm('Are you sure you want to delete this record?');
}
</script>
 </body></html>
