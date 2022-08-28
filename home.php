<?php
  //require_once 'inc/header.php';
  require_once __DIR__ . '/inc/header.php';
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
        if(isset($_SESSION['errorMsg']) && !empty($_SESSION['errorMsg'])) {
          echo "<center><span style='color: red'>" . $_SESSION['errorMsg'] . "</span></center>";
          unset($_SESSION['errorMsg']);
        }
      ?>
      <pre><?php echo print_r($_SESSION); ?></pre>
<?php
  //require_once 'inc/footer.php';
  require_once __DIR__ . '/inc/footer.php';
?>
