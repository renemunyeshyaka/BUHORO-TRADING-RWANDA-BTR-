<?php
if(basename($_SERVER['PHP_SELF']) == 'storepo.php') 
  $cm=" class='current'";
include'header.php';
include'connection.php';
$dato=$datos=$Date;
$custo='';
$conde='';

if(isset($_POST['delo']))
		{
			$rowid=$_POST['rowid'];
			$custo=$_POST['custo'];
			$dato=$_POST['dato'];
			$datos=$_POST['datos'];
			$then=mysqli_query($conn, "UPDATE `items` SET `Status`='1' WHERE `Number`='$rowid' LIMIT 1");
		}

if(isset($_POST['search']))
		{
			$custo=$_POST['custo'];
			$dato=$_POST['dato'];
			$datos=$_POST['datos'];
		}

if(isset($_POST['upda']))
			{
			$item=str_replace("'", "`", $_POST['item']);
			$itype=$_POST['itype'];
			$iprice=str_replace(',', '', $_POST['iprice']);
			$ilabel=$_POST['ilabel'];
			$idescri=str_replace("'", "`", $_POST['idescri']);	
			$rowid=$_POST['rowid'];		

/*
$temp = explode(".", $_FILES["files"]["name"]);
$newfilename = round(microtime(true)) . '.' . end($temp);
move_uploaded_file($_FILES["files"]["tmp_name"], "images/" . $newfilename);
*/

$then=mysqli_query($conn, "UPDATE `items` SET `Type`='$itype', `Item`='$item', `Price`='$iprice', `Label`='$ilabel', `Descri`='$idescri' WHERE `Number`='$rowid'");
			}



		if($custo)
			$conde="AND (`Item` LIKE '%$custo%' OR `Type` LIKE '%$custo%')";

