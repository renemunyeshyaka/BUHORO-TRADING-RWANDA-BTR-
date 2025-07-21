<?php
if(basename($_SERVER['PHP_SELF']) == 'upitem.php') 
  $bb=" class='current'";
include'header.php';
include'connection.php';
$pto=0;
$rowid=0;

$btne="<br><button class='btn btn-lg btn-block btn-success' type='submit' name='addo'>
	<i class='lnr lnr-arrow-up-circle'></i>&nbsp;&nbsp;UPLOAD </button>";

require_once('excel_reader2.php');
require_once('SpreadsheetReader.php');

if (isset($_POST["addo"]))
{
   $finame=$_POST['finame'];
				$finame=str_replace("'", "`", $finame);
			$descri=$_POST['descri'];
				$descri=str_replace("'", "`", $descri);
			$donel=$_POST['donel'];
	$n=1;    $T=$P=1;
//  $allowedFileType = ['application/vnd.ms-excel','text/xls','text/xlsx','application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'];
 
  if($_FILES["file"]["type"]){
        $targetPath = 'uploads/'.$_FILES['file']['name'];
        move_uploaded_file($_FILES['file']['tmp_name'], $targetPath);
        
        $Reader = new SpreadsheetReader($targetPath);
        
        $sheetCount = count($Reader->sheets());
        for($i=0;$i<$sheetCount;$i++)
        {
            
            $Reader->ChangeSheet($i);
            
            foreach ($Reader as $Row)
            {
          
                $name = "";
                if(isset($Row[1])) {
                    $name = mysql_real_escape_string($Row[1]);
				$name=str_replace("'", "`", $name);
                } 
                
                $des = "";
                if(isset($Row[2])) {
                    $des = mysql_real_escape_string($Row[2]);
				$des=str_replace("'", "`", $des);
                }
                
                $description = "";
                if(isset($Row[3])) {
                    $description = mysql_real_escape_string($Row[3]);
				$description=str_replace("'", "`", $description);
		$doi=mysql_query("SELECT *FROM `itype` WHERE `Location`='0' AND `Type` = '$description' ORDER BY `Number` DESC");
			if(!$foi=mysql_num_rows($doi) AND $description!=''){
	$so=mysql_query("INSERT INTO `itype` (`Type`, `Date`, `Location`) VALUES ('$description', '$Date', '0')");
			}

			$doil=mysql_query("SELECT *FROM `itype` WHERE `Location`='0' AND `Type` = '$description' ORDER BY `Number` DESC");
				$roil=mysql_fetch_assoc($doil);
					$code=$roil['Number'];
                }

				 $cost = "";
                if(isset($Row[4])) {
                    $cost = mysql_real_escape_string($Row[4]);
				$cost=str_replace(',', '', $cost);
                }

				 $price = "";
                if(isset($Row[5])) {
                    $price = mysql_real_escape_string($Row[5]);
				$price=str_replace(',', '', $price);
                }

				 $qty = "";
                if(isset($Row[6])) {
                    $qty = mysql_real_escape_string($Row[6]);
				$qty=str_replace(',', '', $qty);
                }

				 $eco = "";
                if(isset($Row[7])) {
                    $eco = mysql_real_escape_string($Row[7]);
				$eco=str_replace(',', '', $eco);
                }
                
                if (!empty($name) AND !$n!='1') {
	$doit=mysql_query("SELECT *FROM `items` WHERE `Iname` = '$name' AND `Store`='1' AND `Price`='$price' ORDER BY `Number` DESC LIMIT 1");
			if(!$foit=mysql_num_rows($doit) AND $name!=''){
      $doix="INSERT INTO `items` (`Date`, `User`, `Iname`, `Descri`, `Cost`, `Price`, `Store`, `Unit`, `Type`, `Quantity`, `Ecode`) VALUES ('$Date', '$loge', '$name', '$des', '$cost', '$price', '1', '7', '$code', '$qty', '$eco')";					
				$T++;
							}
							else
								echo"&nbsp;";
                
				$result=mysql_query($doix);
                    if (!empty($result)) {
                        $pto=10;       
						$px=$T;
                        $message = "Excel Data Imported into the Database";
                    } else {
                        $pto=40;
                        $message = "Problem in Importing Excel Data";
                    }
					$n++;
                }
             }
        
         }
		 $finame=$descri='';
  }
  else
  { 
        $pto=40;
        $message = "Invalid File Type. Upload Excel File.";
		}
}

?>

<style type="text/css">
#Style {
position:absolute;
visibility:hidden;
border:solid 1px #CCC;
padding:5px;
float: center;
margin:-300px 0px 0px -100px;
}
</style>

