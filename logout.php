<?php
  //require_once 'inc/header.php';
  require_once __DIR__ . '/inc/header.php';

  /*unset($_SESSION['user']);
  //TODO Revisit these
  unset($_SESSION['TargetFileNameWithExt']);
  unset($_SESSION['uploadedFile']);
  unset($_SESSION['fileUploadMsg']);
  unset($_SESSION['canCloseProfileCreationMsg']);

  //session_destroy();
  $_SESSION['message'] = "You have been successfully logged out of the System";*/

  unset($_SESSION);
  session_destroy();
  header('Location: index.php');

  //require_once 'inc/footer.php';
  require_once __DIR__ . '/inc/footer.php';
?>
