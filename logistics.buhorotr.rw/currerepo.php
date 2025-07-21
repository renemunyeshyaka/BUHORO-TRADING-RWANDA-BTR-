<?php
if(basename($_SERVER['PHP_SELF']) == 'currerepo.php') 
  $cm=" class='current'";
include'header.php';
include'connection.php';
$custo=$conde=$condi='';
$dato=$datos=$Date;
$p=0;

if(isset($_POST['search']))
		{
			$dato=$_POST['dato'];
			$datos=$_POST['datos'];
			$p=1;
		}
		
		if($dato!=$datos)
		    $mpri="FROM $dato TO $datos";
		else
		    $mpri="ON $dato";

		if($p=='0')
$doj=mysqli_query($conn, "SELECT *FROM (SELECT *FROM `moves` WHERE `Type`='RATE' ORDER BY `Date` DESC LIMIT 15) SUB ORDER BY `Number` ASC");
        else
$doj=mysqli_query($conn, "SELECT *FROM `moves` WHERE `Type`='RATE' AND `Date` BETWEEN '$dato' AND '$datos' ORDER BY `Number` ASC");
$fo=mysqli_num_rows($doj);
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

    <li class="list-group-item">
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

    <li class="list-group-item active">
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
	  <a href="trepo.php">
                <p>
                <i class="lnr lnr-menu-circle"></i>&nbsp;Target  Report
                </p>
              </a></li>     
              
              </ul>
  </div>
           
           
       
        <div class="col-lg-10">
                  <div class="row hidden-print">
         
           <div class="col-lg-4"> </div>
          
         
           

        <form action="" method="post" class="form-horizontal ">                  
                       <div class="col-lg-8 no-print"><div class="col-lg-3"> 					
					   
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

			<div class="divFooter"><center><u><b>CURRENCY REPORT <?php echo $mpri ?></b></u></center></div>
             <div class="row">
            <div class="col-lg-12" style='margin-top:-20px;'>
             <span>Total Records Found : <b><?php echo" $fo " ?></b></span>
			  <span class="pull-right">&nbsp;&nbsp; <a href="#" onclick="return window.print()" class="hidden-print" title='Print' data-toggle='tooltip' data-placement='top'><i class="lnr lnr-printer"></i></a>&nbsp;&nbsp;&nbsp;</span>
			  
			  <span class="pull-right hidden-print">
		&nbsp;&nbsp;&nbsp;&nbsp;<a href="#" id="exporttable" class="hidden-print" title='Export to excell' data-toggle='tooltip' data-placement='top'><i class="lnr lnr-line-spacing"></i></a></span>
            <div class="widget-container fluid-height clearfix">
            <div class="widget-content padded clearfix">

			<table class="table table-striped table-hover table-sm" style="font-size:8px;" id="htmltable"><thead>
        <tr role="row"><th width='10%' class='text-center'> No </th>
            <th class='text-center' width='18%'>Date&nbsp;&&nbsp;Time</th>
                        <th> System&nbsp;User </th>
                        
                        <?php 
                        $k=1;           $curr=array();
$curre=mysqli_query($conn, "SELECT `Location` FROM `moves` WHERE `Type`='RATE' AND `Location`!='' GROUP BY `Location` ORDER BY `Location` ASC");
while($rurre=mysqli_fetch_assoc($curre)){
    $cu=$rurre['Location'];
    echo"<th class='text-center'> $cu&nbsp;&nbsp;&nbsp;&nbsp;</th>";
    $curr[$k]=$cu;
    $k++;
}
   ?>                   
   
   </tr>
                    </thead><tbody>
		<?php
					$n=1;			
while($ro=mysqli_fetch_assoc($doj)){
$code=$ro['Number'];
$name=$ro['User'];
$dte=$ro['Date'];
$tme=$ro['Time'];

$stl="style='padding:1px;'";

print("<tr><td $stl><div align='center'>$n&nbsp;</td>
<td class='text-center' $stl> $dte&nbsp;&nbsp;$tme </td><td $stl>$name</td>");
for($i=1; $i<$k; $i++){
    $cuso=$curr[$i];
$see=mysqli_query($conn, "SELECT `Desciption` FROM `moves` WHERE `Number`='$code' AND `Location`='$cuso' AND `Type`='RATE'");
    if($fee=mysqli_num_rows($see)){
        $ree=mysqli_fetch_assoc($see);
        $co=$ree['Desciption'];
    }
    else
        $co="";
  echo"<td $stl class='text-center'> $co &nbsp;</td>";      
}

print("</tr>");
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