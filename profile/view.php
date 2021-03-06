<?php
  require_once __DIR__ . '/../inc/header.php';

  //echo "User Id in Session : " . $_SESSION['user'] . "<br/>";

  $UserId = isset($_GET['UserId']) ? $_GET['UserId'] : '';
  //echo "User Id in REQ : " . $_SESSION['user'] . "<br/>";

  if(empty($UserId)) {
    $UserId = isset($_SESSION['UserId']) ? $_SESSION['UserId'] : '';
    //echo "User Id in Session : " . $_SESSION['user'] . "<br/>";
  }

  if(empty($UserId)) {
    echo "Invalid User Id to proceed. Please supply a valid User Id. <br/>";
    exit();
  }

  $studentDetails = getDetails($UserId);

  if(empty($studentDetails)) {
    $_SESSION['profileNotFoundMsg']='No matching profile available for the User [<b>' . $UserId . '</b>]. Kindly contact Admin.';
    header('Location: list.php');
  }

  $userName = $studentDetails['userName'];
  $regnNo = $studentDetails['regnNo'];
  $dob = $studentDetails['dob'];
  $gender = $studentDetails['gender'];
  $department = $studentDetails['department'];
  $year = $studentDetails['year'];
  $aadhaarNo = $studentDetails['aadhaarNo'];
  $fathersName = $studentDetails['fathersName'];
  $mothersName = $studentDetails['mothersName'];
  $email = $studentDetails['email'];
  $mobile = $studentDetails['mobile'];
  $address = $studentDetails['address'];


  function getDetails($UserId)
	{
	    global $pdo;

      $studentDetails = array();

	    $isValid = false;
	    $userIdFromDB = '';

		//Not required because we use PreparedStatement bind() method. However sanitize() uses other cleaning as well.
	   // $userId = $this->sanitize($userId);
	   // $password = $this->sanitize($password);

	    $sql = "SELECT * from TblStudent where RegnNo=:userId";
	    //$sql = "SELECT * from TblMember where UserId=:userId";

	    try
	    {
	        $statement = $pdo->prepare($sql);

	        $statement->bindParam(":userId", $UserId);
	        $statement->execute();

          $rows = $statement->fetchAll(PDO::FETCH_ASSOC);

          foreach($rows as $row) {
              //printf("$row[0] $row[1] $row[2]\n");
              //print_r($row);
              //echo $row['UserId'];

              //$userName = $row['Name'];
              //$regnNo = $row['RegnNo'];
              $studentDetails['userName'] = $row['Name'];
              $studentDetails['regnNo'] = $row['RegnNo'];
              $studentDetails['dob'] = $row['DOB'];
              $studentDetails['gender'] = $row['Gender'];
              $studentDetails['department'] = $row['Department'];
              $studentDetails['year'] = $row['Year'];
              $studentDetails['aadhaarNo'] = $row['AadhaarNo'];
              $studentDetails['fathersName'] = $row['FathersName'];
              $studentDetails['mothersName'] = $row['MothersName'];
              $studentDetails['email'] = $row['Email'];
              $studentDetails['mobile'] = $row['Mobile'];
              $studentDetails['address'] = $row['Address'];
          }

	       	//$pdo = null;
	    }
	    catch(PDOException $e)
	    {
	    	//[TODO] Proper way of error handling.
	        echo 'ERROR: ' . $e->getMessage();
	    }

      //print_r($studentDetails);
	    return $studentDetails;
	    //return $userIdFromDB;
	}
?>
      <p class="profilePageText">
          Welcome to your <b>Profile</b> page.
      </p>
      <div class="profileData profilePic">
        <img src='<?php echo DOCUMENT_ROOT ; ?>/data/pics/<?php echo $UserId;?>.jpg' width=100 height=100/>
      </div>
      <table class="table table-hover table-bordered profileData profileDataLeft">
        <caption>Profile Data</caption>
          <tr>
              <td>Name </td>
              <td>
                <?php echo $userName;?>
              </td>
          </tr>
          <tr>
              <td>Registration Number</td>
              <td>
                <?php echo $regnNo;?>
              </td>
          </tr>
          <tr>
              <td>Date of Birth</td>
              <td>
                <?php echo $dob;?>
              </td>
          </tr>
          <tr>
              <td>Gender</td>
              <td>
                <?php echo $gender;?>
              </td>
          </tr>
          <tr>
              <td>Department</td>
              <td>
                <?php echo $department;?>
              </td>
          </tr>
          <tr>
              <td>Year</td>
              <td>
                <?php echo $year;?>
              </td>
          </tr>
      <!--</table>
      <table class="table table-hover table-bordered profileData profileDataRight">-->
          <tr>
              <td>Aadhaar</td>
              <td>
                <?php echo $aadhaarNo;?>
              </td>
          </tr>
          <tr>
              <td>Father's Name </td>
              <td>
                <?php echo $fathersName;?>
              </td>
          </tr>
          <tr>
              <td>Mother's Name </td>
              <td>
                <?php echo $mothersName;?>
              </td>
          </tr>
          <tr>
              <td>Email </td>
              <td>
                <?php echo $email;?>
              </td>
          </tr>
          <tr>
              <td>Mobile </td>
              <td>
                <?php echo $mobile;?>
              </td>
          </tr>
          <tr>
              <td>Address </td>
              <td>
                <?php echo $address;?>
              </td>
          </tr>
      </table>
<?php
  require_once __DIR__ . '/../inc/footer.php';
?>
