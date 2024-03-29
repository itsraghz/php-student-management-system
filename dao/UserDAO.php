<?php

require_once __DIR__ . '/../inc/header.php';

require_once 'BaseDAO.php';
/*require_once DOCUMENT_ROOT . '/../bo/TblMemberBO.php';
require_once DOCUMENT_ROOT . '/../db/connection.php';*/
//require_once __DIR__ . '/../bo/TblUserBO.php';
require_once __DIR__ . '/../db/connection.php';
require_once __DIR__ . '/../bo/TblUserBO.php';


// Insert the path where you unpacked log4php
//include __DIR__ . '/../lib/apache-log4php-2.3.0/src/main/php/Logger.php';

// Tell log4php to use our configuration file.
//Logger::configure(__DIR__ . '/../config/log4php-config.xml');

// Fetch a logger, it will inherit settings from the root logger
$log = Logger::getLogger('UserDAO(Outside)');

function testLog($log) {
  // Start logging
  $log->trace("My first message.");   // Not logged because TRACE < WARN
  $log->debug("My second message.");  // Not logged because DEBUG < WARN
  $log->info("My third message.");    // Not logged because INFO < WARN
  $log->warn("My fourth message.");   // Logged because WARN >= WARN
  $log->error("My fifth message.");   // Logged because ERROR >= WARN
  $log->fatal("My sixth message.");   // Logged because FATAL >= WARN
}

//testLog($log);

