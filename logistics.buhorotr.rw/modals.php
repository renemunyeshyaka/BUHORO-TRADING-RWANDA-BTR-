
	<!-- New Insurance Record -->
<div id="insure" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">

    <div class="modal-dialog">

        <div class="modal-content" style="border-radius:5px;">

            <div class="modal-header" style="border-radius:5px;">

                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="fa fa-times-circle" aria-hidden="true"></i></button>

                <h4 class="modal-title" id="myModalLabel">&nbsp;&nbsp;&nbsp;<i class="fa fa-bars"></i> Insurance Registration </h4>

            </div>

            <div class="modal-body">

                
                <!-- Email Logins-->

                

                <form action="" method="post" enctype='multipart/form-data'>

                     <div class="row"> 

                        <div class="col-sm-6" style="padding-top:7px; font-weight:bold;">

                           &nbsp; <i class="fa fa-truck"></i> Vehicle ID
                        </div><div class="col-sm-6" style="padding-top:7px; font-weight:bold;">

                           &nbsp; <i class="fa fa-bank"></i> Insurance Company
                        </div>

                        <label class="control-label col-sm-6">

     <select class="form-control" name="plate" style="font-size:16px; height:34px;" required>
	 <option value=''> </option>
<?php
$do=mysqli_query($conn, "SELECT `Number`, `Plate` FROM `vehicles` WHERE `Status`='0' ORDER BY `Plate` ASC");
		while($ro=mysqli_fetch_assoc($do)){
			$numb=$ro['Number'];
			$plate=$ro['Plate'];
			echo"<option value='$numb'> $plate </option>";
		}
		?>
		</select>


</label>
                       

						<div class="col-sm-6">

       <select class="form-control text-center" name="compa" style="font-size:16px; height:34px;" required>
	 <option value=''> </option>
<?php
$doz=mysqli_query($conn, "SELECT `Name` FROM `icompany` ORDER BY `Name` ASC");
		while($roz=mysqli_fetch_assoc($doz)){
			$name=$roz['Name'];
			echo"<option value='$name'> $name </option>";
		}
		?>
		</select>

                        </div>
</div>


 <div class="row"> 


 <div class="col-sm-6" style="padding-top:0px; font-weight:bold;">

                           &nbsp; <i class="fa fa-calendar"></i> Starting Date
                        </div><div class="col-sm-6" style="padding-top:0px; font-weight:bold;">

                           &nbsp; <i class="fa fa-calendar"></i> Ending Date
                        </div>

                        <label class="control-label col-sm-6">

    <input class="form-control form-center" name="dato" type="text" value="<?php echo $Date ?>" onkeypress='return isNumberKey(event)' required>
					</label>
                       

						<div class="col-sm-6">

      <input class="form-control form-center" name="datos" type="text" value="<?php echo $Date ?>" onkeypress='return isNumberKey(event)' required>

                        </div>

</div>

 <div class="row"> 
						

                   <div class="col-sm-6" style="padding-top:0px; font-weight:bold;">

                           &nbsp; <i class="fa fa-laptop"></i> Description
                        </div><div class="col-sm-6 form-center" style="padding-top:0px; font-weight:bold;">

                           &nbsp; <i class="fa fa-file-text"></i> Document File
                        </div>

                        <label class="control-label col-sm-6">

    <textarea placeholder="Write description here..." class="form-control" rows="3" name="desc"></textarea>
					</label>
                       

						<div class="col-sm-6 form-center"><br>

      <div class="fileupload fileupload-new" data-provides="fileupload"><input value="<?php echo $rowid ?>" name="rowid" type="hidden">
                <span class="btn btn-default btn-file"><span class="fileupload-new">Select</span><span class="fileupload-exists">Change</span><input name="file1" id="app_file" type="file" readonly='readonly'></span><span class="fileupload-preview"></span><button class="close fileupload-exists" data-dismiss="fileupload" style="float:none" type="button">×</button>
		<?php echo $dfile ?>
				
                     
              </div>     <small>Zip, txt, jpeg, png, pdf, doc (Max : 2M)</small>

                        </div>

