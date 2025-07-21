<?php
if(basename($_SERVER['PHP_SELF']) == 'wiserepo.php') 
  $cm=" class='current'";
include'header.php';
$custo=$conde='';


    if(isset($_POST['search']))
		{
		$pieces = explode(" ", $_POST['custo']);
			$s1=$pieces[0]; // piece1
			$s2=$pieces[1]; // piece2
			$s3=$pieces[2]; // piece3
			$s4=$pieces[3]; // piece4
		    
		$conde="SELECT `items`.* FROM `items` WHERE (`items`.`Iname` LIKE '%".$s1."%' AND `items`.`Status` = '0' AND `items`.`Iname` LIKE '%".$s2."%' AND `items`.`Iname` LIKE '%".$s3."%' AND `items`.`Iname` LIKE '%".$s4."%') GROUP BY `items`.`Iname` ORDER BY `items`.`Iname` ASC";
		}
		else
			$conde="SELECT `itype`.`Type` AS `Typo`, `items`.* FROM `items` INNER JOIN `itype` ON `items`.`Type` = `itype`.`Number` WHERE `items`.`Status`='0' ORDER BY `itype`.`Type` ASC, `items`.`Iname` ASC LIMIT 1400";

$do=mysql_query("$conde");
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

	 <li class="list-group-item">
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

	 <li class="list-group-item active">
	  <a href="wiserepo.php">
                <p>
                <i class="lnr lnr-menu-circle"></i>&nbsp;Stock-Wise Report
                </p>
              </a></li>   
                         
            </ul>
  </div>
                    
           
           
       
        <div class="col-lg-10">
                  <div class="row">
         
           <div class="col-lg-2 hidden-print"> </div>
          
         
           

        <form action="" method="post" class="form-horizontal ">                  
                       <div class="col-lg-10 hidden-print">
		<div class="col-lg-5 hidden-print"> 					
					   
					   </div>
            <div class="col-lg-4 hidden-print"> 
     	<input class="form-control form-left" id="searchu" name="custo" type="text" value="<?php echo $custo ?>" placeholder="Item Name">		   
		        </div><div class="col-lg-2">
        <button class="btn  btn-primary btn-block" type="submit" name="search"><i class="lnr lnr-magnifier"></i> Search</button>
                   
					  </div>
                </div></div>
            </form> 
             
			<div class="divFooter"><center><u><b>STOCK-WISE REPORT ON <?php echo $Date ?></b></u></center></div>

             <div class="row">
            <div class="col-lg-12" style='margin-top:-20px;'>
             <span> &nbsp;&nbsp; Total Records Found : <b><?php echo" $fo " ?></b></span>
			 <span class="pull-right hidden-print">&nbsp;&nbsp;&nbsp;&nbsp;<a href="#" onclick="return window.print()" class="hidden-print" title='Click to print' data-toggle='tooltip' data-placement='top'><i class="lnr lnr-printer"></i></a></span>
            <div class="widget-container fluid-height clearfix">
            <div class="widget-content padded clearfix">
               
                <table class="table table-striped table-hover">     
                    <thead><tr role="row"><th class="text-center"> No </th>
                       <th class="text-center"> ITEM&nbsp;TYPE </th>
                       <th class="text-center"> ITEM&nbsp;NAME </th>
                       <th class="text-center"> COST&nbsp;PRICE </th>
                       <th class="text-center"> SALES&nbsp;PRICE </th>
                    <?php
            $seda=mysql_query("SELECT *FROM `stores` WHERE `Status`>='0' ORDER BY `Number` ASC");
                    $dta=$clo=$dna=array();          $a=1;
            while($reda=mysql_fetch_assoc($seda)){
                $dnam=$reda['Name'];
                $dcon=$reda['Store'];
                $dta[$a]=$dcon;       
                $col=$reda['Color'];
                $clo[$a]=$col;
                $dna[$a]=$dnam;
                echo"<th class='text-center text-$col'> $dnam </th>";
                    $a++;
                }
        ?>
    <th class="text-center"> TOTAL&nbsp;QTY </th></tr></thead>
            <tbody>
					<?php
						$n=1;	                $gto=0;
		while($ro=mysql_fetch_assoc($do)){
			$code=$ro['Number'];
			$iname=$ro['Iname'];
			$type=$ro['Typo'];
			$uno=$ro['Unit'];			
			$cos=$ro['Cost'];			        $coso=number_format($cos, 2);
			$qt=$ro['Quantity'];				$qty=number_format($qt, 2);		
			$pri=$ro['Price'];			        $prio=number_format($pri, 2);
			$tot=0;

				$stn="padding:0px;";

		$dox=mysql_query("SELECT *FROM `unit` WHERE `Number`='$uno' ORDER BY `Number` ASC");
				$rox=mysql_fetch_assoc($dox);
					$unit=$rox['Unit'];
		
		print("<tr><td class='text-center' style='$stn'>$n&nbsp;&nbsp;</td>
            <td style='$stn'> $type </td><td style='$stn'> $iname </td>
                <td style='$stn'><div align='right'> $coso </td>
			<td style='$stn'><div align='right'> $prio </td>");
		
		for($i=1; $i<$a; $i++){                 
		    $na=$dta[$i];
		    $co=$clo[$i];
		    $dn=$dna[$i];
		    
			$qt=$ro["$na"];               $qto=number_format($qt, 2);
		echo"<td style='$stn' class='text-right text-$co' title='$dn' data-toggle='tooltip' data-placement='top'> $qto </td>";
		   
		 $tot+=$qt;            $isto[$i]+=$qt;
		}
		            $toto=number_format($tot, 2);
	print("<td style='$stn'><div align='right'><b> $toto </td></tr>");
	        $n++;                     $gto+=$tot;
						}	   
	
		?>
						
                    </tbody>
                  </table><br>

                  </div></div>   
				  <span class="pull-right hidden-print">
			 &nbsp;&nbsp;&nbsp;&nbsp;<a href="#" onclick="return window.print()" class="hidden-print" title='Click to print' data-toggle='tooltip' data-placement='top'><i class="lnr lnr-printer"></i></a></span>                       
              
            </div></div>
                  </div>
      
   </div></div></div>  
   <?php
   include'footer.php';
   ?>
