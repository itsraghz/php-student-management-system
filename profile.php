<?php
  require_once 'inc/header.php';
?>
      <p class="profilePageText">
          Welcome to your <b>Profile</b> page.
      </p>
      <table class="profileData profileDataLeft">
          <tr>
              <td>Name </td>
              <td>
                <?php echo isset($_SESSION['user']) ? $_SESSION['user'] : 'Guest';?>
              </td>
          </tr>
          <tr>
              <td>Registration Number </td>
              <td>
                R12345
              </td>
          </tr>
          <tr>
              <td>Date of Birth </td>
              <td>
                01-Jan-2000
              </td>
          </tr>
          <tr>
              <td>Age </td>
              <td>
                22
              </td>
          </tr>
          <tr>
              <td>Course </td>
              <td>
                B.Tech (CSE)
              </td>
          </tr>
      </table>
      <table class="profileData profileDataRight">
          <tr>
              <td>Name </td>
              <td>
                <?php echo isset($_SESSION['user']) ? $_SESSION['user'] : 'Guest';?>
              </td>
          </tr>
          <tr>
              <td>Registration Number </td>
              <td>
                R12345
              </td>
          </tr>
          <tr>
              <td>Date of Birth </td>
              <td>
                01-Jan-2000
              </td>
          </tr>
          <tr>
              <td>Age </td>
              <td>
                22
              </td>
          </tr>
          <tr>
              <td>Course </td>
              <td>B.Tech (CSE)</td>
          </tr>
      </table>
<?php
  require_once 'inc/footer.php';
?>