</div>

                                          
                  

                     <div class="row">

                        <div class="col-sm-12" style="text-align:center"><hr>

                           
                     <button class="view-listing-button" type="submit" name="savei" style="border:1px solid #99ccff; width:240px; float:center; height:30px; border-radius:5px; font-size:18px;"><i class="fa fa-check-square-o"></i> &nbsp; Save  </button>
                        </div>

                     </div>

                </form>

            </div>


        </div>

        <!-- /.modal-content -->

    </div>

    <!-- /.modal-dialog -->

</div>








































<!-- For technical inspection -->
<div id="inspect" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">

    <div class="modal-dialog">

        <div class="modal-content" style="border-radius:5px;">

            <div class="modal-header" style="border-radius:5px;">

                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="fa fa-times-circle" aria-hidden="true"></i></button>

                <h4 class="modal-title" id="myModalLabel">&nbsp;&nbsp;&nbsp;<i class="fa fa-bars"></i> Technical Inspection </h4>

            </div>

            <div class="modal-body">

                
                <!-- Email Logins-->

                

                <form action="" method="post" enctype='multipart/form-data'>

                     <div class="row"> 

                        <div class="col-sm-6" style="padding-top:7px; font-weight:bold;">

                           &nbsp; <i class="fa fa-truck"></i> Vehicle ID
                        </div><div class="col-sm-6" style="padding-top:7px; font-weight:bold;">

                           &nbsp; <i class="fa fa-street-view"></i> Place of Inspection
                        </div>

                        <label class="control-label col-sm-6">

     <select class="form-control" name="plate" style="font-size:16px; height:34px;" required>
	 <option value=''> </option>
<?php
$do=mysqli_query($conn, "SELECT `Number`, `Plate` FROM `vehicles` WHERE `Status`='0' ORDER BY `Plate` ASC");
		while($ro=mysqli_fetch_assoc($do)){
			$numb=$ro['Number'];
			$plate=$ro['Plate'];
			echo"<option value='$numb'> $plate </option>";
		}
		?>
		</select>


</label>
                       

						<div class="col-sm-6">

       <select class="form-control text-center" name="compa" style="font-size:16px; height:34px;" required>
	 <option value=''> </option>
<?php
$doz=mysqli_query($conn, "SELECT `Name` FROM `places` ORDER BY `Name` ASC");
		while($roz=mysqli_fetch_assoc($doz)){
			$name=$roz['Name'];
			echo"<option value='$name'> $name </option>";
		}
		?>
		</select>

                        </div>
</div>


 <div class="row"> 


 <div class="col-sm-6" style="padding-top:0px; font-weight:bold;">

                           &nbsp; <i class="fa fa-calendar"></i> Starting Date
                        </div><div class="col-sm-6" style="padding-top:0px; font-weight:bold;">

                           &nbsp; <i class="fa fa-calendar"></i> Ending Date
                        </div>

                        <label class="control-label col-sm-6">

    <input class="form-control form-center" name="dato" type="text" value="<?php echo $Date ?>" onkeypress='return isNumberKey(event)' required>
					</label>
                       

						<div class="col-sm-6">

      <input class="form-control form-center" name="datos" type="text" value="<?php echo $Date ?>" onkeypress='return isNumberKey(event)' required>

                        </div>

</div>

 <div class="row"> 
						

                   <div class="col-sm-6" style="padding-top:0px; font-weight:bold;">

                           &nbsp; <i class="fa fa-laptop"></i> Description
                        </div><div class="col-sm-6 form-center" style="padding-top:0px; font-weight:bold;">

                           &nbsp; <i class="fa fa-file-text"></i> Document File
                        </div>

                        <label class="control-label col-sm-6">

    <textarea placeholder="Write description here..." class="form-control" rows="3" name="desc"></textarea>
					</label>
                       

						<div class="col-sm-6 form-center"><br>

      <div class="fileupload fileupload-new" data-provides="fileupload"><input value="<?php echo $rowid ?>" name="rowid" type="hidden">
                <span class="btn btn-default btn-file"><span class="fileupload-new">Select</span><span class="fileupload-exists">Change</span><input name="file1" id="app_file" type="file" readonly='readonly'></span><span class="fileupload-preview"></span><button class="close fileupload-exists" data-dismiss="fileupload" style="float:none" type="button">×</button>
		<?php echo $dfile ?>
				
                     
              </div>     <small>Zip, txt, jpeg, png, pdf, doc (Max : 2M)</small>

                        </div>

