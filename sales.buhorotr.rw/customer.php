<?php
if(basename($_SERVER['PHP_SELF']) == 'customer.php') 
  $bb=" class='current'";
include'header.php';
include'connection.php';
$custo='';
$conde='';
 $brc=$_SESSION['BR'];	

if(isset($_POST['delo']))
		{
			$rowid=$_POST['rowid'];
	$do=mysql_query("UPDATE `account` SET `Status`='1' WHERE `Status`='0' AND `Number`='$rowid' ORDER BY `Number` DESC LIMIT 1");
		}

if(isset($_POST['search']))
		{
			$custo=$_POST['custo'];
		}

		
		if($custo){
			$conde="AND (`Customer` LIKE '%$custo%' OR `Telephone` LIKE '%$custo%' OR `Address` LIKE '%$custo%')";
			$lim=999999999;
		}
		else{
			$conde='';
			$lim=140;
		}

$do=mysql_query("SELECT *FROM `account` WHERE `Status`='0' $conde ORDER BY `Customer` ASC LIMIT $lim");
$fo=mysql_num_rows($do);
?>
<div class="container-fluid main-content">
        <div class="page-title hidden-print">
          <h3 style='margin-top:-20px; margin-bottom: 5px; color:#ffcc33'>
         Customers' Accounts
          </h3>
  
    </div>
   <div class="row">
  <div class="col-lg-2 hidden-print">
   
  <ul class="list-group">
    
    <li class="list-group-item active">
	  <a href="customer.php">
                <p>
                <i class="lnr lnr-menu-circle"></i>&nbsp;Customers' Accounts
                </p>
              </a></li>  

	   <li class="list-group-item">
              <a href="createa.php">
                <p>
                <i class="lnr lnr-plus-circle"></i>&nbsp;Create New Customer
                </p>
              </a></li>   

	   <li class="list-group-item">
              <a href="branches.php">
                <p>
                <i class="lnr lnr-plus-circle"></i>&nbsp;Sales/Payment
                </p>
              </a></li> 
                
            </ul>
  </div>
                    
           
           
       
        <div class="col-lg-10">
                  <div class="row">
         
           <div class="col-lg-4"> </div>
          
         
           

        <form action="" method="post" class="form-horizontal ">                  
                       <div class="col-lg-8 hidden-print"><div class="col-lg-3"> 					
					   
					   </div>
            <div class="col-lg-6"> 
      <input class="form-control"  name="custo" type="text" value="<?php echo $dato ?>" id="searchi" required>
			</div>                      
                       
                       <div class="col-lg-2">
                        <button class="btn  btn-primary btn-block" type="submit" name="search"><i class="lnr lnr-magnifier"></i> Search</button>
                   
					  </div>
                         </div> 
                      
                     
                  
            </form> 
             
               
            </div>
            <div class="divFooter"><center><u><b>CUSTOMERS REPORT <?php echo"ON $Date" ?></b></u></center></div>
             <div class="row">
            <div class="col-lg-12">
             <span>Total Records Found : <b><?php echo" $fo " ?></b></span>
			 <span class="pull-right hidden-print">&nbsp;&nbsp;&nbsp;&nbsp;<a href="#" onclick="return window.print()" class="hidden-print" title='Click to print' data-toggle='tooltip' data-placement='top'><i class="lnr lnr-printer hidden-print"></i></a></span>
            <div class="widget-container fluid-height clearfix">
            <div class="widget-content padded clearfix">

			<div class='table-responsive'><table class="table table-striped">     
                                      <thead>
                    <tr role="row"> <th> No </th>
    <th class='text-center'>&nbsp;&nbsp;&nbsp;DATE&nbsp;&nbsp;&nbsp;</th>
                     <th> FULL NAME </th>
                     <th> DELEGATOR </th>
                     <th> TIN/VAT No </th>
                        <th> ADDRESS </th>
                        <th> TELEPHONE </th>
						<th class="hidden-xs hidden-print" style="width:40px; text-align:center;" colspan='2'> OPTIONS </th></tr>
                    </thead>
                                        <tbody>
		<?php
					$n=1;			$tot=0;	
		while($ro=mysql_fetch_assoc($do)){
$code=$ro['Number'];
$name=$ro['Customer'];
$dte=$ro['Date'];
$addre=$ro['Address'];
$tele=$ro['Telephone'];
$tin=$ro['Tin'];
$bal=$ro['Balance'];
$balo=number_format($bal);
$brc=$ro['Branche'];
$dele=$ro['Delegator'];
$stl="style='padding:1px;'";

if($_SESSION['Cancel'] AND $bal<='100'){
			 $dbutn='submit';
			 $disa='';
		 }
		 else{
			 $dbutn='button';
			 $disa='disabled';
		 }

		 echo"<div class='modal fade' id='exampleModal$n' tabindex='-1' role='dialog' aria-labelledby='exampleModalLabel' aria-hidden='true' 
		style='top:220px;'>
  <div class='modal-dialog' role='document'>
    <div class='modal-content'>
      <div class='modal-header'>
        <h5 class='modal-title' id='exampleModalLabel'>DELETE CONFIRMATION 
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; $name </h5>

      </div>
      <div class='modal-body' style='height:40px;'>
        <h5 style='color:#ff0033'>Are you sure you want to delete this customer?</h5>
      </div><form method='post' action=''><input type='hidden' name='rowid' value='$code'>
      <div class='modal-footer' style='margin-top:-10px; height:50px; padding-top:5px; border:0px solid blue;'>
        <button type='button' class='btn btn-sm btn-success' data-dismiss='modal'>&nbsp;NO&nbsp;</button>
        <button type='$dbutn' name='delo' class='btn btn-sm btn-danger' $disa>YES</button>
      </div></form>
    </div>
  </div>
</div>";

print("<tr><td $stl><div align='center'>$n&nbsp;&nbsp;</td><td $stl><div align='center'> $dte </td><td $stl>$name</td>
	<td $stl>$dele</td><td class='text-right' $stl> $tin &nbsp;&nbsp;</td><td $stl> $addre </td>
	<td $stl><div align='right'> &nbsp; $tele &nbsp; </td>
					   
					<form method=post action='createa.php'>   
					   <td class='hidden-xs hidden-print' align='right' style='width:40px; padding:0px;'>
                              <input type='hidden' name='rowid' value='$code'>
                          <button type='submit' class='btn btn-xs btn-warning hidden-print' name='open' style='height:18px; padding:0px;'>
						  &nbsp;&nbsp;<i class='lnr lnr-pencil'></i>&nbsp;&nbsp;</button></td></form>
						  
						  <td class='hidden-xs hidden-print' align='right' style='width:40px; padding:0px;'>
                          <button type='$dbutn' class='btn btn-xs btn-danger hidden-print' style='height:18px; padding:0px;' data-placement='top' data-toggle='modal' data-target='#exampleModal$n' $disa>&nbsp;&nbsp;<i class='lnr lnr-trash'></i>&nbsp;&nbsp;</button></td></tr>");
			$n++;				$tot+=$bal;
	}
	
				?>
                  </table><br></div>                 
                
              </div>
            </div></div>
                  </div><span class="pull-right hidden-print">
			 &nbsp;&nbsp;&nbsp;&nbsp;<a href="#" onclick="return window.print()" class="hidden-print" title='Click to print' data-toggle='tooltip' data-placement='top'><i class="lnr lnr-printer"></i></a></span>
      
   </div></div></div>
   <?php
   include'footer.php';
   ?>