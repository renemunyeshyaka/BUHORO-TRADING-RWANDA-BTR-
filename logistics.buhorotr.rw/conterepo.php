<?php
if(basename($_SERVER['PHP_SELF']) == 'conterepo.php') 
  $nv=" class='current'";
include'header.php';
include'connection.php';
$custo=$conde=$condi='';
$dato=$datos=$Date;
$code=$p=0;

if(isset($_POST['search']))
		{
			$custo=$_POST['custo'];
			$datos=$_POST['datos'];
			$dato=$_POST['dato'];
			$p=1;
		}

	if(isset($_POST['open']))
		{
			$code=$_POST['rowid'];
			$custo=$_POST['custo'];
			$datos=$_POST['datos'];
			$dato=$_POST['dato'];
			$p=$_POST['p'];
		}

	if(isset($_POST['saveco']))
		{
			$trip=$_POST['trip'];
			$custo=$_POST['custo'];
			$datos=$_POST['datos'];
			$dato=$_POST['dato'];
			$p=$_POST['p'];
			$ldate=$_POST['ldate'];
			$conte=str_replace("'", "`", $_POST['conte']);
		
	$doin=mysqli_query($conn, "UPDATE `trips` SET `Container`='$conte', `Ldate`='$ldate' WHERE `Number`='$trip' ORDER BY `Number` ASC LIMIT 1");
		}
		
		
	if(isset($_POST['codele']))
		{
			$code=$_POST['code'];
	$doin=mysqli_query($conn, "UPDATE `trips` SET `Container`='', `Ldate`='0000-00-00', `Ddate`='', `Deso`='', `Inter`='' WHERE `Number`='$code' ORDER BY `Number` ASC LIMIT 1");
		}
		
		
		if(isset($_POST['savere']))
		{
			$trip=$_POST['code'];
			$custo=$_POST['custo'];
			$datos=$_POST['datos'];
			$dato=$_POST['dato'];
			$p=$_POST['p'];
			$rdate=$_POST['rdate'];
			$deso=str_replace("'", "`", $_POST['deso']);
			
			 $temp1 = explode(".", $_FILES["file1"]["name"]);
    $newfilename1 = round(microtime(true)) . '.' . end($temp1);
    move_uploaded_file($_FILES["file1"]["tmp_name"], "files/" . $newfilename1);
	    if(!end($temp1))
	    $newfilename1='';
		
	$doin=mysqli_query($conn, "UPDATE `trips` SET `Ddate`='$rdate', `Deso`='$deso', `Inter`='$newfilename1' WHERE `Number`='$trip' ORDER BY `Number` ASC LIMIT 1");
		}

	
	if($custo)
	    $conde="AND `Container` = '$custo'";

if($p=='0')
$doje=mysqli_query($conn, "SELECT *FROM (SELECT *FROM `trips` WHERE `Status`='0' AND `Container`!='' GROUP BY `Container` ORDER BY `Ldate` DESC LIMIT 10) SUB ORDER BY `Ldate` ASC");
else
$doje=mysqli_query($conn, "SELECT *FROM `trips` WHERE `Status`='0' AND `Ldate` BETWEEN '$dato' AND '$datos' AND `Container`!='' $conde GROUP BY `Container` ORDER BY `Ldate` ASC");

$fo=mysqli_num_rows($doje);
?>
<div class="container-fluid main-content">
        <div class="page-title hidden-print">
          <h2 style='margin-top:-20px; margin-bottom: 5px; color:#ffcc33'>
         Vehicles
          </h2>
  
    </div>
   <div class="row">
  <div class="col-lg-2 hidden-print">
   
  <ul class="list-group">
                  
			  <li class="list-group-item">
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

			<li class="list-group-item" style="border:1px dashed #cccccc; border-radius:5px; margin:0px 0px 4px 0px;">
	  <a href="createa.php">
                <p>
                <i class="lnr lnr-plus-circle"></i>&nbsp;Create Customers
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
              
            <li class="list-group-item" style="border:1px dashed #cccccc; border-radius:5px; margin:0px 0px 4px 0px;">
	  <a href="payslip.php">
                <p>
                <i class="lnr lnr-plus-circle"></i>&nbsp;Payment Vouchers
                </p>
              </a></li>	
              
              
            <li class="list-group-item active" style="border:1px dashed #cccccc; border-radius:5px; margin:0px 0px 4px 0px;">
	  <a href="conterepo.php">
                <p>
                <i class="lnr lnr-plus-circle"></i>&nbsp;Container Dispatch
                </p>
              </a></li>	
  </div>
                    
     
     
     <?php
     
      echo"<div class='modal fade' id='Modaldis' tabindex='-1' role='dialog' aria-labelledby='exampleModalLabel' aria-hidden='true'>
  <div class='modal-dialog' role='document'><div class='modal-content'><div class='modal-header text-left'>
        <h5 class='modal-title' id='exampleModalLabel'>LOAD TRIP CONTAINER 
        <span class='pull-right'>  </span></h5>

      </div><form action='' method='post'>
      <div class='modal-body text-left'><div class='row'>

        <div class='form-group'>
			<div class='col-md-5' align='right' style='padding-top:10px'> 
            <label class='control-label'>Select&nbsp;a&nbsp;Trip</label></div>
            <div class='col-md-6'>
