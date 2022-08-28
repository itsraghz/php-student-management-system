<?php
  require_once __DIR__ . '/../inc/header.php';
  require_once __DIR__ . '/../util/Util.php';

  // Fetch a logger, it will inherit settings from the root logger
  $log = Logger::getLogger('view.php');

  $UserId = isset($_GET['UserId']) ? $_GET['UserId'] : '';
  echo "User Id in REQ : " . $UserId . "<br/>";
  $log->debug("User id in REQ : [" . $UserId . "]");

  if(empty($UserId)) {
    $log->debug("User Id in REQ is EMPTY.. taking from Session.");
    $UserId = isset($_SESSION['UserId']) ? $_SESSION['UserId'] : '';
    //echo "User Id in Session : " . $_SESSION['user'] . "<br/>";
  }

  echo "User in Session : " . $_SESSION['user'] . "<br/>";
  $log->debug("user in Session : [" . $_SESSION['user'] . "]");

  echo "User Id in Session : " . $_SESSION['userId'] . "<br/>";
  $log->debug("user Id in Session : [" . $_SESSION['userId'] . "]");

  $user = isset($_SESSION['user']) ? $_SESSION['user'] : '';
  //echo "User Name in Session : " . $_SESSION['user'] . "<br/>";
  $log->debug("user in Session : [" . $_SESSION['user'] . "]");

  if(empty($UserId)) {
    echo "Invalid User Id to proceed. Please supply a valid User Id. <br/>";
    exit();
  }

  $studentDetails = getDetails($UserId);

  if(empty($studentDetails)) {
    $_SESSION['profileNotFoundMsg']='No matching profile available for the User [<b>' . $user . '</b>]. Kindly contact Admin.';
    header('Location: list.php');
  }

  $user = $studentDetails['userName'];
  $regnNo = $studentDetails['regnNo'];
  $modeId = $studentDetails['modeId'];
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
	    //$sql = "SELECT * from TblStudent where UserId=:userId";

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

              //$user = $row['Name'];
              //$regnNo = $row['RegnNo'];
              $studentDetails['userName'] = $row['Name'];
              $studentDetails['regnNo'] = $row['RegnNo'];
              $studentDetails['modeId'] = $row['ModeId'];
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
      <?php
        if(isset($_SESSION['errorMsg']) && !empty($_SESSION['errorMsg'])) {
          echo "<center><span style='color: red'>" . $_SESSION['errorMsg'] . "</span></center>";
          unset($_SESSION['errorMsg']);
        }
      ?>
      <table class="table table-hover table-bordered profileData profileDataLeft">
        <caption>Profile Data</caption>
          <tr>
              <td>Name </td>
              <td>
                <?php echo $user;?>
              </td>
          </tr>
          <tr>
              <td>Registration Number</td>
              <td>
                <?php echo $regnNo;?>
              </td>
          </tr>
          <tr>
              <td>Admission Mode</td>
              <td>
                <?php echo Util::getAdmissionMode($modeId);?>
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
