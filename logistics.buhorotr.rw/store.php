<?php
if(basename($_SERVER['PHP_SELF']) == 'store.php') 
  $nv=" class='current'";
include'header.php';
include'connection.php';
$custo='';
$conde='';

if(isset($_POST['delo']))
		{
			$rowid=$_POST['rowid'];
			$custo=$_POST['custo'];
			$then=mysqli_query($conn, "UPDATE `items` SET `Status`='1' WHERE `Number`='$rowid' LIMIT 1");
		}

if(isset($_POST['search']))
		{
			$custo=$_POST['custo'];
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

$do=mysqli_query($conn, "SELECT *FROM `items` WHERE `Status`='0' $conde ORDER BY `Type` ASC");
$fo=mysqli_num_rows($do);
?>
<div class="container-fluid main-content">
        <div class="page-title hidden-xs hidden-print">
          <h2 style='margin-top:-20px; margin-bottom: 5px; color:#ffcc33'>
         Materials
          </h2>
                 </div>
     
        <div class="row">
  <div class="col-lg-2 hidden-print">
   
   <ul class="list-group">

    <li class="list-group-item active">
	  <a href="store.php">
                <p>
                <i class="lnr lnr-menu-circle"></i>&nbsp;Store Status
                </p>
              </a></li> 

	   <li class="list-group-item">
              <a href="#" data-toggle='modal' data-target='#myModo'>
                <p>
                <i class="lnr lnr-plus-circle"></i>&nbsp;Create New Item
                </p>
              </a></li> 
                  
			  <li class="list-group-item">
              <a href="requit.php">
                <p>
                <i class="lnr lnr-plus-circle"></i>&nbsp;Requisition Forms
                </p>
              </a></li>
                  
			  <li class="list-group-item">
              <a href="receive.php">
                <p>
                <i class="lnr lnr-plus-circle"></i>&nbsp;Receive Items
                </p>
              </a></li>
                  
			  <li class="list-group-item">
              <a href="#" data-toggle='modal' data-target='#myModos'>
                <p>
                <i class="lnr lnr-plus-circle"></i>&nbsp;Used Items
                </p>
              </a></li>
                       
            </ul><br><br><br>
  </div>
                    
           
           
       
        <div class="col-lg-10">
                  <div class="row">
         
           <div class="col-lg-6"> </div>
          
         
           

        <form action="" method="post" class="form-horizontal ">                  
                       
            <div class="col-lg-3 hidden-xs hidden-print"> 
      <input class="form-control"  name="custo" type="text" id="search" list="item" autofocus="autofocus">
	   <datalist id="item">
	  <?php
	$select =mysqli_query($conn, "SELECT * FROM `items` WHERE `Status` = '0' GROUP BY `Item` ORDER BY `Item` ASC");
while ($row=mysqli_fetch_array($select)) 
{
 echo"<option value=".$row['Item'].">";
}
	  ?>
		</datalist>
			</div>                      
                       
                       <div class="col-lg-2 hidden-xs hidden-print">
                        <button class="btn  btn-primary btn-block" type="submit" name="search"><i class="lnr lnr-magnifier"></i> Search</button>
                   
					  </div>
                         
                      
                     
                  
            </form> 
             
               
            </div>
             <div class="row">
            <div class="col-lg-12" style='margin-top:-20px;'>
             <span> &nbsp;&nbsp; Total Records Found : <b><?php echo" $fo " ?></b></span> 
			 <span class="pull-right"><a href="#" onclick="return window.print()" class="hidden-print" title='Click to print' data-toggle='tooltip' data-placement='top'><i class="lnr lnr-printer"></i></a></span>
            <div class="widget-container fluid-height clearfix">
            <div class="widget-content padded clearfix">
               
                                 <table class="table table-striped table-hover">     
                                      <thead>
                    <tr role="row">
                     <th class="hidden-xs"> NO </th>
                        <th><div align='center'> ITEM&nbsp;NAME </th>
                       <th><div align='center'> ITEM&nbsp;TYPE </th>
                       <th><div align='center'> COST </th>
					   <th><div align='center'> OPEN. </th>
						 <th><div align='center'> NEW </th>
						 <th><div align='center'> USED </th>
						 <th><div align='center'> CLOS. </th>
							<th><div align='center'>VALUE</th>
                        <th class="hidden-xs hidden-print" style="width:20px; text-align:center;" colspan='2'> Options </th>
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
			$prio=number_format($pri,2);				$qto=number_format($qty,2);					$valo=number_format($val,2);
			$stl="style='padding:1px;'";

			$seen=mysqli_query($conn, "SELECT SUM(`Quantity`) AS 'New' FROM `stouse` WHERE `Item`='$code' AND `Status`='0' AND `Store`='1' AND `Date`='$Date' AND `Action`='RECEIVE'");
					$reen=mysqli_fetch_assoc($seen);
						$new=$reen['New'];

			$seeu=mysqli_query($conn, "SELECT SUM(`Quantity`) AS 'Use' FROM `stouse` WHERE `Item`='$code' AND `Status`='0' AND `Store`='1' AND `Date`='$Date' AND `Action`='USED'");
					$reeu=mysqli_fetch_assoc($seeu);
						$use=$reeu['Use'];
			$newo=number_format($new,2);								$useo=number_format($use,2);				$ope=number_format($qty-$new+$use, 2);
		 
		print("<tr>
                        <td class='hidden-xs' $stl><div align='right'>$n&nbsp;&nbsp;</td>
						<td $stl> $item </td><td $stl> $type </td><td $stl class='text-right'> $prio </td>
						<td $stl class='text-right'> $ope </td><td $stl class='text-right'> $newo </td>
						<td $stl class='text-right'> $useo </td><td $stl class='text-right'> $qto </td>
						<td $stl class='text-right' style='padding-right:10px;'> $valo </div>");





// ********************** Delete Confirmation *****************************************

		echo"<div class='modal fade' id='exampleModal$n' tabindex='-1' role='dialog' aria-labelledby='exampleModalLabel' aria-hidden='true' 
		style='top:220px;'>
  <div class='modal-dialog' role='document'>
    <div class='modal-content'>
      <div class='modal-header'>
        <h5 class='modal-title' id='exampleModalLabel'>DELETE CONFIRMATION 
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; $item </h5>

      </div>
      <div class='modal-body' style='height:40px;'>
        <h5 style='color:#ff0033'>Are you sure you want to delete this item?</h5>
      </div><form method='post' action=''><input type='hidden' name='rowid' value='$code'><input type='hidden' name='custo' value='$custo'>
      <div class='modal-footer' style='margin-top:-10px; height:50px; padding-top:5px; border:0px solid blue;'>
        <button type='button' class='btn btn-sm btn-success' data-dismiss='modal'>&nbsp;NO&nbsp;</button>
        <button type='$dbutn' name='delo' class='btn btn-sm btn-danger'>YES</button>
      </div></form>
    </div>
  </div>
</div>";








// ********************************** Edit an item *****************************************

include'edit.php';
						
						
						
						
						
						echo("</td>
						   <form method=post action='crete.php'><td class='hidden-xs hidden-print' align='right' style='width:20px; padding:0px;'>
                              <input type='hidden' name='rowid' value='$code'>
                          <button type='button' class='btn btn-xs btn-warning hidden-print' style='height:25px; padding:0px; margin:0px;' data-toggle='modal' data-target='#uModal$n'>&nbsp;&nbsp;<i class='lnr lnr-pencil'></i>&nbsp;&nbsp;</button></td></form>
						  
						  <form method=post action=''>
						  <td class='hidden-xs hidden-print' align='right' style='width:20px; padding:0px; padding-right:5px;'>
						  <div title='Delete' data-toggle='tooltip' data-placement='top'>
                              <input type='hidden' name='rowid' value='$code'><input type='hidden' name='custo' value='$custo'>
                          <button type='button' class='btn btn-xs btn-danger hidden-print' style='height:25px; padding:0px; margin:0px;' data-placement='top'
						  data-toggle='modal' data-target='#exampleModal$n' $disa>
						  &nbsp;&nbsp;<i class='lnr lnr-trash'></i>&nbsp;&nbsp;</button></div></td></form></tr>");
							$n++;			
							 if($ro['Status']!='1')
								 $to+=$ro['Price'];
						}
						$to=number_format($to);					
						?>
						
                    </tbody>
                  </table>

					 <div class="col-md-12 hidden-xs hidden-print">
                  <div class="pull-right hidden-xs hidden-print">
                  <ul class="pagination">
                      <li>
                                            </li>
                      <li class="activei">
					  <?php
					  if($l1!=0){
						  ?>
					    <a href="#">
                        &nbsp;<<&nbsp;                        </a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						<?php
					 }
						?>
                       
						<?php
						echo"<a href='#'>";
						?>
                        >>                        </a>
                      </li>
                                             <li>
                                            </li>
                    </ul>
              </div></div>

                  </div>                     
                
              </div>
            </div></div>
                  </div>
      
   </div></div></div>  
   <?php
   include'footer.php';
   ?>
