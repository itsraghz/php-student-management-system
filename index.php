<?php
  require_once 'inc/header.php';

  //check if the user has been already logged into the System

  if(isset($_SESSION['user']) && !empty($_SESSION['user'])) {
    header('Location: home.php');
  }
?>
      <div class="welcomeTxt">
        Welcome to the <b>Home Page</b> of the Student Management System (<b>SMS</b>).
      </p>
      <div class="vl"></div>
      <div class="login">
        <?php
          if(isset($_SESSION['errMsg']) && !empty($_SESSION['errMsg'])) {
        ?>
              <span class="errMsg"><?php echo $_SESSION['errMsg'];?></span>
        <?php
              unset($_SESSION['errMsg']);
          } else {
            if(isset($_SESSION['message']) && !empty($_SESSION['message'])) {
          ?>
                <span class="message"><?php echo $_SESSION['message'];?></span>
          <?php
                unset($_SESSION['message']);
            }
          }
        ?>
        <form class="loginForm" name="loginForm" action="login.php" method="post">
          <h3 class="login">Login</h3>
          <table>
            <tr>
                <td>UserName &nbsp;&nbsp;&nbsp;</td>
                <td>
                  <input type="text" name="userName" id="userName"
                  value="912517114301" placeholder="User Name"
                  required=true size=20/>
                </td>
            </tr>
            <tr>
                <td>Password &nbsp;&nbsp;&nbsp;</td>
                <td>
                  <input type="password" name="password" id="password"
                  value="912517114301" placeholder="Password"
                  required=true size=20/>
                </td>
            </tr>
            <tr>
                <td>
                </td>
                <td>
                  <input class="login" type="submit" name="Login" value="Login"/>
                  <input class="reset" type="reset" name="Reset" value="Reset"/>
                </td>
            </tr>
          </table>
        </form>
      </div>
<?php
  require_once 'inc/footer.php';
?>