if($_SESSION['Rsi'])
$do=mysqli_query($conn, "SELECT *FROM `items` WHERE `Status`='0' $conde ORDER BY `Item` ASC");
else
$do=mysqli_query($conn, "SELECT *FROM `items` WHERE `Status`='10' $conde ORDER BY `Item` ASC");
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

    <li class="list-group-item active">
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
              <a href="xrecerepo.php">
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
                  
			  <li class="list-group-item">
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
      <input class="form-control form-center date" data-provide="datepacker" name="dato" type="text" id="from" value="<?php echo $dato ?>" onkeypress='return isNumberKey(event)' required>
	  <span class="input-group-addon"><i class="lnr lnr-calendar-full"></i></span>
			</div></div>


		  <div class="col-lg-2 hidden-print"> 
           <div class="input-group date datepicker">	
      <input class="form-control form-center date" data-provide="datepacker" name="datos" type="text" id="to" value="<?php echo $datos ?>" onkeypress='return isNumberKey(event)' required>
	  <span class="input-group-addon"><i class="lnr lnr-calendar-full"></i></span>
              </div></div>      
                       
                       <div class="col-lg-2 hidden-print">
                        <button class="btn  btn-primary btn-block" type="submit" name="search"><i class="lnr lnr-magnifier"></i> Search</button>
                   
					  </div>
                         
                      
                     
                  
            </form> 
             
               
            </div>
             <div class="row">
            <div class="col-lg-12" style='margin-top:-20px;'>
			 <span class="pull-right">&nbsp;&nbsp;&nbsp;&nbsp;<a href="#" onclick="return window.print()" class="hidden-print" title='Click to print' data-toggle='tooltip' data-placement='top'><i class="lnr lnr-printer"></i></a></span>
			 
		<span class="pull-right hidden-print">
		&nbsp;&nbsp;&nbsp;&nbsp;<a href="#" id="exporttable" class="hidden-print" title='Export to excell' data-toggle='tooltip' data-placement='top'><i class="lnr lnr-line-spacing"></i></a></span>
		
            <div class="widget-container fluid-height clearfix">
            <div class="widget-content padded clearfix">
               
    <table class="table table-striped table-hover" id="htmltable">     
        <thead><tr role="row"><th> No </th>
                        <th><div align='center'> ITEM&nbsp;NAME </th>
                       <th><div align='center'> ITEM&nbsp;TYPE </th>
                       <th><div align='center'> COST </th>
					   <th><div align='center'> OPEN. </th>
						 <th><div align='center'> NEW </th>
						 <th><div align='center'> USED </th>
						 <th><div align='center'> CLOS. </th>
							<th><div align='center'>VALUE</th>
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
			$stl="style='padding:1px;'";
			
			// ******************** Received and used after datos *******
			
		$iseen=mysqli_query($conn, "SELECT SUM(`Quantity`) AS 'New' FROM `stouse` WHERE `Item`='$code' AND `Status`='0' AND `Store`='1' AND `Date`>'$datos' AND `Action`='RECEIVE'");
					$ireen=mysqli_fetch_assoc($iseen);
						$inew=$ireen['New'];

                 if($item=='MARTIN PETROLEUM')
		$iseeu=mysqli_query($conn, "SELECT SUM(`Quantity`) AS 'Use' FROM `stouse` WHERE `Status`='0' AND `Store`='1' AND `Date`>'$datos' AND `Action`='PURCHASE'");
		        else
		$iseeu=mysqli_query($conn, "SELECT SUM(`Quantity`) AS 'Use' FROM `stouse` WHERE `Item`='$code' AND `Status`='0' AND `Store`='1' AND `Date`>'$datos' AND `Action`='USED'");
					$ireeu=mysqli_fetch_assoc($iseeu);
						$iuse=$ireeu['Use'];
						
			$clo=$qty-$inew+$iuse;	            $qto=number_format($clo,2);
			
			
			// ******************** Received and used within selected date *******

		$seen=mysqli_query($conn, "SELECT SUM(`Quantity`) AS 'New' FROM `stouse` WHERE `Item`='$code' AND `Status`='0' AND `Store`='1' AND `Date` BETWEEN '$dato' AND '$datos' AND `Action`='RECEIVE'");
					$reen=mysqli_fetch_assoc($seen);
						$new=$reen['New'];

                if($item=='MARTIN PETROLEUM')
		$seeu=mysqli_query($conn, "SELECT SUM(`Quantity`) AS 'Use' FROM `stouse` WHERE `Status`='0' AND `Store`='1' AND `Date` BETWEEN '$dato' AND '$datos' AND `Action`='PURCHASE'");
		        else
		$seeu=mysqli_query($conn, "SELECT SUM(`Quantity`) AS 'Use' FROM `stouse` WHERE `Item`='$code' AND `Status`='0' AND `Store`='1' AND `Date` BETWEEN '$dato' AND '$datos' AND `Action`='USED'");
					$reeu=mysqli_fetch_assoc($seeu);
						$use=$reeu['Use'];
						
			$newo=number_format($new,2);					
			$useo=number_format($use,2);
			$op=$clo-$new+$use;
			$ope=number_format($op, 2);
		 
		 if($new OR $use OR $op OR $clo){
		print("<tr><td $stl><div align='right'>$n&nbsp;&nbsp;</td>
	                    <td $stl> $item </td><td $stl> $type </td>
	                    <td $stl class='text-right'> $prio </td>
						<td $stl class='text-right'> $ope </td>
						<td $stl class='text-right'> $newo </td>
						<td $stl class='text-right'> $useo </td>
						<td $stl class='text-right'> $qto </td>
	<td $stl class='text-right' style='padding-right:10px;'>$valo</div></tr>");
							$n++;			
							 if($ro['Status']!='1')
								 $to+=$val;
		 }
						}
						$to=number_format($to, 2);					
						?>
						
                    </tbody>
					<tr><th> </th><th colspan='5'>&nbsp;&nbsp;&nbsp;&nbsp; TOTAL VALUE </th>
					<th class='text-right' colspan='3'><?php echo $to ?>&nbsp;</th></tr>
                  </table>
              </div></div>

                  </div>                     
                
              </div><span class="pull-right hidden-print">
			 &nbsp;&nbsp;&nbsp;&nbsp;<a href="#" onclick="return window.print()" class="hidden-print" title='Click to print' data-toggle='tooltip' data-placement='top'><i class="lnr lnr-printer"></i></a></span>
			 
	<span class="pull-right hidden-print">
		&nbsp;&nbsp;&nbsp;&nbsp;<a href="#" id="exporttable" class="hidden-print" title='Export to excell' data-toggle='tooltip' data-placement='top'><i class="lnr lnr-line-spacing"></i></a></span>
            </div></div>
                  </div>
        
   <?php
   include'footer.php';
   ?>
