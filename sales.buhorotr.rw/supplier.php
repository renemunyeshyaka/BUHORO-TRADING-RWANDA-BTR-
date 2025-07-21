<?php
if(basename($_SERVER['PHP_SELF']) == 'supplier.php') 
  $co=" class='current'";
include'header.php';
include'connection.php';
$custo='';
$conde='';

if(isset($_POST['delo']))
		{
			$rowid=$_POST['rowid'];
	$do=mysql_query("UPDATE `suppliers` SET `Status`='1' WHERE `Status`='0' AND `Number`='$rowid' ORDER BY `Number` DESC LIMIT 1");
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

$do=mysql_query("SELECT *FROM `suppliers` WHERE `Status`='0' $conde ORDER BY `Number` DESC LIMIT $lim");
$fo=mysql_num_rows($do);
?>
<div class="container-fluid main-content">
        <div class="page-title">
          <h2 style='margin-top:-20px; margin-bottom: 5px;'>
        Suppliers' List
          </h2>
                 </div>
     
        <div class="row">
  <div class="col-lg-2 hidden-print">
   
   <ul class="list-group">
    
    <li class="list-group-item active">
	  <a href="supplier.php">
                <p>
                <i class="lnr lnr-menu-circle"></i>&nbsp;Suppliers' List
                </p>
              </a></li>  

	   <li class="list-group-item">
              <a href="createsu.php">
                <p>
                <i class="lnr lnr-plus-circle"></i>&nbsp;Create New Supplier
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
                    <tr role="row"> <th> S.NO</th>
                        <th> Date </th>
                     <th> Name </th>
                        <th> Address </th>
                        <th> Telephone </th><th><div align='right'> &nbsp;Balance&nbsp;&nbsp;&nbsp;</th>
						<th class="hidden-xs hidden-print" style="width:40px; text-align:center;" colspan='2'> Options </th></tr>
                    </thead>
                                        <tbody>
		<?php
					$n=1;			$tot=0;	
		while($ro=mysql_fetch_assoc($do)){
$code=$ro['Number'];
$name=$ro['Supplier'];
$dte=$ro['Date'];
$addre=$ro['Address'];
$tele=$ro['Telephone'];
$bal=$ro['Balance'];
$balo=number_format($bal);
$stl="style='padding:0px;'";

print("<tr><td $stl><div align='center'>$n&nbsp;&nbsp;</td><td $stl><div align='center'> $dte </td>
	<td $stl>$name</td><td $stl> $addre </td><td $stl> $tele </td><td $stl><div align='right'>&nbsp;<strike>$balo</strike>&nbsp;&nbsp;</td>
					   
					<form method=post action='createsu.php'>   
					   <td class='hidden-xs hidden-print' align='right' style='width:40px; padding:0px;'>
                              <input type='hidden' name='rowid' value='$code'>
                          <button type='submit' class='btn btn-xs btn-warning hidden-print' name='open' style='height:18px; padding:0px;'>
						  &nbsp;&nbsp;<i class='lnr lnr-pencil'></i>&nbsp;&nbsp;</button></td></form>
						  
						  <form method=post action=''><td class='hidden-xs hidden-print' align='right' style='width:40px; padding:0px;'>
                              <input type='hidden' name='rowid' value='$code'>
                          <button type='submit' class='btn btn-xs btn-danger hidden-print' name='delo' style='height:18px; padding:0px;'>
						  &nbsp;&nbsp;<i class='lnr lnr-trash'></i>&nbsp;&nbsp;</button></td></form></tr>");
			$n++;				$tot+=$bal;
	}
	$toto=number_format($tot);
		print("<tr><th colspan='5' style='padding-left:40px;'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Total Amount </th>
		<th colspan='1'><div align='right'>&nbsp;<strike>$toto</strike></th><th colspan='2'><div align='center'> -- </th></tr>");
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