  <footer class="footer footer-static footer-light navbar-border navbar-shadow">
    <p class="clearfix blue-grey lighten-2 text-sm-center mb-0 px-2">
      <span class="float-md-left d-block d-md-inline-block">Copyright &copy; 2020 <a class="text-bold-800 grey darken-2" href="https://www.ur.ac.rw"
        target="_blank">URSTMS </a>, All rights reserved. </span>
      <span class="float-md-right d-block d-md-inline-blockd-none d-lg-block">In Work & Made with <i class="ft-heart blue"></i></span>
    </p>
  </footer>
<?php   // getting data to pre-fill the form
//   $staff = new Staff();
//   $staff_details = $staff->getStaffById($staf_id);
 ?>

                         <div id="update-staff-profile-modal" class="modal modal-adminpro-general modal-zoomInDown fade" role="dialog">
                              <div class="modal-dialog modal-md">
                                  <div class="modal-content">
                                      <div class="modal-close-area modal-close-df">
                                          <a class="close" data-dismiss="modal" href="#"><i class="fa fa-close"></i></a>
                                      </div>
                                      <div class="modal-body">
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
                                                                          <input id="update_staff_username" name="update_staff_username" type="text" class="form-control" placeholder="first name"  value="<?php echo (empty($staff_details[0]['username'] || $staff_details[0]['username'] == "") ? $staff_details[0]['stf_email'] : $staff_details[0]['username']  ); ?>" />
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
                                                                        <option  <?php echo $staff_details[0]['gender']=="Male" ? "selected" : "disabled";?> value="Male">Male</option>
                                                                        <option  <?php echo $staff_details[0]['gender']=="Female" ? "selected" : "disabled";?> value="Female">Female</option>                                                   
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
                                                                        
                                                                        <option id="<?php echo $positions[$key]["role_id"]; ?>" <?php echo $staff_details[0]['role_id'] == $positions[$key]["role_id"] ? "selected" : "disabled"; ?> > <?php echo $positions[$key]["role_name"]; ?> </option>

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
                                                                        <option id="<?php echo $departments[$key]["dept_id"]; ?>" <?php echo $departments[$key]["dept_id"] == $staff_details[0]['dept_id'] ? "selected" : "disabled"; ?> > <?php echo $departments[$key]["dept_name"]; ?> </option>
                                            
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
                                          </div>
                                          
                                      </div>
                                  </div>
                              </div>
                          