<select class='form-control' name='trip' style='font-size:16px; height:34px;' required>
	 <option value=''> </option>";

$do=mysqli_query($conn, "SELECT *FROM (SELECT `Number`, `Date`, `Plate`, `Destination`, `Location`, `Container` FROM `trips` WHERE `Status`='0' ORDER BY `Date` DESC LIMIT 70) SUB ORDER BY `Date` ASC");
		while($ro=mysqli_fetch_assoc($do)){
			$numb=$ro['Number'];
			$plate=$ro['Plate'];
			$dati=$ro['Date'];
			$des=$ro['Destination'];
			$loc=$ro['Location'];
			if($ro['Container'])
			    $stl="style='color:blue;'";
			else
			    $stl="";
	echo"<option value='$numb' $stl> $dati $plate [$des-$loc]</option>";
		}
		
		echo"</select></div>    
		</div></div>
		
		
		<div class='row'>
		<div class='form-group'>
			<div class='col-md-5' align='right' style='padding-top:10px'> 
            <label class='control-label'>Date of Loading</label></div>
            <div class='col-md-6'><div class='input-group date' data-provide='datepicker'><input class='form-control form-center' name='ldate' type='text' value='$Date' onkeypress='return isNumberKey(event)' required><div class='input-group-addon'><span class='lnr lnr-calendar-full'></span></div></div></div></div>
            </div>
           
           <div class='row'> 
        <div class='form-group'>
			<div class='col-md-5' align='right' style='padding-top:10px'> 
            <label class='control-label'>Container Number</label></div>
            <div class='col-md-6'><input class='form-control form-center' name='conte' type='text' OnKeyup='return cUpper(this);' required></div></div></div>   
            
            
            </div>
		
	<div class='modal-header text-right' style='height:50px; padding-top:15px;'>	<input type='hidden' value='$p' name='p'>
	<input type='hidden' value='$dato' name='dato'>
	<input type='hidden' value='$datos' name='datos'>
	<input type='hidden' value='$custo' name='custo'>
		<button type='button' class='btn btn-xs btn-danger' data-dismiss='modal' style='width:80px;'> CANCEL </button>
        <button type='submit' name='saveco' class='btn btn-xs btn-success' style='width:80px;'> SAVE </button></div>
      </form>
  </div></div>
</div>";
?>

           
       
        <div class="col-lg-10">
                  <div class="row hidden-print">
                      
                      <div class="col-lg-2" style="margin-left:40px;">
              
       <button class="btn  btn-warning btn-block" type="button" data-toggle='modal' data-target='#Modaldis'> Load Container </button>
      
						</div>
		<div class="col-lg-1"> </div> 

        <form action="" method="post" class="form-horizontal ">                  
                       <div class="col-lg-8 hidden-print">
					   
					   <div class="col-lg-4 hidden-print"> 
      <select class="form-control" name="custo">
				<option value='' selected='selected'>Select Container</option>
			 <?php
	$doi=mysqli_query($conn, "SELECT `Container` FROM `trips`  WHERE `Container`!='' GROUP BY `Container` ORDER BY `Container` ASC");
			while($roi=mysqli_fetch_assoc($doi)){
				$conte=$roi['Container'];
				if($conte==$custo)
					$sle="selected";
				else
					$sle='';
			echo"<option value='$conte' $sle> $conte </option>";
			}
			?>    
                            </select>
			</div>          
            
			 <div class="col-lg-3 hidden-print"> 
           <div class="input-group date" data-provide="datepicker">
      <input class="form-control form-center" id="from" name="dato" type="text" value="<?php echo $dato ?>" onkeypress='return isNumberKey(event)' required>
	  <span class="input-group-addon"><i class="lnr lnr-calendar-full"></i></span>
			</div></div>


		  <div class="col-lg-3 hidden-print"> 
           <div class="input-group date" data-provide="datepicker">	
      <input class="form-control form-center" id="to" name="datos" type="text" value="<?php echo $datos ?>" onkeypress='return isNumberKey(event)' required>
	  <span class="input-group-addon"><i class="lnr lnr-calendar-full"></i></span>
              </div></div> 
                       
                       <div class="col-lg-2">
                        <button class="btn  btn-primary btn-block" type="submit" name="search"><i class="lnr lnr-magnifier"></i> Search</button>
                   
					  </div>
                         </div> 
                      
                      
                     
                  
            </form> 
             
               
            </div>
             <div class="row">
            <div class="col-lg-12" style='margin-top:-20px;'>
             <span>Total Records Found : <b><?php echo" $fo " ?></b></span>
			  <span class="pull-right hidden-print">
			 &nbsp;&nbsp;&nbsp;&nbsp;<a href="#" onclick="return window.print()" class="hidden-print" title='Print' data-toggle='tooltip' data-placement='top'><i class="lnr lnr-printer"></i></a>&nbsp;&nbsp;&nbsp;</span>
			 
			 <span class="pull-right hidden-print">
			 &nbsp;&nbsp;&nbsp;&nbsp;<a href="#" onclick="exportTableToExcel('tblData')" class="hidden-print" title='Export to excell' data-toggle='tooltip' data-placement='top'><i class="lnr lnr-line-spacing"></i></a></span>
            <div class="widget-container fluid-height clearfix">
            <div class="widget-content padded clearfix">

