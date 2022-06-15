<?php
  //require_once 'inc/header.php';
  require_once __DIR__ . '/inc/header.php';

  //check if the user has been already logged into the System

  /*if(isset($_SESSION['user']) && !empty($_SESSION['user'])) {
    header('Location: home.php');
  }*/
?>
      <div class="welcomeFrame">
        <div class="welcomeMsg">Welcome to the Student Management System (<b>SMS</b>).</div>
        <div class="welcomeTxt">
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
                  //if($_SESSION) {
                  closeSession();
                  //}
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
                    value="hod.ece" placeholder="User Name"
                    required=true size=20/>
                  </td>
              </tr>
              <tr>
                  <td>Password &nbsp;&nbsp;&nbsp;</td>
                  <td>
                    <input type="password" name="password" id="password"
                    value="hod.ece" placeholder="Password"
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
              <?php
                     $IS_ENV_DEV = strcmp(ENV, "DEV")==0;
                     //echo "Env configured :: " . ENV . "<br/>";
              ?>
              <?php

                if($IS_ENV_DEV && DEV_QUICK_LOGIN)
                {
              ?>
                <tr>
                    <td>
                        Populate &rarr;
                    </td>
                    <td>
                        <!--Populate &rarr;
                        <a href="javascript:populate1();">Raghs</a> &nbsp; | &nbsp;
                        <a href="javascript:populate2();">Jhanani</a> &nbsp; | &nbsp;
                        <a href="javascript:clear();">Clear</a>
                        <br/>-->
                        <b>Admin</b> &rarr; <br/>
                        <a href="javascript:populate(0);">Admin</a> &nbsp; | &nbsp;
                        <a href="javascript:populate(1);">Accounts</a> &nbsp; | &nbsp;<br/>
                        <a href="javascript:populate(2);">HOD ECE</a> &nbsp; | &nbsp;
                        <a href="javascript:populate(3);">HOD CSE</a> &nbsp; | &nbsp;
                        <br/><br/>
                        <b>Non Admin</b> &rarr;<br/>
                        <a href="javascript:populate(4);">912518106005</a> &nbsp; | &nbsp;
                        <a href="javascript:populate(5);">912518106010</a> &nbsp; | &nbsp;
                        <!--<a href="javascript:populate(6);">Test</a> &nbsp;&nbsp;&nbsp; | &nbsp;&nbsp;&nbsp;-->
                        <br/>
                        <a href="javascript:clear();">Clear</a>
                    </td>
                </tr>
              <?php
                }
              ?>
            </table>
          </form>
        </div>
      </div>
<?php
  //require_once 'inc/footer.php';
  require_once __DIR__ . '/inc/footer.php';
?>
