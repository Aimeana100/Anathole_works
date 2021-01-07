
<?php 
include('../Classes/DBController.php');
include('../Classes/Staff_class.php');
include('../Classes/Organisation_class.php');

if(isset($_POST['staff_id'])){
    $staff_id = $_POST['staff_id'];
    $staff = new Staff();
    $organisation = new Organisation();

    $staff_details = $staff->getStaffById($staff_id);
}
 ?>

 <div class="modal-login-form-inner">
                                                                                                           
 <div class="basic-login-inner modal-basic-inner">
     <h3>Update Profile </h3>
     
     <form id="update_staff_form" name="update-staff-profile-form" action="#">
         <div class="form-group-inner">
             <div class="row">
                 <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                     <label for="update_Emp_id" class="login2">Staff Id | code</label>
                 </div>
                 <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
                     <input type="text" type="text" name="update_Emp_id" class="Emp_id form-control" id="update_Emp_id" placeholder="Employee id" required  value="<?php echo($staff_details[0]['stf_id']); ?>" />
                 </div>
             </div>
         </div>
         <div class="form-group-inner">
             <div class="row">
                 <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                     <label class="login2" for="update_staff_username ">staff's Username</label>
                 </div>
                 <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
                     <input id="update_staff_username" name="update_staff_username" type="text" class="form-control" placeholder="usernamename"  value="<?php echo (empty($staff_details[0]['username'] || $staff_details[0]['username'] == "") ? $staff_details[0]['stf_email'] : $staff_details[0]['username']  ); ?>" readonly />
                 </div>
             </div>
         </div>

         <div class="form-group-inner">
             <div class="row">
                 <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                     <label class="login2" for="update_first_name ">First name</label>
                 </div>
                 <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
                     <input id="update_first_name" name="update_first_name" type="text" class="form-control" placeholder="first name"  value="<?php echo($staff_details[0]['stf_fname']); ?>" />
                 </div>
             </div>
         </div>

         <div class="form-group-inner">
             <div class="row">
                 <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                     <label class="login2" for="update_last_name ">Lastrst name</label>
                 </div>
                 <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
                     <input id="update_last_name" name="update_last_name" type="text" class="form-control" placeholder="last name"  value="<?php echo($staff_details[0]['stf_lname']); ?>" />
                 </div>
             </div>
         </div> 

         <div class="form-group-inner">
             <div class="row">
                 <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                 <label for="update_gender" class="login2">Gender</label>
                 </div>
                 <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
                 <select  id="update_gender" name="update_gender" data-placeholder="...select gender..." class="form-control chosen-seelect" tabindex="-1">
                   <option selected disabled value="">Select</option>
                   <option   value="Male">Male</option>
                   <option  value="Female">Female</option>                                                   
               </select>                                                                                        </div>
             </div>
         </div>

         <div class="form-group-inner">
             <div class="row">
                 <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                 <label for="update_Position" class="login2">Position</label>
                 </div>
                 <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
                 <select id="update_position" name="update_Position"   data-placeholder="Choose a Position ..." class="chosen-select" tabindex="-1">
                   <option value="">Select</option>

                   <?php
                       $positions = $organisation->getAllPositions();

                       if(!empty($positions)):
                       foreach($positions as $key => $value):
                   ?>
                   
                   <option id="<?php echo $positions[$key]["role_id"]; ?>" > <?php echo $positions[$key]["role_name"]; ?> </option>

                   <?php endforeach; endif; ?>
                   
                       
               </select>
               </div>
             </div>
         </div>


         <div class="form-group-inner">
             <div class="row">
                 <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                 <label for="update_Department" class="login2">Departement</label>
                 </div>
                 <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
                 <select id="update_departement" name="update_Department"   data-placeholder="Choose a deptmnt ..." class="chosen-select" tabindex="-1">
                   <option value="">Select</option>
                   <?php
                   $departments = $organisation->getAllDepartments();
                                               
                   if(!empty($departments)):
                   foreach($departments as $key => $value):
                   ?>               
                   <option id="<?php echo $departments[$key]["dept_id"]; ?>"> <?php echo $departments[$key]["dept_name"]; ?> </option>

                   <?php endforeach; endif; ?>
                                                   
               </select>
               </div>
             </div>
         </div>

         <div class="form-group-inner">
             <div class="row">
                 <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                     <label for="update_email" class="login2">Staff's Email</label>
                 </div>
                 <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
                     <input type="text" name="update_email" id="update_email" class="form-control" required pattern="[^@]+@[^@]+.[a-zA-Z]{2,6}" title=" 💯" placeholder="Staff Email" value="<?php echo($staff_details[0]["stf_email"]); ?>" />
                 </div>
             </div>
         </div>

         <div class="form-group-inner">
             <div class="row">
                 <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                     <label for="update_telphone" class="login2">Staff telphone</label>
                 </div>
                 <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
                     <input type="text" name="update_telphone" id="update_telphone"  class="form-control" required pattern="[^@]+@[^@]+.[a-zA-Z]{2,6}" data-mask="(999) 999-9999" title=""  value="<?php echo($staff_details[0]["stf_tel_no"]); ?>"  placeholder="Staff phone" />
                 </div>
             </div>
         </div>

                                         
         </div>



         <div class="login-btn-inner">
        <div class="row">
                 <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12"></div>
                 <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
                     <div class="login-horizental">
                         <input id="update-staff" type="button" onclick="UpdateStaffInfo()" name="register"  class="btn btn-sm btn-primary login-submit-cs" value="Update" />
                     </div>
                 </div>
             </div>
         </div>
     </form>