</div>

                                          
                  

                     <div class="row">

                        <div class="col-sm-12" style="text-align:center"><hr>

                           
                     <button class="view-listing-button" type="submit" name="savep" style="border:1px solid #99ccff; width:240px; float:center; height:30px; border-radius:5px; font-size:18px;"><i class="fa fa-check-square-o"></i> &nbsp; Save  </button>
                        </div>

                     </div>

                </form>

            </div>


        </div>

        <!-- /.modal-content -->

    </div>

    <!-- /.modal-dialog -->

</div>














































<!-- For transport permit -->
<div id="permit" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">

    <div class="modal-dialog">

        <div class="modal-content" style="border-radius:5px;">

            <div class="modal-header" style="border-radius:5px;">

                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="fa fa-times-circle" aria-hidden="true"></i></button>

                <h4 class="modal-title" id="myModalLabel">&nbsp;&nbsp;&nbsp;<i class="fa fa-bars"></i> Transport Permit </h4>

            </div>

            <div class="modal-body">

                
                <!-- Email Logins-->

                

                <form action="" method="post" enctype='multipart/form-data'>

                     <div class="row"> 

                        <div class="col-sm-6" style="padding-top:7px; font-weight:bold;">

                           &nbsp; <i class="fa fa-truck"></i> Vehicle ID
                        </div><div class="col-sm-6" style="padding-top:7px; font-weight:bold;">

                           &nbsp; <i class="fa fa-truck"></i> Permit Type
                        </div>

                        <label class="control-label col-sm-6">

     <select class="form-control" name="plate" style="font-size:16px; height:34px;" required>
	 <option value=''> </option>
<?php
$do=mysqli_query($conn, "SELECT `Number`, `Plate` FROM `vehicles` WHERE `Status`='0' ORDER BY `Plate` ASC");
		while($ro=mysqli_fetch_assoc($do)){
			$numb=$ro['Number'];
			$plate=$ro['Plate'];
			echo"<option value='$numb'> $plate </option>";
		}
		?>
		</select>


</label>
                       

						<div class="col-sm-6">

       <select class="form-control text-center" name="compa" style="font-size:16px; height:34px;" required>
	 <option value=''> </option>
<?php
$doz=mysqli_query($conn, "SELECT `Name` FROM `ptype` ORDER BY `Name` ASC");
		while($roz=mysqli_fetch_assoc($doz)){
			$name=$roz['Name'];
			echo"<option value='$name'> $name </option>";
		}
		?>
		</select>

                        </div>
</div>


 <div class="row"> 


 <div class="col-sm-6" style="padding-top:0px; font-weight:bold;">

                           &nbsp; <i class="fa fa-calendar"></i> Starting Date
                        </div><div class="col-sm-6" style="padding-top:0px; font-weight:bold;">

                           &nbsp; <i class="fa fa-calendar"></i> Ending Date
                        </div>

                        <label class="control-label col-sm-6">

    <input class="form-control form-center" name="dato" type="text" value="<?php echo $Date ?>" onkeypress='return isNumberKey(event)' required>
					</label>
                       

						<div class="col-sm-6">

      <input class="form-control form-center" name="datos" type="text" value="<?php echo $Date ?>" onkeypress='return isNumberKey(event)' required>

                        </div>