<div class="container-fluid main-content">
<div class="page-title">
        <h2 style='margin-top:-20px; margin-bottom: 5px; color:#ffcc33'>Branches</h2>
  
    </div>

 <div class="row">
  <div class="col-lg-2 hidden-print">
   
   <ul class="list-group">

   <li class="list-group-item">
	  <a href="ilist.php">
                <p>
                <i class="lnr lnr-menu-circle"></i>&nbsp;Sales Items
                </p>
              </a></li> 

    <li class="list-group-item">
	  <a href="creteb.php">
                <p>
                <i class="lnr lnr-menu-circle"></i>&nbsp;Create New Item
                </p>
              </a></li> 

		 <li class="list-group-item active">
              <a href="upitem.php">
                <p>
                <i class="lnr lnr-plus-circle"></i>&nbsp;Upload All Items
                </p>
              </a></li>

	 <li class="list-group-item">
	  <a href="bconfig.php">
                <p>
                <i class="lnr lnr-menu-circle"></i>&nbsp;Configurations
				<?php
				if($fcode)
					echo"<span class='badge' style='float:right; font-size:12px; margin-right:0px; margin-top:0px; height:18px; background-color:#cc3366; width:20px;'> $fcode </span>";
					?>
                </p>
              </a></li> 

	   <li class="list-group-item">
              <a href="stobranch.php">
                <p>
                <i class="lnr lnr-plus-circle"></i>&nbsp;Store Status
                </p>
              </a></li>
                       
            </ul><br><br><br>

  </div>
  
  <div class="col-md-10">
 <div class="widget-container fluid-height clearfix">
 <div class="widget-content padded">
 <form method="post" class="form-horizontal" action="" enctype="multipart/form-data">
 <input name="app_file_size" id="app_file_size" type="hidden">
 <br>
 <?php 
if($pto==10)
echo"<center><div class='alert alert-danger' style='width:88%;text-align:center;float:center;background-color: #60c560;color: #ffffff;border-radius:5px;'>
		<i class='lnr lnr-checkmark-circle'></i> &nbsp;&nbsp; <button class='close' data-dismiss='alert' type='button'>×</button>$px items have been uploaded from excel file. 
		</div></center>";
if($pto==40)
echo"<center><div class='alert alert-danger' style='width:88%;text-align:center;float:center;background-color: #ff9933;color: #ffffff;border-radius:5px;'>
		<i class='lnr lnr-checkmark-circle'></i> &nbsp;&nbsp; <button class='close' data-dismiss='alert' type='button'>×</button>Uploaded excel format is not allowed.
		</div></center>";
	
			echo"<input value='$code' name='rowid' type='hidden'>";
			?>
			<br><br><div class="form-group">
			<div class="col-md-2" align="right"> 
            <label class="control-label">File Name</label></div>
            <div class="col-md-3">
           <input name="finame" class="form-control" type="text" style="text-align:left;" value="<?php echo $finame ?>" required>
            </div><span style="color:#d43f3a">
                         mandatory
                      </span> 
			
			 	
			 
			  <div class="col-md-2" align="right">
			  <label class="control-label">Description</label></div>	

 <div class="col-md-3">
          <input name="descri" class="form-control" type="text" value="<?php echo $descri ?>">
            </div>

 </div>
 

  <div class="form-group">
            <label class="control-label col-md-3"><br><br>Upload&nbsp;Type</label>
            <div class="col-md-3" style='margin-right:10px;'>
              <br><br><select class="form-control" name="donel" required><option value=''> </option>
			  
			   <?php
			echo"<option value='NEW'> NEW LIST </option><option value='ADD'> ADDITION </option>";
			?>    
                            </select> &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp;
			 </div> 

			 
			<div class="col-md-4" style='text-align:right; margin-left:20px;'><br><br>
			  <input name="dato" id="from" class="form-control" value="<?php echo $Date ?>" type="text" style='width:210px; text-align:center;' readonly required>
            </div> 
 </div>

 <div class="form-group"> <div class="col-md-2" align="right"> </div>
    <label class="control-label col-md-3" for="exampleInputFile">Excel File</label>
                     <div class="col-md-6">
              <div class="fileupload fileupload-new" data-provides="fileupload"><input value="<?php echo $rowid ?>" name="rowid" type="hidden">
                <span class="btn btn-default btn-file"><span class="fileupload-new">Select</span><span class="fileupload-exists">Change</span>
				<input name="file" id="app_file" type="file" readonly='readonly'></span><span class="fileupload-preview"></span><button class="close fileupload-exists" data-dismiss="fileupload" style="float:none" type="button">×</button>
		<?php echo $dfile ?>
				
              <small> Only <b>Excel</b> format (Max : 2M)</small>       
              </div>     
            </div>
            </div>

			<a href="#" style='text-weight:normal; font-size:10px;' onMouseOver="ShowPicture('Style',1)" onMouseOut="ShowPicture('Style',0)">
				Move mouse here to display allowed excel format </a>
				<div id="Style" style='left:400px;'><IMG SRC="imgs/excel.PNG" WIDTH="524" HEIGHT="328" BORDER="0" ALT=""></div> 

  <div class="form-group">
  <div class="col-md-12">
  <div class="col-sm-1"></div>
   <div class="col-sm-9" align='center' style='border:0px solid black;'> 
   <?php
	  echo"<input type='hidden' name='rowid' value='$rowid'> $btne";
	   ?>
		</div></div><br><br>
		</form></div></div></div></div>
	 
 </div></div></div>
 
<?php
include'footer.php';
?>
