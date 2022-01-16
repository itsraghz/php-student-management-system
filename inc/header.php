<?php
  ob_start();
  @session_start();
  require_once 'connection.php';

?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <title>Student Management System (SMS)</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap core CSS -->
    <link href="dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <link href="assets/css/ie10-viewport-bug-workaround.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="starter-template.css" rel="stylesheet">

    <!-- Just for debugging purposes. Don't actually copy these 2 lines! -->
    <!--[if lt IE 9]><script src="../../assets/js/ie8-responsive-file-warning.js"></script><![endif]-->
    <script src="assets/js/ie-emulation-modes-warning.js"></script>

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

    <!-- Bootstrap CSS -->
    <!--<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">-->

    <!--<link rel="stylesheet" href="style.css"/>-->
    <link rel="stylesheet" href="style-bootstrap.css"/>
  </head>
  <body>
    <div class="container">
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
              require_once __DIR__ . './menu.php';
            } else {
              //echo "User is not in Session!";
              if(strcmp($scriptName, "/sms/index.php")!=0) {
                $_SESSION['errMsg'] = "Unauthorized access is forbidden. Please login!";
                header('Location: index.php');
              }
            }
        ?>
        <h1 class="title">Student Management System (SMS)</h1>
