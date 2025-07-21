<?php
if(basename($_SERVER['PHP_SELF']) == 'ilist.php') 
  $bb=" class='current'";
include'header.php';
include'connection.php';
$custo=$type='';
$conde=$cond='';

if(isset($_POST['delo']))
		{
			$rowid=$_POST['rowid'];
			$custo=$_POST['custo'];
			$type=$_POST['type'];
			$then=mysql_query("UPDATE `items` SET `Status`='1' WHERE `Number`='$rowid' LIMIT 1");
		}

if(isset($_POST['search']))
		{
			$custo=$_POST['custo'];
			$type=$_POST['type'];
		}

		
		if($custo){
			$conde="AND (`Iname` LIKE '%$custo%' OR `Descri` LIKE '%$custo%')";
			$lim=999999999;
		}
		else{
			$conde='';
			$lim=1000;
		}

		if($type)
			$cond="AND `Number`='$type'";
		else
			$cond="";

$do=mysql_query("SELECT *FROM `items` WHERE `Store`='3' AND `Status`='0' $conde ORDER BY `Iname` ASC LIMIT $lim");
$fo=mysql_num_rows($do);
?>
<div class="container-fluid main-content">
        <div class="page-title">
          <h2 style='margin-top:-20px; margin-bottom: 5px; color:#ffcc33'>
         Branches
          </h2>
                 </div>
     
        <div class="row">
  <div class="col-lg-2 hidden-print">
   
   <ul class="list-group">

    <li class="list-group-item active">
	  <a href="ilist.php">
                <p>
                <i class="lnr lnr-menu-circle"></i>&nbsp;Sales Items
                </p>
              </a></li>

	   <li class="list-group-item">
              <a href="stobranch.php">
                <p>
                <i class="lnr lnr-plus-circle"></i>&nbsp;Store Status
                </p>
              </a></li>       
                       
            </ul><br><br>
  </div>
                    
           
           
       
        <div class="col-lg-10">
                  <div class="row">
         
           <div class="col-lg-2"> </div>
          
         
           

        <form action="" method="post" class="form-horizontal ">                  
                       <div class="col-lg-10 no-print"><div class="col-lg-3"> 					
					   
					   </div>
            <div class="col-lg-3"> 
      <input class="form-control"  name="custo" type="text" id="searchi" autofocus="autofocus">
			</div>

		<div class="col-lg-3"> 					   
			   <select class="form-control" name="type">
				<option value='' selected='selected'> SELECT TYPE </option>
		
		<?php			
	$dois=mysql_query("SELECT *FROM `itype` WHERE `Location`='1' AND `Date`!='' GROUP BY `Type` ORDER BY `Type` ASC");
			while($rois=mysql_fetch_assoc($dois)){
				$fna=$rois['Type'];
				$inu=$rois['Number'];
			echo"<option value='$inu' $t> $fna </option>";
			}
			?>		</select>
					   
					   </div>                      
                       
                       <div class="col-lg-2">
                        <button class="btn  btn-primary btn-block" type="submit" name="search"><i class="lnr lnr-magnifier"></i> Search</button>
                   
					  </div>
                         </div></form>            
               
            </div>
			<?php
			if($do){
				?>
             <div class="row">
            <div class="col-lg-12" style='margin-top:-20px;'>
             <span> Total Records Founds : <b><?php echo" $fo " ?></b></span>
            <div class="widget-container fluid-height clearfix">
            <div class="widget-content padded clearfix">
               
                               <table class="table table-striped">     
                                      <thead>
                    <tr role="row">
                     <th class="hidden-xs"> NO </th>
                       <th> Item&nbsp;Name </th>
                        <th> Description </th>
                       <th> Item&nbsp;Type </th>
						 <th> Price/Unit </th>
                       <th> Count&nbsp;Unit </th>
                        <th><div align='center'> Quantity </th>
                        <th class="hidden-xs hidden-print" style="width:20px; text-align:center;" colspan='2'> Options </th>
                     </tr>
                    </thead>
                                        <tbody>
					<?php
		$doi=mysql_query("SELECT *FROM `itype` WHERE `Location`='1' AND `Items`!='0' $cond GROUP BY `Type` ORDER BY `Number` ASC");
			while($roi=mysql_fetch_assoc($doi)){
				$type=$roi['Type'];
				$ity=$roi['Number'];

	
		$do=mysql_query("SELECT *FROM `items` WHERE `Store`='3' AND `Status`='0' AND `Type`='$ity' $conde ORDER BY `Iname` ASC LIMIT $lim");
			$fo=mysql_num_rows($do);
			$then=mysql_query("UPDATE `itype` SET `Items`='$fo' WHERE `Number`='$ity' AND `Items`!='$fox' LIMIT 1");


				if(!$custo)
				echo"<thead>
                    <tr role='row'>
                     <th class='hidden-xs' style='background-color:powderblue;'> </th>
						 <th colspan='6' style='background-color:powderblue;'> $type </th>
							<th class='hidden-xs hidden-print text-center' colspan='2' style='background-color:powderblue;'> $fo </th>
								</tr></thead>";

					$n=1;
						while($ror=mysql_fetch_assoc($do)){
						$code=$ror['Number'];
						$iname=$ror['Iname'];
						$sale=$ror['Price'];			
						$cost=$ror['Cost'];	
						$qty=$ror['Quantity'];
						$dte=$ror['Date'];
						$uno=$ror['Unit'];
						$descri=$ror['Descri'];

				$dox=mysql_query("SELECT *FROM `unit` WHERE `Number`='$uno' ORDER BY `Number` ASC");
					$rox=mysql_fetch_assoc($dox);
							$unit=$rox['Unit'];

			$costo=number_format($cost, 2);			$prio=number_format($sale, 2);

			$ite="$item|$qty";

			$doki=mysql_query("SELECT *FROM `requis` WHERE `Produce`='$voi' AND `Status`='0' AND `Upda`='1' ORDER BY `Number` ASC");
					if($foki=mysql_num_rows($doki)){
						$hr="";
						$bt='disabled';
					}
					else{
						$hr="<a href='oper.php?prodele=$code'>";
						$bt='';
					}
if($cost=='0'){
$clr="style='color:blue;'";
$clri="color:blue;";
}
else{
$clr='';
$clri='';
}

       $b=$n*10;
				print("<tr>
                        <td class='hidden-xs' $clr><div align='center'>$n&nbsp;&nbsp;</td>
						<td $clr> $iname </td><td $clr> $descri </td><td $clr> $type </td>
						<td $clr><div align='right'> $costo&nbsp;/&nbsp;$prio </td><td $clr> $unit </td>
						
						<td $clr><div align='right'><input name='qty$n' class='form-control' type='text' onkeyup='minusBy$n();' onkeypress='return isNumberKey(event)' style='text-align:center; width:80px; height:22px; margin:0px 0px 0px 0px; background-color:transparent; border:0px;' id='box$n' value='$qty' readonly='readonly'></td>	
						
						<form method=post action='creteb.php'><td class='hidden-xs hidden-print' align='right' style='width:40px; padding:0px;'>
                              <input type='hidden' name='rowid' value='$code'>
                          <button type='submit' class='btn btn-xs btn-warning hidden-print' name='open' style='height:18px; padding:0px;' title='Edit' data-toggle='tooltip' data-placement='top'>
						  &nbsp;&nbsp;<i class='lnr lnr-pencil'></i>&nbsp;&nbsp;</button></td></form>
						  
						  <form action='' method='post'><td class='hidden-xs hidden-print' align='right' style='width:40px; padding:0px; $clri'>
                          <input type='hidden' name='rowid' value='$code'><input type='hidden' name='custo' value='$custo'>
                          <input type='hidden' name='type' value='$type'><button type='submit' name='delo' class='btn btn-xs btn-danger hidden-print' style='height:18px; padding:0px;' title='Delete' data-toggle='tooltip' data-placement='top'>&nbsp;&nbsp;<i class='lnr lnr-trash'></i>&nbsp;&nbsp;</button></td></form></tr>");
						  $n++;
						}
			}
						$toto=number_format($tot);			$tco=number_format($tco);
						?>
						
                    </tbody>
                  </table>

                   <div class="row">
                  <div class="col-lg-9"></div><div class="col-lg-3">
                

              </div></div></form> 
			  
			  <?php
				}
					else{
						echo"<div class='row'>
            <div class='col-lg-12' style='margin-top:-20px;'>
             <span> Total Records Founds : <b> $vout </b></span>
            <div class='widget-container fluid-height clearfix'>
            <div class='widget-content padded clearfix'>
			<br><br><br><br><br><br>
						<div style='text-align:center; font-size:24px; color:#ff9999'>There is no pending production </div><br><br><br><br><br><br><br>";
					}
					?>
                
              </div>
            </div></div>
                  </div>
      
   </div></div></div>  
   <?php
   include'footer.php';
   ?>
