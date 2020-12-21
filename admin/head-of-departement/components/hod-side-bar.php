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

     
        <li class=" nav-item"><a href="staff.php?option=requests"><i class="la la-envelope"></i><span class="menu-title" data-i18n="nav.dash.main">All Requests</span></a>
        </li>

             <li class=" nav-item"><a href="#"><i class="la la-envelope"></i><span class="menu-title" data-i18n="nav.page_headers.main">Manage Staffs</span></a>
          <ul class="menu-content">
            <li><a class="menu-item" href="staff.php?option=add_staff" data-i18n="nav.page_headers.headers_breadcrumbs_basic">Add staff</a>
            </li>
            <li><a class="menu-item" href="staff.php?option=staffs" data-i18n="nav.page_headers.headers_breadcrumbs_top">All Staffs</a>
            </li>
          </ul>
        </li>

         <li class=" nav-item"><a href="#"><i class="la la-download"></i><span class="menu-title" data-i18n="nav.footers.main">completed Report</span></a>
          <ul class="menu-content">
            <li><a class="menu-item" href="select-dates.php" data-i18n="nav.footers.footer_light">Between Dates</a>
            </li>

            <li><a class="menu-item" href="search.php" data-i18n="nav.footers.footer_dark">Search</a>
            </li>
              <li><a class="menu-item" href="staff.php?option=all_reports" data-i18n="nav.footers.footer_dark">All Report </a>
            </li>
         
          </ul>
        </li>


        <!-- end of options close to HOD -->


    

    <li style="padding-bottom: 3px;" class=" depertment-inbox depertment-name nav-item">
        <a href="staff.php"><i class="la la-home"></i>
        <span class="menu-title" data-i18n="nav.dash.main">My Inbox </span></a>
        </li>


        <li class=" nav-item">
        
         <a href="#" class=" active"><i class="la la-envelope"></i><span class="menu-title" data-i18n="nav.page_headers.main">My Requests</span></a>
          <ul class="menu-content">

          <li><a class="menu-item" href="hod-request-form.php" data-i18n="nav.page_headers.headers_breadcrumbs_basic">Create New Request</a>
            </li>


        <li><a class="menu-item" href="staff-all-requests.php" data-i18n="nav.page_headers.headers_breadcrumbs_basic">All requests</a>
            </li>

        <li><a class="menu-item" href="hod-approved.php" data-i18n="nav.page_headers.headers_breadcrumbs_top">
        Approved request</a>
            </li>
         <li><a class="menu-item" href="hod-disapprove.php" data-i18n="nav.page_headers.headers_breadcrumbs_top">
        Disapproved request</a>
            </li> 

          </ul>
        </li>

         <li class=" nav-item"><a href="#"><i class="la la-download"></i><span class="menu-title" data-i18n="nav.footers.main">report submition</span></a>
          <ul class="menu-content">

            <li><a class="menu-item" href="search.php" data-i18n="nav.footers.footer_dark">Search request</a>
            </li>
              <li><a class="menu-item" href="hod-completed.php" data-i18n="nav.footers.footer_dark"> reported Mission </a>
            </li>
         
          </ul>
        </li>

        <li class=" nav-item"><a href="change-password.php"><i class="la la-envelope"></i><span class="menu-title" data-i18n="nav.dash.main">Change password</span></a>
        </li>

    <li class=" nav-item"><a href="logout.php"><i class="la la-envelope"></i><span class="menu-title" data-i18n="nav.dash.main">logout</span></a>
    </li>

   
      </ul>
    </div>
  </div>