class UserDAO extends BaseDAO
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

  function verifyLogin($userId, $password)
	{
      $this->log->debug('verifyLogin() - ENTER');
      $this->log->debug('userId : [' . $userId . '], password : [' . $password .']');

	    global $pdo;

	    $isValid = false;
	    $userIdFromDB = '';

		  //Not required because we use PreparedStatement bind() method. However sanitize() uses other cleaning as well.
	    $userId = $this->sanitize($userId);
	    $password = $this->sanitize($password);

	    //$sql = "SELECT * from TblUser where UserId=:userId and Password=:password";
      //$sql = "SELECT Name from TblUser a, TblStudent b where a.UserId=b.RegnNo AND a.UserId=:userId and a.Password=:password";
      $sql = "SELECT * from TblUser a where a.UserId=:userId and a.Password=:password and IS_ACTIVE='Y'";
	    //$sql = "SELECT * from TblMember where UserId=:userId";

      //echo "<b>Query : </b> " . $sql . "<br/>";
      $this->log->debug("Query : [ " . $sql . "]");

	    try
	    {
	        $statement = $pdo->prepare($sql);

	        $statement->bindParam(":userId", $userId);
	       	$statement->bindParam(":password", $password);

	        $statement->execute();

	        //$row = $query->fetch();
          /*
          while (($row = $statement->fetchAll(PDO::FETCH_ASSOC)) !== false) {
              echo $row['UserId'] . '<br>';
              $isValid = true;
          }
          */

          $rows = $statement->fetchAll(PDO::FETCH_ASSOC);

          //print_r($sth->execute());

          foreach($rows as $row) {
              //printf("$row[0] $row[1] $row[2]\n");
              //print_r($row);
              //echo $row['UserId'];
              $isValid = true;

              $UserBO = $this->getUserByUserName($userId);
              $this->log->debug("User BO :: " . $UserBO);

              //if(isset($_SESSION['UserBO']) && !empty($_SESSION['UserBO'])) {
              if(!empty($UserBO)) {
                $_SESSION['userName']=$UserBO->getUserId();
                $this->log->info('Successful match of an User with the name [' . $_SESSION['userName'] . ']. It is set in session.');
              }
          }

          /*while($rows!==false) {
            echo $rows['UserId'];
            $isValid = true;
          }*/

	       	//$pdo = null;
	    }
	    catch(PDOException $e)
	    {
	    	//[TODO] Proper way of error handling.
	        echo 'ERROR: ' . $e->getMessage();
          $this->log->error('ERROR : ' . $e->getMessage());
	    }

      $this->log->debug('verifyLogin() - EXIT, isValid : [' . $isValid . ']');

	    return $isValid;
	    //return $userIdFromDB;
	}

  function checkUserExists($userId)
  {
      $this->log->debug('checkUserExists() - ENTER');
      $this->log->debug('userId : [' . $userId . ']');

      global $pdo;

      $isValid = false;

      //Not required because we use PreparedStatement bind() method. However sanitize() uses other cleaning as well.
      $userId = $this->sanitize($userId);

      //$sql = "SELECT * from TblUser where UserId=:userId and Password=:password";
      $sql = "SELECT * from TblUser a where a.UserId=:userId";
      //$sql = "SELECT * from TblMember where UserId=:userId";

      //echo "<b>Query : </b> " . $sql . "<br/>";
      $this->log->debug("Query : [ " . $sql . "]");

      try
      {
          $statement = $pdo->prepare($sql);

          $statement->bindParam(":userId", $userId);

          $statement->execute();

          $rows = $statement->fetchAll(PDO::FETCH_ASSOC);

          foreach($rows as $row) {
              //printf("$row[0] $row[1] $row[2]\n");
              //print_r($row);
              //echo $row['UserId'];
              $isValid = true;
          }

          //$pdo = null;
      }
      catch(PDOException $e)
      {
        //[TODO] Proper way of error handling.
          echo 'ERROR: ' . $e->getMessage();
          $this->log->error('ERROR : ' . $e->getMessage());
	    }

      $this->log->debug('checkUserExists() - EXIT, isValid : [' . $isValid . ']');

      return $isValid;
      //return $userIdFromDB;
  }

  function insertUser()
	{
      $this->log->debug('insertUser() - ENTER');

	    global $pdo;

      $UserName = $_POST['RegnNo'];
      $Password = $_POST['RegnNo'];

      /*echo "<b>UserName : </b> " . $UserName . "<br/>";
      echo "<b>Password : </b> " . $Password . "<br/>";*/
      $this->log->debug("insertUser() - UserName : [$UserName], Password : [$Password]");

	    //$sql = "SELECT * from TblUser where UserId=:userId and Password=:password";
      $sql = "INSERT INTO TblUser (UserId, Password, CREATED_BY) VALUES (:userName, :password, :createdBy)";
	    //$sql = "SELECT * from TblMember where UserId=:userId";

      $this->log->debug("Query : [ " . $sql . "]");

      $createdBy = isset($_SESSION['user']) ? $_SESSION['user'] : '';
      $this->log->debug('insertUser() - createdBy : ' . $createdBy);

      $IdInserted = 0;
      $ExecResult = null;

	    try
	    {
          //$pdo->beginTransaction();

	        $statement = $pdo->prepare($sql);

          $statement->bindParam(":userName", $UserName);
   	      $statement->bindParam(":password", $Password);
          $statement->bindParam(":createdBy", $createdBy);
          //print_r($statement->execute());
          $ExecResult = $statement->execute();
          $count = $statement->rowCount();

          $IdInserted = $pdo->lastInsertId();
          //echo "<i>Inserted into the TblUser, with Id : <b>" . $IdInserted . "</b></i> <br/>";
          $this->log->debug("IdInserted : [ " . $IdInserted . "]");
          //$pdo->commit();

          $errorCode= $statement->errorCode();
          $errorInfoArray = $statement->errorInfo();

          //echo "<b>RowCount : </b> " . $count . "<br/>";
          $this->log->debug('insertUser() - ExecResult : ' . $ExecResult);
          $this->log->debug('insertUser() - RowCount : ' . $count);
          $this->log->debug('insertUser() - errorCode : ' . $errorCode);
          $this->log->debug('insertUser() - errorInfoArray : ' . print_r($errorInfoArray, 1));
	    }
	    catch(PDOException $e)
	    {
	    	//[TODO] Proper way of error handling.
          //$pdo->rollback();
	        echo '<br/>ERROR: ' . $e->getMessage();
          $this->log->error('ERROR : ' . $e->getMessage());
	    }

      $this->log->debug('insertUser() - EXIT');

	    //return $isValid;
	    //return $userIdFromDB;
      return $IdInserted;
	}

  function insertUserRole($UserId)
  {
      $this->log->debug('insertUserRole() - ENTER');

      global $pdo;

      /*$RegnNo = $_POST['RegnNo'];
      $RegnNo = $_POST['RegnNo']; */

      //$UserName = $_POST['RegnNo'];

      //echo "insertUserRole() - <b>UserId : </b> " . $UserId . "<br/>";

      //$sql = "SELECT * from TblUser where UserId=:userId and Password=:password";
      $sql = "INSERT INTO TblUserRole (UserId, RoleId, CREATED_BY) VALUES (:userId, 4, :createdBy)"; //4 - Student
      //$sql = "SELECT * from TblMember where UserId=:userId";

      $createdBy = isset($_SESSION['user']) ? $_SESSION['user'] : '';
      $this->log->debug('insertUserRole() - createdBy : ' . $createdBy);

      $IdInserted = 0;
      $ExecResult = null;

      try
      {
          //$pdo->beginTransaction();

          $statement = $pdo->prepare($sql);

          $statement->bindParam(":userId", $UserId);
          $statement->bindParam(":createdBy", $createdBy);
          //print_r($statement->execute());
          $ExecResult = $statement->execute();
          $count = $statement->rowCount();

          $IdInserted = $pdo->lastInsertId();
          //echo "<i>Inserted into the TblUserRole, with Id : <b>" . $IdInserted . "</b></i> <br/>";
          //$pdo->commit();

          $errorCode= $statement->errorCode();
          $errorInfoArray = $statement->errorInfo();

          //echo "<b>RowCount : </b> " . $count . "<br/>";
          $this->log->debug('insertUserRole() - ExecResult : ' . $ExecResult);
          $this->log->debug('insertUserRole() - RowCount : ' . $count);
          $this->log->debug('insertUserRole() - errorCode : ' . $errorCode);
          $this->log->debug('insertUserRole() - errorInfoArray : ' . print_r($errorInfoArray, 1));
      }
      catch(PDOException $e)
      {
        //[TODO] Proper way of error handling.
          echo '<br/>ERROR: ' . $e->getMessage();
          //$pdo->rollback();
          $this->log->error('ERROR : ' . $e->getMessage());
      }

      $this->log->debug('insertUserRole() - EXIT');

      //return $isValid;
      //return $userIdFromDB;
      return $IdInserted;
  }

  function insertStudent()
	{
    $this->log->debug('insertStudent() - ENTER');

    /*echo "<br/>";
    echo "<b>POST Array contents :: </b><br/>";
    print_r($_POST);
    echo "<br/>";*/

    $Name = $_POST['Name'];
    $RegnNo = $_POST['RegnNo'];
    $ModeId = $_POST['ModeId'];
    $DOB = $_POST['DOB'];
    $Gender = $_POST['Gender'];
    $DeptId = $_POST['DeptId'];
    $Year = $_POST['Year'];
    $AadhaarNo = $_POST['AadhaarNo'];
    $FathersName = $_POST['FathersName'];
    $MothersName = $_POST['MothersName'];
    $ReligionId = $_POST['ReligionId'];
    $CommunityId = $_POST['CommunityId'];
    $Email = $_POST['Email'];
    $Mobile = $_POST['Mobile'];
    $Address = $_POST['Address'];
    $Id = $_POST['UserId'];

    $createdBy = isset($_SESSION['user']) ? $_SESSION['user'] : '';
    $this->log->debug('insertStudent() - createdBy : ' . $createdBy);

    $this->log->debug('insertStudent() - \$_POST - CommunityId : ' . $CommunityId);

    /* In case the actual / updated Community Id is 0 from UI, it must be stored as Null in DB */
    //if(!empty($CommunityId) && strcmp($CommunityId, '0')==0) {
    if(strcmp($CommunityId, '0')==0) {
      $this->log->debug("insertStudent() - CommunityId is NOT EMPTY but Zero!");
      $CommunityId = NULL;
    }

    $this->log->debug('insertStudent() - (Computed) CommunityId : ' . $CommunityId);

    //echo "insertStudent() - UserId : " . $Id . "<br/>";

    global $pdo;

    /*$sql = "INSERT INTO TblStudent (`UserId`, `RegnNo`, `Name`, `DOB`, `Gender`,`DeptId`, `Year`, `AadhaarNo`,
      `FathersName`, `MothersName`, `Email`, `Mobile`, `Address`)
       VALUES (':userId', ':regnNo', ':name', ':dob', ':gender', ':deptId', ':year', ':aadhaarNo',
          ':fathersName', ':mothersName', ':email', ':mobile', ':address')";*/

    $sql = "INSERT INTO TblStudent (UserId, RegnNo, ModeId, Name, DOB, Gender, DeptId, Year, AadhaarNo,
            FathersName, MothersName, ReligionId, CommunityId, Email, Mobile, Address, CREATED_BY)
          VALUES (:userId, :regnNo, :modeId, :name, :dob, :gender, :deptId, :year, :aadhaarNo,
            :fathersName, :mothersName, :religionId, :communityId, :email, :mobile, :address, :createdBy)";

    /*echo "<br/>";
    echo "<b>SQL Query :: </b> " . $sql . "<br/>";
    echo "<br/>";*/

    //$this->insertUser($RegnNo, $RegnNo);
    //$this->insertUserRole($RegnNo);

    $this->log->debug('insertStudent() - SQL : ' . $sql);

    $this->log->debug('insertStudent () - $_POST Array : ' . print_r($_POST, 1));

    $ExecResult = false;

    try
    {
        //$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $statement = $pdo->prepare($sql);

        $statement->bindParam(":userId", $Id);
        $statement->bindParam(":regnNo", $RegnNo);
        $statement->bindParam(":modeId", $ModeId);
        $statement->bindParam(":name", $Name);
        $statement->bindParam(":dob", $DOB);
        $statement->bindParam(":gender", $Gender);
        $statement->bindParam(":deptId", $DeptId);
        $statement->bindParam(":year", $Year);
        $statement->bindParam(":aadhaarNo", $AadhaarNo);
        $statement->bindParam(":fathersName", $FathersName);
        $statement->bindParam(":mothersName", $MothersName);
        $statement->bindParam(":religionId", $ReligionId);
        $statement->bindParam(":communityId", $CommunityId);
        $statement->bindParam(":email", $Email);
        $statement->bindParam(":mobile", $Mobile);
        $statement->bindParam(":address", $Address);
        $statement->bindParam(":createdBy", $createdBy);

        $ExecResult = $statement->execute();
        $count = $statement->rowCount();

        //echo "<b>RowCount : </b> " . $count . "<br/>";

        $errorCode= $statement->errorCode();
        $errorInfoArray = $statement->errorInfo();

        //echo "<b>RowCount : </b> " . $count . "<br/>";
        $this->log->debug('insertStudent() - ExecResult : ' . $ExecResult);
        $this->log->debug('insertStudent() - RowCount : ' . $count);
        $this->log->debug('insertStudent() - errorCode : ' . $errorCode);
        $this->log->debug('insertStudent() - errorInfoArray : ' . print_r($errorInfoArray, 1));
      }
      catch(PDOException $e)
      {
          //[TODO] Proper way of error handling.
          echo 'ERROR: ' . $e->getMessage();
          $this->log->error('ERROR : ' . $e->getMessage());
      }

      /*if($ExecResult) {
        echo "<br/><i>Inserted the details into the TblStudent...</i> <br/>";
      } else {
        echo "<br/><font color=red><i>Failed to Insert the details into the TblStudent...</i></font> <br/>";
      }*/

      $this->log->debug('insertStudent() - EXIT');

      return $ExecResult;
	}

  function UnUsedRefActivateUser($UserId)
	{
      $this->log->debug('activateUser() - ENTER, UserId : [' . $UserId . ']');

	    global $pdo;

      $sql = "UPDATE TblUser SET IS_ACTIVE='Y' WHERE USERId=:userId";

      $this->log->debug('activateUser() - SQL : ' . $sql);
      $this->log->debug('activateUser() - $_POST Array : ' . print_r($_POST, 1));

      $ExecResult = false;

	    try
	    {
          //$pdo->beginTransaction();
	        $statement = $pdo->prepare($sql);

          $statement->bindParam(":userId", $UserId);

          $ExecResult = $statement->execute();
          //$pdo->commit();
          $count = $statement->rowCount();

          echo "<b>RowCount : </b> " . $count . "<br/>";
          $this->log->debug('activateUser() - RowCount : ' + $count);

          $errorCode= $statement->errorCode();
          $errorInfoArray = $statement->errorInfo();

          //echo "<b>RowCount : </b> " . $count . "<br/>";
          $this->log->debug('activateUser() - ExecResult : ' . $ExecResult);
          $this->log->debug('activateUser() - RowCount : ' . $count);
          $this->log->debug('activateUser() - errorCode : ' . $errorCode);
          $this->log->debug('activateUser() - errorInfoArray : ' . print_r($errorInfoArray, 1));

	    }
	    catch(PDOException $e)
	    {
	    	//[TODO] Proper way of error handling.
          //$pdo->rollback();
	        echo '<br/>ERROR: ' . $e->getMessage();
          $this->log->error('ERROR : ' . $e->getMessage());
	    }

      $this->log->debug('activateUser() - EXIT');

      /*if($ExecResult) {
        echo "<br/><i>Successfully Activated the User Account.</i> <br/>";
      } else {
        echo "<br/><font color=red><i>Failed to activte the User...</i></font> <br/>";
      }*/

      return $ExecResult;
	}

  function activateUser($UserId)
	{
    $this->log->debug("activateUser() - ENTER, UserId : [$UserId]");
    return $this->updateUserActiveStatus($UserId, 'Y');
  }

  function deactivateUser($UserId)
	{
    $this->log->debug("deactivateUser() - ENTER, UserId : [$UserId]");
    return $this->updateUserActiveStatus($UserId, 'N');
  }

  function updateUserActiveStatus($UserId, $Status)
	{
      $this->log->debug('updateUserActiveStatus() - ENTER');
      $this->log->debug("updateUserActiveStatus() - UserId : [$UserId], Status : [$Status]");

	    global $pdo;

      $sql = "UPDATE TblUser SET `IS_ACTIVE`=:status, `MODIFIED_BY`=:modifiedBy WHERE USERId=:userId";

      $this->log->debug('updateUserActiveStatus() - SQL : ' . $sql);
      //$this->log->debug('updateUserActiveStatus() - $_POST Array : ' . print_r($_POST, 1));

      $ExecResult = false;

      $modifiedBy = isset($_SESSION['user']) ? $_SESSION['user'] : '';
      $this->log->debug("updateUserActiveStatus() - modifiedBy : [$modifiedBy]");

	    try
	    {
          //$pdo->beginTransaction();
	        $statement = $pdo->prepare($sql);

          $statement->bindParam(":status", $Status);
          $statement->bindParam(":modifiedBy", $modifiedBy);
          $statement->bindParam(":userId", $UserId);

          $ExecResult = $statement->execute();
          //$pdo->commit();
          $count = $statement->rowCount();

          echo "<b>RowCount : </b> " . $count . "<br/>";
          $this->log->debug('updateUserActiveStatus() - RowCount : ' + $count);

          $errorCode= $statement->errorCode();
          $errorInfoArray = $statement->errorInfo();

          //echo "<b>RowCount : </b> " . $count . "<br/>";
          $this->log->debug('updateUserActiveStatus() - ExecResult : ' . $ExecResult);
          $this->log->debug('updateUserActiveStatus() - RowCount : ' . $count);
          $this->log->debug('updateUserActiveStatus() - errorCode : ' . $errorCode);
          $this->log->debug('updateUserActiveStatus() - errorInfoArray : ' . print_r($errorInfoArray, 1));
	    }
	    catch(PDOException $e)
	    {
	    	//[TODO] Proper way of error handling.
          //$pdo->rollback();
	        echo '<br/>ERROR: ' . $e->getMessage();
          $this->log->error('ERROR : ' . $e->getMessage());
	    }

      $this->log->debug('updateUserActiveStatus() - EXIT');

      /*if($ExecResult) {
        echo "<br/><i>Successfully Activated the User Account.</i> <br/>";
      } else {
        echo "<br/><font color=red><i>Failed to activte the User...</i></font> <br/>";
      }*/

      return $ExecResult;
	}

  function updateStudent()
	{
    $this->log->debug('updateStudent() - ENTER');

    $Name = isset($_POST['Name']) ? $_POST['Name'] : '';
    $RegnNo = isset($_POST['RegnNo']) ? $_POST['RegnNo'] : '';
    $ModeId = isset($_POST['ModeId']) ? $_POST['ModeId'] : '';
    $DOB = isset($_POST['DOB']) ? $_POST['DOB'] : '';
    $Gender = isset($_POST['Gender']) ? $_POST['Gender'] : '';
    /*
     * Though the UI controls may be disabled based on the role, the value gets
     * submitted due to the hack applied in the enablePath() method in sms.js file,
     * where the selected UI controls are enabled just before the form gets submitted
     *
     * Applicable to all such UI controls (checkbox, dropdown etc.,)
     * 
     * Reference : StackOverflow link : https://stackoverflow.com/a/9413809/1001242
     */
    $DeptId = isset($_POST['DeptId']) ? $_POST['DeptId'] : '';
    $Year = isset($_POST['Year']) ? $_POST['Year'] : '';
    $AadhaarNo = isset($_POST['AadhaarNo']) ? $_POST['AadhaarNo'] : '';
    $FathersName = isset($_POST['FathersName']) ? $_POST['FathersName'] : '';
    $MothersName = isset($_POST['MothersName']) ? $_POST['MothersName'] : '';
    $ReligionId = isset($_POST['ReligionId']) ? $_POST['ReligionId'] : '';
    $CommunityId = isset($_POST['CommunityId']) ? $_POST['CommunityId'] : '';
    $Email = isset($_POST['Email']) ? $_POST['Email'] : '';
    $Mobile = isset($_POST['Mobile']) ? $_POST['Mobile'] : '';
    $Address = isset($_POST['Address']) ? $_POST['Address'] : '';
    $IsActive = isset($_POST['IsActive']) ? $_POST['IsActive'] : '';
    $UserId = isset($_POST['UserId']) ? $_POST['UserId'] : '';

    echo "updateStudent() - UserId : " . $UserId . "<br/>";
    $this->log->debug('updateStudent() - UserId : ' . $UserId);

    echo "updateStudent() - IsActive : " . $IsActive . "<br/>";
    $this->log->debug('updateStudent() - IsActive : ' . $IsActive);

    $modifiedBy = isset($_SESSION['user']) ? $_SESSION['user'] : '';
    $this->log->debug('updateStudent() - modifiedBy : ' . $modifiedBy);

    /* In case the actual / updated Community Id is 0 from UI, it must be stored as Null in DB */
    //if(!empty($CommunityId) && strcmp($CommunityId, '0')==0) {
    if(strcmp($CommunityId, '0')==0) {
      $this->log->debug("updateStudent() - CommunityId is NOT EMPTY but Zero!");
      $CommunityId = NULL;
    }
    $this->log->debug('updateStudent() - (Computed) CommunityId : ' . $CommunityId);

    global $pdo;

    /* Learnings : https://stackoverflow.com/a/37581288/1001242 */
    /**
     * Error : SQLSTATE[HY093]: Invalid parameter number: number of bound variables does not match number of tokens error
     * Reason: The two values were not bound(missing = symbol, stupid/silly mistake as a typo)
     * Solution : https://stackoverflow.com/questions/11942999/error-sqlstatehy093-invalid-parameter-number-number-of-bound-variables-does?rq=1
     */
    $sql = "UPDATE
                TblStudent
            SET
                `RegnNo`=:regnNo, `ModeId`=:modeId, `Name`=:name, `DOB`=:dob,
                `Gender`=:gender, `DeptId`=:deptId, `Year`=:year, `AadhaarNo`=:aadhaarNo,
                `FathersName`=:fathersName, `MothersName`=:mothersName,
                `ReligionId`=:religionId, `CommunityId`=:communityId,
                `Email`=:email, `Mobile`=:mobile, `Address`=:address,
                `MODIFIED_BY`=:modifiedBy, `IS_ACTIVE`=:isActive
            WHERE
                UserId=:userId";

    $this->log->debug('updateStudent() - SQL : ' . $sql);

    $this->log->debug('updateStudent() - $_POST Array : ' . print_r($_POST, 1));

    $ExecResult = false;

    try
    {
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $statement = $pdo->prepare($sql);
        $statement->bindParam(":regnNo", $RegnNo);
        $statement->bindParam(":modeId", $ModeId);
        $statement->bindParam(":name", $Name);
        $statement->bindParam(":dob", $DOB);
        $statement->bindParam(":gender", $Gender);
        $statement->bindParam(":deptId", $DeptId);
        $statement->bindParam(":year", $Year);
        $statement->bindParam(":aadhaarNo", $AadhaarNo);
        $statement->bindParam(":fathersName", $FathersName);
        $statement->bindParam(":mothersName", $MothersName);
        $statement->bindParam(":religionId", $ReligionId);
        $statement->bindParam(":communityId", $CommunityId);
        $statement->bindParam(":email", $Email);
        $statement->bindParam(":mobile", $Mobile);
        $statement->bindParam(":address", $Address);
        $statement->bindParam(":modifiedBy", $modifiedBy);
        $statement->bindParam(":isActive", $IsActive);
        //$statement->bindParam(":userId", $Id, PDO::PARAM_INT);
        $statement->bindParam(":userId", $UserId);

        $ExecResult = $statement->execute();
        $count = $statement->rowCount();

        echo "<b>RowCount : </b> " . $count . "<br/>";
        $this->log->debug('updateStudent() - RowCount : ' + $count);

        $errorCode= $statement->errorCode();
        $errorInfoArray = $statement->errorInfo();

        //echo "<b>RowCount : </b> " . $count . "<br/>";
        $this->log->debug('updateStudent() - ExecResult : ' . $ExecResult);
        $this->log->debug('updateStudent() - RowCount : ' . $count);
        $this->log->debug('updateStudent() - errorCode : ' . $errorCode);
        $this->log->debug('updateStudent() - errorInfoArray : ' . print_r($errorInfoArray, 1));
      }
      catch(PDOException $e)
      {
        //[TODO] Proper way of error handling.
          echo 'ERROR: ' . $e->getMessage();
          $this->log->error('ERROR : ' . $e->getMessage());
      }

      /*if($ExecResult) {
        echo "<br/><i>Inserted the details into the TblStudent...</i> <br/>";
      } else {
        echo "<br/><font color=red><i>Failed to Insert the details into the TblStudent...</i></font> <br/>";
      }*/

      return $ExecResult;
	}

  function insertStudentByObj($UserBO)
  {
    $this->insertStudent($UserBO->getUserId());
  }


  function getIdByUserName($UserName)
	{
      $this->log->debug('getIdByUserName() - ENTER');
      $this->log->debug('UserName : [' . $UserName . ']');

	    $UserBO = $this->getUserByUserName($UserName);
      $Id = 0;
      if(!empty($UserBO)) {
        $Id = $UserBO->getId();
      }

      $this->log->debug('Id :: ' . $Id);
      $this->log->debug('getIdByUserName() - EXIT');

	    return $Id;
	}

  function getUserByUserName($UserName)
	{
      $this->log->debug('getUserByUserName() - ENTER');
      $this->log->debug('UserName : [' . $UserName . ']');

	    global $pdo;

      $isValid=false;
	    $Id = '';

		  //Not required because we use PreparedStatement bind() method. However sanitize() uses other cleaning as well.
	    $UserName = $this->sanitize($UserName);

	    $sql = "SELECT * from TblUser where UserId=:UserName";
	    //$sql = "SELECT * from TblMember where UserId=:userId";

      $this->log->debug("Query : [ " . $sql . "]");
      $UserBO = null;
	    try
	    {
	        $query = $pdo->prepare($sql);

	        $query->bindParam(":UserName", $UserName);

	        $query->execute();

	        /*while($row = $query->fetch())
	        {
	            echo "Row valid! ......................<br/>";
	            //print_r($row);
	            $isValid=true;
	            $userIdFromDB = $row['Name'];
	        }*/

	        $row = $query->fetch();

	        $UserBO = new TblUserBO;
	        $UserBO->copyFromResultSet($row);

	        if(!empty($UserBO->getId()))
	        {
	            $isValid=true;
	            //$Id = $userBO->getId();
							/** gets omitted because of a redirection through header() function in login.php */
							/*echo "<br/>--------- <br/>";
							echo "<pre> " , var_dump($_SESSION), "</pre>";
					    echo "<br/>--------- <br/>";
							echo "<pre> " , var_dump($memberBO), "</pre>";
					    echo "<br/>--------- <br/>";*/

              storeUserBOToSession($UserBO);
	        }

	       	//$pdo = null;
	    }
	    catch(PDOException $e)
	    {
	    	  //[TODO] Proper way of error handling.
	        echo 'ERROR: ' . $e->getMessage();
          $this->log->error('ERROR : ' . $e->getMessage());
	    }

      $this->log->debug("## User ## : [ " . $UserBO . "]");
      $this->log->debug('getUserByUserName() - EXIT');

	    //return $isValid;
	    return $UserBO;
	}


  function getUserById($Id)
  {
      //echo "<br/> getUserById - ID : $Id <br/>";

      global $pdo;

      $isValid = false;
      $userIdFromDB = '';

      //Not required because we use PreparedStatement bind() method. However sanitize() uses other cleaning as well.
      $Id = $this->sanitize($Id);

      $sql = "SELECT * from TblUser where Id=:Id";

      try
      {
          $query = $pdo->prepare($sql);
          $query->bindParam(":Id", $Id);
          $query->execute();

          while($row = $query->fetch())
          {
              $userBO = new TblUserBO;
              $userBO->copyFromResultSet($row);
          }

          //$row = $query->fetch();
          $userBO = new TblUserBO;
          $userBO->copyFromResultSet($row);
          //$pdo = null;
      }
      catch(PDOException $e)
      {
        //[TODO] Proper way of error handling.
          echo 'ERROR: ' . $e->getMessage();
          $this->log->error('ERROR : ' . $e->getMessage());
      }

      return $userBO;
  }

  function getAllUsers()
  {
      //echo "<br/> getUserById - ID : $Id <br/>";
      $this->log->debug("getAllUsers() - ENTRY");

      global $pdo;

      $sql = "SELECT * from TblUser where IS_ACTIVE='Y'";

      $this->log->info("Query: [$sql]");

      $userBO = null;
	    $tblUserBOArray = array();

      try
      {
          $query = $pdo->prepare($sql);

          //$query->bindParam(':IsActive', "Y");

          $query->execute();

          while($row = $query->fetch())
          {
            //print_r($row);

            $userBO = new TblUserBO;
            $userBO->copyFromResultSet($row);

            array_push($tblUserBOArray, $userBO);
          }

          //$pdo = null;
      }
      catch(PDOException $e)
      {
        //[TODO] Proper way of error handling.
          echo 'ERROR: ' . $e->getMessage();
          $this->log->error('ERROR : ' . $e->getMessage());
      }

      $this->log->debug("getAllUsers() - EXIT, # of Users : [" . count($tblUserBOArray) . "]");

      return $tblUserBOArray;
  }

  function deleteStudent($UserId)
  {
    $this->log->debug('deleteStudent() - UserId (Param) : [' . $UserId . ']');

    //echo "deleteStudent() - UserId : " . $Id . "<br/>";

    global $pdo;

      //$sql = "DELETE FROM TblStudent WHERE UserId=:userId";
      //$sql = "DELETE FROM TblStudent WHERE RegnNo='912518106010'";
      //$sql = "DELETE FROM TblStudent WHERE RegnNo=:userId";
      $sql = "UPDATE TblStudent SET `IS_ACTIVE`='N', `MODIFIED_BY`=:modifiedBy WHERE RegnNo=:userId";

      $this->log->debug('deleteStudent() - SQL : [' . $sql . "]");

    /*echo "<br/>";
    echo "<b>SQL Query :: </b> " . $sql . "<br/>";
    echo "<br/>";*/

    $ExecResult = false;

    $modifiedBy = isset($_SESSION['user']) ? $_SESSION['user'] : '';
    $this->log->debug('deleteStudent() - modifiedBy : ' . $modifiedBy);

    try
    {
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $statement = $pdo->prepare($sql);

        $statement->bindParam(":userId", $UserId);
        $statement->bindParam(":modifiedBy", $modifiedBy);

        $ExecResult = $statement->execute();
        $count = $statement->rowCount();

        $errorCode= $statement->errorCode();
        $errorInfoArray = $statement->errorInfo();

        //echo "<b>RowCount : </b> " . $count . "<br/>";
        $this->log->debug('deleteStudent() - ExecResult : ' . $ExecResult);
        $this->log->debug('deleteStudent() - RowCount : ' . $count);
        $this->log->debug('deleteStudent() - errorCode : ' . $errorCode);
        $this->log->debug('deleteStudent() - errorInfoArray : ' . print_r($errorInfoArray, 1));
      }
      catch(PDOException $e)
      {
        //[TODO] Proper way of error handling.
          echo 'ERROR: ' . $e->getMessage();
          $this->log->error('ERROR : ' . $e->getMessage());
      }

      /*if($ExecResult) {
        echo "<br/><i>Deleted the Record from TblStudent...</i> <br/>";
      } else {
        echo "<br/><font color=red><i>Failed to delete a record from TblStudent...</i></font> <br/>";
      }*/

      return $count;
  }


  function deleteUser($UserId)
  {
    $this->log->debug('deleteUser() - UserId (Param) : [' . $UserId . ']');

    //echo "deleteStudent() - UserId : " . $Id . "<br/>";

    global $pdo;

    $modifiedBy = isset($_SESSION['user']) ? $_SESSION['user'] : '';
    $this->log->debug('deleteUser() - modifiedBy : ' . $modifiedBy);

      //$sql = "DELETE FROM TblStudent WHERE UserId=:userId";
      //$sql = "DELETE FROM TblStudent WHERE RegnNo='912518106010'";
      //$sql = "DELETE FROM TblUser WHERE UserId=:userId";
      $sql = "UPDATE TblUser SET `IS_ACTIVE`='N', `MODIFIED_BY`=:modifiedBy WHERE UserId=:userId";

      $this->log->debug('deleteUser() - SQL : [' . $sql . "]");

    /*echo "<br/>";
    echo "<b>SQL Query :: </b> " . $sql . "<br/>";
    echo "<br/>";*/

    $ExecResult = false;

    try
    {
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $statement = $pdo->prepare($sql);

        $statement->bindParam(":userId", $UserId);
        $statement->bindParam(":modifiedBy", $modifiedBy);

        $ExecResult = $statement->execute();
        $count = $statement->rowCount();

        $errorCode= $statement->errorCode();
        $errorInfoArray = $statement->errorInfo();

        //echo "<b>RowCount : </b> " . $count . "<br/>";
        $this->log->debug('deleteUser() - ExecResult : ' . $ExecResult);
        $this->log->debug('deleteUser() - RowCount : ' . $count);
        $this->log->debug('deleteUser() - errorCode : ' . $errorCode);
        $this->log->debug('deleteUser() - errorInfoArray : ' . print_r($errorInfoArray, 1));
      }
      catch(PDOException $e)
      {
        //[TODO] Proper way of error handling.
          echo 'ERROR: ' . $e->getMessage();
          $this->log->error('ERROR : ' . $e->getMessage());
      }

      /*if($ExecResult) {
        echo "<br/><i>Deleted the Record from TblStudent...</i> <br/>";
      } else {
        echo "<br/><font color=red><i>Failed to delete a record from TblStudent...</i></font> <br/>";
      }*/

      return $count;
  }
}
?>
