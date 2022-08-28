<?php
require_once __DIR__ . '/../inc/header.php';

  //echo "User Id in Session : " . $_SESSION['user'] . "<br/>";
?>
      <?php
        $IS_ENV_DEV = strcmp(ENV, "DEV")==0;

        if(isset($_SESSION['verifyProfileMsg'])) {
      ?>
        <p class="profilePageText">
            <!--Add the details for a student profile.-->
            <?php
              echo "<span style='background-color: teal; color: white;'>" . $_SESSION['verifyProfileMsg'] . "</span>";
            ?>
        </p>
      <?php
          /*if(isset($_SESSION['canCloseProfileCreationMsg'])) {
            unset($_SESSION['canCloseProfileCreationMsg']);
          }*/
        }
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
              required=true size="50" value="<?php if($IS_ENV_DEV) echo 'Ramba. G';?>" tabindex=1
              placeholder="Name of the Student">
            </td>
          </tr>
          <tr>
              <td>
                <label for="modeId">Admission Mode</label> <span class='mandatory'>*</span>
              </td>
              <td>
                  <select class="form-select" aria-label="ModeId"
                      id="modeId" name="ModeId" required>
                    <option selected>--SELECT--</option>
                    <option id="1" value="1" <?php if($IS_ENV_DEV) echo 'selected';?>>Counselling</option>
                    <option id="2" value="2">Management</option>
                  </select>
              </td>
          </tr>
          <tr>
              <td>
                <label for="regnNo">Registration Number</label> <span class='mandatory'>*</span>
              </td>
              <td>
                <input class="form-control" type=text name="RegnNo" id="RegnNo"
                  size="50" maxlength=15 required=true value="<?php echo $_SESSION['searchedUser'];?>"
                  tabindex=2 placeholder="Registration No. of the Student"/>
              </td>
          </tr>
          <tr>
              <td>
                <label for="dob">Date of Birth</label> <span class='mandatory'>*</span>
              </td>
              <td>
                <input class="form-control" type=date name="DOB" id="DOB"
                  value="<?php if($IS_ENV_DEV) echo '2000-10-31';?>"
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
                        value="M" tabindex="0">
                    <label class="form-check-label" for="genderMale">
                      Male
                    </label>
                    <input class="form-check-input" type="radio" name="Gender" id="genderFemale"
                        value="F" tabindex="-1" <?php if($IS_ENV_DEV) echo 'checked';?>>
                    <label class="form-check-label" for="genderFemale">
                      Female
                    </label>
                  </div>
              </td>
          </tr>
          <tr>
              <td>
                <label for="deptId">Department</label> <span class='mandatory'>*</span>
              </td>
              <td>
                  <select class="form-select" aria-label="Department"
                      id="deptId" name="DeptId" required>
                    <option selected>--SELECT--</option>
                    <option id="1" value="1" <?php if($IS_ENV_DEV) echo 'selected';?>>Eletronics and Communication</option>
                    <option id="2" value="2">Electrical and Eletronics</option>
                    <option id="3" value="3">Computer Science</option>
                    <option id="4" value="4">Mechanical</option>
                    <option id="5" value="5">Civil</option>
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
                    <option id="1" value="1">First</option>
                    <option id="2" value="2">Second</option>
                    <option id="3" value="3">Third</option>
                    <option id="4" value="4" <?php if($IS_ENV_DEV) echo 'selected';?>>Fourth</option>
                  </select>
              </td>
          </tr>
          <tr>
              <td>
                <label for="aadhaarNo">Aadhaar</label>
              </td>
              <td>
                <input class="form-control" type="number" name="AadhaarNo" id="aadhaarNo"
                  size="50" required=false value="<?php if($IS_ENV_DEV) echo '326095784985';?>"
                  placeholder="Aadhaar No of the Student" maxlength="12"/>
              </td>
          </tr>
          <tr>
              <td>
                <label for="fathersName">Father's Name</label> <span class='mandatory'>*</span>
              </td>
              <td>
                <input class="form-control" type=text name="FathersName" id="fathersName"
                  size="50" required=true value="<?php if($IS_ENV_DEV) echo 'Ganesan.S';?>"
                  placeholder="Father's Name of the Student"/>
              </td>
          </tr>
          <tr>
            <td>
              <label for="mothersName">Mother's Name</label> <span class='mandatory'>*</span>
            </td>
              <td>
                <input class="form-control" type=text name="MothersName" id="mothersName"
                  size="50" required=true value="<?php if($IS_ENV_DEV) echo 'Chitra.G';?>"
                  placeholder="Mother's Name of the Student"/>
              </td>
          </tr>
          <tr>
              <td>
                <label for="religionId">Religion</label> <span class='mandatory'>*</span>
              </td>
              <td>
                  <select class="form-select" aria-label="Religion"
                      id="religionId" name="ReligionId" required>
                    <option selected>--SELECT--</option>
                    <option id="1" value="1" <?php if($IS_ENV_DEV) echo 'selected';?>>Hindu</option>
                    <option id="2" value="2">Islam</option>
                    <option id="3" value="3">Christian</option>
                    <option id="4" value="4">Jain</option>
                    <option id="5" value="5">Sikh</option>
                  </select>
              </td>
          </tr>
          <tr>
              <td>
                <label for="communityId">Community</label> <span class='mandatory'>*</span>
              </td>
              <td>
                  <select class="form-select" aria-label="Community"
                      id="communityId" name="CommunityId" required>
                    <option selected>--SELECT--</option>
                    <option id="0" value="0">No Community</option>
                    <option id="1" value="1" <?php if($IS_ENV_DEV) echo 'selected';?>>Chettiyar</option>
                    <option id="2" value="2">Mudaliyar</option>
                    <option id="3" value="3">Nadar</option>
                    <option id="4" value="4">Thevar</option>
                    <option id="5" value="5">Vallambar</option>
                    <option id="6" value="6">Ambalam</option>
                  </select>
              </td>
          </tr>
          <tr>
              <td>
                <label for="email">Email Address</label> <span class='mandatory'>*</span>
              </td>
              <td>
                <input class="form-control" type="email" name="Email" id="email"
                  size="50" required=true value="<?php if($IS_ENV_DEV) echo 'kavikutti57@gmail.com';?>"
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
                  size="50" required=true value="<?php if($IS_ENV_DEV) echo '6382800226';?>"
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
                  placeholder="Address of the Student"><?php if($IS_ENV_DEV) echo '16/13, Thirunagar, Peyanpatti, O.Siruvayal, Sivaganga, Tamilnadu,630208';?>
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
