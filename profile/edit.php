<?php
require_once __DIR__ . '/../inc/header.php';
require_once __DIR__ . '/../dao/UserDAO.php';
require_once __DIR__ . '/../dao/StudentDAO.php';
require_once __DIR__ . '/../bo/TblUserBO.php';

//echo "User Id in Session : " . $_SESSION['user'] . "<br/>";
$UserId = $_GET['UserId'];

if(empty($UserId)) {
  $errorMsg = "Invalid UserId to update the profile. Please try again with the valid input.";
  $_SESSION['errorMsg']=$errorMsg;
  header('Location: list.php');
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

if(empty($StudentBO)) {
  $errorMsg = "Profile not exists for the User with the Id [$UserId] for editing. Kindly contact Admin.";
  $_SESSION['errorMsg']=$errorMsg;
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
          Welcome to your <b>Edit Profile</b> page.
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
      <form class="form-horizontal" id="addProfileForm" name="addProfileForm"
          action="insert.php" method="post">
          <table class="table table-hover table-bordered profileData profileDataLeft">
          <caption>Profile Data (The fields marked with red color asterisk are mandatory)</caption>
          <tr>
            <td>
              <label for="Name">Name</label> <span class='mandatory'>*</span>
            </td>
            <td>
              <input type="text" class="form-control" id="Name" name="Name"
              required=true size="50" value="<?php echo $StudentBO->getName() .
                  ' | Gender : ' . $StudentBO->getGender() .
                  " | Department : " . $StudentBO->getDepartment();?>"
              tabindex=1 placeholder="Name of the Student">
            </td>
          </tr>
          <tr>
              <td>
                <label for="regnNo">Registration Number</label> <span class='mandatory'>*</span>
              </td>
              <td>
                <input class="form-control" type=text name="RegnNo" id="RegnNo"
                  size="50" maxlength=15 required=true value="<?php echo $StudentBO->getRegnNo();?>"
                  tabindex=2 placeholder="Registration No. of the Student" readonly/>
              </td>
          </tr>
          <tr>
              <td>
                <label for="dob">Date of Birth</label> <span class='mandatory'>*</span>
              </td>
              <td>
                <input class="form-control" type=text name="DOB" id="DOB"
                  value="<?php echo $StudentBO->getDOB();?>"
                  tabindex=3 size="50" required=true placeholder="Date of Birth of the Student"/>
              </td>
          </tr>
          <tr>
              <td>
                <label for="gender">Gender</label> <span class='mandatory'>*</span>
              </td>
              <td>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="Gender" id="genderMale"
                        value="M" tabindex="0" <?php echo strcmp($StudentBO->getGender(), 'M')==0 ? 'checked' : '';?>>
                    <label class="form-check-label" for="genderMale">
                      Male
                    </label>
                    <input class="form-check-input" type="radio" name="Gender" id="genderFemale"
                        value="F" tabindex="-1" <?php echo strcmp($StudentBO->getGender(), 'F')==0 ? 'checked' : '';?>>
                    <label class="form-check-label" for="genderFemale">
                      Female
                    </label>
                  </div>
              </td>
          </tr>
          <tr>
              <td>
                <label for="department">Department</label> <span class='mandatory'>*</span>
              </td>
              <td>
                  <select class="form-select" aria-label="Department"
                      id="department" name="Department" required>
                    <option selected>--SELECT--</option>
                    <option id="1" value="Mech" <?php echo strcmp($StudentBO->getDepartment(), 'Mech')==0 ? 'selected' : '';?>>Mechanical</option>
                    <option id="2" value="Civil" <?php echo strcmp($StudentBO->getDepartment(), 'Civil')==0 ? 'selected' : '';?>>Civil</option>
                    <option id="3" value="EEE" <?php echo strcmp($StudentBO->getDepartment(), 'EEE')==0 ? 'selected' : '';?>>Electrical and Eletronics</option>
                    <option id="4" value="ECE" <?php echo strcmp($StudentBO->getDepartment(), 'ECE')==0 ? 'selected' : '';?>>Eletronics and Communication</option>
                    <option id="5" value="CSE" <?php echo strcmp($StudentBO->getDepartment(), 'CSE')==0 ? 'selected' : '';?>>Computer Science</option>
                  </select>
              </td>
          </tr>
          <tr>
              <td>
                <label for="year">Year</label> <span class='mandatory'>*</span>
              </td>
              <td>
                  <select class="form-select" aria-label="Year of Study"
                      id="year" name="Year" required>
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
                  placeholder="Aadhaar No of the Student" maxlength="12"/>
              </td>
          </tr>
          <tr>
              <td>
                <label for="fathersName">Father's Name</label> <span class='mandatory'>*</span>
              </td>
              <td>
                <input class="form-control" type=text name="FathersName" id="fathersName"
                  size="50" required=true value="<?php echo $StudentBO->getFathersName();?>"
                  placeholder="Father's Name of the Student"/>
              </td>
          </tr>
          <tr>
            <td>
              <label for="mothersName">Mother's Name</label> <span class='mandatory'>*</span>
            </td>
              <td>
                <input class="form-control" type=text name="MothersName" id="mothersName"
                  size="50" required=true value="<?php echo $StudentBO->getMothersName();?>"
                  placeholder="Mother's Name of the Student"/>
              </td>
          </tr>
          <tr>
              <td>
                <label for="email">Email Address</label> <span class='mandatory'>*</span>
              </td>
              <td>
                <input class="form-control" type="email" name="Email" id="email"
                  size="50" required=true value="<?php echo $StudentBO->getEmail();?>"
                  aria-describedby="emailHelp"
                  placeholder="Email Address of the Student"/>
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
          <tr>
              <td></td>
              <td>
                <center>
                  <button type="submit" align="center" class="btn btn-success">Registration</button>&nbsp;&nbsp;&nbsp;
                  <button type="reset" align="center" class="btn btn-danger">Reset</button>
                </center>
              </td>
          </table>
      </form>
<?php
  require_once __DIR__ . '/../inc/footer.php';
?>
