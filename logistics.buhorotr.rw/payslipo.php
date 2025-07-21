<?php
if(basename($_SERVER['PHP_SELF']) == 'payslip.php') 
  $pp=" class='current'";
include'headero.php';
include'connection.php';
$Date;

		// *************************** Open a given payroll *************************************
if(isset($_POST['open_id']))
		{
			$mt=$_POST['mt'];
			$yr=$_POST['yr'];
			$numb=$_POST['numb'];
			$ope=1;
		}
		

$do=mysql_query("SELECT *FROM `payrolls` WHERE `Number`='$numb' ORDER BY `Number` ASC");
	$fo=mysql_num_rows($do);
	while($ro=mysql_fetch_assoc($do)){
$numb=$ro['Number'];
$mt=$ro['Month'];
$user=$ro['User'];
$yr=$ro['Year'];
$dati=$ro['Date'];
$st=$ro['Status'];
$sal=$ro['Salary'];
$empo=$ro['Employee'];
	}

$doe=mysql_query("SELECT *FROM `employees` WHERE `Eid`='$empo' AND `Depart`='1' ORDER BY `Fname` ASC");
		$foe=mysql_num_rows($doe);
		while($roe=mysql_fetch_assoc($doe)){
			$fna=$roe['Fname'];
			$lna=$roe['Lname'];
			$currentp=$roe['Currentp'];
			$rssb=$roe['Rssb'];
			$idno=$roe['Idno'];
			$cont1=$roe['Contact1'];
			$cont2=$roe['Contact2'];
			$bank=$roe['Bank'];
			$acco=$roe['Account'];
			if($bank)
				$banko="[$bank / $acco]";
			else
				$banko="";
		}

		$dei=mysql_query("SELECT *FROM `position` WHERE `Postid`='$currentp' ORDER BY `Postname` ASC");
			 if($fei=mysql_num_rows($dei)){
				 $rei=mysql_fetch_assoc($dei);
					$post=$re['Postname'];
			 }
			 else
				 $post="";

		$allow=0;
// ******************************* allowances for selected month *******************************************
	$allo1=mysql_query("SELECT *FROM `allows` WHERE `Employee`='$empo' AND `M1`='$mt' AND `Y1`='$yr' AND `Status`='0'");
			while($ro1=mysql_fetch_assoc($allo1)){
				$allow+=$ro1['A1'];
			}
	$allo2=mysql_query("SELECT *FROM `allows` WHERE `Employee`='$empo' AND `M2`='$mt' AND `Y2`='$yr' AND `Status`='0'");
			while($ro2=mysql_fetch_assoc($allo2)){
				$allow+=$ro2['A2'];
			}
	$allo3=mysql_query("SELECT *FROM `allows` WHERE `Employee`='$empo' AND `M3`='$mt' AND `Y3`='$yr' AND `Status`='0'");
			while($ro3=mysql_fetch_assoc($allo3)){
				$allow+=$ro3['A3'];
			}
	$allo4=mysql_query("SELECT *FROM `allows` WHERE `Employee`='$empo' AND `M4`='$mt' AND `Y4`='$yr' AND `Status`='0'");
			while($ro4=mysql_fetch_assoc($allo4)){
				$allow+=$ro4['A4'];
			}

	
	$duct=0;
// ******************************* deductions for selected month *******************************************
	$duct1=mysql_query("SELECT *FROM `deduct` WHERE `Employee`='$empo' AND `M1`='$mt' AND `Y1`='$yr' AND `Status`='0'");
			while($ro1=mysql_fetch_assoc($duct1)){
				$duct+=$ro1['A1'];
			}
	$duct2=mysql_query("SELECT *FROM `deduct` WHERE `Employee`='$empo' AND `M2`='$mt' AND `Y2`='$yr' AND `Status`='0'");
			while($ro2=mysql_fetch_assoc($duct2)){
				$duct+=$ro2['A2'];
			}
	$duct3=mysql_query("SELECT *FROM `deduct` WHERE `Employee`='$empo' AND `M3`='$mt' AND `Y3`='$yr' AND `Status`='0'");
			while($ro3=mysql_fetch_assoc($duct3)){
				$duct+=$ro3['A3'];
			}
	$duct4=mysql_query("SELECT *FROM `deduct` WHERE `Employee`='$empo' AND `M4`='$mt' AND `Y4`='$yr' AND `Status`='0'");
			while($ro4=mysql_fetch_assoc($duct4)){
				$duct+=$ro4['A4'];
			}		

