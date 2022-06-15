<?php
  ob_start();
  @session_start();
  //echo "dirname(__FILE__) is : " . dirname(__FILE__) . "<br/>";
  require_once __DIR__ . '/configure.php';
  require_once __DIR__ . '/global.php';
  //require_once __DIR__ . './../db/connection.php';
  require_once __DIR__ . '/../db/connection.php';

  /* PROD Server */
  /* ----------- */
  /*error_reporting(E_ALL);
  ini_set('display_errors',0);
  ini_set('log_errors',1); */

  /* Dev Server */
  //error_reporting(E_ALL);
  //ini_set('display_errors',1);

?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <title>Student Management System (SMS)</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap core CSS -->
    <link href="<?php echo DOCUMENT_ROOT . '/dist/css/bootstrap.min.css';?>" rel="stylesheet">

    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <link href="<?php echo DOCUMENT_ROOT . '/assets/css/ie10-viewport-bug-workaround.css';?>" rel="stylesheet">

    <!-- Custom styles for this template -->
    <!--<link href="starter-template.css" rel="stylesheet">-->

    <!-- Just for debugging purposes. Don't actually copy these 2 lines! -->
    <!--[if lt IE 9]><script src="../../assets/js/ie8-responsive-file-warning.js"></script><![endif]-->
    <script src="<?php echo DOCUMENT_ROOT . '/assets/js/ie-emulation-modes-warning.js';?>"></script>

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

    <!-- Bootstrap CSS -->
    <!--<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">-->

    <!--<link rel="stylesheet" href="style.css"/>-->
    <!--<link rel="stylesheet" href="<?php //echo $_SERVER ["DOCUMENT_ROOT"] . '/sms/inc/style/style-bootstrap.css';?>"/>-->
    <!--<link rel="stylesheet" href="<?php //echo __DIR__ . '\..\\style\\style-bootstrap.css';?>"-->
    <!--<link rel="stylesheet" href="<?php //echo dirname(__FILE__) . "/style/style-bootstrap.css";?>/>-->
    <link rel="stylesheet" href="<?php echo DOCUMENT_ROOT . "/inc/style/style-bootstrap.css"; ?>"/>
    <script src="<?php echo DOCUMENT_ROOT . "/inc/scripts/sms.js"; ?>"></script>
    <script src="<?php echo DOCUMENT_ROOT . "/inc/scripts/populate-defaults.js"; ?>"></script>
  </head>
  <body <?php echo (strcmp($_SERVER['SCRIPT_NAME'], "/sms/index.php")==0) ? ' class="homePage"' : ' '; ?> >
    <div class="container">
        <div id="menu"> <!-- menu div starts -->
          <?php
            //print_r($_SERVER['SCRIPT_NAME']);
            $scriptName = $_SERVER['SCRIPT_NAME'];
            //echo "<b>Script Name : </b> " . $scriptName . "<br/>";
          ?>
        <!--</pre>-->
        <?php
            if(isset($_SESSION['user']) && !empty($_SESSION['user'])) {
              unset($_SESSION['message']);
              unset($_SESSION['errMsg']);
              require_once 'menu.php';
              //require_once 'menu-hierarchy.php';
            } else {
              //echo "User is not in Session!";
              if(strcmp($scriptName, "/sms/index.php")!=0) {
                $_SESSION['errMsg'] = "Unauthorized access is forbidden. Please login!";
                //TODO: Verify this later
                header('Location: index.php');
              }
            }
        ?>
      </div><!-- menu div end -->
      <br/><br/>
      <?php
        if(strcmp($_SERVER['SCRIPT_NAME'], "/sms/index.php")==0)
        {
      ?>
          <div class="homePageImage">
            <br/><br/><br/><br/><br/><br/><br/><br/><br/>
            <br/><br/><br/><br/>
            <br/><br/><br/>
          </div>
      <?php
        }
      ?>
      <div id="content"> <!-- content div starts -->
        <h1 class="<?php echo (strcmp($_SERVER['SCRIPT_NAME'], "/sms/index.php")==0) ? 'titleHomePage' : 'title'; ?>">Student Management System (SMS)</h1>
        <h5 class="infoHeader">
            <!-- <b>Database Table   : </b><span class='dbInfo'><?php //echo DB_TBL_EXPENSES;?></span> | -->
            <!--<b>Last Login Time  : </b><span class='dbInfo'><?php //echo isset($_SESSION['login_time'])? $_SESSION['login_time'] : 0;?></span>-->
            <?php
              if(isset($_SESSION['userName']) && !empty($_SESSION['userName']))
              {
                echo "Welcome <b>" . $_SESSION['userName'] . "</b>. | ";
            ?>
                <b>Session Active   : </b>
                <span class='dbInfo'>
                  <?php echo getSessionActiveTime() . " (seconds)"?>
                </span>
                  [<?php echo getSessionActiveTime()/60 . " minutes";?>]
            <?php
              }
            ?>
        </h5>
