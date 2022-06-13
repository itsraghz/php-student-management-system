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
      $sql = "SELECT * from TblUser a where a.UserId=:userId and a.Password=:password";
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

	    //$sql = "SELECT * from TblUser where UserId=:userId and Password=:password";
      $sql = "INSERT INTO TblUser (UserId, Password) VALUES (:userName, :password)";
	    //$sql = "SELECT * from TblMember where UserId=:userId";

      $this->log->debug("Query : [ " . $sql . "]");

      $IdInserted = 0;

	    try
	    {
          //$pdo->beginTransaction();

	        $statement = $pdo->prepare($sql);

          $statement->bindParam(":userName", $UserName);
   	      $statement->bindParam(":password", $Password);
          //print_r($statement->execute());
          $statement->execute();
          $IdInserted = $pdo->lastInsertId();
          //echo "<i>Inserted into the TblUser, with Id : <b>" . $IdInserted . "</b></i> <br/>";
          $this->log->debug("IdInserted : [ " . $IdInserted . "]");
          //$pdo->commit();
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
      global $pdo;

      /*$RegnNo = $_POST['RegnNo'];
      $RegnNo = $_POST['RegnNo']; */

      //$UserName = $_POST['RegnNo'];

      //echo "insertUserRole() - <b>UserId : </b> " . $UserId . "<br/>";

      //$sql = "SELECT * from TblUser where UserId=:userId and Password=:password";
      $sql = "INSERT INTO TblUserRole (UserId, RoleId) VALUES (:userId, 4)"; //4 - Student
      //$sql = "SELECT * from TblMember where UserId=:userId";

      $IdInserted = 0;

      try
      {
          //$pdo->beginTransaction();

          $statement = $pdo->prepare($sql);

          $statement->bindParam(":userId", $UserId);
          //print_r($statement->execute());
          $statement->execute();
          $IdInserted = $pdo->lastInsertId();
          //echo "<i>Inserted into the TblUserRole, with Id : <b>" . $IdInserted . "</b></i> <br/>";
          //$pdo->commit();
      }
      catch(PDOException $e)
      {
        //[TODO] Proper way of error handling.
          echo '<br/>ERROR: ' . $e->getMessage();
          //$pdo->rollback();
      }

      //return $isValid;
      //return $userIdFromDB;
      return $IdInserted;
  }

  function insertStudent()
	{
    /*echo "<br/>";
    echo "<b>POST Array contents :: </b><br/>";
    print_r($_POST);
    echo "<br/>";*/

    $Name = $_POST['Name'];
    $RegnNo = $_POST['RegnNo'];
    $DOB = $_POST['DOB'];
    $Gender = $_POST['Gender'];
    $Department = $_POST['Department'];
    $Year = $_POST['Year'];
    $AadhaarNo = $_POST['AadhaarNo'];
    $FathersName = $_POST['FathersName'];
    $MothersName = $_POST['MothersName'];
    $Email = $_POST['Email'];
    $Mobile = $_POST['Mobile'];
    $Address = $_POST['Address'];
    $Id = $_POST['UserId'];

    //echo "insertStudent() - UserId : " . $Id . "<br/>";

    global $pdo;


    /*$sql = "INSERT INTO TblStudent (`UserId`, `RegnNo`, `Name`, `DOB`, `Gender`,`Department`, `Year`, `AadhaarNo`,
      `FathersName`, `MothersName`, `Email`, `Mobile`, `Address`)
       VALUES (':userId', ':regnNo', ':name', ':dob', ':gender', ':department', ':year', ':aadhaarNo',
          ':fathersName', ':mothersName', ':email', ':mobile', ':address')";*/

    $sql = "INSERT INTO TblStudent (UserId, RegnNo, Name, DOB, Gender, Department, Year, AadhaarNo,
            FathersName, MothersName, Email, Mobile, Address)
          VALUES (:userId, :regnNo, :name, :dob, :gender, :department, :year, :aadhaarNo,
            :fathersName, :mothersName, :email, :mobile, :address)";

    /*echo "<br/>";
    echo "<b>SQL Query :: </b> " . $sql . "<br/>";
    echo "<br/>";*/

    //$this->insertUser($RegnNo, $RegnNo);
    //$this->insertUserRole($RegnNo);

    $ExecResult = false;

    try
    {
        //$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $statement = $pdo->prepare($sql);

        $statement->bindParam(":userId", $Id);
        $statement->bindParam(":regnNo", $RegnNo);
        $statement->bindParam(":name", $Name);
        $statement->bindParam(":dob", $DOB);
        $statement->bindParam(":gender", $Gender);
        $statement->bindParam(":department", $Department);
        $statement->bindParam(":year", $Year);
        $statement->bindParam(":aadhaarNo", $AadhaarNo);
        $statement->bindParam(":fathersName", $FathersName);
        $statement->bindParam(":mothersName", $MothersName);
        $statement->bindParam(":email", $Email);
        $statement->bindParam(":mobile", $Mobile);
        $statement->bindParam(":address", $Address);

        $ExecResult = $statement->execute();
        $count = $statement->rowCount();

        //echo "<b>RowCount : </b> " . $count . "<br/>";
      }
      catch(PDOException $e)
      {
        //[TODO] Proper way of error handling.
          echo 'ERROR: ' . $e->getMessage();
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
              /*echo "Row valid! ......................<br/>";
              print_r($row);
              echo "<br/>";*/

              //$isValid=true;
              //$userIdFromDB = $row['Name'];

              $userBO = new TblUserBO;
              /*echo "userBo just instantiated.....<br/>";
              var_dump($userBO);
              echo "<br/>";
              print_r($userBO);
              echo "<br/>";*/

              $userBO->copyFromResultSet($row);
              /*echo "userBo copied over from the row object.....<br/>";
              var_dump($userBO);
              echo "<br/>";
              print_r($userBO);
              echo "<br/>";*/
          }

          //$row = $query->fetch();

          $userBO = new TblUserBO;
          /*echo "userBo just instantiated.....<br/>";
          var_dump($userBO);
          echo "<br/>";
          print_r($userBO);
          echo "<br/>";*/

          $userBO->copyFromResultSet($row);
          /*echo "userBo copied over from the row object.....<br/>";
          var_dump($userBO);
          echo "<br/>";
          print_r($userBO);
          echo "<br/>";*/

          //$pdo = null;
      }
      catch(PDOException $e)
      {
        //[TODO] Proper way of error handling.
          echo 'ERROR: ' . $e->getMessage();
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

	/**
	 * <p>
	 *		A method to update the member details.
	 * </p>
	 * <p>
	 *		Added for the <tt>SBI-1</tt> (https://shadeteam.atlassian.net/browse/SBI-1)
	 * </p>
	 */
	function update($tblMemberBO)
	{
		global $pdo;

		//echo '<pre>', var_dump($tblMemberBO), '</pre>';

		$sql = "UPDATE TblMember
						SET Name=:Name,
								EmailId1=:EmailId1,
								EmailId2=:EmailId2,
								PhoneNo1=:PhoneNo1,
								PhoneNo2=:PhoneNo2,
								Company=:Company,
								Branch=:Branch,
								City=:City,
								Country=:Country,
								DateOfJoin=:DateOfJoin,
								IsContributor=:IsContributor,
								IsVolunteer=:IsVolunteer,
								IsActive=:IsActive,
								AddToGroups=:AddToGroups,
								Remarks=:Remarks,
								MODIFIED_BY=:ModifiedBy
						WHERE
								Id=:Id
					 ";

		//echo "<b>DEBUG : </b> SQL : <i>" . $sql . "</i><br/>";

		$Id = $tblMemberBO->getId();
		$Name = $tblMemberBO->getName();
		$UserId = $tblMemberBO->getUserId();
		$EmailId1 = $tblMemberBO->getEmailId1();
		$EmailId2 = $tblMemberBO->getEmailId2();
		$PhoneNo1 = $tblMemberBO->getPhoneNo1();
		$PhoneNo2 = $tblMemberBO->getPhoneNo2();
		$Company = $tblMemberBO->getCompany();
		$Branch = $tblMemberBO->getBranch();
		$City = $tblMemberBO->getCity();
		$Country = $tblMemberBO->getCountry();
		$DateOfJoin = $tblMemberBO->getDateOfJoin();
		$IsContributor = $tblMemberBO->getIsContributor();
		$IsVolunteer = $tblMemberBO->getIsVolunteer();
		$IsActive = $tblMemberBO->getIsActive();
		$AddToGroups = $tblMemberBO->getAddToGroups();
		$Remarks = $tblMemberBO->getRemarks();

		try
		{
			$query = $pdo->prepare($sql);

			//Not required because we use PreparedStatement bind() method. However sanitize() uses other cleaning as well.
			$Id - $this->sanitize($Id);
			$Name = $this->sanitize($Name);
			$UserId = $this->sanitize($UserId);
			$EmailId1 = $this->sanitize($EmailId1);
			$EmailId2 = $this->sanitize($EmailId2);
			$PhoneNo1 = $this->sanitize($PhoneNo1);
			$PhoneNo2 = $this->sanitize($PhoneNo2);
			$Company = $this->sanitize($Company);
			$Branch = $this->sanitize($Branch);
			$City = $this->sanitize($City);
			$Country = $this->sanitize($Country);
			$DateOfJoin = $this->sanitize($DateOfJoin);
			$IsContributor = $this->sanitize($IsContributor);
			$IsVolunteer = $this->sanitize($IsVolunteer);
			$IsActive = $this->sanitize($IsActive);
			$AddToGroups = $this->sanitize($AddToGroups);
			$Remarks = $this->sanitize($Remarks);

			$query->bindParam(":Id", $Id);
			$query->bindParam(":Name", $Name);

			/* Not used in the UPDATE Clause so not binding it. Otherwise, it will throw
			 SQLSTATE[HY093]: Invalid parameter number: parameter was not defined */
			//$query->bindParam(":UserId", $UserId);

			$query->bindParam(":EmailId1", $EmailId1);
			$query->bindParam(":EmailId2", $EmailId2);
			$query->bindParam(":PhoneNo1", $PhoneNo1);
			$query->bindParam(":PhoneNo2", $PhoneNo2);
			$query->bindParam(":Company", $Company);
			$query->bindParam(":Branch", $Branch);
			$query->bindParam(":City", $City);
			$query->bindParam(":Country", $Country);
			$query->bindParam(":DateOfJoin", $DateOfJoin);
			$query->bindParam(":IsContributor", $IsContributor);
			$query->bindParam(":IsVolunteer", $IsVolunteer);
			$query->bindParam(":IsActive", $IsActive);
			$query->bindParam(":AddToGroups", $AddToGroups);
			$query->bindParam(":Remarks", $Remarks);
			$query->bindParam(":ModifiedBy", $UserId);

			/*echo "Name : " . $Name;
			echo "<br/>";
			echo "BeneficiaryId : " . $BeneficiaryId;
			echo "<br/>";
			echo "DateEntered : " . $DateEntered;
			echo "<br/>";*/

			$query->execute();

				//$pdo = null;
		}
		catch(PDOException $e)
		{
			echo 'ERROR: ' . $e->getMessage();
		}
	}
}
?>
