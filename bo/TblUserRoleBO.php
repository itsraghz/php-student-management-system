<?php

require_once 'BaseBO.php';

class TblUserRoleBO  { //extends BaseBO {

  private $Id;
  private $UserId;
  private $RoleId;
  private $Description;
  private $IsActive;
  private $CreatedDate;
  private $CreatedBy;
  private $ModifiedDate;
  private $ModifiedBy;

  public function __construct()
  {
    //$this->setRoleId(isset($_SESSION['roleId']) ? $_SESSION['roleId'] : '');
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
      return $this->getUserId() . "::" . $this->getRoleId();
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
		$this->setRoleId($row['RoleId']);
		$this->setDescription($row['Description']);
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

	public function getRoleId() {
	    return $this->RoleId;
	}

	public function setRoleId($RoleId) {
	    $this->RoleId=$RoleId;
	}

  public function getDescription() {
	    return $this->Description;
	}

	public function setDescription($Description) {
	    $this->Description=$Description;
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
