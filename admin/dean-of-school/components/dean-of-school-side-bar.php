<div class="main-menu menu-fixed menu-dark menu-accordion menu-shadow" data-scroll-to-active="true">
    <div  class="main-menu-content">

      <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">

       
         <li style="padding-bottom: 3px;" class=" depertment-name nav-item">
        <a href="staff.php"><i class="la la-home"></i><span class="menu-title" data-i18n="nav.dash.main">
       
       <?php
       if(isset($staff_details)) {
         $depertement = $staff_details[0]["dept_name"];
         }
        if (!empty($depertement)) {
          echo $depertement;
          } ?>
          
        </span></a>
        </li>

     
        <li class=" nav-item"><a href="index.php"><i class="la la-envelope"></i><span class="menu-title" data-i18n="nav.dash.main">All Requests</span></a>
        </li>

        <li class=" nav-item"><a href="school-staffs.php"><i class="la la-envelope"></i><span class="menu-title" data-i18n="nav.dash.main">Dept Staffs</span></a>
        </li>

        <li class=" nav-item"><a href="school-reports.php"><i class="la la-envelope"></i><span class="menu-title" data-i18n="nav.dash.main">Dept reports</span></a>
        </li>


        <!-- end of options close to HOD -->


        <li style="padding-bottom: 3px;" class=" depertment-inbox depertment-name nav-item">
        <a href="hod-inbox.php"><i class="la la-home"></i>
        <span class="menu-title" data-i18n="nav.dash.main">My Inbox </span></a>
        </li>

        <li class=" nav-item"><a href="dean-inbox-requests.php"><i class="la la-envelope"></i><span class="menu-title" data-i18n="nav.dash.main">My Requests</span></a>
        </li>
        <li class=" nav-item"><a href="dean-inbox-reports.php"><i class="la la-envelope"></i><span class="menu-title" data-i18n="nav.dash.main">My reports</span></a>
        </li>
        <li class=" nav-item"><a href="?option=change-password"><i class="la la-envelope"></i><span class="menu-title" data-i18n="nav.dash.main">Change password</span></a>
        </li>

    <li class=" nav-item"><a href="../../logout.php"><i class="la la-envelope"></i><span class="menu-title" data-i18n="nav.dash.main">logout</span></a>
    </li>

   
      </ul>
    </div>
  </div>