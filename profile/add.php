<?php
  require_once __DIR__ . './../inc/header.php';

  //echo "User Id in Session : " . $_SESSION['user'] . "<br/>";
?>
      <p class="profilePageText">
          Add the details for a student profile.
      </p>
      <?php
        if(isset($_SESSION['verifyProfileErrorMsg'])) {
      ?>
        <p class="profilePageText">
            <!--Add the details for a student profile.-->
            <?php
              echo "<span style='color: red;'>" . $_SESSION['verifyProfileErrorMsg'] . "</span>";
            ?>
        </p>
      <?php
          /*if(isset($_SESSION['canCloseProfileCreationMsg'])) {
            unset($_SESSION['canCloseProfileCreationMsg']);
          }*/
          unset($_SESSION['verifyProfileErrorMsg']);
        }
      ?>

      <form class="form-horizontal" name="addProfileForm" method="post" action="verify.php">
          <table class="table table-hover table-bordered profileData profileDataLeft">
          <caption>Verify User</caption>
          <tr>
            <td>
              <label for="UserId">Registration Id</label>
            </td>
            <td>
              <input type="text" class="form-control" id="UserId" name="UserId"
              required=true size="50" value="912518106014"
              placeholder="Registration Id of the Student">
            </td>
          </tr>
          <tr>
              <td></td>
              <td>
                <center>
                  <button type="submit" align="center" class="btn btn-success">Search</button>&nbsp;&nbsp;&nbsp;
                  <button type="reset" align="center" class="btn btn-danger">Reset</button>
                </center>
              </td>
        <table>
      </form>
<?php
  require_once __DIR__ . './../inc/footer.php';
?>