$salo=number_format($sal);
$allowo=number_format($allow);
$ducto=number_format($duct);

 if($sal>100000)
				 $tpr=((100000-30000)*(20/100))+(($sal-100000)*(30/100));
			 else
				 $tpr=($sal-30000)*(20/100);

		   $tpro=number_format($tpr);	
?>
	  
	

<div class="container-fluid main-content" id="div_print" style='margin-top:-94px; border:0px solid blue;'>
<div class="page-title" style='height:50px; border:0px solid blue;'>

<h1>
Payslip
</h1></div>


<div class="invoice">
<div class="row">
<div class="col-lg-12">

<table class="table  invoice-table ">
<tbody>
<tr><td width="30%">
<img src="imgs/logo.png" height="120px;" width="150px;"></td><td width="40%"></td>
<td class="text-right" width="30%">
<?php
echo"<h2>#$empo</h2>
<h5>$mt $yr</h5>
<h5>Basic Pay: RWF&nbsp;$salo</h5><h5> Date:
$Date</h5>";
?>
</td></tr>
    </tbody></table>



</div>

<div class="col-lg-12">

<table class="table  invoice-table">
    <thead>
<tr>
<th width="40%">
<?php
	echo"<h4><strong>EMPLOYER</strong></h4></th><th width='30%'></th><th class='text-right' width='30%'>
    <h4><strong>EMPLOYEE</strong></h4></th></tr>
    </thead><tbody><tr><td>$cna<br>$adde                                    
                                                                        
  <br>$mail,&nbsp;&nbsp; $web<br>$pho1, $pho2</td><td></td>
  <td class='text-right' style='vertical-align: text-top;'>$fna $lna<br>$post<br>$idno<br>$cont1, $cont2</td></tr></tbody>
    </table></div>";
	?>





<br><br>
<div class="row">
<div class="col-lg-12">
<table class="table table-striped invoice-table ">
<thead>
<tr><th width="40%">
<h4><strong>ALLOWANCE(s)</strong></h4></th>
<th width="30%"><h4><strong>DEDUCTION(s)</strong></h4></th>
<th width="30%"><h4><strong><center>TPR</strong></h4></th>
</tr>
</thead><tbody>
<tr><td style="vertical-align: text-top;">
<table class="table table-striped invoice-table ">

<tbody>
<tr>
<td style="border: 0px;"><b>Total </b></td>
<td style="border: 0px;"><b>RWF&nbsp;<?php echo $allowo ?></b></td>
 </tr>
</tbody>
</table>


</td><td style="vertical-align: text-top;">


<table class="table table-striped invoice-table ">

<tbody>
  <tr>
<td style="border: 0px;"><b>Total </b></td>
<td style="border: 0px;"><b>RWF&nbsp;<?php echo $ducto ?></b></td>
 </tr></tbody>
</table>
</td>
<td style="    vertical-align: text-top;">
<table class="table table-striped invoice-table   ">

<tbody>
  <tr>
<td style="border: 0px;"><b><center>RWF&nbsp;<?php echo $tpro ?></b></td>
<td style="border: 0px;"><b> &nbsp;&nbsp; </b></td>
 </tr>
 </tbody>
</table>

</td></tr></tbody></table>


</div>
</div>

<div class="row">
<div class="col-lg-12">
<table class="table table-striped invoice-table">
<thead>
<tr>
	<?php
			$doi=mysql_query("SELECT *FROM `rolling` WHERE `Month`='$mt' AND `Year`='$yr' AND `Employee`>'0' ORDER BY `Number` ASC");
		while($roi=mysql_fetch_assoc($doi)){
			$des=$roi['Description'];
			$vue=$roi['Employee'];
		if($vue<100){
		$vu=$vue;
		$per="($vu %)";
		}
	else{
		$vu="";
		$per="";
	}

			echo"<th width='40%'>
			<h4><strong> $des $per </strong></h4></th>";
			  }
			?>

