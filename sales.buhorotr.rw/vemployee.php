<?php
if(basename($_SERVER['PHP_SELF']) == 'vemployee.php') {
  $cu=" class='current'";
} else {
  $cu="";
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
$contact1=$ro['Contact1'];
$contact2=$ro['Contact2'];
$idno=$ro['Idno'];
$currentp=$ro['Currentp'];
$gender=$ro['Gender'];
$email=$ro['Email'];
$password=$ro['Password'];
$confirm_password=$ro['Password'];
$salary=number_format($ro['Salary']);
$qualify=$ro['Branche'];
$start=$ro['Starting'];
$status=$ro['Status'];
$photo=$ro['Photo'];
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

$de=mysql_query("SELECT *FROM `depart` WHERE `Number`='$depart' ORDER BY `Number` ASC");
			  $re=mysql_fetch_assoc($de);
					$depart=$re['Depart'];

$po=mysql_query("SELECT *FROM `position` WHERE `Postid`='$currentp' ORDER BY `Postname` ASC");
			  $ro=mysql_fetch_assoc($po);
					$position=$ro['Postname'];
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
	if($_SESSION['Settings']=='1'){
	?>
	<table><tr><td align='right'> <?php echo $btn ?></td>
</form> <form method='post' action='new_employee.php'>
	<td align='right'> <?php
	echo"<input type='hidden' name='rowid' value='$code'>";
	?>
	<button class="btn btn-primary btn-block" name='edit_id' style='width:100px;'>Edit</button>	
	</td></tr></table></form>
	<?php
	}
	?>
 </div></div>
</div></div>
  <div class="row">
        <div class="col-md-2">
		 <?php
					  if($_SESSION['Emploaccess']=='1'){
                   echo"<ul class='list-group'>
			 			  <li class='list-group-item active'>
           <a href='employees.php'>
           <p>
           <i class='lnr lnr-menu-circle'></i>&nbsp;List
           </p></a>
           </li>
           
		 <li class='list-group-item'>
           <a href='new_employee.php'>
           <p>
           <i class='lnr lnr-plus-circle'></i>&nbsp;Create
           </p></a>
           </li>
		     </ul>";
		   $bty="submit";
	}
					   else{
					    echo"<ul class='list-group'>
			 			  <li class='list-group-item active'>
           <a href='#'>
           <p>
           <i class='lnr lnr-menu-circle'></i>&nbsp;List
           </p></a>
           </li>
           
	<li class='list-group-item'>
           <a href='#'>
           <p>
           <i class='lnr lnr-plus-circle'></i>&nbsp;Create
           </p></a>
           </li></ul>";
		   $bty="button";
					   }
		   ?>
		
         
  
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
                      <option selected="selected" value="" selected>Show All</option>
                      
                      </select><br>
                      <button class="btn btn-block btn-primary" type="<?php echo $bty ?>" name="submitfilter">
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
								Gender: <?php echo $gender ?>  <hr>
								 <b><?php echo $position ?></b>
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
   <p><?php echo"&nbsp;$fname $lname"; ?></p>
    <strong>Username:</strong>
     <p><?php echo"&nbsp;$email"; ?></p>
     <strong>Contact 1:</strong>
    <p><?php echo"&nbsp;$contact1"; ?></p>
  <strong>Contact 2:</strong>                  
 <p><?php echo"&nbsp;$contact2"; ?></p>
             
 </div>
  </div>
   </div>
   <?php
        if(!$qualify)
            $qualify="&nbsp;&nbsp;&nbsp;&nbsp; <font color='#c9c9c9'>NO LIMIT</font>";
            ?>
    
          <div class="col-md-4">
            <div class="widget-container fluid-height">
              <div class="heading">
                <h4>Other Details</h4>
              </div>
              <div class="widget-content padded">
              <strong>ID No:</strong>
                 <p>&nbsp;<?php echo $idno ?></p>
                  <strong>Salary:</strong>
                 <p>RWF&nbsp;<?php echo $salary ?>
                 </p>				 
                  <strong>Calculation:</strong>
                 <p>&nbsp;<?php echo $depart ?>
                 </p>				 				 
                  <strong>Branch Limit:</strong>
                 <p>&nbsp;<?php echo $qualify ?>
                 </p>
              </div>
            </div>
          </div>
        </div>

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
   <?php
   include'footer.php';
   ?>