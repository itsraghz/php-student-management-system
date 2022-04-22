<?php
require_once __DIR__ . './../inc/header.php';

  //echo "User Id in Session : " . $_SESSION['user'] . "<br/>";
?>
      <?php
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
      <form class="form-horizontal" id="addProfileForm" name="addProfileForm" method="post" action="insert.php">
          <table class="table table-hover table-bordered profileData profileDataLeft">
          <caption>Profile Data</caption>
          <tr>
            <td>
              <label for="Name">Name</label>
            </td>
            <td>
              <input type="text" class="form-control" id="Name" name="Name"
              required=true size="50" value="Ramba.G"
              placeholder="Name of the Student">
            </td>
          </tr>
          <tr>
              <td>
                <label for="regnNo">Registration Number</label>
              </td>
              <td>
                <input class="form-control" type=text name="RegnNo" id="regnNo"
                  size="50" maxlength=15 required=true value="<?php echo $_SESSION['searchedUser'];?>"
                  placeholder="Registration No. of the Student"/>
              </td>
          </tr>
          <tr>
              <td>
                <label for="dob">Date of Birth</label>
              </td>
              <td>
                <input class="form-control" type=date name="DOB" id="dob" value="2000-10-31"
                  size="50" required=true placeholder="Date of Birth of the Student"/>
              </td>
          </tr>
          <tr>
              <td>
                <label for="gender">Gender</label>
              </td>
              <td>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="Gender" id="genderMale" value="M">
                    <label class="form-check-label" for="genderMale">
                      Male
                    </label>
                    <input class="form-check-input" type="radio" name="Gender" id="genderFemale" value="F">
                    <label class="form-check-label" for="genderFemale">
                      Female
                    </label>
                  </div>
              </td>
          </tr>
          <tr>
              <td>
                <label for="department">Department</label>
              </td>
              <td>
                  <select class="form-select" aria-label="Department"
                      id="department" name="Department">
                    <option selected>--SELECT--</option>
                    <option id="1" value="Mech">Mechanical</option>
                    <option id="2" value="Civil">Civil</option>
                    <option id="3" value="EEE">Electrical and Eletronics</option>
                    <option id="4" value="ECE">Eletronics and Communication</option>
                    <option id="5" value="CSE">Computer Science</option>
                  </select>
              </td>
          </tr>
          <tr>
              <td>
                <label for="year">Year</label>
              </td>
              <td>
                  <select class="form-select" aria-label="Year of Study"
                      id="year" name="Year">
                    <option selected>--SELECT--</option>
                    <option id="1" value="1">First</option>
                    <option id="2" value="2">Second</option>
                    <option id="3" value="3">Third</option>
                    <option id="4" value="4">Fourth</option>
                  </select>
              </td>
          </tr>
          <tr>
              <td>
                <label for="aadhaarNo">Aadhaar</label>
              </td>
              <td>
                <input class="form-control" type="number" name="AadhaarNo" id="aadhaarNo"
                  size="50" required=false value="326095784985"
                  placeholder="Aadhaar No of the Student" maxlength="12"/>
              </td>
          </tr>
          <tr>
              <td>
                <label for="fathersName">Father's Name</label>
              </td>
              <td>
                <input class="form-control" type=text name="FathersName" id="fathersName"
                  size="50" required=true value="Ganesan.S"
                  placeholder="Father's Name of the Student"/>
              </td>
          </tr>
          <tr>
            <td>
              <label for="mothersName">Mother's Name</label>
            </td>
              <td>
                <input class="form-control" type=text name="MothersName" id="mothersName"
                  size="50" required=true value="Chitra.G"
                  placeholder="Mother's Name of the Student"/>
              </td>
          </tr>
          <tr>
              <td>
                <label for="email">Email Address</label>
              </td>
              <td>
                <input class="form-control" type="email" name="Email" id="email"
                  size="50" required=true value="kavikutti57@gmail.com"
                  aria-describedby="emailHelp"
                  placeholder="Email Address of the Student"/>
                  <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
              </td>
          </tr>
          <tr>
              <td>
                <label for="mobile">Mobile No.</label>
              </td>
              <td>
                <input class="form-control" type=number name="Mobile" id="mobile"
                  size="50" required=true value="6382800226"
                  maxlength="10" min="1000000001"
                  placeholder="Mobile No. of the Student"/>
              </td>
          </tr>
          <tr>
              <td>
                <label for="address">Address</label>
              </td>
              <td>
                <textarea class="form-control" name="Address" id="address" rows="3"
                  size="50" required=true value="J.J. Nagar, Devakottai Rastha,  Karaikudi"
                  placeholder="Address of the Student">16/13, Thirunagar, peyanpatti,O.Siruvayal, sivaganga, tamilnadu,630208</textarea>
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
  require_once __DIR__ . './../inc/footer.php';
?>
