<?php
if(basename($_SERVER['PHP_SELF']) == 'disrepo.php') 
$cm=" class='current'";
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

	if(isset($_POST['upda']))
		{
			$code=$_POST['code'];
			$eld=$_POST['eld'];
			$ead=$_POST['ead'];
			$uploc=$_POST['uploc'];
			$uplod=$_POST['uplod'];
			
	$do=mysqli_query($conn, "UPDATE `trips` SET `ELD`='$eld', `EAD`='$ead', `Uploc`='$uploc', `Upload`='$uplod' WHERE `Status`='0' AND `Number`='$code' ORDER BY `Number` ASC LIMIT 1");
		}


	$doi=mysqli_query($conn, "SELECT `Vehicle`, `Plate` FROM `trips` WHERE `Status`='0' GROUP BY `Vehicle` ORDER BY `Vehicle` ASC");
        $fo=mysqli_num_rows($doi);
?>
<div class="container-fluid main-content">
        <div class="page-title hidden-print">
          <h2 style='margin-top:-20px; margin-bottom: 5px; color:#ffcc33'>
         Trip Report
          </h2>
  
    </div>
   <div class="row">
  <div class="col-lg-2 hidden-print">
   
  <ul class="list-group">
                  
			  <li class="list-group-item">
              <a href="triprepo.php">
                <p>
                <i class="lnr lnr-plus-circle"></i>&nbsp;Trip Report
                </p>
              </a></li>

    <li class="list-group-item active">
	  <a href="disrepo.php">
                <p>
                <i class="lnr lnr-menu-circle"></i>&nbsp;Dispatch Report
                </p>
              </a></li> 

    <li class="list-group-item">
	  <a href="arrirepo.php">
                <p>
                <i class="lnr lnr-menu-circle"></i>&nbsp;Departure Report
                </p>
              </a></li>  

    <li class="list-group-item">
	  <a href="mirepo.php">
                <p>
                <i class="lnr lnr-menu-circle"></i>&nbsp;Mileage Report
                </p>
              </a></li>  

    <li class="list-group-item">
	  <a href="ductrepo.php">
                <p>
                <i class="lnr lnr-menu-circle"></i>&nbsp;Deduction Report
                </p>
              </a></li>  

    <li class="list-group-item">
	  <a href="custorepo.php">
                <p>
                <i class="lnr lnr-menu-circle"></i>&nbsp;Recovery Report
                </p>
              </a></li> 

    <li class="list-group-item">
	  <a href="currerepo.php">
                <p>
                <i class="lnr lnr-menu-circle"></i>&nbsp;Currency Report
                </p>
              </a></li>  

    <li class="list-group-item">
	  <a href="payreport.php">
                <p>
                <i class="lnr lnr-menu-circle"></i>&nbsp;Payment Report
                </p>
              </a></li>    

    <li class="list-group-item">
	  <a href="debtors.php">
                <p>
                <i class="lnr lnr-menu-circle"></i>&nbsp;Debtors Report
                </p>
              </a></li>      

    <li class="list-group-item">
	  <a href="girepo.php">
                <p>
                <i class="lnr lnr-menu-circle"></i>&nbsp;GPS Report
                </p>
              </a></li>      

    <li class="list-group-item">
	  <a href="girepo.php">
                <p>
                <i class="lnr lnr-menu-circle"></i>&nbsp;GPS Report
                </p>
              </a></li>          

    <li class="list-group-item">
	  <a href="trepo.php">
                <p>
                <i class="lnr lnr-menu-circle"></i>&nbsp;Target  Report
                </p>
              </a></li>         

    <li class="list-group-item">
	  <a href="trepo.php">
                <p>
                <i class="lnr lnr-menu-circle"></i>&nbsp;Target  Report
                </p>
              </a></li>         
                       
            </ul><br><br>
  </div>
                    
           
           
       
        <div class="col-lg-10">
                  <div class="row hidden-print">
		<div class="col-lg-4"> </div>  
         
           

        <form action="" method="post" class="form-horizontal ">                  
                       <div class="col-lg-8 no-print">
					   
					   <div class="col-lg-4 hidden-print"> 
					   
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
        <button class="btn  btn-primary btn-block" type="button" name="search"><i class="lnr lnr-magnifier"></i> Search</button>
                   
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
		&nbsp;&nbsp;&nbsp;&nbsp;<a href="#" id="exporttable" class="hidden-print" title='Export to excell' data-toggle='tooltip' data-placement='top'><i class="lnr lnr-line-spacing"></i></a></span>
            <div class="widget-container fluid-height clearfix">
            <div class="widget-content padded clearfix">

