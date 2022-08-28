<?php
  require_once __DIR__ . '/../inc/header.php';
  require_once __DIR__ . '/../dao/UserDAO.php';

  // Fetch a logger, it will inherit settings from the root logger
  $log = Logger::getLogger('delete.php');

  //echo "<pre>", print_r($_POST), "</pre>";
  //echo "</pre>", var_dump($_POST), "</pre>";

  $UserId = isset($_GET['UserId']) ? $_GET['UserId'] :  '';
  $log->info("UserId in Request Param : " . $UserId);

  $IsUserAStaff = Util::isUserAStaff()? true : false;
  //echo "IsUserAStaff? : " . $IsUserAStaff . "<br/><br/>";
  $log->info("Util::isUserAStaff()? : " . Util::isUserAStaff());
  $log->info("IsUserAStaff? : $IsUserAStaff");
  $log->info("IsUserAStaff? (print_r) : " . print_r($IsUserAStaff, 1));
  $log->info("IsUserAStaff? (var_dump) : " . var_dump($IsUserAStaff));

  /*echo("Util::isUserAStaff()? : " . Util::isUserAStaff(). "<br/>");
  echo("IsUserAStaff? : $IsUserAStaff <br/>");
  echo("IsUserAStaff? (print_r) : " . print_r($IsUserAStaff, 1). "<br/>");
  echo("IsUserAStaff? (var_dump) : " . var_dump($IsUserAStaff) . "<br/>");*/

  $isUserNotAStudent = Util::isUserNotAStudent() ? true : false;
  //echo "isUserNotAStudent? : " . $isUserNotAStudent . "<br/><br/>";
  $log->info("Util::isUserNotAStudent()? : " . Util::isUserNotAStudent());
  $log->info("isUserNotAStudent? : $isUserNotAStudent");
  $log->info("isUserNotAStudent? (print_r) : " . print_r($isUserNotAStudent, 1));
  $log->info("isUserNotAStudent? (var_dump) : " . var_dump($isUserNotAStudent));

  /*echo("Util::isUserNotAStudent()? : " . Util::isUserNotAStudent(). "<br/>");
  echo("isUserNotAStudent? : $isUserNotAStudent <br/>");
  echo("isUserNotAStudent? (print_r) : " . print_r($isUserNotAStudent, 1) . "<br/>");
  echo("isUserNotAStudent? (var_dump) : " . var_dump($isUserNotAStudent) . "<br/>");*/

  //checkUser($IsUserAStaff, $isUserNotAStudent);

  if(!$IsUserAStaff && !$isUserNotAStudent) {
    $log->info("User Id is NEITHER a Staff NOR an Admin/Accounts User but a Student ...");
    $errorMsg = "Being a Student, You are not entitled to delete an User from the System. Please contact admin.";
    $_SESSION['errorMsg']=$errorMsg;
    $location = '../home.php';
    header("Location: $location");
    $log->info("!!![X][X][X] even after header to redirect!!! [X][X][X]!!!");
  }
  else
  {
      if(empty($UserId)) {
        handleStaffUser($IsUserAStaff, $isUserNotAStudent);
      } else {
        checkUser($IsUserAStaff, $isUserNotAStudent);
        deleteUser($UserId);
      }
  }

  function canDelete($IsUserAStaff, $isUserNotAStudent)
  {
    $log = Logger::getLogger('delete.php');

    $log->info("canDelete() - IsUserAStaff? : $IsUserAStaff");
    $log->info("canDelete() - isUserNotAStudent? : $isUserNotAStudent");

    return !$IsUserAStaff && !$isUserNotAStudent;
  }

/**
  * Has an issue. Not sure why the redirection not working in this method! ;(
  */
  function checkUser($IsUserAStaff, $isUserNotAStudent)
  {
    $log = Logger::getLogger('delete.php');

    $log->info("checkUser() - IsUserAStaff? : $IsUserAStaff");
    $log->info("checkUser() - isUserNotAStudent? : $isUserNotAStudent");

    $location = 'list.php';

    if(!$IsUserAStaff && !$isUserNotAStudent)
    {
      $log->info("checkUser() - User Id is NEITHER a Staff NOR an Admin/Accounts User but a Student ...");
      $errorMsg = "You are not entitled to delete an User from the System. Please contact admin.";
      //$location = 'home.php';
      $_SESSION['errorMsg']=$errorMsg;
      $location = '../home.php';
    }
    else
    {
      $log->info("checkUser() - [!!] User Id is either a Staff OR an Admin/Accounts User but NOT a Student ...");
    }
    header("Location: $location");
    //TODO: Not sure why this header redirection is NOT working. instead the one below in handleStaffUser() is working.
    $log->info("checkUser() - [X][X][X] even after header to redirect!!! [X][X][X] ");
  }

  function handleStaffUser($IsUserAStaff, $isUserNotAStudent)
  {
    $log = Logger::getLogger('delete.php');

    $log->info("handleStaffUser() - User Id is EMPTY ...");

    $errorMsg = '';

    if($IsUserAStaff && $isUserNotAStudent) {
      $errorMsg = "Invalid UserId to delete the profile. Please try again with the valid input.";
      $location = 'list.php';
    } else {
      $errorMsg = "You are not authorized to delete an User from the System.";
      $location = '../home.php';
    }

    $_SESSION['errorMsg']=$errorMsg;
    header('Location: ' . $location);
  }

  function deleteUser($UserId)
  {
    $log = Logger::getLogger('delete.php');

    $log->info("deleteUser() - User Id : $UserId");

    //$_POST['UserId'] = $UserId;

    $UserDAO = new UserDAO;

    //$UserDAO->insertUser();
    //$UserDAO->insertStudent();

    $userExists = $UserDAO->checkUserExists($UserId);

    if(!$userExists)
    {
      //echo "<font color=red>The User with the Id [$UserId] already exists in the System.</font>";
      $_SESSION['verifyProfileErrorMsg'] = "The User with the Id [$UserId] does NOT exist in the System.";
    }
    else
    {
      echo "User exists!";
      $StudDelCount = $UserDAO->deleteStudent($UserId);
      /*if($count==1) {
        $_SESSION['successMsg'] = "The Student with the Id [$UserId] was deleted successfully from the System.";
      } else {
        $_SESSION['errorMsg'] = "The Student with the Id [$UserId] was NOT deleted from the System. Please contact Admin.";
      }*/

      $log->info("deleteUser() - StudDelCount : " . $StudDelCount);

      $UserDelCount = $UserDAO->deleteUser($UserId);

      $log->info("deleteUser() - UserDelCount : " . $UserDelCount);

      if($StudDelCount==1 && $UserDelCount==1) {
        $_SESSION['successMsg'] = "The User with the Id [$UserId] was deleted successfully from the System.";
      } else {
        $_SESSION['errorMsg'] = "The User with the Id [$UserId] was NOT deleted from the System. Please contact Admin.";
      }
    }

    header('Location: list.php');
  }

  require_once __DIR__ . '/../inc/footer.php';
?>
