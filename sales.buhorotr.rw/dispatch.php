<?php
if(basename($_SERVER['PHP_SELF']) == 'dispatch.php') 
  $cm=" class='current'";
include'header.php';
include'connection.php';
$dato=$datos=$Date;
$conde='';
$custo=$p=0;
$a=$b='';

if(isset($_POST['search']))
		{
			$dato=$_POST['dato'];
			$datos=$_POST['datos'];
			$custo=$_POST['custo'];
			$p=1;
		}
		
		if($custo=='0')
		    $a="selected";
		if($custo=='1'){
		    $b="selected";
		    $conde="AND `count`.`Qtin`!=`count`.`Qton`";
		}
		    

	if($dato==$datos)
			$mpri="ON $dato";
	else
		$mpri="FROM $dato TO $datos";

if($p=='0')
$do=mysql_query("SELECT `count`.`Qtin`, `count`,`Qton`, `count`.`Item`, `items`.* FROM `count` INNER JOIN `items` ON `count`.`Item`=`items`.`Number` ORDER BY `count`.`Number` DESC LIMIT 10");
else
$do=mysql_query("SELECT `count`.`Qtin`, `count`,`Qton`, `count`.`Item`, `items`.* FROM `count` INNER JOIN `items` ON `count`.`Item`=`items`.`Number` $conde WHERE `count`.`Date` BETWEEN '$dato' AND '$datos' ORDER BY `count`.`Number` DESC LIMIT 1400");
$fo=mysql_num_rows($do);
?>
<div class="container-fluid main-content">
        <div class="page-title hidden-print">
          <h2 style='margin-top:-20px; margin-bottom: 5px; color:#ffcc33'>
         Store Report
          </h2>
                 </div>
     
         <div class="row">
  <div class="col-lg-2 hidden-print">
   
   <ul class="list-group">

    <li class="list-group-item">
	  <a href="storeport.php">
                <p>
                <i class="lnr lnr-menu-circle"></i>&nbsp;Store Report
                </p>
              </a></li>  

	 <li class="list-group-item">
	  <a href="inrepo.php">
                <p>
                <i class="lnr lnr-menu-circle"></i>&nbsp;S.In Report
                </p>
              </a></li>  
      
    <li class="list-group-item">
	  <a href="outrepo.php">
                <p>
                <i class="lnr lnr-menu-circle"></i>&nbsp;S.Out Report
                </p>
              </a></li>  

			   <li class="list-group-item">
              <a href="transrepo.php">
                <p>
                <i class="lnr lnr-menu-circle"></i>&nbsp;Transfer Report
                </p>
              </a></li>

			   <li class="list-group-item">
              <a href="delirepo.php">
                <p>
                <i class="lnr lnr-menu-circle"></i>&nbsp;Delivery Report
                </p>
              </a></li> 
			  
			   <li class="list-group-item">
              <a href="recerepo.php">
                <p>
                <i class="lnr lnr-menu-circle"></i>&nbsp;Receiving Report
                </p>
              </a></li>

			  <li class="list-group-item">
              <a href="purrepo.php">
                <p>
                <i class="lnr lnr-menu-circle"></i>&nbsp;Purchase Report
                </p>
              </a></li>  

	 <li class="list-group-item active">
	  <a href="dispatch.php">
                <p>
                <i class="lnr lnr-menu-circle"></i>&nbsp;Count Report
                </p>
              </a></li>       

	 <li class="list-group-item">
	  <a href="stobal.php">
                <p>
                <i class="lnr lnr-menu-circle"></i>&nbsp;Item Report
                </p>
              </a></li>  
                         
            </ul>
  </div>     
                    
           
           
       
        <div class="col-lg-10">
                  <div class="row">
         
           <div class="col-lg-4"> </div>
          
         
           

        <form action="" method="post" class="form-horizontal ">                  
                       <div class="col-lg-8 hidden-print"><div class="col-lg-3"> 
					   
			   <select class="form-control" name="custo">
			   <option value='0' <?php echo $a ?>>ALL ITEMS</option>
			   <option value='1' <?php echo $b ?>>BALANCED</option></select>
					   
					   </div>
            <div class="col-lg-3"> 
           <div class="input-group date datepicker">
      <input class="form-control form-center" id="from" name="dato" type="text" value="<?php echo $dato ?>" onkeypress='return isNumberKey(event)' required>
	  <span class="input-group-addon"><i class="lnr lnr-calendar-full"></i></span>
			</div></div>

		  <div class="col-lg-3"> 
           <div class="input-group date datepicker">	
      <input class="form-control form-center" id="to" name="datos" type="text" value="<?php echo $datos ?>" onkeypress='return isNumberKey(event)' required>
	  <span class="input-group-addon"><i class="lnr lnr-calendar-full"></i></span>
              </div></div> 
                       
                       <div class="col-lg-2">
                        <button class="btn  btn-primary btn-block" type="submit" name="search"><i class="lnr lnr-magnifier"></i> Search</button>
                   
					  </div>
                         </div> 
                      
                     
                  
            </form> 
             
               
            </div>

			<div class="divFooter"><center><u><b>DISPATCH REPORT <?php echo $mpri ?></b></u></center></div>
             <div class="row">
            <div class="col-lg-12">
             <span>  <b><?php echo" $fol " ?></b></span>
			 <span class="pull-right"><b> &nbsp;&nbsp; </b>
			 &nbsp;&nbsp;&nbsp;&nbsp;<a href="#" onclick="return window.print()" class="hidden-print" title='Click to open delivery voucher' data-toggle='tooltip' data-placement='top'><i class="lnr lnr-printer"></i></a></span>
            <div class="widget-container fluid-height clearfix">
            <div class="widget-content padded clearfix">
               
                                 <div class='table-responsive'><table class="table table-striped table-hover">     
                                      <thead>
                                     <tr role="row">
                     <th class="hidden-xs"> No </th>
                       <th> Brand&nbsp;Name </th>
                       <th> Item&nbsp;Name </th>
                        <th> Description </th>
						 <th> Cost Price </th>
                         <th> Sales&nbsp;Price </th>
                        <th><div align='center'> S.Count </th>
                        <th><div align='center'> I.Count </th>
						<th><div align='center'> Balance </th></tr>
                    </thead>
                                        <tbody>
					<?php
					$n=1;		
			while($ro=mysql_fetch_assoc($do)){
				$code=$ro['Number'];
				$item=$ro['Item'];
			$qt=$ro['Qtin'];				$qty=number_format($qt, 2);	
			$qo=$ro['Qton'];                $qto=number_format($qo, 2);

	$stn="padding:1px;";                   $balo=number_format($qo-$qt);
				
	$dox=mysql_query("SELECT *FROM `items` WHERE `Number`='$item' ORDER BY `Number` ASC");
		$rox=mysql_fetch_assoc($dox);
			$iname=$rox['Iname'];
			$kin=$rox['Type'];
			$descri=$rox['Descri'];
			$uno=$rox['Unit'];			
			$cost=$rox['Cost'];			$costo=number_format($cost, 2);		
			$pri=$rox['Price'];			$prio=number_format($pri, 2);

    $doi=mysql_query("SELECT *FROM `itype` WHERE `Number`='$kin' ORDER BY `Number` ASC");
		$roi=mysql_fetch_assoc($doi);
				$type=$roi['Type'];

		print("<tr><td class='hidden-xs' style='$stn'>
                        <div align='center'>$n&nbsp;&nbsp;</td>
                        <td style='$stn'> $type </td>
						<td style='$stn'> $iname </td>
						<td style='$stn'> $descri </td>
                        <td style='$stn'><div align='right'> $costo </td>
						<td style='$stn'><div align='right'> $prio </td>
						<td style='$stn'><div align='right'> $qty </td>
						<td style='$stn'><div align='right'> $qto </td>
						<td style='$stn'><div align='right' style='padding-right:20px;'> $balo </td></tr>");
						  $n++;
						}
						$toto=number_format($tot);			$tco=number_format($tco);
						?>
						
                    </tbody>
                  </table><br></div>                   
                
              </div>
            </div></div>
                  </div> <span class="pull-right">
			 &nbsp;&nbsp;&nbsp;&nbsp;<a href="#" onclick="return window.print()" class="hidden-print" title='Click to open delivery voucher' data-toggle='tooltip' data-placement='top'><i class="lnr lnr-printer"></i></a></span>
      
   </div></div></div>
 
   <?php
   include'footer.php';
   ?>
