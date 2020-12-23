
       <form method="POST" id="staff-form-request" name="staff-form-request" >  
        <div class="container-fluid" id="request" >  
 
               <div class="row">
               <div class="col-md-3 col-xs-3 col-3 pl-1  col-3 col-lg-3"> 
                    
                <img src="../../images/UR-logo2.jpeg" width="100%" class=" ml-0 mx-auto "> 
              </div>
            <div class="col-md-9 col-xs-9 col-9 col-9 col-lg-9 pr-0 pt-30 mr-0" >
                  <h4 style="margin-top: 5%;color: black;font-family: Crimson Text" class="float-right mr-1 "><b> COLLEGE OF SCIENCE AND TECHNOLOGY</b></h4>
            </div>
            </div>
            <hr style="border: 2px solid #3385ff;border-radius: 1px;" class="hol1">
            
            <div class="row mt-1 " >
                  <div class="col-12 mr-0 mx-auto"><h5 class="text-center text-body" style="font-size : 100%; color: #000000;font-family: Crimson Text" ; ><b>IN-COUNTRY MISSION AUTHORIZATION FORM</b></h5> </div>
            </div>

      <div class="row mx-auto mt-2">
                
        <div class="col-8 mx-auto text-center text-body">
        <span style="color: #000000" ><b>  Mission Serial N<sup>o</sup>  &nbsp</b>  
             ........
          </span> 
            </div>
                
        </div>


     
      <div class="row pl-4">
        <div  class="col-lg-2 col-md-4 col-sm-4 col-xs-6">  <b><span class="" style="color: #000000" >1.</span></b>&nbsp <span style="color: #000000" classs="blanked" >Issued to </span>
        </div>
        <div class="col-lg-10 col-md-7 col-sm-8 col-xs-6"> 
          <b> 
           <?php echo $staff_details[0]["stf_fname"]." ".$staff_details[0]["stf_lname"]."  "; ?> </b>
             <span> signature</span>
           <span> <?php echo "signs" ?></span>
        </div>
        </div>

      <div class="row pl-4">  </div>

      <div class="row pl-4">
      <div class="col-lg-3 col-md-4 col-sm-4 col-xs-4">
      <b>2. </b> <span>Department: </span>
      </div>
      <div  class="col-lg-9 col-md-7"><b><?php echo $staff_details[0]["dept_name"]." / ".$staff_details[0]["scl_name"] ; ?></b>
      </div>
      </div>

      <div class="row pl-4">
      <div class="col-lg-3 col-md-4 col-sm-4 col-xs-4">
      <b>3. </b> <span>Function: </span>
      </div>
      <div  class="col-lg-9 col-md-7 col-sm-8 col-xs-8 "><b><?php echo $staff_details[0]["role_name"]; ?></b>
      </div>
      </div>

      <div class="row pl-4">
      <div class="col-lg-4 col-md-5 col-sm-6 col-xs-7">
      <b>04. </b> <span>Purpose of the Mission </span>
      </div>
      <div  class="col-lg-8 col-md-7 col-sm-6 col-xs-12">
        <textarea style="width: 100%"  id="req_purpose" name="req-purpose" row="2" cols="" title="purpose is mandatory" > </textarea>
      </div>
      </div>

       <div class="row pl-4">
      <div class="col-lg-4 col-md-5 col-sm-6 col-xs-7">
      <b>05. </b> <span>Expected Result </span>
      </div>
      <div  class="col-lg-8 col-md-7 col-sm-6 col-xs-12">
        <textarea style="width: 100%" id="exp-result" name="exp-result" col="5" row="2" cols="" title="expected result is mandatory" > </textarea>
      </div>
      </div>


       <div class="row pl-4">
      <div class="col-lg-4 col-md-5 col-sm-6 col-xs-7">
      <b>06. </b> <span> Destination </span>
      </div>

      <div  class="col-lg-8 col-md-7 col-sm-6 col-xs-12">

      <select class="form-control col-6 " id="destination" name="destination" >
      <option value="" selected disabled="true" > ..select the destination.. </option>

          <?php
          $destinations = $request->getAllDestination();
          if(!empty($destinations)):
        
        foreach($destinations as $key => $value):
            ?>
        <option value="<?php echo $destinations[$key]["des_id"];?>">
         <?php echo $destinations[$key]["des_name"]; ?> </option>

       <?php endforeach; endif ?>    
        </select>
        
      </div>
      </div>


       <div class="row pl-4">
      <div class="col-lg-4 col-md-5 col-sm-6 col-xs-7">
      <b>07. </b> <span>Distance in KM (to and from) </span>
      </div>
      <div  class="col-lg-8 col-md-7 col-sm-6 col-xs-12">
        <span><input class="form-control col-6" id="distance-of-travel" type="number" name="distance-of-travel" placeholder="........"></span>
        
      </div>
      </div>


      <div class="row pl-4">
      <div class="col-lg-4 col-md-5 col-sm-6 col-xs-6">
      <b>08. </b> <span>Departue date </span>
      </div>
      <div class="col-lg-4 col-md-5 col-sm-6 col-xs-6">
      <b>09. </b> <span>Return date </span>
      </div>
      </div>

      <div class="row pl-4 data-custon-pick data-custom-mg" id="data_5">
              
              <div class="input-daterange input-group pl-3" id="datepicker">
                  <input id="destination-departure-date" type="text" class="" name="start" value="05/14/2014" />
                  <span class="input-group-addon ml-0 mr-0">to</span>
                  <input id="destination-return-date" type="text" class="" name="end" value="05/22/2014" />
              </div>
         </div>



      <div class="row pl-4">
      <div class="col-lg-6 col-md-8 col-sm-8 col-xs-11">
      <b>10. </b> <span> Duration of the mission (Number of days)</span>
      </div>
      <div  class="col-lg-6 col-md-6 col-sm-4 col-xs-8">
        <input class="form-control col-lg-4 col-md-6 "  id="mission-duration" type="number" name="mission-duration" min="1" placeholder="00">
      </div>
      </div>



      <div class="row pl-4">
      <div class="col-lg-4 col-md-5 col-sm-6 col-xs-7">
      <b>11. </b> <span>Transiportaton  means </span>
      </div>

      <div  class=" col-lg-8 col-md-7 col-sm-6 col-xs-12">
        <div class="col-12">
      <label style="padding: 4px;" class="co-4 " ><input type="radio" value="1" name="transiportation">public </label>
      <label style="padding: 4px;" class="co-4 " ><input type="radio" value="2" name="transiportation">private </label>
      <label style="padding: 4px;" class="co-4 " ><input type="radio" value="3" name="transiportation">provided </label>
      </div>

  
      </div>
      </div>



      <div class="row pl-4">
      <div class="col-lg-4 col-md-5 col-sm-6 col-xs-7">
      <b>12. </b> <span>Vehicle Identification </span>
      </div>
      <div  class="col-lg-8 col-md-7 col-sm-6 col-xs-12">
      <span>.............</span>
        
      </div>
      </div>


      <div class="row pl-4">
      <div class="col-lg-4 col-md-5 col-sm-6 col-xs-7">
      <b>13. </b> <span> Name of Driver </span>
      </div>
      <div  class="col-lg-8 col-md-7 col-sm-6 col-xs-12">
      <span>.............</span>
        
      </div>
      </div>




        <div class="row pl-4">
        <div  class="col-lg-4 col-md-4 col-sm-4 col-xs-4"> 
         <b><span class="blanked" style="color: #000000" >14.</span></b>&nbsp
          <span style="color: #000000" classs="blanked" >Name of Supervisor </span>
        </div>
        <div class="col-lg-8 col-md-7 col-sm-8"> 
          <b> 


          <?php 
          if(isset($staff_hod_details))
          {

          echo $staff_hod_details[0]["stf_fname"] ." ".$staff_hod_details[0]["stf_lname"]."  "; 

          }
          else{
            echo "hod not registered";
          }


          ?> </b>
          <span> signature</span>
           <span> <?php echo "signs" ?></span>

            
        </div>
        </div>

       



        <div class="row pl-4">
      <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
      <b>15. </b> <span> <b><u> Authorized by VC/DVCs/ Principal or Campus Director of operations </u></b> </span>
      </div>
      <div  class="text-center mt-1 col-lg-12 col-md-12 col-sm-12 col-xs-12">
          <b>
         <?php if(isset($staff_principal_details))
         {
           echo $staff_principal_details[0]["stf_fname"]." ".$staff_principal_details[0]["stf_lname"]." " ;
         }
         else{
          echo " Principal not registered";
         }
          ?>
          </b>
          <span> signature</span>
           <span> <?php echo "signs" ?></span>
        </div>
        
      </div>
      

        <div class="row pl-4">
        <div  class="col-lg-4 col-md-4 col-sm-4 col-xs-4">  <b><span class="blanked" style="color: #000000" >16.</span></b>&nbsp <span style="color: #000000" classs="blanked" ><u><b>Acknowledged by HR </b></u> </span>
        </div>
        <div class="col-lg-8 col-md-7 col-sm-8"> 
          <b> 
          <?php

          if(isset($staff_HR_details))
          {
                      echo $staff_HR_details[0]["stf_fname"]." ".$staff_HR_details[0]["stf_lname"]."  "; 
          }
          else{
            echo "HR not registred";
          }



          ?> </b>
          <span> signature</span>
           <span> <?php echo "signs" ?></span>
        </div>
        </div>


        <div class="row pl-4">
          <div class="col-lg-6 col-md-4 col-sm-2 col-xs-12"></div>
          <div class="col-lg-6 col-md-8 col-sm-10 col-xs-12">
                  <div class="col-12 pt-1 "><b>Visa for Destination</b></div>
                  <div class="col-12  "><b>Stamp and Signature</b></div>
                  <div class="col-12 pt-1 ">Arrival Date .....</div>
                  <div class="col-12 pt-1 ">Depature date ..... .</div>
            
          </div>
        </div>

  
    </div>


    
  <div class="text-center"><button  type="button" onclick="SubmitFormRequest()" class="btn btn-primary">Submit request</button></div>
 
  </form>