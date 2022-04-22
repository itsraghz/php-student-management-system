<?php
  //require_once 'inc/header.php';
  require_once __DIR__ . './inc/header.php';

  //check if the user has been already logged into the System

  /*if(isset($_SESSION['user']) && !empty($_SESSION['user'])) {
    header('Location: home.php');
  }*/
?>
      <!--<div class="jumbotron">
        <h1 class="display-4">Hello, world!</h1>
        <p class="lead">This is a simple hero unit, a simple jumbotron-style component for calling extra attention to featured content or information.</p>
        <hr class="my-4">
        <p>It uses utility classes for typography and spacing to space content out within the larger container.</p>
        <p class="lead">
          <a class="btn btn-primary btn-lg" href="#" role="button">Learn more</a>
        </p>
      </div>-->
      <!--<div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
        <ol class="carousel-indicators">
          <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
          <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
          <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
        </ol>
        <div class="carousel-inner">
          <div class="carousel-item active">
            <img class="d-block w-100" src="..." alt="First slide">
          </div>
          <div class="carousel-item">
            <img class="d-block w-100" src="..." alt="Second slide">
          </div>
          <div class="carousel-item">
            <img class="d-block w-100" src="..." alt="Third slide">
          </div>
        </div>
        <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
          <span class="carousel-control-prev-icon" aria-hidden="true"></span>
          <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
          <span class="carousel-control-next-icon" aria-hidden="true"></span>
          <span class="sr-only">Next</span>
        </a>
      </div>-->

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
                  value="912518106005" placeholder="User Name"
                  required=true size=20/>
                </td>
            </tr>
            <tr>
                <td>Password &nbsp;&nbsp;&nbsp;</td>
                <td>
                  <input type="password" name="password" id="password"
                  value="912518106005" placeholder="Password"
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
  //require_once 'inc/footer.php';
  require_once __DIR__ . './inc/footer.php';
?>
