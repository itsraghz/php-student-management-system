<?php
  require_once __DIR__ . '/../inc/header.php';
  require_once __DIR__ . '/../dao/UserDAO.php';
  require_once __DIR__ . '/../bo/TblUserBO.php';

  $UserDAO = new UserDAO;

  /*echo "<pre>", print_r($_POST), "</pre>";
  echo "<br/><hr/><br/>";
  echo "</pre>", var_dump($_POST), "</pre>";*/

  //$UserId=$UserDAO->insertUser();
  $UserId=$UserDAO->insertUser();
  //echo "UserId : " . $UserId . "<br/>";

  $UserRoleId=$UserDAO->insertUserRole($UserId);
  //echo "UserRoleId : " . $UserRoleId . "<br/>";

  $UserBO = $UserDAO->getUserById($UserId);
  /*echo "<br/>UserBO retrieved for the matching UserId - $UserId is : <br/>";
  echo "================================= <br/>";
  var_dump($UserBO);
  echo "================================= <br/>";*/


  /*echo "<br/>";
  echo "<b>POST Array contents :: </b><br/>";
  print_r($_POST);
  echo "<br/>";*/

  $_POST['UserId'] = $UserId;

  if($UserDAO->insertStudent()) {
  //if($UserDAO->insertStudentByObj($UserBO)) {
    echo "<br/><font color=green>Student details captured successfully into the TblStudent table.</font>";
    $_SESSION['canCloseProfileCreationMsg'] = true;
    unset($_SESSION['TargetFileNameWithExt']);
    unset($_SESSION['uploadedFile']);
    unset($_SESSION['fileUploadMsg']);
    unset($_SESSION['canCloseProfileCreationMsg']);

    header('Location: list.php');
  } else {
    echo "<br/><font color=red>Student details NOT captured successfully into the TblStudent table.</font>";
    //header('Location: addProfile0.php');
  }

  require_once __DIR__ . '/../inc/footer.php';
?>
