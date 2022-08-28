<?php
  require_once __DIR__ . '/../inc/header.php';
  require_once __DIR__ . '/../dao/UserDAO.php';
  require_once __DIR__ . '/../bo/TblUserBO.php';
  require_once __DIR__ . '/../bo/TblStudentBO.php';

  // Fetch a logger, it will inherit settings from the root logger
  $log = Logger::getLogger('Update.php');

  //echo "User Id in Session : " . $_SESSION['user'] . "<br/>";
  $UserId = $_SESSION['UserId'];
  $log->info("UserId in Session : " . $UserId);

  /*echo "<pre>", print_r($_POST), "</pre>";
  echo "<br/><hr/><br/>";
  echo "</pre>", var_dump($_POST), "</pre>";*/

  //$UserId=$UserDAO->insertUser();
  //$UserId=$UserDAO->updateUser();
  //echo "UserId : " . $UserId . "<br/>";

  //$UserRoleId=$UserDAO->insertUserRole($UserId);
  //echo "UserRoleId : " . $UserRoleId . "<br/>";

  //$UserBO = $UserDAO->getUserById($UserId);
  /*echo "<br/>UserBO retrieved for the matching UserId - $UserId is : <br/>";
  echo "================================= <br/>";
  var_dump($UserBO);
  echo "================================= <br/>";*/


  /*echo "<br/>";
  echo "<b>POST Array contents :: </b><br/>";
  echo "<pre>", print_r($_POST), "</pre>";
  echo "<br/>";

  exit();*/

  //$_POST['UserId'] = $UserId;

  $_SESSION['RegnNo']=$_POST['RegnNo'];

  /* ----------------------------------------------------------------------- */
  function checkAndUpdateUser($UserId)
  {
    $log = Logger::getLogger('Update.php');
    $log->info("checkAndUpdateUser() - UserId : [$UserId]");

    $UserDAO = new UserDAO;

    $IsActiveB4Edit = isset($_SESSION['IsActiveB4Edit']) ? $_SESSION['IsActiveB4Edit'] : null;
    $log->info("checkAndUpdateUser() - IsActiveB4Edit in Session : [$IsActiveB4Edit]");

    if(empty($IsActiveB4Edit))
    {
      $log->info("checkAndUpdateUser() - IsActiveB4Edit in EMPTY, no updates further on Activating the User");
      return;
    }

    $isActiveInPost = '';

    if(!isset($_POST['IsActive']))
    {
      $log->info("checkAndUpdateUser() - IsActive NOT present in the \$_POST array!");
    }
    else
    {
      $IsActivePost = $_POST['IsActive'];
      $log->info("checkAndUpdateUser() - IsActive exists in the \$_POST, with the value : [$IsActivePost]");
      $log->info("checkAndUpdateUser() - IsActive in the \$_SESSION, with the value : [$IsActiveB4Edit]");

      if(strcmp($IsActivePost, $IsActiveB4Edit)!=0)
      {
        $log->info("checkAndUpdateUser() - IsActive differs in \$_POST and \$_SESSION");

        if(strcmp($IsActivePost, 'Y')==0)
        {
          $log->info("checkAndUpdateUser() - Activating the User");
          $UserDAO->activateUser($UserId);
        }
        else
        {
          $log->info("checkAndUpdateUser() - Deactivating the User");
          $UserDAO->deactivateUser($UserId);
        }
      }
    }
  }
  /* ------------------------------------------------------------------- */

  $UserDAO = new UserDAO;

  if($UserDAO->updateStudent())
  {
    checkAndUpdateUser($_SESSION['RegnNo']);

    //if($UserDAO->insertStudentByObj($UserBO)) {
    echo "<br/><font color=green>Student details updated successfully into the TblStudent table.</font>";
    $_SESSION['successMsg']="Student details updated successfully for [" . $_SESSION['RegnNo'] . "]";
    $_SESSION['canCloseProfileCreationMsg'] = true;
    unset($_SESSION['TargetFileNameWithExt']);
    unset($_SESSION['uploadedFile']);
    unset($_SESSION['fileUploadMsg']);
    unset($_SESSION['canCloseProfileCreationMsg']);
    $log->info("message in Session : " . $_SESSION['successMsg']);
  }
  else
  {
    echo "<br/><font color=red>Student details NOT updated successfully into the TblStudent table.</font>";
    $_SESSION['errorMsg'] = "Student details NOT updated successfully for [" . $_SESSION['RegnNo'] . "].";
    //header('Location: addProfile0.php');
    $log->info("errorMsg in Session : " . $_SESSION['errorMsg']);
  }

  $log->info("Contents of \$_Session : " . print_r($_SESSION,1));
  $log->info("Redirecting to view.php, with the UserId : [" . $_SESSION['RegnNo'] . "]");
  header('Location: view.php?UserId=' . $_SESSION['RegnNo']);

  require_once __DIR__ . '/../inc/footer.php';
?>
