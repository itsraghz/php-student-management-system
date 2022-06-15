<?php
	date_default_timezone_set("Asia/Calcutta");

	// Insert the path where you unpacked log4php
	include __DIR__ . '/../lib/apache-log4php-2.3.0/src/main/php/Logger.php';

	// Tell log4php to use our configuration file.
	Logger::configure(__DIR__ . '/../config/log4php-config.xml');

	function getBaseDir() {
	    $loc_pos_2 = strpos($_SERVER['REQUEST_URI'], "/", 1);

	    //echo "REQUEST_URI :: <i>" . $_SERVER['REQUEST_URI'] . "</i> | ";
	    //echo "loc_pos_2 -> " . $loc_pos_2 . " | ";

	    $baseDir = substr($_SERVER['REQUEST_URI'], 0, $loc_pos_2);

	    //echo "baseDir : " . $baseDir . "<br/>";

	    //$baseDir = $_SERVER['DOCUMENT_ROOT'] . $baseDir;

	    return $baseDir;
	}

	function getDocumentRoot() {
	   // echo "<b> BaseDir : </b> " . getBaseDir() . "<br/>";

	    $docRoot =  getBaseDir();// . '/' . 'sms';

	    //$docRoot = getBaseDir2();
	    //$docRoot = $_SERVER['DOCUMENT_ROOT'] . '/raghs-nextGen';

	    return $docRoot;
	}

	define('DOCUMENT_ROOT', getDocumentRoot());


	define("ENV", "DEV");
	//define("ENV", "PROD");

	define("DEV_QUICK_LOGIN", false);
	//define("DEV_QUICK_LOGIN", true);

	define("VERSION_INFO", "(V 2.1) | 15 Jun 2022 Wednesday");

	/** Dev Related Settings - NEED NOT GO TO PROD */
	error_reporting(E_ALL);
	ini_set('display_errors', 1);
	ini_set('log_errors', 1);

	/* [SBI-77] Create a Staging or Parallel Environment for the Admin People to test */
	//define("IS_STAGING", true);
	define("IS_STAGING", false);
?>
