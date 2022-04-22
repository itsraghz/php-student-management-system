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
        <li><a href="<?php echo DOCUMENT_ROOT . '/profile/view.php';?>">View</a></li>
        <li><a href="<?php echo DOCUMENT_ROOT . '/student/list.php';?>">List Students</a></li>
        <li><a href="<?php echo DOCUMENT_ROOT . '/profile/list.php';?>">List Users</a></li>
        <li><a href="<?php echo DOCUMENT_ROOT . '/profile/add.php';?>">Add Student</a></li>
        <li><a href="#">Attendance</a></li>
        <li><a href="#">Fees</a></li>
        <li><a href="#">Activities</a></li>
        <li><a href="#">Reports</a></li>
        <li><a href="<?php echo DOCUMENT_ROOT . '/versionHistory.php';?>">Version History</a></li>
        <li><a href="<?php echo DOCUMENT_ROOT . '/logout.php';?>">Logout</a></li>
        <li><a href="#contact">Contact</a></li>
      </ul>
    </div><!--/.nav-collapse -->
  </div>
</nav>
