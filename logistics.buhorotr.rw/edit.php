<?php
echo"<div id='uModal$n' class='modal fade' tabindex='-1' role='dialog' aria-labelledby='myModalLabel' aria-hidden='true' style='display: none;'>

    <div class='modal-dialog'>

        <div class='modal-content'>

            <div class='modal-header'>

                <button type='button' class='close' data-dismiss='modal' aria-hidden='true'><i class='fa fa-times-circle' aria-hidden='true'></i></button>

                <h4 class='modal-title' id='myModalLabel'>&nbsp;&nbsp;&nbsp;<i class='fa fa-bars'></i> Update an Item </h4>

            </div>

            <div class='modal-body'>

                
                <!-- Email Logins-->

                

                <form action='' method='post' enctype='multipart/form-data'>

                     <div class='row'>

                        <div class='col-sm-6' style='padding-top:7px; font-weight:bold;'>

                           &nbsp; <i class='fa fa-user'></i> Item Name
                        </div><div class='col-sm-6' style='padding-top:7px; font-weight:bold;'>

                           &nbsp; <i class='fa fa-puzzle-piece'></i> Item Type
                        </div>

                        <div class='col-sm-6'>

                            <input type='text' class='form-control' name='item' style='font-size:16px; height:38px;' value='$item' required>

                        </div>

						<div class='col-sm-6'>

                            <select class='form-control' name='itype' style='font-size:16px; height:38px;' required>	
							<option value=''> Select Type </option>";
							
		$tee=mysqli_query($conn, "SELECT `Number`, `Type` FROM `itype` WHERE `Type`!='' AND `Location`='1' ORDER BY `Number` ASC");
			while($reo=mysqli_fetch_assoc($tee)){
				$no=$reo['Number'];
				$typ=$reo['Type'];
				if($type==$typ)
					$s='selected';
				else
					$s='';
				echo"<option value='$typ' $s> $typ </option>";
			}
			if($lab=='Fixed Asset'){
				$f='selected';
				$v='';
			}
			else{
				$f='';
				$v='selected';
			}
				
							echo"</select>

                        </div>




						<div class='col-sm-6' style='padding-top:7px; font-weight:bold;'>

                           &nbsp; <i class='fa fa-money'></i> Item Price
                        </div><div class='col-sm-6' style='padding-top:7px; font-weight:bold;'>

                           &nbsp; <i class='fa fa-bell'></i> Item Label
                        </div>

                        <div class='col-sm-6'>

     <input type='text' class='form-control text-center' name='iprice' style='font-size:16px; height:38px;' onkeyup='format(this);' value='$prio' required>

                        </div>

						<div class='col-sm-6'>

                             <select class='form-control' name='ilabel' style='font-size:16px; height:38px;' required>	
							<option value=''> Select Label </option><option value='Fixed Asset' $f> Fixed Asset </option>
							<option value='Variable Asset' $v> Variable Asset </option></select>

                        </div>

                     </div>

                     <br>

                     <div class='row'>

                        <div class='col-sm-6' style='padding-top:7px;font-weight:bold;'>

                            &nbsp; <i class='fa fa-id-card-o'></i> Description
                        </div><div class='col-sm-4' style='padding-top:7px;font-weight:bold;'>

                            &nbsp; <i class='fa fa-id-card-o'></i> Picture 
                        </div>

                        <div class='col-sm-6'>

                            <textarea placeholder='Item description here...' class='form-control' rows='4' name='idescri'>$des</textarea>

                        </div>

						  <div class='col-md-4 text-center'><hr><input name='files' id='app_file' type='file' readonly='readonly' required><hr>
						
                     
              </div>

                     </div>

                                          
                     <br>

                     <div class='row'>

                        <div class='col-sm-12' style='text-align:center'><hr>

                          <input type='hidden' name='rowid' value='$code'> 
                     <button class='view-listing-button' type='submit' name='upda' style='border:1px solid #99ccff; width:240px; float:center; height:30px; border-radius:5px; font-size:18px;'><i class='fa fa-check-square-o'></i> &nbsp; Update  </button>
                        </div>

                     </div>

                </form>

            </div>

            <div class='modal-footer' style='color:#ccc; text-align:center;'> Please fill the form bellow in order to update an item

            </div>

        </div>

        <!-- /.modal-content -->

    </div>

    <!-- /.modal-dialog -->

</div>";