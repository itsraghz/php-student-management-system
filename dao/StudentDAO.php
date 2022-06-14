<?php

require_once __DIR__ . '/../inc/header.php';

require_once 'BaseDAO.php';
require_once __DIR__ . '/../db/connection.php';
require_once __DIR__ . '/../bo/TblStudentBO.php';


// Insert the path where you unpacked log4php
//include __DIR__ . '/../lib/apache-log4php-2.3.0/src/main/php/Logger.php';

// Tell log4php to use our configuration file.
//Logger::configure(__DIR__ . '/../config/log4php-config.xml');

// Fetch a logger, it will inherit settings from the root logger
$log = Logger::getLogger('RoleDAO(Outside)');

function testLogStudentDAO($log) {
  // Start logging
  $log->trace("My first message.");   // Not logged because TRACE < WARN
  $log->debug("My second message.");  // Not logged because DEBUG < WARN
  $log->info("My third message.");    // Not logged because INFO < WARN
  $log->warn("My fourth message.");   // Logged because WARN >= WARN
  $log->error("My fifth message.");   // Logged because ERROR >= WARN
  $log->fatal("My sixth message.");   // Logged because FATAL >= WARN
}

//testLogStudentDAO($log);

class StudentDAO extends BaseDAO
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

  function getStudentByUserId($UserId)
	{
      $this->log->debug('getStudentByUserId() - ENTER');
      $this->log->debug('UserId : '. $UserId);

	    global $pdo;

	    $sql = "SELECT * from TblStudent WHERE UserId=:UserId";

      $this->log->debug("Query : [ " . $sql . "]");

      $isValid=false;

	    try
	    {
	        $query = $pdo->prepare($sql);

          $query->bindParam(":UserId", $UserId);

	        $query->execute();

          $row = $query->fetch();

          $StudentBO = new TblStudentBO;
          $StudentBO->copyFromResultSet($row);

          if(!empty($StudentBO->getId()))
          {
              $isValid=true;
              //$Id = $StudentBO->getId();
              /** gets omitted because of a redirection through header() function in login.php */
              /*echo "<br/>--------- <br/>";
              echo "<pre> " , var_dump($_SESSION), "</pre>";
              echo "<br/>--------- <br/>";
              echo "<pre> " , var_dump($memberBO), "</pre>";
              echo "<br/>--------- <br/>";*/

              storeStudentBOToSession($StudentBO);
          }

	        //$pdo = null;
	    }
	    catch(PDOException $e)
	    {
	        echo 'ERROR: ' . $e->getMessage();
          $this->log->error('ERROR : ' . $e->getMessage());
	    }

      $this->log->debug("## StudentBO ## : [ " . $StudentBO . "]");
      $this->log->debug('getStudentByUserId() - EXIT');

	    //return $isValid;
	    return $StudentBO;
	}

  function getStudentByRegnNo($RegnNo)
	{
      $this->log->debug('getStudentByRegnNo() - ENTER');
      $this->log->debug('RegnNo : ' + $RegnNo);

	    global $pdo;

	    $sql = "SELECT * from TblStudent WHERE RegnNo=:RegnNo";

      $this->log->debug("Query : [ " . $sql . "]");

      $isValid=false;

	    try
	    {
	        $query = $pdo->prepare($sql);

          $statement->bindParam(":RegnNo", $RegnNo);

	        $query->execute();

          $row = $query->fetch();

          $StudentBO = new TblStudentBO;
          $StudentBO->copyFromResultSet($row);

          if(!empty($StudentBO->getId()))
          {
              $isValid=true;
              //$Id = $StudentBO->getId();
              /** gets omitted because of a redirection through header() function in login.php */
              /*echo "<br/>--------- <br/>";
              echo "<pre> " , var_dump($_SESSION), "</pre>";
              echo "<br/>--------- <br/>";
              echo "<pre> " , var_dump($memberBO), "</pre>";
              echo "<br/>--------- <br/>";*/

              storeStudentBOToSession($StudentBO);
          }

	        //$pdo = null;
	    }
	    catch(PDOException $e)
	    {
	        echo 'ERROR: ' . $e->getMessage();
          $this->log->error('ERROR : ' . $e->getMessage());
	    }

      $this->log->debug("## StudentBO ## : [ " . $StudentBO . "]");
      $this->log->debug('getStudentByRegnNo() - EXIT');

	    //return $isValid;
	    return $StudentBO;
	}
}

//$studentDAO = new StudentDAO;
//$studentDAO->fetchAll();
