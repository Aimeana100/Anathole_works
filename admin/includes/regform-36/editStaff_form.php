<?php 
   // getting data to pre-fill the form
  $staff = new Staff();
  $staff_details = $staff->getStaffById($staf_id);

?>

<div class="page-content" style="padding-top :0%; margin-top:0px;  ">
		<div class="form-v10-content" style="padding-top :0%; margin-top:4px; display: gradient">

			
		
			<form class="form-detail validate-form " action="" method="post" id="myform" name="regform" enctype="multipart/form-data" valid_form() >


				<div class="form-right">
					<h2>General Staff Infomation</h2>

					<div class="form-group">
					<div class="form-row form-row-1">
						<label class="text-light" for="Emp_id">staff code | Id</label>
						<input type="text" name="Emp_id" class="Emp_id" id="Emp_id" placeholder="Employee id" value="<?php echo($staff_details[0]['stf_id']); ?>" required onblur="return  GEEKFORGEEKS()" >
					</div>

					<div class="form-row form-row-2">
						<label class="text-light" for="staff_username">staff username</label>
						<input type="text" name="staff_username" class="staff_username" id="staff_username" placeholder="staff username" value="<?php echo (empty($staff_details[0]['username']) ? empty($staff_details[0]['username']) : $staff_details[0]['stf_email']); ?>" required onblur="return  GEEKFORGEEKS()" >
					</div>
				</div>
				
					<div class="form-group">
						<div class="form-row form-row-1">
							<label class="text-light" for="first_name">Staff first name</label>
							<input type="text" name="first_name" id="first_name" class="input-text" placeholder="First Name" value="<?php echo($staff_details[0]['stf_fname']); ?>" required>
						</div>
						<div class="form-row form-row-2">
							<label class="text-light" for="last_name">Staff last name</label>
							<input type="text" name="last_name" id="last_name" class="input-text" placeholder="Last Name" value="<?php echo($staff_details[0]['stf_lname']); ?>" required="true">
						</div>
					</div>
				
					<div class="form-group">
					<div class="form-row form-row-1">
						<label class="text-light" for="gender">Gender</label>
						<select id="gender" name="gender">
						    <option class="option" value="" selected  disabled style="color :blueviolet; opacity : .4; ">---select Gender---</option>
						    <option class="option" <?php echo $staff_details[0]['gender']=="Male" ? "selected" : "disabled";?> value="Male">Male</option>
						    <option class="option" <?php echo $staff_details[0]['gender']=="Female" ? "selected" : "disabled";?> value="Female">female</option>
						</select>
						<span class="select-btn">
						  	<i class="zmdi zmdi-chevron-down"></i>
						</span>
					</div>

					<div class="form-row form-row-2">
						<label class="text-light" for="Department">Depertement</label>
						<select id="departement" name="Department" >
						    <option class="option" value=""  selected disabled style="color :blueviolet; opacity : .4 ">---select depertment---</option>
                                    
							<?php

							$departments = $organisation->getAllDepartments();
														
							if(!empty($departments)):
							foreach($departments as $key => $value):
							?>               
                              <option id="<?php echo $departments[$key]["dept_id"]; ?>" <?php echo $departments[$key]["dept_id"] == $staff_details[0]['dept_id'] ? "selected" : "disabled"; ?> > <?php echo $departments[$key]["dept_name"]; ?> </option>

							  <?php endforeach; endif; ?>
							  
						</select>
						<span class="select-btn">
						  	<i class="zmdi zmdi-chevron-down"></i>
						</span>
					</div>



				</div>

					<div class="form-row">
						<label class="text-light" for="Position">Position</label>
						<select id="position" name="Position">
						    <option value=""  selected disabled style="color :blueviolet ; opacity : 0.1 ">---select Position ---</option>
                                    
							<?php
								$positions = $organisation->getAllPositions();

								if(!empty($positions)):
								foreach($positions as $key => $value):
                            ?>
                               
                              <option id="<?php echo $positions[$key]["role_id"]; ?>" <?php echo $staff_details[0]['role_id'] == $positions[$key]["role_id"] ? "selected" : "disabled"; ?> > <?php echo $positions[$key]["role_name"]; ?> </option>

							  <?php endforeach; endif; ?>
							  
			

						</select>
						<span class="select-btn">
						  	<i class="zmdi zmdi-chevron-down"></i>
						</span>

					</div>

					<div class="form-group ">


					<div class="form-row form-row-1">
						<label class="text-light" for="email">Email</label>
						<input type="text" name="email" id="email" class="input-text" required pattern="[^@]+@[^@]+.[a-zA-Z]{2,6}" placeholder="Your Email" value="<?php echo($staff_details[0]["stf_email"]); ?>" >

					</div>

					<div class="form-row form-row-2 input-group">
						<label class="text-light" for="telphone">Mobile phone</label>
						<input type="text" name="telphone" id="telphone" class=" telphone form-control" data-mask="(999) 999-9999" required placeholder="telphone" value="<?php echo($staff_details[0]["stf_tel_no"]); ?>" >

					</div>
				</div>

					<div class="form-row-last">
						<input id="add-staff" type="button" onclick="UpdateStaffInfo();" name="update" class="register btn" value="update">
					</div>
				</div>

<div id="wait" style="z-index:100;display:none;width:69px;height:89px;border:1px solid black;position:absolute;top:50%;left:50%;padding:2px;"><img src='ajax-loader.gif' width="64" height="64" /><br>Loading..</div>

			</form>
		</div>
	</div>



	<script>
$(document).ready(function(){
  $(document).ajaxStart(function(){
    $("#wait").css("display", "block");
  });
  $(document).ajaxComplete(function(){
    $("#wait").css("display", "none");
  });
});


  function UpdateStaffInfo() {
                var dept = $.trim($("#departement").children(":selected").attr("id"));
                var staff_id = $("#Emp_id").val();
                var staff_username = $("#staff_username").val();
                var staff_fname=$("#first_name").val();
                var staff_lname=$("#last_name").val();
                var staff_gender=$("#gender").children(":selected").attr("value");
                var staff_position=$("#position").children(":selected").attr("id");
                var staff_tel=$("#telphone").val();
                var staff_email = $("#email").val();
                var position_id =$('#position').val();
                // alert(dept+staff_id+staff_fname+staff_lname+staff_gender+staff_position+staff_tel+staff_email+position_id);
                
                $.post("scripts/save-staff-profile-edited.php", { Emp_id: staff_id, first_name: staff_fname,  last_name: staff_lname, email: staff_email, telphone: staff_tel, gender: staff_gender, Position: staff_position, Department: dept, username: staff_username,update: true},
                function(data) {
                	alert(data);
       //          	$("#success-message").css("display","block")
       //          	$("#success-message span").html(data);
       //          	$("#myform")[0].reset();
       //          	$(window).scrollTop(0)
       //          	$("html, body").animate({
			    //     scrollTop: $("#success-message").offset().top
			    // }, 1000);
                });
            }

	 	</script>


	<?php

 	
	?>