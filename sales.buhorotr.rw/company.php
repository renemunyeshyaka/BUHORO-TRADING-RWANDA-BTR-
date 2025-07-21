<?php
if(basename($_SERVER['PHP_SELF']) == 'prices.php') 
  $cu=" class='current'";
include'header.php';
include'connection.php';
$dato=$datos=$Date;
$conde='';
$emploi='';
$emplo='Select Class';

if(isset($_POST['save']))
		{
			$n=$_POST['n'];
			while($n>0){
			$codi=$_POST["code$n"];
			$vtype=$_POST["vtype$n"];
			$price=$_POST["price$n"];
			$price=str_replace(',', '', $price);
	$then=mysql_query("UPDATE `services` SET `$vtype`='$price' WHERE `Number`='$codi' LIMIT 1");
		$n--;
			}
		}

$so=mysql_query("DELETE FROM `payment` WHERE `Amount`='0' ORDER BY `Number` ASC LIMIT 50");

		if($emplo!='Select Class' AND $emplo!='')
			$conde="AND `Done`='$emplo'";

$do=mysql_query("SELECT *FROM `services` ORDER BY `Number` ASC");
$fo=mysql_num_rows($do);
?>
<div class="container-fluid main-content">
      
           
           
       
        <div class="col-lg-12">
            <div class="col-lg-12">
             <span>Total Records Found : <b><?php echo" $fo " ?></b></span>
            <div class="widget-container fluid-height clearfix">
            <div class="widget-content padded clearfix">
               <form action="" method="post">
                                 <table class="table table-striped">     
                                      <thead>
                    <tr role="row">
                     <th class="hidden-xs"> S.NO</th>
                        <th> Service&nbsp;Name </th>
						<?php
						$n=1;	
	$doil=mysql_query("SELECT *FROM `vtype` ORDER BY `Number` ASC");
			while($roil=mysql_fetch_assoc($doil)){
				$clna=$roil['Type'];
			echo"<th><div align='center'> $clna </div></th>";
			}
			?>    
                      
                     </tr>
                    </thead>
                                        <tbody>
					<?php
						$tot=0;		$p=1;
		while($ro=mysql_fetch_assoc($do)){
$code=$ro['Number'];
$servo=$ro['Name'];

	
	if($pupo)
		$pupos="&nbsp;($pupo)";
	else
		$pupos="";

	if($servo=='Discount Rate'){
		$stl="style='color:blue;'";
		$clr="color:blue;";
		$wdt="width:80px;";
		$per="<font color='blue'>%</font>";
	}
	else{
		$stl='';
		$clr="";
		$wdt="width:100px;";
		$per="";
	}
/*
if($file1)
	$dfile="<a href='down_contra.php?link=$file1'>Download&nbsp;File</a>";
else
	$dfile="";
*/
           
		print("<tr><td class=hidden-xs $stl><div align='center'>$p&nbsp;&nbsp;</td><td $stl> $servo </td>");
		
	$doit=mysql_query("SELECT *FROM `vtype` ORDER BY `Number` ASC");
			while($roit=mysql_fetch_assoc($doit)){
				$clna=$roit['Type'];	
	
	$doi=mysql_query("SELECT *FROM `services` WHERE `Number`='$code'");
			$roi=mysql_fetch_assoc($doi);
				$pri=$roi["$clna"];
				$pro=number_format($pri);
		print("<td><div align='center'><input type='hidden' value='$code' name='code$n'><input type='hidden' value='$clna' name='vtype$n'>
		&nbsp;$per&nbsp;<input class='form-control' name='price$n' type='text' value='$pro' required style='$wdt height:24px; padding:0px 5px 0px 5px; float:right; text-align:center; $clr' onkeyup='format(this);' onkeypress='return isNumberKey(event)' title='$clna / $servo'></div></td>");
						  $n++;
			}
			$p++;
						}
						$toto=number_format($tot);
						?>
						
                    </tr></tbody>
                  </table>
					<?php
				if($_SESSION['Priaccess']=='1'){
					?>
					<div class="col-lg-12">
                  <div class="pull-right"><?php echo"<input type='hidden' name='n' value='$n'>"; ?>
                 <button class="btn btn-primary btn-success hidden-print" name='save' type='submit'><i class="lnr lnr-menu-circle"></i>&nbsp;&nbsp;CHANGE</button>
              </div></div>
				<?php
					}
				?>
						</form>

 

                 </div>                     
                
              </div>
            </div></div>
                  </div>
      
   </div></div></div>  
   <style>
   @media print
{    
    .no-print, .no-print *
    {
        display: none !important;
    }
}
</style>
  <script>
$(document).ready(function(){
	$(".pdf").click(function(){
		$("#table1").hide();
		setTimeout(function(){$("#table1").show()},1000);
		});
});

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
<script src="style/bootstrap-confirmation.js"></script>
  
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
  
   // Toggle repayment schedle
	   function toggle() {
	var ele = document.getElementById("toggleText");
	var text = document.getElementById("displayText");
	if(ele.style.display == "block") {
    		ele.style.display = "none";
		text.innerHTML = "<U>Change Discount</U>";
  	}
	else {
		ele.style.display = "block";
		text.innerHTML = "<U>Change Discount</U>";
	}
	}
   </script>
 </body></html>