<div class="table-responsive">
			<table class="table table-striped table-hover table-sm" style="font-size:8px;" id="tblData">     
                                      <thead>
                    <tr role="row"> 
					<th width='4px'>&nbsp;No&nbsp;</th>
		<th class="text-center" width='7%'> Date </th>
		<th><div align='center'> Customer </th><th> Vehicle </th>
    <th> Destination </th><th> Location </th><th> Final </th>
    <th> Load&nbsp;Size </th><th> Container&nbsp;No </th>
    <th><div align='center'> Loading&nbsp;Date </th>
    <th><div align='center'> Days </th>
    <th colspan='2'><div align='center'> Return&nbsp;Date </th></tr>
                    </thead><tbody>
		<?php
					$n=1;
		while($ro=mysqli_fetch_assoc($doje)){
$code=$ro['Number'];
$name=$ro['Vehicle'];
$dte=$ro['ETD'];
$loce=$ro['Location'];
$dicha=$ro['Final'];
$dese=$ro['Destination'];
$desc=$ro['Description'];
$capa=$ro['Capacity'];									
$capao=number_format($capa, 2);
$caps=number_format($capa);
$dista=$ro['Distance'];									
$distao=number_format($dista, 2);
$dists=number_format($dista);
$driver=$ro['Driver'];
$conte=$ro['Container'];
$inter=$ro['Inter'];
$lda=$ro['Ldate'];
$dda=$ro['Ddate'];
$deso=$ro['Deso'];
if($dda=='0000-00-00')
$eda=$Date;
else
$eda=$dda;

$ndy=1 + (strtotime("$eda") - strtotime("$lda")) / (60 * 60 * 24);
$pla=$ro['Plate'];

$stl="style='padding:1px; font-size:13px;'";

	$ttl="title='$desc'";
	
	if($inter){
	    $contes="<label class='hover_img'>
     <a href='files/$inter' target='_blank'>$conte<span><img src='files/$inter' alt='image' height='500' width='500' /></span></a></label>";
	}
	else
	    $contes=$conte;
	
	$custom=mysqli_query($conn, "SELECT `account`.`Customer` FROM `account` INNER JOIN `income` ON `account`.`Number` = `income`.`Customer` WHERE `income`.`Trip`='$code' AND `income`.`Status`='0' AND `income`.`Customer`!='0' ORDER BY `income`.`Number` DESC LIMIT 1");
			$rusto=mysqli_fetch_assoc($custom);
				$cus=$rusto['Customer'];
				
				if($dda=='0000-00-00')
	$dda="<a class='link' href='#' data-toggle='modal' data-target='#modal-xi1020$n'> InterChange </a>";
	            else
	$dda="<a class='link' href='#' data-toggle='modal' data-target='#modal-xi1020$n'> $dda </a>";

echo"<tr $ttl data-toggle='tooltip' data-placement='top'>
<td $stl><div align='center'><style>
          .hover_img a { position:relative; }
.hover_img a span { position:absolute; display:none; z-index:99; font-size:14px; }
.hover_img a:hover span { display:block; }
    </style> $n&nbsp;</td>
<td $stl><div align='center'>$dte</td><td $stl> $cus </td>
	<td $stl>$pla&nbsp;</td><td $stl> $dese </td><td $stl> $loce </td>
	<td $stl> $dicha </td><td $stl><div align='right'>&nbsp;$capao&nbsp;T
	</td><td $stl><div align='right'><b> $contes </td>
	<td $stl><div align='center'> $lda </td>
	<td $stl><div align='center'> $ndy </td>
	<td $stl><div align='center'> $dda </td>
	<td style='padding:1px; font-size:13px; width:1px;'>";
	if($_SESSION['Ctr'])
	$bdl="submit";
	else
	$bdl="button";
	include'interchange.php';
	echo"</tr>";
	        $n++;
			}
			?></tbody>
                  </table>
                  
                    </div></div></div>                
               <div class="col-lg-12 hidden-print">
                   <span class="pull-right hidden-print">
            &nbsp;&nbsp;&nbsp;&nbsp;<a href="#" onclick="return window.print()" class="hidden-print" title='Print' data-toggle='tooltip' data-placement='top'><i class="lnr lnr-printer"></i></a>&nbsp;&nbsp;&nbsp;</span>
			 
			 <span class="pull-right hidden-print">
			 &nbsp;&nbsp;&nbsp;&nbsp;<a href="#" onclick="exportTableToExcel('tblData')" class="hidden-print" title='Export to excell' data-toggle='tooltip' data-placement='top'><i class="lnr lnr-line-spacing"></i></a></span></div> 
                          
                  </div>
      
   </div></div></div>
   <?php
   include'footer.php';
   ?>