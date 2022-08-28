<?php
require_once __DIR__ . '/../inc/header.php';
require_once __DIR__ . '/../dao/UserDAO.php';
require_once __DIR__ . '/../dao/StudentDAO.php';
require_once __DIR__ . '/../bo/TblUserBO.php';

//$canEcho = true;

function echoMsg($msg) {
  echoMsg2($msg, false);
}

function echoMsg2($msg, $canPrint) {
    if($canPrint) {
      echo $msg;
    }
}

// Fetch a logger, it will inherit settings from the root logger
$log = Logger::getLogger('edit.php');

//echo "User Id in Session : " . $_SESSION['user'] . "<br/>";
$log->info("User Id in Session : " . $_SESSION['user']);

$UserId = isset($_GET['UserId']) ? $_GET['UserId'] : "";

//echo "User Id in Request GET : " . $UserId . "<br/>";
$log->info("User Id in Request GET : " . $UserId);

$IsUserAStaff = Util::isUserAStaff()? true : false;
//echo "IsUserAStaff? : " . $IsUserAStaff . "<br/><br/>";
$log->info("IsUserAStaff? : $IsUserAStaff");

$isUserNotAStudent = Util::isUserNotAStudent() ? true : false;
//echo "isUserNotAStudent? : " . $isUserNotAStudent . "<br/><br/>";
$log->info("isUserNotAStudent? : $isUserNotAStudent");

/**  [07Aug2022] A condition added for the time being to stop a Staff NOT to edit the profile,
  *  as the profile is created in the System ONLY for the students.
  */
/*if($isUserNotAStudent) {
  $log->info("The logged in User is Not a Student ....");
  $errorMsg = "Currently, the profiles are available ONLY for the Students. You [<b>" . $_SESSION['user'] . "]</b> are <u>NOT</u> a Student. Kindly contact Admin.";
  $_SESSION['errorMsg']=$errorMsg;
  header('Location: list.php');
}*/

if(empty($UserId))
{
  $log->info("User Id is EMPTY...");
  /* Good to go, as the logged in User is a Student. */
  $UserId = $_SESSION['UserId'];
  $log->info("User Id considered from Session : [$UserId]");
}

if(empty($UserId)) {
  $log->info("User Id is EMPTY (even after taking it from Session)...");
  $errorMsg = "Invalid UserId to update the profile. Please try again with the valid input.";
  $_SESSION['errorMsg']=$errorMsg;

  if($IsUserAStaff) {
    header('Location: list.php');
  } else {
    header('Location: view.php');
  }
}

/*$UserDAO = new UserDAO;
$UserBO = $UserDAO->getUserByUserName($UserId);

if(empty($UserBO)) {
  $errorMsg = "Profile not exists for the User with the Id [$UserId] for editing. Kindly contact Admin.";
  $_SESSION['errorMsg']=$errorMsg;
  header('Location: list.php');
}*/

$StudentDAO = new StudentDAO;
$StudentBO = $StudentDAO->getStudentByUserId($UserId);

//echo "<pre>" , print_r($StudentBO) , "</pre> <br/>";
$log->info("StudentBO :: " . print_r($StudentBO, 1));

/*
 * Preserving the StudentBO in Session to introspect later while updating
 * especially on the IS_ACTIVE flag, because if the update takes place to
 * activate an invlaid user, we need to enable the TblUser account as well,
 * apart from the primary TblSudent table. This object in session will help
 * us compare the previous value of the IS_ACTIVE before the update happened!
 */
$_SESSION['IsActiveB4Edit']=$StudentBO->getIsActive();


if(empty($StudentBO) || empty($StudentBO->getUserId())) {
  $errorMsg = "Profile not exists for the User with the Id [$UserId] for editing. Kindly contact Admin.";
  $_SESSION['profileNotFoundMsg']=$errorMsg;
  header('Location: list.php');
}

// For the photograph to be modified if at all.
$_SESSION['searchedUser'] = $StudentBO->getRegnNo();

