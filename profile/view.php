<?php
  require_once __DIR__ . '/../inc/header.php';
  require_once __DIR__ . '/../util/Util.php';

  //$canEcho = true;

  function echoMsg($msg) {
    echoMsg2($msg, false);
  }

  function echoMsg2($msg, $canPrint) {
      if($canPrint) {
        echo $msg;
      }
  }

  /*echo "<br/>";
  echo "<b>SESSION Array contents :: </b><br/>";
  echo "<pre>", print_r($_SESSION), "</pre>";
  echo "<br/>";*/

  // Fetch a logger, it will inherit settings from the root logger
  $log = Logger::getLogger('view.php');

  $UserId = isset($_GET['UserId']) ? $_GET['UserId'] : '';
  echoMsg("UserId in REQ : " . $UserId . "<br/>");
  $log->debug("User id in REQ : [" . $UserId . "]");

  $UserIdSessionConsidered = false;

  if(empty($UserId)) {
    echoMsg("UserId in REQ is EMPTY. Taking from Session. <br/>");
    $log->debug("UserId in REQ is EMPTY. Taking from Session.");
    $UserId = isset($_SESSION['UserId']) ? $_SESSION['UserId'] : '';
    $UserIdSessionConsidered=true;
    //echoMsg("User Id in Session : " . $_SESSION['user'] . "<br/>";
    $log->debug("UserId in Session : [" . $UserId . "]");
  }

  $user = isset($_SESSION['user']) ? $_SESSION['user'] : '';
  echoMsg("User in Session : " . $_SESSION['user'] . "<br/>");
  $log->debug("user in Session : [" . $_SESSION['user'] . "]");

  echoMsg("UserId in Session : " . $_SESSION['UserId'] . "<br/>");
  $log->debug("UserId in Session : [" . $_SESSION['UserId'] . "]");

  $isUserAStaff = Util::isUserAStaff();
  echoMsg("isUserAStaff ? " . $isUserAStaff . "<br/>");
  $log->debug("isUserAStaff ? : " . $isUserAStaff );

  $isUserNotAStudent = Util::isUserNotAStudent();
  $log->debug("isUserNotAStudent  : [" . $isUserNotAStudent . "]");

  if(empty($UserId)) {
    echoMsg("Invalid UserId to proceed. Please supply a valid UserId. <br/>");
    exit();
  }

  $studentDetails = getDetails($UserId);

  $log->debug("studentDetails : " . print_r($studentDetails, 1));

  if(empty($studentDetails))
  {
    $userToSpecify = $user;
    if($isUserNotAStudent) {
      $userToSpecify = !empty($UserId) ? $UserId : $user;
    }
    if(isset($_SESSION['regnNoUsed']) && !empty($_SESSION['regnNoUsed'])) {
      $userToSpecify = $user;
      unset($_SESSION['regnNoUsed']);
    }
    $_SESSION['profileNotFoundMsg']='No matching profile available for the User [<b>' . $userToSpecify . '</b>]. Kindly contact Admin.';
    header('Location: list.php');
  }

  $user = $studentDetails['userName'];
  $regnNo = $studentDetails['regnNo'];
  $modeId = $studentDetails['modeId'];
  $dob = $studentDetails['dob'];
  $gender = $studentDetails['gender'];
  $deptId = $studentDetails['deptId'];
  $year = $studentDetails['year'];
  $aadhaarNo = $studentDetails['aadhaarNo'];
  $fathersName = $studentDetails['fathersName'];
  $mothersName = $studentDetails['mothersName'];
  $religionId = $studentDetails['religionId'];
  $communityId = $studentDetails['communityId'];
  $email = $studentDetails['email'];
  $mobile = $studentDetails['mobile'];
  $address = $studentDetails['address'];
  $isActive = $studentDetails['isActive'];

  $createdDate = $studentDetails['createdDate'];
  $createdBy = $studentDetails['createdBy'];
  $modifiedDate = $studentDetails['modifiedDate'];
  $modifiedBy = $studentDetails['modifiedBy'];

  function getDetails($UserId)
	{
      // Fetch a logger, it will inherit settings from the root logger
      $log = Logger::getLogger('view.php-getDetails()');

      $log->debug("getDetails() - ENTER");
      $log->debug("UserId Param : [" . $UserId . "]");
      echoMsg("getDetails() - UserId Param : [" . $UserId . "]");

	    global $pdo;

      $studentDetails = array();

	    $isValid = false;
	    $userIdFromDB = '';

		//Not required because we use PreparedStatement bind() method. However sanitize() uses other cleaning as well.
	   // $userId = $this->sanitize($userId);
	   // $password = $this->sanitize($password);

	    //$sql = "SELECT * from TblStudent where RegnNo=:userId";
      $isUserAStaff = Util::isUserAStaff();
      $log->debug("isUserAStaff  : [" . $isUserAStaff . "]");

      $isUserNotAStudent = Util::isUserNotAStudent();
      $log->debug("isUserNotAStudent  : [" . $isUserNotAStudent . "]");

      if($isUserNotAStudent) {
        //$sql = "SELECT * from TblStudent where UserId=:userId";
        $sql = "SELECT * from TblStudent where RegnNo=:userId";
        $_SESSION['regnNoUsed'] = true;
      } else {
        $sql = "SELECT * from TblStudent where RegnNo=:userId";
        unset($_SESSION['regnNoUsed']);
      }

        $log->debug("SQL Query : [" . $sql . "]");

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
              $log->debug("Row exists : [" . $row['Name'] . "]");

              //$user = $row['Name'];
              //$regnNo = $row['RegnNo'];
              $studentDetails['userName'] = $row['Name'];
              $studentDetails['regnNo'] = $row['RegnNo'];
              $studentDetails['modeId'] = $row['ModeId'];
              $studentDetails['dob'] = $row['DOB'];
              $studentDetails['gender'] = $row['Gender'];
              $studentDetails['deptId'] = $row['DeptId'];
              $studentDetails['year'] = $row['Year'];
              $studentDetails['aadhaarNo'] = $row['AadhaarNo'];
              $studentDetails['fathersName'] = $row['FathersName'];
              $studentDetails['mothersName'] = $row['MothersName'];
              $studentDetails['email'] = $row['Email'];
              $studentDetails['mobile'] = $row['Mobile'];
              $studentDetails['address'] = $row['Address'];
              $studentDetails['religionId'] = $row['ReligionId'];
              $studentDetails['communityId'] = $row['CommunityId'];
              $studentDetails['isActive'] = $row['IS_ACTIVE'];

              $studentDetails['createdBy'] = $row['CREATED_DATE'];
              $studentDetails['createdDate'] = $row['CREATED_BY'];
              $studentDetails['modifiedDate'] = $row['MODIFIED_DATE'];
              $studentDetails['modifiedBy'] = $row['MODIFIED_BY'];
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
          <?php
            if($isUserNotAStudent || $isUserAStaff) {
          ?>
                <span style="background-color: yellow;">
                  You are viewing the profile of a Student with the Registration Number : <b><u><?php echo $regnNo;?></u></b>
                </span>
          <?php
            } else {
          ?>
                Welcome to your <b>Profile</b> page.
          <?php
            }
          ?>
      </p>
      <div>
        <?php
          if(isset($_SESSION['successMsg']) && !empty($_SESSION['successMsg'])) {
            echo "<center><span style='border:1px solid gray; background-color: #aafedf; color: black;'>
                <b>Message from Server : </b> " . $_SESSION['successMsg'] . "</span></center>";
            unset($_SESSION['successMsg']);
          }
        ?>
        <?php
          if(isset($_SESSION['errorMsg']) && !empty($_SESSION['errorMsg'])) {
            echo "<center><span style='color: red'>" . $_SESSION['errorMsg'] . "</span></center>";
            unset($_SESSION['errorMsg']);
          }
        ?>
      </div>
      <div class="profileData profilePic">
        <img src='<?php echo DOCUMENT_ROOT ; ?>/data/pics/<?php echo $regnNo;?>.jpg' width=100 height=100/>
      </div>
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
                <?php echo Util::getDepartment($deptId);?>
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
              <td>Religion</td>
              <td>
                <?php echo Util::getReligion($religionId);?>
              </td>
          </tr>
          <tr>
              <td>Community</td>
              <td>
                <?php echo Util::getCommunity($communityId);?>
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
          <?php
            if($isUserAStaff || $isUserNotAStudent)
            {
          ?>
              <tr>
                  <td>Active </td>
                  <td>
                    <?php echo $isActive;?>
                  </td>
              </tr>
          <?php
            }
          ?>
      </table>
      <table class="table table-hover table-bordered profileData profileDataLeft">
      <caption>Audit Columns</caption>
        <tr>
            <td>Created By</td>
            <td>
              <?php echo $createdBy;?>
            </td>
            <td>Created Date</td>
            <td>
              <?php echo $createdDate;?>
            </td>
        </tr>
        <tr>
            <td>Modified By</td>
            <td>
              <?php echo $modifiedBy;?>
            </td>
            <td>Modified Date</td>
            <td>
              <?php echo $modifiedDate;?>
            </td>
        </tr>
      </table>
<?php
  require_once __DIR__ . '/../inc/footer.php';
?>
