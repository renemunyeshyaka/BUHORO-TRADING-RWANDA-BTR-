<?php
if(basename($_SERVER['PHP_SELF']) == 'users.php') {
  $st=" class='current'";
} else {
  $st="";
} 
include'header.php';
include'connection.php';
$perpagevalue=20;
$cond="";
$conde='';
$condi='';
$ecode=0;

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
		}

if(isset($_POST['edit_id']))
		{
			$ecode=$_POST['rowid'];
		}

if(isset($_POST['update']))
		{
			$privilege=$_POST['privilege'];
			$ecode=$_POST['rowid'];
		if($privilege==5)
			$do=mysqli_query($conn, "UPDATE `employees` SET `Suspend`='1' WHERE `Eid`='$ecode' LIMIT 1");
		elseif($privilege==6)
			$do=mysqli_query($conn, "UPDATE `employees` SET `Suspend`='0' WHERE `Eid`='$ecode' LIMIT 1");
		elseif($privilege==1111){
			$do=mysqli_query($conn, "UPDATE `employees` SET `Password`='',`Access`='0' WHERE `Eid`='$ecode' LIMIT 1");
			$ecode=0;
		}
		else
			$do=mysqli_query($conn, "UPDATE `employees` SET `Access`='$privilege' WHERE `Eid`='$ecode' LIMIT 1");
		}


