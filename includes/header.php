<nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top" id="mainNav" >
    <a class="navbar-brand" href="#"><img src="img/logo1.jpg" alt="" width="25"/> Doctor Appointment System</a>
    <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarResponsive">
        <ul class="navbar-nav navbar-sidenav" id="exampleAccordion" style="overflow-y: scroll;">
            
        
        <?php if ($_SESSION ['role'] == 'doctor'){?>
            <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Home">
          <a class="nav-link" href="DoctorHome.php">
            <i class="fa fa-fw fa-home"></i>
            <span class="nav-link-text">Home</span>
          </a>
        </li>
        <li class="nav-item" data-toggle="tooltip" data-placement="right" title="notifications">
          <a class="nav-link" href="doctor-notifications.php">
            <i class="fa fa-fw fa-bell-o"></i>
            <span class="nav-link-text">Notifications</span>
          </a>
        </li>
        <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Add Doctor/Receptionist">
          <a class="nav-link nav-link-collapse collapsed" data-toggle="collapse" href="#collapseComponents" data-parent="#exampleAccordion">
            <i class="fa fa-fw fa-wrench"></i>
            <span class="nav-link-text">Add Patient</span>
          </a>
          <ul class="sidenav-second-level collapse" id="collapseComponents">
            <li>
              <a href="user-list-patient.php">Patients' list</a>
            </li>            
            <li>
              <a href="patient-registration.php">Add Patient</a>
            </li>
          </ul>
        </li>
        <li class="nav-item" data-toggle="tooltip" data-placement="right" title="report">
            <a class="nav-link" href="doctor-report.php">
            <i class="fa fa-fw fa-file-text"></i>
            <span class="nav-link-text">Report</span>
          </a>
        </li>
        <?php }?>
        
        <?php if ($_SESSION ['role'] == 'patient'){?>
        <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Home">
          <a class="nav-link" href="home.php">
            <i class="fa fa-fw fa-home"></i>
            <span class="nav-link-text">Home</span>
          </a>
        </li>
        <li class="nav-item" data-toggle="tooltip" data-placement="right" title="MakeAppointment">
          <a class="nav-link" href="MakeAppointment.php">
            <i class="fa fa-fw fa-edit"></i>
            <span class="nav-link-text">Make an Appointment</span>
          </a>
        </li>
        <li class="nav-item" data-toggle="tooltip" data-placement="right" title="notifications">
            <a class="nav-link" href="patient-notifications.php">
            <i class="fa fa-fw fa-bell-o"></i>
            <span class="nav-link-text">Notifications</span>
          </a>
        </li>
        <li class="nav-item" data-toggle="tooltip" data-placement="right" title="report">
            <a class="nav-link" href="patient-report.php">
            <i class="fa fa-fw fa-file-text"></i>
            <span class="nav-link-text">Report</span>
          </a>
        </li>
        <?php }?>
        
        <?php if ($_SESSION ['role'] == 'receptionist'){?>
        <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Home">
            <a class="nav-link" href="ReceptionistHome.php">
            <i class="fa fa-fw fa-home"></i>
            <span class="nav-link-text">Home</span>
          </a>
        </li>
        <li class="nav-item" data-toggle="tooltip" data-placement="right" title="notifications">
            <a class="nav-link" href="receptionist-notifications.php">
            <i class="fa fa-fw fa-bell-o"></i>
            <span class="nav-link-text">Notifications</span>
          </a>
        </li>
        <li class="nav-item" data-toggle="tooltip" data-placement="right" title="report">
            <a class="nav-link" href="receptionist-report.php">
            <i class="fa fa-fw fa-file-text"></i>
            <span class="nav-link-text">Report</span>
          </a>
        </li>
        <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Add Doctor/Receptionist">
          <a class="nav-link nav-link-collapse collapsed" data-toggle="collapse" href="#collapseComponents" data-parent="#exampleAccordion">
            <i class="fa fa-fw fa-wrench"></i>
            <span class="nav-link-text">Add Users</span>
          </a>
          <ul class="sidenav-second-level collapse" id="collapseComponents">
              <li>
              <a href="user-list.php">Users' list</a>
            </li>
            <li>
              <a href="doctor-registration.php">Add Doctor</a>
            </li>
            <li>
              <a href="receptionist-registration.php">Add Receptionist</a>
            </li>
            <li>
              <a href="patient-registration.php">Add Patient</a>
            </li>
          </ul>
        </li>
        <?php }?>
        
        
        
        <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Change Password">
            <a class="nav-link" href="change-password.php">
            <i class="fa fa-fw fa-lock"></i>
            <span class="nav-link-text">Change Password</span>
          </a>
        </li>
        
        
        <li class="nav-item" data-toggle="tooltip" data-placement="right" title="logout">
          <a class="nav-link" href="logout.php">
            <i class="fa fa-fw fa-sign-out"></i>
            <span class="nav-link-text">Log out</span>
          </a>
        </li>
      </ul>        
    </div>
  </nav>