</div>

 <div class="row"> 
						

                   <div class="col-sm-6" style="padding-top:0px; font-weight:bold;">

                           &nbsp; <i class="fa fa-laptop"></i> Description
                        </div><div class="col-sm-6 form-center" style="padding-top:0px; font-weight:bold;">

                           &nbsp; <i class="fa fa-file-text"></i> Document File
                        </div>

                        <label class="control-label col-sm-6">

    <textarea placeholder="Write description here..." class="form-control" rows="3" name="desc"></textarea>
					</label>
                       

						<div class="col-sm-6 form-center"><br>

      <div class="fileupload fileupload-new" data-provides="fileupload"><input value="<?php echo $rowid ?>" name="rowid" type="hidden">
                <span class="btn btn-default btn-file"><span class="fileupload-new">Select</span><span class="fileupload-exists">Change</span><input name="file1" id="app_file" type="file" readonly='readonly'></span><span class="fileupload-preview"></span><button class="close fileupload-exists" data-dismiss="fileupload" style="float:none" type="button">×</button>
		<?php echo $dfile ?>
				
                     
              </div>     <small>Zip, txt, jpeg, png, pdf, doc (Max : 2M)</small>

                        </div>

</div>

                                          
                  

                     <div class="row">

                        <div class="col-sm-12" style="text-align:center"><hr>

                           
                     <button class="view-listing-button" type="submit" name="savet" style="border:1px solid #99ccff; width:240px; float:center; height:30px; border-radius:5px; font-size:18px;"><i class="fa fa-check-square-o"></i> &nbsp; Save  </button>
                        </div>

                     </div>

                </form>

            </div>


        </div>

        <!-- /.modal-content -->

    </div>

    <!-- /.modal-dialog -->

</div>

























<!-- For fuel consumption -->
<div id="fuel" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">

    <div class="modal-dialog">

        <div class="modal-content" style="border-radius:5px;">

            <div class="modal-header" style="border-radius:5px;">

                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="fa fa-times-circle" aria-hidden="true"></i></button>

                <h4 class="modal-title" id="myModalLabel">&nbsp;&nbsp;&nbsp;<i class="fa fa-bars"></i> Fuel Consumption </h4>

            </div>

            <div class="modal-body">

                
                <!-- Email Logins-->

                

                <form action="" method="post" enctype='multipart/form-data'>

                     <div class="row"> 

                        <div class="col-sm-6" style="padding-top:7px; font-weight:bold;">

                           &nbsp; <i class="fa fa-calendar"></i> Due Date
                        </div><div class="col-sm-6" style="padding-top:7px; font-weight:bold;">

                           &nbsp; <i class="fa fa-truck"></i> Vehicle ID
                        </div>

                        <label class="control-label col-sm-6">

    <input class="form-control form-center" name="dato" type="text" value="<?php echo $Date ?>" onkeypress='return isNumberKey(event)' id='from' required>

</label>
                       

						<div class="col-sm-6">

       <select class="form-control" name="plate" style="font-size:16px; height:34px;" required>
	 <option value=''> </option>
<?php
$do=mysqli_query($conn, "SELECT `Number`, `Plate` FROM `vehicles` WHERE `Status`='0' ORDER BY `Plate` ASC");
		while($ro=mysqli_fetch_assoc($do)){
			$numb=$ro['Number'];
			$plate=$ro['Plate'];
			echo"<option value='$numb'> $plate </option>";
		}
		?>
		</select>

                        </div>
</div>


 <div class="row"> 


 <div class="col-sm-6" style="padding-top:0px; font-weight:bold;">

                           &nbsp; <i class="fa fa-database"></i> Quantity (Liters)
                        </div><div class="col-sm-6" style="padding-top:0px; font-weight:bold;">

                           &nbsp; <i class="fa fa-product-hunt"></i> Price per unit
                        </div>

                        <label class="control-label col-sm-6">
 <input class="form-control form-center" name="qty" type="text" onkeypress="return isNumberKey(event)" onkeyup='devideBy1();' onkeypress='return isNumberKey(event)' id='box10' required>
    
					</label>
					
					
                       

						<div class="col-sm-3">
						<?php
						/*
			$dop=mysqli_query($conn, "SELECT `Price` FROM `consumption` ORDER BY `Number` DESC");
				$rop=mysqli_fetch_assoc($dop);
					$pri=number_format($rop['Price']);
					*/
		?>
      <input class="form-control form-center" name="amo" type="text" onkeyup='devideBy1();' onkeypress="return isNumberKey(event)" id='box1' required>
                        </div>
                        
            <div class="col-sm-3"><select class='form-control' name='curre' title='Currency' data-toggle='tooltip' data-placement='top' style='margin-left:0px;' required><option value='1' selected='selected'>Currency</option>
		<?php
			$doi=mysqli_query($conn, "SELECT `Code`, `Rate` FROM `currency` WHERE `Code`!='' ORDER BY `Code` ASC");
			while($roi=mysqli_fetch_assoc($doi)){
				$fna=$roi['Code'];
				$rate=$roi['Rate'];
				$rte=number_format($rate, 2);
			echo"<option value='$rate'> $fna @ $rte </option>";
			}
		?>
		   </select></div>

