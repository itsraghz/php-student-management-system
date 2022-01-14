<?php
  require_once 'inc/header.php';

  unset($_SESSION['user']);
  //session_destroy();
  $_SESSION['message'] = "You have been successfully logged out of the System";
  header('Location: index.php');

  require_once 'inc/footer.php';
?>
