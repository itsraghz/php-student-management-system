<?php
  ob_start();
  @session_start();
  require_once 'connection.php';

?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Student Management System (SMS)</title>
    <link rel="stylesheet" href="style.css"/>
  </head>
  <body>
      <h1 class="title">Student Management System (SMS)</h1>
        <pre>
      <?php
        //print_r($_SERVER['SCRIPT_NAME']);
        $scriptName = $_SERVER['SCRIPT_NAME'];
        //echo "<b>Script Name : </b> " . $scriptName . "<br/>";
      ?>
        </pre>
      <?php
          if(isset($_SESSION['user']) && !empty($_SESSION['user'])) {
            unset($_SESSION['message']);
            unset($_SESSION['errMsg']);
            require_once 'menu.php';
          } else {
            //echo "User is not in Session!";
            if(strcmp($scriptName, "/sms/index.php")!=0) {
              $_SESSION['errMsg'] = "Unauthorized access is forbidden. Please login!";
              header('Location: index.php');
            }
          }
      ?>