</div>

 <div class="row"> 
 

<div class="col-sm-6" style="padding-top:0px; font-weight:bold;">

   <select class="form-control text-center" name="station" style="font-size:16px; height:34px;" required><option value=''> Petrol Station </option>
<?php
$doz=mysqli_query($conn, "SELECT `Name` FROM `station` ORDER BY `Name` ASC");
		while($roz=mysqli_fetch_assoc($doz)){
			$name=$roz['Name'];
			echo"<option value='$name'> $name </option>";
		}
		?>
		</select></div>
						
	<div class="col-sm-6" style="padding-top:0px; font-weight:bold;">
                            
    <input class="form-control form-center" name="pucha" type="text" onkeypress="return isNumberKey(event)" placeholder="Mileage Count" title='Mileage Count' data-toggle='tooltip' data-placement='top'>
					</div>
					
            </div>

         <div class="row">
			<div class="col-sm-6" style="margin-top:-30px;"><br><br>
 <input class="form-control form-center" name="invo" type="text" onkeypress="return isNumberKey(event)" placeholder="Invoice No" title="Invoice No" data-toggle='tooltip' data-placement='top'></div>
						
	<div class="col-sm-6 text-center" style="padding-top:0px; font-weight:bold;">

      <div class="fileupload fileupload-new" data-provides="fileupload">
          <input value="<?php echo $rowid ?>" name="rowid" type="hidden">
                <span class="btn btn-default btn-file"><span class="fileupload-new">Select</span><span class="fileupload-exists">Change</span><input name="file1" id="app_file" type="file" readonly='readonly'></span><span class="fileupload-preview"></span><button class="close fileupload-exists" data-dismiss="fileupload" style="float:none" type="button">×</button>
		<?php echo $dfile ?>
				
                     
              </div>     <small>Zip, txt, jpeg, png, pdf, doc (Max : 2M)</small>

                        </div>

</div>

                                          
                  

                        <div class="col-sm-12" style="text-align:center"><hr>

                           
                     <button class="view-listing-button" type="submit" name="savef" style="border:1px solid #99ccff; width:240px; float:center; height:30px; border-radius:5px; font-size:18px;"><i class="fa fa-check-square-o"></i> &nbsp; Save  </button>
                        </div>

                     </div>

                </form>

            </div>


        </div>

        <!-- /.modal-content -->

    </div>

    <!-- /.modal-dialog -->

</div>























<!-- For transport services -->
<div id="myTrans" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">

    <div class="modal-dialog">

        <div class="modal-content" style="border-radius:5px;">

            <div class="modal-header" style="border-radius:5px;">

                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="fa fa-times-circle" aria-hidden="true"></i></button>

                <h4 class="modal-title" id="myModalLabel">&nbsp;&nbsp;&nbsp;<i class="fa fa-bars"></i> Transport Services [Income]</h4>

            </div>

            <div class="modal-body">

                
                <!-- Email Logins-->

                

                <form action="" method="post" enctype='multipart/form-data'>

                     <div class="row"> 

                        <div class="col-sm-6" style="padding-top:7px; font-weight:bold;">

                           &nbsp; <i class="fa fa-calendar"></i> Due Date
                        </div><div class="col-sm-6" style="padding-top:7px; font-weight:bold;">

                           &nbsp; <i class="fa fa-truck"></i> Vehicle ID
                        </div>

                        <label class="control-label col-sm-6">

    <input class="form-control form-center" name="dato" type="text" value="<?php echo $Date ?>" onkeypress='return isNumberKey(event)' id='from' required>

