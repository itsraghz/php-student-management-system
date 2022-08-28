<?php
  require_once __DIR__ . '/../inc/header.php';

?>
      <p class="profilePageText">
          Welcome to your <b>Fee Details</b> page.
      </p>
      <table class="table table-hover table-bordered profileData profileDataLeft">
        <caption>Fee Details</caption>
          <tr>
              <td>Registration Number</td>
              <td>
                <?php echo $regnNo;?>
              </td>
              <td>Year </td>
              <td>
                <?php echo $year;?>
              </td>
          </tr>
          <tr>
              <td>Name</td>
              <td>
                <?php echo $userName;?>
              </td>
              <td>Department </td>
              <td>
                <?php echo $department;?>
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
        <caption>Audit Columns</caption>
          <tr>
              <td>Created By</td>
              <td>
                <?php echo $regnNo;?>
              </td>
              <td>Created Date</td>
              <td>
                <?php echo $year;?>
              </td>
          </tr>
          <tr>
              <td>Modified By</td>
              <td>
                <?php echo $regnNo;?>
              </td>
              <td>Modified Date</td>
              <td>
                <?php echo $year;?>
              </td>
          </tr>
      </table>
<?php
  require_once __DIR__ . '/../inc/footer.php';
?>