</div>

<script>
function UpdateStaffInfo() {
    let error  = [];
    var dept = $.trim($("#update_departement").children(":selected").attr("id"));
    var staff_id = $("#update_Emp_id").val();
    var staff_username = $("update_#staff_username").val();
    var staff_fname = $("#update_first_name").val();
    var staff_lname = $("#update_last_name").val();
    var staff_gender = $("#update_gender").children(":selected").attr("value");
    var staff_position = $("#update_position").children(":selected").attr("id");
    var staff_tel = $("#update_telphone").val();
    var staff_email = $("#update_email").val();
    var position_id = $('#update_position').val();
    console.log(dept+staff_id+staff_fname+staff_lname+staff_gender+staff_position+staff_tel+staff_email+position_id);
    
      if(staff_id.length == 0){
      error.push("<p>Staff Id not specified</p>");
       }
      if(staff_fname.length == 0){
        error.push("<p>First name can't be empty</p>");
      }
      if (staff_lname.length == 0) 
      {
          error.push("<p>Last name can't be empty</p>");
      }
      if (staff_gender == "") {
          error.push("<p>Select a gender</>");
      }
      if (staff_position == null) {
        error.push("<p>Position can't be empty</p>");
      }
      if(dept == null){
        error.push("<p>select departement</p>");
      }
      if( staff_tel == ""){
        error.push("<p>telphone can't be empty</p>");
      }
      if(staff_email ==0 ){
        error.push("<p>Email can't be empty</p>");
      }
      
      if(error.length !=0 )  {
      errorMessage = "";
      for(var i = 0; i < error.length; i++){
      errorMessage += error[i];
      }
      Lobibox.notify('error', {
        sound: false,
        size: 'large',
        width: 500,
        position: 'top right',
        msg: '<b> PLease Fill the form propery</b>'
    });

    
  }
  else{
    $.post("../scripts/save-staff-profile-edited.php", { Emp_id: staff_id, first_name: staff_fname,  last_name: staff_lname, email: staff_email, telphone: staff_tel, gender: staff_gender, Position: staff_position, Department: dept, username: staff_username,update: true},
    function(data) {
        alert(data);
        $("#wait").css("display","none");
        Lobibox.notify('success', {
          size: 'large',
           width: 500,
          position: 'top right',
          msg: data

    });
    //        $("#success-message").css("display","block")
//          	$("#success-message span").html(data);
         	  //  $("#update_staff_form")[0].reset();
//          	$(window).scrollTop(0)
//          	$("html, body").animate({
    //     scrollTop: $("#success-message").offset().top
    // }, 1000);
  });
  }
}

</script>