</label>
                       

						<div class="col-sm-6">

       <select class="form-control" name="plate" style="font-size:16px; height:34px;" required>
	 <option value=''> </option>
<?php
$do=mysqli_query($conn, "SELECT `Number`, `Plate` FROM `vehicles` WHERE `Status`='0' ORDER BY `Plate` ASC");
		while($ro=mysqli_fetch_assoc($do)){
			$numb=$ro['Number'];
			$plate=$ro['Plate'];
			echo"<option value='$numb'> $plate </option>";
		}
		?>
		</select>

                        </div>
</div>


 <div class="row"> 


 <div class="col-sm-6" style="padding-top:0px; font-weight:bold;">

                           &nbsp; <i class="fa fa-area-chart"></i> Distance (KM)
                        </div><div class="col-sm-6" style="padding-top:0px; font-weight:bold;">

                           &nbsp; <i class="fa fa-briefcase"></i> Total Amount
                        </div>

                        <label class="control-label col-sm-6">
 <input class="form-control form-center" name="dista" type="text" onkeyup="format(this);" onkeypress="return isNumberKey(event)" required>
    
					</label>
                       

						<div class="col-sm-3">
      <input class="form-control form-center" name="amo" type="text" onkeyup="format(this);" onkeypress="return isNumberKey(event)" required>

                        </div>
                        
            <div class="col-sm-3"><select class='form-control' name='curre' title='Currency' data-toggle='tooltip' data-placement='top' style='margin-left:0px;' required><option value='1' selected='selected'>Currency</option>
		<?php
			$doi=mysqli_query($conn, "SELECT `Code`, `Rate` FROM `currency` WHERE `Code`!='' ORDER BY `Code` ASC");
			while($roi=mysqli_fetch_assoc($doi)){
				$fna=$roi['Code'];
				$rate=$roi['Rate'];
				$rte=number_format($rate, 2);
			echo"<option value='$rate'> $fna @ $rte </option>";
			}
		?>
		   </select></div>
					
					</div>

 <div class="row"> 

						<div class="col-sm-6" style="padding-top:0px; font-weight:bold;">

                           &nbsp; <i class="fa fa-user"></i> Drivers` Name
                        </div><div class="col-sm-6" style="padding-top:0px; font-weight:bold;">

                           &nbsp; <i class="fa fa-balance-scale"></i> Weight (KG)
                        </div>

                        <label class="control-label col-sm-6">
 <input class="form-control" name="driv" type="text" OnKeyup='return cUpper(this);' list="dive" required>
     <datalist id="dive">
<?php
$doe=mysqli_query($conn, "SELECT `Fname`, `Lname` FROM `employees` WHERE `Currentp`='7' AND `Status`='0' ORDER BY `Fname` ASC");
		while($roe=mysqli_fetch_assoc($doe)){
			$fna=$roe['Fname'];
			$lna=$roe['Lname'];
			$name="$fna $lna";
			echo"<option value='$name'>";
		}
		?>
		</datalist>
					</label>
                       

						<div class="col-sm-6">
      <input class="form-control form-center" name="wei" type="text" onkeyup="format(this);" onkeypress="return isNumberKey(event)" required>

                        </div>

</div>

 <div class="row"> 
 

 <div class="col-sm-6" style="padding-top:0px; font-weight:bold;">

                           &nbsp; <i class="fa fa-bars"></i> District
                        </div><div class="col-sm-6" style="padding-top:0px; font-weight:bold;">

                           &nbsp; <i class="fa fa-map-marker"></i> Location
                        </div>

                   <div class="col-sm-6" style="padding-top:0px; font-weight:bold; height:60px;">

  <select class="form-control text-center" name="dist" style="font-size:16px; height:34px;" required>
	 <option value=''> Select a District </option>
<?php
$doz=mysqli_query($conn, "SELECT `Name` FROM `districts` ORDER BY `Name` ASC");
		while($roz=mysqli_fetch_assoc($doz)){
			$name=$roz['Name'];
			echo"<option value='$name'> $name </option>";
		}
		?>
		</select>
                        </div>

   
                        <label class="control-label col-sm-6">
				
<input class="form-control" name="loco" type="text">
					</label>

</div>

 <div class="row"> 
                       

						<div class="col-sm-6 form-center" style="margin-top:0px;">
 
    <textarea placeholder="Description...." class="form-control" rows="3" name="descri"></textarea>

			</div><div class="col-sm-6 form-center" style="margin-top:0px; padding-top:10px;">
    
					

      <div class="fileupload fileupload-new" data-provides="fileupload"><input value="<?php echo $rowid ?>" name="rowid" type="hidden">
                <span class="btn btn-default btn-file"><span class="fileupload-new">Select</span><span class="fileupload-exists">Change</span><input name="file1" id="app_file" type="file" readonly='readonly'></span><span class="fileupload-preview"></span><button class="close fileupload-exists" data-dismiss="fileupload" style="float:none" type="button">×</button>
		<?php echo $dfile ?>
				
                     
              </div>     <small>Zip, txt, jpeg, png, pdf, doc (Max : 2M)</small>

                        </div>

</div>

                                          
                  

                        <div class="col-sm-12" style="text-align:center"><hr>

                           
                     <button class="view-listing-button" type="submit" name="saves" style="border:1px solid #99ccff; width:240px; float:center; height:30px; border-radius:5px; font-size:18px;"><i class="fa fa-check-square-o"></i> &nbsp; Save  </button>
                        </div>

                     </div>

                </form>

            </div>


        </div>

        <!-- /.modal-content -->

    </div>

    <!-- /.modal-dialog -->

</div>





















<!-- For Repair & Services -->
<div id="repair" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">

    <div class="modal-dialog">

        <div class="modal-content" style="border-radius:5px;">

            <div class="modal-header" style="border-radius:5px;">

                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="fa fa-times-circle" aria-hidden="true"></i></button>

                <h4 class="modal-title" id="myModalLabel">&nbsp;&nbsp;&nbsp;<i class="fa fa-bars"></i> Repair & Services </h4>

            </div>

            <div class="modal-body">

                
                <!-- Email Logins-->

                

                <form action="" method="post" enctype='multipart/form-data'>

                     <div class="row"> 

                        <div class="col-sm-6" style="padding-top:7px; font-weight:bold;">

                           &nbsp; <i class="fa fa-calendar"></i> Due Date
                        </div><div class="col-sm-6" style="padding-top:7px; font-weight:bold;">

                           &nbsp; <i class="fa fa-truck"></i> Vehicle ID
                        </div>

                        <label class="control-label col-sm-6">

    <input class="form-control form-center" name="dato" type="text" value="<?php echo $Date ?>" onkeypress='return isNumberKey(event)' id='to' required>

</label>
                       

						<div class="col-sm-6">

       <select class="form-control" name="plate" style="font-size:16px; height:34px;" required>
	 <option value=''> </option>
<?php
$do=mysqli_query($conn, "SELECT `Number`, `Plate` FROM `vehicles` WHERE `Status`='0' ORDER BY `Plate` ASC");
		while($ro=mysqli_fetch_assoc($do)){
			$numb=$ro['Number'];
			$plate=$ro['Plate'];
			echo"<option value='$numb'> $plate </option>";
		}
		?>
		</select>

                        </div>
</div>


 <div class="row"> 


 <div class="col-sm-6" style="padding-top:0px; font-weight:bold;">

                           &nbsp; <i class="fa fa-bars"></i> Repair/Service Type
                        </div><div class="col-sm-6" style="padding-top:0px; font-weight:bold;">

                           &nbsp; <i class="fa fa-user"></i> Driver`s Name
                        </div>

                        <label class="control-label col-sm-6">
 <select class="form-control" name="garage" style="font-size:16px; height:34px;" required>
	 <option value=''> Select Type </option>
