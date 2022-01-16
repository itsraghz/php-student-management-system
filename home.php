<?php
  require_once 'inc/header.php';
  //session_start();
?>
      <p class="homePageTxt">
          <?php
            $welcomeMsg = "Welcome ";

            if(isset($_SESSION['userName'])) {
                $welcomeMsg .= "<b>" . $_SESSION['userName'] . "</b>";
            }

            $welcomeMsg .= " to your home page. Please click on the links above to proceed with the functionalities.";

            echo $welcomeMsg;
          ?>
      </p>
<?php
  require_once 'inc/footer.php';
?>
