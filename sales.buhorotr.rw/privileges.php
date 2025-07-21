<?php
if(basename($_SERVER['PHP_SELF']) == 'privileges.php') {
  $cu=" class='current'";
} else {
  $cu="";
} 
include'header.php';
include'connection.php';

if(isset($_POST['save']))
		{
			$n=$_POST['n'];
			while($n>0){
			$codi=$_POST["code$n"];
			$vtype=$_POST["vtype$n"];
			$prive=$_POST["prive$n"];
	$then=mysql_query("UPDATE `previleges` SET `$vtype`='$prive' WHERE `NUMBER`='$codi' LIMIT 1");
		$n--;
			}
		}



$po=mysql_query("SELECT *FROM `position` WHERE `Postid`='$currentp' ORDER BY `Postname` ASC");
			  $ro=mysql_fetch_assoc($po);
					$position=$ro['Postname'];
?>
<div class="container-fluid main-content">
<div class="page-title">
<div class="row">
<div class="col-md-6">
<h1 style='margin-top:-20px; margin-bottom: 5px;'>Privileges</h1>
</div>
<div class="col-md-6">
 <div class="col-md-5 pull-right" style='text-align:right;'>
 
 </div></div>
</div></div>
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
                      <option selected="selected" value="">Show All</option>
              
                      </select><br>
                      <button class="btn btn-block btn-primary" type="button" name="submitfilter">
                      <i class="lnr lnr-checkmark-circle"></i> Submit</button>
                      </form></div></div>   </div>
                </div>
              </div>
            </div>        
         </div>


<?php
$do=mysql_query("SELECT *FROM `previleges` ORDER BY `NUMBER` ASC");
$fo=mysql_num_rows($do);
?>

		 <div class="col-md-10">  
<div class="col-md-12">
 <div class="widget-container fluid-height">
 
             <span>Total Records Found : <b><?php echo" $fo " ?></b></span>
            <div class="widget-container fluid-height clearfix">
            <div class="widget-content padded clearfix">
               <form action="" method="post">
        <table width="90%" class="table table-striped table-hover">  
            <thead><tr role="row"><th class="hidden-xs"> S.NO</th>
                <th> Privilege </th>
						<?php
						$n=1;	
	$doil=mysql_query("SELECT *FROM `position` WHERE `Access`='1' ORDER BY `Postid` ASC");
			while($roil=mysql_fetch_assoc($doil)){
				$clna=$roil['Postname'];
			echo"<th><div align='center'> $clna </div></th>";
			}
			?>    
                      
                     </tr>
                    </thead>
                                        <tbody>
					<?php
						$tot=0;		$p=1;
		while($ro=mysql_fetch_assoc($do)){
$code=$ro['NUMBER'];
$servo=$ro['PNAME'];
$stl="style='padding:0px;'";

			print("<tr><td class=hidden-xs $stl><div align='center'>$p&nbsp;&nbsp;</td><td $stl> $servo </td>");
		
	$doit=mysql_query("SELECT *FROM `position` WHERE `Access`='1' ORDER BY `Postid` ASC");
			while($roit=mysql_fetch_assoc($doit)){
				$clna=$roit['Postname'];	
	
	$doi=mysql_query("SELECT *FROM `previleges` WHERE `NUMBER`='$code'");
			$roi=mysql_fetch_assoc($doi);
				$pri=$roi["$clna"];
				if($pri=='1')
					$chk="checked";
				else
					$chk="";
		print("<td $stl><div align='center'><input type='hidden' value='$code' name='code$n'><input type='hidden' value='$clna' name='vtype$n'>
		<input class='form-control' name='prive$n' type='checkbox' value='1' $chk style='margin:0px;'></div></td>");
						  $n++;
			}
			$p++;
			echo"</tr>";
						}
						$toto=number_format($tot);
						?>
						
                    </tbody>
                  </table><hr>
					<?php
				if($_SESSION['Settings']=='1'){
					?>
					<div class="form-group">
					<div class="col-lg-12">
                  <div class="pull-right" style='width:320px; border:0px solid blue'><?php echo"<input type='hidden' name='n' value='$n'>"; ?>
                 <button class="btn btn-primary btn-success hidden-print" name='save' type='submit' style='width:320px;'>
				 <i class="lnr lnr-chevron-up-circle"></i>&nbsp;&nbsp;UPDATE</button>
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
   <?php
	   include'footer.php';
	   ?>