$do=mysqli_query($conn, "SELECT *FROM `employees` WHERE `Eid`!='1001' AND `Password`!='' AND `Email`!='' $conde $condi $cond ORDER BY `Access` ASC, `Fname` ASC");
$fo=mysqli_num_rows($do);
?>	  
	  
	  <div class="container-fluid main-content">
  <div class="page-title">
           <h1 style='margin-top:-20px; margin-bottom: 5px;'>
         System Users
          </h1>
                </div>
      
        <div class="row">
        <div class="col-md-2">
		<ul class="list-group">
			 			
		    <li class="list-group-item active">
           <a href="users.php">
           <p>
           <i class="lnr lnr-menu-circle"></i>&nbsp;List of Users
           </p></a>
           </li>
                          <li class="list-group-item">
           <a href="new_employee.php">
           <p>
           <i class="lnr lnr-plus-circle"></i>&nbsp;Create New User
           </p></a>
           </li>
                       </ul>
		
         
  
            </div>
         
         
         <!-- Search and show per page on top of table -->
         <div class="col-md-10">
          <div class="row">
           <div class="col-md-6 "> 
           <form action="users.php" method="POST" class="form-horizontal ">
        <input name="searchkeyword" value="" type="hidden">
        <input name="column_name" value="" type="hidden">
    
            <div class="col-md-4 "> 
           <select name="perpagevalue" class="form-control">
                              <option selected="selected" value="20">20 per page</option>
                              <option value="50">50 per page</option>
                              <option value="100">100 per page</option>
                            
               </select>
          
         </div>    
          
                    <div class="col-md-2 "> 
      
                 <button class="btn  btn-primary  btn-block" type="submit" name="perpage"><i class="lnr lnr-chevron-right-circle"></i> Show</button>
				
          </div> 
    
        </form>
        </div>
          
          
           <div class="col-md-6 ">
           

        <form action="users.php" method="post" class="form-horizontal ">
                  
                       <div class="col-md-6"> 
              <?php
			  if(!$ecode)
				print("<span>Total Records Found : <b> $fo / $perpagevalue </b></span>");
			?>
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



			<?php
			if($ecode){



$do=mysqli_query($conn, "SELECT *FROM `employees` WHERE `Eid`='$ecode' ORDER BY `Eid` ASC LIMIT 1");
while($ro=mysqli_fetch_assoc($do)){
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
$photo=$ro['Photo'];
$file1=$ro['File1'];
$file2=$ro['File2'];
$file3=$ro['File3'];
$acces=$ro['Access'];
$susp=$ro['Suspend'];
	if(!$photo)
		$photo="imgs/-text.png";
	else
		$photo="photos/$photo";
}

$de=mysqli_query($conn, "SELECT *FROM `depart` WHERE `Number`='$depart' ORDER BY `Number` ASC");
			  $re=mysqli_fetch_assoc($de);
					$depart=$re['Depart'];


					?>




					
<div class="col-md-3">
            <div class="widget-container fluid-height">
              <div class="heading">
                <h4>Profile Picture</h4>
              </div>
              <div class="widget-content padded " style="text-align:center;">
                            	<img src="<?php echo $photo ?>" width="60%"><br><br>
								Gender: <?php echo $gender ?>  <br><div style='padding-top:10px;'><b>
								 <?php echo"&nbsp; $privi" ?> </b></div>
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
 </div>
  </div>
   </div>
          <div class="col-md-4">
            <div class="widget-container fluid-height">
              <div class="heading">
                <h4>Official Details</h4>
              </div>
              <div class="widget-content padded">
             <strong>ID/Passport No:</strong>
                  <p><?php echo $idno ?>                 </p>
         <strong>RSSB Number:</strong>
                 <p><?php echo $rssb ?>                  </p>
                  <strong>Employee Code:</strong>
                 <p><?php echo $code ?></p>
                   <strong>Address:</strong>                
 <p><?php echo $address ?></p> 
              </div>
            </div>
          </div>
        </div>
<hr>
 <form action="users.php" method="post" class="form-horizontal">
<div align='right'>
   <div class="col-md-2" style='border: 0px solid black'>
            <label class="control-label"> &nbsp; </label></div>
	<div class="col-md-4"><select name="privilege" class="form-control" style="width:210px;" required>
	<?php
		$n=1;
		$got=mysqli_query($conn, "SELECT `Number`,`Access` FROM `users` ORDER BY `Access` ASC");
			while($rot=mysqli_fetch_assoc($got)){
				$acce=$rot['Access'];
				$numb=$rot['Number'];
				if($acces==$acces){
					$sel='selected';
					$n++;
				}
				else{
					$sel='';
				}
				if($susp==1 AND $acce=='SUSPEND'){
					$acco='SUSPENDED';
					$selo='selected';
				}
				else{
					$selo=$sel;
					$acco=$acce;
				}
				echo"<option $selo value='$acce'>$acco</option>";
			}
			if($n==1)
				echo"<option selected value='0'>Select Privileges</option>";
			if($susp==1)
				echo"<option value='1111' title='Completely remove this user' style='color:#0033cc;'>REMOVE USER</option>";
			?>
                             
               </select>  </div>

	<div class="col-md-3" style='text-align:left;'> 
	<?php 
		echo"<input type='hidden' name='rowid' value='$ecode'>";
	?>
		  <button class="btn btn-lg btn-block btn-success" type="submit"  name="update" style='width: 140px; height:34px; padding-top:5px;' onClick='return validatepass(form);'><i class="lnr lnr-checkmark-circle"></i> UPDATE </button> 
		</div>    <div class="row"> </div>    <div class="row"> </div>
</div></form>

<?php


			}
			else{
				?>
                
                                 <table class="table table-striped" style='margin-top:-20px;'>     
                                      <thead>
                    <tr role="row">
                     <th class="hidden-xs"> S.NO</th> 
                       <th class="hidden-xs"> Code</th>
                       <th> First&nbsp;Name </th>
                       <th> Last&nbsp;Name</th>
                       <th> Contact</th>
					   <th class="hidden-xs"> ID_Number</th>
					   <th> Access</th>
					   <th class="hidden-xs"><center> Status</th>
                        <th><center> Actions</th>
                     </tr>
                    </thead>
                                        <tbody>
                                          
				<?php
				$n=1;
				while($ro=mysqli_fetch_assoc($do)){
$code=$ro['Eid'];
$fna=$ro['Fname'];
$lna=$ro['Lname'];
$dep=$ro['Depart'];
$cont=$ro['Contact1'];
$idn=$ro['Idno'];
$pos=$ro['Currentp'];
$adde=$ro['Address'];
$acces=$ro['Access'];
$suspe=$ro['Suspend'];

if($suspe=='1'){
	$sta='SUSPENDED';
	$clo='color:red';
}
else{
	$sta='ACTIVE';
	$clo='';
}

$then=mysqli_query($conn, "SELECT `Depart` FROM `depart` WHERE `Number` = '$dep'");
$ren=mysqli_fetch_assoc($then);
$dep=$ren['Depart'];

$de=mysqli_query($conn, "SELECT *FROM `users` WHERE `Number`='$acces' ORDER BY `Number` ASC");
			  $re=mysqli_fetch_assoc($de);
					$privi=$re['Access'];

	print("<tr style='$clo'><td class='hidden-xs'> $n</td><td class='hidden-xs'> $code</td><td> $fna</td><td> $lna</td>
	<td align='center'> $cont</td><td class='hidden-xs' align='center'> $idn</td><td class='hidden-xs'> $acces</td><td class='hidden-xs'> $sta</td>	 

						<form method=post action='users.php'><td align='center' style='width:40px;padding:0px;'>
                        <input type='hidden' name='rowid' value='$code'><button style='background-color:transparent;border:0px solid black; 
						width:40px; margin:0px;' type='submit' name='edit_id'><span style=color:blue;>Edit</span></button></td></form></tr>");
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
                         
								<?php
			}
								?>
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