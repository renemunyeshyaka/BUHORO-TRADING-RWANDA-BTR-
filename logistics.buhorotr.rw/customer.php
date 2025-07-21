<?php
if(basename($_SERVER['PHP_SELF']) == 'customer.php') 
  $nv=" class='current'";
include'header.php';
include'connection.php';
$custo='';
$conde=$condi='';

if(isset($_POST['delo']))
		{
			$rowid=$_POST['rowid'];
	$do=mysqli_query($conn, "UPDATE `account` SET `Status`='1' WHERE `Status`='0' AND `Number`='$rowid' ORDER BY `Number` DESC LIMIT 1");
		}

if(isset($_POST['search']))
		{
			$custo=$_POST['custo'];
		}

		
		if($custo){
			$conde="AND (`Customer` LIKE '%$custo%' OR `Telephone` LIKE '%$custo%' OR `Tag` LIKE '%$custo%')";
			$lim=9999;
			$condi='';
		}
		else{
			$condi="";
			$conde='';
			$lim=40;
		}

		if($custo=='*' OR $custo=='all' OR $custo=='All' OR $custo=='ALL'){
			$condi="";
			$conde='';
			$lim=9999;
		}

$doj=mysqli_query($conn, "SELECT *FROM `account` WHERE `Status`='0' $conde ORDER BY `Customer` ASC LIMIT $lim");
$fo=mysqli_num_rows($doj);
?>
<div class="container-fluid main-content">
        <div class="page-title hidden-print">
          <h2 style='margin-top:-20px; margin-bottom: 5px; color:#ffcc33'>
         Customers
          </h2>
  
    </div>
   <div class="row">
  <div class="col-lg-2 hidden-print">
   
  <ul class="list-group"> <li class="list-group-item">
              <a href="ment.php">
                <p>
                <i class="lnr lnr-plus-circle"></i>&nbsp;Repair & Services
                </p>
              </a></li>

    <li class="list-group-item">
	  <a href="mainsto.php">
                <p>
                <i class="lnr lnr-menu-circle"></i>&nbsp;List of Vehicles
                </p>
              </a></li> 

	   <li class="list-group-item">
              <a href="crete.php">
                <p>
                <i class="lnr lnr-plus-circle"></i>&nbsp;Create a Vehicle
                </p>
              </a></li>    

	   <li class="list-group-item">
              <a href="tools.php">
                <p>
                <i class="lnr lnr-book"></i>&nbsp;Tools & Materials
                </p>
              </a></li>  

	   <li class="list-group-item">
              <a href="notes.php">
                <p>
                <i class="lnr lnr-plus-circle"></i>&nbsp;Notifications
                </p>
              </a></li> 
              </ul><br><br>
              
              <ul class="list-group">
    
    <li class="list-group-item active" style="border:1px dashed #cccccc; border-radius:5px; margin:0px 0px 4px 0px;">
	  <a href="customer.php">
                <p>
                <i class="lnr lnr-menu-circle"></i>&nbsp;Customers' List
                </p>
              </a></li>  

	   <li class="list-group-item" style="border:1px dashed #cccccc; border-radius:5px; margin:0px 0px 4px 0px;">
              <a href="createa.php">
                <p>
                <i class="lnr lnr-plus-circle"></i>&nbsp;Create Customer
                </p>
              </a></li> 
              
            <li class="list-group-item" style="border:1px dashed #cccccc; border-radius:5px; margin:0px 0px 4px 0px;">
	  <a href="dispatch.php">
                <p>
                <i class="lnr lnr-plus-circle"></i>&nbsp;Create Vehicle Trip
                </p>
              </a></li>		
                
                <?php
              if($_SESSION['Cpo']){
                  ?>
			  <li class="list-group-item" style="border:1px dashed #cccccc; border-radius:5px; margin:0px 0px 4px 0px;">
              <a href="purcha.php">
                <p>
                <i class="lnr lnr-plus-circle"></i>&nbsp;Purchase Orders
                </p>
              </a></li>
              <?php
              }
              if($_SESSION['Cpi']){
                  ?>
            <li class="list-group-item" style="border:1px dashed #cccccc; border-radius:5px; margin:0px 0px 4px 0px;">
	  <a href="profo.php">
                <p>
                <i class="lnr lnr-plus-circle"></i>&nbsp;Create Proforma
                </p>
              </a></li>	
              <?php
              }
              ?>
                
            </ul><br><br><center>
            <font size='3' color='teal'>Search <b>*</b> or '<b>all</b>' to display all cusstomers</font></center>
  </div>
                    
           
           
       
        <div class="col-lg-10">
                  <div class="row hidden-print">
         
           <div class="col-lg-4"> </div>
          
         
           

        <form action="" method="post" class="form-horizontal ">                  
                       <div class="col-lg-8 no-print"><div class="col-lg-3"> 					
					   
					   </div>
            <div class="col-lg-6"> 
      <input class="form-control"  name="custo" type="text" value="<?php echo $custo ?>" id="searchs" required>
			</div>                      
                       
                       <div class="col-lg-2">
                        <button class="btn  btn-primary btn-block" type="submit" name="search"><i class="lnr lnr-magnifier"></i> Search</button>
                   
					  </div>
                         </div> 
                      
                     
                  
            </form> 
             
               
            </div>
             <div class="row">
            <div class="col-lg-12" style='margin-top:-20px;'>
             <span>Total Records Found : <b><?php echo" $fo " ?></b></span>
			  <span class="pull-right"><a href="#" onclick="return window.print()" class="hidden-print" title='Print' data-toggle='tooltip' data-placement='top'><i class="lnr lnr-printer"></i></a>&nbsp;&nbsp;&nbsp;</span>
            <div class="widget-container fluid-height clearfix">
            <div class="widget-content padded clearfix">

			<table class="table table-striped table-hover table-sm style="font-size:8px;">     
                                      <thead>
                    <tr role="row"> <th>&nbsp;&nbsp;No&nbsp;&nbsp;</th>
                        <th> Customer&nbsp;Name </th><th> Address </th>
                <th><div align='right'>&nbsp;&nbsp;Telephone&nbsp;&nbsp;</th>
						<th><div align='left'>&nbsp;&nbsp;Email&nbsp;&nbsp;</th><th><div align='center'> Tin </th><th> Trip </th>
						<th class="hidden-xs hidden-print" style="width:40px; text-align:center;" colspan='2'> Options </th></tr>
                    </thead><tbody>
		<?php
					$n=1;			
		while($ro=mysqli_fetch_assoc($doj)){
$code=$ro['Number'];
$name=$ro['Customer'];
$dte=$ro['Date'];
$addre=$ro['Address'];
$tele=$ro['Telephone'];
$tin=$ro['Tin'];
$tag=$ro['Tag'];
$email=$ro['Email'];

$setri=mysqli_query($conn, "SELECT `Number` FROM `income` WHERE `Status`='0' AND `Customer`='$code'");
    $file=mysqli_num_rows($setri);

$stl="style='padding:1px;'";

print("<tr><td $stl><div align='center'>$n&nbsp;</td>
	<td $stl>$name</td><td $stl> $addre </td>
	<td $stl><div align='right'>&nbsp;$tele&nbsp;</td>
	<td $stl><div align='left'>&nbsp;$email&nbsp;</td>
	<td $stl><div align='right'>&nbsp;$tin&nbsp;</td>
	<td $stl><div align='right'>&nbsp;$file&nbsp;&nbsp;");


	echo"<div class='modal fade' id='exampleModal$n' tabindex='-1' role='dialog' aria-labelledby='exampleModalLabel' 
	aria-hidden='true' style='top:220px;'><div class='modal-dialog' role='document'>
		<div class='modal-content'><div class='modal-header text-left'>
        <h5 class='modal-title' id='exampleModalLabel'>DELETE CONFIRMATION <span class='pull-right'> $name </span></h5>

      </div><form action='' method='post'>
      <div class='modal-body text-left' style='height:40px;'>
        <h5 style='color:#ff0033'>Are you sure you want to delete this account ?</h5>
      </div><input type='hidden' name='rowid' value='$code'>
      <div class='modal-footer' style='margin-top:-10px; height:50px; padding-top:5px; border:0px solid blue;'>
        <button type='button' class='btn btn-sm btn-success' data-dismiss='modal'>&nbsp;NO&nbsp;</button>
        <button type='submit' name='delo' class='btn btn-sm btn-danger'>YES</button>
      </div></form>
    </div>
  </div>
</div>";
					   
					print("</td><form method=post action='createa.php'>   
		<td class='hidden-xs hidden-print' align='right' style='width:20px; padding:0px;'><input type='hidden' name='rowid' value='$code'>
                          <button type='submit' class='btn btn-xs btn-warning hidden-print' name='open' style='height:18px; padding:0px; margin:3px;'>
						  &nbsp;&nbsp;<i class='lnr lnr-pencil'></i>&nbsp;&nbsp;</button></td></form>
						  
						  <form method=post action=''><td class='hidden-xs hidden-print' align='right' style='width:20px; padding:0px;'>
                          <button type='button' class='btn btn-xs btn-danger hidden-print' style='height:18px; padding:0px; margin:3px;' data-placement='top' data-toggle='modal' data-target='#exampleModal$n'>
						  &nbsp;&nbsp;<i class='lnr lnr-trash'></i>&nbsp;&nbsp;</button></td></form></tr>");
			$n++;		
	}

				?></tbody>
                  </table>
                    <div class="row">
                    </div></div></div> </div>                   
               <div class="col-lg-12 hidden-print"> <span class="pull-right hidden-print"><a href="#" onclick="return window.print()" class="hidden-print" title='Print' data-toggle='tooltip' data-placement='top'><i class="lnr lnr-printer"></i></a>&nbsp;&nbsp;&nbsp;</span></div> 
              
            </div>
                  </div>
      
   </div></div></div>
   <?php
   include'footer.php';
   ?>