</tr>
</thead>
<tbody>
<tr>
<?php
		$empoe=0;
				$doi=mysql_query("SELECT *FROM `rolling` WHERE `Month`='$mt' AND `Year`='$yr' AND `Employee`>'0' ORDER BY `Number` ASC");
		while($roi=mysql_fetch_assoc($doi)){
			$des=$roi['Description'];
			$vue=$roi['Employee'];
		if($vue<100){
		$vu=($vue/100*$sal);
		}
	else{
		$vu=$vue;
		}
	$vuo=number_format($vu);
		$empoe+=$vu;
			echo"<td>RWF&nbsp;&nbsp; $vuo </td>";
			  }		
			  $net=$sal-$empoe-$tpr+$allow-$duct;
		   $neto=number_format($net);
		   ?>
</tr>
</tbody>
</table>

</div>
</div>

<div class="row">
<div class="col-lg-12">
<table class="table table-striped invoice-table">
<thead>
<tr>
<th width="40%">
<h4><strong>PAYMENT MODE</strong></h4></th>
<th width="30%">
<h4><strong>DATE OF PAYMENT</strong></h4></th>
<th width="30%">
<h4><strong><center>NET PAY</strong></h4></th>
</tr>
</thead>
<tbody>
<tr>
<td>
Bank <?php echo $banko ?></td>
<td><?php echo $dati ?></td>
<td><b><center>
RWF&nbsp;&nbsp;<?php echo $neto ?></b></td>
</tr>
</tbody>
</table></div></div>
<br>
<div class="row">
<div class="col-lg-12">
<div class="widget-container fluid-height">
<div class="widget-content padded clearfix">
Notes : 
N/A</div></div></div></div>
</div></div></div></div>


<div class="row">
<div class="col-lg-12">
<a href="#" style="text-decoration:none; font-family:sans-serif;cursor:pointer;" class="btn btn-primary pull-right">
<i class="lnr lnr-arrow-left-circle">&nbsp;Ms Excell</i></a>
<span onclick="printdiv('div_print');" style=" font-family: sans-serif; cursor: pointer;" class="print btn btn-primary pull-right"><i class="lnr lnr-printer">&nbsp;Print</i></span>
 <a href="#" style="text-decoration: none; font-family: sans-serif;cursor: pointer;" class="pdf btn btn-primary pull-right"><i class="lnr lnr-inbox">&nbsp;PDF Generate</i></a>		
</div>
</div>
<script language="javascript">
function printdiv(printpage)
{
var headstr = '<html><head><title></title><style>@media print {body{padding-top:0px;}.invoice strong {font-size: 85%; color:#000000 !important;display: block;padding-bottom: 8px;margin-bottom: 10px;} }</style>'+
'</head><body>';
var footstr = "</body>";
var newstr = document.all.item(printpage).innerHTML;
var oldstr = document.body.innerHTML;
document.body.innerHTML = headstr+newstr+footstr;
window.print();
document.body.innerHTML = oldstr;
return false;
}
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
  <script src="style/jquery_004.js" type="text/javascript"></script>
 <!-- ****************************** -->
  
   <script src="style/jquery.js" type="text/javascript"></script>
  <script src="style/datatable-editable.js" type="text/javascript"></script>
  <!-- used for calendar -->
 <script src="style/jquery_002.js" type="text/javascript"></script>
 <!-- ******************************* -->
  
  <script src="style/bootstrap-fileupload.js" type="text/javascript"></script>
   <script src="Sstyle/bootstrap-datepicker.js" type="text/javascript"></script>
   <script src="style/bootstrap-timepicker.js" type="text/javascript"></script>
   <script src="style/jquery_003.js" type="text/javascript"></script>
   
    
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