<?php
$doz=mysqli_query($conn, "SELECT `Name` FROM `garage` ORDER BY `Name` ASC");
		while($roz=mysqli_fetch_assoc($doz)){
			$name=$roz['Name'];
			echo"<option value='$name'> $name </option>";
		}
		?>
		</select>
					</label>
                       

						<div class="col-sm-6">
	<input type="text" class="form-control" name="driver" OnKeyup='return cUpper(this);' style="font-size:16px; height:34px;" list='dive'>
	 <datalist id="dive">
<?php
$doe=mysqli_query($conn, "SELECT `Fullname` FROM `employees` WHERE `Currentp` = '7' AND `Status` = '0' ORDER BY `Fullname` ASC");
		while($roe=mysqli_fetch_assoc($doe)){
			$fna=$roe['Fullname'];
			echo"<option value='$fna'>";
		}


$doa=mysqli_query($conn, "SELECT `Fullname` FROM `employees` WHERE `Currentp` = '26' AND `Status` = '0' ORDER BY `Fullname` ASC");
		while($roa=mysqli_fetch_assoc($doa)){
			$lna=$roa['Fullname'];
			echo"<option value='$lna'>";
		}
		?>
		</datalist>
                        </div>

</div>

 <div class="row">  <div class="col-sm-6" style="padding-top:0px; font-weight:bold;">

                           &nbsp; <i class="fa fa-question-circle"></i> Issue
                        </div><div class="col-sm-6" style="padding-top:0px; font-weight:bold;">

                           &nbsp; <i class="fa fa-cogs"></i> Repair
                        </div>
				
		 <label class="control-label col-sm-6">

    <textarea placeholder="Write here..." class="form-control" rows="3" name="issue"></textarea>
					</label>
					
					 <label class="control-label col-sm-6">

    <textarea placeholder="Write here..." class="form-control" rows="3" name="repair"></textarea>
					</label>

