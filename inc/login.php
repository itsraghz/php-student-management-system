<?php
  require_once 'inc/header.php';
  //echo "Login Page";

  $userName = $_POST['userName'];
  $password = $_POST['password'];

  /*
  echo "<h3>Input Data : </h3>";
  echo "<ul>";
  echo "<li>UserName : " . $userName . "</li>";
  echo "<li>Password : " . $password . "</li>";
  echo "</ul>";
  */
  //if(strcmp($userName, "912517114301")==0 && strcmp($password, "912517114301")==0) {
  if(strcmp($userName, $password)==0) {
    //echo "Login Successful!";
    $_SESSION['user']=$userName;
    header('Location: home.php');
  } else {
    echo "Login failed!";
    $_SESSION['errMsg']="Invalid Username/Password. Try again!";
    header('Location: index.php');
  }

  require_once 'inc/footer.php';
?>
