<?php

require_once 'BaseBO.php';

class TblStudentBO extends BaseBO {

  private $Id;
  private $UserId;
  private $RegnNo;
  private $Name;
  private $DOB;
  private $Gender;
  private $Department;
  private $Year;
  private $AadhaarNo;
  private $FathersName;
  private $MothersName;
  private $Email;
  private $Mobile;
  private $Address;
  private $IsActive;
  private $CreatedDate;
  private $CreatedBy;
  private $ModifiedDate;
  private $ModifiedBy;

  public function __construct()
  {
    //$this->setUserId(isset($_SESSION['userId']) ? $_SESSION['userId'] : '');
    //$this->setLoginTime(date('Y-m-d H:i:s'));

    //echo 'The class "', __CLASS__, '" was initiated!<br />';
  }

  public function __destruct()
  {
      //echo 'The class "', __CLASS__, '" was destroyed.<br />';
  }

  public function __toString()
  {
      //echo "The __toString() method of TblMemberBO has been invoked.. <br/>";
      return "[StudentBO] Id : " . $this->getId() . ", UserId : " . $this->getUserId() . ", RegnNo : " . $this->getRegnNo();
  }

  public function toLongString()
  {
      //echo "The __toString() method of TblMemberBO has been invoked.. <br/>";
      return "[StudentBO] Id : " . $this->getId()
          . "| UserId : " . $this->getUserId()
          . "| RegnNo : " . $this->getRegnNo()
          . "| Gender : " . $this->getGender()
          . "| Dept : " . $this->getDepartment()
          . "| Year : " . $this->getYear();
  }

  public function hasProperty($property)
	{
		//Syntax : property_exists($myObj, "property");
		//Returns : Boolean
		return property_exists($this, $property);
	}

	public function hasMethod($method)
	{
		//Syntax : method_exists($myObj, "method");
		//Returns : Boolean
		return method_exists($this, $property);
	}

	public function copyFromResultSet($row)
	{
    /*echo "%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%% <br/>";
    echo "copyFromResultSet() - row object contains : <br/>";
    print_r($row);
    echo "------------------ <br/>";
    var_dump($row);
    echo "<br/>";
    echo "%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%% <br/>";*/

		$this->setId($row['Id']);
		$this->setUserId($row['UserId']);
		$this->setRegnNo($row['RegnNo']);
    $this->setName($row['Name']);
    $this->setDOB($row['DOB']);
    $this->setGender($row['Gender']);
    $this->setDepartment($row['Department']);
    $this->setYear($row['Year']);
    $this->setAadhaarNo($row['AadhaarNo']);
    $this->setFathersName($row['FathersName']);
    $this->setMothersName($row['MothersName']);
    $this->setEmail($row['Email']);
    $this->setMobile($row['Mobile']);
    $this->setAddress($row['Address']);
		$this->setIsActive($row['IS_ACTIVE']);
		$this->setCreatedDate($row['CREATED_DATE']);
		$this->setCreatedBy($row['CREATED_BY']);
		$this->setModifiedDate($row['MODIFIED_DATE']);
		$this->setModifiedBy($row['MODIFIED_BY']);

		//$this->setCREATED_DATE($row['CREATED_DATE']);
		/*$CreatedDate = $row['CREATED_DATE'];
	  if(!$this->isValidDate($CreatedDate))
	  {
	    	$CreatedDate = "";
		}

		$this->setCREATED_DATE($CreatedDate);

		$this->setCREATED_BY($row['CREATED_BY']);

		//$this->setMODIFIED_DATE($row['MODIFIED_DATE']);
		$ModifiedDate = $row['MODIFIED_DATE'];
	    if(!$this->isValidDate($ModifiedDate))
	    {
	    	$ModifiedDate="";
		}

		$this->setMODIFIED_DATE($ModifiedDate);

		$this->setMODIFIED_BY($row['MODIFIED_BY']);*/

		/* [28Oct2016] To convert back the HTML characters while displaying */
		/* Ref :  http://php.net/manual/en/function.htmlspecialchars-decode.php */
		//$this->setRemarks($row['Remarks']);
		//$this->setRemarks(htmlspecialchars_decode($row['Remarks']));

		//echo "Properties are successfully populated from Resultset <br/>";

		//echo "<pre>" , print_r($this) , "</pre> <br/>";
	}

  /* ==================================== */
  /*    		GETTERS and SETTERS           */
  /* ==================================== */

  public function getId() {
	    return $this->Id;
	}

	public function setId($Id) {
	    $this->Id=$Id;
	}

	public function getUserId() {
	    return $this->UserId;
	}

	public function setUserId($UserId) {
	    $this->UserId=$UserId;
	}

  public function getName() {
	    return $this->Name;
	}

	public function setName($Name) {
	    $this->Name=$Name;
	}

  public function getRegnNo() {
      return $this->RegnNo;
  }

  public function setRegnNo($RegnNo) {
      $this->RegnNo=$RegnNo;
  }

  public function getDOB() {
      return $this->DOB;
  }

  public function setDOB($DOB) {
      $this->DOB=$DOB;
  }

  public function getGender() {
      return $this->Gender;
  }

  public function setGender($Gender) {
      $this->Gender=$Gender;
  }

  public function getDepartment() {
      return $this->Department;
  }

  public function setDepartment($Department) {
      $this->Department=$Department;
  }

  public function getYear() {
      return $this->Year;
  }

  public function setYear($Year) {
      $this->Year=$Year;
  }

  public function getAadhaarNo() {
      return $this->AadhaarNo;
  }

  public function setAadhaarNo($AadhaarNo) {
      $this->AadhaarNo=$AadhaarNo;
  }

  public function getFathersName() {
      return $this->FathersName;
  }

  public function setFathersName($FathersName) {
      $this->FathersName=$FathersName;
  }

  public function getMothersName() {
      return $this->MothersName;
  }

  public function setMothersName($MothersName) {
      $this->MothersName=$MothersName;
  }

  public function getEmail() {
      return $this->Email;
  }

  public function setEmail($Email) {
      $this->Email=$Email;
  }

  public function getMobile() {
      return $this->Mobile;
  }

  public function setMobile($Mobile) {
      $this->Mobile=$Mobile;
  }

  public function getAddress() {
      return $this->Address;
  }

  public function setAddress($Address) {
      $this->Address=$Address;
  }

  public function getIsActive() {
	    return $this->IsActive;
	}

	public function setIsActive($IsActive) {
	    $this->IsActive=$IsActive;
	}

  public function getCreatedDate() {
	    return $this->CreatedDate;
	}

	public function setCreatedDate($CreatedDate) {
	    $this->CreatedDate=$CreatedDate;
	}

  public function getCreatedBy() {
	    return $this->CreatedBy;
	}

	public function setCreatedBy($CreatedBy) {
	    $this->CreatedBy=$CreatedBy;
	}

  public function getModifiedDate() {
	    return $this->ModifiedDate;
	}

	public function setModifiedDate($ModifiedDate) {
	    $this->ModifiedDate=$ModifiedDate;
	}

  public function getModifiedBy() {
	    return $this->ModifiedBy;
	}

	public function setModifiedBy($ModifiedBy) {
	    $this->ModifiedBy=$ModifiedBy;
	}
}
?>