?>
      <?php
        if(isset($_SESSION['fileUploadMsg'])) {
      ?>
          <p class="profilePageText">
              <?php
                echo "<span style='background-color:green; color: white;'>" . $_SESSION['fileUploadMsg'] . "</span>";
              ?>
          </p>
      <?php
        if(isset($_SESSION['canCloseProfileCreationMsg'])) {
          unset($_SESSION['fileUploadMsg']);
        }
      }
      ?>
      <p class="profilePageText">
          <?php
            $roleBasedDisabled = 'disabled';
            $roleBasedReadOnly = 'readonly';

            $mandatoryReadOnly = 'readonly';

            $NonStudent = ($isUserNotAStudent || $isUserAStaff);

            if($NonStudent) {
              $roleBasedDisabled = '';
              $roleBasedReadOnly = '';
          ?>
                <span style="background-color: yellow;">
                  You are editing the profile of a Student with the Registration Number : <b><u><?php echo $_SESSION['searchedUser'];?></u></b>
                </span>
          <?php
            } else {
          ?>
                Welcome to your <b>Edit Profile</b> page.
          <?php
            }
          ?>
      </p>
      <div class="profileData profilePic">
        <img src='<?php echo DOCUMENT_ROOT ; ?>/data/pics/<?php echo $StudentBO->getRegnNo();?>.jpg' width=100 height=100/>
      </div>
      <table class="table table-hover table-bordered profileData profileDataLeft">
        <caption>Photograph</caption>
        <tr>
            <td>
              <label for="formFile" class="form-label">Upload the Photo</label>
            </td>
            <td>
                <div class="mb-3">
                  <!--<input class="form-control" type="file" id="photo" name="photo">-->
                  <form method='post' action='upload.php' enctype='multipart/form-data'>
                  Select File: <input type='file' id="photo" name="photo" size='10'/>
                  <input type='Submit' name='Upload' value='Upload'/>
                  <input type='Submit' name='Clear' value='Clear'/>
                  <?php
                    if(isset($_SESSION['TargetFileNameWithExt'])){
                      echo "<b>Uploaded File : </b> " . $_SESSION['uploadedFile'];
                      echo "| <b>Mapped to : </b> " .  $_SESSION['TargetFileNameWithExt'];
                      if(isset($_SESSION['canCloseProfileCreationMsg'])) {
                        unset($_SESSION['TargetFileNameWithExt']);
                        unset($_SESSION['uploadedFile']);
                        //unset($_SESSION['canCloseProfileCreationMsg']);
                      }
                    }
                  ?>
                  </form>
                </div>
            </td>
        </tr>
      </table>
      <!-- https://stackoverflow.com/a/9413809/1001242 -->
      <!-- Disabled inputs were not actually submitted to the backend, whereas the readonly ones are. -->
      <!-- Checkbox, and Select/Dropdowns don't work with readonly, and they must be used with disabled. -->
      <!-- Used the fix as suggested in the SO link to enable them just before they are passed on to the Server -->
      <!-- with the help of a JavaScript method bound to the 'onSubmit' of the form element -->
      <form class="form-horizontal" id="addProfileForm" name="addProfileForm"
          action="update.php" method="post" onSubmit="enablePath();">
          <table class="table table-hover table-bordered profileData profileDataLeft">
          <caption>Profile Data (The fields marked with red color asterisk are mandatory)</caption>
          <tr>
            <td>
              <label for="UserId">User Id</label> <span class='mandatory'>*</span>
            </td>
            <td>
              <input type="text" class="form-control" id="UserId" name="UserId"
              required=true size="50" value="<?php echo $StudentBO->getUserId();?>"
              tabindex=1 placeholder="UserId of the Student" <?php echo $mandatoryReadOnly; ?> />
            </td>
          </tr>
          <tr>
            <td>
              <label for="Name">Name</label> <span class='mandatory'>*</span>
            </td>
            <td>
              <input type="text" class="form-control" id="Name" name="Name"
                data-toggle="tooltip" data-placement="right" data-html="true"
                title="<?php echo 'Name : ' . $StudentBO->getName() .
                  ' | Gender : ' . $StudentBO->getGender() .
                  " | Dept : " . Util::getDepartment($StudentBO->getDeptId());?>"
                required=true size="50" value="<?php echo $StudentBO->getName();?>"
                tabindex=2 placeholder="Name of the Student" <?php echo $roleBasedReadOnly; ?>
                aria-describedby="nameHelp" />
                <small id="nameHelp" class="form-text text-muted">Hover the mouse to see the other attributes for a quick info</small>
              <!-- We want the actual / updated name alone to be sent back to the Server when submitted -->
              <input type="hidden" class="form-control" id="Name" name="Name"
                required=true size="50" value="<?php echo $StudentBO->getName();?>"
                  tabindex=2 placeholder="Name of the Student" <?php echo $roleBasedReadOnly; ?> />
              <!--<button type="button" class="btn btn-secondary" data-toggle="tooltip" data-placement="top"
              title="<?php //echo 'Name : ' . $StudentBO->getName() .
                //' | Gender : ' . $StudentBO->getGender() .
                //" | Dept : " . Util::getDepartment($StudentBO->getDeptId());?>">
                Relevant Attributes on top
              </button>-->
            </td>
          </tr>
          <tr>
              <td>
                <label for="RegnNo">Registration Number</label> <span class='mandatory'>*</span>
              </td>
              <td>
                <input class="form-control" type=text name="RegnNo" id="RegnNo"
                  size="50" maxlength=15 required=true value="<?php echo $StudentBO->getRegnNo();?>"
                  tabindex=3 placeholder="Registration No. of the Student" <?php echo $mandatoryReadOnly; ?> />
              </td>
          </tr>
          <tr>
              <td>
                <label for="ModeId">Admission Mode</label> <span class='mandatory'>*</span>
              </td>
              <td>
                <!--<input class="form-control" type=text name="ModeId" id="ModeId"
                  size="50" maxlength=15 required=true value="<?php //echo $StudentBO->getModeId();?>"
                  tabindex=2 placeholder="Admission Mode of the Student" readonly/>-->
                <!--<select class="form-select" aria-label="ModeId" id="modeId" name="ModeId" disabled>
                  <option selected>--SELECT--</option>
                  <option id="1" value="1" <?php //echo strcmp($StudentBO->getModeId(), '1')==0 ? 'selected' : '';?>>Counselling</option>
                  <option id="2" value="2" <?php //echo strcmp($StudentBO->getModeId(), '2')==0 ? 'selected' : '';?>>Management</option>
                </select>-->
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="ModeId" id="modeC" <?php echo $roleBasedDisabled; ?>
                        value="1" tabindex="0" <?php echo strcmp($StudentBO->getModeId(), '1')==0 ? 'checked' : '';?>>
                    <label class="form-check-label" for="modeC">
                      Counselling
                    </label>
                    <input class="form-check-input" type="radio" name="ModeId" id="modeM" <?php echo $roleBasedDisabled; ?>
                        value="2" tabindex="-1" <?php echo strcmp($StudentBO->getModeId(), '2')==0 ? 'checked' : '';?>>
                    <label class="form-check-label" for="modeM">
                      Management
                    </label>
                  </div>
              </td>
          </tr>
          <tr>
              <td>
                <label for="dob">Date of Birth</label> <span class='mandatory'>*</span>
              </td>
              <td>
                <input class="form-control" type=text name="DOB" id="DOB"
                  value="<?php echo $StudentBO->getDOB();?>" <?php echo $roleBasedReadOnly; ?>
                  tabindex=4 size="50" required=true placeholder="Date of Birth of the Student"/>
              </td>
          </tr>
          <tr>
              <td>
                <label for="gender">Gender</label> <span class='mandatory'>*</span>
              </td>
              <td>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="Gender" id="genderMale" <?php echo $roleBasedDisabled; ?>
                        value="M" tabindex="0" <?php echo strcmp($StudentBO->getGender(), 'M')==0 ? 'checked' : '';?>>
                    <label class="form-check-label" for="genderMale">
                      Male
                    </label>
                    <input class="form-check-input" type="radio" name="Gender" id="genderFemale" <?php echo $roleBasedDisabled; ?>
                        value="F" tabindex="-1" <?php echo strcmp($StudentBO->getGender(), 'F')==0 ? 'checked' : '';?>>
                    <label class="form-check-label" for="genderFemale">
                      Female
                    </label>
                  </div>
              </td>
          </tr>
          <tr>
              <td>
                <label for="deptId">DeptId</label> <span class='mandatory'>*</span>
              </td>
              <td>
                  <select class="form-select" aria-label="DeptId"
                      id="deptId" name="DeptId" <?php echo $roleBasedDisabled; ?>>
                    <option selected>--SELECT--</option>
                    <option id="1" value="1" <?php echo strcmp($StudentBO->getDeptId(), '1')==0 ? 'selected' : '';?>>Eletronics and Communication</option>
                    <option id="2" value="2" <?php echo strcmp($StudentBO->getDeptId(), '2')==0 ? 'selected' : '';?>>Electrical and Eletronics</option>
                    <option id="3" value="3" <?php echo strcmp($StudentBO->getDeptId(), '3')==0 ? 'selected' : '';?>>Computer Science</option>
                    <option id="4" value="4" <?php echo strcmp($StudentBO->getDeptId(), '4')==0 ? 'selected' : '';?>>Mechanical</option>
                    <option id="5" value="5" <?php echo strcmp($StudentBO->getDeptId(), '5')==0 ? 'selected' : '';?>>Civil</option>
                  </select>
              </td>
          </tr>
          <tr>
              <td>
                <label for="year">Year</label> <span class='mandatory'>*</span>
              </td>
              <td>
                  <select class="form-select" aria-label="Year of Study"
                      id="year" name="Year" <?php echo $roleBasedDisabled; ?>>
                    <option selected>--SELECT--</option>
                    <option id="1" value="1" <?php echo strcmp($StudentBO->getYear(), '1')==0 ? 'selected' : '';?>>First</option>
                    <option id="2" value="2" <?php echo strcmp($StudentBO->getYear(), '2')==0 ? 'selected' : '';?>>Second</option>
                    <option id="3" value="3" <?php echo strcmp($StudentBO->getYear(), '3')==0 ? 'selected' : '';?>>Third</option>
                    <option id="4" value="4" <?php echo strcmp($StudentBO->getYear(), '4')==0 ? 'selected' : '';?>>Fourth</option>
                  </select>
              </td>
          </tr>
          <tr>
              <td>
                <label for="aadhaarNo">Aadhaar</label>
              </td>
              <td>
                <input class="form-control" type="number" name="AadhaarNo" id="aadhaarNo"
                  size="50" required=false value="<?php echo $StudentBO->getAadhaarNo();?>"
                  placeholder="Aadhaar No of the Student" maxlength="12" <?php echo $roleBasedReadOnly; ?>/>
              </td>
          </tr>
          <tr>
              <td>
                <label for="fathersName">Father's Name</label> <span class='mandatory'>*</span>
              </td>
              <td>
                <input class="form-control" type=text name="FathersName" id="fathersName"
                  size="50" required=true value="<?php echo $StudentBO->getFathersName();?>"
                  placeholder="Father's Name of the Student" <?php echo $roleBasedReadOnly; ?>/>
              </td>
          </tr>
          <tr>
            <td>
              <label for="mothersName">Mother's Name</label> <span class='mandatory'>*</span>
            </td>
              <td>
                <input class="form-control" type=text name="MothersName" id="mothersName"
                  size="50" required=true value="<?php echo $StudentBO->getMothersName();?>"
                  placeholder="Mother's Name of the Student" <?php echo $roleBasedReadOnly; ?>/>
              </td>
          </tr>
          <tr>
              <td>
                <label for="religionId">Religion</label> <span class='mandatory'>*</span>
              </td>
              <td>
                  <select class="form-select" aria-label="Religion"
                      id="religionId" name="ReligionId" <?php echo $roleBasedDisabled; ?>>
                    <option selected>--SELECT--</option>
                    <option id="1" value="1" <?php echo strcmp($StudentBO->getReligionId(), '1')==0 ? 'selected' : '';?>>Hindu</option>
                    <option id="2" value="2" <?php echo strcmp($StudentBO->getReligionId(), '2')==0 ? 'selected' : '';?>>Islam</option>
                    <option id="3" value="3" <?php echo strcmp($StudentBO->getReligionId(), '3')==0 ? 'selected' : '';?>>Christian</option>
                    <option id="4" value="4" <?php echo strcmp($StudentBO->getReligionId(), '4')==0 ? 'selected' : '';?>>Jain</option>
                    <option id="5" value="5" <?php echo strcmp($StudentBO->getReligionId(), '5')==0 ? 'selected' : '';?>>Sikh</option>
                  </select>
              </td>
          </tr>
          <tr>
              <td>
                <label for="communityId">Community</label> <span class='mandatory'>*</span>
              </td>
              <td>
                  <select class="form-select" aria-label="CommunityId"
                      id="communityId" name="CommunityId" <?php echo $roleBasedDisabled; ?>>
                    <option selected>--SELECT--</option>
                    <option id="0" value="0" <?php echo empty($StudentBO->getCommunityId()) ? 'selected' : '';?>>No Community</option>
                    <option id="1" value="1" <?php echo strcmp($StudentBO->getCommunityId(), '1')==0 ? 'selected' : '';?>>Chettiyar</option>
                    <option id="2" value="2" <?php echo strcmp($StudentBO->getCommunityId(), '2')==0 ? 'selected' : '';?>>Mudaliyar</option>
                    <option id="3" value="3" <?php echo strcmp($StudentBO->getCommunityId(), '3')==0 ? 'selected' : '';?>>Nadar</option>
                    <option id="4" value="4" <?php echo strcmp($StudentBO->getCommunityId(), '4')==0 ? 'selected' : '';?>>Thevar</option>
                    <option id="5" value="5" <?php echo strcmp($StudentBO->getCommunityId(), '5')==0 ? 'selected' : '';?>>Vallambar</option>
                    <option id="6" value="6" <?php echo strcmp($StudentBO->getCommunityId(), '6')==0 ? 'selected' : '';?>>Ambalam</option>
                  </select>
              </td>
          </tr>
          <tr>
              <td>
                <label for="email">Email Address</label> <span class='mandatory'>*</span>
              </td>
              <td>
                <input class="form-control" type="email" name="Email" id="email"
                  size="50" required=true value="<?php echo $StudentBO->getEmail();?>"
                  aria-describedby="emailHelp" placeholder="Email Address of the Student"/>
                  <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
              </td>
          </tr>
          <tr>
              <td>
                <label for="mobile">Mobile No.</label> <span class='mandatory'>*</span>
              </td>
              <td>
                <input class="form-control" type=number name="Mobile" id="mobile"
                  size="50" required=true value="<?php echo $StudentBO->getMobile();?>"
                  maxlength="10" min="1000000001"
                  placeholder="Mobile No. of the Student"/>
              </td>
          </tr>
          <tr>
              <td>
                <label for="address">Address</label> <span class='mandatory'>*</span>
              </td>
              <td>
                <textarea class="form-control" name="Address" id="address" rows="3" size="50" required=true value=""
                  placeholder="Address of the Student"><?php echo $StudentBO->getAddress();?>
                </textarea>
              </td>
          </tr>
          <?php
            if($NonStudent)
            {
          ?>
              <tr>
                  <td>
                    <label for="isActive">Active</label> <span class='mandatory'>*</span>
                  </td>
                  <td>
                    <div class="form-check">
                        <!--<?php echo "IsActive ? " . $StudentBO->getIsActive(); ?>-->
                        <input class="form-check-input" type="radio" name="IsActive" id="isActiveY" <?php echo $roleBasedDisabled; ?>
                            value="Y" tabindex="0" <?php echo strcmp($StudentBO->getIsActive(), 'Y')==0 ? 'checked' : '';?>>
                        <label class="form-check-label" for="isActiveY">
                          Yes
                        </label>
                        <input class="form-check-input" type="radio" name="IsActive" id="isActiveN" <?php echo $roleBasedDisabled; ?>
                            value="N" tabindex="1" <?php echo strcmp($StudentBO->getIsActive(), 'N')==0 ? 'checked' : '';?>>
                        <label class="form-check-label" for="isActiveN">
                          No
                        </label>
                      </div>
                  </td>
              </tr>
          <?php
            }
          ?>
          <tr>
              <td></td>
              <td>
                <center>
                  <button type="submit" align="center" class="btn btn-success">Update</button>&nbsp;&nbsp;&nbsp;
                  <button type="reset" align="center" class="btn btn-danger">Reset</button>
                </center>
              </td>
          </table>
      </form>
<?php
  require_once __DIR__ . '/../inc/footer.php';
?>
