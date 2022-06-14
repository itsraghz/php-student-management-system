<?php
  //require_once 'inc/header.php';
  require_once __DIR__ . '/inc/header.php';
  //require_once 'dao/UserDAO.php';
  require_once __DIR__ . '/dao/UserDAO.php';
  require_once __DIR__ . '/dao/UserRoleDAO.php';
  require_once __DIR__ . '/dao/StudentDAO.php';

  //echo "Login Page";

  $userName = $_POST['userName'];
  $password = $_POST['password'];

  /*echo "<h3>Input Data : </h3>";
  echo "<ul>";
  echo "<li>UserName : " . $userName . "</li>";
  echo "<li>Password : " . $password . "</li>";
  echo "</ul>";*/

  $UserDAO = new UserDAO;

  //if(strcmp($userName, "912517114301")==0 && strcmp($password, "912517114301")==0) {
  if($UserDAO->verifyLogin($userName, $password)) {
  //if(strcmp($userName, $password)==0) {
    echo "Login Successful!";
    $_SESSION['UserId']=$userName;
    /* [13Jun2022] To resolve the error in the header.php */
    $_SESSION['user']=$userName;

    $_SESSION['logged_in'] = true;
    $_SESSION['login_time'] = time();
    //$attempted_url = getAttemptedURL();
    //echo "<b>Attempted URL: </b> ['" . getAttemptedURL() . "'] <br/>";

    /* [09Oct2016] to find out the inactive time */
    $_SESSION['last_accessed_time'] = time();

    $UserId = $UserDAO->getIdByUserName($userName);

    $UserRoleDAO = new UserRoleDAO;
    $isUserAStaff = $UserRoleDAO->isUserAStaff($UserId);

    $_SESSION['isUserAStaff']=($isUserAStaff==1) ? true : false;

    $StudentDAO = new StudentDAO;
    $StudentBO = $StudentDAO->getStudentByUserId($UserId) ;

    if(!empty($StudentBO)) {
      $_SESSION['userName']=$StudentBO->getName();
    }

    header('Location: home.php');
    //header('Location: ' . $attempted_url);
  } else {
    //echo "Login failed!";
    $_SESSION['errMsg']="Invalid Username/Password. Try again!";
    header('Location: index.php');
  }

  //require_once 'inc/footer.php';
  require_once __DIR__ . '/inc/footer.php';
?>
