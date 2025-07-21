<?php
if(basename($_SERVER['PHP_SELF']) == 'alist.php') 
  $pr=" class='current'";
include'header.php';
include'connection.php';
$dato=$datos=$Date;

$cond='LIMIT 20';
$conde='';
$perpagevalue=20;

if(isset($_POST['delete_id']))
		{
			$rowid=$_POST['rowid'];
			$then=mysqli_query($conn, "UPDATE `allows` SET `Status`='1' WHERE `Number`='$rowid' LIMIT 1");
			$p=$_POST['p'];
			$im=$_POST['im'];
			$file_to_delete = "allows/$im";
			unlink($file_to_delete);
		}
if(isset($_POST['perpage']))
		{
			$perpagevalue=$_POST['perpagevalue'];
			$cond="LIMIT $perpagevalue";
			$p=$_POST['p'];
		}
if(isset($_POST['search']))
		{
			$dato=$_POST['dato'];
			$datos=$_POST['datos'];
			$conde="AND `Date` BETWEEN '$dato' AND '$datos'";
		}


	if($p)
$do=mysqli_query($conn, "SELECT *FROM `allows` WHERE `Status`='0' $conde ORDER BY `Number` ASC");
	else
$do=mysqli_query($conn, "SELECT *FROM `allows` WHERE `Status`='0' ORDER BY `Date` DESC $cond");
$fo=mysqli_num_rows($do);
?>
<div class="container-fluid main-content">
        <div class="page-title">
          <h1 style='margin-top:-20px; margin-bottom: 5px;'>
         Allowance
          </h1>
                 </div>
     
        <div class="row">
  <div class="col-lg-2">
   
   <ul class="list-group">
      
    <li class="list-group-item active">
	  <a href="alist.php">
                <p>
                <i class="lnr lnr-menu-circle"></i>&nbsp;Allowance List
                </p>
              </a></li>  

	   <li class="list-group-item">
              <a href="allows.php">
                <p>
                <i class="lnr lnr-plus-circle"></i>&nbsp;Create New Record
                </p>
              </a></li> 
                         
            </ul>
  </div>
                    
           
           
       
        <div class="col-lg-10">
                  <div class="row">
           <div class="col-lg-6 "> 
           <form action="" method="POST" class="form-horizontal ">
        <input name="searchkeyword" value="" type="hidden">
        <input name="column_name" value="" type="hidden">
    
            <div class="col-lg-4 "> 
			<?php echo"<input value='$p' name='p' type='hidden'>"; ?>
           <select name="perpagevalue" class="form-control">
                              <option selected="selected" value="20">20 per page</option>
                              <option value="50">50 per page</option>
                              <option value="100">100 per page</option>
                              <option value="200">200 per page</option>
                              <option value="1000">1000 per page</option>
                            
               </select>
          
         </div>    
          
                    <div class="col-lg-2 "> 
      
                 <button class="btn  btn-primary  btn-block" type="submit" name="perpage"><i class="lnr lnr-chevron-right-circle"></i> Show</button>
          </div> 
    
        </form>
           
           
              </div>
          
          
         
           

        <form action="" method="post" class="form-horizontal ">
                  
                       <div class="col-lg-6"> <table border='0'><tr><th>
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
          
		  </th><th>
                      
                       
                       <div class="col-lg-6 input-group">
                      <span class="input-group-btn">
                        <button class="btn  btn-primary" type="submit" name="search"><i class="lnr lnr-magnifier"></i> Search</button>
                      </span>
					  </div>
                       </th></tr></table>  </div> 
                      
                     
                  
            </form> 
             
               
            </div>
             <div class="row">
            <div class="col-lg-12">
             <span>Total Records Found : <b><?php echo" $fo " ?></b></span>
            <div class="widget-container fluid-height clearfix">
            <div class="widget-content padded clearfix">
               
                                 <table class="table table-striped">     
                                      <thead>
                    <tr role="row">
                     <th class="hidden-xs"> No </th>
                        <th> Due&nbsp;Date </th>
                       <th> Employee`s&nbsp;Name</th> 
                        <th class="hidden-xs"> Purpose/Issue </th>
						 <th> Total&nbsp;Amount </th>
                        <th class='hidden-print' colspan='2' style="width: 40px;text-align:center;">Actions</th>
                     </tr>
                    </thead>
                                        <tbody>
					<?php
					$n=1;           $tot=0;
						while($ro=mysqli_fetch_assoc($do)){
$code=$ro['Number'];
$emplo=$ro['Employee'];
$amo=$ro['Amount'];
	$amoo=number_format($amo);
$purpo=$ro['Purpose'];
$dte=$ro['Date'];
$im=$ro['File1'];

$doi=mysqli_query($conn, "SELECT *FROM `employees` WHERE `Eid`='$emplo'");
			$roi=mysqli_fetch_assoc($doi);
				$fna=$roi['Fname'];
				$lna=$roi['Lname'];
/*
if($file1)
	$dfile="<a href='down_contra.php?link=$file1'>Download&nbsp;File</a>";
else
	$dfile="";
*/
$stn="style='padding:1px;'";

echo"<div class='modal fade' id='exampleModal$n' tabindex='-1' role='dialog' aria-labelledby='exampleModalLabel' aria-hidden='true' 
		style='top:220px;'>
  <div class='modal-dialog' role='document'>
    <div class='modal-content'>
      <div class='modal-header'>
        <h5 class='modal-title' id='exampleModalLabel'>DELETE CONFIRMATION 
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b> $amoo </b></h5>

      </div>
      <div class='modal-body' style='height:40px;'>
        <h5 style='color:#ff0033'>Are you sure you want to delete this record?</h5>
      </div><form method='post' action=''><input type='hidden' name='rowid' value='$code'>
	  <input value='$p' name='p' type='hidden'><input value='$im' name='im' type='hidden'>
      <div class='modal-footer' style='margin-top:-10px; height:50px; padding-top:5px; border:0px solid blue;'>
        <button type='button' class='btn btn-sm btn-success' data-dismiss='modal'>&nbsp;NO&nbsp;</button>
        <button type='submit' name='delete_id' class='btn btn-sm btn-danger' $disa>YES</button>
      </div></form>
    </div>
  </div>
</div>";
           
		print("<tr><td $stn class='text-center hidden-xs'>$n</td>
                        <td $stn class=hidden-xs> $dte </td>
                        <td $stn class=hidden-xs> $fna $lna </td><td $stn> $purpo </td>
						<td class='text-right' style='padding:0px 40px 0px 0px;'> $amoo </td>

                     <form method=post action='allows.php'>
                     <td class='hidden-print' align='right' style='width:20px; padding:0px;'>
                        <input type='hidden' name='rowid' value='$code'>
                           <button type='submit' class='btn btn-xs btn-warning hidden-print text-center' name='edit_id' style='height:20px; padding:0px; margin-top:2px; margin-botton:2px; width:25px; text-align:center; padding-right:5px;' title='Edit' data-toggle='tooltip' data-placement='top'>
						  &nbsp;&nbsp;<i class='lnr lnr-pencil'></i></td></form>
						   
						   <td class='hidden-print' align='right' style='width:20px; padding:0px;'>
						  <button type='button' class='btn btn-xs btn-danger hidden-print' style='height:20px; padding:0px; margin-top:2px; margin-botton:2px; width:25px;' data-placement='top' data-toggle='modal' data-target='#exampleModal$n' $disa>
						  <i class='lnr lnr-trash'></i></button></td></form></tr>");
						  $n++;        $tot+=$amo;
						}
						$tot=number_format($tot);
				
					print("<tr><th class='hidden-xs'> </th> 
	<th colspan='3' style='align:center; padding-left:80px;'> TOTAL AMOUNT </th>
	<th class='text-right' style='padding:0px 40px 0px 0px;'> $tot </th><th colspan='2' class='text-right hidden-print' $stn>  </th></tr>");
						?>
						
                    </tbody>   
                  </table>
                    <div class="row">
                  <div class="col-lg-12">
                  <div class="pull-right">
                  <ul class="pagination">
				   <li>
                                 <a class="icon" href="#">
           <i class="lnr lnr-chevron-left"></i></a>
                                            </li>
                      <li>
                                            </li>
                      <li class="active">
                        <a href="#">
                        1                        </a>
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
      
  <?php
  include'footer.php';
  ?>