</div>

						<div class="row"> 
						

                   <div class="col-sm-6" style="padding-top:0px; font-weight:bold;">

				    &nbsp; <i class="fa fa-briefcase"></i> Total Amount
    
                        </div>
						
						<div class="col-sm-6 form-center" style="padding-top:0px; font-weight:bold;">

                           &nbsp; <i class="fa fa-file-text"></i> Document File
                        </div>

   
                        <label class="control-label col-sm-6">

	<input class="form-control form-center" name="amo" type="text" onkeyup="format(this);" onkeypress="return isNumberKey(event)" required><br>
						<b>&nbsp;&nbsp; <i class="fa fa-spinner"></i> Mileage Count </b> &nbsp;&nbsp; 
			<b>&nbsp; <i class="fa fa-spinner"></i> Next Count<br></b><div class="col-sm-6 form-center">
	<input class="form-control form-center" name="purcha" type="text" onkeypress="return isNumberKey(event)" title='Mileage Count' data-toggle='tooltip' data-placement='top' style="width:120px;"></div><div class="col-sm-6 form-center"><input class="form-control form-center" name="next" type="text" onkeypress="return isNumberKey(event)" title='Next Count' data-toggle='tooltip' data-placement='top' style="width:120px;"></div>

					</label>
                       

						<div class="col-sm-6 form-center"><br>

      <div class="fileupload fileupload-new" data-provides="fileupload"><input value="<?php echo $rowid ?>" name="rowid" type="hidden">
                <span class="btn btn-default btn-file"><span class="fileupload-new">Select</span><span class="fileupload-exists">Change</span><input name="file1" id="app_file" type="file" readonly='readonly'></span><span class="fileupload-preview"></span><button class="close fileupload-exists" data-dismiss="fileupload" style="float:none" type="button">×</button>
		<?php echo $dfile ?>
				
                     
              </div>     <small>Zip, txt, jpeg, png, pdf, doc (Max : 2M)</small>

                        </div>

</div>

                        <div class="col-sm-12" style="text-align:center"><hr>

                           
                     <button class="view-listing-button" type="submit" name="savege" style="border:1px solid #99ccff; width:240px; float:center; height:30px; border-radius:5px; font-size:18px;"><i class="fa fa-check-square-o"></i> &nbsp; Save  </button>
                        </div>

                     </div>

                </form>

            </div>


        </div>

        <!-- /.modal-content -->

    </div>

    <!-- /.modal-dialog -->

</div>