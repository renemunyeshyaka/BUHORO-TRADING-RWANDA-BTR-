<?php
if(basename($_SERVER['PHP_SELF']) == 'bankrepo.php') 
  $cm=" class='current'";
include'header.php';
include'connection.php';
$dato=$datos=$Date;
$custo=$conde='';
$p=$depart=0;


// search for an item to be added to the chart
if(isset($_POST['search']))
		{
			$dato=$_POST['dato'];
			$datos=$_POST['datos'];
			$p=1;
		}

if(isset($_POST['back']))
		{
			$dato=$_POST['dato'];
			$datos=$_POST['datos'];
			$p=$_POST['p'];
		}

		// *************************** Open a given payroll *************************************
if(isset($_POST['open_id']))
		{
			$mt=$_POST['mt'];
			$yr=$_POST['yr'];			
			$sd=$_POST['std'];			
			$ed=$_POST['end'];
			$po=$_POST['po'];
			$dato=$_POST['dato'];
			$datos=$_POST['datos'];
			$p=2;
		}
		
		
		// *************************** Select from a given payroll *************************************
if(isset($_POST['open_se']))
		{
			$mt=$_POST['mt'];
			$yr=$_POST['yr'];			
			$sd=$_POST['std'];			
			$ed=$_POST['end'];
			$po=$_POST['po'];
			$dato=$_POST['dato'];
			$datos=$_POST['datos'];
			$depart=$_POST['depart'];
			$p=2;
		}
		
		$_SESSION['Dato']=$dato;
		$_SESSION['Datos']=$datos;
		$_SESSION['Mt']=$mt;
		$_SESSION['Yr']=$yr;
		$_SESSION['Sd']=$sd;
		$_SESSION['Ed']=$ed;
		$_SESSION['Po']=$po;
		$_SESSION['Depart']=$depart;
		$_SESSION['P']=$p;
	
	if($dato==$datos)
			$mpri="ON $dato";
		else
			$mpri="FROM $dato TO $datos";
			
			    if($depart)
			        $conde="AND `Depart`='$depart'";
			    else
			        $conde="";
?>
<div class="container-fluid main-content">
        <div class="page-title hidden-print">
          <h3 style='margin-top:-20px; margin-bottom: 5px; color:#ffcc33'>
         Payroll Report
          </h3>
                 </div>
     
        <div class="row">
  <div class="col-lg-2 hidden-print">
   
  <ul class="list-group">   

    <li class="list-group-item">
	  <a href="rollrepo.php">
                <p>
                <i class="lnr lnr-menu-circle"></i>&nbsp;Payroll Report
                </p>
              </a></li> 
              
     <li class="list-group-item">
	  <a href="payerepo.php">
                <p>
                <i class="lnr lnr-menu-circle"></i>&nbsp;Payroll Report & PAYE
                </p>
              </a></li>   

    <li class="list-group-item active">
	  <a href="bankrepo.php">
                <p>
                <i class="lnr lnr-menu-circle"></i>&nbsp;Payroll Report & BANK
                </p>
              </a></li>     

    <li class="list-group-item">
	  <a href="handrepo.php">
                <p>
                <i class="lnr lnr-menu-circle"></i>&nbsp;Payroll Report & HAND
                </p>
              </a></li> 

    <li class="list-group-item">
	  <a href="adrepo.php">
                <p>
                <i class="lnr lnr-menu-circle"></i>&nbsp;Advance Report
                </p>
              </a></li>  

    <li class="list-group-item">
	  <a href="allrepo.php">
                <p>
                <i class="lnr lnr-menu-circle"></i>&nbsp;Allowance Report
                </p>
              </a></li>

	 <li class="list-group-item">
	  <a href="derepo.php">
                <p>
                <i class="lnr lnr-menu-circle"></i>&nbsp;Deduction Report
                </p>
              </a></li>    

<li class="list-group-item">
	  <a href="payrepo.php">
                <p>
                <i class="lnr lnr-menu-circle"></i>&nbsp;Payment Report
                </p>
              </a></li>     

<li class="list-group-item">
	  <a href="erepo.php">
                <p>
                <i class="lnr lnr-menu-circle"></i>&nbsp;Employees Report
                </p>
              </a></li>  
                         
            </ul>
  </div>
                    
    <?php       
    if($p==2){
    ?>
    <form action="" method="post" class="form-horizontal "> 
        <div class="col-lg-10">
                  <div class="row">

				  <div class="col-lg-1"> </div>
         
           <div class="col-lg-2 hidden-print"><?php
		 if($p==2)
			echo"<input type='hidden' value='$po' name='p'><input type='hidden' value='$dato' name='dato'>
			<input type='hidden' value='$datos' name='datos'><button class='btn  btn-warning btn-block' type='submit' name='back'>
			&nbsp;&nbsp; <span class='lnr lnr-chevron-left'></span><span class='lnr lnr-chevron-left'></span> &nbsp;&nbsp; 
			 Back&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</button>";
		 ?></div> <div class="col-lg-1"> </div>
           

                         
                       <div class="col-lg-8 hidden-print"><div class="col-lg-3">

					   </div>
            <div class="col-lg-3"> 
          <?php
        echo"<input type='hidden' value='$mt' name='mt'>
						<input type='hidden' value='$yr' name='yr'>
						<input type='hidden' value='$std' name='std'>
						<input type='hidden' value='$p' name='po'>
						<input type='hidden' value='$dato' name='dato'>
						<input type='hidden' value='$datos' name='datos'>
						<input type='hidden' value='$end' name='end'>";  
          ?></div>


		  <div class="col-lg-3"> 	
     <select class="form-control" name="depart">
         <option value=''>ALL</option>
			  <?php
		$de=mysql_query("SELECT *FROM `depart` ORDER BY `Number` ASC");
			  while($re=mysql_fetch_assoc($de)){
					$ne=$re['Number'];
					$dep=$re['Depart'];
					if($ne==$depart)
						$sed="selected=selected'";
					else
						$sed="";
			echo"<option value='$ne' $sed>$dep</option>";
			  }
			  ?>
                            </select>
	 
              </div>                     
                       
                       <div class="col-lg-2">
                        <button class="btn  btn-primary btn-block" type="submit" name="open_se"><i class="lnr lnr-magnifier"></i> Search</button>
                   
					  </div>
                         </div> 
               <?php
    }
    else{
        ?>
     <form action="" method="post" class="form-horizontal "> 
        <div class="col-lg-10">
                  <div class="row">

				  <div class="col-lg-1"> </div>
         
           <div class="col-lg-2 hidden-print">
           
           </div> <div class="col-lg-1"> </div>
           

                         
                       <div class="col-lg-8 hidden-print"><div class="col-lg-3">

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
     <?php   
    }
    ?>
                     
                  
            </form> 
             
               
            </div>
            
			    <?php
               $_SESSION['excel']='bankrepos.php';		
               $_SESSION['filename']="PAYROLL REPORT FOR $mt $yr.xls";
            include'bankrepos.php';
                ?>       
				
              </div>
            </div></div>
                  </div>                  
                <span class="pull-right hidden-print">
			 <a href="#" onclick="return window.print()" class="hidden-print" title='Click to print' data-toggle='tooltip' data-placement='top'><i class="lnr lnr-printer"></i></a></span>
			 
			  <span class="pull-right hidden-print"><a href='#' onclick=window.location.href='data.php' title='Export to Excel' data-toggle='tooltip' data-placement='top'><i class="lnr lnr-line-spacing"></i></a> &nbsp;&nbsp; </span>
      
   </div></div></div>  
   <?php
   include'footer.php';
   ?>