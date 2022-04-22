<?php
  require_once __DIR__ . './../inc/header.php';
  require_once __DIR__ . './../dao/UserDAO.php';

  //echo "<pre>", print_r($_POST), "</pre>";
  //echo "</pre>", var_dump($_POST), "</pre>";

  $UserId = $_POST['UserId'];

  $UserDAO = new UserDAO;

  //$UserDAO->insertUser();
  //$UserDAO->insertStudent();

  if($UserDAO->checkUserExists($UserId)) {
    //echo "<font color=red>The User with the Id [$UserId] already exists in the System.</font>";
    $_SESSION['verifyProfileErrorMsg'] = "The User with the Id [$UserId] already exists in the System.";
    header('Location: add.php');
  } else {
    echo "User does not exist!";
    $_SESSION['verifyProfileMsg'] = "User [$UserId] does not exist. You can create one.";
    $_SESSION['searchedUser'] = $UserId;
    header('Location: create.php');
  }

  require_once __DIR__ . './../inc/footer.php';
?>
