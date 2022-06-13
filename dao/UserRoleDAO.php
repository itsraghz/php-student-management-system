<?php

require_once __DIR__ . '/../inc/header.php';

require_once 'BaseDAO.php';
require_once __DIR__ . '/../db/connection.php';
require_once __DIR__ . '/../bo/TblUserRoleBO.php';


// Insert the path where you unpacked log4php
//include __DIR__ . '/../lib/apache-log4php-2.3.0/src/main/php/Logger.php';

// Tell log4php to use our configuration file.
//Logger::configure(__DIR__ . '/../config/log4php-config.xml');

// Fetch a logger, it will inherit settings from the root logger
$log = Logger::getLogger('UserRoleDAO(Outside)');

/*function testLog($log) {
  // Start logging
  $log->trace("My first message.");   // Not logged because TRACE < WARN
  $log->debug("My second message.");  // Not logged because DEBUG < WARN
  $log->info("My third message.");    // Not logged because INFO < WARN
  $log->warn("My fourth message.");   // Logged because WARN >= WARN
  $log->error("My fifth message.");   // Logged because ERROR >= WARN
  $log->fatal("My sixth message.");   // Logged because FATAL >= WARN
}

//testLog($log);*/

class UserRoleDAO extends BaseDAO
{
  /** Holds the Logger. */
  private $log;

  /** Logger is instantiated in the constructor. */
  public function __construct()
  {
      // The __CLASS__ constant holds the class name, in our case "Foo".
      // Therefore this creates a logger named "Foo" (which we configured in the config file)
      $this->log = Logger::getLogger(__CLASS__);
      //echo "<br/>Logger has been instantiated <br/>";
  }

  function testLogger()
  {
      $this->log->debug('testLogger() invoked.');
  }

  function fetchRolesForUser($UserId)
	{
      $this->log->debug('fetchRolesForUser() - ENTER');
      $this->log->debug('UserId: ' . $UserId);

	    global $pdo;

	    $sql = "SELECT DISTINCT R.NAME from TblUserRole UR, TblRole R
              WHERE UR.RoleId=R.ID AND R.IS_ACTIVE='Y' and UR.IS_ACTIVE='Y'
              AND UR.UserId=:UserId ORDER BY R.Id ASC";

      $this->log->debug('sql: [' . $sql . "]");

	    try
	    {
	        $query = $pdo->prepare($sql);

          //Not required because we use PreparedStatement bind() method. However sanitize() uses other cleaning as well.
    			$UserId = $this->sanitize($UserId);

    			//echo "<b>[Debug] - AppealDAO </b> AppealId ::: " . $AppealId . "<br/>";

    			$query->bindParam(":UserId", $UserId);

	        $query->execute();

	        $roleNamesArray = array();

	        while($row = $query->fetch())
	        {
	            array_push($roleNamesArray, $row['NAME']);
	        }

	        //$pdo = null;
	    }
	    catch(PDOException $e)
	    {
	        echo 'ERROR: ' . $e->getMessage();
	    }

      $this->log->debug('roleNamesArray contains : ');
      $this->log->debug('---------------------------');
      foreach ($roleNamesArray as $value) {
        $this->log->debug($value);
      }
      $this->log->debug('---------------------------');

      $this->log->debug('fetchRolesForUser() - EXIT');

	    return $roleNamesArray;
	}

  function isUserAStaff($UserId) {
    $this->log->debug('isUserAStaff() - ENTRY');
    $this->log->info('UserId: ' . $UserId);

    $roleNamesArray = $this->fetchRolesForUser($UserId);

    $isUserAStaff = 0;

    if(!empty($roleNamesArray) || count($roleNamesArray)>=1) {
      if (in_array("Staff", $roleNamesArray)) {
        $isUserAStaff=1;
      }
    }

    $this->log->info('isUserAStaff : ' . $isUserAStaff);
    $this->log->debug('isUserAStaff() - EXIT');

    return $isUserAStaff;
  }

  function isUserAStaffForName($UserName) {
    $this->log->debug('isUserAStaffForName() - ENTRY');
    $this->log->info('UserId: ' . $UserName);

    $roleNamesArray = $this->fetchRolesForUser($UserId);

    $isUserAStaff = 0;

    if(!empty($roleNamesArray) || count($roleNamesArray)>=1) {
      if (in_array("Staff", $roleNamesArray)) {
        $isUserAStaff=1;
      }
    }

    $this->log->info('isUserAStaff: ' . $isUserAStaff);
    $this->log->debug('isUserAStaffForName() - EXIT');

    return $IsUserAStaff;
  }
}

/*$roleDAO = new UserRoleDAO;
$roleDAO->fetchRolesForUser(3);
$roleDAO->isUserAStaff(3);

$roleDAO->fetchRolesForUser(9);
$roleDAO->isUserAStaff(9);*/
