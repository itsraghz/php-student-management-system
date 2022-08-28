<!--<div id="menu" class="menu">
  <ul>
      <li><a href='home.php'>Home</a></li>
      <li><a href='profile.php'>Profile</a></li>
      <li>Attendance</li>
      <li>Fees</li>
      <li>Activities</li>-->
      <!--<li><a href='Requirements.md'>Requirements</a><li>
      <li><a href='References.php'>References</a><li>-->
      <!--<li><a href='VersionHistory.php'>Version History</a></li>
      <li><a href='logout.php'>Logout</a></li>
  </ul>
</div>
<div class="clear"/>
<hr color=blue/>
-->
<nav class="navbar navbar-inverse navbar-fixed-top">
  <div class="container">
    <div class="navbar-header">
      <!--<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>-->
      <a class="navbar-brand" href="<?php echo DOCUMENT_ROOT . '/home.php';?>">PHP SMS (Home)</a>
    </div>
    <div id="navbar" class="collapse navbar-collapse">
      <ul class="nav navbar-nav">
        <li class="active"><a href="<?php echo DOCUMENT_ROOT . '/home.php';?>">Home</a></li>

        <?php
          $isUserAStaff = Util::isUserAStaff();
          $isUserNotAStudent = Util::isUserNotAStudent();
        ?>
        <li class="nav-item dropdown">
           <!-- Reference: https://bootstrap-menu.com/detail-basic-hover.html -->
           <!--<a class="nav-link  dropdown-toggle" href="#" data-bs-toggle="dropdown">Student &nbsp;<i class="arrow down"></i></a>-->
           <a class="nav-link  dropdown-toggle" href="#" data-bs-toggle="dropdown"><div id="downarrow"><span>Profile</span></div></a>
            <ul class="dropdown-menu">
              <li><a class="dropdown-item" href="<?php echo DOCUMENT_ROOT . '/profile/view.php';?>">View Profile</a></li>
              <li><a class="dropdown-item" href="<?php echo DOCUMENT_ROOT . '/profile/edit.php';?>">Edit Profile</a></li>
              <?php if($isUserAStaff || $isUserNotAStudent) { ?>
                <li><a class="dropdown-item" href="<?php echo DOCUMENT_ROOT . '/profile/delete.php';?>">Delete Profile</a></li>
                <li><a class="dropdown-item" href="<?php echo DOCUMENT_ROOT . '/profile/list.php';?>">List Users</a></li>
              <?php }?>
            </ul>
        </li>
        <?php
          if($isUserAStaff || $isUserNotAStudent) {
        ?>
            <li class="nav-item dropdown">
               <!--<a class="nav-link  dropdown-toggle" href="#" data-bs-toggle="dropdown">Student &nbsp;<i class="arrow down"></i></a>-->
               <a class="nav-link  dropdown-toggle" href="#" data-bs-toggle="dropdown"><div id="downarrow"><span>Student</span></div></a>
                <ul class="dropdown-menu">
                  <li><a class="dropdown-item" href="<?php echo DOCUMENT_ROOT . '/profile/add.php';?>">Add Student</a></li>
                  <li><a class="dropdown-item" href="<?php echo DOCUMENT_ROOT . '/student/list.php';?>">List Students</a></li>
                </ul>
            </li>
        <?php
          }
        ?>

        <li><a href="#">Attendance</a></li>
        <?php
          if($isUserAStaff || $isUserNotAStudent) {
        ?>
            <li class="nav-item dropdown">
               <!--<a class="nav-link  dropdown-toggle" href="#" data-bs-toggle="dropdown">Student &nbsp;<i class="arrow down"></i></a>-->
               <a class="nav-link  dropdown-toggle" href="#" data-bs-toggle="dropdown"><div id="downarrow"><span>Fees</span></div></a>
                <ul class="dropdown-menu">
                  <li><a class="dropdown-item" href="<?php echo DOCUMENT_ROOT . '/fees/add.php';?>">Add Fees</a></li>
                  <li><a class="dropdown-item" href="<?php echo DOCUMENT_ROOT . '/fees/list.php';?>">List Fees</a></li>
                </ul>
            </li>
        <?php
          } else {
        ?>
              <li><a href="<?php echo DOCUMENT_ROOT . '/fees/view.php';?>">Fees</a></li>
        <?php
          }
        ?>
        <li><a href="#">Activities</a></li>
        <?php if($isUserAStaff || $isUserNotAStudent) { ?>
          <li class="nav-item dropdown">
             <!--<a class="nav-link  dropdown-toggle" href="#" data-bs-toggle="dropdown">Student &nbsp;<i class="arrow down"></i></a>-->
             <a class="nav-link  dropdown-toggle" href="#" data-bs-toggle="dropdown"><div id="downarrow"><span>Reports</span></div></a>
              <ul class="dropdown-menu">
                <li><a class="dropdown-item" href="<?php echo DOCUMENT_ROOT . '/profile/add.php';?>">Student Report</a></li>
                <li><a class="dropdown-item" href="<?php echo DOCUMENT_ROOT . '/student/list.php';?>">Attendance Report</a></li>
                <li><a class="dropdown-item" href="<?php echo DOCUMENT_ROOT . '/profile/list.php';?>">Fee Report</a></li>
              </ul>
          </li>
        <?php } ?>
        <li><a href="<?php echo DOCUMENT_ROOT . '/versionHistory.php';?>">Version History</a></li>
        <li><a href="#contact">Contact</a></li>
      </ul>
      <ul class="nav navbar-nav navbar-right">
      <li>
          <a href="#"><span class="glyphicon glyphicon-user"></span>
            <span style="color: #76dde3; font-weight: bold;">
              <?php echo $_SESSION['user'] ;?>
              <?php echo isset($_SESSION['userName']) ? " | " . $_SESSION['userName'] : '';?>
            </span>
          </a>
      </li>
      <!--<li><a href="<?php //echo DOCUMENT_ROOT . '/logout.php';?>">Logout</a></li>-->
      <li>
        <a href="<?php echo DOCUMENT_ROOT . '/logout.php';?>">
          <span class="glyphicon glyphicon-log-out"></span> Logout
        </a>
      </li>
      <!--<li><a href="#"><span class="glyphicon glyphicon-log-in"></span> Login</a></li>
      <p class="navbar-text">Some text</p>-->
    </ul>
    </div><!--/.nav-collapse -->
  </div>
</nav>
