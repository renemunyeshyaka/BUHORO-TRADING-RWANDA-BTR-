<?php
if(basename($_SERVER['PHP_SELF']) == 'supplier.php') 
  $nv=" class='current'";
include'header.php';
include'connection.php';
$custo='';
$conde='';

if(isset($_POST['delo']))
		{
			$rowid=$_POST['rowid'];
	$do=mysqli_query($conn, "UPDATE `suppliers` SET `Status`='1' WHERE `Status`!='1' AND `Number`='$rowid' ORDER BY `Number` DESC LIMIT 1");
		}

if(isset($_POST['search']))
		{
			$custo=$_POST['custo'];
		}

		
		if($custo){
			$conde="AND (`Supplier` LIKE '%$custo%' OR `Telephone` LIKE '%$custo%' OR `Address` LIKE '%$custo%')";
			$lim=999999999;
		}
		else{
			$conde='';
			$lim=140;
		}

$do=mysqli_query($conn, "SELECT *FROM `suppliers` WHERE `Status`!='1' $conde ORDER BY `Number` DESC LIMIT $lim");
$fo=mysqli_num_rows($do);
?>
<div class="container-fluid main-content">
        <div class="page-title">
          <h2 style='margin-top:-20px; margin-bottom: 5px; color:#ffcc33'>
        Materials
          </h2>
                 </div>
     
        <div class="row">
  <div class="col-lg-2 hidden-print">
   
   <ul class="list-group">
    
    <li class="list-group-item active">
	  <a href="supplier.php">
                <p>
                <i class="lnr lnr-menu-circle"></i>&nbsp;List of Suppliers
                </p>
              </a></li>  

	   <li class="list-group-item">
              <a href="createsu.php">
                <p>
                <i class="lnr lnr-plus-circle"></i>&nbsp;Create New Supplier
                </p>
              </a></li> 

	   <li class="list-group-item">
              <a href="purcha.php">
                <p>
                <i class="lnr lnr-plus-circle"></i>&nbsp;Purchase Orders
                </p>
              </a></li>     

	   <li class="list-group-item">
              <a href="receive.php">
                <p>
                <i class="lnr lnr-plus-circle"></i>&nbsp;Receive Items
                </p>
              </a></li>  
                
            </ul>
  </div>
                    
           
           
       
        <div class="col-lg-10">
                  <div class="row">
         
           <div class="col-lg-4"> </div>
          
         
           

        <form action="" method="post" class="form-horizontal ">                  
                       <div class="col-lg-8 no-print"><div class="col-lg-3"> 					
					   
					   </div>
            <div class="col-lg-6"> 
      <input class="form-control"  name="custo" type="text" value="<?php echo $dato ?>" required>
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
            <div class="widget-container fluid-height clearfix">
            <div class="widget-content padded clearfix">

			<table class="table table-striped">     
                                      <thead>
                    <tr role="row"> <th> No </th>
                        <th width="8%">&nbsp;&nbsp;&nbsp;&nbsp;Date </th>
                     <th> Name </th><th> Address </th><th> Telephone </th>
                        <th><div align='center'> &nbsp;Email </th>
						<th class="hidden-xs hidden-print" style="width:40px; text-align:center;" colspan='2'> Options </th></tr>
                    </thead>
                                        <tbody>
		<?php
					$n=1;			$tot=0;	
		while($ro=mysqli_fetch_assoc($do)){
$code=$ro['Number'];
$name=$ro['Supplier'];
$dte=$ro['Date'];
$addre=$ro['Address'];
$tele=$ro['Telephone'];
$email=$ro['Email'];
$stl="style='padding:0px;'";


	$set=mysqli_query($conn, "UPDATE `stouse` SET `Customer`='$code' WHERE `Destin`='$name' AND `Action`='RECEIVE' AND `Status`='0'");

print("<tr><td $stl><div align='center'>$n&nbsp;&nbsp;</td>
<td $stl><div align='center'> $dte </td><td $stl>$name</td>
<td $stl> $addre </td><td $stl> $tele </td><td $stl> $email </td>
					   
					<form method=post action='createsu.php'>   
					   <td class='hidden-xs hidden-print' align='right' style='width:40px; padding:0px;'>
                              <input type='hidden' name='rowid' value='$code'>
                          <button type='submit' class='btn btn-xs btn-warning hidden-print' name='open' style='height:18px; padding:0px;'>
						  &nbsp;&nbsp;<i class='lnr lnr-pencil'></i>&nbsp;&nbsp;</button></td></form>
						  
						  <form method=post action=''><td class='hidden-xs hidden-print' align='right' style='width:40px; padding:0px;'>
                              <input type='hidden' name='rowid' value='$code'>
                          <button type='submit' class='btn btn-xs btn-danger hidden-print' name='delo' style='height:18px; padding:0px;'>
						  &nbsp;&nbsp;<i class='lnr lnr-trash'></i>&nbsp;&nbsp;</button></td></form></tr>");
			$n++;				
	}
				?>
                  </table><hr>
                    <div class="row">
                  <div class="col-lg-12">
                  <div class="pull-right">
                 <button class="btn btn-primary btn-success hidden-print" onclick="return window.print()"><i class="lnr lnr-printer"></i> Print</button>
              </div></div></div>                     
                
              </div>
            </div></div>
                  </div>
      
   </div></div></div>
   <?php
   include'footer.php';
   ?>