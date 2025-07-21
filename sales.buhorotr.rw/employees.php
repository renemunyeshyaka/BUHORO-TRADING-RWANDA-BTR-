<?php
if(basename($_SERVER['PHP_SELF']) == 'employees.php') {
  $cu=" class='current'";
} else {
  $cu="";
} 
include'header.php';
include'connection.php';
$perpagevalue=20;
$cond="LIMIT $perpagevalue";
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
			$conde="AND (`Fname` LIKE '%$searchkeyword%' OR `Lname` LIKE '%$searchkeyword%' OR `Idno` LIKE '%$searchkeyword%' OR `Contact1` LIKE '%$searchkeyword%' OR `Contact2` LIKE '%$searchkeyword%')";
		else
			$conde='';
		}
if(isset($_POST['submitfilter']))
		{
			$department=$_POST['department'];
$_SESSION['Depa']=$department;
}
$department=$_SESSION['Depa'];

		if($department)
			$condi="AND `Depart`='$department'";

if(isset($_POST['delete_id']))
		{
			$rowid=$_POST['rowid'];
			$then=mysql_query("UPDATE `employees` SET `Status`='1001' WHERE `Eid`='$rowid' LIMIT 1");
		}

$do=mysql_query("SELECT *FROM `employees` WHERE `Eid`!='1001' AND `Status`='0' $conde $condi $cond");
$fo=mysql_num_rows($do);
?>	  
	  
	  <div class="container-fluid main-content">
  <div class="page-title">
          <h1 style='margin-top:-20px; margin-bottom: 5px;'>
           Employees
          </h1>
                </div>
      
        <div class="row">
        <div class="col-md-2">
		<ul class="list-group">
			 		  <li class="list-group-item active">
           <a href="employees.php">
           <p>
           <i class="lnr lnr-menu-circle"></i>&nbsp;Users` List
           </p></a>
           </li>
           
		  
                          <li class="list-group-item">
           <a href="new_employee.php">
           <p>
           <i class="lnr lnr-plus-circle"></i>&nbsp;Create New
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
                      <option selected="selected" value="" selected>Show All</option>
                    
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
					   <th><center> Position </th>
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

if($_SESSION['Settings']=='1'){
	$form="<form method=post action='new_employee.php'>";
	$forms="</form>";
}
else
	$form=$forms="";

	print("<tr><td class='text-right hidden-xs'> $n &nbsp;&nbsp;</td><td class='text-right hidden-xs'> $code &nbsp;&nbsp;</td>
	<td> $fna</td><td> $lna</td><td class='hidden-xs'> $dep</td><td align='right'> $cont</td><td class='hidden-xs' align='right'> $idn</td>
	<td class='hidden-xs'> $pos</td><td  align='right' style='width:40px;padding:0px;'><div class='action-buttons'>
                                                <a class='table-actions' href='vemployee.php?id=$code'>View</a></td>

						$form <td align='right' style='width:40px;padding:0px;'>
                        <input type='hidden' name='rowid' value='$code'>
                           <button style='background-color:transparent;border:0px solid black; width:40px; margin:0px;' type='submit' name='edit_id'>
						   <span style=color:blue;>Edit</span></button></td> $forms
                                                </div></td></tr>");
												$n++;
				}
				?>
                    </tbody>   
                  </table>
                                      <div class="row">
                 </div>
                                
              </div>
            </div>
        </div>
       </div>
       </div>
       </div> </div> <?php
	   include'footer.php';
	   ?>