
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


// function to add a staff
function AddStaff(){
  let error = [];
  var dept = $("#departement").children(":selected").attr("id");
  var staff_id = $("#Emp_id").val();
  var staff_fname = $("#first_name").val();
  var staff_lname = $("#last_name").val();
  var staff_gender = $("#gender").children(":selected").attr("value");
  var staff_position = $("#position").children(":selected").attr("id");
  var staff_tel = $("#telphone").val();
  var staff_email = $("#email").val();
  var position_id = $('#position').val();

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
      msg: '<b> PLease Fill out the form propery</b>'
  });
}
else{
  $("#wait").css("display","block");
  $.post("../scripts/save-new-staff.php", { Emp_id: staff_id, first_name: staff_fname,  last_name: staff_lname, email: staff_email, telphone: staff_tel, gender: staff_gender, Position: staff_position, Department: dept, insert_staff: true},
  function(data){
    alert(data);
    $("#wait").css("display","none");
    Lobibox.notify('success', {
      sound: false,
      width: 500,
      position: 'top right',
      msg: data
  });
    // $("#add-staff-form-fill")[0].reset();
    $(window).scrollTop(0)
  //   $("html, body").animate({
  //   scrollTop: $("#success-message").offset().top
  // }, 1000);
  });
}
      
}
