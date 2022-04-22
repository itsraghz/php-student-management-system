<?php

//TODO Not writing anything in the log file
function closeSession() {
  //echo "closeSession invoked <br/>";
  $log = Logger::getLogger('Logout');
  if(isset($_SESSION['user']) && !empty($_SESSION['user'])) {
    //echo "A session exists for the user [ " . $_SESSION['user'] ."] <br/>";
    $user = $_SESSION['user'];
    unset($_SESSION['user']);
    session_destroy();
    $log->info("Session belonging to the user [$user] is destroyed. ");
  }
}

function setAttemptedURL($url) {
	//echo "setAttemptedURL(),  url : <i>" . $url . "</i> <br/>";
	//global $attempted_url;
	//$attempted_url = $url;
	$_SESSION['attempted_url'] = $url;
}

function getAttemptedURL() {
	//global $attempted_url;
	//$attempted_url = $_SESSION['attempted_url'];
	//echo "getAttemptedURL(),  attempted_url : <i>" . $attempted_url . "</i> <br/>";
	$attempted_url = isset($_SESSION['attempted_url']) ? $_SESSION['attempted_url'] : 'index.php';
	return $attempted_url;
}

function getLoginTimeDiff() {
  $lastLoginTime = isset($_SESSION['login_time']) ? $_SESSION['login_time'] : 0;
  $lastAccessedTime = isset($_SESSION['last_accessed_time']) ? $_SESSION['last_accessed_time'] : 0;

  /* Should be a combination of login + accessed time */
  //$lastAccessedTime = $lastLoginTime + $lastAccessedTime;

  $loginTimeDiff = time() - $lastAccessedTime;
  //echo "<b>Login Accessed Time Diff :: </b><u><i>" . $loginTimeDiff . "</i></u>". "<br/>";
  return $loginTimeDiff;
}

/* To be used in the header.php page just to show the active session time */
function getSessionActiveTime() {
  $lastLoginTime = isset($_SESSION['login_time']) ? $_SESSION['login_time'] : 0;
  $lastAccessedTime = isset($_SESSION['last_accessed_time']) ? $_SESSION['last_accessed_time'] : 0;

  return $lastAccessedTime - $lastLoginTime;
}


/**
 * Show the login Page if the User has not logged in OR the previous session is timed out
 * Timeout is calculated for every 5 minutes of inactivity (5 * 60s = 300s)
 */
//if(!isset($_SESSION['logged_in']) || (time() - $_SESSION['login_time'] > 300)) {
if(!isset($_SESSION['logged_in']) || (getLoginTimeDiff() > 300 * 10)) {

  //echo "<span class='error'>User not logged in!</span><br/>";

  $dirName = DOCUMENT_ROOT;

	$homePage = $dirName . "/index.php";
	$loginPage = $dirName . "/login.php";


	$profileViewPage = $dirName . "/profile/view.php";
	$profileAddPage = $dirName . "/profile/add.php";
  $profileListPage = $dirName . "/profile/list.php";

    /*
     * SCRIPT_NAME misses the Query String if any, especially for editTx and insertNew pages
     * Hence, using REQUEST_URI as that covers pretty much everything.
     */
    $scriptName = $_SERVER['SCRIPT_NAME'];
    $scriptName = $_SERVER['REQUEST_URI'];

	//echo "homePage -> [" . $homePage . "] <br/>";
	//echo "scriptName -> [" . $scriptName . "] <br/>";

	$securedPagesArray = array (
		$profileViewPage, $profileAddPage, $profileListPage
	);

	$nonSecuredPagesArray = array (
		$homePage, $loginPage
	);

	//$isSecuredFileName = (strpos($scriptName, "e-") !== FALSE);

	$isInSecuredPageArray = in_array($scriptName, $securedPagesArray);

	$isExcludedSecuredFile = !in_array($scriptName, $nonSecuredPagesArray);

  if($isExcludedSecuredFile && $isInSecuredPageArray) {
    setAttemptedURL($scriptName);
    header('Location: ' . $loginPage);
  }
  else {
    //echo "<b>Access to a non-secured page. Hence granted.</b><br/>";

    // Do Nothing for time being.
  }
}
else
{
  /* [09Oct2016] Pretty Important, otherwise it loses the significance */
  /* Only then it will be relative, else it will be absolute */
      $_SESSION['last_accessed_time'] = time();

  //appendWhiteSpace("<a href=\"Expenses_CreateTable.php\">CreateTable</a>", 5);
  //appendWhiteSpace("<a href=\"dropDatabase.php\">Drop</a>", 5);
  //appendWhiteSpace("<a href=\"functionDemo.php\">FunctionDemo</a>", 5);
  /*appendWhiteSpace("<a href=\"index.php\" target=\"_blank\">Home</a>  |  ", 2);
  appendWhiteSpace("<a href=\"../logout.php\">Logout</a>", 5);
  echo "<hr size=2 color=\"purple\"/>";
  echo "<br/>";*/
}

?>
