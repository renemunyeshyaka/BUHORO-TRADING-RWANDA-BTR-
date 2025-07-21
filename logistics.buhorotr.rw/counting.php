<?php
if(basename($_SERVER['PHP_SELF']) == 'counting.php') 
  $cm=" class='current'";
include'header.php';
include'connection.php';
$dato=$datos=$Date;
$custo='';
$conde='';

$do=mysqli_query($conn, "SELECT *FROM `items` WHERE `Status`='0' ORDER BY `Item` ASC");
$fo=mysqli_num_rows($do);
?>
<div class="container-fluid main-content">
        <div class="page-title hidden-xs hidden-print">
          <h2 style='margin-top:-20px; margin-bottom: 5px; color:#ffcc33'>
         Store Report
          </h2>
                 </div>
     
        <div class="row">
  <div class="col-lg-2 hidden-print">
   
   <ul class="list-group">

    <li class="list-group-item">
	  <a href="storepo.php">
                <p>
                <i class="lnr lnr-menu-circle"></i>&nbsp;Store Status
                </p>
              </a></li>
                  
			  <li class="list-group-item">
              <a href="recerepo.php">
                <p>
                <i class="lnr lnr-plus-circle"></i>&nbsp;S.In &nbsp;Report
                </p>
              </a></li>
                  
			  <li class="list-group-item">
              <a href="recerepo.php">
                <p>
                <i class="lnr lnr-plus-circle"></i>&nbsp;Receiving Report
                </p>
              </a></li>
                  
			  <li class="list-group-item">
              <a href="requirepo.php">
                <p>
                <i class="lnr lnr-plus-circle"></i>&nbsp;Requisition Report
                </p>
              </a></li>
                  
			  <li class="list-group-item">
              <a href="consurepo.php">
                <p>
                <i class="lnr lnr-plus-circle"></i>&nbsp;Consumption Report
                </p>
              </a></li>  
                  
			  <li class="list-group-item">
              <a href="balrepo.php">
                <p>
                <i class="lnr lnr-menu-circle"></i>&nbsp;Balance Report
                </p>
              </a></li>   
                  
			  <li class="list-group-item">
              <a href="suprepo.php">
                <p>
                <i class="lnr lnr-plus-circle"></i>&nbsp;Suppliers Report
                </p>
              </a></li> 
                  
			  <li class="list-group-item active">
              <a href="counting.php">
                <p>
                <i class="lnr lnr-menu-circle"></i>&nbsp;Counting Papers
                </p>
              </a></li> 
                       
            </ul><br><br><br>
  </div>
                    
           
           
       
        <div class="col-lg-10">
                  <div class="row">
         
           <div class="col-lg-2 hidden-print">  </div>

        <form action="" method="post" class="form-horizontal ">                  
                       
            <div class="col-lg-3 hidden-print"> 
      <input class="form-control"  name="custo" type="text" id="search" autofocus="autofocus">
	   
			</div> 
			
			<div class="col-lg-2 hidden-print"> 
           <div class="input-group date datepicker">
      <input class="form-control form-center" id="from" name="dato" type="text" value="<?php echo $dato ?>" onkeypress='return isNumberKey(event)' required>
	  <span class="input-group-addon"><i class="lnr lnr-calendar-full"></i></span>
			</div></div>


		  <div class="col-lg-2 hidden-print"> 
           <div class="input-group date datepicker">	
      <input class="form-control form-center" id="to" name="datos" type="text" value="<?php echo $datos ?>" onkeypress='return isNumberKey(event)' required>
	  <span class="input-group-addon"><i class="lnr lnr-calendar-full"></i></span>
              </div></div>      
                       
                       <div class="col-lg-2 hidden-print">
                        <button class="btn  btn-primary btn-block" type="submit" name="search" disabled><i class="lnr lnr-magnifier"></i> Search</button>
                   
					  </div>
                         
                      
                     
                  
            </form> 
             
               
            </div>
             <div class="row">
            <div class="col-lg-12" style='margin-top:-20px;'>
             <span> &nbsp;&nbsp; </span>
			 <span class="pull-right"><a href="#" onclick="return window.print()" class="hidden-print" title='Click to print' data-toggle='tooltip' data-placement='top'><i class="lnr lnr-printer"></i></a></span>
            <div class="widget-container fluid-height clearfix">
            <div class="widget-content padded clearfix">
               
                                 <table class="table table-striped table-hover">     
                                      <thead>
                    <tr role="row">
                     <th> No </th>
                        <th><div align='center'> ITEM&nbsp;NAME </th>
                       <th><div align='center'> ITEM&nbsp;TYPE </th>
                       <th><div align='center'> COST </th>
					   <th><div align='center'> SYSTEM COUNT </th>
						 <th><div align='center'> PHYSICAL COUNT </th>
                     </tr>
                    </thead>
                                        <tbody>
					<?php
					$n=1;				$to=0;
						while($ro=mysqli_fetch_assoc($do)){
				$code=$ro['Number'];
			$item=$ro['Item'];
			$type=$ro['Type'];
			$pri=$ro['Price'];
			$qty=$ro['Quantity'];
			$val=$qty*$pri;
			$lab=$ro['Label'];
			$des=$ro['Descri'];
			$prio=number_format($pri,2);			
			$valo=number_format($val,2);
			  
    if($_SESSION['Rsi'])
		$qty=number_format($qty,2);
	else
	    $qty="****";
			$stl="style='padding:1px;'";
		 
		
		print("<tr><td $stl><div align='right'>$n&nbsp;&nbsp;</td>
	                    <td $stl> $item </td><td $stl> $type </td>
	                    <td $stl class='text-right'> $prio </td>
						<td $stl class='text-right'> $qty </td>
						<td $stl class='text-right'>  </td></tr>");
							$n++;			
							
						}
						
						?>
						
                    </tbody>
				
                  </table>
              </div></div>

                  </div>                     
                
              </div><span class="pull-right hidden-print">
			 &nbsp;&nbsp;&nbsp;&nbsp;<a href="#" onclick="return window.print()" class="hidden-print" title='Click to print' data-toggle='tooltip' data-placement='top'><i class="lnr lnr-printer"></i></a></span>
            </div></div>
                  </div>
        
   <?php
   include'footer.php';
   ?>
