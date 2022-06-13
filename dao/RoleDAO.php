<?php

require_once __DIR__ . '/../inc/header.php';

require_once 'BaseDAO.php';
require_once __DIR__ . '/../db/connection.php';
require_once __DIR__ . '/../bo/TblRoleBO.php';


// Insert the path where you unpacked log4php
//include __DIR__ . '/../lib/apache-log4php-2.3.0/src/main/php/Logger.php';

// Tell log4php to use our configuration file.
//Logger::configure(__DIR__ . '/../config/log4php-config.xml');

// Fetch a logger, it will inherit settings from the root logger
$log = Logger::getLogger('RoleDAO(Outside)');

function testLog($log) {
  // Start logging
  $log->trace("My first message.");   // Not logged because TRACE < WARN
  $log->debug("My second message.");  // Not logged because DEBUG < WARN
  $log->info("My third message.");    // Not logged because INFO < WARN
  $log->warn("My fourth message.");   // Logged because WARN >= WARN
  $log->error("My fifth message.");   // Logged because ERROR >= WARN
  $log->fatal("My sixth message.");   // Logged because FATAL >= WARN
}

testLog($log);

class RoleDAO extends BaseDAO
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

  function fetchAll()
	{
      $this->log->debug('fetchAll() - ENTER');

	    global $pdo;

	    $sql = "SELECT DISTINCT NAME from TblRole";

	    try
	    {
	        $query = $pdo->prepare($sql);

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

      $this->log->debug('fetchAll() - EXIT');

     //var_dump($roleNamesArray);

	    return $roleNamesArray;
	}
}

//$roleDAO = new RoleDAO;
//$roleDAO->fetchAll();