<div class="table-responsive">
			<table class="table table-striped table-hover table-sm" style="font-size:8px;" id="htmltable">     
                                      <thead>
                    <tr role="row"> 
					<th width='4px'> &nbsp;No&nbsp;</th>
		<th class="text-center" width='8%'> Vehicle </th>
		<th><div align='center'> Starting </th><th> Destination </th>
		<th> Final </th><th><div align='center'> ELD </th>
    <th><div align='center'> EAD </th><th> Location </th>
    <th width='6px'> Update </th><th width='5px'> Trip </th>
        </tr></thead><tbody>
		    <?php
					$n=1;
				while($roi=mysqli_fetch_assoc($doi)){
				    $veh=$roi['Vehicle'];
				    $pla=$roi['Plate'];
		
	$do=mysqli_query($conn, "SELECT *FROM `trips` WHERE `Vehicle`='$veh' AND `Status`='0' ORDER BY `Number` DESC LIMIT 1");
	if($fo=mysqli_num_rows($do)){
	    $ro=mysqli_fetch_assoc($do);
        $code=$ro['Number'];
        $name=$ro['Vehicle'];
        $dte=$ro['ETD'];
        $dest=$ro['Destin'];
        $final=$ro['Findes'];
        $date=$ro['Date'];
        $driver=$ro['Driver'];
        
        $etd=$ro['Stadate'];
        $ead=$ro['EAD'];
        $pla=$ro['Plate'];
		$eld=$ro['ELD'];
		$uploc=$ro['Uploc'];
		$uplod=$ro['Upload'];
		
        $std = date('Y-m-01', strtotime($Date));
    $seti=mysqli_query($conn, "SELECT `Number` FROM `trips` WHERE `Vehicle`='$veh' AND `Status`='0' AND `ETD`>='$std' ORDER BY `Number` DESC LIMIT 100");
	$tri=mysqli_num_rows($seti);
        }
    else{
    $etd=$etl=$ead=$ead=$dest=$final=$uploc=$uplod=$trip='';
        }
            $stl="style='padding:1px;'";

print("<tr><td $stl><div align='center'> $n&nbsp;</td><td $stl><div align='left'><button type='button' class='btn btn-xs btn-link' style='margin:0px; padding:0px;' data-toggle='modal' data-placement='top' data-target='#TrModal$n'>$pla</button></td><td $stl><div align='center'>$etd</td>

    <td $stl> $dest </td><td $stl>$final</td><td $stl><div align='center'> $eld </td><td $stl><div align='center'> $ead </td><td $stl> $uploc </td>
        <td $stl> $uplod </td><td $stl><div align='center'> $tri 



    <div class='modal fade' id='TrModal$n' tabindex='-1' role='dialog' aria-labelledby='exampleModalLabel' aria-hidden='true' style='top:80px;'>
  <div class='modal-dialog' role='document'>
    <div class='modal-content'><div class='modal-header text-left'>
    <h5 class='modal-title' id='exampleModalLabel'>LOCATION RECORD 
  <label style='float:right; text-align:right;'><b> $pla </b></label></h5>

      </div><form method='post' action=''>
    <div class='modal-body text-left' style='height:240px; padding-top:40px;'>
      
      <div class='col-md-12'>
      <div class='col-xs-6 text-center'> ESTIMETED LOADING DATE <br>
    <div class='input-group date' data-provide='datepicker'><input class='form-control form-center' name='eld' type='text' value='$eld' onkeypress='return isNumberKey(event)' required><span class='input-group-addon'><i class='lnr lnr-calendar-full'></i></span></div></div>
      
      
        <div class='col-xs-6 text-center'> ESTIMETED ARRIVAL DATE <br>
    <div class='input-group date' data-provide='datepicker'><input class='form-control form-center' name='ead' type='text' value='$ead' onkeypress='return isNumberKey(event)' required><span class='input-group-addon'><i class='lnr lnr-calendar-full'></i></span></div></div>
      
      
        </div><div class='row'></div><br><br><div class='col-md-12'>
      <div class='col-xs-6 text-center'> UPDATE LOCATION <br>
    <input class='form-control form-center' name='uploc' type='text' value='$uploc' OnKeyup='return cUpper(this);' required></div>
      
      
        <div class='col-xs-6 text-center'> UPDATE LOADING <br>
    <select class='form-control' name='uplod'>
    <option value='$uplod'> $uplod </option>
    <option value='WAITING'> WAITING </option>
    <option value='GOING'> GOING </option>
    <option value='RETURNING'> RUTERNING </option>
        </select></div>
      
      
      </div>
      
      
      </div><input type='hidden' name='code' value='$code'>
      <div class='modal-header text-right' style='margin-top:-10px; height:50px; padding-top:10px; border:0px solid blue;'>
        <button type='button' class='btn btn-sm btn-danger' data-dismiss='modal' style='width:80px;'> CANCEL </button>
        <button type='submit' name='upda' class='btn btn-sm btn-success' style='width:80px;'>UPDATE</button>
            </div></form>
        </div></div>
    </div></td></tr>");
    
    $n++;
    }
				?></tbody>
                  </table>
                  
                    </div></div></div></div></div>                 
               <div class="col-lg-12 hidden-print">
                   <span class="pull-right hidden-print">
            &nbsp;&nbsp;&nbsp;&nbsp;<a href="#" onclick="return window.print()" class="hidden-print" title='Print' data-toggle='tooltip' data-placement='top'><i class="lnr lnr-printer"></i></a>&nbsp;&nbsp;&nbsp;</span>
			 
			 </div> 
                          
                  </div>
      
   </div></div></div>
   <?php
   include'footer.php';
   ?>