<!-- 

  <div class="app-content content">
    <div style="padding-top: 10px;" class="content-wrapper"> -->

      <!-- <div style="background: #0d0d0d" class="content-header row ">
        <div class="content-header-left col-md-6 col-12 mb-2 breadcrumb-new">
          <h3 style="font-family: Anton;" class=" content-header-title mb-0 d-inline-block text-white">Add New Staff </h3>
          <div class="row breadcrumbs-top d-inline-block">
            <div class="breadcrumb-wrapper col-12">
              <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="dashboard.php">Dashboard</a>
                </li>
                </li>
                <li class="breadcrumb-item active">New Staff Form</li>
              </ol>
            </div>
          </div>
        </div>
    
      </div>
      
      <div style="background: white; border: 1px solid black; padding-bottom: 0px; padding-top: 0px" class="content-body container-fluid"> -->

        <!-- <section  style="color: black; margin-top: 0px" class="card"> -->

      



<!-- 
<div id="success-message" class="text-center" id="message"> <span class="alert alert-success"  role="alert" ></span></div>

<div id="danger-message" class="text-center" > <span class="alert alert-danger"  role="alert" id="errors" ></span></div> -->
<div class="page-content" style="padding:0%; margin-top:0px; ">
		<div class="form-v10-content" style="padding-top :0%; margin-top:4px; border: none; box-shadow: none;">

			
			<form class="form-detail validate-form " action="" method="post" id="myform" name="regform" enctype="multipart/form-data" valid_form() >
                <div style="" class="form-right">
					<h2>General Staff Infomation</h2>

					 <div class="form-row">
						<label for="Emp_id">Staff Id | code</label>
						<input type="text" name="Emp_id" class="Emp_id" id="Emp_id" placeholder="Employee id" required onblur="return  GEEKFORGEEKS() " >
					</div>
				
					<div class="form-group">
						<div class="form-row form-row-1">
							<label for="first_name">Staff first name</label>
							<input type="text" name="first_name" id="first_name" class="input-text" placeholder="First Name" required>
						</div>
					    <div class="form-row form-row-2">
							<label for="staff last name">Staff last name</label>
							<input type="text" name="last_name" id="last_name" class="input-text" placeholder="Last Name" required="true">
					    </div>
					</div>
					

					<div class="form-group">
					<div class="form-row form-row-1">
						<label for="gender"> Gender</label>
						<select id="gender" name="gender">
						    <option class="option" value="" selected  disabled style="color :blueviolet; opacity : .4; ">---select Gender---</option>
						    <option class="option" value="Male">Male</option>
						    <option class="option" value="Female">female</option>
						</select>
						<span class="select-btn">
						  	<i class="zmdi zmdi-chevron-down"></i>
						</span>
					</div>

					<div class="form-row form-row-2">
						<label for="Department"> Depertement</label>
						<select id="departement" name="Department" >
						    <option class="option" value=""  selected disabled style="color :blueviolet; opacity : .4 ">---select depertment---</option>
                                     
							<?php
							$departments = $organisation->getAllDepartments();
							
							 if(!empty($departments)):
							 foreach($departments as $key => $value):
                            ?>
                               
                              <option id="<?php echo $departments[$key]['dept_id'];?>"> <?php echo $departments[$key]['dept_name']; ?> </option>

							  <?php  endforeach; endif; ?>
							  
						</select>
						<span class="select-btn">
						  	<i class="zmdi zmdi-chevron-down"></i>
						</span>
					</div> 



				</div>


					<div class="form-row">
						<label for="Position"> Position</label>
						<select id="position" name="Position">
						    <option value="" selected disabled style="color :blueviolet ; opacity : 0.1 ">---select Position ---</option>
                                    
							<?php

								$positions = $organisation->getAllPositions();

								if(!empty($positions)):
								foreach($positions as $key => $value):
                            ?>
                               
                              <option id="<?php  echo $positions[$key]['role_id']; ?>"> <?php echo $positions[$key]['role_name']; ?> </option>

							  <?php  endforeach; endif; ?>
							  
			

						</select>
						<span class="select-btn">
						  	<i class="zmdi zmdi-chevron-down"></i>
						</span>

					</div>

					<div class="form-group ">
					<div class="form-row form-row-1">
						<label for="email">Staff's Email</label>
						<input type="text" name="email" id="email" class="input-text" required pattern="[^@]+@[^@]+.[a-zA-Z]{2,6}" placeholder="staff Email">

					</div>

					<div class="form-row form-row-2 input-group">
						<label for="telphone">Staff telphone</label>
						<input type="text" name="telphone" id="telphone" class=" telphone form-control" data-mask="(999) 999-9999" required placeholder="telphone">

					</div>
				</div>

					<div class="form-row-last">
						<input id="add-staff" type="button" onclick="AddStaff();" name="register" class="register btn" value="Register">
					</div>


				</div>
				
			</form>
		</div>
	</div>

	
	<!-- </section> -->
    
	<!-- </div> -->




<!-- </div>
</div>
 -->




	<script>

// $(document).ready(function(){
//   $(document).ajaxStart(function(){
//     $("#wait").css("display", "block");
//   });
//   $(document).ajaxComplete(function(){
//     $("#wait").css("display", "none");
//   });
// });


//   function AddStaff(){
	  	  
// 		var dept = $("#departement").children(":selected").attr("id");
// 		var staff_id = $("#Emp_id").val();
// 		var staff_fname=$("#first_name").val();
// 		var staff_lname=$("#last_name").val();
// 		var staff_gender=$("#gender").children(":selected").attr("value");
// 		var staff_position=$("#position").children(":selected").attr("id");
// 		var staff_tel=$("#telphone").val();
// 		var staff_email = $("#email").val();
// 		var position_id =$('#position').val();	
// 		$("#wait").css("display","block");
// 		$.post("scripts/save-new-staff.php", { Emp_id: staff_id, first_name: staff_fname,  last_name: staff_lname, email: staff_email, telphone: staff_tel, gender: staff_gender, Position: staff_position, Department: dept, insert_staff: true},
// 		function(data){
// 			alert(data);
// 			$("#wait").css("display","none");
			// $("#wait").html(data);
			// $("#myform")[0].reset();
			// $(window).scrollTop(0)
		// 	$("html, body").animate({
		// 	scrollTop: $("#success-message").offset().top
		// }, 1000);
		// });
 }</script>


	<?php

 	
	?>